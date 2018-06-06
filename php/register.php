<?php

require './config.php';

if (isset($_SERVER['REQUEST_METHOD']) == 'POST' && $_POST['register'] == 'Send') {
    require_once './database.php';
    $error = array();
    $conn = Database::getInstance();
    if (isset($_POST['username']) && !empty($_POST['username'])) {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    } else {
        array_push($error, "Username is mandatory");
    }

    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS, FILTER_SANITIZE_MAGIC_QUOTES | FILTER_SANITIZE_STRING);
    } else {
        array_push($error, "Password is mandatory");
    }

    if (isset($_POST['email']) && !empty($_POST['email'] && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    } else {
        array_push($error, "Email is mandatory");
    }


    if (count($error) == 0) {
        $cnt = $conn->testExistUserByPass($username, $password);
        if ($cnt > 0) {
            $_SESSION['error'] = "Username is exist yet";
            header("location:../index.php");
        } else {
            $res = $conn->register($username, $password, $email);
            if ($res == 'Success') {
                $_SESSION['username'] = $username;
                header("location: ../success.php");
            } else {
                $_SESSION['error'] = $res;
                header("location: ../index.php");
            }
        }
    } else {
        $_SESSION['error'] = implode("<br />", $error);
        header("location:../index.php");
    }
}


