<?php
header("Access-Control-Allow-Origin: http://zoo-project.local:4000");
header('Content-Type: application/json');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once 'pdo.php';

function verifyUserLoginPassword(PDO $pdo, string $nom, string $mot_de_passe): array|bool {
    $query = $pdo->prepare("SELECT * FROM personel WHERE nom = :nom");
    $query->bindValue(":nom", $nom, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($mot_de_passe, $user["mot_de_passe"])) {
        return $user;
    } else {
        return false;
    }
}

session_set_cookie_params([
    'lifetime' => 3600,
    'path' => '/',
    'domain' => _DOMAIN_,
    'secure' => false,
    'httponly' => true,
   
]);

session_start();

$action = isset($_GET["action"]) ? $_GET["action"] : null;

if ($action === "login") {
    if (isset($_POST["nom"]) && isset($_POST["mot_de_passe"])) {
        $nom = $_POST["nom"];
        $mot_de_passe = $_POST["mot_de_passe"];

        $user = verifyUserLoginPassword($pdo, $nom, $mot_de_passe);
        if ($user) {
             session_regenerate_id(true);
            $_SESSION["user"] = $user;
            die(json_encode(array(
                "status" => true,
                "message" => "Authentification réussie",
                "session_id" => session_id()
            )));
        } else {
            die(json_encode(array(
                "status" => false,
                "message" => "Email ou mot de passe incorrect"
            )));
        }
    } else {
        die(json_encode(array(
            "status" => false,
            "message" => "Les champs email et mot de passe sont requis"
        )));
    }
} elseif ($action === "logout") {
    if (isset($_SESSION['user'])) {
        session_destroy();
        echo json_encode(["status" => true, "message" => "Déconnexion réussie"]);
    } else {
        echo json_encode(["status" => false, "message" => "Utilisateur non connecté"]);
    }
    exit();
} elseif ($action === "ajouter_utilisateur") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $mot_de_passe = $_POST['mot_de_passe'];
        $role = $_POST['role'];
    
        if (empty($nom) || empty($email) || empty($mot_de_passe) || empty($role)) {
            echo json_encode(array("status" => "error", "message" => "Tous les champs doivent être remplis."));
            exit();
        }
    
        $hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);
    
        $stmt = $pdo->prepare("INSERT INTO personel (nom, email, mot_de_passe, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nom, $email, $hashed_password, $role]);
    
        if ($stmt->rowCount()) {
            $subject = 'Compte crée';
            $message = "Bonjour voici votre $nom pour vous connecter!";
            $headers = 'From: webmaster@garage.en.gp' . "\r\n" .
            'Reply-To: webmaster@garage.en.gp' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
       
            mail($email, $subject, $message, $headers);
            echo json_encode(array("status" => "success", "message" => "Données du formulaire insérées avec succès"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Erreur lors de l'insertion des données du formulaire."));
        }
    
    } else {
        echo json_encode(array("status" => "error", "message" => "Requête invalide"));
    }
}elseif ($action === "lire_utilisateur") {
    $personel=$pdo->query("SELECT `idpersonel`, `nom`, `email`, `role` FROM personel")->fetchAll(PDO::FETCH_ASSOC);


    die(json_encode(array(
        "status" => true,
        "message" => "les utilisateurs ont été récupéré",
        "personel" =>$personel,
     )));
}elseif ($action === "supprimer_utilisateur") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
   

        $stmt = $pdo->prepare("DELETE FROM personel  WHERE idpersonel = ? ");
        $stmt->execute([$_POST["idpersonel"]]);
        
        if ($stmt->rowCount()) {
            echo json_encode(array("status" => "success", "message" => "Données du formulaire insérées avec succès"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Erreur lors de l'insertion des données du formulaire : " . $stmt->errorInfo()));
        }
    
        
    } else {
        echo json_encode(array("status" => "error", "message" => "Requête invalide"));
    }
}

else {
    echo json_encode(["status" => false, "message" => "Action non valide"]);
    exit();
}

?>
