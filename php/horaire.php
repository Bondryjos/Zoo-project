<?php
header("Access-Control-Allow-Origin: http://zoo-project.en.gp");
header('Content-Type: application/json');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
require 'vendor/autoload.php';
require_once 'pdo.php';
require_once 'session.php';

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
}function updateHoraire($lundi, $mardi, $mercredi, $jeudi, $vendredi, $samedi) {
    $db = getDb();
    $collection = $db->selectCollection('horaire');
    
    $result = $collection->findOne();
    if ($result) {
        $collection->updateOne(
            ['_id' => $result['_id']],
            ['$set' => [
                'lundi' => $lundi,
                'mardi' => $mardi,
                'mercredi' => $mercredi,
                'jeudi' => $jeudi,
                'vendredi' => $vendredi,
                'samedi' => $samedi,
                'updated_at' => new MongoDB\BSON\UTCDateTime()
            ]]
        );
    } else {
        insertHoraire($lundi, $mardi, $mercredi, $jeudi, $vendredi, $samedi);
    }
}
$action = isset($_GET["action"]) ? $_GET["action"] : null;

if ($action === "get_horaire") {
$horaire = getHoraire();
unset($horaire['_id'],$horaire['created_at'],$horaire['updated_at']);
echo json_encode($horaire);
}else if ($action === "create_horaire") {
$lundi = $mardi = $jeudi = $vendredi = "07:00 - 18:00";
$mercredi = '09:00 - 17:00';
$samedi = '08:00 -12:00';

insertHoraire($lundi,$mardi,$mercredi,$jeudi,$vendredi, $samedi);

echo "Les horaires ont été insérés avec succès.";
}else if ($action === "update_horaire") {
    $data = json_decode(file_get_contents('php://input'), true);
    if ($data) {
        $lundi = $data['lundi'];
        $mardi = $data['mardi'];
        $mercredi = $data['mercredi'];
        $jeudi = $data['jeudi'];
        $vendredi = $data['vendredi'];
        $samedi = $data['samedi'];
        
        updateHoraire($lundi, $mardi, $mercredi, $jeudi, $vendredi, $samedi);
        
        echo json_encode(["message" => "Les horaires ont été mis à jour avec succès."]);
    } else {
        echo json_encode(["error" => "Données invalides."]);
    }
}
?>
