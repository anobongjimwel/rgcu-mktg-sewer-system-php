<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RGCU Sewer</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md sticky-top" style="background-color:#ffffff;">
        <div class="container-fluid"><a class="navbar-brand" href="#">RGCU Marketing</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse"
                id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown"><a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#" style="color:rgba(0,0,0,0.5);">Employees&nbsp;</a>
                        <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="#">Add New Employee</a><a class="dropdown-item" role="presentation" href="#">View Employees</a></div>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Cards&nbsp;</a>
                        <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="#">Add New Card</a><a class="dropdown-item" role="presentation" href="#"></a><a class="dropdown-item" role="presentation" href="#">View Cards</a></div>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Sewers&nbsp;</a>
                        <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="#">Add New Sewer</a><a class="dropdown-item" role="presentation" href="#">View Sewers</a></div>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Reports&nbsp;</a>
                        <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="#">View Sewers By Date</a><a class="dropdown-item" role="presentation" href="#">Print Sewers By Date</a></div>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Others&nbsp;</a>
                        <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="#">About</a></div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
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