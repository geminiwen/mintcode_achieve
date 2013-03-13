define(function(require,exports) {

	var MTDate = require("./mt_date");
	var MTFile = require("./mt_file");

	var $ = require('bootstrap');

	var date = new MTDate("#date").render();

	var fileHolder = new MTFile("filedrag","/timeline/upload");
	
	var $filedrag = $('#filedrag'),
		notify = function(info) {
			$filedrag.popover({
				animation: true,
				placement: 'bottom',
				trigger: 'manual',
				title: '通知',
				content: info
			});
			$filedrag.popover('show');
			setTimeout(function() { $filedrag.popover('destroy')  } ,2000);
		},
		success = function (data) {
			var result = data['result'];
			if( result ) {
				notify("录入成功");
			} else {
				notify("录入失败");
			}
		},
		error = success;

	fileHolder.render(success,error);
	
	var checkAll = false;
	
	$('#checkAll').click(function(){ 
		checkAll = !checkAll;
		$('.checkToDelete').each(function(id) {
				this.checked = (checkAll);
		});
	});

	$('#deleteAll').click(function() {
		return false;
	})
});
