
    $(document).on("focus", ".origens", function(e){
		setupAutocomplete($(this), $(this).attr("id"));
		$(this).removeClass('origens');
	});

	$(document).on("focus", ".destinos", function(e){
		setupAutocomplete($(this), $(this).attr("id"));
		$(this).removeClass('destinos');
	});
