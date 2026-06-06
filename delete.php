<?php
include 'admin_check.php';
include 'config.php';

$id = $_GET['id'];

$stmt = mysqli_prepare(
    $conn,
    "DELETE FROM posts WHERE id=?"
);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);

mysqli_stmt_execute($stmt);

header("Location:index.php");
exit();
?>