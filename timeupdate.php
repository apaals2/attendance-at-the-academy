<?php

	$date = date("Y-m-d"); // 오늘날짜
	$week = array("일","월","화","수","목","금","토");	 
	$week = $week[date('w', strtotime($date))]; //오늘요일
				
				
	try {
        $db = new PDO("mysql:host=localhost;dbname=phpdb", "php", "1234");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$query = $db->query("SELECT *
							FROM course c, signup_t u, student s
							WHERE u.grade = c.grade AND u.class = c.class AND u.course=c.course AND s.id=u.id AND c.c_time='$week'"); 
							
							//오늘날짜에 수업있는애들
		
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) { 

				$id= $row["id"];
				$name= $row["name"];
				
				if($c_date != $date){ //오늘날짜로 결석을 넣어라
				
					$c_datex=$date;
					$c_week=$week;
					$c_on="결석";
					$db->exec("alter table checkon auto_increment =1");//auto_increment 값 초기화(글번호+1 초기화)
					$db->exec("insert into checkon values ('','$id','$name','', '$c_datex', '$c_week', '','$c_on','')");
				}
	
		}	
?>
<?php
		
		$query = $db->query("select * from checkon where c_date='$date' ");
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) { 
			$id=$row["id"];
				$db->exec("delete from checkon where c_datex='$date' and id=$id");
			}
		} catch (PDOException $e) {
        exit($e->getMessage());
		}

		header("Location:absence.php");		
		exit;
?>


