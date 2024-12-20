<?php
// Database connection details
$host = "localhost";
$username = "root";
$password = "";
$db_name = "likitha";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Initialize variables
$name =  $email = $phone = $gametype = $address = "";

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $gametype = htmlspecialchars($_POST["gametype"]);
    $address = htmlspecialchars($_POST["address"]);

    try {
        $stmt = $pdo->prepare("INSERT INTO registration(name,email,phone, gametype, address)
                               VALUES (?, ?, ?, ?,?)");
        $stmt->execute([$name,$email, $phone, $gametype, $address]);
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "Error: Duplicate entry. <a href='indexp.html'>Try again</a>";
            exit();
        } else {
            echo "Error: " . $e->getMessage();
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Details</title>
    <link rel="stylesheet" href="stylep.css">
</head>
<body>
    <div class="container">
        <h1>Registration Details</h1>
        <p><strong>Name:</strong> <?= htmlspecialchars($name) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($phone) ?></p>
        <p><strong>gametype:</strong> <?= htmlspecialchars($gametype) ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($address) ?></p>
         <a href="indexp.html" style="display: block; margin-top: 20px; text-align: center; color: #5cb85c;">Back to Form</a>
    </div>
</body>
</html>

