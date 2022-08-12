  <?php
    error_reporting(E_ALL);
  require_once('config/database_connection.php'); ?>
  <?php

  $SID   = $_REQUEST['SID'];
      
  $output = '';
  if(isset($_POST["export"]))
  {
 $query ="SELECT 
  tbl_profilingca.SID,tbl_profilingca.INFO_CON_TYPE,tbl_profilingca.INFO_NAME,tbl_profilingca.INFO_REGION,tbl_profilingca.INFO_PROV,tbl_profilingca.INFO_MUN,
  tbl_profilingca.INFO_WATERSHED,tbl_profilingca.INFO_TF_FROM,tbl_profilingca.INFO_TF_TO,tbl_profilingca.INFO_STATUS,tbl_profilingca.INFO_COMMODITIES,
  tbl_profilingca.INFO_REMARKS ,tbl_profilingca.INFO_STAT_AF,tbl_profilingca.INFO_USER, tbl_vmgob.INFO_VISION, tbl_vmgob.INFO_MISSION,tbl_vmgob.INFO_GOAL,tbl_vmgob.INFO_OBJECTIVE,tbl_vmgob.INFO_BRIEF_DESC
  FROM   tbl_profilingca
        INNER JOIN tbl_vmgob
                ON tbl_profilingca.SID = tbl_vmgob.SID  WHERE  tbl_profilingca.SID = '$SID' AND tbl_vmgob.SID = '$SID'";
            
  $result= $dbConn->query($query);

  if(mysqli_num_rows($result) > 0)
  {
    $output .= '
    <table class="table" border="1" >  
        <tr>  
        <th style="background-color: #49657b; color:white;">TYPE</th>  
        <th style="background-color: #49657b; color:white;">CONVERGENCE AREA NAME</th>  
        <th style="background-color: #49657b; color:white;">REGION</th>  
        <th style="background-color: #49657b; color:white;">PROVINCE</th>
        <th style="background-color: #49657b; color:white;">MUNICIPALITY</th>  
        <th style="background-color: #49657b; color:white;">WATERSHED</th>  
        <th style="background-color: #49657b; color:white;">DATE FROM</th>  
        <th style="background-color: #49657b; color:white;">DATE TO</th>  
        <th style="background-color: #49657b; color:white;">STATUS</th>  
        <th style="background-color: #49657b; color:white;">COMMODITIES</th>  
        <th style="background-color: #49657b; color:white;">REMARKS</th>
        <th style="background-color: #49657b; color:white;"></th>
        <th style="background-color: #49657b; color:white;">VISION</th>
        <th style="background-color: #49657b; color:white;">MISSION</th>
        <th style="background-color: #49657b; color:white;">GOAL</th>
        <th style="background-color: #49657b; color:white;">OBJECTIVE</th>
        <th style="background-color: #49657b; color:white;">BRIEF DESCRIPTION</th>
        </tr>
    ';

    $i = 0;
    while($row = mysqli_fetch_array($result))
    {  

      $query_comm = $dbConn->query("SELECT * FROM tbl_priority_commodities WHERE sid ='$SID'"); // Convert PSGC code to Location Names
    $geocode = $row['INFO_REGION'];
    $getLocation = $dbConn->query("SELECT * FROM psgc_region WHERE psgc_code LIKE '$geocode%'");
    $rowLocation = mysqli_fetch_assoc($getLocation);                  

  //   PROVINCE
    $provCode = $row['INFO_PROV'];
    $getProv = $dbConn->query("SELECT * FROM psgc_provinces WHERE Code LIKE '$provCode%'");
    $rowProv = mysqli_fetch_assoc($getProv);   

  //WATERSHED
  $ws_name = '';
  $ws_name = explode(",", $row['INFO_WATERSHED']);
  $ws_col = "";
  foreach($ws_name as $name_ws) {
      //echo $municipality = trim($municipality) . '<br/>';
      $getws = $dbConn->query("SELECT * FROM ref_watershed WHERE `WS_CODE`=$name_ws");
      $rowws = mysqli_fetch_assoc($getws);
      $ws_col .= $rowws['NAME_WATERSHED'] .', ';
      // echo $rowws['NAME_WATERSHED'] . '<br/>';
  }   

  //MUNICIPALITY
      $municipalities = "";
      $municipalities = explode(",", $row["INFO_MUN"]);
      $municipalities_col = "";
      foreach($municipalities as $municipality) {
      $getMunicipality = $dbConn->query("SELECT * FROM psgc_municipalities WHERE `Code`=$municipality");
      $rowMunicipality = mysqli_fetch_assoc($getMunicipality);
      $municipalities_col .= $rowMunicipality["Municipality"] .', ';
      }


  // $query_comm = $dbConn->query("SELECT * FROM tbl_priority_commodities WHERE sid ='$SID'");
  // $comm_col = "";
  // while($row_comm = mysqli_fetch_assoc($query_comm)){  
  //           if($row_comm['comm_info']=='OTHERS'){ 
  //             $comm_col .= $row_comm['comm_info'] . '-' .$row_comm['info_other'].' ,';}
  //           else{  $comm_col .= $row_comm['comm_info'].' ,'; }
  //     }
  $comm = "";
  $comm = explode(",", $row["INFO_COMMODITIES"]);
  $comm_col = "";
  foreach($comm as $commo) {
  $getComm = $dbConn->query("SELECT * FROM ref_priority_commodities WHERE `PC_CODE`=$commo");
  $rowComm = mysqli_fetch_assoc($getComm);
  $comm_col .= $rowComm["PC_DESC"] .', ';
  }
    $output .= '
      <tr>';  
            if($i==0){
              $output .= '
                <td>'.$row["INFO_CON_TYPE"].'</td>  
                <td>'.$row["INFO_NAME"].' </td>   
                <td>'.$rowLocation["name"].'</td> 
                <td>'.$rowProv["Province"].'</td> 
                <td>'.rtrim($municipalities_col,' ,').'</td> 
                <td>'.rtrim($ws_col,' ,').'</td> 
                <td>'.$row["INFO_TF_FROM"].'</td> 
                <td>'.$row["INFO_TF_TO"].'</td> 
                <td>'.$row["INFO_STATUS"].'</td> 
                <td>'.rtrim($comm_col,' ,').'</td> 
                <td>'.$row["INFO_REMARKS"].'</td>  
                <td></td>
                <td>'.$row["INFO_VISION"].'</td> 
                <td>'.$row["INFO_MISSION"].'</td> 
                <td>'.$row["INFO_GOAL"].'</td> 
                <td>'.$row["INFO_OBJECTIVE"].'</td> 
                <td>'.$row["INFO_BRIEF_DESC"].'</td>';
                }
    echo  '</tr>';    
    
    $i++;

    }
    $output .= '</table>';
    $expdate = date("Y/m/d");
    header('Content-Type: application/xls');  
    header('Content-Disposition: attachment; filename=CONVERGENCE AREA PROFILING'.$expdate.'.xls');
    echo $output;
  }
  }
  ?>
