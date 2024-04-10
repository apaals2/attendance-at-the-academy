<!doctype html>
<html>
<head>
    <meta charset="utf-8">
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
		
        table     { width:1500px; margin-left:auto; margin-right:auto; text-align:center;  }
        th        { background-color:#334081; width: 100px; height:45px; color:#ffffff; font-size:20px;   }
        td		  { border:1px solid black; border-collapse:collapse; height:25px;}
		
		.num 	{ width:50px;}
        .grade	{ width:70px;}   
		.class	{ width:70px;}   
		.phone	{ width:150px;}
				
		
        a:link    { text-decoration:none; color:blue; }
        a:visited { text-decoration:none; color:blue; }
        a:hover   { text-decoration:none; color:red;  }
		input[type=submit] { width:70px;height:28px; margin-top:30px; }
		input[type=text]   { width:150px; height:20px; }
		input[type=password]{ width:150px; height:20px; }
		.add	{ height:32px; width:75px; margin-left:1530px; }
		
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
            <li style="width:24.37%; background-color:#242e60;">
			<a href="list.php" style="color:#fff;">학생관리</a></li>
            <li><a href="c_check.php">수강관리 </a></li>
            <li><a href="timetable.php">시간표 </a></li>
            <li><a href="absence.php">출결관리</a></li>
        </ul>
    </nav>
</header>

<form action="list.php" method="get" ><!-- 검색 -->
	 <select name="s_key" style="height:25px; width:90px; margin-top:30px; margin-left:1275px;">
        <option value="" selected>검색기준</option>
        <option value="name">이름</option>
        <option value="grade">학년</option>
		<option value="class">반</option>
    </select>
    <input type="text" name="s_value">
    <input type="submit" value="검색">
</form>



<table>
    <tr>
        <th class="num"    >	번호		</th>
		<th class="id"     >	고유번호	</th>
		<th class="name"   >	이름		</th> 
        <th class="grade"  >	학년		</th>
        <th class="class"  >	반		</th>
		<th class="phone"  >	핸드폰번호	</th>
		<th class="email"  >	이메일		</th>
		<th class="r_date" >	등록일		</th>
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
         <td><?=$row["phone"]?></td>
         <td><?=$row["email"]?></td>
         <td><?=$row["r_date"]?></td>
      </tr>
<?php      }
      }catch (PDOException $e) {
         exit($e->getMessage()); 
      } 
?>

</table>

<?php
    if (!empty($_SESSION["userId"])) {
?>
		<br>
        <input type="button" class=add value="신규등록"
								onclick="window.open('member_join_form.php', 'popup', 'width=480, height=500, top=200, left=400')">
<?php
    }
?>  

</body>
</html>