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
<script>
$(document).ready(function() {
    $('#example').DataTable({ordering: false});
} );

$(document).ready(function() {
    $('#DAR').DataTable({ordering: false});
} );

$(document).ready(function() {
    $('#DENR').DataTable({ordering: false});
} );

$(document).ready(function() {
    $('#DILG').DataTable({ordering: false});
} );

$(document).ready(function() {
    $('#OTHERS').DataTable({ordering: false});
} );
</script>

<div class="container-fluid px-3 py-0">
	<div class="col-lg-12 bg-white border p-3">
      <div class="form-row">
      	<div class="col-lg-12">
	         <!-- Page Heading -->
	         <h1 class="h4 mb-2 text-gray-800">Programs, Activities and Projects with Corresponding Targets</h1>
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
                <div class="mt-3">
                <div class="form-row mt-3">
                    <div class="col-lg-12">
                        <h4 class="custom-font">Department of Agriculture</h4>
                    </div>
                </div>
                    <table id="DA" class="display text-xs" style="width:100%;">
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
                        <?php $queryDA = $dbConn->query("SELECT * FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%AGRICULTURE%' ORDER BY INFO_DATETIME DESC");
                        while($rowDA= mysqli_fetch_assoc($queryDA)){?>
                    

                        <tbody>
                            <tr>
                                <td><?php echo $rowDA['INFO_PARTICULARS']; ?></td>
                                <td><?php echo $rowDA['INFO_INTERVENTION']; ?></td>
                                <td><?php echo $rowDA['INFO_COMM_QUANTITY']; ?></td>
                                <td><?php echo $rowDA['INFO_DEL_QUANTITY']; ?></td>
                                <td><?php echo $rowDA['INFO_COMM_BUDGET']; ?></td>
                                <td><?php echo $rowDA['INFO_ALLOC_BUDGET']; ?></td>
                                <td><?php echo $rowDA['INFO_DISBURSED_BUDGET']; ?></td>
                                <td><a href="#" data-toggle="modal" class="btn btn-primary btn-sm text-xs" data-target="#editDA<?=$rowDA['ID'];?>">
                                    <i class="fas fa-pen-nib fa-xs"></i>
                                    </a>
                                    <?php include('modal_edit_profinfo.php'); ?>
                                </td>
                            </tr>
                        </tbody>
                        <?php } ?>
                    </table>
                </div>		

                <!-- DAR -->
                <div class="mt-3">
                <div class="form-row mt-3">
                    <div class="col-lg-12">
                        <h4 class="custom-font">Department of Agrarian Reform</h4>
                    </div>
                </div>
                    <table id="DAR" class="display text-xs" style="width:100%;">
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
                        <?php $queryDAR = $dbConn->query("SELECT * FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%AGRARIAN REFORM%' ORDER BY INFO_DATETIME DESC");
                        while($rowDAR= mysqli_fetch_assoc($queryDAR)){?>
                    

                        <tbody>
                            <tr>
                                <td><?php echo $rowDAR['INFO_PARTICULARS']; ?></td>
                                <td><?php echo $rowDAR['INFO_INTERVENTION']; ?></td>
                                <td><?php echo $rowDAR['INFO_COMM_QUANTITY']; ?></td>
                                <td><?php echo $rowDAR['INFO_DEL_QUANTITY']; ?></td>
                                <td><?php echo $rowDAR['INFO_COMM_BUDGET']; ?></td>
                                <td><?php echo $rowDAR['INFO_ALLOC_BUDGET']; ?></td>
                                <td><?php echo $rowDAR['INFO_DISBURSED_BUDGET']; ?></td>
                                <td><a href="#" data-toggle="modal" class="btn btn-primary btn-sm text-xs" data-target="#editDAR<?=$rowDAR['ID'];?>">
                                    <i class="fas fa-pen-nib fa-xs"></i>
                                    </a>
                                <?php include('modal_edit_infcomDAR.php'); ?></td>
                        </tr>
                        </tbody>
                        <?php } ?>
                    </table>
                </div>	
                <!-- END DAR -->

                <!-- DENR -->
                <div class="mt-3">
                    <div class="form-row mt-3">
                        <div class="col-lg-12">
                            <h4 class="custom-font">Department of Environment and Natural Resources</h4>
                        </div>
                    </div>
                    <table id="DENR" class="display text-xs" style="width:100%;">
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
                        <?php $queryDENR = $dbConn->query("SELECT * FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%DEPARTMENT OF ENVIRONMENT AND NATURAL RESOURCES%' ORDER BY INFO_DATETIME DESC");
                        while($rowDENR= mysqli_fetch_assoc($queryDENR)){?>
                    

                        <tbody>
                            <tr>
                                <td><?php echo $rowDENR['INFO_PARTICULARS']; ?></td>
                                <td><?php echo $rowDENR['INFO_INTERVENTION']; ?></td>
                                <td><?php echo $rowDENR['INFO_COMM_QUANTITY']; ?></td>
                                <td><?php echo $rowDENR['INFO_DEL_QUANTITY']; ?></td>
                                <td><?php echo $rowDENR['INFO_COMM_BUDGET']; ?></td>
                                <td><?php echo $rowDENR['INFO_ALLOC_BUDGET']; ?></td>
                                <td><?php echo $rowDENR['INFO_DISBURSED_BUDGET']; ?></td>
                                <td><a href="#" data-toggle="modal" class="btn btn-primary btn-sm text-xs" data-target="#editDENR<?=$rowDENR['ID'];?>">
                                    <i class="fas fa-pen-nib fa-xs"></i>
                                    </a>
                                <?php include('modal_edit_infcomDENR.php'); ?></td>
                        </tr>
                        </tbody>
                        <?php } ?>
                    </table>
                </div>	
                <!-- END DENR -->

                <!-- DILG -->
                <div class="mt-3">
                    <div class="form-row mt-3">
                        <div class="col-lg-12">
                            <h4 class="custom-font">Department of the Interior and Local Government</h4>
                        </div>
                    </div>
                    <table id="DILG" class="display text-xs" style="width:100%;">
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
                        <?php $queryDILG = $dbConn->query("SELECT * FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%INTERIOR%' ORDER BY INFO_DATETIME DESC");
                        while($rowDILG= mysqli_fetch_assoc($queryDILG)){?>
                    

                        <tbody>
                            <tr>
                                <td><?php echo $rowDILG['INFO_PARTICULARS']; ?></td>
                                <td><?php echo $rowDILG['INFO_INTERVENTION']; ?></td>
                                <td><?php echo $rowDILG['INFO_COMM_QUANTITY']; ?></td>
                                <td><?php echo $rowDILG['INFO_DEL_QUANTITY']; ?></td>
                                <td><?php echo $rowDILG['INFO_COMM_BUDGET']; ?></td>
                                <td><?php echo $rowDILG['INFO_ALLOC_BUDGET']; ?></td>
                                <td><?php echo $rowDILG['INFO_DISBURSED_BUDGET']; ?></td>
                                <td><a href="#" data-toggle="modal" class="btn btn-primary btn-sm text-xs" data-target="#editDILG<?=$rowDILG['ID'];?>">
                                    <i class="fas fa-pen-nib fa-xs"></i>
                                    </a>
                                <?php include('modal_edit_infcomDILG.php'); ?></td>
                        </tr>
                        </tbody>
                        <?php } ?>
                    </table>
                </div>	
                <!-- END DILG -->

                <!-- OTHERS -->
                <div class="mt-3">
                    <div class="form-row mt-3">
                        <div class="col-lg-12">
                            <h4 class="custom-font">Others</h4>
                        </div>
                    </div>
                    <table id="OTHERS" class="display text-xs" style="width:100%;">
                        <thead class="bg-accent text-xs">
                            <tr style="color:white;background-color: #49657b;">
                                <th>Office</th>
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
                        <?php $queryOTHER = $dbConn->query("SELECT * FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%5%' ORDER BY INFO_DATETIME DESC");
                        while($rowOTHER= mysqli_fetch_assoc($queryOTHER)){?>
                    

                        <tbody>
                            <tr>
                                <td><?php echo rtrim($rowOTHER['INFO_MAIN'],".5"); ?></td>
                                <td><?php echo $rowOTHER['INFO_PARTICULARS']; ?></td>
                                <td><?php echo $rowOTHER['INFO_INTERVENTION']; ?></td>
                                <td><?php echo $rowOTHER['INFO_COMM_QUANTITY']; ?></td>
                                <td><?php echo $rowOTHER['INFO_DEL_QUANTITY']; ?></td>
                                <td><?php echo $rowOTHER['INFO_COMM_BUDGET']; ?></td>
                                <td><?php echo $rowOTHER['INFO_ALLOC_BUDGET']; ?></td>
                                <td><?php echo $rowOTHER['INFO_DISBURSED_BUDGET']; ?></td>
                                <td><a href="#" data-toggle="modal" class="btn btn-primary btn-sm text-xs" data-target="#editOTHER<?=$rowOTHER['ID'];?>">
                                    <i class="fas fa-pen-nib fa-xs"></i>
                                    </a>
                                <?php include('modal_edit_infcomOTHER.php'); ?></td>
                        </tr>
                        </tbody>
                        <?php } ?>
                    </table>
                </div>	
                <!-- END OTHERS -->

            </div>
        </div>
	</div>
</div>




<?php include('footer.html'); ?></body>