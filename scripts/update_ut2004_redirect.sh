#!/bin/bash

### USER CONFIG
redirect_dir=~/public_html/redirect
dirs=(~/ut2004/ballistic_freon_1 ~/ut2004/fbdg_friends_1)
### END USER CONFIG

echo starting..
rm ${redirect_dir}/*

for i in "${dirs[@]}"
do
	find $i -iname '*.ut2' -type f -exec ln --target-directory=${redirect_dir} -s {} basename {} \; 1>/dev/null 2>&1
	find $i -iname '*.ukx' -type f -exec ln --target-directory=${redirect_dir} -s {} basename {} \; 1>/dev/null 2>&1
	find $i -iname '*.uax' -type f -exec ln --target-directory=${redirect_dir} -s {} basename {} \; 1>/dev/null 2>&1
	find $i -iname '*.u'   -type f -exec ln --target-directory=${redirect_dir} -s {} basename {} \; 1>/dev/null 2>&1
	find $i -iname '*.utx' -type f -exec ln --target-directory=${redirect_dir} -s {} basename {} \; 1>/dev/null 2>&1
done

