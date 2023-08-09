<?php

const emojis = ['😀', '😃', '😄', '😁', '😆'];

// Check if there is a second player
if ($_SERVER['REMOTE_ADDR'] !== $_SESSION['ip_address']) {
    // There is no second player
    header('Location: guess.php');
    exit();
}

// Get the emoji from the first player
$emoji = $_POST['emoji'];

// Generate a random emoji for the second player
$random_emoji = array_rand(emojis, 1);

// Send the emoji to the first player
echo json_encode([
    'status' => 'ok',
    'emoji' => $random_emoji
]);

?>
