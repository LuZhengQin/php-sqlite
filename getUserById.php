

<?php
header("Access-Control-Allow-Origin:*");
$user_id = $_GET["user_id"];

function getUserById($mysqli, $user_id)
{

    $arr = array();
    $sql = "SELECT * FROM t_user_real where user_id = '$user_id';";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
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

$result = getUserById($mysqli, $user_id);
echo json_encode($result);