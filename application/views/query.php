<!DOCtype html>
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
		<input name="start_date" type="text" id="startDate" class="Wdate" onclick="WdatePicker()" placeholder="起始日期">
		<input name="end_date" id="endDate" class="Wdate" type="text" onclick="WdatePicker()" placeholder="终止日期">
		<div><button id="doQuery">查询</button></div>
	</table>
	<div id="userinfo"></div>
	<table id="dateTable" style="display:none" class="QueryTable table table-bordered table-hover">
		<thead><tr><th>序号</th><th>上班时间</th><th>下班时间</th><th>日期</th><th>备注</th></tr></thead>
		<tbody> </tbody>
		<tfoot></tfoot>
	</table>
	<script src="resources/javascript/seajs/sea.js"
				data-config="use/config.js"
				data-main="use/query.js"></script>
	<script type="text/javascript" src="resources/javascript/datepicker/WdatePicker.js" ></script>
</body>
</html>
