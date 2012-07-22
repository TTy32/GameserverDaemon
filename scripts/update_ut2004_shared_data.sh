#!/usr/bin/env bash

### USER CONFIG
ut2004_shared_data=~/ut2004/ut2004_shared_data
dirs=(~/ut2004/ballistic_freon_1 ~/ut2004/fbdg_friends_1)
### END USER CONFIG

echo starting..

for i in "${dirs[@]}"
do
	find ${ut2004_shared_data}/* -maxdepth 1 -type d -exec bash -c 'mkdir ${0}/`basename {}`' $i \; #1>/dev/null 2>&1
	find ${ut2004_shared_data} -maxdepth 1 -type d -exec bash -c 'sudo mount --bind {} ${0}/`basename {}`' $i \; #1>/dev/null 2>&1
done

