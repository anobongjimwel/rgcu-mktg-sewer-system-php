<tbody>
<tr>
    <th>ID</th>
    <th>Item</th>
    <th>Actions</th>
</tr>
<?php
    require_once "../php/CardManager.php";
    if (isset($_POST['q']) && !empty($_POST['q'])) {
        $q = $_POST['q'];
        $conditionalObject = $cardMgr->searchCard($q);
    } else {
        $conditionalObject = $cardMgr->getCards();
    }
    if (is_array($conditionalObject)) {
        foreach ($conditionalObject as $card) {
            echo "<tr>";
            echo "<td>" . $card['id'] . "</td>";
            echo "<td>" . $card['item'] . "</td>";
            echo "<td><a href='cardEdit.php?id=" . $card['id'] . "'>Edit</a> ·<a href='javascript:deleteCard(" . $card['id'] . ",\"" . $card['item'] . "\")'>Delete</a></td>";
        }
    }