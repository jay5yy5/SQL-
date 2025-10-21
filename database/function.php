<?php
// 檢查來自 index.html 的命令

    $functionname = $_POST['functionname'];
    // 根據命令導向不同的 PHP 文件執行
    switch ($functionname) {
        case '新增':
            header("Location: editform.html");
            exit(); // 確保腳本在重定向後停止執行
        case '刪除':
            header("Location: delete.html");
            exit(); // 確保腳本在重定向後停止執行
        case '展示':
            header("Location: ShowTheForm.html");
            exit(); // 確保腳本在重定向後停止執行
            case '修改':
                header("Location: update.html");
                exit();
        default:
            echo "無效的命令";
            break;
    };
?>