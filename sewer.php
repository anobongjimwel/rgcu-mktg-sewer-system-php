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
                <h2>Sewer Item (#CN Card Item)</h2>
                <p>xx pcs, amt - Status (Name)</p>
                <form>
                    <div class="form-row" style="width:100%;">
                        <div class="col col-md-6 col-12" style="padding-top:20px;"><label>Sewer (Edging)</label>
                            <div class="form-group"><select class="form-control"><option value="12" selected=""></option><option value="1">Option 1</option><option value="2">Option 2</option></select><input class="form-control" type="date"></div>
                            <div style="height:30px;"></div><label>Sewer (Piping)</label>
                            <div class="form-group"><select class="form-control"><option value="12" selected=""></option><option value="1">Option 1</option><option value="2">Option 2</option></select><input class="form-control" type="date"></div>
                            <div style="height:30px;"></div><label>Sewer (Lock)</label>
                            <div class="form-group"><select class="form-control"><option value="12" selected=""></option><option value="1">Option 1</option><option value="2">Option 2</option></select><input class="form-control" type="date"></div>
                            <div style="height:30px;"></div>
                        </div>
                        <div class="col col-md-6 col-12" style="padding-top:20px;"><label>Packing (Trim)</label>
                            <div class="form-group"><select class="form-control"><option value="12" selected=""></option><option value="1">Option 1</option><option value="2">Option 2</option></select><input class="form-control" type="date"></div>
                            <div style="height:30px;"></div><label>Packing (Quality Control)</label>
                            <div class="form-group"><select class="form-control"><option value="12" selected=""></option><option value="1">Option 1</option><option value="2">Option 2</option></select><input class="form-control" type="date"></div>
                            <div style="height:30px;"></div><label>Packing (Pack)</label>
                            <div class="form-group"><select class="form-control"><option value="12" selected=""></option><option value="1">Option 1</option><option value="2">Option 2</option></select><input class="form-control" type="date"></div>
                            <div style="height:30px;"></div>
                            <div class="btn-group float-right" role="group"><button class="btn btn-danger" type="button">Refresh</button><button class="btn btn-success" type="button">Submit</button></div>
                        </div>
                    </div>
                </form>
                <div style="height:30px;"></div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>