<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Video Upload</h1>

	<div id="body">
		
		<!-- <form action="<?=site_url('welcome/post')?>" method='post' enctype="multipart/form-data">
			<input type="file" name="file"><br><br>
			<input type="submit" name="" value="submit">
		</form> -->
		<form id="upload_form" <?=site_url('welcome/post')?> enctype="multipart/form-data" method="post">
		  <input type="file" name="file1" id="file1"><br>
		  <input type="button" value="Upload File" onclick="uploadFile()">
		  <progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
		  <h3 id="status"></h3>
		  <p id="loaded_n_total"></p>
		</form>


		<table>
			<tr>
				<td>Sr.no</td>
				<td>File</td>
				<td>Share</td>
			</tr>
			<?php $a=1;?>
			<?php foreach ($v_files as $row): ?>
				<tr>
					<td><?=$a++?></td>
					<td><?=$row?></td>
					<td><a href="<?=base_url()?>Uploads/<?=$row?>">url</a></td>
				</tr>
				
			<?php endforeach ?>
		</table>
	</div>


	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>
<script type="text/javascript">
	function _(el) {
	  return document.getElementById(el);
	}

	function uploadFile() {
	  var file = _("file1").files[0];
	  // alert(file.name+" | "+file.size+" | "+file.type);
	  var formdata = new FormData();
	  formdata.append("file1", file);
	  var ajax = new XMLHttpRequest();
	  ajax.upload.addEventListener("progress", progressHandler, false);
	  ajax.addEventListener("load", completeHandler, false);
	  ajax.addEventListener("error", errorHandler, false);
	  ajax.addEventListener("abort", abortHandler, false);
	  ajax.open("POST", "<?=site_url('welcome/post')?>");
	  ajax.send(formdata);
	  
	}

	function progressHandler(event) {
	  _("loaded_n_total").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
	  var percent = (event.loaded / event.total) * 100;
	  _("progressBar").value = Math.round(percent);
	  _("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
	}

	function completeHandler(event) {
	  _("status").innerHTML = event.target.responseText;
	  _("progressBar").value = 0;
	}

	function errorHandler(event) {
	  _("status").innerHTML = "Upload Failed";
	}

	function abortHandler(event) {
	  _("status").innerHTML = "Upload Aborted";
	}
</script>
</body>
</html>