


<?php include('head.html'); ?>
<?php include('session.php');?>
<body>  
<?php include('sidebar.php');?>
<?php include('menu.php');?>

<!-- SQL -->
<?php
if($rowUserInfo['INFO_ACCESSLEVEL']=='ENCODER'){
   $getDate = $dbConn->query("SELECT DISTINCT `SID`, INFO_TF_FROM, INFO_TF_TO, INFO_NAME FROM tbl_profilingca WHERE INFO_STAT_AF='For Review' AND INFO_USER = '$userid'");
}
elseif($rowUserInfo['INFO_ACCESSLEVEL']=='ADMINISTRATOR'){
  $getDate = $dbConn->query("SELECT DISTINCT `SID`, INFO_TF_FROM, INFO_TF_TO, INFO_NAME FROM tbl_profilingca WHERE INFO_STAT_AF='For Approval'");
}
elseif($rowUserInfo['INFO_ACCESSLEVEL']=='VERIFIER'){
  $getDate = $dbConn->query("SELECT DISTINCT `SID`, INFO_TF_FROM, INFO_TF_TO, INFO_NAME FROM tbl_profilingca WHERE INFO_STAT_AF='For Approval' AND INFO_AGENCY = '$agency'");
}else{
  $getDate = $dbConn->query("SELECT DISTINCT `SID`, INFO_TF_FROM, INFO_TF_TO, INFO_NAME FROM tbl_profilingca WHERE INFO_STAT_AF='For Review' AND INFO_AGENCY = '$agency'");
}
?>

          <div class="container-fluid mb-3 mt-3">
			  <div class="form-row">
				<div class="col-lg-12">
					<!-- Page Heading -->
					<h4 class="mb-2 text-gray-800">List of For Approval CADP</h4>
					<hr 999/>
		 		</div>
			  </div>
           <table id="datatable" class="display" style="width:100%">
                  <thead class="text-sm">
                      <tr style="color:white;background-color: #1f4068;">
                          <th>DATE</th>
                          <th>CONVERGENCE NAME</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php while($rowDate = mysqli_fetch_array($getDate)){ ?> 
                      <tr>
                          <td><a href="tbl_approval_list.php?DATEFROM=<?php echo $rowDate['INFO_TF_FROM']; ?>&&DATETO=<?php echo $rowDate['INFO_TF_TO'];?>"><?php echo $rowDate['INFO_TF_FROM']." - ".$rowDate['INFO_TF_TO']; ?></td>
                          <td><?php echo $rowDate['INFO_NAME'];?></td>
                      </tr>
                    <?php } ?> 
                  </tbody>
                  <tfoot>
                      <tr style="background-color:white;" class="text-sm" >
                         <th>DATE</th>
                          <th>CONVERGENCE NAME</th>
                      </tr>
                  </tfoot>
           </table>  
          </div>
<?php include('footer.html'); ?>
</body>

</html>

