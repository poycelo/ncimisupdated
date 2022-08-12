<?php require_once('config/database_connection.php');
	$codeRegion			= $_GET['region'];
	$codeProvince		= $_GET['province'];
	$codeMunicipality	= $_GET['municipality'];
	$prov = substr($codeProvince,0,4);
	$mun = substr($codeMunicipality,0,6);

	$getBarangay 	= $dbConn->query("SELECT DISTINCT `Barangay`, `Code` FROM psgc_barangays WHERE Left(Code,6) like '%$mun%' ORDER BY Barangay");
?>
	<select id="barangaydiv" class="form-control text-xs">
	    <option value=""><?php echo "Select Barangasssy" ?></option>
		<?php while($rowBarangay = mysqli_fetch_assoc($getBarangay)) { ?>
		<option value="<?php echo $rowBarangay['Code']; ?>" ><?php echo $rowBarangay['Barangay'];?></option>
		<?php }	?>
 	</select>
