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
      UPDATE test set name = lzq1 where ID=1;
EOF;
$ret = $db->exec($sql);
if(!$ret){
    echo $db->lastErrorMsg();
} else {
    echo $db->changes(), " Record updated successfully\n";
}

$sql =<<<EOF
      SELECT * from test;
EOF;
$ret = $db->query($sql);
while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
    echo "ID = ". $row['ID'] . "\n";
    echo "NAME = ". $row['NAME'] ."\n";
}
echo "Operation done successfully\n";
$db->close();
?>