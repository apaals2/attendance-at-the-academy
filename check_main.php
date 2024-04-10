<!doctype html>
<html>
<head>
<link rel= "stylesheet" type="text/css" href="css/check_main_style.css">

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
<?php include("html/check_main_form.html"); ?>


</body>	
</html>


 

