<!DOCTYPE html>
<html>
<head>
  <title>Assessment Result | Powered by @csmk</title>
  <link rel="shortcut icon" href="../resources/pictures/icon3.jpeg" type="image/x-icon">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
.navbar-brand {
background-image: url("../resources/pictures/icon3.jpeg");
background-repeat: no-repeat;
background-size: contain;
width: 25px;
height: 25px;
border-radius: 10px;
}
    .flex-container {
      display: flex;
      flex-wrap: nowrap;
      background-color: black;
    }

    .flex-container .box {
      background-color: #f1f1f1;
      width: 50%;
      margin: 5px;
      text-align: center;
      line-height: 40px;
      font-size: 20px;
    }
    .flex-container .box.boxIn {
      background-color: #f1f1f1;
      margin: 10px;
      text-align: center;
      line-height: 30px;
      font-size: 10px;
    }
.navbar-nav .nav-item:hover {
background-color: rgba(180, 190, 203, 0.4);
}
.navbar-custom{
background-color: #0f1a14;
}
.nav-link{
color: #f1f1f1;
}
.nav-link:hover{
color: yellow;
}
    </style>

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

     <?php echo $test_result; ?>
    <h1>Assessment Outputs</h1>

    <div class="flex-container">
      <div class="box">
        <h2>The Ref-Virtual Machine output<h2>
        <div class="boxIn">
        <p><?php echo $ref_output; ?></p>
        </div>
      </div>
      <div class="box">
        <h2>Your Virtual Machine output<h2>
          <div class="boxIn">
              <p><?php echo $own_output; ?></p>
          </div>
      </div>
    </div>

    <p></p>
    <p><strong></strong></p>

      <!-- jQuery library -->
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

                    <!-- Popper JS -->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

                    <!-- Latest compiled JavaScript -->
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
