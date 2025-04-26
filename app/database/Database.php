<?php
class Database
{

    public static function conectar()
    {
        $host = "mysql";
        $port = 3306;
        $username = "root";
        $password = "12345678";
        $name = "arquivosdb";

        $connUrl = "mysql:host=$host;port=$port;dbname=$name;charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

        return new PDO($connUrl, $username, $password, $options);
    }

}