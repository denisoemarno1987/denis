<?php
//ini untuk index
if($_GET['aksi'] == "home"){
    $query = "SELECT * FROM user_login";
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
                            <table class='table table-striped table-bordered data'>
                                            <thead>
                                            <tr>                                            
                                                <th>No.</th>
                                                <th>Email</th>
                                                <th>Name</th>
                                                <th>Level</th>
                                                <th>Aksi</th>
                                            </tr>
                                            </thead>
                                            <tbody>";
                                            if(mysqli_num_rows($hasil) > 0){
                                                while($row = mysqli_fetch_assoc($hasil)){
                                                    if($row['status'] != 0){
                                                    echo"<tr>
                                                            <td>".$i++."</td>
                                                            <td>".$row["email"]."</td>
                                                            <td>".$row["name"]."</td>
                                                            <td>".$row["level"]."</td>
                                                            <td>
                                                                <a href='index.php?p=user_login&aksi=update&code=".$row['id_user']."' class='btn btn-warning'>Edit</a>
                                                                <a href='index.php?p=user_login&aksi=delete&code=".$row['id_user']."' class='btn btn-danger style='color:#c00;' Onclick='return ConfirmDelete();'>Hapus</a>
                                                            </td>
                                                        </tr>";
                                                    }
                                                }
                                            }
                                            echo"</tbody>
                                        </table>
                                        <a href='index.php?p=user_login&aksi=insert' class='btn btn-success'>Tambah</a>
                        </div>
                    </div>";
}
//ini untuk insert data
if($_GET['aksi'] == "insert"){
    $EmailErr = $NameErr = $PasswordErr = $LevelErr = "";
    $EmailChace = $NameChace = $PasswordChache = $LevelChace = "";
    $cekvalid = true;
    if(isset($_POST['insert'])){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["email"])) {
                $EmailErr = "Email is required";
                $cekvalid = false;
            }else{
                $EmailChace = test_input($_POST["email"]);
                $cekvalid = true;
            }

            if(empty($_POST["name"])){
                $NameErr = "Name is required";
                $cekvalid = false;
            }else{
                $NameChace = test_input($_POST["name"]);
                $cekvalid = true;
            }

            if(empty($_POST["password"])){
                $PasswordErr = "password is required";
                $cekvalid = false;
            }else{
                $PasswordChache = test_input($_POST["password"]);
                $cekvalid = true;
            }

            if(empty($_POST["level"])){
                $LevelErr = "level user is required";
                $cekvalid = false;
            }else{
                $LevelChace = test_input($_POST["level"]);
                $cekvalid = true;
            }

            if($cekvalid == true){
                $EnDPass = md5($Salt.$_POST['password']);
                $insert = "INSERT INTO user_login (email, password, level, name, status) 
                            VALUES ('$_POST[email]', '$EnDPass', '$_POST[level]', '$_POST[name]', 1)";
                mysqli_query($conn, $insert);
                header('Location: index.php?p=user_login&aksi=home');
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
                                    <label>Email:</label>
                                    <input type='email' class='form-control' name='email' value='".$EmailChace."'>
                                    <span class = 'error'>*".$EmailErr."</span>
                                </div>
                                <div class='form-group'>
                                    <label>Name:</label>
                                    <input type='text' class='form-control' name='name' value='".$NameChace."'>
                                    <span class = 'error'>*".$NameErr."</span>
                                </div>
                                <div class='form-group'>
                                    <label>Password:</label>
                                    <input type='password' class='form-control' name='password' value='".$PasswordChache."'>
                                    <span class = 'error'>*".$PasswordErr."</span>
                                </div>
                                <div class='form-group'>
                                    <div><h4><strong>Choose Level:</strong></h4></div>
                                    <label class='radio-inline'>
                                    <input type='radio' name='level' value='executive'>
                                    <strong>executive</strong>
                                    </label>
                                    <label class='radio-inline'>
                                    <input type='radio' name='level' value='admin'>
                                    <strong>admin</strong>
                                    </label>
                                    <span class = 'error'>*".$LevelErr."</span>
                                </div>
                                <div class='form-group'>
                                    <input type='submit' name='insert' class='btn btn-success' value='Simpan'>
                                    <a href='index.php?p=user_login&aksi=home' class='btn btn-danger'>Kembali</a>
                                </div>   
                            </form>
                        </div>
                    </div>";
}
//ini untuk update
if($_GET['aksi'] == "update" && $_GET['code'] != ""){
    $code = $_GET['code'];
    $EmailErr = $NameErr = $PasswordErr = $LevelErr = "";
    $EmailChace = $NameChace = $PasswordChache = $LevelChace = "";
    $cekvalid = true;
    if(isset($_POST['update'])){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["email"])) {
                $EmailErr = "Email is required";
                $cekvalid = false;
            }else{
                $EmailChace = test_input($_POST["email"]);
                $cekvalid = true;
            }

            if(empty($_POST["name"])){
                $NameErr = "Name is required";
                $cekvalid = false;
            }else{
                $NameChace = test_input($_POST["name"]);
                $cekvalid = true;
            }

            if(empty($_POST["password"])){
                $PasswordErr = "password is required";
                $cekvalid = false;
            }else{
                $PasswordChache = test_input($_POST["password"]);
                $cekvalid = true;
            }

            if(empty($_POST["level"])){
                $LevelErr = "level user is required";
                $cekvalid = false;
            }else{
                $LevelChace = test_input($_POST["level"]);
                $cekvalid = true;
            }

            if($cekvalid == true){
                $EnDPass = md5($Salt.$_POST['password']);
                $update = "UPDATE user_login SET email = '$_POST[email]', password='$EnDPass',
                            level = '$_POST[level]', name='$_POST[name]' 
                            WHERE id_user = '$code'";
                    mysqli_query($conn, $update);
                   header('Location: index.php?p=user_login&aksi=home');
            }
        }
    }
    $cek = "SELECT * FROM user_login WHERE id_user='$code'";   
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
                                    <label>Email:</label>
                                    <input type='email' class='form-control' name='email' value='".$row['email']."'>
                                    <span class = 'error'>*".$EmailErr."</span>
                                </div>
                                <div class='form-group'>
                                    <label>Name:</label>
                                    <input type='text' class='form-control' name='name' value='".$row['name']."'>
                                    <span class = 'error'>*".$NameErr."</span>
                                </div>
                                <div class='form-group'>
                                    <label>Password:</label>
                                    <input type='password' class='form-control' name='password' value='".$row['password']."'>
                                    <span class = 'error'>*".$PasswordErr."</span>
                                </div>
                                <div class='form-group'>
                                    <div><h4><strong>Choose Level:</strong></h4></div>
                                    <label class='radio-inline'>"; ?>
                                    <input type="radio" name="level" value="executive" 
                                        <?php if($row['level']=="executive"){echo "checked";}?>>
                                    <?php echo"<strong>executive</strong>
                                    </label>
                                    <label class='radio-inline'>"; ?>
                                    <input type="radio"" name="level"" value="admin"
                                    <?php if($row['level']=="admin"){echo "checked";}?>>
                                     <?php echo"<strong>admin</strong>
                                    </label>
                                    <span class = 'error'>*".$LevelErr."</span>
                                </div>
                                <div class='form-group'>
                                    <input type='submit' name='update' class='btn btn-success' value='Simpan'>
                                    <a href='index.php?p=user_login&aksi=home' class='btn btn-danger'>Kembali</a>
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
    $update = "UPDATE user_login SET status = 0 WHERE id_user = '$code'";
    mysqli_query($conn, $update);
    header('Location: index.php?p=user_login&aksi=home');
}
?>

