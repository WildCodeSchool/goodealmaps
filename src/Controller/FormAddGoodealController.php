<?php

namespace App\Controller;

use App\Model\AddGoodealManager;

class FormAddGoodealController extends AbstractController
{
    public function index(): string
    {
        return $this->twig->render('FormAddGoodeal/index.html.twig');
    }

    public function add(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $goodeal = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $goodealManager = new AddGoodealManager();
            $goodealManager->insert($goodeal);
            header('Location:/home');
        }
    }
}
