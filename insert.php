<?php
    $st_name = $_REQUEST["st_name"];	
	$title = $_REQUEST["title"];
	$class = $_REQUEST['class'];
	$phone = $_REQUEST["phone"];
	$email = $_REQUEST["email"];
    
    if(st_name && $title && $class && $phone && $email){
    
        try {
                $db = new PDO("mysql:host=localhost;dbname=phpdb","php", "1234");
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
                $regtime = date("Y-m-d H:i:s");
				$db->exec("alter table student auto_increment =1");//auto_increment 값 초기화(글번호+1 초기화)
                // [출처] [PHP] 게시판 만들기 #13 Auto_increment초기화|작성자 S Writer      
				
                $db->exec("insert into student (st_name, title, class, phone, email)
                                    values('$st_name', '$title', '$class', '$phone', '$email')");
									
				$db->exec("insert into a_time (regtime)
                                    values('$regtime')");
                      
                } catch (PDOException $e) {
                      exit($e->getMessage());
                }

                header("Location:list.php");
                  
                exit;
    } 
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>

<script>
    alert('모든 항목이 빈칸 없이 입력되어야 합니다.');
    history.back();
</script>
</body>
</html>
