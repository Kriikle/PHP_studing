<?php

namespace Core;

//The name of the class is taken from the lesson
use mysqli;
use mysqli_sql_exception;

class Db
{
    private mysqli $conn;
    private static Db $instance;

    private function __construct()
    {

    }

    private function __clone()
    {

    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    function getConnection(): mysqli
    {

        $dbHost = DB_HOST;
        $dbUser = DB_USER;
        $dbPass = DB_PASS;
        $db = DB_NAME;

        if (!isset($this->conn)) {
            $conn = new mysqli($dbHost, $dbUser, $dbPass,$db);
            if ($conn->connect_error) {
                die("db Connection failed: " . $conn->connect_error);
            } else{
                $this->conn = $conn;
            }
        }


        return $this->conn;
    }

    function CloseCon(): void
    {
        $this->conn->close();
    }

    public function lastInsertId()
    {
        return $this->getConnection()->insert_id;
    }

    //Insert or update
    public function executeQuery(string $query, ... $params): void
    {
        $stmt = $this->getConnection()->prepare($query);
        $stmt->bind_param(str_repeat('s',count($params)), ...$params);
        try {
            $stmt->execute();
            //file_put_contents('bd.logs', $stmt->get_result() . "\n");
            print_r($stmt->get_result());
        } catch (mysqli_sql_exception  $e) {
            echo $e->getMessage() ;
            file_put_contents('bd.logs', $e->getMessage() . "\n");
        }
    }


}