  <!-- Interventions: Department of the Interior and Local Government (DILG) -->
  <div class="form-row mt-3">
                        <div class="col-lg-12">
                        <h5 class="custom-font">Department of the Interior and Local Government</h5>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-lg-12">
                            <table id="DILGS" class="table table-bordered table-striped custom-font" width="100%" cellspacing="0">
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
                                <?php $queryDILG = $dbConn->query("SELECT * FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%.4%' ORDER BY INFO_DATETIME ASC"); ?>
                                <?php $countDILG = mysqli_num_rows($queryDILG); ?>
                                <tbody>
                                <?php if($countDILG==0){?>
                                    <!-- OFFICE -->
                                    <input type="hidden" name="SID" value="<?php echo $SID; ?>">

                                    <tr class="fieldGroupDILG">
                                        <td>
                                        <select name="txtMainoff[]" class="form-control form-control-sm col-lg-12" id="off_select">
                                        <option value="" selected >SELECT OFFICE</option>
                                        <?php foreach($ref_off_infoDILG as $off_infoDILG) { ?>
                                        <option value="<?php echo $off_infoDILG; ?>"><?php echo rtrim($off_infoDILG,".4");?></option>
                                        <?php } ?>                              
                                        </select>   
                                        </td>
                                        <td>  
                                        <!-- PROGRAM -->
                                            <?php $getProgramDILG = $dbConn->query("SELECT * FROM ref_programs WHERE OFFICE_CODE = 'DILG'");?>
                                            <select class="form-control form-control-sm col-lg-12 text-xs" name="txtParticulars[]" placeholder="Program/Project Classification">
                                                <option value="" selected >SELECT PROGRAM</option>
                                                <?php while($rowProgramDILG = mysqli_fetch_assoc($getProgramDILG)) { ?>
                                                <option value="<?php echo $rowProgramDILG['PROGRAM_DESC']; ?>"><?php echo $rowProgramDILG['PROGRAM_DESC']; ?></option>   
                                                <?php } ?>
                        
                                            </select>
                                        </td>
                                        <td>
                                            <?php $getInterDILG = $dbConn->query("SELECT * FROM ref_intervention WHERE OFFICE_CODE = 'DILG'");?>
                                            <select class="form-control form-control-sm col-lg-12 text-xs" name="txtIntervention[]" placeholder="Specific Intervention">
                                            <option value="" selected >SELECT INTERVENTION</option>
                                            <?php while($rowInterDILG = mysqli_fetch_assoc($getInterDILG)) { ?>
                                                        <option value="<?php echo $rowInterDILG['INTERVENTION_DESC']; ?>">
                                                        <?php echo $rowInterDILG['INTERVENTION_DESC']; ?>
                                                        </option>   
                                            <?php } ?>
                                            </select>    
                                        </td>
                                        <td><input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtQuantity[]" placeholder="Committed Quantity" onkeyup="this.value = this.value.toUpperCase();"></td>
                                        <td>
                                            <?php  $query_unitDILG = $dbConn->query("SELECT * FROM ref_unit");?>
                                            <select class="form-control form-control-sm col-lg-12 text-xs" name="txtUnit[]" placeholder="Unit">
                                                <option value="" selected >SELECT UNIT</option>
                                                <?php while($rowUnitDILG = mysqli_fetch_assoc($query_unitDILG)) { ?>
                                                <option value="<?php echo $rowUnitDILG['UNIT']; ?>"><?php echo $rowUnitDILG['UNIT']; ?></option>   
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
                                        <td class="text-center"><button type="button" id="addMoreDILG" name="somethingbtn" class="btn btn-success btn-sm addMoreDILG"><i class="fas fa-plus fa-white"></i></button></td>
                                    </tr>


                                <?php }
                                    $certCountDILG = 0; // counter for certificates. 1st record will have 'add' button, succeeding rows will have 'remove' button.
                                    while($rowDILG = mysqli_fetch_assoc($queryDILG)){ 
                                                $certCountDILG = $certCountDILG + 1; ?>
                                    <tr class="fieldGroupDILG">
                                        
                                            <td>
                                                 <?php $getOfficeDILG = $dbConn->query("SELECT * FROM ref_offices WHERE CODE_MAIN = '4'");?>
                                                <select name="txtMainoff[]" class="form-control form-control-sm col-lg-12" id="off_select">
                                                <option value="<?php echo $rowDILG['INFO_MAIN'];?>" selected ><?php echo rtrim($rowDILG['INFO_MAIN'],".4");?></option>  
                                                <option value="" disabled>SELECT OFFICE</option>    
                                                <?php while($rowOfficeDILG = mysqli_fetch_assoc($getOfficeDILG)) { ?>
                                                            <option value="<?php echo $rowOfficeDILG['INFO_OFFICE']; ?>">
                                                            <?php echo $rowOfficeDILG['INFO_OFFICE']; ?>
                                                            </option>  
                                                <?php } ?>                              
                                                </select>   
                                            </td> 
                                            <td>
                                            <!-- PROGRAM -->
                                                            
                                            <?php $getProgramDILG = $dbConn->query("SELECT * FROM ref_programs WHERE PROGRAM_CODE = 'DILG'");?>
                                            <select class="form-control form-control-sm col-lg-12 text-xs" name="txtParticulars[]" placeholder="Program/Project Classification">
                                                <option value="<?php echo $rowDILG['INFO_PARTICULARS'];?>" selected ><?php echo $rowDILG['INFO_PARTICULARS'];?></option>    
                                                <option value="" disabled>SELECT PROGRAM</option>
                                                <?php while($rowProgramDILG = mysqli_fetch_assoc($getProgramDILG)) { ?>
                                                            <option value="<?php echo $rowProgramDILG['PROGRAM_DESC']; ?>">
                                                            <?php echo $rowProgramDILG['PROGRAM_DESC']; ?>
                                                            </option>   
                                                <?php } ?>
                                            </select>
                                        </td>   
                                        <td>
                                        <!-- Intervention -->
                                        <?php $getInterDILG = $dbConn->query("SELECT * FROM ref_intervention WHERE OFFICE_CODE = 'DILG'");?>
                                            <select class="form-control form-control-sm col-lg-12 text-xs" name="txtIntervention[]" placeholder="Specific Intervention">
                                                <option value="<?php echo $rowDILG['INFO_INTERVENTION'];?>" selected ><?php echo $rowDILG['INFO_INTERVENTION'];?></option>
                                                <option value="" disabled>SELECT INTERVENTION</option>
                                                <?php while($rowInterDILG = mysqli_fetch_assoc($getInterDILG)) { ?>
                                                            <option value="<?php echo $rowInterDILG['INTERVENTION_DESC']; ?>">
                                                            <?php echo $rowInterDILG['INTERVENTION_DESC']; ?>
                                                            </option>   
                                                <?php } ?>
                                            </select>
                                        </td>
                                                    
                            
                                            <td><input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtQuantity[]" value="<?php echo $rowDILG['INFO_COMM_QUANTITY'];?>"placeholder="Committed Quantity" onkeyup="this.value = this.value.toUpperCase();">
                                            </td>
                                            
                                            <td>
                                                    <!-- UNIT -->
                                                    
                                                    <select class="form-control form-control-sm col-lg-12 text-xs" name="txtUnit[]" placeholder="Unit">
                                                    <option value="<?php echo $rowDILG['INFO_UNIT'];?>"><?php echo $rowDILG['INFO_UNIT'];?></option>
                                                    <option value="" disabled >SELECT UNIT</option>
                                                    <?php  $query_unitDILG = $dbConn->query("SELECT * FROM ref_unit"); ?>
                                                    <?php while($rowUnitDILG = mysqli_fetch_assoc($query_unitDILG)) { ?>
                                                                <option value="<?php echo $rowUnitDILG['UNIT']; ?>">
                                                                <?php echo $rowUnitDILG['UNIT']; ?>
                                                                </option>   
                                                    <?php } ?>
                                                    </select>
                                            </td>
                                            <td>
                                                <select name="txtYear[]" class="form-control  form-control-sm col-lg-12 text-xs">
                                                    <option value="<?php echo $rowDILG['INFO_YEAR'];?>"><?php echo $rowDILG['INFO_YEAR'];?></option>
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
                                            <td><input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtBudget[]" value="<?php echo $rowDILG['INFO_COMM_BUDGET'];?>" placeholder="Financial Target ('000)" onkeyup="this.value = this.value.toUpperCase();"></td>
                                            <td class="text-center">
                                            <?php if($certCountDILG==1){ ?>
                                            <button type="button" id="addMoreDILG" name="somethingbtn" class="btn btn-success btn-sm addMoreDILG"><i class="fas fa-plus fa-white"></i></button>
                                            <?php } else { ?>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm removeDILG"><i class="fas fa-minus fa-white"></i></a>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                        
                                    <?php } ?>
                                    <tr class="fieldGroupCopyDILG" style="display: none;">
                                    <td>
                                        <!-- OFFICE -->
                                        <input type="hidden" name="SID" value="<?php echo $SID; ?>">
                                        
                                        <select name="txtMainoff[]" class="form-control form-control-sm col-lg-12" id="off_select">
                                        <option value="" selected >SELECT OFFICE</option>
                                        <?php foreach($ref_off_infoDILG as $off_infoDILG) { ?>
                                        <option value="<?php echo $off_infoDILG; ?>"><?php echo rtrim($off_infoDILG,".4");?></option>
                                        <?php } ?>                              
                                        </select>   
                                        </td>
                                        <td>  
                                        
                                        <!-- PROGRAM -->
                                        <?php $getProgramDILG = $dbConn->query("SELECT * FROM ref_programs WHERE PROGRAM_CODE = 'DILG'");?>
                                        <select class="form-control form-control-sm col-lg-12 text-xs" name="txtParticulars[]" placeholder="Program/Project Classification">
                                        <option value="" selected >SELECT PROGRAM</option>
                                        <?php while($rowProgramDILG = mysqli_fetch_assoc($getProgramDILG)) { ?>
                                                    <option value="<?php echo $rowProgramDILG['PROGRAM_DESC']; ?>">
                                                    <?php echo $rowProgramDILG['PROGRAM_DESC']; ?>
                                                    </option>   
                                                    <?php } ?>
                                        </select></td>
                                        <td>
                                        <?php $getInterDILG = $dbConn->query("SELECT * FROM ref_intervention WHERE OFFICE_CODE = 'DILG'");?>
                                            <select class="form-control form-control-sm col-lg-12 text-xs" name="txtIntervention[]" placeholder="Specific Intervention">
                                            <option value="" selected >SELECT INTERVENTION</option>
                                            <?php while($rowInterDILG = mysqli_fetch_assoc($getInterDILG)) { ?>
                                                        <option value="<?php echo $rowInterDILG['INTERVENTION_DESC']; ?>">
                                                        <?php echo $rowInterDILG['INTERVENTION_DESC']; ?>
                                                        </option>   
                                            <?php } ?>
                                            </select>    
                                        </td>
                                        <td><input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtQuantity[]" placeholder="Committed Quantity" onkeyup="this.value = this.value.toUpperCase();">
                                        </td>
                                        <td> <?php  $query_unitDILG = $dbConn->query("SELECT * FROM ref_unit");?>
                                            <select class="form-control form-control-sm col-lg-12 text-xs" name="txtUnit[]" placeholder="Unit">
                                                <option value="" selected >SELECT UNIT</option>
                                                <?php while($rowUnitDILG = mysqli_fetch_assoc($query_unitDILG)) { ?>
                                                            <option value="<?php echo $rowUnitDILG['UNIT']; ?>">
                                                            <?php echo $rowUnitDILG['UNIT']; ?>
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
                                        <td class="text-center"><a href="javascript:void(0)" class="btn btn-danger btn-sm removeDILG"><i class="fas fa-minus fa-white"></i></a>
                                            
                                    </td>
                                    </tr>
                                </tbody>
                                    </table>
                            </div> 
                            </div> 
                            <!-- END DILG -->