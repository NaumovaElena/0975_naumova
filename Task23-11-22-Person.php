<?php

class Person {
    // инкапсуляция
private $name;
private $lastname;
private $age;
private $hp;
private $mother;
private $father;

function __construct($name, $lastname, $age, $mother=null, $father=null) {
    $this->name = $name;
    $this->lastname = $lastname;
    $this->age = $age;
    $this->mother = $mother;
    $this->father = $father;
    $this->hp = 100;

}
function sayHi($name) {
    return "Hi, $name, I'm " . $this->name;

}
function setHp($hp) {
    if ($this->hp + $hp >=100) $this->hp = 100;
    else $this->hp = $this->hp + $hp;

}

function getHp() {
    return $this->hp;
}
function getName() {
    return $this->name;
}
function getLastname() {
    return $this->lastname;
}
function getMother() {
    return $this->mother;
}
function getFather() {
    return $this->father;
}
function getInfo() {
    return "
    <h2>A few words about myself.</h2><br>
    " . "My name: " . $this->getName() . " " . $this->getLastname() . 
    "<br><hr> My father: " . $this->getFather()->getName() . " " . $this->getFather()->getLastname() .
    "<br> My mother: " . $this->getMother()->getName() . " " . $this->getMother()->getLastname() . 
    "<br><hr> My paternal grandfather: " . $this->getFather()->getFather()->getName() . " " . $this->getFather()-> getFather()->getLastname() . 
    "<br> My paternal grandmother: " . $this->getFather()->getMother()->getName() . " " . $this->getFather()-> getMother()->getLastname() .
    "<br><hr> My maternal grandfather: " . $this->getMother()->getFather()->getName() . " " . $this->getMother()-> getFather()->getLastname() .
    "<br> My maternal grandmother: " . $this->getMother()->getMother()->getName() . " " . $this->getMother()-> getMother()->getLastname() . "<hr>"
    ;
 }
}

// ! Здоровье человека не может быть более 100 единиц
// родители матери
$igor = new Person("Igor", "Petrov", 78);
$natalia = new Person("Natalia", "Petrova", 77);
// родители отца
$oleg = new Person("Oleg", "Ivanov", 79);
$irina = new Person("Irina", "Ivanova", 79);
// родители
$alex = new Person("Alex", "Ivanov", 42, $irina, $oleg);
$olga = new Person("Olga", "Ivanova", 42, $natalia, $igor);
$valera = new Person("Valera", "Ivanov", 15, $olga, $alex);

// echo $valera->getName();
// echo $valera->getMother()->getName();
// echo $valera->getMother()->getFather()->getName();
echo $valera->getInfo();

// $medKit = 50;
// //$alex->hp = $alex->hp - 30; //Упал
// $alex->setHp(-30);

// //echo $alex->hp . "<br>";
// echo $alex->getHp() . "<br>";
// //$alex->hp = $alex->hp + $medKit; //нашел аптечку
// $alex->setHp($medKit);
// //echo $alex->hp;
// echo $alex->getHp();


// echo $alex->name;
//echo $alex->sayHi($igor->name);