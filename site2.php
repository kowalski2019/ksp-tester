<!DOCTYPE html>
<html>
  <head>
          <meta charset="utf-8" />
          <link rel="stylesheet" href="style.css" />
          <title>KSP certain-Tester</title>
          <!-- Latest compiled and minified CSS -->
                            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-custom">
          <div class="container-fluid">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ">
                <li class="nav-item ">
                  <a class="nav-link" href="#"></i>Home</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="#" >Contact</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <div class="container-fluid">
    <fieldset id="menu2">

    <legend>Tester Service</legend>

    <form action="upload1.php" method="post" enctype="multipart/form-data">
      Select your Virtual-Machine to upload:
      <input type="file" name="fileToUpload" id="fileToUpload" required/> e.g. : njvm (Your compiled machine)<br><br>

      <label for="test"> Select a Ninja, ASM or Binary file to upload: </label>
      <select name="test" id="test">
            <?php
                    $head='<option value="';
                    $middle='">';
                    $tail='</option>';
                    $select_list='';
                    $cmd_get_allTest='ls KSP_Test/ksp_test';
                    $version='2';
                    $all_test=Array();
                    $t_index=0;
                    $i=2;
                    $cmd_get_allTest1='ls KSP_Test/';
                    exec($cmd_get_allTest1, $results, $ret);
                    $j=0;
                        while($j<count($results)){
                            $select_list=$head.$results[$j].$middle.$results[$j].$tail.'\n';
                            echo $select_list;
                            $j += 1;
                        }
            ?>
            </select>

     e.g. : test.nj, test.asm or test.bin(test)<br><br>
      Give some default inputs if necessary:
      <input type="text" name="defaultInput" id="text"/>  e.g. : 12 3 34 ...<br><br><br>
      <input type="submit" name="submit" id="button"/>
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
