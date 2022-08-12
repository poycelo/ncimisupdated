<?php include('head.html'); ?>
<?php include('session.php'); ?>
<body>
<?php include('sidebar.php');?>
<?php include('menu.php');?>
<?php 

$SID = $_REQUEST['SID'];
$query_profca = $dbConn->query("SELECT * FROM tbl_profilingca WHERE SID ='$SID'");
$row_profca   = mysqli_fetch_assoc($query_profca);

// UPDATE / EDIT
if(isset($_POST['editAddInter'])){
    // $SID            = $_POST['SID'];
    $ID             = $_POST['modalID'];
    $DelQuan        = $_POST['txtDelQuantity'];
    $AllocBud       = $_POST['txtAllocBudget'];
    $DisBud         = $_POST['txtDisBudget'];

    $dbConn->query('UPDATE tbl_interventions SET INFO_DEL_QUANTITY        = "' .$DelQuan.'",
                                                 INFO_ALLOC_BUDGET        = "' .$AllocBud.'",
                                                 INFO_DISBURSED_BUDGET    = "' .$DisBud. '"
                                    WHERE ID="' .$ID. '" ');
}
?>

<div class="container-fluid px-3 py-0">
	<div class="col-lg-12 bg-white border p-3">
      <div class="form-row">
      	<div class="col-lg-12">
	         <!-- Page Heading -->
	         <h1 class="h4 mb-2 text-gray-800">Intervention per Percentage</h1>
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
                                <th>Program/Project Classification</th>
                                <th>Specific Intervention</th>  
                                <th>Committed Quantity</th>  
                                <th>Delivered Quantity</th>
                                <th>Financial Target</th>  
                                <th>Allocated Budget</th>    
                                <th>Disbursed Budget</th>
                                <th>Action</th>  
                            </tr>
                        </thead>
                        <?php
                            $query_inter = $dbConn->query("SELECT * FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%AGRICULTURE%'");
                            while($rowDA = mysqli_fetch_assoc($query_inter)) { 
                        ?>  
                        <tr>
                        <td><?php echo $rowDA['INFO_PARTICULARS']; ?></td>
                                <td><?php echo $rowDA['INFO_INTERVENTION']; ?></td>
                                <td><?php echo $rowDA['INFO_COMM_QUANTITY']; ?></td>
                                <td><?php echo $rowDA['INFO_DEL_QUANTITY']; ?></td>
                                <td><?php echo $rowDA['INFO_COMM_BUDGET']; ?></td>
                                <td><?php echo $rowDA['INFO_ALLOC_BUDGET']; ?></td>
                                <td><?php echo $rowDA['INFO_DISBURSED_BUDGET']; ?></td>
                                <td><a href="#" data-toggle="modal" class="btn btn-sm btn-outline-primary text-xs form-control form-control-sm border" data-target="#editDA<?=$rowDA['ID'];?>">
                                    <i class="fas fa-pen-nib"></i>
                                    </a>
                                <?php include('modal_edit_profinfo.php'); ?>
                                </td>
                        </tr>
                        <?php } ?>              
                </table>
                <!-- DA -->

       
<?php
    include('DAR_add_interv_percentage.php');

?>
          
        </div>
      </div>
    </div>
 </div>
</div>




<?php include('footer.html'); ?></body>