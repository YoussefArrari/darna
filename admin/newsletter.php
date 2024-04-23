<?php
session_start();
    require 'includes/dbh.inc.php';
    function getNewsletters($pdo) {
        $sql = "SELECT * FROM newsletter_subscribers";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }
    $newsletters = getNewsletters($pdo);
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
    <link rel="stylesheet" href="css/products.css" />
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
                <h2>Newsletter Subscribers</h2>
            </header>
            <div class="messages">
                <?php foreach($newsletters as $newsletter): ?>
                    <div class="message">
                        <div class="topside">
                            <div>
                                <h3><?= $newsletter['email'] ?></h3>
                                <p><?= $newsletter['signup_date'] ?></p>
                            </div>
                        </div>
                        <div class="bottomside">
                            <a class="delete" href="./includes/deleteNewsletter.php?id=<?= $newsletter['id'] ?>">Delete</a>
                        </div>
                </div>
                <?php endforeach; ?>

            </div>          
        </div>

    </main>
</body>
</html>
