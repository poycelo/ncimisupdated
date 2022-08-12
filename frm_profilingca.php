<?php include('head.html'); ?>
<?php include('session.php'); ?>

<body>
    <?php include('sidebar.php'); ?>
    <?php include('menu.php'); ?>
    <?php

    if (isset($_POST['saveProf'])) {
        $region             = $_POST['txtReg'];
        $prov               = $_POST['txtProvince'];
        $muni               = implode(',', $_POST['txtMunici']);

        $LCA_CODE           = $_POST['Name'];
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

        $profiling_sql = $dbConn->query('SELECT * FROM tbl_profilingca order by ID DESC LIMIT 1');
        $row_profiling = mysqli_fetch_array($profiling_sql);
        $month = date('m');
        $day = date('d');
        $year = date('Y');

        $get_profca = $row_profiling['ID'] + 1;
        $procaid = '10' . $month . $day . $year . rand(1,100);

        $dbConn->query('INSERT INTO tbl_profilingca
                                                        (SID, 
                                                        INFO_NAME, 
                                                        INFO_CON_TYPE, 
                                                        INFO_REGION, 
                                                        INFO_PROV, 
                                                        INFO_MUN, 
                                                        INFO_WATERSHED, 
                                                        INFO_WATERSHED_OTHERS, 
                                                        INFO_COMMODITIES, 
                                                        INFO_COMM_LIVESTOCK, 
                                                        INFO_COMM_POULTRY,
                                                        INFO_COMM_OTHERS, 
                                                        INFO_TF_FROM, 
                                                        INFO_TF_TO, 
                                                        INFO_STATUS, 
                                                        INFO_REMARKS,  
                                                        INFO_VISION, 
                                                        INFO_MISSION, 
                                                        INFO_GOAL, 
                                                        INFO_OBJECTIVE, 
                                                        INFO_BRIEF_DESC,
                                                        INFO_STAT_AF, 
                                                        INFO_USER, 
                                                        INFO_OFFICE, 
                                                        INFO_AGENCY, 
                                                        INFO_ACCESSLEVEL) 
                            VALUES ("'.$procaid.'", 
                                    "'.$conarea_name.'", 
                                    "'.$LCA_CODE.'", 
                                    "'.$region.'", 
                                    "'.$prov.'", 
                                    "'.$muni.'", 
                                    "'.$watershed.'", 
                                    "'.$wsothers.'",
                                    "'.$comm.'", 
                                    "'.$livestock.'", 
                                    "'.$poultry.'",
                                    "'.$others.'", 
                                    "'.$datefrom.'", 
                                    "'.$dateto.'" , 
                                    "'.$status.'",
                                    "'.$remarks.'",
                                    "'.$vision.'",
                                    "'.$mission.'",
                                    "'.$goals.'",
                                    "'.$objective.'",
                                    "'.$briefdesc.'",
                                    "'.$profstat.'",
                                    "'.$userid.'",
                                    "'.$office.'",
                                    "'.$agency.'", 
                                    "'.$accesslvl.'"
                                    )');

        $dbConn->query('INSERT INTO bckup_tbl_profilingca
                                                (SID, 
                                                INFO_NAME, 
                                                INFO_CON_TYPE, 
                                                INFO_REGION, 
                                                INFO_PROV, 
                                                INFO_MUN, 
                                                INFO_WATERSHED, 
                                                INFO_WATERSHED_OTHERS, 
                                                INFO_COMMODITIES, 
                                                INFO_COMM_LIVESTOCK, 
                                                INFO_COMM_POULTRY,
                                                INFO_COMM_OTHERS, 
                                                INFO_TF_FROM, 
                                                INFO_TF_TO, 
                                                INFO_STATUS, 
                                                INFO_REMARKS,  
                                                INFO_VISION, 
                                                INFO_MISSION, 
                                                INFO_GOAL, 
                                                INFO_OBJECTIVE, 
                                                INFO_BRIEF_DESC,
                                                INFO_STAT_AF, 
                                                INFO_USER, 
                                                INFO_OFFICE, 
                                                INFO_AGENCY, 
                                                INFO_ACCESSLEVEL) 
                                                VALUES ("'.$procaid.'", 
                                                        "'.$conarea_name.'", 
                                                        "'.$LCA_CODE.'", 
                                                        "'.$region.'", 
                                                        "'.$prov.'", 
                                                        "'.$muni.'", 
                                                        "'.$watershed.'", 
                                                        "'.$wsothers.'",
                                                        "'.$comm.'", 
                                                        "'.$livestock.'", 
                                                        "'.$poultry.'",
                                                        "'.$others.'", 
                                                        "'.$datefrom.'", 
                                                        "'.$dateto.'" , 
                                                        "'.$status.'",
                                                        "'.$remarks.'",
                                                        "'.$vision.'",
                                                        "'.$mission.'",
                                                        "'.$goals.'",
                                                        "'.$objective.'",
                                                        "'.$briefdesc.'",
                                                        "'.$profstat.'",
                                                        "'.$userid.'",
                                                        "'.$office.'",
                                                        "'.$agency.'", 
                                                        "'.$accesslvl.'"
                                                        )');

    //     $dbConn->query("INSERT INTO tbl_profilingca (SID, INFO_NAME, INFO_CON_TYPE, INFO_REGION, INFO_PROV, INFO_MUN, INFO_WATERSHED , INFO_WATERSHED_OTHERS, INFO_COMMODITIES, INFO_COMM_LIVESTOCK, INFO_COMM_POULTRY,INFO_COMM_OTHERS, INFO_TF_FROM, INFO_TF_TO, INFO_STATUS, INFO_REMARKS, INFO_STAT_AF, INFO_USER, INFO_OFFICE, INFO_AGENCY, INFO_ACCESSLEVEL) 
    // VALUES ('$procaid', '$conarea_name', '$LCA_CODE', '$region', '$prov', '$muni', '$watershed', '$wsothers','$comm', '$livestock' , '$poultry' ,'$others', '$datefrom', '$dateto' , '$status','$remarks','$profstat','$userid','$office','$agency', '$accesslvl')");

        // $dbConn->query("INSERT INTO tbl_vmgob (SID, INFO_VISION, INFO_MISSION, INFO_GOAL, INFO_OBJECTIVE, INFO_BRIEF_DESC, INFO_STAT_AF,INFO_USER, INFO_OFFICE, INFO_AGENCY, INFO_ACCESSLEVEL)
        //           VALUES ('$procaid','$vision','$mission','$goals','$objective','$briefdesc','$profstat','$userid','$office','$agency', '$accesslvl')");

        echo '<script language="javascript">alert("Profile save successfully!")</script>';
        echo "<script>window.location.href='vw_profilinginfo.php?SID=$procaid';</script>";
    }
    ?>

    <form method="post" name="myForm" onsubmit="return validateForm()">
        <div class="container-fluid px-3 py-0">
            <div class="col-lg-12 bg-white border p-3">
                <div class="form-row">
                    <div class="col-lg-12">
                        <!-- Page Heading -->
                        <h1 class="h4 mb-2 text-gray-800">Profiling Convergence Area</h1>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-lg-12">
                        <!-- Data Table -->

                        <div class="form-row mt-3 border">
                                <div class="col-lg-2 bg-label p-2" id="regdiv">
                                    Region
                                </div>
                                <div class="col-lg-10 p-2">
                                    <?php $getRegion = $dbConn->query("SELECT * FROM psgc_region "); ?>
                                    <select name="txtReg" id="reg" placeholder="Region" onChange="getProvince(this.value)" class="form-control text-xs" required>
                                        <option value="">SELECT REGION</option>
                                        <?php while ($rowRegion = mysqli_fetch_assoc($getRegion)) { ?>
                                            <option value="<?php echo $rowRegion['psgc_code']; ?>">
                                                <?php echo $rowRegion['name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                        </div>

                        <div style="font-size: 0.9rem;font-family:Calibri;">
                            <div class="form-row border">
                                <div class="col-lg-2 bg-label p-2">
                                    Type of Convergence Area
                                </div>
                                <div class="col-lg-2 p-2">
                                    <select class="form-control" id="type" name="Name" required>
                                        <option>Select Type</option>
                                        <option disabled>-------------</option>
                                        <option value="CADP">CADP</option>
                                        <option value="LCAEC">LCAEC</option>
                                        <option value="Proposed CADP">Proposed CADP</option>
                                    </select>
                                </div>
                            </div>
                         
                            <div class="form-row border border-top-0" id="provdiv">
                               <div class="col-lg-2 bg-label p-2 ">
                                Convergence Area
                                </div>
                                <div class="col-lg-10 p-2" id="cadpdiv">
                                    <select name="txtName"   class="form-control" placeholder="CADP" disabled required>
                                        <option value="">SELECT CONVERGENCE AREA </option>
                                    </select>
                                </div>
                                <div class="col-lg-2 bg-label p-2">
                                    Province
                                </div>
                                <div class="col-lg-10 p-2">
                                    <select name="txtProvince" class="form-control" placeholder="Province" disabled required>
                                        <option value="">SELECT PROVINCE</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 bg-label p-2 ">
                                    Municipality/City
                                </div>
                                <div class="col-lg-10 p-2" id="mundiv">
                                    <select name="txtMunici" class="form-control" placeholder="Municipality" disabled required>
                                        <option value="">SELECT MUNICIPALITY</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 bg-label p-2">
                                    Watershed
                                </div>
                                <div class="col-lg-10 p-2">
                                    <select name="txtWatershed" class="form-control" placeholder="Watershed" disabled required>
                                        <option value="">SELECT WATERSHED</option>
                                    </select>
                                    <br />







                                    <!-- <input type="text" id="txtChkWs" name="txtOthersWs" class="col-lg-30"  placeholder="Please Specify:" onkeyup="this.value = this.value.toUpperCase();" disabled="disabled" /> -->


                                </div>


                            </div>
                            
                            <div class="form-row border border-top-0">
                                <div class="col-lg-2 bg-label p-2">
                                    Other Watershed
                                </div>
                                <div class="col-lg-10 p-2">
                                    <input type="text" class="form-control text-xs" name="txtOthersWs" placeholder="Please Specify:" onkeyup="this.value = this.value.toUpperCase();" >
                                </div>
                            </div>

                            <div class="form-row border border-top-0">
                                <div class="col-lg-2 bg-label p-2">
                                    Date From
                                </div>
                                <div class="col-lg-2 p-2">
                                    <select name="txtDateFrom" placeholder="From" class="form-control" required>
                                        <option value="" selected disabled>SELECT YEAR</option>
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
                                    <select name="txtDateTo" placeholder="To" class="form-control" required>
                                        <option value="" selected disabled>SELECT YEAR</option>
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
                                    Status of CADP
                                </div>
                                <div class="col-lg-2 p-2">
                                    <select class="form-control" name="txtStatus" placeholder="Status" id="PCADP" required>
                                        <option value="" selected>SELECT STATUS</option>
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
                                    <div class="form-row">

                                        <?php

                                        $commodities = $dbConn->query("SELECT * FROM ref_priority_commodities");
                                        $cntComm = mysqli_num_rows($commodities);
                                        $i = 0;
                                        $dataCount     = $cntComm; //mysqli_num_rows
                                        $columnCount   = 4; //default (col-lg-3) per column
                                        $fieldCount    = round($dataCount / $columnCount);
                                        $rowCount = 0;
                                        //echo $dataCount .','. $fieldCount;
                                        ?>
                                        <div class="form-row p-2">

                                            <?php
                                            while ($row_resultComm = mysqli_fetch_assoc($commodities)) {

                                                if ($i == 0) {
                                                    echo "<div class='col-lg-3'>";
                                                }

                                                echo "<div class='form-row'><input type='checkbox' class='mr-2'  name='txtComm[]' value='" . $row_resultComm["PC_CODE"] . "'>" . $row_resultComm['PC_DESC'] . "</div>";

                                                $i = $i + 1;
                                                $rowCount = $rowCount + 1;

                                                if ($i == $fieldCount) {
                                                    echo "</div>";
                                                    $i = 0;
                                                }
                                            }
                                            ?>


                                          <div class="row">
                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="itemid" value="3" class="check item">
                                                </div>
                                                Please specify:
                                                <div class="col-sm-10">
                                                    <div class="form-group cost-box">
                                                        <div class="form-line">
                                                            <input type="text" name="txtOthers" class="form-control" placeholder="" onkeyup="this.value = this.value.toUpperCase();" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="row">
                                                <div class="col-sm-2">

                                                    <input type="checkbox" name="itemid" value="1" class="check item">
                                                </div>
                                                LIVESTOCK
                                                <div class="col-sm-10">
                                                    <div class="form-group cost-box">
                                                        <div class="form-line">
                                                            <input type="text" name="txtLivestock" class="form-control" placeholder="Please Specify:" onkeyup="this.value = this.value.toUpperCase();" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <input type="checkbox" name="itemid" value="2" class="check item">
                                                </div>
                                                POULTRY
                                                <div class="col-sm-10">
                                                    <div class="form-group cost-box">
                                                        <div class="form-line">
                                                            <input type="text" name="txtPoultry" class="form-control" placeholder="Please Specify:" onkeyup="this.value = this.value.toUpperCase();" />
                                                        </div>
                                                    </div>
                                                </div>
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
                                <textarea type="text" class="form-control text-xs" rows="2" name="txtRemarks" placeholder="Remarks" onkeyup="this.value = this.value.toUpperCase();" required></textarea>
                            </div>
                        </div>
                    </div>


                    <!-- VMGOB -->
                    <div class="form-row mt-5">
                        <div class="col-lg-12">
                            <!-- Page Heading -->
                            <h1 class="h5 mb-2 text-gray-800">Vision, Mission, etc.</h1>
                        </div>
                    </div>
                    <div class="border-top" style="font-size: 0.9rem;">
                        <div class="form-row border border-top-0 ">
                            <div class="col-lg-2 p-2 bg-label">
                                Vision
                            </div>
                            <div class="col-lg-10 p-2">
                                <textarea type="text" class="form-control text-xs" name="txtVision" rows="3" placeholder="Vision" onkeyup="this.value = this.value.toUpperCase();" required></textarea>
                            </div>
                        </div>
                        <div class="form-row border border-top-0">
                            <div class="col-lg-2 p-2 bg-label">
                                Mission
                            </div>
                            <div class="col-lg-10 p-2">
                                <textarea type="text" class="form-control text-xs" name="txtMission" rows="3" placeholder="Mission" onkeyup="this.value = this.value.toUpperCase();" required></textarea>
                            </div>
                        </div>
                        <div class="form-row border border-top-0">
                            <div class="col-lg-2 p-2 bg-label">
                                Goal
                            </div>
                            <div class="col-lg-10 p-2">
                                <textarea type="text" class="form-control text-xs" name="txtGoal" rows="3" placeholder="Goals" onkeyup="this.value = this.value.toUpperCase();" required></textarea>
                            </div>
                        </div>
                        <div class="form-row border border-top-0">
                            <div class="col-lg-2 p-2 bg-label">
                                Objective
                            </div>
                            <div class="col-lg-10 p-2">
                                <textarea type="text" class="form-control text-xs" name="txtObj" rows="3" placeholder="Objectives" onkeyup="this.value = this.value.toUpperCase();" required></textarea>
                            </div>
                        </div>
                        <div class="form-row border border-top-0">
                            <div class="col-lg-2 p-2 bg-label">
                                Brief Description
                            </div>
                            <div class="col-lg-10 p-2">
                                <textarea type="text" class="form-control text-xs" name="txtBriefdesc" rows="3" placeholder="Brief Description" onkeyup="this.value = this.value.toUpperCase();" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>


        <button type="submit" name="saveProf" class="btn btn-sm btn-success mt-2 ml-3">
            <i class="fas fa-save fa-xs"></i>
            Save
        </button>
    </form>

    <?php include('footer.html'); ?>
</body>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
    var disable_options = false;
    document.getElementById('type').onchange = function() {
        if (this.value == "Proposed CADP") {
            document.getElementById('PCADP').setAttribute('disabled', true);
        }
    }

    $(".cost-box").hide();
    $(".item").click(function() {
        if ($(this).is(":checked")) {
            $(this).parent().siblings().find(".cost-box").show();
        } else {
            $(this).parent().siblings().find(".cost-box").hide();
        }
    });

    // $(function() {
    //     $("#chkWs").click(function() {
    //         if ($(this).is(":checked")) {
    //             $("#txtChkWs").removeAttr("disabled");
    //             $("#txtChkWs").focus();
    //         } else {
    //             $("#txtChkWs").attr("disabled", "disabled");
    //         }
    //     });
    // });

    $(function() {
        $("#chkPassport").click(function() {
            if ($(this).is(":checked")) {
                $("#txtPassportNumber").removeAttr("disabled");
                $("#txtPassportNumber").focus();
            } else {
                $("#txtPassportNumber").attr("disabled", "disabled");
            }
        });
    });


    $(function() {
        $("#chkPoultry").click(function() {
            if ($(this).is(":checked")) {
                $("#txtChkPoultry").removeAttr("disabled");
                $("#txtChkPoultry").focus();
            } else {
                $("#txtChkPoultry").attr("disabled", "disabled");
            }
        });
    });

    $(function() {
        $("#chkOthers").click(function() {
            if ($(this).is(":checked")) {
                $("#txtChkOthers").removeAttr("disabled");
                $("#txtChkOthers").focus();
            } else {
                $("#txtChkOthers").attr("disabled", "disabled");
            }
        });
    });
    //   function validateForm() {
    //   var x = document.forms["myForm"]["fname"].value;
    //   if (x == "" || x == null) {
    //     alert("Name must be filled out");
    //     return false;
    //   }
    // }

    $('form').each(function() {
        $(this).submit(function(e) {
            if ($('input[name="txtMunici[]"]:checked').length) {
                console.log("at least one checked");
                return true;
            } else {
                e.preventDefault();
                alert('Please select atleast one Municipality');
                return false;
            }
        })
    })

    $('form').each(function() {
        $(this).submit(function(e) {
            if ($('input[name="txtComm[]"]:checked').length) {
                console.log("at least one checked");
                return true;
            } else {
                e.preventDefault();
                alert('Please select atleast one Commodity');
                return false;
            }
        })
    })

    $('form').each(function() {
        $(this).submit(function(e) {
            if ($('input[name="txtWatershed[]"]:checked').length) {
                console.log("at least one checked");
                return true;
            } else {
                e.preventDefault();
                alert('Please select atleast one Watershed');
                return false;
            }
        })
    })
</script>