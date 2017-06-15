<?php
if($_GET['aksi'] == "Rsvp"){
echo"<div class='panel-content'>
    <div class='container-fluid'>
        <div class='row'>
        <div class='col-md-10 col-sm-10'>
            <div class='panel panel-primary'>
                <div class='panel-heading'>
                    <span class='glyphicon glyphicon-dashboard'></span> Export File RSVP
                </div>
                <div class='panel-body'>
                    <div class='col-sm-12'>
                        <form class='form-horizontal' action='../conf/functions.php' method='post' name='upload_excel'   
                      enctype='multipart/form-data'>
                            <div class='form-group'>
                                <div class='col-md-4 col-md-offset-4'>
                                    <input type='submit' name='Export_Rsvp' class='btn btn-success' value='export to excel'/>
                                </div>
                            </div>                    
                        </form>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div> ";   
}
if($_GET['aksi'] == "WalkIn"){
echo"<div class='panel-content'>
    <div class='container-fluid'>
        <div class='row'>
        <div class='col-md-10 col-sm-10'>
            <div class='panel panel-primary'>
                <div class='panel-heading'>
                    <span class='glyphicon glyphicon-dashboard'></span> Export File RSVP By Walk In
                </div>
                <div class='panel-body'>
                    <div class='col-sm-12'>
                        <form class='form-horizontal' action='../conf/functions.php' method='post' name='upload_excel'   
                      enctype='multipart/form-data'>
                            <div class='form-group'>
                                <div class='col-md-4 col-md-offset-4'>
                                    <input type='submit' name='Export_WalkIn' class='btn btn-success' value='export to excel'/>
                                </div>
                            </div>                    
                        </form>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div> ";   
}
?>