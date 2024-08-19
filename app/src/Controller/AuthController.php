<?php

namespace App\Controller;


require '../../bootsrap.php';

use App\model\UserModel;
use Exception;


class AuthController
{

    private $usermodel;

    public function __construct()
    {
        $this->usermodel = new UserModel();
    }
    public function loginUser($email, $password)
    {
        $usermodel = $this->usermodel;

        $user = $usermodel->getUser($email);

        if (empty($email) || empty($user['email'])) {
            $_SESSION['error1'] = 'Email Error!';
            throw new Exception("Input Error");
        }


        if (empty($password) || !password_verify($password, $user['password'])) {
            $_SESSION['error2'] = 'Password Error!';
            throw new Exception("Input Error");
        }
    }
}
