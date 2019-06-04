<?php
if (
    (isset($_POST['item']) && !empty($_POST['item'])) &&
    (isset($_POST['card']) && !empty($_POST['card']))
) {
    require_once "../php/SewerManager.php";
    $item = $_POST['item'];
    $card = $_POST['card'];
    if ($sewerMgr->addSewer("$item", $card)) {
        echo "GOOD";
    } else {
        echo "BAD";
    }
} else {
    echo "BAD";
}

