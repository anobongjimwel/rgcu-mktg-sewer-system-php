<?php require_once "assets/php/SewerManager.php" ?>
<!DOCTYPE html>
<html>

<head>
    <title>RGCU Sewer</title>
    <?php include_once "assets/includes/genHeader.php" ?>
</head>

<body>
<script>
    function searchSewer(item) {
        let xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('table_sewers').innerHTML = this.responseText;
            }
        };
        xmlHttp.open("post", "assets/ajax/searchSewers.php", true);
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttp.send("q=" + item);
    }

    function deleteSewer(id, item) {
        Sweetalert2.fire({
            title: "Are you sure?",
            text: "Delete employee \"" + item + "\"?",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            showCancelButton: true,
            showCloseButton: true,
            cancelButtonColor: "red",
            type: "warning"
        }).then((result) => {
            if (result.value) {
                let xmlHttp = new XMLHttpRequest();
                xmlHttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.responseText == "GOOD") {
                            Sweetalert2.fire({
                                title: "Deleted!",
                                type: "success",
                                text: "Sewer '" + item + "' deleted. "
                            });
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            Sweetalert2.fire({
                                title: "Failed",
                                type: "error",
                                text: "Failed to delete sewer \"" + item + "\""
                            });
                        }
                    }
                };
                xmlHttp.open("post", "assets/ajax/deleteSewer.php", false);
                xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlHttp.send("id=" + id);

                setTimeout(function () {
                    location.reload();
                }, 2000);
            } else {
                Sweetalert2.fire({
                    title: "Declined!",
                    type: "error",
                    text: "Sewer '" + item + "' deletion action declined. "
                })
            }
        })
    }
</script>


<?php include_once "assets/includes/navbar.php" ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12" id="page-heading">
            <h2>Sewers (<?php echo $sewerMgr->countSewers() ?>)</h2>
            <div></div>
            <form>
                <div class="form-group">
                    <div style="height:10px;"></div>
                    <input class="form-control" type="search" placeholder="Type to search"
                           onkeyup="searchSewer(this.value)"></div>
            </form>
        </div>
        <div class="col" id="page-form" style="padding-top:20px;">
            <div id="ajaxTable">
                <table class='table table-hover table-fluid table-borderless' id="table_sewers">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <th>Item</th>
                        <th>Qty (Amount)</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    <!-- UI Testing Purposes Only
                    <tr>
                        <td>ID</td>
                        <td>Sample Name</td>
                        <td>xx pcs, Php 10, 000</td>
                        <td>Status (Name)</td>
                        <td><a href="#">View</a> · <a href="#">Delete</a></td>
                    </tr>
                    -->
                    <?php
                    if ($sewerMgr->countSewers() != 0) {
                        foreach ($sewerMgr->getSewersID() as $sewer) {
                            echo "<tr>";
                            echo "<td>" . $sewer['id'] . "</td>";
                            echo "<td>" . $sewerMgr->getSewerItem($sewer['id']) . "</td>";
                            echo "<td>" . ($sewerMgr->getSewerQty($sewer['id']) ? $sewerMgr->getSewerQty($sewer['id']) : 0) . " pc(s), PhP " . number_format($sewerMgr->getSewerAmt($sewer['id']), 2, '.', ', ') . "</td>";
                            echo "<td>" . $sewerMgr->getSewerStatusById($sewer['id']) . "</td>";
                            echo "<td><a href=\"sewer.php?id=" . $sewer['id'] . "\">View</a> · <a href=\"#\" onclick='deleteSewer(" . $sewer['id'] . ", \"" . $sewer['item'] . "\")'>Delete</a></td>";
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>