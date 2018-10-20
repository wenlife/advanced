<%@Import NameSpace="System.IO"%>
<%@Import NameSpace="System"%>
<% @ Page Language="C#" %>
<%

String pic = Request.Form["pic"];
String pic1 = Request.Form["pic1"];
String pic2 = Request.Form["pic2"];
String pic3 = Request.Form["pic3"];

//原图
if (pic.Length == 0) {
}else {
	byte[] bytes = Convert.FromBase64String(pic);  //将2进制编码转换为8位无符号整数数组
	
	string url = "./src.png";
	FileStream fs =new FileStream(Server.MapPath(url),System.IO.FileMode.Create);
	fs.Write(bytes, 0, bytes.Length);
	fs.Close();
}

byte[] bytes1 = Convert.FromBase64String(pic1);  //将2进制编码转换为8位无符号整数数组.
byte[] bytes2 = Convert.FromBase64String(pic2);  //将2进制编码转换为8位无符号整数数组.
byte[] bytes3 = Convert.FromBase64String(pic3);  //将2进制编码转换为8位无符号整数数组.



//图1
string url1 = "./1.png";
FileStream fs1 =new FileStream(Server.MapPath(url1),System.IO.FileMode.Create);
fs1.Write(bytes1, 0, bytes1.Length);
fs1.Close();

//图2
string url2 = "./2.png";
FileStream fs2 =new FileStream(Server.MapPath(url2),System.IO.FileMode.Create);
fs2.Write(bytes2, 0, bytes2.Length);
fs2.Close();

//图3
string url3 = "./3.png";
FileStream fs3 =new FileStream(Server.MapPath(url3),System.IO.FileMode.Create);
fs3.Write(bytes3, 0, bytes3.Length);
fs3.Close();

Response.Write("{\"status\":1}");

%> 