<?php

if (false === isset($_POST['addressLine1'], $_POST['addressLine2'], $_POST['city'], $_POST['state'], $_POST['zip'])) {
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Invalid Request']);
    exit;
}
try {
    require_once __DIR__.'/../src/database.php';

    $conn = Database::getInstance()->getConn();

    $stmt = $conn->prepare(<<<'SQL'
        INSERT INTO `addresses` (`addressLine1`, `addressLine2`, `city`, `state`, `zip`)
        VALUES (:addressLine1, :addressLine2, :city, :state, :zip)
SQL
    );
    $stmt->bindParam(':addressLine1', $_POST['addressLine1']);
    $stmt->bindParam(':addressLine2', $_POST['addressLine2']);
    $stmt->bindParam(':city', $_POST['city']);
    $stmt->bindParam(':state', $_POST['state']);
    $stmt->bindParam(':zip', $_POST['zip']);
    $stmt->execute();

    header('Content-Type: application/json');
    echo json_encode(['saved' => true]);
} catch (PDOException $e) {
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Database Error']);
} catch (Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}
