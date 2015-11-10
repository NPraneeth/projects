This is my first code in Go Language. I feel that i have really got an oppurtunity to learn a lot in a few hours.
This project deals with implementing the basic ReadFile and WriteFile implementation. 
	Given a filename, the client sends a read request to the server, as soon as the server sends the acknowledgement the File transfer starts from the server location to the client location.
	Similarly given a filename the client request to write at the server, as soon as the server send the acknowledgement the File transfer starts from the client location to the server location.

Execution Steps:
	1. Observer that there are only two files in the Server Folder. "TFTPServer.go" and "FileToUpload".
	2. Go inside the "Server" folder. Compile and run the TFTPServer.go file
	3. Also observer that there are only two files in the Client Folder, "TFTPClient.go" and "FileToDownload"
	4. Go inside the "Client" folder. Compile and run the TFTPClient.go file
	5. You will see that the FileToUpload is written and renamed to new1 in the server folder.
	6. Similary you see that the FileToDownload is downloaded as newFileToDownload1 in the client folder.


Future Scope for Development :
	1. The data is currently handled as naive buffer, this can be structured and made into different kinds of packets
	2. Acknowledgement is handled as message. Error can also be handled along with the timeouts


Known Bugs : 
	1. Not able to Open or Create files in the Server.go program, hence hard coded
	2. From a single client process single request can be sent. You can spawn clients for concurrency