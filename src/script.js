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
				//console.log(res);
				//let parse_res = JSON.parse(res);
				let last_res = [];
				let test = $("#test");
				$.ajax({
					type: "GET",  //type of method
					url: "api.php",  //your page
					data: {last_t: 'last_t'},
					success: function (last_t) {
						console.log(last_t);
						if(last_t !== null ) {
							if (last_t[1] == version) {
								last_res.push(last_t);
							}
						}
						for ( i in res) {
							if(res[i] != last_t) {
								last_res.push(res[i]);
							}
						}
						//console.log(last_res);
						test.empty(); // remove preview options in select
						$.each(last_res, function (index, value) {
							test.append($('<option/>', {
								value: value,
								text: value
							}));
						});

					}
				});

			}
		});
	}
	catch (e) {
		console.log("Error in getFilesNames")
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
		//gc_div.animate({ opacity: 1 }, speed);
		gc_div.fadeIn(speed);
	} else if (checked === 'no') {
		//gc_div.animate({ opacity: 0 }, speed);
		gc_div.fadeOut(speed);
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
