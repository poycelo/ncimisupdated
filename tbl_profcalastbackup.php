
<!DOCTYPE html>
<html>

<head>
<?php include('head.html'); ?>
<?php include('session.php'); ?>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/colreorder/1.5.2/css/colReorder.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.dataTables.min.css">

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

      // Setup - add a text input to each footer cell
      $('#example thead tr').clone(true).appendTo( '#example thead' );
      $('#example thead tr:eq(1) th').each( function (i) {
          var title = $(this).text();
          $(this).html( '<input type="text"/>' );
   
          $( 'input', this ).on( 'keyup change', function () {
              if ( table.column(i).search() !== this.value ) {
                  
                table
                      .column(i)
                      .search( this.value )
                      .draw();
              }
          } );
      } );


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
        "paging": false,
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
  <?php include('sidebarmenu.php');?>
  <?php include('menu.php');?>
  <?php 
 if($rowUserInfo["INFO_ACCESSLEVEL"] == 'ENCODER'){ 
	$resultprofca = $dbConn->query("SELECT * FROM tbl_profilingca WHERE INFO_USER = '$userid' AND INFO_STAT_AF is NULL GROUP BY SID"); 


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
 }
 elseif($rowUserInfo["INFO_ACCESSLEVEL"] == 'VERIFIER'){ 
	$resultprofca = $dbConn->query("SELECT * FROM tbl_profilingca WHERE INFO_AGENCY = '$agency' AND INFO_STAT_AF is NULL GROUP BY SID"); 

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
      <div class="content">
            <div class="col-lg-10">
                    <!-- Page Heading -->
                    <h3 class="text-gray-800">Convergence Area Profile</h3>
            </div>
            <?php if($rowUserInfo["INFO_ACCESSLEVEL"] == 'ENCODER'){ ?>
              <div class="col-lg-1">
                <a href="frm_profilingca.php" class="btn btn-sm btn-primary">
                  <i class="fas fa-plus fa-xs"></i>
                  Add Profile
                </a>
              </div>
            <?php }?>
        <div class="form-row mt-5">
          <div class="col-lg-12">
            <div class="demo-html">
              <div>
                <b>Select Columns to Show</b></label><br>
                <a class="form-control-sm btn btn-sm btn-select-col text-xs toggle-vis" style="background-color:#c3aed6;" data-column="0" ><input type="checkbox" class="cb-element" checked=""/>&nbsp;ACTIONS</a>
                <a class="btn btn-sm btn-select-col text-xs toggle-vis" style="background-color:#8bcdcd;" data-column="1" ><input type="checkbox" class="cb-element" checked=""/>&nbsp;TYPE</a>
                <a class="btn btn-sm btn-select-col text-xs toggle-vis" style="background-color:#ffa62b;" data-column="2" ><input type="checkbox" class="cb-element" checked=""/>&nbsp;NAME</a>
                <a class="btn btn-sm btn-select-col text-xs toggle-vis" style="background-color:#c060a1;" data-column="3" ><input type="checkbox" class="cb-element" checked=""/>&nbsp;REGION</a>
                <a class="btn btn-sm btn-select-col text-xs toggle-vis" style="background-color:#b8de6f;" data-column="4" ><input type="checkbox" class="cb-element" checked=""/>&nbsp;PROVINCE</a>
                <a class="btn btn-sm btn-select-col text-xs toggle-vis" style="background-color:#b2deec;" data-column="5" ><input type="checkbox" class="cb-element" checked=""/>&nbsp;MUNICIPALITY</a>
                <a class="btn btn-sm btn-select-col text-xs toggle-vis" style="background-color:#c3aed6;" data-column="6" ><input type="checkbox" class="cb-element" checked=""/>&nbsp;WATERSHED COVERED</a>
                <a class="btn btn-sm btn-select-col text-xs toggle-vis" style="background-color:#8bcdcd;" data-column="7" ><input type="checkbox" class="cb-element" checked=""/>&nbsp;STATUS OF CADP</a>
                <a class="btn btn-sm btn-select-col text-xs toggle-vis" style="background-color:#ffa62b;" data-column="8" ><input type="checkbox" class="cb-element" checked=""/>&nbsp;COMMODITIES</a>
                <a class="btn btn-sm btn-select-col text-xs toggle-vis" style="background-color:#c060a1;" data-column="9" ><input type="checkbox" class="cb-element" checked=""/>&nbsp;FROM</a>
                <a class="btn btn-sm btn-select-col text-xs toggle-vis" style="background-color:#b8de6f;" data-column="10" ><input type="checkbox" class="cb-element" checked=""/>&nbsp;TO</a>
                <a class="btn btn-sm btn-select-col text-xs toggle-vis" style="background-color:#b2deec;" data-column="11" ><input type="checkbox" class="cb-element" checked=""/>&nbsp;REMARKS</a>
          
                <br><br>
              </div>

              <table id="example" class="table-bordered display text-xs mt-3">
                <thead class="bg-accent text-xs">
                  <tr style="color:white;">
                    <th class="d-sm-table-cell">ACTIONS</th>  
                    <th class="d-sm-table-cell">CONVERGENCE TYPE</th>
                    <th class="d-sm-table-cell">CONVERGENCE AREA NAME</th>  
                    <th class="d-sm-table-cell">REGION</th>  
                    <th class="d-sm-table-cell">PROVINCE</th>
                    <th class="d-sm-table-cell">MUNICIPALITY</th>  
                    <th class="d-sm-table-cell">WATERSHED</th>    
                    <th class="d-sm-table-cell">STATUS</th>
                    <th class="d-sm-table-cell">COMMODITIES</th>  
                    <th class="d-sm-table-cell">FROM</th>  
                    <th class="d-sm-table-cell">TO</th>  
                    <th class="d-sm-table-cell">REMARKS</th>  
                  </tr>
                </thead>
                <tbody>
                <?php 
                  while($rowresult = mysqli_fetch_assoc($resultprofca)){ 
										$SID = $rowresult['SID'];
									?>
                    <?php 
                        // Convert PSGC code to Location Names
                        $geocode = $rowresult['INFO_REGION'];
                        $getLocation = $dbConn->query("SELECT * FROM psgc_region WHERE psgc_code LIKE '$geocode%'");
                        $rowLocation = mysqli_fetch_assoc($getLocation);                  

                        //   PROVINCE
                        $provCode = $rowresult['INFO_PROV'];
                        $getProv = $dbConn->query("SELECT * FROM psgc_provinces WHERE Code LIKE '$provCode%'");
                        $rowProv = mysqli_fetch_assoc($getProv);                 
                    ?>
								<tr>
									<td class="d-sm-table-cell">
										<form method="post" action="export_excel.php?SID=<?php echo $rowresult['SID'];?>">
											<input type="submit" name="export" class="btn btn-sm btn-secondary text-xs form-control form-control-sm mt-1" value="Export">
										</form>

                    <?php if($rowUserInfo['INFO_ACCESSLEVEL']=='ENCODER'){?>
										<a href="vw_profilinginfo.php?SID=<?=$rowresult['SID'];?>" class="btn btn-sm btn-success text-xs form-control form-control-sm mt-1">
											<!-- <i class="fas fa-eye fa-xs fa-white mr-2"></i> -->
											View
                    </a>
                    
                    <?php }?>
                    <?php if($rowUserInfo['INFO_ACCESSLEVEL']=='VERIFIER'){?>
                      <a href="ver_frm_appflag.php?SID=<?=$rowresult['SID'];?>" class="btn btn-sm btn-success text-xs form-control form-control-sm mt-1">
											<i class="fas fa-eye fa-xs fa-white mr-2"></i>
											View
                      </a>
                    <?php }?>
									</td>
									<td class="d-sm-table-cell"><?=$rowresult['INFO_CON_TYPE'];?></td>
										
									<td class="d-sm-table-cell"><?=$rowresult['INFO_NAME'];?></td>   
										
									<td class="d-sm-table-cell"><?=$rowLocation['name'];?></td>  
									
									<td class="d-sm-table-cell"><?=$rowProv['Province'];?></td>  
									
									<td class="d-sm-table-cell">
										<?php 
											$mun = '';
											$mun = explode(",", $rowresult['INFO_MUN']);
											foreach($mun as $muncode) {
												$getmun = $dbConn->query("SELECT * FROM psgc_municipalities WHERE `Code`=$muncode");
												$rowmun = mysqli_fetch_assoc($getmun);
												echo $rowmun['Municipality'] .', ';
											} ?>
									</td>

									<td class="d-sm-table-cell">
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

									<td class="d-sm-table-cell"> <?php 
                         if($rowresult["INFO_STATUS"]==''){ echo "N/A" ; }
                         else{ echo $rowresult["INFO_STATUS"]; }
                        ?></td>

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

									<td class="d-sm-table-cell"><?=$rowresult['INFO_TF_FROM'];?></td>
									
									<td class="d-sm-table-cell"><?=$rowresult['INFO_TF_TO'];?></td>

									<td class="d-sm-table-cell"><?=$rowresult['INFO_REMARKS'];?></td>
								
								</tr >
                <?php }?>
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
        </div>
    </div>
  </div>  

</body>
</html>