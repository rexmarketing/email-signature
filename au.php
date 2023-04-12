<?php
$correct_password = "password123"; // Set your desired password here

if ($_POST["password"] != $correct_password) {
    echo '
        <form method="post">
            <label for="password">Password:</label>
            <input type="password" name="password">
            <input type="submit" value="Submit">
        </form>
    ';
} else {
    // Display the protected content (an HTML page)
    echo file_get_contents("generator-au.html");
}
?>
