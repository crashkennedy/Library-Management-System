  <?php
  session_start();

  if (empty($_SESSION['log-in'])) {
    header('Location:\app\src\view\userLog-in.php');
  }

  if (isset($_POST['btn'])) {
    $_SESSION['log-in'] = '';
    session_unset();
  }

  $books = '';
  $result = '';
  // var_dump($_POST);
  if (!empty($searchValue)) {
    $searchValue = $_POST['sv'];

    $_SESSION['searchValue'] = $searchValue;
    var_dump($searchValue);
    // $stmt = ("SELECT * FROM Library WHERE (title = '$searchValue' OR author = '$searchValue' OR genre = '$searchValue' OR yearPublished = '$searchValue')");
    // $result = $conn->query($stmt);
    // $books = $result->fetch_all(MYSQLI_ASSOC);
    // $_SESSION['searchValue'] = "";
    var_dump($_SESSION);
  } else {
    $sql = 'SELECT * FROM Library';
    $conn = new mysqli('localhost', 'root', '', 'important');
    $result = $conn->query($sql);
    $books = $result->fetch_all(MYSQLI_ASSOC);
  }
  ?>


  <html !doctype>
  <html>

  <head>
    <link rel='stylesheet' href='css\homePage.css'>
  </head>

  <body>

    <script>
      function displayBook(searchValue) {
        if (searchValue.length === 0) {
          console.log(book);
        } else {
          const xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              console.log(this.responseText)
              xmlhttp.open('GET', 'search.php?searchValue=' + searchValue, true)
              xmlhttp.send()
            }
          }

        }

      }
    </script>

    <script>
      function toggleDropdown() {
        var dropdown = document.getElementById('dropdownContent');
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
      }
    </script>

    <form method='post' class='one' action='' enctype='multipart/form-data'>
      <img class='pic' src='uploads\cook 7 02-01.png' />


      <img class='pic2' src='uploads/5bbc0692ad8e3-4011e1f983b0ea25d0e4f481b3951edb.png' onclick='toggleDropdown()' />
      <div class='dropdown-content' id='dropdownContent'>
        <a href='\app\src\view\userLog-in.php'><input type='submit' value='Log Out' name='btn' class='log'></a>
      </div>


      <input type='text' class='inp' name='sv' id='searchInput' onkeyup='displayBook(this.value)'>


      <button type='submit' name='btn' class='btn'>Search</button>

    </form>


    <div class='grid-container' id='book_container'>



      <?php
      foreach ($books as $book) {
      ?>
        <form method='post' class='two'>

          <a href=<?php echo 'bookDetails.php?bookId=' . $book['id'] ?> class='book-link' id='book'>
            <div class="grid-item">

              <img src='<?php echo $book['img'] ?>' height='150px' width='100px'>
              <br>

              <p class='text'>Title:</p>
              <span class='bold'>
                <?php

                echo $book['title'] ?> </span>
              <br>
              <p class='text'>Author:</p>
              <span class='bold'><?php echo $book['author'] ?></span>


              <br>
            </div>
          </a>
        </form>
      <?php } ?>
    </div>

    <a href='\app\src\view\addBook.php' class='lnk'>Add A Book </a>

  </body>
  <!-- <script>
 const book = document.querySelector('button').addEventListener("click",function(e){
 e.preventDefault()
       console.log(e.target.id) 
 })
</script> -->

  </html>