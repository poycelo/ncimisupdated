<?php include('head.html');?>
<body>
<!-- Filter Dashboard -->


<?php
$msg = $_REQUEST['msg'];
if($msg=='1'){
   $msgInfo = '<div class="alert alert-success" role="alert">
               	Data have been successfully processed.
               </div>';
}else{
   $msgInfo=NULL;
}

if(isset($_POST['btnprocess'])){
	$regcode = $_POST['region_code'];

	$getEntries = $dbConn->query('SELECT * FROM tbl_profilingca WHERE region_code LIKE "'.$regcode.'%"  ORDER BY region_code');

	while($rowEntries = mysqli_fetch_assoc($getEntries)){
		$getRegion = $dbConn->query('SELECT * FROM psgc_region WHERE psgc_code LIKE "'.$regcode.'%"');
		$rowRegion = mysqli_fetch_assoc($getRegion);

		// $getPSGC = $dbConn->query('SELECT * FROM vw_consolidated_psgc WHERE brg_code="'.$rowEntries['region_code'].'"');
		// $rowPSGC = mysqli_fetch_assoc($getPSGC);

		$dbConn->query('UPDATE tbl_profilingca SET region_code="'.$rowRegion['name'].'" WHERE region_code="'.$rowEntries['region_code'].'"');
	}
	echo "<script>window.location = 'test_reg.php?msg=1';</script>";
}
?>
<div class="container-fluid">
	<!-- page heading -->
	<div class="row">
		<div class="col-lg-12">
			<div class="p-3 rounded-top"style="font-size: small; background-color: #383838;">
				<div class="d-sm-flex align-items-center justify-content-between">
			      <h1 class="h5 mb-0 text-white text-left">Update Enterprise Profiles PSGC Information</h1>
			   </div>
			</div>
			<div class="bg-white p-3 bg-light border rounded-bottom">
				<?=$msgInfo;?>

	   		<?php $getTally = $dbConn->query('SELECT  COUNT(case when region_code LIKE "13%"  then 1 end) as cntReg13,
                                                        COUNT(case when region_code LIKE "14%"  then 1 end) as cntReg14,  
                                                        COUNT(case when region_code LIKE "01%"  then 1 end) as cntReg01, 
                                                        COUNT(case when region_code LIKE "02%"  then 1 end) as cntReg02,
                                                        COUNT(case when region_code LIKE "03%"  then 1 end) as cntReg03,
                                                        COUNT(case when region_code LIKE "04%"  then 1 end) as cntReg04,
                                                        COUNT(case when region_code LIKE "17%"  then 1 end) as cntReg17,
                                                        COUNT(case when region_code LIKE "05%"  then 1 end) as cntReg05,
                                                        COUNT(case when region_code LIKE "06%"  then 1 end) as cntReg06,
                                                        COUNT(case when region_code LIKE "07%"  then 1 end) as cntReg07,
                                                        COUNT(case when region_code LIKE "08%"  then 1 end) as cntReg08,
                                                        COUNT(case when region_code LIKE "09%"  then 1 end) as cntReg09,
                                                        COUNT(case when region_code LIKE "10%"  then 1 end) as cntReg10,
                                                        COUNT(case when region_code LIKE "11%"  then 1 end) as cntReg11,
                                                        COUNT(case when region_code LIKE "12%"  then 1 end) as cntReg12,
                                                        COUNT(case when region_code LIKE "16%"  then 1 end) as cntReg16,
                                                        COUNT(case when region_code LIKE "15%"  then 1 end) as cntReg15
	   														
	   											FROM tbl_profilingca');
	   			$rowTally = mysqli_fetch_assoc($getTally);
	   		?>
	   
	   <form method="post">
	  	<div class="form-row mb-3">
	  		<div class="col-lg-11">
	  			<select  name="region_code" class="form-control form-control-sm" required>
	  				<option value="" disabled selected>Choose One</option>
	  				<?php if($rowTally['cntReg13']!=0){ ?><option value="13">NCR (NATIONAL CAPITAL REGION)</option><?php } ?>
	  				<?php if($rowTally['cntReg14']!=0){ ?><option value="14">CAR (CORDILLERA ADMINISTRATIVE REGION)</option><?php } ?> 
	  				<?php if($rowTally['cntReg01']!=0){ ?><option value="01">REGION I (ILOCOS REGION)</option><?php } ?>
	  				<?php if($rowTally['cntReg02']!=0){ ?><option value="02">REGION II (CAGAYAN VALLEY)</option><?php } ?>
	  				<?php if($rowTally['cntReg03']!=0){ ?><option value="03">REGION III (CENTRAL LUZON)</option><?php } ?>
	  				<?php if($rowTally['cntReg04']!=0){ ?><option value="04">REGION IV-A (CALABARZON)</option><?php } ?>
	  				<?php if($rowTally['cntReg17']!=0){ ?><option value="17">REGION IV-B (MIMAROPA)</option><?php } ?>
	  				<?php if($rowTally['cntReg05']!=0){ ?><option value="05">REGION V (BICOL REGION)</option><?php } ?>
	  				<?php if($rowTally['cntReg06']!=0){ ?><option value="06">REGION VI (WESTERN VISAYAS)</option><?php } ?>
	  				<?php if($rowTally['cntReg07']!=0){ ?><option value="07">REGION VII (CENTRAL VISAYAS)</option><?php } ?>
	  				<?php if($rowTally['cntReg08']!=0){ ?><option value="08">REGION VIII (EASTERN VISAYAS)</option><?php } ?>
	  				<?php if($rowTally['cntReg09']!=0){ ?><option value="09">REGION IX (ZAMBOANGA PENINSULA)</option><?php } ?>
	  				<?php if($rowTally['cntReg10']!=0){ ?><option value="10">REGION X (NORTHERN MINDANAO)</option><?php } ?>
	  				<?php if($rowTally['cntReg11']!=0){ ?><option value="11">REGION XI (DAVAO REGION)</option><?php } ?>
	  				<?php if($rowTally['cntReg12']!=0){ ?><option value="12">REGION XII (SOCCSKSARGEN)</option><?php } ?>
	  				<?php if($rowTally['cntReg16']!=0){ ?><option value="16">REGION XIII (CARAGA)</option><?php } ?> 
	  				<?php if($rowTally['cntReg15']!=0){ ?><option value="15">BARMM (BANGSAMORO AUTONOMOUS REGION IN MUSLIM MINDANAO)</option><?php } ?>
	  			</select>
	  		</div>
	  		<div class="col-lg-1 text-right">
	  			<button type="submit" class="btn btn-sm btn-primary col-lg-12" name="btnprocess">Process</button>
	  		</div>
	  	</div>
		</form> 
	  	<div class="form-row text-xs">
	   	<div class="col-lg-12 mt-3">
		   <table class="table text-xs table-bordered table-striped">
		   	<tr>
		   		<td>NCR (NATIONAL CAPITAL REGION)</td>
		   		<td class="text-right  <?php if($rowTally['cntReg13']==0) { echo 'text-success';} else { echo 'text-danger'; }?>"><?=$rowTally['cntReg13']; ?></td>
		   	</tr>	
		   	<tr>
		   		<td>CAR (CORDILLERA ADMINISTRATIVE REGION)</td>
		   		<td class="text-right  <?php if($rowTally['cntReg14']==0) { echo 'text-success';} else { echo 'text-danger'; }?>"><?=$rowTally['cntReg14']; ?></td>
		   		
		   	</tr>	<tr>
		   		<td>REGION I (ILOCOS REGION)</td>
		   		<td class="text-right  <?php if($rowTally['cntReg01']==0) { echo 'text-success';} else { echo 'text-danger'; }?>"><?=$rowTally['cntReg01']; ?></td>
		   	</tr>
		   	
		   	<tr>
		   		<td>REGION II (CAGAYAN VALLEY)</td>
		   		<td class="text-right  <?php if($rowTally['cntReg02']==0) { echo 'text-success';} else { echo 'text-danger'; }?>"><?=$rowTally['cntReg02']; ?></td>
		   	</tr>	
		   	<tr>
		   		<td>REGION III (CENTRAL LUZON)</td>
		   		<td class="text-right  <?php if($rowTally['cntReg03']==0) { echo 'text-success';} else { echo 'text-danger'; }?>"><?=$rowTally['cntReg03']; ?></td>
		   	</tr>	
		   	<tr>
		   		<td>REGION IV-A (CALABARZON)</td>
		   		<td class="text-right  <?php if($rowTally['cntReg04']==0) { echo 'text-success';} else { echo 'text-danger'; }?>"><?=$rowTally['cntReg04']; ?></td>
		   	</tr>	
		   	<tr>
		   		<td>REGION IV-B (MIMAROPA)</td>
		   		<td class="text-right  <?php if($rowTally['cntReg17']==0) { echo 'text-success';} else { echo 'text-danger'; }?>"><?=$rowTally['cntReg17']; ?></td>
		   	</tr>	
		   	<tr>
		   		<td>REGION V (BICOL REGION)</td>
		   		<td class="text-right  <?php if($rowTally['cntReg05']==0) { echo 'text-success';} else { echo 'text-danger'; }?>"><?=$rowTally['cntReg05']; ?></td>
		   	</tr>	
		   	<tr>
		   		<td>REGION VI (WESTERN VISAYAS)</td>
		   		<td class="text-right  <?php if($rowTally['cntReg06']==0) { echo 'text-success';} else { echo 'text-danger'; }?>"><?=$rowTally['cntReg06']; ?></td>
		   	</tr>	
		   	<tr>
		   		<td>REGION VII (CENTRAL VISAYAS)</td>
		   		<td class="text-right  <?php if($rowTally['cntReg07']==0) { echo 'text-success';} else { echo 'text-danger'; }?>"><?=$rowTally['cntReg07']; ?></td>
		   	</tr>	
		   	<tr>
		   		<td>REGION VIII (EASTERN VISAYAS)</td>
		   		<td class="text-right  <?php if($rowTally['cntReg08']==0) { echo 'text-success';} else { echo 'text-danger'; }?>"><?=$rowTally['cntReg08']; ?></td>
		   	</tr>	
		   	<tr>
		   		<td>REGION IX (ZAMBOANGA PENINSULA)</td>
		   		<td class="text-right  <?php if($rowTally['cntReg09']==0) { echo 'text-success';} else { echo 'text-danger'; }?>"><?=$rowTally['cntReg09']; ?></td>
		   	</tr>	
		   	<tr>
		   		<td>REGION X (NORTHERN MINDANAO)</td>
		   		<td class="text-right  <?php if($rowTally['cntReg10']==0) { echo 'text-success';} else { echo 'text-danger'; }?>"><?=$rowTally['cntReg10']; ?></td>
		   	</tr>	
		   	<tr>
		   		<td>REGION XI (DAVAO REGION)</td>
		   		<td class="text-right  <?php if($rowTally['cntReg11']==0) { echo 'text-success';} else { echo 'text-danger'; }?>"><?=$rowTally['cntReg11']; ?></td>
		   	</tr>	
		   	<tr>
		   		<td>REGION XII (SOCCSKSARGEN)</td>
		   		<td class="text-right  <?php if($rowTally['cntReg12']==0) { echo 'text-success';} else { echo 'text-danger'; }?>"><?=$rowTally['cntReg12']; ?></td>
		   	</tr>	
		   	<tr>
		   		<td>REGION XIII (CARAGA)</td>
					<td class="text-right  <?php if($rowTally['cntReg16']==0) { echo 'text-success';} else { echo 'text-danger'; }?>"><?=$rowTally['cntReg16']; ?></td>		   	
				</tr>	
		   	<tr>
		   		<td>BARMM (BANGSAMORO AUTONOMOUS REGION IN MUSLIM MINDANAO)</td>
		   		<td class="text-right  <?php if($rowTally['cntReg15']==0) { echo 'text-success';} else { echo 'text-danger'; }?>"><?=$rowTally['cntReg15']; ?></td>
		   	</tr>
		   	<tr style="font-size: small;">
		   		<td><b>TOTAL</b></td>
		   		<td class="text-right  <?php if($rowTally['cntReg15']==0) { echo 'text-success';} else { echo 'text-danger'; }?>"><b><?=$rowTally['cntAll']; ?></b></td>
		   	</tr>	
		   </table>
		 </div>
		</div>
	
	</div>
</div>

<?php include('footer.html');?>	
