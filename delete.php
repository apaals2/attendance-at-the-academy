<?php
	$id = $_REQUEST["id"];
           
    try {
        $db = new PDO("mysql:host=localhost;dbname=phpdb","php", "1234");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
                             
        $db->exec("delete from student where id=$id");
		$db->exec("delete from checkon where id=$id");
		$db->exec("delete from s_id where id=$id");
		$db->exec("delete from grade where id=$id");
		$db->exec("delete from signup where id=$id");
		$db->exec("delete from signup_t where id=$id");
?>		
		<script>
                alert('삭제되었습니다.');
				opener.location.href="http://localhost/test/list.php";
				//opener.parent.parent.location.reload(); 오류 //출처: https://folio4jyang.tistory.com/24 [개발쟝 폴리오]
				window.close();
         </script>
<?php
                  
        } catch (PDOException $e) {
           exit($e->getMessage());
        }

                       
?>
