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
	if (new_val.length > 0) {
		//alert(basedir +"/lib/getTitle.php");
		$.post(basedir +"/lib/getTitle.php",{b_url : new_val}, function(data){
			$("#clearUrl").fadeIn(80);
			if (data.length>0) {
				$("#b_title").val(data);
			} else {
				$("b_title").val(new_val);
			}
		});
	}
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



/* ######################

	A J A X

####################### */
var calc_file = "ajax/";
var bkm_div = "#ajax_bkm";

function show_colors(triger) {
	$(triger).next().fadeIn(200);
	$(triger).next().addClass("showm");
}
function hide_colors(triger) {
	$(triger).parent().fadeOut(200);
	$(triger).parent().removeClass("shown");
}

function set_color(basedir, triger) {
	bid = $(triger).parent().parent().parent().find("[name=bid]").val();
	color = $(triger).html();
	li_element = $(triger).parent().parent().parent();
	$.post(basedir + calc_file,{method : "set_color", bid : bid, color : color}, function(data) {
		if (color > 0) {
			li_element.css("background","rgba("+data+",0.6)");
		} else {
			li_element.css("background","none");
		}
	});
	
}