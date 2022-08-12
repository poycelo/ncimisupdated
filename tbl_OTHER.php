  <!-- Interventions: Department of the Interior and Local Government (OTHER) -->
  <div class="form-row mt-3">
                        <div class="col-lg-12">
                        <h5 class="custom-font">Other</h5>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-lg-12">
                            <table id="OTHERS" class="table table-bordered table-striped custom-font" width="100%" cellspacing="0">
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
                                <?php $queryOTHER = $dbConn->query("SELECT * FROM tbl_interventions WHERE SID = '$SID' AND INFO_MAIN LIKE '%.5%' ORDER BY INFO_DATETIME ASC"); ?>
                                <?php $countOTHER = mysqli_num_rows($queryOTHER); ?>
                                <tbody>
                                <?php if($countOTHER==0){?>
                                    <!-- OFFICE -->
                                    <input type="hidden" name="SID" value="<?php echo $SID; ?>">

                                    <tr class="fieldGroupOTHER">
                                        <td>
                                        <select name="txtMainoff[]" class="form-control form-control-sm col-lg-12" id="off_select">
                                        <option value="" selected >SELECT OFFICE</option>
                                        <?php foreach($ref_off_infoother as $off_infoother) { ?>
                                        <option value="<?php echo $off_infoother; ?>"><?php echo rtrim($off_infoother,".5");?></option>
                                        <?php } ?>                              
                                        </select>   
                                        </td>
                                        <td>  
                                        <!-- PROGRAM -->
                                            <?php $getProgramOTHER = $dbConn->query("SELECT * FROM ref_programs WHERE OFFICE_CODE = 'OTHER'");?>
                                            <select class="form-control form-control-sm col-lg-12 text-xs" name="txtParticulars[]" placeholder="Program/Project Classification">
                                                <option value="" selected >SELECT PROGRAM</option>
                                                <?php while($rowProgramOTHER = mysqli_fetch_assoc($getProgramOTHER)) { ?>
                                                <option value="<?php echo $rowProgramOTHER['PROGRAM_DESC']; ?>"><?php echo $rowProgramOTHER['PROGRAM_DESC']; ?></option>   
                                                <?php } ?>
                        
                                            </select>
                                        </td>
                                        <td>
                                        <input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtIntervention[]"  placeholder="Specific Intervention" onkeyup="this.value = this.value.toUpperCase();">
                                            
                                        </td>
                                        <td><input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtQuantity[]" placeholder="Committed Quantity" onkeyup="this.value = this.value.toUpperCase();"></td>
                                        <td>
                                            <?php  $query_unitOTHER = $dbConn->query("SELECT * FROM ref_unit");?>
                                            <select class="form-control form-control-sm col-lg-12 text-xs" name="txtUnit[]" placeholder="Unit">
                                                <option value="" selected >SELECT UNIT</option>
                                                <?php while($rowUnitOTHER = mysqli_fetch_assoc($query_unitOTHER)) { ?>
                                                <option value="<?php echo $rowUnitOTHER['UNIT']; ?>"><?php echo $rowUnitOTHER['UNIT']; ?></option>   
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
                                        <td class="text-center"><button type="button" id="addMoreOTHER" name="somethingbtn" class="btn btn-success btn-sm addMoreOTHER"><i class="fas fa-plus fa-white"></i></button></td>
                                    </tr>


                                <?php }
                                    $certCountOTHER = 0; // counter for certificates. 1st record will have 'add' button, succeeding rows will have 'remove' button.
                                    while($rowOTHER = mysqli_fetch_assoc($queryOTHER)){ 
                                                $certCountOTHER = $certCountOTHER + 1; ?>
                                    <tr class="fieldGroupOTHER">
                                        
                                            <td>
                                                 <?php $getOfficeOTHER = $dbConn->query("SELECT * FROM ref_offices2 WHERE CODE_MAIN = '5'");?>
                                                <select name="txtMainoff[]" class="form-control form-control-sm col-lg-12" id="off_select">
                                                <option value="<?php echo $rowOTHER['INFO_MAIN'];?>" selected ><?php echo rtrim($rowOTHER['INFO_MAIN'],".5");?></option>  
                                                <option value="" disabled>SELECT OFFICE</option>    
                                                <?php while($rowOfficeOTHER = mysqli_fetch_assoc($getOfficeOTHER)) { ?>
                                                            <option value="<?php echo $rowOfficeOTHER['INFO_OFFICE']; ?>">
                                                            <?php echo $rowOfficeOTHER['INFO_OFFICE']; ?>
                                                            </option>  
                                                <?php } ?>                              
                                                </select>   
                                            </td> 
                                            <td>
                                            <!-- PROGRAM -->
                                                            
                                            <?php $getProgramOTHER = $dbConn->query("SELECT * FROM ref_programs WHERE PROGRAM_CODE = 'OTHER'");?>
                                            <select class="form-control form-control-sm col-lg-12 text-xs" name="txtParticulars[]" placeholder="Program/Project Classification">
                                                <option value="<?php echo $rowOTHER['INFO_PARTICULARS'];?>" selected ><?php echo $rowOTHER['INFO_PARTICULARS'];?></option>    
                                                <option value="" disabled>SELECT PROGRAM</option>
                                                <?php while($rowProgramOTHER = mysqli_fetch_assoc($getProgramOTHER)) { ?>
                                                            <option value="<?php echo $rowProgramOTHER['PROGRAM_DESC']; ?>">
                                                            <?php echo $rowProgramOTHER['PROGRAM_DESC']; ?>
                                                            </option>   
                                                <?php } ?>
                                            </select>
                                        </td>   
                                        <td>
                                        <input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtIntervention[]" value="<?php echo $rowOTHER['INFO_INTERVENTION'];?>"  placeholder="Specific Intervention" onkeyup="this.value = this.value.toUpperCase();">
                                            
                                        </td>
                                                    
                            
                                            <td><input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtQuantity[]" value="<?php echo $rowOTHER['INFO_COMM_QUANTITY'];?>"placeholder="Committed Quantity" onkeyup="this.value = this.value.toUpperCase();">
                                            </td>
                                            
                                            <td>
                                                    <!-- UNIT -->
                                                    
                                                    <select class="form-control form-control-sm col-lg-12 text-xs" name="txtUnit[]" placeholder="Unit">
                                                    <option value="<?php echo $rowOTHER['INFO_UNIT'];?>"><?php echo $rowOTHER['INFO_UNIT'];?></option>
                                                    <option value="" disabled >SELECT UNIT</option>
                                                    <?php  $query_unitOTHER = $dbConn->query("SELECT * FROM ref_unit"); ?>
                                                    <?php while($rowUnitOTHER = mysqli_fetch_assoc($query_unitOTHER)) { ?>
                                                                <option value="<?php echo $rowUnitOTHER['UNIT']; ?>">
                                                                <?php echo $rowUnitOTHER['UNIT']; ?>
                                                                </option>   
                                                    <?php } ?>
                                                    </select>
                                            </td>
                                            <td>
                                                <select name="txtYear[]" class="form-control  form-control-sm col-lg-12 text-xs">
                                                    <option value="<?php echo $rowDA['INFO_YEAR'];?>"><?php echo $rowDA['INFO_YEAR'];?></option>
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
                                             <td><input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtBudget[]" value="<?php echo $rowOTHER['INFO_COMM_BUDGET'];?>" placeholder="Financial Target ('000)" onkeyup="this.value = this.value.toUpperCase();"></td>
                                            <td class="text-center">
                                            <?php if($certCountOTHER==1){ ?>
                                            <button type="button" id="addMoreOTHER" name="somethingbtn" class="btn btn-success btn-sm addMoreOTHER"><i class="fas fa-plus fa-white"></i></button>
                                            <?php } else { ?>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm removeOTHER"><i class="fas fa-minus fa-white"></i></a>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                        
                                    <?php } ?>
                                    <tr class="fieldGroupCopyOTHER" style="display: none;">
                                    <td>
                                        <!-- OFFICE -->
                                        <input type="hidden" name="SID" value="<?php echo $SID; ?>">
                                        
                                        <select name="txtMainoff[]" class="form-control form-control-sm col-lg-12" id="off_select">
                                        <option value="" selected >SELECT OFFICE</option>
                                        <?php foreach($ref_off_infoother as $off_infoother) { ?>
                                        <option value="<?php echo $off_infoother; ?>"><?php echo rtrim($off_infoother,".5");?></option>
                                        <?php } ?>                              
                                        </select>   
                                        </td>
                                        <td>  
                                        
                                        <!-- PROGRAM -->
                                        <?php $getProgramOTHER = $dbConn->query("SELECT * FROM ref_programs WHERE PROGRAM_CODE = 'OTHER'");?>
                                        <select class="form-control form-control-sm col-lg-12 text-xs" name="txtParticulars[]" placeholder="Program/Project Classification">
                                        <option value="" selected >SELECT PROGRAM</option>
                                        <?php while($rowProgramOTHER = mysqli_fetch_assoc($getProgramOTHER)) { ?>
                                                    <option value="<?php echo $rowProgramOTHER['PROGRAM_DESC']; ?>">
                                                    <?php echo $rowProgramOTHER['PROGRAM_DESC']; ?>
                                                    </option>   
                                                    <?php } ?>
                                        </select></td>
                                        <td>
                                        <input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtIntervention[]"  placeholder="Specific Intervention" onkeyup="this.value = this.value.toUpperCase();">
                                            
                                        </td>
                                        <td><input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtQuantity[]" placeholder="Committed Quantity" onkeyup="this.value = this.value.toUpperCase();">
                                        </td>
                                        <td> <?php  $query_unitOTHER = $dbConn->query("SELECT * FROM ref_unit");?>
                                            <select class="form-control form-control-sm col-lg-12 text-xs" name="txtUnit[]" placeholder="Unit">
                                                <option value="" selected >SELECT UNIT</option>
                                                <?php while($rowUnitOTHER = mysqli_fetch_assoc($query_unitOTHER)) { ?>
                                                            <option value="<?php echo $rowUnitOTHER['UNIT']; ?>">
                                                            <?php echo $rowUnitOTHER['UNIT']; ?>
                                                            </option>   
                                                <?php } ?>
                                            </select>
                                            </td>
                                            <td><input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtYear[]" placeholder="Year" onkeyup="this.value = this.value.toUpperCase();"></td>       
                                         <td><input type="text" class="form-control form-control-sm col-lg-12 text-xs" name="txtBudget[]" placeholder="Financial Target ('000)" onkeyup="this.value = this.value.toUpperCase();">
                                        </td>
                                        <td class="text-center"><a href="javascript:void(0)" class="btn btn-danger btn-sm removeOTHER"><i class="fas fa-minus fa-white"></i></a>
                                            
                                    </td>
                                    </tr>
                                </tbody>
                                    </table>
                            </div> 
                            </div> 
                            <!-- END OTHER -->