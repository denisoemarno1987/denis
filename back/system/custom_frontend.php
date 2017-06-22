<?php
//ini untuk index
if($_GET['aksi'] == "front-end"){
    if(isset($_POST['submit']) && isset($_FILES['img_name'])){
        $target_dir = "../bootstrap/img/";
        $uploadOk = 1;
        $file_name = $_FILES['img_name']['name'];
        $file_size =$_FILES['img_name']['size'];
        $file_tmp =$_FILES['img_name']['tmp_name'];
        $file_type=$_FILES['img_name']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['img_name']['name'])));
        $expensions= array("jpeg","jpg","png");
        // Check if image file is a actual image or fake image
        if(in_array($file_ext,$expensions)=== false) {
            echo "extension not allowed, please choose a JPEG or PNG file.";
            $uploadOk = 0;
        }
        // Check file size
        if ($file_size > 5000000) {
            echo "File size must be excately 5MB.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } 
        else {
                //upload an image
                move_uploaded_file($file_tmp, $target_dir.$file_name);

                $update = "UPDATE custom_front SET dir_name = '$target_dir', img_name='$file_name',
                            footer_name = '$_POST[footer_name]'
                            WHERE id_front = 'front'";
                mysqli_query($conn, $update);
                header('Location: index.php?p=custom_frontend&aksi=front-end');

        }
    }
?>
<div class="panel-content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-10 col-sm-10">
            <div class="panel panel-primary"><!--Panel -->
                <div class="panel-heading"><!--Panel Header -->
                    <span class="glyphicon glyphicon-dashboard"></span> Change FrontEnd
                </div>
                <div class="panel-body"><!--Panel Body -->
                    <div class="col-sm-12">
                            <form action="" method="post" enctype="multipart/form-data">
                            <?php 
                                $query = "SELECT * FROM custom_front WHERE id_front = 'front'";
                                $hasil = mysqli_query($conn, $query);

                                if(mysqli_num_rows($hasil) > 0){
                                    while($row = mysqli_fetch_assoc($hasil)){
                                        if($row['status'] != 0){
                            ?>
                                        <div class="form-group">
                                            <label>Header Image</label><br>
                                            <input type="hidden" name="id_front" value="<?php echo $row['id_front']; ?>">
                                            <img src="<?php echo $row['dir_name'].$row['img_name']; ?>"/>
                                            <input type="file" name="img_name" value="" required/><br />
                                        </div>
                                        <div class="form-group">
                                            <label>Footer label</label>
                                            <input type="text" name="footer_name" value="<?php echo $row['footer_name']; ?>" required/><br />
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="Submit" class="btn btn-default" name="submit"/>
                                            <input type="button" align="left" value="Back" class="btn btn-success" onclick="history.go(-1)"/>
                                        </div>
                            <?php } } } else { echo "Tidak ada data !"; } ?>
                            </form>                    
                    </div>            
                            
                             </form>
                            </div>
                        

                    </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>      
<?php } ?>
<?php
//ini untuk index
if($_GET['aksi'] == "back-end"){
    if(isset($_POST['submit']) && isset($_FILES['img_name'])){
        $target_dir = "../bootstrap/img/";
        $uploadOk = 1;
        $file_name = $_FILES['img_name']['name'];
        $file_size =$_FILES['img_name']['size'];
        $file_tmp =$_FILES['img_name']['tmp_name'];
        $file_type=$_FILES['img_name']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['img_name']['name'])));
        $expensions= array("jpeg","jpg","png");
        // Check if image file is a actual image or fake image
        if(in_array($file_ext,$expensions)=== false) {
            echo "extension not allowed, please choose a JPEG or PNG file.";
            $uploadOk = 0;
        }
        // Check file size
        if ($file_size > 5000000) {
            echo "File size must be excately 5MB.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } 
        else {
                //upload an image
                move_uploaded_file($file_tmp, $target_dir.$file_name);

                $update = "UPDATE custom_front SET dir_name = '$target_dir', img_name='$file_name',
                            footer_name = '$_POST[footer_name]'
                            WHERE id_front = 'back'";
                mysqli_query($conn, $update);
                header('Location: index.php?p=custom_frontend&aksi=back-end');

        }
    }
?>
<div class="panel-content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-10 col-sm-10">
            <div class="panel panel-primary"><!--Panel -->
                <div class="panel-heading"><!--Panel Header -->
                    <span class="glyphicon glyphicon-dashboard"></span> Change FrontEnd
                </div>
                <div class="panel-body"><!--Panel Body -->
                    <div class="col-sm-12">
                            <form action="" method="post" enctype="multipart/form-data">
                            <?php 
                                $query = "SELECT * FROM custom_front WHERE id_front = 'back'";
                                $hasil = mysqli_query($conn, $query);

                                if(mysqli_num_rows($hasil) > 0){
                                    while($row = mysqli_fetch_assoc($hasil)){
                                        if($row['status'] != 0){
                            ?>
                                        <div class="form-group">
                                            <label>Header Image</label><br>
                                            <input type="hidden" name="id_front" value="<?php echo $row['id_front']; ?>">
                                            <img src="<?php echo $row['dir_name'].$row['img_name']; ?>"/>
                                            <input type="file" name="img_name" value="" required/><br />
                                        </div>
                                        <div class="form-group">
                                            <label>Footer label</label>
                                            <input type="text" name="footer_name" value="<?php echo $row['footer_name']; ?>" required/><br />
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" value="Submit" class="btn btn-default" name="submit"/>
                                            <input type="button" align="left" value="Back" class="btn btn-success" onclick="history.go(-1)"/>
                                        </div>
                            <?php } } } else { echo "Tidak ada data !"; } ?>
                            </form>                    
                    </div>            
                            
                             </form>
                            </div>
                        

                    </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>      
<?php } ?>