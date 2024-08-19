<?php
session_start();
require '../../bootsrap.php';

use App\Controller\AuthController;


$email = "";
$password = "";


$authCont = new AuthController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $authCont->loginUser($email, $password);

        $_SESSION['log-in'] = "logged-in";
        header('Location: \app\src\view\homePage.php');
    } catch (\Throwable $e) {
        $error = $e->getMessage();
    }
}
?>


<!DOCTYPE HTML>
<html>

<head>
    <link rel='stylesheet' href='css\userLog-in.css'>
</head>

<body>


    <form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>' method='post'>

        <label> Email: </label>
        <input type='text' name='email' value='<?php echo $email ?>'>
        <?php if (isset($_SESSION['error1'])) { ?>
            <span class="error1"> <?php echo $_SESSION['error1']; ?></span>

        <?php
            unset($_SESSION['error1']);
        }
        ?>
        <label> Password: </label>
        <input type='password' name='password' value='<?php echo $password ?>'>
        <?php if (isset($_SESSION['error2'])) { ?>

            <span class="error1"><?php echo $_SESSION['error2']; ?></span>

        <?php unset($_SESSION['error2']);
        } ?>

        <input type='submit' name='submit'>


        <span>Don't Have An Account? <a href='\app\src\view\userSign-in.php'>Sign-Up</a></span>
    </form>
</body>

</html>