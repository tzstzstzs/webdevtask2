<?php
$errorMessage = isset($_GET['error']) ? $_GET['error'] : '';
$colorMessage = isset($_GET['color']) ? "A kedvenc színed: " . $_GET['color'] : '';

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
                <label for="username">Felhasználónév:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Jelszó:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>

        <?php 
        if (!empty($errorMessage)) {
            echo "<p class='error'>{$errorMessage}</p>";
        } elseif (!empty($colorMessage)) {
            echo "<p class='success'>{$colorMessage}</p>";
            // Display the image of that color
            echo "<img src='/assets/colors/{$_GET['color']}.png' alt='Color image' style='width: 100px; height: 100px;'>"; // Adjust the size as needed.
        }
        ?>

    </div>
</body>
</html>
