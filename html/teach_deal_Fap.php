<?php
//设置文件执行的编码
header("Content-type: text/html; charset=utf-8");
 
$link=new mysqli('127.0.0.1','root','yby479155','stu_tch');
$link->set_charset("utf8");
$sch_num=$_POST["tacherselect"];
$reason=$_POST["reason"];
if($link->connect_error){
    die("连接失败：".$link->connect_error);
}
$sql2="update schedule set late='1',reason='$reason' where sch_num='$sch_num'";
$res2=$link->query($sql2);
$line=$res2->num_rows;
if ($res2) {
	echo "<script language=\"JavaScript\">\r\n";
	echo " alert(\"失约处理成功\");\r\n";
	echo " location.replace(\"http://localhost/project2020/initial/html/sign.html\");\r\n"; 
	echo "</script>";
	exit;
} else {
    echo "<script language=\"JavaScript\">\r\n";
	echo " alert(\"失约处理失败\");\r\n";
	echo " location.replace(\"http://localhost/project2020/initial/html/sign.html\");\r\n"; 
	echo "</script>";
	exit;
}

$link->close();
?>