<?php
session_start();

$valid_username = "aqua12345";
$valid_password = "phonics12345";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!-- index.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Aquametrics - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 350px;">
        <h2 class="text-center mb-4">Aquametrics</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
        </form>
        <?php if (isset($error)) echo "<p class='text-danger mt-3 text-center'>$error</p>"; ?>
    </div>
</body>
</html>
