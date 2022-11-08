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

  private function cleanValue(array $data): array
  { 
    foreach ($data as $key => $value) {
        $cleanValue = htmlentities(trim($value));
        $checkedData[$key] = $cleanValue;
    }
    return $checkedData;
   
  }

    public function checkForm(array $data): array
    {
        $errors = [];
        $gooDeal = [];

        foreach ($data as $key => $value) {
            switch ($value) {
                case "":
                    $errors[$key] = "Merci de Remplir le champ";
                    break;
                default:
                    ;
            }

            switch ($key) {
                case "title":
                    if (strlen($value) > 50) {
                        $errors[$key] = "Le nom du Goodeal est trop long, merci de donner 
                        un nom plus court à votre Goodeal";
                    }
                    break;
                case "lastname":
                    if (strlen($value) > 20) {
                        $errors[$key] = "Nom trop long, merci de fournir un nom 
                        plus court";
                    }
                    break;
                case "firstname":
                    if (strlen($value) > 20) {
                        $errors[$key] = "Prénom trop long, merci de fournir un prénom 
                        plus court";
                    }
                    break;
                case "email":
                    if (strlen($value) > 20) {
                        $errors[$key] = "L'email est trop long, merci de fournir une 
                        adresse mail plus courte";
                    } elseif (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $errors[$key] = "Adresse mail non valide, merci de fournir 
                        une adresse mail valide";
                    }
                    break;
                case "adress":
                    if (strlen($value) > 255) {
                        $errors[$key] = "L'adresse est trop longue, merci de donner 
                        une adresse valide";
                    }
                    break;
                case "city":
                    if (strlen($value) > 100) {
                        $errors[$key] = "Le nom de la Ville est trop long, merci 
                        d'utiliser un nom de ville valide";
                    }
                    break;
                case "zipcode":
                    if (strlen($value) > 5 || strlen($value) < 5) {
                        $errors[$key] = "Le Code Postal n'est pas valide, merci 
                        d'utiliser un Code Postal valide";
                    }
                    break;
                default:
                    ;
            }

          /*  if ($key === "message" && strlen($value) > 65535) {
                $errors[$key] = "La description est trop longue, merci de raccourcir la description";
            }*/

            if (empty($errors[$key])) {
                $gooDeal[$key] = $value;
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
        $finalValue = [];
        $finalValue['errors'] = [];

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

                $checkedData = $this->cleanValue($data);
                $finalValue = $this->checkForm($checkedData);

                if (!$finalValue["errors"]) {
                 //   $addGoodealManager = new AddGoodealManager();
                 //   $addGoodealManager->insertGoodeal($checkedData["gooDeal"]);

                      $addAuthor = new AuthorManager();
                      $addAuthor->insertAuthor($finalValue["gooDeal"]);
                   //   header('Location: /addGoodeal');
                }
        }
           // Generate the web page

          return $this->twig->render('Announcement/addGoodeal.html.twig', [
            'data' => $data,
            'errors' => $finalValue['errors']
               ]);
    }
}
