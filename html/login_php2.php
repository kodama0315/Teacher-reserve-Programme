<?php
//设置文件执行的编码
header("Content-type: text/html; charset=utf-8");
 
$link=new mysqli('127.0.0.1','root','yby479155','stu_tch');
$link->set_charset("utf8");
$num=$_POST["login_num"];
$pwd=$_POST["login_pwd"];
$judge=$_POST["judge_login"];
if($link->connect_error){
    die("连接失败：".$link->connect_error);
}
if($judge=="student"){
	$sql2="select * from stu where snum like '$num' and pwd like '$pwd'";
	$res2=$link->query($sql2);

	if ($res2->num_rows > 0) {
    	// 输出数据
    	if($row = $res2->fetch_assoc()) {
			$student_nam=$row["snam"];
			$student_num=$row["snum"];
			session_start();
  			$_SESSION['student_nam']=$student_nam;
  			$_SESSION['student_num']=$student_num;
			$_SESSION['judge_id']="student";
        	header("location:http://localhost/project2020/initial/html/index.html");
    	}
	} else {
    	echo "<script language=\"JavaScript\">\r\n";
		echo " alert(\"用户名或密码错误\");\r\n";
		echo " location.replace(\"http://localhost/project2020/initial/html/login2.html\");\r\n"; 
		echo "</script>";
		exit;
	}
	$link->close();
}
elseif($judge=="teacher"){
	$sql2="select * from tch where tnum like '$num' and pwd like '$pwd'";
	$res2=$link->query($sql2);

	if ($res2->num_rows > 0) {
    	// 输出数据
    	if($row = $res2->fetch_assoc()) {
			$student_nam=$row["tnam"];
			$student_num=$row["tnum"];
			session_start();
  			$_SESSION['student_nam']=$student_nam;
  			$_SESSION['student_num']=$student_num;
			$_SESSION['judge_id']="teacher";
        	header("location:http://localhost/project2020/initial/html/index.html");
    	}
	} else {
    	echo "<script language=\"JavaScript\">\r\n";
		echo " alert(\"用户名或密码错误\");\r\n";
		echo " location.replace(\"http://localhost/project2020/initial/html/login2.html\");\r\n"; 
		echo "</script>";
		exit;
	}
	$link->close();
} else{
		echo "<script language=\"JavaScript\">\r\n";
		echo " alert(\"访问控制出错\");\r\n";
		echo " location.replace(\"http://localhost/project2020/initial/html/login2.html\");\r\n"; 
		echo "</script>";
		exit;
}
?>