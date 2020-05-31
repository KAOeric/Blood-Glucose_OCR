<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("db.php");
$id = $_POST['id'];

if($_SESSION['username'] != null)
{
        $sql = "delete from member_table where username='$id'";
        if(mysql_query($sql))
        {
                echo '刪除成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
        }
        else
        {
                echo '刪除失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
        }
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=..\realtimesearch1020\indexn.php>';
}
?>