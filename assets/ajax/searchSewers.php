<tbody>
<tr>
    <th>ID</th>
    <th>Item</th>
    <th>Qty (Amount)</th>
    <th>Status</th>
    <th>Actions</th>
</tr>
<?php
    require_once "../php/SewerManager.php";
    if (isset($_POST['q']) && !empty($_POST['q'])) {
        $q = $_POST['q'];
        $conditionalObject = $sewerMgr->searchSewerID($q);
    } else {
        $conditionalObject = $sewerMgr->getSewersID();
    }
    if (is_array($conditionalObject)) {
        foreach ($conditionalObject as $sewer) {
            echo "<tr>";
            echo "<td>".$sewer['id']."</td>";
            echo "<td>".$sewerMgr->getSewerItem($sewer['id'])."</td>";
            echo "<td>".$sewerMgr->getSewerQty($sewer['id'])." pcs, PhP ".number_format($sewerMgr->getSewerAmt($sewer['id']),2,'.',', ')."</td>";
            echo "<td>".$sewerMgr->getSewerStatusById($sewer['id'])."</td>";
            echo "<td><a href=\"sewer.php?id=".$sewer['id']."\">View</a><br /><a href=\"#\" onclick='deleteSewer(".$sewer['id'].", \"".$sewer['item']."\")'>Delete</a></td>";
        }
    }
