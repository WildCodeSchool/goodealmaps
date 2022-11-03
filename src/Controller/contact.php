<?php

use App\Model\ContactController;

if (isset($_POST["message"])) {
    $message = "Message envoyé depuis la page contact de goodealmap
    Nom : " . $_POST["lname"] . "
    Prenom : " . $_POST["fname"] . "
    Email : " . $_POST["email"] . "
    Sujet : " . $_POST["sujet"] . "
    Message :" . $_POST["subject"];

    $retour = mail(
        "alexandremathieu1706@gmail.com",
        $_POST["sujet"],
        $message,
        "From:contact@exemplemail.fr" . "\r\n" . "Reply-to:" . $_POST["email"]
    );
    if ($retour) {
        echo "<p>Email bien envoyé.</p>";
    }
}
