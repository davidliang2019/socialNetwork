// JavaScript in login.php and chkEmail() in signup.php
function chkEmail(event){
	var mytd = document.getElementById("mytd1");
	var eml = document.getElementById("email_id");
	var pos = eml.value.search(
			/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/);
	eml.style.background = '#FFFFFF';
	mytd.innerHTML="";
	if(pos!=0){
		mytd.setAttribute("style", "color: red;");
		mytd.innerHTML="Invalid email format. Correct format: name@hotmail.com";
		eml.style.background = '#FFF000';
		event.preventDefault();
	}
}

function chkPassword(event){
	var mytd = document.getElementById("mytd2");
	var pwd = document.getElementById("pwd_id");
	var pos = pwd.value.search(/^[\S]{8,}$/);
	pwd.style.background = '#FFFFFF';
	mytd.innerHTML="";
	if(pos!=0){
		mytd.setAttribute("style", "color: red;");
		mytd.innerHTML="Invalid password. Correct format: 8 characters or longer, no spaces";
		pwd.style.background = '#FFF000';
		event.preventDefault();
	}
}

//JavaScript in signup.php
function chkFirstName(event){
	var mytd = document.getElementById("mytd3");
	var fnm = document.getElementById("fname_id");
	var pos = fnm.value.search(/^[a-zA-Z][a-zA-Z\s]+[a-zA-Z]$/);
	fnm.style.background = '#FFFFFF';
	mytd.innerHTML="";
	if(pos!=0){
		mytd.setAttribute("style", "color: red;");
		mytd.innerHTML= "Invalid format. Correct format: Mike";
		fnm.style.background = '#FFF000';
		event.preventDefault();
	}
}

function chkLastName(event){
	var mytd = document.getElementById("mytd4");
	var lnm = document.getElementById("lname_id");
	var pos = lnm.value.search(/^[a-zA-Z][a-zA-Z\s]+[a-zA-Z]$/);
	lnm.style.background = '#FFFFFF';
	mytd.innerHTML="";
	if(pos!=0){	
		mytd.setAttribute("style", "color: red;");
		mytd.innerHTML= "Invalid format. Correct format: Smith";
		lnm.style.background = '#FFF000';
		event.preventDefault();
	}
}

function chkBirthDate(event){
	var mytd = document.getElementById("mytd5");
	var bd = document.getElementById("bdate");
	//reference: http://www.regular-expressions.info/dates.html
	var pos = bd.value.search(
			/^(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d$/);
	bd.style.background = '#FFFFFF';
	mytd.innerHTML="";
	if(pos!=0){	
		mytd.setAttribute("style", "color: red;");
		mytd.innerHTML= "Invalid date. Correct format: (mm/dd/yyyy)";	
		bd.style.background = '#FFF000';
		event.preventDefault();
	}
}

function chkPassword2(event){
	var mytd = document.getElementById("mytd7");
	var pwd = document.getElementById("sign_pwd");
	var pos = pwd.value.search(/^(?=.*[^a-zA-Z]).{8}$/);
	pwd.style.background = '#FFFFFF';
	mytd.innerHTML="";
	if(pos!=0){
		mytd.setAttribute("style", "color: red;");
		mytd.innerHTML="Invalid password. 8 characters long, " +
				"at least one non-letter character";
		pwd.style.background = '#FFF000';
		event.preventDefault();
	}
}

function matchPassword(event){
	var mytd = document.getElementById("mytd8");
	var init = document.getElementById("sign_pwd");
	var sec = document.getElementById("match_pwd");
	sec.style.background = '#FFFFFF';
	mytd.innerHTML="";
	if(init.value==""){
		mytd.setAttribute("style", "color: red;");
		mytd.innerHTML="You have not enter a password yet.";
		sec.style.background = '#FFF000';
		event.preventDefault();
	}else if (init.value != sec.value){
		mytd.setAttribute("style", "color: red;");
		mytd.innerHTML="The two passwords you entered are not the same\n" +
				"Please re-enter again.";
		sec.style.background = '#FFF000';
		event.preventDefault();
	}
}

//JavaScript in statusform.php and commentform.php
function chkTitle(event){
	var mytd = document.getElementById("mytd9");
	var title = document.getElementById("title_id");
	title.style.background = '#FFFFFF';
	mytd.innerHTML="";
	if(title.value==null||title.value==""){
		mytd.setAttribute("style", "color: red;");
		mytd.innerHTML= "Please enter a title.";
		title.style.background = '#FFF000';
		event.preventDefault();
	}
}

function chkStatus(event){
	var mytd = document.getElementById("mytd10");
	var status = document.getElementById("status_id");
	status.style.background = '#FFFFFF';
	mytd.innerHTML="";
	if(status.value==null||status.value==""){
		mytd.setAttribute("style", "color: red;");
		mytd.innerHTML= "You cannot submit an blank body.";
		status.style.background = '#FFF000';
		event.preventDefault();
	}else if(status.value.length>=1000){
		mytd.setAttribute("style", "color: red;");
		mytd.innerHTML= "Please shorter than 1000 characters";
		status.style.background = '#FFF000';
		event.preventDefault();
	}
}

function chkImage(event){
	var mytd = document.getElementById("mytd11");
	var x = document.getElementById("image_id");
	var pos = x.value.search(/^.*?\.(jpg|gif|png)$/i);
	x.style.background = '#FFFFFF';
	mytd.innerHTML="";
	if(x.value!=null && x.value !="" && pos!=0){
		mytd.setAttribute("style", "color: red;");
		mytd.innerHTML="Please upload an image file.";
		x.style.background = '#FFF000';
		event.preventDefault();
	}
}

//JavaScript in status.php and comment.php
function flipIt(event, it){
	var top = event.currentTarget;
	var num = top.id.match(/\d/g);
	var y = document.getElementById(it+num);
	temp = top.className;
	top.className = y.className;
	y.className = temp;
}

function statusLike(event){
	var top = event.currentTarget;
	var num = top.id.match(/\d/g);
	var u = document.getElementById("user").value;
	var p = document.getElementById("post"+num).value;
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if(xhr.readyState==4 && xhr.status==200){
			document.getElementById("likecount"+num).innerHTML=xhr.responseText;
		}
	}
	xhr.open("GET", "statuslike.php?user="+u+"&post="+p, true);
	xhr.send(null);
}

function commentLike(event){
	var top = event.currentTarget;
	var num = top.id.match(/\d/g);
	var u = document.getElementById("user").value;
	var p = document.getElementById("post"+num).value;
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if(xhr.readyState==4 && xhr.status==200){
			document.getElementById("likecount"+num).innerHTML=xhr.responseText;
		}
	}
	xhr.open("GET", "commentlike.php?user="+u+"&post="+p, true);
	xhr.send(null);
}

var load1=0;
var p1=999;
function checkUpdate(str){
    var p = document.getElementById("post1").value;
    var s = document.getElementById("std").value;
    if(p1>p)
	p1=p;
    xhr = new XMLHttpRequest();	
    xhr.onreadystatechange = function(){
	if(xhr.readyState==4 && xhr.status==200){
	    createChatLists(this.responseText, str);
	}
    }
    xhr.open("GET", "update.php?table="+str+"&post="+p1+"&abc="+s, true);
    xhr.send(null);
    setTimeout(function(){checkUpdate(str)},2000);
}

function createChatLists(myString, str){
	var num = 0;
	if(str=="status"){
		var rows1 = document.getElementsByClassName("status_class");
		num = rows1.length;
	}else{
		var rows2 = document.getElementsByClassName("comments");
		num =rows2.length;
	}
	var myObj = JSON.parse(myString);
	var pnode = document.getElementById("parent");
	if(load1!=myObj.content.length){
	    while(pnode.firstChild){
		pnode.removeChild(pnode.firstChild);
	    }
	    for(var i=0; i<myObj.content.length; i++){
	    	updateStatusComments(i, str, num, myObj, pnode);
    	    }
	    load1=myObj.content.length;
	}
	for(var j=1; j<=num; j++){
		countLikes(j, str, myObj);
	}
}

function countLikes(j, str, myObj){
	var count1 = 0;
	var count2 = 0;
	if(str=="status"){
	    for(var i=0;i<myObj.like.length;i++)
		if(document.getElementById("post"+j).value==myObj.like[i].statusId)
		    count1++;
	    for(var i=0;i<myObj.comment.length;i++)
		if(document.getElementById("post"+j).value==myObj.comment[i].statusId)
		    count2++;
	    document.getElementById("commentcount"+j).innerHTML=count2;
	}else{
	    for(var i=0;i<myObj.like.length;i++)
		if(document.getElementById("post"+j).value==myObj.like[i].commentId)
		    count1++;
	}
	document.getElementById("likecount"+j).innerHTML=count1;
}

function updateStatusComments(i, str, num, myObj, pnode){
	var num1 = num+1+i;
	var new_article = createArticle(str);
	pnode.appendChild(new_article);

	var name = myObj.content[i].firstName + " " + myObj.content[i].lastName;
	createAuthor(name, new_article);
	createDate(myObj.content[i].date, new_article);
	createTitle(str, myObj.content[i].title, new_article);	
	createContent(myObj.content[i].content, new_article);
	if(myObj.content[i].image!=null)
		createImage(new_article, myObj.content[i].image);

	var new_aside3 = document.createElement("aside");
	new_aside3.className = "view";
	new_article.appendChild(new_aside3);

	createUnlike(num1, str, new_aside3);
	createLike(num1, str, new_aside3);
	createLikeCount(num1, new_aside3, str);
	if (str=="status"){
		createCommentCount(num1, new_aside3);
		createCommentButton(new_aside3, myObj.content[i].statusId);
	}	
	if(str=="status")
	    createHiddenInfo(num1, new_aside3, myObj.content[i].statusId);
	else
	    createHiddenInfo(num1, new_aside3, myObj.content[i].commentId);
}

function createArticle(str){
	var new_article = document.createElement("article");
	if(str=="status")
	    new_article.className="status_class";
	else
	    new_article.className="comments";
	return new_article;
}

function createAuthor(name, article){
	var aside = document.createElement("aside");
	aside.className = "author_class";
	aside.innerHTML = name;
	article.appendChild(aside);
}

function createDate(time, article){
	var aside = document.createElement("aside");
	aside.className = "time";
	aside.innerHTML = time;
	article.appendChild(aside);
}

function createTitle(str, title, article){
	if(str=="status"){
		var new_h1 = document.createElement("h1");
		new_h1.innerHTML = title;
		article.appendChild(new_h1);	
	} else {
		var break1 = document.createElement("br");
		article.appendChild(break1);
	}
}

function createContent(content, article){
	var new_p1 = document.createElement("p");
	new_p1.innerHTML = content;		    
	article.appendChild(new_p1);
}

function createImage(article, image){
	var imgNode = document.createElement("img");
	imgNode.className="imgstyle";
	imgNode.src="upload/" + image;
	article.appendChild(imgNode);
}

function createUnlike(num1, str, aside){
	var img1 = document.createElement("img");
	img1.id="unlike_icon"+num1.toString();
	img1.className="on";
	img1.src="like01.JPG";

	img1.addEventListener("click", function(event){flipIt(event,"like_icon")}, false);
	if(str=="status"){
	    img1.addEventListener("click",statusLike,false);
	}else{
	    img1.addEventListener("click",commentLike,false);
	}
	aside.appendChild(img1);
}

function createLike(num1, str, aside){
	var img2 = document.createElement("img");
	img2.id="like_icon"+num1.toString();
	img2.className="off";
	img2.src="like02.JPG";

	img2.addEventListener("click", function(event){flipIt(event,"unlike_icon")}, false);
	if(str=="status"){
	    img2.addEventListener("click",statusLike,false);
	}else{
	    img2.addEventListener("click",commentLike,false);
	}
	aside.appendChild(img2);
}

function createLikeCount(num1, new_aside3, str){
	var new_span1 = document.createElement("span");		
	new_span1.id="likecount"+num1.toString();
	var textNode5 = document.createTextNode("0");
	new_span1.appendChild(textNode5);
	new_aside3.appendChild(new_span1);
	var text;
	if(str=="status"){
	    text = " likes, ";
	}else{
	    text = " likes";
	}
	var textNode6 = document.createTextNode(text);
	new_aside3.appendChild(textNode6);
}

function createCommentCount(num1, new_aside3){
	var new_span2 = document.createElement("span");
	new_span2.id="commentcount"+num1.toString();
	var textNode7 = document.createTextNode("0");
	new_span2.appendChild(textNode7);
	new_aside3.appendChild(new_span2);
}

function createCommentButton(new_aside3, addr){
	var aNode = document.createElement("a");
	aNode.href="comment.php?post_id="+addr.toString();		
	var textNode8 = document.createTextNode(" comments");
	aNode.appendChild(textNode8);
	new_aside3.appendChild(aNode);
}

function createHiddenInfo(num1, new_aside3, Id){
	var iNode = document.createElement("input");
	iNode.type = "hidden";
	iNode.id = "post"+num1.toString();
	iNode.value = Id;
	new_aside3.appendChild(iNode);
}
