<?php
/*
Plugin Name: AAP Options Framework
Plugin URI: http://appsaz.ir
Description: Options framework for Wordpress themes and plugins.
version: 1.2
Author: mhdighsmi
Author URI: http://appsaz.ir
 */

/*
* AAP Constants
*/
define( 'AAP_VERSION' , '1.2' );
define( 'AAP_PATH' , dirname(__FILE__) . "/");
define( 'AAP_DIR_URI' , plugin_dir_url(__FILE__) );

require_once(AAP_PATH . 'inc/aap.class.php');
