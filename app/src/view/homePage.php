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

  if (!empty($searchValue)) {
    $searchValue = $_POST['sv'];

    $_SESSION['searchValue'] = $searchValue;
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
    <link rel='stylesheet' href='\app\src\view\css\homePage.css'>
    <script src="https://unpkg.com/htmx.org@2.0.2"></script>
  </head>

  <body>



    <script>
      function toggleDropdown() {
        var dropdown = document.getElementById('dropdownContent');
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
      }
    </script>

    <form method='post' class='one' action='' enctype='multipart/form-data'>
      <img class='pic' src='app\src\view\uploads\cook 7 02-01.png' />



      <img class='pic2' src='app\src\view\uploads/5bbc0692ad8e3-4011e1f983b0ea25d0e4f481b3951edb.png' onclick='toggleDropdown()' />
      <div class='dropdown-content' id='dropdownContent'>
        <a href='\app\src\view\userLog-in.php'><input type='submit' value='Log Out' name='btn' class='log'></a>
      </div>


      <input type='text' class='inp' name='search' id='searchInput' hx-get="/search.php" hx-trigger="keyup" , hx-target="#book_container">


      <!-- <button type='submit' name='btn' class='btn'">Search</button> -->

    </form>


    <div class='grid-container' id='book_container'>



      <?php
      foreach ($books as $book) {

      ?>

        <a href=<?php
                $bookId = $book['id'];
                echo 'bookDetails.php/?'  . $bookId;
                ?> class='book-link' id='book'>
          <?php
          // $_SESSION['tag'] = $book['id'];
          ?>
          <div class="grid-item">

            <img class="image" src='<?php echo 'app\src\view\uploads/' . $book['img'] ?>'>

            <br>

            <p class='text'>Title:
              <br>
              <?php echo $book['title'] ?>
            </p>

            <p class='text'>Author:
              <br>
              <?php echo $book['author'] ?>
            </p>
        </a>
    </div>
  <?php } ?>




  <a href='/addBook' class='lnk'>Add A Book </a>

  </body>


  </html>