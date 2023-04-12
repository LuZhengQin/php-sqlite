<?php

header("Access-Control-Allow-Origin:*");

function getBorrowList($mysqli)
{
    $arr = array();
    $sql = "SELECT * FROM borrow;";
    $result = $mysqli->query($sql);
    $num = $result->num_rows;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $borrowid = $row['borrowid'];
            $deviceid = $row['deviceid'];
            $sid = $row['sid'];
            $devicename = $row['devicename'];
            $borrowtime = $row['borrowtime'];
            $returntime = $row['returntime'];
            $flag = $row['flag'];
            $stuname = null;
            $sql1 = "SELECT name FROM t_user_real where user_id = '$sid';";
            $result = $mysqli->query($sql1);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $stuname = $row['name'];
                }
            }
            array_push($arr, array('borrowId' => $borrowid, 'deviceid' => $deviceid, 'stuname' => $stuname, 'devicename' => $devicename,'borrowtime' => $borrowtime, 'returntime' => $returntime, 'flag' => $flag));
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

$arr = getBorrowList($mysqli);

echo json_encode($arr);

//获取所有用户数据

