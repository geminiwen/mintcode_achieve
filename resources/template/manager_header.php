<div class="MainTitle">
		<h1>Welcome to mintcode OA system</h1>
	</div>

	<div class="Notice">
		<div class="TimeHeader">今天是：<span id="date"></span></div>
	</div>
	<form id="upload" action="/timeline/upload" method="POST" enctype="multipart/form-data">
	<input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="300000">

		<div>
			<div id="filedrag" style="display: block;" class="">drop files here</div>
		</div>

	</form>
