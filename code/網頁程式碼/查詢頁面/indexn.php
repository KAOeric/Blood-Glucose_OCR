<!DOCTYPE HTML>
<html>
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>血糖紀錄-長期趨勢曲線</title>
		<script type="text/javascript"></script>
		<script type="text/javascript" src="../js/jquery.min-1.8.2.js"></script>
		<script src="./pikaday.js"></script>
		<link rel="stylesheet" href="./pikaday.css">
		
		
		<?php 
		include("../db.php");
		date_default_timezone_set("Asia/Taipei");
		?>
		
	<script>
	$(function () {
		$(document).ready(function() {
        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });
    
        var chart;
        $('#container').highcharts({
            chart: {
			    backgroundColor: {
				linearGradient: [110, 110, 110, 0],
				stops: [
					[0, 'rgb(255, 255, 255)'],
					[1, 'rgb(200, 200, 255)']
				    ]
			    },
                type: 'spline',
                animation: Highcharts.svg, // don't animate in old IE
                marginRight: 10,
                events: {
                    load: function() {
                        var series = this.series[0];
                    }
                }
            },
            title: {
                text: '血糖紀錄-長期趨勢'
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 100,
				//max: null
            },
            yAxis: {
			tickInterval: 1,
                title: {
                    text: '血糖值(Mg/dL)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
				
            },
			
            tooltip: {
			enabled: true,
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) +'<br/>'+
                        Highcharts.numberFormat(this.y, 2);
                }
            },
            legend: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            series: [{
                name: '血糖值',
				turboThreshold: 6000,
                data: (function() {
                    DBdata.reverse();
                    return DBdata;
                })()
            }]
        });
  
  });
    
});

	</script>
</head>
<body>
    <?php session_start(); 

    include("../db.php");

    if($_SESSION['username'] != null)
    {//將$_SESSION['廠商員工帳號']丟給$id
        //這樣在下SQL語法時才可以給搜尋的值
        $id = $_SESSION['username'];
        $sql = "SELECT * FROM member_table where username='$id'";
        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);
		}
    ?>
	<script src="../js/highchartsNEW.js"></script>
	<script src="../js/modules/exporting.js"></script>
	<body background="11111.jpg" style="background-repeat:no-repeat; background-position:center top;">
	<font size="11" style="text-shadow:3px 3px 3px #27408B;" color="FFB630" align="left"><b>血糖紀錄-長期趨勢</b></font><br><br>
	
	<?//php echo $row['username'];?>
	
    <a href="../update.php">修改</a>&nbsp;
	<a href="../delete.php">刪除</a>&nbsp; 
	<a href="../logout.php">登出</a><br>
	<body background="11111.jpg" style="background-repeat:no-repeat; background-position:center; background-position:30px 70px;">
	<form action="indexn.php" method="post" name="foem" >
		輸入帳號<input name="Ma_Account" type="text" value="<?php echo @$_POST['Ma_Account']?>" id="Ma_Account"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;正常人數值&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;糖尿病患目標<br>
		今天日期<input type="text" name="date1" value="<?php if(@$_POST['date1']!=''){echo $_POST['date1'];}else{echo date('Y-m-d');}?>" id="datepicker">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;空腹血糖值&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;低於 100 mg/dL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;80-130 mg/dL<br>
		選擇時段<select id="date2" name="date2" >
					<option value="365">年</option>
					<option value="0">月</option>
					<option value="12">週</option>
				</select>
				<input type="submit" value="查詢">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;飯後血糖值&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;低於 140 mg/dL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;低於 160 mg/dL<br><br><br>
				
	</form>
	<?php 
		
		
		if(isset($_POST['date1']) && isset($_POST['date2']) && $_POST['date1'] !='' && $_POST['date2']!='')
		{
			$date1=$_POST['date1'];
			$date2=$_POST['date2'];
			if($date2 == 0)
				{
				$show = '月';
				//echo date("Y-m-d\n",strtotime("-1 month"));
				$date2=date("Y-m-d\n",strtotime("-1 month"));
				$date1=date("Y-m-d 23:59:59\n");
				echo '<b>'.$date2.'~ '.$date1.' '.$show.'趨勢'.'</b><br>';
				$sql = "select max(Mg) from receiveparameter2 WHERE `username` ='".$_POST['Ma_Account']."' AND `Time` between "."'".$date2."'"." and "."'".$date1."'".""; 
                $rs = mysql_query($sql); 
                $row = mysql_fetch_array($rs);
                $sql2 = "select min(Mg) from receiveparameter2 WHERE `username` ='".$_POST['Ma_Account']."' AND `Time` between "."'".$date2."'"." and "."'".$date1."'".""; 
                $rs2 = mysql_query($sql2); 
                $row2 = mysql_fetch_array($rs2);
				}
			elseif($date2 == 12)
				{
				$show = '週';
				//echo date("Y-m-d\n",strtotime("-1 week"));
				$date2=date("Y-m-d\n",strtotime("-1 week"));
				$date1=date("Y-m-d 23:59:59\n");
				echo '<b>'.$date2.'~ '.$date1.' '.$show.'趨勢'.'</b><br>';
				$sql = "select max(Mg) from receiveparameter2 WHERE `username` ='".$_POST['Ma_Account']."' AND `Time` between "."'".$date2."'"." and "."'".$date1."'".""; 
                $rs = mysql_query($sql); 
                $row = mysql_fetch_array($rs);
                $sql2 = "select min(Mg) from receiveparameter2 WHERE `username` ='".$_POST['Ma_Account']."' AND `Time` between "."'".$date2."'"." and "."'".$date1."'".""; 
                $rs2 = mysql_query($sql2); 
                $row2 = mysql_fetch_array($rs2);
				}
			elseif($date2 == 365)
				{
				$show = '年';
				//echo date("Y-m-d\n",strtotime("-1 year"));
				$date2=date("Y-m-d\n",strtotime("-1 year"));
				$date1=date("Y-m-d 23:59:59\n");
				echo '<b>'.$date2.'~ '.$date1.' '.$show.'趨勢'.'</b><br>';
				}
                $sql = "select max(Mg) from receiveparameter2 WHERE `username` ='".$_POST['Ma_Account']."' AND `Time` between "."'".$date2."'"." and "."'".$date1."'".""; 
                $rs = mysql_query($sql); 
                $row = mysql_fetch_array($rs);
                $sql2 = "select min(Mg) from receiveparameter2 WHERE `username` ='".$_POST['Ma_Account']."' AND `Time` between "."'".$date2."'"." and "."'".$date1."'".""; 
                $rs2 = mysql_query($sql2); 
                $row2 = mysql_fetch_array($rs2);				
                echo '最大值: '.$row["0"].' mg/dL<br>';
				echo '最小值: '.$row2["0"].' mg/dL';
                				
		}
		elseif(isset($_POST['date1']) && isset($_POST['date2']) && isset($_POST['Ma_Account'])&& $_POST['date1'] !='' && $_POST['date2']=='' )
		{
			$date1=date('Y-m-d ');
			$date2=date('Y-m-d');
			$sql="SELECT `M_chname` FROM `machine` WHERE `M_Account`='".$_POST['Ma_Account']."'";
			$result = mysql_query($sql);
			$row = mysql_fetch_row($result);
			$date1=$_POST['date1'];
			$date2=date("Y-m-d\n",strtotime("-1 year"));
			echo '<p align="center"><b>'.$date2.'~ '.$date1.' '.'年趨勢'.'</b></p>';
		}
	
            //echo '<p><b>'.$date2.'</b></p>';			
            //echo $date1;			
    ?>

	<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
	<div id="container2" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
	<div id="container3" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
	<script>
	var h = <?php echo date('H');?>;
	if(h<12){
		document.getElementById('date2').value = '0';
	}else{
		document.getElementById('date2').value = '12';
	}
    var picker = new Pikaday(
    {
        field: document.getElementById('datepicker'),
        firstDay: 1,
        minDate: new Date('2015-07-01'),
        maxDate: new Date('2050-12-31'),
        yearRange: [2010,2050]
    }
	);
    </script>
	<script src="./pikaday.js"></script>
	
    <script>
    var picker = new Pikaday(
    {
        field: document.getElementById('datepicker2'),
        firstDay: 1,
        minDate: new Date('2015-07-01'),
        maxDate: new Date('2050-12-31'),
        yearRange: [2010,2050]
    }
	);
	</script>
</body>
</html>

<?php
//****Mg*******************************************************************
echo "<script>var DBdata = [],te = [];</script>\n";
echo "<script>";
	if(isset($_POST['date1']) && isset($_POST['date2']) && $_POST['date1'] !='' && $_POST['date2']!='')
	{
		$ma_account = $_POST['Ma_Account'];
		$num = $_POST['date2'];
		$selectQuery = "SELECT * FROM `receiveparameter2` WHERE `username`='$ma_account' AND `Time` between "."'".$date2."'"." and "."'".$date1."'"." ORDER BY `Time`";
		$result = mysql_query($selectQuery);
		//echo $selectQuery;
		while($row = mysql_fetch_array($result))
		{
			$dataTime = $row['Time'];
			$dataTime = new DateTime($dataTime);
			$dataTime = $dataTime->getTimestamp()*1000;
			//echo date("Y-m-d H:i:s",$dataTime->getTimestamp()) . "<br />"; continue;
			echo "DBdata.push({".        
					"x:" . $dataTime . " , ".
					"y:" . $row['Mg'].
				 "});";
			
		}
		echo "</script>";
		//echo '<div align="center"><a href="excel.php?a='.$selectQuery.'" class="btn btn-success btn-sm btn-lg active" >匯出Excel檔案</a></div>';
	}
	elseif(isset($_POST['date1']) && isset($_POST['date2']) && isset($_POST['Ma_Account'])&& $_POST['date1'] !='' && $_POST['date2']=='' )
		{
		$ma_account = $_POST['Ma_Account'];
		$date1 = $_POST['date1'];
		$date2 = $_POST['date2'];
		$selectQuery = "SELECT * FROM `receiveparameter2` WHERE `username`='$ma_account' AND `Time` between "."'".$date2."'"." and "."'".$date1."'"." ORDER BY `Time`";
		$result = mysql_query($selectQuery);
		//echo $selectQuery;
		while($row = mysql_fetch_array($result))
			{
			$dataTime = $row['Time'];
			$dataTime = new DateTime($dataTime);
			$dataTime = $dataTime->getTimestamp()*1000;
			//echo date("Y-m-d H:i:s",$dataTime->getTimestamp()) . "<br />"; continue;
			echo "DBdata.push({".        
					"x:" . $dataTime . " , ".
					"y:" . $row['Mg'].
				 "});";
			
			}
		echo "</script>";
		//echo '<div align="center"><a href="excel.php?a='.$selectQuery.'" class="btn btn-success btn-sm btn-lg active" >匯出Excel檔案</a></div>';
		}
	else{
		echo "</script>";
		}
	//echo $selectQuery;
	//echo mysql_num_rows($result);
	


//echo $selectQuery;
//echo mysql_num_rows($result);
function zero($num)
{
	if($num<10)
	{
		return "0".$num;
	}
	else
	{
		return $num;
	}
}
?>
