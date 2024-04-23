<?php
    require 'includes/dbh.inc.php';
    session_start();
    function get_messages($pdo){
        $sql = "SELECT * FROM messages";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $messages = $stmt->fetchAll();
        return $messages;
    }
    $messages = get_messages($pdo);
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
                <h2>Messages</h2>
            </header>
            <div class="messages">
                <?php foreach ($messages as $message): ?>
                    <div class="message">
                        <div class="topside">
                            <div><h3><?= $message['email'] ?></h3>
                            <h4><?= $message['name'] ?></h4></div>
                            <p><?= $message['message'] ?></p>
                        </div>
                        <div class="bottomside">
                            <a class="delete" href="./includes/deleteMessage.php?id=<?= $message['id'] ?>">Delete</a>
                        </div>
                    </div>
                <?php endforeach; ?>       
        </div>

    </main>
</body>
</html>
