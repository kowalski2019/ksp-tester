# ksp-tester Powered by

* Claude Stephane Manace Kouame
* Donald Donchi FofackCancel Changes
* Stephane Sob Fouodji
* Bright Baah

## Start KSP-Tester localy without a docker container
- launch the bash script ' **./startMyPhpServer** '
- and join the homepage on : localhost:4000/src/homepage.php

## About the Shell script ' runner '
The shell script 'runner' makes all necessary copies of files for the docker,
creates an image of the KSP-Tester and finally starts the application in a docker container.
We can pass him the options:
- 'build' : it will just create the image
- 'start': does not build the image but just starts the docker container
- no argument: create the image and start the docker container automatically

### Build the KSP-Tester docker-image
- launch the bash script ' **./runner build** '

### Run the KSP-Tester in a docker container
- launch the bash script ' **./runner start** '

### Build and run KSP-Tester localy in docker container
- launch the bash script ' **./runner**'
- and join the homepage on : localhost:5000/src

### Pull container image and start the KSP-Tester
 you just have to pull the image and run the command like the example below.
 ```
 sudo docker pull ghcr.io/kowalski2019/ksp_tester_img:latest
 ```
 ```
 sudo docker run -d --restart=always -p 5000:80 --name ksp_server ghcr.io/kowalski2019/ksp_tester_img:latest 
 ```
