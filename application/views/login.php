<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>login</title>
<link rel="stylesheet" type="text/css" href="resources/css/main.css" />
<link rel="stylesheet" type="text/css" href="resources/css/login.css" />
</head>
<body>
	<form action="/user/login" method="post">
		<fieldset>
			<legend>Login</legend>
			<table>
				<tbody>
					<tr><td>username:</td><td><input type="text" name="username" ></td></tr>
					<tr><td>password:</td><td><input type="password" name="password" ></td></tr>
					<tr><td colspan="2"><input type="submit" value="login" /></td></tr>
				</tbody>
			</table>
		</fieldset>
	</form>
</body>
</html>