<?php require_once "assets/php/EmployeeManager.php" ?>
<?php require_once "assets/php/SewerManager.php" ?>
<?php require_once "assets/php/CardManager.php" ?>
<?php require_once "assets/requires/dbcon.php" ?>
<?php // Sewer Update Processor
    if (isset($_POST['sewer_submit'])) {
        $updateSuccess = true;

        if (isset($_POST['sewerID']) && !empty($_POST['sewerID'])) {
            if (
                is_array($sewerMgr->searchSewerID($_POST['sewerID']))
            ) {
                if (isset($_POST['sewer_edging_date']) && !empty($_POST['sewer_edging_date']) && isset($_POST['sewer_edging']) && !empty(($_POST['sewer_edging']))) {
                    $sewerMgr->updateTask($_POST['sewerID'],1,$_POST['sewer_edging'],"'".$_POST['sewer_edging_date']."'") ? : $updateSuccess = false;
                } else {
                    $sewerMgr->updateTask($_POST['sewerID'],1,"","") ? : $updateSuccess = false;
                }
                
                if (isset($_POST['sewer_piping_date']) && !empty($_POST['sewer_piping_date']) && isset($_POST['sewer_piping']) && !empty(($_POST['sewer_piping']))) {
                    $sewerMgr->updateTask($_POST['sewerID'],2,$_POST['sewer_piping'],"'".$_POST['sewer_piping_date']."'") ? : $updateSuccess = false;
                } else {
                    $sewerMgr->updateTask($_POST['sewerID'],2,"","") ? : $updateSuccess = false;
                }
                
                if (isset($_POST['sewer_lock_date']) && !empty($_POST['sewer_lock_date']) && isset($_POST['sewer_lock']) && !empty(($_POST['sewer_lock']))) {
                    $sewerMgr->updateTask($_POST['sewerID'],3,$_POST['sewer_lock'],"'".$_POST['sewer_lock_date']."'") ? : $updateSuccess = false;
                } else {
                    $sewerMgr->updateTask($_POST['sewerID'],3,"","") ? : $updateSuccess = false;
                }
                
                if (isset($_POST['packing_trim_date']) && !empty($_POST['packing_trim_date']) && isset($_POST['packing_trim']) && !empty(($_POST['packing_trim']))) {
                    $sewerMgr->updateTask($_POST['sewerID'],4,$_POST['packing_trim'],"'".$_POST['packing_trim_date']."'");
                } else {
                    $sewerMgr->updateTask($_POST['sewerID'],4,"","") ? : $updateSuccess = false;
                }
                
                if (isset($_POST['packing_qc_date']) && !empty($_POST['packing_qc_date']) && isset($_POST['packing_trim']) && !empty(($_POST['packing_trim']))) {
                    $sewerMgr->updateTask($_POST['sewerID'],5,$_POST['packing_qc'],"'".$_POST['packing_qc_date']."'") ? : $updateSuccess = false;
                } else {
                    $sewerMgr->updateTask($_POST['sewerID'],5,"","") ? : $updateSuccess = false;
                }
                
                if (isset($_POST['packing_pack_date']) && !empty($_POST['packing_pack_date']) && isset($_POST['packing_pack']) && !empty(($_POST['packing_pack']))) {
                    $sewerMgr->updateTask($_POST['sewerID'],6,$_POST['packing_pack'],"'".$_POST['packing_pack_date']."'") ? : $updateSuccess = false;
                } else {
                    $sewerMgr->updateTask($_POST['sewerID'],6,"","") ? : $updateSuccess = false;
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html>

<head>
    <title>RGCU Sewer</title>
    <?php include_once "assets/includes/genHeader.php"?>
</head>

<body>
    <?php include_once "assets/includes/navbar.php"?>
    <?php
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            echo "<script>
                            location.href = 'sewers.php';
                </script>";
        } else {
            $checkForSewer = $db->query("SELECT * FROM sewers WHERE id = ".$_GET['id']);
            if ($checkForSewer->rowCount()!=1) {
                echo "<script>location.href='sewers.php'</script>";
            }
        }
    ?>
    <?php
        if (isset($updateSuccess)){
            if ($updateSuccess==true) {
                "<script>
                        Sweetalert2.fire({
                        title: \"Updated!\",
                        type: \"success\",
                        text: \"This sewer has been completely and successfully updated.\"
                        });
                </script>";
            } else {
                "<script>
                        Sweetalert2.fire({
                        title: \"Oops!\",
                        type: \"error\",
                        text: \"Probably some to no queries has been successful upon updating this sewer. Please try again.\"
                        });
                </script>";
            }
        }
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12" id="page-heading">
                <h2>Sewer "<?php echo $sewerMgr->getSewerItem($_GET['id'])?>" (#<?php echo $cardMgr->searchCardById($sewerMgr->getCardId($_GET['id']))['id'] . " " . $cardMgr->searchCardById($sewerMgr->getCardId($_GET['id']))['item']?>)</h2>
                <p><?php echo $sewerMgr->getSewerQty($_GET['id'])?> pcs, PhP <?php echo number_format($sewerMgr->getSewerAmt($_GET['id']),2,".",", ") ?> -> <?php echo $sewerMgr->getSewerStatusById($_GET['id']) ?></p>
                <form id="edit_sewer_form" name="edit_sewer_form" method="post" action="sewer.php?id=<?php echo $_GET['id']?>" enctype="application/x-www-form-urlencoded">
                    <input type="hidden" id="sewerID" name="sewerID" value="<?php echo $_GET['id'] ?>" />
                    <div class="form-row" style="width:100%;">
                        <div class="col col-md-6 col-12" style="padding-top:20px;"><label>Sewer (Edging)</label>
                            <div class="form-group">
                                <select id="sewer_edging" name="sewer_edging" class="form-control">
                                    <?php
                                        $checkForEmployee = $db->query("SELECT * FROM tasks LEFT JOIN employees e ON tasks.employee = e.id WHERE status = 1 AND employee IS NOT NULL AND sewer_id = '".$_GET['id']."'");
                                        if ($checkForEmployee->rowCount()==1) {
                                            $employeeSelected = $checkForEmployee->fetch(PDO::FETCH_ASSOC);
                                            echo "<option value='".$employeeSelected['employee']."' class=\"form-control\">".$employeeSelected['name']."</option>";
                                        } else {
                                            echo "<option value='' class=\"form-control\">None</option>";
                                        }
                                    ?>
                                    <option disabled>---</option>
                                    <option value="">None</option>
                                    <?php
                                        foreach ($employeeMgr->getEmployees() as $employee) {
                                            echo "<option value='".$employee['id']."'>#".$employee['id']." ".$employee['name']."</option>";
                                        }
                                    ?>
                                </select>
                                <input class="form-control" id="sewer_edging_date" name="sewer_edging_date" type="date" <?php if ($checkForEmployee->rowCount()==1) {echo "value='".date("Y-m-d", strtotime($employeeSelected['date']))."'";}?>></div>
                            <div style="height:30px;"></div><label>Sewer (Piping)</label>
                            <div class="form-group">
                                <select id="sewer_piping" name="sewer_piping" class="form-control">
                                    <?php
                                    $checkForEmployee = $db->query("SELECT * FROM tasks LEFT JOIN employees e ON tasks.employee = e.id WHERE status = 2 AND employee IS NOT NULL AND sewer_id = '".$_GET['id']."'");
                                    if ($checkForEmployee->rowCount()==1) {
                                        $employeeSelected = $checkForEmployee->fetch(PDO::FETCH_ASSOC);
                                        echo "<option value='".$employeeSelected['employee']."' class=\"form-control\">".$employeeSelected['name']."</option>";
                                    } else {
                                        echo "<option value='' class=\"form-control\">None</option>";
                                    }
                                    ?>
                                    <option disabled>---</option>
                                    <option value="">None</option>
                                    <?php
                                    foreach ($employeeMgr->getEmployees() as $employee) {
                                        echo "<option value='".$employee['id']."'>#".$employee['id']." ".$employee['name']."</option>";
                                    }
                                    ?>
                                </select>
                                <input class="form-control" type="date" id="sewer_piping_date" name="sewer_piping_date" <?php if ($checkForEmployee->rowCount()==1) {echo "value='".date("Y-m-d", strtotime($employeeSelected['date']))."'";}?>>
                            </div>
                            <div style="height:30px;"></div><label>Sewer (Lock)</label>
                            <div class="form-group">
                                <select id="sewer_lock" name="sewer_lock" class="form-control">
                                    <?php
                                    $checkForEmployee = $db->query("SELECT * FROM tasks LEFT JOIN employees e ON tasks.employee = e.id WHERE status = 3 AND employee IS NOT NULL AND sewer_id = '".$_GET['id']."'");
                                    if ($checkForEmployee->rowCount()==1) {
                                        $employeeSelected = $checkForEmployee->fetch(PDO::FETCH_ASSOC);
                                        echo "<option value='".$employeeSelected['employee']."' class=\"form-control\">".$employeeSelected['name']."</option>";
                                    } else {
                                        echo "<option value='' class=\"form-control\">None</option>";
                                    }
                                    ?>
                                    <option disabled>---</option>
                                    <option value="">None</option>
                                    <?php
                                    foreach ($employeeMgr->getEmployees() as $employee) {
                                        echo "<option value='".$employee['id']."'>#".$employee['id']." ".$employee['name']."</option>";
                                    }
                                    ?>
                                </select>
                                <input class="form-control" type="date" id="sewer_lock_date" name="sewer_lock_date" <?php if ($checkForEmployee->rowCount()==1) {echo "value='".date("Y-m-d", strtotime($employeeSelected['date']))."'";}?>></div>
                            <div style="height:30px;"></div>
                        </div>
                        <div class="col col-md-6 col-12" style="padding-top:20px;"><label>Packing (Trim)</label>
                            <div class="form-group"><select id="packing_trim" name="packing_trim" class="form-control">
                                    <?php
                                    $checkForEmployee = $db->query("SELECT * FROM tasks LEFT JOIN employees e ON tasks.employee = e.id WHERE status = 4 AND employee IS NOT NULL AND sewer_id = '".$_GET['id']."'");
                                    if ($checkForEmployee->rowCount()==1) {
                                        $employeeSelected = $checkForEmployee->fetch(PDO::FETCH_ASSOC);
                                        echo "<option value='".$employeeSelected['employee']."' class=\"form-control\">".$employeeSelected['name']."</option>";
                                    } else {
                                        echo "<option value='' class=\"form-control\">None</option>";
                                    }
                                    ?>
                                    <option disabled>---</option>
                                    <option value="">None</option>
                                    <?php
                                    foreach ($employeeMgr->getEmployees() as $employee) {
                                        echo "<option value='".$employee['id']."'>#".$employee['id']." ".$employee['name']."</option>";
                                    }
                                    ?>
                                <input class="form-control" type="date" id="packing_trim_date" name="packing_trim_date" <?php if ($checkForEmployee->rowCount()==1) {echo "value='".date("Y-m-d", strtotime($employeeSelected['date']))."'";}?>>
                            </div>
                            <div style="height:30px;"></div><label>Packing (Quality Control)</label>
                            <div class="form-group"><select id="packing_qc" name="packing_qc" class="form-control">
                                <?php
                                $checkForEmployee = $db->query("SELECT * FROM tasks LEFT JOIN employees e ON tasks.employee = e.id WHERE status = 5 AND employee IS NOT NULL AND sewer_id = '".$_GET['id']."'");
                                if ($checkForEmployee->rowCount()==1) {
                                    $employeeSelected = $checkForEmployee->fetch(PDO::FETCH_ASSOC);
                                    echo "<option value='".$employeeSelected['employee']."' class=\"form-control\">".$employeeSelected['name']."</option>";
                                } else {
                                    echo "<option value='' class=\"form-control\">None</option>";
                                }
                                ?>
                                <option disabled>---</option>
                                <option value="">None</option>
                                <?php
                                foreach ($employeeMgr->getEmployees() as $employee) {
                                    echo "<option value='".$employee['id']."'>#".$employee['id']." ".$employee['name']."</option>";
                                }
                                ?>
                                </select>
                                <input class="form-control" type="date" id="packing_qc_date" name="packing_qc_date" <?php if ($checkForEmployee->rowCount()==1) {echo "value='".date("Y-m-d", strtotime($employeeSelected['date']))."'";}?>>
                            </div>
                            <div style="height:30px;"></div><label>Packing (Pack)</label>
                            <div class="form-group">
                                <select id="packing_pack" name="packing_pack" class="form-control">
                                    <?php
                                    $checkForEmployee = $db->query("SELECT * FROM tasks LEFT JOIN employees e ON tasks.employee = e.id WHERE status = 6 AND employee IS NOT NULL AND sewer_id = '".$_GET['id']."'");
                                    if ($checkForEmployee->rowCount()==1) {
                                        $employeeSelected = $checkForEmployee->fetch(PDO::FETCH_ASSOC);
                                        echo "<option value='".$employeeSelected['employee']."' class=\"form-control\">".$employeeSelected['name']."</option>";
                                    } else {
                                        echo "<option value='' class=\"form-control\">None</option>";
                                    }
                                    ?>
                                    <option disabled>---</option>
                                    <option value="">None</option>
                                    <?php
                                    foreach ($employeeMgr->getEmployees() as $employee) {
                                        echo "<option value='".$employee['id']."'>#".$employee['id']." ".$employee['name']."</option>";
                                    }
                                    ?>
                                <input class="form-control" type="date" id="packing_pack_date" name="packing_pack_date" <?php if ($checkForEmployee->rowCount()==1) {echo "value='".date("Y-m-d", strtotime($employeeSelected['date']))."'";}?>></div>
                            <div style="height:30px;"></div>
                            <div class="btn-group float-right" role="group"><button class="btn btn-danger" type="button">Refresh</button><button class="btn btn-success" type="submit" name="sewer_submit" id="sewer_submit" value="sewer_submit">Submit</button></div>
                        </div>
                    </div>
                </form>
                <div style="height:30px;"></div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>