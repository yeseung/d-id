<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>D-ID 동영상 생성기</title>
  <style>
    body { font-family: sans-serif; padding: 20px; }
    input, textarea { width: 100%; margin: 10px 0; padding: 8px; }
    button { padding: 10px 20px; }
  </style>
</head>
<body>
  <h1>D-ID AI 동영상 생성</h1>

  <form action="create.php" method="post">
    <label>스크립트 (읽을 텍스트):</label>
    <textarea name="script" rows="5" required>안녕하세요! 저는 애비사예요. 인공지능으로 만들어진 친구로, 여러분과 대화를 나누고 도움이 되고자 여기 있어요.</textarea>

    <label>이미지 URL:</label>
    <input type="text" name="image_url" value="https://i.postimg.cc/yYdJf30G/2025-07-03-3-12-52.jpg" required />

    <button type="submit">동영상 생성</button>
  </form>
</body>
</html>
