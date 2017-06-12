<?php
session_start();
include('../conf/koneksi.php');
ob_start();
if(isset($_GET['logout'])){
	session_destroy();
	header('Location: index.php');
}
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
date_default_timezone_set('Asia/Jakarta');
?>

<!-- ini untuk posisi menu navigasi -->
    <body>
        

                                
                                        <?php
                                            $pages_dir = 'sistem';
                                            if(!empty($_GET['p'])){
                                                $pages = scandir($pages_dir, 0);
                                                unset($pages[0], $pages[1]);
                                    
                                                $p = $_GET['p'];
                                                if(in_array($p.'.php', $pages)){
                                                    require('layout/header.php');
                                                    require('layout/menu.php');
                                                    include($pages_dir.'/'.$p.'.php');
                                                } else {
                                                    echo 'Halaman tidak ditemukan! :(';
                                                }
                                            } else {
                                                require('layout/header.php');
                                                include($pages_dir.'/login.php');
                                            }
                                        ?>               
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

        <!-- Javascript -->
        <script src="../bootstrap/js/jquery-1.9.1.min.js"></script>
        <script src="../bootstrap/js/bootstrap-datepicker.js"></script>
        <script src="../bootstrap/js/plugins/dataTables/jquery.dataTables.js"></script>
        <script src="../bootstrap/js/plugins/dataTables/dataTables.bootstrap.js"></script>
        <script src="../bootstrap/chart/code/highcharts.js"></script>
        <script src="../bootstrap/chart/code/modules/exporting.js"></script>

        <script>
            function ConfirmDelete()
            {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
            }
        </script>
        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('.data').dataTable();
    });
    </script>
        <!-- End Of Javascript -->
    </body>
</html>