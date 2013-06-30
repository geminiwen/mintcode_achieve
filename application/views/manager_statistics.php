<!DOCType html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<title>查询</title>
	<base href="<?=$this->config->item('base_url')?>" />
	<link rel="stylesheet" type="text/css" href="resources/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="resources/css/main.css" />
	<link rel="stylesheet" type="text/css" href="resources/css/query.css" />
	
</head>
<body>
	<div class="QueryContainer">
	<div class="input-prepend"><span class="add-on">开始日期:</span>
							   <input id="startDate" class="Wdate" type="text" onclick="WdatePicker()" ></div>
	<div class="input-prepend"><span class="add-on">结束日期</span>
							   <input id="endDate" class="Wdate" type="text" onclick="WdatePicker()" ></div>
	<div><button class="btn btn-primary" id="doQuery">查询</button>
		 <button class="btn" onclick="location.replace('/manager')">返回</a>
	</div>
	</div>
	<div id="userinfo"></div>
	<table id="dateTable" style="display:none" class="QueryTable table table-bordered table-hover">
		<thead><tr><th>姓名</th><th>上班打卡</th><th>下班打卡</th><th>上班打卡异常</th><th>下班打卡异常</th><th>备注</th></tr></thead>
		<tbody></tbody>
		<tfoot></tfoot>
	</table>
	<div id="information"></div>
	<script type="text/javascript" src="resources/javascript/datepicker/WdatePicker.js"></script>
	<script src="resources/javascript/seajs/sea.js"
				data-config="use/config.js"
				data-main="use/manager_statistics.js"></script>
</body>
</html>