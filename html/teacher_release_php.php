<?php
//设置文件执行的编码
header("Content-type: text/html; charset=utf-8");

$link=new mysqli('127.0.0.1','root','yby479155','stu_tch');
$link->set_charset("utf8");
if($link->connect_error){
    die("连接失败：".$link->connect_error);
}
$sql2="select b.tnam,b.tnum,a.week,a.weekday,a.time,b.emil,a.tip from schedule as a left join tch as b on a.tnum=b.tnum where a.state like '0'";
$res2=$link->query($sql2);
$line=$res2->num_rows;
if ($line > 0) {
    // 输出数据
    $row = $res2->fetch_all(); 
	session_start();
    $_SESSION["teacher_line"]=$line;
	$_SESSION["teacher_vlid"]=$row;
    //echo $line."、".$row[0][0]."、".$row[0][1]."、".$row[0][2];
	$link->close();
	header("location:http://localhost/project2020/initial/html/teacher_release.html");
    
} else {
	$link->close();
    echo "<script language=\"JavaScript\">\r\n";
	echo " alert(\"没有老师空闲\");\r\n";
	echo " location.replace(\"http://localhost/project2020/initial/html/index.html\");\r\n"; 
	echo "</script>";
	exit;
}

?>