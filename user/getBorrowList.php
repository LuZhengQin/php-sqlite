<?php

header("Access-Control-Allow-Origin:*");
header('Access-Control-Allow-Methods:*');
$user_id = $_GET['user_id'];
function getBorrowList($mysqli, $user_id)
{
    $arr = array();
    $sql = "SELECT * FROM borrow where sid = '$user_id' and flag = '未归还';";
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
            $borrow_nums = $row['borrow_nums'];
            array_push($arr, array('borrowId' => $borrowid, 'deviceid' => $deviceid, 'borrow_nums' => $borrow_nums, 'devicename' => $devicename,'borrowtime' => $borrowtime, 'returntime' => $returntime, 'flag' => $flag));
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

$arr = getBorrowList($mysqli, $user_id);

echo json_encode($arr);

//获取所有用户数据

