<?php
  require_once 'includes/config_session.inc.php';
  require_once 'includes/login_view.inc.php';
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
    <title>Login</title>
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
            <div class="h1">Sign In</div>
            <div class="p">
              Don't have an account? <a href="/php%20tuto/signup.php">Sign Up</a>
            </div>
            <?php  check_login_errors(); ?>
          </header> 
          <form action="includes/login.inc.php" method="post">
         
            <div class="inputContainer">
              <input
                type="text"
                name="email"
                
                placeholder="Your usernam or email address"
              />

              <input
                type="password"
                name="password"
                
                placeholder="Password"
              />
              <div class="PassLink"><p class="pass">Forgot password ?</p></div>
            </div>
            <button class="submit" type="submit" name="submit">Sign In</button>
          </form>
        </div>
      </div>
    </main>
  </body>
</html>
