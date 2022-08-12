<?php include('head.html'); ?>
<?php include('session.php'); ?>
<body>
<?php include('sidebar.php');?>
<?php include('menu.php');?>

<?php
  if(isset($_POST['btnPassword'])){
    $accountId     = $_POST['dataAccountNo'];
    $newPassword   = $_POST['retypePassword'];
    //echo "<script type='text/javascript'>alert('$newPassword')</script>";

    $dbConn->query("UPDATE tbl_user SET INFO_PASSWORD='$newPassword' WHERE ID='$accountId'");
    // header('location:frm_userprofile.php');
    echo "<script>window.location.href='frm_userprofile.php';</script>";
  }
?>

<?php
  function maskPassword($password){
    $mask_Password =  str_repeat("*", strlen($password)-1) . substr($password, -1);
    
    return $mask_Password;
}
?>


  <!-- START OF CONTENT -->
  <div class="content">
    <!-- FORM TITLE -->    
     <div class="container-fluid">
  
      <!-- PAGE TITLE -->
      <div class="ml-2">
        <h1 class="info-name align-xs-center">User Account Information
        <img src="img/logos.png" style="margin-left:68%;width:12%; height:auto;"/>
        </h1>
      </div>
            <hr color="#999"/> 


      <div class="row text-secondary mt-2 mb-5">
      
      <div class="col-xl-2 col-md-4 align-xs-center">
        <a href="#" data-toggle="modal" data-target="#photoModal<?=$rowUserInfo['ID'];?>" 
          onclick="enableForm()" >
          <div class="row justify-content-center">
            <img class="img-fix my-1" src="images/profiles/<?php //echo $idBuyer;?>.jpg" onerror="this.onerror=null;this.src='images/profiles/nophoto.png'">
          </div>
        </a>
      </div>

      <div class="col-md-8">
        <div class="row">
          <div class="col-xl-3 col-md-5 col-6 text-right my-1">
            <h4 class="text-uppercase font-weight-bold" style="color: #3f6f21!important; font-family:'Roboto'!important;">Name:</h4>
          </div>
          <div class="col-xl-3 col-md-7 col-6 my-1">
            <h5 style="font-family:'Roboto'!important;"><?=$rowUserInfo['INFO_LNAME'] . ', ' . $rowUserInfo['INFO_FNAME'] . ' ' . $rowUserInfo['INFO_MNAME'];?></h5>
          </div>
       
          <div class="col-xl-3 col-md-7 col-6 text-right my-1">
            <h4 class="text-uppercase font-weight-bold" style="color: #3f6f21!important; font-family:'Roboto'!important;">Account Type:</h4>
          </div>
          <div class="col-xl-3 col-md-7 col-6 my-1">
            <h5 style="font-family:'Roboto'!important;"><?php echo $rowUserInfo['INFO_ACCESSLEVEL'];?></h5>
          </div>
       
          <div class="col-xl-3 col-md-5 col-6 text-right my-1">
            <h4 class="text-uppercase font-weight-bold" style="color: #3f6f21!important; font-family:'Roboto'!important;">Email Address:</h4>
          </div>
          <div class="col-xl-3 col-md-7 col-6 my-1">
            <h5 style="font-family:'Roboto'!important;"><?php echo $rowUserInfo['INFO_EMAILADD'];?></h5>
          </div>
       
          <div class="col-xl-3 col-md-5 col-6 text-right my-1">
            <h4 class="text-uppercase font-weight-bold" style="color: #3f6f21!important; font-family:'Roboto'!important;">Office:</h4>
          </div>
          <div class="col-xl-3 col-md-7 col-6 my-1">
            <h5 style="font-family:'Roboto'!important;"><?php echo $rowUserInfo['INFO_OFFICE'];?></h5>
          </div>
         
          <div class="col-xl-3 col-md-5 col-6 text-right my-1">
            <h4 class="text-uppercase font-weight-bold" style="color: #3f6f21!important; font-family:'Roboto'!important;">Username:</h4>
          </div>
          <div class="col-xl-3 col-md-7 col-6 my-1">
            <h5 style="font-family:'Roboto'!important;"><?php echo $rowUserInfo['INFO_USERNAME'];?></h5>
          </div>
       
          <div class="col-xl-3 col-md-5 col-6 text-right my-1">
          </div>
          <div class="col-xl-3 col-md-7 col-6 my-1">
          </div>
          <div class="col-xl-3 col-md-5 col-6 text-right my-1">
            <h4 class="text-uppercase font-weight-bold" style="color: #3f6f21!important; font-family:'Roboto'!important;">Password:</h4>
          </div>
          <div class="col-xl-3 col-md-7 col-6 my-1">
            <h5 style="font-family:'Roboto'!important;"><?php echo maskPassword($rowUserInfo['INFO_PASSWORD']);?> 
            <a href="#" data-toggle="modal" data-target="#passwordModal<?=$rowUserInfo['ID'];?>">(Change Password)</a></h5>
          </div>
          
        </div>
    
      

    </div>
  </div>
  
  <?php include('footer.html'); ?>

</body>


</html>
<div class="modal fade" id="passwordModal<?=$rowUserInfo['ID'];?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-l" role="document">
          <div class="modal-content">
            <div class="modal-header"><h4 class="modal-title text-uppercase">Change Password</h4></div>      
            <div class="modal-body modal-bg">
              <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="dataAccountNo" value="<?php echo $rowUserInfo['ID']; ?>">
              <div class="row justify-content-center">
                
                  <div class="col-lg-8 col-sm-12">
                    <label>Old Password</label>
                    <input type="hidden" class="form-control" name="userpassword" id="userpassword" value="<?=$rowUserInfo['INFO_PASSWORD'];?>">
                    <input type="password" class="form-control text-primary" name="oldPassword" id="id-oldPassword" onkeyup="compareOldPw()" value="">
                    <input type="hidden" class="form-control" name="remarkspw" id="remarkspw" readonly>
                  </div>
                  <div class="col-lg-8 col-sm-12">
                    <label>New Password</label>
                    <input type="password" class="form-control" name="newPassword" id="newPassword" onkeyup="compareTypePw()">
                    
                  </div>
                  <div class="col-lg-8 col-sm-12 mb-3">
                    <label>Re-type Password</label>
                    <input type="password" class="form-control" name="retypePassword" id="retypePassword" onkeyup="compareTypePw()">
                    <input type="hidden" class="form-control border-0" name="newpwremarks" id="newpwremarks" oninput="enableChangePw()">
                  </div>
              </div>
            </div>
              <div class="modal-footer">
                <div class="form-group">
                  <button type="submit" class="btn btn-success" id="btnPassword" name="btnPassword" disabled>Update</button>
                  <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form> <!-- end of form method="post" -->
              </div><!-- end of modal-content -->
            </div>  <!-- end of modal-dialog -->
              <!-- end of modal-fade -->
<!-- Search function -->

<script>
function compareOldPw() {
     
      //var PercentResult = parseInt(FilPercent) + parseInt(ForPercent);
      //if (!isNaN(PercentResult)) {
    if(document.getElementById('userpassword').value == document.getElementById('id-oldPassword').value) {
      document.getElementById('remarkspw').value =  "Good";
      document.getElementById("id-oldPassword").className ="" ;
      document.getElementById("id-oldPassword").className =document.getElementById("id-oldPassword").className + " form-control border-success";
      if(document.getElementById('newpwremarks').value == document.getElementById('remarkspw').value ){
        document.getElementById('btnPassword').disabled = false;
      }
      else{
        document.getElementById('btnPassword').disabled = true;
      }
    }
    else{  
      document.getElementById('remarkspw').value =  "Bad";
      document.getElementById("id-oldPassword").className =document.getElementById("id-oldPassword").className + " form-control border-warning";
       document.getElementById('btnPassword').disabled =  true;
    }
}
function compareTypePw() {
    //var PercentResult = parseInt(FilPercent) + parseInt(ForPercent);
    //if (!isNaN(PercentResult)) {
    if(document.getElementById('newPassword').value == document.getElementById('retypePassword').value) {
      document.getElementById('newpwremarks').value =  "Good";
      document.getElementById("newPassword").className ="";
      document.getElementById("retypePassword").className  ="";
      document.getElementById("newPassword").className = document.getElementById("retypePassword").className + " form-control border-success";
      document.getElementById("retypePassword").className = document.getElementById("newPassword").className + " form-control border-success";



      if(document.getElementById('newpwremarks').value == document.getElementById('remarkspw').value ){
        document.getElementById('btnPassword').disabled = false;
      }
      else{
        document.getElementById('btnPassword').disabled =  true;
      }
   }
    else{
      document.getElementById('newpwremarks').value =  "Passwords do not match.";
      document.getElementById("retypePassword").className = document.getElementById("retypePassword").className + " form-control border-warning";
      document.getElementById("newPassword").className = document.getElementById("newPassword").className + " form-control border-warning";
      document.getElementById('btnPassword').disabled = true;
    }         
}

</script>

