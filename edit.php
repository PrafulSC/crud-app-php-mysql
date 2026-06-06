<?php
include 'admin_check.php';
include 'config.php';

$id = $_GET['id'];

$stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM posts WHERE id=?"
);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$data = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
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
        "UPDATE posts
        SET title=?, content=?
        WHERE id=?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "ssi",
        $title,
        $content,
        $id
    );

    mysqli_stmt_execute($stmt);

    header("Location:index.php");
    exit();
}
?>

<form method="POST">

<input
type="text"
name="title"
value="<?php echo $data['title']; ?>"
required
>

<br><br>

<textarea
name="content"
required
><?php echo $data['content']; ?></textarea>

<br><br>

<button name="update">
Update
</button>

</form>