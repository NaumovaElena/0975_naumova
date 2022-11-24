<?php

class User {
    //инкапсуляция
    private $name;
    private $lastname;
    private $email;
    private $id;

    //конструктор
    function __construct($id, $name, $lastname, $email) {
        $this->id = $id;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->email = $email;
    }

    //ключ GET, функции, чтобы достучаться и вернуть значения переменных
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getLastname() {
        return $this->lastname;
    }

    function getEmail() {
        return $this->email;
    }
    
    // * Статический метод (функция внутри класса) добавления пользователя в базу данных
    static function addUser($name, $lastname, $email, $pass) {
        global $mysqli;
        $email = trim(mb_strtolower($email));
        $pass = trim($pass);
        $pass = password_hash("$pass", PASSWORD_DEFAULT);
        $result = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email'");
        if ($result->num_rows !== 0) {
            return json_encode(["result"=>"exist"]);

        } else {
            $mysqli->query("INSERT INTO `users`(`name`, `lastname`, `email`, `pass`) VALUES ('$name', '$lastname', '$email', '$pass')");
            return json_encode(["result"=>"success"]);
        }
        //var_dump($mysqli);
        //echo "User added";
    }

    // * Статический метод (функция внутри класса) авторизации пользователя
    static function authUser($email, $pass) {
        global $mysqli;
        $email = trim(mb_strtolower($_POST["email"]));
        $pass = trim($_POST["pass"]);
        
        $result = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email'");

        $result = $result->fetch_assoc();
        
        if (password_verify($pass, $result["pass"])) {
            return json_encode(["result"=>"ok"]);
           
            $_SESSION["name"] = $result["name"];
            $_SESSION["lastname"] = $result["lastname"];
            $_SESSION["email"] = $result["email"];
            $_SESSION["id"] = $result["id"];
        } else {
           return json_encode(["result"=>"not_found"]);
        }


    }

}