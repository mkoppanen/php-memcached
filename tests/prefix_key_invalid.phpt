--TEST--
Test key prefix ini-setting with invalid key
--SKIPIF--
<?php 
if (!extension_loaded("memcached")) print "skip"; 
?>
--INI--
memcached.prefix_key = "test prefix has spaces"
--FILE--
<?php
include dirname (__FILE__) . '/config.inc';

var_dump (memc_get_instance ());

echo "OK". PHP_EOL;

--EXPECTF--
Fatal error: Memcached::__construct(): could not set key prefix, check memcached.prefix_key ini-setting in %s on line %d