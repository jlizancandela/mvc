<?php

namespace App\Models;

use App\Models\model;
use PDO;
use PDOException;

class User_model extends model
{
    // ----------------------------------------------------------------
    // Login
    // ----------------------------------------------------------------
    public function login($email, $password)
    {
        $query = "select * from Users where Email = :email";
        $smtp = $this->pdo->prepare($query);
        $smtp->execute(["email" => $email]);
        $result = $smtp->fetch(PDO::FETCH_ASSOC);

        if ($smtp->rowCount() == 0) {
            return false;
        }

        return $result;
    }
    // ----------------------------------------------------------------
    // Devuelve todos los usuarios
    // ----------------------------------------------------------------
    public function getAll()
    {
        $query = "select * from Users";
        $smtp = $this->pdo->prepare($query);
        $smtp->execute();
        $result = $smtp->fetchAll(PDO::FETCH_ASSOC);

        if ($smtp->rowCount() == 0) {
            return false;
        }

        return $result;
    }
    // ----------------------------------------------------------------
    // Devuelve las direcciones del usuario
    // ----------------------------------------------------------------
    public function getDirections($email)
    {
        $query =
            "select * from Direccion where Usuario = (select Codigo from Users where Email = :email)";
        $smtp = $this->pdo->prepare($query);
        $smtp->execute(["email" => $email]);
        $result = $smtp->fetchAll(PDO::FETCH_ASSOC);

        if ($smtp->rowCount() == 0) {
            return false;
        }

        return $result;
    }
    // ----------------------------------------------------------------
    // Devuelve el rol del usuario
    // ----------------------------------------------------------------
    public function getRol($email)
    {
        $query = "select Rol from Users where Email = :email";
        $smtp = $this->pdo->prepare($query);
        $smtp->execute(["email" => $email]);
        $result = $smtp->fetch(PDO::FETCH_ASSOC);

        if ($smtp->rowCount() == 0) {
            return false;
        }

        return $result;
    }
    // ----------------------------------------------------------------
    // Registra un nuevo usuario
    // ----------------------------------------------------------------
    public function register($array)
    {
        $rol = isset($array["rol"]) ? $array["rol"] : "User";

        try {
            var_dump($array);
            $query = 'INSERT INTO Users (Nombre,Passwd,Email,Telefono,Rol) 
                    values (:nombre,:passwd,:email,:telefono,:rol)';
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ":nombre" => $array["nombre"],
                ":passwd" => $array["password"],
                ":email" => $array["email"],
                ":telefono" => $array["telefono"],
                ":rol" => $rol,
            ]);

            $lastId = $this->pdo->lastInsertId();
            var_dump($lastId);

            $query = 'INSERT INTO Direccion (Usuario, Direccion, CP, Provincia)
                            VALUES (:usuario, :direccion, :cp, :provincia);';

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ":usuario" => $lastId,
                ":direccion" => $array["direccion"],
                ":cp" => $array["cp"],
                ":provincia" => $array["provincia"],
            ]);

            if ($stmt->rowCount() == 0) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // ----------------------------------------------------------------
    // Actualiza un usuario
    // ----------------------------------------------------------------
    public function update($array)
    {
        $sql = 'UPDATE Users 
                SET Nombre = :nombre,
                Telefono = :telefono,
                Email = :email,
                Rol = :rol 
                WHERE Codigo = :id';

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            "nombre" => $array["Nombre"],
            "telefono" => $array["Telefono"],
            "email" => $array["Email"],
            "rol" => $array["Rol"],
            "id" => $array["Id"],
        ]);

        if ($stmt->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }
    // ----------------------------------------------------------------
    // Actualiza la dirección de un usuario
    // ----------------------------------------------------------------
    public function updateDirections($array)
    {
        $sql = 'UPDATE Direccion 
                SET Direccion = :direccion,
                CP = :cp,
                Provincia = :provincia
                WHERE Codigo = :codigo';

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            "direccion" => $array["Direccion"],
            "cp" => $array["CP"],
            "provincia" => $array["Provincia"],
            "codigo" => $array["Codigo"],
        ]);

        if ($stmt->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }
    //--------------------------------------------------------
    // Crea la dirección de un usuario
    //--------------------------------------------------------
    public function create_directions($array)
    {
        $sql = 'INSERT INTO Direccion (Usuario, Direccion, CP, Provincia)
                VALUES (:usuario, :direccion, :cp, :provincia)';

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            "direccion" => $array["Direccion"],
            "cp" => $array["CP"],
            "provincia" => $array["Provincia"],
            "usuario" => $array["Codigo"],
        ]);

        if ($stmt->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }
    //--------------------------------------------------------
    //Elimina la dirección de un usuario
    //--------------------------------------------------------
    public function delete_directions($id)
    {
        $sql = "DELETE FROM Direccion WHERE Codigo = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            "id" => $id,
        ]);

        if ($stmt->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }
    //--------------------------------------------------------
    //Elimina un usuario
    //--------------------------------------------------------
    public function delete($id)
    {
        $sql = "DELETE FROM Users WHERE Codigo = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            "id" => $id,
        ]);

        if ($stmt->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }
    //---------------------------------------------------------
    // Resetea la contraseña de un Usuario
    //---------------------------------------------------------
    public function reset($email, $password)
    {
        try {
            $query = "UPDATE Users SET Passwd = :password WHERE Email = :email";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ":password" => $password,
                ":email" => $email,
            ]);
            if ($stmt->rowCount() == 0) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    //--------------------------------------------------------
    // Registra en la base de datos los inicios de sesión
    //--------------------------------------------------------
    public function register_error($email, $result)
    {
        $email = isset($email) ? $email : null;
        $result = isset($result) ? $result : null;

        $query =
            "insert into Login (Email, Resultado, Ip) values (:email,:result,:ip)";
        $smtp = $this->pdo->prepare($query);

        //var_dump($email, $result, $_SERVER['REMOTE_ADDR']);
        $smtp->execute([
            ":email" => $email,
            ":result" => $result,
            ":ip" => $_SERVER["REMOTE_ADDR"],
        ]);
    }
}
