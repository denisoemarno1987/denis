<?php
//ini untuk index
if($_GET['aksi'] == "home"){
    $query = "SELECT * FROM rsvp";
	$hasil = mysqli_query($conn, $query);
	$i = 1;
    echo"
    <div class='panel-content'>
        <div class='container-fluid'>
            <div class='row'>
            <div class='col-md-10 col-sm-10'>
                <div class='panel panel-primary'><!--Panel -->
                    <div class='panel-heading'><!--Panel Header -->
                        <span class='glyphicon glyphicon-dashboard'></span> RSVP List
                    </div>
                    <div class='panel-body'><!--Panel Body -->
                        <div class='col-sm-12'>
                            <table class='table table-striped table-bordered data'>
                                            <thead>
                                            <tr>                                            
                                                <th>No.</th>
                                                <th>Id Event</th>
                                                <th>Customer Name</th>
                                                <th>Company Name</th>
                                                <th>Title</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th>Aksi</th>
                                            </tr>
                                            </thead>
                                            <tbody>";
                                            if(mysqli_num_rows($hasil) > 0){
                                                while($row = mysqli_fetch_assoc($hasil)){
                                                    if($row['status'] != 0){
                                                    echo"<tr>
                                                            <td>".$i++."</td>
                                                            <td>".$row["idEvent"]."</td>
                                                            <td>".$row["customerName"]."</td>
                                                            <td>".$row["companyName"]."</td>
                                                            <td>".$row["title"]."</td>
                                                            <td>".$row["email"]."</td>
                                                            <td>".$row["phoneNumber"]."</td>
                                                            <td>
                                                                <a href='index.php?p=rsvp&aksi=update&code=".$row['idRsvp']."' class='btn btn-warning'>Edit</a>
                                                                <a href='index.php?p=rsvp&aksi=delete&code=".$row['idRsvp']."' class='btn btn-danger style='color:#c00;' Onclick='return ConfirmDelete();'>Hapus</a>
                                                            </td>
                                                        </tr>";
                                                    }
                                                }
                                            }
                                            echo"</tbody>
                                        </table>
                                        <a href='index.php?p=rsvp&aksi=insert' class='btn btn-success'>Tambah</a>
                        </div>
                    </div>";
}
//ini untuk insert data
if($_GET['aksi'] == "insert"){
    $CustomerNameErr = $CompanyNameErr = $TitleErr = $EmailErr = $PhoneNumberErr = "";
    $CustomerNameChace = $CompanyNameChace = $TitleChace = $EmailChace = $PhoneNumberChace = "";
    $cekvalid = true;
    $idEvent = "";
    $dateStamp = date('Y/m/d H:i:s');
    if(isset($_POST['insert'])){
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
                $PhoneNumberErr = "Phone Number is required";
                $cekvalid = false;
            }else{
                $PhoneNumberChace = test_input($_POST["phoneNumber"]);
                $cekvalid = true;
            }

            if($cekvalid == true){
                //cari id event dahulu
                $EventNow = "SELECT * FROM event_now";   
                $EventNows = mysqli_query($conn, $EventNow);

                if(mysqli_num_rows($EventNows) > 0){
                    while($dr = mysqli_fetch_assoc($EventNows)){
                        $idEvent = $dr['event_now'];
                    }
                    $insert = "INSERT INTO rsvp(idEvent, customerName, companyName, title, email, phoneNumber, created, modified,walkIn,isAttend,print,printer_name, status) 
                                VALUES ('$idEvent','$_POST[customerName]', '$_POST[companyName]', '$_POST[title]', '$_POST[email]', '$_POST[phoneNumber]','$dateStamp', '$dateStamp',0,0,0,'NONE', 1)";
                    mysqli_query($conn, $insert);
                    header('Location: index.php?p=rsvp&aksi=home');   
                }                
            }
        }
    }
    echo"
    <div class='panel-content'>
        <div class='container-fluid'>
            <div class='row'>
            <div class='col-md-10 col-sm-10'>
                <div class='panel panel-primary'><!--Panel -->
                    <div class='panel-heading'><!--Panel Header -->
                        <span class='glyphicon glyphicon-dashboard'></span> Insert RSVP
                    </div>
                    <div class='panel-body'><!--Panel Body -->
                        <div class='col-sm-12'>
                            <form action='' method='POST' class='form-default col-sm-4'>
                                <div class='form-group'>
                                    <label>Customer Name:</label>
                                    <input type='text' class='form-control' name='customerName' value='".$CustomerNameChace."'>
                                    <span class = 'error'>*".$CustomerNameErr."</span>
                                </div>
                                <div class='form-group'>
                                    <label>Company Name:</label>
                                    <input type='text' class='form-control' name='companyName' value='".$CompanyNameChace."'>
                                    <span class = 'error'>*".$CompanyNameErr."</span>
                                </div>
                                <div class='form-group'>
                                    <label>Title:</label>
                                    <input type='text' class='form-control' name='title' value='".$TitleChace."'>
                                    <span class = 'error'>*".$TitleErr."</span>
                                </div>
                                <div class='form-group'>
                                    <label>Email:</label>
                                    <input type='email' class='form-control' name='email' value='".$EmailChace."'>
                                    <span class = 'error'>*".$EmailErr."</span>
                                </div>
                                <div class='form-group'>
                                    <label>Phone Number:</label>
                                    <input type='text' class='form-control' name='phoneNumber' value='".$PhoneNumberChace."'>
                                    <span class = 'error'>*".$PhoneNumberErr."</span>
                                </div>
                                <div class='form-group'>
                                    <input type='submit' name='insert' class='btn btn-success' value='Simpan'>
                                    <a href='index.php?p=rsvp&aksi=home' class='btn btn-danger'>Kembali</a>
                                </div>   
                            </form>
                        </div>
                    </div>";
}
//ini untuk update
if($_GET['aksi'] == "update" && $_GET['code'] != ""){
    $code = $_GET['code'];
    $CustomerNameErr = $CompanyNameErr = $TitleErr = $EmailErr = $PhoneNumberErr = "";
    $CustomerNameChace = $CompanyNameChace = $TitleChace = $EmailChace = $PhoneNumberChace = "";
    $cekvalid = true;
    $idEvent = "";
    $dateStamp = date('Y/m/d H:i:s');
    if(isset($_POST['update'])){
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
                $PhoneNumberErr = "Phone Number is required";
                $cekvalid = false;
            }else{
                $PhoneNumberChace = test_input($_POST["phoneNumber"]);
                $cekvalid = true;
            }
            if($cekvalid == true){
                //cari id event dahulu
                $EventNow = "SELECT * FROM event_now";   
                $EventNows = mysqli_query($conn, $EventNow);

                if(mysqli_num_rows($EventNows) > 0){
                    while($dr = mysqli_fetch_assoc($EventNows)){
                        $idEvent = $dr['event_now'];
                    }
                    $update = "UPDATE rsvp SET idEvent = '$idEvent',
                                               customerName = '$_POST[customerName]',
                                               companyName = '$_POST[companyName]',
                                               title = '$_POST[title]',
                                               email = '$_POST[email]',
                                               phoneNumber = '$_POST[phoneNumber]',
                                               modified = '$dateStamp'
                               WHERE idRsvp = '$code'";
                    mysqli_query($conn, $update);
                    header('Location: index.php?p=rsvp&aksi=home');
                }

        }
    }
  }  
    $cek = "SELECT * FROM rsvp WHERE idRsvp='$code'";   
    $ceks = mysqli_query($conn, $cek);

    if(mysqli_num_rows($ceks) > 0){
        echo"
        <div class='panel-content'>
        <div class='container-fluid'>
            <div class='row'>
            <div class='col-md-10 col-sm-10'>
                <div class='panel panel-primary'><!--Panel -->
                    <div class='panel-heading'><!--Panel Header -->
                        <span class='glyphicon glyphicon-dashboard'></span> Update User
                    </div>
                    <div class='panel-body'><!--Panel Body -->
                        <div class='col-sm-12'>
                            <form action='' method='POST' class='form-default col-sm-4'>";
        while($row = mysqli_fetch_assoc($ceks)){
            echo"<div class='form-group'>
                                    <label>Customer Name:</label>
                                    <input type='text' class='form-control' name='customerName' value='".$row['customerName']."'>
                                    <span class = 'error'>*".$CustomerNameErr."</span>
                                </div>
                                <div class='form-group'>
                                    <label>Company Name:</label>
                                    <input type='text' class='form-control' name='companyName' value='".$row['companyName']."'>
                                    <span class = 'error'>*".$CompanyNameErr."</span>
                                </div>
                                <div class='form-group'>
                                    <label>Title:</label>
                                    <input type='text' class='form-control' name='title' value='".$row['title']."'>
                                    <span class = 'error'>*".$TitleErr."</span>
                                </div>
                                <div class='form-group'>
                                    <label>Email:</label>
                                    <input type='email' class='form-control' name='email' value='".$row['email']."'>
                                    <span class = 'error'>*".$EmailErr."</span>
                                </div>
                                <div class='form-group'>
                                    <label>Phone Number:</label>
                                    <input type='text' class='form-control' name='phoneNumber' value='".$row['phoneNumber']."'>
                                    <span class = 'error'>*".$PhoneNumberErr."</span>
                                </div>
                                <div class='form-group'>
                                    <input type='submit' name='update' class='btn btn-success' value='Simpan'>
                                    <a href='index.php?p=rsvp&aksi=home' class='btn btn-danger'>Kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>";
        }
    }
}


//ini untuk delete
if($_GET['aksi'] == "delete" && $_GET['code'] != ""){
    $code = $_GET['code'];
    $update = "UPDATE rsvp SET status = 0 WHERE idRsvp = '$code'";
    mysqli_query($conn, $update);
    header('Location: index.php?p=rsvp&aksi=home');
}
?>