<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once('includes/db.php');

$sql = "SELECT * FROM letters";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Letters - Postman</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="view-letters-container">
        <h2>View Letters</h2>
        <table>
            <thead>
                <tr>
                    <th>Letter ID</th>
                    <th>Sender</th>
                    <th>Receiver</th>
                    <th>Delivered Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['sender']}</td>";
                    echo "<td>{$row['receiver']}</td>";
                    echo "<td>{$row['delivered_date']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <p><a href="home.php">Back to Home</a></p>
    </div>
</body>
</html>
