<?php

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    'lifetime' => 3600,
    'path' => '/',
    'domain' => 'localhost',
    'secure' => true,
    'httponly' => true
]);
session_start();

if(!isset($_SESSION['last_regenerate'])) {
    regenrate_session_id();
}else{
    $interval = 60 * 30;
    if(time() - $_SESSION['last_regenerate'] >= $interval) {
        regenrate_session_id();
    };
}

function regenrate_session_id(){
    session_regenerate_id(true);
    $_SESSION['last_regenerate'] = time();
}