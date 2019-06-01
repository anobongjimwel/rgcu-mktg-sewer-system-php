<?php
$username = "root";
$password = "";
$destination = "mysql:host=localhost;dbname=rgcu_sewer";

$db = new PDO($destination, $username, $password);