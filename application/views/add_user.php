<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<title>欢迎</title>
	<link rel="stylesheet" type="text/css" href="/resources/css/main.css" />
	<link rel="stylesheet" type="text/css" href="/resources/css/manager.css" />
	<link rel="stylesheet" type="text/css" href="/resources/css/manager_user.css" />
	<script src="/resources/javascript//seajs/sea.js"
			data-config="use/config.js"
			data-main="use/index.js"></script>
</head>
<body>
	<?php include 'resources/template/manager_header.php'; ?>
	<form action="/manager/user?action=add_user" method="post">
		<table id="AddUserTable">
			<tr><td>用户名:</td><td><input type="text" name="username" ></td></tr>
			<tr><td>密码:</td><td><input type="password" name="password" ></td></tr>
			<tr><td>上班时间</td><td><input type="text" name="starttime" ></td></tr>
			<tr><td>下班时间</td><td><input type="text" name="endtime" ></td></tr>
			<tr><td colspan="2"><div><input type="submit" value="submit"><input type="reset" value="reset"></td></tr>
		</table>
	</form>
</body>
</html>