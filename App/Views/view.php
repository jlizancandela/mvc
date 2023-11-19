<?php

namespace App\Views;


class View
{
    protected $twig;
    public $flash_message;
    public function __construct()
    {


        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $this->twig = new \Twig\Environment($loader, [
            //'cache' => 'config/cache',
            'cache' => false,
            'debug' => true,
        ]);
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
        $this->twig->addGlobal('session', $_SESSION);
        $this->twig->addGlobal('padre', '/mvc/');
        if (isset($_SESSION['flash_message'])) {
            $error = $_SESSION['flash_message'];
            $this->twig->addGlobal('flash_message', $error);
        };
    }
    public function get_twig()
    {

        return $this->twig;
    }
}
