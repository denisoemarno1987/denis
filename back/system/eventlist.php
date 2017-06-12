<?php
//ini untuk index
if($_GET['aksi'] == "home"){
    $query = "SELECT * FROM event_list";
	$hasil = mysqli_query($conn, $query);
	$i = 1;
    echo"
    <div class='panel-content'>
        <div class='container-fluid'>
            <div class='row'>
            <div class='col-md-10 col-sm-10'>
                <div class='panel panel-primary'><!--Panel -->
                    <div class='panel-heading'><!--Panel Header -->
                        <span class='glyphicon glyphicon-dashboard'></span> Event List
                    </div>
                    <div class='panel-body'><!--Panel Body -->
                        <div class='col-sm-12'>
                            <table class='table table-striped table-bordered data'>
                                            <thead>
                                            <tr>                                            
                                                <th>No.</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>From Date</th>
                                                <th>To Date</th>
                                                <th>Event Name</th>
                                                <th>Event Location</th>
                                                <th>Client</th>
                                                <th>Aksi</th>
                                            </tr>
                                            </thead>
                                            <tbody>";
                                            if(mysqli_num_rows($hasil) > 0){
                                                while($row = mysqli_fetch_assoc($hasil)){
                                                    if($row['status'] != 0){
                                                    echo"<tr>
                                                            <td>".$i++."</td>
                                                            <td>".$row["start_date"]."</td>
                                                            <td>".$row["end_date"]."</td>
                                                            <td>".$row["from_date"]."</td>
                                                            <td>".$row["to_date"]."</td>
                                                            <td>".$row["event_name"]."</td>
                                                            <td>".$row["event_location"]."</td>
                                                            <td>".$row["client"]."</td>
                                                            <td>";
                                                            $cek = "SELECT * FROM event_now WHERE event_now='$row[id_event]'";   
                                                            $ceks = mysqli_query($conn, $cek);
                                                            if(mysqli_num_rows($ceks) > 0){
                                                                echo"<a href='index.php?p=eventlist&aksi=eventNow&code=".$row['id_event']."' class='btn btn-primary'>Default</a>";
                                                            }else{
                                                                echo"<a href='index.php?p=eventlist&aksi=eventNow&code=".$row['id_event']."' class='btn btn-default'>Default</a>";
                                                            }
                                                                echo"<a href='index.php?p=eventlist&aksi=update&code=".$row['id_event']."' class='btn btn-warning'>Edit</a>
                                                                <a href='index.php?p=eventlist&aksi=delete&code=".$row['id_event']."' class='btn btn-danger style='color:#c00;' Onclick='return ConfirmDelete();'>Hapus</a>
                                                            </td>
                                                        </tr>";
                                                    }
                                                }
                                            }
                                            echo"</tbody>
                                        </table>
                                        <a href='index.php?p=eventlist&aksi=insert' class='btn btn-success'>Tambah</a>
                        </div>
                    </div>";
}
//ini untuk insert data
if($_GET['aksi'] == "insert"){
    $StartDateErr = $EndDateErr = $FromDateErr = $TodateErr = $EventNameErr = $EventLocErr = $ClientErr = "";
    $StartDateChace = $EndDateChace = $FromDateChace = $TodateChace = $EventNameChace = $EventLocChace = $ClientChace = "";
    $cekvalid = true;
    if(isset($_POST['insert'])){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["start_date"])) {
                $EmailErr = "Start Date is required";
                $cekvalid = false;
            }else{
                $EmailChace = test_input($_POST["start_date"]);
                $cekvalid = true;
            }

            if(empty($_POST["end_date"])){
                $NameErr = "End Date is required";
                $cekvalid = false;
            }else{
                $NameChace = test_input($_POST["end_date"]);
                $cekvalid = true;
            }

            if(empty($_POST["from_date"])){
                $PasswordErr = "From Date is required";
                $cekvalid = false;
            }else{
                $PasswordChache = test_input($_POST["from_date"]);
                $cekvalid = true;
            }

            if(empty($_POST["to_date"])){
                $LevelErr = "To Date is required";
                $cekvalid = false;
            }else{
                $LevelChace = test_input($_POST["to_date"]);
                $cekvalid = true;
            }

            if(empty($_POST["event_name"])){
                $LevelErr = "Event Name is required";
                $cekvalid = false;
            }else{
                $LevelChace = test_input($_POST["event_name"]);
                $cekvalid = true;
            }

            if(empty($_POST["event_location"])){
                $LevelErr = "Event Location is required";
                $cekvalid = false;
            }else{
                $LevelChace = test_input($_POST["event_location"]);
                $cekvalid = true;
            }

            if(empty($_POST["client"])){
                $LevelErr = "Client is required";
                $cekvalid = false;
            }else{
                $LevelChace = test_input($_POST["client"]);
                $cekvalid = true;
            }

            if($cekvalid == true){
                $insert = "INSERT INTO event_list (start_date, end_date, from_date, to_date, event_name, event_location, client, status) 
                            VALUES ('$_POST[start_date]', '$_POST[end_date]', '$_POST[from_date]', '$_POST[to_date]', '$_POST[event_name]', '$_POST[event_location]', '$_POST[client]', 1)";
                mysqli_query($conn, $insert);
                header('Location: index.php?p=eventlist&aksi=home');
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
                        <span class='glyphicon glyphicon-dashboard'></span> Insert Event List
                    </div>
                    <div class='panel-body'><!--Panel Body -->
                        <div class='col-sm-12'>
                            <form action='' method='POST' class='form-default col-sm-4'>
                                <div class='form-group'>
                                    <label>Start Date:</label>
                                    <input type='text' class='form-control' name='start_date' value='".$StartDateChace."' data-provide='datepicker' data-date-format='yyyy/mm/dd'>
                                    <span class = 'error'>*".$StartDateErr."</span>
                                </div>
                                <div class='form-group'>
                                    <label>End Date:</label>
                                    <input type='text' class='form-control' name='end_date' value='".$EndDateChace."' data-provide='datepicker' data-date-format='yyyy/mm/dd'>
                                    <span class = 'error'>*".$EndDateErr."</span>
                                </div>
                                <div class='form-group'>
                                    <label>From Date:</label>
                                    <input type='text' class='form-control' name='from_date' value='".$FromDateChace."' data-provide='datepicker' data-date-format='yyyy/mm/dd'>
                                    <span class = 'error'>*".$FromDateErr."</span>
                                </div>
                                <div class='form-group'>
                                    <label>To Date:</label>
                                    <input type='text' class='form-control' name='to_date' value='".$TodateChace."' data-provide='datepicker' data-date-format='yyyy/mm/dd'>
                                    <span class = 'error'>*".$TodateErr."</span>
                                </div>
                                <div class='form-group'>
                                    <label>Event Name:</label>
                                    <input type='text' class='form-control' name='event_name' value='".$EventNameChace."'>
                                    <span class = 'error'>*".$EventNameErr."</span>
                                </div>
                                <div class='form-group'>
                                    <label>Event Location:</label>
                                    <input type='text' class='form-control' name='event_location' value='".$EventLocChace."'>
                                    <span class = 'error'>*".$EventLocErr."</span>
                                </div>
                                <div class='form-group'>
                                    <label>Client:</label>
                                    <input type='text' class='form-control' name='client' value='".$ClientChace."'>
                                    <span class = 'error'>*".$ClientErr."</span>
                                </div>
                                <div class='form-group'>
                                    <input type='submit' name='insert' class='btn btn-success' value='Simpan'>
                                    <a href='index.php?p=eventlist&aksi=home' class='btn btn-danger'>Kembali</a>
                                </div>   
                            </form>
                        </div>
                    </div>";
}
//ini untuk update
if($_GET['aksi'] == "update" && $_GET['code'] != ""){
    $code = $_GET['code'];
    $StartDateErr = $EndDateErr = $FromDateErr = $TodateErr = $EventNameErr = $EventLocErr = $ClientErr = "";
    $StartDateChace = $EndDateChace = $FromDateChace = $TodateChace = $EventNameChace = $EventLocChace = $ClientChace = "";
    $cekvalid = true;
    if(isset($_POST['update'])){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["start_date"])) {
                $EmailErr = "Start Date is required";
                $cekvalid = false;
            }else{
                $EmailChace = test_input($_POST["start_date"]);
                $cekvalid = true;
            }

            if(empty($_POST["end_date"])){
                $NameErr = "End Date is required";
                $cekvalid = false;
            }else{
                $NameChace = test_input($_POST["end_date"]);
                $cekvalid = true;
            }

            if(empty($_POST["from_date"])){
                $PasswordErr = "From Date is required";
                $cekvalid = false;
            }else{
                $PasswordChache = test_input($_POST["from_date"]);
                $cekvalid = true;
            }

            if(empty($_POST["to_date"])){
                $LevelErr = "To Date is required";
                $cekvalid = false;
            }else{
                $LevelChace = test_input($_POST["to_date"]);
                $cekvalid = true;
            }

            if(empty($_POST["event_name"])){
                $LevelErr = "Event Name is required";
                $cekvalid = false;
            }else{
                $LevelChace = test_input($_POST["event_name"]);
                $cekvalid = true;
            }

            if(empty($_POST["event_location"])){
                $LevelErr = "Event Location is required";
                $cekvalid = false;
            }else{
                $LevelChace = test_input($_POST["event_location"]);
                $cekvalid = true;
            }

            if(empty($_POST["client"])){
                $LevelErr = "Client is required";
                $cekvalid = false;
            }else{
                $LevelChace = test_input($_POST["client"]);
                $cekvalid = true;
            }

            if($cekvalid == true){
                $update = "UPDATE event_list SET start_date = '$_POST[start_date]', end_date='$_POST[end_date]',
                            from_date = '$_POST[from_date]', to_date='$_POST[to_date]', event_name = '$_POST[event_name]',
                            event_location = '$_POST[event_location]', client = '$_POST[client]'
                            WHERE id_event = '$code'";
                    mysqli_query($conn, $update);
                   header('Location: index.php?p=eventlist&aksi=home');
            }
        }
    }
    $cek = "SELECT * FROM event_list WHERE id_event='$code'";   
    $ceks = mysqli_query($conn, $cek);

    if(mysqli_num_rows($ceks) > 0){
        echo"
        <div class='panel-content'>
        <div class='container-fluid'>
            <div class='row'>
            <div class='col-md-10 col-sm-10'>
                <div class='panel panel-primary'><!--Panel -->
                    <div class='panel-heading'><!--Panel Header -->
                        <span class='glyphicon glyphicon-dashboard'></span> Update Event
                    </div>
                    <div class='panel-body'><!--Panel Body -->
                        <div class='col-sm-12'>
                            <form action='' method='POST' class='form-default col-sm-4'>";
        while($row = mysqli_fetch_assoc($ceks)){
            echo"<div class='form-group'>
                                    <label>Start Date:</label>
                                    <input type='text' class='form-control' name='start_date' value='".$row['start_date']."' data-provide='datepicker' data-date-format='yyyy/mm/dd'>
                                    <span class = 'error'>*".$StartDateErr."</span>
                                </div>
                                <div class='form-group'>
                                    <label>End Date:</label>
                                    <input type='text' class='form-control' name='end_date' value='".$row['end_date']."' data-provide='datepicker' data-date-format='yyyy/mm/dd'>
                                    <span class = 'error'>*".$EndDateErr."</span>
                                </div>
                                <div class='form-group'>
                                    <label>From Date:</label>
                                    <input type='text' class='form-control' name='from_date' value='".$row['from_date']."' data-provide='datepicker' data-date-format='yyyy/mm/dd'>
                                    <span class = 'error'>*".$FromDateErr."</span>
                                </div>
                                <div class='form-group'>
                                    <label>To Date:</label>
                                    <input type='text' class='form-control' name='to_date' value='".$row['to_date']."' data-provide='datepicker' data-date-format='yyyy/mm/dd'>
                                    <span class = 'error'>*".$TodateErr."</span>
                                </div>
                                <div class='form-group'>
                                    <label>Event Name:</label>
                                    <input type='text' class='form-control' name='event_name' value='".$row['event_name']."'>
                                    <span class = 'error'>*".$EventNameErr."</span>
                                </div>
                                <div class='form-group'>
                                    <label>Event Location:</label>
                                    <input type='text' class='form-control' name='event_location' value='".$row['event_location']."'>
                                    <span class = 'error'>*".$EventLocErr."</span>
                                </div>
                                <div class='form-group'>
                                    <label>Client:</label>
                                    <input type='text' class='form-control' name='client' value='".$row['client']."'>
                                    <span class = 'error'>*".$ClientErr."</span>
                                </div>
                                <div class='form-group'>
                                    <input type='submit' name='update' class='btn btn-success' value='Simpan'>
                                    <a href='index.php?p=eventlist&aksi=home' class='btn btn-danger'>Kembali</a>
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
    $update = "UPDATE event_list SET status = 0 WHERE id_event = '$code'";
    mysqli_query($conn, $update);
    header('Location: index.php?p=eventlist&aksi=home');
}

//ini untuk event Now
if($_GET['aksi'] == "eventNow" && $_GET['code'] != ""){
    $code = $_GET['code'];

    $cek = "SELECT * FROM event_now WHERE event_now='$code'";   
    $ceks = mysqli_query($conn, $cek);

    if(mysqli_num_rows($ceks) > 0){
        //hapus data dulu
        $delete = "DELETE FROM event_now";
        mysqli_query($conn, $delete);
        //kemudian insert
        $insert = "INSERT INTO event_now (id, event_now) VALUES (1, '$code')";
        mysqli_query($conn, $insert);
    }else{
        //hapus data dulu
        $delete = "DELETE FROM event_now";
        mysqli_query($conn, $delete);
        //kemudian insert
        $insert = "INSERT INTO event_now (id, event_now) VALUES (1, '$code')";
        mysqli_query($conn, $insert);
    }
    header('Location: index.php?p=eventlist&aksi=home');
}
?>