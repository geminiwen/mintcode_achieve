define(function(require,exports,module){
	var TimeUtil = function(time) {
		var reg = /^(\d{1,2}):(\d{1,2}):(\d{1,2})/;
		if( reg.test(time) ) {
			this.hour = RegExp.$1;
			this.minite = RegExp.$2;
			this.seconds = RegExp.$3;
			this.avaliable = true;	
		} else {
			this.avaliable = false;
		}
	};

	TimeUtil.prototype.diff = function( time ) {
		if( typeof time == "string" ) {
			time = new TimeUtil(time);
		}

		if( !time.avaliable || !this.avaliable ) {
			throw "Unnormalizable time to diff!";
		}
		
		var data = {};
		data['hour'] = time.hour - this.hour;
		data['minite'] = time.minite - this.minite;
		data['seconds'] = time.seconds - this.seconds;

		if( data['seconds'] < 0 ) {
			data['minite'] --;
			data['seconds'] += 60;
		}

		if( data['minite'] < 0 ) {
			data['hour'] --;
			data['minite'] += 60;
		}
	
		
		return data;
	}

  	TimeUtil.toTimeString = function () {
		var date = {};
		if( arguments.length == 0 ) {
			date['hour'] = this.hour;
			date['minite'] = this.minite;
			date['seconds'] = this.seconds;
		} else {
			date = arguments[0];
		}
		var _output = '';
		var _i = 0;
		for( var _f in date ){
			var _v = date[_f];
			if( _v < 10 )
			{
				_output += '0';
			}
			_output += _v;
			if( _i ++ < 2 ){
				_output += ':';
			}
		}
		return _output;
	}

	module.exports = TimeUtil;
});
