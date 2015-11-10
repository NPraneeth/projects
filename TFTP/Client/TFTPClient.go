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

	serverAddress, err := net.ResolveUDPAddr("udp", "127.0.0.1:22346")
	if err != nil {
		fmt.Println("Error in creating the serveraddress")
		return
	}
	for k := 0; k < 10; k++ {
		handleSendFile("FileToUpload", serverAddress)
		//handleReceiveFile("FileToDownload", serverAddress)
	}

}

func handleSendFile(filename string, serverAddress *net.UDPAddr) {
	conn, err := createClient()
	if err != nil {
		return
	}
	sendNFile(filename, conn, serverAddress)
}

func handleReceiveFile(filename string, serverAddress *net.UDPAddr) {
	conn, err := createClient()
	if err != nil {
		return
	}
	receiveNFile(filename, conn, serverAddress)
}

func receiveNFile(filename string, conn *net.UDPConn, serverAddress *net.UDPAddr) {

	var currentByte int64 = 0
	buffer := make([]byte, 1024)
	conn.WriteToUDP([]byte("RRQ:"+filename), serverAddress)
	_, _, err := conn.ReadFromUDP(buffer)
	if err != nil {
		return
	}
	message := string(buffer)

	fmt.Println(message)
	if strings.Contains(message, "OK") {
		file, err2 := os.Create(strings.TrimSpace("new" + filename + strconv.Itoa(i)))
		i++
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
}

func sendNFile(filename string, conn *net.UDPConn, serverAddress *net.UDPAddr) {
	var currentByte int64
	var n int
	buffer := make([]byte, 1024)
	conn.WriteToUDP([]byte("WRQ:"+filename), serverAddress)
	fmt.Println("Listening on " + conn.LocalAddr().String())
	_, newServerAddress, _ := conn.ReadFromUDP(buffer)
	message := string(buffer)
	fmt.Println(message)
	fmt.Println("Got it from the new address " + newServerAddress.String())
	file, err := os.Open(strings.TrimSpace(filename))
	if strings.Contains(message, "OK") {
		//conn.WriteToUDP([]byte("send "+filename), newServerAddress)
		for err == nil || err != io.EOF {
			n, err = file.ReadAt(buffer, currentByte)
			currentByte += 1024
			fmt.Println("sending ", buffer, "part of the file as buffer")
			conn.WriteToUDP(buffer[:n], newServerAddress)
		}
	}
	defer file.Close()
	defer conn.Close()
}

func createClient() (*net.UDPConn, error) {
	ClientAddr, err := net.ResolveUDPAddr("udp", ":0")
	//	ClientAddrPort := ClientAddr.Port
	fmt.Println("ClientAddress resolved is " + ClientAddr.String())
	if err != nil {
		fmt.Println("Error in creating the local address")
		return nil, err
	}
	conn1, err := net.ListenUDP("udp", ClientAddr)
	if err != nil {
		fmt.Println("Error in listening in the created client address:" + ClientAddr.String())
		return nil, err
	}
	return conn1, nil
}
