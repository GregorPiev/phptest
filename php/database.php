<?php

class Database {

    protected static $db;
    private $connection;
    private $server = Constans::SERVER;
    private $username = Constans::USERNAME;
    private $password = Constans::PASSWORD;
    private $database = Constans::DATABASE;
    private $error = '';

    public function __construct() {
        try {
            $this->connection = new PDO("mysql:host=$this->server;dbname=$this->database", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $ex) {
            echo "Connection Error: " . $ex->getMessage();
        }
    }

    public static function getInstance() {
        if (!self::$db) {
            self::$db = new self();
        }
        return self::$db;
    }

    public function login($email, $pass) {
        try {
            $query = "Select * From `users` Where `email`='$email' ";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            $count = $stmt->rowCount();
            if ($count > 0) {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $row = $stmt->fetch();
                if (password_verify($pass, $row['password'])) {
                    return "Invalid passvord";
                } else {
                    return $row;
                }
            } else {
                return $this->error = "It's provided invalid values";
            }
        } catch (Exception $ex) {
            return $this->error = "Error message: $ex->getMessage()";
        }
    }

    public function testExistUserByPass($user, $pass) {
        $query = "Select * From `users` Where `username`='$user' and `password`='$pass'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }

    public function register($user, $pass, $email) {
        try {
            $password = password_hash($pass, PASSWORD_BCRYPT);
            $hash = md5(rand(0, 1000));

            $query = "insert into users (`username`,`password`,`email`,`hash`) Values (:username,:password,:email,:hash)";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':username', $user);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':hash', $hash);
            $stmt->execute();


            $subject = "Account Verification";
            $message_body = "Hello $user,
                Thank you for signing up!
                Please click this link to activate your account:
                http://localhost/phptest/verify.php?email=$email&hash=$hash";
            $headers = 'From: webmaster@example.com' . "\r\n" .
                    'Reply-To: webmaster@example.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

            //mail($email, $subject, $message_body, $headers);
            return "Success";
        } catch (Exception $ex) {
            return "Error registration: $ex->getMessage()";
        }
    }

    public function getListUsers() {
        try {
            $result = array();
            $query = "Select * From `users`";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            $count = $stmt->rowCount();
            if ($count > 0) {
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                while ($row = $stmt->fetch()) {
                    array_push($result, $row);
                }
                return $result;
            } else {
                return "There were not users";
            }
        } catch (Exception $ex) {
            return "Error: " . $ex->getMessage();
        }
    }

}
