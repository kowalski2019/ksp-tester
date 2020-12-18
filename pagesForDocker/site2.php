<?php

 echo "<!DOCTYPE html>
<html>
  <head>
          <meta charset=\"utf-8\" />
          <link rel=\"stylesheet\" href=\"style.css\" />
          <title>KSP certain-Tester</title>
  </head>
  <body>
    <h1>Tester Service</h1>
    <form action=\"upload1.php\" method=\"post\" enctype=\"multipart/form-data\">
      Select your Virtual-Machine to upload:
      <input type=\"file\" name=\"fileToUpload\" id=\"fileToUpload\" required/> e.g. : njvm (Your compiled machine)<br><br>

      <label for=\"test\"> Select a Ninja, ASM or Binary file to upload: </label>
      <select name=\"test\" id=\"test\">";

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
                        echo "<optgroup label=\"version$i\" >";
                        exec($cmd_get_allTest.chr(ord($i)),$results,$ret);
                        $j=0;
                        while($j<count($results)){
                            $select_list=$head.$results[$j].$middle.$results[$j].$tail."\n";
                            echo $select_list;
                            $j += 1;
                        }
                      //  $all_test[$t_index]=$results;
                        $i+=1;
                        echo "</optgroup>";
                    }

                    echo $select_list;

           echo  "</select>

     e.g. : test.nj, test.asm or test.bin(test)<br><br>
      Give some default inputs if necessary:
      <input type=\"text\" name=\"defaultInput\" id=\"text\"/>  e.g. : 12 3 34 ...<br><br><br>
      <input type=\"submit\" name=\"submit\" id=\"button\"/>
    </form>

  </body>
</html>";

?>
