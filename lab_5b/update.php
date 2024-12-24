<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "Lab_5b"; // Correct database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details
if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];
    $result = $conn->query("SELECT * FROM users WHERE matric='$matric'");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        die("User not found.");
    }
}

// Update user details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $level = $_POST['level'];

    $conn->query("UPDATE users SET name='$name', role='$level' WHERE matric='$matric'");
    header("Location: index.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>
<body>
    <h2>Update User</h2>
    <form action="update.php" method="POST">
        <label for="matric">Matric:</label>
        <input type="text" id="matric" name="matric" value="<?php echo htmlspecialchars($user['matric']); ?>" readonly><br><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required><br><br>

        <label for="level">Access Level:</label>
        <input type="text" id="level" name="level" value="<?php echo htmlspecialchars($user['role']); ?>" required><br><br>

        <button type="submit">Update</button>
        <a href="index.php">Cancel</a>
    </form>
</body>
</html>
