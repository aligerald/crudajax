<?php

$host = 'localhost';
$username = 'root';
$password = '1521';
$dbname = 'poocrud';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // echo "Conexión Exitosa";
} catch (PDOException $exception) {
    die("Conexión Fallida:" . $exception->getMessage());
}
