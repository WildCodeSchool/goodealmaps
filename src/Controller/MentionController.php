<?php

namespace App\Controller;

class MentionController extends AbstractController
{
    public function mention(): string
    {
        return $this->twig->render('Mention/mention.html.twig');
    }
}
