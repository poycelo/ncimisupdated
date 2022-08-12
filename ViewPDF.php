<!-- OPEN PDF -->
      <div class="modal fade" id="projDocOpen" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <!-- MODAL HEADER - START -->
            <div class="modal-header"><h4 class="modal-title info-name">View Project Document:</h4></div>           
            <!-- MODAL HEADER - END -->
            <!-- MODAL BODY - START -->
              <?php $docs = 'uploads/'. $row['ATTACHED_FILENAME']; ?>
              <?php
                echo '<embed src="' . $docs . '" frameborder="0" width="100%" height="800px">' ;
              ?>
              

              <!-- MODAL BODY - END -->
              <!-- MODAL FOOTER - START -->
              <div class="modal-footer">
                <div class="form-group">
                   <button type="submit" class="btn btn-secondary" data-dismiss="modal"><span class="fas fa-close mr-2"></span>Close</button>
                </div>
              </div> <!-- end of modal-footer       -->
          </div>
        </div>       <!-- end of modal-dialog       -->
      </div>         <!-- end of modal-suspended    -->
<!-- OPEN PDF -->