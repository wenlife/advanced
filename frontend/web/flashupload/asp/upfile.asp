<%
Dim temp
dim temp1
Dim temp2
Dim temp3

temp = request.Form("pic")
temp1 = request.Form("pic1")
temp2 = request.Form("pic2")
temp3 = request.Form("pic3")

if temp=""  Then
Else
src = base64Decode(temp)
call Save2Local(src,server.MapPath("src.png"))	
end If


data1 = base64Decode(temp1)
data2 = base64Decode(temp2)
data3 = base64Decode(temp3)


call Save2Local(data1,server.MapPath("1.png"))
call Save2Local(data2,server.MapPath("2.png"))
call Save2Local(data3,server.MapPath("3.png"))

Response.write("{""status"":1}")


function Save2Local(imgs,tofile) 
Set objStream = Server.CreateObject("ADODB.Stream") 
objStream.Type =1 
objStream.Open 
objstream.write imgs 
objstream.SaveToFile tofile,2 
objstream.Close() 
set objstream=nothing 
end function 

 function Base64Encode(strData)
    dim objAds,objXd
    set objAds=createobject("adodb.stream")
    objAds.Type=2
    objAds.charset="unicode"
    objAds.mode=3
    call objAds.open()
    objAds.writeText strData
    objAds.Position=0
    objAds.Type=1
    'objAds.Position=2
 
    set objXd=createobject("msxml.domdocument")
    call objXd.loadXml("<root/>")
    objXd.DocumentElement.DataType="bin.base64"
    objXd.DocumentElement.NodeTypedValue=objAds.read()
    Base64Encode=objXd.DocumentElement.text
end function
 
function Base64Decode(strData)
    dim objXd
    set objXd=createobject("msxml.domdocument")
    call objXd.loadXml("<root/>")
    objXd.DocumentElement.DataType="bin.base64"
    objXd.DocumentElement.text=strData
    Base64Decode=objXd.DocumentElement.NodeTypedValue
end function
%>