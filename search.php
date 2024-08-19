<?php
$searchValue = $_REQUEST['searchValue'];

$stmt = "SELECT * FROM Library WHERE (title = '$searchValue' OR author = '$searchValue' OR genre = '$searchValue' OR yearPublished = '$searchValue')";
  $result = $conn->query($stmt);
  $books = $result->fetch_all(MYSQLI_ASSOC); 

  echo $books;