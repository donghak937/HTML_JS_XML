<?php
// hello_css.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP with CSS</title>
    <style>
        h2 {
            font-size: 30px;
            color: blue;
            font-weight: bold;
            text-align: center;
            background-color: tomato;
        }
    </style>
</head>
<body>
    <h1>My first PHP page</h1>

    <?php
        // h2 태그를 PHP로 출력
        echo "<h2>Hello World!</h2>";
    ?>

</body>
</html>
