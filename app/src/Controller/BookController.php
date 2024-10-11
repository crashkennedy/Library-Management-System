<?php

namespace App\Controller;

use Exception;
use App\model\Book;
use mysqli;


// if (empty($_SESSION['log-in'])) {
//     header('Location:\app\src\view\userLog-in.php');
// }

class BookController
{

    private $bookModel;

    public function __construct()
    {
        $this->bookModel = new Book();
    }

    public function registerBook($title, $author, $genre, $yearPublished, $available, $imgPath)
    {

        $bookModel = $this->bookModel;

        if (!$title) {
            throw new Exception('Title is Required *');
        }
        if (!$author) {
            throw new Exception('Author is Required *');
        }

        if (!$genre) {
            throw new Exception('Genre is Required *');
        }

        if (!$yearPublished) {
            throw new Exception('Year is Required *');
        }

        if (empty($imgPath)) {
            throw new Exception('Image is Required *');
        }

        $book = $bookModel->getBook($title);
        if ($book['title'] == $title) {
            throw new Exception('A Book With This Title Already Exists !!!');
        }

        if (!empty($title) && !empty($author) && !empty($genre) && !empty($yearPublished) && !empty($available) && !empty($imgPath)) {
            $bookModel->addBook($title, $author, $genre, $yearPublished, $available, $imgPath);
        }

        header('Location: \app\src\view\homePage.php ');
    }

    public function removeBook($id)
    {
        $bookModel = $this->bookModel;
        $bookModel->deleteBook($id);
    }

    public function updateBook($title, $author, $genre, $yearPublished, $available, $imagePath, $id)
    {
        $bookModel = $this->bookModel;
        $bookModel->editBook($title, $author, $genre, $yearPublished, $available, $imagePath, $id);
    }
}
