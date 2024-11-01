<?php
/*
Plugin Name: SP Disable Site 
Plugin URI: http://web-cude.com/sp-disable-page/
Description: SP Disable Site is a WordPress plugin which can create disable page in your site.
Version: 1.0.0
Text Domain: spdp86
Domain Path: /languages
Author: spoot1986
Author URI: http://web-cude.com
*/

//require class
require_once(plugin_dir_path(__FILE__).'class-sp-disable-site.php');

$SpDisableSite = new SpDisableSite();
?>