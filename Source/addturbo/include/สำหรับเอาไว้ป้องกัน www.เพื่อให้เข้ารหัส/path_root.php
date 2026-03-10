<?php

header('Content-Type: text/plain');
echo $_SERVER['PHP_SELF'] . "\n";
echo dirname($_SERVER['PHP_SELF']) . "\n";
echo preg_replace('/\/[^\/]+/','../',dirname($_SERVER['PHP_SELF'])) . "\n";
echo realpath('./' . preg_replace('/\/[^\/]+/','../',dirname($_SERVER['PHP_SELF']))) . "\n";

?>
