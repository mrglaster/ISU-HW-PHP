<?php
$db = new PDO("mysql:dbname=calls_table;host=localhost", "testadmin", "testadmin");
$db->query("use calls_table");
$sql = "insert into  calls (id, phone_init, phone_receiver, duration, date) values  (4,".'"'."88003412345".'"'.','.'"'."89874617264".'"'.','.'"'."2.11".'"'.','.'"'."01-09-2003".'"'.");";
$db->prepare($sql)->execute();
echo "Test line was added!\n";