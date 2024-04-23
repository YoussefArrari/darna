<?php
  session_start();
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/sheet.css">
    <title>Document</title>
  </head>

  <body>
    <main class="main">
      <form action="../includes/formhandler.inc.php" method="post">
        <label for="username">username</label>
        <input type="text" name="username" id="username">

        <label for="email">email</label>
        <input type="text" name="email" id="email">
      
        <label for="password">password</label>
        <input type="text" name="password" id="password">

        <button type="submit" name="submit">Submit</button>


      </form>
    </main>
    <button><a href="login.php">Go to formhandler</a></button>
  </body>

  </html>