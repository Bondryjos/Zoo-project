<?php
header("Access-Control-Allow-Origin: http://zoo-project.local:4000");
header('Content-Type: application/json');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
require 'vendor/autoload.php';
require_once 'pdo.php';


function insertHoraire($lundi,$mardi,$mercredi,$jeudi,$vendredi, $samedi) {
    $db = getDb();
    $collection = $db->selectCollection('horaire');
    
    $document = [
        'lundi' => $lundi,
        'mardi' => $mardi,
        'mercredi' => $mercredi,
        'jeudi' => $jeudi,
        'vendredi' => $vendredi,
        'samedi' => $samedi,
        'created_at' => new MongoDB\BSON\UTCDateTime()
    ];
    
    $collection->insertOne($document);
}
function getHoraire() {
    $db = getDb();
    $collection = $db->selectCollection('horaire');
    return $collection->findOne();
}
$action = isset($_GET["action"]) ? $_GET["action"] : null;

if ($action === "get_horaire") {
$horaire = getHoraire();
unset($horaire['_id'],$horaire['created_at']);
echo json_encode($horaire);
}else if ($action === "create_horaire") {
$lundi = $mardi = $jeudi = $vendredi = "07:00 - 18:00";
$mercredi = '09:00 - 17:00';
$samedi = '08:00 -12:00';

insertHoraire($lundi,$mardi,$mercredi,$jeudi,$vendredi, $samedi);

echo "Les horaires ont été insérés avec succès.";
}
?>
