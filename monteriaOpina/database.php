<?php
class Database
{
    public static function StartUp()
    {
        $pdo = new PDO('pgsql:host=localhost;dbname=monteriaopinadb;', 'postgres', 'root');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        return $pdo;
    }
}
