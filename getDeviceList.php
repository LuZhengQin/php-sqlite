<?php

header("Access-Control-Allow-Origin:*");

function getCourseList($mysqli)
{
    $arr = array();
    $sql = "SELECT * FROM device;";
    $result = $mysqli->query($sql);
    $num = $result->num_rows;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $deviceid = $row['deviceid'];
            $devicename = $row['devicename'];
            $available_nums = $row['available_nums'];
            $total_nums = $row['total_nums'];
            array_push($arr, array('deviceid' => $deviceid, 'devicename' => $devicename, 'available_nums' => $available_nums,'total_nums' => $total_nums));
        }
    }
    $result = array('code' => 0, 'msg' => '', 'count' => $num, 'data' => $arr);
    return $result;
}

//$conn
$mysqli = mysqli_connect("bj-cynosdbmysql-grp-nofx4lqu.sql.tencentcdb.com:25980","root","Lzqzxc,.","dainsai");

//如果有错误，存在错误号
if (mysqli_errno($mysqli)) {

    echo mysqli_error($mysqli);

    exit;
}

mysqli_set_charset($mysqli, 'utf8');   //选择字符集

$arr = getCourseList($mysqli);

echo json_encode($arr);

//获取所有用户数据

