<?php 


  
    $version = $_POST['version'];

    $grep_cmd = " | grep -iE ^v$version.*";
    $cmd_get_allTest="ls ../resources/bin_test_files$grep_cmd";

    exec($cmd_get_allTest, $results, $error);
    # json datei
    echo json_encode($results);

?>

