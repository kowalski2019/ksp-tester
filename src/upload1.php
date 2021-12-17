<?php //begin

/*static variables */
$actualName="a";
$file_name=""; //variable commence par &
$test_name="";
$uploadFileOk = false;
$uploadTestOk = false;

/* functions */

function log_info($str) {
	echo "<script>console.log(".json_encode($str).") </script>";
}

function generate_name($name){
	$result="";
	$tail="";
	$test=0;
	$i=0;
	$n_size=strlen($name);
	while($i<$n_size){
		if($name[$i]=='z')
			$test+=1;
		$i+=1;
	}

	if($test==$n_size){
		$i=0;
		while($i<$test+1){
			$result.="a";
			$i+=1;
		}
	}
	else {
		$j=$n_size-1;
		while($name[$j]=='z'){
			$tail.="a";
			$j-=1;
		}
		$result=substr($name,0,$j);
		$result.=chr(ord($name[$j])+1).$tail;
	}
	return $result;
}


 if(isset($_FILES["fileToUpload"])){//verification si un fichier est select
    $errors= array(); //tableau vide
    $file_name = $_FILES["fileToUpload"]["name"]; //function standart du fichier on recupere le nom
    $tmp_ac_name=generate_name($actualName);
    $file_name.=$tmp_ac_name;
    $actualName = $tmp_ac_name;
    $file_size =$_FILES["fileToUpload"]["size"];//taille
    $file_tmp =$_FILES["fileToUpload"]["tmp_name"];//nom temporaire qui nous aide a deplacer notre fichier dans ntre server
    $file_type=$_FILES["fileToUpload"]["type"];//type
    $file_parts=explode(".",$file_name);//extension du fichier
    $file_ext=strtolower(end($file_parts));//extention du fichier en Lowercase
    $target_dir = "uploads"; //dossier ou tout les uploads atterir(fichier test)

    if($file_size>134217728){
        $errors[]="File to large";
    }
    if(empty($errors)==true){//si errors est vide il n y a pas d erreur
        move_uploaded_file($file_tmp,"$file_name");//deplace le fichier upload dans le server
        $uploadFileOk=true;
     }else{
        echo "Somethings went wrong";
        print_r($errors);
     }
 }

$test_name = $_POST["test"];

#save the name of the last test
exec("echo $test_name > .last_test.l", $res_l, $err_l);


$def_Inputs = $_POST["defaultInput"]; //recuperation des valeurs du default input

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
		if ($heap_size <= 100)
			$ulimit_val = 2000;
		else if($heap_size > 100 && $heap_size <= 1000)
			$ulimit_val = 5000;
		else if ($heap_size >= 1000 && $heap_size <= 10000)
			$ulimit_val = intval($heap_size * 1.14);
		else if(($heap_size >= 10000) && ($heap_size <= 100000))
			$ulimit_val = intval($heap_size * 1.04);
		else
			$ulimit_val = intval($heap_size * 1.8);

	}

	/*if (($stack_size + 300) > $ulimit_val)
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
$default_in=explode(" ",$def_Inputs);
$echo_inputs="echo -n ";
$i1=0;


#building echo command
while($i1<count($default_in)){
    $echo_inputs.=$default_in[$i1];
    $echo_inputs.=" ";
    $i1++;
}
### echo -n input1 input2 input3 ...

$version= substr($test_name, 1, 1);
$pipe="|";
$own_cmd=$echo_inputs.$pipe." "; //construction la commande pour executer la machine virtuelle du user



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

$RefOutput="";
$OwnOutput="";
$compiled=false;

if($uploadFileOk){
    # make the uploaded file executable
    $makeExc="chmod 755 ";
    $makeExc.=$file_name;
    exec($makeExc); //execute la comande coe sur le terminal
    ###

    $own_cmd.="./";
    $own_cmd.=$file_name." ";

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

    $own_cmd .= "../resources/bin_test_files/".$test_name." 2>&1";
    $ref_cmd .= "../resources/bin_test_files/".$test_name." 2>&1";

    $own_cmd = "bash -c \"$own_cmd\"";
    $ref_cmd = "bash -c \"$ref_cmd\"";

}

#log_info($own_cmd);
#log_info($ref_cmd);

exec($own_cmd, $OwnOutput, $ret1); //ret1 erreur, ownoutput pour les output
exec($ref_cmd, $RefOutput, $ret2);

#echo "$ret1 <br>";
#echo "$re2";

$own_output = "";//pour re constuiter les erreurs
$ref_output = "";

$i2 = 0;
while($i2 < count($OwnOutput)){
    $own_output .= nl2br($OwnOutput[$i2]."\n");//php comprend le nextline
	$i2++;
}

$i2 = 0;
while($i2 < count($RefOutput)){
    $ref_output .= nl2br($RefOutput[$i2]."\n");
	$i2++;
}

## clean Steps
#$rmv1_cmd="cd uploads && sh .file_remover && cd .. 2>/dev/null";
$rmv2_cmd = "rm ".$file_name." 2>/dev/null";

#exec($rmv1_cmd);
exec($rmv2_cmd);

##

if(strcmp($own_output,$ref_output)==0){
    $test_result="<h1 style=\"color:green;\">Test passed</h1>";
}else{
    $test_result="<h1 style=\"color:red;\">Test not passed</h1>";
}

include "assessment_result.php";


?>
