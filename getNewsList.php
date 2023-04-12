<?php

header("Access-Control-Allow-Origin:*");

function getNewsList($mysqli)
{
    $arr = array();
    $sql = "SELECT * FROM news;";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $news_id = $row['news_id'];
            $title = $row['title'];
            $detail = $row['detail'];
            $time = $row['time'];
            $editTime = $row['editTime'];
            array_push($arr, array('news_id' => $news_id, 'title' => $title, 'detail' => $detail, 'time' => $time, 'editTime' => $editTime));
        }
    }
    return $arr;
}

//$conn
$mysqli = mysqli_connect("bj-cynosdbmysql-grp-nofx4lqu.sql.tencentcdb.com:25980","root","Lzqzxc,.","dainsai");

//如果有错误，存在错误号
if (mysqli_errno($mysqli)) {

    echo mysqli_error($mysqli);

    exit;
}

mysqli_set_charset($mysqli, 'utf8');   //选择字符集

$arr = getNewsList($mysqli);

echo json_encode($arr);

//获取所有用户数据

