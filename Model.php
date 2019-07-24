<?php

class Model
{

    protected static $_instance;
    private static $conn;

    private function __construct()
    {
        self::$conn = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    public function __toString()
    {
        return __CLASS__;
    }

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    private static function sendQuery($query, $param)
    {
        $sth = self::$conn->prepare($query);
        if ($sth->execute($param)) {
            return $sth;
        } else {
            return false;
        }

    }

    public function getBooksAuthor($id)
    {
        $query = "SELECT author.surname as author, books.name, publisher.name as publisher, books.date_manufacture FROM books INNER JOIN publisher ON books.id_publisher = publisher.id INNER JOIN author ON books.id_author = author.id WHERE id_author = ?";
        $sth = self::sendQuery($query, [$id]);
        if ($sth) {
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function addBook($param)
    {
        $query = "INSERT INTO books (id_author, date_manufacture, name, id_publisher) VALUES (:id_author, :date_manufacture, :name, :id_publisher)";
        if (self::sendQuery($query, $param)) {
            return true;
        } else {
            return false;
        }
    }

    public function changeAuthorBook($param)
    {
        $query = "UPDATE books SET id_author = :id_author WHERE books.id = :id_book";
        return self::sendQuery($query, $param);

    }

    public function delAuthor($param)
    {
        $query = "DELETE FROM author WHERE author.id = ?";
        return self::sendQuery($query, $param);
    }
}