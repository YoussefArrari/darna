<?php
    session_start();
    require 'includes/dbh.inc.php';
    function get_products($pdo){
        $sql = "SELECT * FROM products";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        return $products;
    }
    $products = get_products($pdo);
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
                <h2>Stock</h2>
                <a href="uploadproduct.php">
                Add Product</a>
            </header>
            <div class="products">
                <?php foreach ($products as $product): ?>
                    <div class="product">
                        <div class="left-side">
                            <img src="../uploads/<?= $product['image_urls'] ?>" alt="<?= $product['product_name'] ?>" width="150px" height="00px" />
                            
                           
                        </div>
                        <div class="right-side">
                            <div class="h3container">
                                <h3><?= $product['product_name'] ?></h3>
                                <p>Price: <?= $product['price'] ?> dt</p>
                            </div>
                            <div class="buttons">
                            <a class="edit" href="editpage.php?id=<?= $product['product_id'] ?>">Edit</a>
                            <a class="delete" href="delete.php?id=<?= $product['product_id'] ?>">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
        </div>

    </main>
</body>
</html>
