<?php


namespace App\Views;

use App\Views\view;

class Admin_View extends view
{
    public function getUsers($array)
    {
        $twig = $this->get_twig();
        $template = $twig->load('Admin_Users.twig');

        return $template->render($array);
    }
    public function get_articles($array)
    {
        $twig = $this->get_twig();
        $template = $twig->load('Admin_Articles.twig');

        return $template->render(['array' => $array]);
    }
}
