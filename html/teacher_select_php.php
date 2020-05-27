<?php
//设置文件执行的编码
header("Content-type: text/html; charset=utf-8");
 
$link=new mysqli('127.0.0.1','root','yby479155','stu_tch');
$link->set_charset("utf8");
$teacher_nam=$_POST["teacher_name"];
$select_week=$_POST["select_week"];

if($link->connect_error){
    die("连接失败：".$link->connect_error);
}
$sql2="select a.sch_num,b.tnam,a.tnum,a.weekday,a.week,a.time,a.state from schedule as a left join tch as b on a.tnum=b.tnum where b.tnam like '$teacher_nam' and a.week like '$select_week' and a.state like '0'";
$res2=$link->query($sql2);
$line=$res2->num_rows;
if ($line > 0) {
    // 输出数据
    $row = $res2->fetch_all(); 
	session_start();
    $_SESSION["sch_select"]=$row;
	$_SESSION["sch_line"]=$line;
    header("location:http://localhost/project2020/initial/html/teacher_select.html");
    
} else {
    echo "<script language=\"JavaScript\">\r\n";
	echo " alert(\"维护中\");\r\n";
	echo " location.replace(\"http://localhost/project2020/initial/html/teacher_select.html\");\r\n"; 
	echo "</script>";
	exit;
}

$link->close();
?>