<?php
    if (
        (isset($_POST['itm']) && !empty($_POST['itm'])) &&
        (isset($_POST['dsgn']) && !empty($_POST['dsgn'])) &&
        (isset($_POST['stre']) && !empty($_POST['stre']))
    ) {
        require_once "../php/CardManager.php";
        $itm = $_POST['itm'];
        $dsgn = $_POST['dsgn'];
        $stre = $_POST['stre'];
        if ($cardMgr->addCard($itm, $dsgn, $stre)) {
            echo "GOOD";
        } else {
            echo "BAD";
        }
    } else {
        echo "BAD";
    }

