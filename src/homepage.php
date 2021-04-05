<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>KSP Tester | Welcome</title>
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
              <a class="nav-link" href="contact.php" >Contact</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="help.php" >Help</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container-fluid" id="welcomePage" >
        <form action="site.php" method="post" enctype="multipart/form-data">

                <h1 class="first">Welcome to <span class="emphasis">Ksp-tester</span></h1>



                <fieldset id="menu">
                    <h2 class="second">How can ksp-tester help you?<h2>

<div class="third">
                    <input  type="radio" name="choice" value="self-test" id="radio" /> <label for="self-test">Test your virtual machine with a self-written test</label><br />
                    <input  type="radio" name="choice" value="certain-test" id="radio" checked /> <label for="certain-test">Test certain functionality of your virtual machine</label><br />
                   <!--
                    <input type="radio" name="choice" value="auto-test" id="radio"  /> <label for="certain-test">Evaluate your ninja virtual machine</label><br />
                   -->
                   <input class="btn btn-success" type="submit" value="OK" name="ok" id="button"/>
      </div>

                </fieldset>




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
