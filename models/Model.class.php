<?php

abstract class Model
{
    private static $pdo;

    private static function setBdd()
    {
        self::$pdo = new PDO("mysql:host=mysql_SIS;dbname=sudidfsecourisme;charset=utf8", "sudidfsecourisme", "sudidfsecourisme");
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    protected function getBdd()
    {
        if (self::$pdo === null) {
            self::setBdd();
        }
        return self::$pdo;
    }
}
