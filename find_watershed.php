<?php require_once('config/database_connection.php');
	$codeRegion = substr($_GET['region'],0,2);

    $getWatershed = $dbConn->query("SELECT DISTINCT `NAME_WATERSHED`, `RWS_CODE` FROM ref_watershed WHERE RWS_CODE like '$codeRegion%'");
?>

    <select  name="txtWatershed"  id="watershed22" class="form-control">
        <option value=""><?php echo "Select Watershesssssd" ?></option>
        <?php while($rowWatershed = mysqli_fetch_assoc($getWatershed)) { ?>
        <option value="<?php echo $rowWatershed['NAME_WATERSHED']; ?>" ><?php echo $rowWatershed['NAME_WATERSHED']?></option>
        <?php } ?>
	</select>
