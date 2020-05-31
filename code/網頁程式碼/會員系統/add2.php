<?php 
header("Access-Control-Allow-Origin:*");
date_default_timezone_set("Asia/Taipei");
include("db.php");
$ma_no =$_POST['ma_no'];
//----MG血糖--
$mg = $_POST['mg'];
$ma_time = date('Y-m-d H:i:s');
$password = $_POST['password'];
$sqlYJ = "SELECT * FROM `member_table` WHERE `username` = '$ma_no'";
$reac = mysql_query($sqlYJ);
$rowac = @mysql_fetch_row($reac);
//echo $password.'=='.$rowac[2];
if($password == $rowac[2] && $rowac[2]!=''){
	$sql = "INSERT INTO `receiveparameter2`(`username`, `Mg`, `Time`) VALUES ('$ma_no','$mg','$ma_time');";
	if(mysql_query($sql)){
		echo'success';
	}
	else{
		echo 'dataerror';
	}
}else{
	echo 'passerror';
//	echo $ma_time;
	}
