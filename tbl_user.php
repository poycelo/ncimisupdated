<!DOCTYPE html>
<html>
<head>
<?php include('head.html'); ?>
<?php include('session.php'); ?>

</head>
<body>
  <?php include('sidebar.php');?>
  <?php include('menu.php');?>
  <?php

    $sequence= $dbConn->query('SELECT * FROM tbl_user order by ID DESC LIMIT 1');

    $row = mysqli_fetch_array($sequence);

    $month = date('m');
    $day =date('d');
    $year = date('Y');
    $get_userid = $row['ID']+ 1;

 
      $user_id ='USER'. $month. $day. $year. $get_userid;
 
  // TESTING CODE
  // echo "<script type='text/javascript'>alert('')</script>";
  // SAVE / INSERT
  if(isset($_POST['saveUser'])){
    $prefname       = $_POST['txtprefixname'];
    $suffname       = $_POST['txtsuffixname'];
    $fname          = $_POST['txtfname'];
    $mname          = $_POST['txtmname'];
    $lname          = $_POST['txtlname'];
    $dob            = $_POST['txtdob'];
    $office         = $_POST['txtoffice'];
    $agency         = $_POST['txtagency'];
    $position       = $_POST['txtposition']; 
    $email          = $_POST['txtemail'];
    $username       = $_POST['txtusername'];
    $password       = $_POST['txtpassword'];
    $accesslevel    = $_POST['txtaccesslevel'];
    $status         = $_POST['txtstatus'];

    $dbConn->query('INSERT INTO tbl_user (USERID, INFO_PREFIX, INFO_SUFFIX, INFO_LNAME, INFO_FNAME, INFO_MNAME, INFO_DOB, INFO_POSITION, INFO_USERNAME, INFO_PASSWORD, INFO_EMAILADD, INFO_OFFICE, INFO_AGENCY, INFO_ACCESSLEVEL, INFO_STATUS)
                    VALUES ("' . $user_id. '" ,
                            "' . $prefname . '" ,
                            "' . $suffname . '" , 
                            "' . $lname   . '" ,
                            "' . $fname . '" , 
                            "' . $mname . '" ,
                            "' . $dob   . '" ,  
                            "' . $position   . '" ,
                            "' . $username . '" ,
                            "' . $password . '" , 
                            "' . $email . '" ,                         
                            "' . $office   . '" ,             
                            "' . $agency   . '" ,
                            "' . $accesslevel . '" ,
                            "' . $status . '")');
      echo "<script>window.location.href='tbl_user.php';</script>";
  }

  // UPDATE / EDIT
  if(isset($_POST['editUser'])){
    $userid         = $_POST['txtuserid'];
    $prefname       = $_POST['txtprefixname'];
    $suffname       = $_POST['txtsuffixname'];
    $fname          = $_POST['txtfname'];
    $mname          = $_POST['txtmname'];
    $lname          = $_POST['txtlname'];
    $dob            = $_POST['txtdob'];
    $office         = $_POST['txtoffice'];
    $agency         = $_POST['txtagency']; 
    $position       = $_POST['txtposition']; 
    $email          = $_POST['txtemail'];
    $username       = $_POST['txtusername'];
    $password       = $_POST['txtpassword'];
    $accesslevel    = $_POST['txtaccesslevel'];
    $status         = $_POST['txtstatus'];

    //echo "<script type='text/javascript'>alert('$SID $NAME_F $NAME_L $NAME_M')</script>";

    $dbConn->query('UPDATE tbl_user SET INFO_PREFIX        = "' .$prefname.'",
                                        INFO_SUFFIX        = "' .$suffname.'",
                                        INFO_LNAME         = "' .$lname. '",
                                        INFO_FNAME         = "' .$fname. '", 
                                        INFO_MNAME         = "' .$mname. '", 
                                        INFO_DOB           = "' .$dob.   '",
                                        INFO_POSITION      = "' .$position. '" ,
                                        INFO_USERNAME      = "' .$username. '",
                                        INFO_PASSWORD      = "' .$password. '",
                                        INFO_EMAILADD      = "' .$email. '",
                                        INFO_OFFICE        = "' .$office. '",
                                        INFO_AGENCY        = "' .$agency. '",
                                        INFO_ACCESSLEVEL   = "' .$accesslevel. '",
                                        INFO_STATUS        = "' .$status. '"
                                               
                                         WHERE USERID="' .$userid. '" ');      
        echo "<script>window.location.href='tbl_user.php';</script>";
  }

  // DELETE
  if(isset($_GET['deleteUser'])){
    $userid = $_GET['deleteUser'];
    $dbConn->query("DELETE FROM tbl_user WHERE USERID='$userid'");
      echo "<script>window.location.href='tbl_user.php';</script>";
  }
?>

    <div class="container-fluid mb-3 mt-3">
      <div class="form-row">
        <div class="col-lg-11">
            <!-- Page Heading -->
            <h4 class="mb-2 text-gray-800">List of Users</h4>
            <hr 999/>
        </div>
        <div class="col-lg-1">
          <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addUser">
            <i class="fas fa-user-plus fa-xs"></i>
            Add User
          </a>
        </div>
      </div>
      <table id="datatable" class="table-bordered display text-xs" style="width:100%;">
        <thead class="text-sm">
          <tr style="color:white;background-color: #0e918c;">
            <th class="d-sm-table-cell">ACTION</th>
            <th class="d-sm-table-cell">FULL NAME</th> 
            <th class="d-sm-table-cell">POSITION</th>
            <th class="d-sm-table-cell">OFFICE / AGENCY</th>  
            <th class="d-sm-table-cell">USERNAME</th>
            <th class="d-sm-table-cell">E-MAIL ADDRESS</th>
            <th class="d-sm-table-cell">ACCESSLEVEL</th>    
            <th class="d-sm-table-cell">STATUS</th>  
          </tr>
        </thead>
        <tbody>
        <?php $resultprofca = $dbConn->query("SELECT * FROM tbl_user"); 
               while($rowresult = mysqli_fetch_assoc($resultprofca)){ ?>
            <tr>
                <td class="d-sm-table-cell">
                    <a href="tbl_user.php?deleteUser=<?php echo $rowresult['USERID']; //Get row ID ?>" class="btn btn-sm btn-danger text-xs form-control form-control-sm border"  onclick="return confirm('Are you sure you want to delete this item?');" style="background-color: #af2d2d; color:white;">
                      <i class="fas fa-trash-alt fa-xs fa-white"></i>
                    </a>
                    <a data-toggle="modal" data-target="#editUser<?=$rowresult['USERID'];?>" class="btn btn-sm btn-secondary text-xs form-control form-control-sm border" style="color:white;">
                          <i class="fas fa-pen fa-xs fa-white"></i>
                    </a>

                    <?php include('modal_edit_users.php'); ?>
                   
                </td>
                <td><?php echo $rowresult['INFO_FNAME']. ' '. $rowresult['INFO_LNAME'];?></td>    
                <td><?php echo $rowresult['INFO_POSITION'];?></td>
                <td><?php echo $rowresult['INFO_OFFICE'];?></td>
                <td><?php echo $rowresult['INFO_USERNAME'];?>
                <td><?php echo $rowresult['INFO_EMAILADD'];?></td>
                <td><?php echo $rowresult['INFO_ACCESSLEVEL'];?></td>
                <td><?php echo $rowresult['INFO_STATUS'];?></td>
            </tr>
        <?php }?>
        </tbody>
       </table>
    </div>
    <!-- MODAL: ADD USER -->
  <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
      <form method="post">
        <div class="modal-content">      
        <div class="modal-body modal-bg">

          <div class="container-fluid px-3 py-0">
           <div class="col-lg-12 bg-white p-3">
             <div class="form-row">
                <div class="col-lg-12">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Add User Profile</h1>
                    <hr 999/>
                </div>
            
            <div class="col-lg-12">
             <!-- Data Table -->
              <div style="font-size: 0.9rem;">
                <div class="form-row mt-2 border">
                  <div class="col-lg-2 mt-3">
                   <label>Prefix</label>
                    <select class="form-control" name="txtprefixname" required>
                      <option disabled>-------------</option>   
                      <option value="MR">MR.</option>
                      <option value="MS">MS.</option>
                    </select>
                  </div> 

                  <div class="col-lg-3 mt-3">
                    <label>First Name</label>
                    <input type="text" class="form-control" name="txtfname" onkeyup="this.value = this.value.toUpperCase();" required>
                  </div>

                  <div class="col-lg-2 mt-3">
                    <label>Middle Initial</label>
                    <input type="text" class="form-control" name="txtmname" onkeyup="this.value = this.value.toUpperCase();" >
                  </div>

                  <div class="col-lg-3 mt-3">
                    <label>Last Name</label>
                    <input type="text" class="form-control" name="txtlname" onkeyup="this.value = this.value.toUpperCase();"  required>
                  </div>

                  <div class="col-lg-2 mt-3">
                    <label>Suffix</label>
                    <input type="text" class="form-control" name="txtsuffixname" onkeyup="this.value = this.value.toUpperCase();" >
                  </div>
                  <div class="col-lg-3 mt-2">
                    <label>Office</label>
                      <select class="form-control" name="txtoffice" required>
                        <option value="">Select Office</option>
                        <option value="" disabled>-----------</option>
                        <option value="Department of Agriculture">Department of Agriculture</option>
                        <<option value="Departmend of Agrarian Reform">Departmend of Agrarian Reform</option>
                        <option value="Department of Environment and Natural Resources">Department of Environment and Natural Resources</option>
                        <option value="Department of Interior and Local Government">Department of Interior and Local Government</option>
                        <option value="Other Agencies">Other Agencies</option>
                      </select>
                  </div>
                  <div class="col-sm-3 mt-2">
                    <label>Agency</label>
                    <input type="text" class="form-control" name="txtagency" onkeyup="this.value = this.value.toUpperCase();"  required required>
                  </div>

                   <div  class="col-sm-3 mt-2">
                    <label>Position</label>
                    <input type="text" class="form-control" name="txtposition" onkeyup="this.value = this.value.toUpperCase();" required>
                  </div>

                  <div class="col-sm-3 mt-2">
                    <label>Date of Birth</label>
                    <input type="date" class="form-control" name="txtdob" onkeyup="this.value = this.value.toUpperCase();" required>
                  </div>

                  <div class="col-sm-4 form-group mt-2">
                    <label>Email Address</label>
                    <input type="Email" class="form-control" name="txtemail" required>
                  </div>

                    <!-- ACCOUNT INFO -->
                  <div class="col-sm-4 form-group mt-2">
                    <label>Username</label>
                    <input type="text" class="form-control" name="txtusername" required>
                  </div>

                  <!-- PASSWORD -->
                  <div class="col-sm-4 form-group mt-2">
                    <label>Password</label>
                    <input type="password" class="form-control" name="txtpassword" required>
                  </div>

                   <!-- ACCOUNT TYPE -->
                  <div class="col-sm-3 form-group mt-2">
                    <label>Account Type</label>
                      <select class="form-control" name="txtaccesslevel" required>
                        <option value="" disabled>Choose Type</option>
                        <option value="ADMINISTRATOR">Administrator</option>
                        <option value="SECRETARIAT">Secretariat</option>
                        <option value="VERIFIER">Verifier</option>
                        <option value="VIEWER">Viewer</option>
                        <option value="ENCODER">Encoder</option>
                      </select>
                  </div>

                  <!-- ACCOUNT STATUS -->
                  <div class="col-sm-3 form-group mt-2">
                    <label>Status</label>
                      <select class="form-control" name="txtstatus" required>
                        <option value="" disabled>Choose Type</option>
                        <option value="ACTIVE">Active</option>
                        <option value="INACTIVE">Inactive</option>
                      </select>
                  </div>
                </div>
             </div>
            </div>
             </div>
            </div>

           <div class="modal-footer">
            <div class="form-group">
              <button type="submit" name="saveUser" class="btn btn-success">SAVE</button>
              <button type="submit" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
            </div>
          </div>
        </div>
        <!-- MODAL FOOTER - END -->
      </form> <!-- end of form method="post" -->
    </div>    <!-- end of modal-content -->
  </div>      <!-- end of modal-dialog -->
<!-- END OF MODAL -->
<?php include('footer.html'); ?>
</body>
</html>

