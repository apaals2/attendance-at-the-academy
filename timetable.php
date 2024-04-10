<!DOCTYPE html>
<html>
<head>
<style>
		* { margin: 0; padding: 0;}

		/*header*/
				header { width:100%; height:100px; background-color:#334081; padding-top:10px;}
				#header .nav li         { 
								list-style:none; background:#e8e8e8; width:25%; height:40px; 
								text-align:center; float:left; padding:15px 0 2px 0;
								margin-top:10px; border:1px dotted black;
								}
				#header .nav li a       { font-size: 12px; color:#000; text-decoration:none; }
				#header .nav li a:hover { color:red;}

		/*sidemenu*/<!--sidemenu-->		
				div {}
				#sidemenu {margin-left:20px; margin-top:50px; float:left; border:5px solid #dedede; width:230px; height:435px;}
				#sidemenu li 	{ list-style: none; color:#000;}
				#sidemenu img	{ width:15px;}
				
				#sidemenu .menu { font-weight:bold; margin-top:10px; line-height:40px; margin-left:20px; margin-bottom:10px;}
				#sidemenu .submenu{ font-size:13px; line-height : 35px;}
				#sidemenu .submenu a { text-decoration:none; color:#000; }
				#sidemenu .submenu .submenu_1{ margin-left:20px; }
		
		/*main*/<!--main-->		
				section	{}
				#main	{margin-top:55px;}
				#main h3 {color: #334081; margin-left:310px;}
		/*main table*/<!--main_table-->	
				#main_table	{}
				#main_table .table_tr {background-color:#dedede;}
				#main_table table, th, td { border:1px solid #bcbcbc; border-collapse:collapse; text-align:center;}
				#main_table table { margin-left:50px; width:1200px; font-size:13px; margin-top:20px;}
				#main_table th { height:35px; font-weight:bold; font-size:15px;}
				#main_table td { height:40px; }				

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
            <li style="width:24.37%; background-color:#242e60;"><a href="timetable.php" style="color:#fff;">시간표 </a></li>
            <li><a href="absence.php">출결관리</a></li>
        </ul>
    </nav>
</header>
<div id="sidemenu"> <!--sidemenu-->
	<ul>
		<li class="menu"><img src="img/3.png">&nbsp;시간표</a></li>
		<ul class="submenu"><!--side_submenu-->
			<li class="submenu_1"><a href="timetable.php"><img src="img/2.jpg">&nbsp;전체 시간표 </a></li>
			<li class="submenu_1"><a href="timetable3_1.php"><img src="img/2.jpg">&nbsp;3학년 시간표</a></li>
		</ul>  
	</ul>
</div>
<section id="main"><!--main-->
	<h3>시간표 설정 : 전체시간표</h3>
	<section id="main_table" style="overflow-y:scroll; height:900px; " ><!--main table scroll-->
	<table>	<!--월요일-->
		  <tr class="table_tr">
		  
			<th style="width:5%;" colspan="2" >월요일 </th>
			<th style="width:5%;"  >시간 </th>
			<th style="width:20%;">3-A</th>
			<th style="width:20%;">3-B</th>
		  </tr>
<?php
	   try {
		  $db = new PDO("mysql:host=localhost;dbname=phpdb", "php", "1234");
		  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$query = $db->query("select * 
							from c_adate
							where t_time like '월%'
							");
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
?>
		<tr>
			<td style="font-weight:bold; font-size:14px;"colspan="3"><?=$row["c_time"]?></td>		
			<td><?=$row["c1n"]?></td>
			<td><?=$row["c2n"]?></td>	
		 </tr>		  
 
<?php    
			}	
		} catch (PDOException $e) {
			exit($e->getMessage()); 
		 } 	
?>


	<table>	<!--화-->
		  <tr class="table_tr">
			<th style="width:5%;" colspan="2" >화요일 </th>
			<th style="width:5%;"  >시간 </th>
			<th style="width:20%;">3-A</th>
			<th style="width:20%;">3-B</th>
		  </tr>
<?php
	   try {
		  $db = new PDO("mysql:host=localhost;dbname=phpdb", "php", "1234");
		  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$query = $db->query("select * 
							from c_adate
							where t_time like '화%'
							");
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
?>
		<tr>
			<td style="font-weight:bold; font-size:14px;" colspan="3"><?=$row["c_time"]?></td>		
			<td><?=$row["c1n"]?></td>
			<td><?=$row["c2n"]?></td>	
		 </tr>		  
 
<?php    
			}	
		} catch (PDOException $e) {
			exit($e->getMessage()); 
		 } 	
?>

	<table>	<!--수요일-->
		  <tr class="table_tr">
			<th style="width:5%;" colspan="2" >수요일 </th>
			<th style="width:5%;"  >시간 </th>
			<th style="width:20%;">3-A</th>
			<th style="width:20%;">3-B</th>
		  </tr>
<?php
	   try {
		  $db = new PDO("mysql:host=localhost;dbname=phpdb", "php", "1234");
		  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$query = $db->query("select * 
							from c_adate
							where t_time like '수%'
							");
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
?>
		<tr>
			<td style="font-weight:bold; font-size:14px;" colspan="3"><?=$row["c_time"]?></td>		
			<td><?=$row["c1n"]?></td>
			<td><?=$row["c2n"]?></td>	
		 </tr>		  
 
<?php    
			}	
		} catch (PDOException $e) {
			exit($e->getMessage()); 
		 } 	
?>
	<table>	<!--목요일-->
		  <tr class="table_tr">
			<th style="width:5%;" colspan="2" >목요일 </th>
			<th style="width:5%;"  >시간 </th>
			<th style="width:20%;">3-A</th>
			<th style="width:20%;">3-B</th>
		  </tr>
<?php
	   try {
		  $db = new PDO("mysql:host=localhost;dbname=phpdb", "php", "1234");
		  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$query = $db->query("select * 
							from c_adate
							where t_time like '목%'
							");
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
?>
		<tr>
			<td style="font-weight:bold; font-size:14px;" colspan="3"><?=$row["c_time"]?></td>		
			<td><?=$row["c1n"]?></td>
			<td><?=$row["c2n"]?></td>	
		 </tr>		  
 
<?php    
			}	
		} catch (PDOException $e) {
			exit($e->getMessage()); 
		 } 	
?>
	<table>	<!--금요일-->
		  <tr class="table_tr">
			<th style="width:5%;" colspan="2" >금요일 </th>
			<th style="width:5%;"  >시간 </th>
			<th style="width:20%;">3-A</th>
			<th style="width:20%;">3-B</th>
		  </tr>
<?php
	   try {
		  $db = new PDO("mysql:host=localhost;dbname=phpdb", "php", "1234");
		  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$query = $db->query("select * 
							from c_adate
							where t_time like '금%'
							");
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
?>
		<tr>
			<td style="font-weight:bold; font-size:14px;" colspan="3"><?=$row["c_time"]?></td>		
			<td><?=$row["c1n"]?></td>
			<td><?=$row["c2n"]?></td>	
		 </tr>		  
 
<?php    
			}	
		} catch (PDOException $e) {
			exit($e->getMessage()); 
		 } 	
?>



	</section>
</section>
</body>
</html>
