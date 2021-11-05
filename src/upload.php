<?php //begin

/*global variables */
$actualName = "a";
$file_name = "";
$test_name = "";
$uploadFileOk = false;
$uploadTestOk = false;

/* functions */
function generate_name($name){
	$result = "";
	$tail = "";
	$test = 0;
	$i = 0;
	$n_size = strlen($name);
	while($i < $n_size){
		if($name[$i] == 'z')
			$test += 1;
		$i += 1;
	}

	if($test == $n_size){
		$i = 0;
		while($i < $test+1){
			$result .= "a";
			$i += 1;
		}
	}
	else {
		$j = $n_size - 1;
		while($name[$j] == 'z'){
			$tail .= "a";
			$j -= 1;
		}
		$result = substr($name, 0, $j);
		$result .= chr(ord($name[$j]) + 1).$tail;
	}
	return $result;
}


 if(isset($_FILES["fileToUpload"])){ // check if a file was be selected
    $errors = array(); // empty array for erros
    $file_name = $_FILES["fileToUpload"]["name"]; // retrieving the njvm file name
    $tmp_ac_name = generate_name($actualName);
    $file_name .= $tmp_ac_name;
    $actualName = $tmp_ac_name;
    $file_size = $_FILES["fileToUpload"]["size"];//taille
    $file_tmp = $_FILES["fileToUpload"]["tmp_name"];//nom temporaire qui nous aide a deplacer notre fichier dans ntre server
    $file_type = $_FILES["fileToUpload"]["type"];//type
    $file_parts = explode(".", $file_name);//extension du fichier
    $file_ext = strtolower(end($file_parts));//extention du fichier en Lowercase
    $target_dir = "uploads"; //dossier ou tout les uploads atterir(fichier test)

    if($file_size > 134217728){
        $errors[] = "File to large";
    }
    if(empty($errors) == true){//si errors est vide il n y a pas d erreur
        move_uploaded_file($file_tmp, "$file_name");//deplace le fichier upload dans le server
        $uploadFileOk = true;
     }else{
        echo "Somethings went wrong";
        print_r($errors);
     }
 }

 if(isset($_FILES["testFile"])){
    $errors1 = array();
    $tmp_ac_name = generate_name($actualName);
    $test_name = $tmp_ac_name;
    $actualName = $tmp_ac_name;
    $test_name .= $_FILES["testFile"]["name"];
    $test_size = $_FILES["testFile"]["size"];
    $test_tmp = $_FILES["testFile"]["tmp_name"];
    $test_type = $_FILES["testFile"]["type"];
    $test_parts = explode(".", $test_name);
    $test_ext = strtolower(end($test_parts));
    $target_dir = "../uploads";
    $extensions = array("nj", "asm", "bin", "");

    if($test_size > 134217728){
        $errors1[] = "Test file to large";
    }
    if(in_array($test_ext, $extensions) === false){
        $errors1[]="extension not allowed, please choose a nj,asm or bin file.";
     }
    if(empty($errors1) == true){
        move_uploaded_file($test_tmp, "$target_dir/$test_name");
        $uploadTestOk = true;
     }else{
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

	if(count($gc_opt) == 2) {
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
if(strlen($do_gc) != 0) {
	if (strcmp($do_gc, "yes") == 0)
		$gc = true;

	if(strlen($stack_size) == 0)
		$stack_size = 64;
	if(strlen($heap_size) == 0){
		$heap_size = $heap_default_size;
	}
	else{
		$heap_size = intval($heap_size);
		# 1.12 if < 10 000
		# 1.04 if < 100 000
		# 1.08 if < 1 000 000
		if ($heap_size < 100)
			$ulimit_val = 2000;
		else if($heap_size >= 100 && $heap_size <= 1000)
			$ulimit_val = 5000;
		else if ($heap_size >= 1000 && $heap_size <= 10000)
			$ulimit_val = intval($heap_size * 1.14);
		else if(($heap_size >= 10000) && ($heap_size <= 100000))
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
if(strlen($def_Inputs) == 0) {
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
$pipe = "|";

$own_cmd = $echo_inputs.$pipe." ";  # build the echo cmd and the pipe

$ref_cmd_path = " ../resources/references/";
$ref_cmd = "";
if($version == 2){
	$ref_cmd = $echo_inputs.$pipe.$ref_cmd_path."refnjvm2 ";
}
else if($version == 3){
	$ref_cmd = $echo_inputs.$pipe.$ref_cmd_path."refnjvm3 ";
}
else if($version == 4){
	$ref_cmd = $echo_inputs.$pipe.$ref_cmd_path."refnjvm4 ";
}
else if($version == 5){
	$ref_cmd = $echo_inputs.$pipe.$ref_cmd_path."refnjvm5 ";
}
else if($version == 6){
	$ref_cmd = $echo_inputs.$pipe.$ref_cmd_path."refnjvm6 ";
}
else if($version == 7){
	$ref_cmd = $echo_inputs.$pipe.$ref_cmd_path."refnjvm7 ";
}
else if($version == 8){
	$ref_cmd = $echo_inputs.$pipe.$ref_cmd_path."refnjvm8 ";
}

/*
if($version<=4){
    $ref_cmd=$echo_inputs.$pipe." ./refnjvm4 "; //. pour concatener les strings
}else $ref_cmd=$echo_inputs.$pipe." ./refnjvm8 ";

*/


$RefOutput = "";
$OwnOutput = "";
$compiled = false;


if($uploadFileOk && $uploadTestOk){
    # make the uploaded file executable
    $makeExc = "chmod 755 ";
    $makeExc .= $file_name;
    exec($makeExc);
    ###

    $own_cmd .= "./";
    $own_cmd .= $file_name." ";


    if($version == 2){
        if($test_ext == "nj" || $test_ext == "asm"){
		$compiler1 = "../resources/compilers/compile2 ../uploads/".$test_parts[0];
             	// TODO check error possibility
            	exec($compiler1);
		$compiled = true;
        }
        ### ready for test
    }
    else if($version == 3 ){
        if($test_ext == "nj" || $test_ext == "asm"){
		$compiler1 = "../resources/compilers/compile3 ../uploads/".$test_parts[0];
             	// TODO check error possibility
            	exec($compiler1);
            	$compiled = true;
        }
        ### ready for test
    }
    else if($version == 4){
	    if($test_ext == "nj" || $test_ext == "asm"){
		$compiler1 = "../resources/compilers/compile4 ../uploads/".$test_parts[0];
            	// TODO check error possibility
            	exec($compiler1);
            	$compiled = true;
        }
        ### ready for test
    }
    else if($version == 5){
        if($test_ext == "nj" || $test_ext == "asm"){
		$compiler1 = "../resources/compilers/compile5 ../uploads/".$test_parts[0];
            	// TODO check error possibility
            	exec($compiler1);
            	$compiled = true;
	}
        ### ready for test
    }
    else if($version == 6){
        if($test_ext == "nj" || $test_ext == "asm"){
		$compiler1 = "../resources/compilers/compile6 ../uploads/".$test_parts[0];
             	// TODO check error possibility
            	exec($compiler1);
            	$compiled = true;
	}
        ### ready for test
    }
    else if($version == 7){
        if($test_ext == "nj" || $test_ext == "asm"){
		$compiler1 = "../resources/compilers/compile7 ../uploads/".$test_parts[0];
             	// TODO check error possibility
            	exec($compiler1);
            	$compiled = true;
       	}
        ### ready for test
    }

    else {
        if($test_ext == "nj" || $test_ext == "asm"){
		$compiler1 = "../resources/compilers/compile8 ../uploads/".$test_parts[0];
 		// TODO check error possibility
		exec($compiler1);
		$compiled = true;
	}
    }

    if ($gc && $version == 8) {
	    $own_cmd = "$ulimit_cmd $own_cmd";
	    $ref_cmd = "$ulimit_cmd $ref_cmd";

	    $own_cmd .= "--stack $stack_size --heap $heap_size ";
	    $ref_cmd .= "--stack $stack_size --heap $heap_size ";
	    if($gc_stats_opt) {
		$own_cmd .= "--gcstats ";
		$ref_cmd .= "--gcstats ";
	    }
	    if($gc_purge_opt) {
		$own_cmd .= "--gcpurge ";
		$ref_cmd .= "--gcpurge ";
	    }
    }

    if($compiled){
        $own_cmd .= "../uploads/".$test_parts[0];
        $ref_cmd .= "../uploads/".$test_parts[0];
    }
    else {
	# we can direct excute the file
        $own_cmd .= "../uploads/".$test_name;
        $ref_cmd .= "../uploads/".$test_name;
    }

    $own_cmd .= " 2>&1";
    $ref_cmd .= " 2>&1";

    $own_cmd = "bash -c \"$own_cmd\"";
    $ref_cmd = "bash -c \"$ref_cmd\"";

}

# " 2>/dev/null";
#echo "$own_cmd <br>";
#echo $ref_cmd;

exec($own_cmd, $OwnOutput, $ret1); # ret1 to get some errors
exec($ref_cmd, $RefOutput, $ret2);

#echo "$ret1 <br>";
#echo "$re2";

$own_output = ""; # to build the user njvm outputs
$ref_output = ""; # to build the ref njvm outputs

$i2 = 0;
while($i2 < count($OwnOutput)){
    $own_output .= nl2br($OwnOutput[$i2]."\n");
	$i2++;
}
$i2 = 0;
while($i2 < count($RefOutput)){
    $ref_output .= nl2br($RefOutput[$i2]."\n");
	$i2++;
}

## clean Steps
$rmv1_cmd = "cd ../uploads/cmd && sh .file_remover && cd - 2>/dev/null";
$rmv2_cmd = "rm ".$file_name." 2>/dev/null";

exec($rmv1_cmd);
exec($rmv2_cmd);

##


if(strcmp($own_output,$ref_output) == 0){
    $test_result = "<h1 style=\"color:green;\">Test passed</h1>";
}else{
    $test_result = "<h1 style=\"color:red;\">Test not passed</h1>";
}

include "assessment_result.php";


?>
