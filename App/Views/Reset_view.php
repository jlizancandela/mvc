<?php

namespace App\Views;

use App\Views\view;

class Reset_view extends view
{
    public function show()
    {
        $this->get_twig();
        $template = $this->twig->load('reset.twig');
        echo $template->render(['session' => $_SESSION]);
    }
}
