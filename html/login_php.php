<?php
//设置文件执行的编码
header("Content-type: text/html; charset=utf-8");
 
$link=new mysqli('127.0.0.1','root','yby479155','stu_tch');
$link->set_charset("utf8");
$snum=$_POST["login_num"];
$spwd=$_POST["login_pwd"];

if($link->connect_error){
    die("连接失败：".$link->connect_error);
}
$sql2="select * from stu where snum like '$snum' and pwd like '$spwd'";
$res2=$link->query($sql2);

if ($res2->num_rows > 0) {
    // 输出数据
    if($row = $res2->fetch_assoc()) {
		$student_nam=$row["snam"];
		$student_num=$row["snum"];
		session_start();
  		$_SESSION['student_nam']=$student_nam;
  		$_SESSION['student_num']=$student_num;
        header("location:http://localhost/project2020/initial/html/index.html");
    }
} else {
    echo "<script language=\"JavaScript\">\r\n";
	echo " alert(\"用户名或密码错误\");\r\n";
	echo " location.replace(\"http://localhost/project2020/initial/html/login.html\");\r\n"; 
	echo "</script>";
	exit;
}

$link->close();
?>