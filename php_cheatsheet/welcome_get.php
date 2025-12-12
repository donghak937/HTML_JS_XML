<?php
// welcome_get.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome (GET)</title>
</head>
<body>

<?php
// $_GET 슈퍼 글로벌 배열에서 값 읽기
$name  = $_GET["name"]  ?? "";
$email = $_GET["email"] ?? "";
?>

Welcome <?php echo htmlspecialchars($name); ?><br>
Your email address is: <?php echo htmlspecialchars($email); ?>

</body>
</html>
