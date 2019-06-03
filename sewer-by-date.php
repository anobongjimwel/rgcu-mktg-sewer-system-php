<?php require_once "assets/php/SewerManager.php"?>
<!DOCTYPE html>
<html>

<head>
    <title>RGCU Sewer</title>
    <?php include_once "assets/includes/genHeader.php"?>
</head>

<body>
    <?php include_once "assets/includes/navbar.php"?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12" id="page-heading">
                <h2>View Sewers By Date</h2>
                <div></div>
                <form method="get" action="sewer-by-date.php">
                    <div class="form-group"><input class="form-control" type="date" name="date" id="date" <?php echo (isset($_GET['date']) && !empty($_GET['date'])) ? "value='".$_GET['date']."'" : null ; ?>style="width:100%;">
                        <div style="height:10px;"></div><button class="btn btn-primary float-right" type="submit" name="sewerFilterSubmit" value="sewerFilterSubmit">View</button></div>
                </form>
            </div>
            <div class="col col-12" id="page-form" style="padding-top:20px;"><div id="ajaxTable">
    <table class='table equal-width table-hover table-bordered table-responsive-xs'>
        <tbody>
            <tr>
                <th rowspan=2 style='text-align: center; vertical-align: middle'>CN</th>
                <th rowspan=2 style='text-align: center; vertical-align: middle'>Item</th>
                <th colspan=3 style='text-align: center'>Sewer</th>
                <th colspan=3 style='text-align: center'>Packing</th>
            </tr>
            <tr>
                <th style='text-align: center'>Edging</th>
                <th style='text-align: center'>Piping</th>
                <th style='text-align: center'>Lock</th>
                <th style='text-align: center'>Trim</th>
                <th style='text-align: center'>Quality Control</th>
                <th style='text-align: center'>Pack</th>
            </tr>
            <?php
                if (isset($_GET['date']) && !empty($_GET['date']) ) {
                    if (isset($_GET['sewerFilterSubmit']) && !empty($_GET['sewerFilterSubmit'])) {
                        $counter = $sewerMgr->getSewersIDwithFilterCounter($_GET['date']);
                        $getter = $sewerMgr->getSewersIDwithFilter($_GET['date']);
                    } else {
                        $counter = $sewerMgr->countSewers();
                        $getter = $sewerMgr->getSewersID();
                    }
                } else {
                    $counter = $sewerMgr->countSewers();
                    $getter = $sewerMgr->getSewersID();
                }
                if ($counter != 0) {
                    foreach ($getter as $sewer) {
                        echo "<tr>";
                        echo "<td>" . $sewer['card_number'] . "</td>";
                        echo "<td>" . $sewerMgr->getSewerItem($sewer['id']) . "</td>";
                        for ($i = 1; $i <= 6; $i++) {
                            echo "<td>" . $sewerMgr->getSewerSpecificStatusAndDate($sewer['id'], $i)['name'] . "<br />" . (is_null($sewerMgr->getSewerSpecificStatusAndDate($sewer['id'], $i)['date']) ? "" : date("F d, Y", strtotime($sewerMgr->getSewerSpecificStatusAndDate($sewer['id'], $i)['date']))) . "</td>";
                        }
                        echo "</tr>";
                    }
                }
            ?>
            <!-- UI Preview Purposes Only
            <tr>
                <td>ID</td>
                <td>Sample Item</td>
                <td>Jimwel Anobong<br />Jun 20, 2019</td>
                <td>Jimwel Anobong<br />Jun 20, 2019</td>
                <td>Jimwel Anobong<br />Jun 20, 2019</td>
                <td>Jimwel Anobong<br />Jun 20, 2019</td>
                <td>Jimwel Anobong<br />Jun 20, 2019</td>
                <td>Jimwel Anobong<br />Jun 20, 2019</td>
                <td><a href="#">View</a> · <a href="#">Delete</a></td>
            </tr>
            -->
        </tbody>
    </table>
</div></div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>