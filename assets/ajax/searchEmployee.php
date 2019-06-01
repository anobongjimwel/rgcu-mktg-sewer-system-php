<tbody>
<tr>
    <th>ID</th>
    <th>Item</th>
    <th>Actions</th>
</tr>
<?php
    require_once "../php/EmployeeManager.php";
    if (isset($_POST['q']) && !empty($_POST['q'])) {
        $q = $_POST['q'];
        $conditionalObject = $employeeMgr->searchEmployee($q);
    } else {
        $conditionalObject = $employeeMgr->getEmployees();
    }
    if (is_array($conditionalObject)) {
        foreach ($conditionalObject as $employee) {
            echo "<tr>";
            echo "<td>" . $employee['id'] . "</td>";
            echo "<td>" . $employee['name'] . "</td>";
            echo "<td><a href='employee.php?id=" . $employee['id'] . "'>View</a> · <a href='javascript:deleteEmployee(" . $employee['id'] . ",\"" . $employee['name'] . "\")'>Delete</a></td>";
        }
    }