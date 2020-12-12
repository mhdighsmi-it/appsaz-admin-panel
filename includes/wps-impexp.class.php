<?php
/*
 * APPSAZADMIN
 * @author   AcmeeDesign
 * @url     http://acmeedesign.com
*/

defined('ABSPATH') || die;

if (!class_exists('WPS_IMP_EXP')) {

    class WPS_IMP_EXP extends APPSAZADMIN
    {
        public $aof_options;

        function __construct()
        {
            $this->aof_options = parent::get_wps_option_data(APPSAZ_ADMIN_OPTIONS_PANEL);
            add_action('admin_menu', array($this, 'add_impexp_menu'));
            add_action('plugins_loaded',array($this, 'wps_settings_action'));
        }

        function add_impexp_menu() {
            add_submenu_page( WPADMINPANEL_MENU_SLUG, __('Import and Export Settings', 'appsaz-admin'), __('Import-Export Settings', 'appsaz-admin'), 'manage_options', 'wps_impexp_settings', array($this, 'wps_impexp_settings_page') );
        }

        function wps_impexp_settings_page() {
            global $aof_options;
            ?>
            <div class="wrap wps-wrap">
        <?php
            if(isset($_GET['page']) && $_GET['page'] == 'wps_impexp_settings' && isset($_GET['status']) && $_GET['status'] == 'updated')
            {
                ?>
                <div class="updated top">
                    <p><strong><?php echo __('Settings Imported!', 'appsaz-admin'); ?></strong></p>
                </div>
        <?php
            }
            elseif(isset($_GET['page']) && $_GET['page'] == 'wps_impexp_settings' && isset($_GET['status']) && $_GET['status'] == 'dataerror')
            {
                ?>
                <div class="updated top">
                    <p><strong><?php echo __('You are importing empty data or wrong data format.', 'appsaz-admin'); ?></strong></p>
                </div>
        <?php
            }

            ?>
                <div style="padding: 15px 0">
                    <form name="wps_master_reset_form" method="post" onsubmit="return confirm('Do you really want to Reset?');">
                    <input type="hidden" name="reset_to_default" value="wps_master_reset" />
                    <?php wp_nonce_field('wps_reset_nonce','wps_reset_field'); ?>
                    <input id="wps-button-reset" class="button button-primary" type="submit" value="<?php echo __('Reset All Settings', 'appsaz-admin'); ?>" />
                    </form>
                </div>

                <h3><?php echo __('Export Settings', 'appsaz-admin'); ?></h3>
                <div style="padding: 15px 0">
                <span><?php echo __('Save the below contents to a text file.', 'appsaz-admin'); ?></span>
                <textarea class="widefat" rows="10" ><?php echo $this->wps_get_settings(); ?></textarea>
                </div>

                <h3><?php echo __('Import Settings', 'appsaz-admin'); ?></h3>
                <div style="padding:15px 0">
                <form name="wps_import_settings_form" method="post" action="">
                        <input type="hidden" name="wps_import_settings" value="1" />
                        <textarea class="widefat" name="wps_import_settings_data" rows="10" ></textarea><br /><br />
                        <input class="button button-primary button-hero" type="submit" value="<?php echo __('Import Settings', 'appsaz-admin'); ?>" />
                <?php wp_nonce_field('wps_import_settings_nonce','wps_import_settings_field'); ?>
                </form>
                </div>

            </div>

<?php
        }

        function wps_settings_action() {
            if(isset($_POST['wps_import_settings_field']) ) {
                if(!wp_verify_nonce( $_POST['wps_import_settings_field'], 'wps_import_settings_nonce' ) )
                    exit();
                $import_data = trim($_POST['wps_import_settings_data']);
                if(empty($import_data) || !is_serialized($import_data)) {
                    wp_safe_redirect( admin_url( 'admin.php?page=wps_impexp_settings&status=dataerror' ) );
                    exit();
                }
                else {
                    $data = unserialize($import_data); //to avoid double serialization
                    parent::updateOption(APPSAZ_ADMIN_OPTIONS_PANEL, $data);
                    wp_safe_redirect( admin_url( 'admin.php?page=wps_impexp_settings&status=updated' ) );
                    exit();
                }
            }

            if(isset($_POST['reset_to_default']) && $_POST['reset_to_default'] == "wps_master_reset") {
                if(!wp_verify_nonce( $_POST['wps_reset_field'], 'wps_reset_nonce' ) )
                        exit();

                global $aap_options;
                $aap_options->aofLoaddefault(true);
                wp_safe_redirect( admin_url( 'admin.php?page='.WPADMINPANEL_MENU_SLUG ) );
                exit();
            }
        }

        function wps_get_settings() {
           $saved_data = parent::get_wps_option_data(APPSAZ_ADMIN_OPTIONS_PANEL);
           if(!empty($saved_data)) {
               if(!is_serialized($saved_data)) {
                   return maybe_serialize($saved_data);
               }
               else {
                   return $saved_data;
               }
           }
        }

    }

}

new WPS_IMP_EXP();
