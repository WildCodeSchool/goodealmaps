<?php

namespace App\Controller;

class LegalController extends AbstractController
{
    public function index(): string
    {
        return $this->twig->render('Legal/legal.html.twig');
    }
}
