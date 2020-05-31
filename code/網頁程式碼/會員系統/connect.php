<?php session_start(); ?>
<!--上方語法為啟用session，此語法要放在網頁最前方-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//連接資料庫
//只要此頁面上有用到連接MySQL就要include它
include("db.php");
$id = $_POST['id'];
$pw = $_POST['pw'];
//搜尋資料庫資料
$sql = "SELECT * FROM member_table where username = '$id'";
$result = mysql_query($sql);
$row = @mysql_fetch_row($result);

//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員
if($id != null && $pw != null && $row[0] == $id && $row[1] == $pw)
{
        //將帳號寫入session，方便驗證使用者身份
		
    $_SESSION['username'] = $id;
    if ($id == 'admin')
		{
        echo '登入成功!歡迎進入本系統!';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=../realtimesearch1020/indexn.php>';
		}
	else 
		{
		echo '登入成功!歡迎進入本系統!';
		echo '<meta http-equiv=REFRESH CONTENT=1;url=../realtimesearch1020/indexn1.php>';
		}
}
else
{
    echo '登入失敗!';
    echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}
?>