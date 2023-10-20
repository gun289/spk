<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../configurasi/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Input kecamatan
if ($module=='kecamatan' AND $act=='input_kecamatan'){
  mysql_query("INSERT INTO kecamatan(id_kecamatan,
                                 nama
								 )
	                       VALUES('$_POST[id_kecamatan]',
                                '$_POST[nama]'
								)");
  header('location:../../media_admin.php?module='.$module);
}

elseif ($module=='kecamatan' AND $act=='hapuskecamatan'){
  mysql_query("DELETE FROM kecamatan WHERE id = '$_GET[id]'");
  header('location:../../media_admin.php?module='.$module);
}

elseif ($module=='kecamatan' AND $act=='hapuswalikecamatan'){
  $kecamatan = mysql_query("SELECT * FROM masyarakat WHERE id_kecamatan = '$_GET[id]'");
  $r = mysql_fetch_array($kecamatan);

  mysql_query("UPDATE masyarakat SET jabatan = 'masyarakat'
                                WHERE id_masyarakat = '$r[id_masyarakat]'");
  mysql_query("UPDATE kecamatan SET id_pengajar  = '0',
                                id_masyarakat  = '0'
                        WHERE id = '$_GET[id]'");
  header('location:../../media_admin.php?module='.$module);
}

elseif ($module=='kecamatan' AND $act=='update_kecamatan'){
  mysql_query("UPDATE kecamatan SET id_kecamatan = '$_POST[id_kecamatan]',
                                nama = '$_POST[nama]'
								
                        WHERE id = '$_POST[id]'");
  header('location:../../media_admin.php?module='.$module);
}
elseif ($module=='kecamatan' AND $act=='input_walikecamatan'){
  $cari = mysql_query("SELECT * FROM kecamatan WHERE id_kecamatan = '$_POST[kecamatan]'");
  $r = mysql_fetch_array($cari);
  mysql_query("UPDATE kecamatan SET id_pengajar  = '$_SESSION[idpengajar]',
                                id_masyarakat  = '$_POST[ketua]'
                        WHERE id = '$r[id]'");
  mysql_query("UPDATE masyarakat SET jabatan = 'Ketua kecamatan'
                                WHERE id_masyarakat = '$_POST[ketua]'");
  header('location:../../media_admin.php?module=home');
}

elseif ($module=='kecamatan' AND $act=='update_walikecamatan'){
  $cek = mysql_query("SELECT * FROM kecamatan WHERE id = '$_POST[id]'");
  $c = mysql_fetch_array($cek);
  $cek_masyarakat = mysql_query("SELECT id_masyarakat FROM kecamatan WHERE id = '$_POST[id]'");
  $s=mysql_num_rows($cek_masyarakat);
  $cari = mysql_query("SELECT * FROM kecamatan WHERE id_kecamatan = '$_POST[kecamatan]'");
  $r = mysql_fetch_array($cari);

  if ($_POST['kecamatan']==$c[id_kecamatan]){

    if(!empty($s)){
         mysql_query("UPDATE masyarakat SET jabatan = 'masyarakat'
                                WHERE id_masyarakat = '$c[id_masyarakat]'");
         mysql_query("UPDATE kecamatan SET id_masyarakat  = '$_POST[ketua]'
                        WHERE id = '$_POST[id]'");
         mysql_query("UPDATE masyarakat SET jabatan = 'Ketua kecamatan'
                                WHERE id_masyarakat = '$_POST[ketua]'");
    }else{
        mysql_query("UPDATE kecamatan SET id_masyarakat  = '$_POST[ketua]'
                        WHERE id = '$_POST[id]'");
    }
  }else{
      if (!empty($s)){
      mysql_query("UPDATE masyarakat SET jabatan = 'masyarakat'
                                WHERE id_masyarakat = '$c[id_masyarakat]'");
      mysql_query("UPDATE kecamatan SET id_pengajar  = '0',
                                id_masyarakat  = '0'
                        WHERE id = '$_POST[id]'");

      mysql_query("UPDATE kecamatan SET id_pengajar  = '$_SESSION[idpengajar]',
                                id_masyarakat  = '$_POST[ketua]'
                        WHERE id = '$r[id]'");
      mysql_query("UPDATE masyarakat SET jabatan = 'Ketua kecamatan'
                                WHERE id_masyarakat = '$_POST[ketua]'");
      }else{
          mysql_query("UPDATE kecamatan SET id_pengajar  = '0',
                                id_masyarakat  = '0'
                        WHERE id = '$_POST[id]'");

          mysql_query("UPDATE kecamatan SET id_pengajar  = '$_SESSION[idpengajar]',
                                id_masyarakat  = '$_POST[ketua]'
                        WHERE id = '$r[id]'");
          mysql_query("UPDATE masyarakat SET jabatan = 'Ketua kecamatan'
                                WHERE id_masyarakat = '$_POST[ketua]'");
      }
  }
  header('location:../../media_admin.php?module='.$module);
}

elseif ($module=='kecamatan' AND $act=='update_kecamatan_masyarakat'){
    mysql_query("UPDATE masyarakat SET id_kecamatan         = '$_POST[id_kecamatan]'
                                WHERE  id_masyarakat    = '$_SESSION[idmasyarakat]'");

header('location:../../../media.php?module=kecamatan');
}

}
?>
