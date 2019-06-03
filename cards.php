<?php require_once "assets/php/CardManager.php"?>
<!DOCTYPE html>
<html>

<head>
    <title>RGCU Sewer</title>
    <?php include_once "assets/includes/genHeader.php"?>
</head>

<body>
    <Script>
        function searchCard(item) {
            let xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('table_cards').innerHTML = this.responseText;
                }
            };
            xmlHttp.open("post", "assets/ajax/searchCards.php", true);
            xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlHttp.send("q=" + item);
        }

        function deleteCard(id, item) {
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
                                    text: "Card '" + item + "' deleted. "
                                });
                                setTimeout(function () {
                                    location.reload();
                                }, 2000);
                            } else {
                                Sweetalert2.fire({
                                    title: "Failed",
                                    type: "error",
                                    text: "Failed to delete card \"" + item + "\""
                                });
                            }
                        }
                    };
                    xmlHttp.open("post", "assets/ajax/deleteCard.php", false);
                    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlHttp.send("id=" + id);

                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    Sweetalert2.fire({
                        title: "Declined!",
                        type: "error",
                        text: "Employee '" + item + "' deletion action declined. "
                    })
                }
            })
        }
    </script>
<?php include_once "assets/includes/navbar.php"?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12" id="page-heading">
                <h2>View Cards (<?php echo $cardMgr->countCards()?>)</h2>
                <div style="height:10px;"></div>
                <div class="form-group"><input class="form-control" onkeyup="searchCard(this.value)" type="search" placeholder="Type to search"></div>
            </div>
            <div class="col" id="page-form" style="padding-top:20px;"><div>
    <table class='table table-hover table-fluid table-borderless' id="table_cards">
        <tbody>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Store and Design</th>
                <th>Actions</th>
            </tr>
            <!-- UI Testing Purposes only
            <tr>
                <td>ID</td>
                <td>Sample Name</td>
                <td>Store Name, Design Name</td>
                <td><a href="#">View</a> · <a href="#">Edit</a> · <a href="#">Delete</a></td>
            </tr>
            -->
            <?php
                if ($cardMgr->countCards()>0) {
                    foreach ($cardMgr->getCards() as $card) {
                        echo "<tr>";
                        echo "<td>" . $card['id'] . "</td>";
                        echo "<td>" . $card['item'] . "</td>";
                        echo "<td>" . $card['store'] . ", ".$card['design']."</td>";
                        echo "<td><a href='cardEdit.php?id=" . $card['id'] . "'>Edit</a> · <a href='javascript:deleteCard(".$card['id'].",\"".$card['item']."\")'>Delete</a></td>";
                    }
                }
            ?>
        </tbody>
    </table>
</div></div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>