<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<title>查询</title>
	<link rel="stylesheet" type="text/css" href="/resources/css/main.css" />
	<link rel="stylesheet" type="text/css" href="/resources/css/query.css" />
	<script src="/resources/javascript/seajs/sea.js"
			data-config="use/config.js"
			data-main="use/query.js"></script>
</head>
<body>

	<table class="QueryTable">
		<tr><td>起始日期:</td><td><input name="start_date" id="startDate" class="Wdate" onclick="WdatePicker()"></td><td>终止日期:</td><td><input name="end_date" id="endDate" class="Wdate" onclick="WdatePicker()"></td></tr>
		<tr><td colspan="4"><button id="doQuery">查询</button></td></tr>
	</table>
	<div id="userinfo"></div>
	<table id="dateTable" style="display:none" class="QueryTable">
		<thead><tr><th>序号</th><th>上班时间</th><th>下班时间</th><th>日期</th><th>备注</th></tr></thead>
		<tbody> </tbody>
		<tfoot></tfoot>
	</table>
<script type="text/javascript" src="/resources/javascript/datepicker/WdatePicker.js" ></script></body>
</html>
