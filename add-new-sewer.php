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
                <h2>Add New Sewer</h2>
            </div>
            <div class="col" id="page-form" style="padding-top:20px;">
                <form><label>Sewer Card:</label><select class="form-control"><option value="12" selected=""></option><option value="1">Option 1</option><option value="2">Option 2</option></select>
                    <div style="height:30px;"></div><label>Item Design:</label><input class="form-control form-control-sm" type="text" style="width:100%;">
                    <div style="height:30px;"></div><label>Item Store:</label><input class="form-control form-control-sm" type="text" style="width:100%;">
                    <div style="height:30px;"></div>
                    <div class="btn-group float-right" role="group"><button class="btn btn-danger" type="button">Cancel</button><button class="btn btn-success" type="button">Submit</button></div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>