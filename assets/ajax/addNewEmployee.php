<?php
if (isset($_POST['n']) && !empty($_POST['n'])) {
    require_once "../php/EmployeeManager.php";
    $name = $_POST['n'];
    if ($employeeMgr->addEmployee($name)) {
        echo "GOOD";
    } else {
        echo "BAD";
    }
} else {
    echo "BAD";
}

