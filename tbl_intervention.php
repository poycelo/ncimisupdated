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
	$resultprofca = $dbConn->query("SELECT * fROM tbl_profilingca WHERE INFO_USER = '$userid' AND INFO_STAT_AF is NULL GROUP BY SID"); 


    // $resultprofca = $dbConn->query("SELECT 
    // tbl_profilingca.SID,tbl_profilingca.INFO_CON_TYPE,tbl_profilingca.INFO_NAME,tbl_profilingca.INFO_REGION,tbl_profilingca.INFO_PROV,tbl_profilingca.INFO_MUN,
    // tbl_profilingca.INFO_WATERSHED,tbl_profilingca.INFO_TF_FROM,tbl_profilingca.INFO_TF_TO,tbl_profilingca.INFO_STATUS,tbl_profilingca.INFO_COMMODITIES,
    // tbl_profilingca.INFO_REMARKS ,tbl_profilingca.INFO_STAT_AF,tbl_profilingca.INFO_USER,tbl_profilingca.ATTACHED_FILENAME, tbl_vmgob.INFO_VISION, tbl_vmgob.INFO_MISSION,tbl_vmgob.INFO_GOAL,tbl_vmgob.INFO_OBJECTIVE,tbl_vmgob.INFO_BRIEF_DESC, 
    // tbl_interventions.INFO_MAIN, tbl_interventions.INFO_INTERVENTION, tbl_interventions.INFO_PARTICULARS, tbl_interventions.INFO_COMM_QUANTITY, tbl_interventions.INFO_UNIT, tbl_interventions.INFO_COMM_BUDGET
    // FROM   tbl_profilingca
    //        INNER JOIN tbl_interventions
    //                ON tbl_profilingca.SID= tbl_interventions.SID
    //        INNER JOIN tbl_vmgob
    //                ON tbl_interventions.SID = tbl_vmgob.SID WHERE tbl_profilingca.INFO_USER = '$userid' AND tbl_profilingca.INFO_STAT_AF is NULL GROUP BY tbl_profilingca.SID"); 
 }
 elseif($rowUserInfo["INFO_ACCESSLEVEL"] == 'ADMINISTRATOR'){ 
	$resultprofca = $dbConn->query("SELECT * fROM tbl_profilingca WHERE INFO_USER = '$userid' AND INFO_STAT_AF is NULL GROUP BY SID"); 

    // $resultprofca = $dbConn->query("SELECT 
    // tbl_profilingca.SID,tbl_profilingca.INFO_CON_TYPE,tbl_profilingca.INFO_NAME,tbl_profilingca.INFO_REGION,tbl_profilingca.INFO_PROV,tbl_profilingca.INFO_MUN,
    // tbl_profilingca.INFO_WATERSHED,tbl_profilingca.INFO_TF_FROM,tbl_profilingca.INFO_TF_TO,tbl_profilingca.INFO_STATUS,tbl_profilingca.INFO_COMMODITIES,
    // tbl_profilingca.INFO_REMARKS ,tbl_profilingca.INFO_STAT_AF,tbl_profilingca.INFO_USER,tbl_profilingca.ATTACHED_FILENAME, tbl_vmgob.INFO_VISION, tbl_vmgob.INFO_MISSION,tbl_vmgob.INFO_GOAL,tbl_vmgob.INFO_OBJECTIVE,tbl_vmgob.INFO_BRIEF_DESC, 
    // tbl_interventions.INFO_MAIN, tbl_interventions.INFO_INTERVENTION, tbl_interventions.INFO_PARTICULARS, tbl_interventions.INFO_COMM_QUANTITY, tbl_interventions.INFO_UNIT, tbl_interventions.INFO_COMM_BUDGET
    // FROM   tbl_profilingca
    //        INNER JOIN tbl_interventions
    //                ON tbl_profilingca.SID= tbl_interventions.SID
    //        INNER JOIN tbl_vmgob
    //                ON tbl_interventions.SID = tbl_vmgob.SID WHERE tbl_profilingca.INFO_STAT_AF is NULL GROUP BY tbl_profilingca.SID"); 
 }
?>

<div class="col-lg-12 bg-white border p-3">
    <div class="form-row">
        <div class="col-lg-11">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">List of Interventions</h1>
            <hr 999/>
        </div>
    </div>
  
    <div class="form-row mt-3">
      <div class="col-lg-12">
        <!-- Data Table -->
        <div class="demo-html">
          <table id="datatable" class="table-bordered display text-xs" style="width:100%;">
						<thead class="bg-accent text-xs">
							<tr style="color:white;background-color: #0e918c;">
								<th class="d-sm-table-cell">CONVERGENCE TYPE</th>
								<th class="d-sm-table-cell">CONVERGENCE AREA NAME</th>  
								<th class="d-sm-table-cell">PROVINCE</th>
								<th class="d-sm-table-cell">WATERSHED</th>    
								<th class="d-sm-table-cell">STATUS</th>
								<th class="d-sm-table-cell">COMMODITIES</th>  
                <th class="d-sm-table-cell">ACTIONS</th> 
                 
							</tr>
						</thead>
						
						<tbody>
							<?php while($rowresult = mysqli_fetch_assoc($resultprofca)){ 
										$SID = $rowresult['SID'];
									?>
									<?php               

											//   PROVINCE
											$provCode = $rowresult['INFO_PROV'];
											$getProv = $dbConn->query("SELECT * FROM psgc_provinces WHERE Code LIKE '$provCode%'");
											$rowProv = mysqli_fetch_assoc($getProv);                 
									?>
								<tr>
									<td><?=$rowresult['INFO_CON_TYPE'];?></td>
										
									<td><?=$rowresult['INFO_NAME'];?></td>   
									
									<td><?=$rowProv['Province'];?></td>  

									<td>
										<?php 
										
											$wat = '';
											$wat = explode(",", $rowresult['INFO_WATERSHED']);
											foreach($wat as $watss) {
												$getwat = $dbConn->query("SELECT * FROM ref_watershed WHERE WS_CODE='$watss'");
												$rowwat = mysqli_fetch_assoc($getwat);
												
												echo $rowwat['NAME_WATERSHED'] .', ';
											}
										?>
									</td>

									<td class="d-sm-table-cell">
                      <?php if($rowresult['INFO_STATUS']==''){echo "N/A";}
                      else{ echo $rowresult["INFO_STATUS"];};?>
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

									<td class="d-sm-table-cell">
                      <a href="frm_profilingcainfo.php?SID=<?=$rowresult['SID'];?>" class="btn btn-sm btn-outline-success text-xs form-control form-control-sm border">
											<i class="fas fa-eye"></i>
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




<?php include('footer.html'); ?></body>
</html>
