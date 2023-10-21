<?php
// Define the path to the password.txt file
$file_path = __DIR__ . '/../password.txt';  // Adjust the path if necessary

// Check if the file exists
if (!file_exists($file_path)) {
    die("password.txt file not found!");
}

// Read the file
$passwords = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Display the contents
echo "<h3>Contents of password.txt:</h3>";
echo "<table border='1'>";
echo "<tr><th>Username</th><th>Password</th></tr>";

foreach ($passwords as $line) {
    list($username, $password) = explode('*', $line);
    echo "<tr><td>" . htmlspecialchars($username) . "</td><td>" . htmlspecialchars($password) . "</td></tr>";
}

echo "</table>";
?>
