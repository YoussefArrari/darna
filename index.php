<?php
  require_once 'includes/config_session.inc.php';
  require_once 'includes/signup_view.inc.php';
  require_once 'includes/login_view.inc.php';
  require_once 'includes/is_loged_in.php';
  require_once 'includes/cart.inc.php';
  function generateProductCards($pdo) {
    try {
        // Prepare SQL statement to fetch all products
        $sql = "SELECT * FROM products";
        $stmt = $pdo->query($sql);


        // Check if there are any products
        if ($stmt->rowCount() > 0) {
            $i=0;
            while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) and( $i<4)) {
                $i++;
                // Start product card
                echo '<div class="product_card">';
                echo '<div class="top">';

                // Check if product is new
                $createdAt = strtotime($row['created_at']);
                $twoWeeksAgo = strtotime('-2 weeks');
                if ($createdAt > $twoWeeksAgo) {
                    echo '<div class="state">';
                    echo '<div class="new">NEW</div>';
                    echo '</div>';
                }

           
                // Add onclick attribute to the Add to Cart button
                echo '<div class="addButton" onclick="addToCart(' . $row['product_id'] . ')">Add to cart</div>';
                echo '<img src="uploads/' . $row['image_urls'] . '" alt="' . $row['product_name'] . '" class="product_img" />';
                echo '</div>'; // Close top

                echo '<div class="bottom">';
                echo '<a href="/php%20tuto/product_details.php?id='. $row['product_id'] .'"  class="name">' . $row['product_name'] . '</a>';
                echo '<div class="price">' . $row['price'] . ' dt</div>';
                echo '</div>'; // Close bottom

                echo '</div>'; // Close product card
            }
        } else {
            echo "<p>No products found.</p>";
        }
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/home.css" />
    <title>home</title>
  </head>
  <body>
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
          <button class="view-cart">View Cart  </button>
        </div>
      </div>
  
  </section>
    <!-- Hero Section -->
    <section class="hero">
    <?php  check_signup_errors(); ?>
    <?php  check_login_errors(); ?>
    
      <div class="imageslider"></div>
      <div class="titlesContainer">
        <div class="titlesleft">
          <div class="title">Simply Unique<span class="lastleter">/</span></div>
          <div class="title">Simply Better<span class="lastleter">.</span></div>
        </div>
        <div class="titlesright">
          <p class="subtitle">
            <span class="boldsubtitle">Darna</span> is a gift & decorations
            store based in Tunis, Tunisia since 2019.
          </p>
        </div>
      </div>
    </section>
    <!-- Products Section -->
    <section class="categories">
      <div class="card1">
        <div class="cardtitlecontainer">
          <div class="cardtitle">Living Romm</div>
          <a href="/php%20tuto/shop.php" class="cardbutton">
            Shop Now <img src="img/arrow.svg" alt="arrow" />
          </a>
        </div>
        <div class="imgcontainer">
          <img src="img/chair1.png" width="450px" alt="chair" />
        </div>
      </div>
      <div class="cardholder">
        <div class="card2">
          <div class="cardtitlecontainer2">
            <div class="cardtitle2">Bedroom</div>
            <a href="/php%20tuto/shop.php" class="cardbutton">
              Shop Now <img src="img/arrow.svg" alt="arrow" />
            </a>
          </div>
          <div class="imgcontainer2">
            <img src="img/9jar.svg" width="350" alt="chair" />
          </div>
        </div>
        <div class="card3">
          <div class="cardtitlecontainer2">
            <div class="cardtitle2">Kitchen</div>
            <a href="/php%20tuto/shop.php" class="cardbutton">
              Shop Now <img src="img/arrow.svg" alt="arrow" />
            </a>
          </div>
          <div class="imgcontainer2">
            <img src="img/toast.svg" width="320" alt="chair" />
          </div>
        </div>
      </div>
    </section>
      <!-- Products Section -->
      <section class="Products">
        <div class="section1">
          <div class="newarrivals">New Arrivals</div>
          <a href="/php%20tuto/shop.php" class="cardbutton2">
              Shop Now <img src="img/arrow.svg" alt="arrow" />
            </a>
        </div>
     
        <div class="section1">
          <div class="products_container">
            <?php generateProductCards($pdo); ?> 
          </div>
        </div>
        <div class="section2">
          <div class="offres">
            <img src="img/offre1.svg" width="60" alt="chair" />
            <div class="offrestitle">Free Shipping</div>
            <div class="offressubtitle">On all orders over 100dt</div>
          </div>
          <div class="offres">
            <img src="img/offre2.svg" width="60" alt="chair" />
            <div class="offrestitle">Money-back</div>
            <div class="offressubtitle">30 days guarantee</div>
          </div>
          <div class="offres">
            <img src="img/offre3.svg" width="60" alt="chair" />
            <div class="offrestitle">Secure Payments</div>
            <div class="offressubtitle">Secured by Stripe</div>
          </div>
          <div class="offres">
            <img src="img/offre4.svg" width="60" alt="chair" />
            <div class="offrestitle">24/7 Support</div>
            <div class="offressubtitle">OPhone and Email support</div>
          </div>
        </div>

     </section>
     
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
  <script>
   
   function addToCart(productId) {
    // Send AJAX request to add_to_cart.php
   
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "includes/add_to_cart.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle response
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                // Product added successfully
                updateCart();
            } else {
                // User is not logged in
                window.location.href = "/php%20tuto/login.php";
            }
        }
    };
    xhr.send("product_id=" + productId);


  }
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

   let menu = document.querySelector(".menu-icon");
   let navlist = document.querySelector(".navlist");
   menu.onclick = () => {
     navlist.classList.toggle("open");
   };
   navlist.onclick = () => {
     navlist.classList.toggle("open");
   };


   let cartCloser = document.querySelector(".cart-closing-button");
   let cartOpener = document.getElementById("openCart");
   let cart = document.querySelector(".cart");
   
   let toggled = false;
   cartOpener.onclick = () => {
     //document.querySelector(".cart").style.display = "block";
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


   // Get the toast element
   var toast = document.getElementById("toast");

   // Function to hide the toast after 4 seconds
   setTimeout(function () {
     toast.remove();
   }, 4000);

   function dismissSuccessMessage(){
      document.getElementById("success-message-container").style.display = "none";
    }
 </script>
</html>
