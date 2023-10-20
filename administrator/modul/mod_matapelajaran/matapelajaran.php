<script>
function confirmdelete(delUrl) {
if (confirm("Anda yakin ingin menghapus?")) {
document.location = delUrl;
}
}
</script>

<script language="JavaScript" type="text/JavaScript">

 function showpel()
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
   echo "if (document.form_materi.id_kecamatan.value == \"".$idkecamatan."\")";
   echo "{";

   // membuat option matapelajaran untuk masing-masing kecamatan
   $query2 = "SELECT * FROM mata_kuliah WHERE id_kecamatan = '$idkecamatan' AND id_pengajar = '0'";
   $hasil2 = mysql_query($query2);
   $content = "document.getElementById('pelajaran').innerHTML = \"<select name='".kodematkul."'>";
   while ($data2 = mysql_fetch_array($hasil2))
   {
       $content .= "<option value='".$data2['kodematkul']."'>".$data2['nama']."</option>";
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
	
$aksi="modul/mod_matapelajaran/aksi_matapelajaran.php";

switch($_GET[act]){
// Tampil Mata Kuliah
  default:
    if ($_SESSION[leveluser]=='admin' || $_SESSION['leveluser']=='guest'){
	
	 $tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria ");
	
     ?>
	 <div class="col-md-8" >
	 <div class="box box-danger box-solid">
				<div class="box-header with-border" >
					<h3 class="box-title">Data Kriteria</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">
					<a  class ='btn  btn-success btn-flat' href='?module=matapelajaran&act=tambahkriteria'>Tambah Data </a>
					<br><br><br>
					
					
					<table id="example1" class="table table-bordered table-striped" >
						<thead>
							<tr>
								
								<th>No</th>
								<th>Nama Kriteria</th>
								<th>Type</th>
								<th>Bobot</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							$no=1;
							  while ($r=mysql_fetch_array($tampil_kriteria)){
								echo "
								
								<td>$no</td>
								<td>$r[kriteria]</td>
								<td>$r[type_kriteria]</td>
								<td>$r[bobot]</td>
							
								
								 <td><a href='?module=matapelajaran&act=editkriteria&id=$r[id]' title='Edit' class='btn btn-primary btn-xs'>Edit</a> |
									 <a href=javascript:confirmdelete('$aksi?module=matapelajaran&act=hapus&id=$r[id]') title='Hapus'  class='btn btn-danger btn-xs'>Hapus</a></td></tr>";
								$no++;
								}
						echo "</tbody></table>";
					?>
				</div>
			</div>	
             
	 <?php
		 
    }
	
	
    break;

case "tambahkriteria":
    if ($_SESSION[leveluser]=='admin' || $_SESSION['leveluser']=='guest'){
         echo "
		  <div class='col-md-8'>
		  <div class='box box-danger box-solid'>
				<div class='box-header with-border'>
					<h3 class='box-title'>Tambah Data Kriteria</h3>
					<div class='box-tools pull-right'>
						<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class='box-body'>
						<form method=POST action='$aksi?module=matapelajaran&act=input_matapelajaran' enctype='multipart/form-data' class='form-horizontal'>
							  <div class='form-group'>
									<label class='col-sm-3 control-label'>Nama Kriteria</label>        		
									 <div class='col-sm-4'>
										<input type=text name='nm_kriteria' class='form-control' Placeholder='Nama Kriteria' required='required'>
									 </div>
							  </div>

							  <div class='form-group'>
									  <label class='col-sm-3 control-label'>Type</label>
									  <div class='col-sm-4'>
											  <select name='type_kriteria' class=' form-control'>
											  	<option value='Benefit'>Benefit</option>
											  	<option value='Cost'>Cost</option>
											  </select>
									  </div>

							  </div>

							  <div class='form-group'>
									<label class='col-sm-3 control-label'>Bobot</label>        		
									 <div class='col-sm-2'>
										<input type=text name='bobot' class='form-control' Placeholder='Bobot' required='required'>
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

case "editkriteria":
    if ($_SESSION[leveluser]=='admin' || $_SESSION['leveluser']=='guest'){
        $kriteria=mysql_query("SELECT * FROM tbl_kriteria WHERE id = '$_GET[id]'");
        $m=mysql_fetch_array($kriteria);
        
        
        echo "
		   <div class='col-md-8'>
		  <div class='box box-danger box-solid'>
				<div class='box-header with-border'>
					<h3 class='box-title'>Edit Data Kriteria</h3>
					<div class='box-tools pull-right'>
						<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class='box-body'>
						<form method=POST action='$aksi?module=matapelajaran&act=update_matapelajaran'  class='form-horizontal'>
							  <input type=hidden name=id value='$m[id]'>
							  <div class='form-group'>
									<label class='col-sm-3 control-label'>Nama Kriteria</label>        		
									 <div class='col-sm-4'>
										<input type=text name='nm_kriteria' class='form-control' Placeholder='Nama Kriteria' value='$m[kriteria]'>
									 </div>
							  </div>

							  <div class='form-group'>
									  <label class='col-sm-3 control-label'>Type</label>
									  <div class='col-sm-4'>
											  <select name='type_kriteria' class=' form-control'>
											  	<option value='Benefit'>Benefit</option>
											  	<option value='Cost'>Cost</option>
											  </select>
									  </div>

							  </div>

							  <div class='form-group'>
									<label class='col-sm-3 control-label'>Bobot</label>        		
									 <div class='col-sm-3'>
										<input type=text name='bobot' class='form-control' Placeholder='Bobot' value='$m[bobot]'>
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

	case "himpunankriteria":
	if ($_SESSION[leveluser]=='admin' || $_SESSION['leveluser']=='guest'){
	
	 $tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria ");
	
     ?>
	 <div class="col-md-8">
	 <div class="box box-danger box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Data Kriteria</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">
					
	
					
					
					<table id="example1" class="table table-bordered table-striped" >
						<thead>
							<tr>
								
								<th>No</th>
								<th>Nama Kriteria</th>
								
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							$no=1;
							  while ($r=mysql_fetch_array($tampil_kriteria)){
								echo "
								
								<td>$no</td>
								<td>$r[kriteria]</td>
								
							
								
								 <td><a href='?module=matapelajaran&act=listhimpunankriteria&id=$r[id]' title='input Data Kriteria' class='btn btn-primary btn-xs'>Input Data Kriteria</a> 
									</td></tr>";
								$no++;
								}
						echo "</tbody></table>";
					?>
				</div>
			</div>	
             
	 <?php
		 
    }
	break;
	
	
	case "listhimpunankriteria":
	if ($_SESSION[leveluser]=='admin' || $_SESSION['leveluser']=='guest'){
	
	 $tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria WHERE id ='$_GET[id]'");
	 $a = mysql_fetch_array($tampil_kriteria);
	 
	 $tampil_himpunankriteria = mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_kriteria='$_GET[id]'");
	?>
	 <div class="col-md-8">
	 <div class="box box-danger box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Data Himpunan Kriteria <?php echo $a['kriteria']; ?> </h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						
					</div><!-- /.box-tools -->
				</div>
				<div class="box-body">
					
					<a  class ='btn  btn-success btn-flat' href='?module=matapelajaran&act=tambahhimpunan&id=<?php echo $a['id']; ?> '>Tambah Data </a>
					<br><br><br>
					
					<table id="example1" class="table table-bordered table-striped" >
						<thead>
							<tr>
								
								<th>No</th>
								<th>List</th>
								<th>Keterangan</th>
								<th>Nilai</th>
								
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							$no=1;
							  while ($r=mysql_fetch_array($tampil_himpunankriteria)){
								echo "
								
								<td>$no</td>
								<td>$r[nama]</td>
								<td>$r[keterangan]</td>
								<td>$r[nilai]</td>
								
							
								
								<td><a href='?module=matapelajaran&act=edithimpunankriteria&id=$r[id_hk]' title='Edit' class='btn btn-primary btn-xs'>Edit</a> 
									 <a href='$aksi?module=matapelajaran&act=hapus_himpunan&id=$r[id_hk]&id_kriteria=$r[id_kriteria]' title='Hapus'  class='btn btn-danger btn-xs'>Hapus</a></td></tr>";
								$no++;
								}
						echo "</tbody></table>";
					?>
				</div>
			</div>	
             
	 <?php
		 
    }
	break;
	
	case "tambahhimpunan":
	if ($_SESSION[leveluser]=='admin' || $_SESSION['leveluser']=='guest'){
	
	$tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria WHERE id ='$_GET[id]'");
	 $a = mysql_fetch_array($tampil_kriteria);
		
		
	echo "
		  <div class='col-md-8'>
		  <div class='box box-danger box-solid'>
				<div class='box-header with-border'>
					<h3 class='box-title'>Tambah Data Himpunan Kriteria $a[kriteria]</h3>
					<div class='box-tools pull-right'>
						<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class='box-body'>
						<form method=POST action='$aksi?module=matapelajaran&act=input_himpunan' class='form-horizontal'>
							<input type=hidden name='id_kriteria' class='form-control' Placeholder='Masukan Data' value='$a[id]'>							 
							 <div class='form-group'>
									<label class='col-sm-3 control-label'>Masukan Data</label>        		
									 <div class='col-sm-4'>
										<input type=text name='nama' class='form-control' Placeholder='Masukan Data' required='required'>
									 </div>
							  </div>
							  <div class='form-group'>
									<label class='col-sm-3 control-label'>Keterangan</label>        		
									 <div class='col-sm-4'>
										<input type=text name='ket' class='form-control' Placeholder='Keterangan' required='required'>
									 </div>
							  </div>
							  <div class='form-group'>
									<label class='col-sm-3 control-label'>Nilai</label>        		
									 <div class='col-sm-2'>
										<input type=text name='nilai' class='form-control' Placeholder='Nilai' required='required'>
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
	
	
	case "edithimpunankriteria":
	if ($_SESSION[leveluser]=='admin' || $_SESSION['leveluser']=='guest'){
	
	$tampil_hk = mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_hk = '$_GET[id]'");
	$f = mysql_fetch_array($tampil_hk);
	
	$tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria WHERE id ='$f[id_kriteria]'");
	$a = mysql_fetch_array($tampil_kriteria);
		
		
	echo "
		  <div class='col-md-8'>
		  <div class='box box-danger box-solid'>
				<div class='box-header with-border'>
					<h3 class='box-title'>Edit Data Himpunan Kriteria $a[kriteria]</h3>
					<div class='box-tools pull-right'>
						<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class='box-body'>
						<form method=POST action='$aksi?module=matapelajaran&act=update_himpunan' class='form-horizontal'>
							<input type=hidden name='id_kriteria' class='form-control' Placeholder='Masukan Data' value='$a[id]'>							 
							<input type=hidden name='id_hk' class='form-control' Placeholder='Masukan Data' value='$f[id_hk]'>							 
							 <div class='form-group'>
									<label class='col-sm-3 control-label'>Masukan Data</label>        		
									 <div class='col-sm-4'>
										<input type=text name='nama' class='form-control' Placeholder='Masukan Data' value='$f[nama]'>
									 </div>
							  </div>
							  
							  <div class='form-group'>
									<label class='col-sm-3 control-label'>Keterangan</label>        		
									 <div class='col-sm-4'>
										<input type=text name='ket' class='form-control' Placeholder='Keterangan' value='$f[keterangan]'>
									 </div>
							  </div>
							  
							  <div class='form-group'>
									<label class='col-sm-3 control-label'>Nilai</label>        		
									 <div class='col-sm-2'>
										<input type=text name='nilai' class='form-control' Placeholder='Nilai' value='$f[nilai]'>
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
	
	
	case "klasifikasi":
	
		
	if ($_SESSION[leveluser]=='admin' OR $_SESSION[leveluser]=='guest'){

  
      $tampil_masyarakat = mysql_query("SELECT * FROM masyarakat ORDER BY id_kecamatan ");
      
	  ?>
			
			<div class='col-md-8'>
			<div class="box box-danger box-solid" style="height: 900px">
				<div class="box-header with-border">
					<h3 class="box-title">Data Klasifikasi</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">
					
					
					
					<table id="example1" class="table table-bordered table-striped" >
						<thead>
							<tr>
								<th>No</th>
								<th>ID DTKS</th>
								<th>Nama</th>
								<th>Kecamatan</th>
								
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php 
								$no=1;
								while ($r=mysql_fetch_array($tampil_masyarakat)){
									echo "<tr class='warnabaris' >
											<td>$no</td>
											<td>$r[iddtks]</td>
											<td>$r[nama_lengkap]</td>";
												$kecamatan = mysql_query("SELECT * FROM kecamatan WHERE id_kecamatan = '$r[id_kecamatan]'");
												while($k=mysql_fetch_array($kecamatan)){
														echo"<td><a href=?module=kecamatan&act=detailkecamatan&id=$r[id_kecamatan] title='Detail kecamatan'>$k[nama]</a></td>";
												}
										echo"
											<td><a href=?module=matapelajaran&act=inputklasifikasi&id=$r[id_masyarakat] class='btn btn-primary btn-xs'>Input Klasifikasi</a> 
											 <p> </p>
											 
											 <a href=javascript:confirmdelete('$aksi?module=matapelajaran&act=hapus_klasifikasi&id=$r[id_masyarakat]') title='Hapus' class='btn btn-danger btn-xs'>Hapus </a>
				  
											</td>
										</tr>";
								$no++;
								}
						echo "</tbody></table>";
					?>
				</div>
			</div>	
             
	
		
			
					
				
		

<?php
    
    }
    break;
	
	case "inputklasifikasi":
    if ($_SESSION[leveluser]=='admin'  OR $_SESSION[leveluser]=='guest'){
       $detail=mysql_query("SELECT * FROM masyarakat WHERE id_masyarakat='$_GET[id]'");
       $masyarakat=mysql_fetch_array($detail);
       $tgl_lahir   = tgl_indo($masyarakat[tgl_lahir]);

       $get_kecamatan = mysql_query("SELECT * FROM kecamatan WHERE id_kecamatan = '$masyarakat[id_kecamatan]'");
       $kecamatan = mysql_fetch_array($get_kecamatan);
       
	   $friends = mysql_num_rows(mysql_query("SELECT * FROM masyarakat WHERE id_kecamatan='$masyarakat[id_kecamatan]'"));
      echo "
		  <div class='box box-danger box-solid'>
				<div class='box-header with-border'>
					<h3 class='box-title'>Input Klasifikasi</h3>
					<div class='box-tools pull-right'>
						<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class='box-body'>
					<div class='col-md-3'>
						<div class='box box-danger'>
							<div class='box-body box-profile'>";
							    if ($masyarakat[foto]!=''){
									echo "<img class='profile-user-img img-responsive img-circle' src='../foto_masyarakat/medium_$masyarakat[foto]' alt='User profile picture'>";
								}
	
      
              
							
							  
							 echo "		 
							  <h3 class='profile-username text-center'>$masyarakat[nama_lengkap]</h3>
							  <p class='text-muted text-center'>$masyarakat[iddtks]</p>

							  <ul class='list-group list-group-unbordered'>
								
								<li class='list-group-item'>
								  <b>Kecamatan</b> <a href=?module=kecamatan&act=detailkecamatan&id=$masyarakat[id_kecamatan] class='pull-right'>$kecamatan[nama]</a>
								</li>
								<li class='list-group-item'>
								  <b>Warga</b> <a class='pull-right'>$friends</a>
								</li>
								
							  </ul>
							  <input class='btn btn-primary btn-block' type=button value=Kembali onclick=self.history.back()>
							  
							</div><!-- /.box-body -->
						</div><!-- /.box -->
					</div>
					<div class='col-md-9'>	
						<div class='nav-tabs-custom'>
							<ul class='nav nav-tabs'>
								<li class='active'><a href='#activity' data-toggle='tab'>Input Klasifikasi</a></li>
								
							</ul>	
								
								<div class='tab-content'>
									<div class='active tab-pane' id='activity'>
										<div class='post'>
										<form method=POST action='$aksi?module=matapelajaran&act=input_klasifikasi' ' class='form-horizontal'>
										<input type='hidden' value ='$masyarakat[id_masyarakat]' name='id_masyarakat'>
										";
											
											$kriteria = mysql_query("SELECT * FROM tbl_kriteria");
											$i=1;
											while ($f = mysql_fetch_array($kriteria)){
												
												$forms = mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_kriteria='$f[id]'");
												
												echo "<p>
												<div class='form-group'>
													<label class='col-sm-3 control-label'>$f[kriteria]</label> 
													<div class='col-sm-2'>
													
													<select name='id_hk$i' class=' form-control  '  >
														 ";
														
														 while($r=mysql_fetch_array($forms)){
														 echo "<option value=$r[id_hk]>$r[nama]</option>";
														 
														 }
													
													echo "</select>
													
												</div>
												</div>
												</p>
												
												";     
												$i++;
											}
											
										$jumkriteria = mysql_num_rows(mysql_query("SELECT * FROM tbl_kriteria"));
										
										echo"
											<div class='buttons'>
												<input type='hidden' value='$jumkriteria' name='jumkriteria' >
												<input class='btn btn-success' type=submit value=Prosess >
											
											</div>
											</form>
											
													
											
										   		
		
										</div>	
								
								    </div>
									
						</div>
					</div>
				
				</div>
			</div>";
	  
	  
    }
	break;
	case "eeditklasifikasi":
		if ($_SESSION[leveluser]=='admin'  OR $_SESSION[leveluser]=='guest'){
		   $detail=mysql_query("SELECT * FROM masyarakat WHERE id_masyarakat='$_GET[id]'");
		   $masyarakat=mysql_fetch_array($detail);
		   $tgl_lahir   = tgl_indo($masyarakat[tgl_lahir]);
	
		   $get_kecamatan = mysql_query("SELECT * FROM kecamatan WHERE id_kecamatan = '$masyarakat[id_kecamatan]'");
		   $kecamatan = mysql_fetch_array($get_kecamatan);
		   
		   $friends = mysql_num_rows(mysql_query("SELECT * FROM masyarakat WHERE id_kecamatan='$masyarakat[id_kecamatan]'"));
		  echo "
			  <div class='box box-danger box-solid'>
					<div class='box-header with-border'>
						<h3 class='box-title'>Edit Klasifikasi</h3>
						<div class='box-tools pull-right'>
							<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
						</div><!-- /.box-tools -->
					</div>
					<div class='box-body'>
						<div class='col-md-3'>
							<div class='box box-danger'>
								<div class='box-body box-profile'>";
									if ($masyarakat[foto]!=''){
										echo "<img class='profile-user-img img-responsive img-circle' src='../foto_masyarakat/medium_$masyarakat[foto]' alt='User profile picture'>";
									}
		
		  
				  
								
								  
								 echo "		 
								  <h3 class='profile-username text-center'>$masyarakat[nama_lengkap]</h3>
								  <p class='text-muted text-center'>$masyarakat[iddtks]</p>
	
								  <ul class='list-group list-group-unbordered'>
									
									<li class='list-group-item'>
									  <b>Kecamatan</b> <a href=?module=kecamatan&act=detailkecamatan&id=$masyarakat[id_kecamatan] class='pull-right'>$kecamatan[nama]</a>
									</li>
									<li class='list-group-item'>
									  <b>Warga</b> <a class='pull-right'>$friends</a>
									</li>
									
								  </ul>
								  <input class='btn btn-primary btn-block' type=button value=Kembali onclick=self.history.back()>
								  
								</div><!-- /.box-body -->
							</div><!-- /.box -->
						</div>
						<div class='col-md-9'>	
							<div class='nav-tabs-custom'>
								<ul class='nav nav-tabs'>
									<li class='active'><a href='#activity' data-toggle='tab'>Edit Klasifikasi</a></li>
									
								</ul>	
									
									<div class='tab-content'>
										<div class='active tab-pane' id='activity'>
											<div class='post'>
											<form method=POST action='$aksi?module=matapelajaran&act=edit_klasifikasi' ' class='form-horizontal'>
											<input type='hidden' value ='$masyarakat[id_masyarakat]' name='id_masyarakat'>
											";
												
												$kriteria = mysql_query("SELECT * FROM tbl_kriteria");
												
												$i=1;
												
												while ($f = mysql_fetch_array($kriteria)){
													
													
													$forms = mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_kriteria='$f[id]'");
													
													
													echo "<p>
													<div class='form-group'>
														<label class='col-sm-3 control-label'>$f[kriteria]</label> 
														<div class='col-sm-2'>
														
														<select name='id_hk$i' class=' form-control  '  >
													
															 ";
															 
															
															 
															
															 while($r=mysql_fetch_array($forms)){
															 echo "<option value=$r[id_hk]>$r[nilai]</option>";
															 
															 }
														
														echo "</select>
														
													</div>
													</div>
													</p>
													
													";     
													$i++;
												}
												
											$jumkriteria = mysql_num_rows(mysql_query("SELECT * FROM tbl_kriteria"));
											
											echo"
												<div class='buttons'>
													<input type='hidden' value=	'$jumkriteria' name='jumkriteria' >
													<input class='btn btn-success' type=submit value=Prosess >
													<a href=javascript:confirmdelete('$aksi?module=matapelajaran&act=hapus_klasifikasi&id=$r[id_masyarakat]') title='Hapus' class='btn btn-danger btn-xs'>Hapus </a>
												</div>
												</form>
												
														
												
													   
			
											</div>	
									
										</div>
										
							</div>
						</div>
					
					</div>
				</div>";
		  
		  
		}
		break;
	
	case "analisa":
	if ($_SESSION[leveluser]=='admin' || $_SESSION['leveluser']=='guest'){
	
	 $tampil_masyarakat = mysql_query("SELECT * FROM masyarakat");	
	 $tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria ");
	 $tampil_klasifikasi = mysql_query("SELECT * FROM tbl_klasifikasi GROUP by id_masyarakat")
     
	 //Matrik Awal
	 ?>
	 
	 <div class="box box-danger box-solid"  >
				<div class="box-header with-border">
					<h3 class="box-title">Matrik Awal</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">
					
					
					<table id="example1" class="table table-bordered table-striped" >
						<thead>
							<tr>
								
								<th>No</th>
								<th>ID DTKS</th>
								<th>Nama</th>
						<?php 
							$a = 1;
							while($f= mysql_fetch_array($tampil_kriteria)){
								
								echo "<th>C$a</th>";
							
							$a++;	
							}	
						
						?>
								
							</tr>
						</thead>
						<tbody>
						<?php 
							$no=1;
							  while ($r=mysql_fetch_array($tampil_klasifikasi)){
								$h = mysql_fetch_array(mysql_query("SELECT * FROM masyarakat WHERE id_masyarakat ='$r[id_masyarakat]'"));
								
								
								echo "
								
								<td>$no</td>
								<td>$h[iddtks]</td>
								<td>$h[nama_lengkap]</td>";
								
								$klasifikasi = mysql_query("SELECT * FROM tbl_klasifikasi WHERE id_masyarakat = '$r[id_masyarakat]'");
								while ($n=mysql_fetch_array($klasifikasi)){
									
										$himpunankriteria = mysql_fetch_array(mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_hk ='$n[id_hk]'"));
										
										echo "<td>$himpunankriteria[nama]</td>";
										
									
								}
								
								echo"
								
								
								
								</tr>";
								$no++;
								}
						echo "</tbody></table>";
					?>
				</div>
			</div>	
			
			<?php
			
			
			
			
			
			$tampil_masyarakat = mysql_query("SELECT * FROM masyarakat");	
			$tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria ");
			$tampil_klasifikasi = mysql_query("SELECT * FROM tbl_klasifikasi GROUP by id_masyarakat")
			?>
			
			 <div class="box box-danger box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Matrik Awal</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">
					
					
					
					<table id="example2" class="table table-bordered table-striped" >
						<thead>
							<tr>
								
								<th>No</th>
								<th>ID DTKS</th>
								<th>Nama</th>
						<?php 
							$a = 1;
							while($f= mysql_fetch_array($tampil_kriteria)){
								
								echo "<th>C$a</th>";
							
							$a++;
							}	
						
						?>
								
							</tr>
						</thead>
						<tbody>
						<?php 
							$no=1;
							  while ($r=mysql_fetch_array($tampil_klasifikasi)){
								$h = mysql_fetch_array(mysql_query("SELECT * FROM masyarakat WHERE id_masyarakat ='$r[id_masyarakat]'"));
								
								
								echo "
								
								<td>$no</td>
								<td>$h[iddtks]</td>
								<td>$h[nama_lengkap]</td>";
								
								$klasifikasi = mysql_query("SELECT * FROM tbl_klasifikasi WHERE id_masyarakat = '$r[id_masyarakat]'");
								while ($n=mysql_fetch_array($klasifikasi)){
									
										$himpunankriteria = mysql_fetch_array(mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_hk ='$n[id_hk]'"));
										
										echo "<td>$himpunankriteria[nilai]</td>";
										
									
								}
								
								echo"
								
								
								
								</tr>";
								$no++;
								}
						echo "</tbody></table>";
					?>
				</div>
			</div>	
			
			
			<?php
			
			
			
			
			//Normalisasi
			
			$tampil_masyarakat = mysql_query("SELECT * FROM masyarakat");	
			$tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria ");
			$tampil_klasifikasi = mysql_query("SELECT * FROM tbl_klasifikasi GROUP by id_masyarakat")
			?>
			
			 <div class="box box-danger box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Normalisasi</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">
					
					
					
					<table id="example3" class="table table-bordered table-striped" >
						<thead>
							<tr>
								
								<th>No</th>
								<th>ID DTKS</th>
								<th>Nama</th>
						<?php 
							$a = 1;
							while($f= mysql_fetch_array($tampil_kriteria)){
								
								echo "<th>C$a</th>";
							
							$a++;
							}	
						
						?>
								
							</tr>
						</thead>
						<tbody>
						<?php 
							$no=1;
							  while ($r=mysql_fetch_array($tampil_klasifikasi)){
								$h = mysql_fetch_array(mysql_query("SELECT * FROM masyarakat WHERE id_masyarakat ='$r[id_masyarakat]'"));
								
								
								echo "
								
								<td>$no</td>
								<td>$h[iddtks]</td>
								<td>$h[nama_lengkap]</td>";

							

								$klasifikasi = mysql_query("SELECT * FROM tbl_klasifikasi WHERE id_masyarakat = '$r[id_masyarakat]'");
											while ($n=mysql_fetch_array($klasifikasi)){

					
								$himpunankriteria = mysql_fetch_array(mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_hk ='$n[id_hk]'"));
								$nilai1 = $himpunankriteria['nilai'];
								
								$pembagi = mysql_fetch_array(mysql_query("SELECT * FROM v_analisaa WHERE id_klasifikasi ='$n[id_klasifikasi]'"));
								$nilai2 = $pembagi['id_kriteria'];
								if ($nilai2 == 6){
									$nilai = $nilai1 / 5 ;
									
									echo "<td>$nilai</td>";
								} elseif ($nilai2 == 7){
									
									$nilai = $nilai1 / 4 ;
									echo "<td>$nilai</td>";
								}elseif ($nilai2 == 8){
									
									$nilai = $nilai1 / 6 ;
									echo "<td>$nilai</td>";
								}elseif ($nilai2 == 9){
									
									$nilai = $nilai1 / 4 ;
									echo "<td>$nilai</td>";
								}elseif ($nilai2 == 10){
									
									$nilai = $nilai1 / 6 ;
									echo "<td>$nilai</td>";
								}elseif ($nilai2 == 11){
								
									$nilai = $nilai1 / 5 ;
									echo "<td>$nilai</td>";
								}else {
									echo "<td>salah</td>";
								}

								
										}


								echo"
								
								
								
								</tr>";
								$no++;
								}
						echo "</tbody></table>";
					?>
				</div>
			</div>	
			
			
			
			<?php
			
			
			
			
			//Rangking
			
			$tampil_masyarakat = mysql_query("SELECT * FROM masyarakat");	
			$tampil_kriteria = mysql_query("SELECT * FROM tbl_kriteria ");
			$tampil_klasifikasi = mysql_query("SELECT * FROM tbl_klasifikasi GROUP by id_masyarakat")
			
			?>
			
			 <div class="box box-danger box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Rangking</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">
					
			

					<table id="example4" class="table table-bordered table-striped">
						
					<thead>
				
							<tr>
							
						
								<th>No</th>
								<th>ID DTKS</th>
								<th>Nama</th>
								<th>Kecamatan</th>
								<th>Total Nilai</th>
						
								
							</tr>
						</thead>
	
						<tbody>

   
					  <?php 
				
						$no=1;
							  while ($r=mysql_fetch_array($tampil_klasifikasi)){
								$h = mysql_fetch_array(mysql_query("SELECT * FROM masyarakat WHERE id_masyarakat ='$r[id_masyarakat]'"));
								
								
								echo "
								
								<td>$no</td>
								<td>$h[iddtks]</td>
								
								<td>$h[nama_lengkap]</td>";
								$kecamatan = mysql_query("SELECT * FROM kecamatan WHERE id_kecamatan = '$h[id_kecamatan]'");
												while($k=mysql_fetch_array($kecamatan)){
														echo"<td><a href=?module=kecamatan&act=detailkecamatan&id=$h[id_kecamatan] title='Detail kecamatan'>$k[nama]</a></td>";
												}
							
								
								$klasifikasi = mysql_query("SELECT * FROM v_analisaa WHERE id_masyarakat = '$r[id_masyarakat]'");
								$totalnilai = 0;
								
								$simpan2 =1;
								while ($n=mysql_fetch_array($klasifikasi)){

								
								
							$himpunankriteria = mysql_fetch_array(mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_hk ='$n[id_hk]'"));
							$nilai1 = $himpunankriteria['nilai'];
							
							$pembagi = mysql_fetch_array(mysql_query("SELECT * FROM v_analisaa WHERE id_klasifikasi ='$n[id_klasifikasi]'"));
							$nilai2 = $pembagi['id_kriteria'];
							if ($nilai2 == 6){
								$nilai = $nilai1 / 5 ;
								
								
							} elseif ($nilai2 == 7){
								
								$nilai = $nilai1 / 4 ;
								
							}elseif ($nilai2 == 8){
								
								$nilai = $nilai1 / 6 ;
								
							}elseif ($nilai2 == 9){
								
								$nilai = $nilai1 / 4 ;
								
							}elseif ($nilai2 == 10){
								
								$nilai = $nilai1 / 6 ;
								
							}elseif ($nilai2 == 11){
							
								$nilai = $nilai1 / 5 ;
								
							}else {
								echo "<td>salah</td>";
							}
							
							
										
										$bobot = mysql_fetch_array(mysql_query("SELECT * FROM tbl_kriteria WHERE id = '$n[id_kriteria]'"));
										$simpan += ($nilai * $bobot['bobot'])	;
										$simpan2 *= pow($nilai, $bobot['bobot']);

										
										$rank = ((0.5) * $simpan);
										$rank2 = ((0.5) * $simpan2)	;							
										$totalnilai = $rank + $rank2 ;	

									
										
								}
								$simpan = 0;

									// $benefit = 'Benefit';
									// $cost = 'Cost';

									// $n1 = $n['id_kriteria'];
									// $n2 = $n['id_hk'];

									// $tampil_kriteria_tipe = mysql_query("SELECT * FROM tbl_kriteria WHERE id='$n1'");

									// $hasilnya = mysql_fetch_row($tampil_kriteria_tipe);

									// if($hasilnya[2] == $benefit){

									// 	$crmax = mysql_fetch_array(mysql_query("SELECT max(nilai) as nilaimax FROM v_analisa WHERE id_kriteria='$n[id_kriteria]'"));
									// 	$himpunankriteria = mysql_fetch_array(mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_hk ='$n[id_hk]'"));
									
									// 	$nilaiok = $himpunankriteria['nilai'] / $crmax['nilaimax'];
											
									// 		echo "<td>$nilaiok</td>";
									// } else {
										
									// 	$crmin = mysql_fetch_array(mysql_query("SELECT min(nilai) as nilaimin FROM v_analisa WHERE id_kriteria='$n1'"));
										
									// 	$himpunankriteria = mysql_fetch_array(mysql_query("SELECT * FROM tbl_himpunankriteria WHERE id_hk ='$n2'"));

									// 	$nilaiok = $crmin['nilaimin'] / $himpunankriteria['nilai'];
									// 	// $nilaiok = $himpunankriteria['nilai'] / $crmin['nilaimin'];
									// 	echo "<td>$nilaiok</td>";

									// }

								echo "<td>".number_format($totalnilai,5)."</td>";




								echo"
								
								
								
								</tr>";
								$no++;
								}
								
						echo "</tbody></table>";
					?>
				</div>
			</div>	
             
	 <?php
		 
    }
	break;
	
	
	
}
}
?>
