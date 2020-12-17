<!DOCTYPE html>
<html>
  <head>
          <meta charset="utf-8" />
          <link rel="stylesheet" href="style.css" />
          <title>KSP certain-Tester</title>
  </head>
  <body>
    <h1>Tester Service</h1>
    <form action="homepage.php" method="post" enctype="multipart/form-data">
      Select your Virtual-Machine to upload:
      <input type="file" name="fileToUpload" id="fileToUpload"> e.g. : njvm (Your compiled machine)<br><br>
      <br><br>
      Select a Ninja, ASM or Binary file to upload:
      <select name="Test file" id="test">
      <select name="Test file" id="test_file">
      $select_test
      </select>
     e.g. : test.nj, test.asm or test.bin(test)<br><br>
      Give some default inputs if necessary:
      <input type="text" name="defaultInput">  e.g. : 12 3 34 ...<br><br><br>
      <input type="submit" name="submit">
    </form>

  </body>
</html>
