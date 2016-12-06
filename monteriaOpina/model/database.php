<?php
class Database
{
    public static function StartUp()
    {
         $pdo = new PDO('pgsql:host=127.0.0.1;dbname=u9264487_opina;', 'u9264487_monteria', '6AXUsg..FI4d');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        return $pdo;
    }
}
