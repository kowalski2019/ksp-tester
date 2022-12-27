<?php //begin

/*global variables */
$file_name = "";
$test_name = "";
$uploadFileOk = false;
$uploadTestOk = false;

/* functions */

function log_info($str)
{
	echo "<script>console.log(" . json_encode($str) . ") </script>";
}

if (isset($_FILES["fileToUpload"])) { // check if a file has been upload
	$errors = array(); // empty array for errors
	$file_name = $_FILES["fileToUpload"]["name"]; // retrieving the njvm file name
	$tmp_ac_name = $_SERVER['REMOTE_ADDR'];
	$file_name .= $tmp_ac_name;
	#$actualName = $tmp_ac_name;
	$file_size = $_FILES["fileToUpload"]["size"];
	$file_tmp = $_FILES["fileToUpload"]["tmp_name"];
	$file_type = $_FILES["fileToUpload"]["type"];
	$file_parts = explode(".", $file_name);
	$file_ext = strtolower(end($file_parts));
	$target_dir = "uploads"; // upload dir 

	if ($file_size > 134217728) {
		$errors[] = "File to large";
	}
	if (empty($errors) == true) {
		move_uploaded_file($file_tmp, "$file_name");
		$uploadFileOk = true;
	} else {
		echo "Somethings went wrong";
		print_r($errors);
	}
}

function rebuild_test_file_name($test_file_name_as_array, $ext){
	$res = "";
	foreach ($test_file_name_as_array as $item) {
		if ($item != $ext) {
			$res .= $item . ".";
		}
	}
	return substr($res, 0, - 1);
}

if (isset($_FILES["testFile"])) {
	$errors1 = array();
	$tmp_ac_name = $_SERVER['REMOTE_ADDR'];
	$test_name = $tmp_ac_name . "_";
	#$actualName = $tmp_ac_name;
	$test_name .= $_FILES["testFile"]["name"];
	$test_size = $_FILES["testFile"]["size"];
	$test_tmp = $_FILES["testFile"]["tmp_name"];
	$test_type = $_FILES["testFile"]["type"];
	$test_parts = explode(".", $test_name);
	$test_ext = strtolower(end($test_parts));
	$target_dir = "../uploads";
	$extensions = array("nj", "asm", "bin", "");

	if ($test_size > 134217728) {
		$errors1[] = "Test file to large";
	}
	if (in_array($test_ext, $extensions) === false) {
		$errors1[] = "extension not allowed, please choose a nj,asm or bin file.";
	}

	if (empty($errors1) == true) {
		move_uploaded_file($test_tmp, "$target_dir/$test_name");
		$uploadTestOk = true;
	} else {
		print_r($errors1);
	}
}

$def_Inputs = $_POST["defaultInput"]; // retrieve the defaulft inputs

$do_gc = $_POST["gc"];
$stack_size = $_POST["s_size"];
$heap_size = $_POST["h_size"];
$gc_stats_opt = false;
$gc_purge_opt = false;

if (isset($_POST["gc_opt"])) {
	$gc_opt = $_POST["gc_opt"];  # index 0 for gcstats and 1 for gcpurge

	if (count($gc_opt) == 2) {
		$gc_stats_opt = true;
		$gc_purge_opt = true;
	} else {
		if (strcmp($gc_opt[0], "stats") == 0)
			$gc_stats_opt = true;
		else
			$gc_purge_opt = true;
	}
}

$gc = false;
# if gc is on use the omd "ulimit -SHd" and start the test"
#echo $gc_opt[0];
#echo $gc_opt[1];

$heap_default_size = 8192;

$ulimit_cmd = "ulimit -SHd ";

$ulimit_val = 9000;
if (strlen($do_gc) != 0) {
	if (strcmp($do_gc, "yes") == 0)
		$gc = true;

	if (strlen($stack_size) == 0)
		$stack_size = 64;
	if (strlen($heap_size) == 0) {
		$heap_size = $heap_default_size;
	} else {
		$heap_size = intval($heap_size);
		# 1.12 if < 10 000
		# 1.04 if < 100 000
		# 1.08 if < 1 000 000
		if ($heap_size < 100)
			$ulimit_val = 2000;
		else if ($heap_size >= 100 && $heap_size <= 1000)
			$ulimit_val = 5000;
		else if ($heap_size >= 1000 && $heap_size <= 10000)
			$ulimit_val = intval($heap_size * 1.14);
		else if (($heap_size >= 10000) && ($heap_size <= 100000))
			$ulimit_val = intval($heap_size * 1.04);
		else
			$ulimit_val = intval($heap_size * 1.8);
	}

	/*if ($stack_size + 300 > $ulimit_val)
		$ulimit_val += 300;
	if (($stack_size) >= $ulimit_val)
		$ulimit_val += $stack_size;
	 */
	$ulimit_cmd .= " $ulimit_val 2>&1 && ";
}

#echo $ulimit_cmd;
if (strlen($def_Inputs) == 0) {
	$def_Inputs = "1 2 3 4 5 6 7 8";
}

$default_in = explode(" ", $def_Inputs); //split tableau des different input
$echo_inputs = "echo -n "; //effite le nextline
$i1=0;

#building echo command
while($i1 < count($default_in)){
    $echo_inputs .= $default_in[$i1];
    $echo_inputs .= " ";
    $i1++;
}


### build ulimit if gc_on


### echo -n input1 input2 input3 ...
$version = $_POST["version"];
$pipe = " | ";

$user_run_cmd = $echo_inputs . $pipe . "timeout -k 9 2m ";  # build the echo cmd and the pipe

$ref_run_cmd_path = " ../resources/references/";
$ref_run_cmd = "";

$ref_run_cmd = $echo_inputs . $pipe . "timeout -k 9 2m" . $ref_run_cmd_path . "refnjvm". $version . " ";


$refNJVMOutput = "";
$userNJVMOutput = "";
$compiled = false;


if ($uploadFileOk && $uploadTestOk) {
	# make the uploaded njvm file executable
	$makeExc = "chmod 755 ";
	$makeExc .= $file_name;
	exec($makeExc);
	###

	$user_run_cmd .= "./";
	$user_run_cmd .= $file_name . " ";

	$test_file_name = rebuild_test_file_name($test_parts, $test_ext);
	log_info($test_file_name);
	if ($test_ext == "nj" || $test_ext == "asm") {
		$compiler1 = "../resources/compilers/compile" . "$version ../uploads/" . $test_file_name;
		// TODO check error possibility
		exec($compiler1);
		log_info($compiler1);
		$compiled = true;
	}

	$timeout_included = false;
	if ($gc && ($version == 8)) {
		$user_run_cmd = "$ulimit_cmd $user_run_cmd";
		$ref_run_cmd = "$ulimit_cmd $ref_run_cmd";

		$timeout_included = true;
		$user_run_cmd .= "--stack $stack_size --heap $heap_size ";
		$ref_run_cmd .= "--stack $stack_size --heap $heap_size ";
		if ($gc_stats_opt) {
			$user_run_cmd .= "--gcstats ";
			$ref_run_cmd .= "--gcstats ";
		}
		if ($gc_purge_opt) {
			$user_run_cmd .= "--gcpurge ";
			$ref_run_cmd .= "--gcpurge ";
		}
	}

	if ($compiled) {
		$user_run_cmd .= "../uploads/" . $test_file_name;
		$ref_run_cmd .= "../uploads/" . $test_file_name;
	} else {
		# we can direct excute the file
		$user_run_cmd .= "../uploads/" . $test_name;
		$ref_run_cmd .= "../uploads/" . $test_name;
	}

	$user_run_cmd .= " 2>&1";
	$ref_run_cmd .= " 2>&1";

	$user_run_cmd = "bash -c \"$user_run_cmd\"";
	$ref_run_cmd = "bash -c \"$ref_run_cmd\"";
}

# " 2>/dev/null";
#log_info($user_run_cmd);
#log_info($ref_run_cmd);

exec($user_run_cmd, $userNJVMOutput, $ret1); # ret1 to get some errors
exec($ref_run_cmd, $refNJVMOutput, $ret2);

#echo "$ret1 <br>";
#echo "$re2";

$user_njvm_output = ""; # to build the user njvm outputs
$ref_njvm_output = ""; # to build the ref njvm outputs

$i2 = 0;
while ($i2 < count($userNJVMOutput)) {
	$user_njvm_output .= nl2br($userNJVMOutput[$i2] . "\n");
	$i2++;
}
$i2 = 0;
while ($i2 < count($refNJVMOutput)) {
	$ref_njvm_output .= nl2br($refNJVMOutput[$i2] . "\n");
	$i2++;
}

## clean Steps
$rmv1_cmd = "cd ../uploads/cmd && /bin/sh .file_remover && cd - 2>/dev/null";
$rmv2_cmd = "rm " . $file_name . " 2>/dev/null";

exec($rmv1_cmd);
exec($rmv2_cmd);

##


if (strcmp($user_njvm_output, $ref_njvm_output) == 0) {
	$test_result = "<h1 style=\"color:green;\">Test passed</h1>";
} else {
	$test_result = "<h1 style=\"color:red;\">Test not passed</h1>";
}

include "assessment_result.php";
