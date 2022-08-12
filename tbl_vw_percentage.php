<!DOCTYPE html>
<html>
<head>
<?php include('head.html'); ?>
<?php include('session.php'); ?>

</head>
<body>
  <?php include('sidebar.php');?>
  <?php include('menu.php');?>

<?php  
 if($rowUserInfo["INFO_ACCESSLEVEL"] == 'ENCODER'){ 
	$resultprofca = $dbConn->query("SELECT tbl_profilingca.SID, tbl_profilingca.INFO_TF_TO, tbl_profilingca.INFO_CON_TYPE,tbl_profilingca.INFO_NAME, 
   tbl_interventions.INFO_MAIN, tbl_interventions.INFO_INTERVENTION, tbl_interventions.INFO_PARTICULARS, tbl_interventions.INFO_YEAR, tbl_interventions.INFO_OFFICE, 
   tbl_profilingca.INFO_OFFICE, tbl_interventions.INFO_AGENCY, tbl_profilingca.INFO_AGENCY FROM tbl_profilingca INNER JOIN tbl_interventions 
   ON tbl_profilingca.SID=tbl_interventions.SID WHERE tbl_profilingca.INFO_STAT_AF is NULL AND tbl_interventions.INFO_STAT_AF is NULL 
   AND tbl_interventions.INFO_AGENCY='$agency' AND tbl_profilingca.INFO_AGENCY='$agency' GROUP BY tbl_interventions.SID");  
 }
 if($rowUserInfo["INFO_ACCESSLEVEL"] == 'ADMINISTRATOR'){ 
	$resultprofca = $dbConn->query("SELECT tbl_profilingca.SID, tbl_profilingca.INFO_TF_TO, tbl_profilingca.INFO_CON_TYPE,tbl_profilingca.INFO_NAME, 
   tbl_interventions.INFO_MAIN, tbl_interventions.INFO_INTERVENTION, tbl_interventions.INFO_PARTICULARS, tbl_interventions.INFO_YEAR, tbl_interventions.INFO_OFFICE, 
   tbl_profilingca.INFO_OFFICE, tbl_interventions.INFO_AGENCY, tbl_profilingca.INFO_AGENCY FROM tbl_profilingca INNER JOIN tbl_interventions 
   ON tbl_profilingca.SID=tbl_interventions.SID WHERE tbl_profilingca.INFO_STAT_AF is NULL AND tbl_interventions.INFO_STAT_AF is NULL 
   AND tbl_interventions.INFO_AGENCY='$agency' AND tbl_profilingca.INFO_AGENCY='$agency' GROUP BY tbl_interventions.SID");  
 }
?>

<div class="col-lg-12 bg-white border p-3">
        <div class="form-row">
            <div class="col-lg-11">
                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Status of Interventions</h1>
                <hr 999/>
            </div>
        </div>
		  
		<div class="form-row mt-3">
			<div class="col-lg-12">
				<!-- Data Table -->
				<div class="demo-html">
			
					<table id="datatable" class="table-bordered display text-xs" style="width:100%;">
						<thead class="bg-accent text-xs">
							<tr style="color:white;background-color: #3f72af;">
                        <th>Convergence Area Name</th>  
                        <th>Office</th>
                        <th>Intervention</th>
                        <th>Particulars</th>
                        <th>Action</th>
							</tr>
						</thead>
						
						<tbody>
							<?php while($rowresult = mysqli_fetch_assoc($resultprofca)){ 
										$SID = $rowresult['SID'];
									?>
								  <td class="d-sm-table-cell"><?php echo $rowresult['INFO_NAME'];?></td>
                        <td class="d-sm-table-cell" >
                              <?php 
                              if($rowresult['INFO_MAIN']=='DEPARTMENT OF AGRICULTURE'){ echo $rowresult['INFO_MAIN'];}
                              elseif($rowresult['INFO_MAIN']=='DEPARTMENT OF AGRARIAN REFORM'){ echo $rowresult['INFO_MAIN'];}
                              elseif($rowresult['INFO_MAIN']=='DEPARTMENT OF ENVIRONMENT AND NATURAL RESOURCES'){ echo $rowresult['INFO_MAIN'];}
                              elseif($rowresult['INFO_MAIN']=='DEPARTMENT OF THE INTERIOR AND LOCAL GOVERNMENT'){ echo $rowresult['INFO_MAIN'];}
                              else{ echo rtrim($rowresult['INFO_MAIN'],".5");}
                              ?>
                        </td>

                        <td class="d-sm-table-cell" ><?php echo $rowresult['INFO_INTERVENTION'];?></td>
                        
                        <td class="d-sm-table-cell"><?php echo $rowresult['INFO_PARTICULARS'];?></td>
                        <td>
                           <a href="vw_intervention_percentage.php?SID=<?php echo $rowresult['SID'];?>" class="btn btn-sm btn-outline-success text-xs form-control form-control-sm border">
                           <i class="fas fa-eye fa-green"></i>
                        </a>
                        </td>
								</tr >
							<?php }?>
                            
						</tbody>    
					</table>
				</div>	
			</div>
	   </div>
	   

	</div>
</div>




<?php include('footer.html'); ?></body>
</html>
