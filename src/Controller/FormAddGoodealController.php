<?php

namespace App\Controller;

class FormAddGoodealController extends AbstractController
{
    public function index(): string
    {
        return $this->twig->render('FormAddGoodeal/index.html.twig');
    }
}

