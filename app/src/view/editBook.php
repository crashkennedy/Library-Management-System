<?php

use App\Controller\BookController;



session_start();

$title = "";
$author = "";
$genre = "";
$yearPublished = "";
$imgContent = "";

$bookController1 = new BookController();

$result = '';
$id = $_SERVER['QUERY_STRING'];
$sql = "SELECT * FROM Library WHERE id = '$id'";
$conn = new mysqli('localhost', 'root', '', 'important');
$result = $conn->query($sql);
$book = $result->fetch_assoc();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageDir = 'uploads/';
        $imagefile = basename($_FILES['image']['name']);
        $uploadFile = $imageDir . $imagefile;
        var_dump($uploadFile);
        if (!file_exists($imageDir)) {
            mkdir($imageDir);
        }
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {

            $imgContent = $imagefile;
        }
    }
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $yearPublished = $_POST['yearPublished'];
    $available = true;



    try {
        $bookController1->updateBook($title, $author, $genre, $yearPublished, $available, $imgContent, $id);
    } catch (Throwable $e) {
        echo $e->getMessage();
    }
}



?>


<!DOCTYPE HTML>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 80px;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    form {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 500px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
    }

    input[type="text"],
    input[type="date"],
    input[type="file"],
    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        color: #333;
    }

    input[type="radio"] {
        margin-right: 5px;
    }

    .btn {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 18px;
        width: 100%;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    br {
        clear: both;
    }
</style>

<head>
    <link rel='stylesheet' href='css\editBook.css'>
</head>

<body>
    <form method='POST' action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?<?= $id ?>' enctype='multipart/form-data'>
        <div class='form-group'>
            <label>Book title</label>
            <input type='text' name='title' class='form-control' value='<?php echo $book['title'] ?>'>

        </div>
        <br><br>
        <div class='form-group'>
            <label>Book author</label>
            <input class="form-control" name="author" value='<?php echo $book['author'] ?>'>

        </div>
        <br><br>
        <div class='form-group'>
            <label>Book Genre</label>
            <input type='text' name='genre' class='form-control' value='<?php echo $book['genre'] ?>'>

        </div>
        <br><br>
        <div class='form-group'>
            <label>Date Published</label>
            <input type='date' name='yearPublished' class='form-control' value='<?php echo $book['yearPublished'] ?>'>

        </div>
        <br><br>
        <!-- <div class='form-group'>
      <label>Available</label>
      <input type='radio' name='available' class='sel' checked='checked' <?php if (isset($book['available']) && $book['available'] == 'available') {
                                                                                echo 'checked';
                                                                            } ?> value='available'>
      <label>Unavailable</label>
      <input type='radio' name='available' class='sel' <?php if (isset($book['available'])) {
                                                            echo 'checked';
                                                        } ?>>

    </div> -->
        <br><br>
        <div class='form-group'>
            <label>Book Image</label><br>
            <input type='file' name='image' value=''>

        </div>

        <br>
        <button type='submit' name='upload' class='btn btn-primary'>Edit</button>
    </form>

</body>

</html>