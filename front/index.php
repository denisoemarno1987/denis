<?php
include('../conf/koneksi.php');
ob_start();
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
date_default_timezone_set('Asia/Jakarta');

//insert RSVP
$CustomerNameErr = $CompanyNameErr = $TitleErr = $EmailErr = $PhoneNumberErr = "";
$CustomerNameChace = $CompanyNameChace = $TitleChace = $EmailChace = $PhoneNumberChace = "";
$cekvalid = true;
$idEvent = "";
$dateStamp = date('Y/m/d H:i:s');
if(isset($_POST['done_Rspv'])){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["customerName"])) {
                $CustomerNameErr = "Customer Name is required";
                $cekvalid = false;
            }else{
                $CustomerNameChace = test_input($_POST["customerName"]);
                $cekvalid = true;
            }

            if(empty($_POST["companyName"])){
                $CompanyNameErr = "Company Name is required";
                $cekvalid = false;
            }else{
                $CompanyNameChace = test_input($_POST["companyName"]);
                $cekvalid = true;
            }

            if(empty($_POST["title"])){
                $TitleErr = "Title is required";
                $cekvalid = false;
            }else{
                $TitleChace = test_input($_POST["title"]);
                $cekvalid = true;
            }

            if(empty($_POST["email"])){
                $EmailErr = "Email is required";
                $cekvalid = false;
            }else{
                $EmailChace = test_input($_POST["email"]);
                $cekvalid = true;
            }

            if(empty($_POST["phoneNumber"])){
                $PhoneNumberErr = "Mobile Phone is required";
                $cekvalid = false;
            }else{
                $PhoneNumberChace = test_input($_POST["phoneNumber"]);
                $cekvalid = true;
            }

            if($cekvalid == true){
                //cari id event dahulu
                $EventNow = "SELECT * FROM event_now";   
                $EventNows = mysqli_query($conn, $EventNow);

                //Generate Code
                $tahun = date("Y");
                $tahun = trim($tahun, "2");
                $bulan = date("m");
                $tanggal = date("d");
                $CodeCount = "0001";
                $AutoCode = 0;

                $query = "SELECT MAX(cast(idRsvp as decimal)) id FROM rsvp";
                if($hasil = mysqli_query($conn, $query)){
                    $row = mysqli_fetch_assoc($hasil);
                    $count = $row['id'];
                    $count = $count+1;

                    $CodeCount = str_pad($count, 4, "0", STR_PAD_LEFT);
                    $AutoCode = $CodeCount;
                        
                    if($AutoCode == "0001"){
                        $AutoCode = $tahun.$bulan.$tanggal.$CodeCount;
                    }
                    else{
                        $AutoCode = "0".$CodeCount;
                    }    
                }
                //End Of Generate Code

                if(mysqli_num_rows($EventNows) > 0){
                    while($dr = mysqli_fetch_assoc($EventNows)){
                        $idEvent = $dr['event_now'];
                    }
                    $insert = "INSERT INTO rsvp(idRsvp, idEvent, customerName, companyName, title, email, phoneNumber, created, modified,walkIn,isAttend,print,printer_name, status) 
                                VALUES ('$AutoCode', '$idEvent','$_POST[customerName]', '$_POST[companyName]', '$_POST[title]', '$_POST[email]', '$_POST[phoneNumber]','$dateStamp', '$dateStamp',0,0,0,'NONE', 1)";
                    mysqli_query($conn, $insert);
                    echo '<script type="text/javascript">'; 
                    echo 'alert("Check Your Mailbox!");'; 
                    echo 'window.location.href = "index.php";';
                    echo '</script>';
                }                
            }
        }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Conference - Responsive HTML5 Template</title>

    <!-- favicon -->
    <link href="favicon.png" rel=icon>

    <!-- web-fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,500' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Style CSS -->
    <link href="../bootstrap/css/style.css" rel="stylesheet">

    <!-- jquery -->
    <script src="../bootstrap/js/jquery-1.9.1.min.js"></script>

    <!-- Bootstrap -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    
</head>
<!-- ini untuk posisi menu navigasi -->
<body>
<div id="header-wrap" class="clr">
    <header id="header" class="site-header clr container" role="banner">      
        <!-- place your image here -->
                <?php 
                    $query = "SELECT * FROM custom_front WHERE id_front='front'";
                    $hasil = mysqli_query($conn, $query);
                    if(mysqli_num_rows($hasil) > 0){
                        while($row = mysqli_fetch_assoc($hasil)){
                            if($row['status'] != 0){ ?>
               <img src="<?php echo $row['dir_name'].$row['img_name']; ?>" alt="company logo" style="width: 100%;" class="img-responsive">
</div>
    <form class="form-horizontal" role="form" action="" method="post">
    <h2 align="center">Registration Form</h2>
        <div class="form-group">
            <label for="firstName" class="col-sm-3 control-label">Full Name</label>
            <div class="col-sm-6">
                <input type="text" id="firstName" name="customerName" placeholder="Full Name" class="form-control"  value="<?php echo $CustomerNameChace;?>" autofocus>
                <span class = "help-block">*<?php echo $CustomerNameErr;?></span>
            </div>
        </div>
        <div class="form-group">
            <label for="company" class="col-sm-3 control-label">Company</label>
            <div class="col-sm-6">
                <input type="text" id="company" name="companyName" placeholder="Company" class="form-control" value="<?php echo $CompanyNameChace;?>" >
                <span class = "help-block">*<?php echo $CompanyNameErr;?></span>
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">Title</label>
            <div class="col-sm-6">
                <input type="text" id="title" name="title" placeholder="Title" class="form-control" value="<?php echo $TitleChace;?>">
                <span class = "help-block">*<?php echo $TitleErr;?></span>
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-6">
                <input type="email" id="email" name="email" placeholder="Email" class="form-control" value="<?php echo $EmailChace;?>">
                <span class = "help-block">*<?php echo $EmailErr;?></span>
            </div>
        </div>
        <div class="form-group">
            <label for="phoneNumber" class="col-sm-3 control-label">Phone Number</label>
            <div class="col-sm-6">
                <input type="phoneNumber" id="phoneNumber" name="phoneNumber" placeholder="Mobile Phone" class="form-control" value="<?php echo $PhoneNumberChace;?>">
                <span class = "help-block">*<?php echo $PhoneNumberErr;?></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-6 col-sm-offset-3">
                <input type="submit" class="btn btn-primary btn-block" name="done_Rspv" value="Register">
            </div>
        </div>
    </form> <!-- /form -->
<!-- ini untuk posisi footer -->
    <div class="clear">&nbsp;</div>
    <div class="clear">&nbsp;</div>
    <div class="panel-footer">
        <div class="footer-bottom">
            <div class="container">
                <center><a href="#"><?php echo $row["footer_name"]; } } }?></a></center>
            </div>
        </div>
    </div>
    <!-- posisi footer selesai -->
</body>
</html>