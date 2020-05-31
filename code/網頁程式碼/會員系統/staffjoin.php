<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="zh-tw" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>員工功能</title>
<link href="css/table.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style1 {
	text-align: center;
	font-size: 45pt;
}
.style2 {
	text-align: center;
	font-size: 45pt;
	font-family: 標楷體;
}
.style3 {
	font-family: 標楷體;
}
.style4 {
	font-family: 標楷體;
	font-size: 26pt;
}
.style5 {
	font-size: 26pt;
}
body {
	background-image: url(image/bg266.gif);
	background-repeat: repeat;
}
.fancytable td{
	line-height:50px;
	}
.textbox2{
	font-size:50px;
}
</style>

<link href="css/button.css" rel="stylesheet" type="text/css" />
<link href="pikaday.css" rel="stylesheet" type="text/css" />

</head>
<body>
<div align="center">
<p class="style2">員工註冊</p>
<p class="style3">＊為必填項目</p>
<form name="form" method="post" action="staffjoin_finish.php" id="form">
<div class="sexyborder" >
<table width="100%" class="fancytable" style="font-size:40px;font-family:標楷體;">
  <tr>
    <td width="40%" class="dataroweven">單位代碼:*</td>
    <td width="60%" class="datarowodd" nowrap="nowrap"><div align="left">
      <input name="S_ucode" type="text" id="ucode" style="BORDER:0px; height:85%; width:50%; font-size:50px;"  />
     <input name="open" type="button" id="open" value="開新視窗" onClick="window.open('ucode_search.php');"/></div></td>
  </tr>
    <tr>
    <td width="40%" class="dataroweven">單位名稱:*</td><td width="60%" class="datarowodd" nowrap="nowrap">
    <div>
      <input name="S_ucname" type="text" id="ucname" style="BORDER:0px; height:85%; width:95%; font-size:50px;"  />
    </div></td>
  </tr>
  <tr> 
    <td class="dataroweven">員工代碼:*</td>
    <td class="datarowodd"><div align="left"><input name="S_no" type="text" id="S_account" style="BORDER:0px; height:85%; width:30%; font-size:50px;" /><b style="font-size:22px">此為登入帳號</b>
    </div>
    </td>
    </tr>
  <tr>
    <td class="dataroweven">密&nbsp;&nbsp;碼&nbsp;:*</td>
    <td class="datarowodd">
      <input name="S_password" type="password" class="textbox2"  id="S_password"/>
    </td>
  </tr>
  <tr>
    <td class="dataroweven">確認密碼:*</td>
    <td class="datarowodd">
      <input name="S_password2" type="password" class="textbox2"  id="S_password2" />
    </td>
  </tr>
  <tr>
    <td class="dataroweven">姓&nbsp;&nbsp;名&nbsp;:*</td>
    <td class="datarowodd">
      <input name="S_name" type="text" class="textbox2"  id="S_name" /></td>
  </tr>
  <tr>
    <td class="dataroweven">職&nbsp;&nbsp;稱&nbsp;&nbsp;:</td>
    <td class="datarowodd">
      <input name="S_level" type="text" class="textbox2"  id="S_level"/>
    </td>
  </tr>
  <tr>
    <td class="dataroweven">院內分機:</td>
    <td class="datarowodd">
      <input name="S_exphone" type="text" class="textbox2"  id="S_exphone" />
    </td>
  </tr>
  <tr>
    <td class="dataroweven">員工手機:</td>
    <td class="datarowodd">
      <input name="S_cellphone" type="text" class="textbox2"  id="S_cellphone"/>
    </td>
  </tr>
  <tr>
    <td class="dataroweven">速撥碼&nbsp;&nbsp;:</td>
    <td class="datarowodd">
      <input name="S_fastphone" type="text" class="textbox2"  id="S_fastphone" />
    </td>
  </tr>
  <tr>
    <td class="dataroweven">信&nbsp;&nbsp;箱&nbsp;:*</td>
    <td class="datarowodd">
      <input name="S_email" type="text" class="textbox2"  id="S_email"/>
    </td>
  </tr>
  <tr>
    <td class="dataroweven">照&nbsp;&nbsp;片&nbsp;&nbsp;:</td>
    <td class="datarowodd">登入後再自行上傳修改!</td>
  </tr>
  <tr>
    <td class="dataroweven" nowrap="nowrap">生&nbsp;&nbsp;日&nbsp;&nbsp;:</br>(yyyy-mm-dd)</td>
    <td class="datarowodd">
      <input name="S_birthday" type="text" class="textbox2" id="datepicker"  />
   </td>
  </tr>
  <tr>
    <td class="dataroweven">備&nbsp;&nbsp;註&nbsp;&nbsp;:</td>
    <td class="datarowodd">
      <textarea name="備註" cols="45" rows="5" class="textbox2" id="remark" >
</textarea>
    </td>
  </tr>
  <tr>
    <td class="dataroweven">性&nbsp;&nbsp;別&nbsp;&nbsp;:</td>
    <td class="datarowodd">
      <label>
        <input type="radio" name="RadioGroup1" value="M" id="RadioGroup1_0" />
        男</label>
      <label>
        <input type="radio" name="RadioGroup1" value="F" id="RadioGroup1_1"  />
        女</label>
    </td>
  </tr>
</table>
</div>
   		<div align="center">
           <input name="Submit1" type="submit" class="button" value="註冊" />
           &nbsp;
	  <input name="Submit2" type="button" class="button" onclick="self.location.href='index.php'" value="返回"  />
      </div>

</form>
</div>
</body>
</html>
    <script src="pikaday.js"></script>
    <script>
    var picker = new Pikaday(
	{
        field: document.getElementById('datepicker'),
        firstDay: 1,
        minDate: new Date('1950-01-01'),
        maxDate: new Date('2000-12-31'),
        yearRange: [1950,2000]
	}
	);
    </script>