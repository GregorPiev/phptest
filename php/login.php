<?php

require './config.php';
if (isset($_SERVER['REQUEST_METHOD']) == 'POST' && $_POST['login'] == 'Send') {
    require_once './database.php';
    $error = array();
    $conn = Database::getInstance();
    if (isset($_POST['email']) && !empty($_POST['email'] && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    } else {
        array_push($error, "Email is mandatory");
    }

    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_SANITIZE_MAGIC_QUOTES | FILTER_SANITIZE_STRING);
    } else {
        array_push($error, "Password is mandatory");
    }

    if (count($error) == 0) {
        $res = $conn->login($email, $password);
        if (!is_string($res)) {
            $_SESSION['username'] = $res['username'];
            header("location: ../userslist.php");
        } else {
            $_SESSION['error'] = $res;
            header("location: ../index.php");
        }
    } else {
        $_SESSION['error'] = implode("<br />", $error);
        header("location:../index.php");
    }
}
