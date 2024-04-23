<?php 

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
  
    try {
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';
       
        $errors=[];
        if(is_input_empty($username, $email, $password)) {
            $errors["empty_input"] = "Please fill in all the fields";
        }
        if(is_email_valid($email)) {
            $errors["invalid_email"] = "Please enter a valid email";
            
        }
        if(is_username_taken($pdo, $username)) {
            $errors["username_taken"] = "Username already taken";
        }
        if(is_email_registered($pdo, $email)) {
            $errors["email_registered"] = "Email already registered";
        }

        require_once 'config_session.inc.php';
        if($errors){
            $_SESSION["errors_signup"] = $errors;
            
            $signupData = [
                'username' => $username,
                'email' => $email
            ];
            $_SESSION["signup_data"] = $signupData;

            header("Location: ../signup.php");
            die();
        }
        create_user($pdo, $username, $email, $password);
        header("Location: ../index.php?signup=success");
       
        $pdo = null;
        $stmt=null;

        die();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

} else {
    header("Location: ../index.php");
}
