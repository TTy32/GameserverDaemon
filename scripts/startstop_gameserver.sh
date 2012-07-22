#!/usr/bin/env bash

# Command line arguments: <ID> <working dir> <game server executable>
# E.g: <script-name.sh> ut2004 ut2004_dedicated ucc-bin

# Include config
source `dirname $0`/config.sh

file_stop=${web_interface_root}/game_management/${1}-cmd_stop
file_start=${web_interface_root}/game_management/${1}-cmd_start
file_restart=${web_interface_root}/game_management/${1}-cmd_restart
file_binary_arguments=${web_interface_root}/game_management/${1}-server_arguments
file_status=${web_interface_root}/game_management/${1}-server_is_alive

daemonize_game_workingdir=~/${2}
daemonize_game_binary=${daemonize_game_workingdir}/${3}
daemonize_game_stderr=${web_interface_root}/game_management/${1}-server.log
daemonize_game_stdout=${web_interface_root}/game_management/${1}-server.log
daemonize_game_pid=${daemonize_game_workingdir}/server.pid
daemonize_game_lock=${daemonize_game_workingdir}/server.lock

cmd_stop='kill `cat ${daemonize_game_pid}`'
cmd_start='${daemonize_executable} -c ${daemonize_game_workingdir} -e ${daemonize_game_stderr} -o ${daemonize_game_stdout} -p ${daemonize_game_pid} -l ${daemonize_game_lock} -v ${daemonize_game_binary} `cat ${file_binary_arguments}`'

while [ 0 ]; do
	if test -e ${file_start}; then
#		echo ">>> cmd_start >>> ${cmd_start}"
#		echo ">>> file_start >>> ${file_start}"
		eval ${cmd_start} > /dev/null 2>&1
		rm ${file_start} > /dev/null 2>&1
	fi

	if test -e ${file_stop}; then
#		echo ">>> cmd_start >>> ${cmd_stop}"
#		echo ">>> file_start >>> ${file_stop}"
		eval ${cmd_stop} > /dev/null 2>&1
		rm ${file_stop} > /dev/null 2>&1
		sleep ${sleep_time}
	fi

	if test -e ${file_restart}; then
		eval ${cmd_stop} > /dev/null 2>&1
		rm ${file_restart} > /dev/null 2>&1
		sleep ${sleep_time} > /dev/null 2>&1
		eval ${cmd_start}
	fi

	pid=`cat ${daemonize_game_pid}`
	if kill -s 0 ${pid} ; then
		touch ${file_status} > /dev/null 2>&1
	else
		rm ${file_status}
	fi

	sleep 1
done
