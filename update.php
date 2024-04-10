<?php
    $name 	 = $_REQUEST["name"];
    $r_date  = $_REQUEST["r_date"];
    $id 	 = $_REQUEST["id"];
    $grade 	 = $_REQUEST["grade"];
    $class 	 = $_REQUEST["class"];
	$gender  = $_REQUEST["gender"];
    $email   = $_REQUEST["email"];
    $course  = $_REQUEST["course"];
    $phone 	 = $_REQUEST["phone"];
    $address = $_REQUEST["address"];

    	
	if ($name && $grade && $class && $gender && $course && $phone) {
        try {
            $db = new PDO("mysql:host=localhost;dbname=phpdb", "php", "1234");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    		
            $db->exec("update student set name='$name', r_date='$r_date', id='$id', 
                       grade='$grade', class='$class', gender='$gender', email='$email',
					   course='$course', phone='$phone', address='$address' where id=$id");
        
        } catch (PDOException $e) {
            exit($e->getMessage());
        } 
    	
    	header("Location:student.php?id=$id");
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