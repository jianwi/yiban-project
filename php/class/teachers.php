<?php
/**
 * 教师类
 *
 */

class students extends tools {
	public $yb_uid; //易班uid
	public $class; //班级信息
	public $students_name; //学生名字
	public $students_number; //学号

// 构造函数，查询并保存用户的姓名,学号，班级等信息

	function __construct($yb_uid) {

		$this->yb_uid = $yb_uid;

		$db = $this->pdos();
		$db->exec("set names utf8");
		$sql = "select * from students where yb_uid='{$yb_uid}'";
		$db->query($sql);
		$this->class = $a->fetchColumn(3);
		$this->students_name = $a->fetchColumn(2);
		$this->students_number = $a->fetchColumn(4);

	}

//保存表单
function save_form($text,$date1,$date2,$classes){

}