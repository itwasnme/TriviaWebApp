#!/bin/bash

SERVER=`jq -r .host info.json`
user=`jq -r .username info.json`
pword=`jq -r .password info.json`

command="mysql --host=$SERVER --user=$user --password=$pword"
echo $command

$command
$SHELL
