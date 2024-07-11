<?php
require_once 'config.php';
try {
    $pdo = new PDO("mysql:dbname="._DB_NAME_.";host="._DB_SERVER_.";charset=utf8mb4", _DB_USERS_ , _DB_PASSWORD_);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
function getDb() {
    $username = 'newuser';
    $password = 'Garage15*';
    $host = 'zoo-project.en.gp';
    $port = '27017';
    $database = 'zoo-project';

    $uri = "mongodb://$username:$password@$host:$port";
    
    $client = new MongoDB\Client($uri);

    return $client->selectDatabase($database);
}
?>
