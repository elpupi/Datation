#!/bin/bash

for (( i=1; i<10000; i++))
do
    echo $i > "files/$i.txt";
done
