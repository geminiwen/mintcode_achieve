<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<title>查询</title>
	<link rel="stylesheet" type="text/css" href="/resources/css/main.css" />
	<link rel="stylesheet" type="text/css" href="/resources/css/query.css" />
	<script src="/resources/javascript/seajs/sea.js"
			data-config="use/config.js"
			data-main="use/manager_query.js"></script>
</head>
<body>

	<table class="QueryTable">
		<tr><td>日期:</td><td><input name="check_date" id="checkDate" class="Wdate" onclick="WdatePicker()"></td></tr>
		<tr><td><button id="doQuery">查询</button></td>
		    <td><a href="/manager">返回</a></td></tr>
	</table>
	<div id="userinfo"></div>
	<table id="dateTable" style="display:none" class="QueryTable">
		<thead><tr><th>姓名</th><th>上班时间</th><th>上班打卡</th><th>下班时间</th><th>下班打卡</th><th>日期</th><th>加班时间</th><th>备注</th></tr></thead>
		<tbody> </tbody>
		<tfoot></tfoot>
	</table>
	<div id="information"></div>
<script type="text/javascript" src="/resources/javascript/datepicker/WdatePicker.js"></script>
</body>
</html>
