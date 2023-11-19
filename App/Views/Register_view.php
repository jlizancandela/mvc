<?php

namespace App\Views;

use App\Views\view;

class Register_view extends view
{
    public function show()
    {
        $this->get_twig();
        $template = $this->twig->load('register.twig');
        echo $template->render(['session' => $_SESSION]);
    }
}
