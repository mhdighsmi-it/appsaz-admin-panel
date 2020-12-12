<?php
/*
Plugin Name: پنل مدیریت اپ ساز
Plugin URI: https://appsaz.ir/
Description: ایجاد صفحه اصلی سایت به صورت خیلی زیبا
Version: 3.0.1
Author: mhdighsmi
Author URI: https://appsaz.ir
License: GPLv2 or later
Text Domain: appsaz-admin
*/

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

if ( file_exists( dirname( __FILE__ ) . '/UpdatepluginAppsaz.php' ) ) {
    require_once dirname( __FILE__ ) . '/UpdatepluginAppsaz.php';
}
new UpdatepluginAppsaz(
    'http://apprepository.ir/plugins/appsaz-panel-admin/site-config.json',
    plugin_basename(__FILE__),
    __FILE__, //Full path to the main plugin file or functions.php.
    'appsaz-admin-panel'
);

define( 'WPAPPSAZADMIN_VERSION' , '3.0.1' );


define( 'WPADMINPANEL_PATH' , dirname(__FILE__) . "/");


define( 'WPADMINPANEL_DIR_URI' , plugin_dir_url(__FILE__) );

/*
*   APPSAZADMIN Options slug Constant
*/
define( 'APPSAZ_ADMIN_OPTIONS_PANEL' , 'wpappsazadmin_options' );

use Inc\Activate;
use Inc\Deactivate;

if(is_multisite())
    define('NETWORK_ADMIN_CONTROL', true);
// Delete the above two lines to enable customization per blog


require_once( WPADMINPANEL_PATH . 'includes/wps-options.php' );


if(!function_exists('wpaap_config')) {
  function wpaap_config() {
    if(!is_multisite()) {
        $multi_option = false;
    }
     elseif(is_multisite() && !defined('NETWORK_ADMIN_CONTROL')) {
         $multi_option = false;
     }
     else {
         $multi_option = true;
     }

     /* Stop editing after this */
     $wps_fields = get_wps_options();
     $config = array(
         'multi' => $multi_option, //default = false
         'wps_fields' => $wps_fields,
       );

       return $config;
  }
}


require_once(WPADMINPANEL_PATH . 'appsaz-settings.php');


include_once WPADMINPANEL_PATH . 'includes/dash-icons.class.php';
include_once WPADMINPANEL_PATH . 'includes/fa-icons.class.php';
include_once WPADMINPANEL_PATH . 'includes/line-icons.class.php';
include_once WPADMINPANEL_PATH . 'includes/appsazadmin.class.php';
include_once WPADMINPANEL_PATH . 'includes/wpass.class.php';
include_once WPADMINPANEL_PATH . 'includes/wps-impexp.class.php';
include_once WPADMINPANEL_PATH . 'includes/Activate.php';
include_once WPADMINPANEL_PATH . 'includes/Deactivate.php';

$login_change=0;
if(isset(get_option(APPSAZ_ADMIN_OPTIONS_PANEL)['admin_page_login'])) {
    $login_change = get_option(APPSAZ_ADMIN_OPTIONS_PANEL)['admin_page_login'];
}

if($login_change==1){
    add_action( 'wp_before_admin_bar_render', 'appsaz_remove_old_logout');
    add_action( 'admin_bar_menu', 'appsaz_newlogout_box' );
    $loginpage =WPADMINPANEL_PATH.'/template/appsaz-login.php';
    $loginbase =ABSPATH.'/wp-content/wp-login.php';
    $loginpage1 = ABSPATH .'appsaz-login.php';
    $loginbase1 = ABSPATH .'wp-login.php';

        copy($loginpage, $loginpage1);
        if(!file_exists($loginbase)){
            rename($loginbase1, $loginbase);
        }
}
else{

    $loginpage =WPADMINPANEL_PATH.'/template/appsaz-login.php';
    $loginbase =ABSPATH.'/wp-content/wp-login.php';

    $loginpage1 = ABSPATH .'appsaz-login.php';
    $loginbase1 = ABSPATH .'wp-login.php';
    if(file_exists ($loginpage1)) {
        rename($loginpage1, $loginpage);
    }
        if(file_exists($loginbase)){
            rename($loginbase, $loginbase1);
    }
}
function appsaz_remove_old_logout() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_node('my-account');
}
function appsaz_newlogout_box() {
    ?>

    <table
            style="position: fixed;
            left: 0;
            z-index: 100000;
            background: black;
            padding: 10px;
            color: white;
            top: 10px;"
            id="one-click01" style="" border="0" cellspacing="0" cellpadding="0"><tr><td align=center valign=center>
                <?php
                wp_get_current_user();
                $current_user = wp_get_current_user();
                if ( !($current_user instanceof WP_User) )
                    return;
                $name = $current_user->display_name;
                ?>

                <?php echo '
                                        <a href="/appsaz-login.php?action=logout" title="' . esc_attr__('Log Out') . '">Howdy, ' . __($name) . '</a>'
                ; ?>

            </td></tr></table>

    <?php
}


$activePlugin=new Activate;

$dectivePlugin=new Deactivate;

register_activation_hook( __FILE__, array( $activePlugin, 'activate' ) );

// deactivation
register_deactivation_hook( __FILE__, array( $dectivePlugin, 'deactivate' ) );


