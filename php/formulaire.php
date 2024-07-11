<?php
header("Access-Control-Allow-Origin: http://zoo-project.local:4000");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: *");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';
    $gsm = $_POST['gsm'] ?? '';
    $message = $_POST['message'] ?? '';

    $errors = [];

    if (strlen($nom) > 30 || strlen($nom) < 2) {
        $errors[] = "Nombre de caractères du nom insuffisant";
    }

    if (strlen($prenom) > 30 || strlen($prenom) < 2) {
        $errors[] = "Nombre de caractères du prénom insuffisant";
    }

    if (strlen($email) > 250 || strlen($email) < 10) {
        $errors[] = "Nombre de caractères de l'email insuffisant";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email invalide";
    }

    if (strlen($gsm) > 20 || strlen($gsm) < 6) {
        $errors[] = "Nombre de caractères du GSM insuffisant";
    }

    if (strlen($message) > 550 || strlen($message) < 40) {
        $errors[] = "Nombre de caractères du message insuffisant";
    }

    if (empty($errors)) {
        $recipients = ['employee1@example.com', 'employee2@example.com', 'admin@example.com'];
        $subject = "Nouveau formulaire soumis par $prenom $nom";
        $body = "
            <html>
            <head>
                <title>$subject</title>
            </head>
            <body>
                <p><strong>Nom:</strong> $nom</p>
                <p><strong>Prénom:</strong> $prenom</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>GSM:</strong> $gsm</p>
                <p><strong>Message:</strong> $message</p>
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
