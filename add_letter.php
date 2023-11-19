<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('includes/db.php');

    $sender = $_POST['sender'];
    $receiver = $_POST['receiver'];

    $sql = "INSERT INTO letters (sender, receiver, delivered_date) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $sender, $receiver);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Letter - Postman</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="add-letter-container">
        <h2>Add Letter</h2>
        <form action="add_letter.php" method="post">
            <label for="sender">Sender:</label>
            <input type="text" id="sender" name="sender" required>
            <label for="receiver">Receiver:</label>
            <input type="text" id="receiver" name="receiver" required>
            <button type="submit">Submit</button>
        </form>
        <p><a href="home.php">Back to Home</a></p>
    </div>
</body>
</html>
