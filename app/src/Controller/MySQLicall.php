<?php

namespace Controller;

use mysqli;

$conn = new mysqli('localhost', 'root', '', 'important');


if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
