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

const int maxBufferSize = 5 * 1024 * 1024;


const int G = 831;
const int P = 465;

const int A = 35195;
const int C = 95315410;
int x = 1;

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
				
		string message = Encoding.UTF8.GetString(buffer, 0, bytesRead);
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
			way = DecodeUrlString(way);
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
				byte[] rt = Encoding.UTF8.GetBytes($"HTTP/1.1 200 OK\r\nContent-Type: {exte}\r\nContent-Length: {result.Length}\r\nAccept-Ranges: bytes\r\n\r\n");
				byte[] tow = new byte[rt.Length + result.Length];
				for(int i = 0; i < rt.Length; ++i){
					tow[i] = rt[i];
				}
				for(int i = 0; i < result.Length; ++i){
					tow[rt.Length + i] = result[i];
				}
		
				st.Write(tow);
			} catch (Exception e) {
				st.Write(Encoding.UTF8.GetBytes($"HTTP/1.1 404 Not Found\r\n" + e.ToString()));
				continue;
			}
			
		} else {
			string[] params1 = way.Substring(9).Split('&');
			string filename = ""; //NOTE: fname key must be parsed early than data
			string chatName = ""; //NOTE: chatName must be parsed early than sent/readall key
			string serverName = ""; //NOTE: serverName must be parsed early than chat key
			string ftype = "";
			//login-help
			string login = ""; //NOTE: login key must be pasrsed early pass key
			bool register = false; //NOTE: register key must be parsed early passkey, if key was undefined - system just tries to login up
			//parsing
			for(int i = 0; i < params1.Length; ++i){
				string[] kW = params1[i].Split('=');
				Console.Write(kW[0]);
				//switching keys
				switch(kW[0]){
					case "sent":
						if(chatName == "") break;
						string answer = Encoding.UTF8.GetString(File.ReadAllBytes($"text/{serverName}/{chatName}")) + kW[1];
						byte[] deparse = Encoding.UTF8.GetBytes(answer);
						File.WriteAllBytes($"text/{serverName}/{chatName}", deparse);
						st.Write(Encoding.UTF8.GetBytes($"HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nContent-Length: {deparse.Length}\r\nAccept-Ranges: bytes\r\n\r\n{answer}"));
						break;

					case "fname":
						filename = kW[1];
						Console.Write($"Parsed file: {kW[1]}");
						break;

					case "data":
						Console.Write(filename);
					    string filePath = "front/files/" + DecodeUrlString(filename);
					    
					    // Проверяем, base64 ли это (бинарный файл)
					    bool isBase64 = false;
					    foreach (var param in params1) {
					        if (param.StartsWith("isBase64=")) {
					            isBase64 = param.Substring(9) == "1";
					            break;
					        }
					    }
					    
					    if (isBase64) {
					        // Декодируем base64 в бинарные данные
					        string realBase = kW[1].Trim().Replace(" ", "+").Replace("\n", "");
					        //for(int j = 0; j < kW.Length - 2; ++j) realBase += "=";
					        Console.Write(realBase);
					        byte[] fileData = base64_decode(kW[1]);
					        File.WriteAllBytes(filePath, fileData);
					    } else {
					        // Текстовые данные пишем как есть
					        File.WriteAllText(filePath, DecodeUrlString(kW[1]), Encoding.UTF8);
					    }
					    
					    // Обновляем чат
					    string answer1 = Encoding.UTF8.GetString(File.ReadAllBytes($"text/{serverName}/{chatName}"));
					    
					    switch(ftype){
							case "down":
								answer1 += $"<br><a href=\"files/{filename}\" download=\"\">{filename}</a>";
								break;
							case "pict":
								answer1 += $"<br><img src=\"files/{filename}\">";
								break;
							case "vide":
								answer1 += $"<br><video href=\"files/{filename}\" controls=\"\">";
								break;
							case "musc":
								answer1 += $"<br><audio href=\"files/{filename}\" controls=\"\">";
								break;

						}
					    
					    File.WriteAllBytes($"text/{serverName}/{chatName}", Encoding.UTF8.GetBytes(answer1));
					    st.Write(Encoding.UTF8.GetBytes($"HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nContent-Length: {answer1.Length}\r\nAccept-Ranges: bytes\r\n\r\n{answer1}"));
					    break;

					/*case "data":
						if(chatName == "") break;
						FileStream file = File.Create("front/files/" + filename);
						file.Close();
						File.WriteAllBytes("front/files/" + DecodeUrlString(filename), /*Encoding.UTF8.GetBytes(base64_decode(kW[1])));
						string answer1 = Encoding.UTF8.GetString(File.ReadAllBytes($"text/{serverName}/{chatName}"));
						Console.Write(ftype);
						
						byte[] deparse1 = Encoding.UTF8.GetBytes(answer1);
						File.WriteAllBytes($"text/{serverName}/{chatName}", deparse1);
						st.Write(Encoding.UTF8.GetBytes($"HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nContent-Length: {deparse1.Length}\r\nAccept-Ranges: bytes\r\n\r\n{answer1}"));
						break;
					*/

					case "type":
						ftype = kW[1];
						break;

					case "readall":
						if(chatName == "") break;
						byte[] bt = File.ReadAllBytes($"text/{serverName}/{chatName}");
						string rd = Encoding.UTF8.GetString(bt);
						Console.Write($"\n{rd}");
						st.Write(Encoding.UTF8.GetBytes($"HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nContent-Length: {bt.Length}\r\nAccept-Ranges: bytes\r\n\r\n{rd}"));
						break;

					case "newchat":
						if(serverName == "") break;
						//Directory.CreateDirectory(directory + "\\" + par[1]);
						FileStream file2 = File.Create($"text/{serverName}" + kW[1]);
						file2.Close();
						File.WriteAllBytes($"text/{serverName}/" + kW[1], Encoding.UTF8.GetBytes("-------------------System: Dialog started-------------------"));
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
						st.Write(Encoding.UTF8.GetBytes($"HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nContent-Length: {buff.Length}\r\nAccept-Ranges: bytes\r\n\r\n{buff}"));
						break;

					case "newserver":
						Directory.CreateDirectory("text/" + DecodeUrlString(kW[1]));
						st.Write(Encoding.UTF8.GetBytes("HTTP/1.1 200 OK"));
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
						st.Write(Encoding.UTF8.GetBytes($"HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nContent-Length: {buffia.Length}\r\nAccept-Ranges: bytes\r\n\r\n{buffia}"));
						break;

					case "generateB":
						int x2 = LCM();
						int B = fastPow(G, x2) % P;
						st.Write(Encoding.UTF8.GetBytes($"HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nContent-Length: 4\r\nAccept-Ranges: bytes\r\n\r\n{B}"));
						break;
					
					case "register":
						register = true;
						Console.WriteLine("Volatile register");
						break;

					case "login":
						login = kW[1];
						break;
					case "pass":
						foreach (var param in params1) {
					        if (param.StartsWith("register=")) {
					            register = true;
					        }
					        Console.WriteLine("HereLine");
					    }

						Console.WriteLine(login);
						Console.WriteLine(register);
						if(register){
							if(!File.Exists($"usr/{login}.conf")){
								FileStream fileME = File.Create($"usr/{login}.conf");
								fileME.Close();
								File.WriteAllBytes($"usr/{login}.conf", Encoding.UTF8.GetBytes($"{AlekOSHash(kW[1])}"));
								st.Write(Encoding.UTF8.GetBytes("HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nContent-Length: 5\r\nAccept-Ranges: bytes\r\n\r\nLogin"));
							} else {
								st.Write(Encoding.UTF8.GetBytes("HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nContent-Length: 5\r\nAccept-Ranges: bytes\r\n\r\nExist"));
							}
						} else {
							if(File.Exists($"usr/{login}.conf")){
								string userpass = Encoding.UTF8.GetString(File.ReadAllBytes($"usr/{login}.conf"));
								if(userpass == $"{AlekOSHash(kW[1])}"){ //unencrypted check
									st.Write(Encoding.UTF8.GetBytes($"HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nContent-Length: 15\r\nAccept-Ranges: bytes\r\n\r\nLogin succeeful"));
								} else {
									st.Write(Encoding.UTF8.GetBytes($"HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nContent-Length: 18\r\nAccept-Ranges: bytes\r\n\r\nPassword incorrect"));
								}
							} else {
								st.Write(Encoding.UTF8.GetBytes($"HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nContent-Length: 14\r\nAccept-Ranges: bytes\r\n\r\nUser not found"));
							}
						}
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

int LCM(){
	x = x * A + C;
	return (x & 16) & 5;
}

int fastPow(int a, int b){
	return 0;
}

/*
byte[] base64_decode(string into){
	byte[] outto = new byte[(int) Math.Ceiling((double) (into.Length / 4 * 3))];
	const string ou = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
	int push = 0;
	int io = 0;
	for(int i = 0; i < into.Length; ++i){
		for(int j = 0; i < 64; ++j){
			if(ou[j] == into[i]){
				push |= j << ((~i & 3) * 6);
				if((i & 3) == 3){
					outto[io] = (byte) (push & 255);
					outto[io + 1] = (byte) ((push >> 8) & 255);
					outto[io + 2] = (byte) (push >> 16);
					io += 3;
					push = 0;
				}
				break;
			}
		}
	}
	return outto;
}
*/
byte[] base64_decode(string input) {
    // The base character set
    int max_padding = input.Length % 4;
    for(int i = 0; i < max_padding; ++i) input += "=";
    const string BASE64_CHARS = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
    // The length of the input
    int input_length = input.Length;

    // The output
    int t = 0;
    byte[] output = new byte[(int) Math.Ceiling((double) input.Length / 4 * 3)];
 
    // Process the input in 4-character blocks
    for(int i = 0; i < input_length; i += 4) {
        // The value of the block
        int block_value = (BASE64_CHARS.IndexOf(input[i]) << 18) + (BASE64_CHARS.IndexOf(input[i+1]) << 12) + (BASE64_CHARS.IndexOf(input[i+2]) << 6 ) + BASE64_CHARS.IndexOf(input[i + 3]);
 
        // Decode the block into 3 bytes
        for(int j = 0; j < 3; ++j){
            byte k = (byte) ((block_value >> ((2 - j) * 8)) & 0xFF);
            output[t] = k;
            t++;
        }
    }
 
    // Remove any padding bytes from the output
    int padding = input.Split('=').Length - 1;
    byte[] ou = new byte[output.Length - padding];
    for(int i = 0; i < output.Length - padding; ++i){
    	ou[i] = output[i];
    }
 
    return ou;
}