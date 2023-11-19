<?php

namespace App\Controllers;

use App\Models\Articles_model;
use App\Views\Articles_view;
use App\Views\Article_view;
use App\Views\Home_view;

class Article_controller
{
    public $articles;
    public function __construct()
    {
        $this->articles = new Articles_model();
    }

    public function index()
    {

        $data = $this->articles->getAll();
        $baner = $this->articles->getImg_baner(3);

        $home_view = new home_view();
        echo $home_view->show(
            $array = [
                'data' => $data,
                'banner' => $baner
            ]
        );
    }
    public function Article_show()
    {
        $public = $_GET['public'] ?? null;

        // extraer el parametro public de $params


        $page = (isset($_GET['page'])) ? $_GET['page'] : 1;

        $inner = isset($_GET['ofertas']) ? "inner" : "left";

        $ofertas = isset($_GET['ofertas']) ? "1" : "0";

        $count = $this->articles->getCount($public, $inner, 4);
        $data = $this->articles->getAll_by_public($public, '', $inner, $page);
        $altdata = $this->articles->getAll_by_public($public, 'not');

        //var_dump($data);
        $articles_view = new Articles_view();
        echo $articles_view->show(['data' => $data, 'altdata' => $altdata, 'public' => $public, 'page' => $page, 'count' => $count, 'ofertas' => $ofertas]);
    }
    public function Article_show_by_id()
    {
        if (!isset($_SESSION['login'])) {
            $_SESSION['flash_message'] = 'Logueate para ver la descripcion del articulo';
            header('Location: login');
        };
        $id = $_GET['id'] ?? null;
        $data = $this->articles->getOne($id);
        $articles_view = new Article_view();
        echo $articles_view->show(['data' => $data]);
    }
}
