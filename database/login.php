<?php
// 開始 session
session_start();

// 模擬帳號和密碼
$correct_username = 'admin';
$correct_password = '123';

// 檢查 POST 請求
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 獲取用戶提交的帳號和密碼
    $username = $_POST['account'];
    $password = $_POST['ad_password'];

    // 驗證帳號和密碼是否正確
    if ($username === $correct_username && $password === $correct_password) {
        // 登入成功，將用戶信息存儲到 session 中
        $_SESSION['username'] = $username;
        $_SESSION['logged_in'] = true;

        // 返回 JSON 格式的成功信息
        echo json_encode(array('success' => true));
    } else {
        // 登入失敗，返回 JSON 格式的失敗信息
        echo json_encode(array('success' => false));
    }
} else {
    // 如果不是 POST 請求，返回 404 錯誤
    http_response_code(404);
}
?>
