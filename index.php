<!DOCTYPE html>
<html lang="en">
<?php
  include('head.html'); 
?> 

<?php
// SUBMIT - CREDENTIALS
if(isset($_POST['btnLogin'])){
	// POST VALUES FROM LOGIN FORM
		$dataUsername = $_POST['username'];
		$dataPassword = $_POST['password'];
	// CHECK DATABASE FOR USER CREDENTIALS
		$getUserLogin = $dbConn->query("SELECT * FROM tbl_user WHERE INFO_USERNAME='$dataUsername' AND INFO_PASSWORD ='$dataPassword' AND INFO_STATUS ='ACTIVE'");
    $rowUserInfo = mysqli_fetch_assoc($getUserLogin);
    $cntUserLogin = mysqli_num_rows($getUserLogin);
	// CHECK IF USER EXIST
		if($cntUserLogin!=0){
			session_start();
			$_SESSION['sess_user'] = $dataUsername;
      // if($rowUserInfo['INFO_ACCESSLEVEL'] == 'VERIFIER' || $rowUserInfo['INFO_ACCESSLEVEL'] == 'ADMINISTRATOR'){
      //   echo "<script>window.location.href='tbl_profca.php'</script>";
      // }
      // else{
       $user = $rowUserInfo['USERID'];
       echo "<script>window.location.href='tbl_profca.php?userid=$user'</script>";
      // }
		}
		else{
			// $prompt = "Incorrect Username and/or Password";
      // header('Location:index.php?warning=1');
      echo '<script>alert("Incorrect Username and/or Password")</script>';
		}	
}
?>

<style type="text/css">
      #loader{
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('img/loading.gif') 50% 50% no-repeat rgb(249,249,249);
        opacity: 1;
    }
 </style>
 <div id="loader"></div>

<body class="bg-gradient-custom-accent">
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block"><img style="width: 115%" src="img/login.jpg" alt=""></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h5 text-gray-900 mb-4"><b>National Convergence Initiative - Management Information System
                    </b></h1>  
                  </div>
                  <form class="user" method="post">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="username" placeholder="Enter Username...">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id= "inputpassword" name="password" placeholder="Password">
                    </div>

                      <div class="form-group ml-2">
                        <input type="checkbox" onclick="Function()">  Show Password
                      </div>
                    <!-- <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div> -->
                    <button class="h3 btn btn-primary text-white btn-user btn-block w-100 " name="btnLogin" value="btn">Login
                    </button>
                    <!-- <hr>
                    <a href="#" class="btn btn-google btn-outline-danger btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="#" class="btn btn-facebook btn-outline-primary btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a> -->
                  </form>
                  <hr>
                  <div class="text-center">
                    <p class="container w-100 text-justify" style="font-size:12px;">2nd floor, Bureau of Soils and Water Management, Visayas Avenue corner Elliptical Road, Diliman, Quezon City
                    <br/> Tel: +632-8-929-5683 / +632-8-929-4927 <br/>E-mail: <a href="mailto:ncisrd@da.gov.ph" style="color:blue;">ncisrd@da.gov.ph</a><br/>
                    Facebook: <a href="https://facebook.com/nationalconvergence" target="_blank" style="color:blue;">facebook.com/nationalconvergence</a></p>
                    <center><img src="img/logos.png" style="width:90%; height:auto;"/></center>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
<script>

$(window).on('load', function(){
    //you remove this timeout
    setTimeout(function(){
          $('#loader').fadeOut('slow');  
      });
      //remove the timeout
      //$('#loader').fadeOut('slow'); 
  });

function Function() {
    var x = document.getElementById("inputpassword");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>
</body>

</html>
