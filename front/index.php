<!-- ini untuk posisi menu navigasi -->
    <body>
        

                                
                                        <?php
                                            $pages_dir = 'front';
                                            if(!empty($_GET['p'])){
                                                $pages = scandir($pages_dir, 0);
                                                unset($pages[0], $pages[1]);
                                    
                                                $p = $_GET['p'];
                                                if(in_array($p.'.php', $pages)){
                                                    require('layoutFront/header.php');
                                                    include($pages_dir.'/'.$p.'.php');
                                                } else {
                                                    echo 'Halaman tidak ditemukan! :(';
                                                }
                                            } else {
                                                require('layoutFront/header.php');
                                                include($pages_dir.'/index.php');
                                            }
                                        ?>  

                         <!-- dialog box hidden -->
                            <section id="section-regis" class="section-wrapper section-regis">
                                <div id="container" style="display">
                                    <form class="form-horizontal" role="form" action="" method="post">
                                        <h2 align="center">Registration Form</h2>
                                        <div class="form-group">
                                            <label for="firstName" class="col-sm-3 control-label">Full Name</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="firstName" name="customerName" placeholder="Full Name" class="form-control" autofocus>
                                                <span class="help-block">Last Name, First Name, eg.: Smith, Harry</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="company" class="col-sm-3 control-label">Company</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="company" name="companyName" placeholder="Company" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="title" class="col-sm-3 control-label">Title</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="title" name="title" placeholder="Title" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-sm-3 control-label">Email</label>
                                            <div class="col-sm-6">
                                                <input type="email" id="email" name="email" placeholder="Email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phoneNumber" class="col-sm-3 control-label">Phone Number</label>
                                            <div class="col-sm-6">
                                                <input type="phoneNumber" id="phoneNumber" name="phoneNumber" placeholder="Mobile Phone" class="form-control">
                                            </div>
                                        </div>
                                         
                                        <div class="form-group">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" class="btn btn-primary btn-block" name="done_Rspv" value="Register">
                                            </div>
                                        </div>
                                    </form> <!-- /form -->
                                </div> <!-- ./container -->
                            </section>

                            <!-- end dialog box hidden -->



                        <div class="panel-footer"><!--Panel Footer -->
                        </div>  
                    </div>
                </div>
            </div>
        </div>
        </div>
<!-- ini untuk posisi footer -->
        <div class="clear">&nbsp;</div>
        <div class="clear">&nbsp;</div>
        <div class="panel-footer">
            <div class="footer-bottom">
                <div class="container">
                    <center><a href="#">&copy; Copyright 2016 #NgeCodeAja</a></center>
                </div>
            </div>
        </div>
        <!-- posisi footer selesai -->

</body>
</html>