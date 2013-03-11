define(function(require){
	var $ = require("jquery");
	
	function handleResponseData( result ) {
		var bSuccess = result['result'];

		function wrap(text) {
			return "<font color='red'>"+text+"</font>";
		}

		function handleStartTime(ele) {
			var unchecked = "<font color='red'>打卡时间晚于12:00</font>";
			if( ele['start_checked'] == '0' ) {
				return unchecked;
			}

			var start_time = ele['user_starttime'];

			if( ele['start_time'] > start_time ) {
				return wrap(ele['start_time']);
			}

			return ele['start_time'];

		}

		function handleEndTime(ele) {
			var unchecked = "<font color='red'>打卡时间早于12:00</font>";
			if( ele['end_checked'] == '0' ) {
				return unchecked;
			}

			var end_time = ele['user_endtime'];

			if( ele['end_time'] < end_time ) {
				return wrap(ele['end_time']);
			}

			return ele['end_time'];
		}

		if( bSuccess ) {
			$("#dateTable").show();
			var data = result['data'];
			var count = data.length;
			var tbody = $('#dateTable>tbody');
			var userinfo = result['userinfo'];

			$('#userinfo').html("<h1>名字："+userinfo['user_name']+"，上班时间："+userinfo['start_time']+"，下班时间："+userinfo['end_time']+"。</h1>");
			$(tbody).empty();
			for( var i = 0; i < count; i ++ ) {
				var ele = data[i];
				$("<tr></tr>").append("<td>"+ele['account_id']+"</td>")
							  .append("<td>"+ele['user_starttime']+"</td>")
							  .append("<td>"+handleStartTime(ele)+"</td>")
							  .append("<td>"+ele['user_endtime']+"</td>")
							  .append("<td>"+handleEndTime(ele)+"</td>")
							  .append("<td>"+ele['check_date']+"</td>")
							  .appendTo(tbody);
			}
		}
		
	};

	function handleErrorData( xhr, textStatus, error ) {
		$('#infomation').html(xhr.responseText);
	}

	$("#doQuery").click(function(){
		var checkDate	= $('#checkDate').val();

		if(checkDate == "") {
			$('#checkDate').focus();
			alert('参数不能为空');
			return;
		}

		var data = {
			"date" : checkDate
		};
		$.ajax({
			url:"/manager/query",
			method: "post",
			dataType:"json",
			data : data,
			success: handleResponseData,
			error: handleErrorData
		});
	});
});