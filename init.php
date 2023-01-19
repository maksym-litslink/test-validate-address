<?php

require_once __DIR__ . '/src/database.php';

if (PHP_SAPI !== 'cli') {
    die('should be only in cli');
}

$conn = Database::getInstance()->getConn();

$result = $conn->query('SHOW TABLES LIKE \'addresses\'');
if ($result->rowCount() === 1) {
    echo 'Table exists' . PHP_EOL;
    return;
}

$conn->exec('DROP TABLE IF EXISTS `addresses`');
$conn->exec(<<<'SQL'
CREATE TABLE `addresses` (
    id INT PRIMARY KEY AUTO_INCREMENT,
    addressLine1 VARCHAR(255) NOT NULL,
    addressLine2 VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    state VARCHAR(2) NOT NULL,
    zip VARCHAR(10) NOT NULL
);
SQL
);

echo 'Completed' . PHP_EOL;
