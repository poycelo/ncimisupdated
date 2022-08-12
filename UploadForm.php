


<!-- MO DAL FOR PROJECT OBJECTIVES AND OUTCOMES-->
<div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-l" role="document">
    <div class="modal-content">
      <!-- MODAL HEADER - START -->
      <div class="modal-header"><h4 class="modal-title info-name">Add Project Outcomes</h4></div>           
      <!-- MODAL HEADER - END -->
      <!-- MODAL BODY - START -->
        <div class="modal-body modal-bg">
            <div class="row justify-content-center">        
            <form action="func_pdfUpload.php" method="post" enctype="multipart/form-data">
              <div class="modal-body modal-bg">
                  <div class="row justify-content-center">        
                  <input type="file" name="file" size="50"/>
                  <input type="hidden" name="SID" value="<?php echo $SID; ?>" />  
                  <input type="submit" value="Upload" />
                  </div>
              </div> 

              <!-- MODAL BODY - END -->
            
                </form> 
                <input type="hidden" name="info_proj_id"  value="<?php echo $info_proj_id; ?>">
            </div>
        </div> 
        <!-- MODAL BODY - END -->
        <!-- MODAL FOOTER - START -->
        <div class="modal-footer">
                <div class="form-group">
                   <?php $check = $rowresult['ATTACHED_FILENAME']; if($check<>'N/A'){ ?><a data-toggle="modal" data-target="#projDocOpen" href="#projDocOpen"><button type="submit" class="btn btn-success" data-dismiss="modal"><span class="fas fa-close mr-2"></span>View Uploaded Document</button></a><?php } ?>         
                   <button type="submit" class="btn btn-secondary" data-dismiss="modal"><span class="fas fa-close mr-2"></span>Close</button>


                </div>
              </div> <!-- end of modal-footer       -->
    </div>     <!-- end of modal-content      -->
  </div>       <!-- end of modal-dialog       -->
</div>         <!-- end of modal-suspended    -->
<!-- MODAL FOR PROJECT OBJECTIVES AND OUTCOMES-->