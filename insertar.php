<?php
require_once "conexion.php";

$name_per = $_POST["nameper"];
$lastname_per = $_POST["lastnameper"];
$datebirth_per = $_POST["datebirthper"];
$address_per = $_POST["addressper"];
$phone_per = $_POST["phoneper"];
$email_per = $_POST["emailper"];

try {
    $sql = "INSERT INTO persons(name_per,lastname_per,datebirth_per,address_per,phone_per,email_per) VALUES ('$name_per','$lastname_per','$datebirth_per','$address_per','$phone_per','$email_per')";

    $consulta = $conn->query($sql, PDO::FETCH_ASSOC);
    header("Location: front.php");
} catch (\Throwable $th) {
    echo $th->getMessage();
}
