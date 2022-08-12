  <!-- Interventions: Department of Environment and Natural Resources (DENR) -->
  <div class="form-row mt-3">
                        <div class="col-lg-12">
                        <h5 class="custom-font">Department of Environment and Natural Resources</h5>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-lg-12">
                            <table id="DENRS" class="table table-bordered table-striped custom-font" width="100%" cellspacing="0">
                                <thead class="custom-ffedis text-white bg-accent text-xs">
                                    <tr>
                                        <th>OFFICE</th>
                                        <th width="20%">Program/Project Classification</th>
                                        <th>Intervention</th>
                                        <th>Committed Quantity</th>
                                        <th>Unit</th>
                                        <th>Year</th>
                                        <th>Financial Target ('000)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php $queryDENR = $dbConn->query("SELECT * FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%.3%' ORDER BY INFO_DATETIME ASC"); ?>
                                <?php $countDENR = mysqli_num_rows($queryDENR); ?>
                                <tbody>
                                <?php if($countDENR==0){?>
                                    <!-- OFFICE -->
                                    <input type="hidden" name="SID" value="<?php echo $SID; ?>">

                                    <tr class="fieldGroupDENR">
                                        <td>
                                        <select name="txtMainoff[]" class="form-control form-control-sm col-lg-12" id="off_select">
                                        <option value="" selected >SELECT OFFICE</option>
                                        <?php foreach($ref_off_infoDENR as $off_infoDENR) { ?>
                                        <option value="<?php echo $off_infoDENR; ?>"><?php echo rtrim($off_infoDENR,".3");?></option>
                                        <?php } ?>                              
                                        </select>   
                                        </td>
                                        <td>  
                                        <!-- PROGRAM -->
                                            <?php $getProgramDENR = $dbConn->query("SELECT * FROM ref_programs WHERE OFFICE_CODE = 'DENR'");?>
                                            <select class="form-control form-control-sm col-lg-12 text-xs" name="txtParticulars[]" placeholder="Program/Project Classification">
                                                <option value="" selected >SELECT PROGRAM</option>
                                                <?php while($rowProgramDENR = mysqli_fetch_assoc($getProgramDENR)) { ?>
                                                <option value="<?php echo $rowProgramDENR['PROGRAM_DESC']; ?>"><?php echo $rowProgramDENR['PROGRAM_DESC']; ?></option>   
                                                <?php } ?>
                        
                                            </select>
                                        </td>
                                        <td>
                                            <?php $getInterDENR = $dbConn->query("SELECT * FROM ref_intervention WHERE OFFICE_CODE = 'DENR'");?>
                                            <select class="form-control form-control-sm col-lg-12 text-xs" name="txtIntervention[]" placeholder="Specific Intervention">
                                            <option value="" selected >SELECT INTERVENTION</option>
                                            <?php while($rowInterDENR = mysqli_fetch_assoc($getInterDENR)) { ?>
                                                        <option value="<?php echo $rowInterDENR['INTERVENTION_DESC']; ?>">
                                                        <?php echo $rowInterDENR['INTERVENTION_DESC']; ?>
                                                        </option>   
                                            <?php } ?>
                                            </select>    
                                        </td>
                                        <td><input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtQuantity[]" placeholder="Committed Quantity" onkeyup="this.value = this.value.toUpperCase();"></td>
                                        <td>
                                            <?php  $query_unitDENR = $dbConn->query("SELECT * FROM ref_unit");?>
                                            <select class="form-control form-control-sm col-lg-12 text-xs" name="txtUnit[]" placeholder="Unit">
                                                <option value="" selected >SELECT UNIT</option>
                                                <?php while($rowUnitDENR = mysqli_fetch_assoc($query_unitDENR)) { ?>
                                                <option value="<?php echo $rowUnitDENR['UNIT']; ?>"><?php echo $rowUnitDENR['UNIT']; ?></option>   
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td>
                                           <select name="txtYear[]" class="form-control form-control-sm col-lg-12 text-xs">
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
                                        <td class="text-center"><button type="button" id="addMoreDENR" name="somethingbtn" class="btn btn-success btn-sm addMoreDENR"><i class="fas fa-plus fa-white"></i></button></td>
                                    </tr>


                                <?php }
                                    $certCountDENR = 0; // counter for certificates. 1st record will have 'add' button, succeeding rows will have 'remove' button.
                                    while($rowDENR = mysqli_fetch_assoc($queryDENR)){ 
                                                $certCountDENR = $certCountDENR + 1; ?>
                                    <tr class="fieldGroupDENR">
                                        
                                            <td>
                                                 <?php $getOfficeDENR = $dbConn->query("SELECT * FROM ref_offices2 WHERE CODE_MAIN = '3'");?>
                                                <select name="txtMainoff[]" class="form-control form-control-sm col-lg-12" id="off_select">
                                                <option value="<?php echo $rowDENR['INFO_MAIN'];?>" selected ><?php echo rtrim($rowDENR['INFO_MAIN'],".3");?></option>  
                                                <option value="" disabled>SELECT OFFICE</option>    
                                                <?php while($rowOfficeDENR = mysqli_fetch_assoc($getOfficeDENR)) { ?>
                                                            <option value="<?php echo $rowOfficeDENR['INFO_OFFICE']; ?>">
                                                            <?php echo $rowOfficeDENR['INFO_OFFICE']; ?>
                                                            </option>  
                                                <?php } ?>                              
                                                </select>   
                                            </td> 
                                            <td>
                                            <!-- PROGRAM -->
                                                            
                                            <?php $getProgramDENR = $dbConn->query("SELECT * FROM ref_programs WHERE PROGRAM_CODE = 'DENR'");?>
                                            <select class="form-control form-control-sm col-lg-12 text-xs" name="txtParticulars[]" placeholder="Program/Project Classification">
                                                <option value="<?php echo $rowDENR['INFO_PARTICULARS'];?>" selected ><?php echo $rowDENR['INFO_PARTICULARS'];?></option>    
                                                <option value="" disabled>SELECT PROGRAM</option>
                                                <?php while($rowProgramDENR = mysqli_fetch_assoc($getProgramDENR)) { ?>
                                                            <option value="<?php echo $rowProgramDENR['PROGRAM_DESC']; ?>">
                                                            <?php echo $rowProgramDENR['PROGRAM_DESC']; ?>
                                                            </option>   
                                                <?php } ?>
                                            </select>
                                        </td>   
                                        <td>
                                        <!-- Intervention -->
                                        <?php $getInterDENR = $dbConn->query("SELECT * FROM ref_intervention WHERE OFFICE_CODE = 'DENR'");?>
                                            <select class="form-control form-control-sm col-lg-12 text-xs" name="txtIntervention[]" placeholder="Specific Intervention">
                                                <option value="<?php echo $rowDENR['INFO_INTERVENTION'];?>" selected ><?php echo $rowDENR['INFO_INTERVENTION'];?></option>
                                                <option value="" disabled>SELECT INTERVENTION</option>
                                                <?php while($rowInterDENR = mysqli_fetch_assoc($getInterDENR)) { ?>
                                                            <option value="<?php echo $rowInterDENR['INTERVENTION_DESC']; ?>">
                                                            <?php echo $rowInterDENR['INTERVENTION_DESC']; ?>
                                                            </option>   
                                                <?php } ?>
                                            </select>
                                        </td>
                                                    
                            
                                            <td><input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtQuantity[]" value="<?php echo $rowDENR['INFO_COMM_QUANTITY'];?>"placeholder="Committed Quantity" onkeyup="this.value = this.value.toUpperCase();">
                                            </td>
                                            
                                            <td>
                                                    <!-- UNIT -->
                                                    
                                                    <select class="form-control form-control-sm col-lg-12 text-xs" name="txtUnit[]" placeholder="Unit">
                                                    <option value="<?php echo $rowDENR['INFO_UNIT'];?>"><?php echo $rowDENR['INFO_UNIT'];?></option>
                                                    <option value="" disabled >SELECT UNIT</option>
                                                    <?php  $query_unitDENR = $dbConn->query("SELECT * FROM ref_unit"); ?>
                                                    <?php while($rowUnitDENR = mysqli_fetch_assoc($query_unitDENR)) { ?>
                                                                <option value="<?php echo $rowUnitDENR['UNIT']; ?>">
                                                                <?php echo $rowUnitDENR['UNIT']; ?>
                                                                </option>   
                                                    <?php } ?>
                                                    </select>
                                            </td>
                                            <td>
                                                <select name="txtYear[]" class="form-control  form-control-sm col-lg-12 text-xs">
                                                    <option value="<?php echo $rowDENR['INFO_YEAR'];?>"><?php echo $rowDENR['INFO_YEAR'];?></option>
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
                                            <td><input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtBudget[]" value="<?php echo $rowDENR['INFO_COMM_BUDGET'];?>" placeholder="Financial Target ('000)" onkeyup="this.value = this.value.toUpperCase();"></td>
                                            <td class="text-center">
                                            <?php if($certCountDENR==1){ ?>
                                            <button type="button" id="addMoreDENR" name="somethingbtn" class="btn btn-success btn-sm addMoreDENR"><i class="fas fa-plus fa-white"></i></button>
                                            <?php } else { ?>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm removeDENR"><i class="fas fa-minus fa-white"></i></a>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                        
                                    <?php } ?>
                                    <tr class="fieldGroupCopyDENR" style="display: none;">
                                    <td>
                                        <!-- OFFICE -->
                                        <input type="hidden" name="SID" value="<?php echo $SID; ?>">
                                        
                                        <select name="txtMainoff[]" class="form-control form-control-sm col-lg-12" id="off_select">
                                        <option value="" selected >SELECT OFFICE</option>
                                        <?php foreach($ref_off_infoDENR as $off_infoDENR) { ?>
                                        <option value="<?php echo $off_infoDENR; ?>"><?php echo rtrim($off_infoDENR,".5");?></option>
                                        <?php } ?>                              
                                        </select>   
                                        </td>
                                        <td>  
                                        
                                        <!-- PROGRAM -->
                                        <?php $getProgramDENR = $dbConn->query("SELECT * FROM ref_programs WHERE PROGRAM_CODE = 'DENR'");?>
                                        <select class="form-control form-control-sm col-lg-12 text-xs" name="txtParticulars[]" placeholder="Program/Project Classification">
                                        <option value="" selected >SELECT PROGRAM</option>
                                        <?php while($rowProgramDENR = mysqli_fetch_assoc($getProgramDENR)) { ?>
                                                    <option value="<?php echo $rowProgramDENR['PROGRAM_DESC']; ?>">
                                                    <?php echo $rowProgramDENR['PROGRAM_DESC']; ?>
                                                    </option>   
                                                    <?php } ?>
                                        </select></td>
                                        <td>
                                            <?php $getInterDENR = $dbConn->query("SELECT * FROM ref_intervention WHERE OFFICE_CODE = 'DENR'");?>
                                            <select class="form-control form-control-sm col-lg-12 text-xs" name="txtIntervention[]" placeholder="Specific Intervention">
                                            <option value="" selected >SELECT INTERVENTION</option>
                                            <?php while($rowInterDENR = mysqli_fetch_assoc($getInterDENR)) { ?>
                                                        <option value="<?php echo $rowInterDENR['INTERVENTION_DESC']; ?>">
                                                        <?php echo $rowInterDENR['INTERVENTION_DESC']; ?>
                                                        </option>   
                                            <?php } ?>
                                            </select>    
                                        </td>
                                        <td><input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtQuantity[]" placeholder="Committed Quantity" onkeyup="this.value = this.value.toUpperCase();">
                                        </td>
                                        <td> <?php  $query_unitDENR = $dbConn->query("SELECT * FROM ref_unit");?>
                                            <select class="form-control form-control-sm col-lg-12 text-xs" name="txtUnit[]" placeholder="Unit">
                                                <option value="" selected >SELECT UNIT</option>
                                                <?php while($rowUnitDENR = mysqli_fetch_assoc($query_unitDENR)) { ?>
                                                            <option value="<?php echo $rowUnitDENR['UNIT']; ?>">
                                                            <?php echo $rowUnitDENR['UNIT']; ?>
                                                            </option>   
                                                <?php } ?>
                                            </select>
                                            </td>
                                            <td>
                                                <select name="txtYear[]" class="form-control form-control-sm col-lg-12 text-xs">
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
                                        <td class="text-center"><a href="javascript:void(0)" class="btn btn-danger btn-sm removeDENR"><i class="fas fa-minus fa-white"></i></a>
                                            
                                    </td>
                                    </tr>
                                </tbody>
                                    </table>
                            </div> 
                            </div> 
                            <!-- END DENR -->