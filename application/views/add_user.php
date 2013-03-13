<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<title>欢迎</title>
	<link rel="stylesheet" type="text/css" href="/resources/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="/resources/css/main.css" />
	<link rel="stylesheet" type="text/css" href="/resources/css/manager.css" />
	<link rel="stylesheet" type="text/css" href="/resources/css/manager_user.css" />
	
</head>
<body>
	<?php include 'resources/template/manager_header.php'; ?>
	<div class="AddUserTable">
		<div class="AddUserRow"><input type="text" name="username" placeholder="真实姓名" ></div>
		<!-- <div class="AddUserRow"><input type="password" name="password" placeholder="密码" ></div> -->
		<div class="AddUserRow"><input type="text" name="starttime" placeholder="上班时间"  ></div>
		<div class="AddUserRow"><input type="text" name="endtime" placeholder="下班时间" ></div>
		<div><input type="button" id="submit" class="btn btn-primary" value="提交">
			 <input type="reset" class="btn" value="重置">
			 <input type="button" class="btn" onclick="location.replace('/manager')" value="返回" ></div>
	</div>

	<div id="modalDialog" class="modal hide fade" tabindex="-1" role="dialog">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			<h3>提示</h3>
		</div>
		<div class="modal-body">
			<p></p>
		</div>
	</div>

	<script type="text/javascript" src="/resources/javascript/datepicker/WdatePicker.js"></script>
	<script src="/resources/javascript/seajs/sea.js"
			data-config="use/config.js"
			data-main="use/add_user.js"></script>
</body>
</html>