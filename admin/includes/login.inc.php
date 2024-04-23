<?php


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try{
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        $errors=[];
        if(is_input_empty($email, $password)) {
            $errors["empty_input"] = "Please fill in all the fields";
        }

        $result = get_admin_user($pdo, $email);
        if(is_email_wrong($result)) {
            $errors["wrong_email"] = "Email not found";
        }

        if(!is_email_wrong($result) && is_password_wrong($password, $result['password'])) {
            $errors["wrong_password"] = "Wrong password";
        }
      

        require_once 'config_session.inc.php';
        if($errors){
            $_SESSION["errors_login"] = $errors;

            header("Location: ../login.php");
            die();
        }
        
        $_SESSION['admin_id'] =  htmlspecialchars($result['id']);

        $_SESSION['last_regenerate'] = time();

        header("Location: ../products.php?");
        $pdo=null;
        $stmt=null;

        die();
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

}else {
    header("Location: ../login.php?ee");
    die();
}