   <!-- INTERVENTIONS -->
        <!-- Interventions: OTHERS -->
        <div class="form-row mt-3">
            <div class="col-lg-12" style="font-size: 0.8rem;">
            <h5 class="custom-font">Other Offices / Agency</h5>
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-lg-12">
                <table id="OTHERS" class="table table-bordered table-striped custom-font" width="100%" cellspacing="0">
                    <thead class="custom-font text-white bg-accent text-xs">
                        <tr>
                            <th class="d-sm-table-cell">Offices / Agency</th> 
                            <th class="d-sm-table-cell">Program/Project Classification</th>
                            <th class="d-sm-table-cell">Intervention</th>
                            <th class="d-sm-table-cell">Committed Quantity</th>
                            <th class="d-sm-table-cell">Unit</th>
                            <th class="d-sm-table-cell">Year</th>   
                            <th class="d-sm-table-cell">Financial Target ('000)</th>  
                        </tr>
                    </thead>
                    <?php 
                        $queryOTHER = $dbConn->query("SELECT * FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%.5%' ORDER BY INFO_DATETIME ASC");
                        while($rowOTHER = mysqli_fetch_assoc($queryOTHER)){
                    ?>

                    <tbody>
                        <tr>
                            <td><?php echo rtrim($rowOTHER['INFO_MAIN'],".5");?> </td> 
                            <td><?php echo $rowOTHER['INFO_PARTICULARS'];?></td>
                            <td><?php echo $rowOTHER['INFO_INTERVENTION'];?> </td>
                            <td><?php echo $rowOTHER['INFO_COMM_QUANTITY'];?></td>
                            <td><?php echo $rowOTHER['INFO_UNIT'];?> </td> 
                            <td><?php echo $rowOTHER['INFO_YEAR'];?></td>
                            <td><?php echo $rowOTHER['INFO_COMM_BUDGET'];?></td>
                        </tr>
                    </tbody>
                    <?php }?>
                </table>
            </div>
        </div>
<!-- END OTHERS -->