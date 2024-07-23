<?php
header("Access-Control-Allow-Origin: http://zoo-project.en.gp");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: *");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['titre'] ?? '';
    $prenom = $_POST['message'] ?? '';
    $email = $_POST['email'] ?? '';
    $errors = [];

    if (strlen($nom) > 30 || strlen($titre) < 2) {
        $errors[] = "Nombre de caractères du nom insuffisant";
    }

    if (strlen($prenom) > 30 || strlen($message) < 2) {
        $errors[] = "Nombre de caractères du prénom insuffisant";
    }

    if (strlen($email) > 250 || strlen($email) < 10) {
        $errors[] = "Nombre de caractères de l'email insuffisant";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email invalide";
    }


    if (empty($errors)) {
        $recipients = ['employee1@example.com', 'employee2@example.com', 'admin@example.com'];
        $subject = "Nouveau formulaire soumis par $titre";
        $body = "
            <html>
            <head>
                <title>$subject</title>
            </head>
            <body>
                <p><strong>Nom:</strong> $titre</p>
                <p><strong>Message:</strong> $message</p>
                <p><strong>Email:</strong> $email</p>
            </body>
            </html>
        ";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: $email" . "\r\n";

        $mailSuccess = true;
        foreach ($recipients as $recipient) {
            if (!mail($recipient, $subject, $body, $headers)) {
                $mailSuccess = false;
                break;
            }
        }

        if ($mailSuccess) {
            echo json_encode(["status" => "success", "message" => "Formulaire soumis et email envoyé avec succès"]);
        } else {
            echo json_encode(["status" => "success", "message" => "Formulaire soumis, mais l'envoi d'email a échoué"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => implode(", ", $errors)]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Requête invalide"]);
}
?>
