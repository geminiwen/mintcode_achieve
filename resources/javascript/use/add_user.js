define(function(require,exports) {

	var $ = require("bootstrap");

	var MTDate = require("./mt_date");

	var date = new MTDate("#date").render();

	function notify(node,info) {
		$(node).popover({
					animation: true,
					placement: 'right',
					trigger: 'manual',
					content: info
				});
		$(node).popover('show');
		setTimeout(function(){ $(node).popover('hide'); }, 2000);
	}

	$('#modalDialog').modal(
	{
		show:false
	});

	function add_user(username,starttime,endtime) {
		var data = {
			'username' : username,
			'starttime' : starttime,
			'endtime' : endtime
		};

		function handleResponse( data ) {
			var success = data['result'];
			var message = success ? '添加用户成功' : '添加用户失败';

			$('#modalDialog .modal-body p').text(message);

			$('#modalDialog').modal('show');

			$('input[name="username"]').val('');
			$('input[name="starttime"]').val('');
			$('input[name="endtime"]').val('');


			setTimeout(function() { $('#modalDialog').modal('hide')}, 2000);

		}

		function handleError( xhr ) {
			$('#modalDialog .modal-body p').html(xhr.responseText);

			$('#modalDialog').modal('show');
		}

		$.ajax({
			url: '/manager/user?action=add_user',
			data: data,
			method: 'post',
			dataType: 'json',
			success: handleResponse,
			error: handleError
		});


	}


	$('#submit').click(function() {
		do {
			var $username = $('input[name="username"]');
			var $starttime = $('input[name="starttime"]');
			var $endtime = $('input[name="endtime"]');

			var username = $username.val();
			if( username == '' ) {
				notify($username,'真实姓名不能为空');
				$username.focus();
				break;
			}

			var starttime = $starttime.val();
			if( starttime == '' ) {
				notify($starttime,'上班不能为空');
				$starttime.focus();
				break;
			}

			var endtime = $endtime.val();
			if( endtime == '' ) {
				notify($endtime,'下班不能为空');
				$endtime.focus();
				break;
			}

			add_user(username,starttime,endtime);
			

		}while(false);

	});

});