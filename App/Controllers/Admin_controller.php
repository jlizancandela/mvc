<?php

namespace App\Controllers;

use App\Models\Articles_model;
use App\Models\User_model;
use App\Views\Admin_View;

require_once "config/env.php";

class Admin_controller
{
    public $articles;
    public $users;
    public $padre;

    //----------------------------------------------------------------
    // Constructor
    //----------------------------------------------------------------
    public function __construct()
    {
        $this->padre = $GLOBALS["padre"];
        //Bloquea la entrada al panel de administrador si no lo eres.
        if (isset($_SESSION["rol"])) {
            if ($_SESSION["rol"]["Rol"] != "Admin") {
                header("location:" . $this->padre . "home");
                //echo 'ola desde dentro';
            }
        } else {
            header("location:" . $this->padre . "home");
            //echo 'ola desde fuera';
        }
    }
    //----------------------------------------------------------------
    //Se trae los usuarios del modelo y los pasa a vista
    //----------------------------------------------------------------    
    public function getUsers()
    {
        $this->users = new User_model();
        $data = $this->users->getAll();

        $array = [];

        foreach ($data as $key => $value) {
            $usuario = [
                "Codigo" => $value["Codigo"],
                "Nombre" => $value["Nombre"],
                "Passwd" => $value["Passwd"],
                "Telefono" => $value["Telefono"],
                "Email" => $value["Email"],
                "Rol" => $value["Rol"],
                "Direcciones" => $this->users->getDirections($value["Email"]),
            ];
            array_push($array, $usuario);
        }

        $Admin_View = new Admin_View();
        echo $Admin_View->getUsers(["data" => $array]);
    }

    //----------------------------------------------------------------
    //Se trae los articulos del modelo y los pasa a vista
    //----------------------------------------------------------------
    public function getArticles()
    {
        $articles = new Articles_model();
        $array = [
            "categorias" => $articles->get_categorias(),
            "publico" => $articles->get_publico(),
            "ofertas" => $articles->get_ofertas(),
            "articulos" => [],
        ];

        $data = $articles->getAll();

        foreach ($data as $value) {
            $article = [
                "Id" => $value["Id"],
                "Nombre" => $value["Nombre"],
                "Precio" => $value["Precio"],
                "Oferta" => $value["Oferta"],
                "Publico" => $value["Publico"],
                "Categoria" => $value["Categoria"],
                "Descripcion" => $value["Descripcion"],
                "Imagenes" => $articles->getImg($value["Id"]),
            ];
            array_push($array["articulos"], $article);
        }

        $Admin_View = new Admin_View();
        echo $Admin_View->get_articles($array);
    }
    public function updateUsers()
    {
        $array = [
            "Id" => isset($_POST["Id"]) ? $_POST["Id"] : "",
            "Nombre" => isset($_POST["Nombre"]) ? $_POST["Nombre"] : "",
            "Telefono" => isset($_POST["Telefono"]) ? $_POST["Telefono"] : "",
            "Email" => isset($_POST["Email"]) ? $_POST["Email"] : "",
            "Rol" => isset($_POST["Rol"]) ? $_POST["Rol"] : "",
        ];

        $this->users = new User_model();
        $resultado = $this->users->update($array);
        if ($resultado) {
            //echo 'sdofdsafasd';

            //dump($array['Email']);

            if ($array["Email"] == $_SESSION["email"]) {
                //echo 'ola';
                $_SESSION["rol"]["Rol"] = $array["Rol"];
                if ($array["Rol"] != "Admin") {
                    $_SESSION["flash_message"] =
                        "Usted no tiene permisos de administrador";
                }
            }
            $location = $array["Rol"] != "Admin" ? "login" : "admin/users";

            header("Location:" . $this->padre . $location);
        }
    }
    public function updateDirections()
    {
        $array = [
            "Codigo" => isset($_POST["Codigo"])
                ? htmlspecialchars($_POST["Codigo"], ENT_QUOTES, "UTF-8")
                : "",
            "Direccion" => isset($_POST["Direccion"])
                ? htmlspecialchars($_POST["Direccion"], ENT_QUOTES, "UTF-8")
                : "",
            "CP" => isset($_POST["Cp"])
                ? htmlspecialchars($_POST["Cp"], ENT_QUOTES, "UTF-8")
                : "",
            "Provincia" => isset($_POST["Provincia"])
                ? htmlspecialchars($_POST["Provincia"], ENT_QUOTES, "UTF-8")
                : "",
        ];

        $this->users = new User_model();
        $resultado = $this->users->updateDirections($array);

        if ($resultado) {
            header("Location:" . $this->padre . "admin/users");
        }
    }
    public function create_directions()
    {
        $array = [
            "Codigo" => isset($_POST["Codigo"])
                ? htmlspecialchars($_POST["Codigo"], ENT_QUOTES, "UTF-8")
                : "",
            "Direccion" => isset($_POST["Direccion"])
                ? htmlspecialchars($_POST["Direccion"], ENT_QUOTES, "UTF-8")
                : "",
            "CP" => isset($_POST["Cp"])
                ? htmlspecialchars($_POST["Cp"], ENT_QUOTES, "UTF-8")
                : "",
            "Provincia" => isset($_POST["Provincia"])
                ? htmlspecialchars($_POST["Provincia"], ENT_QUOTES, "UTF-8")
                : "",
        ];

        $this->users = new User_model();
        $resultado = $this->users->create_directions($array);

        if ($resultado) {
            header("Location:" . $this->padre . "admin/users");
        }
    }
    public function delete_directions($id)
    {
        $id = isset($id) ? $id : "";

        $this->users = new User_model();
        $resultado = $this->users->delete_directions($id);

        if ($resultado) {
            header("Location:" . $this->padre . "admin/users");
        }
    }
    public function delete_users($id)
    {
        $id = isset($id) ? $id : "";
        $this->users = new User_model();
        $resultado = $this->users->delete($id);

        if ($resultado) {
            header("Location:" . $this->padre . "admin/users");
        }
    }
    // -----------------------------------------
    //  INSERTAR IMAGENES (POR TESTEAR)
    // -----------------------------------------
    public function Upload_img()
    {
        //ob_start();
        //$txt = "public/img/log.txt";
        $this->articles = new Articles_model();
        var_dump($_GET);
        var_dump($_POST);
        var_dump($_FILES);

        $id = isset($_POST["Id_articulo"]) ? $_POST["Id_articulo"] : null;

        $destino = "public/img/"; // Directorio donde se guardarán los archivos

        if (isset($_FILES["file"])) {
            $archivo = basename($_FILES["file"]["name"]);
            $extension = pathinfo($archivo, PATHINFO_EXTENSION);
            $nombre = $id . uniqid() . date("YmdHis") . "." . $extension;
            $archivofinal = $destino . $nombre;

            if (
                move_uploaded_file($_FILES["file"]["tmp_name"], $archivofinal)
            ) {
                echo "El archivo se subió correctamente.";
                //---------------------
                // SQL
                //---------------------
                $resultado = $this->articles->create_img($id, $archivofinal);

                if ($resultado) {
                    echo "El archivo se subió correctamente.";
                }
            } else {
                echo "Hubo un error al subir el archivo.";
            }
        } else {
            echo "No se recibió ningún archivo para cargar.";
        }
        // $contenido = ob_get_clean();
        // file_put_contents($txt, $contenido);
    }
    public function Create_article()
    {
        $this->articles = new Articles_model();
        // nombre, categoria, publico, nuevaCategoria, descripcion, precio, oferta, nueva-oferta

        $array = [
            "nombre" => isset($_POST["nombre"]) ? $_POST["nombre"] : null,
            "categoria" => isset($_POST["categoria"])
                ? $_POST["categoria"]
                : null,
            "publico" => isset($_POST["publico"]) ? $_POST["publico"] : null,
            "nuevaCategoria" => isset($_POST["nuevaCategoria"])
                ? $_POST["nuevaCategoria"]
                : null,
            "descripcionCategoria" => isset($_POST["descripcionCategoria"])
                ? $_POST["descripcionCategoria"]
                : null,
            "descripcion" => isset($_POST["descripcion"])
                ? $_POST["descripcion"]
                : null,
            "precio" => isset($_POST["precio"]) ? $_POST["precio"] : null,
            "oferta" => isset($_POST["oferta"]) ? $_POST["oferta"] : null,
            "nuevaOferta" => isset($_POST["nuevaOferta"])
                ? $_POST["nuevaOferta"]
                : null,
            "ofertaDto" => isset($_POST["oferta-dto"])
                ? $_POST["oferta-dto"]
                : null,
        ];
        // CREAR NUEVA CATEGORIA
        if ($array["categoria"] === "nueva") {
            $idCategoria = $this->articles->create_categoria(
                $array["nuevaCategoria"],
                $array["descripcionCategoria"]
            );
        }

        // CREAR NUEVA OFERTA
        if ($array["oferta"] === "nueva") {
            $idOferta = $this->articles->create_oferta(
                $array["nuevaOferta"],
                $array["ofertaDto"]
            );
        }

        // CREAR NUEVO ARTICULO
        $idArticulo = $this->articles->create_Product(
            $array["nombre"],
            $array["precio"],
            $array["descripcion"],
            $array["publico"]
        );

        $idCategoria = isset($idCategoria) ? $idCategoria : $array["categoria"];
        $idOferta = isset($idOferta) ? $idOferta : $array["oferta"];

        // AGREGARLE LA CATEGORIA
        $this->articles->create_prcategoria($idArticulo, $idCategoria);

        //AGREGARLE LA OFERTA

        if ($array["oferta"] != "ninguna") {
            $this->articles->create_proferta($idArticulo, $idOferta);
        }

        header("Location: " . $this->padre . "admin/articles");
    }
}
