<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>登陆</title>
<link rel="stylesheet" type="text/css" href="resources/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="resources/css/main.css" />
<link rel="stylesheet" type="text/css" href="resources/css/login.css" />
</head>
<body>
	<form action="/user/login" method="post">
		<fieldset>
			<legend>登陆</legend>
			<table>
				<tbody>
					<tr><td>用户名:</td><td><input type="text" name="username" ></td></tr>
					<tr><td>密码:</td><td><input type="password" name="password" ></td></tr>
					<tr><td colspan="2"><input type="submit" value="登陆" class="btn btn-primary" /></td></tr>
				</tbody>
			</table>
		</fieldset>
	</form>
</body>
</html>
