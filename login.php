<?php
session_start();

include 'config.php';

if(isset($_POST['login']))
{
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if(empty($username))
    {
        die("Username is required");
    }

    if(empty($password))
    {
        die("Password is required");
    }

    $stmt = mysqli_prepare(
        $conn,
        "SELECT * FROM users WHERE username=?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $username
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $user = mysqli_fetch_assoc($result);

    if($user &&
       password_verify(
       $password,
       $user['password']))
    {
        $_SESSION['user'] = $username;
        $_SESSION['role'] = $user['role'];

        header("Location:index.php");
        exit();
    }
    else
    {
        echo "Invalid Login";
    }
}
?>

<form method="POST">

Username:
<input type="text" name="username" required>

<br><br>

Password:
<input type="password" name="password" required>

<br><br>

<button name="login">
Login
</button>

</form>