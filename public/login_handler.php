<?php
function decrypt($encryptedText) {
    $keys = [5, -14, 31, -9, 3];
    $decryptedText = '';
    $keyCounter = 0;

    for ($i = 0; $i < strlen($encryptedText); $i++) {
        $char = $encryptedText[$i];

        if ($char == "\n") {
            $decryptedText .= $char;
            $keyCounter = 0; // Reset the key counter for a new line
            continue;
        }

        $charValue = ord($char);
        $charValue -= $keys[$keyCounter];
        $decryptedText .= chr($charValue);

        $keyCounter = ($keyCounter + 1) % count($keys); // Move to the next key and wrap around if needed.
    }

    return $decryptedText;
}


// Include the config file for database connection
require '../config.php';

// Read the encrypted passwords from the password.txt file
$encryptedPasswords = file_get_contents('../password.txt');
$decryptedPasswords = decrypt($encryptedPasswords);
$passwords = explode("\n", $decryptedPasswords);


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
