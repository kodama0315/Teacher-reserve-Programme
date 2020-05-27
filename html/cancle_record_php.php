<?php
//设置文件执行的编码
header("Content-type: text/html; charset=utf-8");
 
$link=new mysqli('127.0.0.1','root','yby479155','stu_tch');
$link->set_charset("utf8");
$sch_num=$_POST["cancle"];
session_start();
$student_num = $_SESSION['student_num'];

if($link->connect_error){
    die("连接失败：".$link->connect_error);
}
$sql2="update schedule set state='0',snum=NULL where sch_num='$sch_num'";
$res2=$link->query($sql2);
$line=$res2->num_rows;
if ($res2) {
	echo "<script language=\"JavaScript\">\r\n";
	echo " alert(\"修改成功\");\r\n";
	echo " location.replace(\"http://localhost/project2020/initial/html/cancel_reserve.html\");\r\n"; 
	echo "</script>";
	exit;
} else {
    echo "<script language=\"JavaScript\">\r\n";
	echo " alert(\"修改失败\");\r\n";
	echo " location.replace(\"http://localhost/project2020/initial/html/cancel_reserve.html\");\r\n"; 
	echo "</script>";
	exit;
}

$link->close();
?>