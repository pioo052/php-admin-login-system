
<?php

session_set_cookie_params([
    "httponly" => true,
    "samesite" => "Lax",
    "secure" => false
]);

session_start();

require_once "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    $sql = "SELECT * FROM admins WHERE email = :email";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":email" => $email
    ]);

    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password, $admin["password"])) {

        // Create a new session identifier
        session_regenerate_id(true);

        // Store administrator information in session
        $_SESSION["admin_id"] = $admin["id"];
        $_SESSION["admin_username"] = $admin["username"];

        // Redirect to dashboard
        header("Location: dashboard.php");
        exit;

    } else {

        $message = "Invalid email or password.";

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Admin Login</h1>

    <form method="POST" action="">

        <label>Email Address:</label>
        <input type="email" name="email" required>

        <br><br>

        <label>Password:</label>
        <input type="password" name="password" required>

        <br><br>

        <button type="submit">Login</button>

    </form>

    <?php if ($message !== ""): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

</body>
</html>
