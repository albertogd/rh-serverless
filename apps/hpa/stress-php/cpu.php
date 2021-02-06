<?php
$minutes = (int)$_REQUEST['minutes'];
$seconds = $minutes * 60;
$timeout = time() + $seconds;
$exec_cores = trim(shell_exec("grep -P '^processor' /proc/cpuinfo|wc -l"));

// Get CPU Load before test
$before_load = sys_getloadavg();
$before_cpu = round($before_load[0]/($exec_cores + 1)*100, 0) . '%';

// Flush output in real time
ob_implicit_flush(true);
ob_end_flush();
print "<h1>CPU Stress Application for testing HPA</h1>";
print "CPU before stressing CPU: {$before_cpu }<br /><br />";
print "Starting to stress CPU during {$minutes} minutes...<br /><br />";
print str_pad('',1)."\n";

// Infinite loop until timeout
for ($i = 7777777; $current_time <= $timeout; $i++) {
   $i = $i * $i;
   $current_time = time();
}

// Get CPU Load after test
$after_load = sys_getloadavg();
$after_cpu = round($after_load[0]/($exec_cores + 1)*100, 0) . '%';

print "Finihsed CPU Test Load in {$minutes} minutes.";
print "CPU after stressing CPU: {$after_cpu }<br /><br />";
print str_pad('',1)."\n";
return;

?>
