    <div class="form-row mt-3">
        <div class="col-lg-12">
            <h5 class="custom-font">Department of Agrarian Reform</h5>
        </div>
    </div>                
    <table id="DAR" class="table-bordered display text-xs" style="width:100%;">
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
                $queryDAR = $dbConn->query("SELECT * FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%AGRARIAN%'");
                while($rowDAR = mysqli_fetch_assoc($queryDAR)) { 
            ?>  
            <tr>
            <td><?php echo $rowDAR['INFO_PARTICULARS']; ?></td>
                    <td><?php echo $rowDAR['INFO_INTERVENTION']; ?></td>
                    <td><?php echo $rowDAR['INFO_COMM_QUANTITY']; ?></td>
                    <td><?php echo $rowDAR['INFO_DEL_QUANTITY']; ?></td>
                    <td><?php echo $rowDAR['INFO_COMM_BUDGET']; ?></td>
                    <td><?php echo $rowDAR['INFO_ALLOC_BUDGET']; ?></td>
                    <td><?php echo $rowDAR['INFO_DISBURSED_BUDGET']; ?></td>
                    <td><a href="#" data-toggle="modal" class="btn btn-sm btn-outline-primary text-xs form-control form-control-sm border"data-target="#editDAR<?=$rowDAR['ID'];?>">
                        <i class="fas fa-pen-nib"></i>
                        </a>
                    <?php include('modal_edit_infcomDAR.php'); ?>
                    </td>
            </tr>
            <?php } ?>              
    </table>


    <div class="form-row mt-3">
        <div class="col-lg-12">
            <h5 class="custom-font">Department of Environment and Natural Resources</h5>
        </div>
    </div>                
    <table id="DENR" class="table-bordered display text-xs" style="width:100%;">
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
                $queryDENR = $dbConn->query("SELECT * FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%ENVIRONMENT%'");
                while($rowDENR = mysqli_fetch_assoc($queryDENR)) { 
            ?>  
            <tr>
            <td><?php echo $rowDENR['INFO_PARTICULARS']; ?></td>
                    <td><?php echo $rowDENR['INFO_INTERVENTION']; ?></td>
                    <td><?php echo $rowDENR['INFO_COMM_QUANTITY']; ?></td>
                    <td><?php echo $rowDENR['INFO_DEL_QUANTITY']; ?></td>
                    <td><?php echo $rowDENR['INFO_COMM_BUDGET']; ?></td>
                    <td><?php echo $rowDENR['INFO_ALLOC_BUDGET']; ?></td>
                    <td><?php echo $rowDENR['INFO_DISBURSED_BUDGET']; ?></td>
                    <td><a href="#" data-toggle="modal" class="btn btn-sm btn-outline-primary text-xs form-control form-control-sm border" data-target="#editDENR<?=$rowDENR['ID'];?>">
                        <i class="fas fa-pen-nib"></i>
                        </a>
                    <?php include('modal_edit_infcomDENR.php'); ?>
                    </td>
            </tr>
            <?php } ?>              
    </table>


    
    <div class="form-row mt-3">
        <div class="col-lg-12">
            <h5 class="custom-font">Department of the Interior and Local Government</h5>
        </div>
    </div>                
    <table id="DILG" class="table-bordered display text-xs" style="width:100%;">
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
                $queryDILG = $dbConn->query("SELECT * FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%INTERIOR%'");
                while($rowDILG = mysqli_fetch_assoc($queryDILG)) { 
            ?>  
            <tr>
            <td><?php echo $rowDILG['INFO_PARTICULARS']; ?></td>
                    <td><?php echo $rowDILG['INFO_INTERVENTION']; ?></td>
                    <td><?php echo $rowDILG['INFO_COMM_QUANTITY']; ?></td>
                    <td><?php echo $rowDILG['INFO_DEL_QUANTITY']; ?></td>
                    <td><?php echo $rowDILG['INFO_COMM_BUDGET']; ?></td>
                    <td><?php echo $rowDILG['INFO_ALLOC_BUDGET']; ?></td>
                    <td><?php echo $rowDILG['INFO_DISBURSED_BUDGET']; ?></td>
                    <td><a href="#" data-toggle="modal" class="btn btn-sm btn-outline-primary text-xs form-control form-control-sm border" data-target="#editDILG<?=$rowDILG['ID'];?>">
                        <i class="fas fa-pen-nib"></i>
                        </a>
                    <?php include('modal_edit_infcomDILG.php'); ?>
                    </td>
            </tr>
            <?php } ?>              
    </table>




    
    <div class="form-row mt-3">
        <div class="col-lg-12">
            <h5 class="custom-font">Other</h5>
        </div>
    </div>                
    <table id="OTHERS" class="table-bordered display text-xs" style="width:100%;">
            <thead class="bg-accent text-xs">
                <tr style="color:white;background-color: #49657b;">
                    <th>Office / Agency</th>  
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
                $queryOTHERS = $dbConn->query("SELECT * FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%.5%'");
                while($rowOTHERS = mysqli_fetch_assoc($queryOTHERS)) { 
            ?>  
            <tr>
                    <td><?php echo rtrim($rowOTHERS['INFO_MAIN'],".5"); ?></td>
                    <td><?php echo $rowOTHERS['INFO_PARTICULARS']; ?></td>
                    <td><?php echo $rowOTHERS['INFO_INTERVENTION']; ?></td>
                    <td><?php echo $rowOTHERS['INFO_COMM_QUANTITY']; ?></td>
                    <td><?php echo $rowOTHERS['INFO_DEL_QUANTITY']; ?></td>
                    <td><?php echo $rowOTHERS['INFO_COMM_BUDGET']; ?></td>
                    <td><?php echo $rowOTHERS['INFO_ALLOC_BUDGET']; ?></td>
                    <td><?php echo $rowOTHERS['INFO_DISBURSED_BUDGET']; ?></td>
                    <td><a href="#" data-toggle="modal" class="btn btn-sm btn-outline-primary text-xs form-control form-control-sm border" data-target="#editOTHERS<?=$rowOTHERS['ID'];?>">
                        <i class="fas fa-pen-nib"></i>
                        </a>
                    <?php include('modal_edit_infcomOTHER.php'); ?>
                    </td>
            </tr>
            <?php } ?>              
    </table>