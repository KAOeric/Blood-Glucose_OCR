<?php session_start(); ?>
<!--上方語法為啟用session，此語法要放在網頁最前方-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//連接資料庫
//只要此頁面上有用到連接MySQL就要include它
include("db.php");
date_default_timezone_set("Asia/Taipei");
$logintime= date("Y-m-d H:i:s");
$員工代碼 = $_POST['s_no'];
$密碼 = $_POST['s_password'];

//搜尋資料庫資料
$sql = "SELECT 員工代碼,員工密碼,本次登入時間,登入次數,員工姓名,單位代碼,使用,Role FROM staffjoin where 員工代碼 = '$員工代碼'";
$result = mysql_query($sql);
$row = @mysql_fetch_array($result);
$logincount=$row['登入次數']+1;		//增加登入次數
//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員

if($員工代碼 != null && $密碼 != null && $row['員工代碼'] == $員工代碼 && $row['員工密碼'] == $密碼)
	{
		if($row['使用']=='true'){
        //將帳號寫入session，方便驗證使用者身份
        $_SESSION['員工代碼'] = $員工代碼;
		$_SESSION['員工姓名'] = $row['員工姓名'];
		$_SESSION['員工單位代碼'] = $row['單位代碼'];
		$_SESSION['role'] = $row['Role'];
        echo '登入成功!!<br />本次為你第'.$logincount."次登入<br />現在時間:".$logintime;
		$sql2="UPDATE staffjoin SET 登入次數='$logincount' , 本次登入時間='$logintime' where 員工代碼 = '$員工代碼'";
		$result2 = mysql_query($sql2);
		if(!@$result2)
       		die("登入次數增加失敗或登入時間修改失敗");
        echo '<meta http-equiv=REFRESH CONTENT=1;url=staffWork.php>';
		}
		else{
			echo "你的帳號尚未授權,請通知員工授權!";
			echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';	
		}
	}
	else
	{
        echo '登入失敗!<br>'.$row['員工代碼'].'<br>'.$員工代碼.'<br>'.$row['員工密碼'].'<br>'.$密碼;
        echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
	}

?>