define(function(require,exports) {

	var MTDate = require("./mt_date");
	var MTFile = require("./mt_file");

	var date = new MTDate("#date");
	date.render();

	var fileHolder = new MTFile("filedrag");
	fileHolder.render();
});
