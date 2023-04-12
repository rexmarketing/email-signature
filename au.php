<!DOCTYPE html>
<html>
<head>
	<title>Protected Page</title>
	<!-- Include Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<h1 class="text-center my-4">Protected Page</h1>
		<?php
		$correct_password = "password123"; // Set your desired password here

		if ($_POST["password"] != $correct_password) {
		    echo '
		        <form method="post" class="border rounded p-4">
		            <div class="form-group">
		            	<label for="password">Password:</label>
		            	<input type="password" class="form-control" name="password" required>
		            </div>
		            <button type="submit" class="btn btn-primary">Submit</button>
		        </form>
		    ';
		} else {
		    echo '
		    	<div class="alert alert-success my-4" role="alert">
		    		You have successfully logged in!
		    	</div>
		    	' . file_get_contents("generator-au.html");
		}
		?>
	</div>
	<!-- Include Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNSpdwN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
