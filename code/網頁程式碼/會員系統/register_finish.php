<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("db.php");

$id = $_POST['id'];
$pw = $_POST['pw'];
$pw2 = $_POST['pw2'];
$telephone = $_POST['telephone'];
$address = $_POST['address'];

//判斷帳號密碼是否為空值
//確認密碼輸入的正確性
if($id != null && $pw != null && $pw2 != null && $pw == $pw2)
{
        //新增資料進資料庫語法
        $sql = "insert into member_table (username, password, telephone, address) values ('$id', '$pw', '$telephone', '$address')";
        if(mysql_query($sql))
        {
                echo '註冊成功!妥善保管個人的帳號及密碼!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
        }
        else
        {
                echo '註冊失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
        }
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>