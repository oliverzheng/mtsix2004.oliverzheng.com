function gotoMT() {
	window.location.href = "http://mtsix.com/mt/mt.php";
	return true;
}

function popitup(url,w,h)
{
	newwindow=window.open(url,'name','height='+h+',width='+w);
	if (window.focus) {newwindow.focus()}
	return false;
}
function fullScreen(theURL) {
	fullscreen=window.open(theURL, '', 'fullscreen=yes, scrollbars=auto');
	if (window.focus) {fullscreen.focus()}
	return false;
}
function emailMe(user, domain) {
	var addy = user + "@" + domain;
	window.location.href = 'mailto:' + addy;
}
function checkContact(name, email, message, submit_button) {
	if(name.value.length < 1) {
		alert("Please enter your name.");
		name.focus();
		return false;
	}
	if(email.value.length < 1) {
		alert("Please enter your email address.");
		email.focus();
		return false;
	}
	if(!checkemail(email.value)) {
		alert("Please enter a valid email address.");
		email.focus();
		return false;
	}
	if(message.value.length < 1) {
		alert("Please enter a message.");
		message.focus();
		return false;
	}
	submit_button.disabled=true;
	return true;
}
function checkemail(str) {
	var at="@"
	var dot="."
	var lat=str.indexOf(at)
	var lstr=str.length
	var ldot=str.indexOf(dot)
	if (str.indexOf(at)==-1){
		return false
	}
	if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		return false
	}
	if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		return false
	}
	if (str.indexOf(at,(lat+1))!=-1){
		return false
	 }
	if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		return false
	}
	if (str.indexOf(dot,(lat+2))==-1){
		return false
	}
	if (str.indexOf(" ")!=-1){
		return false
	}
	return true					
}