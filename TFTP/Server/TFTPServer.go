package main

import (
	"bytes"
	"fmt"
	"io"
	"net"
	"os"
	"strconv"
	"strings"
)

var i int = 1

func main() {
	var err error
	fmt.Println("Hi.. The Server program has been invoked .. !!")
	serverAddr, err := net.ResolveUDPAddr("udp", "127.0.0.1:22346")
	if err != nil {
		fmt.Println("Error in resolving the UDP Address " + "127.0.0.1:22346")
		fmt.Println(err)
		return
	}
	serverConn, err := net.ListenUDP("udp", serverAddr)
	if err != nil {
		fmt.Println("Error while listing on 127.0.0.1:22346 using the UDP protocol")
		fmt.Println(err)
		return
	}
	buffer := make([]byte, 1024)
	for {
		bytesofdata, fromaddr, _ := serverConn.ReadFromUDP(buffer)
		fmt.Println("Read " + string(buffer[0:bytesofdata]))
		msgReceived := string(buffer)
		req_file := strings.Split(msgReceived, ":")
		request := req_file[0]
		filename := strings.TrimSpace(req_file[1])

		fmt.Println(filename + request)
		i++
		if request == "WRQ" {
			/*
				if filename1 == filename {
					fmt.Println("I am not able to create the file giving filename1 as the argument to os.Create() function which is later used in the server program")
				}*/
			filename := "new" + strconv.Itoa(i)
			go handleReceiveFile(filename, fromaddr)
		}
		if request == "RRQ" {
			go handleSendFile(filename, fromaddr)
		}
	}
}

func handleSendFile(filename string, clientAddress *net.UDPAddr) {
	conn, err := createDedicatedServer()
	if err != nil {
		fmt.Println("error while creating the dedicated server")
		return
	}
	fmt.Println("Created Dedicated Server")
	sendNFile(filename, conn, clientAddress)
}

func sendNFile(filename string, conn *net.UDPConn, clientAddress *net.UDPAddr) {
	var currentByte int64
	var n int
	buffer := make([]byte, 1024)
	conn.WriteToUDP([]byte("OK"), clientAddress)
	fmt.Println(filename)
	/*fileInfo, err := os.Stat(filename)
	if err != nil {
		fmt.Println(err)
	}
	fmt.Println(fileInfo)
	*/
	file, err := os.Open("FileToDownload")
	//file, err := os.Open(filename)
	if err != nil {
		fmt.Println("error in opening the file to read")
		fmt.Println(err)
		/*	if err2, ok := err.(*os.PathError); ok {
			fmt.Println(err2)
			fmt.Printf("err2 has type %T\n", err2.Error)
			/*if errno, ok := err2.Error.(os.Errno); ok {
				fmt.Fprintf(os.Stderr, "errno=%d\n", int64(errno))
			}*/
		//}
	}

	for err == nil || err != io.EOF {
		n, err = file.ReadAt(buffer, currentByte)
		currentByte += 1024
		conn.WriteToUDP(buffer[:n], clientAddress)
	}
	defer file.Close()
	defer conn.Close()
}

func handleReceiveFile(filename string, fromaddr *net.UDPAddr) {
	conn, err := createDedicatedServer()
	if err != nil {
		fmt.Println(err)
		return
	}
	receiveNFile(filename, conn, fromaddr)
	return
}

func receiveNFile(filename string, conn *net.UDPConn, clientAddress *net.UDPAddr) {
	fmt.Println("Sending from " + conn.LocalAddr().String() + "to " + clientAddress.String())
	conn.WriteToUDP([]byte("OK"), clientAddress)
	var err2 error
	var currentByte int64 = 0
	buffer := make([]byte, 1024)
	file, err2 := os.Create(strings.TrimSpace(filename))
	if err2 != nil {
		fmt.Println("There is an error in creating the file")
		fmt.Println(err2)
		return
	}
	for err2 == nil || err2 != io.EOF {
		conn.Read(buffer)
		cleanbuffer := bytes.Trim(buffer, "\x00")
		fmt.Println("Read :", cleanbuffer)
		_, err2 = file.WriteAt(cleanbuffer, currentByte)
		currentByte += 1024
	}
	defer conn.Close()
	defer file.Close()
}

func createDedicatedServer() (*net.UDPConn, error) {
	newServerAddr, err := net.ResolveUDPAddr("udp", ":0")
	if err != nil {
		fmt.Println(err)
		return nil, err
	}
	newConn, err := net.ListenUDP("udp", newServerAddr)
	if err != nil {
		fmt.Println(err)
		return nil, err
	}
	return newConn, nil
}
