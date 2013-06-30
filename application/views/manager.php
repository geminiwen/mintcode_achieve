<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<title>欢迎</title>
	<base href="<?=$this->config->item('base_url')?>" />
	<link rel="stylesheet" type="text/css" href="resources/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="resources/css/main.css" />
	<link rel="stylesheet" type="text/css" href="resources/css/manager.css" />
</head>
<body>
	<?php include 'resources/template/manager_header.php'; ?>
	<form id="upload" action="timeline/upload" method="POST" enctype="multipart/form-data">
	<input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="300000">

		<div>
			<div id="filedrag" style="display: block;">将打卡文件拖放到这</div>
		</div>

	</form>
	<div>
		<table class="table-bordered table table-hover">
			<thead>
				<tr>
					<th></th>
					<th>编号</th>
					<th>名字</th>
					<th>上班时间</th>
					<th>下班时间</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				{users}
				<tr>
					<td><input type="checkbox" name="du[]" class="checkToDelete" value="{user_id}"></td>
					<td>{user_id}</td>
					<td><a href="/query/single?action=indicate&user_name={username}">{username}</a></td>
					<td><input type="text" class="starttime" name="starttime[]" value='{start_time}'></td>
					<td><input type="text" class="endtime" name="endtime[]" value='{end_time}'></td>
					<td><input type="button" class="save btn" value="保存更改" /><img src="resources/img/ajax-loader.gif" style="display:none;" /></td>
				</tr>
				{/users}
				
			</tbody>
			<tfoot>
				<tr style="background-color:#CDC9C9">
					<td><input type="checkbox" id="checkAll"></td>
					<td><input type="submit" class="btn" value="全部删除" id="deleteAll"></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tfoot>
		</table>

		<table style="margin:0 auto">
			<td><button class="btn btn-primary" onclick="location='manager/query_index/statistics'">统计</button></td>
			<td><button id="managerQuery" class="btn" onclick="location='manager/query_index'">查询</button></td>
			<td><button class="btn" onclick="window.location='manager/user'">添加新成员</button></td>
		</table>
		
	</div>
	
	<script src="resources/javascript/seajs/sea.js"
			data-config="use/config.js"
			data-main="use/index.js"></script>
</body>
</html>
