<?php

namespace App\Controller;

use App\Model\AboutManager;

class AboutController extends AbstractController
{
    private $pathAva = '/assets/images/photos/';
    public static $pathIcon = '/assets/images/icons/';

    public function index(): string
    {
        $aboutManager = new AboutManager();
        $devs = $aboutManager->renderDevs();
        return $this->twig->render(
            'About/about.html.twig',
            ['devs' => $devs, 'pathAva' => $this->pathAva, 'pathIcon' => static::$pathIcon]
        );
    }
}
