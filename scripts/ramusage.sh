#!/bin/bash

TMP=`ps aux | grep -v grep | grep "$1" | awk '{print $6}'`
SUM=0
for line in $TMP
do
SUM=$(($SUM + $line))
done
echo $SUM

