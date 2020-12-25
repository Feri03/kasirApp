<?php
    session_start();
    if(empty( $_SESSION['id_user'] ) ){
        //session_destroy();
        $_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
        header('Location: ./');
        die();
    } else {
        require "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title>Aplikasi Kasir</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="icon" href="./assest/img/favicon.ico" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="assest/css/bootstrap.min.css">
    <link rel="stylesheet" href="assest/css/bootstrap.css">
    <link rel="stylesheet" href="assest/css/jquery-ui.min.css">
    <script src="assest/js/jquery.min.js"></script>
	<style type="text/css">
    body {
      min-height: 200px;
      padding-top: 70px;
    }
    @media print {
      .container {
        margin-top: -30px;
      }
      #tombol,
        .noprint {
          display: none;
        }
    }
	</style>

  </head>

  <body>
    <?php include "menu.php"; ?>
    <div class="container">
	<?php
	if( isset($_REQUEST['hlm'] )){
    $hlm = $_REQUEST['hlm'];
    
		switch( $hlm ){
			case 'transaksi':
				include "transaksi.php";
				break;
			case 'laporan':
				include "laporan.php";
				break;
			case 'user':
				include "user.php";
				break;
			case 'biaya':
				include "biaya.php";
				break;
			case 'cetak':
				include "cetak_nota.php";
				break;
		}
	} else {
	?>
    <div class="jumbotron">
        <h2>Selamat Datang di Aplikasi Kasir STEAM</h2>
        <p>Halo <strong><?php echo $_SESSION['nama']; ?></strong>, Anda login sebagai
			<strong>
			<?php
				if($_SESSION['level'] == 1){
					echo 'Admin.';
				} else {
						echo 'Petugas Kasir.';
				}
			?>
			</strong>
		</p>
    </div>

    <?php 
    $sql = mysqli_query($koneksi, "SELECT count(nama), sum(total) FROM transaksi");
    list($nama, $total) = mysqli_fetch_array($sql);
    echo '<center>
          <div class="col-sm-6">
          <div class="card mb-4"> 
          <div class="card-body"> 
            <h4>Jumlah Pelanggan</h4>
            <h4>
            <span class="glyphicon glyphicon-user"></span>
            <b>'.$nama.'</b> Pelanggan
            </h4>
            </div>
            </div>
            </div>

        <div class="col-sm-6">
        <div class="card"> 
        <div class="card-body"> 
        <h4>Jumlah Pendapatan</h4>
        <h4>
        <b>RP. '.number_format($total).'</b>
        </h4>
      </div>
      </div>
      </div>
      </center>
  ' 
  ?>
	<?php
	}
	?>
    </div> <!-- /container -->
    <!-- Bootstrap core JavaScript, Placed at the end of the document so the pages load faster -->
    <script src="assest/js/bootstrap.min.js"></script>
    <script src="assest/js/jquery-ui.min.js"></script>
    <script src="assest/js/jquery-3.2.1.min.js"></script>
    <script src="assest/js/popper.min.js"></script>
    <script src="assest/js/bootstrap.min.js"></script>
    <script src="assest/js/script.js"></script>
</body>
</html>
<?php
}
?>
