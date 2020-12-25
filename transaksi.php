<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
	<form action="" method="post" class="navbar-form">
		<div class="input-group">
			<input type="text" name="keyword" size="35" autofocus placeholder="Masukan Keyword Pencarian" autocomplete="off" id="keyword" class="group-control">
			<div class="input-group-btn">
				<button type="submit" name="cari" id="tombol-cari" class="btn btn-info">
				<img src="./assest/fonts/cari.svg" width="20px"></button>
			</div>
		</div>
	</form>
</body>
</html>

<?php

if(empty($_SESSION['id_user'])){
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if( isset( $_REQUEST['aksi'] )){
		$aksi = $_REQUEST['aksi'];
		switch($aksi){
			case 'baru':
				include 'transaksi_baru.php';
				break;
			case 'edit':
				include 'transaksi_edit.php';
				break;
			case 'hapus':
				include 'transaksi_hapus.php';
				break;
			case 'cetak':
				include 'cetak_nota.php';
				break;
		}
	} else {
		echo '
			<div class="container col-lg">
				<h3 style="margin-bottom: -20px;">Daftar Transaksi</h3>
				<div class="text-right"> 
				<a href="./admin.php?hlm=transaksi&aksi=baru" class="btn btn-success">Tambah Data Transaksi</a>
				</div> 
				<br/><hr/>

				<table class="table table-bordered">
					<thead>
					<tr class="table-primary">
						<th width="2%">No</th>
						<th width="10%">No. Nota</th>
						<th width="15%">Nama Pelanggan</th>
						<th width="12%">Jenis</th>
						<th width="10%">Total Bayar</th>
						<th width="12%">Tanggal</th>
						<th width="18%">Tindakan</th>
					</tr>
					</thead>
				<tbody>';
			//skrip untuk menampilkan data dari database
			// $sql = mysqli_query($koneksi, "SELECT * FROM transaksi");
			if( isset($_POST["cari"]) ){
				$cari = $_POST["keyword"];
				$query = "SELECT * FROM transaksi
					WHERE
					no_nota LIKE '%$cari%' OR
					jenis LIKE '%$cari%' OR
					nama LIKE '%$cari%' OR
					total LIKE '%$cari%' OR
					tanggal LIKE '%$cari%'
					";
			}else{
				$query = "SELECT * FROM transaksi";
			}
			
			$result = mysqli_query($koneksi, $query);			
				if(mysqli_num_rows($result ) > 0){
					
					$no = 0;
					while($row = mysqli_fetch_array($result )){
						$no++;
					echo '

					<tr>
						<td>'.$no.'</td>
						<td>'.$row['no_nota'].'</td>
						<td>'.$row['nama'].'</td>
						<td>'.$row['jenis'].'</td>
						<td>RP. '.number_format($row['total']).'</td>
						<td>'.date("d M Y", strtotime($row['tanggal'])).'</td>
						<td>

						<script type="text/javascript" language="JavaScript">
							function konfirmasi(){
								tanya = confirm("Anda yakin akan menghapus data ini?");
								if (tanya == true) return true;
								else return false;
						}
					</script>

					<a href="?hlm=cetak&id_transaksi='.$row['id_transaksi'].'" class="btn btn-info btn-s" target="_blank">Cetak Nota</a>

					<a href="?hlm=transaksi&aksi=edit&id_transaksi='.$row['id_transaksi'].'" class="btn btn-warning btn-s"><i class="fas fa-edit"></i></a>

					<a href="?hlm=transaksi&aksi=hapus&submit=yes&id_transaksi='.$row['id_transaksi'].'" onclick="return konfirmasi()" class="btn btn-danger btn-s"><i class="fas fa-trash-alt"></i></a>

					</td>';
				}
			} else {
				echo '<td colspan="8"><center>
				<p class="add">Tidak ada data untuk ditampilkan. <u>
				<a href="?hlm=transaksi&aksi=baru" class="text-danger">Tambah data baru</a></u> 
				</p></center>
				</td>
				</tr>';
			}
			echo '
			</tbody>
			</table>
		</div>';
	}
}
?>
