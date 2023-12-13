


<?php
session_start();
require_once('db.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// $select_values = "SELECT * FROM user_reg WHERE user_id = ?";
// $stmt = mysqli_prepare($conn, $select_values);

// mysqli_stmt_bind_param($stmt, "i", $_SESSION['user_id']);

// mysqli_stmt_execute($stmt);

// $adminlogins = mysqli_stmt_get_result($stmt);

$select_values = "SELECT * FROM user_reg WHERE user_id = $_SESSION['user_id']";
$adminlogins = mysqli_query($conn, $select_values);

$num_of_rows = mysqli_num_rows($adminlogins);

if ($num_of_rows == 1) {
    $fetch_row = mysqli_fetch_assoc($adminlogins);
    $_SESSION['disname'] = $fetch_row['name'];
    $_SESSION['disemail'] = $fetch_row['email'];
    $_SESSION['disphone'] = $fetch_row['phone'];
} else {
    header('Location: login.php');
    exit();
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
    <p>Welcome, <?php echo $_SESSION['disname']; ?>!</p>
    <p>Your Phone: <?php echo $_SESSION['disphone']; ?></p>
    <p>Your Email: <?php echo $_SESSION['disemail']; ?></p>
    <!-- Display other user-specific content here -->
    <a href="logout.php">Logout</a>
</body>
</html>


















<?php
session_start();
require_once('db.php');
// require_once('user.php');
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}

$select_values = "SELECT * FROM user_reg WHERE user_id = $_SESSION['user_id']";
$adminlogins = mysqli_query($conn, $select_values);

$num_of_rows = mysqli_num_rows($adminlogins);
if ($num_of_rows == 1) {
    $fetch_row = $adminlogins->fetch_assoc();
    $_SESSION['disname'] = $fetch_row['name'];
    $_SESSION['disemail'] = $fetch_row['email'];
    $_SESSION['disphone'] = $fetch_row['phone'];
    return true;
} else {
    return false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
    <p>Welcome, <?php echo $_SESSION['disname']; ?>!</p>
    <p>Your Phone: <?php echo $_SESSION['disphone']; ?></p>
    <p>Your Email: <?php echo $_SESSION['disemail']; ?></p>
    <!-- Display other user-specific content here -->
    <a href="logout.php">Logout</a>
</body>
</html>



































<?php 





CREATE DATABASE IF NOT EXISTS user_management;
USE user_management;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);







class User {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function register($name, $phone, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO users (name, phone, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $phone, $email, $hashedPassword);
        $stmt->execute();
        $stmt->close();
    }

    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($id, $hashedPassword);
        $stmt->fetch();
        $stmt->close();

        if (password_verify($password, $hashedPassword)) {
            return $id;
        } else {
            return false;
        }
    }
}







require_once('db.php');
require_once('User.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($password == $confirmPassword) {
        $user = new User($conn);
        $user->register($name, $phone, $email, $password);
        header('Location: login.php');
        exit();
    } else {
        echo "Passwords do not match.";
    }
}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>
    <h2>User Registration</h2>
    <form method="POST" action="register.php">
        <label>Name:</label>
        <input type="text" name="name" required><br>

        <label>Phone:</label>
        <input type="text" name="phone" required><br>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <label>Confirm Password:</label>
        <input type="password" name="confirm_password" required><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>








require_once('db.php');
require_once('User.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new User($conn);
    $userId = $user->login($email, $password);

    if ($userId) {
        $_SESSION['user_id'] = $userId;
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Invalid email or password.";
    }
}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
</head>
<body>
    <h2>User Login</h2>
    <form method="POST" action="login.php">
        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>






session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch user data from the database using $_SESSION['user_id']

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
    <h2>User Dashboard</h2>
    <p>Welcome, User!</p>
    <!-- Display user-specific content here -->
    <a href="logout.php">Logout</a>
</body>
</html>







session_start();
session_unset();
session_destroy();
header('Location: login.php');
exit();







$dbHost = 'your_host';
$dbUser = 'your_username';
$dbPass = 'your_password';
$dbName = 'user_management';

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




?>