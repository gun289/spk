<script>
function confirmdelete(delUrl) {
if (confirm("Anda yakin ingin menghapus?")) {
document.location = delUrl;
}
}
</script>



<?php
include "../configurasi/koneksi.php";
include "../configurasi/library.php";
include "../configurasi/fungsi_indotgl.php";
include "../configurasi/fungsi_combobox.php";
include "../configurasi/class_paging.php";

$aksi_kecamatan="modul/mod_kecamatan/aksi_kecamatan.php";
$aksi_mapel="modul/mod_matapelajaran/aksi_matapelajaran.php";

// Bagian Home
if ($_GET['module']=='home'){
  if ($_SESSION['leveluser']=='admin'){
    
	?>
	  <!-- Small boxes (Stat box) -->
	
		<div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-tag"></i> Quick Links</h3>
        </div>	
	   <div class="box-body">
			<div class="row">
				<div class="callout callout-danger "  style="margin:20px 20px 20px 20px">
					<h4><?php echo Admin?> </h4>
					<p><?php echo "Selamat datang di halaman SISTEM PENDUKUNG KEPUTUSAN PENENTUAN PENERIMA BANTUAN PANGAN NON TUNAI MENGGUNAKAN METODE 
WASPAS
(Studi Kasus : Kota Samarinda).

						<br><br> Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola website"; ?>
					</p>
				</div>
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-aqua">
						<div class="inner">
							<?php $masyarakat = mysql_num_rows(mysql_query("SELECT * FROM masyarakat")); ?>
							<h3><?php echo $masyarakat; ?></h3>
							<p>Masyarakat</p>
						</div>
						<div class="icon">
							<i class="fa fa-graduation-cap"></i>
						</div>
						<a href="?module=masyarakat" class="small-box-footer">Klik disini <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div><!-- ./col -->
				
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-yellow">
						<div class="inner">
							<?php $kecamatan = mysql_num_rows(mysql_query("SELECT * FROM kecamatan")); ?>
							<h3><?php echo $kecamatan; ?></h3>
							<p>Kecamatan</p>
						</div>
						<div class="icon">
							<i class="fa fa-group"></i>
						</div>
						<a href="?module=kecamatan" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div><!-- ./col -->
				
				<div class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-green">
						<div class="inner">
							<?php $kriteria = mysql_num_rows(mysql_query("SELECT * FROM tbl_kriteria")); ?>
							<h3><?php echo $kriteria; ?></h3>
							<p>Kriteria</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
						<a href="?module=matapelajaran&act=himpunankriteria" class="small-box-footer">Klik Disini <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div><!-- ./col -->
				
		</div>
	 
  <?php
  echo "<p align=right>Login : $hari_ini
  <span id='date'></span> <span id='clock'></span></p>
  </div>";
  
  }
  elseif ($_SESSION['leveluser']=='guest'){
     
	?>
  <!-- Small boxes (Stat box) -->

  <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-tag"></i> Quick Links</h3>
      </div>	
   <div class="box-body">
    <div class="row">
      <div class="callout callout-danger "  style="margin:20px 20px 20px 20px">
        <h4><?php echo Admin?> </h4>
        <p><?php echo "Selamat datang di halaman SISTEM PENDUKUNG KEPUTUSAN PENENTUAN PENERIMA BANTUAN PANGAN NON TUNAI MENGGUNAKAN METODE 
WASPAS
(Studi Kasus : Kota Samarinda).

          <br><br> Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola website"; ?>
        </p>
      </div>
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <?php $masyarakat = mysql_num_rows(mysql_query("SELECT * FROM masyarakat")); ?>
            <h3><?php echo $masyarakat; ?></h3>
            <p>Masyarakat</p>
          </div>
          <div class="icon">
            <i class="fa fa-graduation-cap"></i>
          </div>
          <a href="?module=masyarakat" class="small-box-footer">Klik disini <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <?php $kecamatan = mysql_num_rows(mysql_query("SELECT * FROM kecamatan")); ?>
            <h3><?php echo $kecamatan; ?></h3>
            <p>Kecamatan</p>
          </div>
          <div class="icon">
            <i class="fa fa-group"></i>
          </div>
          <a href="?module=kecamatan" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <?php $kriteria = mysql_num_rows(mysql_query("SELECT * FROM tbl_kriteria")); ?>
            <h3><?php echo $kriteria; ?></h3>
            <p>Kriteria</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="?module=matapelajaran&act=himpunankriteria" class="small-box-footer">Klik Disini <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div><!-- ./col -->
      
  </div>
 
<?php
echo "<p align=right>Login : $hari_ini
<span id='date'></span> <span id='clock'></span></p>
</div>";
 	}
        else{
             echo "<h2>Home</h2>
          <p>Hai <b>$_SESSION[namalengkap]</b>, selamat datang di E-Learning.</p>
          <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
          <p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d"));
  echo " | ";
  echo date("H:i:s");
  echo " WIB</p>";
        }
}
// Bagian Modul
elseif ($_GET['module']=='modul'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_modul/modul.php";
  }
}
// Bagian user admin
elseif ($_GET['module']=='admin'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_admin/admin.php";
  }else{
      include "modul/mod_admin/admin.php";
  }
}

// Bagian user admin
elseif ($_GET['module']=='detailpengajar'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_admin/admin.php";
  }else{
      include "modul/mod_admin/admin.php";
  }
}

// Bagian kecamatan
elseif ($_GET['module']=='kecamatan'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_kecamatan/kecamatan.php";
  }
  elseif ($_SESSION['leveluser']=='pengajar'){
      include "modul/mod_kecamatan/kecamatan.php";
  }
  elseif ($_SESSION['leveluser']=='masyarakat'){
      include "modul/mod_kecamatan/kecamatan.php";
  }

}


// Bagian masyarakat
elseif ($_GET['module']=='masyarakat'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_masyarakat/masyarakat.php";
  }else{
      include "modul/mod_masyarakat/masyarakat.php";
  }
}

// Bagian masyarakat
elseif ($_GET['module']=='daftarmasyarakat'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_masyarakat/masyarakat.php";
  }else{
      include "modul/mod_masyarakat/masyarakat.php";
  }
}

// Bagian masyarakat
elseif ($_GET['module']=='detailmasyarakat'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_masyarakat/masyarakat.php";
  }else{
      include "modul/mod_masyarakat/masyarakat.php";
  }
}

// Bagian masyarakat
elseif ($_GET['module']=='detailmasyarakatpengajar'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_masyarakat/masyarakat.php";
  }else{
      include "modul/mod_masyarakat/masyarakat.php";
  }
}

// Bagian mata pelajaran
elseif ($_GET['module']=='matapelajaran'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_matapelajaran/matapelajaran.php";
  }
  else{
      include "modul/mod_matapelajaran/matapelajaran.php";
  }
}
// Bagian mata pelajaran
elseif ($_GET['module']=='ujian'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_ujian/ujian.php";
  }
  else{
      include "modul/mod_matapelajaran/matapelajaran.php";
  }
}

// Bagian materi
elseif ($_GET['module']=='materi'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_materi/materi.php";
  }else{
      include "modul/mod_materi/materi.php";
  }
}
// Bagian absen
elseif ($_GET['module']=='absensi'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_absen/absen.php";
  }else{
      include "modul/mod_absen/absen.php";
  }
}
// Bagian Jadwal Tambahan
elseif ($_GET['module']=='tambahan'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_tambahan/tambahan.php";
  }else{
      include "modul/mod_tambahan/tambahan.php";
  }
}

// Bagian topik soal
elseif ($_GET['module']=='quiz'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_quiz/quiz.php";
  }else{
      include "modul/mod_quiz/quiz.php";
  }
}

// Bagian topik soal
elseif ($_GET['module']=='buatquiz'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_quiz/quiz.php";
  }else{
      include "modul/mod_quiz/quiz.php";
  }
}

// Bagian topik soal
elseif ($_GET['module']=='buatquizesay'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_quiz/quiz.php";
  }else{
      include "modul/mod_quiz/quiz.php";
  }
}

// Bagian topik soal
elseif ($_GET['module']=='buatquizpilganda'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_quiz/quiz.php";
  }else{
      include "modul/mod_quiz/quiz.php";
  }
}

// Bagian topik soal
elseif ($_GET['module']=='daftarquiz'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_quiz/quiz.php";
  }else{
      include "modul/mod_quiz/quiz.php";
  }
}

// Bagian topik soal
elseif ($_GET['module']=='daftarquizesay'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_quiz/quiz.php";
  }else{
      include "modul/mod_quiz/quiz.php";
  }
}

// Bagian topik soal
elseif ($_GET['module']=='daftarquizpilganda'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_quiz/quiz.php";
  }else{
      include "modul/mod_quiz/quiz.php";
  }
}

// Bagian Templates
elseif ($_GET['module']=='templates'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_templates/templates.php";
  }
}

// Bagian Templates
elseif ($_GET['module']=='registrasi'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_registrasi/registrasi.php";
  }
}
?>
