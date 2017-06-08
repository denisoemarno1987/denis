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
                        <span class='glyphicon glyphicon-dashboard'></span> User Login List
                    </div>
                    <div class='panel-body'><!--Panel Body -->
                        <div class='col-sm-12'>
                            <table class='table table-hover'>
                                            <thead>
                                            <tr>                                            
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>Company</th>
                                                <th>Title</th>
                                                <th>Email</th>
                                                <th>Mobile Phone</th>
                                                <th>Aksi</th>
                                            </tr>
                                            </thead>
                                            <tbody>";
                                            if(mysqli_num_rows($hasil) > 0){
                                                while($row = mysqli_fetch_assoc($hasil)){
                                                    if($row['status'] != 0){
                                                    echo"<tr>
                                                            <td>".$i++."</td>
                                                            <td>".$row["customerName"]."</td>
                                                            <td>".$row["companyName"]."</td>
                                                            <td>".$row["title"]."</td>
                                                            <td>".$row["email"]."</td>
                                                            <td>".$row["phoneNumber"]."</td>

                                                            <td>
                                                                <a href='index.php?p=rsvp&aksi=update&code=".$row['idRsvp']."' class='btn btn-warning'>Edit</a>
                                                                <a href='index.php?p=rspv&aksi=delete&code=".$row['idRsvp']."' class='btn btn-danger'>Hapus</a>
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
    $NameErr = $CompanyErr = $TitleErr = $EmailErr = $phoneNumberErr = "";
    $NameChace = $CompanyChace = $TitleChace = $EmailChace = $phoneNumberChace = "";
    $cekvalid = true;
    if(isset($_POST['insert'])){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["customerName"])) {
                $NameErr = "Name is required";
                $cekvalid = false;
            }else{
                $NameChace = test_input($_POST["customerName"]);
                $cekvalid = true;
            }

            if(empty($_POST["companyName"])){
                $CompanyErr = "Company is required";
                $cekvalid = false;
            }else{
                $CompanyChace = test_input($_POST["companyName"]);
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
                $phoneNumberErr = " Mobile Phone is required";
                $cekvalid = false;
            }else{
                $phoneNumberChace = test_input($_POST["phoneNumber"]);
                $cekvalid = true;
            }

            if($cekvalid == true){
               
                $insert = "INSERT INTO rsvp (customerName, companyName, title, email, phoneNumber, status) 
                            VALUES ('$_POST[customerName]', '$_POST[companyName]', '$_POST[title]', '$_POST[email]','$_POST[phoneNumber]', 1)";
                mysqli_query($conn, $insert);
                header('Location: index.php?p=rsvp&aksi=home');
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
                        <span class='glyphicon glyphicon-dashboard'></span> Insert User
                    </div>
                    <div class='panel-body'><!--Panel Body -->
                        <div class='col-sm-12'>
                            <form action='' method='POST' class='form-default col-sm-4'>
                                <div class='form-group'>
                                    <label>Name:</label>
                                    <input type='text' class='form-control' name='customerName' value='".$NameChace."'>
                                    <span class = 'error'>*".$NameErr."</span>
                                </div>
                                <div class='form-group'>
                                    <label>Company:</label>
                                    <input type='text' class='form-control' name='companyName' value='".$CompanyChace."'>
                                    <span class = 'error'>*".$CompanyErr."</span>
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
                                    <label>Mobile Phone:</label>
                                    <input type='text' class='form-control' name='phoneNumber' value='".$phoneNumberChace."'>
                                    <span class = 'error'>*".$phoneNumberErr."</span>
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
    $NameErr = $CompanyErr = $TitleErr = $EmailErr = $phoneNumberErr = "";
    $NameChace = $CompanyChace = $TitleChace = $EmailChace = $phoneNumberChace = "";
    $cekvalid = true;
    if(isset($_POST['update'])){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["customerName"])) {
                $NameErr = "Name is required";
                $cekvalid = false;
            }else{
                $NameChace = test_input($_POST["customerName"]);
                $cekvalid = true;
            }

            if(empty($_POST["companyName"])){
                $CompanyErr = "Company is required";
                $cekvalid = false;
            }else{
                $CompanyChace = test_input($_POST["companyName"]);
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
                $phoneNumberErr = " Mobile Phone is required";
                $cekvalid = false;
            }else{
                $phoneNumberChace = test_input($_POST["phoneNumber"]);
                $cekvalid = true;
            }
            if($cekvalid == true){
                
                $update = "UPDATE rsvp SET customerName = '$_POST[customerName]', companyName='$_POST[companyName]',
                            title = '$_POST[title]', email='$_POST[email]', phoneNumber='$_POST[phoneNumber]'
                            WHERE idRsvp = '$code'";
                    mysqli_query($conn, $update);
                   header('Location: index.php?p=rsvp&aksi=home');
            }
        }
    }

    $cek = "SELECT * FROM rsvp WHERE idRsvp = '$code'";   
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
                                    <label>Name:</label>
                                    <input type='text' class='form-control' name='customerName' value='".$row['customerName']."'>
                                    <span class = 'error'>*".$NameErr."</span>
                                </div>
                                <div class='form-group'>
                                    <label>Company:</label>
                                    <input type='text' class='form-control' name='companyName' value='".$row['companyName']."'>
                                    <span class = 'error'>*".$CompanyErr."</span>
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
                                    <label>Mobile Phone:</label>
                                    <input type='text' class='form-control' name='phoneNumber' value='".$$row['phoneNumber']."'>
                                    <span class = 'error'>*".$phoneNumberErr."</span>
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