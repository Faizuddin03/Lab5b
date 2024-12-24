<?php

session_start();

$users = [
    ['matric' => '12345', 'password' => 'password123'], 
    ['matric' => '67890', 'password' => 'mypassword'],  
];

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    $authenticated = false;
    foreach ($users as $user) {
        if ($user['matric'] === $matric && $user['password'] === $password) {
            $authenticated = true;
            $_SESSION['matric'] = $matric;
            header("Location: display.php"); 
            exit();
        }
    }

    if (!$authenticated) {
        $error = 'Invalid username or password, try again.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="POST">
        <label for="matric">Matric:</label>
        <input type="text" id="matric" name="matric" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>
    <br>
    <a href="register.php">Register here if you have not.</a>

    <?php if (!empty($error)) : ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
</body>
</html>
