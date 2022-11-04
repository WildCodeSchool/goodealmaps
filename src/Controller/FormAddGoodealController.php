<?php

namespace App\Controller;

use App\Model\AddGoodealManager;

class FormAddGoodealController extends AbstractController
{
    public function index(): string
    {
        return $this->twig->render('FormAddGoodeal/index.html.twig');
    }

    public function checkForm(array $data): array
    {
        $errors = [];
        $gooDeal = [];

        foreach ($data as $key => $value) {
            $cleanValue = htmlentities(trim($value));
            if ($cleanValue === "") {
                $errors[$key] = "Merci de Remplir le champs $key";
            }
          /*  if ($key === "title" && strlen($cleanValue) > 50) {
                $errors[$key] = "Le nom du Goodeal est trop long, merci de donner un nom plus court à votre Goodeal";
            }
            if ($key === "message" && strlen($cleanValue) > 65535) {
                $errors[$key] = "La description est trop longue, merci de raccourcir la description";
            }
            if ($key === "adress" && strlen($cleanValue) > 255) {
                $errors[$key] = "L'adresse est trop longue, merci de donner une adresse valide";
            }
            if ($key === "city" && strlen($cleanValue) > 100) {
                $errors[$key] = "Le nom de la Ville est trop long, merci d'utiliser un nom de ville valide";
            }
            if ($key === "zipcode" && strlen($cleanValue) > 5) {
                $errors[$key] = "Le Code Postal est trop long, merci d'utiliser un Code Postal valide";
            }
            if ($key === "email" && strlen($cleanValue) > 20) {
                $errors[$key] = "L'email est trop long, merci de fournir une adresse mail plus courte";
            }
            if ($key === "email" && !filter_var($cleanValue, FILTER_VALIDATE_EMAIL)) {
                $errors[$key] = "Adresse mail non valide, merci de fournir une adresse mail valide";
            }
            if ($key === "firstname" && strlen($cleanValue) > 20) {
                $errors[$key] = "Prénom trop long, merci de fournir un prénom plus court";
            }
            if ($key === "lastname" && strlen($cleanValue) > 20) {
                $errors[$key] = "Nom trop long, merci de fournir un prénom plus court";
            }*/
            if (!isset($errors[$key])) {
                $gooDeal[$key] = $cleanValue;
            }
        }

        $checkedData = [
            "errors" => $errors,
            "gooDeal" => $gooDeal
        ];
        return $checkedData;
    }


    public function addGoodeal(): string
    {
        $data = [];
        $checkedData = [];

        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
                $data = [
                "title" => $_POST['deal-name'],
                "lastname" => $_POST['lastname'],
                "firstname" => $_POST['firstname'],
                "category" => $_POST['category'],
                "adress" => $_POST['adress'],
                "region" => $_POST['region'],
                "city" => $_POST['city'],
                "zipcode" => $_POST['zip-code'],
                "start-date" => $_POST['start-date'],
                "end-date" => $_POST['end-date'],
                //"image" => $_POST['avatar'],
                "email" => $_POST['email'],
                "message" => $_POST['description']
                ];

                $checkedData = $this->checkForm($data);

                if (empty($checkedData["errors"])) {
                    $addGoodealManager = new AddGoodealManager();
                    $addGoodealManager->insertGoodeal($checkedData["gooDeal"]);
                    header('Location: /addGoodeal');
                }
        }
           // Generate the web page

               return $this->twig->render('FormAddGoodeal/index.html.twig', [
                   'errors' => $checkedData['errors']
               ]);
    }
}
