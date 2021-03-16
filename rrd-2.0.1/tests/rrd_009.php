<?php
rrd_create(dirname(__FILE__) . "/rrd_create_test.rrd", array("badParam"));
var_dump(rrd_error());
var_dump(rrd_error());
?>
