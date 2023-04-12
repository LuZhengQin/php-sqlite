<?php

header("Access-Control-Allow-Origin:*");

$page = $_GET["page"];
$limit = $_GET["limit"];

function getUserList($mysqli, $page, $limit)
{
    $startRow = ($page - 1) * $limit;
    $arr = array();
    $sql = "SELECT * FROM t_user_real limit $startRow,$limit";
    $result = $mysqli->query($sql);
    $num = $result->num_rows;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $user_id = $row['user_id'];
            $name = $row['name'];
            $college = $row['college'];
            $class = $row['class'];
            $phone = $row['phone'];
            $email = $row['email'];
            $gender = $row['gender'];
            $description = $row['description'];
            $room = $row['room'];
            $seat = $row['seat'];
            array_push($arr, array('user_id' => $user_id, 'name' => $name, 'college' => $college, 'class' => $class, 'phone' => $phone, 'email' => $email, 'sex' => $gender, 'decription' => $description, 'room' => $room, 'seat' => $seat));
        }
    }
    $result = array('code' => 0, 'msg' => '', 'count' => $num, 'data' => $arr);
    return $result;
}

//$conn
$mysqli = mysqli_connect("bj-cynosdbmysql-grp-nofx4lqu.sql.tencentcdb.com:25980", "root", "Lzqzxc,.", "dainsai");
//$mysqli = mysqli_connect("localhost","root","136928","dainsai");

//如果有错误，存在错误号
if (mysqli_errno($mysqli)) {

    echo mysqli_error($mysqli);

    exit;
}

mysqli_set_charset($mysqli, 'utf8');   //选择字符集

$arr = getUserList($mysqli, $page, $limit);

echo json_encode($arr);

//获取所有用户数据

