<?php
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('test.db');
    }
}
$db = new MyDB();
if(!$db){
    echo $db->lastErrorMsg();
} else {
    echo "Opened database successfully\n";
}

$sql =<<<EOF
      SELECT * from test;
EOF;
$arr = array();

$ret = $db->query($sql);
while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
    /*echo "ID = ". $row['id'] . "\n";
    echo "NAME = ". $row['name'] ."\n";*/
    array_push($arr, array('user_id' => $row['id'], 'name' => $row['name']));
}
echo "Operation done successfully\n";
$result = array('code' => 0, 'msg' => '', 'count' => 2, 'data' => $arr);
echo json_encode($result);
$db->close();
?>