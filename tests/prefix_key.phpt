--TEST--
Test key prefix ini-setting
--SKIPIF--
<?php 
if (!extension_loaded("memcached")) print "skip"; 
?>
--INI--
memcached.prefix_key = "test_prefix_"
--FILE--
<?php
include dirname (__FILE__) . '/config.inc';

var_dump (memc_get_instance ()->getOption (Memcached::OPT_PREFIX_KEY));

memc_get_instance (array (
					Memcached::OPT_PREFIX_KEY => 'foo_bar'
				));

echo "OK". PHP_EOL;

--EXPECTF--
string(12) "test_prefix_"

Warning: Memcached::setOptions(): cannot set OPT_PREFIX_KEY when memcached.prefix_key ini-setting is active in %s on line %d
Failed to set options
OK