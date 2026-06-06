<?php
include 'admin_check.php';
include 'config.php';

if(isset($_POST['save']))
{
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if(empty($title))
    {
        die("Title is required");
    }

    if(empty($content))
    {
        die("Content is required");
    }

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO posts(title,content) VALUES(?,?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "ss",
        $title,
        $content
    );

    mysqli_stmt_execute($stmt);

    header("Location:index.php");
    exit();
}
?>

<form method="POST">

Title:
<input type="text" name="title" required>

<br><br>

Content:
<textarea name="content" required></textarea>

<br><br>

<button name="save">
Save
</button>

</form>