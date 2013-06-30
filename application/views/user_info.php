<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>完善个人信息</title>
<base href="<?=$this->config->item('base_url')?>" />
<link rel="stylesheet" type="text/css" href="resources/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="resources/css/main.css" />
<link rel="stylesheet" type="text/css" href="resources/css/login.css" />
<script type="text/javascript" src="resources/javascript/lib/jquery-1.9.1.min.js"></script>
</head>
<body>
	<form action="user/change_password?action=change" method="post" id="changepwd">
		<fieldset>
			<legend>完善个人信息</legend>
			<table>
				<tbody>
					<tr><td>用户名:</td><td>{username}<input type="hidden" name="username" value="{username}" ></td></tr>
					<tr><td>密码:</td><td><input type="password" name="password" id="pwd" ></td></tr>
					<tr><td>确认密码:</td><td><input type="password" name="repassword" id="repwd" ></td></tr>
					<tr><td colspan="2"><input type="submit" value="确认" id="submit" /></td></tr>
				</tbody>
			</table>
		</fieldset>
	</form>
	<script type="text/javascript">
		$(document).ready(function() {
			var Form = function(pwd,repwd) {
				this.pwd = $(pwd);
				this.repwd = repwd && $(repwd);
			};

			Form.prototype.check = function () {
				var pwd = $(this.pwd);
				var repwd = $(this.repwd);
				if( pwd.val() == '' ) {
					alert('密码不能为空');
					pwd.focus();
					return false;
				}

				if( pwd.val().length < 6 ) {
					alert('密码长度不能小于6');
					pwd.focus();
					return false;
				}

				if( this.repwd ) {
					if( repwd.val() != pwd.val() ) {
						alert('两次密码不一致');
						pwd.val('');
						repwd.val('');
						pwd.focus();
						return false;
					}
				}

				return true;
			}

			var form = new Form('#pwd','#repwd');

			$('#submit').click(function() { 
				return form.check();
			});

		});

	</script>
</body>
</html>