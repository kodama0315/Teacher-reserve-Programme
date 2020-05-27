<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();
	$judge_id=$_SESSION['judge_id'];
	if($judge_id=="student"){
		$student_num=$_SESSION['student_num'];
		$link=new mysqli('127.0.0.1','root','yby479155','stu_tch');
		$link->set_charset("utf8");
		if($link->connect_error){
   			die("连接失败：".$link->connect_error);
		}
		$sql2="select b.tnam,a.week,a.weekday,a.time,b.emil,a.reason from schedule as a left join tch as b on a.tnum=b.tnum where a.late like '1' and a.snum='$student_num'";
		$res2=$link->query($sql2);
		$line=$res2->num_rows;
		if ($line > 0) {
	    	// 输出数据
	    	$row = $res2->fetch_all(); 
	    	$_SESSION["late_line_s"]=$line;
			$_SESSION["late_row_s"]=$row;
	    	//echo $line."、".$row[0][0]."、".$row[0][1]."、".$row[0][2];
			$link->close();
			header("location:http://localhost/project2020/initial/html/default_record.html");
	    
		} 
	}elseif($judge_id=="teacher"){
		$teacher_num=$_SESSION['student_num'];
		$link=new mysqli('127.0.0.1','root','yby479155','stu_tch');
		$link->set_charset("utf8");
		if($link->connect_error){
   			die("连接失败：".$link->connect_error);
		}
			$sql2="select a.sch_num,b.snam,a.week,a.weekday,a.time,b.emil from schedule as a left join stu as b on a.snum=b.snum where a.state like '1' and a.tnum='$teacher_num' and a.snum is not NULL ";
			$res2=$link->query($sql2);
			$line=$res2->num_rows;
			if ($line > 0) {
	    	// 输出数据
	    	$row = $res2->fetch_all(); 
	    	$_SESSION["late_line_t"]=$line;
			$_SESSION["late_row_t"]=$row;
	    	//echo $line."、".$row[0][0]."、".$row[0][1]."、".$row[0][2];
			$link->close();
			header("location:http://localhost/project2020/initial/html/sign.html");
			
			}
	}else{
		echo "<script language=\"JavaScript\">\r\n";
		echo " alert(\"非法访问\");\r\n";
		echo " location.replace(\"http://localhost/project2020/initial/html/login.html\");\r\n"; 
		echo "</script>";
		exit;
	}

?>