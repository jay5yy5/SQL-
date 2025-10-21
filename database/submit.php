<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $choice = $_POST['choice'];

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

    echo 'Connection successful!';

    // 根據表格名稱選擇不同的處理方式
    if ($choice === '學生') {
        $studentId = $_POST['studentId'];
        $studentName = $_POST['studentName']; 
        $studentGender = $_POST['studentGender'];
        $studentBirthday = $_POST['studentBirthday'];
        $studentPhone = $_POST['studentPhone'];
        $studentAddress = $_POST['studentAddress'];

        $stmt = $mysqli->prepare("INSERT INTO 學生 (studentId, studentName, studentGender, studentBirthday, studentPhone, studentAddress) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $studentId, $studentName, $studentGender, $studentBirthday, $studentPhone, $studentAddress);
    } elseif ($choice === '部門') {
        $departmentId = $_POST['departmentId'];
        $departmentName = $_POST['departmentName'];
        $departmentPhone= $_POST['departmentPhone'];

        $stmt = $mysqli->prepare("INSERT INTO 部門 (departmentId, departmentName, departmentPhone) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $departmentId, $departmentName, $departmentPhone);
    } elseif ($choice === '員工') {
        $employeeId = $_POST['employeeId'];
        $departmentId = $_POST['departmentId'];
        $employeeGender = $_POST['employeeGender'];
        $employeeName = $_POST['employeeName'];
        $projectId=$_POST['projectId'];

        $stmt = $mysqli->prepare("INSERT INTO 員工 (employeeId, departmentId, employeeGender, employeeName, projectId) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iissi", $employeeId, $departmentId, $employeeGender, $employeeName,$projectId);
    } elseif ($choice === '聯絡人') {
        $contactAddress = $_POST['contactAddress'];
        $contactPhone = $_POST['contactPhone'];
        $contactName = $_POST['contactName'];
        $studentId= $_POST['studentId'];

        $stmt = $mysqli->prepare("INSERT INTO 聯絡人 (contactAddress, contactPhone, contactName, studentId) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $contactAddress, $contactPhone, $contactName, $studentId);
    } elseif ($choice === '負責項目') {
        $projectId = $_POST['projectId'];
        $departmentId = $_POST['departmentId'];
        $projectName = $_POST['projectName'];

        $stmt = $mysqli->prepare("INSERT INTO 負責項目 (projectId, departmentId, projectName) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $projectId, $departmentId, $projectName);
    }

    if ($stmt && $stmt->execute()) {
        echo "數據插入成功";
    } else {
        echo "數據插入失敗: " . $stmt->error;
    }

    if(isset($stmt)){
        $stmt->close();
    }
    $mysqli->close();
    echo '<a href="http://localhost/functionflow.html">返回功能選擇頁面</a>';
}
?>