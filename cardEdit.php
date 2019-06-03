<?php require_once "assets/requires/dbcon.php" ?>
<!DOCTYPE html>
<html>

<head>
    <title>RGCU Sewer</title>
    <?php include_once "assets/includes/genHeader.php"?>
</head>

<body>
<?php
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        echo "<script>
                location.href = 'cards.php';
              </script>";
    } else {
        $checkForCards = $db->query("SELECT * FROM cards WHERE id = ".$_GET['id']);
        if ($checkForCards->rowCount()!=1) {
            echo "<script>location.href='cards.php'</script>";
        } else {
            $details = $checkForCards->fetch(PDO::FETCH_ASSOC);
        }
    }
    ?>
    <script>
        function editCard() {
            const id = document.getElementById("id");
            const itm = document.getElementById("itm");
            const dsgn = document.getElementById("dsgn");
            const stre = document.getElementById("stre");
            if (itm.value=="" || dsgn.value=="" || stre.value=="") {
                Sweetalert2.fire({
                    title: "Information Incomplete!",
                    type: "error",
                    text: "You must fill in required fields to edit the card you want to edit."
                });
            } else {
                var xmlHttp = new XMLHttpRequest();
                xmlHttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.responseText=="GOOD") {
                            Sweetalert2.fire({
                                title: "Added!",
                                type: "success",
                                text: "Card named \""+itm.value+"\" edited"
                            });
                            setTimeout(function() {
                                location.href = 'cards.php';
                            }, 3000);
                        } else {
                            Sweetalert2.fire({
                                title: "Failed",
                                type: "error",
                                text: "Failed to edit card named \""+itm.value+"\""
                            });
                        }
                    }
                };
                xmlHttp.open("post","assets/ajax/editCard.php", true);
                xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                xmlHttp.send("itm="+itm.value+"&dsgn="+dsgn.value+"&stre="+stre.value+"&id="+id.value);
            }

        }

        function enter(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                editCard();
            }
        }
    </script>
    <?php include_once "assets/includes/navbar.php"?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12" id="page-heading">
                <h2>Add New Card</h2>
            </div>
            <div class="col" id="page-form" style="padding-top:20px;">
                <form><label>Item Name:</label><input class="form-control form-control-sm" type="text" id="itm" onkeyup="enter(event)" name="itm" value="<?php echo $details['item'] ?>" style="width:100%;">
                    <input type="hidden" id="id" name="id" value="<?php echo $_GET['id']?>" />
                    <div style="height:30px;"></div><label>Item Design:</label><input class="form-control form-control-sm" onkeyup="enter(event)" id="dsgn" name="dsgn" type="text" value="<?php echo $details['design'] ?>" style="width:100%;">
                    <div style="height:30px;"></div><label>Item Store:</label><input class="form-control form-control-sm" onkeyup="enter(event)" id="stre" name="stre" type="text" value="<?php echo $details ['store'] ?>" style="width:100%;">
                    <div style="height:30px;"></div>
                    <div class="btn-group float-right" role="group"><button class="btn btn-danger" type="button" onclick="location.href='cards.php'">Cancel</button><button class="btn btn-success" onclick="editCard()" type="button">Submit</button></div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>