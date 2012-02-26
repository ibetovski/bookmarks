function cut_text(id) {
	var buffer=38;
	var element=document.getElementById(id);
	var cuted_text=element.text.substr(0,buffer) + "...";
	var str_length=element.text.length;
	element.title=element.text;
	if (str_length > buffer) {
		element.innerHTML=cuted_text;
	}
}

function uncut_text(id) {
	var element=document.getElementById(id);
	element.innerHTML=element.title;
}