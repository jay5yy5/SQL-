<?php
// 資料庫設置
$servername = "127.0.0.1"; // 主機名稱
$username = "root"; // 資料庫用戶名
$password = ""; // 資料庫密碼
$dbname = "homework"; // 資料庫名稱

// 建立與 MySQL 伺服器的連接
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連接是否成功
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
} else {
    echo "連接成功！";
}

// 確認是否從表單提交了資料
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 檢查 $_POST['tableChoice'] 是否存在
    if (isset($_POST['tableChoice'])) {
        // 獲取選擇的資料表名稱
        $tableChoice = $_POST['tableChoice'];

        // 檢查是否按下了顯示全部按鈕
        if (isset($_POST['showAll']) && $_POST['showAll'] == 'true') {
            // 根據不同的資料表執行不同的查詢
            switch ($tableChoice) {
                case '學生':
                    $sql = "SELECT * FROM 學生";
                    break;
                case '聯絡人':
                    $sql = "SELECT * FROM 聯絡人";
                    break;
                case '員工':
                    $sql = "SELECT * FROM 員工";
                    break;
                case '部門':
                    $sql = "SELECT * FROM 部門";
                    break;
                case '負責項目':
                    $sql = "SELECT * FROM 負責項目";
                    break;
                default:
                    echo "無效的資料表名稱";
                    exit;
            }
        } else {
            // 動態構建 SQL 查詢語句
            $conditions = [];
            foreach ($_POST as $key => $value) {
                if (!empty($value) && $key != 'tableChoice') {
                    $conditions[] = "$key = '$value'";
                }
            }

            if (count($conditions) > 0) {
                $sql = "SELECT * FROM $tableChoice WHERE " . implode(' AND ', $conditions);
            } else {
                echo "未提供查詢條件";
                exit;
            }
        }

        // 執行 SQL 查詢
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // 顯示查詢結果
            echo "<table border='1'>";
            echo "<tr>";
            // 顯示表頭
            while ($fieldinfo = $result->fetch_field()) {
                echo "<th>" . $fieldinfo->name . "</th>";
            }
            echo "</tr>";
            // 顯示資料列
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>" . $value . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "沒有查詢到資料";
        }

        // 釋放查詢結果
        $result->free();
    } else {
        echo "未選擇資料表";
    }
} else {
    echo "請通過表單提交資料";
}

// 記得關閉資料庫連接
$conn->close();
echo '<a href="http://localhost/functionflow.html">返回功能選擇頁面</a>';
?>
