<?php


$searchValue = $_REQUEST['search'];
if (!$searchValue) {
}

$conn = new mysqli('localhost', 'root', '', 'important');
$stmt = "SELECT * FROM Library WHERE title = '$searchValue' OR author = '$searchValue' OR genre = '$searchValue' OR yearPublished = '$searchValue' ";
$result = $conn->query($stmt);
$row = $result->fetch_all(MYSQLI_ASSOC);



foreach ($row as $book) {
  $src = 'app\src\view\uploads/' . $book['img'];

  echo " <a href ='' class='book-link' id='book'>";

  echo " <div class='grid-item'>";
  echo "<img class='image' src={$src}>";
  echo "<br>";

  echo  "<p class='text'>Title:";
  echo "<br>";
  echo $book['title'];
  echo "</p>";

  echo  "<p class='text'>Author:";
  echo "<br>";
  echo  $book['author'];
  echo "</p>";
  echo "</div>";
  echo "</a>";
}
