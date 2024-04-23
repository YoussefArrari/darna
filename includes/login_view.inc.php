<?php

declare(strict_types=1);

function check_login_errors() {     
    if(isset( $_SESSION["errors_login"] )) {
      $errors= $_SESSION["errors_login"] ;
      
     echo"<div class='error'>";
        foreach($errors as $error) {
            echo "<div>$error</div>";
           
        }
    echo"</div>";
        unset( $_SESSION["errors_login"] );
    }elseif(isset($_GET['login']) && $_GET['login'] == 'success'){
        echo"<div class='signedUp' id='toast'>You have successfully Loged In</div>";

    }
}