<?php
include('../conf/koneksi.php');
if(isset($_POST['done_submit']))
{
    
}

?>



<!DOCTYPE html>
<html>
<head>
    <title>Scan Barcode</title>


<!-- Custom styles for this template -->


    <link href="../bootstrap/bs/navbar-static-top.css" rel="stylesheet">
    <link href="../bootstrap/bs/bs_tables.css" rel="stylesheet">
    <link href="../bootstrap/bs/bootstrap.datatables.css" rel="stylesheet">

    
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/bs/css/font.css">
    <link rel="stylesheet" href="../bootstrap/bs/css/style.css">
    <link href="new_page.css" rel="stylesheet">
    

</head>
<body>
<style> 
    .table th
    {
     font-size:14px;
     vertical-align:middle !important;
    }

    .table td
    {
     vertical-align:middle !important;
     font-size:14px;
     font-weight:bold; 
    }

    #bs_table th 
    {
        font-size:14px;
    }
    #bs_table td 
    {
        font-size:12px;
    }
    #bs_table td  input
    {
        font-size:12px;
    }

</style>
    <!-- Static navbar -->

<div id="header-wrap" class="clr">
    <header id="header" class="site-header clr container" role="banner">      
        <!-- place your image here -->
                <?php 
                    $query = "SELECT * FROM custom_front WHERE id_front='back'";
                    $hasil = mysqli_query($conn, $query);
                    if(mysqli_num_rows($hasil) > 0){
                        while($row = mysqli_fetch_assoc($hasil)){
                            if($row['status'] != 0){ ?>
               <img src="<?php echo $row['dir_name'].$row['img_name']; ?>" alt="company logo" style="width: 100%;" class="img-responsive">
</div>

<div class="clearfix">&nbsp;</div>
<div class="panel-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-8">
                <div class="panel panel-primary"><!--Panel -->
                    <div class="panel-body"><!--Panel Body -->
                        <div class="col-sm-12">
                            <form action="" class="result_table_form" name="bs_table" method="POST">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" name="search_form" required>
                            <span class="input-group-btn">
                                <input class="btn btn-default" type="submit" value="Search">
                            </span>
                            </div><!-- /input-group -->
                            </form>
                            <!--menampilkan data-->
                            <div class="clearfix">&nbsp;</div>
                            <table class="table table-striped table-bordered data"> 
                                    <?php
                                        if(isset($_POST["search_form"])){
                                        $no = 1;
                                        $q = "select * from rsvp where (customerName LIKE '%$_POST[search_form]%' || companyName LIKE '%$_POST[search_form]%')limit 10";
                                        $rsvp_sql = mysqli_query($conn, $q);
                                        if(mysqli_num_rows($rsvp_sql) > 0){ ?>
                                            <tr>
                                                <th width="25">No</th>
                                                <th>Customer Name</th>
                                                <th>Company</th>
                                                <th>Contact</th>
                                                <th>Email</th>
                                                <th style="text-align:center;">Registration</th>
                                            </tr>
                                    <?php
                                        while($rs=mysqli_fetch_assoc($rsvp_sql))
                                        {
                                            //$track = mysql_fetch_array(mysql_query("select * from track where idTrack = '$rs[idTrack]'"));
                                    ?>
                                    
                                    <tr>
                                        <td align="center" style="text-align:center;"><?php echo $no; ?></td>
                                        <td><?php echo $rs['customerName']; ?></td>
                                        <td><?php echo $rs['companyName']; ?></td>
                                        <td align="center" style="text-align:center; width:130px;">
                                        <?php
                                        if($rs['isAttend'] == 1)
                                                {
                                                    echo $rs['phoneNumber'];
                                        ?>
                                        <?php   }   else    {   ?>
                                            <input class="form-control" type="text" id="contact<?php echo $rs['idRsvp']; ?>" style="width:100%;" value="<?php echo $rs['phoneNumber']; ?>" name="phone<?php echo $rs['idRsvp']; ?>" />
                                        <?php   }   ?>
                                        </td>
                                        <td align="center" style="text-align:center; width:200px;">
                                        <?php
                                        if($rs['isAttend'] == 1)
                                                {
                                                    echo $rs['email'];
                                                }
                                                else    {   ?>
                                            <input class="form-control" type="text" id="email<?php echo $rs['idRsvp']; ?>" style="width:100%;" value="<?php echo $rs['email']; ?>" name="email<?php echo $rs['idRsvp']; ?>" />
                                        <?php   }   ?>
                                        </td>       
                                        <td style="text-align:center; width:120px;">                                        
                                        <div class="form-group">
                                            <?php
                                                if($rs['isAttend'] != 1)
                                                {   ?>
                                            <button type="button" value="<?php echo $rs['idRsvp']; ?>" data-toggle="modal" data-whatever = "<?php echo $rs['idRsvp']; ?>" name="update" data-target=".bs-example-modal-lg" class="btn btn-small btn-default ">Register</button>
                                            <?php   } else  { ?>
                                                <h5>Registered</h5>
                                            <?php } ?>
                                        </div>
                                        
                                        </td>
                                    </tr>                                    
                                    <?php   $no++; } }  } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-md-2'>&nbsp;</div>
        </div>
    </div>
</div>
<!-- ini untuk posisi footer -->
    <div class="clear">&nbsp;</div>
    <div class="clear">&nbsp;</div>
    <div class="panel-footer">
        <div class='container-fluid'>
            <div class="row">
                <center><a href="#"><?php echo $row["footer_name"]; } } }?></a></center>
            </div>
        </div>
    </div>
    <!-- posisi footer selesai -->
</body>
</html>
