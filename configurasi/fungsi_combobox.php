<?php
function combotgl($awal, $akhir, $var, $terpilih){
  echo "<select name=$var class='form-control'>";
  for ($i=$awal; $i<=$akhir; $i++){
    $lebar=strlen($i);
    switch($lebar){
      case 1:
      {
        $g="0".$i;
        break;     
      }
      case 2:
      {
        $g=$i;
        break;     
      }      
    }  
    if ($i==$terpilih)
      echo "<option value=$g selected>$g</option>";
    else
      echo "<option value=$g>$g</option>";
  }
  echo "</select> ";
}

function combobln($awal, $akhir, $var, $terpilih){
  echo "<select name=$var >";
  for ($bln=$awal; $bln<=$akhir; $bln++){
    $lebar=strlen($bln);
    switch($lebar){
      case 1:
      {
        $b="0".$bln;
        break;     
      }
      case 2:
      {
        $b=$bln;
        break;     
      }      
    }  
      if ($bln==$terpilih)
         echo "<option value=$b selected>$b</option>";
      else
        echo "<option value=$b>$b</option>";
  }
  echo "</select> ";
}

function combothn($awal, $akhir, $var, $terpilih){
  echo "<select name=$var class='form-control'>";
  for ($i=$awal; $i<=$akhir; $i++){
    if ($i==$terpilih)
      echo "<option value=$i selected>$i</option>";
    else
      echo "<option value=$i>$i</option>";
  }
  echo "</select> ";
}

function combonamabln($awal, $akhir, $var, $terpilih){
  $nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei", 
                      "Juni", "Juli", "Agustus", "September", 
                      "Oktober", "November", "Desember");
  echo "<select name=$var class='form-control'>";
  for ($bln=$awal; $bln<=$akhir; $bln++){
      if ($bln==$terpilih)
         echo "<option value=$bln selected>$nama_bln[$bln]</option>";
      else
        echo "<option value=$bln>$nama_bln[$bln]</option>";
  }
  echo "</select> ";
}
function combokelas($awal, $akhir, $var, $terpilih){
  $nama_kls=array(1=> "Samarinda Ilir",  "Sungai Pinang");
  echo "<select name=$var class='form-control'>";
  for ($kls=$awal; $kls<=$akhir; $kls++){
      if ($kls==$terpilih)
         echo "<option value=$kls selected>$nama_kls[$kls]</option>";
      else
        echo "<option value=$kls>$nama_kls[$kls]</option>";
  }
  echo "</select> ";
}

?>
