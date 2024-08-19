<?php
session_start();

$result = '';
$id = $_GET['bookId'];
$sql = "SELECT * FROM Library WHERE id = '$id'";
$conn = new mysqli('localhost', 'root', '', 'important');
$result = $conn->query($sql);
?>


<!doctype html>
<html>

<head>
  <link rel='stylesheet' href='css\bookDetails.css'>
</head>


<body>
  <a href='homePage.php' class='btn'>
    < </a>
      <h1 class='box'>Book Details</h1>
      <?php

      if ($result->num_rows > 0) {


        if ($row = $result->fetch_assoc()) { ?>

          <div class='details-container'>
            <p> <span class='ind'> Genre: </span> <?php echo $row['genre'] ?> </p>
            <p> <span class='ind'> Year Published: </span> <?php echo $row['yearPublished']  ?> </p>
            <p> <span class='ind'> Status: </span> <?php echo $row['available'] ?> </p>

          <?php } ?>

        <?php } ?>
          </div>
</body>

</html>