<?php
session_start();
    require 'includes/dbh.inc.php';
    function getBlogs($pdo) {
        $stmt = $pdo->prepare("SELECT * FROM blogs");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    $blogs = getBlogs($pdo);

    require 'includes/is_loged_in.php';
    if(!is_logged_in()) {
        header("Location: /php%20tuto/admin/login.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/blogs.css" />
    <title>Display all products</title>
</head>
<body>
    <main>
        <div class="navBar">
            <div class="logo">
               DARNA
            </div>
            <div class="nav">
                <a href="products.php">Stock</a>
                <a href="Blogs.php">Blogs</a>
                <a href="Messages.php">Messages</a>
                <a href="Newsletter.php">News letter</a>
            </div>
            <div class="logout">
                <a href="logout.php">Logout</a>
            </div>           
        </div>


        <div class="main">
            <header>
                <h2>Blogs</h2>
                <a href="uploadblog.php">
                Add a Blog</a>
            </header>
            <div class="products">
                <?php foreach ($blogs as $blog): ?>
                    <div class="product">
                        <div class="left-side">
                            <img src="../uploads/<?= $blog['img_title'] ?>" alt="<?= $blog['title'] ?>" width="150px" height="00px" />
                            
                           
                        </div>
                        <div class="right-side">
                            <div class="h3container">
                                <h3><?=$blog['title']  ?></h3>
                                <p>Author: <?= $blog['author'] ?></p>
                            </div>
                            <div class="buttons">
                            <a class="edit" href="editpage.php?id=<?= $blog['id'] ?>">Edit</a>
                            <a class="delete" href="./includes/deleteblog.php?id=<?= $blog['id'] ?>">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
        </div>

    </main>
</body>
</html>
