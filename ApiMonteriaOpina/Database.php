<?php
class Database
{
    private static $dbName = 'u9264487_opina';
    private static $dbHost = '127.0.0.1';
    private static $dbUsername = 'u9264487_monteria';
    private static $dbUserPassword = '6AXUsg..FI4d';

    private static $cont = null;

    public function __construct() {
        die('Fallo la conexion');
    }

    public static function connect() {
        if (null === self::$cont) {
            try {
                self::$cont =  new PDO('pgsql:host='.self::$dbHost.'; dbname='.self::$dbName, self::$dbUsername, self::$dbUserPassword);
            } catch(PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$cont;
    }

    public static function disconnect() {
        self::$cont = null;
    }
}
