<?php
    if (
        (isset($_POST['item']) && !empty($_POST['item'])) &&
        (isset($_POST['card']) && !empty($_POST['card'])) &&
        (isset($_POST['qty']) && !empty($_POST['qty'])) &&
        (isset($_POST['u_p']) && !empty($_POST['u_p'])) &&
        (isset($_POST['amt']) && !empty($_POST['amt']))
    ) {
        require_once "../php/SewerManager.php";
        $item = $_POST['item'];
        $card = $_POST['card'];
        $qty = $_POST['qty'];
        $u_p = $_POST['u_p'];
        $amt = $_POST['amt'];
        if ($sewerMgr->addSewer("$item", $card, $qty, $u_p, $amt)) {
            echo "GOOD";
        } else {
            echo "BAD";
        }
    } else {
        echo "BAD";
    }

