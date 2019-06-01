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
                <h2>Sewers</h2>
                <div></div>
                <form>
                    <div class="form-group">
                        <div style="height:10px;"></div><input class="form-control" type="search" placeholder="Type to search"></div>
                </form>
            </div>
            <div class="col" id="page-form" style="padding-top:20px;"><div id="ajaxTable">
    <table class='table table-hover table-fluid table-borderless'>
        <tbody>
            <tr>
                <th>ID</th>
                <th>Item</th>
                <th>Qty (Amount)</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td>ID</td>
                <td>Sample Name</td>
                <td>xx pcs, Php 10, 000</td>
                <td>Status (Name)</td>
                <td><a href="#">View</a> · <a href="#">Edit</a> · <a href="#">Delete</a></td>
            </tr>
        </tbody>
    </table>
</div></div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>