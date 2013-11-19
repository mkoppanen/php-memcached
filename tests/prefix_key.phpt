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

ini_set ('memcached.prefix_key', '');

$should_work = memc_get_instance (array (Memcached::OPT_PREFIX_KEY => 'foo_bar'));
var_dump ($should_work->getOption (Memcached::OPT_PREFIX_KEY));


ini_set ('memcached.prefix_key', 'persistent_prefix');

$m = memc_get_instance (array (), 'p_id');

ini_set ('memcached.prefix_key', '');

var_dump (memc_get_instance (array (), 'p_id')->getOption (Memcached::OPT_PREFIX_KEY));

echo "OK". PHP_EOL;

--EXPECTF--
string(12) "test_prefix_"

Warning: Memcached::setOptions(): cannot set OPT_PREFIX_KEY when memcached.prefix_key ini-setting is active in %s on line %d
Failed to set options
string(7) "foo_bar"
string(17) "persistent_prefix"
OK