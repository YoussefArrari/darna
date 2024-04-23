<?php
require_once "includes/dbh.inc.php";
require_once 'includes/is_loged_in.php';
require_once 'includes/config_session.inc.php';
require_once 'includes/cart.inc.php';
  


?>
 

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/contact.css" />
    <title>shop</title>
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
          <button class="view-cart">View Cart</button>
        </div>
      </div>
  
  </section>
    <main>
    
        <div class="header" >
            <div class="h1">We believe in sustainable decor. We’re passionate about life at home.</div>
            <p class="subheader">Our features timeless furniture, with natural fabrics, curved lines, plenty of mirrors and classic design, which can be incorporated into any decor project. The pieces enchant for their sobriety, to last for generations, faithful to the shapes of each period, with a touch of the present</p>
        </div>
        <div class="contactUs">
            <div class="contactUsTitle">Contact Us</div>
            <div class="contact-us-boxes">
                <div class="box">
                    <img src="img/phone.svg" alt="phone" width="40" height="40" />
                    <div class="box-title">PHONE</div>
                    <div class="box-content">+214 54 770 766</div>
                </div>
                <div class="box">
                    <img src="img/house.svg" alt="phone" width="40" height="40" />
                    <div class="box-title">ADRESS</div>
                    <div class="box-content">234 Hai Trieu, Ho Chi Minh City,Viet Nam</div>
                </div>
                <div class="box">
                    <img src="img/email.svg" alt="phone" width="40" height="40" />
                    <div class="box-title">EMAIL</div>
                    <div class="box-content">hello@darna.com</div>
                </div>
            </div>

            <div class="fontAndimgContainer">
                
                <div class="formContainer">
                    <form action="includes/contact.inc.php" method="post">
                        <div class="formTitle">Send us a message</div>
                        <?php
                              // Check if the URL parameter 'success' is set and its value is 'message_sent'
                              if (isset($_GET['success']) && $_GET['success'] === 'message_sent') {
                                // Display a success message
                                echo '<div class="success-message">Your message has been sent successfully!</div>';
                            } elseif (isset($_GET['error'])) {
                                // Display an error message if 'error' parameter is set
                                $error_message = htmlspecialchars($_GET['error']);
                                echo '<div class="error-message">' . $error_message . '</div>';
                            } 
                              ?>
                        <div class="formInput">
                            <div class="inputTitle">Full Name</div>
                            <input type="text" name="name" placeholder="Name" />
                            <div class="inputTitle ">Email</div>
                            <input type="email" name="email" placeholder="Email" />
                            <div class="inputTitle ">Message</div>
                            <textarea name="message" placeholder="Message"></textarea>
                            <button type="submit" name="submit" class="submit">Send</button>
                        </div>
                    </form>
                </div>
                <div class="imgContainer">
                    <img src="img/contactUs.svg" alt="contactUs" width="600" height="600" />
                </div>
            </div>
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
