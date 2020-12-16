<!DOCTYPE html>
<html>
<head>
<title>KSP Tester | Powered by @csmk</title>
</head>
<body>
<h1>Tester Service</h1>
<form action="upload.php" method="post" enctype="multipart/form-data">
  Select your Virtual-Machine to upload:
  <input type="file" name="fileToUpload" id="fileToUpload"> e.g. : njvm (Your compiled machine)<br><br>
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
  Select a Ninja, ASM or Binary file to upload:
  <input type="file" name="testFile" id="testFile"> e.g. : test.nj, test.asm or test.bin(test)<br><br>
  Give some default inputs if necessary:
  <input type="text" name="defaultInput">  e.g. : 12 3 34 ...<br><br><br>
  <input type="submit" name="submit">
</form>

</body>
</html>
