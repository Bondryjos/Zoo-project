<?php
header("Access-Control-Allow-Origin: http://zoo-project.local:4000");
header('Content-Type: application/json');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require_once 'pdo.php';

function verifyUserLoginPassword(PDO $pdo, string $email, string $mot_de_passe): array|bool {
    $query = $pdo->prepare("SELECT * FROM personel WHERE email = :email");
    $query->bindValue(":email", $email, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && $mot_de_passe === $user["mot_de_passe"]) {
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
    if (isset($_POST["email"]) && isset($_POST["mot_de_passe"])) {
        $email = $_POST["email"];
        $mot_de_passe = $_POST["mot_de_passe"];

        $user = verifyUserLoginPassword($pdo, $email, $mot_de_passe);
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
} else {
    echo json_encode(["status" => false, "message" => "Action non valide"]);
    exit();
}
?>
