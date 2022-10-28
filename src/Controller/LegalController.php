<?php

namespace App\Controller;

class LegalController extends AbstractController
{
    public function legal(): string
    {
        return $this->twig->render('Legal/legal.html.twig');
    }
}
