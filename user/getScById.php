<?php
header("Access-Control-Allow-Origin:*");
$user_id = $_GET['user_id'];
function getStudentScores($mysqli, $sid)
{
    $arr = array();
    $sql = "SELECT * FROM sc where sid = '$sid';";
    $result = $mysqli->query($sql);
    $num = $result->num_rows;

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cid = $row['cid'];
            $sql1 = "SELECT * FROM t_user_real where user_id = '$sid';";
            $sql2 = "SELECT * FROM course where cosid = '$cid';";
            $result1 = $mysqli->query($sql1);
            $result2 = $mysqli->query($sql2);
            $stuname =null;
            $cosname = null;
            if ($result1->num_rows > 0) {
                while ($row = $result1->fetch_assoc()) {
                    $stuname = $row['name'];
                }
            }
            if ($result2->num_rows > 0) {
                while ($row = $result2->fetch_assoc()) {
                    $cosname = $row['cosname'];
                }
            }
            array_push($arr, array('cid' => $cid, 'cosname' => $cosname,'stuname' => $stuname, 'sid' => $sid));
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

$arr = getStudentScores($mysqli, $user_id);

echo json_encode($arr);

//获取所有用户数据

