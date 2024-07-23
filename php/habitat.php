<?php
header("Access-Control-Allow-Origin: http://zoo-project.en.gp");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: *");

require_once 'pdo.php';
require_once 'session.php';

function getAllHabitatData(PDO $pdo)
{
    try {
        $query = $pdo->prepare("SELECT * FROM habitat ORDER BY idhabitat desc ".(isset($_GET["limit"]) ? 'LIMIT '.intval($_GET["limit"]): ''));
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

    $habitat=[];
        foreach ($result as $row) {
            $habitat[$row['idhabitat']]=$row;
            if (empty($row['image'])) {
                $row['image'] = '..\src\assets\Leonardo_Diffusion_XL_car_logo_in_orange_for_website_3.jpg';
            }
        }

        return $habitat;
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
$action=$_GET["action"];
if ($_GET["action"] == "afficher_habitat") {
if(isset($_GET["filter"])) {
    $data = getAllFilterData($pdo);
} else {
  $data = getAllHabitatData($pdo);
}

header('Content-Type: application/json');
echo json_encode($data);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom= $_POST['prenom'];
    $etat=$_POST['etat'];
    $description=$_POST['description'];
    $mode_de_vie = $_POST['mode_de_vie'];
    $information=$_POST['information'];
    $habitat_idhabitat=$_POST['habitat_idhabitat'];
     
    if ($_FILES["image"]["error"] > 0) {
        echo "Erreur lors du téléchargement: " . $_FILES["image"]["error"];
    } else {
        $uploadDirectory = "../src/assets/";

        $fileName = $_FILES["image"]["name"];
        $image =  "/src/assets/$fileName";
        $destination = $uploadDirectory . $fileName;

        move_uploaded_file($_FILES["image"]["tmp_name"], $destination)
        ;
    }
    $stmt = $pdo->prepare("INSERT INTO animal (prenom, etat, description, mode_de_vie, information, habitat_idhabitat ) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$prenom, $etat, $description, $mode_de_vie,$information,$habitat_idhabitat ]);
    
    if ($stmt->rowCount()) {
        echo json_encode(array("status" => "success", "message" => "Données du formulaire insérées avec succès"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Erreur lors de l'insertion des données du formulaire : " . $stmt->errorInfo()));
    }

    
} 
} elseif ($action === "modifier_habitat") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["idhabitat"])) {
           
            $stmt = $pdo->prepare("UPDATE habitat SET `nom` = ?,`description`=?,
              `commentaire` = ?
              WHERE
              idhabitat = ?");
            
            $stmt->execute([
                $_POST["nom"],
                $_POST["description"],
                $_POST["commentaire"],
                $_POST["idhabitat"],
            ]);
    
            if ($stmt->rowCount()) {
                echo json_encode(array("status" => "success", "message" => "Données du formulaire mises à jour avec succès"));
            } else {
                echo json_encode(array("status" => "error", "message" => "Erreur lors de la mise à jour des données du formulaire : " . json_encode($stmt->errorInfo())));
            }
        } else {
            echo json_encode(array("status" => "error", "message" => "Vehicules_id non fourni dans la requête POST"));
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "Requête invalide"));
    }
} elseif ($action === "supprimer_animaux") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
   

        $stmt = $pdo->prepare("DELETE FROM vehicules  WHERE vehicules_id = ? ");
        $stmt->execute([$_POST["vehicules_id"]]);
        
        if ($stmt->rowCount()) {
            echo json_encode(array("status" => "success", "message" => "Données du formulaire insérées avec succès"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Erreur lors de l'insertion des données du formulaire : " . $stmt->errorInfo()));
        }
    
        
    } else {
        echo json_encode(array("status" => "error", "message" => "Requête invalide"));
    }
}elseif ($action === "administration_habitat") {
    $habitat=$pdo->query("SELECT * FROM habitat")->fetchAll(PDO::FETCH_ASSOC);


    die(json_encode(array(
        "status" => true,
        "message" => "les habitats ont été récupéré",
        "habitat" =>$habitat,
     )));
}elseif ($action === "get_habitat") {
    $habitat=$pdo->query("SELECT * FROM habitat")->fetchAll(PDO::FETCH_ASSOC);


    die(json_encode(array(
        "status" => true,
        "message" => "les habitats ont été récupéré",
        "habitat" =>$habitat,
     )));
}
