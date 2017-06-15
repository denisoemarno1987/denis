<?php 
if($_GET['aksi'] == "ImportCSV"){
$dateStamp = date('Y/m/d H:i:s');
if(isset($_POST["Import"])){
		
		$filename=$_FILES["file"]["tmp_name"];		

		 if($_FILES["file"]["size"] > 0)
		 {
		  	$file = fopen($filename, "r");
	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
                $sql = "INSERT INTO rsvp(idEvent, customerName, companyName, title, email, phoneNumber, created, modified,walkIn,isAttend,print,printer_name, status) 
                        VALUES('".intval($getData[1])."','".$getData[2]."','".$getData[3]."','".$getData[4]."','".$getData[5]."','".intval($getData[6])."','$dateStamp','$dateStamp','".intval($getData[9])."','".intval($getData[10])."','".intval($getData[11])."','".$getData[12]."','".intval($getData[13])."')";
                   $result = mysqli_query($conn, $sql);
				if(!isset($result))
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"index.php?p=import&aksi=ImportCSV\"
						  </script>";		
				}
				else {
					  echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"index.php?p=import&aksi=ImportCSV\"
					</script>";
				}
	         }
			
	         fclose($file);	
		 }
	}	
?>

<!-- ini untuk posisi content -->
<div class="panel-content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-10 col-sm-10">
            <div class="panel panel-primary"><!--Panel -->
                <div class="panel-heading"><!--Panel Header -->
                    <span class="glyphicon glyphicon-dashboard"></span> Import File RSVP
                </div>
                <div class="panel-body"><!--Panel Body -->
                    <div class="col-sm-12">
                       <form enctype="multipart/form-data" method="post" role="form">
                            <div class="form-group">
                                <label for="exampleInputFile">File Upload</label>
                                <input type="file" name="file" id="file" size="150">
                                <p class="help-block">Only CSV File Import.</p>
                            </div>
                            <a href="#" class="btn btn-primary">Back</a>
                            <button type="submit" class="btn btn-primary" name="Import" value="Import">Upload</button>
                        </form>
                    </div>
                    <div class="col-sm-12">
                    <?php                
                echo "</div></div>";
}
                ?>