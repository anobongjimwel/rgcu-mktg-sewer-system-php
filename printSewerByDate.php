<?php require_once "assets/requires/dbcon.php" ?>
<html>
    <head>
        <title>RGCU Sewer</title>
        <?php include_once "assets/includes/genHeader.php" ?>
    </head>
    <body style="padding-top: 10px">
        <?php
            if (
                    isset($_POST['sewerPrinter']) && !empty($_POST['sewerPrinter']) &&
                    isset($_POST['date']) && !empty($_POST['date'])
            ) {
                $date = date_parse($_POST['date'])['year']."-".date_parse($_POST['date'])['month']."-".date_parse($_POST['date'])['day'];
                $query = $db->query("SELECT e.id, e.name FROM employees e INNER JOIN ( SELECT employee FROM tasks WHERE date = '2019-12-19' GROUP BY employee) t ON e.id = t.employee");
                foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $employee) {
                    echo "<table class='table table-hover table-fluid table-bordered' id=\"table_employees\">";
                    echo "<tbody>";
                    echo "<tr>";
                    echo "<th colspan='8'>RGCU Marketing Sewer By Date Report: June 12, 1212<span style=\"float:right\">Employee: #" . $employee['id'] . " " . $employee['name'] . "</span></th>";
                    echo "</tr>";
                    echo "<tr>
                <th>CN</th>
                <th>ID</th>
                <th>Item (Card)</th>
                <th>Activity</th>
                <th>Qty</th>
                <th>U.P.</th>
                <th>Amt</th>
                <th>Date</th>
                </tr>";
                    $query2 = $db->query("SELECT c.id as cn, s.id as id, s.item as item, c.item as card, st.category as status, t.quantity as quantity, t.unit_price as unit_price, t.amount as amount, t.date as date FROM tasks t LEFT JOIN statuses st ON t.status = st.id LEFT JOIN employees e ON t.employee = e.id LEFT JOIN sewers s ON t.sewer_id = s.id LEFT JOIN cards c ON s.card_number = c.id WHERE employee = 1 ORDER BY cn desc, st.id asc, s.id desc");
                    foreach ($query2->fetchAll(PDO::FETCH_ASSOC) as $activity) {
                        echo "<tr>";
                        echo "<td>" . $activity['cn'] . "</td>";
                        echo "<td>" . $activity['id'] . "</td>";
                        echo "<td>" . $activity['item'] . " (" . $activity['card'] . ")</td>";
                        echo "<td>" . $activity['status'] . "</td>";
                        echo "<td>" . $activity['quantity'] . "</td>";
                        echo "<td>" . number_format($activity['unit_price'], 2) . "</td>";
                        echo "<td>" . number_format($activity['amount'], 2) . "</td>";
                        echo "<td>" . date("F gS, Y", strtotime($activity['date'])) . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>
                    </table>";
                    echo "<div style='page-break-after: always'></div>";
                }
                echo "<script>print()</script>";
            } else {
                echo "<script>location.href='print-sewer-by-date.php'</script>";
            }
        ?>

        <!-- UI Testing Only
        <table class='table table-hover table-fluid table-bordered' id="table_employees">
            <tbody>
            <tr>
                <th colspan="8">RGCU Marketing Sewer By Date Report: June 12, 1212<span style="float:right">Employee: #1 Jimwel Anobong</span></th>
            </tr>
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
            <tr>
                <td>CN</td>
                <td>ID</td>
                <td>Item (Card)</td>
                <td>Activity</td>
                <td>Qty</td>
                <td>U.P.</td>
                <td>Amt</td>
                <td>Date</td>
            </tr>
            </tbody>
        </table>
        -->
    </body>
</html>