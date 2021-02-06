<?php
print "<html>";
print "<h1>CPU Stress Application for testing HPA</h1>";
print "Stress CPU for 2 minutes: <a href=http://{$_SERVER['HTTP_HOST']}/cpu.php?minutes=2>CPU Stress</a><br /><br />";
print "Allocate 200MB for two minutes: <a href=http://{$_SERVER['HTTP_HOST']}/memory.php?minutes=2&size=200>Memory allocation</a>";
print "</html>";
?>
