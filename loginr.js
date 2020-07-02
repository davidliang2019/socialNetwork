// Registration in login.php
document.getElementById("email_id").addEventListener("blur", chkEmail, false);   

document.getElementById("pwd_id").addEventListener("blur", chkPassword, false);   

var dom = document.getElementById("loginForm");   
dom.addEventListener("submit", chkEmail, false);
dom.addEventListener("submit", chkPassword, false);