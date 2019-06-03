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
                <form>
                    <div class="form-group"><input class="form-control" type="date" style="width:100%;">
                        <div style="height:10px;"></div><button class="btn btn-primary float-right" type="button">View</button></div>
                </form>
            </div>
            <div class="col col-12" id="page-form" style="padding-top:20px;"><div id="ajaxTable">
    <table class='table equal-width table-hover table-bordered table-responsive-xs'>
        <tbody>
            <tr>
                <th rowspan=2 style='text-align: center; vertical-align: middle'>ID</th>
                <th rowspan=2 style='text-align: center; vertical-align: middle'>Item</th>
                <th colspan=3 style='text-align: center'>Sewer</th>
                <th colspan=3 style='text-align: center'>Packing</th>
                <th rowspan=2 style='text-align: center; vertical-align: middle'>Actions</th>
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
                if ($sewerMgr->countSewers()!=0) {
                    foreach ($sewerMgr->getSewersID() as $sewer) {
                        echo "<tr>";
                        echo "<td>" . $sewer['id'] . "</td>";
                        echo "<td>" . $sewerMgr->getSewerItem($sewer['id']) . "</td>";
                        for ($i = 1; $i <= 6; $i++) {
                            echo "<td>". $sewerMgr->getSewerSpecificStatusAndDate($sewer['id'],$i)['name'] . "<br />" . (is_null($sewerMgr->getSewerSpecificStatusAndDate($sewer['id'],$i)['date']) ? "" : date("F d, Y", strtotime($sewerMgr->getSewerSpecificStatusAndDate($sewer['id'],$i)['date']))) . "</td>";
                        }
                        echo "<td><a href=\"sewer.php?id=" . $sewer['id'] . "\">View</a> · <a href=\"#\" onclick='deleteSewer(" . $sewer['id'] . ", \"" . $sewer['item'] . "\")'>Delete</a></td>";
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