<?php
header("Access-Control-Allow-Origin: http://zoo-project.local:4000");
header('Content-Type: application/json');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once 'pdo.php';
require_once 'session.php';


die(json_encode(array(
    "status" => true,
    "message" => "accès autorisé",
    "connecter" => isConnect(),
    "veterinaire" => isVeterinaire(),
    "employe" => isEmploye(),
    "admin" => isAdmin(),
 ))); 