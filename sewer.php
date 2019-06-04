<?php require_once "assets/php/EmployeeManager.php" ?>
<?php require_once "assets/php/SewerManager.php" ?>
<?php require_once "assets/php/CardManager.php" ?>
<?php require_once "assets/requires/dbcon.php" ?>
<?php // Sewer Update Processor
if (isset($_POST['sewer_submit'])) {
    if (isset($_POST['sewerID']) && !empty($_POST['sewerID'])) {
        if (
        is_array($sewerMgr->searchSewerID($_POST['sewerID']))
        ) {
            if (
                isset($_POST['sewer_edging_date']) && !empty($_POST['sewer_edging_date']) &&
                isset($_POST['sewer_edging']) && !empty(($_POST['sewer_edging'])) &&
                isset($_POST['sewer_edging_u_p']) && !empty(($_POST['sewer_edging_u_p'])) &&
                isset($_POST['sewer_edging_qty']) && !empty(($_POST['sewer_edging_qty']))
            ) {
                $sewerMgr->updateTask($_POST['sewerID'], 1, $_POST['sewer_edging'], "'" . $_POST['sewer_edging_date'] . "'", $_POST['sewer_edging_qty'], $_POST['sewer_edging_u_p'], number_format($_POST['sewer_edging_qty'] * $_POST['sewer_edging_u_p'], 2,'.',''));
            } else {
                $sewerMgr->updateTask($_POST['sewerID'], 1, "", "", "", "", "");
            }

            if (
                isset($_POST['sewer_piping_date']) && !empty($_POST['sewer_piping_date']) &&
                isset($_POST['sewer_piping']) && !empty(($_POST['sewer_piping'])) &&
                isset($_POST['sewer_piping_u_p']) && !empty(($_POST['sewer_piping_u_p'])) &&
                isset($_POST['sewer_piping_qty']) && !empty(($_POST['sewer_piping_qty']))
            ) {
                $sewerMgr->updateTask($_POST['sewerID'], 2, $_POST['sewer_piping'], "'" . $_POST['sewer_piping_date'] . "'", $_POST['sewer_piping_qty'], $_POST['sewer_piping_u_p'], number_format($_POST['sewer_piping_qty'] * $_POST['sewer_piping_u_p'], 2,'.',''));
            } else {
                $sewerMgr->updateTask($_POST['sewerID'], 2, "", "", "", "", "");
            }

            if (
                isset($_POST['sewer_lock_date']) && !empty($_POST['sewer_lock_date']) &&
                isset($_POST['sewer_lock']) && !empty(($_POST['sewer_lock'])) &&
                isset($_POST['sewer_lock_u_p']) && !empty(($_POST['sewer_lock_u_p'])) &&
                isset($_POST['sewer_lock_qty']) && !empty(($_POST['sewer_lock_qty']))
            ) {
                $sewerMgr->updateTask($_POST['sewerID'], 3, $_POST['sewer_lock'], "'" . $_POST['sewer_lock_date'] . "'", $_POST['sewer_lock_qty'], $_POST['sewer_lock_u_p'], number_format($_POST['sewer_lock_qty'] * $_POST['sewer_lock_u_p'], 2,'.',''));
            } else {
                $sewerMgr->updateTask($_POST['sewerID'], 3, "", "", "", "", "");
            }

            if (
                isset($_POST['packing_trim_date']) && !empty($_POST['packing_trim_date']) &&
                isset($_POST['packing_trim']) && !empty(($_POST['packing_trim'])) &&
                isset($_POST['packing_trim_u_p']) && !empty(($_POST['packing_trim_u_p'])) &&
                isset($_POST['packing_trim_qty']) && !empty(($_POST['packing_trim_qty']))
            ) {
                $sewerMgr->updateTask($_POST['sewerID'], 4, $_POST['packing_trim'], "'" . $_POST['packing_trim_date'] . "'", $_POST['packing_trim_qty'], $_POST['packing_trim_u_p'], number_format($_POST['packing_trim_qty'] * $_POST['packing_trim_u_p'], 2,'.',''));
            } else {
                $sewerMgr->updateTask($_POST['sewerID'], 4, "", "", "", "", "");
            }

            if (
                isset($_POST['packing_qc_date']) && !empty($_POST['packing_qc_date']) &&
                isset($_POST['packing_qc']) && !empty(($_POST['packing_qc'])) &&
                isset($_POST['packing_qc_u_p']) && !empty(($_POST['packing_qc_u_p'])) &&
                isset($_POST['packing_qc_qty']) && !empty(($_POST['packing_qc_qty']))
            ) {
                $sewerMgr->updateTask($_POST['sewerID'], 5, $_POST['packing_qc'], "'" . $_POST['packing_qc_date'] . "'", $_POST['packing_qc_qty'], $_POST['packing_qc_u_p'], number_format($_POST['packing_qc_qty'] * $_POST['packing_qc_u_p'], 2,'.',''));
            } else {
                $sewerMgr->updateTask($_POST['sewerID'], 5, "", "", "", "", "");
            }

            if (
                isset($_POST['packing_pack_date']) && !empty($_POST['packing_pack_date']) &&
                isset($_POST['packing_pack']) && !empty(($_POST['packing_pack'])) &&
                isset($_POST['packing_pack_u_p']) && !empty(($_POST['packing_pack_u_p'])) &&
                isset($_POST['packing_pack_qty']) && !empty(($_POST['packing_pack_qty']))
            ) {
                $sewerMgr->updateTask($_POST['sewerID'], 6, $_POST['packing_pack'], "'" . $_POST['packing_pack_date'] . "'", $_POST['packing_pack_qty'], $_POST['packing_pack_u_p'], number_format($_POST['packing_pack_qty'] * $_POST['packing_pack_u_p'], 2,'.',''));
            } else {
                $sewerMgr->updateTask($_POST['sewerID'], 6, "", "", "", "", "");
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>RGCU Sewer</title>
    <?php include_once "assets/includes/genHeader.php" ?>
</head>

<body>

<?php include_once "assets/includes/navbar.php" ?>
<?php
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>
                            location.href = 'sewers.php';
                </script>";
} else {
    $checkForSewer = $db->query("SELECT * FROM sewers WHERE id = " . $_GET['id']);
    if ($checkForSewer->rowCount() != 1) {
        echo "<script>location.href='sewers.php'</script>";
    }
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12" id="page-heading">
            <h2>Sewer "<?php echo $sewerMgr->getSewerItem($_GET['id']) ?>"
                (#<?php echo $cardMgr->searchCardById($sewerMgr->getCardId($_GET['id']))['id'] . " " . $cardMgr->searchCardById($sewerMgr->getCardId($_GET['id']))['item'] ?>)</h2>
            <p><?php echo $sewerMgr->getSewerQty($_GET['id']) ? $sewerMgr->getSewerQty($_GET['id']) : 0 ?> pcs,
                PhP <?php echo number_format($sewerMgr->getSewerAmt($_GET['id']), 2, ".", ", ") ?>
                -> <?php echo $sewerMgr->getSewerStatusById($_GET['id']) ?></p>
            <form id="edit_sewer_form" name="edit_sewer_form" method="post"
                  action="sewer.php?id=<?php echo $_GET['id'] ?>" enctype="application/x-www-form-urlencoded">
                <input type="hidden" id="sewerID" name="sewerID" value="<?php echo $_GET['id'] ?>"/>
                <div class="form-row" style="width:100%;">
                    <div class="col col-md-6 col-12" style="padding-top:20px;"><label>Sewer (Edging)</label>
                        <div class="form-group">
                            <select id="sewer_edging" name="sewer_edging" class="form-control">
                                <?php
                                $checkForEmployee = $db->query("SELECT * FROM tasks LEFT JOIN employees e ON tasks.employee = e.id WHERE status = 1 AND employee IS NOT NULL AND sewer_id = '" . $_GET['id'] . "'");
                                if ($checkForEmployee->rowCount() == 1) {
                                    $employeeSelected = $checkForEmployee->fetch(PDO::FETCH_ASSOC);
                                    echo "<option value='" . $employeeSelected['employee'] . "' class=\"form-control\">" . $employeeSelected['name'] . "</option>";
                                } else {
                                    echo "<option value='' class=\"form-control\">None</option>";
                                }
                                ?>
                                <option disabled>---</option>
                                <option value="">None</option>
                                <?php
                                foreach ($employeeMgr->getEmployees() as $employee) {
                                    echo "<option value='" . $employee['id'] . "'>#" . $employee['id'] . " " . $employee['name'] . "</option>";
                                }
                                ?>
                            </select>
                            <input class="form-control" id="sewer_edging_date" name="sewer_edging_date"
                                   type="date" <?php if ($checkForEmployee->rowCount() == 1) {
                                echo "value='" . date("Y-m-d", strtotime($employeeSelected['date'])) . "'";
                            } ?>>
                            <div class="row">
                                <div class="col-4" style="padding-right: 0px;">
                                    <input class="form-control form-control-sm" id="sewer_edging_u_p"
                                           name="sewer_edging_u_p" placeholder="Unit Price" type="number"
                                           style="width:100%;" step="0.01"
                                           min="0.01" <?php if ($checkForEmployee->rowCount() == 1) {
                                        echo "value='" . number_format($employeeSelected['unit_price'], 2) . "'";
                                    } ?>>
                                </div>
                                <div class="col-4" style="padding: 0px 0px;">
                                    <input class="form-control form-control-sm" id="sewer_edging_qty"
                                           name="sewer_edging_qty" placeholder="Quantity" type="number"
                                           style="width:100%;" step="1"
                                           min="1"<?php if ($checkForEmployee->rowCount() == 1) {
                                        echo "value='" . $employeeSelected['quantity'] . "'";
                                    } ?>>
                                </div>
                                <div class="col-4" style="padding-left: 0px;">
                                    <input class="form-control form-control-sm" id="sewer_edging_amt"
                                           name="sewer_edging_amt" type="number" disabled=""
                                           style="width:100%;" <?php if ($checkForEmployee->rowCount() == 1) {
                                        echo "value='" . number_format($employeeSelected['amount'], 2) . "'";
                                    } ?>>
                                </div>
                            </div>

                        </div>
                        <div style="height:30px;"></div>
                        <label>Sewer (Piping)</label>
                        <div class="form-group">
                            <select id="sewer_piping" name="sewer_piping" class="form-control">
                                <?php
                                $checkForEmployee = $db->query("SELECT * FROM tasks LEFT JOIN employees e ON tasks.employee = e.id WHERE status = 2 AND employee IS NOT NULL AND sewer_id = '" . $_GET['id'] . "'");
                                if ($checkForEmployee->rowCount() == 1) {
                                    $employeeSelected = $checkForEmployee->fetch(PDO::FETCH_ASSOC);
                                    echo "<option value='" . $employeeSelected['employee'] . "' class=\"form-control\">" . $employeeSelected['name'] . "</option>";
                                } else {
                                    echo "<option value='' class=\"form-control\">None</option>";
                                }
                                ?>
                                <option disabled>---</option>
                                <option value="">None</option>
                                <?php
                                foreach ($employeeMgr->getEmployees() as $employee) {
                                    echo "<option value='" . $employee['id'] . "'>#" . $employee['id'] . " " . $employee['name'] . "</option>";
                                }
                                ?>
                            </select>
                            <input class="form-control" type="date" id="sewer_piping_date"
                                   name="sewer_piping_date" <?php if ($checkForEmployee->rowCount() == 1) {
                                echo "value='" . date("Y-m-d", strtotime($employeeSelected['date'])) . "'";
                            } ?>>
                            <div class="row">
                                <div class="col-4" style="padding-right: 0px;">
                                    <input class="form-control form-control-sm" id="sewer_piping_u_p"
                                           name="sewer_piping_u_p" placeholder="Unit Price" type="number"
                                           style="width:100%;" step="0.01"
                                           min="0.01" <?php if ($checkForEmployee->rowCount() == 1) {
                                        echo "value='" . number_format($employeeSelected['unit_price'], 2) . "'";
                                    } ?>>
                                </div>
                                <div class="col-4" style="padding: 0px 0px;">
                                    <input class="form-control form-control-sm" id="sewer_piping_qty"
                                           name="sewer_piping_qty" placeholder="Quantity" type="number"
                                           style="width:100%;" step="1"
                                           min="1"<?php if ($checkForEmployee->rowCount() == 1) {
                                        echo "value='" . $employeeSelected['quantity'] . "'";
                                    } ?>>
                                </div>
                                <div class="col-4" style="padding-left: 0px;">
                                    <input class="form-control form-control-sm" id="sewer_piping_amt"
                                           name="sewer_piping_amt" type="number" disabled=""
                                           style="width:100%;" <?php if ($checkForEmployee->rowCount() == 1) {
                                        echo "value='" . number_format($employeeSelected['amount'], 2) . "'";
                                    } ?>>
                                </div>
                            </div>
                        </div>
                        <div style="height:30px;"></div>
                        <label>Sewer (Lock)</label>
                        <div class="form-group">
                            <select id="sewer_lock" name="sewer_lock" class="form-control">
                                <?php
                                $checkForEmployee = $db->query("SELECT * FROM tasks LEFT JOIN employees e ON tasks.employee = e.id WHERE status = 3 AND employee IS NOT NULL AND sewer_id = '" . $_GET['id'] . "'");
                                if ($checkForEmployee->rowCount() == 1) {
                                    $employeeSelected = $checkForEmployee->fetch(PDO::FETCH_ASSOC);
                                    echo "<option value='" . $employeeSelected['employee'] . "' class=\"form-control\">" . $employeeSelected['name'] . "</option>";
                                } else {
                                    echo "<option value='' class=\"form-control\">None</option>";
                                }
                                ?>
                                <option disabled>---</option>
                                <option value="">None</option>
                                <?php
                                foreach ($employeeMgr->getEmployees() as $employee) {
                                    echo "<option value='" . $employee['id'] . "'>#" . $employee['id'] . " " . $employee['name'] . "</option>";
                                }
                                ?>
                            </select>
                            <input class="form-control" type="date" id="sewer_lock_date"
                                   name="sewer_lock_date" <?php if ($checkForEmployee->rowCount() == 1) {
                                echo "value='" . date("Y-m-d", strtotime($employeeSelected['date'])) . "'";
                            } ?>>
                            <div class="row">
                                <div class="col-4" style="padding-right: 0px;">
                                    <input class="form-control form-control-sm" id="sewer_lock_u_p"
                                           name="sewer_lock_u_p" placeholder="Unit Price" type="number"
                                           style="width:100%;" step="0.01"
                                           min="0.01" <?php if ($checkForEmployee->rowCount() == 1) {
                                        echo "value='" . number_format($employeeSelected['unit_price'], 2) . "'";
                                    } ?>>
                                </div>
                                <div class="col-4" style="padding: 0px 0px;">
                                    <input class="form-control form-control-sm" id="sewer_lock_qty"
                                           name="sewer_lock_qty" placeholder="Quantity" type="number"
                                           style="width:100%;" step="1"
                                           min="1"<?php if ($checkForEmployee->rowCount() == 1) {
                                        echo "value='" . $employeeSelected['quantity'] . "'";
                                    } ?>>
                                </div>
                                <div class="col-4" style="padding-left: 0px;">
                                    <input class="form-control form-control-sm" id="sewer_lock_amt"
                                           name="sewer_lock_amt" type="number" disabled=""
                                           style="width:100%;" <?php if ($checkForEmployee->rowCount() == 1) {
                                        echo "value='" . number_format($employeeSelected['amount'], 2) . "'";
                                    } ?>>
                                </div>
                            </div>
                        </div>
                        <div style="height:30px;"></div>
                    </div>
                    <div class="col col-md-6 col-12" style="padding-top:20px;"><label>Packing (Trim)</label>
                        <div class="form-group"><select id="packing_trim" name="packing_trim" class="form-control">
                                <?php
                                $checkForEmployee = $db->query("SELECT * FROM tasks LEFT JOIN employees e ON tasks.employee = e.id WHERE status = 4 AND employee IS NOT NULL AND sewer_id = '" . $_GET['id'] . "'");
                                if ($checkForEmployee->rowCount() == 1) {
                                    $employeeSelected = $checkForEmployee->fetch(PDO::FETCH_ASSOC);
                                    echo "<option value='" . $employeeSelected['employee'] . "' class=\"form-control\">" . $employeeSelected['name'] . "</option>";
                                } else {
                                    echo "<option value='' class=\"form-control\">None</option>";
                                }
                                ?>
                                <option disabled>---</option>
                                <option value="">None</option>
                                <?php
                                foreach ($employeeMgr->getEmployees() as $employee) {
                                    echo "<option value='" . $employee['id'] . "'>#" . $employee['id'] . " " . $employee['name'] . "</option>";
                                }
                                ?>
                                <input class="form-control" type="date" id="packing_trim_date"
                                       name="packing_trim_date" <?php if ($checkForEmployee->rowCount() == 1) {
                                    echo "value='" . date("Y-m-d", strtotime($employeeSelected['date'])) . "'";
                                } ?>>
                                <div class="row">
                                    <div class="col-4" style="padding-right: 0px;">
                                        <input class="form-control form-control-sm" id="packing_trim_u_p"
                                               name="packing_trim_u_p" placeholder="Unit Price" type="number"
                                               style="width:100%;" step="0.01"
                                               min="0.01" <?php if ($checkForEmployee->rowCount() == 1) {
                                            echo "value='" . number_format($employeeSelected['unit_price'], 2) . "'";
                                        } ?>>
                                    </div>
                                    <div class="col-4" style="padding: 0px 0px;">
                                        <input class="form-control form-control-sm" id="packing_trim_qty"
                                               name="packing_trim_qty" placeholder="Quantity" type="number"
                                               style="width:100%;" step="1"
                                               min="1"<?php if ($checkForEmployee->rowCount() == 1) {
                                            echo "value='" . $employeeSelected['quantity'] . "'";
                                        } ?>>
                                    </div>
                                    <div class="col-4" style="padding-left: 0px;">
                                        <input class="form-control form-control-sm" id="packing_trim_amt"
                                               name="packing_trim_amt" type="number" disabled=""
                                               style="width:100%;" <?php if ($checkForEmployee->rowCount() == 1) {
                                            echo "value='" . number_format($employeeSelected['amount'], 2) . "'";
                                        } ?>>
                                    </div>
                                </div>
                        </div>
                        <div style="height:30px;"></div>
                        <label>Packing (Quality Control)</label>
                        <div class="form-group"><select id="packing_qc" name="packing_qc" class="form-control">
                                <?php
                                $checkForEmployee = $db->query("SELECT * FROM tasks LEFT JOIN employees e ON tasks.employee = e.id WHERE status = 5 AND employee IS NOT NULL AND sewer_id = '" . $_GET['id'] . "'");
                                if ($checkForEmployee->rowCount() == 1) {
                                    $employeeSelected = $checkForEmployee->fetch(PDO::FETCH_ASSOC);
                                    echo "<option value='" . $employeeSelected['employee'] . "' class=\"form-control\">" . $employeeSelected['name'] . "</option>";
                                } else {
                                    echo "<option value='' class=\"form-control\">None</option>";
                                }
                                ?>
                                <option disabled>---</option>
                                <option value="">None</option>
                                <?php
                                foreach ($employeeMgr->getEmployees() as $employee) {
                                    echo "<option value='" . $employee['id'] . "'>#" . $employee['id'] . " " . $employee['name'] . "</option>";
                                }
                                ?>
                            </select>
                            <input class="form-control" type="date" id="packing_qc_date"
                                   name="packing_qc_date" <?php if ($checkForEmployee->rowCount() == 1) {
                                echo "value='" . date("Y-m-d", strtotime($employeeSelected['date'])) . "'";
                            } ?>>
                            <div class="row">
                                <div class="col-4" style="padding-right: 0px;">
                                    <input class="form-control form-control-sm" id="packing_qc_u_p"
                                           name="packing_qc_u_p" placeholder="Unit Price" type="number"
                                           style="width:100%;" step="0.01"
                                           min="0.01" <?php if ($checkForEmployee->rowCount() == 1) {
                                        echo "value='" . number_format($employeeSelected['unit_price'], 2) . "'";
                                    } ?>>
                                </div>
                                <div class="col-4" style="padding: 0px 0px;">
                                    <input class="form-control form-control-sm" id="packing_qc_qty"
                                           name="packing_qc_qty" placeholder="Quantity" type="number"
                                           style="width:100%;" step="1"
                                           min="1"<?php if ($checkForEmployee->rowCount() == 1) {
                                        echo "value='" . $employeeSelected['quantity'] . "'";
                                    } ?>>
                                </div>
                                <div class="col-4" style="padding-left: 0px;">
                                    <input class="form-control form-control-sm" id="packing_qc_amt"
                                           name="packing_qc_amt" type="number" disabled=""
                                           style="width:100%;" <?php if ($checkForEmployee->rowCount() == 1) {
                                        echo "value='" . number_format($employeeSelected['amount'], 2) . "'";
                                    } ?>>
                                </div>
                            </div>
                        </div>
                        <div style="height:30px;"></div>
                        <label>Packing (Pack)</label>
                        <div class="form-group">
                            <select id="packing_pack" name="packing_pack" class="form-control">
                                <?php
                                $checkForEmployee = $db->query("SELECT * FROM tasks LEFT JOIN employees e ON tasks.employee = e.id WHERE status = 6 AND employee IS NOT NULL AND sewer_id = '" . $_GET['id'] . "'");
                                if ($checkForEmployee->rowCount() == 1) {
                                    $employeeSelected = $checkForEmployee->fetch(PDO::FETCH_ASSOC);
                                    echo "<option value='" . $employeeSelected['employee'] . "' class=\"form-control\">" . $employeeSelected['name'] . "</option>";
                                } else {
                                    echo "<option value='' class=\"form-control\">None</option>";
                                }
                                ?>
                                <option disabled>---</option>
                                <option value="">None</option>
                                <?php
                                foreach ($employeeMgr->getEmployees() as $employee) {
                                    echo "<option value='" . $employee['id'] . "'>#" . $employee['id'] . " " . $employee['name'] . "</option>";
                                }
                                ?>
                                <input class="form-control" type="date" id="packing_pack_date"
                                       name="packing_pack_date" <?php if ($checkForEmployee->rowCount() == 1) {
                                    echo "value='" . date("Y-m-d", strtotime($employeeSelected['date'])) . "'";
                                } ?>>
                                <div class="row">
                                    <div class="col-4" style="padding-right: 0px;">
                                        <input class="form-control form-control-sm" id="packing_pack_u_p"
                                               name="packing_pack_u_p" placeholder="Unit Price" type="number"
                                               style="width:100%;" step="0.01"
                                               min="0.01" <?php if ($checkForEmployee->rowCount() == 1) {
                                            echo "value='" . number_format($employeeSelected['unit_price'], 2) . "'";
                                        } ?>>
                                    </div>
                                    <div class="col-4" style="padding: 0px 0px;">
                                        <input class="form-control form-control-sm" id="packing_pack_qty"
                                               name="packing_pack_qty" placeholder="Quantity" type="number"
                                               style="width:100%;" step="1"
                                               min="1"<?php if ($checkForEmployee->rowCount() == 1) {
                                            echo "value='" . $employeeSelected['quantity'] . "'";
                                        } ?>>
                                    </div>
                                    <div class="col-4" style="padding-left: 0px;">
                                        <input class="form-control form-control-sm" id="packing_pack_amt"
                                               name="packing_pack_amt" type="number" disabled=""
                                               style="width:100%;" <?php if ($checkForEmployee->rowCount() == 1) {
                                            echo "value='" . number_format($employeeSelected['amount'], 2) . "'";
                                        } ?>>
                                    </div>
                                </div>
                        </div>
                        <div style="height:30px;"></div>
                        <div class="btn-group float-right" role="group">
                            <button class="btn btn-danger" type="button">Refresh</button>
                            <button class="btn btn-success" type="submit" name="sewer_submit" id="sewer_submit"
                                    value="sewer_submit">Submit
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <div style="height:30px;"></div>
        </div>
    </div>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script>
    let sewer_edging_u_p = document.getElementById("sewer_edging_u_p");
    let sewer_edging_qty = document.getElementById("sewer_edging_qty");
    let sewer_edging_amt = document.getElementById("sewer_edging_amt");
    sewer_edging_qty.addEventListener("keyup", updateAmountForSewerEdging);
    sewer_edging_u_p.addEventListener("keyup", updateAmountForSewerEdging);

    function updateAmountForSewerEdging() {
        sewer_edging_amt.value = parseFloat(sewer_edging_u_p.value * sewer_edging_qty.value).toFixed(2)
    }

    let sewer_piping_u_p = document.getElementById("sewer_piping_u_p");
    let sewer_piping_qty = document.getElementById("sewer_piping_qty");
    let sewer_piping_amt = document.getElementById("sewer_piping_amt");
    sewer_piping_qty.addEventListener("keyup", updateAmountForSewerPiping);
    sewer_piping_u_p.addEventListener("keyup", updateAmountForSewerPiping);

    function updateAmountForSewerPiping() {
        sewer_piping_amt.value = parseFloat(sewer_piping_u_p.value * sewer_piping_qty.value).toFixed(2)
    }

    let sewer_lock_u_p = document.getElementById("sewer_lock_u_p");
    let sewer_lock_qty = document.getElementById("sewer_lock_qty");
    let sewer_lock_amt = document.getElementById("sewer_lock_amt");
    sewer_lock_qty.addEventListener("keyup", updateAmountForSewerLock);
    sewer_lock_u_p.addEventListener("keyup", updateAmountForSewerLock);

    function updateAmountForSewerLock() {
        sewer_lock_amt.value = parseFloat(sewer_lock_u_p.value * sewer_lock_qty.value).toFixed(2)
    }

    let packing_trim_u_p = document.getElementById("packing_trim_u_p");
    let packing_trim_qty = document.getElementById("packing_trim_qty");
    let packing_trim_amt = document.getElementById("packing_trim_amt");
    packing_trim_qty.addEventListener("keyup", updateAmountForPackingTrim);
    packing_trim_u_p.addEventListener("keyup", updateAmountForPackingTrim);

    function updateAmountForPackingTrim() {
        packing_trim_amt.value = parseFloat(packing_trim_u_p.value * packing_trim_qty.value).toFixed(2)
    }

    let packing_qc_u_p = document.getElementById("packing_qc_u_p");
    let packing_qc_qty = document.getElementById("packing_qc_qty");
    let packing_qc_amt = document.getElementById("packing_qc_amt");
    packing_qc_qty.addEventListener("keyup", updateAmountForPackingQc);
    packing_qc_u_p.addEventListener("keyup", updateAmountForPackingQc);

    function updateAmountForPackingQc() {
        packing_qc_amt.value = parseFloat(packing_qc_u_p.value * packing_qc_qty.value).toFixed(2)
    }

    let packing_pack_u_p = document.getElementById("packing_pack_u_p");
    let packing_pack_qty = document.getElementById("packing_pack_qty");
    let packing_pack_amt = document.getElementById("packing_pack_amt");
    packing_pack_qty.addEventListener("keyup", updateAmountForPackingPack);
    packing_pack_u_p.addEventListener("keyup", updateAmountForPackingPack);

    function updateAmountForPackingPack() {
        packing_pack_amt.value = parseFloat(packing_pack_u_p.value * packing_pack_qty.value).toFixed(2)
    }
</script>
</body>

</html>