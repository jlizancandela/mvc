<?php

namespace App\Controllers;

use App\Models\User_model;
use App\Views\Login_view;
use App\Views\Register_view;
use App\Views\Reset_view;
use App\Helper\Sendmail_helper;
use App\Helper\Ramdom_helper;

class Users_controller
{
    public $email,
        $password,
        $nombre,
        $telefono,
        $direccion,
        $postalCode,
        $province,
        $error;

    function __construct()
    {
    }
    // ---------------------------------------------------
    // LOGIN
    // ---------------------------------------------------

    public function show_login()
    {
        // Mostramos el formulario de login
        $login = new login_view();
        echo $login->get_form();

        if (isset($_SESSION["flash_message"])) {
            unset($_SESSION["flash_message"]);
        }
    }

    public function login()
    {
        // Logeamos al usuario
        $this->email = isset($_POST["email"])
            ? filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)
            : null;
        $this->password = isset($_POST["password"])
            ? htmlspecialchars($_POST["password"], ENT_QUOTES, "UTF-8")
            : null;

        if ($this->email && $this->password) {
            $login = new User_model();
            $result = $login->login($this->email, $this->password);

            if (isset($result["Passwd"])) {
                $result = password_verify($this->password, $result["Passwd"]);
            }

            if ($result) {
                $_SESSION["email"] = $this->email;
                $_SESSION["login"] = true;
                $_SESSION["rol"] = $login->getRol($this->email);

                $login->register_error($this->email, 1);

                header("location: home");
            } else {
                $login->register_error($this->email, 0);
                $_SESSION["flash_message"] = "Error al iniciar la sesión";
                header("Location: login");
            }
        } else {
            $_SESSION["flash_message"] = "Error al iniciar la sesión";
            header("Location: login");
        }
    }
    // ---------------------------------------------------
    // REGISTER
    // ---------------------------------------------------

    public function register()
    {
        // Registramos el usuario
        if (isset($_SESSION["flash_message"])) {
            unset($_SESSION["flash_message"]);
        }
        $register = new Register_view(); // Instanciamos la vista
        $register->show();
    }
    public function create_User()
    {
        $array = [
            "email" => isset($_POST["email"])
                ? filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)
                : null,
            "nombre" => isset($_POST["nombre"])
                ? htmlspecialchars($_POST["nombre"], ENT_QUOTES, "UTF-8")
                : null,
            "password" => isset($_POST["password"])
                ? password_hash($_POST["password"], PASSWORD_DEFAULT)
                : null,
            "telefono" => isset($_POST["telefono"])
                ? htmlspecialchars($_POST["telefono"], ENT_QUOTES, "UTF-8")
                : null,
            "direccion" => isset($_POST["direccion"])
                ? htmlspecialchars($_POST["direccion"], ENT_QUOTES, "UTF-8")
                : null,
            "cp" => isset($_POST["postalCode"])
                ? htmlspecialchars($_POST["postalCode"], ENT_QUOTES, "UTF-8")
                : null,
            "provincia" => isset($_POST["province"])
                ? htmlspecialchars($_POST["province"], ENT_QUOTES, "UTF-8")
                : null,
            "rol" => isset($_POST["Rol"]) ? $_POST["Rol"] : null,
        ];

        if (
            $array["email"] &&
            $array["nombre"] &&
            $array["password"] &&
            $array["telefono"] &&
            $array["direccion"] &&
            $array["cp"] &&
            $array["provincia"]
        ) {
            $User = new User_model();
            $User->register($array);

            $location = isset($_POST["Rol"]) ? "admin/users" : "login";

            header("Location: $location");
        } else {
            $_SESSION["flash_message"] = "Error en el registro del usuario";
        }
    }
    // ---------------------------------------------------
    // RESET PASSWORD
    // ---------------------------------------------------
    public function show_reset()
    {
        $reset = new Reset_view(); // Instanciamos la vista
        $reset->show();
    }

    public function reset()
    {
        // Reseteamos la contraseña y la enviamos por correo
        $this->email = isset($_POST["email"])
            ? filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)
            : null;
        if ($this->email) {
            $User = new User_model();
            $Ramdom_password = new ramdom_helper();
            $this->password = $Ramdom_password->generate();
            $result = $User->reset(
                $this->email,
                password_hash($this->password, PASSWORD_DEFAULT)
            );
            if ($result) {
                $sendmail = new sendmail_helper();
                $sendmail->set_properpies(
                    $this->email,
                    "Reset password",
                    "Hola esta es tu nueva contraseña para iniciar la sesión : " .
                        $this->password
                );

                $send = $sendmail->send();
                if ($send) {
                    header("Location: login");
                } else {
                    echo "Error al enviar el correo";
                }
            } else {
                echo "Error al resetear la contraseña";
            }
        }
    }
}
