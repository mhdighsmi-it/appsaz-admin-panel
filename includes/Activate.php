<?php
/**
 * @package  AppsazAdminInterface
 */

namespace Inc;

if ( ! defined( 'ABSPATH' ) ) {

    exit; // Exit if accessed directly.

}


class Activate
{
    public static function activate() {
        self::aai_translation();

    }
    private static function aai_translation(){
        $currentFilePath =WPADMINPANEL_PATH.'/languages/appsaz-admin-fa_IR.po';
        $currentFilePath1 =WPADMINPANEL_PATH.'/languages/appsaz-admin-fa_IR.mo';

        $newFilePath = ABSPATH . "wp-content/languages/plugins/appsaz-admin-fa_IR.po";
        $newFilePath1 = ABSPATH . "wp-content/languages/plugins/appsaz-admin-fa_IR.mo";

        copy($currentFilePath,$newFilePath);
        copy($currentFilePath1,$newFilePath1);

    }

}