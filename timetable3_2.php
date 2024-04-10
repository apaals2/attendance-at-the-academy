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
					#header .nav li a       { font-size: 12px; color:#000; text-decoration:none;}
					#header .nav li a:hover { color:red;}
							
			/*sidemenu*/<!--sidemenu-->		
					div {}
					#sidemenu {margin-left:20px; margin-top:50px; float:left; border:5px solid #dedede; width:230px; height:435px; }
					#sidemenu li 	{ list-style: none; color:#000;}
					#sidemenu img	{ width:15px;}
					
					#sidemenu .menu { font-weight:bold; margin-top:10px; line-height:40px; margin-left:20px; margin-bottom:10px;}
					#sidemenu .submenu{ font-size:13px; line-height : 35px;}
					#sidemenu .submenu a { text-decoration:none; color:#000; }
					#sidemenu .submenu .submenu_1{ margin-left:20px; }
					
			/*main*/<!--main-->		
				section	{}
				#main	{margin-top:100px;}
				#main h3 {color: #334081; margin-left:310px; }
				
			/*main table*/<!--main_table-->	
				#main_table	{}
				#main_table table, th, td { border:1px solid #bcbcbc; border-collapse:collapse;  text-align:center;}
				#main_table td { height:75px;}
				#main_table th { height:50px;}
				#main_table table{ margin-left:230px; width:1000px; font-size:13px;}

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
	<h3>시간표 설정 : 3학년 B반</h3> 
	<section id="main_table"><!--main table-->
		<form style= "margin-bottom:10px; margin-left:1070px; height:25px; width:200px;">
			<select onchange="if(this.value) location.href=(this.value);">				
				<option value="">== 반을 선택하세요 ==</option>
				<option value="timetable3_1.php">A</option>
				<option value="timetable3_2.php">B</option>
			</select>
		</form>
	<table style="margin-left:300px;">	
		  <tr style="background-color:#dedede;">
			<th style="width:13%; font-weight:bold; font-size:15px;" colspan="2" >수업 </th>
			<th style="width:15%; font-weight:bold; font-size:15px;">월</th>
			<th style="width:15%; font-weight:bold; font-size:15px;">화</th>
			<th style="width:15%; font-weight:bold; font-size:15px;">수</th>
			<th style="width:15%; font-weight:bold; font-size:15px;">목</th>
			<th style="width:15%; font-weight:bold; font-size:15px;">금</th>
			
		  </tr>
<?php
	   try {
		  $db = new PDO("mysql:host=localhost;dbname=phpdb", "php", "1234");
		  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$query = $db->query("select * 
							from c_date
							where grade like '3%' and class like '%B%'  ");
		while($row = $query->fetch(PDO::FETCH_ASSOC)) {
?>

		<tr>
			<td></td>
			<td style="font-weight:bold; font-size:15px;"><?=$row["c_time"]?></td>
			<td><?=$row["c1n"]?></td>
			<td><?=$row["c2n"]?></td>
			<td><?=$row["c3n"]?></td>
			<td><?=$row["c4n"]?></td>
			<td><?=$row["c5n"]?></td>		
		 </tr>
		  
 
<?php    
			}	
		} catch (PDOException $e) {
			exit($e->getMessage()); 
		 } 	
?>





	</table>
	</section>

</section>
</body>

</html>
