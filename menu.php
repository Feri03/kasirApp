<?php 
if(!empty( $_SESSION['id_user'] ) ){
    require "koneksi.php";
?>


<nav class="navbar navbar-expand-lg navbar-dark fixed-top " style="background-color: rgb(72, 61, 139);" >
<div class="container">
	<a class="navbar-brand" href="https://ferywn.blogspot.com/">KASIR STEAM</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="./admin.php">Beranda <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./admin.php?hlm=transaksi">Transaksi</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?hlm=laporan">Laporan</a>
      </li>
      <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Data Master
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="./admin.php?hlm=biaya">Data Biaya</a>
          <a class="dropdown-item" href="./admin.php?hlm=user">Data Pelanggan</a>
        </div>
	  </li>
	</ul>
	<ul class="navbar-nav ml-auto">
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<?php echo $_SESSION['nama']; ?> <b class="caret"></b>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar ?')"> 
        <img src="./assest/fonts/sign-out-alt.svg" width="17px">
        Keluar
        </a>
		</div>
	  </li>
	  </ul>
  </div>
  </div>
</nav>
<script type="text/javascript">
//   $( '#navbarSupportedContent .navbar-nav a' ).on( 'click', function () {
// 	$( '#navbarSupportedContent .navbar-nav' ).find( 'li.active' ).removeClass( 'active' );
// 	$( this).parent( 'li' ).addClass( 'active' );
// });
</script>

<?php
} else {
	header("Location: ./");
	die();
}
?>