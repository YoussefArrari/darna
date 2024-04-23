<?php
  require_once 'includes/config_session.inc.php';
  require_once 'includes/signup_view.inc.php';

  require_once 'includes/is_loged_in.php';

  if(is_logged_in()) {
    header("Location: /php%20tuto/");
    die();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/login.css" />
    <title>Sign Up</title>
  </head>

  <body>
    <main>
      <!-- Image Side -->
      <div class="leftSide">
        <img src="img/chair1.png" alt="login" width="auto" height="auto" />
        <div class="logo">Darna.</div>
      </div>
      <!-- Form Side -->
      <div class="rightSide">
        <div class="formContainer">
          <header>
            <div class="h1">Sign Up</div>
            <div class="p">
              Already have an account? <a href="/php%20tuto/login.php">Sign In</a>
            </div>
            
            <?php  check_signup_errors(); ?>
           
          </header>
          <form action="includes/signup.inc.php" method="post">
            <div class="inputContainer">
             <?php signup_input(); ?>
              <div class="agree">
                <input type="checkbox" name="agree" id="agree" />
                <span
                  >I agree with <span class="terms">Privacy Policy</span> and
                  <span class="terms">Terms of Use</span>
                </span>
              </div>
            </div>
            <button class="submit" type="submit" name="submit">Sign Up</button>
          </form>
        </div>
      </div>
    </main>
   
  </body>
</html>
