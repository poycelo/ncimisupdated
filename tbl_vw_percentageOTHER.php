  <!-- Interventions: OTHER-->
  <div class="mt-3">
                <div class="form-row mt-3">
                    <div class="col-lg-12">
                        <h5 class="custom-font">Others</h5>
                    </div>
                </div>

                <table id="OTHERS" class="table-bordered display text-xs" style="width:100%;">
                        <thead class="bg-accent text-xs">
                            <tr style="color:white;background-color: #49657b;">
                                <th>Office</th>
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
                            $query_inter = $dbConn->query("SELECT * FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%.5%'");
                            while($row_inter = mysqli_fetch_assoc($query_inter)) { 
                        ?>  
                        <tr>
                             <td><?php echo rtrim($row_inter["INFO_MAIN"],".5"); ?></td>
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
                                else if ($Infoquantity == 0 || $Delquantity == 0) {echo "0%";}
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
                                else if ($Infoquantity == 0 || $Delquantity == 0) {echo "0%";}
                                else{$Operation = $Delquantity / $Infoquantity; $Percen = $Operation * 100; echo number_format($Percen, 2, '.', '')."%";}
                                ?>
                            </td>
                            <td><?php echo number_format($row_inter["INFO_DISBURSED_BUDGET"]); ?></td>
                            <td>
                                <?php 
                                $Delquantity = $row_inter["INFO_DISBURSED_BUDGET"];
                                $Infoquantity = $row_inter["INFO_ALLOC_BUDGET"];
                                if ($Delquantity == 0 && $Infoquantity == 0) {echo "0%";}
                                else if ($Infoquantity == 0 && $Delquantity == 0) {echo "0%";}
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
                              $query_comm = $dbConn->query("SELECT sum(INFO_COMM_QUANTITY) as TotalCommQ FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%.5%'");
                              $row_comm = mysqli_fetch_assoc($query_comm);
                              echo number_format($row_comm['TotalCommQ']);  
                            ?></b>
                            </td>
                            <td><b>
                            <?php
                               $query_comm = $dbConn->query("SELECT sum(INFO_DEL_QUANTITY) as TotalDelQ FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%.5%'");
                              $row_comm = mysqli_fetch_assoc($query_comm);
                              echo number_format($row_comm['TotalDelQ']); 
                            ?></b>
                            </td>
                            <td></td>
                            <td><b>
                            <?php
                              $query_comm = $dbConn->query("SELECT sum(INFO_COMM_BUDGET) as TotalBudget FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%.5%'");
                              $row_comm = mysqli_fetch_assoc($query_comm);
                              echo number_format($row_comm['TotalBudget']); 
                            ?></b>
                            </td>
                            <td><b>
                            <?php
                              $query_comm = $dbConn->query("SELECT sum(INFO_ALLOC_BUDGET) as TotalAlloc FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%.5%'");
                              $row_comm = mysqli_fetch_assoc($query_comm);
                              echo number_format($row_comm['TotalAlloc']); 
                            ?></b>
                            </td>
                            <td></td>
                            <td><b>
                            <?php
                              $query_comm = $dbConn->query("SELECT sum(INFO_DISBURSED_BUDGET) as TotalDisbursed FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%.5%'");
                              $row_comm = mysqli_fetch_assoc($query_comm);
                              echo number_format($row_comm['TotalDisbursed']); 
                            ?></b>
                            </td>
                            <td></td>
                         </tr>       
                </table>
                <!-- OTHER -->