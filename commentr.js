// Registration in comment.php
document.addEventListener("DOMContentLoaded",function(){checkUpdate("comment")},false);
var rows = document.getElementsByClassName("comments");
for(var j=1; j<=rows.length; j++){
	document.getElementById("unlike_icon"+j).addEventListener("click", function(event){flipIt(event,"like_icon")}, false);
	document.getElementById("like_icon"+j).addEventListener("click", function(event){flipIt(event,"unlike_icon")}, false);
	document.getElementById("unlike_icon"+j).addEventListener("click",commentLike,false);
	document.getElementById("like_icon"+j).addEventListener("click",commentLike,false);
}
