<?php 
 echo '
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
  <nav class="navbar navbar-expand-lg navbar-custom">
          <div class="container-fluid">
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
              <a class="nav-link" href="about.php">About</a>
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
        <div class="container-fluid">
    <h1>Tester Service</h1>
    <form action="upload2.php" method="post" enctype="multipart/form-data">
      Select your Virtual-Machine to upload:
      <input type="file" name="fileToUpload" id="fileToUpload" required/> e.g. : njvm (Your compiled machine)<br><br>
      <label for="Version">Choose a version:</label>
      <select name="version" id="version">

        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>

      </select>
      <br><br>
      Give some default inputs if necessary:
      <input type="text" name="defaultInput" id="text"/>  e.g. : 12 3 34 ...<br><br><br>
      <input type="submit" name="submit" id="button">
    </form>
    </div>
    <!-- jQuery library -->
                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                      <!-- Popper JS -->
                      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

                      <!-- Latest compiled JavaScript -->
                      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  </body>
</html>
'; 
 ?>
