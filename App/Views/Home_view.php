<?php

namespace App\Views;

use App\Views\view;


class home_view extends view
{
    public function show($array)
    {
        $twig = $this->get_twig();
        $template = $twig->load('home.twig');
        return $template->render([
            'session' => $_SESSION,
            'array' => $array
        ]);
    }
}
