
<?php

$host    = "127.0.0.1";
$port    = 9000;
$message = "hostname";
$s_message="";
/*
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
socket_close($socket);*/
$socket="";
$result="";

function create_socket()
{
	
	$GLOBALS['socket'] = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
}

function bind_socket()
{
	
	$GlOBALS['result'] = socket_connect($GLOBALS['socket'], $GLOBALS['host'], $GLOBALS['port']) or die("Could not connect to server\n");  
}



function receive()
{
	$buf="";
	
	while ($bytes = socket_recv($GLOBALS['socket'], $r_data, 4000, MSG_WAITALL)) 
	{
		$result .= $r_data;
		echo "..\n";
	}
	
	
	echo "[+] Type >>>".gettype($result);
	echo "\n";
	echo "[+] Final Result >>>>> ".json_decode($result);
	
	
	
	
	
	if (false !== ($bytes = socket_recv($socket, $buf, 2048, MSG_WAITALL))) {
    echo "Read $bytes bytes from socket_recv(). Closing socket...";
} else {
    echo "socket_recv() failed; reason: " . socket_strerror(socket_last_error($socket)) . "\n";
}

	echo "[+] Type >>>".gettype($buf);
	echo "\n";
	echo "[+] Final Result >>>>> ".json_decode($buf);
	
	/*
	
	while(TRUE)
	{
			try
			{
				$result = socket_read ($GLOBALS['socket'], 1024) or die("Could not read server response\n");
				echo "[+] Type >>>".gettype($result);
				echo "\n";
			
				echo "[+] Final Result >>>>> ".json_decode($result);
			
		
			}
			catch(Exception  $e)
			{
				echo '[+] Exception Message>>> ' .$e->getMessage();
				continue;
			}	
		
		
		
	}*/

	
	
	
	
	
}
function json_send($message)
{
	$GLOBALS['s_message'] = serialize($message);

	$GLOBALS['s_message']= json_encode($message);
	echo "[+]Message to send >>>>".$GLOBALS['s_message'];
	echo"\n";
	//socket_sendto($GlOBALS['socket'], $GLOBALS['s_message'],strlen($GLOBALS['s_message']),0,$GLOBALS['host'],$GLOBALS['port']) or die("Could not send data to server\n");
	socket_write($GLOBALS['socket'], $GLOBALS['s_message'], strlen($GLOBALS['s_message']));
	
	echo "[+] Output from server >>>>>>>>>>>>>>>>>>\n";
	
	
	
			
	
}




function run()
{
	while(TRUE)
	{
		$command = (string)readline(">>>");
		
		if($command == "exit")
		{
			
			break;
		}
		else
		{
			
			echo "\n".$command;
			echo "\n";
			
			json_send($command);
			receive();
			
			
			
			
		}
	
		
	}
	
	
}

create_socket();
bind_socket();
run();


?>