<?php
  include("dbconfig/database.php");
  include("dbconfig/user.php");
  include("dbconfig/viewuser.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <title>PHP and Ajax Task</title>
  <link rel="stylesheet" href="css/style.css" type="text/css" />
  <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<div class="container">
	<h1 class="text-center"><a href="#" target="_blank">PHP And Ajax File Format Uploading </a></h1>
		<form id="upload_form" enctype="multipart/form-data" method="post">
			<input  type="file" name="file1" id="file1"><br>
			<input type="button" value="Upload File" onclick="uploadFile()">
			<progress id="progressBar" value="0" max="100" style="width:300px;height:25px;"></progress>
			<h3 id="status"></h3>
			<p id="loaded_n_total"></p>
		</form>
	</div>
</body>
</html>