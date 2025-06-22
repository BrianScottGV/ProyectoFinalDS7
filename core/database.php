<?php
    include "config.php";

    class BaseDeDatos {

        public static function ConectarSinDB() {
            try {
                $conexion = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS);
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conexion;
            } catch (PDOException $e) {
                die("Error de conexión (Sin DB): " . $e->getMessage());
            }
        }

        public static function Conectar() {
            try {
                $conexion = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conexion;
            } catch (PDOException $e) {
                die("Error de conexión (Con DB): " . $e->getMessage());
            }
        }

        public static function CrearDB() {
            try {
                // CREAR BASE DE DATOS SI NO EXISTE
                $conexionSinDB = self::ConectarSinDB();
                $conexionSinDB->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME . " CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");

                $conexion = self::Conectar();

                // EJECUTA EL SCRIPT init.sql
                $sql = file_get_contents(__DIR__ . '/../sql/init.sql');
                $conexion->exec($sql);

            } catch (PDOException $e) {
                die("Error al crear la base de datos: " . $e->getMessage());
            }
        }
    }
?>
