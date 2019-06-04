<?php
require_once "../requires/dbcon.php";
$query = $db->query('SELECT max(id) as id from SEWERS');
echo $query->fetch(PDO::FETCH_ASSOC)['id'];