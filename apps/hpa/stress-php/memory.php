<?php

ini_set('memory_limit','512M');
print "<h1>Memory Stress Application for testing HPA</h1>";

$memory_limit = get_memory_limit();
print "Memory Limit: $memory_limit <br />";

$initMemory = $currentMemory = memory_get_usage();
print "Initial memory usage: $initMemory <br /><br />";

$size = intval($_REQUEST['size']);
$minutes =  intval($_REQUEST['minutes']);

flush();

print "Allocated $size MB<br />";
$myArray = array_fill(0, $size * 1000 * 32 , pack('C', 1));

sleep($minutes * 60);

$myArray = null;

function get_memory_limit()
{
   $limit_string = ini_get('memory_limit');
   $unit = strtolower(mb_substr($limit_string, -1 ));
   $bytes = intval(mb_substr($limit_string, 0, -1), 10);
   
   switch ($unit)
   {
      case 'k':
         $bytes *= 1024;
         break 1;
      
      case 'm':
         $bytes *= 1048576;
         break 1;
      
      case 'g':
         $bytes *= 1073741824;
         break 1;
      
      default:
         break 1;
   }
   
   return $bytes;
}
?>
