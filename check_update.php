<!doctype html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>

<?php 

	$id 	 = $_REQUEST["id"];
    $c_datex = $_REQUEST["c_datex"];
	$reason  = $_REQUEST["reason"];
    
    try {
        $db = new PDO("mysql:host=localhost;dbname=phpdb", "php", "1234");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
			if (!($c_datex && $reason)) {
?>
            <script>
                alert('결석일과 결석사유를 입력해주세요.');
                history.back();
            </script>
<?php            
			}else {
				
				$c_week = array("일","월","화","수","목","금","토");	 
				//[출처]https://m.blog.naver.com/PostView.nhn?blogId=mtjeaids&logNo=70093547646&proxyReferer=https:%2F%2Fwww.google.com%2F
				$c_week = $c_week[date('w', strtotime($c_datex))];
				
				$db->exec("update checkon set c_datex='$c_datex', c_week='$c_week', reason='$reason' where id=$id and c_datex=$c_datex");		   
		
	?>            
				<script>
					alert('수정이 완료되었습니다.');
					opener.parent.location.reload(); //[출처]
					window.close();
				</script>
<?php            
				 }
    } catch (PDOException $e) {
        exit($e->getMessage());
    } 
?>

</body>
</html>