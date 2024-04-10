<!doctype html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>

<?php 
	$id= $_REQUEST["id"];
    $c_datex= $_REQUEST["c_datex"];
    $reason= $_REQUEST["reason"];
    
    try {
        $db = new PDO("mysql:host=localhost;dbname=phpdb", "php", "1234");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$query = $db->query("select * from student where id=$id");
		if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			if (!($c_datex && $reason)) {
?>
            <script>
                alert('결석일과 결석사유를 입력해주세요.');
                history.back();
            </script>
<?php            
			}else {
				
				$name = $row["name"];
				$c_week = array("일","월","화","수","목","금","토");	 
				//[출처]https://m.blog.naver.com/PostView.nhn?blogId=mtjeaids&logNo=70093547646&proxyReferer=https:%2F%2Fwww.google.com%2F
				$c_week = $c_week[date('w', strtotime($c_datex))];
				$c_on = "결석";
				
				
				$db->exec("alter table checkon auto_increment =1");//auto_increment 값 초기화(글번호+1 초기화)
					// [출처] [PHP] 게시판 만들기 #13 Auto_increment초기화|작성자 S Writer
					
					
				$db->exec("insert into checkon values ('','$id','$name', '','$c_datex', '$c_week', '', '$c_on', '$reason')");
						   
		
	?>            
				<script>
					alert('입력완료되었습니다.');
					opener.parent.location.reload(); //[출처]
					window.close();
				</script>
<?php            
				 }
		}
    } catch (PDOException $e) {
        exit($e->getMessage());
    } 
?>

</body>
</html>