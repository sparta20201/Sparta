<?php

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'sparta_city';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;charset=utf8", $username, $password); 
  //array para trabajar con caracteres array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\'')
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}

?>