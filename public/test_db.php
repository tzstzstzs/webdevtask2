<?php
// Include the database configuration file
require '../config.php';

// Define a known username for testing
$testUsername = 'nagysanyi@gmail.hu';  // Replace 'example_username' with a known username from your database.

// Fetch details for the test user
$stmt = $pdo->prepare("SELECT * FROM tabla WHERE Username = ?");
$stmt->execute([$testUsername]);

// Fetch the result
$user = $stmt->fetch();

// Display the result
if ($user) {
    echo "User found!<br>";
    echo "Username: " . htmlspecialchars($user['Username']) . "<br>";
    echo "Favorite Color: " . htmlspecialchars($user['Titkos']) . "<br>";  // Assuming 'Titkos' is the column name for the color.
} else {
    echo "User not found!";
}
?>
