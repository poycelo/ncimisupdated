<!-- frm_profilingca.php -->
<?php 

if(isset($_POST['saveProf'])){
    $region             = $_POST['txtReg'];
    $prov               = $_POST['txtProvince'];
    $muni               = implode(',',$_POST['txtMunici']);
 
    $LCA_CODE           = $_POST['Name'];
    $conarea_name       = $_POST['txtName'];
    $watershed          = implode(',',$_POST['txtWatershed']);
    $wsothers           = $_POST['txtOthersWs'];
    $comm               = implode(',', $_POST['txtComm']);
    $livestock            = $_POST['txtLivestock'];
    $poultry             = $_POST['txtPoultry'];
    $others             = $_POST['txtOthers'];
    $comm               = implode(',',$_POST['txtComm']);
    $datefrom           = $_POST['txtDateFrom'];
    $dateto             = $_POST['txtDateTo'];
    $status             = $_POST['txtStatus']; 
    $remarks            = $_POST['txtRemarks']; 
 
    $vision             = $_POST['txtVision'];
    $mission            = $_POST['txtMission'];
    $goals              = $_POST['txtGoal'];
    $objective          = $_POST['txtObj'];
    $briefdesc          = $_POST['txtBriefdesc'];   
 
    $profiling_sql= $dbConn->query('SELECT * FROM tbl_profilingca order by ID DESC LIMIT 1');
    $row_profiling = mysqli_fetch_array($profiling_sql);
    $month = date('m');
    $day =date('d');
    $year = date('Y');
 
    $get_profca = $row_profiling['ID'] + 1;
    $procaid = '10'.$month. $day. $year. $get_profca;
    
 
    $dbConn->query("INSERT INTO tbl_profilingca (SID, INFO_NAME, INFO_CON_TYPE, INFO_REGION, INFO_PROV, INFO_MUN, INFO_WATERSHED , INFO_WATERSHED_OTHERS, INFO_COMMODITIES, INFO_COMM_LIVESTOCK, INFO_COMM_POULTRY, INFO_COMM_OTHERS ,INFO_TF_FROM, INFO_TF_TO, INFO_STATUS, INFO_REMARKS, INFO_USER, INFO_OFFICE, INFO_AGENCY, INFO_ACCESSLEVEL) 
    VALUES ('$procaid', '$conarea_name', '$LCA_CODE', '$region', '$prov', '$muni', '$watershed', '$wsothers','$comm', '$livestock', '$poultry', '$others', '$datefrom', '$dateto' , '$status','$remarks','$userid','$office','$agency', '$accesslvl')");
    
    $dbConn->query("INSERT INTO tbl_vmgob (SID, INFO_VISION, INFO_MISSION, INFO_GOAL, INFO_OBJECTIVE, INFO_BRIEF_DESC,INFO_USER, INFO_OFFICE, INFO_AGENCY, INFO_ACCESSLEVEL)
                  VALUES ('$procaid','$vision','$mission','$goals','$objective','$briefdesc','$userid','$office','$agency', '$accesslvl')");

echo '<script language="javascript">alert("Profile save successfully!")</script>';
echo "<script>window.location.href='vw_profilinginfo.php?SID=$procaid';</script>";
}
?>
<!-- frm_profilingca.php -->

<!-- frm_profilingcainfo -->

<!-- frm_profilingcainfo -->

<!-- frm_profilingca_edit -->

<?php
$SID    = $_REQUEST['SID'];
   
$getprof = $dbConn->query("SELECT * FROM tbl_profilingca WHERE SID='$SID'");
$rowprof = mysqli_fetch_assoc($getprof);

$getvmgob = $dbConn->query("SELECT * FROM tbl_vmgob WHERE SID='$SID'");
$rowvmgob = mysqli_fetch_assoc($getvmgob);


// Convert PSGC code to Location Names
$geocode = $rowprof['INFO_REGION'];
$getLocation = $dbConn->query("SELECT * FROM psgc_region WHERE psgc_code LIKE '$geocode%'");
$rowLocation = mysqli_fetch_assoc($getLocation);   
//   PROVINCE
$provCode = $rowprof['INFO_PROV'];
$getProv = $dbConn->query("SELECT * FROM psgc_provinces WHERE Code LIKE '$provCode%'");
$rowProv = mysqli_fetch_assoc($getProv);   

if(isset($_POST['editprof'])){
    $region             = $_POST['txtRegion'];
    $prov               = $_POST['txtProvince'];
    $muni               = implode(',',$_POST['txtMunici']);

    $LCA_CODE           = $_POST['txtConType'];
    $conarea_name       = $_POST['txtName'];
    $watershed          = implode(',',$_POST['txtWatershed']);
    $wsothers           = $_POST['txtOthersWs'];
    $comm               = implode(',',$_POST['txtComm']);
    $livestock            =$_POST['txtLivestock'];
    $poultry             = $_POST['txtPoultry'];
    $others             = $_POST['txtOthers'];
    $datefrom           = $_POST['txtDateFrom'];
    $dateto             = $_POST['txtDateTo'];
    $status             = $_POST['txtStatus']; 
    $remarks            = $_POST['txtRemarks'];

    $vision             = $_POST['txtVision'];
    $mission            = $_POST['txtMission'];
    $goals              = $_POST['txtGoal'];
    $objective          = $_POST['txtObj'];
    $briefdesc          = $_POST['txtBriefdesc'];



   $dbConn->query("UPDATE tbl_profilingca SET   INFO_NAME         ='$conarea_name', 
                                                INFO_CON_TYPE     ='$LCA_CODE',  
                                                INFO_REGION       ='$region',
                                                INFO_PROV         ='$prov', 
                                                INFO_MUN          ='$muni',
                                                INFO_WATERSHED    ='$watershed',
                                                INFO_WATERSHED_OTHERS ='$wsothers',
                                                INFO_COMM_LIVESTOCK = '$livestock',
                                                INFO_COMM_POULTRY ='$poultry',
                                                INFO_COMM_OTHERS  = '$others', 
                                                INFO_COMMODITIES  ='$comm', 
                                                INFO_TF_FROM      ='$datefrom', 
                                                INFO_TF_TO        ='$dateto', 
                                                INFO_STATUS       ='$status',
                                                INFO_REMARKS      ='$remarks',
                                                INFO_VISION       ='$vision', 
                                                INFO_MISSION      ='$mission',  
                                                INFO_GOAL         ='$goals',                                          
                                                INFO_OBJECTIVE    ='$objective', 
                                                INFO_BRIEF_DESC   ='$briefdesc'
                  WHERE SID='$SID'");

// $result = $dbConn->query("SELECT * FROM tbl_vmgob WHERE SID='$SID'");
// $rowcount=mysqli_num_rows($result);
//    if($rowcount<=0){
//       $dbConn->query("INSERT INTO tbl_vmgob (SID, INFO_VISION, INFO_MISSION, INFO_GOAL, INFO_OBJECTIVE, INFO_BRIEF_DESC,INFO_USER, INFO_OFFICE, INFO_AGENCY, INFO_ACCESSLEVEL)
//       VALUES ('$SID','$vision','$mission','$goals','$objective','$briefdesc','$user','$office','$agency', '$accesslvl')");
// } else{
//    $dbConn->query("UPDATE tbl_vmgob SET INFO_VISION            ='$vision', 
//                                          INFO_MISSION      ='$mission',  
//                                          INFO_GOAL         ='$goals',
//                                          INFO_OBJECTIVE    ='$objective', 
//                                          INFO_BRIEF_DESC   ='$briefdesc'
//                   WHERE SID='$SID'");
// }
    echo '<script language="javascript">alert("Update successfully!")</script>';
    echo "<script>window.location.href='vw_profilinginfo.php?SID=$SID';</script>";
}
          $watershed = $dbConn->query("SELECT * FROM ref_watershed");
          $conarea = $dbConn->query("SELECT * FROM ref_convergence_area");
?>
<!-- frm_profilingca_edit -->
