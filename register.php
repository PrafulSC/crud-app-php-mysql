<?php
include 'config.php';

if(isset($_POST['register']))
{
    $username = $_POST['username'];

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

    $sql = "INSERT INTO users(username,password)
            VALUES('$username','$password')";

    mysqli_query($conn,$sql);

    echo "Registration Successful";
}
?>

<form method="POST">
    Username:
    <input type="text" name="username">

    Password:
    <input type="password" name="password">

    <button name="register">
        Register
    </button>
</form>