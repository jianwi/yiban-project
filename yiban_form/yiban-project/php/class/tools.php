<?php
/*
 *
 *
 */
function __construct($yb_uid) {

	date_default_timezone_set("Asia/Shanghai");
	$date = time();
	$this->date = $date;
	$this->yb_uid = $yb_uid;
}

//初始化pdo

function pdos() {

	try {
		$db = new PDO(dsn, username, passwd);
	} catch (PDOException $e) {
		die("couldn't connect to the database" . $e);
	}
	return $db;
}