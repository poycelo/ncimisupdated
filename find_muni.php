<?php require_once('config/database_connection.php');
	$codeRegion		=$_GET['region'];
	$codeProvince	=$_GET['province'];
	$prov = substr($codeProvince,0,4);
	
    $getMunicipality 	= $dbConn->query("SELECT DISTINCT `Municipality`, `Code` FROM psgc_municipalities WHERE Left(Code,4) like '%$prov%' ORDER BY Municipality");
    $cntMunicipality = mysqli_num_rows($getMunicipality);
?>
	
	<!--<select name="txtMunici" id="mundiv" class="form-control" onchange="getBar(<?php// echo $codeRegion?>,<?php// echo $codeProvince?>,this.value)">
		<option value=""><?php// echo "Select Municipality" ?></option>
		<?php //while($rowMunicipality = mysqli_fetch_assoc($getMunicipality)) { ?>
        <option value="<?php// echo $rowMunicipality['Code']?>"><?php// echo $rowMunicipality['Municipality']?></option>
		<?php //} ?>asdasdasdas
	 </select>
		-->
		<div id="mundiv">
             <?php 
               	$i=0; 
                 $dataCount     = $cntMunicipality; //mysqli_num_rows
                 $columnCount   = 4; //default (col-lg-3) per column
				 $fieldCount    = round($dataCount / $columnCount) +1;  
                 $rowCount =0;
				//echo $dataCount .','. $fieldCount;
?>
		<div class="form-row p-2">

<?php
                 while($rowMunicipality = mysqli_fetch_assoc($getMunicipality)) {
					
                	if($i==0){ echo "<div class='col-lg-3'>"; }

                 		echo "<div class='form-row'><input type='checkbox' class='mr-2'  name='txtMunici[]' value='". $rowMunicipality["Code"]."'>". $rowMunicipality['Municipality'] . "</div>";
                 
						$i = $i + 1;	      				
						$rowCount = $rowCount + 1;

            			if($i==$fieldCount){ echo "</div>"; $i=0;}

		        }		 
                 ?>
			
 	</div>

 	</div>