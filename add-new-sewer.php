<?php require_once "assets/php/CardManager.php"?>
<?php require_once "assets/php/CardManager.php"?>
<!DOCTYPE html>
<html>

<head>
    <title>RGCU Sewer</title>
    <?php include_once "assets/includes/genHeader.php"?>
</head>

<body>
<script>
    function addSewer() {
        let item = document.getElementById("item");
        let card = document.getElementById("card");
        let qty = document.getElementById("qty");
        let u_p = document.getElementById("u_p");
        let amt = document.getElementById("amt");
        if (
            item.value == "" ||
            card.value == "" ||
            qty.value == "" || qty.value < 1 ||
            u_p.value == "" ||
            amt.value == ""
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
                        setTimeout(function () {
                            location.href = 'sewers.php';
                        }, 3000);
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
            xmlHttp.send("item=" + item.value + "&card=" + card.value + "&qty=" + qty.value + "&u_p=" + u_p.value + "&amt=" + amt.value);
        }
    }

    function enter(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            addSewer();
        } else {
            let qty = document.getElementById("qty");
            let u_p = document.getElementById("u_p");
            let amt = document.getElementById("amt");
            if (qty.value != "" || u_p.value != "") {
                amt.value = parseFloat(qty.value*u_p.value).toFixed(2);
            } else {
                amt.value = "";
            }
        }
    }
</script>
<?php include_once "assets/includes/navbar.php"?>
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
                                echo "<option value='".$card['id']."'>#".$card['id']." ".$card['item']."</option>";
                            }
                        ?>
                    </select>
                    <div style="height:30px;"></div><label>Item Name:</label><input id="item" name="item" class="form-control form-control-sm" onkeyup="enter(this)" type="text" style="width:100%;">
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div style="height:30px;"></div><label>Quantity:</label><input id="qty" name="qty" class="form-control form-control-sm" onkeyup="enter(this)" type="number" style="width:100%;" step="1" min="1">
                        </div>
                        <div class="col-md-4 col-12">
                            <div style="height:30px;"></div><label>Unit Price:</label><input id="u_p" name="u_p" class="form-control form-control-sm" onkeyup="enter(this)" type="number" style="width:100%;" step="0.50" min="0.1">
                        </div>
                        <div class="col-md-4 col-12">
                            <div style="height:30px;"></div><label>Total Amount:</label><input id="amt" name="amt" class="form-control form-control-sm" onkeyup="enter(this)" type="number" disabled="" style="width:100%;" step="0.50" min="0.1">
                        </div>
                    </div>

                    <div style="height:30px;"></div>
                    <div class="btn-group float-right" role="group"><button class="btn btn-danger" type="button" onclick="location.href='sewers.php'">Cancel</button><button class="btn btn-success" onclick="addSewer()" type="button">Submit</button></div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>