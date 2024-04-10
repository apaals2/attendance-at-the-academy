<!DOCTYPE html>
<html>
<head>

<link rel= "stylesheet" type="text/css" href="css/work.css">

</head>
<body>
<header id="header" class="clearfix">
<?php
    session_start();
    
    if (empty($_SESSION["userId"])) {
?>  
		<form action="login.php" method="post" style="margin-left:70%;width:680px;height:60px;border:0;" >
			아이디:   <input type="text" size="10" name="id">&nbsp;&nbsp;
			비밀번호: <input type="password" size="10" name="pw">
			<input type="submit" value="관리자로그인">
		</form>
<?php
    } else {
?>
        <form action="logout.php" method="post" style="margin-left:85%;width:680px;height:60px;border:0;">
            <?=$_SESSION["userName"]?>님 로그인 
            <input type="submit" value="로그아웃">
        </form>
<?php        
    }
?>	
<?php include("html/work.html"); ?>
<?php

	$s_key   = empty($_REQUEST["s_key"  ]) ? "" : $_REQUEST["s_key"  ]; 
    $s_value = empty($_REQUEST["s_value"]) ? "" : $_REQUEST["s_value"]; 
	
   try {
      $db = new PDO("mysql:host=localhost;dbname=phpdb", "php", "1234");
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	  
	  if ($s_key && $s_value) {
             $query = $db->query("select * 
								  from work_center
								  where $s_key like '%$s_value%'"); //  검색
        } else {
             $query = $db->query("select * from work_center");
        }
      
	
	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
?> 
		<tr>
			<td><?=$row["city"]?></td>		
			<td><?=$row["center"]?></td>
			<td><?=$row["tel"]?></td>	
			<td><a href="#"><?=$row["homepage"]?></td>
			<td style="font-weight:bold; font-size:14px;"><a href="work_adr.php?num=<?=$row["num"]?>"><?=$row["address"]?></td>
			
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
