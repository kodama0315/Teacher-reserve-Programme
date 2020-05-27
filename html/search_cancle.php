<?php
//设置文件执行的编码
header("Content-type: text/html; charset=utf-8");

$link=new mysqli('127.0.0.1','root','yby479155','stu_tch');
$link->set_charset("utf8");
session_start();
$student_num = $_SESSION['student_num'];
if($link->connect_error){
    die("连接失败：".$link->connect_error);
}
$sql2="select a.sch_num,b.tnam,a.weekday,a.week,a.time,a.tip from schedule as a left join tch as b on a.tnum=b.tnum where a.snum like '$student_num' and a.state like '1'";
$res2=$link->query($sql2);
$line=$res2->num_rows;
if ($line > 0) {
    // 输出数据
    $row = $res2->fetch_all(); 
    $_SESSION["record_line"]=$line;
	$_SESSION["record_row"]=$row;
    //echo $line."、".$row[0][0]."、".$row[0][1]."、".$row[0][2];
	header("location:http://localhost/project2020/initial/html/cancel_reserve2.html");
    
} else {
    echo "<script language=\"JavaScript\">\r\n";
	echo " alert(\"没有预约\");\r\n";
	echo " location.replace(\"http://localhost/project2020/initial/html/index.html\");\r\n"; 
	echo "</script>";
	exit;
}

$link->close();
?>