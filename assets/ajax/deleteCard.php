<?php
if (isset($_POST['id']) && !empty($_POST['id'])) {
    require_once "../php/CardManager.php";
    $id = $_POST['id'];
    if ($cardMgr->deleteCard($id)) {
        echo "GOOD";
    } else {
        echo "BAD";
    }
} else {
    return "BAD";
}

