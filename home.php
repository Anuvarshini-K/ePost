<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not authenticated
    exit();
}
$username = isset($_POST['username']) ? $_POST['username'] : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Postman</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.home-container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.home-container h2 {
    color: #333;
}

.home-container ul {
    list-style-type: none;
    padding: 0;
}

.home-container ul li {
    margin-bottom: 10px;
}

.home-container ul li a {
    text-decoration: none;
    color: #007BFF;
}

.home-container ul li a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
    <div class="home-container">
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <ul>
            <li><a href="view_letters.php">View Letters</a></li>
            <li><a href="add_letter.php">Add Letter</a></li>
            <li><a href="delete_letter.php">Delete Letters</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</body>
</html>
