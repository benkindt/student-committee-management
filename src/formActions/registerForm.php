<?php

$host = "localhost";
$db = "dbwt";
$dbuser = "dbuser";
$dbpass = "test1342";

$email = $_POST["inputEmail"];
$pass = $_POST["inputPassword"];;

$conn = new PDO('pgsql:dbname=dbwt;host=localhost;user=dbuser;password=test1342');

// user=' + $user + ';password=' + $pass + ';');
$query = "INSERT INTO users (email, password) VALUES (?, crypt(?, gen_salt('md5')));";
$STH = $conn->prepare($query);

$STH->bindParam(1, $email);
$STH->bindParam(2, $pass);
$result = $STH->execute();
// check if user already exists
if($result){
	echo "Registration erfolgreich.";
	header("Location: ../userArea/userIndex.php");
	exit;
} else {
	echo "Die Mailadresse "; 
	echo $email;
	echo " wird bereits verwendet.</br>Versuchen Sie es erneut! </br></br>";
	echo "<a href='../index.html' class='btn btn-default'>Ich kann mich an mein Passwort erinnern.</a></br>";
	echo "<a href='../register.html' class='btn btn-default'>Ich werde eine andere Email benutzen.</a>";
	exit;
}
// redirect to new site

?>