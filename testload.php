<?php 
$head="<option value=\"";
$middle="\">";
$tail="</option>";
$select_list="";
$cmd_get_allTest="ls KSP_Test/ksp_test";
$version="2";
$all_test=Array();
$t_index=0;
$i=2;
while($i<9){
    exec($cmd_get_allTest.chr(ord($i)),$results,$ret);
    $all_test[$t_index]=$results;
    $i+=1;
}

// buid now thw select list
echo $all_test[0];
$i=0;
$j=0;

while($i<count($all_test)){
    while($j<count($all_test[$i])){
        $tmpTest_folder=$all_test[$i];
        $select_list.=nl2br($head.$tmpTest_folder[$j].$middle.$tmpTest_folder[$j].$tail);
        $j+=1;
    }
    $j=0;
    $i+=1;
}

// test if the final select list is ok

echo "<label name=\"cars\">Choose a car:</label>";

echo "<select name=\"cars \" id=\"cars\">";
 echo $select_list;
echo "</select>";
?>