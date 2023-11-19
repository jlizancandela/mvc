<?php

namespace App\Views;

use App\Views\view;

class Articles_view extends view
{
    public function show($array)
    {
        $twig = $this->get_twig();
        $template = $twig->load('articles.twig');
        return $template->render($array);
    }
}
