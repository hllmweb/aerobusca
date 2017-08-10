if (document.addEventListener) {
	document.addEventListener('contextmenu', function(e){
		$("#context_menu").attr('class','oppened');
		if($(e.target).closest('a').length){
			$("#context_menu").addClass("for_link");
		}
		$("#context_menu").addClass("oppened");  
		document.getElementById("context_menu").style.top =  mouseY(event) + 'px';
		document.getElementById("context_menu").style.left = mouseX(event) + 'px';
		e.preventDefault();
	}, false);
} else {
	document.attachEvent('oncontextmenu', function() {
		alert("You've tried to open context menu");
		window.event.returnValue = false;
	});
}

$(document).bind("click", function(event){
	document.getElementById("context_menu").className = "closed";
});



function mouseX(evt) {
	if(evt.pageX){
		return evt.pageX;
	}else if(evt.clientX) {
		return evt.clientX + (document.documentElement.scrollLeft ?
		document.documentElement.scrollLeft :
		document.body.scrollLeft);
	}else{
		return null;
	}
}

function mouseY(evt) {
	if(evt.pageY){
		return evt.pageY;
	}else if(evt.clientY){
		return evt.clientY + (document.documentElement.scrollTop ?
		document.documentElement.scrollTop :
		document.body.scrollTop);
	}else{
		return null;
	}
}