
/**
 * Makes a request to get names of versioned files and display them
 * @param {String} version The least version of the files
 */
function getFileNames(version) {
	try {
		$.ajax({
			type: "POST",  //type of method
			url: "api.php",  //your page
			data: { version: version },// passing the values
			success: function (res) {
				let parse_res = JSON.parse(res);
				let test = $("#test");
				test.empty(); // remove preview options in select
				$.each(parse_res, function (index, value) {
					test.append($('<option/>', {
						value: value,
						text: value
					}));
				});
			}
		});
	}
	catch (e) {
		console.log(e);
	}
}
/**
 * clears the garbage collector values
 */
function clearGcValues() {
	$("input[name=s_size]").val('');
	$("input[name=h_size]").val('');
	$("#gcstats").prop("checked", false);
	$("#gcpurge").prop("checked", false);
}

/**
 * Toggles the garbagecollection div.
 * @param {String} checked contains a string yes or no
 * @param {Number} speed speed at which the div appears and disappears
 */
function toggleGarbageCollection(checked, speed = 0) {
	let gc_div = $("#gc_div");
	if (checked === 'yes') {
		gc_div.animate({ opacity: 1 }, speed);
	} else if (checked === 'no') {
		gc_div.animate({ opacity: 0 }, speed);
		clearGcValues();
	}
}

/**
 * when the DOM finishes rendering
 */
$(function () {
	/* 
	######### variables ##########
	*/
	const version = $("#version");
	const option = version.find(":selected");// the value of selected version.
	const radio = $("input[name=gc]")
	const checked = radio.filter(":checked") // the value of the checked radio button. 
	const test = $("#test"); 

	
	/**
	 #### css ####
	 */
	version.css( "background-color", "#bbf" );
	test.css( "background-color", "#bbf" );

	/*
	######### Do when page loads ######### 
	*/
	getFileNames(option.text());
	toggleGarbageCollection(checked.val());


	/*
	########## Event handlers ################
	*/
	version.change(function () {
		let option = $("#version option:selected");
		getFileNames(option.text());
	});
	radio.change(function () {
		let checked = radio.filter(":checked").val()
		toggleGarbageCollection(checked, 500);
	})
});

