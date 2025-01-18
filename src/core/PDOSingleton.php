<?php
namespace Src\core;
use PDO;
use PDOException;

class PDOSingleton {
    private static ?PDO $pdo = null;

    private static function conectar(){
        try {
            $dsn = 'mysql:dbname=' . $_ENV['DB_DATABASE'] . ';host=' . $_ENV['DB_HOST'] . ';charset=utf8';
            $username = $_ENV['DB_USERNAME'];
            $password = $_ENV['DB_PASSWORD'];
            $options = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ];

            return new PDO( $dsn, $username, $password, $options );
        } catch( PDOException $e ){
            throw $e;
        }
    }

    public static function get(){
        if( ! self::$pdo instanceof PDO ){
            self::$pdo = self::conectar();
        }

        return self::$pdo;
    }

    public static function beginTransaction() {
        self::get()->beginTransaction();
    }

    public static function commit() {
        self::get()->commit();
    }

    public static function rollBack() {
        self::get()->rollBack();
    }
}