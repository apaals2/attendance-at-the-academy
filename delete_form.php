<?php $id = $_REQUEST["id"]; ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<style>
		*	 { }
		h2	 { text-align:center; margin-top:50px;}
	
		input[type=submit] { width:70px;height:28px; margin-top:10px;}
		input[type=button] { width:70px;height:28px; margin-top:10px;}
		
		
    </style>
</head>
<body>
<h2>삭제하시겠습니까?</h2>
<form action="delete.php?id=<?=$id?>" method="post"> 
<div align="center">
    <input type="submit" value="네">
	<input type="button" value="아니요" onclick="window.close()">
</div>
</form>

</body>
</html>