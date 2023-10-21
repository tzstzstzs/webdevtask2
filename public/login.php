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
    
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional: Bootstrap JS and Popper.js for Bootstrap components that require JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Typography -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- Your custom CSS styles (if any) -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Login</h5>

                    <?php 
                    if (!empty($errorMessage)) {
                        echo "<div class='alert alert-danger'>{$errorMessage}</div>";
                    } elseif (!empty($colorMessage)) {
                        echo "<div class='alert alert-success'>{$colorMessage}</div>";
                        // Display the image of that color
                        echo "<div class='text-center'><img src='/assets/colors/{$_GET['color']}.png' alt='Color image' style='width: 100px; height: 100px; margin: 0 auto; border: 1px solid #ddd;'></div>"; // Adjust the size as needed.
                    }
                    ?>

                    <form action="login_handler.php" method="POST">
                        <div class="form-group">
                            <label for="username">Felhasználónév:</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Jelszó:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
