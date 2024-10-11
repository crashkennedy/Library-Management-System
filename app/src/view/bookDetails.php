<?php

use App\Controller\BookController;




session_start();
$bookController1 = new BookController();

$result = '';

$id = $_SERVER['QUERY_STRING'];
$sql = "SELECT * FROM Library WHERE id = '$id'";
$conn = new mysqli('localhost', 'root', '', 'important');
$result = $conn->query($sql);
$book = $result->fetch_assoc();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $bookController1->removeBook($id);
}

?>


<!DOCTYPE HTML>

<html>
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: 'Arial', sans-serif;
    background-color: #fdfdfd;
    color: #333;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
  }

  /* Back button */
  .btn {
    position: absolute;
    top: 20px;
    left: 20px;
    color: #2c3e50;
    background-color: #ecf0f1;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    font-size: 22px;
    transition: background-color 0.3s ease;
  }

  .btn:hover {
    background-color: #bdc3c7;
  }

  /* Page title */
  .box {
    font-size: 32px;
    font-weight: bold;
    color: #34495e;
    margin-bottom: 20px;
    text-align: center;
  }

  /* Details container */
  .details-container {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
    width: 80%;
    max-width: 600px;
    margin-bottom: 20px;
  }

  .details-container p {
    font-size: 18px;
    margin-bottom: 15px;
    color: #7f8c8d;
  }

  .ind {
    font-weight: bold;
    color: #2c3e50;
  }

  /* Buttons */
  .delbtn,
  .edit {
    display: inline-block;
    padding: 12px 25px;
    font-size: 16px;
    border-radius: 8px;
    text-transform: uppercase;
    cursor: pointer;
    text-align: center;
    border: none;
    margin: 10px;
    transition: background-color 0.2s ease, box-shadow 0.2s ease;
  }

  .delbtn {
    background-color: #e74c3c;
    color: #fff;
  }

  .delbtn:hover {
    background-color: #c0392b;
    box-shadow: 0 5px 15px rgba(231, 76, 60, 0.2);
  }

  .edit {
    background-color: #2980b9;
    color: #fff;
  }

  .edit:hover {
    background-color: #3498db;
    box-shadow: 0 5px 15px rgba(52, 152, 219, 0.2);
  }

  /* Link inside edit button */
  .edit a {
    color: #fff;
    text-decoration: none;
    display: inline-block;
    width: 100%;
    height: 100%;
  }
</style>

<head>
  <link rel='stylesheet' href='css\bookDetails.css'>
</head>

<body>
  <a href='\app\src\view\homePage.php' class='btn'>
    < </a>
      <h1 class='box'>Book Details</h1>
      <?php

      if ($result->num_rows > 0) {


        if ($book) { ?>

          <div class='details-container'>
            <p> <span class='ind'> Genre: </span> <?php echo $book['genre'] ?> </p>
            <p> <span class='ind'> Year Published: </span> <?php echo $book['yearPublished']  ?> </p>
            <p> <span class='ind'> Status: </span> <?php echo $book['available'] ?> </p>

        <?php }
      } ?>

          </div>

          <form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?<?= $id ?>' method='post'>
            <input type="submit" name="Delete"
              class="delbtn" value="Delete Book" />
          </form>
          <button class="edit"><a href=<?php echo '\app\src\view\editBook.php/?' . $id;  ?>>Edit Book</a></button>
</body>



</html>