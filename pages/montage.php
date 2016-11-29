<?php include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php') ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/scripts/auth_protect.php') ?>
<!-- PHP Logic Scrip -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/head.php') ?>
<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/header.php') ?>
	<div class="container bgLight center">
		<div class="center title">
			<h2>-- CAM --</h2>
		</div>
		<div class="cam center">
			<video id="video"></video>
			<canvas hidden id="canvas"></canvas>
		</div>
		<div class="menu center">
			<img src="http://placekitten.com/g/320/261" id="photo" alt="photo">
			<img src="http://placekitten.com/g/320/261" id="photo" alt="photo">
			<img src="http://placekitten.com/g/320/261" id="photo" alt="photo">
		</div>
		<div class="center padSmall" style="width:100%;">
			<button id="startbutton">Prendre une photo</button>
		</div>
	</div>
	<div class="container bgLight center">
		<div class="center title">
			<h2>-- LAST PIC --</h2>
		</div>
		<ul class="padSmall center" id="list_img">
		</ul>
	</div>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/footer.php') ?>

<script type="text/javascript">

(function() {

  var streaming = false,
      video        = document.querySelector('#video'),
      cover        = document.querySelector('#cover'),
      canvas       = document.querySelector('#canvas'),
      photo        = document.querySelector('#photo'),
      startbutton  = document.querySelector('#startbutton'),
      width = 320,
      height = 0;

  navigator.getMedia = ( navigator.getUserMedia ||
                         navigator.webkitGetUserMedia ||
                         navigator.mozGetUserMedia ||
                         navigator.msGetUserMedia);

  navigator.getMedia(
    {
      video: true,
      audio: false
    },
    function(stream) {
      if (navigator.mozGetUserMedia) {
        video.mozSrcObject = stream;
      } else {
        var vendorURL = window.URL || window.webkitURL;
        video.src = vendorURL.createObjectURL(stream);
      }
      video.play();
    },
    function(err) {
      console.log("An error occured! " + err);
    }
  );

  video.addEventListener('canplay', function(ev){
    if (!streaming) {
      height = video.videoHeight / (video.videoWidth/width);
      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      streaming = true;
    }
  }, false);

  function takepicture() {
    canvas.width = width;
    canvas.height = height;
    canvas.getContext('2d').drawImage(video, 0, 0, width, height);
    var data = canvas.toDataURL('image/png');
    photo.setAttribute('src', data);

	var request = new XMLHttpRequest();
	var url = "/scripts/montage.php";
	var login = '<?php echo $_SESSION['user']->get_user_name() ?>';
	var params = "src_poney=" + encodeURIComponent(data)
		+ "&login=" + encodeURIComponent(login);
	request.open("POST", url, true);

	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	request.onreadystatechange = function() {
		if (request.readyState == 4 && (request.status == 200 || request.status == 0)) {
			//alert(request.responseText);
			var node = document.createElement("LI");
			var img = document.createElement("IMG");
			img.src = request.responseText;
			node.appendChild(img);
			document.getElementById("list_img").appendChild(node);
		}
	}

	request.send(params);
  }

  startbutton.addEventListener('click', function(ev){
      takepicture();
    ev.preventDefault();
  }, false);

})();

</script>

</body>
</html>
