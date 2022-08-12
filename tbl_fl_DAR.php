   <!-- INTERVENTIONS -->
                    <!-- Interventions: Department of Agrarian Reform (DAR) -->
                    <div class="form-row mt-3">
                        <div class="col-lg-12">
                        <h5 class="custom-font">Department of Agrarian Reform</h5>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-lg-12">
                            <table id="" class="table table-bordered table-striped custom-font" width="100%" cellspacing="0">
                                <thead class="custom-ffedis text-white bg-accent text-xs">
                                    <tr>
                                        <th class="d-sm-table-cell">Program/Project Classification</th>
                                        <th class="d-sm-table-cell">Intervention</th>
                                        <th class="d-sm-table-cell">Committed Quantity</th>
                                        <th class="d-sm-table-cell">Unit</th>
                                        <th class="d-sm-table-cell">Year</th>   
                                        <th class="d-sm-table-cell">Financial Target ('000)</th>
                                    </tr>
                                </thead>
                                <?php 
                                    $queryDAR = $dbConn->query("SELECT * FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%AGRARIAN%' ORDER BY INFO_DATETIME ASC");
                                    while($rowDAR = mysqli_fetch_assoc($queryDAR)){
                                ?>

                                <tbody>
                                    <tr>
                                       <td><?php echo $rowDAR['INFO_PARTICULARS'];?></td>
                                       <td><?php echo $rowDAR['INFO_INTERVENTION'];?> </td>
                                       <td><?php echo $rowDAR['INFO_COMM_QUANTITY'];?></td>
                                       <td><?php echo $rowDAR['INFO_UNIT'];?> </td> 
                                       <td><?php echo $rowDAR['INFO_YEAR'];?></td>
                                       <td><?php echo $rowDAR['INFO_COMM_BUDGET'];?></td>
                                    </tr>
            </tbody>
                                    <?php }?>
        </table>
        </div>
                    </div>
           <!-- END DAR -->