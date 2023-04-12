<?php
header("Access-Control-Allow-Origin:*");

$excelFolder = "excel/";
$dir = dirname(__FILE__);//找到当前脚本所在路径
require $dir."/test2.php";

$allowedExts = array("xls", "xlsx");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);        // 获取文件后缀名
if (($_FILES["file"]["size"] < 20480000)    // 小于 200 kb
    && in_array($extension, $allowedExts))
{
    if ($_FILES["file"]["error"] > 0)
    {
        echo "错误：: " . $_FILES["file"]["error"] . "<br>";
    }
    else
    {
        /*echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
        echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
        echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
        echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"];*/
        // 都没问题，就将上传数据移动到目标文件夹，此处直接使用原文件名，建议重命名
        $filetowrite = $excelFolder . $_FILES["file"]["name"];
        move_uploaded_file($_FILES["file"]["tmp_name"], $filetowrite);
        echo json_encode(array('location' => $filetowrite));


        $filename = $dir + "/$filetowrite";
        echo $filename;
        //processExcel($filename);

//        unlink($filetowrite);

    }
}
else
{
    echo "非法的文件格式";
}
?>