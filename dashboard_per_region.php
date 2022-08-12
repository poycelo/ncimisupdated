<?php error_reporting(0); ?>
<?php include('head.html'); ?>
<?php include('session.php'); ?>
<body>
<?php include('sidebar.php');?>
<?php include('menu.php');?>

<!-- Begin Page Content -->
<div class="container-fluid">
<div class="bg-white p-5 shadow p-3 mb-5 bg-light rounded">
      <!-- Content Row -->
        <div class="d-sm-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
          <h1 class="h5 mb-0 text-gray-800">PRIORITY COMMODITIES PER REGION</h1>
        </div>
        <!-- REGION CAR-2 -->
        <div class="form-row mt-5">
        
        <!-- Region CAR -->
              <div class="col-lg-4">
                <div class="row  mx-1  p-3  bg-white" style="border: 1px solid #d6d6d6; border-radius: 10px;">
                    <span  style="color:#888; font-size: small;"><span class="fas fa-chart-line fa-md mr-2"></span><b>Cordillera Administrative Region (CAR)</b></span>
                    <?php
                        
                    $dataPointRegCar  = array();
                    $getComm = $dbConn->query("SELECT * FROM `vw_comms` WHERE INFO_REGION = '140000000'");
                    $cntComm = mysqli_num_rows($getComm);
                    $rowComm = mysqli_fetch_assoc($getComm);                   
                    
                    $array = explode(",", $rowComm['comm_code']);
                                
                    foreach($array as $comm){
                       
                        $count_comm = 0;
                        foreach($array as $comm_compare){
                            {                           
                                if($comm==$comm_compare){
                                    $count_comm = $count_comm + 1;
                                }
                            }                   
                        }
                            $getCommname = $dbConn->query("SELECT * FROM ref_priority_commodities WHERE PC_CODE = $comm");
                            $rowCommname = mysqli_fetch_assoc($getCommname);
                        $pointRegCar   = array("label" =>$rowCommname['PC_DESC'] . ' (' . $count_comm . ') ', "symbol" =>"Convergence Area", "y" =>$count_comm);   
                        array_push($dataPointRegCar, $pointRegCar);   
                    }
                    ?>
                    <div id="chartRegCar" style="height: 300px; width: 100%; padding: 0;"></div>
                </div>
            </div>
            <!-- Region CAR -->              

            <!-- Region 1 -->
              <div class="col-lg-4">
                <div class="row  mx-1  p-3  bg-white" style="border: 1px solid #d6d6d6; border-radius: 10px;">
                    <span  style="color:#888; font-size: small;"><span class="fas fa-chart-line fa-md mr-2"></span><b>Region 1 (ILOCOS REGION)</b></span>
                    <?php
                        
                    $dataPointRegOne  = array();

                    $getComm = $dbConn->query("SELECT * FROM `vw_comms` WHERE INFO_REGION = '010000000'");
                    $cntComm = mysqli_num_rows($getComm);
                    $rowComm = mysqli_fetch_assoc($getComm);                   
                    
                    $arraycomm = explode(",", $rowComm['comm_code']);
                                
                    foreach($arraycomm as $comm){
                        $count_comm = 0;
                        foreach($arraycomm as $comm_compare){
                            {                           
                                if($comm==$comm_compare){
                                    $count_comm = $count_comm + 1;
                                }
                            }                       
                        }
                            $getCommname = $dbConn->query("SELECT * FROM ref_priority_commodities WHERE PC_CODE = $comm");
                            $rowCommname = mysqli_fetch_assoc($getCommname);
                            $pointRegOne   = array("label" =>$rowCommname['PC_DESC'] . ' (' . $count_comm . ') ', "symbol" =>"Convergence Area", "y" =>$count_comm);    
                            array_push($dataPointRegOne, $pointRegOne);   
                    }
                        ?>
                 

                    <div id="chartRegOne" style="min-height: 300px; max-height:300px; width: 100%; padding: 0;"></div>
                </div>
            </div>
            <!-- Region 1 --> 

            <!-- Region 2 -->
                <div class="col-lg-4">      
                    <div class="row  mx-1  p-3  bg-white" style="border: 1px solid #d6d6d6; border-radius: 10px;">
                        <span  style="color:#888; font-size: small;"><span class="fas fa-chart-line fa-md mr-2"></span><b>Region 2 (CAGAYAN VALLEY)</b></span>
                        <?php
                            
                            $dataPointRegTwo  = array();
                            $getComm = $dbConn->query("SELECT * FROM `vw_comms` WHERE INFO_REGION = '020000000'");
                            $cntComm = mysqli_num_rows($getComm);
                            $rowComm = mysqli_fetch_assoc($getComm);                   
                            
                            $array = explode(",", $rowComm['comm_code']);
                                        
                            foreach($array as $comm){
                                $count_comm = 0;
                                foreach($array as $comm_compare){
                                    {                           
                                        if($comm==$comm_compare){
                                            $count_comm = $count_comm + 1;
                                        }
                                    }                       
                                }
                                    $getCommname = $dbConn->query("SELECT * FROM ref_priority_commodities WHERE PC_CODE = $comm");
                                    $rowCommname = mysqli_fetch_assoc($getCommname);
                                $pointRegTwo   = array("label" =>$rowCommname['PC_DESC'] . ' (' . $count_comm . ') ', "symbol" =>"Convergence Area", "y" =>$count_comm);    
                                array_push($dataPointRegTwo, $pointRegTwo);   
                            }
                        ?>
                        <div id="chartRegTwo" style="height: 300px; width: 100%; padding: 0;"></div> 
                    </div>
                </div>
        </div>
            <!-- Region 2--> 

            <!-- Region 3-4B -->
                 <!-- Region 3 -->
                 
        <div class="form-row mt-5">
                <div class="col-lg-4">      
                    <div class="row  mx-1  p-3  bg-white" style="border: 1px solid #d6d6d6; border-radius: 10px;">
                        <span  style="color:#888; font-size: small;"><span class="fas fa-chart-line fa-md mr-2"></span><b>Region 3 (CENTRAL LUZON)</b></span>
                        <?php
                            
                        $dataPointRegThree  = array();
                        
                        $getComm = $dbConn->query("SELECT * FROM `vw_comms` WHERE INFO_REGION = '030000000'");
                        $cntComm = mysqli_num_rows($getComm);
                        $rowComm = mysqli_fetch_assoc($getComm);                   
                        
                        $array = explode(",", $rowComm['comm_code']);
                                    
                        foreach($array as $comm){
                            $count_comm = 0;
                            foreach($array as $comm_compare){
                                {                           
                                    if($comm==$comm_compare){
                                        $count_comm = $count_comm + 1;
                                    }
                                }                       
                            }
                                $getCommname = $dbConn->query("SELECT * FROM ref_priority_commodities WHERE PC_CODE = $comm");
                                $rowCommname = mysqli_fetch_assoc($getCommname);
                            $pointRegThree   =  array("label" =>$rowCommname['PC_DESC'] . ' (' . $count_comm . ') ', "symbol" =>"Convergence Area", "y" =>$count_comm);     
                            array_push($dataPointRegThree, $pointRegThree);   
                        }
                            ?>
                        <div id="chartRegThree" style="height: 300px; width: 100%; padding: 0;"></div> 
                    </div>
                </div>
            <!-- Region 3--> 

               <!-- Region 4A -->
               <div class="col-lg-4">
                <div class="row  mx-1  p-3  bg-white" style="border: 1px solid #d6d6d6; border-radius: 10px;">
                    <span  style="color:#888; font-size: small;"><span class="fas fa-chart-line fa-md mr-2"></span><b>Region 4-A (CALABARZON)</b></span>
                    <?php
                        
                    $dataPointRegFour  = array();
                    $getComm = $dbConn->query("SELECT * FROM `vw_comms` WHERE INFO_REGION = '040000000'");
                    $cntComm = mysqli_num_rows($getComm);
                    $rowComm = mysqli_fetch_assoc($getComm);                   
                    
                    $array = explode(",", $rowComm['comm_code']);
                        
                    foreach($array as $comm){
                        $count_comm = 0;
                        foreach($array as $comm_compare){
                            {                           
                                if($comm==$comm_compare){
                                    $count_comm = $count_comm + 1;
                                }
                            }                       
                        }
                            $getCommname = $dbConn->query("SELECT * FROM ref_priority_commodities WHERE PC_CODE = $comm");
                            $rowCommname = mysqli_fetch_assoc($getCommname);
                        $pointRegFour   = array("label" =>$rowCommname['PC_DESC'] . ' (' . $count_comm . ') ', "symbol" =>"Convergence Area", "y" =>$count_comm);    
                        array_push($dataPointRegFour, $pointRegFour);   
                    }
                        ?>
                    <div id="chartRegFour" style="height: 300px; width: 100%; padding: 0;"></div> 
                </div>
            </div>
            <!-- Region 4A --> 

            <!-- Region 4B -->
            <div class="col-lg-4">
                <div class="row  mx-1  p-3  bg-white" style="border: 1px solid #d6d6d6; border-radius: 10px;">
                    <span  style="color:#888; font-size: small;"><span class="fas fa-chart-line fa-md mr-2"></span><b>Region 4-B (MIMAROPA)</b></span>
                    <?php
                        
                    $dataPointRegFourB  = array();
                    $getComm = $dbConn->query("SELECT * FROM `vw_comms` WHERE INFO_REGION = '170000000'");
                    $cntComm = mysqli_num_rows($getComm);
                    $rowComm = mysqli_fetch_assoc($getComm);                   
                    
                    $array = explode(",", $rowComm['comm_code']);
                   
                    foreach($array as $comm){
                        $count_comm = 0;
                        foreach($array as $comm_compare){
                            {                           
                                if($comm==$comm_compare){
                                    $count_comm = $count_comm + 1;
                                }
                            }                       
                        }
                            $getCommname = $dbConn->query("SELECT * FROM ref_priority_commodities WHERE PC_CODE = $comm");
                            $rowCommname = mysqli_fetch_assoc($getCommname);
                        $pointRegFourB   = array("label" =>$rowCommname['PC_DESC'] . ' (' . $count_comm . ') ', "symbol" =>"Convergence Area", "y" =>$count_comm);   
                        array_push($dataPointRegFourB, $pointRegFourB);   
                    }
                        ?>
                    <div id="chartRegFourB" style="height: 300px; width: 100%; padding: 0;"></div> 
                </div>
            </div>
        </div>
            <!-- Region 4B --> 

            <!-- Region 3-4B -->

            <!-- Region 5-7 -->
               <!-- Region 5 -->
               
           <div class="form-row mt-5">
               <div class="col-lg-4">      
                    <div class="row  mx-1  p-3  bg-white" style="border: 1px solid #d6d6d6; border-radius: 10px;">
                        <span  style="color:#888; font-size: small;"><span class="fas fa-chart-line fa-md mr-2"></span><b>Region 5 (BICOL REGION)</b></span>
                        <?php
                            
                        $dataPointRegFive  = array();
                        $getComm = $dbConn->query("SELECT * FROM `vw_comms` WHERE INFO_REGION = '050000000'");
                        $cntComm = mysqli_num_rows($getComm);
                        $rowComm = mysqli_fetch_assoc($getComm);                   
                        
                        $array = explode(",", $rowComm['comm_code']);
                                    
                        foreach($array as $comm){
                            $count_comm = 0;
                            foreach($array as $comm_compare){
                                {                           
                                    if($comm==$comm_compare){
                                        $count_comm = $count_comm + 1;
                                    }
                                }                       
                            }
                                $getCommname = $dbConn->query("SELECT * FROM ref_priority_commodities WHERE PC_CODE = $comm");
                                $rowCommname = mysqli_fetch_assoc($getCommname);
                            $pointRegFive   = array("label" =>$rowCommname['PC_DESC'] . ' (' . $count_comm . ') ', "symbol" =>"Convergence Area", "y" =>$count_comm);   
                            array_push($dataPointRegFive, $pointRegFive);   
                        }
                            ?>
                        <div id="chartRegFive" style="height: 300px; width: 100%; padding: 0;"></div> 
                    </div>
                </div>
            <!-- Region 5--> 

                <!-- Region 6 -->
                <div class="col-lg-4">      
                <div class="row  mx-1  p-3  bg-white" style="border: 1px solid #d6d6d6; border-radius: 10px;">
                    <span  style="color:#888; font-size: small;"><span class="fas fa-chart-line fa-md mr-2"></span><b>Region 6 (WESTERN VISAYAS)</b></span>
                    <?php
                        
                    $dataPointRegSix  = array();
                    
                    $getComm = $dbConn->query("SELECT * FROM `vw_comms` WHERE INFO_REGION = '060000000'");
                    $cntComm = mysqli_num_rows($getComm);
                    $rowComm = mysqli_fetch_assoc($getComm);                   
                    
                    $array = explode(",", $rowComm['comm_code']);
                                
                    foreach($array as $comm){
                        $count_comm = 0;
                        foreach($array as $comm_compare){
                            {                           
                                if($comm==$comm_compare){
                                    $count_comm = $count_comm + 1;
                                }
                            }                       
                        }
                            $getCommname = $dbConn->query("SELECT * FROM ref_priority_commodities WHERE PC_CODE = $comm");
                            $rowCommname = mysqli_fetch_assoc($getCommname);
                        $pointRegSix   =  array("label" =>$rowCommname['PC_DESC'] . ' (' . $count_comm . ') ', "symbol" =>"Convergence Area", "y" =>$count_comm);    
                        array_push($dataPointRegSix, $pointRegSix);   
                    }
                        ?>
                    <div id="chartRegSix" style="height: 300px; width: 100%; padding: 0;"></div> 
                </div>
            </div>
            <!-- Region 6--> 


            <!-- Region 7 -->
            <div class="col-lg-4">
                <div class="row  mx-1  p-3  bg-white" style="border: 1px solid #d6d6d6; border-radius: 10px;">
                    <span  style="color:#888; font-size: small;"><span class="fas fa-chart-line fa-md mr-2"></span><b>Region 7 (CENTRAL VISAYAS)</b></span>
                    <?php
                        
                    $dataPointRegSeven  = array();
                    $getComm = $dbConn->query("SELECT * FROM `vw_comms` WHERE INFO_REGION = '070000000'");
                    $cntComm = mysqli_num_rows($getComm);
                    $rowComm = mysqli_fetch_assoc($getComm);                   
                    
                    $array = explode(",", $rowComm['comm_code']);
                                
                    foreach($array as $comm){
                        $count_comm = 0;
                        foreach($array as $comm_compare){
                            {                           
                                if($comm==$comm_compare){
                                    $count_comm = $count_comm + 1;
                                }
                            }                       
                        }
                            $getCommname = $dbConn->query("SELECT * FROM ref_priority_commodities WHERE PC_CODE = $comm");
                            $rowCommname = mysqli_fetch_assoc($getCommname);
                        $pointRegSeven   = array("label" =>$rowCommname['PC_DESC'] . ' (' . $count_comm . ') ', "symbol" =>"Convergence Area", "y" =>$count_comm);    
                        array_push($dataPointRegSeven, $pointRegSeven);   
                    }
                        ?>
                    <div id="chartRegSeven" style="height: 300px; width: 100%; padding: 0;"></div> 
                </div>
            </div>
           </div>
            <!-- Region 7 --> 
            <!-- Region 5-7 -->


            <!-- Region 8-10 -->
             <!-- Region 8 -->
           <div class="form-row mt-5">
             <div class="col-lg-4">      
                    <div class="row  mx-1  p-3  bg-white" style="border: 1px solid #d6d6d6; border-radius: 10px;">
                        <span  style="color:#888; font-size: small;"><span class="fas fa-chart-line fa-md mr-2"></span><b>Region 8 (EASTERN VISAYAS)</b></span>
                        <?php
                            
                        $dataPointRegEight  = array();
                        $getComm = $dbConn->query("SELECT * FROM `vw_comms` WHERE INFO_REGION = '080000000'");
                        $cntComm = mysqli_num_rows($getComm);
                        $rowComm = mysqli_fetch_assoc($getComm);                   
                        
                        $array = explode(",", $rowComm['comm_code']);
                                    
                        foreach($array as $comm){
                            $count_comm = 0;
                            foreach($array as $comm_compare){
                                {                           
                                    if($comm==$comm_compare){
                                        $count_comm = $count_comm + 1;
                                    }
                                }                       
                            }
                                $getCommname = $dbConn->query("SELECT * FROM ref_priority_commodities WHERE PC_CODE = $comm");
                                $rowCommname = mysqli_fetch_assoc($getCommname);
                            $pointRegEight   = $pointRegSeven   = array("label" =>$rowCommname['PC_DESC'] . ' (' . $count_comm . ') ', "symbol" =>"Convergence Area", "y" =>$count_comm);   
                            array_push($dataPointRegEight, $pointRegEight);   
                        }
                            ?>
                        <div id="chartRegEight" style="height: 300px; width: 100%; padding: 0;"></div> 
                    </div>
                </div>
            <!-- Region 8--> 

             <!-- Region 9 -->
             <div class="col-lg-4">      
                    <div class="row  mx-1  p-3  bg-white" style="border: 1px solid #d6d6d6; border-radius: 10px;">
                        <span  style="color:#888; font-size: small;"><span class="fas fa-chart-line fa-md mr-2"></span><b>Region 9 (ZAMBOANGA PENINSULA)</b></span>
                        <?php
                            
                        $dataPointRegNine  = array();
                        
                        $getComm = $dbConn->query("SELECT * FROM `vw_comms` WHERE INFO_REGION = '090000000'");
                        $cntComm = mysqli_num_rows($getComm);
                        $rowComm = mysqli_fetch_assoc($getComm);                   
                        
                        $array = explode(",", $rowComm['comm_code']);
                                    
                        foreach($array as $comm){
                            $count_comm = 0;
                            foreach($array as $comm_compare){
                                {                           
                                    if($comm==$comm_compare){
                                        $count_comm = $count_comm + 1;
                                    }
                                }                       
                            }
                                $getCommname = $dbConn->query("SELECT * FROM ref_priority_commodities WHERE PC_CODE = $comm");
                                $rowCommname = mysqli_fetch_assoc($getCommname);
                            $pointRegNine   =  array("label" =>$rowCommname['PC_DESC'] . ' (' . $count_comm . ') ', "symbol" =>"Convergence Area", "y" =>$count_comm);   
                            array_push($dataPointRegNine, $pointRegNine);   
                        }
                            ?>
                        <div id="chartRegNine" style="height: 300px; width: 100%; padding: 0;"></div> 
                    </div>
                </div>
            <!-- Region 9--> 

             <!-- Region 10 -->
             <div class="col-lg-4">      
                    <div class="row  mx-1  p-3  bg-white" style="border: 1px solid #d6d6d6; border-radius: 10px;">
                        <span  style="color:#888; font-size: small;"><span class="fas fa-chart-line fa-md mr-2"></span><b>Region 10 (NORTHERN MINDANAO)</b></span>
                        <?php
                            
                        $dataPointRegTen  = array();
                        
                        $getComm = $dbConn->query("SELECT * FROM `vw_comms` WHERE INFO_REGION = '100000000'");
                        $cntComm = mysqli_num_rows($getComm);
                        $rowComm = mysqli_fetch_assoc($getComm);                   
                        
                        $array = explode(",", $rowComm['comm_code']);
                                    
                        foreach($array as $comm){
                            $count_comm = 0;
                            foreach($array as $comm_compare){
                                {                           
                                    if($comm==$comm_compare){
                                        $count_comm = $count_comm + 1;
                                    }
                                }                       
                            }
                                $getCommname = $dbConn->query("SELECT * FROM ref_priority_commodities WHERE PC_CODE = $comm");
                                $rowCommname = mysqli_fetch_assoc($getCommname);
                            $pointRegTen   =array("label" =>$rowCommname['PC_DESC'] . ' (' . $count_comm . ') ', "symbol" =>"Convergence Area", "y" =>$count_comm);   
                            array_push($dataPointRegTen, $pointRegTen);   
                        }
                            ?>
                        <div id="chartRegTen" style="height: 300px; width: 100%; padding: 0;"></div> 
                    </div>
                </div>
           </div>
            <!-- Region 10--> 
            <!-- Region 8-10 -->

            <!-- Region 11-13 --> 
           <div class="form-row mt-5">  
            <!-- Region 11 -->
             <div class="col-lg-4">      
                    <div class="row  mx-1  p-3  bg-white" style="border: 1px solid #d6d6d6; border-radius: 10px;">
                        <span  style="color:#888; font-size: small;"><span class="fas fa-chart-line fa-md mr-2"></span><b>Region 11 (DAVAO REGION)</b></span>
                        <?php
                            
                        $dataPointRegEleven  = array();
                        
                        $getComm = $dbConn->query("SELECT * FROM `vw_comms` WHERE INFO_REGION = '110000000'");
                        $cntComm = mysqli_num_rows($getComm);
                        $rowComm = mysqli_fetch_assoc($getComm);                   
                        
                        $array = explode(",", $rowComm['comm_code']);
                                    
                        foreach($array as $comm){
                            $count_comm = 0;
                            foreach($array as $comm_compare){
                                {                           
                                    if($comm==$comm_compare){
                                        $count_comm = $count_comm + 1;
                                    }
                                }                       
                            }
                                $getCommname = $dbConn->query("SELECT * FROM ref_priority_commodities WHERE PC_CODE = $comm");
                                $rowCommname = mysqli_fetch_assoc($getCommname);
                            $pointRegEleven  = array("label" =>$rowCommname['PC_DESC'] . ' (' . $count_comm . ') ', "symbol" =>"Convergence Area", "y" =>$count_comm);    
                            array_push($dataPointRegEleven, $pointRegEleven);   
                        }
                            ?>
                        <div id="chartRegEleven" style="height: 300px; width: 100%; padding: 0;"></div> 
                    </div>
                </div>
            <!-- Region 11--> 

            <!-- Region 12 -->
             <div class="col-lg-4">      
                    <div class="row  mx-1  p-3  bg-white" style="border: 1px solid #d6d6d6; border-radius: 10px;">
                        <span  style="color:#888; font-size: small;"><span class="fas fa-chart-line fa-md mr-2"></span><b>Region 12 (SOCCSKRAGEN)</b></span>
                        <?php
                            
                        $dataPointRegTwelve  = array();
                        
                        $getComm = $dbConn->query("SELECT * FROM `vw_comms` WHERE INFO_REGION = '120000000'");
                        $cntComm = mysqli_num_rows($getComm);
                        $rowComm = mysqli_fetch_assoc($getComm);                   
                        
                        $array = explode(",", $rowComm['comm_code']);
                                    
                        foreach($array as $comm){
                            $count_comm = 0;
                            foreach($array as $comm_compare){
                                {                           
                                    if($comm==$comm_compare){
                                        $count_comm = $count_comm + 1;
                                    }
                                }                       
                            }
                                $getCommname = $dbConn->query("SELECT * FROM ref_priority_commodities WHERE PC_CODE = $comm");
                                $rowCommname = mysqli_fetch_assoc($getCommname);
                            $pointRegTwelve   = array("label" =>$rowCommname['PC_DESC'] . ' (' . $count_comm . ') ', "symbol" =>"Convergence Area", "y" =>$count_comm);   
                            array_push($dataPointRegTwelve, $pointRegTwelve);   
                        }
                            ?>
                        <div id="chartRegTwelve" style="height: 300px; width: 100%; padding: 0;"></div> 
                    </div>
                </div>
            <!-- Region 12--> 

            <!-- Region 13 -->
             <div class="col-lg-4">      
                    <div class="row  mx-1  p-3  bg-white" style="border: 1px solid #d6d6d6; border-radius: 10px;">
                        <span  style="color:#888; font-size: small;"><span class="fas fa-chart-line fa-md mr-2"></span><b>Region XIII (CARAGA)</b></span>
                        <?php
                            
                        $dataPointRegThirteen = array();
                        
                        $getComm = $dbConn->query("SELECT * FROM `vw_comms` WHERE INFO_REGION = '160000000'");
                        $cntComm = mysqli_num_rows($getComm);
                        $rowComm = mysqli_fetch_assoc($getComm);                   
                        
                        $array = explode(",", $rowComm['comm_code']);
                                    
                        foreach($array as $comm){
                            $count_comm = 0;
                            foreach($array as $comm_compare){
                                {                           
                                    if($comm==$comm_compare){
                                        $count_comm = $count_comm + 1;
                                    }
                                }                       
                            }
                                $getCommname = $dbConn->query("SELECT * FROM ref_priority_commodities WHERE PC_CODE = $comm");
                                $rowCommname = mysqli_fetch_assoc($getCommname);
                            $pointRegThirteen   = array("label" =>$rowCommname['PC_DESC'] . ' (' . $count_comm . ') ', "symbol" =>"Convergence Area", "y" =>$count_comm);    
                            array_push($dataPointRegThirteen, $pointRegThirteen);   
                        }
                            ?>
                        <div id="chartRegThirteen" style="height: 300px; width: 100%; padding: 0;"></div> 
                    </div>
                </div>
            <!-- Region 13--> 
   
            <!-- Region 11-13 -->

            <!-- BARMM -->
            
               <!-- Region BARMM -->
                <div class="col-lg-4 mt-5">      
                    <div class="row  mx-1  p-3  bg-white" style="border: 1px solid #d6d6d6; border-radius: 10px;">
                        <span  style="color:#888; font-size: small;"><span class="fas fa-chart-line fa-md mr-2"></span><b>Bangsamoro Autonomous Region in Muslim Mindanao (BARMM)</b></span>
                        <?php
                            
                        $dataPointRegBarmm = array();
                        
                        $getComm = $dbConn->query("SELECT * FROM `vw_comms` WHERE INFO_REGION = '150000000'");
                        $cntComm = mysqli_num_rows($getComm);
                        $rowComm = mysqli_fetch_assoc($getComm);                   
                        
                        $array = explode(",", $rowComm['comm_code']);
                                    
                        foreach($array as $comm){
                            $count_comm = 0;
                            foreach($array as $comm_compare){
                                {                           
                                    if($comm==$comm_compare){
                                        $count_comm = $count_comm + 1;
                                    }
                                }                       
                            }
                                $getCommname = $dbConn->query("SELECT * FROM ref_priority_commodities WHERE PC_CODE = $comm");
                                $rowCommname = mysqli_fetch_assoc($getCommname);
                            $pointRegBarmm   = array("label" =>$rowCommname['PC_DESC'] . ' (' . $count_comm . ') ', "symbol" =>"Convergence Area", "y" =>$count_comm);   
                            array_push($dataPointRegBarmm, $pointRegBarmm);   
                        }
                            ?>
                        <div id="chartRegBarmm" style="height: 300px; width: 100%; padding: 0;"></div> 
                    </div>
                </div>
           </div>
            <!-- Region BARMM--> 
            <!-- BARMM -->

</div>
</div>
<?php include('footer.html');?> 
</body>

<script>
// Region CAR
var chartRegCar = new CanvasJS.Chart("chartRegCar", {
		colorSet: "inhalers",
		exportEnabled: true,
		theme: "light1",
		animationEnabled: true,
        dataPointWidth: 25,
		data: [{
		    type: "doughnut",
		    yValueFormatString: "#",
		    indexLabelFontSize: 13,
		    showInLegend: false,
		    legendText: "{label} : {y} ",
		    dataPoints: <?php echo json_encode($dataPointRegCar, JSON_NUMERIC_CHECK); ?>
		    }]
		});
        chartRegCar.render();
//End Region CAR

// Region 1
var chartRegOne = new CanvasJS.Chart("chartRegOne", {
		colorSet: "inhalers",
		exportEnabled: true,
		theme: "light1",
		animationEnabled: true,
		dataPointWidth: 25,
		data: [{
		    type: "doughnut",
		    yValueFormatString: "#",
		    indexLabelFontSize: 13,
		    showInLegend: false,
		    legendText: "{label} : {y} ",
		    dataPoints: <?php echo json_encode($dataPointRegOne, JSON_NUMERIC_CHECK); ?>
		    }]
		});
        chartRegOne.render();
//End Region 1


// Region 2
var chartRegTwo = new CanvasJS.Chart("chartRegTwo", {
		colorSet: "inhalers",
		exportEnabled: true,
		theme: "light2",
		animationEnabled: true,
		dataPointWidth: 25,
		data: [{
		    type: "doughnut",
		    yValueFormatString: "#",
		    indexLabelFontSize: 13,
		    showInLegend: false,
		    legendText: "{label} : {y} ",
		    dataPoints: <?php echo json_encode($dataPointRegTwo, JSON_NUMERIC_CHECK); ?>
		    }]
		});
        chartRegTwo.render();
//End Region 2


// Region 3
var chartRegThree = new CanvasJS.Chart("chartRegThree", {
		colorSet: "inhalers",
		exportEnabled: true,
		theme: "light3",
		animationEnabled: true,
		dataPointWidth: 25,
		data: [{
		    type: "doughnut",
		    yValueFormatString: "#",
		    indexLabelFontSize: 13,
		    showInLegend: false,
		    legendText: "{label} : {y} ",
		    dataPoints: <?php echo json_encode($dataPointRegThree, JSON_NUMERIC_CHECK); ?>
		    }]
		});
        chartRegThree.render();
//End Region 3


// Region 4
var chartRegFour = new CanvasJS.Chart("chartRegFour", {
		colorSet: "inhalers",
		exportEnabled: true,
		theme: "light3",
		animationEnabled: true,
		dataPointWidth: 25,
		data: [{
		    type: "doughnut",
		    yValueFormatString: "#",
		    indexLabelFontSize: 13,
		    showInLegend: false,
		    legendText: "{label} : {y} ",
		    dataPoints: <?php echo json_encode($dataPointRegFour, JSON_NUMERIC_CHECK); ?>
		    }]
		});
        chartRegFour.render();
//End Region 4


// Region 4B
var chartRegFourB = new CanvasJS.Chart("chartRegFourB", {
		colorSet: "inhalers",
		exportEnabled: true,
		theme: "light3",
		animationEnabled: true,
		dataPointWidth: 25,
		data: [{
            includeZero: false,
		    type: "doughnut",
		    yValueFormatString: "#",
		    indexLabelFontSize: 13,
		    showInLegend: false,
		    legendText: "{label} : {y} ",
		    dataPoints: <?php echo json_encode($dataPointRegFourB, JSON_NUMERIC_CHECK); ?>
		    }]
		});
        chartRegFourB.render();
//End Region 4B


// Region 5
var chartRegFive = new CanvasJS.Chart("chartRegFive", {
		colorSet: "inhalers",
		exportEnabled: true,
		theme: "light1",
		animationEnabled: true,
		dataPointWidth: 25,
		data: [{
		    type: "doughnut",
		    yValueFormatString: "#",
		    indexLabelFontSize: 13,
		    showInLegend: false,
		    legendText: "{label} : {y} ",
		    dataPoints: <?php echo json_encode($dataPointRegFive, JSON_NUMERIC_CHECK); ?>
		    }]
		});
        chartRegFive.render();
//End Region 5


// Region 6
var chartRegSix = new CanvasJS.Chart("chartRegSix", {
		colorSet: "inhalers",
		exportEnabled: true,
		theme: "light2",
		animationEnabled: true,
		dataPointWidth: 25,
		data: [{
		    type: "doughnut",
		    yValueFormatString: "#",
		    indexLabelFontSize: 13,
		    showInLegend: false,
		    legendText: "{label} : {y} ",
		    dataPoints: <?php echo json_encode($dataPointRegSix, JSON_NUMERIC_CHECK); ?>
		    }]
		});
        chartRegSix.render();
//End Region 6


// Region 7
var chartRegSeven = new CanvasJS.Chart("chartRegSeven", {
		colorSet: "inhalers",
		exportEnabled: true,
		theme: "light2",
		animationEnabled: true,
		dataPointWidth: 25,
		data: [{
		    type: "doughnut",
		    yValueFormatString: "#",
		    indexLabelFontSize: 13,
		    showInLegend: false,
		    legendText: "{label} : {y} ",
		    dataPoints: <?php echo json_encode($dataPointRegSeven, JSON_NUMERIC_CHECK); ?>
		    }]
		});
        chartRegSeven.render();
//End Region 7


// Region 8
var chartRegEight = new CanvasJS.Chart("chartRegEight", {
		colorSet: "inhalers",
		exportEnabled: true,
		theme: "light3",
		animationEnabled: true,
		dataPointWidth: 25,
		data: [{
		    type: "doughnut",
		    yValueFormatString: "#",
		    indexLabelFontSize: 13,
		    showInLegend: false,
		    legendText: "{label} : {y} ",
		    dataPoints: <?php echo json_encode($dataPointRegEight, JSON_NUMERIC_CHECK); ?>
		    }]
		});
        chartRegEight.render();
//End Region 8


// Region 9
var chartRegNine = new CanvasJS.Chart("chartRegNine", {
		colorSet: "inhalers",
		exportEnabled: true,
		theme: "light1",
		animationEnabled: true,
		dataPointWidth: 25,
		data: [{
		    type: "doughnut",
		    yValueFormatString: "#",
		    indexLabelFontSize: 13,
		    showInLegend: false,
		    legendText: "{label} : {y} ",
		    dataPoints: <?php echo json_encode($dataPointRegNine, JSON_NUMERIC_CHECK); ?>
		    }]
		});
        chartRegNine.render();
//End Region 9


// Region 10
var chartRegTen = new CanvasJS.Chart("chartRegTen", {
		colorSet: "inhalers",
		exportEnabled: true,
		theme: "light1",
		animationEnabled: true,
		dataPointWidth: 25,
		data: [{
		    type: "doughnut",
		    yValueFormatString: "#",
		    indexLabelFontSize: 13,
		    showInLegend: false,
		    legendText: "{label} : {y} ",
		    dataPoints: <?php echo json_encode($dataPointRegTen, JSON_NUMERIC_CHECK); ?>
		    }]
		});
        chartRegTen.render();
//End Region 10


// Region 11
var chartRegEleven = new CanvasJS.Chart("chartRegEleven", {
		colorSet: "inhalers",
		exportEnabled: true,
		theme: "light1",
		animationEnabled: true,
		dataPointWidth: 25,
		data: [{
		    type: "doughnut",
		    yValueFormatString: "#",
		    indexLabelFontSize: 13,
		    showInLegend: false,
		    legendText: "{label} : {y} ",
		    dataPoints: <?php echo json_encode($dataPointRegEleven, JSON_NUMERIC_CHECK); ?>
		    }]
		});
        chartRegEleven.render();
//End Region 11


// Region 12
var chartRegTwelve = new CanvasJS.Chart("chartRegTwelve", {
		colorSet: "inhalers",
		exportEnabled: true,
		theme: "light1",
		animationEnabled: true,
		dataPointWidth: 25,
		data: [{
		    type: "doughnut",
		    yValueFormatString: "#",
		    indexLabelFontSize: 13,
		    showInLegend: false,
		    legendText: "{label} : {y} ",
		    dataPoints: <?php echo json_encode($dataPointRegTwelve, JSON_NUMERIC_CHECK); ?>
		    }]
		});
        chartRegTwelve.render();
//End Region 12


// Region 13
var chartRegThirteen = new CanvasJS.Chart("chartRegThirteen", {
		colorSet: "inhalers",
		exportEnabled: true,
		theme: "light1",
		animationEnabled: true,
		dataPointWidth: 25,
		data: [{
		    type: "doughnut",
		    yValueFormatString: "#",
		    indexLabelFontSize: 13,
		    showInLegend: false,
		    legendText: "{label} : {y} ",
		    dataPoints: <?php echo json_encode($dataPointRegThirteen, JSON_NUMERIC_CHECK); ?>
		    }]
		});
        chartRegThirteen.render();
//End Region 13


// Region BARMM
var chartRegBarmm = new CanvasJS.Chart("chartRegBarmm", {
		colorSet: "inhalers",
		exportEnabled: true,
		theme: "light1",
		animationEnabled: true,
		dataPointWidth: 25,
		data: [{
		    type: "doughnut",
		    yValueFormatString: "#",
		    indexLabelFontSize: 13,
		    showInLegend: false,
		    legendText: "{label} : {y} ",
		    dataPoints: <?php echo json_encode($dataPointRegBarmm, JSON_NUMERIC_CHECK); ?>
		    }]
		});
        chartRegBarmm.render();
//End Region BARMM
</script>