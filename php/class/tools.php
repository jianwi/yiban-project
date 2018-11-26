<?php
/*
 *公用类，不明确责任类
 *写入用户信息
 *申请成为老师
 *
 */

class tools {
	public $date;
	public $yb_uid;

	function __construct($yb_uid) {
		date_default_timezone_set("Asia/Shanghai");
		$date = time();
		$this->date = $date;
		$this->yb_uid = $yb_uid;
	}

// 获取当前时间戳，int

	function get_time_now() {
		date_default_timezone_set("Asia/Shanghai");
		return time();
	}

//初始化pdo

	function pdos() {

		try {
			$db = new PDO(dsn, username, passwd);
		} catch (PDOException $e) {
			die("couldn't connect to the database" . $e);
		}
		$db->exec("set names utf8");
		return $db;
	}

// 写入用户信息到数据库，bool

	function write_details($yb_uid, $name, $school, $college_name, $class, $studentid, $type) {
		$db = $this->pdos();
		$db->exec("set names utf8");
		$sql = "INSERT INTO `users`(`yb_uid`, `name`, `school`, `college_name`, `class`, `studentid`, `type`) VALUES ('{$yb_uid}','$name','$school','$college_name','$class','$studentid','$type')";

		$a = $db->exec($sql);
		$db = null;
		return $a;
	}

//申请老师身份

	function to_be_teacher($classes) {
		$yb_uid = $this->yb_uid;

	}

}
