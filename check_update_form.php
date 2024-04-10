<?php

	$id = $_REQUEST["id"];
	$c_datex = $_REQUEST["c_datex"];
	$name = "";
	$reason = "";

	
		try {
			$db = new PDO("mysql:host=localhost;dbname=phpdb", "php", "1234");
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$query = $db->query("select * from checkon where c_datex like '%$c_datex%' and id=$id");
			
			if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
				
				$name		= $row["name"];
				$c_datex 	= $row["c_datex"];
				$reason  	= $row["reason"];

				}
				
			}catch (PDOException $e) {
			 exit($e->getMessage());
			} 
			
?>	
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<style>
		table{ width:650px; height:350px;}
		h2	 { text-align:center;}
        th   { background-color:#334081; color:#fff; width:20%; font-size:15px;}
        td   { border:1px solid black; border-collapse:collapse;}
		section { line-height:50px; margin-left:1px; background-color:#334081; color:#fff; 
				font-size:20px; font-weight:bold; text-align:center; width:647px; height:50px; }
		
		input[type=submit] { width:70px;height:28px; margin-top:20px;}
		input[type=button] { width:70px;height:28px; margin-top:20px;}
		
		
    </style>
</head>
<body>
<section>출결상황입력</section>
<form action="check_update.php?id=<?=$id?>" method="post">
	 <table>
		<tr style="height:50px;">
			<th>이름</th>
				<td style="width:35%; font-size:12px;" name="name"><?=$name?></td>
				
		</tr>	
		<tr style="height:50px;">
			<th>결석일</th>
				<td>
					<input type='date' name="c_datex" style="float:left;" value="<?=$c_datex?>"><!-- [출처] : https://www.everdevel.com/HTML/form-input-date-tag/ -->
				</td>		
		</tr>
		<tr>
			<th>결석사유</th>
				<td> <textarea name="reason" rows=10 cols=50 ><?=$reason?></textarea></td>
		</tr>	
	</table>

	<div align="center">
		<input type="submit" value="수정">
		<input type="button" value="취소" onclick="window.close()">
	</div>
</form>
</body>
</html>