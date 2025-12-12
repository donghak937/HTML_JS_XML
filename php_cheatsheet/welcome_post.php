<?php
// welcome_post.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome (POST)</title>
</head>
<body>

<?php
// $_POST 배열에서 값 읽기
$name  = $_POST["name"]  ?? "";
$email = $_POST["email"] ?? "";
?>

Welcome <?php echo htmlspecialchars($name); ?><br>
Your email address is: <?php echo htmlspecialchars($email); ?>

</body>
</html>
