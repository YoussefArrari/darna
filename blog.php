<?php
require_once "includes/dbh.inc.php";
require_once 'includes/is_loged_in.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/login_view.inc.php';
require_once 'includes/config_session.inc.php';
require_once 'includes/cart.inc.php';
  
function displayBlogs($pdo) {
  try {
      // Prepare SQL statement to fetch all blogs
      $sql = "SELECT * FROM blogs";
      $stmt = $pdo->query($sql);

      // Check if there are any blogs
      if ($stmt->rowCount() > 0) {
          // Loop through each blog and display its information
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              // Start blog card
              echo '<div class="blog_card">';
              echo '<div class="top">';
              echo '<div class="state">';
              // Check if blog is new (you can modify this logic as needed)
              // For example, you can check the creation date of the blog
              // and determine if it's new based on certain criteria
              echo '<div class="new">NEW</div>';
              echo '</div>';
              
              echo '<img src="uploads/' . $row['img_title'] . ' "alt="bg" class="product_img" />';
              echo '</div>'; // Close top

              echo '<div class="bottom">';
              echo '<a class="name"href="blog_detail.php?id=' . $row['id'] . '">' . $row['title'] . '</a>';
              echo '<div class="price">' . date('F d, Y', strtotime($row['created_at'])) . '</div>';
              echo '</div>'; // Close bottom

              echo '</div>'; // Close blog_card
          }
      } else {
          echo "<p>No blogs found.</p>";
      }
  } catch (PDOException $e) {
      // Handle database errors
      echo "Error: " . $e->getMessage();
  }
}

// Call the function to display all blogs



?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/shop.css" />
    <title>shop</title>
  </head>
  <body>
     <!-- Cart -->
     <section class="cart ">
      
      <div class="cart-title">Cart
        <div class="cart-closing-button">
          <img src="img/close.svg" alt="plus" width="40px" /></div>
      </div>
      <div class="cart-items-container" id="cartContainer">
        <?php displayCartItems($pdo)?>
        <div class="cart-buttons">
          <button class="checkout">Checkout</button>
          <button class="view-cart">View Cart</button>
        </div>
      </div>
  
  </section>
  
    <!-- Navbar -->
    <header>
      <nav>
        <a href="#" class="logo"> Darna </a>
        <ul class="navlist">
        <li><a href="/php%20tuto/">Home</a></li>
          <li><a href="/php%20tuto/shop.php">Shop</a></li>
          <li><a href="/php%20tuto/blog.php">blog</a></li>
          <li><a href="/php%20tuto/contactUs.php">Contact Us</a></li>
        </ul>
        <div class="right-content">
        <?php
         if(is_logged_in()) {

        echo"  <a  class='nav-btn'>
            <img src='img/profile.svg' alt='profile' width='25' height='25' />
          </a>
          <a  class='nav-btn' id='openCart'>
            <img src='img/bag.svg' alt='profile' width='29' height='29' />
           "; if(getCartItemCount($pdo)>0){ echo" <div class='numbers'>".getCartItemCount($pdo)."</div>";}; echo"
             </a>
          <img
            src='img/menu.svg'
            alt='menu'
            width='30'
            height='30'
            class='menu-icon'
          />
          "
        ;}else{
          echo" <a href='/php%20tuto/login.php' class='nav-btn'>
            <img src='img/profile.svg' alt='profile' width='25' height='25' />
          </a>
          <a href='/php%20tuto/login.php' class='nav-btn' id='openCart'>
            <img src='img/bag.svg' alt='profile' width='29' height='29' />
          </a>
          <img
            src='img/menu.svg'
            alt='menu'
            width='30'
            height='30'
            class='menu-icon'
          />";
        };
            
          ?>
        </div>
      </nav>
    </header>
    
    <main>
      <!-- WELCOME TO THE SHOP -->
      <div class="welcomeBlog">
        <div class="title">Our Blog</div>
        <div class="subtitle">Home ideas and design inspiration</div>
      </div>
      <!-- Products Section -->
      <section class="product_section">
        
        <div class="products">
          <div class="title">Blogs</div>
        
          <div class="blog_container">
            <?php displayBlogs($pdo)?>
          </div>
          


        </div>
      </section>
    </main>

   <!--Newsletter -->
   <div class="newsletter">
    <div>
        <!-- img1 -->
        <img src="img/newsletter1.svg" width="350" alt="chair" />
    </div>
    <div class="newsContainer">
        <div class="title">Join Our Newsletter</div>
        <div class="subtitle">Sign up for deals, new products, and promotions</div>
        <?php
        // Check if the 'success' parameter is present in the URL
        if(isset($_GET['emailsuccess']) && $_GET['emailsuccess'] == 'true') {
            // Display a success message
            echo '<div class="success-message-container" id="success-message-container">';
            echo '<div class="success-message" >Thank you for subscribing to our newsletter!</div>';
            echo'<button class="dismiss-button" onclick="dismissSuccessMessage()">
            <img src="img/closewhite.svg" alt="close" width="20" height="20" />
            </button>';
            echo '</div>';
        }
        ?>

          <form class="inputcontainer" action="./includes/subscribe.php" method="post">
              <input type="email" name="email" placeholder="Enter your email" required />
              <button type="submit" class="buttonMail" name="subscribe">Sign Up</button>
          </form>
          
    </div>
    <div>
        <!-- img2 -->
        <img src="img/newsletter2.svg" width="350" alt="chair" />
      </div>
    </div>

    <!-- Footer -->
    <div class="footer">
      <div class="footertop">
        <div class="footerlogo">Darna</div>
        <div class="footerlinks">
          <a href="#">Home</a>
          <a href="#">Shop</a>
          <a href="#">Product</a>
          <a href="#">blog</a>
          <a href="#">Contact Us</a>
        </div>
      </div>

      <div class="footerbottom">
        <div class="footerbottomleft">
          <div class="copyrights">&copy; 2021 Darna. All rights reserved</div>
          <div>Privacy Policy</div>
          <div>Terms of Use</div>
        </div>

        <div class="socialmedia">
          <img src="img/instagram.svg" alt="instagram" />
          <img src="img/facebook.svg" alt="facebook" />
          <img src="img/youtube.svg" alt="youtube" />
        </div>
      </div>
    </div>
  </body>
  <script >
    
  function deleteCartItem(productId) {
    // Send an AJAX request to delete the item from the car
    
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "includes/delete_item.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Reload the cart items after deletion
        
        updateCart();
      }
    };
    xhr.send("product_id=" + productId);
  }
  


  function updateCart() {
    window.location.reload();
}
   

   let cartCloser = document.querySelector(".cart-closing-button");
   let cartOpener = document.getElementById("openCart");
   let cart = document.querySelector(".cart");
   
   let toggled = false;
   cartOpener.onclick = () => {
    
     if(toggled){
       cart.classList.toggle("closed")
     }
     
     cart.classList.toggle("open")

   };
  
   cartCloser.onclick = () => {
     //document.querySelector(".cart").style.display = "none";
     cart.classList.toggle("open")
     
     cart.classList.toggle("closed")
     toggled = true;
   };

   function dismissSuccessMessage(){
      document.getElementById("success-message-container").style.display = "none";
    }
  </script>
  
</html>
