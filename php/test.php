<?php

const dsn = "mysql:dbname=yb_form;host=jianwi.cn;port=3306";
const username = "yb_form";
const passwd = "jianwi.cn";
$db = new PDO(dsn, username, passwd);

$db->exec("set names utf8");
$sql = "select classybname from yb_classlist left join yb_adminlist on yb_classlist.classteacher=yb_adminlist.teacherid WHERE yb_adminlist.teacherid=5554641";
$a = $db->query($sql);
$db = null;
print_r(array_column($db->query($sql)->fetchAll(), "classybname")); //返回符合条件的表单id值
?>