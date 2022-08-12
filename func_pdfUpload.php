<?php require_once('config/database_connection.php'); ?>
<?php

$ID = $_REQUEST['ID'];
// echo '<script language="javascript">alert(' . $ID . ')</script>';

$extension = pathinfo( $_FILES["file"]["name"], PATHINFO_EXTENSION );
$newname = $ID;
$attached_file = $newname.".".$extension;
$targ_directory = "uploads/".$newname.".".$extension;

 $ok=1;

$file_type=$_FILES['file']['type'];

if ($file_type=="application/pdf" || $file_type=="image/gif" || $file_type=="image/jpeg") {

 if(move_uploaded_file($_FILES['file']['tmp_name'], $targ_directory))

 {

$uploadfile = $dbConn->query("UPDATE tbl_profilingca SET ATTACHED_FILENAME = '$attached_file' WHERE `SID` = '$ID'");
echo '<script language="javascript">alert("The file is uploaded successfully!")</script>';
echo "<script>window.location = 'tbl_profca.php';</script>";
 }

 else {

 echo '<script language="javascript">alert("There is a problem encountered while uploading the file. Please try again.")</script>';
 echo "<script>window.location ='vw_profilinginfo.php?SID=$SID';</script>";

 }

}

else {

 echo '<script language="javascript">alert("You can only upload PDF, JPEG or GIF files.")</script>';
 echo "<script>window.location = 'vw_profilinginfo.php?SID=$SID';</script>";

}

if (isset($_GET['ID'])) {
    $id = $_GET['ID'];

    // fetch file to download from database
    $sql = "SELECT * FROM tbl_profilingca WHERE `SID`=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'uploads/' . $file['name'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $file['name']));
        readfile('uploads/' . $file['name']);

        // Now update downloads count
        // $newCount = $file['downloads'] + 1;
        // $updateQuery = "UPDATE files SET downloads=$newCount WHERE id=$id";
        // mysqli_query($conn, $updateQuery);
        // exit;
    }

}

?>
