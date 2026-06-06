<?php
session_start();

if(!isset($_SESSION['user']))
{
    header("Location:login.php");
}

include 'config.php';

if(isset($_GET['search']))
{
    $search = $_GET['search'];

    $result = mysqli_query(
        $conn,
        "SELECT * FROM posts
         WHERE title LIKE '%$search%'
         OR content LIKE '%$search%'"
    );
}
else
{
    $limit = 5;

    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    $start = ($page - 1) * $limit;

    $result = mysqli_query(
        $conn,
        "SELECT * FROM posts LIMIT $start,$limit"
    );
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">

<h2>Welcome <?php echo $_SESSION['user']; ?></h2>

<a href="create.php" class="btn btn-primary">
    Add Post
</a>

<br><br>

<form method="GET" class="mb-3">

    <input
        type="text"
        name="search"
        class="form-control"
        placeholder="Search title or content">

    <br>

    <input
        type="submit"
        value="Search"
        class="btn btn-success">

</form>

<table class="table table-bordered table-striped">

<tr>
    <th>ID</th>
    <th>Title</th>
    <th>Content</th>
    <th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

    <td><?php echo $row['id']; ?></td>

    <td><?php echo $row['title']; ?></td>

    <td><?php echo $row['content']; ?></td>

    <td>

        <a
            href="edit.php?id=<?php echo $row['id']; ?>"
            class="btn btn-warning btn-sm">
            Edit
        </a>

        <a
            href="delete.php?id=<?php echo $row['id']; ?>"
            class="btn btn-danger btn-sm">
            Delete
        </a>

    </td>

</tr>

<?php } ?>

</table>

<?php

$total_result = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total FROM posts"
);

$total_row = mysqli_fetch_assoc($total_result);

$total_posts = $total_row['total'];

$total_pages = ceil($total_posts / 5);

echo "<br>";

for($i=1; $i<=$total_pages; $i++)
{
    echo "<a class='btn btn-outline-primary btn-sm me-1' href='index.php?page=$i'>$i</a>";
}

?>

<br><br>

<a href="logout.php" class="btn btn-secondary">
    Logout
</a>

</div>

</body>
</html>