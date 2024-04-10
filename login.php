<?php 
    $id = $_REQUEST["id"];
    $pw = $_REQUEST["pw"];
    
    try {
        $db = new PDO("mysql:host=localhost;dbname=phpdb", "php", "1234");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $query = $db->query("select * from login where id='$id' and pw='$pw'");
        if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            session_start();
            
            $_SESSION["userId"  ] = $row["id"  ];
            $_SESSION["userName"] = $row["name"];
            
            header("Location:list.php");

            exit;
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
    alert('아이디 또는 비밀번호가 틀렸습니다.');
    history.back();
</script>

</body>
</html>