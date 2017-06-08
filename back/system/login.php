<?php
if(isset($_POST['login'])){
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
        $StartPass = md5($Salt.$password);
		$no = 0;
		$sql="select * from user_login where email = '$email' and password ='$StartPass'";
		$result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            while($log=mysqli_fetch_assoc($result)){
                $_SESSION['id_user'] = $log['id_user'];
                $_SESSION['email'] = $log['email'];
                $_SESSION['password'] = $log['password'];
                $_SESSION['level'] = $log['level'];
                header('Location: index.php?p=dashboard');
            }
        }
        else{
            echo "<script>alert('Login Gagal: Email atau Password salah !');history.go(-1);</script>";
        }
	}
?>
<div class="header">
<div class="clear">&nbsp;</div>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel-group">
				<div class="panel panel-info">
					<div class="panel-heading"><!--Panel Heading-->
						<center>Welcome</center>
					</div>
                    <div class="panel-body"><!--Panel Body-->
                        <form role="form" method="post" action="">
                            <div class="form-group">
                                <input class="form-control" placeholder="User" name="email" type="text" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                            </div>
                                <input type="submit" value="Login" name="login" class="btn btn-success">
                        </form>
                    </div>