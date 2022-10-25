<?php

namespace App\Controller;

class HomeController extends AbstractController
{
    private $pathAva = '/assets/images/photos/';   
    private $pathIcon = '/assets/images/icons/';
    private $devs = [
        0 => ['name' => 'Mathieu Alexandre', 'link' => 'alexandre.png', 'github' => '', 'linkedin' => ''],
        1 => ['name' => 'Juste Axel', 'link' => 'axel.png', 'github' => '', 'linkedin' => ''],
        2 => ['name' => 'Depoorter Franck', 'link' => 'franck.png', 'github' => '', 'linkedin' => ''],
        3 => ['name' => 'Vinchent Paul', 'link' => 'paul.png', 'github' => '', 'linkedin' => ''],
        4 => ['name' => 'Nedbailo Natalia', 'link' => 'natalia.png', 'github' => 'https://github.com/Kengaroo', 'linkedin' => 'https://www.linkedin.com/in/natalia-nedbailo-7036b718/']
    ];
    /**
     * Display home page
     */
    public function index(): string
    {
        return $this->twig->render('Home/index.html.twig');
    }

    public function about(): string
    {
        return $this->twig->render('Home/about.html.twig', ['devs' => $this->devs, 'pathAva' => $this->pathAva, 'pathIcon' => $this->pathIcon]);
    }
}
