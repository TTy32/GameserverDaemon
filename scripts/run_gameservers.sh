#!/usr/bin/env bash

### USER CONFIG
startstop_gameserver_script=./startstop_gameserver.sh
servers_list=~/gameserver_manager/public_html/servers.list
### END USER CONFIG

counter=0

while read line         
do         

	if [ "${line:0:1}" != "#" ] ; then

	arr=($(echo $line | tr " " "\n"))

	${startstop_gameserver_script} ${arr[0]} ${arr[1]} ${arr[2]} > /dev/null 2>&1 &

	fi
	((counter++))
done < ${servers_list}

