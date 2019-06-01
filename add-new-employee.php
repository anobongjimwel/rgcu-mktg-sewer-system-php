<!DOCTYPE html>
<html>

<head>
    <title>RGCU Sewer</title>
    <?php include_once "assets/includes/genHeader.php"?>
</head>

<body>
<script>
    function addEmployee() {
        const name = document.getElementById("empname");
        if (name.value=="") {
            Sweetalert2.fire({
                title: "Information Incomplete!",
                type: "error",
                text: "You must fill in the name of the employee"
            });
            return false;
        } else {
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText=="GOOD") {
                        Sweetalert2.fire({
                            title: "Added!",
                            type: "success",
                            text: "New employee named \""+name.value+"\" added"
                        });
                        setTimeout(function() {
                            location.href = 'employees.php';
                        }, 3000);
                    } else {
                        Sweetalert2.fire({
                            title: "Failed",
                            type: "error",
                            text: "Failed to add new employee named \""+name.value+"\""
                        });
                    }
                }
            };
            xmlHttp.open("post","assets/ajax/addNewEmployee.php", true);
            xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlHttp.send("n="+name.value);
        }

    }

    function enter(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            addEmployee();
        }
    }
</script>
<?php include_once "assets/includes/navbar.php"?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12" id="page-heading">
                <h2>Add New Employee</h2>
            </div>
            <div class="col" id="page-form" style="padding-top:20px;">
                <label>Employee Name:</label><input name="empname" onkeydown="enter(event)" id="empname" class="form-control form-control-sm" type="text" style="width:100%;">
                    <div style="height:10px;"></div>
                    <div class="btn-group float-right" role="group"><button class="btn btn-danger" type="button">Cancel</button><button class="btn btn-success" type="button" onclick="addEmployee()">Submit</button></div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>