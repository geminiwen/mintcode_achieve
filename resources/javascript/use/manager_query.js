define(function(require){
	var $ = require("jquery");
	
	var TimeUtil = require('./date_util');
	
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
		
		function overtimeCalculate(ele) {
			var check_end = ele['end_time'];
			var user_end  = ele['user_endtime'];
			
			var formattedCheckEnd = new TimeUtil(check_end);
			var formattedUser     = new TimeUtil(user_end);
		
			var diff = formattedUser.diff(formattedCheckEnd);
			
			var flag = false;
			for(var _f in diff) {
				var _t = diff[_f];
				if( _t < 0 ) {
					flag = true;
				}
			}

			if( flag ) {
				return "00:00:00";
			}
				
			return TimeUtil.toTimeString(diff);
	
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

			$(tbody).empty();
			for( var i = 0; i < count; i ++ ) {
				var ele = data[i];
				$("<tr></tr>").append("<td>"+ele['username']+"</td>")
							  .append("<td>"+ele['user_starttime']+"</td>")
							  .append("<td>"+handleStartTime(ele)+"</td>")
							  .append("<td>"+ele['user_endtime']+"</td>")
							  .append("<td>"+handleEndTime(ele)+"</td>")
							  .append("<td>"+ele['check_date']+"</td>")
							  .append("<td>"+overtimeCalculate(ele)+"</td>") 
							  .appendTo(tbody);
			}
		} else {
			$('#information').html(result['message']);
		}
		
	};

	function handleErrorData( xhr, textStatus, error ) {
		$('#information').html(xhr.responseText);
		var tbody = $('#dateTable>tbody');
		var userinfo = result['userinfo'];
		$(tbody).empty();
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
