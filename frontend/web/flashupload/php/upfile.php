<?php
Session_start(); 
$name = $_SESSION['uid'].'.png';
$file_src = "src.png"; 
$filename162 = "1.png"; 
$filename48 = "2.png"; 
$filename20 = "3.png";  
// $filename162 = ''
// $filename48 ="upload/2/".$name; 
// $filename20 = "upload/3/".$name;



$src=base64_decode($_POST['pic']);
$pic1=base64_decode($_POST['pic1']);   
$pic2=base64_decode($_POST['pic2']);  
$pic3=base64_decode($_POST['pic3']);  

if($src) {
	file_put_contents($file_src,$src);
}

file_put_contents($filename162,$pic1);
file_put_contents($filename48,$pic2);
file_put_contents($filename20,$pic3);

copy('1.png','../../avatar/1/'.$name);
copy('2.png','../../avatar/2/'.$name);
copy('3.png','../../avatar/3/'.$name);


$rs['status'] = 1;

echo json_encode($rs);

?>
