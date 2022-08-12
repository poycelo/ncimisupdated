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
        </div>
      


      <!--  -->
      <div class="row mt-5">
        <div class="col-lg-12">
          <div class="row  mx-1  p-3  bg-white" style="border: 1px solid #d6d6d6; border-radius: 10px;">
            <span  style="color:#888; font-size: small;"><span class="fas fa-chart-line fa-md mr-2"></span><b>Total Watersheds covering Convergence Areas per Region</b></span>
            <?php
              $dataPointWS   = array();
      
              $getWS = $dbConn->query("SELECT COUNT(WS_CODE) as cntWS, LEFT(WS_CODE,2) as regCode FROM count_watershed_encoded GROUP BY regCode");                 
              while($rowWS = mysqli_fetch_array($getWS))
              {        
                $getReg = $dbConn->query('SELECT * FROM psgc_region WHERE psgc_code LIKE "'.$rowWS['regCode'].'%" ORDER BY name_code ASC');
                $rowReg = mysqli_fetch_assoc($getReg); 

                $pointWS    = array("label" =>$rowReg['name'], "symbol" =>"Watershed", "y" =>$rowWS['cntWS']);    
                array_push($dataPointWS, $pointWS);   
              }
                // echo json_encode($dataPointWS, JSON_NUMERIC_CHECK);
                ?>
            <div id="chartWS" style="height: 200px; width: 100%; padding: 0;"></div>
          </div>
        </div>
      </div>

      <!--  -->
      <div class="row mt-5">
        <div class="col-lg-12">
          <div class="row  mx-1  p-3  bg-white" style="width: 50%; border: 1px solid #d6d6d6; border-radius: 10px;">
            <span  style="color:#888; font-size: small;"><span class="fas fa-chart-line fa-md mr-2"></span><b>Total Convergence Areas per Region</b></span>
            <?php
      
              $dataPointCon   = array();
      
              $getCon = $dbConn->query("SELECT COUNT(INFO_NAME) as cntName, INFO_REGION FROM `tbl_profilingca` GROUP BY INFO_REGION");                 
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
      </div>
      <!--  --> 
      <div class="row mt-5">
        <div class="col-lg-12">
          <div class="row  mx-1  p-3  bg-white" style="width: 50%; border: 1px solid #d6d6d6; border-radius: 10px;">
            <span  style="color:#888; font-size: small;"><span class="fas fa-chart-line fa-md mr-2"></span><b>Priority Commodities per Region</b></span>
            <?php
      
              $dataPointComm   = array();
      
              $getComm = $dbConn->query("SELECT tbl_profilingca.SID,tbl_profilingca.INFO_REGION, COUNT(tbl_profilingca.INFO_COMMODITIES) as cntComm,psgc_region.psgc_code, psgc_region.name, ref_priority_commodities.PC_CODE
              FROM tbl_profilingca LEFT JOIN ref_priority_commodities ON tbl_profilingca.INFO_COMMODITIES = ref_priority_commodities.PC_CODE LEFT JOIN psgc_region ON tbl_profilingca.INFO_REGION = psgc_region.name");                 
              while($rowComm = mysqli_fetch_array($getComm))
              {        
                $getRegion = $dbConn->query('SELECT * FROM psgc_region WHERE psgc_code LIKE "'.$rowComm['INFO_REGION'].'%" ');
                $rowRegion = mysqli_fetch_assoc($getRegion); 

                $getCommo = $dbConn->query('SELECT * FROM ref_priority_commodities WHERE PC_CODE LIKE "'.$rowComm['INFO_COMMODITIES'].'%" ');
                $rowCommo = mysqli_fetch_assoc($getCommo);

                $pointComm   = array("label" =>$rowRegion['region_name'], "symbol" =>"Priority Commodities", "y" =>$rowComm['cntComm']);    
                array_push($dataPointComm, $pointComm);   
              }
                // echo json_encode($dataPointWS, JSON_NUMERIC_CHECK);
                ?>
            <div id="chartComm" style="height: 200px; width: 100%; padding: 0;"></div> 
          </div>
        </div>
      </div>

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
// chartConProf.render();
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
        showInLegend: true,
        name: "Watershed",
        type: "column",
        dataPoints:<?php echo json_encode($dataPointWS, JSON_NUMERIC_CHECK); ?>
          
            }]
});
chartWS.render();


var chartCon= new CanvasJS.Chart("chartCon", {
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
        type: "pie",
        dataPoints:<?php echo json_encode($dataPointCon, JSON_NUMERIC_CHECK); ?>
          
            }]
});
chartCon.render();


var chartComm = new CanvasJS.Chart("chartComm", {
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
        name: "Priority Commodities",
        type: "column",
        dataPoints:<?php echo json_encode($dataPointComm, JSON_NUMERIC_CHECK); ?>
          
            }]
});
chartComm.render();
</script>