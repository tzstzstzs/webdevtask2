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

$encryptedText = file_get_contents("../password.txt");
echo decrypt($encryptedText);

?>
