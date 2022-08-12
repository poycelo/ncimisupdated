      <!-- Interventions: Department of Agrarian Reform (DAR) -->
      <div class="form-row mt-3">
                        <div class="col-lg-12">
                           <h5 class="custom-font">Department of Agrarian Reform</h5>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-lg-12">
                           <table id="DAR" class="table table-bordered table-striped custom-font" width="100%" cellspacing="0">
                                <thead class="text-white bg-accent text-xs">
                                    <tr>
                                        <th width="20%">Program/Project Classification</th>
                                        <th>Intervention</th>
                                        <th>Committed Quantity</th>
                                        <th>Unit</th>
                                        <th>Year</th>
                                        <th>Financial Target ('000)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php $queryDAR = $dbConn->query("SELECT * FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%DEPARTMENT OF AGRARIAN%' ORDER BY INFO_DATETIME ASC"); ?>
                                <?php $countDAR = mysqli_num_rows($queryDAR); ?>
                                <tbody>
                                    <?php if($countDAR==0){?>
                                        <!-- OFFICE -->
                                        <input type="hidden" name="SID" value="<?php echo $SID; ?>">

                                        <tr class="fieldGroupDAR">
                                            <td>
                                                <input type="hidden"  class="form-control form-control-sm col-lg-2" name="txtMainoff[]" value="DEPARTMENT OF AGRARIAN REFORM">
                                                <!-- PROGRAM -->
                                                <?php $getProgramDAR = $dbConn->query("SELECT * FROM ref_programs WHERE PROGRAM_CODE = 'DAR'");?>
                                                <select class="form-control form-control-sm col-lg-12 text-xs" name="txtParticulars[]" placeholder="Program/Project Classification">
                                                    <option value="" selected >SELECT PROGRAM</option>
                                                    <?php while($rowProgramDAR = mysqli_fetch_assoc($getProgramDAR)) { ?>
                                                    <option value="<?php echo $rowProgramDAR['PROGRAM_DESC']; ?>"><?php echo $rowProgramDAR['PROGRAM_DESC']; ?></option>   
                                                    <?php } ?>
                            
                                                </select>
                                            </td>
                                            <td>
                                                <?php $getInterDAR = $dbConn->query("SELECT * FROM ref_intervention WHERE OFFICE_CODE = 'DAR'");?>
                                                <select class="form-control form-control-sm col-lg-12 text-xs" name="txtIntervention[]" placeholder="Specific Intervention">
                                                <option value="" selected >SELECT INTERVENTION</option>
                                                <?php while($rowInterDAR = mysqli_fetch_assoc($getInterDAR)) { ?>
                                                            <option value="<?php echo $rowInterDAR['INTERVENTION_DESC']; ?>">
                                                            <?php echo $rowInterDAR['INTERVENTION_DESC']; ?>
                                                            </option>   
                                                <?php } ?>
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtQuantity[]" placeholder="Committed Quantity" onkeyup="this.value = this.value.toUpperCase();"></td>
                                            <td>
                                                <?php  $query_unitDAR = $dbConn->query("SELECT * FROM ref_unit"); ?>
                                                <select class="form-control form-control-sm col-lg-12 text-xs" name="txtUnit[]" placeholder="Unit">
                                                    <option value="" selected >SELECT UNIT</option>
                                                    <?php while($rowUnitDAR = mysqli_fetch_assoc($query_unitDAR)) { ?>
                                                    <option value="<?php echo $rowUnitDAR['UNIT']; ?>"><?php echo $rowUnitDAR['UNIT']; ?></option>   
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="txtYear[]" class="form-control  form-control-sm col-lg-12 text-xs">
                                                    <option value="N/A">SELECT YEAR</option>
                                                    <option value="2010">2010</option>
                                                    <option value="2011">2011</option>
                                                    <option value="2012">2012</option>
                                                    <option value="2013">2013</option>
                                                    <option value="2014">2014</option>
                                                    <option value="2015">2015</option>
                                                    <option value="2016">2016</option>
                                                    <option value="2017">2017</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2019">2019</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2022">2022</option>
                                                    <option value="2023">2023</option>
                                                    <option value="2024">2024</option>
                                                    <option value="2025">2025</option>
                                                    <option value="2026">2026</option>
                                                    <option value="2027">2027</option>
                                                    <option value="2028">2028</option>
                                                    <option value="2029">2029</option>
                                                    <option value="2030">2030</option>
                                                </select>
                                            </td>
                                            
                                               <td><input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtBudget[]" placeholder="Financial Target ('000)" onkeyup="this.value = this.value.toUpperCase();"></td>
                                            <td class="text-center"><button type="button" id="addMoreDAR" name="somethingbtn" class="btn btn-success btn-sm addMoreDAR"><i class="fas fa-plus fa-white"></i></button></td>
                                        </tr>
                                   <?php }   
                                        $certCountDAR = 0; // counter for certificates. 1st record will have 'add' button, succeeding rows will have 'remove' button.
                                        while($rowDAR = mysqli_fetch_assoc($queryDAR)){ 
                                                $certCountDAR = $certCountDAR + 1; ?>
                                    <tr class="fieldGroupDAR">
                                        <td>
                                            <!-- PROGRAM -->
                                            <input type="hidden"  class="form-control form-control-sm col-lg-2" name="txtMainoff[]" value="DEPARTMENT OF AGRARIAN REFORM">
                                                                
                                            <?php $getProgramDAR = $dbConn->query("SELECT * FROM ref_programs WHERE OFFICE_CODE = 'DAR'");?>
                                            <select class="form-control form-control-sm col-lg-12 text-xs" name="txtParticulars[]" placeholder="Program/Project Classification">
                                                <option value="<?php echo $rowDAR['INFO_PARTICULARS'];?>" selected ><?php echo $rowDAR['INFO_PARTICULARS'];?></option>    
                                                <option value="" disabled>SELECT PROGRAM</option>
                                                <?php while($rowProgramDAR = mysqli_fetch_assoc($getProgramDAR)) { ?>
                                                            <option value="<?php echo $rowProgramDAR['PROGRAM_DESC']; ?>">
                                                            <?php echo $rowProgramDAR['PROGRAM_DESC']; ?>
                                                            </option>   
                                                <?php } ?>
                                            </select>
                                        </td>   
                                        <td>
                                            <!-- Intervention -->
                                            <?php $getInterDAR = $dbConn->query("SELECT * FROM ref_intervention WHERE OFFICE_CODE = 'DAR'");?>
                                            <select class="form-control form-control-sm col-lg-12 text-xs" name="txtIntervention[]" placeholder="Specific Intervention">
                                                <option value="<?php echo $rowDAR['INFO_INTERVENTION'];?>" selected ><?php echo $rowDAR['INFO_INTERVENTION'];?></option>
                                                <option value="" disabled>SELECT INTERVENTION</option>
                                                <?php while($rowInterDAR = mysqli_fetch_assoc($getInterDAR)) { ?>
                                                            <option value="<?php echo $rowInterDAR['INTERVENTION_DESC']; ?>">
                                                            <?php echo $rowInterDAR['INTERVENTION_DESC']; ?>
                                                            </option>   
                                                <?php } ?>
                                            </select>
                                        </td>
                            
                                            <td><input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtQuantity[]" value="<?php echo $rowDAR['INFO_COMM_QUANTITY'];?>"placeholder="Committed Quantity" onkeyup="this.value = this.value.toUpperCase();">
                                            </td>
                                            
                                            <td>
                                                    <!-- UNIT -->
                                                    
                                                    <select class="form-control form-control-sm col-lg-12 text-xs" name="txtUnit[]" placeholder="Unit">
                                                    <option value="<?php echo $rowDAR['INFO_UNIT'];?>"><?php echo $rowDAR['INFO_UNIT'];?></option>
                                                    <option value="" disabled >SELECT UNIT</option>
                                                    <?php  $query_unitDAR = $dbConn->query("SELECT * FROM ref_unit"); ?>
                                                    <?php while($rowUnitDAR = mysqli_fetch_assoc($query_unitDAR)) { ?>
                                                                <option value="<?php echo $rowUnitDAR['UNIT']; ?>">
                                                                <?php echo $rowUnitDAR['UNIT']; ?>
                                                                </option>   
                                                    <?php } ?>
                                                    </select>
                                            </td>
                                            <td>
                                                <select name="txtYear[]" class="form-control form-control-sm col-lg-12 text-xs">
                                                    <option value="<?php echo $rowDAR['INFO_YEAR'];?>"><?php echo $rowDAR['INFO_YEAR'];?></option>
                                                    <option value="N/A">SELECT YEAR</option>
                                                    <option value="2010">2010</option>
                                                    <option value="2011">2011</option>
                                                    <option value="2012">2012</option>
                                                    <option value="2013">2013</option>
                                                    <option value="2014">2014</option>
                                                    <option value="2015">2015</option>
                                                    <option value="2016">2016</option>
                                                    <option value="2017">2017</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2019">2019</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2022">2022</option>
                                                    <option value="2023">2023</option>
                                                    <option value="2024">2024</option>
                                                    <option value="2025">2025</option>
                                                    <option value="2026">2026</option>
                                                    <option value="2027">2027</option>
                                                    <option value="2028">2028</option>
                                                    <option value="2029">2029</option>
                                                    <option value="2030">2030</option>
                                                    </select>
                                                </td>
                                         <td><input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtBudget[]" value="<?php echo $rowDAR['INFO_COMM_BUDGET'];?>" placeholder="Financial Target ('000)" onkeyup="this.value = this.value.toUpperCase();"></td>
                                            <td class="text-center">
                                            <?php if($certCountDAR==1){ ?>
                                            <button type="button" id="addMoreDAR" name="somethingbtn" class="btn btn-success btn-sm addMoreDAR"><i class="fas fa-plus fa-white"></i></button>
                                            <?php } else { ?>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm removeDAR"><i class="fas fa-minus fa-white"></i></a>
                                            <?php } ?>
                                            </td>
                                        </tr> <?php } ?>
                                        <tr class="fieldGroupCopyDAR" style="display: none;">
                                            <td>
                                                <!-- OFFICE -->
                                                <input type="hidden" name="SID" value="<?php echo $SID; ?>">
                                                
                                                
                                                <input type="hidden"  class="form-control form-control-sm col-lg-2" name="txtMainoff[]" value="DEPARTMENT OF AGRARIAN REFORM">
                                                <!-- PROGRAM -->
                                                <?php $getProgramDAR = $dbConn->query("SELECT * FROM ref_programs WHERE PROGRAM_CODE = 'DAR'");?>
                                                <select class="form-control form-control-sm col-lg-12 text-xs" name="txtParticulars[]" placeholder="Program/Project Classification">
                                                <option value="" selected >SELECT PROGRAM</option>
                                                <?php while($rowProgramDAR = mysqli_fetch_assoc($getProgramDAR)) { ?>
                                                            <option value="<?php echo $rowProgramDAR['PROGRAM_DESC']; ?>">
                                                            <?php echo $rowProgramDAR['PROGRAM_DESC']; ?>
                                                            </option>   
                                                            <?php } ?>
                                                </select></td>
                                                <td><?php $getInterDAR = $dbConn->query("SELECT * FROM ref_intervention WHERE OFFICE_CODE = 'DAR'");?>
                                                <select class="form-control form-control-sm col-lg-12 text-xs" name="txtIntervention[]" placeholder="Specific Intervention">
                                                <option value="" selected >SELECT INTERVENTION</option>
                                                <?php while($rowInterDAR = mysqli_fetch_assoc($getInterDAR)) { ?>
                                                            <option value="<?php echo $rowInterDAR['INTERVENTION_DESC']; ?>">
                                                            <?php echo $rowInterDAR['INTERVENTION_DESC']; ?>
                                                            </option>   
                                                <?php } ?>
                                                </select></td>
                                                <td><input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtQuantity[]" placeholder="Committed Quantity" onkeyup="this.value = this.value.toUpperCase();">
                                                </td>
                                                <td> <?php  $query_unitDAR = $dbConn->query("SELECT * FROM ref_unit");?>
                                                    <select class="form-control form-control-sm col-lg-12 text-xs" name="txtUnit[]" placeholder="Unit">
                                                        <option value="" selected >SELECT UNIT</option>
                                                        <?php while($rowUnitDAR = mysqli_fetch_assoc($query_unitDAR)) { ?>
                                                                    <option value="<?php echo $rowUnitDAR['UNIT']; ?>">
                                                                    <?php echo $rowUnitDAR['UNIT']; ?>
                                                                    </option>   
                                                        <?php } ?>
                                                    </select>
                                                    </td>
                                                    
                                            <td>
                                                <select name="txtYear[]" class="form-control  form-control-sm col-lg-12 text-xs">
                                                    <option value="N/A">SELECT YEAR</option>
                                                    <option value="2010">2010</option>
                                                    <option value="2011">2011</option>
                                                    <option value="2012">2012</option>
                                                    <option value="2013">2013</option>
                                                    <option value="2014">2014</option>
                                                    <option value="2015">2015</option>
                                                    <option value="2016">2016</option>
                                                    <option value="2017">2017</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2019">2019</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2022">2022</option>
                                                    <option value="2023">2023</option>
                                                    <option value="2024">2024</option>
                                                    <option value="2025">2025</option>
                                                    <option value="2026">2026</option>
                                                    <option value="2027">2027</option>
                                                    <option value="2028">2028</option>
                                                    <option value="2029">2029</option>
                                                    <option value="2030">2030</option>
                                                </select>
                                            </td>
                                             <td><input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtBudget[]" placeholder="Financial Target ('000)" onkeyup="this.value = this.value.toUpperCase();">
                                                </td>
                                                <td class="text-center"><a href="javascript:void(0)" class="btn btn-danger btn-sm removeDAR"><i class="fas fa-minus fa-white"></i></a>
                                                    
                                            </td>
                                    </tr>
                            </table>  
                        </div>
                    </div>
           <!-- END DAR -->