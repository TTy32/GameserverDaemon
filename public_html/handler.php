<?php


function reverse_logfile($file_argument)
{
	$counter = 0;
	$line = array();
	$file_handle = @fopen($file_argument, "r");
	if ($file_handle != false)
	{
		while (!feof($file_handle) && $counter < 100) {
			$line_of_file = fgets($file_handle);
			if ($line_of_file !== false)
			{
				array_push($line, $line_of_file);
			}
			else
			{
				break;
			}
			$counter++;
		}
		fclose($file_handle);

		$counter--;
		array_reverse($line);

		for ($i = $counter; $i > -1; $i--)
		{
			echo $line[$i] . "<br>";
		}
	}
}

if ($_POST["command"] == "getLog")
{
	reverse_logfile("./game_management/" . $_POST["game"] . "-server.log");
	return;
}
elseif ($_POST["command"] == "getStatus")
{
	if (file_exists("./game_management/" . $_POST["game"] . "-server_is_alive"))
	{
		echo "1";
		return;
	}
	else
	{
		echo "0";
		return;
	}
}
elseif ($_POST["command"] == "processEvent")
{
	switch ($_POST["action"])
	{
		case "start":
			touch ("./game_management/" . $_POST["game"] . "-cmd_start");
		break;
		case "stop":
			touch ("./game_management/" . $_POST["game"] . "-cmd_stop");
		break;
		case "restart":
			touch ("./game_management/" . $_POST["game"] . "-cmd_restart");
		break;
	}
	return;
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
