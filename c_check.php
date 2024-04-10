<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>	
		*{ margin:0;padding:0;}

		#wrap { width: 100%; margin: 0px auto;}
		
        /*header*/
		header { width:100%; height:100px; background-color:#334081; padding-top:10px;}
        #header .nav li         { 
								list-style:none; background:#e8e8e8; width:25%; height:40px; 
								text-align:center; float:left; padding:15px 0 2px 0;
								margin-top:10px; border:1px dotted black;
								}
        #header .nav li a       { font-size: 12px; color:#000; text-decoration:none;}
		#header .nav li a:hover { color:red;}
		

	

		
/*left_box*/<!--왼쪽-->
		
		/*section 1*/<!-- 왼쪽 section1 -->
			#s1 { display:inline;}
			
			/*table1 왼쪽 학생 사진 테이블*/	
				#table1 { width:65%;  text-align:center; float:left;}	
				#table1 th { background-color:#334081; width: 100px; height:45px; color:#ffffff; font-size:20px;   }
				#table1 td { border:1px solid black; border-collapse:collapse; height:25px;}


				
	/*right_box*/<!--오른쪽-->	
		
		

		/*nav side*/
			#right_side { }	
			
		/*테이블*/
			#table2    { width:100%; text-align:center; margin-left:10px;}
			#table2 th { background-color:#334081; color:#ffffff; font-size:20px;}
			#table2 td { height:45px; border:1px solid black; border-collapse:collapse;}	
			

			
		
		input[type=text]   { width:150px; height:20px; }
			
        a:link    { text-decoration:none; color:blue; }
        a:visited { text-decoration:none; color:blue; }
        a:hover   { text-decoration:none; color:red;  }
		input[type=submit] { width:70px;height:28px; margin-top:30px; }
		input[type=text]   { width:150px; height:20px; }
		input[type=password]{ width:150px; height:20px; }
		input[type=button]{ height:32px; width:75px; margin-left:85%;  }
		
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
			<input type="submit" value="관리자로그인" style="width:90px;height:28px;">
		</form>
<?php
    } else {
?>
		
        <form action="logout.php" method="post" 
				style="margin-left:80%;width:200px;height:60px; border:0; color:#ffffff; margin">
            <?=$_SESSION["userName"]?>님 로그인 
            <input type="submit" value="로그아웃">
			
        </form>
<?php        
    }
?>
    <nav class="nav">
        <ul>
			<li><a href="list.php">학생관리 </a></li>
            <li style="width:24.37%; background-color:#242e60;">
			<a href="c_check.php" style="color:#fff;">수강관리</a></li>
            <li><a href="timetable.php">시간표 </a></li>
            <li><a href="absence.php">출결관리</a></li>
        </ul>
    </nav>
</header>

<form action="c_check.php" method="get" ><!-- 검색 -->
	 <select name="s_key" style="height:25px; width:90px; margin-top:30px; margin-left:1275px;">
        <option value="" selected>검색기준</option>
        <option value="name">이름</option>
        <option value="grade">학년</option>
		<option value="class">반</option>
    </select>
    <input type="text" name="s_value">
    <input type="submit" value="검색">
</form>

<div id="wrap">
<form action="c_check_add.php" method="post"> 
<section id="left_box" style="margin-left:30px; margin-top:30px; width:100%; float:left;">
	<section id="s1"><!--학생정보테이블-->
		<table id="table1">
    <tr>
		<th style="width:7.5%;">	학생id	</th>
		<th style="width:7.5%;">	이름		</th>
		<th style="width:4.5%;">	학년		</th>
        <th style="width:3.5%;">	반		</th>
		<th style="width:12.8%;">	수강1		</th>
		<th style="width:12.8%;">	수강2		</th>
		<th style="width:12.8%;">	수강3		</th>
		<th style="width:12.8%;">	수강4		</th>
		<th style="width:12.8%;">	수강5		</th>
		<th style="width:13%;">		핸드폰번호	</th>
    </tr>
   
<?php

	$s_key   = empty($_REQUEST["s_key"  ]) ? "" : $_REQUEST["s_key"  ]; 
    $s_value = empty($_REQUEST["s_value"]) ? "" : $_REQUEST["s_value"]; 
	
   try {
      $db = new PDO("mysql:host=localhost;dbname=phpdb", "php", "1234");
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	  
	  if ($s_key && $s_value) {
             $query = $db->query("select * 
								  from student s, signup u
								  where s.id=u.id and s.$s_key like '%$s_value%' order by s.num"); //  검색
        } else {
             $query = $db->query("select * from student s, signup u where s.id=u.id order by s.num");
        }

	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
?>   	

       <tr>
		 <td><input type="checkbox" name="chk[]" value="<?=$row["id"]?>">&nbsp<?=$row["id"]?></td>
         <td><a href="student.php?id=<?=$row["id"]?>"><?=$row["name"]?></a></td>
         <td><?=$row["grade"]?></td>
         <td><?=$row["class"]?></td>
		 <td><?=$row["c1n"]?></td>
		 <td><?=$row["c2n"]?></td>
		 <td><?=$row["c3n"]?></td>
		 <td><?=$row["c4n"]?></td>
		 <td><?=$row["c5n"]?></td>
		 <td><?=$row["phone"]?></td>
      </tr>
<?php      }
      }catch (PDOException $e) {
         exit($e->getMessage()); 
      } 
?>

</table>
</section>

	
<section id="right_box" style="float:left; width:28%; height:100%; margin-right:30px;">
	<nav id="right_side" style="width:100%; height:50%;  ">
	<table id="table2"><!--수강선택-->
	<tr>
		<th>학년</th>
			<td align="center">
				 1학년<input type="radio" name="grade" value="1" <?php echo $s_value=="1" ? "checked" : "" ?>> <!--[출처]https://sir.kr/qa/338424-->
			&nbsp2학년<input type="radio" name="grade" value="2" <?php echo $s_value=="2" ? "checked" : "" ?>>
			&nbsp3학년<input type="radio" name="grade" value="3" <?php echo $s_value=="3" ? "checked" : "" ?>>
				</select>
			</td>
	</tr>	
		<tr>
	<tr>
		<tr>
		<th>수강과목</th>
			<td>
				<select name="course" multiple style="height:130px;">
					<option value="">== 수업을 선택하세요 ==</option>
					<option value="30">모바일프로그래밍</option>
					<option value="31">실무프로젝트</option>
					<option value="32">JSP프로그래밍</option>
					<option value="33">업무프로세스</option>
					<option value="34">전산영어</option>
					<option value="35">GUI템플릿</option>
				</select>
			</td>
	</tr>
	<tr>
		<th>반</th>
			<td width="" align="center">
				  A<input type="radio" name="class" value="A" <?php echo $s_value=="a" || $s_value=="A" ? "checked" : "" ?>>
			&nbsp B<input type="radio" name="class" value="B" <?php echo $s_value=="b" || $s_value=="B" ? "checked" : "" ?>>
			</td>
	</tr>

	</table>   
   
<!--수강신청버튼-->   
<?php 
    if (!empty($_SESSION["userId"])) {
?>
		<br>
  
		<input type="submit" style="height:32px; width:75px; margin-left:85%;" value="수강신청">

<?php
    }
?>  
	</nav>
</section>
</form>
</div>



</body>
</html>