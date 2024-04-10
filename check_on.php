<?php
    $id = $_REQUEST["id"];	
	$c_date = date("Y-m-d"); //오늘날짜
	$c_week = array("일","월","화","수","목","금","토");	 
	//[출처]https://m.blog.naver.com/PostView.nhn?blogId=mtjeaids&logNo=70093547646&proxyReferer=https:%2F%2Fwww.google.com%2F
	$c_week = $c_week[date('w', strtotime($c_date))]; // 오늘요일
	$c_time = date("H:i:s"); //넘어온 시간값 
	
        try {
                $db = new PDO("mysql:host=localhost;dbname=phpdb","php", "1234");
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$query = $db->query("select * from course c, signup_t u, student s
									where  u.grade = c.grade and  u.class = c.class and u.course=c.course and s.id=u.id
									and u.id='$id' and c.c_time='$c_week'"); // 받아온 ID가 듣는 수업중 오늘날짜
				if ($row = $query->fetch(PDO::FETCH_ASSOC)) {		
					if($id == $row["id"]){
						
						//변수정의
						//date("w")은 0(일요일)에서 6(토요일)
						$name = $row["name"]; //이름
						$c_start = $row["c_start"]; //수업시간
						$class_date = $row["c_time"]; //수업요일
						
						$c_later  = date("H:i:s" , strtotime($c_start."+1 hours")); // 수업시작시간보다 한시간 후 
						$c_end  = date("H:i:s" , strtotime($c_start."+2 hours 40minutes")); // 수업시간보다 두시간 후
						//[출처] https://m.blog.naver.com/PostView.nhn?blogId=sapagosu&logNo=220881133763&proxyReferer=https:%2F%2Fwww.google.com%2F

						if($c_week == $class_date){// 오늘날짜가 수업날짜이면
						
							if($c_time >= $c_end){// 수업시작시간보다 2시간 40분 후 이상이라면

?>			
							<script>
								alert('결석처리되었습니다 출석을 할 수 없습니다.');
								history.back();
							</script>
<?php						
							}else if($c_time >= $c_later){//수업시간보다 1시간 후 이상이라면
							
								$c_on = "지각";
								$db->exec("alter table checkon auto_increment =1");
								$db->exec("insert into checkon values ('','$id','$name','$c_date', '', '$c_week', '$c_time','$c_on','')");
								
							
?>			
							<script>
								alert('지각처리되었습니다.');
								history.back();
							</script>
<?php
							}else{
								
								$c_on = "출석";
								$db->exec("alter table checkon auto_increment =1");//auto_increment 값 초기화(글번호+1 초기화)
								// [출처] [PHP] 게시판 만들기 #13 Auto_increment초기화|작성자 S Writer      
								$db->exec("insert into checkon values ('','$id','$name','$c_date', '', '$c_week', '$c_time','$c_on','')");
								
?>			
							<script>
								alert('출석완료되었습니다.');
								history.back();
							</script>
<?php
							}
							
						}
						exit;
						
					}
				}
			} catch (PDOException $e) {
					exit($e->getMessage());
				} 
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>

<script>
    alert('출석체크가 안되었습니다. 번호와 출석일을 확인해주세요');
    history.back();
</script>
</body>
</html>