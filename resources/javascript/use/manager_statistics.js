define(function(require,exports,module){
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
			error: handleErrorData
		});
	});
});