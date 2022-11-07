<?php

namespace App\Controller;

use App\Model\AddGoodealManager;
use App\Model\AuthorManager;

class FormAddGoodealController extends AbstractController
{
    public function index(): string
    {
        return $this->twig->render('Announcement/addGoodeal.html.twig');
    }

    public function checkForm(array $data): array
    {
        $errors = [];
        $gooDeal = [];

        foreach ($data as $key => $value) {
            $cleanValue = htmlentities(trim($value));
            
            if ($key === "title" && strlen($cleanValue) > 50) {
                $errors[$key] = "Le nom du Goodeal est trop long, merci de donner un nom plus court à votre Goodeal";
            }

            switch(true){
                case $cleanValue === "" :
                    $errors[$key] = "Merci de Remplir le champs";
                    break;
                
                case strlen($cleanValue) > 20:
                    switch ($key) {
                        case "lastname" :
                        $errors[$key] = "Nom trop long, merci de fournir un nom plus court";
                    break;

                case "firstname" :
                        $errors[$key] = "Prénom trop long, merci de fournir un prénom plus court";    
                        break;
                        case "email" :
                            $errors[$key] = "L'email est trop long, merci de fournir une adresse mail plus courte";    
                            break;
                        default ;}
                    break;
                    default ; } 

            if ($key === "adress" && strlen($cleanValue) > 255) {
                $errors[$key] = "L'adresse est trop longue, merci de donner une adresse valide";
            }
          /*  if ($key === "message" && strlen($cleanValue) > 65535) {
                $errors[$key] = "La description est trop longue, merci de raccourcir la description";
            }*/
            if ($key === "city" && strlen($cleanValue) > 100) {
                $errors[$key] = "Le nom de la Ville est trop long, merci d'utiliser un nom de ville valide";
            }
            if (($key === "zipcode" && strlen($cleanValue) > 5) || ($key === "zipcode" && strlen($cleanValue) < 5)) {
                $errors[$key] = "Le Code Postal n'est pas valide, merci d'utiliser un Code Postal valide";
            }
            if ($key === "email" && !filter_var($cleanValue, FILTER_VALIDATE_EMAIL)) {
                $errors[$key] = "Adresse mail non valide, merci de fournir une adresse mail valide";
            }

            if (empty($errors[$key])) {
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
        $checkedData['errors'] = [];

        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
                $data = [
                "title" => $_POST['deal-name'],
                "lastname" => $_POST['lastname'],
                "firstname" => $_POST['firstname'],
               // "category" => $_POST['category'],
                "adress" => $_POST['adress'],
              //  "region" => $_POST['region'],
                "city" => $_POST['city'],
                "zipcode" => $_POST['zipcode'],
              /*  "start-date" => $_POST['start-date'],
                "end-date" => $_POST['end-date'],
                "image" => $_POST['avatar'],*/
                "email" => $_POST['email'],
           /*     "message" => $_POST['description']*/
                ];

                
                $checkedData = $this->checkForm($data);

                if (!$checkedData["errors"]) {
                    $addGoodealManager = new AddGoodealManager();
                 //   $addGoodealManager->insertGoodeal($checkedData["gooDeal"]);

                      $addAuthor = new AuthorManager();
                      $addAuthor->insertAuthor($checkedData["gooDeal"]);
                  //  header('Location: /addGoodeal');
                }
        }
           // Generate the web page
            
          return $this->twig->render('Announcement/addGoodeal.html.twig', [
            'data' => $data,
            'errors' => $checkedData['errors']
               ]);
    }
}
