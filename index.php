<?php 
    // memulai session
    session_start();
    //jika ada session, maka akan dijalan ke halaman admin
    if(isset($_SESSION['id_user'])){
        // mengarah ke halaman admin
        header("Location: ./admin.php");
        die();
    }
    // memanggil koneksi database
    require 'koneksi.php';
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assest/css/bootstrap.min.css">
    <!-- fontawesome-free -->
    <link rel="stylesheet" href="assest/css/style.css">
    <link rel="icon" href="assest/img/favicon.ico" type="image/gif" sizes="16x16">
    <title>KASIR STEAM</title>
</head>
<body>
    <div class="container">
        <?php 
            // apabila submit ditekan akan menjalakan script di bawah ini
            if(isset($_REQUEST['login'])){
                // mendeklarasikan data yang akan dimasukan kedalam database
                $username = $_REQUEST['username'];
                $password = $_REQUEST['password'];
                // insert data kedalam database
                $sql = mysqli_query($koneksi, "SELECT id_user, username, nama, level FROM user WHERE username='$username' AND password=MD5('$password')");
                // jika query benar maka akan membuat session
                if($sql){
                    list($id_user, $username, $nama, $level)=mysqli_fetch_array($sql);
                    // membuat session 
                    $_SESSION['id_user'] = $id_user;
                    $_SESSION['username'] = $username;
                    $_SESSION['nama'] = $nama;
                    $_SESSION['level'] = $level;
                    
                    header("Location: ./admin.php");
                    die();
                } else {
                    $_SESSION['err'] = '<strong>ERROR!</strong> Username dan Password tidak ditemukan.';
                    header('Location: ./');
                    die();
            } 
        } else {
        ?>
        <h4 class="text-center">SISTEM INFORMASI KASIR <b>CUCI STEAM</b></h4>
        <hr>
        <form action="" class="login" method="POST" role="form">
            <?php 
                if(isset($_SESSION['err'])){
                    $err = $_SESSION['err'];
                    echo '<div class="alert alert-danger role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$err.
                    '</div>';
                    unset($_SESSION['err']);
                }
            ?>
            <div class="form-group">
                <label for="">Username</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            <img src="./assest/fonts/user.svg" width="16px">
                            </div>
                        </div>
                        <input type="text" name="username" class="form-control" placeholder="Masukan Username Anda" required >
                    </div>
                </div>
            <div class="form-group">
                <label for="">Password</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                        <img src="./assest/fonts/unlock-alt.svg" width="16px">
                        </div>
                    </div>
                    <input type="password" name="password" class="form-control" placeholder="Masukan Password Anda" required>
                </div>
            </div>
            <button type="submit" name="login" class="btn btn-block btn-lg btn-primary">
            Masuk
            </button>
            <hr>
            <div class="footer-copyright text-center">
                &copy; 2020 Feri Irawan.
            </div>
        </form>
    </div>
    <?php
	}
	?>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="assest/js/bootstrap.min.js"></script>
    <script src="assest/js/jquery-3.5.1.min.js"></script>
	
	<script type="text/javascript">
        $(document).ready(function() {
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove();
                });
            }, 4000);
        }); 
	</script>
</body>
</html>