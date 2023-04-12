<?php
header("Access-Control-Allow-Origin:*");

function getStudentScores($mysqli)
{
    $arr = array();
    $sql = "SELECT * FROM sc;";
    $result = $mysqli->query($sql);
    $num = $result->num_rows;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $scid = $row['scid'];
            $cid = $row['cid'];
            $sid = $row['sid'];
            $sql1 = "SELECT * FROM student where stuid = '$sid';";
            $sql2 = "SELECT * FROM course where cosid = '$cid';";
            $result1 = $mysqli->query($sql1);
            $result2 = $mysqli->query($sql2);
            $stuname =null;
            $cosname = null;
            if ($result1->num_rows > 0) {
                while ($row = $result1->fetch_assoc()) {
                    $stuname = $row['stuname'];
                }
            }
            if ($result2->num_rows > 0) {
                while ($row = $result2->fetch_assoc()) {
                    $cosname = $row['cosname'];
                }
            }
            array_push($arr, array('scid' => $scid, 'cid' => $cid, 'cosname' => $cosname, 'stuname' => $stuname, 'sid' => $sid));
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

$arr = getStudentScores($mysqli);

echo json_encode($arr);

//获取所有用户数据

