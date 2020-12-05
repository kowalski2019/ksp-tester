<?php
$file_name="";
$test_name="";
$uploadFileOk = false;
$uploadTestOk = false;

 if(isset($_FILES["fileToUpload"])){
    $errors= array();
    $file_name = $_FILES["fileToUpload"]["name"];
    $file_size =$_FILES["fileToUpload"]["size"];
    $file_tmp =$_FILES["fileToUpload"]["tmp_name"];
    $file_type=$_FILES["fileToUpload"]["type"];
    $file_parts=explode(".",$file_name);
    $file_ext=strtolower(end($file_parts));
    $target_dir = "uploads";

    if($file_size>134217728){
        $errors[]="File to large";
    }
    if(empty($errors)==true){
        move_uploaded_file($file_tmp,"$file_name");
        $uploadFileOk=true;
     }else{
        echo "Somethings went wrong";
        print_r($errors);
     }
 }

 if(isset($_FILES["testFile"])){
    $errors1= array();
    $test_name = $_FILES["testFile"]["name"];
    $test_size =$_FILES["testFile"]["size"];
    $test_tmp =$_FILES["testFile"]["tmp_name"];
    $test_type=$_FILES["testFile"]["type"];
    $test_parts=explode(".",$test_name);
    $test_ext=strtolower(end($test_parts));
    $target_dir = "uploads";
    $extensions= array("nj","asm","bin","");

    if($test_size>134217728){
        $errors1[]="Test file to large";
    }
    if(in_array($test_ext,$extensions)=== false){
        $errors1[]="extension not allowed, please choose a nj,asm or bin file.";
     }
    if(empty($errors1)==true){
        move_uploaded_file($test_tmp,"$target_dir/$test_name");
        $uploadTestOk=true;
     }else{
        print_r($errors1);
     }
 }

$def_Inputs = $_POST["defaultInput"];
$default_in=explode(" ",$def_Inputs);
$echo_inputs="echo -n ";
$i1=0;

#building echo command
while($i1<count($default_in)){
    $echo_inputs.=$default_in[$i1];
    $echo_inputs.=" ";
    $i1++;
}
###
$version= $_POST["version"];
$pipe="|";
$own_cmd=$echo_inputs.$pipe." ";

if($version<=4){
    $ref_cmd=$echo_inputs.$pipe." ./refnjvm4 ";
}else $ref_cmd=$echo_inputs.$pipe." ./refnjvm8 ";

$RefOutput="";
$OwnOutput="";
$compiled=false;


if($uploadFileOk && $uploadTestOk){
    # make the uploaded file executable
    $makeExc="chmod 755 ";
    $makeExc.=$file_name;
    exec($makeExc);
    ###

    $own_cmd.="./";
    $own_cmd.=$file_name." ";

    # check the test file
    if($version <= 4){
        if($test_ext=="nj" || $test_ext=="asm"){
            $compiler1="./compile4 uploads/".$test_parts[0];
            exec($compiler1);
            $compiled=true;
        }
        ### reday for test

    }
    else {
        if($test_ext=="nj" || $test_ext=="asm"){
            $compiler1="./compile8 uploads/".$test_parts[0];
            exec($compiler1);
            $compiled=true;
        }
    }

    if($compiled){
        $own_cmd.="uploads/".$test_parts[0];
        $ref_cmd.="uploads/".$test_parts[0];
    }
    else {
        $own_cmd.="uploads/".$test_name;
        $ref_cmd.="uploads/".$test_name;
    }
}

#echo "$own_cmd <br>";
#echo $ref_cmd;

exec($own_cmd,$OwnOutput,$ret1);
exec($ref_cmd,$RefOutput,$ret2);

$own_output="";
$ref_output="";

$i2=0;
while($i2<count($OwnOutput)){
    $own_output.=nl2br($OwnOutput[$i2]."\n");
	$i2++;
}
$i2=0;
while($i2<count($RefOutput)){
    $ref_output.=nl2br($RefOutput[$i2]."\n");
	$i2++;
}

## clean Steps
$rmv1_cmd="cd uploads && sh .file_remover && cd .. 2>/dev/null";
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
