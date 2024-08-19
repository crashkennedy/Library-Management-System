<?php

namespace App\model;

use mysqli;

class UserModel
{
    public $firstname;
    public $lastname;
    public $email;
    public $password;

    public function createUser($firstname, $lastname, $email, $password)
    {

        $this->firstname = $firstname;
        $this->$lastname = $lastname;
        $this->email = $email;
        $this->password = $password;


        $conn = new mysqli('localhost', 'root', '', 'important');
        $sql = $conn->prepare('INSERT INTO Users (firstname, lastname, email, password)  VALUES(?,?,?,?)');
        $sql->bind_param('ssss', $firstname, $lastname, $email, $password);
        $sql->execute();
    }

    public function getUser($email)
    {
        $value = "";
        $conn = new mysqli('localhost', 'root', '', 'important');
        $stmt = "SELECT email, password FROM Users WHERE email = '$email'";
        $result = $conn->query($stmt);
        $row = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($row as $val) {
            $value = $val;
        }
        return $value;
    }
}
