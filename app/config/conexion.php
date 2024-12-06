<?php

//creo composer.json para no usar requiere ni requiere_ y se llame directamente a las clases
namespace App\Config;


//creo la clase Conexion;

class Conexion{
//creamos una función para llamar a la conexión desde cualquier lugar del proyecto.
public static function obtenerConexion()
{
    require __DIR__ . '/config.php';

    try {
        //comprobamos que toda la info de la conexión existe
        if (empty($host) || empty($dbname) || empty($user) || empty($password)) {
            die("Error: Configuración de base de datos incompleta.");
        }

        //conectamos con PDO. Añado \ para que php no busque una clase específica sino que use la clase glogal de PDO
        $dbConexion = new \PDO(
            "mysql:host=$host;dbname=$dbname;charset=utf8",
            $user,
            $password,
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );

        //si todo es correcto, devuelve la conexión
        return $dbConexion;

        //si no es correcto nos crea un log de errores a la vez que informa al usuario
    } catch (\PDOException $e) {
        error_log("Error de conexión: Línea" . $e->getLine() . " - Mensaje: " . $e->getMessage());
        die("Error al conectar a la base de datos");
    }
}
}