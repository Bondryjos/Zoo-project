<?php
header("Access-Control-Allow-Origin: http://zoo-project.en.gp");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: *");

require_once 'pdo.php';

function getAllServiceData(PDO $pdo)
{
    try {
        $query = $pdo->prepare("SELECT * FROM `service`, `image` WHERE `service`.idimage = `image`.`idimage` GROUP BY `service`.`idservice` ".(isset($_GET["limit"]) ? 'LIMIT '.intval($_GET["limit"]): ''));
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

    $habitat=[];
        foreach ($result as $row) {
            $habitat[$row['idservice']]=$row;
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
if ($_GET["action"] == "afficher_service") {
  $data = getAllServiceData($pdo);
  header('Content-Type: application/json');
echo json_encode($data);
}




if ($_GET["action"] == "ajouter_service") {
    $titre=$_POST['titre'];
    $description=$_POST['description'];
    $type=$_POST['type'];
     
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
    $stmt = $pdo->prepare("INSERT INTO image (image_slide) VALUES (?)");
    $stmt->execute([$image]);
    $idimage = $pdo->lastInsertId();
    $stmt = $pdo->prepare("INSERT INTO service (idservice, titre, description, idimage, type ) VALUES (null, ?, ?, ?, ?)");
    $stmt->execute([ $titre, $description, $idimage,$type ]);
    
    if ($stmt->rowCount()) {
        echo json_encode(array("status" => "success", "message" => "Données du formulaire insérées avec succès"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Erreur lors de l'insertion des données du formulaire : " . $stmt->errorInfo()));
    }

    

} elseif ($action === "modifier_service") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["idservice"])) {
            if ($_FILES["image"]["error"] > 0) {
               $image=null;
            } else {
                $uploadDirectory = "../src/assets/";
        
                $fileName = $_FILES["image"]["name"];
                $image =  "/src/assets/$fileName";
                $destination = $uploadDirectory . $fileName;
        
                move_uploaded_file($_FILES["image"]["tmp_name"],
                 $destination)
                ;
            }
            $stmt = $pdo->prepare("INSERT INTO image (image_slide) VALUES (?)");
            $stmt->execute([$image]);
            $idimage = $pdo->lastInsertId();
           
            $stmt = $pdo->prepare("UPDATE service SET `idimage`=?,
            `titre`=?,`description`=?,`type`=?
            
              WHERE
              idservice = ?");
            
            $stmt->execute([
                
                $idimage,
                $_POST["titre"],
                $_POST["description"],
                $_POST["type"],
                $_POST["idservice"]
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
} elseif ($action === "supprimer_service") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
   

        $stmt = $pdo->prepare("DELETE FROM service  WHERE idservice = ? ");
        $stmt->execute([$_POST["idservice"]]);
        
        if ($stmt->rowCount()) {
            echo json_encode(array("status" => "success", "message" => "Données du formulaire insérées avec succès"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Erreur lors de l'insertion des données du formulaire : " . $stmt->errorInfo()));
        }
    
        
    } else {
        echo json_encode(array("status" => "error", "message" => "Requête invalide"));
    }
}elseif ($action === "administration_service") {
    $service=$pdo->query("SELECT * FROM service")->fetchAll(PDO::FETCH_ASSOC);


    die(json_encode(array(
        "status" => true,
        "message" => "les avis ont été récupéré",
        "service" =>$service,
     )));
}
