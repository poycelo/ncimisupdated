<?php include('head.html'); ?>
<?php include('session.php'); ?>
<body>
<?php include('sidebar.php');?>
<?php include('menu.php');?>

<?php
// print_r("hello");
$SID   = $_REQUEST['SID'];
$query = $dbConn->query("SELECT * FROM tbl_profilingca WHERE SID = '$SID'");
$row   = mysqli_fetch_assoc($query);


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
               <a class="btn btn-sm btn-success" href="frm_profilingca_edit.php?SID=<?php echo $row['SID']; ?>">
                  <i class="fas fa-pen fa-xs mr-2"></i>
                  Update
               </a>
               <input type="hidden" name="ID" value="<?php echo $ID=$row['SID']; ?>">
               <a data-toggle="modal" data-id="<?php echo $ID; ?>"  class="open-AddBookDialog" href="#upload"><button type="button" class="btn btn-sm btn-primary">Upload PDF File</button></a>
               </a>

            <?php }?>
         </div> 
      </div>
      <!-- Start of Data -->
      <div style="font-size: 0.9rem; font-family:Calibri;">
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
                  //  $wsn .= $rowws['NAME_WATERSHED'];
              
                   echo $rowws['NAME_WATERSHED'].' ,';
               }
                   echo $row['INFO_WATERSHED_OTHERS'];
               ?>
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
                  $getComm = $dbConn->query("SELECT * FROM ref_priority_commodities WHERE PC_CODE='$commo'");
                  $rowComm = mysqli_fetch_assoc($getComm);
                  $commoo .= $rowComm['PC_DESC'] . ' ,';
                 
              } echo rtrim($commoo,',');?>
              <?=$row['INFO_COMM_LIVESTOCK']. ',';?> 
              <?=$row['INFO_COMM_POULTRY'] . ',';?> 
              <?=$row['INFO_COMM_OTHERS'];?> 
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
         <div class="form-row mt-3">
            <div class="col-lg-12">
               <!-- Page Heading -->
               <h1 class="h5 mb-2 text-gray-800">Vision, Mission, etc.</h1>
            </div>
         </div>
         <div class="form-row word-wrap border border-top-0">
            <div class="col-lg-2 p-2 bg-label">
               Vision
            </div>
            <div class="col-lg-10 p-2">
               <?=$row['INFO_VISION'];?>
            </div>
         </div>
         <div class="form-row border border-top-0">
            <div class="col-lg-2 p-2 bg-label">
               Mission
            </div>
            <div class="col-lg-10 p-2">
               <?=$row['INFO_MISSION'];?>
            </div>
         </div>
         <div class="form-row border border-top-0">
            <div class="col-lg-2 p-2 bg-label">
               Goal
            </div>
            <div class="col-lg-10 p-2">
               <?=nl2br($row['INFO_GOAL']);?>
            </div>
         </div>
         <div class="form-row border border-top-0">
            <div class="col-lg-2 p-2 bg-label">
               Objective
            </div>
            <div class="col-lg-10 p-2">
               <?=nl2br($row['INFO_OBJECTIVE']);?>
            </div>
         </div>
         <div class="form-row border border-top-0">
            <div class="col-lg-2 p-2 bg-label">
               Brief Description
            </div>
            <div class="col-lg-10 p-2">
               <?=$row['INFO_BRIEF_DESC'];?>
            </div>
         </div>   
         
         


	<!-- MODAL FOR PROJECT OBJECTIVES AND OUTCOMES-->
   <div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-l" role="document">
    <div class="modal-content">
      <!-- MODAL HEADER - START -->
      <div class="modal-header"><h4 class="modal-title info-name">Upload File</h4></div>           
      <!-- MODAL HEADER - END -->
      <!-- MODAL BODY - START -->
        <div class="modal-body modal-bg">
            <div class="row justify-content-center">        
            <form action="func_pdfUpload.php" method="post" enctype="multipart/form-data">
              <div class="modal-body modal-bg">
                  <div class="row justify-content-center">        
                  <input type="file" name="file" size="50"/>
                  <input type="text" name="ID" value="<?php echo $ID; ?>" hidden/>  
                  <input type="submit" value="Upload" />
                  </div>
              </div> 

              <!-- MODAL BODY - END -->
            
            </form> 
            </div>
        </div> 
        <!-- MODAL BODY - END -->
        <!-- MODAL FOOTER - START -->
               <div class="modal-footer">
                  <div class="form-group">
                      <?php $check = $row['ATTACHED_FILENAME']; if($check<>'N/A'){ ?><a data-toggle="modal" data-target="#projDocOpen" href="#projDocOpen">
                       <button type="submit" class="btn btn-success" data-dismiss="modal"><span class="fas fa-folder-open mr-2"></span>View Uploaded Document<?php //echo $SID; ?></button></a>
                       <?php } ?>         
                        <button type="submit" class="btn btn-secondary" data-dismiss="modal"><span class="fas fa-close mr-2"></span>Close</button>
                 </div>
               </div> <!-- end of modal-footer       -->
    </div>     <!-- end of modal-content      -->
  </div>       <!-- end of modal-dialog       -->
</div>         <!-- end of modal-suspended    -->
<!-- MODAL FOR PROJECT OBJECTIVES AND OUTCOMES-->

<!-- OPEN PDF -->
<div class="modal fade" id="projDocOpen" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <!-- MODAL HEADER - START -->
            <div class="modal-header"><h4 class="modal-title info-name">View Project Document:</h4></div>           
            <!-- MODAL HEADER - END -->
            <!-- MODAL BODY - START -->
              <?php $docs = 'uploads/'. $row['ATTACHED_FILENAME']; ?>
              <?php
                echo '<embed src="' . $docs . '" frameborder="0" width="100%" height="800px">' ;
              ?>
              

              <!-- MODAL BODY - END -->
              <!-- MODAL FOOTER - START -->
              <div class="modal-footer">
                <div class="form-group">
                   <button type="submit" class="btn btn-secondary" data-dismiss="modal"><span class="fas fa-close mr-2"></span>Close</button>
                </div>
              </div> <!-- end of modal-footer       -->
          </div>
        </div>       <!-- end of modal-dialog       -->
      </div>         <!-- end of modal-suspended    -->
<!-- OPEN PDF -->



<?php include('footer.html'); ?>     

</body> 

    

               
            
               
