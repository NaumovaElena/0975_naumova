<?php
//в хэдере открываем сессию
session_start();
//в хэдере отправляем требования по кодировке из браузера на сервер
header('Content-Type: text/html; charset=utf-8');


$mysqli = mysqli_connect("localhost", "qfktpikp_0975", "123456", "qfktpikp_0975");
if ($mysqli == false) {
// в php для конкатенации используется точка .
  print("error" . mysqli_connect_error());
} else {
  //print("Соединение установлено успешно");
  //trim - обрезка пробелов, mb_strtolower - понижение регистра.
  $email = trim(mb_strtolower($_POST["email"]));
  $pass = trim($_POST["pass"]);

  
  $result = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email'");
  //нужно преобразовать в ассоциативный массив, т.е. объект, у которого есть ключи
  
  $result = $result->fetch_assoc();
  //var_dump($result["pass"]);
  
  if (password_verify($pass, $result["pass"])) {
    echo "ok";
    $_SESSION["name"] = $result["name"];
    $_SESSION["lastname"] = $result["lastname"];
    $_SESSION["email"] = $result["email"];
    $_SESSION["id"] = $result["id"];
  } else {
    echo "not_found";
  }
}

