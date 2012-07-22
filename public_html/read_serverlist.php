<?php

function get_serverlist (& $ref)
{
	$ref = array();

	$lines = file ("servers.list");
	foreach ($lines as $key => $value)
	{
		if ( substr ($value, 0, 1) != '#') // Exclude first line (comment line)
		{
			$splitted = explode (' ', $value);
			$ref[$key - 1] = array();
			$ref[$key - 1][0] = $splitted[0];
			$ref[$key - 1][1] = $splitted[1];
			$ref[$key - 1][2] = $splitted[2];
		}
	}
}

?>
