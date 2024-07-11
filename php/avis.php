<?php
header("Access-Control-Allow-Origin: http://zoo-project.local:4000");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: *");
require_once 'pdo.php';
$VerifyEmploye = true;
$VerifyAcces = true;

$errors = [];
// Code pour admin
if ($_GET["action"] == "afficher_accueil") {
    function getAllAvisData(PDO $pdo)
    {
        try {
            $query = $pdo->prepare("SELECT * FROM avis Where `verification`
            = 1 ORDER BY idavis desc limit 3 ");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);


            return $result;
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    $data = getAllAvisData($pdo);
    foreach ($data as $index => $avis) {
        foreach ($avis as $nom => $valeur) {
            // $avis[$nom] = htmlentities($valeur);
        }
        // $data[$index] = $avis;
    }
    header('Content-Type: application/json');
    echo json_encode($data);
} else if ($_GET["action"] == "envoyer") {
    if (
        $_SERVER["REQUEST_METHOD"] == "POST"
        && isset($_POST['AvisUsers'])
    ) {
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        if (strlen($nom) > 30 || strlen($nom) < 2) {
            die(json_encode(array("status" => "error", "message" => "nombre de charactère insuffisant")));
        } elseif (strlen($description) > 250 || strlen($description) < 40) {
            die(json_encode(array("status" => "error", "message" => "nombre de charactère insuffisant")));
        }
        $stmt = $pdo->prepare("INSERT INTO avis (nom, description)
        VALUES (?, ?)");
        $stmt->execute([$nom, $description]);

        if ($stmt->rowCount()) {
            echo json_encode(array("status" => "success", "message" => "Données du formulaire insérées avec succès"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Erreur lors de l'insertion des données du formulaire : " . $stmt->errorInfo()));
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "Requête invalide"));
    }
} else if ($_GET["action"] == "verifier") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        $stmt = $pdo->prepare("UPDATE avis SET `verification`
         = true WHERE idavis = ? ");
        $stmt->execute([$_POST["idavis"]]);

        if ($stmt->rowCount()) {
            echo json_encode(array("status" => "success", "message" => "Données du formulaire insérées avec succès"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Erreur lors de l'insertion des données du formulaire : " . $stmt->errorInfo()));
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "Requête invalide"));
    }
} else if ($_GET["action"] == "avis_admin") {
    $data = $pdo->query("SELECT * FROM avis")->fetchAll(PDO::FETCH_ASSOC);

    foreach ($data as $index => $avis) {
        foreach ($avis as $nom => $valeur) {
            // $avis[$nom] = htmlentities($valeur);
        }
        //$data[$index] = $avis;
    }

    die(json_encode(array(
        "status" => true,
        "message" => "les avis ont été récupéré",
        "avis" => $data,
    )));
} else if ($_GET["action"] == "delete_avis") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
   

        $stmt = $pdo->prepare("DELETE FROM avis  WHERE avis_id = ? ");
        $stmt->execute([$_POST["avis_id"]]);
        
        if ($stmt->rowCount()) {
            echo json_encode(array("status" => "success", "message" => "Données du formulaire insérées avec succès"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Erreur lors de l'insertion des données du formulaire : " . $stmt->errorInfo()));
        }
    
        
    } else {
        echo json_encode(array("status" => "error", "message" => "Requête invalide"));
    }
    
}
