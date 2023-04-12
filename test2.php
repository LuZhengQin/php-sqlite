<?php

$dir = dirname(__FILE__);//找到当前脚本所在路径
require $dir."/PHPExcel/PHPExcel/IOFactory.php";//引入读取文件

function processExcel($filename){

    $objPHPExcel = PHPExcel_IOFactory::load($filename);//加载文件

    $sheet = $objPHPExcel->getSheet();
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();

    $password = 123456;
    $desc = "默认值";
    $type = 0;

    for ($row = 2; $row <= $highestRow; $row++) {
        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
        echo $rowData[0][8];
        $user_id = $rowData[0][0];
        $name = $rowData[0][1];
        $email = $rowData[0][2];
        $phone = $rowData[0][3];
        $gender = $rowData[0][4];
        $college = $rowData[0][5];
        $class = $rowData[0][6];
        $room = $rowData[0][7];
        $seat = $rowData[0][8];

        /*$sql = "insert into `t_user_real` (user_id, name, password, college, class, phone, email, gender, description, type, room, seat)
    VALUES ('$user_id', '$name', '$password', '$college', '$class', '$phone', '$email', '$gender', '$desc', '$type', '$room', '$seat');";*/
//    $sql="insert into t_user_real('user_id','password','name','email','phone','gender','college','class','type','description', 'room', 'seat') values ($rowData[0][0], $password, $rowData[0][1], $rowData[0][2], $rowData[0][3], $rowData[0][4], $rowData[0][5]', '$rowData[0][6], $type, $desc, $rowData[0][7],$rowData[0][8])";

        /*if ($conn->query($sql) === TRUE) {
            echo "ok";
        } else {
            echo "error";
        }*/
//    $query=mysqli_query($conn,$sql);//函数执行一条 MySQL 查询。
    }
}

?>