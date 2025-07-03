<?php
// 설정
$apiKey = ''; // 🔐 여기에 본인의 D-ID API 키를 넣으세요
$baseUrl = 'https://api.d-id.com';
$authHeader = 'Authorization: Basic ' . base64_encode($apiKey);

// 1. 동영상 생성 요청
function createTalk($scriptText, $imageUrl) {
    global $baseUrl, $authHeader;

    $url = $baseUrl . '/talks';

    $data = array(
        "script" => array(
            "type" => "text",
            "input" => $scriptText,
            "provider" => array(
                "type" => "microsoft",
                "voice_id" => "ko-KR-SunHiNeural"
            )
        ),
        "source_url" => $imageUrl
    );

    $jsonData = json_encode($data);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        $authHeader
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_POST, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true); // 반환값에 video_id 포함
}

// 2. 동영상 상태 조회
function getTalkStatus($talkId) {
    global $baseUrl, $authHeader;

    $url = $baseUrl . '/talks/' . $talkId;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array($authHeader));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

// 3. 음성 리스트 조회
function getVoices() {
    global $baseUrl, $authHeader;

    $url = $baseUrl . '/tts/voices';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array($authHeader));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

//////////////////////////
// 예제 사용 방법
//////////////////////////

// 1. 동영상 생성 요청
//$script = "안녕하세요! 저는 애비사예요. 인공지능으로 만들어진 친구로...";
$script = "나의 모든 사랑이 떠나가는 날이 당신의 그 웃음 뒤에서 함께 하는데 철이 없는 욕심에 그 많은 미련에 당신이 있는 건 아닌지 아니겠지요 시간은 멀어 집으로 향해 가는데 약속했던 그대만은 올 줄을 모르고 애써 웃음 지으며 돌아오는 이 길은 왜 그리 낯설고 멀기만 한지";
$imageUrl = "https://i.postimg.cc/L8Rdk9hb/2024-05-26-10-34-22.png";


//$result = createTalk($script, $imageUrl);
//echo "<pre>";print_r($result);echo "</pre>";


//2. 생성된 video_id로 상태 확인
//sleep(10); // 조금 기다렸다가 조회 필요
$status = getTalkStatus('tlk_XtpOi3p4wiLFPlVckBhRh');
//$status = getTalkStatus($result['id']);
echo "<pre>";print_r($status);echo "</pre>";
exit;

//3. 음성 목록 보기
//$voices = getVoices();
//print_r($voices);
?>
