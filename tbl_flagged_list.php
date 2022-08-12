<!DOCTYPE>
<html>
<head>
<?php include('head.html');?>
<?php include('session.php');?>

</head>
<body>
  <?php include('sidebar.php');?>
  <?php include('menu.php');?>
  

<?php 
 $DATEFROM   = $_REQUEST['DATEFROM'];
 $DATETO     = $_REQUEST['DATETO'];
 
if($rowUserInfo['INFO_ACCESSLEVEL']=='ENCODER'){
	$resultprofca = $dbConn->query("SELECT * FROM tbl_profilingca WHERE INFO_TF_FROM ='$DATEFROM' AND INFO_TF_TO='$DATETO' AND  INFO_USER = '$userid' AND INFO_STAT_AF ='Flagged' GROUP BY `SID`");
}

elseif($rowUserInfo['INFO_ACCESSLEVEL']=='VERIFIER'){
	$resultprofca = $dbConn->query("SELECT * FROM tbl_profilingca WHERE INFO_TF_FROM ='$DATEFROM' AND INFO_TF_TO='$DATETO' AND  INFO_AGENCY = '$agency' AND INFO_STAT_AF ='Flagged' GROUP BY `SID`");
}
else{
	
	$resultprofca = $dbConn->query("SELECT * FROM tbl_profilingca WHERE INFO_TF_FROM ='$DATEFROM' AND INFO_TF_TO='$DATETO' AND  INFO_AGENCY = '$agency' AND INFO_STAT_AF ='Flagged' GROUP BY `SID`");
}
 ?>

<div class="container-fluid px-3 py-0">
	<div class="col-lg-12 bg-white border p-3">
      <div class="form-row">
      	<div class="col-lg-12">
	         <!-- Page Heading -->
	         <h4 class="mb-2 text-gray-800">List of Flagged Profiles</h4>
			 <hr 999/>
       	</div>
 		</div>
   	<div class="form-row mt-2">
      	<div class="col-lg-12">
	         <!-- Data Table -->
           <table id="datatable" class="table-bordered display text-xs" style="width:100%;">
						<thead class="bg-accent text-xs">
							<tr style="color:white;background-color: #49657b;">
								<th style="background-color:#f05454;">FLAGGED REMARKS</th>  
								<th>CONVERGENCE TYPE</th>
								<th>CONVERGENCE AREA NAME</th>  
								<th>REGION</th>  
								<th>PROVINCE</th>
								<th>MUNICIPALITY</th>  
								<th>WATERSHED</th>    
								<th>STATUS</th>
								<th>COMMODITIES</th>  
								<th>FROM</th>  
								<th>TO</th>  
								<th>ACTIONS</th>  
							</tr>
						</thead>
						
						<tbody>
							<?php while($rowresult = mysqli_fetch_assoc($resultprofca)){ 
										$SID = $rowresult['SID'];
									?>
									<?php 
											// Convert PSGC code to Location Names
											$geocode = $rowresult['INFO_REGION'];
											$getLocation = $dbConn->query("SELECT * FROM psgc_region WHERE psgc_code LIKE '$geocode%'");
											$rowLocation = mysqli_fetch_assoc($getLocation);                  

											//   PROVINCE
											$provCode = $rowresult['INFO_PROV'];
											$getProv = $dbConn->query("SELECT * FROM psgc_provinces WHERE Code LIKE '$provCode%'");
											$rowProv = mysqli_fetch_assoc($getProv);                 
									?>
								<tr>
									
									<td class="d-sm-table-cell"><?=$rowresult['INFO_STAT_REMARKS'];?></td>
								
									<td><?=$rowresult['INFO_CON_TYPE'];?></td>
										
									<td><?=$rowresult['INFO_NAME'];?></td>   
										
									<td><?=$rowLocation['region_name'];?></td>  
									
									<td><?=$rowProv['Province'];?></td>  
									
									<td>
										<?php 
											$mun = '';
											$mun = explode(",", $rowresult['INFO_MUN']);
											foreach($mun as $muncode) {
												$getmun = $dbConn->query("SELECT * FROM psgc_municipalities WHERE `Code`=$muncode");
												$rowmun = mysqli_fetch_assoc($getmun);
												echo $rowmun['Municipality'] .', ';
											} ?>
									</td>

									<td>
										<?php 
										
											$wat = '';
											$wat = explode(",", $rowresult['INFO_WATERSHED']);
											foreach($wat as $watss) {
												$getwat = $dbConn->query("SELECT * FROM ref_watershed WHERE WS_CODE='$watss'");
												$rowwat = mysqli_fetch_assoc($getwat);
												
												echo $rowwat['NAME_WATERSHED'] .', ';
											}  echo $rowresult['INFO_WATERSHED_OTHERS'];
										?>
									</td>

									<td class="d-sm-table-cell"><?=$rowresult['INFO_STATUS'];?></td>

									<td>
										<?php 
										
											$comm = '';
											$comm = explode(",", $rowresult['INFO_COMMODITIES']);
											foreach($comm as $commo) {
												$getcomm = $dbConn->query("SELECT * FROM ref_priority_commodities WHERE PC_CODE='$commo'");
												$rowcomm = mysqli_fetch_assoc($getcomm);
												
												echo $rowcomm['PC_DESC'] .', ';
											} echo $rowresult['INFO_COMM_LIVESTOCK'].','.$rowresult['INFO_COMM_POULTRY'].','.$rowresult['INFO_COMM_OTHERS'];
										?>
									</td>

									<td class="d-sm-table-cell"><?=$rowresult['INFO_TF_FROM'];?></td>
									
									<td class="d-sm-table-cell"><?=$rowresult['INFO_TF_TO'];?></td>

									<td class="d-sm-table-cell">
									<a href="vw_flagged.php?SID=<?php echo $rowresult['SID'];?>" class="btn btn-outline-success text-xs form-control form-control-sm border">
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




<?php include('footer.html'); ?></body>
