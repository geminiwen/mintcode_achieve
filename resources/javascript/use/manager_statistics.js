define(function(require,exports,module){

	var $ = require("bootstrap");

	function handleResponseData( result ) {
		var bSuccess = result['result'];

		if( bSuccess ) {
			$("#dateTable").show();
			var data = result['data'];
			var count = data.length;
			var tbody = $('#dateTable>tbody');

			$(tbody).empty();
			for( var i = 0; i < count; i ++ ) {
				var ele = data[i];
				$("<tr></tr>").append("<td>"+ele['username']+"</td>")
							  .append("<td>"+ele['come']+"</td>")
							  .append("<td>"+ele['away']+"</td>")
							  .append("<td>"+ele['later_come']+"</td>")
							  .append("<td>"+ele['early_quit']+"</td>")
							  .append("<td></td>")
							  .appendTo(tbody);
			}

		} else {
			$("#information").text(result['message']);
		}
	}

	function handleException( xhr ) {
		$("#information").html(xhr.responseText);
	}


	$("#doQuery").click(function(){
		var startDate	= $('#startDate').val();
		var endDate		= $('#endDate').val();
		
		if(startDate == "") {
			$('#startDate').focus();
			alert('开始日期不能为空');
			return;
		}

		if(endDate == "") {
			$('#endDate').focus();
			alert('结束日期不能为空');
			return;
		}

		var data = {
			"startDate" : startDate,
			"endDate" : endDate
		};
		$.ajax({
			url:"/manager/query/statistics",
			method: "post",
			dataType:"json",
			data : data,
			success: handleResponseData,
			error: handleException
		});
	});
});