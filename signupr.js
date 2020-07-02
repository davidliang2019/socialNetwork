//Registration in signup.php
document.getElementById("fname_id").addEventListener("blur", chkFirstName, false);

document.getElementById("lname_id").addEventListener("blur", chkLastName, false);

document.getElementById("bdate").addEventListener("blur", chkBirthDate, false);

document.getElementById("email_id").addEventListener("blur", chkEmail, false);

document.getElementById("sign_pwd").addEventListener("blur", chkPassword2, false);   

document.getElementById("match_pwd").addEventListener("blur", matchPassword, false);

var dom = document.getElementById("signupForm");   
dom.addEventListener("submit", chkFirstName, false);
dom.addEventListener("submit", chkLastName, false);
dom.addEventListener("submit", chkBirthDate, false);
dom.addEventListener("submit", chkEmail, false);
dom.addEventListener("submit", chkPassword2, false);
dom.addEventListener("submit", matchPassword, false);