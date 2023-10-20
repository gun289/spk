<?php
include "../configurasi/koneksi.php";

if ($_SESSION['leveluser']=='admin'){
  $sql=mysql_query("select * from modul where aktif='Y' and type = 'Report' order by urutan");
  while ($m=mysql_fetch_array($sql)){
    echo "<li class='garisbawah'><a href='$m[link]'><i class='fa fa-circle-o'></i>$m[nama_modul]</a></li>";
  }
}
elseif ($_SESSION['leveluser']=='guest'){
  $sql=mysql_query("select * from modul where aktif='Y' and type = 'Report' order by urutan");
  while ($m=mysql_fetch_array($sql)){
    echo "<li class='garisbawah'><a href='$m[link]'><i class='fa fa-circle-o'></i>$m[nama_modul]</a></li>";
  }
}
?>
