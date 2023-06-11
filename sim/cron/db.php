<?php
date_default_timezone_set("Asia/Jakarta"); 

$conn = mysql_connect('localhost', 'acehwee7_nuke', 'acehweek*#');
mysql_select_db ('acehwee7_news', $conn);

if (!$conn) {
    die('Could not connect: ' . mysql_error());
}

function now()
	{
                        $now = time();
			$system_time = mktime(gmdate("H", $now), gmdate("i", $now), gmdate("s", $now), gmdate("m", $now), gmdate("d", $now), gmdate("Y", $now));

			if (strlen($system_time) < 10)
			{
				$system_time = time();
				log_message('error', 'The Date class could not set a proper GMT timestamp so the local time() value was used.');
			}
                        
                        return $system_time;
		 
	}
?>