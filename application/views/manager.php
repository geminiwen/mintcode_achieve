<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<title>欢迎</title>
	<link rel="stylesheet" type="text/css" href="/resources/css/main.css" />
	<link rel="stylesheet" type="text/css" href="/resources/css/manager.css" />
	<script src="/resources/javascript/seajs/sea.js"
			data-config="use/config.js"
			data-main="use/index.js"></script>
</head>
<body>
	<?php include 'resources/template/manager_header.php'; ?>

	<div>
		<table >
			<thead>
				<tr><th></th><th>编号</th><th>名字</th><th>上班时间</th><th>下班时间</th></tr>
			</thead>
			<tbody>
				{users}
				<tr>
					<td><input type="checkbox" name="du[]" class="checkToDelete" value="{user_id}"></td>
					<td>{user_id}</td>
					<td><a href="/query/single?action=indicate&user_name={username}">{username}</a></td>
					<td><input type="text" name="starttime[]" value='{start_time}'></td>
					<td><input type="text" name="endtime[]" value='{end_time}'></td>
				</tr>
				{/users}
				
			</tbody>
			<tfoot>
				<tr style="background-color:#CDC9C9"><td><input type="checkbox" id="checkAll"></td><td><input type="submit" value="全部删除" id="deleteAll"></td><td></td><td id="infomation"></td><td><button onclick="window.location='manager/user'">添加新成员</button></td></tr>
			</tfoot>
		</table>
		
	</div>

</body>
</html>