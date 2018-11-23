<?php

const dsn = "mysql:dbname=yb_form;host=jianwi.cn;port=3306";
const username = "yb_form";
const passwd = "jianwi.cn";
$db = new PDO(dsn, username, passwd);

$db->exec("set names utf8");
$sql = "select * from forms where id= '4'";
$a = $db->query($sql);
print_r($a->fetchAll()); //返回符合条件的表单id值

?>