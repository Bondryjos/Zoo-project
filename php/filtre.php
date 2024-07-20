<?php
header("Access-Control-Allow-Origin: http://zoo-project.local:4000");
header('Content-Type: application/json');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once 'pdo.php';
require_once 'session.php';

function getAllFilterData(PDO $pdo)
{
    try {
        $params = [];
        $query = 'select * from animal  ';
        if(isset($_GET['habitat'])||isset($_GET['race'])){
            $query.='where (';
        }
        if (isset($_GET['habitat'])) {
            foreach ($_GET['habitat'] as $id => $habitat) {
                $query .= 'habitat_idhabitat =:habitat' . $id . ' or ';
                $params[':habitat' . $id] = $habitat;
            }
            $query = substr($query, 0, strlen($query) - 4) . ')';
            if (isset($_GET['race'])) $query .= 'and(';
        }
        if (isset($_GET['race'])) {
            foreach ($_GET['race'] as $id => $race) {
                $query .= 'race =:race' . $id . ' or ';
                $params[':race' . $id] = $race;
            }
            $query = substr($query, 0, strlen($query) - 4) . ')';
        }
        $query = $pdo->prepare($query);
        $query->execute($params);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);





        return $result;
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}


$data = getAllFilterData($pdo);


header('Content-Type: application/json');
echo json_encode($data);
