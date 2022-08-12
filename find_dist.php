<?php require_once('config/database_connection.php');
	$codeRegion		=$_GET['region'];
	$codeProvince	=$_GET['province'];

	$getDistrict 	= $dbConn->query("SELECT `district`, `code_dis` FROM geo_location WHERE code_reg = LPAD('$codeRegion', 2, '0') AND code_pro = LPAD('$codeProvince', 2, '0') GROUP BY `district`");

?>

	<select name="data-District"  id="dist" class="form-control" onchange="getMuni(<?php echo $codeRegion; ?>,<?php echo $codeProvince; ?>,this.value)">
	    <option value=""><?php echo "Select District" ?></option>
		<?php
        while($rowDistrict = mysqli_fetch_assoc($getDistrict)) {
		?>
		<option value="<?php echo $rowDistrict['code_dis']; ?>" ><?php echo $rowDistrict['district']?></option>
		<?php }?>  
 	    </select>
