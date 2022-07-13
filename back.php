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

switch (strtolower($_SERVER['REQUEST_METHOD'])) {
    case 'get':
        $sql = 'SELECT `id_per`,`name_per`, `lastname_per`, `datebirth_per`, `address_per`, `phone_per`, `email_per` FROM `persons`';
        try {
            $result = $conn->query($sql, PDO::FETCH_ASSOC);
            echo json_encode($result->fetchAll());
        } catch (PDOException $exception) {
            http_response_code(500);
            die("Error:" . $exception->getMessage());
        }
        break;

    case 'post':
        $sql = 'INSERT INTO persons(name_per,lastname_per,datebirth_per,address_per,phone_per,email_per) VALUES (:name_per, :lastname_per, :datebirth_per, :address_per, :phone_per, :email_per)';
        $result = $conn->prepare($sql);
        try {
            $result->execute([
                'name_per' => $_POST['name_per'],
                'lastname_per' => $_POST['lastname_per'],
                'datebirth_per' => $_POST['datebirth_per'],
                'address_per' => $_POST['address_per'],
                'phone_per' => $_POST['phone_per'],
                'email_per' => $_POST['email_per'],
            ]);
            echo $conn->lastInsertId();
        } catch (PDOException $exception) {
            http_response_code(500);
            die($exception->getMessage());
        }
        break;

    case 'delete':
        if (empty($id_per = filter_input(INPUT_GET, 'id_per'))) {
            http_response_code(400);
            die;
        }
        $sql = "DELETE FROM persons WHERE id_per = :id_per";
        $st = $conn->prepare($sql);
        try {
            $st->execute([
                'id_per' => $id_per,
            ]);
        } catch (Exception $exception) {
            http_response_code(500);
        }
        break;

    case 'put':
        if (empty($id_per = filter_input(INPUT_GET, 'id_per'))) {
            http_response_code(400);
            die;
        }
        parse_str(file_get_contents('php://input'), $_POST);
        if (empty($_POST['name_per']) || empty($_POST['lastname_per']) || empty($_POST['datebirth_per']) || empty($_POST['address_per']) || empty($_POST['phone_per']) || empty($_POST['email_per'])) {
            http_response_code(400);
            die;
        }
        $sql = 'UPDATE persons SET name_per=:name_per,lastname_per=:lastname_per,datebirth_per=:datebirth_per,address_per=:address_per,phone_per=:phone_per,email_per=:email_per WHERE id_per=:id_per';
        $result = $conn->prepare($sql);
        try {
            $result->execute([
                'name_per' => $_POST['name_per'],
                'lastname_per' => $_POST['lastname_per'],
                'datebirth_per' => $_POST['datebirth_per'],
                'address_per' => $_POST['address_per'],
                'phone_per' => $_POST['phone_per'],
                'email_per' => $_POST['email_per'],
                'id_per' => $id_per,
            ]);
            http_response_code(200);
        } catch (PDOException $exception) {
            http_response_code(500);
            die($exception->getMessage());
        }
        break;
}
