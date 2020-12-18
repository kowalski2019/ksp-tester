<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>KSP Tester | Welcome</title>
    </head>
    <body>
        <form action="site.php" method="post" enctype="multipart/form-data">
            <div id="bloc_page">
                <h1>welcome to Ksp-tester</h1>
            
            </div>

                <fieldset id="menu">
                    <legend>How can ksp-tester help you?</legend>
                
                   
                    <input type="radio" name="choice" value="self-test" id="self-test" /> <label for="self-test">Test your virtual machine with a self-written test</label><br />
                    <input type="radio" name="choice" value="certain-test" id="certain-test" checked /> <label for="certain-test">Test certain functionality of your virtual machine</label><br />
                    <input type="radio" name="choice" value="auto-test" id="auto-test"  /> <label for="certain-test">Evaluate your ninja virtual machine</label><br />
                    <input type="submit" value="OK" name="ok"/>
                    
                </fieldset>
            
            
        </form>
    </body>
</html>
