<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<title>欢迎</title>
	<link rel="stylesheet" type="text/css" href="resources/css/main.css" />
	<link rel="stylesheet" type="text/css" href="resources/css/manager.css" />
	<script src="resources/javascript//seajs/sea.js"
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
				
				<?php
					$count = count ( $users );
					for($i = 0; $i < $count; $i++ ) {
						echo '<tr><td>';
						echo '<input type="checkbox" name="du[]">';
						echo '</td><td>';
						echo $users[$i]->user_id;
						echo '</td><td>';
						echo $users[$i]->username;
						echo '</td><td>';
						echo '<input type="text" name="starttime[]" value = '. $users[$i]->start_time .'>';
						echo '</td><td>';
						echo '<input type="text" name="endtime[]" value = '. $users[$i]->end_time .'>';
						echo '</td></tr>';
					}
				?>
			</tbody>
			<tfoot>
				<tr style="background-color:#CDC9C9"><td><input type="checkbox"></td><td>全部选择</td><td></td><td></td><td><button onclick="window.location='manager/user'">add new staff</button></td></tr>
			</tfoot>
		</table>
		
	</div>

</body>
</html>