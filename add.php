<?php
    $id = $_REQUEST["id"];


    try {
        $db = new PDO("mysql:host=localhost;dbname=phpdb", "php", "1234");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
        $query = $db->query("select * 
							from student s, course c, signup u
							where s.class = c.class and s.grade = c.grade and s.id=u.id and s.id=$id");
        if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			
			$name= $row["name"];
			$r_date= $row["r_date"];
			$id= $row["id"];
			$grade= $row["grade"];
			$class= $row["class"];
			$gender=$row["gender"];
			$email= $row["email"];
			$c_name= $row["c_name"];
			$course= $row["course"];
			$phone= $row["phone"];
			$address= $row["address"];

			$action  = "update.php?id=$id";
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
		*{ margin:0;padding:0;}
		#wrap { width: 100%; margin: 0px auto;}
		#wrap main {margin-left:90px; margin-right:20px;}
		
		a:link    { text-decoration:none; color:blue; }
		a:visited { text-decoration:none; color:blue; }
		a:hover   { text-decoration:none; color:red;  }
		
		
    /*header*/
		header { width:100%; height:100px; background-color:#334081; padding-top:10px;}
        #header .nav li         { 
								list-style:none; background:#e8e8e8; width:25%; height:40px; 
								text-align:center; float:left; padding:15px 0 2px 0;
								margin-top:10px; border:1px dotted black;
								}
        #header .nav li a       { font-size: 12px; color:#000; }
		#header .nav li a:hover { color:red;}
		  
		th { background-color:#334081; color:#fff;}
        td { border:1px solid black; border-collapse:collapse; }
		
	/*left_box*/<!--왼쪽-->
		
		/*section 1*/<!-- 왼쪽 section1 -->
			#s1 { display:inline;}
			
			/*table1 왼쪽 학생 사진 테이블*/	
				#table1 { width:250px; text-align:center;float:left;}
				#table1 .photo { height:45px; font-size:20px; }
				#table1 td { height:283px;}
				#table1 img { height:235px;}	
				
			/*table1_1 왼쪽 학생 정보*/	
				#table1_1 	  { width:850px; text-align:center;}	
				#table1_1 td  { height:30px; width:600px;}
				#table1_1 th  { font-size:15px; }
				
			/*학생정보 수정 삭제 버튼*/
				#btn1 { margin-left:953px;}
				.s1_btn { height:35px; width:70px;}
				
		/*section 2*/<!-- 왼쪽 section2 -->
			#s2 { display:inline;}
			
			/*table2 왼쪽 밑 메뉴 */	
				#table2 	 { margin-top:20px; width:1100px; text-align:center; font-size:12px;}
				#table2  th  { width:100px;height:40px; color:#fff;}
				#table2  th  a{color:#fff;}
				#table2  th  a:hover{color:yellow;}
				
			/*학생정보테이블 쓰기 수정 삭제 버튼*/
				#btn2 { margin-left:993px;}
				.s2_btn { margin-top : 5px; height:25px; width:50px; }
					
			/*table3 왼쪽 밑 내용*/	
				#table3 	 { margin-top:5px; width:1100px; text-align:center; font-size:12px;}	
				#table3  th  { width:100px;height:35px; }
				#table3  td  { height:25px; }
				
	/*right_box*/<!--오른쪽-->	
		
		/*nav side*/
			#right_side { }	
			
		/*table4 오른쪽 학생 목록 테이블*/
			#table4    { width:450px; text-align:center;}
			#table4 th { width:100px; height:45px; font-size:20px; }
			#table4 td { height:25px;}	
			
			input[type=text]   { width:150px; height:20px; }
			



    </style>
</head>
<body>
<header id="header" class="clearfix">
<?php
    session_start();
    
    if (empty($_SESSION["userId"])) {
		
        exit;
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
            <input type="submit" style="width:70px;height:24px; margin-top:30px;" value="로그아웃">
        </form>
<?php        
    }
?>
    <nav class="nav">
        <ul>
            <li style="width:24.37%; background-color:#242e60;">
			<a href="list.php" style="color:#fff;">학생관리</a></li>
            <li><a href="c_check.php">수강관리 </a></li>
            <li><a href="timetable.php">시간표 </a></li>
            <li><a href="absence.php">출결관리</a></li>
        </ul>
    </nav>
</header>
	<form action="list.php" method="get" ><!--검색-->
		 <select name="s_key" style="height:25px; width:90px; margin-left:1275px;">
			<option value="" selected>검색기준</option>
			<option value="name">이름</option>
			<option value="grade">학년</option>
			<option value="class">반이름</option>
		</select>
		<input type="text" name="s_value">
		<input type="submit" style="width:70px;height:24px; margin-top:20px;" value="검색">
	</form>
<div id="wrap">
<section id="left_box" style="margin-left:30px; margin-top:30px; width:68%;background-color:#FFFF00; float:left;">
	<section id="s1"><!--학생정보테이블-->
		<table id="table1">
			<tr><th class="photo">사진</th></tr>
			<tr><td><img src="img/1.png" alt="학생사진" ></td></tr>	
		</table>
		<form method="post" action="<?=$action?>"><!--학생정보수정-->
		<table id="table1_1">
			<tr><th>이름</th>
				<td><input type="text" name="name" maxlength="20" style="text-align:center;" value="<?=$name?>"></td>
			</tr>
			<tr><th>등록일</th>
				<td><input type="text" name="r_date" maxlength="20" style="text-align:center;" value="<?=$r_date?>"></td>
			</tr>
			<tr><th>고유번호</th>
				<td><input type="text" name="id" maxlength="20" style="text-align:center;" value="<?=$id?>"></td>
			</tr>
			<tr><th>학년</th>
			<td align="center">
				 1학년<input type="radio" name="grade" value="1" <?php echo $row["grade"]=="1" ? "checked" : "" ?>>
			&nbsp2학년<input type="radio" name="grade" value="2" <?php echo $row["grade"]=="2" ? "checked" : "" ?>>
			&nbsp3학년<input type="radio" name="grade" value="3" <?php echo $row["grade"]=="3" ? "checked" : "" ?>>
				</select>
			</td>
			</tr>
			<tr><th>반</th>
				<td width="60%" align="center">
				  A<input type="radio" name="class" value="A" <?php echo $row["class"]=="A" ? "checked" : "" ?>>
				  B<input type="radio" name="class" value="B" <?php echo $row["class"]=="B" ? "checked" : "" ?>>
			</td>
			</tr>
			<tr><th>성별</th>
				<td width="60%" align="center">
					남<input type="radio" name="gender" value="1" <?php echo $row["gender"]=="1" ? "checked" : "" ?>>
					여<input type="radio" name="gender" value="2" <?php echo $row["gender"]=="2" ? "checked" : "" ?>> 
				</td>
			</tr>
			<tr><th>이메일</th>
				<td><input type="text" name="email" maxlength="60" style="text-align:center;"
						placeholder=" 예:abcde@g.shingu.ac.kr " value="<?=$email?>"></td>
			</tr>		
			<tr><th>수강과목</th>
				<td>
					<select name="course" style="height:25px; width:200px;">
						<option value="">== 수업을 선택하세요 ==</option>
						<option value="10">모바일프로그래밍</option>
						<option value="11">실무프로젝트</option>
						<option value="12">JSP프로그래밍</option>
						<option value="13">업무프로세스</option>
						<option value="14">전산영어</option>
						<option value="15">GUI템플릿</option>
					</select>
				</td>
			</tr>
			<tr><th>핸드폰번호	</th>
				<td><input type="text" name="phone" maxlength="60" style="text-align:center;"
						placeholder=" 예:010-0000-0000 " value="<?=$phone?>"></td>
			</tr>	
			<tr><th>주소</th>
				<td><input type="text" name="address" maxlength="60" style="text-align:center;"
						placeholder=" 주소를 입력해주세요 " value="<?=$address?>"></td>
			</tr>		
<?php       	}
			}catch (PDOException $e) {
				exit($e->getMessage());
			} 
?>
		</table>
		
	</section>
	<section id="btn1"><!--학생정보수정삭제버튼-->
<?php
    if (!empty($_SESSION["userId"])) {
?>
		<input type="submit" style="height:35px; width:70px;" value="저장">
		<input type="button" class=s1_btn value="취소" onclick="history.back()">
<?php
    }
?>
	</section>
	</form>
	<section id="s2"><!--학생 출결,성적,시간표,수납테이블-->	
		<table id="table2">
			<tr>
				<th><a href="student.php?id=<?=$row["id"]?>">시간표</a></th>
				<th><a href="#">납입현황</a></th>
				<th><a href="s_check.php?id=<?=$row["id"]?>">출석현황</a></th>
				<th><a href="s_grade.php?id=<?=$row["id"]?>">성적</a></th>
			</tr>	
		</table>
	</section>
	<section id="btn2"><!--학생정보테이블쓰기삭제버튼-->
<?php
    if (!empty($_SESSION["userId"])) {
?>
		<input type="button" class=s2_btn value="쓰기" onclick="location.href='add.php?id=<?=$id?>'">
		<input type="button" class=s2_btn value="삭제" onclick="location.href='delete.php?id=<?=$id?>'">
<?php
    }
?>
	</section>
	<section id="s3"><!--학생 출결,성적,시간표,수납테이블 정보-->
		<table id="table3">
			<tr>
				<th>번호</th>
				<th>학년</th>
				<th>반</th>
				<th>수강과목</th>
				<th>교수</th>
				<th>수강시간</th>
				<th>요일</th> 	
			</tr>
<?php
	 
	   try {
		  $db = new PDO("mysql:host=localhost;dbname=phpdb", "php", "1234");
		  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		for($i=1;$i<=5;$i++){
				$ci="c$i"; // 충격적 이게 된다니... 감격스럽다.......
			$query = $db->query("select * 
								from student s, course c, signup u
								where s.class = c.class and s.grade = c.grade and u.id=s.id and u.$ci=c.course and s.id=$id");
								
			$cnt=1; // 번호숫자증가
			if ($row = $query->fetch(PDO::FETCH_ASSOC)) {			
?>
			<tr>	 
				<td><?=$cnt?></td>
				<td><?=$row["grade"]?></td>
				<td><?=$row["class"]?></td>
				<td><?=$row["c_name"]?></td>
				<td><?=$row["professor"]?></td>
				<td><?=$row["c_start"]?>-<?=$row["c_end"]?></td>
				<td><?=$row["c_time"]?></td>
			  </tr>
<?php   
				$cnt++; 								
				}
			}
		  }catch (PDOException $e) {
			 exit($e->getMessage()); 
		  } 
	?>
	</table>
	</section>
</section>

<section id="right_box" style="float:right; width:28%; height:100%; margin-top:30px; margin-right:30px; background-color:#FF0000;">
	<nav id="right_side" style="overflow-y:scroll; width:100%; height:600px; background-color:#FFFF00; ">
	<table id="table4"><!--학생목록-->
		<tr>
			<th>번호</th>
			<th>고유번호</th>
			<th>이름</th> 
			<th>학년</th>
			<th>반</th>
		</tr>
   
<?php

	$s_key   = empty($_REQUEST["s_key"  ]) ? "" : $_REQUEST["s_key"  ]; 
    $s_value = empty($_REQUEST["s_value"]) ? "" : $_REQUEST["s_value"]; 
	
   try {
      $db = new PDO("mysql:host=localhost;dbname=phpdb", "php", "1234");
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	  
	  if ($s_key && $s_value) {
             $query = $db->query("select * 
								  from student
								  where $s_key like '%$s_value%' order by num"); //  검색
        } else {
             $query = $db->query("select * from student order by num");
        }
      
	
	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
?>   
		   <tr>
			 <td><?=$row["num"]?></td>
			 <td><?=$row["id"]?></td>
			 <td><a href="student.php?id=<?=$row["id"]?>"><?=$row["name"]?></a></td>
			 <td><?=$row["grade"]?></td>
			 <td><?=$row["class"]?></td>
		  </tr>
<?php      }
      }catch (PDOException $e) {
         exit($e->getMessage()); 
      } 
?>
	</table>
	</nav>
</section>

</div>

</body>
</html>