<?php
$errorMessage = isset($_GET['error']) ? $_GET['error'] : '';
$colorMessage = isset($_GET['color']) ? "Your favorite color is: " . $_GET['color'] : '';

if (isset($_GET['redirect']) && $_GET['redirect'] === 'true') {
    header("refresh:3;url=https://police.hu");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="login-container">
        <form action="login_handler.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</body>
</html>


<?php 
if (!empty($errorMessage)) {
    echo "<p class='error'>{$errorMessage}</p>";
} elseif (!empty($colorMessage)) {
    echo "<p class='success'>{$colorMessage}</p>";
    echo "<div style='background-color: {$_GET['color']}; width: 100px; height: 100px;'></div>"; // Adjust the size as needed.
}
?>