<?php
if (isset($_POST['id']) && !empty($_POST['id'])) {
    require_once "../php/SewerManager.php";
    $id = $_POST['id'];
    if ($sewerMgr->deleteSewer($id)) {
        echo "GOOD";
    } else {
        echo "BAD";
    }
} else {
    return "BAD";
}

