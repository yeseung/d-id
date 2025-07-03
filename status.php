<?php
header("content-type:text/html; charset=utf-8");
$videoId = $_GET['id'];
$apiKey = '';
$authHeader = 'Authorization: Basic ' . base64_encode($apiKey . ':');

$ch = curl_init("https://api.d-id.com/talks/" . $videoId);
curl_setopt($ch, CURLOPT_HTTPHEADER, array($authHeader));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);

if ($data && isset($data['result_url'])) {
    echo "<h2>동영상 생성 완료!</h2>";
    echo "<video src='{$data['result_url']}' controls autoplay></video>";
} else {
    echo "<h2>아직 준비되지 않았습니다.</h2>";
    echo "<pre>" . print_r($data, true) . "</pre>";
    echo "<meta http-equiv='refresh' content='5'>"; // 5초마다 새로고침
}
?>
