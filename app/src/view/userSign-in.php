<?php
session_start();


use App\Controller\UserController;

$firstname = "";
$lastname = "";
$email = "";
$password = "";



$userController = new UserController();


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['firstname']) && isset($_POST['lastname'])  && isset($_POST['email']) && isset($_POST['password'])) {
        $firstname = test_input($_POST['firstname']);
        $lastname = test_input($_POST['lastname']);
        $email = test_input($_POST['email']);
        $password = test_input($_POST['password']);

        try {
            $userController->registerUser($firstname, $lastname, $email, $password);

            $_SESSION['log-in'] = "logged-in";
            header('Location: \app\src\view\homePage.php');
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }
    }
}
?>


<!DOCTYPE HTML>
<html>

<head>
    <link rel='stylesheet' href='app\src\view\css\userSign-in.css'>
</head>

<body>

    <form method='post' action='\app\src\view\userSign-in.php'>
        <?php if (isset($_SESSION['err'])) { ?>
            <span class="err"><?php echo $_SESSION['err'] ?></span>
        <?php unset($_SESSION['err']);
        } ?>



        <label> FirstName: </label>
        <input type='text' id="firstname" name='firstname' value='<?php echo $firstname; ?>'>

        <p id="err1"></p>

        <script>
            let namePattern = /^[a-zA-Z ]{2,30}$/
            let firstname = document.getElementById("firstname")
            if (firstname.value.length !== 0) {
                console.log(firstname.value)
                if (!namePattern.test(firstname.value)) {

                    document.getElementById("err1").innerHTML = "Invalid Firstname";
                }
            }
        </script>


        <br><br>

        <label> LastName: </label>
        <input type='text' id="lastname" name='lastname' value='<?php echo $lastname; ?>'>

        <p id="err2"></p>

        <script>
            let lastname = document.getElementById("lastname")
            if (lastname.value.length !== 0) {
                if (!namePattern.test(lastname.value)) {

                    document.getElementById("err2").innerHTML = "Invalid Lastname";
                }
            }
        </script>

        <br><br>

        <label>E-mail:</label>
        <input type='text' id="email" name='email' value='<?php echo $email; ?>'>

        <p id="err3"></p>

        <script>
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/
            const input = document.getElementById("email")
            const inputval = input.value
            let err = emailPattern.test(inputval)
            if (input.value.length !== 0) {
                if (!err) {
                    document.getElementById("err3").innerHTML = "Invalid Email Format";
                }
            }
        </script>

        <br><br>

        <label>Password:</label>
        <input type='password' name='password' value='<?php echo $password; ?>'>


        <br><br>
        <input type='submit' name='submit' value='Submit'>

    </form>


</body>

</html>