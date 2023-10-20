<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../configurasi/koneksi.php";
include "../../../configurasi/fungsi_thumb.php";
include "../../../configurasi/library.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Input masyarakat
if ($module=='masyarakat' AND $act=='input_masyarakat'){
  
  
  $cek_nis = mysql_query("SELECT * FROM masyarakat WHERE iddtks='$_POST[iddtks]'");
  $ketemu=mysql_num_rows($cek_nis);

  $tgl_lahir=$_POST[thn].'-'.$_POST[bln].'-'.$_POST[tgl];


    if(empty($ketemu) AND empty($lokasi_file)){
    $pass=md5($_POST[password]);
    mysql_query("INSERT INTO masyarakat(iddtks,
                                no_kk,
                                nik,
                                 no_bpjs,
                                 no_hp,
                                 nama_lengkap,
                                 rt,
                                kelurahan,
                                 id_kecamatan,
                                 alamat,
                                 tempat_lahir,
                                 tgl_lahir,
                                 jenis_kelamin,
                                 foto_rumah,
                                 link_gmap)
                               
	                       VALUES('$_POST[iddtks]',
                           '$_POST[no_kk]',
                                '$_POST[nik]',
                                '$_POST[no_bpjs]',
                                
                                '$_POST[no_hp]',
                               
                                '$_POST[nama_lengkap]',
                                '$_POST[rt]',
                                
                                '$_POST[kelurahan]',
                                '$_POST[id_kecamatan]',
                                '$_POST[alamat]',
                                '$_POST[tempat_lahir]',
                                '$_POST[tgl_lahir]',
                                '$_POST[jenis_kelamin]',
                                '$_POST[foto_rumah]',
                                '$_POST[link_gmap]')");
            header('location:../../media_admin.php?message=success&module='.$module);
    }else{
       echo "<script>window.alert('nis sudah digunakan mohon ulangi.');
                window.location=(href='../../media_admin.php?module=masyarakat&act=tambahmasyarakat')</script>";
    }
}
 //updata masyarakat
 elseif ($module=='masyarakat' AND $act=='update_masyarakat'){
 

      mysql_query("UPDATE masyarakat SET iddtks = '$_POST[iddtks]',
                                  no_kk           = '$_POST[no_kk]',
                                  nik    = '$_POST[nik]',
                                  no_bpjs    = '$_POST[no_bpjs]',
                                  no_hp    = '$_POST[no_hp]',
                                  nama_lengkap    = '$_POST[nama_lengkap]',
                                  rt   = '$_POST[rt]',
                                  kelurahan   = '$_POST[kelurahan]',
                                  id_kecamatan    = '$_POST[id_kecamatan]',
                                  alamat    = '$_POST[alamat]',
                                  tempat_lahir    = '$_POST[tempat_lahir]',
                                  tgl_lahir    = '$_POST[tgl_lahir]',
                                  jenis_kelamin    = '$_POST[jenis_kelamin]',
                                  foto_rumah    = '$_POST[foto_rumah]',
                                  link_gmap    = '$_POST[link_gmap]'
                                
                           WHERE  id_masyarakat        = '$_POST[id]'");
  header('location:../../media_admin.php?module='.$module);
  
}

elseif ($module=='masyarakat' AND $act=='update_kecamatan_masyarakat'){
    mysql_query("UPDATE masyarakat SET id_kecamatan         = '$_POST[id_kecamatan]'
                                WHERE  id_masyarakat    = '$_SESSION[idmasyarakat]'");

header('location:../../../media.php?module=kecamatan');
}

//Hapus masyarakat
elseif ($module=='masyarakat' AND $act=='hapus'){
  mysql_query("DELETE FROM masyarakat WHERE id_masyarakat = '$_GET[id]'");
  mysql_query("DELETE FROM tbl_klasifikasi WHERE id_masyarakat = '$_GET[id]'");
  header('location:../../media_admin.php?module='.$module);
}

elseif ($module=='masyarakat' AND $act=='update_profil_masyarakat'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $direktori_file = "../../../foto_masyarakat/$nama_file";

  $tgl_lahir=$_POST[thn].'-'.$_POST[bln].'-'.$_POST[tgl];

  $cek_iddtks = mysql_query("SELECT * FROM masyarakat WHERE id_masyarakat = '$_POST[id]'");
  $ketemu=mysql_fetch_array($cek_iddtks);

  if($_POST['iddtks']==$ketemu['iddtks']){

   //apabila foto tidak diubah
  if (empty($lokasi_file)){
      mysql_query("UPDATE masyarakat SET
                                  iddtks            = '$_POST[iddtks]',
                                  no_kk           = '$_POST[no_kk]',
                                  nama_lengkap    = '$_POST[nama]',                                  
                                  alamat          = '$_POST[alamat]',
                                  tempat_lahir    = '$_POST[tempat_lahir]',
                                  tgl_lahir       = '$tgl_lahir',
                                  jenis_kelamin   = '$_POST[jk]',
                                  agama           = '$_POST[agama]',
                                  nama_ayah       = '$_POST[nama_ayah]',
                                  nama_ibu        = '$_POST[nama_ibu]',
                                  th_masuk        = '$_POST[th_masuk]',
                                  email           = '$_POST[email]',
                                  no_telp         = '$_POST[no_telp]',
                                  jabatan         = '$_POST[jabatan]',
                                  id_session      = '$_POST[iddtks]',
                                  id_session_soal = '$_POST[iddtks]'
                           WHERE  id_masyarakat        = '$_POST[id]'");

  }
  //apabila foto diubah
  elseif(!empty($lokasi_file)){
      if (file_exists($direktori_file)){
            echo "<script>window.alert('Nama file gambar sudah ada, mohon diganti dulu');
            window.location=(href='../../../media.php?module=masyarakat&act=detailprofilmasyarakat&id=$_SESSION[idmasyarakat]')</script>";
         }else{
            if($tipe_file != "image/jpeg" AND
               $tipe_file != "image/jpg"){
                     echo "<script>window.alert('Tipe File tidak di ijinkan.');
                     window.location=(href='../../../media.php?module=masyarakat&act=detailprofilmasyarakat&id=$_SESSION[idmasyarakat]')</script>";
            }else{
            $cek = mysql_query("SELECT * FROM masyarakat WHERE id_masyarakat = '$_POST[id]'");
            $r = mysql_fetch_array($cek);

            if(!empty($r[foto])){
            $img = "../../../foto_masyarakat/$r[foto]";
            unlink($img);
            $img2 = "../../../foto_masyarakat/medium_$r[foto]";
            unlink($img2);
            $img3 = "../../../foto_masyarakat/small_$r[foto]";
            unlink($img3);

            UploadImage_masyarakat($nama_file);
            mysql_query("UPDATE masyarakat SET
                                  iddtks              = '$_POST[iddtks]',
                                  no_kk           = '$_POST[no_kk]',
                                  nama_lengkap     = '$_POST[nama]',                                  
                                  alamat           = '$_POST[alamat]',
                                  tempat_lahir    = '$_POST[tempat_lahir]',
                                  tgl_lahir       = '$tgl_lahir',
                                  jenis_kelamin    = '$_POST[jk]',
                                  agama           = '$_POST[agama]',
                                  nama_ayah        = '$_POST[nama_ayah]',
                                  nama_ibu         = '$_POST[nama_ibu]',
                                  th_masuk         = '$_POST[th_masuk]',
                                  email            = '$_POST[email]',
                                  no_telp          = '$_POST[no_telp]',
                                  foto             = '$nama_file',
                                  jabatan         = '$_POST[jabatan]',
                                  id_session       = '$_POST[iddtks]',
                                  id_session_soal  = '$_POST[iddtks]'
                           WHERE  id_masyarakat         = '$_POST[id]'");
            }else{
                UploadImage_masyarakat($nama_file);
                mysql_query("UPDATE masyarakat SET
                                  iddtks              = '$_POST[iddtks]',
                                  no_kk           = '$_POST[no_kk]',
                                  nama_lengkap     = '$_POST[nama]',                                  
                                  alamat           = '$_POST[alamat]',
                                  tempat_lahir    = '$_POST[tempat_lahir]',
                                  tgl_lahir       = '$tgl_lahir',
                                  jenis_kelamin    = '$_POST[jk]',
                                  agama           = '$_POST[agama]',
                                  nama_ayah        = '$_POST[nama_ayah]',
                                  nama_ibu         = '$_POST[nama_ibu]',
                                  th_masuk         = '$_POST[th_masuk]',
                                  email            = '$_POST[email]',
                                  no_telp          = '$_POST[no_telp]',
                                  foto             = '$nama_file',
                                  jabatan         = '$_POST[jabatan]',
                                  id_session       = '$_POST[iddtks]',
                                  id_session_soal  = '$_POST[iddtks]'
                           WHERE  id_masyarakat         = '$_POST[id]'");
            }
         }
         }
  }
  header('location:../../../media.php?module=masyarakat&act=detailprofilmasyarakat&id='.$_SESSION[idmasyarakat]);
  }
  elseif($_POST['iddtks']!= $ketemu['iddtks']){
      $cek_iddtks = mysql_query("SELECT * FROM masyarakat WHERE iddtks = '$_POST[iddtks]'");
      $c = mysql_num_rows($cek_iddtks);
      //apabila iddtks tersedia
      if(empty($c)){
          //apabila foto tidak diubah
  if (empty($lokasi_file)){
      mysql_query("UPDATE masyarakat SET
                                  iddtks  = '$_POST[iddtks]',
                                  no_kk           = '$_POST[no_kk]',
                                  nama_lengkap    = '$_POST[nama]', 
                                                                   
                                  alamat          = '$_POST[alamat]',
                                  tempat_lahir    = '$_POST[tempat_lahir]',
                                  tgl_lahir       = '$tgl_lahir',
                                  jenis_kelamin   = '$_POST[jk]',
                                  agama           = '$_POST[agama]',
                                  nama_ayah       = '$_POST[nama_ayah]',
                                  nama_ibu        = '$_POST[nama_ibu]',
                                  th_masuk        = '$_POST[th_masuk]',
                                  email           = '$_POST[email]',
                                  no_telp         = '$_POST[no_telp]',
                                  jabatan         = '$_POST[jabatan]',
                                  id_session      = '$_POST[iddtks]',
                                  id_session_soal = '$_POST[iddtks]'
                           WHERE  id_masyarakat        = '$_POST[id]'");

  }
  //apabila foto diubah
  elseif(!empty($lokasi_file)){
      if (file_exists($direktori_file)){
            echo "<script>window.alert('Nama file gambar sudah ada, mohon diganti dulu');
            window.location=(href='../../../media.php?module=masyarakat&act=detailprofilmasyarakat&id=$_SESSION[idmasyarakat]')</script>";
         }else{
            if($tipe_file != "image/jpeg" AND
               $tipe_file != "image/jpg"){
                     echo "<script>window.alert('Tipe File tidak di ijinkan.');
                     window.location=(href='../../../media.php?module=masyarakat&act=detailprofilmasyarakat&id=$_SESSION[idmasyarakat]')</script>";
            }else{
            $cek = mysql_query("SELECT * FROM masyarakat WHERE id_masyarakat = '$_POST[id]'");
            $r = mysql_fetch_array($cek);

            if(!empty($r[foto])){
            $img = "../../../foto_masyarakat/$r[foto]";
            unlink($img);
            $img2 = "../../../foto_masyarakat/medium_$r[foto]";
            unlink($img2);
            $img3 = "../../../foto_masyarakat/small_$r[foto]";
            unlink($img3);

            UploadImage_masyarakat($nama_file);
            mysql_query("UPDATE masyarakat SET
                                  iddtks              = '$_POST[iddtks]',
                                  no_kk           = '$_POST[no_kk]',
                                  nama_lengkap     = '$_POST[nama]',                                  
                                  alamat           = '$_POST[alamat]',
                                  tempat_lahir    = '$_POST[tempat_lahir]',
                                  tgl_lahir       = '$tgl_lahir',
                                  jenis_kelamin    = '$_POST[jk]',
                                  agama           = '$_POST[agama]',
                                  nama_ayah        = '$_POST[nama_ayah]',
                                  nama_ibu         = '$_POST[nama_ibu]',
                                  th_masuk         = '$_POST[th_masuk]',
                                  email            = '$_POST[email]',
                                  no_telp          = '$_POST[no_telp]',
                                  foto             = '$nama_file',
                                  jabatan         = '$_POST[jabatan]',
                                  id_session       = '$_POST[iddtks]',
                                  id_session_soal  = '$_POST[iddtks]'
                           WHERE  id_masyarakat         = '$_POST[id]'");
            }else{
                UploadImage_masyarakat($nama_file);
                mysql_query("UPDATE masyarakat SET
                                  iddtks              = '$_POST[iddtks]',
                                  no_kk           = '$_POST[no_kk]',
                                  nama_lengkap     = '$_POST[nama]',                                  
                                  alamat           = '$_POST[alamat]',
                                  tempat_lahir    = '$_POST[tempat_lahir]',
                                  tgl_lahir       = '$tgl_lahir',
                                  jenis_kelamin    = '$_POST[jk]',
                                  agama           = '$_POST[agama]',
                                  nama_ayah        = '$_POST[nama_ayah]',
                                  nama_ibu         = '$_POST[nama_ibu]',
                                  th_masuk         = '$_POST[th_masuk]',
                                  email            = '$_POST[email]',
                                  no_telp          = '$_POST[no_telp]',
                                  foto             = '$nama_file',
                                  jabatan         = '$_POST[jabatan]',
                                  id_session       = '$_POST[iddtks]',
                                  id_session_soal  = '$_POST[iddtks]'
                           WHERE  id_masyarakat         = '$_POST[id]'");
            }
         }
         }
  }
  header('location:../../../media.php?module=masyarakat&act=detailprofilmasyarakat&id='.$_SESSION[idmasyarakat]);
    }
      else{
        echo "<script>window.alert('iddtks sudah pernah digunakan.');
        window.location=(href='../../../media.php?module=masyarakat&act=detailprofilmasyarakat&id=$_SESSION[idmasyarakat]')</script>";
      }
  }
}

elseif ($module=='masyarakat' AND $act=='update_account_masyarakat'){
    //jika username dan password tidak diubah
    if (empty($_POST[username]) AND empty($_POST[password])){
        header('location:../../../media.php?module=masyarakat&act=detailaccount');
    }
    //jika username diubah dan pasword tidak diubah
    elseif (!empty($_POST[username]) AND empty($_POST[password])){
        $username = mysql_query("SELECT * FROM masyarakat WHERE id_masyarakat = '$_SESSION[idmasyarakat]'");
        $data_username = mysql_fetch_array($username);
           
        //jika username sama dengan username yang ada di datbase
        if ($_POST[username] == $data_username[username_login]){
        mysql_query("UPDATE masyarakat SET username_login = '$_POST[username]'
                                  WHERE id_masyarakat     = '$_SESSION[idmasyarakat]'");

        echo "<script>window.alert('Username berhasil diubah');
                    window.location=(href='../../../media.php?module=home')</script>";
        }
        //jika username tidak sama username di database
        elseif ($_POST[username] != $data_username[username_login]){
            $username2 = mysql_query("SELECT * FROM masyarakat WHERE username_login = '$_POST[username]'");
            $data_username2 = mysql_num_rows($username2);
            //jika username tersedia
            if (empty($data_username2)){
                mysql_query("UPDATE masyarakat SET username_login = '$_POST[username]'
                                  WHERE id_masyarakat     = '$_SESSION[idmasyarakat]'");

                echo "<script>window.alert('Username berhasil diubah');
                              window.location=(href='../../../media.php?module=home')</script>";
            }
            //jika username tiak tersedia
            else{
                echo "<script>window.alert('Username sudah digunakan mohon diganti');
                              window.location=(href='../../../media.php?module=masyarakat&act=detailaccount')</script>";
            }
        }
    }
    //jika username tidak di ubah dan pasword di ubah
    elseif (empty($_POST[username]) AND !empty($_POST[password])){
        $pass = md5($_POST[password]);
        mysql_query("UPDATE masyarakat SET password_login = '$pass'
                                  WHERE id_masyarakat     = '$_SESSION[idmasyarakat]'");

        echo "<script>window.alert('Password berhasil diubah');
                    window.location=(href='../../../media.php?module=home')</script>";
    }
    //jika username di ubah dan password di ubah
    elseif (!empty($_POST[username]) AND !empty($_POST[password])){
        $username = mysql_query("SELECT * FROM masyarakat WHERE username_login = '$_POST[username]'");
        $data_username = mysql_fetch_array($username);
        //jika username sama dengan di database
        if ($_POST[username] == $data_username[username_login]){
        $pass = md5($_POST[password]);
        mysql_query("UPDATE masyarakat SET username_login = '$_POST[username]',
                                      password_login = '$pass'
                                  WHERE id_masyarakat     = '$_SESSION[idmasyarakat]'");

        echo "<script>window.alert('Username & Password berhasil diubah');
                    window.location=(href='../../../media.php?module=home')</script>";
        }
        //jika username tidak sama dengan username di database
        elseif ($_POST[username] != $data_username[username_login]){
            $username2 = mysql_query("SELECT * FROM masyarakat WHERE username_login = '$_POST[username]'");
            $data_username2 = mysql_num_rows($username2);
            //jika username tersedia
            if (empty($data_username2)){
                $pass = md5($_POST[password]);
                mysql_query("UPDATE masyarakat SET username_login = '$_POST[username]',
                                      password_login = '$pass'
                                  WHERE id_masyarakat     = '$_SESSION[idmasyarakat]'");

                echo "<script>window.alert('Username & Password berhasil diubah');
                                window.location=(href='../../../media.php?module=home')</script>";
            }
            //jika username tidak tersedia
            else{
                echo "<script>window.alert('Username sudah digunakan mohon diganti');
                              window.location=(href='../../../media.php?module=masyarakat&act=detailaccount')</script>";
            }
        }
    }

}

}
?>
