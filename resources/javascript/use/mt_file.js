define(function(require,exports,module){
	function $id(id) {
		return document.getElementById(id);
	}
	var xhr;
		// file drag hover
	function FileDragHover(e) {
		e.stopPropagation();
		e.preventDefault();
		e.target.className = (e.type == "dragover" ? "hover" : "");
	}


	// file selection
	function FileSelectHandler(e) {

		// cancel event and hover styling
		FileDragHover(e);

		// fetch FileList object
		var files = e.target.files || e.dataTransfer.files;

		// process all File objects
		for (var i = 0, f; f = files[i]; i++) {
			parseFile(f);
			fileUpload(f);
		}

	}

	function fileUpload(file) {
		xhr = xhr || new XMLHttpRequest();
		if( xhr.upload ) {
			if( file.type == "application/vnd.ms-excel" 
				|| file.type == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" ) {
				var x = 1;
				xhr.onreadystatechange = function () {
					if(xhr.readyState == 4 && xhr.status == 200 ) {
						alert( xhr.responseText );
					}
				}
				xhr.open("POST", formAction, true);
				xhr.send(file);
			} else {
				alert("not a standard excel file!");
			}
		}
	}

	var formAction;

	var MTFile = function (filedrag,action) {
		this.fileDrag = $id(filedrag);
		formAction = action;
	}

	MTFile.prototype.render = function() {
		if (window.File && window.FileList && window.FileReader) {
			this.init();
		}
	}

	MTFile.prototype.init = function () {
		var filedrag = this.fileDrag;

		xhr = new XMLHttpRequest();
		if (xhr.upload) {
			filedrag.addEventListener("dragover", FileDragHover, false);
			filedrag.addEventListener("dragleave", FileDragHover, false);
			filedrag.addEventListener("drop", FileSelectHandler, false);
			filedrag.style.display = "block";
		}
	}

	MTFile.prototype.fileDragOver = FileDragHover;

	MTFile.prototype.fileSelect = FileSelectHandler;

	function parseFile (file) {
		console.log("TODO: filename"+file.name+"type:"+file.type);
	}

	module.exports = MTFile;

});