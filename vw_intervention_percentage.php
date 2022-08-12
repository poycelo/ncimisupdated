<?php include('head.html'); ?>
<?php include('session.php'); ?>
<body>
<?php include('sidebar.php');?>
<?php include('menu.php');?>
<?php 

$SID = $_REQUEST['SID'];
$query_profca = $dbConn->query("SELECT * FROM tbl_profilingca WHERE SID ='$SID'");
$row_profca   = mysqli_fetch_assoc($query_profca);
?>

<div class="container-fluid px-3 py-0">
	<div class="col-lg-12 bg-white border p-3">
      <div class="form-row">
      	<div class="col-lg-12">
	         <!-- Page Heading -->
	         <h1 class="h4 mb-2 text-gray-800">Status of Interventions</h1>
       	</div>
 		</div>
        <div class="form-row">
            <div class="col-lg-12">
                <!-- Data Table -->
                <div style="font-size: medium;">
                    <div class="form-row mt-3 border">
                        <div class="col-lg-2 bg-label p-2">
                            Name
                        </div>
                        <div class="col-lg-10 p-2">
                            <?php echo $row_profca['INFO_NAME']; ?>
                        </div>
                    </div>
                    <div class="form-row border border-top-0">
                    <div class="col-lg-2 bg-label p-2">
                        Watershed / Sub-watershed
                    </div>
                    <div class="col-lg-10 p-2">
                        <?php 
                        $ws_name = '';
                        $ws_name = explode(",", $row_profca['INFO_WATERSHED']);
                        $wsn = '';
                        foreach($ws_name as $name_ws) {
                            //echo $municipality = trim($municipality) . '<br/>';
                            $getws = $dbConn->query("SELECT * FROM ref_watershed WHERE `WS_CODE`=$name_ws");
                            $rowws = mysqli_fetch_assoc($getws);
                            $wsn .= $rowws['NAME_WATERSHED'] . ' ,';
                        
                        }     echo rtrim($wsn,',');?>
                    </div>
                    </div>
                </div>


         <!-- Part III. -->
         <div class="form-row mt-3">
            <div class="col-lg-12">
               <!-- Page Heading -->
               <h1 class="h5 mb-2 text-gray-800">Interventions Received</h1>
            </div>
         </div>

         <!-- Interventions: Department of Agriculture (DA) -->
         <div class="mt-3">
                <div class="form-row mt-3">
                    <div class="col-lg-12">
                        <h5 class="custom-font">Department of Agriculture</h5>
                    </div>
                </div>

                <table id="DA" class="table-bordered display text-xs" style="width:100%;">
                        <thead class="bg-accent text-xs">
                            <tr style="color:white;background-color: #49657b;">
                                <th>Intervention</th>
                                <th>Particulars</th>
                                <th>Unit</th>
                                <th>Committed Quantity</th>
                                <th>Delivered Quantity</th>
                                <th>% Delivered</th>
                                <th>Committed Quantity</th>
                                <th>Allocated Budget</th>
                                <th>% Allocated</th>
                                <th>Disbursed Budget</th>
                                <th>% Disbursed</th>
                            </tr>
                        </thead>
                        <?php
                            $query_inter = $dbConn->query("SELECT * FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%AGRICULTURE%'");
                            while($row_inter = mysqli_fetch_assoc($query_inter)) { 
                        ?>  
                        <tr>
                             <td><?php echo $row_inter["INFO_INTERVENTION"]; ?></td>
                             <td><?php echo $row_inter["INFO_PARTICULARS"]; ?></td>
                             <td><?php echo $row_inter["INFO_UNIT"]; ?></td>
                             <td><?php echo number_format($row_inter["INFO_COMM_QUANTITY"]); ?></td>   
                             <td><?php echo number_format($row_inter["INFO_DEL_QUANTITY"]); ?></td>
                             <td>
                                <?php 
                                $Delquantity = $row_inter["INFO_DEL_QUANTITY"];
                                $Infoquantity = $row_inter["INFO_COMM_QUANTITY"];
                                if ($Delquantity == 0 && $Infoquantity == 0) {echo "0%";}
                                else if ($Infoquantity == 0 || $Delquantity == 0) {echo "No value";}
                                else{$Operation = $Delquantity / $Infoquantity; $Percen = $Operation * 100; echo number_format($Percen, 2, '.', '')."%";}
                                ?>
                            </td>
                            <td><?php echo number_format($row_inter["INFO_COMM_BUDGET"]); ?></td>
                            <td><?php echo number_format($row_inter["INFO_ALLOC_BUDGET"]); ?></td>
                            <td>
                                <?php 
                                $Delquantity = $row_inter["INFO_ALLOC_BUDGET"];
                                $Infoquantity = $row_inter["INFO_COMM_BUDGET"];
                                if ($Delquantity == 0 && $Infoquantity == 0) {echo "0%";}
                                else if ($Infoquantity == 0 || $Delquantity == 0) {echo "No value";}
                                else{$Operation = $Delquantity / $Infoquantity; $Percen = $Operation * 100; echo number_format($Percen, 2, '.', '')."%";}
                                ?>
                            </td>
                            <td><?php echo number_format($row_inter["INFO_DISBURSED_BUDGET"]); ?></td>
                            <td>
                                <?php 
                                $Delquantity = $row_inter["INFO_DISBURSED_BUDGET"];
                                $Infoquantity = $row_inter["INFO_ALLOC_BUDGET"];
                                if ($Delquantity == 0 && $Infoquantity == 0) {echo "0%";}
                                else if ($Infoquantity == 0 && $Delquantity == 0) {echo "No value";}
                                else{$Operation = $Delquantity / $Infoquantity; $Percen = $Operation * 100; echo number_format($Percen, 2, '.', '')."%";}
                                ?>
                            </td>
                        </tr>
                        <?php } ?>   
                        <tr>
                           <td hidden></td>
                            <td></td> 
                            <td></td>
                            <td><b>TOTAL:</b></td>
                            <td><b>
                            <?php
                              $query_comm = $dbConn->query("SELECT sum(INFO_COMM_QUANTITY) as TotalCommQ FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%AGRICULTURE%'");
                              $row_comm = mysqli_fetch_assoc($query_comm);
                              echo number_format($row_comm['TotalCommQ']);  
                            ?></b>
                            </td>
                            <td><b>
                            <?php
                               $query_comm = $dbConn->query("SELECT sum(INFO_DEL_QUANTITY) as TotalDelQ FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%AGRICULTURE%'");
                              $row_comm = mysqli_fetch_assoc($query_comm);
                              echo number_format($row_comm['TotalDelQ']); 
                            ?></b>
                            </td>
                            <td></td>
                            <td><b>
                            <?php
                              $query_comm = $dbConn->query("SELECT sum(INFO_COMM_BUDGET) as TotalBudget FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%AGRICULTURE%'");
                              $row_comm = mysqli_fetch_assoc($query_comm);
                              echo number_format($row_comm['TotalBudget']); 
                            ?></b>
                            </td>
                            <td><b>
                            <?php
                              $query_comm = $dbConn->query("SELECT sum(INFO_ALLOC_BUDGET) as TotalAlloc FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%AGRICULTURE%'");
                              $row_comm = mysqli_fetch_assoc($query_comm);
                              echo number_format($row_comm['TotalAlloc']); 
                            ?></b>
                            </td>
                            <td></td>
                            <td><b>
                            <?php
                              $query_comm = $dbConn->query("SELECT sum(INFO_DISBURSED_BUDGET) as TotalDisbursed FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%AGRICULTURE%'");
                              $row_comm = mysqli_fetch_assoc($query_comm);
                              echo number_format($row_comm['TotalDisbursed']); 
                            ?></b>
                            </td>
                            <td></td>
                         </tr>                
                </table>
                <!-- DA -->

       
<?php
    include('tbl_vw_percentageDAR.php');
    include('tbl_vw_percentageDENR.php');
    include('tbl_vw_percentageDILG.php');
    include('tbl_vw_percentageOTHER.php');

?>
          
        </div>
      </div>
    </div>
 </div>
</div>




<?php include('footer.html'); ?></body>