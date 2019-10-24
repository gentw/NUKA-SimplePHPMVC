<?php
/***
	WebyFlex PHP Framework
	This file require all files that we need :-)
**/

//LOAD Config file:
require_once 'config/config.php';

/*
require_once('libraries/core.php');
require_once('libraries/controller.php');
require_once('libraries/database.php');*/

spl_autoload_register(function($className) {
	require_once 'libraries/'.$className.'.php';
});