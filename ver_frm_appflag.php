
<?php include('head.html'); ?>
<?php include('session.php'); ?>
<body>
<?php include('sidebar.php');?>
<?php include('menu.php');?>

<?php
$SID   = $_REQUEST['SID'];
$query = $dbConn->query("SELECT * FROM tbl_profilingca WHERE SID = '$SID' AND INFO_STAT_AF = 'For Review'");
$row   = mysqli_fetch_assoc($query);

// Convert PSGC code to Location Names
$geocode = $row['INFO_REGION'];
$getLocation = $dbConn->query("SELECT * FROM psgc_region WHERE psgc_code LIKE '$geocode%'");
$rowLocation = mysqli_fetch_assoc($getLocation);                  

//PROVINCE
$provCode = $row['INFO_PROV'];
$getProv = $dbConn->query("SELECT * FROM psgc_provinces WHERE Code LIKE '$provCode%'");
$rowProv = mysqli_fetch_assoc($getProv);   


// //OTHER
$officesother = $dbConn->query("SELECT * FROM ref_offices2 WHERE CODE_MAIN = '5'");
while($row_resultOffother = $officesother->fetch_assoc()) { 
   $ref_off_infoother[] = $row_resultOffother['INFO_OFFICE'] . '.'. $row_resultOffother['CODE_MAIN'];
}
//END OTHER

//Approved
if(isset($_POST['actionApprove'])){
    $dbConn->query("UPDATE tbl_profilingca SET INFO_STAT_AF='For Approval', INFO_STAT_AF_VERIFIER ='$userid' WHERE SID = '$SID'");
    $dbConn->query("UPDATE tbl_vmgob SET INFO_STAT_AF='For Approval', INFO_STAT_AF_VERIFIER ='$userid' WHERE SID = '$SID'");
    $dbConn->query("UPDATE tbl_interventions SET INFO_STAT_AF='For Approval', INFO_STAT_AF_VERIFIER ='$userid' WHERE SID = '$SID'");

    echo "<script type='text/javascript'>alert('For approval of the National Secretariat.')</script>";
    echo "<script>window.location.href='vw_approval.php?SID=$SID';</script>";
}
//End Approved

//Flagged

if(isset($_POST['actionFlag'])){
    $remarks = $_POST['remarks'];
    $dbConn->query("UPDATE tbl_profilingca SET INFO_STAT_AF='Flagged',INFO_STAT_REMARKS='$remarks', INFO_STAT_AF_VERIFIER ='$userid' WHERE SID = '$SID'");
    $dbConn->query("UPDATE tbl_vmgob SET INFO_STAT_AF='Flagged',INFO_STAT_REMARKS='$remarks', INFO_STAT_AF_VERIFIER ='$userid' WHERE SID = '$SID'");
    $dbConn->query("UPDATE tbl_interventions SET INFO_STAT_AF='Flagged',INFO_STAT_REMARKS='$remarks', INFO_STAT_AF_VERIFIER ='$userid' WHERE SID = '$SID'");

    echo "<script type='text/javascript'>alert('Flagged Profile Successfully!')</script>";
    echo "<script>window.location.href='vw_flagged.php?SID=$SID';</script>";
}
//End Flagged

// Convert PSGC code to Location Names
  $geocode = $row['INFO_REGION'];
  $getLocation = $dbConn->query("SELECT * FROM psgc_region WHERE psgc_code LIKE '$geocode%'");
  $rowLocation = mysqli_fetch_assoc($getLocation);                  

//   PROVINCE
  $provCode = $row['INFO_PROV'];
  $getProv = $dbConn->query("SELECT * FROM psgc_provinces WHERE Code LIKE '$provCode%'");
  $rowProv = mysqli_fetch_assoc($getProv);   

?>
<div class="container-fluid px-3 py-0 custom-font">
   <div class="col-lg-12 bg-white border p-3">
      <div class="form-row">
         <div class="col-lg-10">
            <!-- Page Heading -->
            <h1 class="h5 mb-2 text-gray-800">Convergence Area Profile</h1>
         </div>
         <div class="col-lg-12 text-right">
                <a class="btn btn-sm btn-secondary" href="tbl_profca.php">
                <i class="fas fa-arrow-left fa-xs mr-2"></i>
                Back
                </a>  
              <?php if($rowUserInfo["INFO_ACCESSLEVEL"] == 'ENCODER'){ ?>
               <a class="btn btn-sm btn-success" href="frm_edit_all.php?SID=<?php echo $row['SID']; ?>">
                  <i class="fas fa-pen fa-xs mr-2"></i>
                  Update
               </a>

            <?php }?>
            <a data-toggle="modal" data-id="<?php echo $SID; ?>"  class="open-AddBookDialog" title="Verifier reviewed the profile?" href="#approved">
            <button type="button" class="btn btn-success btn-sm">Review</button></a>
            <a data-toggle="modal" data-id="<?php echo $SID; ?>"  class="open-AddBookDialog" title="Flag this Profile" href="#flagged">
            <button type="button" class="btn btn-danger btn-sm">Flag</button></a>
         </div> 
      </div>
      <!-- Start of Data -->
      <div style="font-size: 0.8rem;">
         <div class="form-row mt-3 border">
            <div class="col-lg-2 bg-label p-2">
               Name
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
               foreach($ws_name as $name_ws) {
                   //echo $municipality = trim($municipality) . '<br/>';
                   $getws = $dbConn->query("SELECT * FROM ref_watershed WHERE `WS_CODE`=$name_ws");
                   $rowws = mysqli_fetch_assoc($getws);
                   $wsn .= $rowws['NAME_WATERSHED'] . ' ,';
              
            }     echo $rowws['NAME_WATERSHED'] .','.$row['INFO_WATERSHED_OTHERS'];?>
            </div>
         </div>
         <div class="form-row border border-top-0">
            <div class="col-lg-2 bg-label p-2">
               Region
            </div>
            <div class="col-lg-2 p-2">
               <?php  echo $rowLocation['name']; ?>
            </div>
            <div class="col-lg-2 bg-label p-2">
               Province
            </div>
            <div class="col-lg-2 p-2">
               <?php  echo $rowProv['Province']; ?>
            </div>
            <div class="col-lg-2 bg-label p-2">
               Municipality
            </div>
            <div class="col-lg-2 p-2">
               <?php // echo $row['INFO_MUN']; ?>
               <?php 
               $municipalities = '';
               $municipalities = explode(",", $row['INFO_MUN']);
               $munn = '';
               foreach($municipalities as $municipality) {
                   //echo $municipality = trim($municipality) . '<br/>';
                   $getMunicipality = $dbConn->query("SELECT * FROM psgc_municipalities WHERE `Code`=$municipality");
                   $rowMunicipality = mysqli_fetch_assoc($getMunicipality);
                   $munn .= $rowMunicipality['Municipality'] . ' ,';
               
               }    echo rtrim($munn,',');?>
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
               <?php if($row['INFO_CON_TYPE']== 'Proposed CADP'){ echo 'N/A'; }else{ echo $row['INFO_STATUS'];}?>
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
               foreach($commodities as $commo) {
                   $getComm = $dbConn->query("SELECT * FROM ref_priority_commodities WHERE PC_CODE=$commo");
                   $rowComm = mysqli_fetch_assoc($getComm);
                   echo $rowComm['PC_DESC'] .',';
                    } echo $row['INFO_COMM_LIVESTOCK'].','.$row['INFO_COMM_POULTRY'].','.$row['INFO_COMM_OTHERS'];?>
            </div>
         </div>
         <div class="form-row border border-top-0">
            <div class="col-lg-2 p-2 bg-label">
               Remarks
            </div>
            <div class="col-lg-10 p-2">
               <?=$row['INFO_REMARKS'];?>
            </div>
         </div>
         <!-- Part II. -->

         <?php
       
         $getVmgob = $dbConn->query("SELECT * FROM tbl_vmgob WHERE SID = '$SID'");
         $rowVmgob = mysqli_fetch_assoc($getVmgob);
         ?>
         <div class="form-row mt-3">
            <div class="col-lg-12">
               <!-- Page Heading -->
               <h1 class="h5 mb-2 text-gray-800">Vision, Mission, etc.</h1>
            </div>
         </div>
         <div class="form-row border">
            <div class="col-lg-2 p-2 bg-label">
               Vision
            </div>
            <div class="col-lg-10 p-2">
               <?=$rowVmgob['INFO_VISION'];?>
            </div>
         </div>
         <div class="form-row border border-top-0">
            <div class="col-lg-2 p-2 bg-label">
               Mission
            </div>
            <div class="col-lg-10 p-2">
               <?=$rowVmgob['INFO_MISSION'];?>
            </div>
         </div>
         <div class="form-row border border-top-0">
            <div class="col-lg-2 p-2 bg-label">
               Goal
            </div>
            <div class="col-lg-10 p-2">
               <?=nl2br($rowVmgob['INFO_GOAL']);?>
            </div>
         </div>
         <div class="form-row border border-top-0">
            <div class="col-lg-2 p-2 bg-label">
               Objective
            </div>
            <div class="col-lg-10 p-2">
               <?=nl2br($rowVmgob['INFO_OBJECTIVE']);?>
            </div>
         </div>
         <div class="form-row border border-top-0">
            <div class="col-lg-2 p-2 bg-label">
               Brief Description
            </div>
            <div class="col-lg-10 p-2">
               <?=$rowVmgob['INFO_BRIEF_DESC'];?>
            </div>
         </div>      
                <!-- INTERVENTIONS -->
                <!-- <div class="form-row mt-3">
                    <div class="col-lg-12"> -->
                    <!-- Page Heading -->
                    <!-- <h1 class="h5 mb-2 text-gray-800">Programs, Activities and Projects with Corresponding Targets</h1>
                    </div>
                </div> -->
            
                    <!-- Interventions: Department of Agriculture (DA) -->
                    
                    <!-- <div class="form-row mt-3" style="font-size: 0.7rem;">
                        <div class="col-lg-12">
                        <h5 class="custom-font">Department of Agriculture</h5>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-lg-12">
                            <table id="DA" class="table table-bordered table-striped custom-font" width="100%" cellspacing="0">
                                <thead class="custom-ffedis text-white bg-accent text-xs">
                                    <tr>
                                        <th class="d-sm-table-cell">Program/Project Classification</th>
                                        <th class="d-sm-table-cell">Intervention</th>
                                        <th class="d-sm-table-cell">Committed Quantity</th>
                                        <th class="d-sm-table-cell">Unit</th>
                                        <th class="d-sm-table-cell">Year</th>   
                                        <th class="d-sm-table-cell">Financial Target ('000)</th>
                                    </tr>
                                </thead>
                                <?php 
                                    //$queryDA = $dbConn->query("SELECT * FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%AGRICULTURE%' ORDER BY INFO_DATETIME ASC");
                                   // while($rowDA = mysqli_fetch_assoc($queryDA)){
                                ?>

                                <tbody>
                                    <tr>
                                       <td><?php// echo $rowDA['INFO_PARTICULARS'];?></td>
                                       <td><?php //echo $rowDA['INFO_INTERVENTION'];?> </td>
                                       <td><?php //echo $rowDA['INFO_COMM_QUANTITY'];?></td>
                                       <td><?php //echo $rowDA['INFO_UNIT'];?> </td> 
                                       <td><?php //echo $rowDA['INFO_YEAR'];?></td>
                                       <td><?php //echo $rowDA['INFO_COMM_BUDGET'];?></td>
                                    </tr>
            </tbody>
                                    <?php //}?>
        </table> -->
        </div>
                    </div>
           <!-- END DA -->


     <?php 
       //include('tbl_fl_DAR.php');
      // include('tbl_fl_DENR.php');
      // include('tbl_fl_DILG.php');
      // include('tbl_fl_OTHER.php');
     ?>

         	</div>
        </div>



<!-- MODAL APPROVED -->
<div class="modal fade" id="approved" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-l" role="document">
    <div class="modal-content">
      <!-- MODAL HEADER - START -->
      <div class="modal-header"><h4 class="modal-title info-name">Already Reviewed this Profiling?</h4></div>           
      <!-- MODAL HEADER - END -->
      <!-- MODAL BODY - START -->
        <div class="modal-body modal-bg">
            <div class="row justify-content-center">        
                <div class="col-sm-12 form-group">
                      <form method="post">
                        <input type="hidden" id="SID" name="SID" value="<?php echo $SID;?>">
                        <input type="hidden" id="VERIFIER" name="VERIFIER" value="<?php echo $rowUserInfo['USERID'];?>">
                </div>
            </div>
        </div> 
        <!-- MODAL BODY - END -->
        <!-- MODAL FOOTER - START -->
        <div class="modal-footer">
          <div class="form-group">
                        <button type="submit" id="actionApprove" name="actionApprove" class="btn btn-success"><span class="fas fa-save mr-2"  ></span>Reviewed</button>
                        <button type="submit" class="btn btn-secondary" data-dismiss="modal"><span class="fas fa-close mr-2"></span>Close</button>
                      </form>
          </div>
        </div> <!-- end of modal-footer       -->
    </div>     <!-- end of modal-content      -->
  </div>       <!-- end of modal-dialog       -->
</div>         <!-- end of modal-suspended    -->
<!-- MODAL APPROVED -->

<!-- MODAL FLAGGED -->
<div class="modal fade" id="flagged" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-l" role="document">
    <div class="modal-content">
      <!-- MODAL HEADER - START -->
      <div class="modal-header"><h4 class="modal-title info-name">Flag this Profile?</h4></div>           
      <!-- MODAL HEADER - END -->
      <!-- MODAL BODY - START -->
        <div class="modal-body modal-bg">
            <div class="row justify-content-center">        
                <div class="col-sm-12 form-group">
                    <label class="font-weight-bold">Add Remarks:</label>
                    <form method="post">
                        <input type="text" id="remarks" name="remarks" class="form-control" required>
                        <input type="hidden" id="SID" name="SID" value="<?php echo $SID;?>">
                        <input type="hidden" id="VERIFIER" name="VERIFIER" value="<?php echo $rowUserInfo['USERID'];?>">
                </div>
            </div>
        </div> 
        <!-- MODAL BODY - END -->
        <!-- MODAL FOOTER - START -->
        <div class="modal-footer">
          <div class="form-group">
                      <button type="submit" id="actionFlag" name="actionFlag" class="btn btn-danger"><span class="fas fa-save mr-2"></span>Flag</button>
                      <button type="submit" class="btn btn-secondary" data-dismiss="modal"><span class="fas fa-close mr-2"></span>Close</button>
                    </form>
          </div>
        </div> <!-- end of modal-footer       -->
    </div>     <!-- end of modal-content      -->
  </div>       <!-- end of modal-dialog       -->
</div>         <!-- end of modal-suspended    -->
<!-- MODAL FLAGGED -->

<?php include('footer.html'); ?>
</body>
            
               
