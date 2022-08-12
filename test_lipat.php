<?php include('head.html');?>
<body>
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
	$SID = $_POST['SID'];

        $getMarket = $dbConn->query('SELECT * FROM tbl_vmgob WHERE SID="'.$SID.'"');
        $rowMarket = mysqli_fetch_assoc($getMarket);
		$dbConn->query('UPDATE tbl_profilingca SET INFO_VISION="'.$rowMarket['INFO_VISION'].'", 
                                                    INFO_MISSION="'.$rowMarket['INFO_MISSION'].'",
                                                    INFO_GOAL="'.$rowMarket['INFO_GOAL'].'",
                                                    INFO_OBJECTIVE="'.$rowMarket['INFO_OBJECTIVE'].'",
                                                    INFO_BRIEF_DESC="'.$rowMarket['INFO_BRIEF_DESC'].'"
                                                    WHERE SID ="'.$SID.'"');
	
	echo "<script>window.location = 'test_lipat.php?msg=1';</script>";
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

	   		<?php 
               $getTally = $dbConn->query('SELECT  COUNT(case when INFO_VISION IS NULL THEN 1 END) as vision,
                                                   COUNT(case when INFO_MISSION IS NULL THEN 1 END) as mission, 
                                                   COUNT(case when INFO_GOAL IS NULL THEN 1 END) as goal,
                                                   COUNT(case when INFO_OBJECTIVE IS NULL THEN 1 END) as obje,
                                                   COUNT(case when INFO_BRIEF_DESC IS NULL THEN 1 END) as briefdesc,
                                                   SID
                                                   FROM tbl_profilingca GROUP BY SID');
	   		?>
	   		<?php 
               $getTally2 = $dbConn->query('SELECT  COUNT(case when INFO_VISION IS NULL THEN 1 END) as vision,
                                                    COUNT(case when INFO_MISSION IS NULL THEN 1 END) as mission, 
                                                    COUNT(case when INFO_GOAL IS NULL THEN 1 END) as goal,
                                                    COUNT(case when INFO_OBJECTIVE IS NULL THEN 1 END) as obje,
                                                    COUNT(case when INFO_BRIEF_DESC IS NULL THEN 1 END) as briefdesc,
                                                    SID 
                                                    FROM tbl_profilingca GROUP BY SID');
                                                    
	   		?>
	   
	   <form method="post">
	  	<div class="form-row mb-3">
	  		<div class="col-lg-11">
	  			<select  name="SID" class="form-control form-control-sm" required>
	  				<option value="" disabled selected>Choose One</option>
                        <?php while($rowTally2 = mysqli_fetch_assoc($getTally2)){ ?>
                            <?php if($rowTally2['vision']!=0) {?> <option value="<?=$rowTally2['SID'];?>"><?=$rowTally2['SID'];?><?php }?>
                        <?php } ?>
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
		   <?php while($rowTally = mysqli_fetch_assoc($getTally)){ ?>
           <tr>
		   		<td><?=$rowTally['SID']; ?></td>
		   		<td class="text-right  <?php if($rowTally['vision']==0) { echo 'text-success';} else { echo 'text-danger'; }?>"><?=$rowTally['vision']; ?></td>
		   		<td class="text-right  <?php if($rowTally['mission']==0) { echo 'text-success';} else { echo 'text-danger'; }?>"><?=$rowTally['mission']; ?></td>
		   		<td class="text-right  <?php if($rowTally['goal']==0) { echo 'text-success';} else { echo 'text-danger'; }?>"><?=$rowTally['goal']; ?></td>
		   		<td class="text-right  <?php if($rowTally['obje']==0) { echo 'text-success';} else { echo 'text-danger'; }?>"><?=$rowTally['obje']; ?></td>
		   		<td class="text-right  <?php if($rowTally['briefdesc']==0) { echo 'text-success';} else { echo 'text-danger'; }?>"><?=$rowTally['briefdesc']; ?></td>
		   	</tr>	
            <?php } ?>
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
</body>