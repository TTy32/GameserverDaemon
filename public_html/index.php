<?php
require ('read_serverlist.php');

$serverlist;
get_serverlist ($serverlist);

?>

<!DOCTYPiE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
<html lang="nl">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>GameserverDaemon</title>

	<link href="jquery-ui.css" rel="stylesheet" type="text/css"/>
	<script src="jquery.min.js"></script>
	<script src="jquery-ui.min.js"></script>

	<link href="style.css" rel="stylesheet" type="text/css"/>

	<script type="text/javascript">

	$(document).ready(function() {
		$("#tabs").tabs();

	<?php
		echo "\n"; // Correction
		foreach ($serverlist as $key => $value)
		{
			// jQuery buttons
			echo "\t"; echo '$("#btn_' . $value[0] . '_status").button({disabled:true});'; echo "\n";
			echo "\t"; echo '$("#btn_' . $value[0] . '_start").button();'; echo "\n";
			echo "\t"; echo '$("#btn_' . $value[0] . '_stop").button();'; echo "\n";
			echo "\t"; echo '$("#btn_' . $value[0] . '_restart").button();'; echo "\n";

			// jQuery events
			echo "\t"; echo '$("#btn_' . $value[0] . '_start").click(function() {'; echo "\n";
			echo "\t\t"; echo 'processEvent("' . $value[0] . '", "start");'; echo "\n";
			echo "\t"; echo '});'; echo "\n";

			echo "\t"; echo '$("#btn_' . $value[0] . '_stop").click(function() {'; echo "\n";
			echo "\t\t"; echo 'processEvent("' . $value[0] . '", "stop");'; echo "\n";
			echo "\t"; echo '});'; echo "\n";

			echo "\t"; echo '$("#btn_' . $value[0] . '_restart").click(function() {'; echo "\n";
			echo "\t\t"; echo 'processEvent("' . $value[0] . '", "restart");'; echo "\n";
			echo "\t"; echo '});'; echo "\n";
		}
	?>

	});

	function getLog(game)
	{
		function ajax_return (return_data)
		{
			document.getElementById("log_" + game).innerHTML = return_data; 
		}
		$.ajax ("handler.php", {type: "POST", dataType: "text", success: ajax_return, data: "command=getLog&game=" + game});
	}

	function getStatus(game)
	{
		function ajax_return (return_data)
		{
			if (return_data == "1")
			{
				document.getElementById("btn_" + game + "_status").style.backgroundColor = '#0F0';
				document.getElementById("btn_" + game + "_status").style.color = '#000';
				document.getElementById("btn_" + game + "_status").innerHTML = "Running";
			} else {
				document.getElementById("btn_" + game + "_status").style.backgroundColor = '#F00';
				document.getElementById("btn_" + game + "_status").style.color = '#FFF';
				document.getElementById("btn_" + game + "_status").innerHTML = "Not Running";
			}
		}
		$.ajax ("handler.php", {type: "POST", dataType: "text", success: ajax_return, data: "command=getStatus&game=" + game});
	}

	
	function processEvent(game, action)
	{
		$.ajax ("handler.php", {type: "POST", data: "command=processEvent&game=" + game + "&action=" + action});
	}

	<?php // Javascript setInterval
		echo "\n"; // Correction
		foreach ($serverlist as $key => $value)
		{
			echo "\t"; echo 'setInterval ( "getLog(\'' . $value[0] . '\')", 500);'; echo "\n";
			echo "\t"; echo 'setInterval ( "getStatus(\'' . $value[0] . '\')", 500);'; echo "\n";
		}
	?>

	</script>

</head>
<body style="font-size:12px; font-famliy:monospace; margin:0; padding:0;">


<div id="tabs" style="background:url(background.jpg); background-position:center; background-repeat:no-repeat;">
	<!-- Tabs -->
    <ul>
	<?php
		echo "\n"; // Correction
		foreach ($serverlist as $key => $value)
		{
			// tab blocks
			echo "\t"; echo '<li><a href="#tab_' . $value[0] . '"><span>' . $value[0] . '</span></a></li>';	echo "\n";
		}
	?>
    </ul>

	<?php
		echo "\n"; // Correction
		foreach ($serverlist as $key => $value)
		{
			// Comment block
			echo '<!-- ' . $value[0] . ' -->';
			echo "\n";
	
			// div id
			echo '<div id="tab_' . $value[0] . '">'; echo "\n";
	
			// nested div - start btn
			echo "\t"; echo '<div id="btn_' . $value[0] . '_start">Start</div>'; echo "\n";

			// nested div - stop btn
			echo "\t"; echo '<div id="btn_' . $value[0] . '_stop">Stop</div>'; echo "\n";
			
			// nested div - restart btn
			echo "\t"; echo '<div id="btn_' . $value[0] . '_restart">Restart</div>'; echo "\n";

			// nested div - status line
			echo "\t"; echo '<div id="btn_' . $value[0] . '_status" class="status">N/A</div>'; echo "\n";

			// nested div - log
			echo "\t"; echo '<div id="log_' . $value[0] . '" class="log"></div>'; echo "\n";

			// Closing parent div
			echo '</div>';
			echo "\n\n";
		}
	?>
</div>

</body>
</html>

