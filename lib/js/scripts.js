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

function ajax_getTitle(basedir) {
	var new_val = $("#b_url").val();
	$.post(basedir +"/lib/getTitle.php",{b_url : new_val}, function(data){
		$("#clearUrl").fadeIn(80);
		if (data.length>0) {
			$("#b_title").val(data);
		} else {
			$("b_title").val(new_val);
		}
	})
}

function animate_cancel() {
	$("form.shown").animate({
		height: ['hide','swing'],
	}, 300, function() {
		$("form").removeClass("shown");
		$(".covering").fadeOut(250);
	});
	return false;
}

function clearUrl() {
	$("#b_url").val("");
	$("#b_title").val("");
	$(this).hide();
	return false;
}