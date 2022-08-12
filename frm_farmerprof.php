<?php include('head.html'); ?>
<?php include('session.php'); ?>
<body>
<?php include('sidebar.php');?>
<?php include('menu.php');?>
<?php 
     
     if(isset($_POST['saveprofiling'])){

      $prefname  = $_POST['txtprefname'];
      $lastname  = $_POST['txtlastname'];
      $firstname = $_POST['txtfirstname'];
      $midname   = $_POST['txtmidname'];
      $suffname   = $_POST['txtsuffname'];
      $region    = $_POST['txtreg'];
      $prov      = $_POST['txtprov'];
      $mun       = $_POST['txtmun'];
      $bar       = $_POST['txtbar'];
      $address   = $_POST['txtaddress'];
      $sex       = $_POST['txtsex'];
      $bdate     = $_POST['txtbdate'];

    $getProf = $dbConn->query('SELECT * FROM tbl_farmersprof order by ID DESC LIMIT 1');
    $rowProf = mysqli_fetch_assoc($getProf);
    $month   = date('m');
    $day     =date('d');
    $year    = date('Y');
 
    $getregion  = $dbConn->query('SELECT * FROM psgc_region');
    $rowreg  = mysqli_fetch_assoc($getregion); 

    $getmun  = $dbConn->query('SELECT * FROM psgc_region');
    $rowmun  = mysqli_fetch_assoc($getmun); 
      
    $get_Profiling = $rowProf['ID'] + 1;
    $rfcode = '10'.$month. $day. $year. $get_Profiling;

       $dbConn->query("INSERT INTO tbl_farmersprof (RFCode, Info_Prefname, Info_LName, Info_FName, Info_MName, Info_SuffName, Info_Region, Info_Province, Info_Municipality, Info_Barangay, Info_Address, Info_Sex, Info_Bdate, Info_UserID) 
        VALUES ('$rfcode', '$prefname', '$lastname', '$firstname', '$midname', '$suffname', '$region', '$prov', '$mun', '$bar', '$address', '$sex', 'bdate', '$userid')");

     }

?>

<div class="container-fluid px-3 py-0">
	<div class="col-lg-12 bg-white border p-3">
      <div class="form-row">
      	<div class="col-lg-12">
	         <!-- Page Heading -->
	         <h1 class="h3 mb-2 text-gray-800">Page Title</h1>
       	</div>
 		</div>
   	<div class="form-row">
      	<div class="col-lg-12">
	         <!-- Data Table -->
	         <div style="font-size: 0.9rem;">
              <div class="form-row mt-3 border">
                  <div class="col-lg-2 bg-label p-2">
                  Name
                  </div>
                  <div class="col-lg-10 p-2">
                  <?php echo $row['Info_Prefname']; ?>
              </div>
            </div>
       	</div>
   	</div>
	</div>
</div>




<?php include('footer.html'); ?>
</body>