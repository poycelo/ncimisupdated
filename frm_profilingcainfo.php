<?php include('head.html'); ?>
<?php include('session.php'); ?>

<body>
    <?php include('sidebar.php'); ?>
    <?php include('menu.php'); ?>


    <?php
    $SID   = $_REQUEST['SID'];
    $query = $dbConn->query("SELECT * FROM tbl_profilingca WHERE SID = '$SID'");
    $row   = mysqli_fetch_assoc($query);

    // Convert PSGC code to Location Names
    $geocode = $row['INFO_REGION'];
    $getLocation = $dbConn->query("SELECT * FROM psgc_region WHERE psgc_code LIKE '$geocode%'");
    $rowLocation = mysqli_fetch_assoc($getLocation);

    //PROVINCE
    $provCode = $row['INFO_PROV'];
    $getProv = $dbConn->query("SELECT * FROM psgc_provinces WHERE Code LIKE '$provCode%'");
    $rowProv = mysqli_fetch_assoc($getProv);

    //DENR
    $officesDENR = $dbConn->query("SELECT * FROM ref_offices WHERE CODE_MAIN = '3'");
    while ($row_resultOffDENR = $officesDENR->fetch_assoc()) {
        $ref_off_infoDENR[] = $row_resultOffDENR['INFO_OFFICE'] . '.' . $row_resultOffDENR['CODE_MAIN'];
    }
    //END DENR


    //DILG
    $officesDILG = $dbConn->query("SELECT * FROM ref_offices WHERE CODE_MAIN = '4'");
    while ($row_resultOffDILG = $officesDILG->fetch_assoc()) {
        $ref_off_infoDILG[] = $row_resultOffDILG['INFO_OFFICE'] . '.' . $row_resultOffDILG['CODE_MAIN'];
    }
    //END DILG

    //OTHER
    $officesother = $dbConn->query("SELECT * FROM ref_offices WHERE CODE_MAIN = '5'");
    while ($row_resultOffother = $officesother->fetch_assoc()) {
        $ref_off_infoother[] = $row_resultOffother['INFO_OFFICE'] . '.' . $row_resultOffother['CODE_MAIN'];
    }
    //END OTHER


    if (isset($_POST['addInter'])) {
        // post part and save part ng intervention
        $SIDArr               = $_POST['SID'];
        //$idid                 = $_POST['ID'];
        $mainofficeArr        = $_POST['txtMainoff'];
        $interventionsArr     = $_POST['txtIntervention'];
        $particularsArr       = $_POST['txtParticulars'];
        $quantityArr          = $_POST['txtQuantity'];
        $yearArr              = $_POST['txtYear'];
        $unitArr              = $_POST['txtUnit'];
        $budgetArr            = $_POST['txtBudget'];
        // save certificates

        $dbConn->query("DELETE FROM tbl_interventions WHERE SID='$SIDArr'");


        // $offArr = $_POST['off'];
        if (!empty($interventionsArr)) {
            for ($i = 0; $i < count($particularsArr); $i++) {
                if (!empty($interventionsArr[$i])) {

                    $sid               = $SIDArr;
                    $off               = $mainofficeArr[$i];
                    $interventions     = $interventionsArr[$i];
                    $particulars       = $particularsArr[$i];
                    $quantity          = $quantityArr[$i];
                    $year              = $yearArr[$i];
                    $unit              = $unitArr[$i];
                    $budget            = $budgetArr[$i];
                    $profstat = 'For Review';
                    $dbConn->query('INSERT INTO tbl_interventions (SID, INFO_MAIN_DEPARTMENT, INFO_MAIN, INFO_INTERVENTION, INFO_PARTICULARS, INFO_COMM_QUANTITY, INFO_YEAR, INFO_UNIT, INFO_COMM_BUDGET, INFO_USER, INFO_OFFICE, INFO_AGENCY, INFO_ACCESSLEVEL) 
                VALUES ("' . $sid . '", "", "' . $off . '", "' . $interventions . '", "' . $particulars . '", "' . $quantity . '", "' . $year . '", "' . $unit . '", "' . $budget . '", "' . $userid . '", "' . $office . '", "' . $agency . '", "' . $accesslvl . '")');
                    echo '<script language="javascript">alert("Save successfully!")</script>';
                    // echo 'INSERT INTO tbl_interventions (SID, INFO_MAIN_DEPARTMENT, INFO_MAIN, INFO_INTERVENTION, INFO_PARTICULARS, INFO_COMM_QUANTITY, INFO_UNIT, INFO_COMM_BUDGET, INFO_USER, INFO_OFFICE, INFO_AGENCY, INFO_ACCESSLEVEL) VALUES ("'.$sid.'", "", "'.$off.'", "'.$interventions.'", "'.$particulars.'", "'.$quantity.'", "'.$unit.'", "'.$budget.'", "'.$user.'", "'.$office.'", "'.$agency.'", "'.$accesslvl.'") /////////// /' . $i;


                    echo "<script>window.location.href='frm_profilingcainfo.php?SID=$SID';</script>";
                }
            }
        }
    }
    ?>
    <div class="container-fluid px-3 py-0">
        <div class="col-lg-12 bg-white border p-3">
            <div class="form-row">
                <div class="col-lg-12">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Convergence Area Profile</h1>
                </div>
            </div>
            <div class="form-row">
                <div class="col-lg-12">
                    <!-- Data Table -->
                    <div style="font-size: 0.9rem;">
                        <div class="form-row mt-3 border">
                            <div class="col-lg-2 bg-label p-2">
                                name
                            </div>
                            <div class="col-lg-10 p-2">
                                <?php echo $row['INFO_NAME']; ?>
                            </div>
                        </div>

                        <div class="form-row border border-top-0">
                            <div class="col-lg-2 bg-label p-2">
                                Watershed / Sub-watershed
                            </div>
                            <div class="col-lg-10 p-2">
                                <?php
                                $ws_name = '';
                                $ws_name = explode(",", $row['INFO_WATERSHED']);
                                $wsn = '';
                                foreach ($ws_name as $name_ws) {
                                    //echo $municipality = trim($municipality) . '<br/>';
                                    $getws = $dbConn->query("SELECT * FROM ref_watershed WHERE `WS_CODE`=$name_ws");
                                    $rowws = mysqli_fetch_assoc($getws);
                                    $wsn .= $rowws['NAME_WATERSHED'] . ' ,';
                                }
                                echo rtrim($wsn, ','); ?>
                            </div>
                        </div>


                        <div class="form-row border border-top-0">
                            <div class="col-lg-2 bg-label p-2">
                                Region
                            </div>
                            <div class="col-lg-2 p-2">
                                <?php echo $rowLocation['name']; ?>
                            </div>
                            <div class="col-lg-2 bg-label p-2">
                                Province
                            </div>
                            <div class="col-lg-2 p-2">
                                <?php echo $rowProv['Province']; ?>
                            </div>
                            <div class="col-lg-2 bg-label p-2">
                                Municipality
                            </div>
                            <div class="col-lg-2 p-2">
                                <?php
                                $municipalities = '';
                                $municipalities = explode(",", $row['INFO_MUN']);
                                $munn = '';
                                foreach ($municipalities as $municipality) {
                                    //echo $municipality = trim($municipality) . '<br/>';
                                    $getMunicipality = $dbConn->query("SELECT * FROM psgc_municipalities WHERE `Code`=$municipality");
                                    $rowMunicipality = mysqli_fetch_assoc($getMunicipality);
                                    $munn .= $rowMunicipality['Municipality'] . ' ,';
                                }
                                echo rtrim($munn, ',');
                                ?>
                            </div>
                        </div>

                        <div class="form-row border border-top-0">
                            <div class="col-lg-2 bg-label p-2">
                                Date From
                            </div>
                            <div class="col-lg-2 p-2">
                                <?php echo $row['INFO_TF_FROM']; ?>
                            </div>
                            <div class="col-lg-2 bg-label p-2">
                                Date To
                            </div>
                            <div class="col-lg-2 p-2">
                                <?php echo $row['INFO_TF_TO']; ?>
                            </div>
                            <div class="col-lg-2 bg-label p-2">
                                Status
                            </div>
                            <div class="col-lg-2 p-2">
                                <?php if ($row['INFO_CON_TYPE'] == 'Proposed CADP') {
                                    echo 'N/A';
                                } else {
                                    echo $row['INFO_STATUS'];
                                } ?>
                            </div>
                        </div>

                        <div class="form-row border border-top-0">
                            <div class="col-lg-2 p-2 bg-label">
                                Priority Commodities
                            </div>
                            <div class="col-lg-10 p-2">
                                <?php
                                $commodities = '';
                                $commodities = explode(",", $row['INFO_COMMODITIES']);
                                $commoo = '';
                                foreach ($commodities as $commo) {
                                    //echo $municipality = trim($municipality) . '<br/>';
                                    $getComm = $dbConn->query("SELECT * FROM ref_priority_commodities WHERE PC_CODE='$commo'");
                                    $rowComm = mysqli_fetch_assoc($getComm);
                                    $commoo .= $rowComm['PC_DESC'] . ' ,';
                                }
                                echo rtrim($commoo, ','); ?>
                                <?php {
                                    $getls = $dbConn->query("SELECT INFO_COMM_LIVESTOCK FROM tbl_profilingca");
                                    $rowls = mysqli_fetch_assoc($getls);

                                    echo $rowls['INFO_COMM_LIVESTOCK'] . ',';
                                }

                                ?>
                                <?php {
                                    $getls = $dbConn->query("SELECT INFO_COMM_POULTRY FROM tbl_profilingca");
                                    $rowls = mysqli_fetch_assoc($getls);

                                    echo $rowls['INFO_COMM_POULTRY'] . ',';
                                }

                                ?>

                                <?php {
                                    $getls = $dbConn->query("SELECT INFO_COMM_OTHERS FROM tbl_profilingca");
                                    $rowls = mysqli_fetch_assoc($getls);

                                    echo $rowls['INFO_COMM_OTHERS'] . '';
                                }

                                ?>

                            </div>
                        </div>
                        <!-- INTERVENTIONS -->
                        <div class="form-row mt-3">
                            <div class="col-lg-12">
                                <!-- Page Heading -->
                                <h1 class="h5 mb-2 text-gray-800">Programs, Activities and Projects with Corresponding Targets</h1>
                            </div>
                        </div>

                        <form method="post">
                            <!-- Interventions: Department of Agriculture (DA) -->
                            <div class="form-row mt-3">
                                <div class="col-lg-12">
                                    <h5 class="custom-font">Department of Agriculture</h5>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-lg-12">
                                    <table id="DA" class="table table-bordered table-striped custom-font" width="100%" cellspacing="0">
                                        <thead class="custom-ffedis text-white bg-accent text-xs">
                                            <tr>
                                                <th width="20%">Program/Project Classification</th>
                                                <th>Intervention</th>
                                                <th>Committed Quantity</th>
                                                <th>Unit</th>
                                                <th>Year</th>
                                                <th>Financial Target ('000)</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php $queryDA = $dbConn->query("SELECT * FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%AGRICULTURE%' ORDER BY INFO_DATETIME ASC"); ?>
                                        <?php $countDA = mysqli_num_rows($queryDA); ?>
                                        <tbody>
                                            <?php if ($countDA == 0) { ?>
                                                <!-- OFFICE -->
                                                <input type="hidden" name="SID" value="<?php echo $SID; ?>">

                                                <tr class="fieldGroupDA">
                                                    <td>
                                                        <input type="hidden" class="form-control form-control-sm col-lg-2" name="txtMainoff[]" value="DEPARTMENT OF AGRICULTURE">
                                                        <!-- PROGRAM -->
                                                        <?php $getProgram = $dbConn->query("SELECT * FROM ref_programs WHERE PROGRAM_CODE = 'DA'"); ?>
                                                        <select class="form-control form-control-sm col-lg-12 text-xs" name="txtParticulars[]" placeholder="Program/Project Classification">
                                                            <option value="" selected>SELECT PROGRAM</option>
                                                            <?php while ($rowProgram = mysqli_fetch_assoc($getProgram)) { ?>
                                                                <option value="<?php echo $rowProgram['PROGRAM_DESC']; ?>"><?php echo $rowProgram['PROGRAM_DESC']; ?></option>
                                                            <?php } ?>

                                                        </select>
                                                    </td>
                                                    <td>
                                                        <?php $getInter = $dbConn->query("SELECT * FROM ref_intervention WHERE OFFICE_CODE = 'DA'"); ?>
                                                        <select class="form-control form-control-sm col-lg-12 text-xs" name="txtIntervention[]" placeholder="Specific Intervention">
                                                            <option value="" selected>SELECT INTERVENTION</option>
                                                            <?php while ($rowInter = mysqli_fetch_assoc($getInter)) { ?>
                                                                <option value="<?php echo $rowInter['INTERVENTION_DESC']; ?>">
                                                                    <?php echo $rowInter['INTERVENTION_DESC']; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td><input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtQuantity[]" placeholder="Committed Quantity" onkeyup="this.value = this.value.toUpperCase();"></td>
                                                    <td>
                                                        <?php $query_unit = $dbConn->query("SELECT * FROM ref_unit"); ?>
                                                        <select class="form-control form-control-sm col-lg-12 text-xs" name="txtUnit[]" placeholder="Unit">
                                                            <option value="" selected>SELECT UNIT</option>
                                                            <?php while ($rowUnit = mysqli_fetch_assoc($query_unit)) { ?>
                                                                <option value="<?php echo $rowUnit['UNIT']; ?>"><?php echo $rowUnit['UNIT']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="txtYear[]" class="form-control form-control-sm col-lg-12 text-xs">
                                                            <option value="N/A">SELECT YEAR</option>
                                                            <option value="2010">2010</option>
                                                            <option value="2011">2011</option>
                                                            <option value="2012">2012</option>
                                                            <option value="2013">2013</option>
                                                            <option value="2014">2014</option>
                                                            <option value="2015">2015</option>
                                                            <option value="2016">2016</option>
                                                            <option value="2017">2017</option>
                                                            <option value="2018">2018</option>
                                                            <option value="2019">2019</option>
                                                            <option value="2020">2020</option>
                                                            <option value="2021">2021</option>
                                                            <option value="2022">2022</option>
                                                            <option value="2023">2023</option>
                                                            <option value="2024">2024</option>
                                                            <option value="2025">2025</option>
                                                            <option value="2026">2026</option>
                                                            <option value="2027">2027</option>
                                                            <option value="2028">2028</option>
                                                            <option value="2029">2029</option>
                                                            <option value="2030">2030</option>
                                                        </select>
                                                    </td>
                                                    <td><input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtBudget[]" placeholder="Financial Target ('000)" onkeyup="this.value = this.value.toUpperCase();"></td>
                                                    <td class="text-center"><button type="button" id="addMoreDA" name="somethingbtn" class="btn btn-success btn-sm addMoreDA"><i class="fas fa-plus fa-white"></i></button></td>
                                                </tr>


                                            <?php }
                                            $certCount = 0; // counter for certificates. 1st record will have 'add' button, succeeding rows will have 'remove' button.
                                            while ($rowDA = mysqli_fetch_assoc($queryDA)) {
                                                $certCount = $certCount + 1; ?>
                                                <tr class="fieldGroupDA">
                                                    <td>
                                                        <!-- PROGRAM -->
                                                        <input type="hidden" class="form-control form-control-sm col-lg-2" name="txtMainoff[]" value="DEPARTMENT OF AGRICULTURE">

                                                        <?php $getProgram = $dbConn->query("SELECT * FROM ref_programs WHERE OFFICE_CODE = 'DA'"); ?>
                                                        <select class="form-control form-control-sm col-lg-12 text-xs" name="txtParticulars[]" placeholder="Program/Project Classification">
                                                            <option value="<?php echo $rowDA['INFO_PARTICULARS']; ?>" selected><?php echo $rowDA['INFO_PARTICULARS']; ?></option>
                                                            <option value="" disabled>SELECT PROGRAM</option>
                                                            <?php while ($rowProgram = mysqli_fetch_assoc($getProgram)) { ?>
                                                                <option value="<?php echo $rowProgram['PROGRAM_DESC']; ?>">
                                                                    <?php echo $rowProgram['PROGRAM_DESC']; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <!-- Intervention -->
                                                        <?php $getInter = $dbConn->query("SELECT * FROM ref_intervention WHERE OFFICE_CODE = 'DA'"); ?>
                                                        <select class="form-control form-control-sm col-lg-12 text-xs" name="txtIntervention[]" placeholder="Specific Intervention">
                                                            <option value="<?php echo $rowDA['INFO_INTERVENTION']; ?>" selected><?php echo $rowDA['INFO_INTERVENTION']; ?></option>
                                                            <option value="" disabled>SELECT INTERVENTION</option>
                                                            <?php while ($rowInter = mysqli_fetch_assoc($getInter)) { ?>
                                                                <option value="<?php echo $rowInter['INTERVENTION_DESC']; ?>">
                                                                    <?php echo $rowInter['INTERVENTION_DESC']; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>

                                                    <td><input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtQuantity[]" value="<?php echo $rowDA['INFO_COMM_QUANTITY']; ?>" placeholder="Committed Quantity" onkeyup="this.value = this.value.toUpperCase();">
                                                    </td>

                                                    <td>
                                                        <!-- UNIT -->

                                                        <select class="form-control form-control-sm col-lg-12 text-xs" name="txtUnit[]" placeholder="Unit">
                                                            <option value="<?php echo $rowDA['INFO_UNIT']; ?>"><?php echo $rowDA['INFO_UNIT']; ?></option>
                                                            <option value="" disabled>SELECT UNIT</option>
                                                            <?php $query_unit = $dbConn->query("SELECT * FROM ref_unit"); ?>
                                                            <?php while ($rowUnit = mysqli_fetch_assoc($query_unit)) { ?>
                                                                <option value="<?php echo $rowUnit['UNIT']; ?>">
                                                                    <?php echo $rowUnit['UNIT']; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="txtYear[]" class="form-control  form-control-sm col-lg-12 text-xs">
                                                            <option value="<?php echo $rowDA['INFO_YEAR']; ?>"><?php echo $rowDA['INFO_YEAR']; ?></option>
                                                            <option value="N/A">SELECT YEAR</option>
                                                            <option value="2010">2010</option>
                                                            <option value="2011">2011</option>
                                                            <option value="2012">2012</option>
                                                            <option value="2013">2013</option>
                                                            <option value="2014">2014</option>
                                                            <option value="2015">2015</option>
                                                            <option value="2016">2016</option>
                                                            <option value="2017">2017</option>
                                                            <option value="2018">2018</option>
                                                            <option value="2019">2019</option>
                                                            <option value="2020">2020</option>
                                                            <option value="2021">2021</option>
                                                            <option value="2022">2022</option>
                                                            <option value="2023">2023</option>
                                                            <option value="2024">2024</option>
                                                            <option value="2025">2025</option>
                                                            <option value="2026">2026</option>
                                                            <option value="2027">2027</option>
                                                            <option value="2028">2028</option>
                                                            <option value="2029">2029</option>
                                                            <option value="2030">2030</option>
                                                        </select>
                                                    </td>
                                                    <td><input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtBudget[]" value="<?php echo $rowDA['INFO_COMM_BUDGET']; ?>" placeholder="Financial Target ('000)" onkeyup="this.value = this.value.toUpperCase();"></td>
                                                    <td class="text-center">
                                                        <?php if ($certCount == 1) { ?>
                                                            <button type="button" id="addMoreDA" name="somethingbtn" class="btn btn-success btn-sm addMoreDA"><i class="fas fa-plus fa-white"></i></button>
                                                        <?php } else { ?>
                                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm removeDA"><i class="fas fa-minus fa-white"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>

                                            <?php } ?>
                                            <tr class="fieldGroupCopyDA" style="display: none;">
                                                <td>
                                                    <!-- OFFICE -->
                                                    <input type="hidden" name="SID" value="<?php echo $SID; ?>">


                                                    <input type="hidden" class="form-control form-control-sm col-lg-2" name="txtMainoff[]" value="DEPARTMENT OF AGRICULTURE">
                                                    <!-- PROGRAM -->
                                                    <?php $getProgram = $dbConn->query("SELECT * FROM ref_programs WHERE PROGRAM_CODE = 'DA'"); ?>
                                                    <select class="form-control form-control-sm col-lg-12 text-xs" name="txtParticulars[]" placeholder="Program/Project Classification">
                                                        <option value="" selected>SELECT PROGRAM</option>
                                                        <?php while ($rowProgram = mysqli_fetch_assoc($getProgram)) { ?>
                                                            <option value="<?php echo $rowProgram['PROGRAM_DESC']; ?>">
                                                                <?php echo $rowProgram['PROGRAM_DESC']; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select></td>
                                                <td><?php $getInter = $dbConn->query("SELECT * FROM ref_intervention WHERE OFFICE_CODE = 'DA'"); ?>
                                                    <select class="form-control form-control-sm col-lg-12 text-xs" name="txtIntervention[]" placeholder="Specific Intervention">
                                                        <option value="" selected>SELECT INTERVENTION</option>
                                                        <?php while ($rowInter = mysqli_fetch_assoc($getInter)) { ?>
                                                            <option value="<?php echo $rowInter['INTERVENTION_DESC']; ?>">
                                                                <?php echo $rowInter['INTERVENTION_DESC']; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select></td>
                                                <td><input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtQuantity[]" placeholder="Committed Quantity" onkeyup="this.value = this.value.toUpperCase();">
                                                </td>
                                                <td> <?php $query_unit = $dbConn->query("SELECT * FROM ref_unit"); ?>
                                                    <select class="form-control form-control-sm col-lg-12 text-xs" name="txtUnit[]" placeholder="Unit">
                                                        <option value="" selected>SELECT UNIT</option>
                                                        <?php while ($rowUnit = mysqli_fetch_assoc($query_unit)) { ?>
                                                            <option value="<?php echo $rowUnit['UNIT']; ?>">
                                                                <?php echo $rowUnit['UNIT']; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="txtYear[]" class="form-control form-control-sm col-lg-12 text-xs">
                                                        <option value="N/A">SELECT YEAR</option>
                                                        <option value="2010">2010</option>
                                                        <option value="2011">2011</option>
                                                        <option value="2012">2012</option>
                                                        <option value="2013">2013</option>
                                                        <option value="2014">2014</option>
                                                        <option value="2015">2015</option>
                                                        <option value="2016">2016</option>
                                                        <option value="2017">2017</option>
                                                        <option value="2018">2018</option>
                                                        <option value="2019">2019</option>
                                                        <option value="2020">2020</option>
                                                        <option value="2021">2021</option>
                                                        <option value="2022">2022</option>
                                                        <option value="2023">2023</option>
                                                        <option value="2024">2024</option>
                                                        <option value="2025">2025</option>
                                                        <option value="2026">2026</option>
                                                        <option value="2027">2027</option>
                                                        <option value="2028">2028</option>
                                                        <option value="2029">2029</option>
                                                        <option value="2030">2030</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtBudget[]" placeholder="Financial Target ('000)" onkeyup="this.value = this.value.toUpperCase();">
                                                </td>
                                                <td class="text-center"><a href="javascript:void(0)" class="btn btn-danger btn-sm removeDA"><i class="fas fa-minus fa-white"></i></a>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END DA -->


                            <?php
                            include('tbl_DAR.php');
                            include('tbl_DENR.php');
                            include('tbl_DILG.php');
                            include('tbl_OTHER.php');
                            ?>

                            <?php if ($rowUserInfo["INFO_ACCESSLEVEL"] == 'ENCODER') { ?>
                                <button type="submit" name="addInter" class="btn btn-sm btn-primary form-control form-control-sm text-xs col-lg-1 ml-3 mt-3">
                                    <i class="fas fa-save fa-xs"></i>
                                    Save
                                </button>
                            <?php } ?>
                        </form>
                    </div>
                </div>




                <?php include('footer.html'); ?>
</body>



<!-- DYNAMIC ADD / REMOVE FORM GROUP -->
<script>
    $(document).ready(function() {
        //group add limit
        var maxGroup = 20;
        var row_id = 0;

        //add more fields group
        $(".addMoreDA").click(function() {
            if ($('body').find('.fieldGroupDA').length < maxGroup) {
                var fieldHTML = '<tr class="fieldGroupDA">' + $(".fieldGroupCopyDA").html() + '</tr>';
                $('body').find('.fieldGroupDA:last').after(fieldHTML);
            } else {
                alert('Maximum ' + maxGroup + ' groups are allowed.');
            }
        });

        //remove fields group
        $("body").on("click", ".removeDA", function() {
            $(this).parents(".fieldGroupDA").remove();
        });
    });


    //DAR
    $(document).ready(function() {
        //group add limit
        var maxGroup = 20;
        var row_id = 0;

        //add more fields group
        $(".addMoreDAR").click(function() {
            if ($('body').find('.fieldGroupDAR').length < maxGroup) {
                var fieldHTML = '<tr class="fieldGroupDAR">' + $(".fieldGroupCopyDAR").html() + '</tr>';
                $('body').find('.fieldGroupDAR:last').after(fieldHTML);
            } else {
                alert('Maximum ' + maxGroup + ' groups are allowed.');
            }
        });

        //remove fields group
        $("body").on("click", ".removeDAR", function() {
            $(this).parents(".fieldGroupDAR").remove();
        });
    });

    //DENR
    $(document).ready(function() {
        //group add limit
        var maxGroup = 20;
        var row_id = 0;

        //add more fields group
        $(".addMoreDENR").click(function() {
            if ($('body').find('.fieldGroupDENR').length < maxGroup) {
                var fieldHTML = '<tr class="fieldGroupDENR">' + $(".fieldGroupCopyDENR").html() + '</tr>';
                $('body').find('.fieldGroupDENR:last').after(fieldHTML);
            } else {
                alert('Maximum ' + maxGroup + ' groups are allowed.');
            }
        });

        //remove fields group
        $("body").on("click", ".removeDENR", function() {
            $(this).parents(".fieldGroupDENR").remove();
        });
    });

    //DILG
    $(document).ready(function() {
        //group add limit
        var maxGroup = 20;
        var row_id = 0;

        //add more fields group
        $(".addMoreDILG").click(function() {
            if ($('body').find('.fieldGroupDILG').length < maxGroup) {
                var fieldHTML = '<tr class="fieldGroupDILG">' + $(".fieldGroupCopyDILG").html() + '</tr>';
                $('body').find('.fieldGroupDILG:last').after(fieldHTML);
            } else {
                alert('Maximum ' + maxGroup + ' groups are allowed.');
            }
        });

        //remove fields group
        $("body").on("click", ".removeDILG", function() {
            $(this).parents(".fieldGroupDILG").remove();
        });
    });


    //OTHER
    $(document).ready(function() {
        //group add limit
        var maxGroup = 20;
        var row_id = 0;

        //add more fields group
        $(".addMoreOTHER").click(function() {
            if ($('body').find('.fieldGroupOTHER').length < maxGroup) {
                var fieldHTML = '<tr class="fieldGroupOTHER">' + $(".fieldGroupCopyOTHER").html() + '</tr>';
                $('body').find('.fieldGroupOTHER:last').after(fieldHTML);
            } else {
                alert('Maximum ' + maxGroup + ' groups are allowed.');
            }
        });

        //remove fields group
        $("body").on("click", ".removeOTHER", function() {
            $(this).parents(".fieldGroupOTHER").remove();
        });
    });
</script>