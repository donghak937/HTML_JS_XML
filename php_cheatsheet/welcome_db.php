<?php
// welcome_db.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert to MySQL</title>
</head>
<body>

<?php
// 폼에서 넘어온 값
$name  = $_POST["name"]  ?? "";
$email = $_POST["email"] ?? "";

// 먼저 화면에 출력
echo "Welcome " . htmlspecialchars($name) . "<br>";
echo "Your email address is: " . htmlspecialchars($email) . "<br><br>";

echo "database insertion <br>";

// MySQL 접속 정보 (XAMPP 기본값)
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "testdb";

// MySQL 서버 접속 (객체지향 방식)
$conn = new mysqli($servername, $username, $password, $dbname);

// 접속 에러 체크
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 한글 깨짐 방지 (선택)
$conn->set_charset("utf8mb4");

// SQL 문 만들기
$sql = "INSERT INTO exercise_sql (name, email)
        VALUES ('" . $conn->real_escape_string($name) . "',
                '" . $conn->real_escape_string($email) . "')";

// 실행
if ($conn->query($sql) === TRUE) {
    echo "A record for name and email has been inserted.";
} else {
    echo "Could not insert record: " . $conn->error;
}

$conn->close();
?>

</body>
</html>
