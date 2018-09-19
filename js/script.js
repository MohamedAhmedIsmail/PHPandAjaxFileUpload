function Ajax(el)
{
	return document.getElementById(el);
}
function uploadFile()
{
	var file = Ajax("file1").files[0];
	var formdata = new FormData();
	formdata.append("file1", file);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "file_upload_parser.php");
	ajax.send(formdata);
}
function progressHandler(event)
{
	Ajax("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
	var percent = (event.loaded / event.total) * 100;
	Ajax("progressBar").value = Math.round(percent);
	Ajax("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
}
function completeHandler(event)
{
	Ajax("status").innerHTML = event.target.responseText;
	Ajax("progressBar").value = 0;
}
function errorHandler(event)
{
	Ajax("status").innerHTML = "Upload Failed";
}
function abortHandler(event)
{
	Ajax("status").innerHTML = "Upload Aborted";
}
var canvas = document.getElementById('canvas');
var ctx = canvas.getContext('2d');
var video = document.getElementById('video');
video.addEventListener('loadedmetadata', function() 
{
  canvas.width = video.videoWidth;
  canvas.height = video.videoHeight;
});
video.addEventListener('play', function() 
{
  var $this = this; //cache
  (function loop() {
    if (!$this.paused && !$this.ended)
     {
      ctx.drawImage($this, 0, 0);
      setTimeout(loop, 1000 / 30);
    }
  })();
}, 0);