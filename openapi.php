<?php
include 'xml2json.php';
 
get_weather_info();
exit(0);
 
function get_weather_info()
{
					//'https://openapi.gg.go.kr/SigunEmplycntr?key=a681853210764553a124bc0de27bd509';
  $service_key = 'key=a681853210764553a124bc0de27bd509';
  $service_url = 'https://openapi.gg.go.kr/SigunEmplycntr';
  $service_api_name = 'ForecastGrib';
  $service_full_url = $service_url . $service_api_name . '?';
  $service_full_url = $service_full_url . ('ServiceKey=' . $service_key);
  $service_full_url = $service_full_url . ('&base_date=' . '20170117');
  $service_full_url = $service_full_url . ('&base_time=' . '0000');
  $service_full_url = $service_full_url . ('&nx=' . '61');
  $service_full_url = $service_full_url . ('&ny=' . '120');
  //$service_full_url = $service_full_url . ('&pageNo=' . '1');
  //$service_full_url = $service_full_url . ('&numOfRows=' . '10');
 
  $ch = curl_init();
 
  curl_setopt($ch, CURLOPT_URL, $service_full_url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
  $response = curl_exec($ch);
 
  $errno = curl_errno($ch);
  if ($errno > 0) {
    if ($errno === 28) {
        echo "Connection timed out.";
    }
    else {
        echo "Error #" . $errno . ": " . curl_error($ch);
    }
 
    exit(0);
  }
 
  if (!$response) {
    echo "ERROR - 1";
    exit(0);
  }
 
  $json_list = XmlToJson::Parse($response);
 
  if (!$json_list) {
    echo "ERROR - 2";
    exit(0);
  }
 
  $json_list= json_decode($json_list, true);
  curl_close($ch);
 
  if (!$json_list) {
    echo "ERROR - 3";
    exit(0);
  }
 
  if(strcmp($json_list['header']['resultMsg'],'OK') == 0 ) {
    var_dump($json_list);
    return 0; //success
  }
 
  var_dump($json_list);
  return 1; //failed
}
?>
