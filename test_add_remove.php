<div class="form-group row mb-0">
      <div class="col-lg-12">
         <table class="table table-bordered table-striped custom-font" width="100%" cellspacing="0">
            <thead class="custom-ffedis text-white">
               <tr>
                  <th width="20%">Registration Permit</th>
                  <th>Registration Number</th>
                  <th>Registration Date</th>
                  <th>Valid Until</th>
                  <th>Place of Filing</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php 
               $getCerts = $dbConn->query("SELECT * FROM enterprise_certifications WHERE enterprise_id='$entId'");
               $cntCerts = mysqli_num_rows($getCerts);
               if($cntCerts==0){ ?>
               <tr class="fieldGroup">
                  <td>
                     <select name="info_certificate[]" class="form-control form-control-sm" id="certType">
                        <option value="">Choose One</option>
                        <option disabled>Registration Permits</option>
                        <option value="Mayor's Permit">Mayor's Permit</option>
                        <option value="CDA">CDA</option>
                        <option value="DOLE">DOLE</option>
                        <option value="DTI">DTI</option>
                        <option value="SEC">SEC</option>
                        <option disabled>Other Certifications / Licenses</option>
                        <option value="FDA-LTO">FDA-LTO</option>
                        <option value="GAP">GAP</option>
                        <option value="GAHP">GAHP</option>
                        <option value="GMP">GMP</option>
                        <option value="GaqP">GaqP</option>
                        <option value="HALAL">HALAL</option>
                        <option value="HACCP">HACCP</option>
                        <option value="KOSHER">KOSHER</option>
                        <option value="ORGANIC">ORGANIC</option>
                        <option value="CSO">CSO</option>
                        <option value="ISO">ISO</option>
                        <option value="BMBE Certificate of Authority">BMBE Certificate of Authority</option>
                        <option value="FAIR TRADE">FAIR TRADE</option>
                        <option value="Others">Others</option>
                     </select>
                  </td>
                  <td><input type="text" class="form-control form-control-sm" name="registration_number[]" placeholder="Registration No."/></td>
                  <td><input type="date" class="form-control form-control-sm" name="registration_date[]"></td>
                  <td><input type="date" class="form-control form-control-sm" name="valid_until[]"></td>
                  <td><input type="text" class="form-control form-control-sm" name="place_filed[]"/></td>
                  <td class="text-center"><button type="button" id="addMore" name="somethingbtn" class="btn btn-success btn-sm addMore"><i class="fas fa-plus fa-white"></i></button>
                  </td>
                </tr>
               <?php }
               $certCount = 0; // counter for certificates. 1st record will have 'add' button, succeeding rows will have 'remove' button.
               while($rowCerts = mysqli_fetch_assoc($getCerts)){ 
                           $certCount = $certCount + 1; ?>
                     <tr class="fieldGroup">
                        <td>
                           <?php if($certCount==1){ ?>
                           <input type="text" name="info_certificate[]" class="form-control form-control-sm" value="<?=$rowCerts['info_certificate'];?>" readonly>
                           <?php } else { ?>
                           <select name="info_certificate[]" class="form-control form-control-sm" id="certType">
                              <option value="<?=$rowCerts['info_certificate'];?>"><?=$rowCerts['info_certificate'];?></option>
                              <option value="">Choose One</option>
                              <option disabled>Registration Permits</option>
                              <option value="Mayor's Permit">Mayor's Permit</option>
                              <option value="CDA">CDA</option>
                              <option value="DOLE">DOLE</option>
                              <option value="DTI">DTI</option>
                              <option value="SEC">SEC</option>
                              <option disabled>Other Certifications / Licenses</option>
                              <option value="FDA-LTO">FDA-LTO</option>
                              <option value="GAP">GAP</option>
                              <option value="GAHP">GAHP</option>
                              <option value="GMP">GMP</option>
                              <option value="GaqP">GaqP</option>
                              <option value="HALAL">HALAL</option>
                              <option value="HACCP">HACCP</option>
                              <option value="KOSHER">KOSHER</option>
                              <option value="ORGANIC">ORGANIC</option>
                              <option value="CSO">CSO</option>
                              <option value="ISO">ISO</option>
                              <option value="BMBE Certificate of Authority">BMBE Certificate of Authority</option>
                              <option value="FAIR TRADE">FAIR TRADE</option>
                              <option value="Others">Others</option>
                           </select>
                           <?php } ?>
                        </td>
                        <td><input type="text" class="form-control form-control-sm" name="registration_number[]" value="<?=$rowCerts['registration_number'];?>" placeholder="Registration No."/></td>
                        <td><input type="date" class="form-control form-control-sm" name="registration_date[]" value="<?=$rowCerts['registration_date'];?>"></td>
                        <td><input type="date" class="form-control form-control-sm" name="valid_until[]" value="<?=$rowCerts['valid_until'];?>"></td>
                        <td><input type="text" class="form-control form-control-sm" name="place_filed[]" value="<?=$rowCerts['place_filed'];?>" /></td>
                        <td class="text-center">
                           <?php if($certCount==1){ ?>
                           <button type="button" id="addMore" name="somethingbtn" class="btn btn-success btn-sm addMore"><i class="fas fa-plus fa-white"></i></button>
                           <?php } else { ?>
                           <a href="javascript:void(0)" class="btn btn-danger btn-sm remove"><i class="fas fa-minus fa-white"></i></a>
                           <?php } ?>
                        </td>
                     </tr>
                     
                  <?php } ?>
                     <tr class="fieldGroupCopy" style="display: none;">
                        <td>
                           <select name="info_certificate[]" class="form-control form-control-sm" id="certType">
                              <option value="" disabled selected>Choose Onsse</option>
                              <option disabled>Registration Permits</option>
                              <option value="Mayor's Permit">Mayor's Permit</option>
                              <option value="CDA">CDA</option>
                              <option value="DOLE">DOLE</option>
                              <option value="DTI">DTI</option>
                              <option value="SEC">SEC</option>
                              <option disabled>Other Certifications / Licenses</option>
                              <option value="FDA-LTO">FDA-LTO</option>
                              <option value="GAP">GAP</option>
                              <option value="GAHP">GAHP</option>
                              <option value="GMP">GMP</option>
                              <option value="GaqP">GaqP</option>
                              <option value="HALAL">HALAL</option>
                              <option value="HACCP">HACCP</option>
                              <option value="KOSHER">KOSHER</option>
                              <option value="ORGANIC">ORGANIC</option>
                              <option value="CSO">CSO</option>
                              <option value="ISO">ISO</option>
                              <option value="BMBE Certificate of Authority">BMBE Certificate of Authority</option>
                              <option value="FAIR TRADE">FAIR TRADE</option>
                              <option value="Others">Others</option>
                           </select>
                        </td>
                        <td><input type="text" name="registration_number[]" class="form-control form-control-sm" placeholder="Registration No."/></td>
                        <td><input type="date" name="registration_date[]" class="form-control form-control-sm"></td>
                        <td><input type="date" name="valid_until[]" class="form-control form-control-sm"></td>
                        <td><input type="text" name="place_filed[]" class="form-control form-control-sm" placeholder="Place Issued" /></td>
                        <td class="text-center"><a href="javascript:void(0)" class="btn btn-danger btn-sm remove"><i class="fas fa-minus fa-white"></i></a></td>
                     </tr>
                  </tbody>
               </table>
            </div>
        </div>
    </div>
</div>



<!-- DYNAMIC ADD / REMOVE FORM GROUP -->
<!-- DYNAMIC ADD / REMOVE FORM GROUP -->
<script>
$(document).ready(function(){
    //group add limit
    var maxGroup = 20;
    var row_id = 0;
    
    //add more fields group
    $(".addMore").click(function(){
        if($('body').find('.fieldGroup').length < maxGroup){
            var fieldHTML = '<tr class="fieldGroup">'+$(".fieldGroupCopy").html()+'</tr>';
            $('body').find('.fieldGroup:last').after(fieldHTML);
        }else{
            alert('Maximum '+maxGroup+' groups are allowed.');
        }
    });
    
    //remove fields group
    $("body").on("click",".remove",function(){ 
        $(this).parents(".fieldGroup").remove();
    });
});

</script>