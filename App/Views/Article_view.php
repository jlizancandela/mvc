<?php

namespace App\Views;

use App\Views\view;


class article_view extends view
{
    public function show($array)
    {
        $twig = $this->get_twig();
        $template = $twig->load('article.twig');

        return $template->render($array);
    }
}
