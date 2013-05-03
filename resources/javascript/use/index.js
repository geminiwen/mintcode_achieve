define(function(require,exports) {

	var MTDate = require("./mt_date");
	var MTFile = require("./mt_file");

	var $ = require('bootstrap');

	var date = new MTDate("#date").render();

	var fileHolder = new MTFile("filedrag","/timeline/upload");
	
	var $filedrag = $('#filedrag'),
		notify = function(info) {
			loaded();
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
		loading = function() {
			$filedrag.popover({
				animation: true,
				placement: 'bottom',
				trigger: 'manual',
				title: '通知',
				html: true,
				content: '<center><img src="/resources/img/ajax-loader.gif" /></center>'
			});
			$filedrag.popover('show');
		},
		loaded = function() {
			$filedrag.popover('destroy')
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

	$('.save').click(function() {
		var self = this;
		var parent 	  = $(this).parents("table")
		var starttime = parent.find(".starttime").val()
		var endtime	  = parent.find(".endtime").val()
		var userid	  = parent.find(".checkToDelete").val()
		$.ajax({
			url: "/manager/update_time",
			data: { 'id': userid, 'starttime' : starttime, 'endtime' : endtime},
			method: 'post',
			dataType: 'json',
			beforeSend: function() {
				$(self).hide();
				$(self).parent().find('img').show();
			},
			success: function() { 
				$(self).show();
				$(self).parent().find('img').hide();
			}
		})
	});

	$('#deleteAll').click(function() {
		return false;
	})
});
