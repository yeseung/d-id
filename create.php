<?php
header("content-type:text/html; charset=utf-8");
// API 키
$apiKey = '';
$authHeader = 'Authorization: Basic ' . base64_encode($apiKey . ':');

$script = $_POST['script'];
$imageUrl = $_POST['image_url'];

$data = array(
    "script" => array(
        "type" => "text",
        "input" => $script,
        "provider" => array(
            "type" => "microsoft",
            "voice_id" => "ko-KR-SunHiNeural"
        )
    ),
    "source_url" => $imageUrl
);

$jsonData = json_encode($data);

// CURL 호출
$ch = curl_init('https://api.d-id.com/talks');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    $authHeader
));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_POST, true);

$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

if (isset($result['id'])) {
    $videoId = $result['id'];
    echo "<h2>동영상 생성 요청 완료!</h2>";
    echo "<p>Video ID: <b>$videoId</b></p>";
    echo "<p><a href='status.php?id=$videoId'>상태 확인 및 영상 보기</a></p>";
} else {
    echo "<h2>오류 발생</h2>";
    echo "<pre>" . print_r($result, true) . "</pre>";
}
?>
