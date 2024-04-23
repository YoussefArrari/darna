<?php

declare(strict_types=1);

function signup_input(){

    if(isset($_SESSION["signup_data"]["username"]) && !isset($_SESSION["errors_signup"]["username_taken"])) {
       echo "<input type='text' name='username'  placeholder='Name' value='".$_SESSION["signup_data"]["username"]."' />";
    }else {
        echo "<input type='text' name='username'  placeholder='Name'  />";
    }
    if(isset($_SESSION["signup_data"]["email"]) && !isset($_SESSION["errors_signup"]["email_registered"])) {
        echo "<input type='text' name='email'  placeholder='Email address' value='".$_SESSION["signup_data"]["email"]."' />";
    }else {
        echo "<input type='text' name='email'  placeholder='Email address' />";
    }
    echo "<input type='password' name='password'  placeholder='Password' />";
}

function check_signup_errors() {
    if(isset($_SESSION['errors_signup'])) {
      $errors=$_SESSION['errors_signup'];
     echo"<div class='error'>";
        foreach($errors as $error) {
            echo "<div>$error</div>";
           
        }
    echo"</div>";
        unset($_SESSION['errors_signup']);
       
    }elseif(isset($_GET['signup']) && $_GET['signup'] == 'success'){
        echo"<div class='signedUp' id='toast'>You have successfully signed up</div>";

    }
}
