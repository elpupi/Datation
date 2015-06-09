#!/bin/bash

test () {
    for (( i=$1*100+1; i<=$1*100+100; i++))
    do
        curl --form "fileupload=@files/$i.txt" http://localhost/Timeland/web/app_dev.php/dropzone
    done
}

#for (( i=0; i<99; i++))
for (( i=0; i<4; i++))
do
    test $i &
done
