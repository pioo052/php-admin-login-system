
<?php
session_set_cookie_params([
    "httponly" => true,
    "samesite" => "Lax",
    "secure" => false
]);

session_start();

// Check whether administrator is logged in
if (!isset($_SESSION["admin_id"])) {

    header("Location: index.php");
    exit;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="dashboard-card">

        <h1>Admin Dashboard</h1>

        <h2>
            Welcome,
            <?php echo htmlspecialchars($_SESSION["admin_username"]); ?>!
        </h2>

        <p>You have successfully accessed the protected dashboard.</p>

        <a href="logout.php" class="logout-button">Logout</a>

    </div>

</body>

</html>
