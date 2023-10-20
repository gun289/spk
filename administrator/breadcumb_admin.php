<?php
include "../configurasi/koneksi.php";

if ($_GET['module']=='home'){
  if ($_SESSION['leveluser']=='admin'){
      echo "<span class='judulhead'><b>Selamat Datang Admin</b></span>";
  }
  elseif ($_SESSION['leveluser']=='pengajar'){
      echo "<span class='judulhead'><b>Selamat Datang Pengajar</b></span>";
  }
}
elseif ($_GET['module']=='modul'){
      echo "<span class='judulhead'><b>Manajeman Modul</b></span>";
  }
elseif ($_GET['module']=='admin'){
      echo "<span class='judulhead'><b>Manajeman Admin</b></span>";
  }
elseif ($_GET['module']=='masyarakat'){
      echo "<span class='judulhead'><b>Manajeman masyarakat</b></span>";
  }
elseif ($_GET['module']=='kecamatan'){
      echo "<span class='judulhead'><b>Manajeman kecamatan</b></span>";
  }
elseif ($_GET['module']=='matapelajaran'){
      echo "<span class='judulhead'><b>Manajeman Mata Pelajaran</b></span>";
  }
elseif ($_GET['module']=='materi'){
      echo "<span class='judulhead'><b>Manajeman Materi</b></span>";
  }
elseif ($_GET['module']=='quiz'){
      echo "<span class='judulhead'><b>Manajeman Quiz</b></span>";
  }

elseif ($_GET['module']=='templates'){
      echo "<span class='judulhead'><b>Manajeman Template</b></span>";
  }

elseif($_GET['module']=='detailpengajar'){
        $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$_GET[id]'");
        $p=mysql_fetch_array($pengajar);
	echo "<span class='judulhead'><b>Manajeman Admin &#187; Detail Pengajar &#187; $p[nama_lengkap]</b></span>";
}
elseif($_GET['module']=='detailmasyarakat'){
        $masyarakat = mysql_query("SELECT * FROM masyarakat WHERE id_masyarakat = '$_GET[id]'");
        $s=mysql_fetch_array($masyarakat);
	echo "<span class='judulhead'><b>Manajeman kecamatan &#187; Detail masyarakat &#187; $s[nama_lengkap]</b></span>";
}

elseif($_GET['module']=='detailmasyarakatpengajar'){
        $masyarakat = mysql_query("SELECT * FROM masyarakat WHERE id_masyarakat = '$_GET[id]'");
        $s=mysql_fetch_array($masyarakat);
	echo "<span class='judulhead'><b>Manajeman kecamatan &#187; Daftar masyarakat &#187; Detail masyarakat</b></span>";
}

elseif($_GET['module']=='daftarmasyarakat'){
        $masyarakat = mysql_query("SELECT * FROM masyarakat WHERE id_kecamatan = '$_GET[id]'");
        $s=mysql_fetch_array($masyarakat);
	echo "<span class='judulhead'><b>Manajeman kecamatan &#187; Daftar masyarakat</b></span>";
}

elseif($_GET['module']=='buatquiz'){
	echo "<span class='judulhead'><b>Manajeman Quiz &#187; Buat Quiz</b></span>";
}

elseif($_GET['module']=='buatquizesay'){
	echo "<span class='judulhead'><b>Manajeman Quiz &#187; Buat Quiz &#187; Buat Quiz Esay</b></span>";
}

elseif($_GET['module']=='buatquizpilganda'){
	echo "<span class='judulhead'><b>Manajeman Quiz &#187; Buat Quiz &#187; Buat Quiz Pilihan Ganda</b></span>";
}

elseif($_GET['module']=='daftarquiz'){
	echo "<span class='judulhead'><b>Manajeman Quiz &#187; Daftar Quiz</b></span>";
}

elseif($_GET['module']=='daftarquizesay'){
	echo "<span class='judulhead'><b>Manajeman Quiz &#187; Daftar Quiz &#187; Daftar Quiz Esay</b></span>";
}

elseif($_GET['module']=='daftarquizpilganda'){
	echo "<span class='judulhead'><b>Manajeman Quiz &#187; Daftar Quiz &#187; Daftar Quiz Pilihan Ganda</b></span>";
}
?>
