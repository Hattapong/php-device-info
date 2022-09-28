<?php

// $servername = "localhost";
// $username = "dvuser";
// $password = "wtf";
// $dbname = "device_info";




class Database
{





    public static function getConnection()
    {

        $servername = "localhost";
        $username = "dvuser";
        $password = "wtf";
        $dbname = "device_info";

        try {


            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }


    public static function execute($sql, $params = null)
    {

        $conn = self::getConnection();

        $stmt = $conn->prepare($sql);

        try {
            if ($params && is_array($params))
                return $stmt->execute($params);
            else
                return $stmt->execute();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function getTable($sql, $params = null)
    {

        $conn = self::getConnection();

        $stmt = $conn->prepare($sql);
        if ($params && is_array($params))
            $stmt->execute($params);
        else
            $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    public static function getFirst($sql, $params)
    {

        $conn = self::getConnection();

        $stmt = $conn->prepare($sql);

        if ($params && is_array($params))
            $stmt->execute($params);
        else
            $stmt->execute();


        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        try {
            return $stmt->fetch();
        } catch (\Throwable $th) {
            return false;
        }
    }


    public static function addCustomer($name)
    {

        if (!isset($name)) return 0;

        $conn = self::getConnection();

        $sql = "insert into customer(name) values(:name)";

        $stmt = $conn->prepare($sql);

        $stmt->execute([
            ':name' => $name
        ]);


        return $conn->lastInsertId();
    }
}