#!/bin/bash

test () {
    for (( i=$1*100+1; i<=$1*100+100; i++))
    do
        curl --form "fileupload=@files/$i.txt" http://localhost/Timeland/web/app_dev.php/dropzone
    done
}

test2 () {
    for (( i=$1*100+1; i<=$1*100+100; i++))
    do
        nodejs selenium.js;
    done
}


#for (( i=0; i<99; i++))
#for (( i=0; i<4; i++))
#do
#    test $i #&
#done

curl --form "fileupload=@files/1.txt" http://localhost/Timeland/web/app_dev.php/dropzone
sleep 1s
curl --form "fileupload=@files/2.txt" http://localhost/Timeland/web/app_dev.php/dropzone
sleep 1s
curl --form "fileupload=@files/3.txt" http://localhost/Timeland/web/app_dev.php/dropzone
sleep 1s
curl --form "fileupload=@files/4.txt" http://localhost/Timeland/web/app_dev.php/dropzone

