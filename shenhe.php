

<?php

$user_id = $_POST["user_id"];
$password = 123456;
$name = $_POST["name"];
$college = $_POST["college"];
$class =  $_POST["class"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$gender =  $_POST["gender"];
$description = $_POST["description"];
$type = 2;

//$conn
$mysqli = mysqli_connect("bj-cynosdbmysql-grp-nofx4lqu.sql.tencentcdb.com:25980","root","Lzqzxc,.","dainsai");

//如果有错误，存在错误号
if (mysqli_errno($mysqli)) {

    echo mysqli_error($mysqli);

    exit;
}
mysqli_set_charset($mysqli, 'utf8');   //选择字符集
$sql = "INSERT INTO `t_user_real` (`name`, `password`, `user_id`, `college`, `class`, `phone`, `email`, `gender`, `type`, `description`) 
        VALUES ('$name', '$password', '$user_id', '$college', '$class', '$phone', '$email', '$gender', '$type', '$description');";


if ($mysqli->query($sql) === TRUE) {
    $arr = array('status' => 200);
    echo json_encode($arr);
} else {
    $arr = array('status' => 500);
    echo json_encode($arr);
}

?>