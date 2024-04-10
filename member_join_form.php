<!doctype html>
<html>
<head>
    <meta charset="utf-8">
	<style>
		*	 { }
		h2	 { text-align:center;}
        table{ text-align:center; width:600px; height:500px; margin:10px; 0 0 10px;}
        th   { background-color:#334081; color:#fff;}
        td   { border:1px solid black; border-collapse:collapse; height:25px;}
		
		input[type=text]   { width:250px; height:20px; }
		input[type=submit] { width:70px;height:28px; margin-top:10px; margin-right:15px; float:right;}
		
		
    </style>
</head>
<body>
<h2>신규 학생 등록</h2>
<form action="member_join.php" method="post"> 
 <table>
    <tr>
		<th>이름</th>
			<td><input type="text" name="name" maxlength="20" style="text-align:center;"></td>
	</tr>
	<tr>
		<th>성별</th>
			<td width="60%" align="center">
				  남<input type="radio" name="gender" value="1" > 
				  여<input type="radio" name="gender" value="2" > 
			</td>
	</tr>
	<tr>
		<th>학년</th>
			<td>
				<select name="grade" style="height:25px; width:200px;">
					<option value="">== 학년을 선택하세요 ==</option>
					<option value="1">1학년</option>
					<option value="2">2학년</option>
					<option value="3">3학년</option>
				</select>
			</td>
	</tr>
	<tr>
		<th>반</th>
			<td width="60%" align="center">
				  A<input type="radio" name="class" value="A">
				  B<input type="radio" name="class" value="B">
			</td>
	</tr>
	<tr>
		<th>핸드폰번호</th>
			<td><input type="text" name="phone" maxlength="60" style="text-align:center;"
						placeholder=" 예:010-0000-0000 "></td>
	</tr>
	<tr>
		<th>이메일</th>
			<td><input type="text" name="email" maxlength="60" style="text-align:center;"
						placeholder=" 예:abcde@g.shingu.ac.kr "></td>
	</tr>

	<tr>
		<th>주소</th>
			<td><input type="text" name="address" maxlength="60" style="text-align:center;"
						placeholder=" 주소를 입력해주세요 "></td>
	</tr>	

</table>
    <input type="submit" value="등록">
</form>

</body>
</html>