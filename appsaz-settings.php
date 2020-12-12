<?php
/*
 * WPADMINPANEL
 * @author   mhdighsmi
 * @url     http://appsaz.ir
*/

defined('ABSPATH') || die;


define( 'WPADMINPANEL_MENU_SLUG' , 'wpappsazadmin_options' );


define( 'WPADMINPANEL_USERS_SLUG' , 'wpa_admin_users' );


define( 'WPS_ADMINBAR_LIST_SLUG' , 'wps_adminbar_list' );


require_once(WPADMINPANEL_PATH . 'includes/appsaz-framework/appsaz-framework.php');

$wps_pages_slugs = array(
  'wps_options' => WPADMINPANEL_MENU_SLUG,
  'wps_manage_menus' => 'APPSAZADMIN_page_admin_menu_management',
  'wps_import_exort' => 'APPSAZADMIN_page_wps_impexp_settings',
);

//Instantiate the AOF class
$aap_options = new AAPFramework();

add_action( 'admin_enqueue_scripts', 'aofAssets', 99 );
function aofAssets($page) {
  global $wps_pages_slugs;
  if( $page == "toplevel_page_wpappsazadmin_options" || in_array($page, $wps_pages_slugs) ) {
      wp_enqueue_script( 'jquery' );
      wp_enqueue_script( 'jquery-ui-core' );
      wp_enqueue_script( 'jquery-ui-sortable' );
      wp_enqueue_script( 'jquery-ui-slider' );
      wp_enqueue_style('aofOptions-css', AAP_DIR_URI . 'assets/css/aap-framework.min.css');
      wp_enqueue_style('aof-ui-css', AAP_DIR_URI . 'assets/css/jquery-ui.css');
      wp_enqueue_script( 'aofresposivetabs', AAP_DIR_URI . 'assets/js/aap-options-tab.js', array( 'jquery' ), '', true );
      wp_enqueue_script( 'aofimageselect', AAP_DIR_URI . 'assets/image-picker/image-picker.min.js', array( 'jquery' ), '', true );
      wp_enqueue_style( 'wp-color-picker' );
      wp_enqueue_style( 'aof-imageselect', AAP_DIR_URI . 'assets/image-picker/image-picker.css');
      wp_enqueue_script( 'aof-scriptjs', AAP_DIR_URI . 'assets/js/script.js', array( 'jquery', 'wp-color-picker' ), false, true );
    }
}

add_action('admin_menu', 'createOptionsmenu');
function createOptionsmenu() {
  $aof_page = add_menu_page( __('appsaz-admin-panel','appsaz-admin'), __('Appsazadmin','appsaz-admin'), 'manage_options', 'wpappsazadmin_options', 'generateFields', 'dashicons-art' );
}

function generateFields() {
  global $aap_options;
  $config = wpaap_config();
  $aap_options->generateFields($config);
}

add_action('admin_menu', 'SaveSettings');
function SaveSettings() {
  global $aap_options;
  if($_POST) {
    $aap_options->SaveSettings($_POST);
  }
}

//remove admin footer text
//add_filter( 'admin_footer_text', '__return_false' );
