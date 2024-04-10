<!doctype html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>

<?php 
    $name= $_REQUEST["name"];
    $gender= $_REQUEST["gender"];
    $grade= $_REQUEST["grade"];
	$class= $_REQUEST["class"];
    $phone= $_REQUEST["phone"];
	$email= $_REQUEST["email"];
	$address= $_REQUEST["address"];
    
    try {
        $db = new PDO("mysql:host=localhost;dbname=phpdb", "php", "1234");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        if (!($name && $gender && $grade && $class && $phone)) {
?>
            <script>
                alert('빈칸 없이 입력해야 합니다.');
                history.back();
            </script>
<?php            
        } else if ($db->query("select count(*) from student 
					where phone='$phone'")->fetchColumn() > 0) {
?>            
            <script>
                alert('이미 등록된 핸드폰 번호입니다.');
                history.back();
            </script>
<?php            
        }else {
			
			$db->exec("alter table s_id auto_increment =1");//auto_increment 값 초기화(글번호+1 초기화)
                // [출처] [PHP] 게시판 만들기 #13 Auto_increment초기화|작성자 S Writer
				
			$db->exec("insert into s_id values ('','$name')");

			$query = $db->query("select * from s_id where name='$name'");		
			if ($row = $query->fetch(PDO::FETCH_ASSOC)) {		
				
				if($name == $row["name"]){
					
					$id = $row["id"];
					$r_date = date("Y-m-d");
				
					$db->exec("alter table student auto_increment =1");//auto_increment 값 초기화(글번호+1 초기화)
					// [출처] [PHP] 게시판 만들기 #13 Auto_increment초기화|작성자 S Writer
						
					$db->exec("insert into student 
								values ('', '$id', '$name', '$phone', '$gender', '$grade', '$class', '$email', '$address', '$r_date')");
				
					//$db->exec("alter table signup_t auto_increment =1");
					//$db->exec("insert into signup_t 
								//values ('', '$id', '$grade', '$class', '', '')");
								
					$db->exec("alter table signup auto_increment =1");
					$db->exec("insert into signup 
								values ('', '$id', '$grade', '$class', '', '', '', '', '', '', '', '', '', '')");
				
?>            
            <script>
                alert('가입이 완료되었습니다.');
				opener.parent.location.reload(); //[출처]
                window.close();
            </script>
<?php            
					}
				}
			}
        
    } catch (PDOException $e) {
        exit($e->getMessage());
    } 
?>

</body>
</html>