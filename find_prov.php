    <?php require_once('config/database_connection.php');
	$codeRegion = substr($_GET['region'],0,2);

    $getProvince = $dbConn->query("SELECT DISTINCT `Province`, `Code` FROM psgc_provinces WHERE Left(Code,2) LIKE '$codeRegion%'");

    $getWatershed = $dbConn->query("SELECT DISTINCT `NAME_WATERSHED`, `RWS_CODE`, `WS_CODE` FROM ref_watershed WHERE RWS_CODE LIKE '$codeRegion%'");
    $cntWatershed = mysqli_num_rows($getWatershed);

    $getCADPs = $dbConn->query("SELECT DISTINCT `LCA_DESC`, `LCA_CODE` FROM ref_convergence_area WHERE LCA_CODE LIKE '$codeRegion%'");
    // $cntCADPs = mysqli_num_rows($getCADPs);
?>
 <div class="col-lg-2 bg-label p-2">
        Convergence Area
    </div>
    <div class="col-lg-10 p-2" >
        <select  name="txtName"  id="cadpdiv" class="form-control" onchange="<?php echo $codeRegion; ?>,this.value" required>
            <option value=""><?php echo "SELECT CONVERGENCE AREA" ?></option>
            <?php while($rowCADPs = mysqli_fetch_assoc($getCADPs)) { ?>
            <option value="<?php echo $rowCADPs['LCA_DESC']; ?>" ><?php echo $rowCADPs['LCA_DESC']?></option>
            <?php } ?>
        </select>
    </div>

    <div class="col-lg-2 bg-label p-2">
        Province
    </div>
    <div class="col-lg-10 p-2" >
        <select  name="txtProvince"  id="provdiv" class="form-control" onchange="getMuni(<?php echo $codeRegion; ?>,this.value)" required>
            <option value=""><?php echo "SELECT PROVINCE" ?></option>
            <?php while($rowProvince = mysqli_fetch_assoc($getProvince)) { ?>
            <option value="<?php echo $rowProvince['Code']; ?>" ><?php echo $rowProvince['Province']?></option>
            <?php } ?>
        </select>
    </div>

    <div class="col-lg-2 bg-label p-2" >
       Municipality
    </div>
    <div class="col-lg-10 p-2 mt-3" id="mundiv">
        <select name="txtMunici[]" class="form-control" placeholder="Municipality" disabled>
        <option value="">SELECT MUNICIPALITY</option>
        </select>
    </div>
<!-- 
    <div class="col-lg-2 bg-label p-2" >
        Watershed
    </div>
    <div class="col-lg-10 p-2" >     
        <select  name="txtWatershed" class="form-control">
            <option value=""><?php //echo "Select Watershed" ?></option>
            <?php //while($rowWatershed = mysqli_fetch_assoc($getWatershed)) { ?>
            <option value="<?php //echo $rowWatershed['NAME_WATERSHED']; ?>" ><?php //echo $rowWatershed['NAME_WATERSHED']?></option>
            <?php //} ?>
        </select>
    </div> -->
    <!-- <div class="col-lg-2 bg-label p-2" >
        Watershed
    </div>
    <div class="col-lg-10 mt-3 p-2">
        <div class="form-row">
        <?php //while($rowWatershed = mysqli_fetch_assoc($getWatershed)) { ?>
        <div class="col-lg-3">
           <input type="checkbox" name="txtWatershed[]" value="<?php //echo $rowWatershed['WS_CODE'];?>" >
           <?php //echo $rowWatershed['NAME_WATERSHED']?>
        </div>
        <?php // } ?>
    </div>
    </div> -->
    <div class="col-lg-2 bg-label p-2" >
        Watershed
    </div>
    <div id="mundiv">
             <?php 
               	$i=0; 
                 $dataCount     = $cntWatershed; //mysqli_num_rows
                 $columnCount   = 4; //default (col-lg-3) per column
				 $fieldCount    = round($dataCount / $columnCount) + 1;  
                 $rowCount =0;
				//echo $dataCount .','. $fieldCount;
?>
		<div class="form-row p-2">

<?php
                 while($rowWatershed = mysqli_fetch_assoc($getWatershed)) {
					
                	if($i==0){ echo "<div class='col-lg-3'>"; }

                 		echo "<div class='form-row'><input type='checkbox' class='mr-2'  name='txtWatershed[]' value='". $rowWatershed["WS_CODE"]."'>". $rowWatershed['NAME_WATERSHED'] . "</div>";
                        // echo "<div class='form-row'><input type='text' class='mr-2' name='txtOthersWs' placeholder='Please Specify:''>" . ""."</div>";
						$i = $i + 1;	      				
						$rowCount = $rowCount + 1;

            			if($i==$fieldCount){ echo "</div>"; $i=0;}

		        }		 
                 ?>
			
 	</div>

 	</div>