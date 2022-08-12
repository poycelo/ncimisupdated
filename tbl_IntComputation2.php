
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
        "scrollY": true,
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
	$resultprofca = $dbConn->query("SELECT tbl_profilingca.SID, tbl_profilingca.INFO_TF_TO, tbl_profilingca.INFO_CON_TYPE,tbl_profilingca.INFO_NAME, 
   tbl_interventions.INFO_MAIN, tbl_interventions.INFO_INTERVENTION, tbl_interventions.INFO_PARTICULARS, tbl_interventions.INFO_YEAR, tbl_interventions.INFO_OFFICE, 
   tbl_profilingca.INFO_OFFICE, tbl_interventions.INFO_AGENCY, tbl_profilingca.INFO_AGENCY FROM tbl_profilingca INNER JOIN tbl_interventions 
   ON tbl_profilingca.SID=tbl_interventions.SID WHERE tbl_profilingca.INFO_STAT_AF is NULL AND tbl_interventions.INFO_STAT_AF is NULL 
   AND tbl_interventions.INFO_AGENCY='$agency' AND tbl_profilingca.INFO_AGENCY='$agency' GROUP BY tbl_interventions.SID");  
 }
?>

<div class="col-lg-12 bg-white border p-3">
        <div class="form-row">
            <div class="col-lg-11">
                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Accomplishment Report</h1>
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
                        <th>Convergence Area Name</th>  
                        <th>Office</th>
                        <th>Intervention</th>
                        <th>Particulars</th>
                        <th>Year</th>
                        <th>Action</th>
							</tr>
						</thead>
						
						<tbody>
							<?php while($rowresult = mysqli_fetch_assoc($resultprofca)){ 
										$SID = $rowresult['SID'];
									?>
								  <td class="d-sm-table-cell"><?php echo $rowresult['INFO_NAME'];?></td>
                        <td class="d-sm-table-cell" >
                              <?php 
                              if($rowresult['INFO_MAIN']=='DEPARTMENT OF AGRICULTURE'){ echo $row_inter['INFO_MAIN'];}
                              elseif($rowresult['INFO_MAIN']=='DEPARTMENT OF AGRARIAN REFORM'){ echo $rowresult['INFO_MAIN'];}
                              elseif($rowresult['INFO_MAIN']=='DEPARTMENT OF ENVIRONMENT AND NATURAL RESOURCES'){ echo $rowresult['INFO_MAIN'];}
                              elseif($rowresult['INFO_MAIN']=='DEPARTMENT OF THE INTERIOR AND LOCAL GOVERNMENT'){ echo $rowresult['INFO_MAIN'];}
                              else{ echo rtrim($rowresult['INFO_MAIN'],".5");}
                              ?>
                        </td>

                        <td class="d-sm-table-cell" ><?php echo $rowresult['INFO_INTERVENTION'];?></td>
                        
                        <td class="d-sm-table-cell"><?php echo $rowresult['INFO_PARTICULARS'];?></td>
                        <td class="d-sm-table-cell"><?php echo $rowresult['INFO_YEAR'];?></td>
                        <td>
                           <a href="add_interv_percentage.php?SID=<?php echo $rowresult['SID'];?>" class="btn btn-sm btn-outline-success text-xs form-control form-control-sm border">
                           <i class="fas fa-eye fa-green"></i>
                        </a>
                        </td>
								</tr >
							<?php }?>
						</tbody>    
					</table>
				</div>	
			</div>
	   </div>
	   

	</div>
</div>




<?php include('footer.html'); ?></body>
</html>
