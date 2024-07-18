<?php
header("Access-Control-Allow-Origin: http://zoo-project.local:4000");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: *");

require_once 'pdo.php';

function getAllNourritureData(PDO $pdo)
{
    try {
        $query = $pdo->prepare("SELECT * FROM nourriture ORDER BY idnourriture desc ".(isset($_GET["limit"]) ? 'LIMIT '.intval($_GET["limit"]): ''));
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

    
        foreach ($result as &$row) {
            if (empty($row['image'])) {
                $row['image'] = '..\src\assets\Leonardo_Diffusion_XL_car_logo_in_orange_for_website_3.jpg';
            }
        }

        return $result;
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
function getAllFilterData(PDO $pdo)
{
    try {
        $query = $pdo->prepare("SELECT * FROM `animal`
         WHERE `prix` < :prix AND `kilometrage` < :kilometrage 
         AND `annee_mise_en_circulation` < :annee_mise_en_circulation");
        $query->execute([":prix" => $_GET["prix"], ":kilometrage" => 
        $_GET["kilometrage"], ":annee_mise_en_circulation" => 
        $_GET["annee"]]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

    
        foreach ($result as &$row) {
            if (empty($row['image'])) {
                $row['image'] = '..\src\assets\Leonardo_Diffusion_XL_car_logo_in_orange_for_website_3.jpg';
            }
        }

        return $result;
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}$action = isset($_GET["action"]) ? $_GET["action"] : null;
if ($_GET["action"] == "afficher_nourriture") {
if(isset($_GET["filter"])) {
    $data = getAllFilterData($pdo);
} else {
  $data = getAllNourritureData($pdo);
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
} elseif ($action === "modifier_animaux") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["idanimal"])) {
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
           
            $stmt = $pdo->prepare("UPDATE animal SET `prenom` = ?,`image`
             = COALESCE(?, image), `annee_mise_en_circulation` = ?, 
             `kilometrage` = ?, `titre` = ?, `description` = ? WHERE
              vehicules_id = ?");
            
            $stmt->execute([
                $_POST["prenom"],
                $image,
                $_POST["annee_mise_en_circulation"],
                $_POST["kilometrage"],
                $_POST["titre"],
                $_POST["description"],
                $_POST["vehicules_id"]
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
   

        $stmt = $pdo->prepare("DELETE FROM animal  WHERE idanimal = ? ");
        $stmt->execute([$_POST["idanimal"]]);
        
        if ($stmt->rowCount()) {
            echo json_encode(array("status" => "success", "message" => "Données du formulaire insérées avec succès"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Erreur lors de l'insertion des données du formulaire : " . $stmt->errorInfo()));
        }
    
        
    } else {
        echo json_encode(array("status" => "error", "message" => "Requête invalide"));
    }
}elseif ($action === "administration_nourriture") {
    $nourriture=$pdo->query("SELECT * FROM nourriture")->fetchAll(PDO::FETCH_ASSOC);


    die(json_encode(array(
        "status" => true,
        "message" => "la nourriture a été récupéré",
        "nourriture" =>$nourriture,
     )));
}elseif ($action === "count_animal") {
    $db = getDb();
    $animal = $pdo->query("SELECT count(*) FROM `animal` WHERE `idanimal` = ".intval($_GET["animal"]))->fetchColumn(0);  
    $collection = $db->selectCollection('count_animal');
    if ($animal==0){echo 'animal introuvable';}
   else { $result = $collection->findOneAndUpdate(
        ['animal' => $_GET["animal"]],
        ['$inc' => ['nombre' => 1]],
        [
            'upsert' => true, 
             ]
    );
    echo 'ok';}
}

 

