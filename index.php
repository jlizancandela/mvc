<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once "vendor/autoload.php";
require_once "config/env.php";

use App\Controllers\Users_controller;
use App\Controllers\Article_controller;
use App\Controllers\Admin_controller;

session_start();

// ---------------------------------------------------
// INICIALIZAR ROUTER
// ---------------------------------------------------

$router = new AltoRouter();

$router->setBasePath("mvc/");
$padre = "/mvc/";

// ---------------------------------------------------
// RUTAS GET
// ---------------------------------------------------

// Ruta de inicio

$router->map("GET", "/", function () {
    load("App\Controllers\Article_controller", "index");
});

$router->map("GET", "/home", function () {
    load("App\Controllers\Article_controller", "index");
});

$router->map("GET", "/articles", function () {
    load("App\Controllers\Article_controller", "Article_show");
});

$router->map("GET", "/article", function () {
    load("App\Controllers\Article_controller", "Article_show_by_id");
});

// Ruta de login
$router->map("GET", "/login", function () {
    load("App\Controllers\Users_controller", "show_login");
});

// Ruta de Tabla Admin

$router->map("GET", "/admin/users", function () {
    load("App\Controllers\Admin_controller", "getUsers");
});

$router->map("GET", "/admin/articles", function () {
    load("App\Controllers\Admin_controller", "getArticles");
});

// Ruta de registro
$router->map("GET", "/register", function () {
    load("App\Controllers\Users_controller", "register");
});

// Ruta de reset
$router->map("GET", "/reset_password", function () {
    load("App\Controllers\Users_controller", "show_reset");
});

// Ruta de logout
$router->map("GET", "/logout", function () {
    session_destroy();
    header("Location: home");
});

// Ruta de Eliminar Direcciones
$router->map("GET", "/admin/directions/delete/[i:id]", function ($id) {
    load("App\Controllers\Admin_controller", "delete_Directions", $id);
});

// Ruta de Eliminar Usuarios
$router->map("GET", "/admin/users/delete/[i:id]", function ($id) {
    load("App\Controllers\Admin_controller", "delete_Users", $id);
});

// Ruta de 404
$router->map("GET", "/404", function () {
    include "config/space/404.html";
});

// ---------------------------------------------------
// RUTAS POST
// ---------------------------------------------------

// Ruta de login
$router->map("POST", "/login", function () {
    $mylogin = new Users_controller();
    $mylogin->login();
});

// Ruta de registro
$router->map("POST", "/register", function () {
    $myregister = new Users_controller();
    $myregister->create_user();
});

// Ruta de reset
$router->map("POST", "/reset_password", function () {
    $myreset = new Users_controller();
    $myreset->reset();
});

// Update Users
$router->map("POST", "/update_users", function () {
    $myadmin = new Admin_controller();
    $myadmin->updateUsers();
});

// Update Directions
$router->map("POST", "/directions/update", function () {
    $myadmin = new Admin_controller();
    $myadmin->updateDirections();
});

// Create Directions
$router->map("POST", "/directions/create", function () {
    $myadmin = new Admin_controller();
    $myadmin->create_directions();
});

// Create Articles
$router->map("POST", "/articles/create", function () {
    $myadmin = new Admin_controller();
    $myadmin->Create_article();
});

// Insert Image
$router->map("POST", "/upload_img", function () {
    $myadmin = new Admin_controller();
    $myadmin->Upload_img();
});

// ---------------------------------------------------
// EJECUCIÓN DE RUTAS
// ---------------------------------------------------

// match current request url
$match = $router->match();

// call closure or throw 404 status
if (is_array($match) && is_callable($match["target"])) {
    call_user_func_array($match["target"], $match["params"]);
} else {
    // no route was matched
    include "config/space/404.html";
}

function load($namespace, $metodo, $parametros = null)
{
    $controller = new $namespace();

    if (isset($parametros)) {
        $controller->$metodo($parametros);
    } else {
        $controller->$metodo();
    }
}
