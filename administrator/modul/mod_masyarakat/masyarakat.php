<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href=../css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
}
else{

include "../../../configurasi/class_paging.php";

$aksi="modul/mod_masyarakat/aksi_masyarakat.php";
$aksi_masyarakat = "administrator/modul/mod_masyarakat/aksi_masyarakat.php";
switch($_GET[act]){
  // Tampil masyarakat
  default:
    if ($_SESSION[leveluser]=='admin' OR $_SESSION[leveluser]=='guest'){

  
      $tampil_masyarakat = mysql_query("SELECT * FROM masyarakat ORDER BY id_kecamatan ");
      
	  ?>
			
			<div class="box box-danger box-solid" style="height: 650px">
				<div class="box-header with-border"  >
				
					<h3 class="box-title">Data Masyarakat</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body" style="overflow-x:auto;">
				<a  class ='btn  btn-success btn-flat' href='?module=masyarakat&act=tambahmasyarakat'>Tambah Data </a>
				<br><br>
				
				
					
					
					<table id="example2" class="table table-bordered table-striped" >
						<thead>
							<tr>
								<th>No</th>
								<th>ID DTKS</th>
								
								<th>Nama</th>
								<th>Kecamatan</th>
								<th>Kelurahan</th>
								
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
										echo"<td>$r[kelurahan]</td>
											 <td><a href='?module=masyarakat&act=editmasyarakat&id=$r[id_masyarakat]' title='Edit' class='btn btn-warning btn-xs'>Edit</a> 
											 <a href=javascript:confirmdelete('$aksi?module=masyarakat&act=hapus&id=$r[id_masyarakat]') title='Hapus' class='btn btn-danger btn-xs'>Hapus </a>
											 <a href=?module=detailmasyarakat&act=detailmasyarakat&id=$r[id_masyarakat] class='btn btn-success btn-xs'> Detail</a>
				  
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
	case "lihatmasyarakat":
		if ($_SESSION[leveluser]=='admin' OR $_SESSION[leveluser]=='guest'){
		
	
		$tampil = mysql_query("SELECT * FROM masyarakat WHERE id_kecamatan = '$_GET[id]' ORDER BY nama_lengkap");
		$cek_masyarakat = mysql_num_rows($tampil);
		if(!empty($cek_masyarakat)){
		?>
			<div class="box box-danger box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">Daftar masyarakat</h3>
						<div class="box-tools pull-right">
							<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div><!-- /.box-tools -->
					</div>
					<div class="box-body">
						
						<br><br><br>	
						<table id="example1" class="table table-bordered table-striped" >
							<thead>
							<tr>
								<th>No</th>
								<th>ID DTKS</th>
								
								<th>Nama</th>
								<th>Kecamatan</th>
								<th>Kelurahan</th>
								
								<th>Aksi</th>
							</tr>
							</thead>
							<tbody>
							<?php 
									$no=1;
									while ($r=mysql_fetch_array($tampil)){
										echo "<tr class='warnabaris' >
										<td>$no</td>
										<td>$r[iddtks]</td>
										
										<td>$r[nama_lengkap]</td>";
											$kecamatan = mysql_query("SELECT * FROM kecamatan WHERE id_kecamatan = '$r[id_kecamatan]'");
											while($k=mysql_fetch_array($kecamatan)){
													echo"<td><a href=?module=kecamatan&act=detailkecamatan&id=$r[id_kecamatan] title='Detail kecamatan'>$k[nama]</a></td>";
											}
									echo"<td>$r[kelurahan]</td>
										 <td><a href='?module=masyarakat&act=editmasyarakat&id=$r[id_masyarakat]' title='Edit' class='btn btn-warning btn-xs'>Edit</a> 
										 <a href=javascript:confirmdelete('$aksi?module=masyarakat&act=hapus&id=$r[id_masyarakat]') title='Hapus' class='btn btn-danger btn-xs'>Hapus </a>
										 <a href=?module=detailmasyarakat&act=detailmasyarakat&id=$r[id_masyarakat] class='btn btn-success btn-xs'> Detail</a>
			  
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
		}
		break;
case "detail_masyarakat":
    if ($_SESSION[leveluser]=='admin' OR $_SESSION[leveluser]=='guest'){
    $p      = new paging_lihatmasyarakat;
    $batas  = 20;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM masyarakat WHERE id_kecamatan = '$_GET[id]' ORDER BY nama_lengkap LIMIT $posisi,$batas");
    $cek_masyarakat = mysql_num_rows($tampil);
    if(!empty($cek_masyarakat)){

	?>
		<div class="box box-danger box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Daftar Masyarakat</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">
				
					<br><br><br>	
					<table id="example1" class="table table-bordered table-striped" >
						<thead>
							<tr>
							<th>No</th>
								<th>ID DTKS</th>
								<th>Nama Lengkap</th>
								<th>Kecamatan</th>
								<th>No KK</th>
								<th>NIK</th>
								<th>No BPJS</th>
								<th>RT</th>
								<th>Jenis Kelamin</th>
								<th>Tanggal Lahir</th>
								<th>Tempat Lahir</th>
								<th>Nomor HP</th>
								<th>Foto Rumah</th>
								<th>Link Google Maps</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php 
								$no=1;
								while ($r=mysql_fetch_array($tampil)){
									echo "<tr class='warnabaris' >
											<td>$no</td>
											<td>$r[iddtks]</td>
											<td>$r[nama_lengkap]</td>";
												$kecamatan = mysql_query("SELECT * FROM kecamatan WHERE id_kecamatan = '$r[id_kecamatan]'");
												while($k=mysql_fetch_array($kecamatan)){
														echo"<td><a href=?module=kecamatan&act=detailkecamatan&id=$r[id_kecamatan] title='Detail kecamatan'>$k[nama]</a></td>";
												}
										echo"<td>$r[no_kk]</td>
										<td>$r[nik]</td>
										<td>$r[no_bpjs]</td>
										
										<td>$r[rt]</td>
										<td><p align='center'>$r[jenis_kelamin]</p></td>             
										<td>$r[tgl_lahir]</td>
										<td>$r[tempat_lahir]</td>
										<td>$r[no_hp]</td>
										 <td><a href='$r[foto_rumah]'target='_blank'>$r[foto_rumah]</a></p></td>
										 <td><a href='$r[link_gmap]'target='_blank'>$r[link_gmap]</a></p></td>

										 <td><a href='?module=masyarakat&act=editmasyarakat&id=$r[id_masyarakat]' title='Edit' class='btn btn-warning btn-xs'>Edit</a> 
										 <a href=javascript:confirmdelete('$aksi?module=masyarakat&act=hapus&id=$r[id_masyarakat]') title='Hapus' class='btn btn-danger btn-xs'>Hapus </a>
										 <a href=?module=detailmasyarakat&act=detailmasyarakat&id=$r[id_masyarakat] class='btn btn-success btn-xs'> Detail</a>
			  
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
	}
    break;

case "tambahmasyarakat":
    if ($_SESSION[leveluser]=='admin'  OR $_SESSION[leveluser]=='guest'){
        $tampil = mysql_query("SELECT * FROM masyarakat WHERE id_masyarakat = '$_GET[id]'");
		if($_GET['message'] =='success'){
			$pesan = "
				<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <h4><i class='icon fa fa-check'></i> Alert!</h4>
                    Data Berhasil Disimpan !!
                </div>
			
			
			";
		}
        echo "
		  <div class='box box-danger box-solid'>
				<div class='box-header with-border'>
					<h3 class='box-title'>Tambah Data Peserta Didik</h3>
					<div class='box-tools pull-right'>
						<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class='box-body'>
						<form method=POST action='$aksi?module=masyarakat&act=input_masyarakat' enctype='multipart/form-data' class='form-horizontal'>
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>ID DTKS</label>        		
									 <div class='col-sm-4'>
										<input type=text name='iddtks' class='form-control' Placeholder='ID DTKS' required='required'>
									 </div>
							  </div>
							  <div class='form-group'>
							  <label class='col-sm-2 control-label'>Nomor KK</label>        		
							   <div class='col-sm-4'>
								  <input type=text name='no_kk' class='form-control' Placeholder='Nomor KK' value='$r[no_kk]'>
							   </div>
						</div>
						<div class='form-group'>
							  <label class='col-sm-2 control-label'>NIK</label>        		
							   <div class='col-sm-4'>
								  <input type=text name='nik' class='form-control' Placeholder='NIK' value='$r[nik]'>
							   </div>
						</div>
						<div class='form-group'>
							  <label class='col-sm-2 control-label'>Nomor BPJS</label>        		
							   <div class='col-sm-4'>
								  <input type=text name='no_bpjs' class='form-control' Placeholder='Nomor BPJS' value='$r[no_bpjs]'>
							   </div>
						</div>
						<div class='form-group'>
							  <label class='col-sm-2 control-label'>Nomor HP</label>        		
							   <div class='col-sm-4'>
								  <input type=text name='no_hp' class='form-control' Placeholder='Nomor HP' value='$r[no_hp]'>
							   </div>
						</div>
											 
						<div class='form-group'>
						<label class='col-sm-2 control-label'>Nama Lengkap</label>        		
						 <div class='col-sm-4'>
							<input type=text name='nama_lengkap' class='form-control' Placeholder='Nama Lengkap' value='$r[nama_lengkap]'>
						 </div>
				  </div>
				  
				  
		   
		   <div class='form-group'>
				  <label class='col-sm-2 control-label'>RT</label>        		
				   <div class='col-sm-4'>
					  <input type=text name='rt' class='form-control' Placeholder='RT' value='$r[rt]'>
				   </div>
			</div>
		   
			<div class='form-group'>
				  <label class='col-sm-2 control-label'>Kelurahan</label>        		
				   <div class='col-sm-4'>
					  <input type=text name='kelurahan' class='form-control' Placeholder='Kelurahan' value='$r[kelurahan]' >
				   </div>
			</div>
			
			  <div class='form-group'>
				  <label class='col-sm-2 control-label'>Alamat</label>        		
				  <div class='col-sm-4'>
					  <input type=text name='alamat' class='form-control' Placeholder='Alamat' value='$r[alamat]' >
				  </div>
		  </div>
			  <div class='form-group'>
					  <label class='col-sm-2 control-label'>Tempat Lahir</label>        		
					  <div class='col-sm-4'>
					  <input type=text name='tempat_lahir' class='form-control' Placeholder='Tempat Lahir' value='$r[tempat_lahir]' >
								  </div>
						  </div>
			  <div class='form-group'>
						  <label class='col-sm-2 control-label'>Tanggal Lahir</label>        		
						  <div class='col-sm-4'>
							  <input type=text name='tgl_lahir' class='form-control' Placeholder='Tanggal Lahir' value='$r[tgl_lahir]' >
						  </div>
				  </div>

				  <div class='form-group'>
				  <label class='col-sm-2 control-label'>Jenis Kelamin</label>        		
				  <div class='col-sm-4'>
					  <input type=text name='jenis_kelamin' class='form-control' Placeholder='Jenis Kelamin' value='$r[jenis_kelamin]' >
				  </div>
		  </div>
		  <div class='form-group'>
				  <label class='col-sm-2 control-label'>Foto Rumah</label>        		
				  <div class='col-sm-4'>
					  <input type=text name='foto_gmap' class='form-control' Placeholder='Foto Rumah' value='$r[foto_gmap]' >
				  </div>
		  </div>
		  
		  <div class='form-group'>
		  <label class='col-sm-2 control-label'>Kecamatan</label>        		
		  <div class='col-sm-2'>
			  <select name='id_kecamatan' class='form-control' >
				  <option value=0 selected>--Pilih Kecamatan--</option>";
				  $tampil=mysql_query("SELECT * FROM kecamatan ORDER BY id_kecamatan");
				  while($r=mysql_fetch_array($tampil)){
				  echo "<option value=$r[id_kecamatan]>$r[nama]</option>";
				  }
			  echo "</select>
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

  case "nis_ada":
     if ($_SESSION[leveluser]=='admin'  OR $_SESSION[leveluser]=='guest'){
         echo "<span class='judulhead'><p class='garisbawah'>nis SUDAH PERNAH DIGUNAKAN<br>
               <input type=button value=Kembali onclick=self.history.back()></p></span>";
     }
     break;





  case "editmasyarakat":
    $edit=mysql_query("SELECT * FROM masyarakat WHERE id_masyarakat='$_GET[id]'");
    $r=mysql_fetch_array($edit);
    
	
	$get_kecamatan = mysql_query("SELECT * FROM kecamatan WHERE id_kecamatan = '$r[id_kecamatan]'");
    $kecamatan = mysql_fetch_array($get_kecamatan);

    if ($_SESSION[leveluser]=='admin'  OR $_SESSION[leveluser]=='guest'){
		if($_GET['message'] =='success'){
			$pesan = "
				<div class='alert alert-success alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <h4><i class='icon fa fa-check'></i> Alert!</h4>
                    Data Berhasil Disimpan !!
                </div>
			
			
			";
		}
		echo "
		  <div class='box box-danger box-solid'>
				<div class='box-header with-border'>
					<h3 class='box-title'>Edit Data Masyarakat</h3>
					<div class='box-tools pull-right'>
						<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class='box-body'>
						<form method=POST action=$aksi?module=masyarakat&act=update_masyarakat  enctype='multipart/form-data' class='form-horizontal'>
							  <input type=hidden name=id value='$r[id_masyarakat]'>
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>ID DTKS</label>        		
									 <div class='col-sm-4'>
										<input type=text name='iddtks' class='form-control' Placeholder='ID DTKS' value='$r[iddtks]'>
									 </div>
							  </div>
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Nomor KK</label>        		
									 <div class='col-sm-4'>
										<input type=text name='no_kk' class='form-control' Placeholder='Nomor KK' value='$r[no_kk]'>
									 </div>
							  </div>
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>NIK</label>        		
									 <div class='col-sm-4'>
										<input type=text name='nik' class='form-control' Placeholder='NIK' value='$r[nik]'>
									 </div>
							  </div>
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Nomor BPJS</label>        		
									 <div class='col-sm-4'>
										<input type=text name='no_bpjs' class='form-control' Placeholder='Nomor BPJS' value='$r[no_bpjs]'>
									 </div>
							  </div>
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Nomor HP</label>        		
									 <div class='col-sm-4'>
										<input type=text name='no_hp' class='form-control' Placeholder='Nomor HP' value='$r[no_hp]'>
									 </div>
							  </div>
							 					  
							  <div class='form-group'>
							  <label class='col-sm-2 control-label'>Nama Lengkap</label>        		
							   <div class='col-sm-4'>
								  <input type=text name='nama_lengkap' class='form-control' Placeholder='Nama Lengkap' value='$r[nama_lengkap]'>
							   </div>
						</div>
						
						
				 
				 <div class='form-group'>
						<label class='col-sm-2 control-label'>RT</label>        		
						 <div class='col-sm-4'>
							<input type=text name='rt' class='form-control' Placeholder='RT' value='$r[rt]'>
						 </div>
				  </div>
				 
				  <div class='form-group'>
						<label class='col-sm-2 control-label'>Kelurahan</label>        		
						 <div class='col-sm-4'>
							<input type=text name='kelurahan' class='form-control' Placeholder='Kelurahan' value='$r[kelurahan]' >
						 </div>
				  </div>
				  
					<div class='form-group'>
						<label class='col-sm-2 control-label'>Alamat</label>        		
						<div class='col-sm-4'>
							<input type=text name='alamat' class='form-control' Placeholder='Alamat' value='$r[alamat]' >
						</div>
				</div>
					<div class='form-group'>
							<label class='col-sm-2 control-label'>Tempat Lahir</label>        		
							<div class='col-sm-4'>
							<input type=text name='tempat_lahir' class='form-control' Placeholder='Tempat Lahir' value='$r[tempat_lahir]' >
										</div>
								</div>
					<div class='form-group'>
								<label class='col-sm-2 control-label'>Tanggal Lahir</label>        		
								<div class='col-sm-4'>
									<input type=text name='tgl_lahir' class='form-control' Placeholder='Tanggal Lahir' value='$r[tgl_lahir]' >
								</div>
						</div>

						<div class='form-group'>
						<label class='col-sm-2 control-label'>Jenis Kelamin</label>        		
						<div class='col-sm-4'>
							<input type=text name='jenis_kelamin' class='form-control' Placeholder='Jenis Kelamin' value='$r[jenis_kelamin]' >
						</div>
				</div>
				<div class='form-group'>
						<label class='col-sm-2 control-label'>Foto Rumah</label>        		
						<div class='col-sm-4'>
							<input type=text name='foto_rumah' class='form-control' Placeholder='Foto Rumah' value='$r[foto_rumah]' >
						</div>
				</div>
				<div class='form-group'>
						<label class='col-sm-2 control-label'>Foto Rumah</label>        		
						<div class='col-sm-4'>
							<input type=text name='link_gmap' class='form-control' Placeholder='Link Google Maps' value='$r[link_gmap]' >
						</div>
				</div>

							<div class='form-group'>
									<label class='col-sm-2 control-label'>Kecamatan</label>        		
									<div class='col-sm-2'>
										<select name='id_kecamatan' class='form-control' value='$r[link_gmap]'>
											";
											$tampil=mysql_query("SELECT * FROM kecamatan ORDER BY id_kecamatan");
											while($r=mysql_fetch_array($tampil)){
											echo "<option value=$r[id_kecamatan]>$r[nama]</option>";
											}
										echo "</select>
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

    
 case "detailmasyarakat":
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
					<h3 class='box-title'>Detail Masyarakat</h3>
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
								  <b>Kelurahan</b> <label class='pull-right'>$masyarakat[kelurahan]
								</li>
								
							  </ul>
							  <input class='btn btn-primary btn-block' type=button value=Kembali onclick=self.history.back()>
							  
							</div><!-- /.box-body -->
						</div><!-- /.box -->
					</div>
					<div class='col-md-9'>	
						<div class='nav-tabs-custom'>
							<ul class='nav nav-tabs'>
								<li class='active'><a href='#activity' data-toggle='tab'>Profil Lengkap</a></li>
								
							</ul>	
								
								<div class='tab-content'>
									<div class='active tab-pane' id='activity'>
										<div class='post'>
											
										
										 
											<p><label class='col-sm-2 control-label'>No KK</label> $masyarakat[no_kk] </p>     		
											<p><label class='col-sm-2 control-label'>NIK</label> $masyarakat[nik]<br> </p>   		
											<p><label class='col-sm-2 control-label'>No BPJS</label>  $masyarakat[no_bpjs]<br></p>      
											<p><label class='col-sm-2 control-label'>RT</label> $masyarakat[rt]<br></p>";  		
											
											
												echo"
											
														
											<p><label class='col-sm-2 control-label'>Jenis Kelamin</label> $masyarakat[jenis_kelamin]<br></p>     		
											<p><label class='col-sm-2 control-label'>Tanggal Lahir</label> $masyarakat[tgl_lahir]<br> </p>   		
											<p><label class='col-sm-2 control-label'>Tempat Lahir</label> $masyarakat[tempat_lahir] <br></p>      		
											<p><label class='col-sm-2 control-label'>No. HP</label> $masyarakat[no_hp] <br></p>      		
											<p><label class='col-sm-2 control-label'>Foto Rumah</label><a href='$masyarakat[foto_rumah]'target='_blank'>$masyarakat[foto_rumah]</a> <br></p>    
											<p><label class='col-sm-2 control-label'>Link Google Maps</label><a href='$masyarakat[link_gmap]'target='_blank'>$masyarakat[link_gmap]</a> <br></p>
										   		
		
										</div>	
								
								    </div>
									
						</div>
					</div>
				
				</div>
			</div>";
	  
	  
    }
    elseif ($_SESSION[leveluser]=='pengajar'){
       $detail=mysql_query("SELECT * FROM masyarakat WHERE id_masyarakat='$_GET[id]'");
       $masyarakat=mysql_fetch_array($detail);
       $tgl_lahir   = tgl_indo($masyarakat[tgl_lahir]);

       $get_kecamatan = mysql_query("SELECT * FROM kecamatan WHERE id_kecamatan = '$masyarakat[id_kecamatan]'");
       $kecamatan = mysql_fetch_array($get_kecamatan);

       echo "<form><fieldset>
             <legend>Detail masyarakat</legend>
             <dl class='inline'>
       <table id='table1' class='gtable sortable'>
          <tr><td rowspan='15'>";if ($masyarakat['foto']!=''){
              echo "<ul class='photos sortable'>
                    <li>
                    <img src='../foto_masyarakat/medium_$masyarakat[foto]'>
                    <div class='links'>
                    <a href='../foto_masyarakat/medium_$masyarakat[foto]' rel='facebox'>View</a>
                    <div>
                    </li>
                    </ul>";
          }echo "</td><td>iddtks</td>        <td> : $masyarakat[iddtks]</td></tr>
          <tr><td>Nama</td>               <td> : $masyarakat[nama_lengkap]</td></tr>          
          <tr><td>kecamatan</td>              <td> : <a href=?module=kecamatan&act=detailkecamatan&id=$masyarakat[id_kecamatan]>$kecamatan[nama]</td></tr>
          <tr><td>Jabatan</td>            <td> : $masyarakat[jabatan]</td></tr>
          <tr><td>alamat</td>             <td> : $masyarakat[alamat]</td></tr>
          <tr><td>Tempat Lahir</td> <td> : $masyarakat[tempat_lahir]</td></tr>
          <tr><td>Tanggal Lahir</td><td> : $tgl_lahir</td></tr>";
          if ($masyarakat[jenis_kelamin]=='P'){
           echo "<tr><td>Jenis Kelamin</td>     <td>  : Perempuan</td></tr>";
            }
            else{
           echo "<tr><td>Jenis kelamin</td>     <td> :  Laki - Laki </td></tr>";
            }echo"
          <tr><td>Agama</td>              <td> : $masyarakat[agama]</td></tr>
          <tr><td>Nama Ayah/Wali</td>     <td> : $masyarakat[nama_ayah]</td></tr>
          <tr><td>Nama Ibu</td>           <td> : $masyarakat[nama_ibu]</td></tr>
          <tr><td>Tahun Masuk</td>        <td> : $masyarakat[th_masuk]</td></tr>
          <tr><td>E-Mail</td>             <td> : <a href=mailto:$masyarakat[email]>$masyarakat[email]</a></td></tr>
          <tr><td>No.Telp/Hp</td>         <td> : $masyarakat[no_telp]</td></tr>
          <tr><td>Aksi</td>               <td> : <input type=button class='button small white' value=Kembali onclick=self.history.back()></td></tr>";
          echo"</table></dl></fieldset</form>";
    }
    elseif ($_SESSION[leveluser]=='masyarakat'){
       $detail=mysql_query("SELECT * FROM masyarakat WHERE id_masyarakat='$_GET[id]'");
       $masyarakat=mysql_fetch_array($detail);
       $tgl_lahir   = tgl_indo($masyarakat[tgl_lahir]);

       $get_kecamatan = mysql_query("SELECT * FROM kecamatan WHERE id_kecamatan = '$masyarakat[id_kecamatan]'");
       $kecamatan = mysql_fetch_array($get_kecamatan);

      echo"<br><b class='judul'>Detail masyarakat</b><br><p class='garisbawah'></p>
       <table>
             <tr><td rowspan='14'>";if ($masyarakat[foto]!=''){
              echo "<img src='foto_masyarakat/medium_$masyarakat[foto]'>";
          }echo "</td><td>nis</td>        <td> : $masyarakat[nis]</td></tr>
          <tr><td>Nama</td>               <td> : $masyarakat[nama_lengkap]</td></tr>          
          <tr><td>kecamatan</td>              <td> : $kecamatan[nama]</td></tr>
          <tr><td>alamat</td>             <td> : $masyarakat[alamat]</td></tr>
          <tr><td>Tempat Lahir</td> <td> : $masyarakat[tempat_lahir]</td></tr>
          <tr><td>Tanggal Lahir</td><td> : $tgl_lahir</td></tr>";
          if ($masyarakat[jenis_kelamin]=='P'){
           echo "<tr><td>Jenis Kelamin</td>     <td>  : Perempuan</td></tr>";
            }
            else{
           echo "<tr><td>Jenis kelamin</td>     <td> :  Laki - Laki </td></tr>";
            }echo"
          <tr><td>Agama</td>              <td> : $masyarakat[agama]</td></tr>
          <tr><td>Nama Ayah/Wali</td>     <td> : $masyarakat[nama_ayah]</td></tr>
          <tr><td>Nama Ibu</td>           <td> : $masyarakat[nama_ibu]</td></tr>
          <tr><td>Tahun Masuk</td>        <td> : $masyarakat[th_masuk]</td></tr>
          <tr><td>E-Mail</td>             <td> : <a href=mailto:$masyarakat[email]>$masyarakat[email]</a></td></tr>
          <tr><td>No.Telp/Hp</td>         <td> : $masyarakat[no_telp]</td></tr>
          <tr><Td>Jabatan</td>            <td> : $masyarakat[jabatan]</td></tr>";
          echo"<tr><td colspan='3'><input type=button class='tombol' value='Kembali'
          onclick=self.history.back()></td></tr></table>";

    }
    break;

case "detailprofilmasyarakat":
    if ($_SESSION[leveluser]=='masyarakat'){
       $detail=mysql_query("SELECT * FROM masyarakat WHERE id_masyarakat='$_GET[id]'");
       $masyarakat=mysql_fetch_array($detail);
       $tgl_lahir   = tgl_indo($masyarakat[tgl_lahir]);

       $get_kecamatan = mysql_query("SELECT * FROM kecamatan WHERE id_kecamatan = '$masyarakat[id_kecamatan]'");
       $kecamatan = mysql_fetch_array($get_kecamatan);

      echo"<br><b class='judul'>Detail masyarakat</b><br><p class='garisbawah'></p>
       <table>
             <tr><td rowspan='14'>";if ($masyarakat[foto]!=''){
              echo "<img src='foto_masyarakat/medium_$masyarakat[foto]'>";
          }echo "</td><td>nis</td>        <td> : $masyarakat[nis]</td></tr>
          <tr><td>Nama</td>               <td> : $masyarakat[nama_lengkap]</td></tr>
          <tr><td>kecamatan</td>              <td> : $kecamatan[nama]</td></tr>
          <tr><td>alamat</td>             <td> : $masyarakat[alamat]</td></tr>
          <tr><td>Tempat Lahir</td> <td> : $masyarakat[tempat_lahir]</td></tr>
          <tr><td>Tanggal Lahir</td><td> : $tgl_lahir</td></tr>";
          if ($masyarakat[jenis_kelamin]=='P'){
           echo "<tr><td>Jenis Kelamin</td>     <td>  : Perempuan</td></tr>";
            }
            else{
           echo "<tr><td>Jenis kelamin</td>     <td> :  Laki - Laki </td></tr>";
            }echo"
          <tr><td>Agama</td>              <td> : $masyarakat[agama]</td></tr>
          <tr><td>Nama Ayah/Wali</td>     <td> : $masyarakat[nama_ayah]</td></tr>
          <tr><td>Nama Ibu</td>           <td> : $masyarakat[nama_ibu]</td></tr>
          <tr><td>Tahun Masuk</td>        <td> : $masyarakat[th_masuk]</td></tr>
          <tr><td>E-Mail</td>             <td> : <a href=mailto:$masyarakat[email]>$masyarakat[email]</a></td></tr>
          <tr><td>No.Telp/Hp</td>         <td> : $masyarakat[no_telp]</td></tr>
          <tr><td>Jabatan</td>            <td> : $masyarakat[jabatan]</td></tr>";
          echo"<tr><td colspan='3'><input type=button class='tombol' value='Edit Profil' onclick=\"window.location.href='?module=masyarakat&act=editmasyarakat&id=$masyarakat[id_masyarakat]';\"></td></tr></table>";
    }
    break;

case "detailaccount":
    if ($_SESSION[leveluser]=='masyarakat'){
        $detail=mysql_query("SELECT * FROM masyarakat WHERE id_masyarakat='$_GET[id]'");
        $masyarakat=mysql_fetch_array($detail);
        echo"<form method=POST action=$aksi_masyarakat?module=masyarakat&act=update_account_masyarakat>";
        echo"<br><b class='judul'>Edit Account Login</b><br><p class='garisbawah'></p>
        <table>
        <tr><td>Username</td><td>:<input type=text name='username' size='40'></td></tr>
        <tr><td>Password</td><td>:<input type=password name='password' size='40'></td></tr>
        <tr><td colspan=2>*) Apabila Username tidak diubah di kosongkan saja.</td></tr>
        <tr><td colspan=2>**) Apabila Password tidak diubah di kosongkan saja.</td></tr>
        <tr><td colspan=2><input type=submit class='tombol' value='Update'></td></tr>
        </table>";
    }
    break;
}
}
?>
