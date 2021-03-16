<?php
$versionArr = explode(".", $ver = rrd_version());
var_dump($ver);
var_dump($versionArr[0] == 1, $versionArr[1] >= 2);
?>
