define(function(require, exports, module) {

	var $ = require('jquery');

	var MTDate = function(node) {
		this.node = $(node);
		this.init();
	}

	MTDate.prototype.init = function() {
		var weekDayStr = ["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
			date = new Date();
		
		var weekDay	= date.getDay();
		this.month		= date.getMonth() + 1;
		this.day 		= date.getDate();
		
		var year		= date.getYear();
		this.year 		= year > 200 ? year : 1900 + year;

		this.weekDay = weekDayStr[weekDay];
	}

	MTDate.prototype.dateString = function () {
		var str = this.year + "年" + this.month + "月" + this.day +"日 " + this.weekDay;
		return str;
	}

	MTDate.prototype.render = function () {
		if( this.node ) {
			$(this.node).text(this.dateString());
		}
		return this;
	}

	

	module.exports = MTDate;
});
