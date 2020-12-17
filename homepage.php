<?php 
    $choise=$_POST['choice'];

    if (isset ($_POST['choice'])){
        
           
            
            if (strcmp($_POST['choice'],"self-test")==0){
                include "site.php";
               
            }
            else if(strcmp($_POST['choice'],"certain-test")==0){

             }
            else if(strcmp($_POST['choice'],"auto-test")==0){

            }
    }
    
?>