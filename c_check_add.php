<!doctype html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<?php
    /* test data
	$grade = "3";
	$class = "A";
	
	$course = "34"; 
    $check = [106, 107, 108];
    */

	$grade = $_REQUEST["grade"];
	$class = $_REQUEST["class"];
	
	$course = $_REQUEST["course"]; 
    
	if($course == "30"){
		$course_name="모바일프로그래밍";
	}else if($course == "31"){
		$course_name="실무프로젝트";
	}else if($course == "32"){
		$course_name="JSP프로그래밍";
	}else if($course == "33"){
		$course_name="업무프로세스";
	}else if($course == "34"){
		$course_name="전산영어";
	}else if($course == "35"){
		$course_name="GUI템플릿";
	}
	
	$check = $_REQUEST['chk']; //  넘어온 값들을 $check에 저장 << id 값 들어있음

	//for ($i=0; $i<count($id); $i++) 
		//print $id[$i]." "; //[출처] http://mm.sookmyung.ac.kr/~sblim/lec/web-int/web17/web17-pra06-sup.htm
     
	try {
        $db = new PDO("mysql:host=localhost;dbname=phpdb", "php", "1234");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        if (!($grade && $class && $course)) {
?>
            <script>
                alert('빠짐 없이 체크해주세요');
                history.back();
            </script>	
<?php       
        }
		
		for($i=0;$i<count($check);$i++){ 
			$id=$check[$i]; // 받아온 check 값을  id변수에 넣음
			
			$query = $db->query("select * from signup where id='$id'"); // id=10i인 학생 
					
			if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
					
            
					for($j=1;$j<=5;$j++){ 
					$ci="c$j";
					$cin="c$j"."n";
						if($row["$ci"] !== $course){ // ci값에 가져온 course 값이 없으면
							if($row["$ci"] == null){// ci값이 null인곳에 넣어라
								$db->exec("update signup set $ci='$course', $cin='$course_name' where id='$id'");
								break;
							}				
						}
					}
                    
			}
			$db->exec("alter table signup_t auto_increment =1");
            $db->exec("insert into signup_t values ('', '$id', '$grade', '$class', '$course', '$course_name')");
		}
		
			header("Location:c_check.php");
			exit;
    } catch (PDOException $e) {
        exit($e->getMessage());
    } 
?>            