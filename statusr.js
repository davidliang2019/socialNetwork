// Registration in status.php

var rows = document.getElementsByTagName("article");
for(var j=1; j<=rows.length; j++){
	document.getElementById("unlike_icon"+j).addEventListener("click", function(event){flipIt(event,"like_icon")}, false);
	document.getElementById("like_icon"+j).addEventListener("click", function(event){flipIt(event,"unlike_icon")}, false);
	document.getElementById("unlike_icon"+j).addEventListener("click",statusLike,false);
	document.getElementById("like_icon"+j).addEventListener("click",statusLike,false);
}
document.addEventListener("DOMContentLoaded",function(){checkUpdate("status")},false);
