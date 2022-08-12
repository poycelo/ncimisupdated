<?php include('head.html'); ?>
<?php include('session.php'); ?>

<body>
    <?php include('sidebar.php'); ?>

    <?php include('menu.php'); ?>

    <?php
    $SID   = $_REQUEST['SID'];
    $query = $dbConn->query("SELECT * FROM tbl_profilingca WHERE SID = '$SID' AND INFO_STAT_AF ='Flagged'");
    $rowprof   = mysqli_fetch_assoc($query);


    $getvmgob = $dbConn->query("SELECT * FROM tbl_vmgob WHERE SID='$SID'");
    $rowvmgob = mysqli_fetch_assoc($getvmgob);

    // Convert PSGC code to Location Names
    $geocode = $rowprof['INFO_REGION'];
    $getLocation = $dbConn->query("SELECT * FROM psgc_region WHERE psgc_code LIKE '$geocode%'");
    $rowLocation = mysqli_fetch_assoc($getLocation);

    //PROVINCE
    $provCode = $rowprof['INFO_PROV'];
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


    // //OTHER
    $officesother = $dbConn->query("SELECT * FROM ref_offices2 WHERE CODE_MAIN = '5'");
    while ($row_resultOffother = $officesother->fetch_assoc()) {
        $ref_off_infoother[] = $row_resultOffother['INFO_OFFICE'] . '.' . $row_resultOffother['CODE_MAIN'];
    }
    //END OTHER


    if (isset($_POST['btnresend'])) {


        $region             = $_POST['txtRegion'];
        $prov               = $_POST['txtProvince'];
        $muni               = implode(',', $_POST['txtMunici']);

        $LCA_CODE           = $_POST['txtConType'];
        $conarea_name       = $_POST['txtName'];
        $watershed          = implode(',', $_POST['txtWatershed']);
        $wsothers           = $_POST['txtOthersWs'];
        $comm               = implode(',', $_POST['txtComm']);
        $livestock            = $_POST['txtLivestock'];
        $poultry             = $_POST['txtPoultry'];
        $others             = $_POST['txtOthers'];
        $datefrom           = $_POST['txtDateFrom'];
        $dateto             = $_POST['txtDateTo'];
        $status             = $_POST['txtStatus'];
        $remarks            = $_POST['txtRemarks'];

        $profstat = 'For Review';
        $vision             = $_POST['txtVision'];
        $mission            = $_POST['txtMission'];
        $goals              = $_POST['txtGoal'];
        $objective          = $_POST['txtObj'];
        $briefdesc          = $_POST['txtBriefdesc'];



        $dbConn->query("UPDATE tbl_profilingca SET   INFO_NAME         ='$conarea_name', 
                                                INFO_CON_TYPE     ='$LCA_CODE',  
                                                INFO_REGION       ='$region',
                                                INFO_PROV         ='$prov', 
                                                INFO_MUN          ='$muni',
                                                INFO_WATERSHED    ='$watershed',
                                                INFO_WATERSHED_OTHERS = '$wsothers',
                                                INFO_COMMODITIES  ='$comm', 
                                                INFO_COMM_LIVESTOCK = '$livestock' ,
                                                INFO_COMM_POULTRY = '$poultry' ,
                                                INFO_COMM_OTHERS ='$others',

                                                INFO_STAT_AF      = '$profstat', 
                                                INFO_STAT_REMARKS = NULL,
                                                INFO_TF_FROM      ='$datefrom', 
                                                INFO_TF_TO        ='$dateto', 
                                                INFO_STATUS       ='$status',
                                                INFO_REMARKS      ='$remarks'
                  WHERE SID='$SID'");

        $result = $dbConn->query("SELECT * FROM tbl_vmgob WHERE SID='$SID'");
        $rowcount = mysqli_num_rows($result);
        if ($rowcount <= 0) {
            $dbConn->query("INSERT INTO tbl_vmgob (SID, INFO_VISION, INFO_MISSION, INFO_GOAL, INFO_OBJECTIVE, INFO_BRIEF_DESC,INFO_STAT_AF, INFO_STAT_REMARKS, INFO_USER, INFO_OFFICE, INFO_AGENCY, INFO_ACCESSLEVEL)
      VALUES ('$SID','$vision','$mission','$goals','$objective','$briefdesc','$profstat',NULL,$user','$office','$agency', '$accesslvl')");
        } else {
            $dbConn->query("UPDATE tbl_vmgob SET INFO_VISION            ='$vision', 
                                         INFO_MISSION      ='$mission',  
                                         INFO_GOAL         ='$goals',
                                         INFO_OBJECTIVE    ='$objective', 
                                         INFO_BRIEF_DESC   ='$briefdesc'
                  WHERE SID='$SID'");
        }
        $watershed = $dbConn->query("SELECT * FROM ref_watershed");
        $conarea = $dbConn->query("SELECT * FROM ref_convergence_area");

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


                    $dbConn->query('INSERT INTO tbl_interventions (SID, INFO_MAIN_DEPARTMENT, INFO_MAIN, INFO_INTERVENTION, INFO_PARTICULARS, INFO_COMM_QUANTITY, INFO_YEAR, INFO_UNIT, INFO_COMM_BUDGET, INFO_USER, INFO_OFFICE, INFO_AGENCY, INFO_ACCESSLEVEL) 
                VALUES ("' . $sid . '", "", "' . $off . '", "' . $interventions . '", "' . $particulars . '", "' . $quantity . '", "' . $year . '", "' . $unit . '", "' . $budget . '", "' . $userid . '", "' . $office . '", "' . $agency . '", "' . $accesslvl . '")');

                    // echo 'INSERT INTO tbl_interventions (SID, INFO_MAIN_DEPARTMENT, INFO_MAIN, INFO_INTERVENTION, INFO_PARTICULARS, INFO_COMM_QUANTITY, INFO_UNIT, INFO_COMM_BUDGET, INFO_USER, INFO_OFFICE, INFO_AGENCY, INFO_ACCESSLEVEL) VALUES ("'.$sid.'", "", "'.$off.'", "'.$interventions.'", "'.$particulars.'", "'.$quantity.'", "'.$unit.'", "'.$budget.'", "'.$user.'", "'.$office.'", "'.$agency.'", "'.$accesslvl.'") /////////// /' . $i;
                }
            }
        }
        echo "<script>window.location.href='tbl_profca.php?SID=$SID';</script>";
        echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
    }

    ?>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                ordering: false,
                "bInfo": false,
                searching: false
            });
        });

        $(document).ready(function() {
            $('#DAR').DataTable({
                ordering: false,
                "bInfo": false,
                searching: false
            });
        });

        $(document).ready(function() {
            $('#DENR').DataTable({
                ordering: false,
                "bInfo": false,
                searching: false
            });
        });

        $(document).ready(function() {
            $('#DILG').DataTable({
                ordering: false,
                "bInfo": false,
                searching: false
            });
        });

        $(document).ready(function() {
            $('#OTHERS').DataTable({
                ordering: false,
                "bInfo": false,
                searching: false
            });
        });
    </script>

    <form method="POST">
        <div class="container-fluid px-3 py-0">
            <div class="col-lg-12 bg-white border p-3">
                <div class="form-row">
                    <div class="col-lg-12">
                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Edit Profiling</h1>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-lg-12">
                        <!-- Start of Data -->
                        <div style="font-size: 0.7rem;">
                            <div class="form-row mt-3 border">
                                <div class="col-lg-2 bg-label p-2">
                                    Type of Convergence Area
                                </div>

                                <div class="col-lg-2 p-2">
                                    <select class="form-control" id="type" name="txtConType" required>
                                        <option value="<?php echo $rowprof['INFO_CON_TYPE']; ?>"><?php echo $rowprof['INFO_CON_TYPE']; ?></option>
                                        <option disabled>-------------</option>
                                        <option value="CADP">CADP</option>
                                        <option value="LCAEC">LCAEC</option>
                                        <option value="Proposed CADP">Proposed CADP</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row border border-top-0">
                                <div class="col-lg-2 bg-label p-2">
                                    Name
                                </div>
                                <div class="col-lg-10 p-2">
                                    <input type="text" class="form-control text-xs txtName" name="txtName" value="<?php echo $rowprof['INFO_NAME']; ?>" placeholder="Convergence Name" onkeyup="this.value = this.value.toUpperCase();">
                                </div>
                            </div>

                            <div class="form-row border border-top-0">
                                <div class="col-lg-2 bg-label p-2" id="regdiv">
                                    Region
                                </div>
                                <div class="col-lg-10 p-2">
                                    <?php $getRegion2 = $dbConn->query("SELECT * FROM psgc_region "); ?>
                                    <select name="txtRegion" id="reg" placeholder="Region" onChange="getProvince(this.value)" class="form-control text-xs">
                                        <option value="<?php echo $rowprof['INFO_REGION']; ?>" selected><?= $rowLocation['name']; ?></option>
                                        <option disabled>-------------</option>
                                        <?php while ($rowLocation2 = mysqli_fetch_assoc($getRegion2)) { ?>
                                            <option value="<?php echo $rowLocation2['psgc_code']; ?>">
                                                <?php echo $rowLocation2['name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row border border-top-0" id="provdiv">
                                <div class="col-lg-2 bg-label p-2">
                                    Province
                                </div>
                                <div class="col-lg-10 p-2">
                                    <select name="txtProvince" class="form-control" placeholder="Province" readonly>
                                        <option value="<?php echo $rowprof['INFO_PROV']; ?>" selected><?= $rowProv['Province']; ?></option>
                                    </select>
                                </div>
                                <div class="col-lg-2 bg-label p-2">
                                    Municipality
                                </div>
                                <div class="col-lg-10 p-2" id="mundiv">
                                    <?php
                                    $codeProvince    = $rowprof['INFO_PROV'];
                                    $prov = substr($codeProvince, 0, 4);
                                    $getMunicipality = $dbConn->query("SELECT * FROM psgc_municipalities WHERE Code LIKE '$prov%' ORDER BY Municipality ASC");
                                    ?>
                                    <div class="form-row p-0 catCereal">
                                        <?php while ($rowMunicipality = mysqli_fetch_assoc($getMunicipality)) { ?>
                                            <div class="col-lg-3 mb-2">
                                                <input type="checkbox" name="txtMunici[]" value="<?= $rowMunicipality['Code']; ?>" 
                                                <?php if (stripos($rowprof['INFO_MUN'], $rowMunicipality['Code']) !== FALSE) {
                                                        echo 'checked';
                                                    } ?> class="mr-2 mb-1">
                                                <?= $rowMunicipality['Municipality']; ?>
                                            </div>
                                        <?php } ?>
                                    </div>

                                </div>
                                <div class="col-lg-2 bg-label p-2">
                                    Watershed
                                </div>
                                <div class="col-lg-10 p-2">
                                    <?php
                                    $codeReg    = $rowprof['INFO_REGION'];
                                    $WScode = substr($codeReg, 0, 2);
                                    $getWater = $dbConn->query("SELECT * FROM ref_watershed WHERE WS_CODE LIKE '$WScode%' ORDER BY NAME_WATERSHED ASC");
                                    ?>
                                    <div class="form-row p-0">
                                        <?php while ($rowWater = mysqli_fetch_assoc($getWater)) { ?>
                                            <div class="col-lg-3 mb-2">
                                                <input type="checkbox" name="txtWatershed[]" value="<?= $rowWater['WS_CODE']; ?>" 
                                                <?php if (stripos($rowprof['INFO_WATERSHED'], $rowWater['WS_CODE']) !== FALSE) {
                                                    echo 'checked';
                                                } ?> class="mr-2 mb-1">
                                                <?= $rowWater['NAME_WATERSHED']; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row border border-top-0">
                                <div class="col-lg-2 bg-label p-2">
                                    Other Watershed
                                </div>
                                <div class="col-lg-10 p-2">
                                    <input type="text" class="form-control text-xs" name="txtOthersWs" placeholder="Please Specify:" onkeyup="this.value = this.value.toUpperCase();" value="
                                    <?= $rowprof['INFO_WATERSHED_OTHERS']; ?>">
                                </div>
                            </div>
                            <div class="form-row border border-top-0">
                                <div class="col-lg-2 bg-label p-2">
                                    Date From
                                </div>
                                <div class="col-lg-2 p-2">
                                    <select name="txtDateFrom" value="" placeholder="From" class="form-control txtDateFrom">
                                        <option value="<?= $rowprof['INFO_TF_FROM']; ?>"><?= $rowprof['INFO_TF_FROM']; ?></option>
                                        <option>------</option>
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
                                </div>
                                <div class="col-lg-2 bg-label p-2">
                                    Date To
                                </div>
                                <div class="col-lg-2 p-2">
                                    <select name="txtDateTo" placeholder="To" class="form-control txtDateTo">
                                        <option value="<?= $rowprof['INFO_TF_TO']; ?>" selected><?= $rowprof['INFO_TF_TO']; ?></option>
                                        <option>------</option>
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
                                </div>
                                <div class="col-lg-2 bg-label p-2">
                                    Status
                                </div>
                                <div class="col-lg-2 p-2">
                                    <select class="form-control txtStatus" name="txtStatus" placeholder="Status" id="PCADP">
                                        <option value="<?= $rowprof['INFO_STATUS']; ?>" selected><?= $rowprof['INFO_STATUS']; ?></option>
                                        <option>------------</option>
                                        <option value="EXISTING">EXISTING</option>
                                        <option value="LAPSED">LAPSED</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row border border-top-0">
                                <div class="col-lg-2 p-2 bg-label">
                                    Priority Commodities
                                </div>
                                <div class="col-lg-10 p-2">
                                    <?php
                                    $getcommo = $dbConn->query("SELECT * FROM ref_priority_commodities ORDER BY PC_DESC ASC");
                                    ?>
                                    <div class="form-row p-0">
                                        <?php while ($rowcommo = mysqli_fetch_assoc($getcommo)) { ?>
                                            <div class="col-lg-3 mb-2">
                                                <input type="checkbox" name="txtComm[]" value="<?= $rowcommo['PC_CODE']; ?>" 
                                                <?php if (strpos($rowprof['INFO_COMMODITIES'], $rowcommo['PC_CODE']) !== FALSE) {
                                                        echo 'checked';
                                                    } ?> class="mr-2 mb-1">
                                                <?= $rowcommo['PC_DESC']; ?>*
                                            </div>

                                        <?php } ?>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-2">
                                            <input type="checkbox" name="itemid" value="1" class="check item"> LIVESTOCK
                                        </div>

                                        <div class="col-sm-10">
                                            <div class="form-group cost-box">
                                                <div class="form-line">
                                                    <input type="text" id="txtPassportNumber" name="txtLivestock" class="form-control" value="<?= $rowprof['INFO_COMM_LIVESTOCK']; ?>" 
                                                    placeholder="Please Specify:" onkeyup="this.value = this.value.toUpperCase();">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-2">
                                            <input type="checkbox" name="itemid" value="2" class="check item"> POULTRY
                                        </div>
                                        <div class="col-sm-10">
                                            <div class="form-group cost-box">
                                                <div class="form-line">
                                                    <input type="text" name="txtPoultry" class="form-control" value="<?= $rowprof['INFO_COMM_POULTRY']; ?>" placeholder="Please Specify:" onkeyup="this.value = this.value.toUpperCase();" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <input type="checkbox" name="itemid" value="3" class="check item"> OTHERS
                                        </div>

                                        <div class="col-sm-10">
                                            <div class="form-group cost-box">
                                                <div class="form-line">
                                                    <input type="text" name="txtOthers" class="form-control" value="<?= $rowprof['INFO_COMM_OTHERS']; ?>" placeholder="Please Specify:" onkeyup="this.value = this.value.toUpperCase();" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row border border-top-0">
                                <div class="col-lg-2 p-2 bg-label">
                                    Remarks
                                </div>
                                <div class="col-lg-10 p-2">
                                    <input type="text" class="form-control txtRemarks" name="txtRemarks" onkeyup="this.value = this.value.toUpperCase();" value="<?= $rowprof['INFO_REMARKS']; ?>" required>
                                </div>
                            </div>

                            <!-- Part II. -->
                            <div class="form-row mt-3">
                                <div class="col-lg-12">
                                    <!-- Page Heading -->
                                    <h1 class="h5 mb-2 text-gray-800">Vision, Mission, etc.</h1>
                                </div>
                            </div>
                            <div class="form-row border border-top-0">
                                <div class="col-lg-2 p-2 bg-label">
                                    Vision
                                </div>
                                <div class="col-lg-10 p-2">
                                    <textarea type="text" class="form-control" name="txtVision" rows="3" placeholder="Vision" onkeyup="this.value = this.value.toUpperCase();" value="<?= $rowvmgob['INFO_VISION']; ?>"><?= $rowvmgob['INFO_VISION']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-row border border-top-0">
                                <div class="col-lg-2 p-2 bg-label">
                                    Mission
                                </div>
                                <div class="col-lg-10 p-2">
                                    <textarea type="text" class="form-control" name="txtMission" rows="3" placeholder="Mission" onkeyup="this.value = this.value.toUpperCase();" value="<?= $rowvmgob['INFO_MISSION']; ?>"><?= $rowvmgob['INFO_MISSION']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-row border border-top-0">
                                <div class="col-lg-2 p-2 bg-label">
                                    Goal
                                </div>
                                <div class="col-lg-10 p-2">
                                    <textarea type="text" class="form-control" name="txtGoal" rows="3" placeholder="Goals" onkeyup="this.value = this.value.toUpperCase();" value="<?= $rowvmgob['INFO_GOAL']; ?>"><?= $rowvmgob['INFO_GOAL']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-row border border-top-0">
                                <div class="col-lg-2 p-2 bg-label">
                                    Objective
                                </div>
                                <div class="col-lg-10 p-2">
                                    <textarea type="text" class="form-control" name="txtObj" rows="3" placeholder="Objectives" onkeyup="this.value = this.value.toUpperCase();" value="<?= $rowvmgob['INFO_OBJECTIVE']; ?>"><?= $rowvmgob['INFO_OBJECTIVE']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-row border border-top-0">
                                <div class="col-lg-2 p-2 bg-label">
                                    Brief Description
                                </div>
                                <div class="col-lg-10 p-2">
                                    <textarea type="text" class="form-control" name="txtBriefdesc" rows="3" placeholder="Brief Description" onkeyup="this.value = this.value.toUpperCase();" value="<?= $rowvmgob['INFO_BRIEF_DESC']; ?>"><?= $rowvmgob['INFO_BRIEF_DESC']; ?></textarea>
                                </div>
                            </div>

                        </div>
                    </div>

            
                    <?php if ($rowUserInfo["INFO_ACCESSLEVEL"] == 'ENCODER') { ?>
                        <button type="submit" name="btnresend" class="btn btn-sm btn-primary form-control form-control-sm text-xs col-lg-1 ml-1 mt-3">
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