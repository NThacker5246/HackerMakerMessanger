// See https://aka.ms/new-console-template for more information
//HackerMakerMessenger Reborn 2.0
// See https://aka.ms/new-console-template for more information
using System.Net;
using System.Net.Sockets;
using System;
using System.Collections;
using System.Collections.Generic;

using System.Globalization;
using System.Text;

int port = 80;

const int maxBufferSize = 64 * 1024;

TcpListener server = new TcpListener(IPAddress.Any, port);
server.Start();

Hashtable ext = new Hashtable();
ext.Add("html", "text/html");
ext.Add("css", "text/css");
ext.Add("js", "application/javascript");

ext.Add("png", "image/png");
ext.Add("jpg", "image/jpeg");
ext.Add("webp", "image/webp");
ext.Add("gif", "image/gif");

ext.Add("mp4", "video/mp4");
ext.Add("webm", "video/webm");
ext.Add("ico", "image/x-icon");


while(true){
	
	using (TcpClient client = server.AcceptTcpClient()){
		Console.WriteLine("Client joined");
		NetworkStream st = client.GetStream();
		byte[] buffer = new byte[maxBufferSize];
		int bytesRead = st.Read(buffer, 0, buffer.Length);
				
		string message = Encoding.ASCII.GetString(buffer, 0, bytesRead);
		int end = 0;
		bool parse = false;
		for(int i = 5; end == 0; ++i){
			if(message[i] == '?') parse = true;
			else if(message[i] == ' ') end = i - 5;
		} 
		string way = message.Substring(5, end);
		Console.WriteLine($"Way: {way}, parse: {parse}\r\n");
		
		if(way == ""){
			way = "index.html";
		}
		
		byte[] result;
		
		if(!parse){
			try {
				result = File.ReadAllBytes("front/"+way);

				string exte = "text/plain";
				int toe = way.IndexOf(".") + 1;
				string est = way.Substring(toe, way.Length - toe);
				Console.Write("\n");
				Console.Write(est);
				Console.Write("\n");
				if(ext.ContainsKey(est)){
					exte = (string) ext[est];
				}
				byte[] rt = Encoding.ASCII.GetBytes($"HTTP/1.1 200 OK\r\nContent-Type: {exte}\r\nContent-Length: {result.Length}\r\nAccept-Ranges: bytes\r\n\r\n");
				byte[] tow = new byte[rt.Length + result.Length];
				for(int i = 0; i < rt.Length; ++i){
					tow[i] = rt[i];
				}
				for(int i = 0; i < result.Length; ++i){
					tow[rt.Length + i] = result[i];
				}
		
				st.Write(tow);
			} catch (Exception e) {
				st.Write(Encoding.ASCII.GetBytes($"HTTP/1.1 404 Not Found\r\n" + e.ToString()));
				continue;
			}
			
		} else {
			string[] params1 = way.Substring(9).Split('&');
			string filename = ""; //NOTE: fname key must be parsed early than data
			string chatName = ""; //NOTE: chatName must be parsed early than sent/readall key
			string serverName = ""; //NOTE: serverName must be parsed early than chat key
			//parsing
			for(int i = 0; i < params1.Length; ++i){
				string[] kW = params1[i].Split('=');
				//Console.Write(kW[i]);
				//switching keys
				switch(kW[0]){
					case "sent":
						if(chatName == "") break;
						string answer = Encoding.ASCII.GetString(File.ReadAllBytes($"text/{serverName}/{chatName}")) + kW[1];
						byte[] deparse = Encoding.ASCII.GetBytes(answer);
						File.WriteAllBytes($"text/{serverName}/{chatName}", deparse);
						st.Write(Encoding.ASCII.GetBytes($"HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nContent-Length: {deparse.Length}\r\nAccept-Ranges: bytes\r\n\r\n{answer}"));
						break;

					case "fname":
						filename = kW[1];
						break;

					case "data":
						if(chatName == "") break;
						FileStream file = File.Create("front/files/" + filename);
						file.Close();
						File.WriteAllBytes("front/files/" + filename, Encoding.ASCII.GetBytes(DecodeUrlString(kW[1])));
						string answer1 = Encoding.ASCII.GetString(File.ReadAllBytes($"text/{serverName}/{chatName}")) + $"<br><a href=\"files/{filename}\" download=\"\">{filename}</a>";
						byte[] deparse1 = Encoding.ASCII.GetBytes(answer1);
						File.WriteAllBytes($"text/{serverName}/{chatName}", deparse1);
						st.Write(Encoding.ASCII.GetBytes($"HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nContent-Length: {deparse1.Length}\r\nAccept-Ranges: bytes\r\n\r\n{answer1}"));
						break;

					case "readall":
						if(chatName == "") break;
						byte[] bt = File.ReadAllBytes($"text/{serverName}/{chatName}");
						string rd = Encoding.ASCII.GetString(bt);
						Console.Write($"\n{rd}");
						st.Write(Encoding.ASCII.GetBytes($"HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nContent-Length: {bt.Length}\r\nAccept-Ranges: bytes\r\n\r\n{rd}"));
						break;

					case "newchat":
						if(serverName == "") break;
						//Directory.CreateDirectory(directory + "\\" + par[1]);
						FileStream file2 = File.Create($"text/{serverName}" + kW[1]);
						file2.Close();
						File.WriteAllBytes($"text/{serverName}/" + kW[1], Encoding.ASCII.GetBytes("-------------------System: Dialog started-------------------"));
						break;

					case "chat":
						if(serverName == "") break;
						chatName = kW[1];
						break;

					case "getchats":
						if(serverName == "") break;
						string buff = "";
						foreach (string fileS in Directory.EnumerateFiles($"text/{serverName}/", "*", SearchOption.TopDirectoryOnly)) {
							//buff += "\n" + file;
							buff += "<div class=\"v23_29 chat\">" + fileS.Substring(6 + serverName.Length) + "</div>";
						}
						st.Write(Encoding.ASCII.GetBytes($"HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nContent-Length: {buff.Length}\r\nAccept-Ranges: bytes\r\n\r\n{buff}"));
						break;

					case "newserver":
						Directory.CreateDirectory("text/" + DecodeUrlString(kW[1]));
						st.Write(Encoding.ASCII.GetBytes("HTTP/1.1 200 OK"));
						break;

					case "server":
						serverName = DecodeUrlString(kW[1]);
						break;

					case "getservers":
						string buffia = "";
						foreach (string fileS in Directory.EnumerateDirectories("text/", "*", SearchOption.TopDirectoryOnly)) {
							//buffia += "\n" + file;
							buffia += "<div class=\"v21_2 serv\">" + fileS.Substring(5) + "</div>";
							Console.Write(fileS);
						}
						st.Write(Encoding.ASCII.GetBytes($"HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nContent-Length: {buffia.Length}\r\nAccept-Ranges: bytes\r\n\r\n{buffia}"));
						break;

				}
			}
		}
		
	
	}
}

int AlekOSHash(string src){
	int result = 0;
	for(int i = 0; i < src.Length; ++i) {
		result = (result << 5) - result;
		result += src[i];
	}
	return result;
}

string DecodeUrlString(string url) {
    string newUrl;
    while ((newUrl = Uri.UnescapeDataString(url)) != url)
        url = newUrl;
    return newUrl;
}