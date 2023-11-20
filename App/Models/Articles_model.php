<?php

namespace App\Models;

use App\Models\model;
use PDO;
use PDOException;

class Articles_model extends model
{
    public $response;

    //------------------------------------------------------------------
    // LISTAR TODOS LOS ARTICULOS
    //------------------------------------------------------------------
    public function getAll()
    {
        $sql = "
        select p.Id, 
        p.Nombre, p.Precio, p.Descripcion,
        p2.Nombre as Publico, c.Nombre as Categoria,
        o.Oferta, c.Id as Id_categoria, o.Id as Id_oferta,
        p2.Id as Id_publico
        from Productos p
        inner join `Publico` p2 on p2.Id = p.Id_Publico
        inner join `Pr_categorias` pr on pr.Id_Producto = p.Id
        inner join `Categorias` c on pr.Id_Categoria = c.Id
        left join Pr_ofertas prof on prof.Id_Producto = p.Id
        left join `Ofertas` o on prof.Id_Oferta = o.Id;
        ";

        $query = $this->pdo->prepare($sql);
        $result = $query->execute();

        if ($result) {
            $this->response = $query->fetchAll(PDO::FETCH_ASSOC);
            return $this->response;
        } else {
            return false;
        }
    }
    //---------------------------------------------------------------
    // LISTAR LAS PORTADAS DE X ARTICULOS (PARA HACER BANERS)
    //---------------------------------------------------------------
    public function getImg_baner($numero)
    {
        $sql = "select  Id_producto, MIN(Url) as Url from Imagenes
        group by Id_producto order by rand()
        limit :numero;";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(":numero", $numero, PDO::PARAM_INT);
        $query->execute();
        $this->response = $query->fetchAll(PDO::FETCH_ASSOC);
        return $this->response;
    }
    //----------------------------------------------------------------
    // LISTAR LAS IMAGENES DE UN ARTICULO
    //----------------------------------------------------------------
    public function getImg($id)
    {
        $sql = "select Url from Imagenes where Id_producto = :id;";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->execute();
        $this->response = $query->fetchAll(PDO::FETCH_ASSOC);
        return $this->response;
    }
    //----------------------------------------------------------------
    // CONTAR LOS ARTICULOS SELECIONADOS (PARA EL PAGINADOR)
    //----------------------------------------------------------------
    public function getCount($public, $inner, $limit)
    {
        // PARAMETROS
        //--------------
        // PUBLIC -> PUBLICO
        // INNER -> TIPO DE JOIN A LA HORA DE RELACIONAR LAS OFERTAS
        //         INNER JOIN PARA SOLO OFERTAS
        //         LEFT JOIN PARA MOSTRAR TODOS LOS PRODUCTOS
        // LIMIT -> LIMITE DE PRODUCTOS (PARA EL PAGINADOR)
        //------------------------------------------------------------

        $sql = "
        select p.Id, 
        p.Nombre, p.Precio, p.Descripcion, 
        p2.Nombre as Publico, c.Nombre as Categoria, o.Oferta
        from Productos p
        inner join `Publico` p2 on p2.Id = p.Id_Publico
        inner join `Pr_categorias` pr on pr.Id_Producto = p.Id
        inner join `Categorias` c on pr.Id_Categoria = c.Id
        {{soloOfertas}} join Pr_ofertas prof on prof.Id_Producto = p.Id
        {{soloOfertas}} join `Ofertas` o on prof.Id_Oferta = o.Id
        where p2.Nombre like :public;
        ";

        $sql = str_replace("{{soloOfertas}}", $inner, $sql); // SE REMPLAZA POR EL TIPO DE UNION

        $query = $this->pdo->prepare($sql);
        $public = !isset($public) ? "%" : $public;
        $query->bindParam(":public", $public, PDO::PARAM_STR);

        $query->execute();

        $rows = $query->rowCount(); // se obtiene el numero de filas para el paginador
        $total_pages = ceil($rows / $limit); // se determina el numero de paginas

        return $total_pages;
    }
    //------------------------------------------------------------------------------------
    // LISTAR PRODUCTOS SEGUN CATEGORIA O PUBLICO
    //------------------------------------------------------------------------------------
    public function getAll_by_public($public, $not, $inner = "left", $page = 1)
    {
        // PARAMETROS
        //--------------
        // PUBLIC -> PUBLICO
        // NOT -> PARA LOS PRODUCTOS ALTERNATIVOS
        //        NOT PARA 'NOT LIKE'
        //       "" PARA 'LIKE'
        // INNER -> TIPO DE JOIN A LA HORA DE RELACIONAR LAS OFERTAS
        //         INNER JOIN PARA SOLO OFERTAS
        //         LEFT JOIN PARA MOSTRAR TODOS LOS PRODUCTOS
        // LIMIT -> LIMITE DE PRODUCTOS (PARA EL PAGINADOR)

        //---------------------SENTENCIA--------------------------------------------------
        $sql = "
        select p.Id, 
        p.Nombre, p.Precio, p.Descripcion, 
        p2.Nombre as Publico, c.Nombre as Categoria, o.Oferta
        from Productos p
        inner join `Publico` p2 on p2.Id = p.Id_Publico
        inner join `Pr_categorias` pr on pr.Id_Producto = p.Id
        inner join `Categorias` c on pr.Id_Categoria = c.Id
        {{soloOfertas}} join Pr_ofertas prof on prof.Id_Producto = p.Id
        {{soloOfertas}} join `Ofertas` o on prof.Id_Oferta = o.Id
        where p2.Nombre {{not}} like :public
        limit :limit offset :offset;";
        
        //---------------------VARIABLES---------------------------------------------------
        $public = !isset($public) ? "%" : $public;
        $not = $not != "" ? "not" : ""; // PARA LAS ALTERNATIVAS
        $page = isset($page) ? $page : 1; 
        $limit = 4; // limite de productos por pagina
        $offset = ($page - 1) * $limit; // offset de la pagina
        
        //---------------------EJECUCION----------------------------------------------------
        $query = $this->pdo->prepare($sql);
        $sql = str_replace("{{soloOfertas}}", $inner, $sql); // se reemplaza {{soloOfertas}} por $inner
        $sql = str_replace("{{not}}", $not, $sql); // se reemplaza {{not}} por $not
        $query->bindParam(":public", $public, PDO::PARAM_STR); // se agrega el parametro publico
        $query->bindParam(":limit", $limit, PDO::PARAM_INT);
        $query->bindParam(":offset", $offset, PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $respuesta = [];
        
        //------------------TRATO LA RESPUESTA------------------------------------------------
        foreach ($data as $key => $value) {
            $precio = $value["Precio"];
            $Oferta = $value["Oferta"];

            $datos = [
                "Nombre" => $value["Nombre"],
                "Oferta" => $value["Oferta"],
                "Portada" => $this->getImg($value["Id"])[0]["Url"],
                "Descripcion" => $value["Descripcion"],
                "Categoria" => $value["Categoria"],
                "Precio" => $value["Precio"],
                "Imagenes" => $this->getImg($value["Id"]),
                "Id" => $value["Id"],
            ];

            array_push($respuesta, $datos);
        }

        return $respuesta;
    }
    //-------------------------------------------------------------------------------------------
    // LISTAR UN ARTICULO
    //-------------------------------------------------------------------------------------------
    public function getOne($id)
    {
        $respuesta = [];
        $sql = "
        select p.Id, 
        p.Nombre, p.Precio, p.Descripcion, 
        p2.Nombre as Publico, c.Nombre as Categoria, o.Oferta
        from Productos p
        inner join `Publico` p2 on p2.Id = p.Id_Publico
        inner join `Pr_categorias` pr on pr.Id_Producto = p.Id
        inner join `Categorias` c on pr.Id_Categoria = c.Id
        left join Pr_ofertas prof on prof.Id_Producto = p.Id
        left join `Ofertas` o on prof.Id_Oferta = o.Id
        where p.Id = :id;
        ";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $images = $this->getImg($id);

        $respuesta = [
            "Nombre" => $data[0]["Nombre"],
            "Oferta" => $data[0]["Oferta"],
            "Portada" => $images[0]["Url"],
            "Descripcion" => $data[0]["Descripcion"],
            "Categoria" => $data[0]["Categoria"],
            "Precio" => $data[0]["Precio"],
            "Imagenes" => $images,
            "Id" => $data[0]["Id"],
        ];

        return $respuesta;
    }

    //------------------------------------------------------------------------
    // LISTAR CATEGORIAS
    //------------------------------------------------------------------------
    public function get_categorias()
    {
        $sql = "Select * from Categorias";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    //-------------------------------------------------------------------------
    // LISTAR OFERTAS
    //-------------------------------------------------------------------------
    public function get_ofertas()
    {
        $sql = "Select * from Ofertas";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    //------------------------------------------------------------------------
    // LISTAR PUBLICO
    //------------------------------------------------------------------------
    public function get_publico()
    {
        $sql = "Select * from Publico";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    //-------------------------------------------------------------------------
    // INSERTAR IMAGEN EN UN ARTICULO
    //-------------------------------------------------------------------------
    public function create_img($id, $url)
    {
        $sql =
            "INSERT INTO `Imagenes` (`Id_producto`, `Url`) VALUES (:id_producto, :url);";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(":id_producto", $id, PDO::PARAM_INT);
        $query->bindParam(":url", $url, PDO::PARAM_STR);
        return $query->execute();
    }
    //------------------------------------------------------------------------
    // CREAR CATEGORIAS
    //------------------------------------------------------------------------
    public function create_categoria($nombre, $descripcion)
    {
        $sql =
            "INSERT INTO Categorias ( Nombre, Descripcion) VALUES (:nombre, :descripcion);";
        $query = $this->pdo->prepare($sql);
        $result = $query->execute([
            ":nombre" => $nombre,
            ":descripcion" => $descripcion,
        ]);

        if ($result) {
            return $this->pdo->lastInsertId();
        } else {
            return false;
        }
    }
    //--------------------------------------------------------------------------
    // CREAR OFERTAS
    //--------------------------------------------------------------------------
    public function create_oferta($nombre, $oferta)
    {
        $sql =
            "INSERT INTO Ofertas ( Nombre, Oferta) VALUES (:nombre, :oferta);";
        $query = $this->pdo->prepare($sql);
        $query->execute([":nombre" => $nombre, ":oferta" => $oferta]);

        if ($query) {
            return $this->pdo->lastInsertId();
        } else {
            return false;
        }
    }
    //----------------------------------------------------------------------------
    // RELACIONAR PRODUCTO CON CATEGORIA
    //----------------------------------------------------------------------------
    public function create_prcategoria($producto, $categoria)
    {
        $sql =
            "INSERT INTO Pr_categorias (Id_Producto, Id_Categoria) VALUES (:producto, :categoria);";
        $query = $this->pdo->prepare($sql);
        return $query->execute([
            ":producto" => $producto,
            ":categoria" => $categoria,
        ]);
    }
    //------------------------------------------------------------------------
    // RELACIONAR PRODUCTO CON OFERTA
    //------------------------------------------------------------------------
    public function create_proferta($producto, $oferta)
    {
        $producto = isset($producto) ? $producto : null;
        $oferta = isset($oferta) ? $oferta : null;

        $sql =
            "INSERT INTO Pr_ofertas (Id_Producto, Id_Oferta) VALUES (:producto, :oferta);";
        $query = $this->pdo->prepare($sql);
        return $query->execute([
            ":producto" => $producto,
            ":oferta" => $oferta,
        ]);
    }
    //----------------------------------------------------------------------------
    // CREAR PRODUCTO
    //----------------------------------------------------------------------------
    public function create_Product($nombre, $precio, $descripcion, $publico)
    {
        $nombre = isset($nombre) ? $nombre : null;
        $precio = isset($precio) ? $precio : null;
        $descripcion = isset($descripcion) ? $descripcion : null;
        $publico = isset($publico) ? $publico : null;

        $sql = "INSERT INTO Productos (Nombre, Precio, Descripcion, Id_Publico) 
                VALUES (:nombre, :precio, :descripcion, :publico);";
        $query = $this->pdo->prepare($sql);
        $result = $query->execute([
            ":nombre" => $nombre,
            ":precio" => $precio,
            ":descripcion" => $descripcion,
            ":publico" => $publico,
        ]);
        if ($result) {
            return $this->pdo->lastInsertId();
        } else {
            return false;
        }
    }
    //-----------------------------------------------------------------------------
    // MODIFICAR PRODUCTO
    //-----------------------------------------------------------------------------
    
   
}
