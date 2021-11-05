<!DOCTYPE html>
<html>
  <head>
          <meta charset="utf-8" />
          <link rel="stylesheet" href="style.css" />
          <title>KSP certain-Tester</title>
          <!-- Latest compiled and minified CSS -->
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
          <link rel="shortcut icon" href="../resources/pictures/icon3.jpeg" type="image/x-icon">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-custom" >
          <div class="container-fluid" >
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ">
            <li class="nav-item ">
              <a class="nav-link" href="homepage.php"> </i>Home</a>
            </li>

            <li class="nav-item ">
              <a class="nav-link" href="contact.php" >Contact</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="help.php" >Help</a>
            </li>
          </ul>
        </div>
          </div>
        </nav>
        <div class="container-fluid" id="site2Page">
    <fieldset id="menu2">

    <legend>Tester Service</legend>

    <form action="upload1.php" method="post" enctype="multipart/form-data">
      Select your Virtual-Machine to upload:
      <input type="file" name="fileToUpload" id="fileToUpload" required/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp e.g. : njvm (Your compiled machine)<br><br>

      <label for="test"> Select a Ninja, ASM or Binary file to upload: </label>
      <select name="test" id="test">
            <?php
                    $head='<option value="';
                    $middle='">';
                    $tail='</option>';
                    $select_list='';
                    $cmd_get_allTest='ls ../resources/bin_test_files';
                    $version='2';
                    $all_test=Array();
                    $t_index=0;
                    $i=2;
                    $cmd_get_allTest1='ls ../resources/bin_test_files';
                    exec($cmd_get_allTest1, $results, $ret);
                    $j=0;
                        while($j<count($results)){
                            $select_list=$head.$results[$j].$middle.$results[$j].$tail.'\n';
                            echo $select_list;
                            $j += 1;
                        }
            ?>
            </select> e.g. : test.nj, test.asm or test.bin(test)<br><br>
      Give some default inputs if necessary:
      <input type="text" name="defaultInput" id="text"/>  e.g. : 12 3 34 ...<br><br>

      <p>Test the functionality of your Garbage Collector (available only for the version 8)</p>

      <input type="radio" id="gc1" name="gc" value="yes">
      <label for="gc1">yes</label>&nbsp
      <input type="radio" id="gc2" name="gc" value="no" checked>
      <label for="gc2">no</label><br><br>
     <p>Fill in these fields below only if you have opted to test with the garbage collector !<br>
       Attention! Please make sure that the stack size does not exceed the size of the heap. </p>

      <input type ="text" name="s_size" style="width: 100px; height: 30px"> stack size</input> &nbsp&nbsp
      <input type ="text" name="h_size" style="width: 100px; height: 30px"> heap size</input><br>
      <input type="checkbox" id="gcstats" name="gc_opt[]" value="stats">
      <label for="gcstats"> gcstats </label> &nbsp
      <input type="checkbox" id="gcpurge" name="gc_opt[]" value="purge">
      <label for="gcpurge"> gcpurge </label><br><br><br>

      <input class="btn btn-success" type="submit" name="submit" id="button"/>
    </form>
    </fieldset>
    </div>
    <!-- jQuery library -->
                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                      <!-- Popper JS -->
                      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

                      <!-- Latest compiled JavaScript -->
                      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  </body>
</html>
