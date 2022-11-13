import socket
import json



class Sender:

	
	
	def __init__(self):
	
		try:
			self.conn=socket.socket(socket.AF_INET,socket.SOCK_STREAM)
			self.conn.connect(("127.0.0.1",9000))
		except socket.error as e:
			print("Error :--",e)
		
		
			
	def receive(self):
	
		result=b''
		
		while True:
			try:
				result = result + self.conn.recv(1024)
				#command=json.loads(command)
				#result=result.decode()
				return json.loads(result)
				
				
			except ValueError:
				continue
				
			
		
			
		
				
	def json_send(self,command):
		json_command = json.dumps(command)
		json_command = json_command.encode()
	
		print("Output from remote Server ")
		
		
		self.conn.send(json_command)
		
			
			
	def run(self):

		while True:
			command = input(">>> ")
			self.json_send(command)
			
			result=self.receive()
			
			print(result)
		
sender=Sender()
sender.run()
	
	

