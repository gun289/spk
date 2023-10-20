
<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href=../css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
}
else{

$aksi="modul/mod_admin/aksi_admin.php";
switch($_GET[act]){
  // Tampil User
  default:
    if ($_SESSION[leveluser]=='admin'){
      $tampil_admin = mysql_query("SELECT * FROM admin ORDER BY username");
	  ?>
	   <div class="box box-primary box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Administrator</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class="box-body">
					<a  class ='btn  btn-success btn-flat' href='?module=admin&act=tambahadmin'>Tambah Administrator </a>
					<br><br><br>
					<table id="example1" class="table table-bordered table-striped" >
						<thead>
							<tr>
								<th>No</th>
								<th>Username</th>
								<th>Nama</th>
								
								<th>Level</th>
								<th>Alamat</th>
								<th>Email</th>
								<th>Telp/HP</th>
								<th>Blokir</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							$no=1;
							while ($r=mysql_fetch_array($tampil_admin)){
							   echo "<tr><td>$no</td>
									 <td>$r[username]</td>
									 <td>$r[nama_lengkap]</td>
									 <td>$r[level]</td>  
									 <td>$r[alamat]</td>
										 <td><a href=mailto:$r[email]>$r[email]</a></td>
										 <td>$r[no_telp]</td>
										 <td align=center>$r[blokir]</td>
									 <td><a href='?module=admin&act=editadmin&id=$r[id_session]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a></td></tr>";
							  $no++;
							}
						echo "</tbody></table>";
					?>
				</div>
			</div>	
		
	  
	  <?php
    }
    else{
      echo "<link href=../css/style.css rel=stylesheet type=text/css>";
      echo "<div class='error msg'>Anda tidak berhak mengakses halaman ini.</div>";
    }
    break;

 

  case "tambahadmin":
    if ($_SESSION[leveluser]=='admin' ){
			echo "
		  <div class='box box-primary box-solid'>
				<div class='box-header with-border'>
					<h3 class='box-title'>Tambah Data Administrator</h3>
					<div class='box-tools pull-right'>
						<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class='box-body'>
						<form method=POST action='$aksi?module=admin&act=input_admin' class='form-horizontal'>
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Username</label>        		
									 <div class='col-sm-4'>
										<input type=text name='username' class='form-control' Placeholder='Username' required='required'>
									 </div>
							  </div>
							  
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Password</label>        		
									 <div class='col-sm-3'>
										<input type=text name='password' class='form-control' Placeholder='Password' required='required'>
									 </div>
							  </div>
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Nama Lengkap</label>        		
									 <div class='col-sm-6'>
										<input type=text name='nama_lengkap' class='form-control' Placeholder='nama_lengkap' required='required'>
									 </div>
							  </div>
							   <div class='form-group'>
									<label class='col-sm-2 control-label'>Alamat</label>        		
									 <div class='col-sm-6'>
										<input type=text name='alamat' class='form-control' Placeholder='alamat' required='required'>
									 </div>
							  </div>
							  
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Email</label>        		
									 <div class='col-sm-4'>
										<input type=text name='email' class='form-control' Placeholder='Email' required='required'>
									 </div>
							  </div>
							  
							   <div class='form-group'>
									<label class='col-sm-2 control-label'>Telp/HP</label>        		
									 <div class='col-sm-4'>
										<input type=text name='no_telp' class='form-control' Placeholder='No Telepon' required='required'>
									 </div>
							  </div>
							   
							 <div class='form-group'>
									<label class='col-sm-2 control-label'>Level</label>        		
									 <div class='col-sm-4'>
										<select name='level' class='form-control'> 
											<option value='admin'>Administrator</option>
										</select>
									 </div>
							  </div>
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Blokir</label>        		
									 <div class='col-sm-4'>
										<input type=radio name='blokir' value='Y' checked>Y 
										<input type=radio name='blokir' value='N'> N
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
    else{
      echo "<link href=../css/style.css rel=stylesheet type=text/css>";
      echo "<div class='error msg'>Anda tidak berhak mengakses halaman ini.</div>";
    }
     break;

  
  case "editadmin":
    $edit=mysql_query("SELECT * FROM admin WHERE id_session='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    if ($_SESSION[leveluser]=='admin'){
    echo "
		  <div class='box box-primary box-solid'>
				<div class='box-header with-border'>
					<h3 class='box-title'>Tambah Data Administrator</h3>
					<div class='box-tools pull-right'>
						<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    </div><!-- /.box-tools -->
				</div>
				<div class='box-body'>
						<form method=POST action='$aksi?module=admin&act=update_admin' class='form-horizontal'>
							  <input type=hidden name=id value='$r[id_session]'>
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Username</label>        		
									 <div class='col-sm-4'>
										<input type=text name='username' class='form-control' Placeholder='Username' value='$r[username]'>
									 </div>
							  </div>
							  
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Password</label>        		
									 <div class='col-sm-3'>
										<input type=text name='password' class='form-control' Placeholder='Password' >
										<small>Apabila password tidak diubah, dikosongkan saja.</small>
									</div>
							  </div>
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Nama Lengkap</label>        		
									 <div class='col-sm-6'>
										<input type=text name='nama_lengkap' class='form-control' Placeholder='nama_lengkap' value='$r[nama_lengkap]'>
									 </div>
							  </div>
							   <div class='form-group'>
									<label class='col-sm-2 control-label'>Alamat</label>        		
									 <div class='col-sm-6'>
										<input type=text name='alamat' class='form-control' Placeholder='alamat' value='$r[alamat]'>
									 </div>
							  </div>
							  
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Email</label>        		
									 <div class='col-sm-4'>
										<input type=text name='email' class='form-control' Placeholder='Email' value='$r[email]'>
									 </div>
							  </div>
							  
							   <div class='form-group'>
									<label class='col-sm-2 control-label'>Telp/HP</label>        		
									 <div class='col-sm-4'>
										<input type=text name='no_telp' class='form-control' Placeholder='No Telepon' value='$r[no_telp]'>
									 </div>
							  </div>
							   
							 <div class='form-group'>
									<label class='col-sm-2 control-label'>Level</label>        		
									 <div class='col-sm-4'>
										<select name='level' class='form-control'> 
											<option value='admin'>Administrator</option>
										</select>
									 </div>
							  </div>
							  <div class='form-group'>
									<label class='col-sm-2 control-label'>Blokir</label>        		
									 <div class='col-sm-4'>
										<input type=radio name='blokir' value='Y' checked>Y 
										<input type=radio name='blokir' value='N'> N
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
    else{
      echo "<link href=../css/style.css rel=stylesheet type=text/css>";
      echo "<div class='error msg'>Anda tidak berhak mengakses halaman ini.</div>";
    }
    break;

 


}
}
?>
