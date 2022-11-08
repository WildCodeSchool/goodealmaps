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
        $checkedData = array_map('trim', $data);
        return $checkedData;
    }

    private function checkEmptyValue(string $value): bool
    {
        if ($value === "") {
            return false;
        }
        return true;
    }

    private function lengthValidation(string $value, int $length, string $errorKey, string $key): string
    {
        $error = "";
        if (strlen($value) > $length && $errorKey) {
            $error = "$errorKey Est trop long.ue. Merci de racourcir le champ.";
        }
        if (
            ($key === "zipcode" && !filter_var(!$value, FILTER_VALIDATE_INT)) ||
            ($key === "zipcode" && strlen($value) < 5 && $errorKey)
        ) {
            $error = "$errorKey Veuillez saisir un code postal valide";
        }
        return $error;
    }

    private function checkLength(string $value, string $key): string
    {
        $error = "";
        $length = "";
        $errorKey = "";
        switch ($key) {
            case "title":
                $length = 50;
                $errorKey = "Titre de ton goodeal";
                break;
            case "lastname":
                $length = 20;
                $errorKey = "Ton nom";
                break;
            case "firstname":
                $length = 20;
                $errorKey = "Ton prénom";
                break;
            case "email":
                $length = 20;
                $errorKey = "Ton email";
                break;
            case "adress":
                $length = 255;
                $errorKey = "L'adresse";
                break;
            case "city":
                $length = 100;
                $errorKey = "Nom de la ville";
                break;
            case "zipcode":
                $length = 5;
                $errorKey = "Le code postal";
                break;
            case "message":
                $length = 65535;
                $errorKey = "Ton message";
                break;
            default:
                $length = 0;
                $errorKey = "";
        }

        $error = $this->lengthValidation($value, $length, $errorKey, $key);

        return $error;
    }

    public function checkForm(array $data): array
    {
        $errors = [];
        $gooDeal = [];
        foreach ($data as $key => $value) {
            if (!$this->checkEmptyValue($value)) {
                $errors[$key] = "Merci de Remplir le champ";
            }

            if ($this->checkLength($value, $key)) {
                $errors[$key] = $this->checkLength($value, $key);
            }

            switch ($key) {
                case "email":
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $errors[$key] = "Merci de Remplir un email valide";
                    }
                    break;
                default:
                    break;
            }

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

    public function checkImage( string $extension, array $authorizedExtensions,
        int $maxFileSize, string $uploadFile): array {
        $errors= [];
       if (in_array($extension, $authorizedExtensions)) {
            if (
                !file_exists($_FILES['imageupload']['tmp_name']) ||
                filesize($_FILES['imageupload']['tmp_name']) > $maxFileSize
            ) {
                $errors['image'] = "Votre fichier doit exister et faire moins de 1M !";
            } else {
                if (!move_uploaded_file($_FILES['imageupload']['tmp_name'], $uploadFile)) {
                    $errors['image'] = "erreur chargement de l'image";
                }
            }
        } else {
             $errors['image'] = 'Veuillez sélectionner une image de type Jpg ou Jpeg ou Png !';
        }

        $checkImage = [
            "errors" => $errors,
        ];

        return $checkImage;
    }

    public function addGoodeal(): string
    {
        $data = [];
        $finalValue = [];
        $finalValue['errors'] = [];

        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
                $uploadDir = 'assets/images/cards/';
                $uploadFile = uniqid(basename($_FILES['imageupload']['name'])) . $uploadDir;
                $extension = pathinfo($_FILES['imageupload']['name'], PATHINFO_EXTENSION);
                $authorizedExtensions = ['jpg','png', 'gif', 'webp'];
                $maxFileSize = 1000000;


                $data = [
                "title" => $_POST['deal-name'],
                "lastname" => $_POST['lastname'],
                "firstname" => $_POST['firstname'],
                "category" => $_POST['category'],
                "adress" => $_POST['adress'],
                "region" => $_POST['region'],
                "city" => $_POST['city'],
                "zipcode" => $_POST['zipcode'],
                "start-date" => $_POST['start-date'],
                "end-date" => $_POST['end-date'],
                "email" => $_POST['email'],
          //    "image" => $_FILE['imageupload'],
                "message" => $_POST['description']
                ];

                $checkImage = $this->checkImage($extension, $authorizedExtensions, $maxFileSize, $uploadFile);
                $checkedData = $this->cleanValue($data);
                $finalValue = array_merge($this->checkForm($checkedData), $checkImage);

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
