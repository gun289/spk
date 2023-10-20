<script>
function confirmdelete(delUrl) {
if (confirm("Anda yakin ingin menghapus?")) {
document.location = delUrl;
}
}
</script>
<script language="JavaScript" type="text/JavaScript">

 function showmasyarakat()
 {
 <?php

 // membaca semua kecamatan
 $query = "SELECT * FROM kecamatan";
 $hasil = mysql_query($query);

 // membuat if untuk masing-masing pilihan kecamatan beserta isi option untuk combobox kedua
 while ($data = mysql_fetch_array($hasil))
 {
   $idkecamatan = $data['id_kecamatan'];

   // membuat IF untuk masing-masing kecamatan
   echo "if (document.form_kecamatan.kecamatan.value == \"".$idkecamatan."\")";
   echo "{";

   // membuat option matapelajaran untuk masing-masing kecamatan
   $query2 = "SELECT * FROM masyarakat WHERE id_kecamatan = '$idkecamatan'";
   $hasil2 = mysql_query($query2);
   $content = "document.getElementById('kecamatan').innerHTML = \"<select name='ketua'><option value='0' selected>--Pilih--</option>";
   while ($data2 = mysql_fetch_array($hasil2))
   {
       $content .= "<option value='".$data2['id_kecamatan']."'>".$data2['nama_lengkap']."</option>";
   }
   $content .= "</select>\";";
   echo $content;
   echo "}\n";
 }

 ?>
 }
</script>

<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href=../css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
}
else{

$aksi="modul/mod_kecamatan/aksi_kecamatan.php";
$aksi_masyarakat = "administrator/modul/mod_masyarakat/aksi_masyarakat.php";
switch($_GET[act]){
  // Tampil kecamatan
  default:
    if ($_SESSION[leveluser]=='admin' || $_SESSION['leveluser']=='guest'){
      $tampil = mysql_query("SELECT * FROM kecamatan ORDER BY id_kecamatan");
	?>
		<div class="box box-danger box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Data Kecamatan</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">
					<a  class ='btn  btn-success btn-flat' href='?module=kecamatan&act=tambahkecamatan'>Tambah Data </a>
					<br><br><br>
					<table id="example1" class="table table-bordered table-striped" >
						<thead>
							<tr>
								<th>No</th>
								<th>Id Kecamatan</th>
								<th>Kecamatan</th>
								
								<th>Jumlah Masyarakat</th>
								
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							   $no =1;
							   while ($r=mysql_fetch_array($tampil)){       
							   echo "<tr><td>$no</td>
									 <td>$r[id_kecamatan]</td>
									 <td>$r[nama]</td>
									 ";
									  $jmlmhs= mysql_fetch_array(mysql_query("SELECT count(iddtks) as jmlmhs FROM masyarakat WHERE id_kecamatan = '$r[id_kecamatan]'"));
									  echo "<td>$jmlmhs[jmlmhs]</td>";
									
									 echo "<td><a href='?module=kecamatan&act=editkecamatan&id=$r[id]' title='Edit' class='btn btn-primary btn-xs'>Edit</a> |
										 <a href=javascript:confirmdelete('$aksi?module=kecamatan&act=hapuskecamatan&id=$r[id]') title='Hapus' class='btn btn-danger btn-xs'>Hapus</a> 
                     <a href=?module=masyarakat&act=lihatmasyarakat&id=$r[id_kecamatan]  class='btn btn-success btn-xs'>Lihat masyarakat</a></td></tr>";
							  $no++;
								}
						echo "</tbody></table>";
					?>
				</div>
			</div>	
	<?php
      
    }
    
    elseif ($_SESSION[leveluser]=='masyarakat'){
        echo"<br><b class='judul'>kecamatan yang anda ikuti</b><br><p class='garisbawah'></p>";
        $ambil_masyarakat = mysql_query("SELECT * FROM masyarakat WHERE id_masyarakat = '$_SESSION[idmasyarakat]'");
        $data_masyarakat = mysql_fetch_array($ambil_masyarakat);
        $kecamatan = mysql_query("SELECT * FROM kecamatan WHERE id_kecamatan = '$data_masyarakat[id_kecamatan]'");

        echo "<table>
          <tr><th>No</th><th>kecamatan</th><th>Pembimbing Akademik</th><th>Ketua kecamatan</th><th>Aksi</th></tr>";
        $no=1;
        while ($r=mysql_fetch_array($kecamatan)){
       echo "<tr>
             <td>$no</td>
             <td>$r[nama]</td>";
             $pengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
                    $ada_pengajar = mysql_num_rows($pengajar);
                    if(!empty($ada_pengajar)){
                    while($p=mysql_fetch_array($pengajar)){
                            echo "<td><a href=?module=admin&act=detailpengajar&id=$r[id_pengajar] title='Detail Pembimbing Akademik'>$p[nama_lengkap]</a></td>";
                    }
                    }else{
                            echo "<td></td>";
                    }

                    $masyarakat = mysql_query("SELECT * FROM masyarakat WHERE id_masyarakat = '$r[id_masyarakat]]'");
                    $ada_masyarakat = mysql_num_rows($masyarakat);
                    if(!empty($ada_masyarakat)){
                    while ($s=mysql_fetch_array($masyarakat)){
                            echo"<td><a href=?module=masyarakat&act=detailmasyarakat&id=$s[id_masyarakat] title='Detail masyarakat'>$s[nama_lengkap]</td>";
                     }
                    }else{
                            echo"<td></td>";
                    }
             echo "<td><input type=button class='button' value='Edit kecamatan'
          onclick=\"window.location.href='?module=kecamatan&act=editkecamatan&id=$r[id]';\">
          <input type=button class='button' value='Lihat Masyarakat'
          onclick=\"window.location.href='?module=masyarakat&act=lihatmasyarakat&id=$r[id_kecamatan]';\">
          </td></tr>";
      $no++;
    }
    echo "</table>";
    }
    break;
    
    case "tambahkecamatan":
    if ($_SESSION[leveluser]=='admin' || $_SESSION['leveluser']=='guest'){
		echo "
		  <div class='box box-danger box-solid'>
				<div class='box-header with-border'>
					<h3 class='box-title'>Tambah Data kecamatan</h3>
					<div class='box-tools pull-right'>
						<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class='box-body'>
						<form method=POST action='$aksi?module=kecamatan&act=input_kecamatan' class='form-horizontal'>
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>ID Kecamatan</label>        		
									 <div class='col-sm-4'>
										<input type=text name='id_kecamatan' class='form-control' Placeholder='ID Kecamatan' required='required'>
									 </div>
							  </div>
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Nama Kecamatan</label>        		
									 <div class='col-sm-6'>
										<input type=text name='nama' class='form-control' Placeholder='Nama Kecamatan' required='required'>
									 </div>
							  </div>
							  
							  
							  
							 
							 
							  
							
							  
							  
							  <div class='buttons'>
							  <input class='btn btn-primary' type=submit value=Simpan>
							  <input class='btn btn-danger' type=button value=Batal onclick=self.history.back()>
							  </div>
							  </form>
							  
				</div> 
				
			</div>";
					
	}	
    
   
    break;

    case "editkecamatan":
    if ($_SESSION[leveluser]=='admin' || $_SESSION['leveluser']=='guest'){
    $tampil = mysql_query("SELECT * FROM kecamatan WHERE id = '$_GET[id]'");
    $r = mysql_fetch_array($tampil);
    $getnip = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
    $nipp = mysql_fetch_array($getnip);
    $getnis = mysql_query("SELECT * FROM masyarakat WHERE id_masyarakat = '$r[id_masyarakat]'");
    $niss = mysql_fetch_array($getnis);
	$getjur = mysql_query("SELECT * FROM jurusan WHERE kodejurusan = '$r[kodejurusan]'");
    $jurr = mysql_fetch_array($getjur);
    
   echo "
		  <div class='box box-danger box-solid'>
				<div class='box-header with-border'>
					<h3 class='box-title'>Edit Data kecamatan</h3>
					<div class='box-tools pull-right'>
						<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class='box-body'>
						<form method=POST action='$aksi?module=kecamatan&act=update_kecamatan' class='form-horizontal'>
							<input type=hidden name=id value='$r[id]'>
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>ID Kecamatan</label>        		
									 <div class='col-sm-4'>
										<input type=text name='id_kecamatan' class='form-control' Placeholder='ID Kecamatan' value='$r[id_kecamatan]'>
									 </div>
							  </div>
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Nama Kecamatan</label>        		
									 <div class='col-sm-6'>
										<input type=text name='nama' class='form-control' Placeholder='Nama Kecamatan' value='$r[nama]'>
									 </div>
							  </div>
							  
							  
							 
							  
							
							  
							  
							  <div class='buttons'>
							  <input class='btn btn-primary' type=submit value=Simpan>
							  <input class='btn btn-danger' type=button value=Batal onclick=self.history.back()>
							  </div>
							  </form>
							  
				</div> 
				
			</div>";
    }
    elseif ($_SESSION[leveluser]=='masyarakat'){
         echo"<br><b class='judul'>Edit kecamatan</b><br><p class='garisbawah'></p>
         <form method=POST action='$aksi_masyarakat?module=masyarakat&act=update_kecamatan_masyarakat'>";
         $tampil = mysql_query("SELECT * FROM kecamatan WHERE id = '$_GET[id]'");
         $r = mysql_fetch_array($tampil);
         echo "<table>
          <tr><td>kecamatan </td>   <td>: <select name='id_kecamatan'>
                                      <option value='$r[id_kecamatan]' selected>$r[nama]</option>";
                                      $tampilk = mysql_query("SELECT * FROM kecamatan ORDER BY id_kecamatan");
                                      while($t=mysql_fetch_array($tampilk)){
                                            echo "<option value=$t[id_kecamatan]>$t[nama]</option>";
                                      }echo"</select></td></tr>
        <tr><td colspan=2><input type=submit class='tombol' value='Update'>
                          <input type=button class='tombol' value='Batal'
                          onclick=self.history.back()></td></tr>
        </form></table>";
    }
    break;


case "detailkecamatan":
    $detail=mysql_query("SELECT * FROM kecamatan WHERE id_kecamatan='$_GET[id]'");
   
    if ($_SESSION[leveluser]=='admin' || $_SESSION['leveluser']=='guest'){
		?>
	 <div class="box box-danger box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Detail Kecamatan</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">
					
					<br><br><br>
					
					
					<table  class="table table-bordered table-striped" >
						<thead>
							<tr>
								
								<th>ID Kecamatan</th>
								<th>Nama Kecamatan</th>
								
								<th>Aksi</th>
								
							</tr>
						</thead>
						<tbody>
						<?php 
							while ($r=mysql_fetch_array($detail)){
							   echo "<tr>
									 <td>$r[id_kecamatan]</td>
									 <td>$r[nama]</td>";
									 
									 
									 echo"<td><a href='?module=kecamatan&act=editkecamatan&id=$r[id]' title='Edit' class='btn btn-primary btn-xs'>Edit</a> 
										 <a href=javascript:confirmdelete('$aksi?module=kecamatan&act=hapuskecamatan&id=$r[id]') title='Hapus'  class='btn btn-danger btn-xs'>Hapus</a> |
										 <a href=?module=masyarakat&act=lihatmasyarakat&id=$r[id_kecamatan]  class='btn btn-success btn-xs'>Lihat Masyarakat</a></td></tr>";
							  }
						echo "</tbody></table>
						<br><input class='btn btn-danger btn-flat' type=button value=Kembali onclick=self.history.back()>";
					?>
				</div>
			</div>	
             
	 <?php
    }else{
		echo "<form><fieldset>
              <legend>Detail Kecamatan</legend>
              <dl class='inline'>";
    echo "<table id='table1' class='gtable sortable'><thead>
          <tr><th>No</th><th>kecamatan</th><th>Pembimbing Akademik</th><th>Ketua kecamatan</th><th>Aksi</th></tr></thead>";
    $no = 1;
    while ($r=mysql_fetch_array($detail)){
       echo "<tr>
             <td>$no</td>
             <td>$r[nama]</td>";
             $getpengajar = mysql_query("SELECT * FROM pengajar WHERE id_pengajar = '$r[id_pengajar]'");
             $cek = mysql_num_rows($getpengajar);
             if (!empty($cek)){
             while($p=mysql_fetch_array($getpengajar)){
             echo "<td><a href=?module=admin&act=detailpengajar&id=$r[id_pengajar] title='Detail Pembimbing Akademik'>$p[nama_lengkap]</a></td>";
             }
             }else{
                 echo"<td></td>";
             }
             $getmasyarakat = mysql_query("SELECT * FROM masyarakat WHERE id_masyarakat = '$r[id_masyarakat]'");
             $cek_masyarakat = mysql_num_rows($getmasyarakat);
             if (!empty($cek_masyarakat)){
             while($s=mysql_fetch_array($getmasyarakat)){
             echo "<td><a href=?module=masyarakat&act=detailmasyarakat&id=$s[id_masyarakat] title='Detail masyarakat'>$s[nama_lengkap]</a></td>";
             }
             }else{
                 echo "<td></td>";
             }
             echo"<td><a href='?module=kecamatan&act=editkecamatan&id=$r[id]' title='Edit'> <img src='images/icons/edit.png' alt='Edit' /></a>|
                      <input type=button class='button small White' value='Lihat Kecamatan' onclick=\"window.location.href='?module=masyarakat&act=lihatmasyarakat&id=$r[id_kecamatan]';\">";
       $no++;
      }
    echo "</table></dl></fieldset</form>
    <br> <input type=button class='button blue' value=Kembali onclick=self.history.back()>";
		
		
	}

    break;

 
}
}
?>
