<?php

function is_logged_in() {
    if(isset($_SESSION['admin_id'])) {
        return true;
    }else {
        return false;
    }
}