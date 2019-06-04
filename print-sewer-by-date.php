<!DOCTYPE html>
<html>

<head>
    <title>RGCU Sewer</title>
    <?php include_once "assets/includes/genHeader.php" ?>
</head>

<body>
<?php include_once "assets/includes/navbar.php" ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-lg-4 offset-lg-4 col-12" id="page-heading" style="padding-top: 150px">
            <h2>Print Sewers By Date</h2>
            <div></div>
            <form method="post" action="printSewerByDate.php" enctype="application/x-www-form-urlencoded">
                <div class="form-group"><input class="form-control" type="date" style="width:100%;" id="date" name="date">
                    <div style="height:10px;"></div>
                    <button class="btn btn-primary float-right" id="sewerPrinter" name="sewerPrinter" value="sewerPrinter" type="submit">Print Pages</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>