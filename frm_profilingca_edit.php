<?php include('head.html'); ?>
<?php include('session.php'); ?>

<body>
   <?php include('sidebar.php'); ?>
   <?php include('menu.php'); ?>
   <?php include('functions.php'); ?>

   <?php

   $SID = $_REQUEST['SID'];
   $query_profca = $dbConn->query("SELECT * FROM tbl_profilingca WHERE SID ='$SID'");
   $row_profca   = mysqli_fetch_assoc($query_profca);

   // UPDATE / EDIT
   if (isset($_POST['editProf'])) {
      $SID            = $_POST['SID'];
      $wsothers           = $_POST['txtOthersWs'];
      $livestock            = $_POST['txtLivestock'];
      $poultry             = $_POST['txtPoultry'];
      $others             = $_POST['txtOthers'];

      $dbConn->query('UPDATE tbl_profilingca SET INFO_COMM_LIVESTOCK      = "' . $livestock . '",
                                               INFO_COMM_POULTRY      = "' . $poultry . '",
                                               INFO_COMM_OTHER   = "' . $others . '",
                                               INFO_WATERSHED_OTHERS   = "' . $wsothers . '"
                                    WHERE SID="' . $SID . '" ');
   }
   ?>

   <form method="POST">
      <div class="container-fluid px-3 py-0">
         <div class="col-lg-12 bg-white border p-3">
            <div class="form-row">
               <div class="col-lg-12">
                  <!-- Page Heading -->
                  <h1 class="h3 mb-2 text-gray-800">Edit Profiling</h1>
               </div>
               <!--   <div class="col-lg-2 text-right">
            <a class="btn btn-sm btn-secondary" href="frm_profilingcainfo.php?SID=<?php //echo $rowprof['SID']; 
                                                                                    ?>">
               <i class="fas fa-arrow-left fa-xs mr-2"></i>
               Back
            </a>
          </div> -->
            </div>

            <div class="form-row">
               <div class="col-lg-12">
                  <!-- Start of Data -->
                  <div style="font-size: 0.7rem;">

                     <div class="form-row mt-3 border">
                        <div class="col-lg-2 bg-label p-2" id="regdiv">
                           Region
                        </div>
                        <div class="col-lg-10">
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

                     <div class="form-row border border-top-0">
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

                     <div class="form-row border border-top-0" id="provdiv">
                        <div class="col-lg-2 bg-label p-2 ">
                          Convergence Area
                        </div>
                        <div class="col-lg-10 p-2" id="cadpdiv">
                           <select name="txtName"   class="form-control" placeholder="CADP" readonly>
                                 <option value="<?php echo $rowprof['INFO_NAME']; ?>" selected><?php echo $rowprof['INFO_NAME']; ?></option>
                           </select>
                        </div>
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
                           $codeProvince   = $rowprof['INFO_PROV'];
                           $prov = substr($codeProvince, 0, 4);
                           $getMunicipality = $dbConn->query("SELECT * FROM psgc_municipalities WHERE Code LIKE '$prov%' ORDER BY Municipality ASC");
                           ?>
                           <div class="form-row p-0">
                              <?php while ($rowMunicipality = mysqli_fetch_assoc($getMunicipality)) { ?>
                                 <div class="col-lg-3 mb-2">
                                    <input type="checkbox" name="txtMunici[]" value="<?= $rowMunicipality['Code']; ?>" <?php if (stripos($rowprof['INFO_MUN'], $rowMunicipality['Code']) !== FALSE) {
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
                           $codeReg   = $rowprof['INFO_REGION'];
                           $WScode = substr($codeReg, 0, 2);      
                           $getWater = $dbConn->query("SELECT * FROM ref_watershed WHERE WS_CODE LIKE '$WScode%' ORDER BY NAME_WATERSHED ASC");
                           ?>
                           <div class="form-row p-0">
                              <?php while ($rowWater = mysqli_fetch_assoc($getWater)) { ?>
                                 <div class="col-lg-3 mb-2">
                                    <input type="checkbox" name="txtWatershed[]" value="<?= $rowWater['WS_CODE']; ?>" <?php if (stripos($rowprof['INFO_WATERSHED'], $rowWater['WS_CODE']) !== FALSE) {
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
                                    <input type="text" class="form-control text-xs" name="txtOthersWs" placeholder="Please Specify:" onkeyup="this.value = this.value.toUpperCase();" value="<?= $rowprof['INFO_WATERSHED_OTHERS']; ?>">
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
                                    <input type="checkbox" name="txtComm[]" value="<?= $rowcommo['PC_CODE']; ?>" <?php if (strpos($rowprof['INFO_COMMODITIES'], $rowcommo['PC_CODE']) !== FALSE) {
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
                                  
                              <input type="text" id="txtPassportNumber" name="txtLivestock"   class="form-control" value="<?= $rowprof['INFO_COMM_LIVESTOCK']; ?>" placeholder="Please Specify:" onkeyup="this.value = this.value.toUpperCase();" />
                        <?php
                              
                           
                        ?>
                                      
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
                                       <textarea type="text" class="form-control" name="txtVision" rows="3" placeholder="Vision" onkeyup="this.value = this.value.toUpperCase();" value="<?= $rowprof['INFO_VISION']; ?>"><?= $rowprof['INFO_VISION']; ?></textarea>
                                    </div>
                                 </div>
                                 <div class="form-row border border-top-0">
                                    <div class="col-lg-2 p-2 bg-label">
                                       Mission
                                    </div>
                                    <div class="col-lg-10 p-2">
                                       <textarea type="text" class="form-control" name="txtMission" rows="3" placeholder="Mission" onkeyup="this.value = this.value.toUpperCase();" value="<?= $rowprof['INFO_MISSION']; ?>"><?= $rowprof['INFO_MISSION']; ?></textarea>
                                    </div>
                                 </div>
                                 <div class="form-row border border-top-0">
                                    <div class="col-lg-2 p-2 bg-label">
                                       Goal
                                    </div>
                                    <div class="col-lg-10 p-2">
                                       <textarea type="text" class="form-control" name="txtGoal" rows="3" placeholder="Goals" onkeyup="this.value = this.value.toUpperCase();" value="<?= $rowprof['INFO_GOAL']; ?>"><?= $rowprof['INFO_GOAL']; ?></textarea>
                                    </div>
                                 </div>
                                 <div class="form-row border border-top-0">
                                    <div class="col-lg-2 p-2 bg-label">
                                       Objective
                                    </div>
                                    <div class="col-lg-10 p-2">
                                       <textarea type="text" class="form-control" name="txtObj" rows="3" placeholder="Objectives" onkeyup="this.value = this.value.toUpperCase();" value="<?= $rowprof['INFO_OBJECTIVE']; ?>"><?= $rowprof['INFO_OBJECTIVE']; ?></textarea>
                                    </div>
                                 </div>
                                 <div class="form-row border border-top-0">
                                    <div class="col-lg-2 p-2 bg-label">
                                       Brief Description
                                    </div>
                                    <div class="col-lg-10 p-2">
                                       <textarea type="text" class="form-control" name="txtBriefdesc" rows="3" placeholder="Brief Description" onkeyup="this.value = this.value.toUpperCase();" value="<?= $rowprof['INFO_BRIEF_DESC']; ?>"><?= $rowprof['INFO_BRIEF_DESC']; ?></textarea>
                                    </div>
                                 </div>

                                 <div class="form-row mt-3">
                                    <div class="col-lg-12">
                                       <input type="submit" name="editprof" value="Save" class="btn btn-success" />
                                    </div>
                                 </div>

                              </div>
                           </div>

   </form>


   <?php include('footer.html'); ?></body>



<script>
   function add_file() {
      $('#file_div').append("<div class='form-row'><select class='form-control mt-2 col-sm-9 float-left mySelect' style='float:left;' name='comm[]' required><option value='' selected disabled>SELECT COMMODITIES</option><?php foreach ($ref_comm_info as $comm_info) { ?><option value='<?php echo $comm_info; ?>'><?php echo $comm_info; ?></option><?php } ?></select><input class='ml-2 myText' type='text' value='<?= $rowPC['info_other']; ?>' name='other[]' onkeyup='this.value = this.value.toUpperCase();' readonly='true'><input type='button' class='btn btn-outline-danger col-sm-1 text-xs float-left ml-3 mt-2' value='REMOVE' onclick=remove_file(this);></div>");
   }

   function remove_file(ele) {
      $(ele).parent().remove();
   }


   //type select
   var disable_options = false;
   document.getElementById('type').onchange = function() {
      if (this.value == "Proposed CADP") {
         document.getElementById('PCADP').setAttribute('readonly', true);
      } {
         document.getElementById('PCADP').setAttribute('readonly', false);
      }
   }

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
</script>