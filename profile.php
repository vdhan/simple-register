<!DOCTYPE html>
<html>
	<head>
		<title>Profile</title>
		<script src="js/jquery.min.js"></script>
	</head>

	<body>
		<?php
		session_start();
		$id = $_SESSION['id'];
		$name = $_SESSION['name'];
		$pass = $_SESSION['pass'];
		$email = $_SESSION['email'];
		$image = $_SESSION['image'];
		echo "
		Username: {$name}<br>
		Password: {$pass}<br>
		Email: {$email}<br>
		Profile picture: <span id='image'><image src='{$image}' alt='no picture' height='50' width='50'></span><br>
		";
		?>
		<form enctype="multipart/form-data">
			<input name="file" id="file" type="file" accept="image/*"><br>
			<button type="button" id="upload_file">Upload</button>
		</form>
		<a href='edit.html'>Edit profile</a>

		<script>
			$('#file').change(function() {
				var file = this.files[0];
				var name = file.name;
				var size = file.size;
				var type = file.type;
			});

			$('#upload_file').click(function() {
				var img = new FormData($('form')[0]);
				$.ajax({
					url: 'upload.php',
					type: 'POST',
					success: function(data) {
						$('#image').html('<img src="' + data + '" alt="no picture" height="50" width="50">');
					},
					data: img,
					cache: false,
					contentType: false,
					processData: false
				});
			});
		</script>
	</body>
</html>
