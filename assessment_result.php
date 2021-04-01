<!DOCTYPE html>
<html>
<head>
  <title>Assessment Result | Powered by @csmk</title>
  <link rel="shortcut icon" href="picture/icon3.jpeg" type="image/x-icon">
  <style>
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
    </style>

    </head>
    <body>
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

</body>
</html>