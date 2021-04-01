<?php //begin

/*static variables */
$actualName="a";
$file_name=""; //variable commence par &
$test_name="";
$uploadFileOk = false;
$uploadTestOk = false;

/* functions */
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

 if(isset($_FILES["testFile"])){
    $errors1= array();
    $tmp_ac_name=generate_name($actualName);
    $test_name=$tmp_ac_name;
    $actualName = $tmp_ac_name;
    $test_name .= $_FILES["testFile"]["name"];
    $test_size =$_FILES["testFile"]["size"];
    $test_tmp =$_FILES["testFile"]["tmp_name"];
    $test_type=$_FILES["testFile"]["type"];
    $test_parts=explode(".",$test_name);
    $test_ext=strtolower(end($test_parts));
    $target_dir = "../uploads";
    $extensions= array("nj","asm","bin","");

    if($test_size>134217728){
        $errors1[]="Test file to large";
    }
    if(in_array($test_ext,$extensions)=== false){//est que l extension est dans l arrays
        $errors1[]="extension not allowed, please choose a nj,asm or bin file.";
     }
    if(empty($errors1)==true){
        move_uploaded_file($test_tmp,"$target_dir/$test_name");
        $uploadTestOk=true;
     }else{
        print_r($errors1);
     }
 }

$def_Inputs = $_POST["defaultInput"]; //recuperation des valeurs du default input
$default_in=explode(" ",$def_Inputs); //split tableau des different input
$echo_inputs="echo -n "; //effite le nextline
$i1=0;

#building echo command
while($i1<count($default_in)){
    $echo_inputs.=$default_in[$i1];
    $echo_inputs.=" ";
    $i1++;
}
### echo -n input1 input2 input3 ...
$version= $_POST["version"];
$pipe="|";
$own_cmd=$echo_inputs.$pipe." "; //construction la commande pour executer la machine virtuelle du user

$ref_cmd_path="../resources/references/";
$ref_cmd="";
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


$RefOutput="";
$OwnOutput="";
$compiled=false;


if($uploadFileOk && $uploadTestOk){
    # make the uploaded file executable
    $makeExc="chmod 755 ";
    $makeExc.=$file_name;
    exec($makeExc); //execute la comande coe sur le terminal
    ###

    $own_cmd.="./";
    $own_cmd.=$file_name." ";


    if($version == 2){
        if($test_ext=="nj" || $test_ext=="asm"){
		$compiler1="../resources/compilers/compile2 ../uploads/".$test_parts[0];
             	// TODO check error possibility
            	exec($compiler1);
		$compiled=true;
        }
        ### ready for test
    }
    else if($version ==3 ){
        if($test_ext=="nj" || $test_ext=="asm"){
		$compiler1="../resources/compilers/compile3 ../uploads/".$test_parts[0];
             	// TODO check error possibility
            	exec($compiler1);
            	$compiled=true;
        }
        ### ready for test
    }
    else if($version == 4){
	    if($test_ext=="nj" || $test_ext=="asm"){
		$compiler1="../resources/compilers/compile4 ../uploads/".$test_parts[0];
            	// TODO check error possibility
            	exec($compiler1);
            	$compiled=true;
        }
        ### ready for test
    }
    else if($version == 5){
        if($test_ext=="nj" || $test_ext=="asm"){
		$compiler1="../resources/compilers/compile5 ../uploads/".$test_parts[0];
            	// TODO check error possibility
            	exec($compiler1);
            	$compiled=true;
	}
        ### ready for test
    }
    else if($version == 6){
        if($test_ext=="nj" || $test_ext=="asm"){
		$compiler1="../resources/compilers/compile6 ../uploads/".$test_parts[0];
             	// TODO check error possibility
            	exec($compiler1);
            	$compiled=true;
	}
        ### ready for test
    }
    else if($version == 7){
        if($test_ext=="nj" || $test_ext=="asm"){
		$compiler1="../resources/compilers/compile7 ../uploads/".$test_parts[0];
             	// TODO check error possibility
            	exec($compiler1);
            	$compiled=true;
       	}
        ### ready for test
    }

    else {
        if($test_ext=="nj" || $test_ext=="asm"){
		$compiler1="../resources/compilers/compile8 ../uploads/".$test_parts[0];
 		// TODO check error possibility
		exec($compiler1);
		$compiled=true;
	}
    }

    if($compiled){
        $own_cmd.="../uploads/".$test_parts[0]." 2>/dev/null";
        $ref_cmd.="../uploads/".$test_parts[0]." 2>/dev/null";
    }
    else {
        $own_cmd.="../uploads/".$test_name." 2>/dev/null";
        $ref_cmd.="../uploads/".$test_name." 2>/dev/null";
    }
}

#echo "$own_cmd <br>";
#echo $ref_cmd;

exec($own_cmd,$OwnOutput,$ret1); //ret1 erreur, ownoutput pour les output
exec($ref_cmd,$RefOutput,$ret2);

$own_output="";//pour re constuiter les erreurs
$ref_output="";

$i2=0;
while($i2<count($OwnOutput)){
    $own_output.=nl2br($OwnOutput[$i2]."\n");//php comprend le nextline
	$i2++;
}
$i2=0;
while($i2<count($RefOutput)){
    $ref_output.=nl2br($RefOutput[$i2]."\n");
	$i2++;
}

## clean Steps
$rmv1_cmd="cd ../uploads && sh .file_remover && cd - 2>/dev/null";
$rmv2_cmd="rm ".$file_name." 2>/dev/null";

exec($rmv1_cmd);
exec($rmv2_cmd);

##

if(strcmp($own_output,$ref_output)==0){
    echo "<h1>Test passed</h1>";
}else{
    echo "<h1>Test not passed</h1>";
}

include "assessment_result.php";


?>
