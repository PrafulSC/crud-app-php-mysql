<?php
include 'config.php';

if(isset($_POST['save']))
{
    $title = $_POST['title'];
    $content = $_POST['content'];

    mysqli_query(
    $conn,
    "INSERT INTO posts(title,content)
    VALUES('$title','$content')"
    );

    header("Location:index.php");
}
?>

<form method="POST">

Title:
<input type="text" name="title">

<br><br>

Content:
<textarea name="content"></textarea>

<br><br>

<button name="save">
Save
</button>

</form>