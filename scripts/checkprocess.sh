#!/bin/bash
if ps ax | grep -v grep | grep -v checkprocess | grep "$1" > /dev/null
then
echo "online";
else
echo "offline";
fi
