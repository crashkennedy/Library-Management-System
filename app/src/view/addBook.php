<?php
session_start();
require '../../bootsrap.php';

use App\Controller\BookController;

if (empty($_SESSION['log-in'])) {
  header('Location:\app\src\view\userLog-in.php');
}

$title = "";
$author = "";
$genre = "";
$yearPublished = "";
$imgContent = "";

$bookController1 = new BookController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $imagePath = 'uploads/' . $_FILES['image']['name'];
    if (!file_exists(dirname($imagePath))) {
      mkdir(dirname($imagePath));
      move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    }
    $imgContent = $imagePath;
  }

  $title = $_POST['title'];
  $author = $_POST['author'];
  $genre = $_POST['genre'];
  $yearPublished = $_POST['yearPublished'];
  $available = true;


  try {
    $bookController1->registerBook($title, $author, $genre, $yearPublished, $available, $imgContent);
  } catch (\Throwable $x) {
    echo $x->getMessage();
  }
}
?>

<!DOCTYPE HTML>
<html>

<head>
  <link rel="stylesheet" href="css\addBook.css">
</head>

<body>
  <form method='POST' action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>' enctype='multipart/form-data'>

    <div class='form-group'>
      <label>Book title</label>
      <input type='text' name='title' class='form-control' value='<?php echo $title ?>'>

    </div>
    <br><br>
    <div class='form-group'>
      <label>Book author</label>
      <input class="form-control" name="author" value='<?php echo $author ?>'>

    </div>
    <br><br>
    <div class='form-group'>
      <label>Book Genre</label>
      <input type='text' name='genre' class='form-control' value='<?php echo $genre ?>'>

    </div>
    <br><br>
    <div class='form-group'>
      <label>Date Published</label>
      <input type='date' name='yearPublished' class='form-control' value='<?php echo $yearPublished ?>'>

    </div>
    <br><br>
    <!-- <div class='form-group'>
      <label>Available</label>
      <input type='radio' name='available' class='sel' checked='checked' <?php if (isset($available) && $available == 'available') {
                                                                            echo 'checked';
                                                                          } ?> value='available'>
      <label>Unavailable</label>
      <input type='radio' name='available' class='sel' <?php if (isset($available)) {
                                                          echo 'checked';
                                                        } ?>>

    </div> -->
    <br><br>
    <div class='form-group'>
      <label>Book Image</label><br>
      <input type='file' name='image' value=''>

    </div>

    <br>
    <button type='submit' name='upload' class='btn btn-primary'>Add</button>
  </form>
</body>

</html>