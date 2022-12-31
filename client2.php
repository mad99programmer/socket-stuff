<?php

$host  = "192.168.56.1";
$port = 5566;


?>
<html>
<head>
</head>


<body>

	<form method="POST" action="#">
	
		<input type="submit" name="connect" id="connect" value="whoami">
		<input type="submit" name="mqsilist" id="mqsilist" value="mqsilist">
		<input type="submit" name="mqsistop" id="mqsistop" value="mqsistop">
		<input type="submit" name="mqsistart" id="mqsistart" value="mqsistart">
		
		
	
	
	</form>

</body>

</html>
<?php
if ( isset($_POST['connect']) )
{
	$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
	$result = socket_connect($socket, $host, $port) or die("Could not connect to server\n"); 
// connect to server
	$message = "mqsistopmsgflow ISO -e HEART_BEAT";

	socket_write($socket, $message, strlen($message)) or die("Could not send data to server\n");
	$result = socket_read ($socket, 1024) or die("Could not read server response\n");
	echo "Reply From Server  :".$result;
	
	
	$message = "!DISCONNECT";

	socket_write($socket, $message, strlen($message)) or die("Could not send data to server\n");
	//socket_close($socket);
	
}

if ( isset($_POST['mqsilist']) )
{
	$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
	$result = socket_connect($socket, $host, $port) or die("Could not connect to server\n"); 
// connect to server
	$message = "mqsilist ISO";

	socket_write($socket, $message, strlen($message)) or die("Could not send data to server\n");
	$result = socket_read ($socket, 1024) or die("Could not read server response\n");
	echo "Reply From Server  :".$result;
	
	
	$message = "!DISCONNECT";

	socket_write($socket, $message, strlen($message)) or die("Could not send data to server\n");
	//socket_close($socket);
	
}

if ( isset($_POST['mqsistop']) )
{
	$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
	$result = socket_connect($socket, $host, $port) or die("Could not connect to server\n"); 
// connect to server
	$message = "mqsistopmsgflow ISO -e HEART_BEAT";

	socket_write($socket, $message, strlen($message)) or die("Could not send data to server\n");
	$result = socket_read ($socket, 1024) or die("Could not read server response\n");
	echo "Reply From Server  :".$result;
	
	
	$message = "!DISCONNECT";

	socket_write($socket, $message, strlen($message)) or die("Could not send data to server\n");
	//socket_close($socket);
	
}

if ( isset($_POST['mqsistart']) )
{
	$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
	$result = socket_connect($socket, $host, $port) or die("Could not connect to server\n"); 
// connect to server
	$message = "mqsistartmsgflow ISO -e HEART_BEAT";

	socket_write($socket, $message, strlen($message)) or die("Could not send data to server\n");
	$result = socket_read ($socket, 1024) or die("Could not read server response\n");
	echo "Reply From Server  :".$result;
	
	
	$message = "!DISCONNECT";

	socket_write($socket, $message, strlen($message)) or die("Could not send data to server\n");
	//socket_close($socket);
	
}
?>


