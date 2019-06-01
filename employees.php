<?php require_once "assets/php/EmployeeManager.php"?>
<!DOCTYPE html>
<html>

<head>
    <title>RGCU Sewer</title>
    <?php include_once "assets/includes/genHeader.php" ?>
</head>

<body>
<script>
    function searchName(name) {
        let xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('table_employees').innerHTML = this.responseText;
            }
        };
        xmlHttp.open("post","assets/ajax/searchEmployee.php", true);
        xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlHttp.send("q="+name);
    }

    function deleteEmployee(classid, name) {
        Sweetalert2.fire({
            title: "Are you sure?",
            text: "Delete employee \""+name+"\"?",
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
                    if (this.responseText=="GOOD") {
                        Sweetalert2.fire({
                            title: "Deleted!",
                            type: "success",
                            text: "Employee '"+name+"' deleted. "
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    } else  {
                        Sweetalert2.fire({
                            title: "Failed",
                            type: "error",
                            text: "Failed to employee class "+name
                        });
                    }
                }
            };
            xmlHttp.open("post","assets/ajax/deleteEmployee.php", false);
            xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlHttp.send("id="+classid);

            setTimeout(function() {
                location.reload();
            }, 2000);
        } else {
            Sweetalert2.fire({
                title: "Declined!",
                type: "error",
                text: "Employee '"+name+"' deletion action declined. "
            })
        }
    })
    }
</script>
<?php include_once "assets/includes/navbar.php"?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12" id="page-heading">
                <h2>View Employees (<?php echo $employeeMgr->countEmployees() ?>)</h2>
                <div style="height:10px;"></div>
                    <div class="form-group"><input class="form-control" onkeyup="searchName(this.value)" type="search" placeholder="Type to search"></div>
            </div>
            <div class="col" style="padding-top:20px;"><div>
    <table class='table table-hover table-fluid table-borderless' id="table_employees">
        <tbody>
            <tr>
                <th>ID</th>
                <th>Item</th>
                <th>Actions</th>
            </tr>
            <?php
                if ($employeeMgr->countEmployees()>0) {
                    foreach ($employeeMgr->getEmployees() as $employee) {
                        echo "<tr>";
                        echo "<td>" . $employee['id'] . "</td>";
                        echo "<td>" . $employee['name'] . "</td>";
                        echo "<td><a href='employee.php?id=" . $employee['id'] . "'>View</a> · <a href='javascript:deleteEmployee(".$employee['id'].",\"".$employee['name']."\")'>Delete</a></td>";
                    }
                }
            ?>
            <!-- UI Preview Purposes
            <tr>
                <td>ID</td>
                <td>Sample Name</td>
                <td><a href="#">View</a> · <a href="#">Delete</a></td>
            </tr>
            -->
        </tbody>
    </table>
</div></div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>