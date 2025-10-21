<?php
// 檢查是否從表單提交了數據
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 處理表單提交
    // 獲取要更新的資料表、識別符號、屬性和新值
    $tableChoice = $_POST['tableChoice'];
    $identifier = $_POST['identifier'];
    $column = $_POST['column'];
    $newValue = $_POST['newValue'];

    // 資料庫連接參數
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "homework";

    // 創建資料庫連接
    $mysqli = new mysqli($servername, $username, $password, $dbname);

    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }

    // 根據所選的資料表執行相應的更新操作
    switch ($tableChoice) {
        case '學生':
            $sql = "UPDATE 學生 SET $column = ? WHERE studentId = ?";
            break;
        case '聯絡人':
            $sql = "UPDATE 聯絡人 SET $column = ? WHERE contactName = ?";
            break;
        case '員工':
            $sql = "UPDATE 員工 SET $column = ? WHERE employeeId = ?";
            break;
        case '負責項目':
            $sql = "UPDATE 負責項目 SET $column = ? WHERE projectId = ?";
            break;
        case '部門':
            $sql = "UPDATE 部門 SET $column = ? WHERE departmentId = ?";
            break;
        default:
            echo "無效的資料表名稱";
            exit;
    }

    // 創建準備語句
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        // 綁定參數並執行準備語句
        $stmt->bind_param("ss", $newValue, $identifier);
        if ($stmt->execute()) {
            // 檢查受影響的行數
            $affected_rows = $stmt->affected_rows;
            if ($affected_rows > 0) {
                echo "成功更新 {$affected_rows} 筆記錄";
            } else {
            echo "沒有符合條件的記錄被更新";
            }
            } else {
            echo "更新失敗：" . $stmt->error;
            }
            // 關閉準備語句
            $stmt->close();
            } else {
            echo "準備語句準備失敗";
            }$mysqli->close();
        } else {
        echo "請通過表單提交數據";
        }
        echo '<a href="http://localhost/functionflow.html">返回功能選擇頁面</a>';
        ?>