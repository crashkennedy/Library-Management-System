<?php

namespace App\Controller;


use App\model\UserModel;
use Exception;


class UserController
{

    private $usermodel;

    public function __construct()
    {
        $this->usermodel = new UserModel();
    }

    public function registerUser($firstname, $lastname, $email, $password)
    {

        $usermodel = $this->usermodel;

        if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
            $_SESSION['err'] = 'All Fields Are Required!';
            throw new Exception();
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid Email');
        }

        if (!preg_match("/^[a-zA-Z-' ]*$/", $firstname)) {
            throw new Exception('Only letters and white space allowed');
        }

        if (!preg_match("/^[a-zA-Z-' ]*$/", $lastname)) {
            throw new Exception('Only letters and white space allowed');
        }


        $hash = password_hash(
            $password,
            PASSWORD_DEFAULT
        );



        if ($usermodel->getUser($email)) {
            throw new Exception('A User With This Email Address Already Exists!');
        }

        $usermodel->createUser($firstname, $lastname, $email, $hash);
    }
}
