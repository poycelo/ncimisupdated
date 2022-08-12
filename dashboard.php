<?php error_reporting(0); ?>
<?php include('head.html'); ?>
<?php include('session.php'); ?>
<body>
<?php include('sidebar.php');?>
<?php include('menu.php');?>

<!-- Start of Content -->

<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- page heading -->
  
    <div class="bg-white p-5 shadow p-3 mb-5 bg-light rounded">
        <!-- Content Row -->
        <div class="d-sm-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
          <h1 class="h5 mb-0 text-gray-800">DASHBOARD</h1>
          
        <a href="dashboard_per_region.php" class="btn btn-sm btn-success  border">
                         BREAK DOWN COMMODITIES PER REGION
                        </a>  
        </div>
      
    <!--  -->
    <!-- <div class="row mt-5"> -->
        <!-- <div class="col-lg-12"> -->
          <!-- <div class="row  mx-1  p-3  bg-white" style="border: 1px solid #d6d6d6; border-radius: 10px;"> -->
            <!-- <span  style="color:#888; font-size: small;"><span class="fas fa-chart-line fa-md mr-2"></span><b>Total Approved CADP's per Region</b></span> -->
            <?php
              $dataPointcadp   = array();
      
              $getcadp = $dbConn->query("SELECT * FROM vw_cadp");                 
              while($rowcadp = mysqli_fetch_array($getcadp))
              {        
                $getRegcadp = $dbConn->query('SELECT * FROM psgc_region WHERE psgc_code LIKE "'.$rowcadp['INFO_REGION'].'%" ORDER BY name_code ASC');
                $rowRegcadp = mysqli_fetch_assoc($getRegcadp); 

                $pointcadp    = array("label" =>$rowRegcadp['region_name'], "y" =>$rowcadp['cnt_type']);    
                array_push($dataPointcadp, $pointcadp);   
              }
                // echo json_encode($dataPointWS, JSON_NUMERIC_CHECK);
                ?>
            <!-- <div id="" style="height: 200px; width: 100%; padding: 0;"></div> -->
          <!-- </div>   -->
        <!-- </div> -->
    <!-- </div> -->
 <!--  -->

      <!--  -->
      <div class="row mt-5">
        <div class="col-lg-6">
          <div class="row  mx-1  p-3  bg-white" style="border: 1px solid #d6d6d6; border-radius: 10px;">
            <span  style="color:#888; font-size: small;"><span class="fas fa-chart-line fa-md mr-2"></span><b>Total Watersheds Covered per Convergence Area</b></span>
            <?php
              $dataPointWS   = array();

              $getWS = $dbConn->query("SELECT `ncimisdb`.`tbl_profilingca`.`INFO_REGION` AS `INFO_REGION`,group_concat(distinct concat('',`ncimisdb`.`tbl_profilingca`.`INFO_WATERSHED`,'') separator ',') AS `combined_ws` FROM `ncimisdb`.`tbl_profilingca` group by `ncimisdb`.`tbl_profilingca`.`INFO_REGION`");
              $cntWS = mysqli_num_rows($getWS);
              $rowWS = mysqli_fetch_assoc($getWS);                   
              
              $arrayWS = explode(",", $rowWS['combined_ws']);
                          
              foreach($arrayWS as $WS){
                  $count_WS = 0;
                  foreach($arrayWS as $WS_compare){
                      {                           
                          if($WS==$WS_compare){
                              $count_WS = $count_WS + 1;
                          }
                      }                       
                  }
                      $getwsname = $dbConn->query("SELECT * FROM ref_watershed WHERE WS_CODE = $WS");
                      $rowwsname = mysqli_fetch_assoc($getwsname);
                      $pointWS   = array("label" =>$rowwsname['NAME_WATERSHED'] . ' (' . $count_WS . ') ', "symbol" =>"Watershed", "y" =>$count_WS);    
                      array_push($dataPointWS, $pointWS);   
              }
              // $getWS = $dbConn->query("SELECT count_ws, LEFT(combined_watershed,2) as regCode FROM count_watershed_encoded GROUP BY regCode");                 
              // while($rowWS = mysqli_fetch_array($getWS))
              // {        
              //   $getReg = $dbConn->query('SELECT * FROM psgc_region WHERE psgc_code LIKE "'.$rowWS['regCode'].'%" ORDER BY name_code ASC');
              //   $rowReg = mysqli_fetch_assoc($getReg); 

              //   $pointWS    = array("label" =>$rowReg['region_name'], "symbol" =>"Watershed", "y" =>$rowWS['count_ws']);    
              //   array_push($dataPointWS, $pointWS);   
              // }
                // echo json_encode($dataPointWS, JSON_NUMERIC_CHECK);
                ?>
            <div id="chartWS" style="height: 200px; width: 100%; padding: 0;"></div><?php echo $arrayWS;?>
          </div>
        </div>
 <!--  -->
        <div class="col-lg-6">
          <div class="row  mx-1  p-3  bg-white" style="border: 1px solid #d6d6d6; border-radius: 10px;">
            <span  style="color:#888; font-size: small;"><span class="fas fa-chart-line fa-md mr-2"></span><b>Total No. of Priority Commodities per Region</b></span>
            <?php
              $dataPointPC   = array();
      
              $getPC = $dbConn->query("SELECT INFO_REGION, INFO_STAT_AF, comm_code, ((length(comm_code) - length(replace(comm_code,',',''))) + 1) AS `count_comm` FROM vw_comms GROUP BY INFO_REGION");                 
              while($rowPC = mysqli_fetch_array($getPC))
              {        
                $getRegPC = $dbConn->query('SELECT * FROM psgc_region WHERE psgc_code LIKE "'.$rowPC['INFO_REGION'].'%" ORDER BY name_code ASC');
                $rowRegPC = mysqli_fetch_assoc($getRegPC); 

                $pointPC    = array("label" =>$rowRegPC['region_name'], "symbol" =>"Commodity", "y" =>$rowPC['count_comm']);    
                array_push($dataPointPC, $pointPC);   
              }
                // echo json_encode($dataPointWS, JSON_NUMERIC_CHECK);
                ?>
            <div id="chartPC" style="height: 200px; width: 100%; padding: 0;"></div>
          </div>
        </div>
      </div>

      <!--  -->
      <!--  -->
      <div class="form-row mt-5">
        <div class="col-lg-6">
          <div class="row  mx-1  p-3  bg-white" style="border: 1px solid #d6d6d6; border-radius: 10px;">
            <span  style="color:#888; font-size: small;"><span class="fas fa-chart-line fa-md mr-2"></span><b>Total Approved Convergence Areas per Region</b></span>
            <?php
      
              $dataPointCon   = array();
      
              $getCon = $dbConn->query("SELECT COUNT(INFO_NAME) as cntName, INFO_REGION,INFO_STAT_AF FROM `tbl_profilingca` WHERE INFO_STAT_AF ='Approved' GROUP BY INFO_REGION");                 
              while($rowCon = mysqli_fetch_array($getCon))
              {        
                $getReg = $dbConn->query('SELECT * FROM psgc_region WHERE psgc_code LIKE "'.$rowCon['INFO_REGION'].'%" ');
                $rowReg = mysqli_fetch_assoc($getReg); 

                $pointCon   = array("label" =>$rowReg['region_name'], "symbol" =>"Convergence Area", "y" =>$rowCon['cntName']);    
                array_push($dataPointCon, $pointCon);   
              }
                // echo json_encode($dataPointWS, JSON_NUMERIC_CHECK);
                ?>
            <div id="chartCon" style="height: 200px; width: 100%; padding: 0;"></div> 
            </div>
            </div>
        <div class="col-lg-6">      
          <div class="row  mx-1  p-3  bg-white" style="border: 1px solid #d6d6d6; border-radius: 10px;">
            <span  style="color:#888; font-size: small;"><span class="fas fa-chart-line fa-md mr-2"></span><b>Total Convergence Areas per Region for Review</b></span>
            <?php
      
              $dataPointFR  = array();
      
              $getFR = $dbConn->query("SELECT COUNT(INFO_NAME) as cntName, INFO_REGION, INFO_STAT_AF FROM `tbl_profilingca` WHERE INFO_STAT_AF ='For Review' GROUP BY INFO_REGION");                 
              while($rowFR = mysqli_fetch_array($getFR))
              {        
                $getReg2 = $dbConn->query('SELECT * FROM psgc_region WHERE psgc_code LIKE "'.$rowFR['INFO_REGION'].'%" ');
                $rowReg2 = mysqli_fetch_assoc($getReg2); 

                $pointFR   = array("label" =>$rowReg2['region_name'], "symbol" =>"Convergence Area", "y" =>$rowFR['cntName']);    
                array_push($dataPointFR, $pointFR);   
              }
                // echo json_encode($dataPointWS, JSON_NUMERIC_CHECK);
                ?>
            <div id="chartFR" style="height: 200px; width: 100%; padding: 0;"></div> 
            </div>
        </div>
      </div>
      <!--  --> 

    </div>
  </div>


<?php include('footer.html');?> 
</body>

<script>
// var chartConProf = new CanvasJS.Chart("chartConProf", {
//   animationEnabled: true,
//   exportEnabled: true, 
//   dataPointWidth: 15,

//   // theme: "light2",
//   // title:{
//   // },
//   axisX: {
//     // valueFormatString: "DD MMM,YY",
//   },
//   axisY: {
//     title: "No. of Interventions",
//     includeZero: true,
//     },
//   legend:{
//     cursor: "pointer",
//     fontSize: 12,
//     itemclick: toggleDataSeries
//   },
//   toolTip:{
//     shared: true
//   },
//     data: [{
//         showInLegend: true,
//         name: "DA",
//         type: "column",
//         color: "rgba(0,0,153,0.7)",
//         dataPoints:<?php //echo json_encode($dataPointDA, JSON_NUMERIC_CHECK); ?>
//             },
//             {
//         showInLegend: true,
//         name: "DAR",
//         type: "column",
//         color: "rgba(102,0,51,0.7)",
//         dataPoints:<?php //echo json_encode($dataPointDAR, JSON_NUMERIC_CHECK); ?>
//             },
//             {
//         showInLegend: true,
//         name: "DENR",
//         type: "column",
//         color: "rgba(153,0,204,0.7)",
//         dataPoints:<?php //echo json_encode($dataPointDENR, JSON_NUMERIC_CHECK); ?>
//             },
//             {
//         showInLegend: true,
//         name: "DILG",
//         type: "column",
//         color: "rgba(0,102,51,0.7)",
//         dataPoints:<?php //echo json_encode($dataPointDILG, JSON_NUMERIC_CHECK); ?>
//             }]
// });
// chartConProf.render();

function toggleDataSeries(e){
  if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  }
  else{
    e.dataSeries.visible = true;
  }
chartConProf.render();
}


var chartWS = new CanvasJS.Chart("chartWS", {
  animationEnabled: true,
  exportEnabled: true, 
  dataPointWidth: 15,

  theme: "light1",
  title:{
  },
  axisX: {
    // valueFormatString: "DD MMM,YY",
  },
  axisY: {
    title: "No. of Watersheds",
    includeZero: true,
    },
  legend:{
    cursor: "pointer",
    fontSize: 12,
    itemclick: toggleDataSeries
  },
  toolTip:{
    shared: true
  },
    data: [{
        showInLegend: false,
        name: "No. of Watershed per Region",
        type: "column",
        dataPoints:<?php echo json_encode($dataPointWS, JSON_NUMERIC_CHECK); ?>
          
            }]
});
chartWS.render();

// var chartcadp = new CanvasJS.Chart("chartcadp", {
//   animationEnabled: true,
//   exportEnabled: true, 
//   dataPointWidth: 15,

//   theme: "light1",
//   title:{
//   },
//   axisX: {
//     // valueFormatString: "DD MMM,YY",
//   },
//   axisY: {
//     title: "No. of CADP's",
//     includeZero: true,
//     },
//   legend:{
//     cursor: "pointer",
//     fontSize: 12,
//     itemclick: toggleDataSeries
//   },
//   toolTip:{
//     shared: true
//   },
//     data: [{
//         showInLegend: false,
//         name: "No. of CADP's per Region",
//         type: "column",
//         dataPoints:<?php //echo json_encode($dataPointcadp, JSON_NUMERIC_CHECK); ?>
          
//             }]
// });
// chartcadp.render();

var chartPC = new CanvasJS.Chart("chartPC", {
  animationEnabled: true,
  exportEnabled: true, 
  dataPointWidth: 15,

  theme: "light1",
  title:{
  },
  axisX: {
    // valueFormatString: "DD MMM,YY",
  },
  axisY: {
    title: "No. of Priority Commodities",
    includeZero: true,
    },
  legend:{
    cursor: "pointer",
    fontSize: 12,
    itemclick: toggleDataSeries
  },
  toolTip:{
    shared: true
  },
    data: [{
        showInLegend: true,
        name: "No. of Priority Commodities per Region",
        type: "line",
        dataPoints:<?php echo json_encode($dataPointPC, JSON_NUMERIC_CHECK); ?>
          
            }]
});
chartPC.render();


var chartCon= new CanvasJS.Chart("chartCon", {
  animationEnabled: true,
  exportEnabled: true, 
  dataPointWidth: 15,

  theme: "light2",
  title:{
  },
  axisX: {
    // valueFormatString: "DD MMM,YY",
  },
  axisY: {
    // title: "No. of Watersheds",
    includeZero: true,
    },
  legend:{
    cursor: "pointer",
    display: true,
    fontSize: 12,
    itemclick: toggleDataSeries,
    labels: {
                fontColor: 'rgb(255, 99, 132)'
            }
  },
  toolTip:{
    shared: true
  },
    data: [{
        showInLegend: false,
        // name: "Watershed",
        type: "pie",
        dataPoints:<?php echo json_encode($dataPointCon, JSON_NUMERIC_CHECK); ?>
          
            }]
});
chartCon.render();

var chartFR= new CanvasJS.Chart("chartFR", {
  animationEnabled: true,
  exportEnabled: true, 
  dataPointWidth: 15,

  theme: "light3",
  title:{
  },
  axisX: {
    // valueFormatString: "DD MMM,YY",
  },
  axisY: {
    // title: "No. of Watersheds",
    includeZero: true,
    },
  legend:{
    cursor: "pointer",
    display: true,
    fontSize: 12,
    itemclick: toggleDataSeries,
    labels: {
                fontColor: 'rgb(255, 99, 132)'
            }
  },
  toolTip:{
    shared: true
  },
    data: [{
        showInLegend: false,
        name: "Watershed",
        type: "doughnut",
        dataPoints:<?php echo json_encode($dataPointFR, JSON_NUMERIC_CHECK); ?>
          
            }]
});
chartFR.render();
</script>