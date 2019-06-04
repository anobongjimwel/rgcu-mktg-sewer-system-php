<?php require_once "assets/php/CardManager.php" ?>
<?php require_once "assets/requires/dbcon.php" ?>
<!DOCTYPE html>
<html>

<head>
    <title>RGCU Sewer</title>
    <?php include_once "assets/includes/genHeader.php" ?>
</head>

<body>
<script>
    function addSewer() {
        let item = document.getElementById("item");
        let card = document.getElementById("card");
        if (
            item.value == "" ||
            card.value == ""
        ) {
            Sweetalert2.fire({
                title: "Invalid!",
                type: "error",
                text: "Required field must be filled in properly to successfully add a new sewer."
            });
        } else {
            let xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText == "GOOD") {
                        Sweetalert2.fire({
                            title: "Added!",
                            type: "success",
                            text: "New sewer named \"" + item.value + "\" added"
                        });
                        let latestRecord = 0;
                        let xmlHttp2 = new XMLHttpRequest();
                        xmlHttp2.onreadystatechange = function () {
                            if (this.readyState == 4 && this.status == 200) {
                                latestRecord = xmlHttp2.responseText;
                                setTimeout(function () {
                                    location.href = 'sewer.php?id=' + (latestRecord).toString();
                                }, 3000);
                            }
                        };
                        xmlHttp2.open("get", "assets/ajax/getLatestSewerRecord.php", true);
                        xmlHttp2.send();

                    } else {
                        Sweetalert2.fire({
                            title: "Failed",
                            type: "error",
                            text: "Failed to add new sewer named \"" + item.value + "\""
                        });
                    }
                }
            };
            xmlHttp.open("post", "assets/ajax/addNewSewer.php", true);
            xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlHttp.send("item=" + item.value + "&card=" + card.value);
        }
    }

    function enter(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            addSewer();
        } else {
            if (qty.value != "" || u_p.value != "") {
                amt.value = parseFloat(qty.value * u_p.value).toFixed(2);
            } else {
                amt.value = "";
            }
        }
    }
</script>
<?php include_once "assets/includes/navbar.php" ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12" id="page-heading">
            <h2>Add New Sewer</h2>
        </div>
        <div class="col" id="page-form" style="padding-top:20px;">
            <form><label>Sewer Card:</label>
                <select class="form-control" id="card" name="card">
                    <option value="" selected=""></option>
                    <?php
                    foreach ($cardMgr->getCards() as $card) {
                        echo "<option value='" . $card['id'] . "'>#" . $card['id'] . " " . $card['item'] . "</option>";
                    }
                    ?>
                </select>
                <div style="height:30px;"></div>
                <label>Item Name:</label><input id="item" name="item" class="form-control form-control-sm"
                                                onkeyup="enter(this)" type="text" style="width:100%;">

                <div style="height:30px;"></div>
                <div class="btn-group float-right" role="group">
                    <button class="btn btn-danger" type="button" onclick="location.href='sewers.php'">Cancel</button>
                    <button class="btn btn-success" onclick="addSewer()" type="button">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>