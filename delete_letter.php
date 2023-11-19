<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_ids'])) {
    $deleteIds = $_POST['delete_ids'];

    // Use prepared statement for delete operation
    $sql = "DELETE FROM letters WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Check if prepared statement is created successfully
    if ($stmt) {
        foreach ($deleteIds as $deleteId) {
            // Bind parameters and execute the statement
            $stmt->bind_param("i", $deleteId);
            $stmt->execute();
        }

        // Close the statement
        $stmt->close();
    } else {
        // Handle error if the prepared statement is not created
        echo "Error: " . $conn->error;
    }
}

// Perform the query to fetch data
$sql = "SELECT * FROM letters";
$result = $conn->query($sql);

// Display the data
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Letters - Postman</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .delete-letters-container table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .delete-letters-container th, .delete-letters-container td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .delete-letters-container th {
            background-color: #f2f2f2;
        }

        .delete-letters-container tr:nth-child(even) {
            background-color: #f9f9f9; /* Light gray for even rows */
        }

        .delete-letters-container tr:nth-child(odd) {
            background-color: #ffffff; /* White for odd rows */
        }

        .delete-letters-container tr:hover {
            cursor: pointer;
            background-color: #f5f5f5; /* Light gray, change as needed */
        }
    </style>
</head>
<body>
    <div class="delete-letters-container">
        <h2>Delete Letters</h2>
        <form action="delete_letter.php" method="post">
            <table>
                <thead>
                    <tr>
                        <th>Select</th>
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
                        echo "<td><input type='checkbox' name='delete_ids[]' value='{$row['id']}'></td>";
                        echo "<td>{$row['id']}</td>";
                        echo "<td>{$row['sender']}</td>";
                        echo "<td>{$row['receiver']}</td>";
                        echo "<td>{$row['delivered_date']}</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button type="submit">Delete Selected Letters</button>
        </form>
        <p><a href="home.php">Back to Home</a></p>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
