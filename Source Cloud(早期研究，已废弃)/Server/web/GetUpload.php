<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>上传文件</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="js/style.css">
</head>
<?php
error_reporting(0);
if ($_GET['Session'] == NULL || $_GET['username'] == NULL)
{
	//header("location:error.html");
	//echo '<body style="display: none"><div class="container"><h2>上传文件</h2><form method="post" id="myForm" action="#" enctype="multipart/form-data">';
} else {
	$dou -> query("select * from login_status where username = '".$_GET['username']."' AND session ='".$_GET['Session']."'");
		if ($dou -> affected_rows() == NULL) 
		{
		//header("location:error.html");
		} 
	}	
?>	
    <body>
	<div class="container">
		<h2>上传文件</h2>
		<form method="post" id="myForm" action="upload.php" enctype="multipart/form-data">
    	<!-- 上传的表单 -->
        <input type="file" id="myFile" multiple>
        <!-- 上传的文件列表 -->
        <table id="upload-list">
            <thead>
            <tr>
                <th width="35%">文件名</th>
                <th width="15%">文件类型</th>
                <th width="15%">文件大小</th>
                <th width="20%">上传进度</th>
                <th width="15%">
                    <input type="button" id="upload-all-btn" value="全部上传">
                </th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </form>
    <!-- 上传文件列表中每个文件的信息模版 -->
    <script type="text/template" id="file-upload-tpl">
        <tr>
            <td>{{fileName}}</td>
            <td>{{fileType}}</td>
            <td>{{fileSize}}</td>
            <td class="upload-progress">{{progress}}</td>
            <td>
                <input type="button" class="upload-item-btn"  data-name="{{fileName}}" data-size="{{totalSize}}" data-state="default" value="{{uploadVal}}">
            </td>
        </tr>
    </script>
</div>

</body>
</html>
<script src="js/jquery.js"></script>
<script src="js/common.js"></script>
