define(function(require,exports) {

	var MTDate = require("./mt_date");
	var MTFile = require("./mt_file");

	var $ = require("jquery");

	var date = new MTDate("#date");
	date.render();

	var fileHolder = new MTFile("filedrag","/timeline/upload");
	var success = function (data) {
		var result = data['result'];
		if( result ) {
			$('#infomation').text("录入成功");
		} else {
			$('#infomation').text("录入失败");
		}
		
	};
	fileHolder.render(success,success);
	var checkAll = false;
	$('#checkAll').click(function(){ 
		checkAll = !checkAll;
		if(checkAll) {
			$('.checkToDelete').each(function(id) {
				this.checked = true;
			});
			
		} else {
			$('.checkToDelete').each(function(id) {
				this.checked = false;
			});

		}
	});

	$('#deleteAll').click(function() {
		return false;
	})
});
