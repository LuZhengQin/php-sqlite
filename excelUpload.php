<?php
header("Content-type:text/html; charset=utf-8");

header("Access-Control-Allow-Origin:*");
$excelFolder = "excel/";
$dir = dirname(__FILE__);//找到当前脚本所在路径
require $dir."/PHPExcel/PHPExcel/IOFactory.php";//引入读取文件


if ($_FILES["file"]["error"] > 0)
{
    echo "错误：" . $_FILES["file"]["error"] . "<br>";
}
else
{

    $filename = $_SERVER['DOCUMENT_ROOT'].'/php/excel/'.$_FILES["file"]["name"];
    $filetowrite = $excelFolder . $_FILES["file"]["name"];
    $flag = move_uploaded_file($_FILES["file"]["tmp_name"], $filetowrite);
    //$flag = move_uploaded_file($_FILES["file"]["tmp_name"], $filename);
    echo json_encode(array('flag' => $flag));
    echo json_encode(array('location' => $_FILES["file"]["tmp_name"]));
    echo json_encode(array('location' => $filetowrite));
    echo json_encode(array('location' => $filename));
}
?>