<?php
include 'config.php';

$id = $_GET['id'];

$data = mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT * FROM posts WHERE id=$id"
)
);

if(isset($_POST['update']))
{
    $title = $_POST['title'];
    $content = $_POST['content'];

    mysqli_query(
    $conn,
    "UPDATE posts
    SET title='$title',
    content='$content'
    WHERE id=$id"
    );

    header("Location:index.php");
}
?>

<form method="POST">

<input
type="text"
name="title"
value="<?php echo $data['title']; ?>"
>

<br><br>

<textarea name="content">
<?php echo $data['content']; ?>
</textarea>

<br><br>

<button name="update">
Update
</button>

</form>