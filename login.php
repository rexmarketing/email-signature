<!DOCTYPE html>
<html>
<head>
	<title>Protected Content</title>
	<style>
		.container {
			display: flex;
			grid-template-columns: repeat(2, 1fr);
			grid-gap: 40px;
			max-width: 1140px;
			margin: 0 auto;
			font-family: "Inter", sans-serif;
			box-sizing: border-box;
			justify-content: center;
			align-items: center;
			height: 100vh;
		}

		.region-box {
			background-color: #fff;
			border: 1px solid #e0e0e0;
			border-radius: 8px;
			padding: 40px;
			font-weight: 500;
			font-size: 16px;
			box-sizing: border-box;
			box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
			position: relative;
		}

		.region-box:active {
			box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
		}

		h1 {
			margin-top: 0;
			font-size: 24px;
			font-weight: bold;
			text-align: center;
			margin-bottom: 30px;
		}

		.region-buttons {
			display: flex;
			justify-content: center;
		}

		button {
			border: none;
			border-radius: 4px;
			padding: 12px 24px;
			font-size: 16px;
			cursor: pointer;
			background-color: #1371b3;
			color: #fff;
			margin-right: 16px;
			transition: background-color 0.2s ease-in-out;
			box-shadow: 0px 3px 0px #000206;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		button:hover {
			background-color: #091a3c;
			box-shadow: 0px 2px 0px #091a3c;
		}

		button:active {
			background-color: #091a3c;
			box-shadow: none;
			border: 1px solid #091a3c;
		}

		.flag {
		  margin-right: 8px;
		  height: 14px;
		  width: 14px;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="region-box">
<?php
session_start();
$correct_password = "password123"; // Set your desired password here

// Check if user is already authenticated
if (isset($_SESSION["authorized"]) && $_SESSION["authorized"]) {
    // User is authenticated, do nothing and continue to protected page
} else {
    // User is not authenticated, check password
    if ($_POST["password"] == $correct_password) {
        // User entered the correct password
        $_SESSION["authorized"] = true;
        // Redirect to the saved URL or the protected page if none saved
        $redirect_url = isset($_SESSION["redirect_url"]) ? $_SESSION["redirect_url"] : "protected.php";
        header("Location: " . $redirect_url);
        exit();
    } else {
        // Password form was not submitted or incorrect password was provided
        // Save the current URL as the redirect URL in session
        $_SESSION["redirect_url"] = $_SERVER["REQUEST_URI"];
        // Display password form
        echo '
            <form method="post">
                <label for="password">Password:</label>
                <input type="password" name="password">
                <input type="submit" value="Submit">
            </form>
        ';
        exit(); // Stop script execution to prevent further code execution
    }
}
?>

		</div>
	</div>
</body>
</html>
