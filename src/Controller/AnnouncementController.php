<?php

namespace App\Controller;

use App\Model\AnnouncementManager;

class AnnouncementController extends AbstractController
{
    /**
     * List items
     */
    public function index(): string
    {
        return $this->twig->render('Announcement/index.html.twig');
    }
}
