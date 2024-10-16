<?php
session_start();


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
    $bookController1->registerBook($title, $author, $genre, $yearPublished, $available, $imgContent);
  } catch (\Throwable $x) {
    echo $x->getMessage();
  }
}
?>

<!DOCTYPE HTML>
<html>

<head>
  <link rel="stylesheet" href="app\src\view\css\addBook.css">
</head>

<body>
  <form method='POST' action='/addBook' enctype='multipart/form-data'>

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
      <input list="browsers" value="<?php echo $genre ?>" name='genre' class='form-control' name="myBrowser" />
      <datalist id="browsers">
        <option value="Crime">
        <option value="Adventure">
        <option value="Religious">
        <option value="Music">
        <option value="Tech">
        <option value="Education">
      </datalist>


    </div>
    <br><br>
    <div class='form-group'>
      <label>Date Published</label>
      <input type='date' name='yearPublished' class='form-control' value='<?php echo $yearPublished ?>'>

    </div>
    <br><br>
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