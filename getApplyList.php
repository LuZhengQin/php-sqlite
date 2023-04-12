<?php
header("Access-Control-Allow-Origin:*");

function getApplyList($mysqli)
{
    $arr = array();
    $sql = "SELECT * FROM apply;";
    $result = $mysqli->query($sql);
    $num = $result->num_rows;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $apply_id = $row['apply_id'];
            $apply_time = $row['time'];
            $deviceid = $row['deviceid'];
            $sid = $row['sid'];
            $flag = $row['flag'];
            $apply_nums = $row['apply_nums'];
            $stuname = null;
            $sql1 = "SELECT name FROM t_user_real where user_id = '$sid';";
            $result1 = $mysqli->query($sql1);
            if ($result1->num_rows > 0) {
                while ($row = $result1->fetch_assoc()) {
                    $stuname = $row['name'];
                }
            }
            $sql2 = "SELECT * FROM device where deviceid = '$deviceid';";
            $result2 = $mysqli->query($sql2);
            $devicename = null;
            $available_nums = null;
            if ($result2->num_rows > 0) {
                while ($row = $result2->fetch_assoc()) {
                    $devicename = $row['devicename'];
                    $available_nums = $row['available_nums'];
                }
            }
            array_push($arr, array('apply_id' => $apply_id, 'apply_time' => $apply_time, 'deviceid' => $deviceid, 'devicename' => $devicename, 'flag' => $flag,
                'apply_nums' => $apply_nums, 'sid' => $sid, 'stuname' => $stuname, 'sid' => $sid, 'available_nums' => $available_nums));
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

$arr = getApplyList($mysqli);

echo json_encode($arr);

//获取所有用户数据

