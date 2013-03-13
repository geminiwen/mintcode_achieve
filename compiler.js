(function (){
	var compiler = require("gcc");
	var source = "./resources/javascript/use/query.js";
	compiler.compile(source, {}, function(error,stdout){
		console.log(stdout);
	});
})();
