<!DOCTYPE html>
<html>
  <head>
          <meta charset="utf-8" />
          <link rel="stylesheet" href="style.css" />
          <title>KSP certain-Tester</title>
  </head>
  <body>
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
      <input type="text" name="defaultInput">  e.g. : 12 3 34 ...<br><br><br>
      <input type="submit" name="submit">
    </form>

  </body>
</html>
