<?php
            $Direccion= new mysqli("localhost","root","","tripin");
            $Direccion -> set_charset("utf8mb4");
class Conexion {
    private static $conexion;

    public static function getConexion() {


        if (!isset(self::$conexion)) {
            try {
                $host = 'localhost';
                $dbname = 'tripin';
                $usuario = 'root';
                $contrasena = '';

                self::$conexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $usuario, $contrasena);
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Error de conexión: ' . $e->getMessage());
            }
        }

        return self::$conexion;
    }
}
