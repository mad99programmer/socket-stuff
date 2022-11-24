
<?php

$host    = "127.0.0.1";
$port    = 9000;
$message = "hostname";
echo "Message To server :".$message;
//$s_message = serialize($message);
$s_message = json_encode($message);
// create socket
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
// connect to server
$result = socket_connect($socket, $host, $port) or die("Could not connect to server\n");  
// send string to server
socket_sendto($socket, $s_message,strlen($s_message),0,$host,$port) or die("Could not send data to server\n");

// get server response
$result = socket_read ($socket, 1024) or die("Could not read server response\n");
echo "Reply From Server  :".$result;
// close socket
socket_close($socket);




?>