
<?php
require_once "includes/dbh.inc.php";
require_once 'includes/is_loged_in.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/login_view.inc.php';
require_once 'includes/config_session.inc.php';
require_once 'includes/cart.inc.php';
  
function fetchBlogDetails($pdo) {
    // Check if blog ID is provided in the URL
    if (isset($_GET['id'])) {
        $blog_id = $_GET['id'];
        
        // Fetch blog details based on blog ID
        $sql = "SELECT * FROM blogs WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$blog_id]);

        // Check if blog exists
        if ($stmt->rowCount() > 0) {
            // Blog found, display its details
            $blog = $stmt->fetch(PDO::FETCH_ASSOC);
            echo '<div class="blog_header">';
            echo '<a href="/php%20tuto/blog.php" class="date">< blogs</a>';
            echo '<h1>' . $blog['title'] . '</h1>';
            echo '<p class="date">Published on: ' . date('F d, Y', strtotime($blog['created_at'])) . '</p>';
            echo '</div>';
            echo '<img src="uploads/' . $blog['img_title'] . '" alt="blog image" width="990px" height="580px"/>';
            echo '<div class="contant">';
            echo '<p>' . wrapPhrasesInPTags($blog['content']) . '</p>';
            echo '</div>';
        } else {
            // Blog not found
            echo '<p>Blog not found.</p>';
        }
    } else {
        // Blog ID not provided in URL
        echo '<p>Blog ID not provided.</p>';
    }
}
function wrapPhrasesInPTags($content) {
    // Split the content into phrases based on the period (.)
    $phrases = preg_split('/(?<=\.)/', $content, -1, PREG_SPLIT_NO_EMPTY);

    // Iterate through each phrase and wrap it in a <p> tag
    $wrapped_content = '';
    foreach ($phrases as $phrase) {
        // Trim the phrase to remove leading/trailing whitespace
        $phrase = trim($phrase);
        // Wrap the phrase in a <p> tag
        $wrapped_content .= '<p>' . $phrase . '</p>';
    }

    // Return the content with phrases wrapped in <p> tags
    return $wrapped_content;
}



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
          </a>
          <img
            src='img/menu.svg'
            alt='menu'
            width='30'
            height='30'
            class='menu-icon'
          />"
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
        <div class="blog-container">
            <?php fetchBlogDetails($pdo); ?>
        </div>
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

