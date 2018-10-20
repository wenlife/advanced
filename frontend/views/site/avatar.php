<?php
use yii\helpers\Url;
?>
<script type="text/javascript">
 function uploadevent(status){
  
//alert(status);
   status += '';
   switch(status){
   case '1':
     var time = new Date().getTime();
     document.getElementById('avatar_priview').innerHTML = "头像1 : <img src='flashupload/php/1.png?" + time + "'/> <br/> 头像2: <img src='flashupload/php/2.png?" + time + "'/><br/> 头像3: <img src='flashupload/php/3.png?" + time + "'/>";
</script>

<?php


?>
<script type="text/javascript">

      break;
      break;
   case '-1':
      window.location.reload();
      break;
   default:
      window.location.reload();
  } 
 }
</script>



<div id="altContent" style="border:1px solid #ccc">
  <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" WIDTH="650" HEIGHT="450" id="myMovieName">
    <PARAM NAME=movie VALUE="flashupload/php/avatar.swf">
    <PARAM NAME=quality VALUE=high>
    <PARAM NAME=bgcolor VALUE=#FFFFFF>
    <param name="flashvars" value="imgUrl=flashupload/php/default.jpg&uploadUrl=flashupload/php/upfile.php &uploadSrc=false" />
    <EMBED src="flashupload/php/avatar.swf" quality=high bgcolor=#FFFFFF WIDTH="650" HEIGHT="450" wmode="transparent" flashVars="imgUrl=flashupload/php/touxiang.jpg&uploadUrl=flashupload/php/upfile.php&uploadSrc=false"
    NAME="myMovieName" ALIGN="" TYPE="application/x-shockwave-flash" allowScriptAccess="always"
    PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer">
    </EMBED>
  </OBJECT>
</div>

<div id="avatar_priview"></div>



