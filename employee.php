<?php require_once "assets/requires/dbcon.php" ?>
<?php require_once "assets/php/EmployeeManager.php" ?>
<!DOCTYPE html>
<html>

<head>
    <title>RGCU Sewer</title>
    <?php include_once "assets/includes/genHeader.php" ?>
</head>

<body>
<script>
</script>
<?php include_once "assets/includes/navbar.php" ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12" id="page-heading">
            <h2><?php echo $employeeMgr->getEmployeeName($_GET['id']) ? $employeeMgr->getEmployeeName($_GET['id'])['name'] : "<script>location.href='employees.php'</script>" ?></h2>
            <h4>Recent Activities</h4>
        </div>
        <div class="col" style="padding-top:10px;">
            <div>
                <table class='table table-hover table-fluid table-borderless' id="table_employees">

                    <tbody>
                    <tr>
                        <th>CN</th>
                        <th>ID</th>
                        <th>Item (Card)</th>
                        <th>Activity</th>
                        <th>Qty</th>
                        <th>U.P.</th>
                        <th>Amt</th>
                        <th>Date</th>
                    </tr>
                    <!-- UI Testing Purposes only
                    <tr>
                        <td>ID</td>
                        <td>ID</td>
                        <td>Sample Name</td>
                        <td>ID</td>
                        <td>Qty</td>
                        <td>U.P.</td>
                        <td>Amt</td>
                        <td>Sample Name</td>
                    </tr>
                    -->
                    <?php
                    $query = $db->query("SELECT s.card_number as cn, t.id as id, s.item as item, c.item as card, st.category as activity, t.date as date, t.quantity as quantity, t.unit_price as unit_price, t.amount as amount FROM tasks t LEFT JOIN employees e ON t.employee = e.id LEFT JOIN sewers s ON t.sewer_id = s.id LEFT JOIN cards c ON s.card_number = c.id LEFT JOIN statuses st ON t.status = st.id WHERE t.employee = " . $_GET['id'] . " ORDER BY t.date desc, s.card_number desc, t.id desc, st.id asc LIMIT 100");
                    if ($query->rowCount() > 0) {
                        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $activity) {
                            echo "<tr>";
                            echo "<td>" . $activity['cn'] . "</td>";
                            echo "<td>" . $activity['id'] . "</td>";
                            echo "<td>" . $activity['item'] . " (" . $activity['card'] . ")</td>";
                            echo "<td>" . $activity['activity'] . "</td>";
                            echo "<td>" . $activity['quantity'] . "</td>";
                            echo "<td>" . "PhP ".number_format($activity['unit_price'], 2) . "</td>";
                            echo "<td>" . "PhP ".number_format($activity['amount'], 2) . "</td>";
                            echo "<td>" . date("F gS, Y", strtotime($activity['date'])) . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<div style="height: 100px"></div>
</body>

</html>