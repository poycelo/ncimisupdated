<?php include('head.html'); ?>
<?php include('config/session.php'); ?>
<body>
<?php include('sidebar.php');?>

<?php include('menu.php');?>

<?php
error_reporting(0);
// print_r("hello");
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

   $query_comm = $dbConn->query("SELECT * FROM tbl_priority_commodities WHERE sid ='$SID'");

// APPROVED
if(isset($_POST['approved'])){

//$SID = $rowresult['SID'];
$SID = $_POST['SID'];

$stat = 'APPROVED';
$remarks_stat = "'" .''. "'";    

$dbConn->query("UPDATE tbl_profilingca SET INFO_STAT_AF = '$stat', INFO_STAT_REMARKS = '' WHERE SID = '$SID'");
$dbConn->query("UPDATE tbl_interventions SET INFO_STAT_AF = '$stat', INFO_STAT_REMARKS = ' ' WHERE SID = '$SID'");
$dbConn->query("UPDATE tbl_vmgob SET INFO_STAT_AF = '$stat', INFO_STAT_REMARKS = ' ' WHERE SID = '$SID'");
$dbConn->query("UPDATE tbl_priority_commodities SET INFO_STAT_AF = '$stat', INFO_STAT_REMARKS = ' ' WHERE SID = '$SID'");
echo "<script>window.location.href='vw_profiling_approved.php?SID=$SID';</script>";
}
//END APPROVED

//FLAGGED 
if(isset($_POST['flagged']))
{ $SID = $_POST['SID'];
$stat = 'FLAGGED';
$remarks_flag = $_POST['txtremarks'];  

$dbConn->query("UPDATE tbl_profilingca SET INFO_STAT_AF = '$stat', INFO_STAT_REMARKS = '$remarks_flag' WHERE SID = '$SID'");
$dbConn->query("UPDATE tbl_interventions SET INFO_STAT_AF = '$stat', INFO_STAT_REMARKS = '$remarks_flag' WHERE SID = '$SID'");
$dbConn->query("UPDATE tbl_vmgob SET INFO_STAT_AF = '$stat', INFO_STAT_REMARKS = '$remarks_flag' WHERE SID = '$SID'");
$dbConn->query("UPDATE tbl_priority_commodities SET INFO_STAT_AF = '$stat', INFO_STAT_REMARKS = '$remarks_flag' WHERE SID = '$SID'");
echo "<script>window.location.href='vw_profiling_flagged.php?SID=$SID';</script>";
}
//END FLAGGED
$query_unit = $dbConn->query("SELECT * FROM ref_unit");

// $offices = $dbConn->query("SELECT * FROM ref_offices2 WHERE CODE_MAIN = '1'");
// while($row_resultOff = $offices->fetch_assoc()) { 
//    $ref_off_info[] = $row_resultOff['INFO_OFFICE'] . '.'. $row_resultOff['CODE_MAIN'];
// }

// //DAR
// $officesdar = $dbConn->query("SELECT * FROM ref_offices2 WHERE CODE_MAIN = '2'");
// while($row_resultOffdar = $officesdar->fetch_assoc()) { 
//    $ref_off_infodar[] = $row_resultOffdar['INFO_OFFICE'] . '.'. $row_resultOffdar['CODE_MAIN'];
// }
// //END DAR

// //DENR
// $officesdenr = $dbConn->query("SELECT * FROM ref_offices2 WHERE CODE_MAIN = '3'");
// while($row_resultOffdenr = $officesdenr->fetch_assoc()) { 
//    $ref_off_infodenr[] = $row_resultOffdenr['INFO_OFFICE'] . '.'. $row_resultOffdenr['CODE_MAIN'];
// }
// //END DENR

// //DILG
// $officesdilg = $dbConn->query("SELECT * FROM ref_offices2 WHERE CODE_MAIN = '4'");
// while($row_resultOffdilg = $officesdilg->fetch_assoc()) { 
//    $ref_off_infodilg[] = $row_resultOffdilg['INFO_OFFICE'] . '.'. $row_resultOffdilg['CODE_MAIN'];
// }
// //END DILG

// //OTHER
// $officesother = $dbConn->query("SELECT * FROM ref_offices2 WHERE CODE_MAIN = '5'");
// while($row_resultOffother = $officesother->fetch_assoc()) { 
//    $ref_off_infoother[] = $row_resultOffother['INFO_OFFICE'] . '.'. $row_resultOffother['CODE_MAIN'];
// }
// //END OTHER


if(isset($_POST['addInter'])){
   // post part and save part ng intervention
        $SIDArr               = $_POST['SID'];
        //$ID                 = $_POST['modalID'];
        $mainofficeArr        = $_POST['txtMainoff'];
        $interventionsArr     = $_POST['txtIntervention'];
        $particularsArr       = $_POST['txtParticulars'];
        $quantityArr          = $_POST['txtQuantity'];
        $unitArr              = $_POST['txtUnit'];
        $budgetArr            = $_POST['txtBudget'];
   
   // $offArr = $_POST['off'];
      if(!empty($interventionsArr)){
         for($i = 0; $i < count($particularsArr); $i++){
           if(!empty($interventionsArr[$i])){
             
               $sid               = $SIDArr;
               $off               = $mainofficeArr[$i];
               $interventions     = $interventionsArr[$i];
               $particulars       = $particularsArr[$i];
               $quantity          = $quantityArr[$i];
               $unit              = $unitArr[$i];
               $budget            = $budgetArr[$i];

                     
               $dbConn->query('INSERT INTO tbl_interventions (SID, INFO_MAIN_DEPARTMENT, INFO_MAIN, INFO_INTERVENTION, INFO_PARTICULARS, INFO_COMM_QUANTITY, INFO_UNIT, INFO_COMM_BUDGET, INFO_USER, INFO_OFFICE, INFO_AGENCY, INFO_ACCESSLEVEL) 
               VALUES ("'.$sid.'", "", "'.$off.'", "'.$interventions.'", "'.$particulars.'", "'.$quantity.'", "'.$unit.'", "'.$budget.'", "'.$user.'", "'.$office.'", "'.$agency.'", "'.$accesslvl.'")');

               // echo 'INSERT INTO tbl_interventions (SID, INFO_MAIN_DEPARTMENT, INFO_MAIN, INFO_INTERVENTION, INFO_PARTICULARS, INFO_COMM_QUANTITY, INFO_UNIT, INFO_COMM_BUDGET, INFO_USER, INFO_OFFICE, INFO_AGENCY, INFO_ACCESSLEVEL) VALUES ("'.$sid.'", "", "'.$off.'", "'.$interventions.'", "'.$particulars.'", "'.$quantity.'", "'.$unit.'", "'.$budget.'", "'.$user.'", "'.$office.'", "'.$agency.'", "'.$accesslvl.'") /////////// /' . $i;
            }
          }  
        }
    echo "<script>window.location.href='frm_profilingcainfo.php?SID=$SID';</script>";
} 
?>
<div class="container-fluid px-3 py-0 custom-font">
   <div class="col-lg-12 bg-white border p-3">
      <div class="form-row">
         <div class="col-lg-10">
            <!-- Page Heading -->
            <h1 class="h5 mb-2 text-gray-800">Convergence Area Profile</h1>
         </div>
         <div class="col-lg-12 text-right">
            <a class="btn btn-sm btn-secondary" href="tbl_intervention.php">
               <i class="fas fa-arrow-left fa-xs mr-2"></i>
               Back
            </a>
           <!-- <?php //if($rowUserInfo["INFO_ACCESSLEVEL"] == 'ENCODER'){ ?>
               <a class="btn btn-sm btn-success" href="frm_profilingca_edit.php?SID=<?php //echo $row['SID']; ?>">
                  <i class="fas fa-pen fa-xs mr-2"></i>
                  Update
               </a>

            <?php //}?> -->
            <?php if($rowUserInfo["INFO_ACCESSLEVEL"] == 'ADMINISTRATOR' || $rowUserInfo["INFO_ACCESSLEVEL"] == 'VERIFIER'){ ?>
   
            <!-- Approve -->
          
             <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#approved<?php echo $row['SID'];?>" >
               <i class="fas fa-check fa-xs fa-white mr-2"></i>Approve
            </a>
            <!-- Flag -->
            <a href="#"  class="btn btn-sm btn-danger" data-toggle="modal" data-target="#flagged<?php echo $row['SID'];?>">
               <i class="fas fa-flag fa-xs fa-white mr-2"></i>Flag
            </a> 
             <?php include('modal_app_flag.php');?>
            <?php }?>   

         </div> 
      </div>
      <!-- Start of Data -->
      <div style="font-size: 0.9rem;">
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
               foreach($ws_name as $name_ws) {
                   //echo $municipality = trim($municipality) . '<br/>';
                   $getws = $dbConn->query("SELECT * FROM ref_watershed WHERE `WS_CODE`=$name_ws");
                   $rowws = mysqli_fetch_assoc($getws);
                   echo $rowws['NAME_WATERSHED'] . '<br/>';
            }?>
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
               Municipality / City
            </div>
            <div class="col-lg-2 p-2">
            <?php 
               $municipalities = '';
               $municipalities = explode(",", $row['INFO_MUN']);
               foreach($municipalities as $municipality) {
                   //echo $municipality = trim($municipality) . '<br/>';
                   $getMunicipality = $dbConn->query("SELECT * FROM psgc_municipalities WHERE `Code`=$municipality");
                   $rowMunicipality = mysqli_fetch_assoc($getMunicipality);
                   echo $rowMunicipality['Municipality'] . '<br/>';
            }?>
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
               <?php if($row['INFO_CON_TYPE']== 'Proposed CADP'){ echo 'N/A'; }else{ echo $row['INFO_STATUS'];}; ?>
            </div>
         </div>
         <div class="form-row border border-top-0">
            <div class="col-lg-2 p-2 bg-label">
               Priority Commodities
            </div>
            <div class="col-lg-10 p-2">
              <?php while($row_comm = mysqli_fetch_assoc($query_comm)){
                    if($row_comm['comm_info']=='OTHERS'){ echo '<div class="col-lg-3">'.$row_comm['comm_info'] . '-' .$row_comm['info_other']. '</div>';}
                     else{ echo '<div class="col-lg-3">'.$row_comm['comm_info']. '</div>'; }
                       }?>
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
         <div class="form-row border border-top-0">
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
         <!-- Part III. -->
         <div class="form-row mt-3">
            <div class="col-lg-12">
               <!-- Page Heading -->
               <h1 class="h5 mb-2 text-gray-800">Programs, Activities and Projects with Corresponding Targets</h1>
            </div>
         </div>
      <form method="post"> 
          <!-- Interventions: Department of Agriculture (DA) -->
         <div class="form-row mt-3">
            <div class="col-lg-6">
               <h4 class="custom-font">Department of Agriculture</h4>
            </div>
   
            <div class="col-lg-6 text-right">
                  <?php if($rowUserInfo["INFO_ACCESSLEVEL"] == 'ENCODER'){ ?>
                        <a class="btn btn-sm btn-primary" href="frm_intervention_editdelete.php?SID=<?php echo $row['SID']; ?>">
                           <i class="fas fa-pen fa-xs mr-2"></i>
                           Update
                        </a>
                  <?php }?> 
            </div>
         </div>

        <div class="form-row p-0 m-1 mt-2 bg-sidebar text-white">
            <div class="col-lg-3 p-2 border-left">Program/Project Classification</div>
            <div class="col-lg-3 p-2 border-left">Intervention</div>
            <div class="col-lg-2 p-2 border-left">Committed Quantity</div>
            <div class="col-lg-1 p-2 border-left">Unit</div>
            <div class="col-lg-2 p-2 border-left">Financial Target</div>
            <!-- <div class="col-lg-1 p-2 border-left">Action</div> -->
         </div>
         <div class="form-row form-inline m-1 p-0">
            <?php $queryDA = $dbConn->query("SELECT * FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%AGRICULTURE%' ORDER BY INFO_DATETIME ASC");
                  while($rowDA= mysqli_fetch_assoc($queryDA)){?>
             <div class="col-lg-3 p-2 border-left" hidden><?=rtrim($rowDA['INFO_MAIN'],".1");?></div>
             <div class="col-lg-3 p-2 border-left"><?=$rowDA['INFO_PARTICULARS'];?></div>
             <div class="col-lg-3 p-2 border-left"><?=$rowDA['INFO_INTERVENTION'];?></div>
             <div class="col-lg-2 p-2 border-left"><?=number_format($rowDA['INFO_COMM_QUANTITY']);?></div>
             <div class="col-lg-1 p-2 border-left"><?=$rowDA['INFO_UNIT'];?></div>
             <div class="col-lg-2 p-2 border-left"><?=$rowDA['INFO_COMM_BUDGET'];?></div>
             <!-- <?php //if($rowUserInfo['INFO_ACCESSLEVEL']== 'ENCODER'){?>
                <div class="col-lg-1 p-2 border-right">
                   <a href="#" data-toggle="modal" class="btn btn-sm btn-primary w-100" data-target="#editDA<?=$rowDA['ID'];?>">
                     <i class="fas fa-pen fa-xs"></i>
                     Edit
                   </a>
                      <?php //include('modal_edit_profinfo.php'); ?>
                      
                   <a href="#" class="btn btn-sm btn-danger w-100" data-toggle="modal" data-target="#deleteDA<?=$rowDA['ID'];?>">
                     <i class="fas fa-trash-alt fa-xs mr-2"></i>
                      Delete
                   </a>
                   <?php //include('modal_delete_info.php'); ?>
                </div>
                <?php //} ?>             -->
             <?php } ?>
         </div>
         <div id="file_div" class="form-row form-inline m-1 p-0">
               <?php
                  $get_User = $dbConn->query("SELECT * FROM tbl_user WHERE USERID = '$userid'");
                    while($row_user = mysqli_fetch_assoc($get_User)) {
               ?>
               <input type="hidden" name="INFO_OFFICE" value="<?php echo $row_user["INFO_OFFICE"] ?>">
               <input type="hidden" name="INFO_USERNAME" value="<?php echo $row_user["INFO_USERNAME"]?>">
               <input type="hidden" name="INFO_ACCESSLEVEL" value="<?php echo $row_user["INFO_ACCESSLEVEL"] ?>">
               <?php } ?>
               <!-- OFFICE -->
               <input type="hidden" name="SID" value="<?php echo $SID; ?>">
              
            
               <?php if($rowUserInfo["INFO_ACCESSLEVEL"] == 'ENCODER'){?>
               <!-- <select name="txtMainoff[]" class="form-control form-control-sm col-lg-2" onChange="getProgram(this.value)">
                  <option value="" selected >SELECT OFFICE</option>
                  <?php //foreach($ref_off_info as $off_info) { ?>
                  <option value="<?php //echo $off_info; ?>"><?php //echo rtrim($off_info,".1");?></option>
                  <?php //} ?>                              
               </select>  -->
               <input type="hidden"  class="form-control form-control-sm col-lg-2" name="txtMainoff[]" value="DEPARTMENT OF AGRICULTURE">
               <!-- PROGRAM -->
               <?php $getProgram = $dbConn->query("SELECT * FROM ref_programs WHERE PROGRAM_CODE = 'DA'");?>
               <select class="form-control col-lg-3 text-xs" name="txtParticulars[]" placeholder="Program/Project Classification">
               <option value="" selected >SELECT PROGRAM</option>
               <?php while($rowProgram = mysqli_fetch_assoc($getProgram)) { ?>
                        <option value="<?php echo $rowProgram['PROGRAM_DESC']; ?>">
                           <?php echo $rowProgram['PROGRAM_DESC']; ?>
                        </option>   
               <?php } ?>
               </select>
               <!-- <input type="text" class="form-control col-lg-2 text-xs" name="txtParticulars[]" placeholder="Program/Project Classification" onkeyup="this.value = this.value.toUpperCase();"> -->
               <!-- INtervention -->
               <?php $getInter = $dbConn->query("SELECT * FROM ref_intervention WHERE OFFICE_CODE = 'DA'");?>
               <select class="form-control col-lg-3 text-xs" name="txtIntervention[]" placeholder="Specific Intervention">
               <option value="" selected >SELECT INTERVENTION</option>
               <?php while($rowInter = mysqli_fetch_assoc($getInter)) { ?>
                        <option value="<?php echo $rowInter['INTERVENTION_DESC']; ?>">
                           <?php echo $rowInter['INTERVENTION_DESC']; ?>
                        </option>   
               <?php } ?>
               </select>
               <!-- <input type="text" class="form-control col-lg-2 text-xs" name="txtIntervention[]" placeholder="Specific Intervention" onkeyup="this.value = this.value.toUpperCase();"> -->
               <!-- Quantity -->
               <input type="text" class="form-control col-lg-2 text-xs" name="txtQuantity[]" placeholder="Committed Quantity" onkeyup="this.value = this.value.toUpperCase();">
               <!-- UNIT -->
               <select class="form-control col-lg-1" name="txtUnit[]" placeholder="Unit">
               <option value="" selected >SELECT UNIT</option>
               <?php while($rowUnit = mysqli_fetch_assoc($query_unit)) { ?>
                        <option value="<?php echo $rowUnit['UNIT']; ?>">
                           <?php echo $rowUnit['UNIT']; ?>
                        </option>   
               <?php } ?>
               </select>
               <!-- Financial Target -->
               <input type="text" class="form-control col-lg-2 text-xs" name="txtBudget[]" placeholder="Financial Target ('000)" onkeyup="this.value = this.value.toUpperCase();">
               <!--Button -->
               <button style="" type="button" class="btn btn-sm btn-success col-lg-1" onclick="add_fileDA();">
                  <i class="fas fa-plus fa-xs"></i> Add
               </button>
              <?php }?>
         </div>

         <!-- END DA -->


          <!-- Interventions: Department of Agrarian Reform (DAR) -->
         <div class="form-row mt-3">
            <div class="col-lg-12">
               <h4 class="custom-font">Department of Agrarian Reform</h4>
            </div>
         </div>

         <div class="form-row p-0 m-1 bg-sidebar text-white">
            <div class="col-lg-2 p-2 border-left" hidden>Office / Agency</div>
            <div class="col-lg-3 p-2 border-left">Program/Project Classification</div>
            <div class="col-lg-3 p-2 border-left">Intervention</div>
            <div class="col-lg-2 p-2 border-left">Committed Quantity</div>
            <div class="col-lg-1 p-2 border-left">Unit</div>
            <div class="col-lg-2 p-2 border-left">Financial Target ('000)</div>
         </div>
         <div class="form-row form-inline m-1 p-0">
            <?php $queryDAR = $dbConn->query("SELECT * FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%AGRARIAN%' ORDER BY INFO_DATETIME ASC");
                  while($rowDAR= mysqli_fetch_assoc($queryDAR)){?>
             <div class="col-lg-2 p-2 border-left" hidden><?=rtrim($rowDAR['INFO_MAIN'],".2");?></div>
             <div class="col-lg-3 p-2 border-left"><?=$rowDAR['INFO_PARTICULARS'];?></div>
             <div class="col-lg-3 p-2 border-left"><?=$rowDAR['INFO_INTERVENTION'];?></div>
             <div class="col-lg-2 p-2 border-left"><?=number_format($rowDAR['INFO_COMM_QUANTITY']);?></div>
             <div class="col-lg-1 p-2 border-left"><?=$rowDAR['INFO_UNIT'];?></div>
             <div class="col-lg-2 p-2 border-left"><?=$rowDAR['INFO_COMM_BUDGET'];?></div>
             <?php } ?>
         </div>
         <div id="file_divdar" class="form-row form-inline m-1 p-0">
               <?php
                  $get_User = $dbConn->query("SELECT * FROM tbl_user WHERE USERID = '$userid'");
                    while($row_user = mysqli_fetch_assoc($get_User)) {
               ?>
               <input type="hidden" name="INFO_OFFICE" value="<?php echo $row_user["INFO_OFFICE"] ?>">
               <input type="hidden" name="INFO_USERNAME" value="<?php echo $row_user["INFO_USERNAME"]?>">
               <input type="hidden" name="INFO_ACCESSLEVEL" value="<?php echo $row_user["INFO_ACCESSLEVEL"] ?>">
               <?php } ?>
               <!-- OFFICE -->
               <input type="hidden" name="SID" value="<?php echo $SID; ?>">
              
               <?php if($rowUserInfo["INFO_ACCESSLEVEL"] == 'ENCODER'){?>
               <!-- <select name="txtMainoff[]" class="form-control form-control-sm col-lg-2" id="off_select">
                  <option value="" selected>SELECT OFFICE</option>
                  <?php //foreach($ref_off_infodar as $off_infodar) { ?>
                  <option value="<?php //echo $off_infodar; ?>"><?php //echo rtrim($off_infodar,".2");?></option>
                  <?php //} ?>                              
               </select>  -->
               <input type="hidden" class="form-control form-control-sm col-lg-2" name="txtMainoff[]" value="DEPARTMENT OF AGRARIAN REFORM">
               <!-- PROGRAM -->
               <?php $getProgram = $dbConn->query("SELECT * FROM ref_programs WHERE PROGRAM_CODE = 'DAR'");?>
               <select class="form-control col-lg-3 text-xs" name="txtParticulars[]" placeholder="Program/Project Classification">
               <option value="" selected >SELECT PROGRAM</option>
               <?php while($rowProgram = mysqli_fetch_assoc($getProgram)) { ?>
                        <option value="<?php echo $rowProgram['PROGRAM_DESC']; ?>">
                           <?php echo $rowProgram['PROGRAM_DESC']; ?>
                        </option>   
               <?php } ?>
               </select>
               <!-- <input type="text" class="form-control col-lg-2 text-xs" name="txtParticulars[]" placeholder="Program/Project Classification" onkeyup="this.value = this.value.toUpperCase();"> -->
               <!-- INtervention -->
               <?php $getInter = $dbConn->query("SELECT * FROM ref_intervention WHERE OFFICE_CODE = 'DAR'");?>
               <select class="form-control col-lg-3 text-xs" name="txtIntervention[]" placeholder="Specific Intervention">
               <option value="" selected >SELECT INTERVENTION</option>
               <?php while($rowInter = mysqli_fetch_assoc($getInter)) { ?>
                        <option value="<?php echo $rowInter['INTERVENTION_DESC']; ?>">
                           <?php echo $rowInter['INTERVENTION_DESC']; ?>
                        </option>   
               <?php } ?>
               </select>
               <!-- <input type="text" class="form-control col-lg-2 text-xs" name="txtIntervention[]" placeholder="Specific Intervention" onkeyup="this.value = this.value.toUpperCase();"> -->
               <!-- Quantity -->
               <input type="text" class="form-control col-lg-2 text-xs" name="txtQuantity[]" placeholder="Committed Quantity" onkeyup="this.value = this.value.toUpperCase();">
               <!-- UNIT -->
               <?php  $query_unitdar = $dbConn->query("SELECT * FROM ref_unit"); ?>
               <select class="form-control col-lg-1" name="txtUnit[]" placeholder="Unit">
               <option value="" selected >SELECT UNIT</option>
               <?php while($rowUnitdar = mysqli_fetch_assoc($query_unitdar)) { ?>
                        <option value="<?php echo $rowUnitdar['UNIT']; ?>">
                           <?php echo $rowUnitdar['UNIT']; ?>
                        </option>
               <?php } ?>
               </select>
               <!-- Financial Target -->
               <input type="text" class="form-control col-lg-2 text-xs" name="txtBudget[]" placeholder="Financial Target ('000)" onkeyup="this.value = this.value.toUpperCase();">
              
               <!--Button -->
               <button style="" type="button" class="btn btn-sm btn-success col-lg-1" onclick="add_filedar();">
                  Add
               </button>
              <?php }?>
               
         </div>
         <!-- END DAR -->

         <!-- DENR -->
         <div class="form-row mt-3">
            <div class="col-lg-12">
               <h4 class="custom-font">Department of Environment and Natural Resources</h4>
            </div>
         </div>

         <div class="form-row p-0 m-1 bg-sidebar text-white">
            <div class="col-lg-2 p-2 border-left" hidden>Office / Agency</div>
            <div class="col-lg-3 p-2 border-left">Program/Project Classification</div>
            <div class="col-lg-3 p-2 border-left">Intervention</div>
            <div class="col-lg-2 p-2 border-left">Committed Quantity</div>
            <div class="col-lg-1 p-2 border-left">Unit</div>
            <div class="col-lg-2 p-2 border-left">Financial Target ('000)</div>
         </div> 
         <div class="form-row form-inline m-1 p-0">
            <?php $queryDENR = $dbConn->query("SELECT * FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%3%' ORDER BY INFO_DATETIME ASC");
                  while($rowDENR= mysqli_fetch_assoc($queryDENR)){?>
             <div class="col-lg-2 p-2 border-left" hidden><?=rtrim($rowDENR['INFO_MAIN'],".3");?></div>
             <div class="col-lg-3 p-2 border-left"><?=$rowDENR['INFO_PARTICULARS'];?></div>
             <div class="col-lg-3 p-2 border-left"><?=$rowDENR['INFO_INTERVENTION'];?></div>
             <div class="col-lg-2 p-2 border-left"><?=number_format($rowDENR['INFO_COMM_QUANTITY']);?></div>
             <div class="col-lg-1 p-2 border-left"><?=$rowDENR['INFO_UNIT'];?></div>
             <div class="col-lg-2 p-2 border-left"><?=$rowDENR['INFO_COMM_BUDGET'];?></div>
             <?php } ?>
         </div>
         <div id="file_divdenr" class="form-row form-inline m-1 p-0">
               <?php
                  $get_User = $dbConn->query("SELECT * FROM tbl_user WHERE USERID = '$userid'");
                    while($row_user = mysqli_fetch_assoc($get_User)) {
               ?>
               <input type="hidden" name="INFO_OFFICE" value="<?php echo $row_user["INFO_OFFICE"] ?>">
               <input type="hidden" name="INFO_USERNAME" value="<?php echo $row_user["INFO_USERNAME"]?>">
               <input type="hidden" name="INFO_ACCESSLEVEL" value="<?php echo $row_user["INFO_ACCESSLEVEL"] ?>">
               <?php } ?>
               <!-- OFFICE -->
               <input type="hidden" name="SID" value="<?php echo $SID; ?>">
              
               <?php if($rowUserInfo["INFO_ACCESSLEVEL"] == 'ENCODER'){?>
               <!-- <select name="txtMainoff[]" class="form-control form-control-sm col-lg-2" id="off_select">
                  <option value="" selected>SELECT OFFICE</option>
                  <?php //foreach($ref_off_infodenr as $off_infodenr) { ?>
                  <option value="<?php //echo $off_infodenr; ?>"><?php //echo rtrim($off_infodenr,".3");?></option>
                  <?php //} ?>                              
               </select>  -->
               <input type="hidden" class="form-control form-control-sm col-lg-2" name="txtMainoff[]" value="DEPARTMENT OF ENVIRONTMENT AND NATURAL RESOURCES">
               <!-- PROGRAM -->
               <?php $getProgram = $dbConn->query("SELECT * FROM ref_programs WHERE PROGRAM_CODE = 'DENR'");?>
               <select class="form-control col-lg-3 text-xs" name="txtParticulars[]" placeholder="Program/Project Classification">
               <option value="" selected >SELECT PROGRAM</option>
               <?php while($rowProgram = mysqli_fetch_assoc($getProgram)) { ?>
                        <option value="<?php echo $rowProgram['PROGRAM_DESC']; ?>">
                           <?php echo $rowProgram['PROGRAM_DESC']; ?>
                        </option>   
               <?php } ?>
               </select>
               <!-- <input type="text" class="form-control col-lg-2 text-xs" name="txtParticulars[]" placeholder="Program/Project Classification" onkeyup="this.value = this.value.toUpperCase();"> -->
               <!-- INtervention -->
               <?php $getInter = $dbConn->query("SELECT * FROM ref_intervention WHERE OFFICE_CODE = 'DENR'");?>
               <select class="form-control col-lg-3 text-xs" name="txtIntervention[]" placeholder="Specific Intervention">
               <option value="" selected >SELECT INTERVENTION</option>
               <?php while($rowInter = mysqli_fetch_assoc($getInter)) { ?>
                        <option value="<?php echo $rowInter['INTERVENTION_DESC']; ?>">
                           <?php echo $rowInter['INTERVENTION_DESC']; ?>
                        </option>   
               <?php } ?>
               </select>
               <!-- <input type="text" class="form-control col-lg-2 text-xs" name="txtIntervention[]" placeholder="Specific Intervention" onkeyup="this.value = this.value.toUpperCase();"> -->
               <!-- Quantity -->
               <input type="text" class="form-control col-lg-2 text-xs" name="txtQuantity[]" placeholder="Committed Quantity" onkeyup="this.value = this.value.toUpperCase();">
               <!-- UNIT -->
               <?php  $query_unitdenr = $dbConn->query("SELECT * FROM ref_unit"); ?>
               <select class="form-control col-lg-1" name="txtUnit[]" placeholder="Unit">
               <option value="" selected >SELECT UNIT</option>
               <?php while($rowUnitdenr = mysqli_fetch_assoc($query_unitdenr)) { ?>
                        <option value="<?php echo $rowUnitdenr['UNIT']; ?>">
                           <?php echo $rowUnitdenr['UNIT']; ?>
                        </option>
               <?php } ?>
               <!-- Financial Target -->
               <input type="text" class="form-control col-lg-2 text-xs" name="txtBudget[]" placeholder="Financial Target ('000)" onkeyup="this.value = this.value.toUpperCase();">

               <!--Button -->
               <button style="" type="button" class="btn btn-sm btn-success col-lg-1" onclick="add_filedenr();">
                  Add
               </button>
              <?php }?>
         </div>
         <!-- END DENR -->

             <!-- DILG -->
         <div class="form-row mt-3">
            <div class="col-lg-12">
               <h4 class="custom-font">Department of the Interior and Local Government</h4>
            </div>
         </div>

         <div class="form-row p-0 m-1 bg-accent text-white">
            <div class="col-lg-2 p-2 border-left" hidden>Office / Agency</div>
            <div class="col-lg-3 p-2 border-left">Program/Project Classification</div>
            <div class="col-lg-3 p-2 border-left">Intervention</div>
            <div class="col-lg-2 p-2 border-left">Committed Quantity</div>
            <div class="col-lg-1 p-2 border-left">Unit</div>
            <div class="col-lg-2 p-2 border-left">Financial Target ('000)</div>
         </div> 
         <div class="form-row form-inline m-1 p-0">
            <?php $queryDILG = $dbConn->query("SELECT * FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%4%' ORDER BY INFO_DATETIME ASC");
                  while($rowDILG= mysqli_fetch_assoc($queryDILG)){?>
             <div class="col-lg-2 p-2 border-left" hidden><?=rtrim($rowDILG['INFO_MAIN'],".4");?></div>
             <div class="col-lg-3 p-2 border-left"><?=$rowDILG['INFO_PARTICULARS'];?></div>
             <div class="col-lg-3 p-2 border-left"><?=$rowDILG['INFO_INTERVENTION'];?></div>
             <div class="col-lg-2 p-2 border-left"><?=number_format($rowDILG['INFO_COMM_QUANTITY']);?></div>
             <div class="col-lg-1 p-2 border-left"><?=$rowDILG['INFO_UNIT'];?></div>
             <div class="col-lg-2 p-2 border-left"><?=$rowDILG['INFO_COMM_BUDGET'];?></div>
             <?php } ?>
         </div>
         <div id="file_divdilg" class="form-row form-inline m-1 p-0">
               <?php
                  $get_User = $dbConn->query("SELECT * FROM tbl_user WHERE USERID = '$userid'");
                    while($row_user = mysqli_fetch_assoc($get_User)) {
               ?>
               <input type="hidden" name="INFO_OFFICE" value="<?php echo $row_user["INFO_OFFICE"] ?>">
               <input type="hidden" name="INFO_USERNAME" value="<?php echo $row_user["INFO_USERNAME"]?>">
               <input type="hidden" name="INFO_ACCESSLEVEL" value="<?php echo $row_user["INFO_ACCESSLEVEL"] ?>">
               <?php } ?>
               <!-- OFFICE -->
               <input type="hidden" name="SID" value="<?php echo $SID; ?>">
               <?php if($rowUserInfo["INFO_ACCESSLEVEL"] == 'ENCODER'){ ?> 
               <!-- <select name="txtMainoff[]" class="form-control form-control-sm col-lg-2" id="off_select">
                  <option value="" selected >SELECT OFFICE</option>
                  <?php //foreach($ref_off_infodilg as $off_infodilg) { ?>
                  <option value="<?php //echo $off_infodilg; ?>"><?php //echo rtrim($off_infodilg,".4");?></option>
                  <?php //} ?>                              
               </select>  -->
               <input type="hidden" class="form-control form-control-sm col-lg-2" name="txtMainoff[]" value="DEPARTMENT OF THE INTERIOR AND LOCAL GOVERNMENT">
               <!-- PROGRAM -->
               <?php $getProgram = $dbConn->query("SELECT * FROM ref_programs WHERE PROGRAM_CODE = 'DILG'");?>
               <select class="form-control col-lg-3 text-xs" name="txtParticulars[]" placeholder="Program/Project Classification">
               <option value="" selected >SELECT PROGRAM</option>
               <?php while($rowProgram = mysqli_fetch_assoc($getProgram)) { ?>
                        <option value="<?php echo $rowProgram['PROGRAM_DESC']; ?>">
                           <?php echo $rowProgram['PROGRAM_DESC']; ?>
                        </option>   
               <?php } ?>
               </select>
               <!-- <input type="text" class="form-control col-lg-2 text-xs" name="txtParticulars[]" placeholder="Program/Project Classification" onkeyup="this.value = this.value.toUpperCase();"> -->
               <!-- INtervention -->
               <?php $getInter = $dbConn->query("SELECT * FROM ref_intervention WHERE OFFICE_CODE = 'DILG'");?>
               <select class="form-control col-lg-3 text-xs" name="txtIntervention[]" placeholder="Specific Intervention">
               <option value="" selected >SELECT INTERVENTION</option>
               <?php while($rowInter = mysqli_fetch_assoc($getInter)) { ?>
                        <option value="<?php echo $rowInter['INTERVENTION_DESC']; ?>">
                           <?php echo $rowInter['INTERVENTION_DESC']; ?>
                        </option>   
               <?php } ?>
               </select>
               <!-- <input type="text" class="form-control col-lg-2 text-xs" name="txtIntervention[]" placeholder="Specific Intervention" onkeyup="this.value = this.value.toUpperCase();"> -->
               <!-- Quantity -->
               <input type="text" class="form-control col-lg-2 text-xs" name="txtQuantity[]" placeholder="Committed Quantity" onkeyup="this.value = this.value.toUpperCase();">
               <!-- UNIT -->
               <?php  $query_unitdilg = $dbConn->query("SELECT * FROM ref_unit"); ?>
               <select class="form-control col-lg-1" name="txtUnit[]" placeholder="Unit">
               <option value="" selected >SELECT UNIT</option>
               <?php while($rowUnitdilg = mysqli_fetch_assoc($query_unitdilg)) { ?>
                        <option value="<?php echo $rowUnitdilg['UNIT']; ?>">
                           <?php echo $rowUnitdilg['UNIT']; ?>
                        </option>
               <?php } ?>
               <!-- Financial Target -->
               <input type="text" class="form-control col-lg-2 text-xs" name="txtBudget[]" placeholder="Financial Target ('000)" onkeyup="this.value = this.value.toUpperCase();">
             
               <!--Button -->
               <button style="" type="button" class="btn btn-sm btn-success col-lg-1" onclick="add_filedilg();">
                  Add
               </button>
               <?php }?>
         </div>
         <!-- END DILG -->

     <!-- OTHER -->
         <div class="form-row mt-3">
            <div class="col-lg-12">
               <h4 class="custom-font">Other Agencies</h4>
            </div>
         </div>

         <div class="form-row p-0 m-1 bg-accent text-white">
            <div class="col-lg-2 p-2 border-left">Office / Agency</div>
            <div class="col-lg-2 p-2 border-left">Program/Project Classification</div>
            <div class="col-lg-2 p-2 border-left">Intervention</div>
            <div class="col-lg-2 p-2 border-left">Committed Quantity</div>
            <div class="col-lg-1 p-2 border-left">Unit</div>
            <div class="col-lg-2 p-2 border-left">Financial Target ('000)</div>
         </div> 
         <div class="form-row form-inline m-1 p-0">
            <?php $queryOTHER = $dbConn->query("SELECT * FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%5%' ORDER BY INFO_DATETIME ASC");
                  while($rowOTHER= mysqli_fetch_assoc($queryOTHER)){?>
             <div class="col-lg-2 p-2 border-left"><?=rtrim($rowOTHER['INFO_MAIN'],".5");?></div>
             <div class="col-lg-2 p-2 border-left"><?=$rowOTHER['INFO_PARTICULARS'];?></div>
             <div class="col-lg-2 p-2 border-left"><?=$rowOTHER['INFO_INTERVENTION'];?></div>
             <div class="col-lg-2 p-2 border-left"><?=number_format($rowOTHER['INFO_COMM_QUANTITY']);?></div>
             <div class="col-lg-1 p-2 border-left"><?=$rowOTHER['INFO_UNIT'];?></div>
             <div class="col-lg-2 p-2 border-left"><?=$rowOTHER['INFO_COMM_BUDGET'];?></div>
             <?php } ?>
         </div>
         <div id="file_divother" class="form-row form-inline m-1 p-0">
               <?php
                  $get_User = $dbConn->query("SELECT * FROM tbl_user WHERE USERID = '$userid'");
                    while($row_user = mysqli_fetch_assoc($get_User)) {
               ?>
               <input type="hidden" name="INFO_OFFICE" value="<?php echo $row_user["INFO_OFFICE"] ?>">
               <input type="hidden" name="INFO_USERNAME" value="<?php echo $row_user["INFO_USERNAME"]?>">
               <input type="hidden" name="INFO_ACCESSLEVEL" value="<?php echo $row_user["INFO_ACCESSLEVEL"] ?>">
               <?php } ?>
               <!-- OFFICE -->
               <input type="hidden" name="SID" value="<?php echo $SID; ?>">
               <?php if($rowUserInfo["INFO_ACCESSLEVEL"] == 'ENCODER'){ ?>
               <select name="txtMainoff[]" class="form-control form-control-sm col-lg-2" id="off_select">
                  <option value="" selected >SELECT OFFICE</option>
                  <?php foreach($ref_off_infoother as $off_infoother) { ?>
                  <option value="<?php echo $off_infoother; ?>"><?php echo rtrim($off_infoother,".5");?></option>
                  <?php } ?>                              
               </select> 
               <!-- PROGRAM -->
               <?php $getProgram = $dbConn->query("SELECT * FROM ref_programs WHERE PROGRAM_CODE = 'OTHER'");?>
               <select class="form-control col-lg-2 text-xs" name="txtParticulars[]" placeholder="Program/Project Classification">
               <option value="" selected >SELECT PROGRAM</option>
               <?php while($rowProgram = mysqli_fetch_assoc($getProgram)) { ?>
                        <option value="<?php echo $rowProgram['PROGRAM_DESC']; ?>">
                           <?php echo $rowProgram['PROGRAM_DESC']; ?>
                        </option>   
               <?php } ?>
               </select>
               <!-- <input type="text" class="form-control col-lg-2 text-xs" name="txtParticulars[]" placeholder="Program/Project Classification" onkeyup="this.value = this.value.toUpperCase();"> -->
               <!-- INtervention -->
               <input type="text" class="form-control col-lg-2 text-xs" name="txtIntervention[]" placeholder="Specific Intervention" onkeyup="this.value = this.value.toUpperCase();">
               <!-- Quantity -->
               <input type="text" class="form-control col-lg-2 text-xs" name="txtQuantity[]" placeholder="Committed Quantity" onkeyup="this.value = this.value.toUpperCase();">
               <!-- UNIT -->
               <?php  $query_unitother = $dbConn->query("SELECT * FROM ref_unit"); ?>
               <select class="form-control col-lg-1" name="txtUnit[]" placeholder="Unit">
               <option value="" selected >SELECT UNIT</option>
               <?php while($rowUnitother = mysqli_fetch_assoc($query_unitother)) { ?>
                        <option value="<?php echo $rowUnitother['UNIT']; ?>">
                           <?php echo $rowUnitother['UNIT']; ?>
                        </option>
               <?php } ?>
               <!-- Financial Target -->
               <input type="text" class="form-control col-lg-2 text-xs" name="txtBudget[]" placeholder="Financial Target ('000)" onkeyup="this.value = this.value.toUpperCase();">
           
               <!--Button -->
               <button style="" type="button" class="btn btn-sm btn-success col-lg-1" onclick="add_fileother();">
                  Add
               </button>
              <?php }?>
         </div>
         <!-- END OTHER -->
                  
		   <?php if($rowUserInfo["INFO_ACCESSLEVEL"] == 'ENCODER'){ ?>
         <button type="submit" name="addInter" class="btn btn-sm btn-primary btn-xs ml-3 mt-2">
            <i class="fas fa-save fa-xs"></i>
            Save
         </button>
         <?php } ?>
      </form>
       
<?php include('footer.html'); ?>     

</body> 

           <script>
         
               function add_fileDA()
                  {
                     $('#file_div').append("<div class='col-lg-12 form-inline m-0 mt-1 p-0 pt-1 border-top'>"+
                        "<?php
                           $get_User = $dbConn->query("SELECT * FROM tbl_user WHERE USERID = '$userid'");
                           while($row_user = mysqli_fetch_assoc($get_User)) {
                        ?>"+
                        "<input type='hidden' name='INFO_OFFICE' value='<?php echo $row_user['INFO_OFFICE'] ?>'>"+
                        "<input type='hidden' name='INFO_USERNAME' value='<?php echo $row_user['INFO_USERNAME']?>'>"+
                        "<input type='hidden' name='INFO_ACCESSLEVEL' value='<?php echo $row_user['INFO_ACCESSLEVEL'] ?>'>"+
                        "<?php } ?>"+
                        "<input type='hidden' name='SID' value='<?php echo $SID; ?>'>"+
                        "<select name='txtMainoff[]' class='form-control form-control-sm col-lg-2' id='off_select'>"+
                           "<option value='' selected >SELECT OFFICE</option>"+
                           "<?php foreach($ref_off_info as $off_info) { ?>"+
                           "<option value='<?php echo $off_info; ?>'><?php echo rtrim($off_info,'.1');?></option>"+
                           "<?php } ?>"+                              
                        "</select> "+  
                        "<?php $getProgram = $dbConn->query("SELECT * FROM ref_programs WHERE PROGRAM_CODE = 'DA'");?>"+
                        "<select class='form-control col-lg-2 text-xs' name='txtParticulars[]' placeholder='Program/Project Classification'>"+
                           "<option value='' selected >SELECT PROGRAM</option>"+
                           "<?php while($rowProgram = mysqli_fetch_assoc($getProgram)) { ?>"+
                           "<option value='<?php echo $rowProgram['PROGRAM_DESC']; ?>'>"+
                           "<?php echo $rowProgram['PROGRAM_DESC']; ?>"+
                           "</option>"+ 
                           "<?php } ?>"+
                        "</select>"+
                        "<?php $getInter = $dbConn->query("SELECT * FROM ref_intervention WHERE OFFICE_CODE = 'DA'");?>"+
                        "<select class='form-control col-lg-2 text-xs' name='txtIntervention[]'>"+
                           "<option value='' selected>SELECT INTERVENTION</option>"+
                           "<?php while($rowInter = mysqli_fetch_assoc($getInter)) { ?>"+
                           "<option value='<?php echo $rowInter['INTERVENTION_DESC']; ?>'>"+
                           "<?php echo $rowInter['INTERVENTION_DESC']; ?>"+
                           "</option>"+ 
                           "<?php } ?>"+
                        "</select>"+
                        "<input type='text' class='form-control col-lg-2 text-xs' name='txtQuantity[]' placeholder='Committed Quantity' onkeyup='this.value = this.value.toUpperCase();'>"+
                        "<?php  $query_unitDA = $dbConn->query("SELECT * FROM ref_unit"); ?>"+
                        "<select class='form-control col-lg-1' name='txtUnit[]' placeholder='Unit'>"+
                        "<option value='' selected >SELECT UNIT</option>"+
                        "<?php while($rowUnitDA = mysqli_fetch_assoc($query_unitDA)) { ?>"+
                        "<option value='<?php echo $rowUnitDA['UNIT']; ?>'>"+
                        "<?php echo $rowUnitDA['UNIT']; ?>"+
                        "</option>"+
                        "<?php } ?>"+
                        "<input type='text' class='form-control col-lg-2 text-xs' name='txtBudget[]' placeholder='Financial Target (000)' onkeyup='this.value = this.value.toUpperCase();'>"+
                        "<input type='button' class='btn btn-sm btn-danger col-lg-1' value='REMOVE' onclick=remove_file(this);></div>");
                  }

            function remove_file(ele)
            {
             $(ele).parent().remove();
            }



             //DAR
               function add_filedar()
                  {
                     $('#file_divdar').append("<div class='col-lg-12 form-inline m-0 mt-1 p-0 pt-1 border-top'>"+
                        "<?php
                           $get_User = $dbConn->query("SELECT * FROM tbl_user WHERE USERID = '$userid'");
                           while($row_user = mysqli_fetch_assoc($get_User)) {
                        ?>"+
                        "<input type='hidden' name='INFO_OFFICE' value='<?php echo $row_user['INFO_OFFICE'] ?>'>"+
                        "<input type='hidden' name='INFO_USERNAME' value='<?php echo $row_user['INFO_USERNAME']?>'>"+
                        "<input type='hidden' name='INFO_ACCESSLEVEL' value='<?php echo $row_user['INFO_ACCESSLEVEL'] ?>'>"+
                        "<?php } ?>"+
                        "<input type='hidden' name='SID' value='<?php echo $SID; ?>'>"+
                        "<input type='hidden' name='MainDepartment' class='MainDepartment'>"+
                        "<select name='txtMainoff[]' class='form-control form-control-sm col-lg-2' id='off_select'>"+
                           "<option value='' selected >SELECT OFFICE</option>"+
                           "<?php foreach($ref_off_infodar as $off_infodar) { ?>"+
                           "<option value='<?php echo $off_infodar; ?>'><?php echo rtrim($off_infodar,'.2');?></option>"+
                           "<?php } ?>"+                              
                        "</select> "+
                        "<?php $getProgram = $dbConn->query("SELECT * FROM ref_programs WHERE PROGRAM_CODE = 'DAR'");?>"+
                        "<select class='form-control col-lg-2 text-xs' name='txtParticulars[]' placeholder='Program/Project Classification'>"+
                           "<option value='' selected >SELECT PROGRAM</option>"+
                           "<?php while($rowProgram = mysqli_fetch_assoc($getProgram)) { ?>"+
                           "<option value='<?php echo $rowProgram['PROGRAM_DESC']; ?>'>"+
                           "<?php echo $rowProgram['PROGRAM_DESC']; ?>"+
                           "</option>"+ 
                           "<?php } ?>"+
                        "</select>"+
                        "<?php $getInter = $dbConn->query("SELECT * FROM ref_intervention WHERE OFFICE_CODE = 'DAR'");?>"+
                        "<select class='form-control col-lg-2 text-xs' name='txtIntervention[]'>"+
                           "<option value='' selected>SELECT INTERVENTION</option>"+
                           "<?php while($rowInter = mysqli_fetch_assoc($getInter)) { ?>"+
                           "<option value='<?php echo $rowInter['INTERVENTION_DESC']; ?>'>"+
                           "<?php echo $rowInter['INTERVENTION_DESC']; ?>"+
                           "</option>"+ 
                           "<?php } ?>"+
                        "</select>"+
                        "<input type='text' class='form-control col-lg-2 text-xs' name='txtQuantity[]' placeholder='Committed Quantity' onkeyup='this.value = this.value.toUpperCase();'>"+
                        "<?php  $query_unitDAR = $dbConn->query("SELECT * FROM ref_unit"); ?>"+
                        "<select class='form-control col-lg-1' name='txtUnit[]' placeholder='Unit'>"+
                        "<option value='' selected >SELECT UNIT</option>"+
                        "<?php while($rowUnitDAR = mysqli_fetch_assoc($query_unitDAR)) { ?>"+
                        "<option value='<?php echo $rowUnitDAR['UNIT']; ?>'>"+
                        "<?php echo $rowUnitDAR['UNIT']; ?>"+
                        "</option>"+
                        "<?php } ?>"+
                        "<input type='text' class='form-control col-lg-2 text-xs' name='txtBudget[]' placeholder='Financial Target (000)' onkeyup='this.value = this.value.toUpperCase();'>"+
                        "<input type='button' class='btn btn-sm btn-danger col-lg-1' value='REMOVE' onclick=remove_filedar(this);></div>");
                  }

            function remove_filedar(ele)
            {
             $(ele).parent().remove();
            }
            //END DAR

            //DENR
              function add_filedenr()
                  {
                     $('#file_divdenr').append("<div class='col-lg-12 form-inline m-0 mt-1 p-0 pt-1 border-top'>"+
                        "<?php
                           $get_User = $dbConn->query("SELECT * FROM tbl_user WHERE USERID = '$userid'");
                           while($row_user = mysqli_fetch_assoc($get_User)) {
                        ?>"+
                        "<input type='hidden' name='INFO_OFFICE' value='<?php echo $row_user['INFO_OFFICE'] ?>'>"+
                        "<input type='hidden' name='INFO_USERNAME' value='<?php echo $row_user['INFO_USERNAME']?>'>"+
                        "<input type='hidden' name='INFO_ACCESSLEVEL' value='<?php echo $row_user['INFO_ACCESSLEVEL'] ?>'>"+
                        "<?php } ?>"+
                        "<input type='hidden' name='SID' value='<?php echo $SID; ?>'>"+
                        "<input type='hidden' name='MainDepartment' class='MainDepartment'>"+
                        "<select name='txtMainoff[]' class='form-control form-control-sm col-lg-2' id='off_select'>"+
                           "<option value='' selected >SELECT OFFICE</option>"+
                           "<?php foreach($ref_off_infodenr as $off_infodenr) { ?>"+
                           "<option value='<?php echo $off_infodenr; ?>'><?php echo rtrim($off_infodenr,'.3');?></option>"+
                           "<?php } ?>"+                              
                        "</select> "+
                        "<?php $getProgram = $dbConn->query("SELECT * FROM ref_programs WHERE PROGRAM_CODE = 'DENR'");?>"+
                        "<select class='form-control col-lg-2 text-xs' name='txtParticulars[]' placeholder='Program/Project Classification'>"+
                           "<option value='' selected >SELECT PROGRAM</option>"+
                           "<?php while($rowProgram = mysqli_fetch_assoc($getProgram)) { ?>"+
                           "<option value='<?php echo $rowProgram['PROGRAM_DESC']; ?>'>"+
                           "<?php echo $rowProgram['PROGRAM_DESC']; ?>"+
                           "</option>"+ 
                           "<?php } ?>"+
                        "</select>"+
                        "<?php $getInter = $dbConn->query("SELECT * FROM ref_intervention WHERE OFFICE_CODE = 'DENR'");?>"+
                        "<select class='form-control col-lg-2 text-xs' name='txtIntervention[]'>"+
                           "<option value='' selected >SELECT INTERVENTION</option>"+
                           "<?php while($rowInter = mysqli_fetch_assoc($getInter)) { ?>"+
                           "<option value='<?php echo $rowInter['INTERVENTION_DESC']; ?>'>"+
                           "<?php echo $rowInter['INTERVENTION_DESC']; ?>"+
                           "</option>"+ 
                           "<?php } ?>"+
                        "</select>"+
                        "<input type='text' class='form-control col-lg-2 text-xs' name='txtQuantity[]' placeholder='Committed Quantity' onkeyup='this.value = this.value.toUpperCase();'>"+
                        "<?php  $query_unitDENR = $dbConn->query("SELECT * FROM ref_unit"); ?>"+
                        "<select class='form-control col-lg-1' name='txtUnit[]' placeholder='Unit'>"+
                        "<option value='' selected >SELECT UNIT</option>"+
                        "<?php while($rowUnitDENR = mysqli_fetch_assoc($query_unitDENR)) { ?>"+
                        "<option value='<?php echo $rowUnitDENR['UNIT']; ?>'>"+
                        "<?php echo $rowUnitDENR['UNIT']; ?>"+
                        "</option>"+
                        "<?php } ?>"+
                        "<input type='text' class='form-control col-lg-2 text-xs' name='txtBudget[]' placeholder='Financial Target (000)' onkeyup='this.value = this.value.toUpperCase();'>"+
                        "<input type='button' class='btn btn-sm btn-danger col-lg-1' value='REMOVE' onclick=remove_filedenr(this);></div>");
                  }

            function remove_filedenr(ele)
            {
             $(ele).parent().remove();
            }
            //END DENR

             //DILG
              function add_filedilg()
                  {
                     $('#file_divdilg').append("<div class='col-lg-12 form-inline m-0 mt-1 p-0 pt-1 border-top'>"+
                        "<?php
                           $get_User = $dbConn->query("SELECT * FROM tbl_user WHERE USERID = '$userid'");
                           while($row_user = mysqli_fetch_assoc($get_User)) {
                        ?>"+
                        "<input type='hidden' name='INFO_OFFICE' value='<?php echo $row_user['INFO_OFFICE'] ?>'>"+
                        "<input type='hidden' name='INFO_USERNAME' value='<?php echo $row_user['INFO_USERNAME']?>'>"+
                        "<input type='hidden' name='INFO_ACCESSLEVEL' value='<?php echo $row_user['INFO_ACCESSLEVEL'] ?>'>"+
                        "<?php } ?>"+
                        "<input type='hidden' name='SID' value='<?php echo $SID; ?>'>"+
                        "<input type='hidden' name='MainDepartment' class='MainDepartment'>"+
                        "<select name='txtMainoff[]' class='form-control form-control-sm col-lg-2' id='off_select'>"+
                           "<option value='' selected >SELECT OFFICE</option>"+
                           "<?php foreach($ref_off_infodilg as $off_infodilg) { ?>"+
                           "<option value='<?php echo $off_infodilg; ?>'><?php echo rtrim($off_infodilg,'.4');?></option>"+
                           "<?php } ?>"+                              
                        "</select> "+
                        "<?php $getProgram = $dbConn->query("SELECT * FROM ref_programs WHERE PROGRAM_CODE = 'DILG'");?>"+
                        "<select class='form-control col-lg-2 text-xs' name='txtParticulars[]' placeholder='Program/Project Classification'>"+
                           "<option value='' selected >SELECT PROGRAM</option>"+
                           "<?php while($rowProgram = mysqli_fetch_assoc($getProgram)) { ?>"+
                           "<option value='<?php echo $rowProgram['PROGRAM_DESC']; ?>'>"+
                           "<?php echo $rowProgram['PROGRAM_DESC']; ?>"+
                           "</option>"+ 
                           "<?php } ?>"+
                        "</select>"+
                        "<?php $getInter = $dbConn->query("SELECT * FROM ref_intervention WHERE OFFICE_CODE = 'DILG'");?>"+
                        "<select class='form-control col-lg-2 text-xs' name='txtIntervention[]'>"+
                           "<option value='' selected >SELECT INTERVENTION</option>"+
                           "<?php while($rowInter = mysqli_fetch_assoc($getInter)) { ?>"+
                           "<option value='<?php echo $rowInter['INTERVENTION_DESC']; ?>'>"+
                           "<?php echo $rowInter['INTERVENTION_DESC']; ?>"+
                           "</option>"+ 
                           "<?php } ?>"+
                        "</select>"+
                        "<input type='text' class='form-control col-lg-2 text-xs' name='txtQuantity[]' placeholder='Committed Quantity' onkeyup='this.value = this.value.toUpperCase();'>"+
                        "<?php  $query_unitDILG = $dbConn->query("SELECT * FROM ref_unit"); ?>"+
                        "<select class='form-control col-lg-1' name='txtUnit[]' placeholder='Unit'>"+
                        "<option value='' selected >SELECT UNIT</option>"+
                        "<?php while($rowUnitDILG = mysqli_fetch_assoc($query_unitDILG)) { ?>"+
                        "<option value='<?php echo $rowUnitDILG['UNIT']; ?>'>"+
                        "<?php echo $rowUnitDILG['UNIT']; ?>"+
                        "</option>"+
                        "<?php } ?>"+
                        "<input type='text' class='form-control col-lg-2 text-xs' name='txtBudget[]' placeholder='Financial Target (000)' onkeyup='this.value = this.value.toUpperCase();'>"+
                        "<input type='button' class='btn btn-sm btn-danger col-lg-1' value='REMOVE' onclick=remove_filedilg(this);></div>");
                  }

            function remove_filedilg(ele)
            {
             $(ele).parent().remove();
            }
            //END DILG

              //OTHER
              function add_fileother()
                  {
                     $('#file_divother').append("<div class='col-lg-12 form-inline m-0 mt-1 p-0 pt-1 border-top'>"+
                        "<?php
                           $get_User = $dbConn->query("SELECT * FROM tbl_user WHERE USERID = '$userid'");
                           while($row_user = mysqli_fetch_assoc($get_User)) {
                        ?>"+
                        "<input type='hidden' name='INFO_OFFICE' value='<?php echo $row_user['INFO_OFFICE'] ?>'>"+
                        "<input type='hidden' name='INFO_USERNAME' value='<?php echo $row_user['INFO_USERNAME']?>'>"+
                        "<input type='hidden' name='INFO_ACCESSLEVEL' value='<?php echo $row_user['INFO_ACCESSLEVEL'] ?>'>"+
                        "<?php } ?>"+
                        "<input type='hidden' name='SID' value='<?php echo $SID; ?>'>"+
                        "<input type='hidden' name='MainDepartment' class='MainDepartment'>"+
                        "<select name='txtMainoff[]' class='form-control form-control-sm col-lg-2' id='off_select'>"+
                           "<option value='' selected >SELECT OFFICE</option>"+
                           "<?php foreach($ref_off_infoother as $off_infoother) { ?>"+
                           "<option value='<?php echo $off_infoother; ?>'><?php echo rtrim($off_infoother,'.5');?></option>"+
                           "<?php } ?>"+                              
                        "</select> "+
                        "<?php $getProgram = $dbConn->query("SELECT * FROM ref_programs WHERE PROGRAM_CODE = 'OTHER'");?>"+
                        "<select class='form-control col-lg-2 text-xs' name='txtParticulars[]' placeholder='Program/Project Classification'>"+
                           "<option value='' selected >SELECT PROGRAM</option>"+
                           "<?php while($rowProgram = mysqli_fetch_assoc($getProgram)) { ?>"+
                           "<option value='<?php echo $rowProgram['PROGRAM_DESC']; ?>'>"+
                           "<?php echo $rowProgram['PROGRAM_DESC']; ?>"+
                           "</option>"+ 
                           "<?php } ?>"+
                        "</select>"+
                        "<input type='text' class='form-control col-lg-2 text-xs' name='txtIntervention[]' placeholder='Specific Intervention' onkeyup='this.value = this.value.toUpperCase();'>"+
                        "<input type='text' class='form-control col-lg-2 text-xs' name='txtQuantity[]' placeholder='Committed Quantity' onkeyup='this.value = this.value.toUpperCase();'>"+
                        "<?php  $query_unitother = $dbConn->query("SELECT * FROM ref_unit"); ?>"+
                        "<select class='form-control col-lg-1' name='txtUnit[]' placeholder='Unit'>"+
                        "<option value='' selected >SELECT UNIT</option>"+
                        "<?php while($rowUnitother = mysqli_fetch_assoc($query_unitother)) { ?>"+
                        "<option value='<?php echo $rowUnitother['UNIT']; ?>'>"+
                        "<?php echo $rowUnitother['UNIT']; ?>"+
                        "</option>"+
                        "<?php } ?>"+
                        "<input type='text' class='form-control col-lg-2 text-xs' name='txtBudget[]' placeholder='Financial Target (000)' onkeyup='this.value = this.value.toUpperCase();'>"+
                        "<input type='button' class='btn btn-sm btn-danger col-lg-1' value='REMOVE' onclick=remove_fileother(this);></div>");
                  }

            function remove_fileother(ele)
            {
             $(ele).parent().remove();
            }
            //END OTHER
    </script>


               
            
               
