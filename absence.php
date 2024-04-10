<!DOCTYPE html>
<html>
<head>
<style>
		*{ margin:0;padding:0;}

		/*header*/
		header { width:100%; height:100px; background-color:#334081; padding-top:10px;}
        #header .nav li         { 
								list-style:none; background:#e8e8e8; width:25%; height:40px; 
								text-align:center; float:left; padding:15px 0 2px 0;
								margin-top:10px; border:1px dotted black;
								}
        #header .nav li a       { font-size: 12px; color:#000; text-decoration:none;}
		#header .nav li a:hover { color:red;}
				
	/*sidemenu*/			
				div {}
				#sidemenu {margin-left:20px; margin-top:50px; color:#666666;}
				
	/*main_menu*/
				#main_menu li{
					color:#666666;
					display:inline;
					margin-right:150px;
					font-size:20px;
					font-weight:bold;
					padding : 0 0 20px 0;
					font-align:center;
				}
				#main_menu ul{
					list-style:none;
					width:90%;
					padding:35px;
					margin:20px 0 10px 40px;
					border:solid 6px #e6e6e6;
					text-align:center;
				}
								
		/*main table*/<!--main_table-->	
				#main{background-color:ff0000;}
				#main .table_tr {background-color:#dedede;}
				#main table, th, td { border:1px solid #bcbcbc;  border-collapse:collapse; text-align:center;}
				#main table { margin-left:50px; width:95%; font-size:13px; margin-top:10px;}
				#main th { height:35px; background-color:#e6e6e6;}
				#main td { height:40px;}
				
		.add	{ height:32px; width:75px; margin-left:10px; }
	

</style>
</head>
<body>
<header id="header" class="clearfix">
<?php
    session_start();
    
    if (empty($_SESSION["userId"])) {
?>  
		<form action="login.php" method="post" class="hform" 
				style="margin-left:60%;width:680px;height:60px;border:0;" >
			아이디:   <input type="text" size="10" name="id">&nbsp;&nbsp;
			비밀번호: <input type="password" size="10" name="pw">
			<input type="submit" value="관리자로그인" style="width:90px;height:28px; margin-top:30px;">
		</form>
<?php
    } else {
?>
        <form action="logout.php" method="post" 
				style="margin-left:82.5%;width:200px;height:60px; border:0; color:#ffffff; margin">
            <?=$_SESSION["userName"]?>님 로그인 
            <input type="submit" value="로그아웃" style="width:70px;height:24px; margin-top:30px;">
        </form>
<?php        
    }
?>
    <nav class="nav">
        <ul>
            <li><a href="list.php">학생관리</a></li>
            <li><a href="c_check.php">수강관리 </a></li>
            <li><a href="timetable.php">시간표 </a></li>
            <li style="width:24.37%; background-color:#242e60;"><a href="absence.php" style="color:#fff;">출결관리 </a></li>
        </ul>
    </nav>
</header>
<div id="sidemenu"> <!--출결현황-->
	<h2> >> 오늘 출결 현황 </h2>
	<section id="main_menu">
<?php
		$date = date("Y-m-d"); // 오늘날짜
		$week = array("일","월","화","수","목","금","토");	 
		$week = $week[date('w', strtotime($date))]; //오늘요일
		
		try {
		  $db = new PDO("mysql:host=localhost;dbname=phpdb", "php", "1234");
		  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		  
		$query = $db->query("SELECT COUNT(*) as cnt from student s");
		
		if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$cnt = $row["cnt"];

?>
		<ul>
		  <li>총원 :<?=$cnt?>명</li>
<?php
		}
		$query = $db->query("SELECT COUNT(*) as cnt from student s, checkon o WHERE o.id=s.id AND o.c_on='결석' AND o.c_datex='$date'");
		
		if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$c_datex = empty($row["cnt"]) ? "0" : $row["cnt"];

?>
		  <li>결석 :<?=$c_datex?>명</li>
<?php
		}
		$query = $db->query("SELECT COUNT(*) as cnt from student s, checkon o WHERE o.id=s.id AND o.c_on='출석' AND o.c_date='$date'");
		
		if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$c_date = empty($row["cnt"]) ? "0" : $row["cnt"];
?>
		  <li>출석생 :<?=$c_date?>명</li>
<?php
		}
		$query = $db->query("SELECT COUNT(*) as cnt from student s, checkon o WHERE o.id=s.id AND o.c_on='지각' AND o.c_date='$date'");
		
		if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$later = empty($row["cnt"]) ? "0" : $row["cnt"];
?>
		  <li>지각생 :<?=$later?>명</li> 
		  
<?php   
		}
		$query = $db->query("SELECT COUNT(*) as cnt from student s WHERE r_date='$date'");
		if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$new = empty($row["cnt"]) ? "0" : $row["cnt"];
?>
		  <li>신규등록생 :<?=$new?>명</li> 
		  </ul>
<?php
		}
		  }catch (PDOException $e) {
			 exit($e->getMessage()); 
		  } 
?>
	</section>
</div>

<section id= "main" style="overflow-y:scroll; width:100%; height:800px;"> 
<?php
		$date = date("Y-m-d"); // 오늘날짜
		$week = array("일","월","화","수","목","금","토");	 
		$week = $week[date('w', strtotime($date))]; //오늘요일
		
		try {
		  $db = new PDO("mysql:host=localhost;dbname=phpdb", "php", "1234");
		  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		  
		$query = $db->query("SELECT COUNT(*) as cnt from student s WHERE r_date='$date'");
		
		if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$new = empty($row["cnt"]) ? "0" : $row["cnt"];

?>
	<h4 style="margin:70px 0 0 820px; color:#666666;">○ 오늘 신규등록 <?=$new?> 건</h4>
	<table>	
		<tr class="table_tr">
			<th style="width:15%;">학년 </th>
			<th style="width:15%;">반 </th>
			<th style="width:15%;">이름</th>
			<th style="width:15%;">수강과목</th>
			<th style="width:15%;">핸드폰번호</th>
			<th style="width:15%;">등록일 </th>
		</tr>
<?php
		}
		$query = $db->query("select * 
							from student s, signup u
							where u.id=s.id and s.r_date='$date' group by s.id");

		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$c1=$row["c1n"];
			$c2=$row["c2n"];
			$c3=$row["c3n"];
			$c4=$row["c4n"];
			$c5=$row["c5n"];
			
			$course=array("$c1","$c2","$c3","$c4","$c5"); // 수강과목 목록나타내기 
			$c_result=array_filter($course); // 수강과목 수평나열

?>			
		<tr>
			<td><?=$row["grade"]?></th>
			<td><?=$row["class"]?></td>
			<td><?=$row["name"]?></td>
			<td>
<?php
	foreach($c_result as $val){
?>

		<?=$val?> &nbsp
<?php	
	}
?>
				</td>
			<td><?=$row["phone"]?></th>
			<td><?=$row["r_date"]?></th>
		</tr>
<?php
		}
?>
		</table>
<?php
		$query = $db->query("SELECT COUNT(*) as cnt from student s, checkon o WHERE o.id=s.id AND o.c_on='결석' AND o.c_datex='$date'");
		
		if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$c_datex = empty($row["cnt"]) ? "0" : $row["cnt"];

?>
<div>
	<h4 style="margin:70px 0 0 820px; color:#666666;">○ 오늘 결석생 <?=$c_datex?> 건 <input type="button" class=add value="새로고침" onclick="location.href='timeupdate.php'"></h4> 
	
</div>
	<table>	
		<tr class="table_tr">
			<th style="width:10%;">학년 </th>
			<th style="width:10%;">반 </th>
			<th style="width:10%;">이름</th>
			<th style="width:5%;">수강요일</th>
			<th style="width:10%;">수강시간</th>
			<th style="width:20%;">수강과목</th>
			<th style="width:10%;">담당선생님</th>
			<th style="width:30%;">결석사유</th>	
		</tr>
<?php
		}
		$query = $db->query("SELECT DISTINCT s.grade, s.class, s.name, c.c_time, c.c_start, c.c_end, c.c_name, c.professor, o.reason
							FROM student s, course c, signup_t u, checkon o
							WHERE u.grade = c.grade AND u.class = c.class AND u.course=c.course AND s.id=u.id AND o.id=s.id 
							AND c.c_time='$week' AND o.c_datex='$date' AND o.c_week='$week'");
							
							
	/*	SELECT *
		FROM student s, checkon o, signup u, signup_t t
		WHERE o.id=s.id AND u.id=s.id AND t.id=s.id AND o.c_on='결석' AND o.c_datex='2020-07-05'
		GROUP BY s.id
	*/
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			
?>			
		<tr>
			<td><?=$row["grade"]?></th>
			<td><?=$row["class"]?></th>
			<td><?=$row["name"]?></td>
			<td><?=$week?></td>
			<td><?=$row["c_start"]?>-<?=$row["c_end"]?></td>
			<td><?=$row["c_name"]?></td>
			<td><?=$row["professor"]?></td>
			<td><?=$row["reason"]?></td>
		</tr>
<?php
		}	
?>	
	</table>			
	<table>	
<?php
		$query = $db->query("SELECT COUNT(*) as cnt from student s, checkon o WHERE o.id=s.id AND o.c_on='지각' AND o.c_date='$date'");
		
		if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$later = empty($row["cnt"]) ? "0" : $row["cnt"];
?>
		<h4 style="color:#666666; margin:100px 0 0 820px;">○ 오늘 지각생 <?=$later?> 건</h4>
		 <tr class="table_tr">
			<th style="width:10%;">학년 </th>
			<th style="width:10%;">반 </th>
			<th style="width:15%;">이름</th>
			<th style="width:40%;">수강과목</th>
			<th style="width:20%;">지각시간</th>
		</tr>
<?php
		}
		$query = $db->query("SELECT * 
							FROM student s, checkon o,  signup u
							WHERE o.id=s.id AND u.id=s.id and o.c_on='지각' AND o.c_date='$date' group by s.id order by o.num");

		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$c1=$row["c1n"];
			$c2=$row["c2n"];
			$c3=$row["c3n"];
			$c4=$row["c4n"];
			$c5=$row["c5n"];
			
			$course=array("$c1","$c2","$c3","$c4","$c5"); // 수강과목 목록나타내기 
			$c_result=array_filter($course); // 수강과목 수평나열				
?>		
		 <tr>
			<td><?=$row["grade"]?></th>
			<td><?=$row["class"]?></th>
			<td><?=$row["name"]?></td>
			<td>
<?php
	foreach($c_result as $val){
?>

		<?=$val?> &nbsp
<?php	
	}
?>
			</td>
			<td><?=$row["c_time"]?></td>
		  </tr>

<?php   
			}
		  }catch (PDOException $e) {
			 exit($e->getMessage()); 
		  } 
?>


</section>
</body>
</html>
