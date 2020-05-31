<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>註冊中</title>
<?php
if(isset($_SESSION['查代碼'])){
	unset($_SESSION['查代碼']);
}
date_default_timezone_set("Asia/Taipei");
include("db.php");
$S_ucode = $_POST['S_ucode'];
$S_ucname = $_POST['S_ucname'];
$S_no = $_POST['S_no'];
$S_password = $_POST['S_password'];
$S_password2 = $_POST['S_password2'];
$S_name = $_POST['S_name'];
$S_level= $_POST['S_level'];
$S_exphone = $_POST['S_exphone'];
$S_cellphone = $_POST['S_cellphone'];
$S_fastphone = $_POST['S_fastphone'];
$S_email = $_POST['S_email'];
$S_birthday =$_POST['S_birthday'];
$S_sex = @$_POST['RadioGroup1'];
$備註= $_POST['備註'];
//$S_admin = $_POST['RadioGroup2'];
$S_jointime= date("Y-m-d H:i:s");

$sucess=1;
$wrongmes="註冊失敗!原因: \n";
//搜尋會員資料庫看帳號是否已經用過
$sqls="SELECT 員工代碼 FROM refrigerator.staffjoin where 員工代碼='$S_no'";
$results = mysql_query($sqls);
if (mysql_num_rows($results) > 0){
	$wrongmes.="員工代碼已申請過! \n";
	$sucess=0;
}
//判斷密碼是否為空值
if(($S_password==null) or ($S_password2==null)){
	$wrongmes.="密碼尚未輸入! \n";
	$sucess=0;
}
//判斷兩次密碼是否一樣
if($S_password!=$S_password2){
	$wrongmes.="兩次密碼輸入不一致! \n";
	$sucess=0;
}
//判斷姓名是否輸入
if($S_name==null ){
	$wrongmes.="姓名尚未輸入! \n";
	$sucess=0;
}
//判斷信箱
if (preg_match('/^([_.0-9a-z]+)@([0-9a-z]+).([_.0-9a-z]+)$/i',$S_email) == false) { //i為大小寫都可
	$wrongmes.="信箱輸入錯誤! \n";
	$sucess=0;
}


//判斷帳號密碼是否為空值
//確認密碼輸入的正確性

if($sucess)
{
        //新增資料進資料庫語法
        $sqli = "insert into refrigerator.staffjoin (單位代碼,單位名稱,員工代碼,員工密碼,員工姓名,員工職稱,院內分機,員工手機,員工速撥碼,員工信箱,員工生日,員工性別,備註,員工加入時間,使用,Role) values ('$S_ucode','$S_ucname','$S_no', '$S_password', '$S_name','$S_level','$S_exphone', '$S_cellphone', '$S_fastphone', '$S_email', '$S_birthday','$S_sex','$備註' ,'$S_jointime', 'false', '1')";
        
		if(mysql_query($sqli))
        {
                echo '註冊成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
				echo "<script> alert('註冊成功\\n權限\審核中,請聯絡管理者開放權限!\\n院內分機:32555') </script>";
        }
        else
        {
                echo '註冊失敗1----!';
				echo "<script> alert('註冊失敗1---!請重新註冊!');history.back();</script>";  
        }
}
else
		{
			echo "註冊失敗2!<br />畫面跳轉中<br />請稍後..."; ?>
			<script>//跳出訊息視窗 並顯示錯誤原因
			var str = <?php echo json_encode($wrongmes) ?>;
			alert(str);
			history.back();
       		 </script>
        	<?php 
		}
?>