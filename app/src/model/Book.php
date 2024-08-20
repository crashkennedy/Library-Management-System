<?php

namespace App\model;

use mysqli;

class Book
{
    public $title;
    public $author;
    public $genre;
    public $yearPublished;
    public $available;
    public $imagePath;

    public function addBook($title, $author, $genre, $yearPublished, $available, $imagePath)
    {

        $this->title = $title;
        $this->author = $author;
        $this->genre = $genre;
        $this->yearPublished = $yearPublished;
        $this->available = $available;
        $this->imagePath = $imagePath;

        $conn = new mysqli('localhost', 'root', '', 'important');
        $sql = $conn->prepare('INSERT INTO Library (title, author, genre, yearPublished, available, img)  VALUES(?,?,?,?,?,?)');
        $sql->bind_param('sssiss', $this->title, $this->author, $this->genre, $this->yearPublished, $this->available, $this->imagePath);
        $sql->execute();

        header('Location: \app\src\view\homePage.php');
    }

    public function getBook($title)
    {
        $conn = new mysqli('localhost', 'root', '', 'important');
        $stmt = "SELECT * FROM Library WHERE title = '$title' ";
        $result = $conn->query($stmt);
        $row = $result->fetch_assoc();
        return $row;
    }


    public function getAllBooks($title)
    {
        $value = "";
        $conn = new mysqli('localhost', 'root', '', 'important');
        $stmt = "SELECT * FROM Library ";
        $result = $conn->query($stmt);
        $row = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($row as $val) {
            $value = $val;
        }
        return $value;
    }
}
