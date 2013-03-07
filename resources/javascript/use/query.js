define(function(require){
	var $ = require("jquery");

	$("#doQuery").click(function(){
		var startDate	= $('#startDate').val();
		var endDate		= $('#endDate').val();

		if(startDate == "") {
			$('#startDate').focus();
			alert('参数不能为空');
			return;
		}

		if(endDate == "") {
			$('#endDate').focus();
			alert('参数不能为空');
			return;
		}
	});
});