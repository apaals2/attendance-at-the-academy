<!DOCTYPE html>
<html>
<head>
<link rel= "stylesheet" type="text/css" href="css/location.css">
</head>
<body>
<header id="header" class="clearfix">
<?php
    session_start();
    
    if (empty($_SESSION["userId"])) {
?>  
		<form action="login.php" method="post" style="margin-left:70%;width:680px;height:60px;border:0;" >
			아이디:   <input type="text" size="10" name="id">&nbsp;&nbsp;
			비밀번호: <input type="password" size="10" name="pw">
			<input type="submit" value="관리자로그인">
		</form>
<?php
    } else {
?>
        <form action="logout.php" method="post" style="margin-left:85%;width:680px;height:60px;border:0;">
            <?=$_SESSION["userName"]?>님 로그인 
            <input type="submit" value="로그아웃">
        </form>
<?php        
    }
?>	
<?php include("html/location.html"); ?>
<script>
var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
    mapOption = { 
        center: new kakao.maps.LatLng(37.44875100519729, 127.16846756364446), // 지도의 중심좌표
        level: 3 // 지도의 확대 레벨
    };

var map = new kakao.maps.Map(mapContainer, mapOption);

// 마커가 표시될 위치입니다 
var markerPosition  = new kakao.maps.LatLng(37.44875100519729, 127.16846756364446); 

// 마커를 생성합니다
var marker = new kakao.maps.Marker({
    position: markerPosition
});

// 마커가 지도 위에 표시되도록 설정합니다
marker.setMap(map);

var iwContent = '<div style="padding:5px;">학원 위치<br><a href="https://map.kakao.com/link/map/,37.44875100519729,127.16846756364446" style="color:blue" target="_blank">큰지도보기</a> <a href="https://map.kakao.com/link/to/,33.450701,126.570667" style="color:blue" target="_blank">길찾기</a></div>', // 인포윈도우에 표출될 내용으로 HTML 문자열이나 document element가 가능합니다
    iwPosition = new kakao.maps.LatLng(37.44875100519729, 127.16846756364446); //인포윈도우 표시 위치입니다

// 인포윈도우를 생성합니다
var infowindow = new kakao.maps.InfoWindow({
    position : iwPosition, 
    content : iwContent 
});
  
// 마커 위에 인포윈도우를 표시합니다. 두번째 파라미터인 marker를 넣어주지 않으면 지도 위에 표시됩니다
infowindow.open(map, marker); 
</script>

</section>
</body>
</html>
