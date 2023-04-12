<?php

header("Access-Control-Allow-Origin:*");

error_reporting(0);

if ( (($_COOKIE['username']) != null)  && (($_COOKIE['password']) != null) ) {
    $user_id = $_COOKIE['user_id'];
    $password = $_COOKIE['password'];

    //从db获取用户信息
    //PS：数据库连接信息改成自己的 分别为主机 数据库用户名 密码
    $conn = mysqli_connect("bj-cynosdbmysql-grp-nofx4lqu.sql.tencentcdb.com:25980","root","Lzqzxc,.","dainsai");
    $res = mysqli_query($conn,"select * from t_user where user_id =  '$user_id' ");
    $row = mysqli_fetch_assoc($res);
    $arr = array('status' => 200);
    echo json_encode($arr);
}

//第一次登陆的时候，通过用户输入的信息来确认用户

    $user_id = $_POST['user_id'];
    $password = $_POST['password'];
    //从db获取用户信息
    $conn = mysqli_connect("bj-cynosdbmysql-grp-nofx4lqu.sql.tencentcdb.com:25980","root","Lzqzxc,.","dainsai");

    $sql = "select user_id,password from t_user_real where user_id = '$user_id'";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($res);
    if	($row['user_id']!=$user_id) {
        $arr = array('status' => 100);
        echo json_encode($arr);
    }
    else if($row['user_id'] == $user_id && $row['password'] != $password)
    {
        $arr = array('status' => 500);
        echo json_encode($arr);
    }
    else if($row['user_id']==$user_id&&$row['password'] ==$password) {
        //最后跳转到登录后的欢迎页面
        $arr = array('status' => 200);
        echo json_encode($arr);
    }
  



?>

