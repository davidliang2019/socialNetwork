// Registration in statusform.php
var dom1 = document.getElementById("title_id");
dom1.addEventListener("blur", chkTitle, false);

var dom2 = document.getElementById("status_id");
dom2.addEventListener("blur", chkStatus, false);

var dom3 = document.getElementById("image_id");
dom3.addEventListener("blur", chkImage, false);

var dom4 = document.getElementById("statusForm");   
dom4.addEventListener("submit", chkTitle, false);
dom4.addEventListener("submit", chkStatus, false);
dom4.addEventListener("submit", chkImage, false);