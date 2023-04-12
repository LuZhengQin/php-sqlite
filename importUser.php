<?php
header("Content-type:text/html; charset=utf-8");

// 制定允许其他域名访问
header("Access-Control-Allow-Origin:*");

$dir = dirname(__FILE__);//找到当前脚本所在路径
require $dir."/PHPExcel/PHPExcel/IOFactory.php";//引入读取文件

$filename = $dir."/excel/test1.xlsx";

try {
//    $fileType = PHPExcel_IOFactory::identify($filename);
    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
    $objReader->setReadDataOnly(true);//只需要添加这个方法
    $objPHPExcel = $objReader->load($filename);
} catch (Exception $e) {
    die('Error loading file "'.pathinfo($filename,$dir).'": '.$e->getMessage());
}

/*try{
    $this -> $objPHPExcel  = PHPExcel_IOFactory::load($this->file_name);
    $err_msgs = '';

}catch(ErrorException $e)
{
    $err_msgs = $e.getMessage();
    echo $err_msgs;

}catch (Exception $e)
{
    $err_msgs = $e.getMessage();
    $err_msgs;

}*/


$conn = mysqli_connect("bj-cynosdbmysql-grp-nofx4lqu.sql.tencentcdb.com:25980","root","Lzqzxc,.","dainsai");
mysqli_set_charset($conn, 'utf8');   //选择字符集
//如果有错误，存在错误号
if (mysqli_errno($conn)) {

    echo mysqli_error($conn);

    exit;
}


$sheetCount = $objPHPExcel->getSheetCount();

$sheet = $objPHPExcel->getSheet();
$highestRow = $sheet->getHighestRow();
$highestColumn = $sheet->getHighestColumn();

$password = 123456;
$desc = "默认值";
$type = 0;


$flag = true;
for ($row = 2; $row <= $highestRow; $row++) {
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
    $user_id = $rowData[0][0];
    $name = $rowData[0][1];
    $email = $rowData[0][2];
    $phone = $rowData[0][3];
    $gender = $rowData[0][4];
    $college = $rowData[0][5];
    $class = $rowData[0][6];
    $room = $rowData[0][7];
    $seat = $rowData[0][8];

    $sql = "insert into `t_user_real` (user_id, name, password, college, class, phone, email, gender, description, type, room, seat)
VALUES ('$user_id', '$name', '$password', '$college', '$class', '$phone', '$email', '$gender', '$desc', '$type', '$room', '$seat');";

    if ($conn->query($sql) === TRUE) {
        $flag = true;
    } else {
        $flag = false;
    }
}

if ($flag === true) {
    $arr = array('status' => 200);
    echo json_encode($arr);
}
else {
    $arr = array('status' => 500);
    echo json_encode($arr);
}
exit;
?>