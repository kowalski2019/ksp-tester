<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT, GET, POST");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode( '/', $uri );

    #exec("echo $uri[3] > URL ", $re, $er);

    if($_POST['version']) {
	$version = $_POST['version'];

    	$grep_cmd = " | grep -iE ^v$version.*";
    	$cmd_get_allTest="ls ../resources/bin_test_files$grep_cmd";

    	exec($cmd_get_allTest, $results, $error);
    	# json datei
    	echo json_encode($results);
    }

    if( $_REQUEST["last_t"]) {
	exec("cat .last_test.l 2>/dev/null", $res1, $err1);
	if ($res1 !== "") {
		echo json_encode($res1[0]);
	}
	else {
		echo json_encode("");
	}
    }

?>
