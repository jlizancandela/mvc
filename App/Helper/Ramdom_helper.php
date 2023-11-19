<?php

namespace App\Helper;

class ramdom_helper
{
    public $length, $characters;

    function __construct()
    {
        require 'config/env.php';

        $this->length = $length;
        $this->characters = $characters;
    }
    public function generate()
    {
        $charactersLength = strlen($this->characters);
        $randomString = '';
        for ($i = 0; $i < $this->length; $i++) {
            $randomString .= $this->characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
