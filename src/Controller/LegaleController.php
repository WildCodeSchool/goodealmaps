<?php

namespace App\Controller;

class LegaleController extends AbstractController
{
    public function legale(): string
    {
        return $this->twig->render('Legale/legale.html.twig');
    }
}
