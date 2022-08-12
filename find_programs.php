<?php require_once('config/database_connection.php');
	$codeRegion = substr($_GET['region'],0,5);

    $getProgram = $dbConn->query("SELECT DISTINCT `PROGRAM_DESC`, `OFFICE_CODE` FROM ref_programs WHERE OFFICE_CODE like '$codeRegion%'");
?>
    <div class="col-lg-2 bg-label p-2">
        Programs
    </div>
    <div class="col-lg-10 p-2" >
        <select name="txtParticulars[]"  id="programdiv" class="form-control">
            <option value=""><?php echo "Select Programs" ?></option>
            <?php while($rowProgram = mysqli_fetch_assoc($getProgram)) { ?>
            <option value="<?php echo $rowProgram['OFFICE_CODE']; ?>" ><?php echo $rowProgram['PROGRAM_DESC']?></option>
            <?php } ?>
        </select>
    </div>