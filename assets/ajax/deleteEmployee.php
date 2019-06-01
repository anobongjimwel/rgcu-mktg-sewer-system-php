<?php
if (isset($_POST['id']) && !empty($_POST['id'])) {
    require_once "../php/EmployeeManager.php";
    $id = $_POST['id'];
    if ($employeeMgr->deleteEmployee($id)) {
        echo "GOOD";
    } else {
        echo "BAD";
    }
} else {
    return "BAD";
}

