<?php

namespace App\Views;

use App\Views\view;

class login_view extends view
{
    public function get_form()
    {
        $twig = $this->get_twig();
        $template = $twig->load('login.twig');
        return $template->render(['session' => $_SESSION]);
    }
};
