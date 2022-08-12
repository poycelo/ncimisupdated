<!DOCTYPE>
<html>
<head>
<?php include('head.html');?>
<?php include('session.php');?>

<style type="text/css">
      #loader{
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('img/loading.gif') 50% 50% no-repeat rgb(249,249,249);
        opacity: 1;
    }
 </style>

</head>
<!-- <div id="loader"></div> -->
<body>
  <?php include('sidebar.php');?>
  <?php include('menu.php');?>
 
<?php 
 if($rowUserInfo["INFO_ACCESSLEVEL"] == 'ENCODER'){ 
   $resultprofca = $dbConn->query("SELECT * FROM tbl_profilingca WHERE INFO_USER='$userid' AND INFO_STAT_AF = 'For Review' GROUP BY `SID`"); 
  }elseif($rowUserInfo["INFO_ACCESSLEVEL"]=='VERIFIER'){ 
    $resultprofca = $dbConn->query("SELECT * FROM tbl_profilingca WHERE INFO_AGENCY = '$agency' AND INFO_STAT_AF = 'For Review' GROUP BY `SID`");
  }elseif($rowUserInfo["INFO_ACCESSLEVEL"]=='SECRETARIAT'){
    $resultprofca = $dbConn->query("SELECT * FROM tbl_profilingca WHERE INFO_STAT_AF  = 'For Approval' GROUP BY `SID`"); 
  }elseif($rowUserInfo["INFO_ACCESSLEVEL"]=='VIEWER'){
    $resultprofca = $dbConn->query("SELECT * FROM tbl_profilingca WHERE INFO_AGENCY = '$agency' AND INFO_STAT_AF  = 'Approved' GROUP BY `SID`");; 
  }elseif($rowUserInfo["INFO_ACCESSLEVEL"]=='ADMINISTRATOR'){
    $resultprofca = $dbConn->query("SELECT * FROM tbl_profilingca WHERE INFO_AGENCY = '$agency' AND INFO_STAT_AF is NULL GROUP BY `SID`");
  }
?>

<div class="col-lg-12 bg-white border p-3" >
    <div class="form-row" >
        <div class="col-lg-11">
            <!-- Page Heading -->
            <h3 class="text-gray-800">Convergence Area Profile</h3>
            <hr 999/>
        </div>
        <?php if($rowUserInfo["INFO_ACCESSLEVEL"] == 'ENCODER'){ ?>
            <div class="col-lg-1">
              <a href="frm_profilingca.php" class="btn btn-sm btn-primary">
                <i class="fas fa-plus fa-xs"></i>
                Add Profile
              </a>
            </div>
          <?php }?>
    </div>
  
    <div class="form-row mt-5">
      <div class="col-lg-12">
        <!-- Data Table -->
          <table id="datatable" class="table-bordered display text-xs" style="width:100%;">
						<thead class="bg-accent text-xs">
							<tr>
                  <th class="d-sm-table-cell">ACTIONS</th> 
                  <th class="d-sm-table-cell">CONVERGENCE TYPE</th>
                  <th class="d-sm-table-cell">CONVERGENCE AREA NAME</th>  
                  <th class="d-none d-sm-table-cell">REGION</th>
                  <th class="d-none d-sm-table-cell">PROVINCE</th>
                  <th class="d-none d-sm-table-cell">WATERSHED</th>    
                  <th class="d-none d-sm-table-cell">COMMODITIES</th>  
                  <th class="d-none d-sm-table-cell">FROM-TO</th>  
                  <th class="d-none d-sm-table-cell">STATUS</th>  
                  <th class="d-none d-sm-table-cell">REMARKS</th>  
                  <!-- <th>OFFICE</th> -->
							</tr>
						</thead>
						
						<tbody>
                  <?php 
                    while($rowresult = mysqli_fetch_assoc($resultprofca)){ 
                    $SID = $rowresult['SID'];
                    
                    
                    // Convert PSGC code to Location Names
                    $geocode = $rowresult['INFO_REGION'];
                    $getLocation = $dbConn->query("SELECT * FROM psgc_region WHERE psgc_code LIKE '$geocode%'");
                    $rowLocation = mysqli_fetch_assoc($getLocation);          

                    //PROVINCE
                    $provCode = $rowresult['INFO_PROV'];
                    $getProv = $dbConn->query("SELECT * FROM psgc_provinces WHERE Code LIKE '$provCode%'");
                    $rowProv = mysqli_fetch_assoc($getProv); 
									?>
								<tr>
                  <td class="d-sm-table-cell">
                      <form method="post" action="export_excel.php?SID=<?php echo $rowresult['SID'];?>">
                        <input type="submit" name="export" class="btn btn-sm btn-secondary text-xs form-control form-control-sm border" value="Export">
                      </form>

                      <?php if($rowUserInfo['INFO_ACCESSLEVEL']=='ENCODER'){?>
                        <a href="vw_profilinginfo.php?SID=<?=$rowresult['SID'];?>" class="btn btn-sm btn-success  border">
                          <i class="fas fa-eye fa-xs fa-white"></i>
                          View
                        </a>  
                      <?php }?>
                      <?php if($rowUserInfo['INFO_ACCESSLEVEL']=='VERIFIER'){?>
                        <a href="ver_frm_appflag.php?SID=<?=$rowresult['SID'];?>" class="btn btn-sm btn-success border">
                        <i class="fas fa-eye fa-xs fa-white"></i>
                        View
                        </a>
                      <?php }?>
                      <?php if($rowUserInfo['INFO_ACCESSLEVEL']=='SECRETARIAT'){?>
                        <a href="sec_frm_appflag.php?SID=<?=$rowresult['SID'];?>" class="btn btn-sm btn-success border">
                        <i class="fas fa-eye fa-xs fa-white"></i>
                        View
                        </a>
                      <?php }?>
                      <?php if($rowUserInfo['INFO_ACCESSLEVEL']=='VIEWER'){?>
                        <a href="tbl_approved.php?SID=<?=$rowresult['SID'];?>" class="btn btn-sm btn-success border">
                        <i class="fas fa-eye fa-xs fa-white"></i>
                        View
                        </a>
                      <?php }?>
                      <?php if($rowUserInfo['INFO_ACCESSLEVEL']=='ADMINISTRATOR'){?>
                        <a href="ver_frm_appflag.php?SID=<?=$rowresult['SID'];?>" class="btn btn-sm btn-success border">
                        <i class="fas fa-eye fa-xs fa-white"></i>
                        View
                        </a>
                      <?php }?>
                  </td>

									<td><?=$rowresult['INFO_CON_TYPE'];?></td>
										
									<td><?=$rowresult['INFO_NAME'];?></td>   
									
                  <td class="d-none d-sm-table-cell"><?=$rowLocation['name'];?></td> 

									<td class="d-none d-sm-table-cell"><?=$rowProv['Province'];?></td>  

									<td class="d-none d-sm-table-cell">
                  <?php 
                    $ws_name = '';
                    $ws_name = explode(",", $rowresult['INFO_WATERSHED']);
                    $wsn = '';
                    foreach($ws_name as $name_ws) {
                        //echo $municipality = trim($municipality) . '<br/>';
                        $getws = $dbConn->query("SELECT * FROM ref_watershed WHERE `WS_CODE`=$name_ws");
                        $rowws = mysqli_fetch_assoc($getws);
                      
                    
                        echo $rowws['NAME_WATERSHED'] .',';
                    }    echo $rowresult['INFO_WATERSHED_OTHERS'];
                  
                    
                    ?>
									</td>

									<td class="d-none d-sm-table-cell">
                  <?php 
										
                    $comm = '';
                    $comm = explode(",", $rowresult['INFO_COMMODITIES']);
                    foreach($comm as $commo) {
                      $getcomm = $dbConn->query("SELECT * FROM ref_priority_commodities WHERE PC_CODE='$commo'");
                      $rowcomm = mysqli_fetch_assoc($getcomm);
                      
                      echo $rowcomm['PC_DESC'] .',';
                    } echo $rowresult['INFO_COMM_LIVESTOCK'].','.$rowresult['INFO_COMM_POULTRY'].','.$rowresult['INFO_COMM_OTHERS'];
                  ?>
                    
                  
									</td>
										
                    <td class="d-none d-sm-table-cell"><?=$rowresult['INFO_TF_FROM'].'-'.$rowresult['INFO_TF_TO'];?></td>   
										
                    <td class="d-none d-sm-table-cell">
                      <?php if($rowresult['INFO_STATUS']==''){echo "N/A";}
                      else{ echo $rowresult["INFO_STATUS"];};?>
                    </td> 
										
                    <td class="d-none d-sm-table-cell"><?=$rowresult['INFO_REMARKS'];?></td>
                    
                  
								</tr >
							<?php }?>
						</tbody>    
					</table>
        </div>
      </div>
    </div>
</div>


<script type="text/javascript">
  $(window).on('load', function(){
    //you remove this timeout
    setTimeout(function(){
          $('#loader').fadeOut('slow');  
      });
      //remove the timeout
      //$('#loader').fadeOut('slow'); 
  });
</script>

<?php include('footer.html'); ?></body>
</html>
