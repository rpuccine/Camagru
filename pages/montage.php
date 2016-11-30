<?php include($_SERVER['DOCUMENT_ROOT'].'/scripts/tools.php') ?>
<?php include($_SERVER['DOCUMENT_ROOT'].'/scripts/auth_protect.php') ?>
<!-- PHP Logic Scrip -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/head.php') ?>
<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/header.php') ?>
	<div class="container bgLight center autofill">
		<div class="montage_main" id="main">
			<div class="center title">
				<h2>-- CAM --</h2>
			</div>
			<div class="cam center">
				<video id="video"></video>
			</div>
			<form enctype="multipart/form-data" method="post" id="montage_form">
				<input type="file" name="file">
				<br>
				<img src='/calc/beard_01.png'>
				<input type="radio" name="calc" value="/calc/beard_01.png" required>
				<img src='/calc/beard_02.png'>
				<input type="radio" name="calc" value="/calc/beard_02.png" required>
				<img src='/calc/beard_03.png'>
				<input type="radio" name="calc" value="/calc/beard_03.png" required>
				<br>
				<input type="submit" value="Take Picture">
			</form>
		</div>
		<div class="montage_main" id="side">
			<div class="center title">
				<h2>-- LAST PIC --</h2>
			</div>
			<div class="menu center">
				<ul class="padSmall center" id="list_img">
				</ul>
			</div>
		</div>
	</div>
	<div class="clear"/>
	<canvas hidden id="canvas"></canvas>
	<img hidden src="http://placekitten.com/g/320/261" id="photo" alt="photo">
	<?php include($_SERVER['DOCUMENT_ROOT'].'/htmlBlocks/footer.php') ?>


<script type="text/javascript">

(function() {

  var streaming = false,
      video        = document.querySelector('#video'),
      cover        = document.querySelector('#cover'),
      canvas       = document.querySelector('#canvas'),
      photo        = document.querySelector('#photo'),
      startbutton  = document.querySelector('#startbutton'),
			form         = document.querySelector('#montage_form'),
			list         = document.querySelector('#list_img'),
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

		var request = new XMLHttpRequest();
		var url = "/scripts/montage.php";
		var login = '<?php echo $_SESSION['user']->get_user_name() ?>';

		// var form_data = new FormData(document.forms.namedItem("montage_form"));
		var form_data = new FormData(form);
		form_data.append("src_poney", data);
		form_data.append("login", login);
		request.open("POST", url, true);

		request.onreadystatechange = function() {
			if (request.readyState == 4 && (request.status == 200 || request.status == 0)) {
				//alert(request.responseText);
				var node = document.createElement("LI");
				var img = document.createElement("IMG");
				img.src = request.responseText;
				photo.setAttribute('src', request.responseText);
				node.appendChild(img);
				list.insertBefore(node, list.childNodes[0]);
				form.reset();
			}
		}

		request.send(form_data);
	}

  //startbutton.addEventListener('click', function(ev){
  form.addEventListener('submit', function(ev){
      takepicture();
    ev.preventDefault();
  }, false);

})();

</script>

</body>
</html>
