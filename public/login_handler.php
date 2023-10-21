<?php

// Include the config file for database connection
require '../config.php';

// Read the passwords from the password.txt file
$passwords = file('../password.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Variables for storing messages
$errorMessage = 'Error Message';
$successMessage = 'Success Message';

// Process the form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredUsername = $_POST["username"];
    $enteredPassword = $_POST["password"];

    $isValidUser = false;
    $correctPassword = false;

    foreach ($passwords as $line) {
        list($fileUsername, $filePassword) = explode('*', $line); // Using new variable names

        if ($fileUsername === $enteredUsername) {
            $isValidUser = true;

            if ($filePassword === $enteredPassword) {
                $correctPassword = true;
            }

            break;
        }
    }

    if (!$isValidUser) {
        $errorMessage = "Nincs ilyen felhasználó.";
        header("Location: login.php?error=" . urlencode($errorMessage));
        exit;
    } elseif (!$correctPassword) {
        $errorMessage = "Incorrect password.";
        header("Location: login.php?error=" . urlencode($errorMessage) . "&redirect=true");
        exit;
    } else {
        // Fetch the user's favorite color from the database
        $stmt = $pdo->prepare("SELECT Titkos FROM tabla WHERE Username = ?");
        $stmt->execute([$enteredUsername]);

        $color = $stmt->fetchColumn();
        if ($color) {
            // Redirect back to login page with the color
            header("Location: login.php?color=" . urlencode($color));
            exit;
        } else {
            $errorMessage = "Error fetching color.";
            header("Location: login.php?error=" . urlencode($errorMessage));
            exit;
        }
    }
}
