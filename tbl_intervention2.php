
<!DOCTYPE html>
<html>
<head>
<?php require_once('config/database_connection.php'); ?>	
<?php include('session.php'); ?>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
  <title>National Convergence Initiative - Management Information System</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/colreorder/1.5.2/css/colReorder.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.dataTables.min.css">

  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/colreorder/1.5.2/js/dataTables.colReorder.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
  <script type="text/javascript" class="init">
  




$(document).ready(function() {

      var table = $('#example').DataTable( {
        
        "dom": 'Bfrtip',
        "buttons": [
            {
                "extend": 'copyHtml5',
                "exportOptions": {
                    "columns": [ 0, ':visible' ]
                }
            },
            {
                "extend": 'excelHtml5',
                "exportOptions": {
                    "columns": ':visible'
                }
            },
            {
                "extend": 'csvHtml5',
                "exportOptions": {
                    "columns": ':visible'
                }
            },
            {
                "extend": 'pdfHtml5',
                "exportOptions": {
                    "columns": ':visible'
                }
            }
        ],
        "responsive": true,
        "colReorder": true,
        "scrollY": "400px",
        "scrollX": true,
		"paging": true,
		"ordering": false,
        "orderCellsTop": true,
        "fixedHeader": true
      } );

      $('a.toggle-vis').on('click', function (e) {
        e.preventDefault();

        // Get the column API object
        var column = table.column( $(this).attr('data-column') );

        // Toggle the visibility
        column.visible( ! column.visible() );
        $(this).find('input[type=checkbox]').prop("checked", !$(this).find('input[type=checkbox]').prop("checked"));
      
      } );

    } );


  </script>
</head>

<body>
<?php include('sidebar.php');?>
<?php include('menu.php');?>

<?php 
 if($rowUserInfo["INFO_ACCESSLEVEL"] == 'ENCODER'){ 
	$resultprofca = $dbConn->query("SELECT * fROM tbl_profilingca WHERE INFO_USER = '$userid' AND INFO_STAT_AF is NULL GROUP BY SID"); 


    // $resultprofca = $dbConn->query("SELECT 
    // tbl_profilingca.SID,tbl_profilingca.INFO_CON_TYPE,tbl_profilingca.INFO_NAME,tbl_profilingca.INFO_REGION,tbl_profilingca.INFO_PROV,tbl_profilingca.INFO_MUN,
    // tbl_profilingca.INFO_WATERSHED,tbl_profilingca.INFO_TF_FROM,tbl_profilingca.INFO_TF_TO,tbl_profilingca.INFO_STATUS,tbl_profilingca.INFO_COMMODITIES,
    // tbl_profilingca.INFO_REMARKS ,tbl_profilingca.INFO_STAT_AF,tbl_profilingca.INFO_USER,tbl_profilingca.ATTACHED_FILENAME, tbl_vmgob.INFO_VISION, tbl_vmgob.INFO_MISSION,tbl_vmgob.INFO_GOAL,tbl_vmgob.INFO_OBJECTIVE,tbl_vmgob.INFO_BRIEF_DESC, 
    // tbl_interventions.INFO_MAIN, tbl_interventions.INFO_INTERVENTION, tbl_interventions.INFO_PARTICULARS, tbl_interventions.INFO_COMM_QUANTITY, tbl_interventions.INFO_UNIT, tbl_interventions.INFO_COMM_BUDGET
    // FROM   tbl_profilingca
    //        INNER JOIN tbl_interventions
    //                ON tbl_profilingca.SID= tbl_interventions.SID
    //        INNER JOIN tbl_vmgob
    //                ON tbl_interventions.SID = tbl_vmgob.SID WHERE tbl_profilingca.INFO_USER = '$userid' AND tbl_profilingca.INFO_STAT_AF is NULL GROUP BY tbl_profilingca.SID"); 
 }elseif($rowUserInfo["INFO_ACCESSLEVEL"] == 'ENCODER'){ 
	$resultprofca = $dbConn->query("SELECT * fROM tbl_profilingca WHERE INFO_USER = '$userid' AND INFO_STAT_AF ='Flagged' GROUP BY SID"); 
	
 }
 elseif($rowUserInfo["INFO_ACCESSLEVEL"] == 'ADMINISTRATOR'){ 
	$resultprofca = $dbConn->query("SELECT * fROM tbl_profilingca WHERE INFO_USER = '$userid' AND INFO_STAT_AF is NULL GROUP BY SID"); 

    // $resultprofca = $dbConn->query("SELECT 
    // tbl_profilingca.SID,tbl_profilingca.INFO_CON_TYPE,tbl_profilingca.INFO_NAME,tbl_profilingca.INFO_REGION,tbl_profilingca.INFO_PROV,tbl_profilingca.INFO_MUN,
    // tbl_profilingca.INFO_WATERSHED,tbl_profilingca.INFO_TF_FROM,tbl_profilingca.INFO_TF_TO,tbl_profilingca.INFO_STATUS,tbl_profilingca.INFO_COMMODITIES,
    // tbl_profilingca.INFO_REMARKS ,tbl_profilingca.INFO_STAT_AF,tbl_profilingca.INFO_USER,tbl_profilingca.ATTACHED_FILENAME, tbl_vmgob.INFO_VISION, tbl_vmgob.INFO_MISSION,tbl_vmgob.INFO_GOAL,tbl_vmgob.INFO_OBJECTIVE,tbl_vmgob.INFO_BRIEF_DESC, 
    // tbl_interventions.INFO_MAIN, tbl_interventions.INFO_INTERVENTION, tbl_interventions.INFO_PARTICULARS, tbl_interventions.INFO_COMM_QUANTITY, tbl_interventions.INFO_UNIT, tbl_interventions.INFO_COMM_BUDGET
    // FROM   tbl_profilingca
    //        INNER JOIN tbl_interventions
    //                ON tbl_profilingca.SID= tbl_interventions.SID
    //        INNER JOIN tbl_vmgob
    //                ON tbl_interventions.SID = tbl_vmgob.SID WHERE tbl_profilingca.INFO_STAT_AF is NULL GROUP BY tbl_profilingca.SID"); 
 }
?>

<div class="col-lg-12 bg-white border p-3">
        <div class="form-row">
            <div class="col-lg-11">
                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">List of Interventions</h1>
                <hr 999/>
            </div>
        </div>
		  
		<div class="form-row mt-3">
			<div class="col-lg-12">
				<!-- Data Table -->
				<div class="demo-html">
			
					<table id="example" class="display text-xs" style="width:100%;">
						<thead class="bg-accent text-xs">
							<tr style="color:white;background-color: #49657b;">
								<th>ACTIONS</th>  
								<th>CONVERGENCE TYPE</th>
								<th>CONVERGENCE AREA NAME</th>  
								<th>PROVINCE</th>
								<th>WATERSHED</th>    
								<th>STATUS</th>
								<th>COMMODITIES</th>  
							</tr>
						</thead>
						
						<tbody>
							<?php while($rowresult = mysqli_fetch_assoc($resultprofca)){ 
										$SID = $rowresult['SID'];
									?>
									<?php               

											//   PROVINCE
											$provCode = $rowresult['INFO_PROV'];
											$getProv = $dbConn->query("SELECT * FROM psgc_provinces WHERE Code LIKE '$provCode%'");
											$rowProv = mysqli_fetch_assoc($getProv);                 
									?>
								<tr>
									<td class="d-sm-table-cell">
                    <a href="frm_profilingcainfo.php?SID=<?=$rowresult['SID'];?>" class="btn btn-sm btn-outline-success text-xs form-control form-control-sm border">
											<i class="fas fa-eye fa-white"></i>
										</a>
									</td>
									<td><?=$rowresult['INFO_CON_TYPE'];?></td>
										
									<td><?=$rowresult['INFO_NAME'];?></td>   
									
									<td><?=$rowProv['Province'];?></td>  

									<td>
										<?php 
										
											$wat = '';
											$wat = explode(",", $rowresult['INFO_WATERSHED']);
											foreach($wat as $watss) {
												$getwat = $dbConn->query("SELECT * FROM ref_watershed WHERE WS_CODE='$watss'");
												$rowwat = mysqli_fetch_assoc($getwat);
												
												echo $rowwat['NAME_WATERSHED'] .', ';
											}
										?>
									</td>

									<td class="d-sm-table-cell"><?=$rowresult['INFO_STATUS'];?></td>

									<td>
										<?php 
										
											$comm = '';
											$comm = explode(",", $rowresult['INFO_COMMODITIES']);
											foreach($comm as $commo) {
												$getcomm = $dbConn->query("SELECT * FROM ref_priority_commodities WHERE PC_CODE='$commo'");
												$rowcomm = mysqli_fetch_assoc($getcomm);
												
												echo $rowcomm['PC_DESC'] .', ';
											}
										?>
									</td>
								</tr >
							<?php }?>
						</tbody>    
					</table>
				</div>	
			</div>
	   </div>
	   

	</div>

	<!-- MO DAL FOR PROJECT OBJECTIVES AND OUTCOMES-->
<div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-l" role="document">
    <div class="modal-content">
      <!-- MODAL HEADER - START -->
      <div class="modal-header"><h4 class="modal-title info-name">Upload File</h4></div>           
      <!-- MODAL HEADER - END -->
      <!-- MODAL BODY - START -->
        <div class="modal-body modal-bg">
            <div class="row justify-content-center">        
            <form action="func_pdfUpload.php" method="post" enctype="multipart/form-data">
              <div class="modal-body modal-bg">
                  <div class="row justify-content-center">        
                  <input type="file" name="file" size="50"/>
                  <input type="text" name="ID" value="<?php echo $ID; ?>" />  
                  <input type="submit" value="Upload" />
                  </div>
              </div> 

              <!-- MODAL BODY - END -->
            
            </form> 
            </div>
        </div> 
        <!-- MODAL BODY - END -->
        <!-- MODAL FOOTER - START -->
        <div class="modal-footer">
                <div class="form-group">
                   <?php $check = $rowresult['ATTACHED_FILENAME']; if($check<>'N/A'){ ?><a data-toggle="modal" data-target="#projDocOpen" href="#projDocOpen">
                       <button type="submit" class="btn btn-success" data-dismiss="modal"><span class="fas fa-close mr-2"></span>View Uploaded Document</button></a>
                       <?php } ?>         
                   <button type="submit" class="btn btn-secondary" data-dismiss="modal"><span class="fas fa-close mr-2"></span>Close</button>


                </div>
              </div> <!-- end of modal-footer       -->
    </div>     <!-- end of modal-content      -->
  </div>       <!-- end of modal-dialog       -->
</div>         <!-- end of modal-suspended    -->
<!-- MODAL FOR PROJECT OBJECTIVES AND OUTCOMES-->

<!-- OPEN PDF -->
<div class="modal fade" id="projDocOpen" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <!-- MODAL HEADER - START -->
            <div class="modal-header"><h4 class="modal-title info-name">View Project Document:</h4></div>           
            <!-- MODAL HEADER - END -->
            <!-- MODAL BODY - START -->
              <?php $docs = 'uploads/'. $rowresult['ATTACHED_FILENAME']; ?>
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
</div>




<?php include('footer.html'); ?></body>
</html>
