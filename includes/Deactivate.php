<?php
/**
 * @package  AppsazAdminInterface
 */
namespace Inc;
if ( ! defined( 'ABSPATH' ) ) {

    exit; // Exit if accessed directly.

}

class Deactivate
{
    public static function deactivate() {

        self::aai_translation();

    }

    private static function aai_translation()
    {

        $newFilePath = ABSPATH . "wp-content/languages/plugins/appsaz-admin-fa_IR.po";
        $newFilePath1 = ABSPATH . "wp-content/languages/plugins/appsaz-admin-fa_IR.mo";

        unlink($newFilePath1);
        unlink($newFilePath);


        $loginpage =WPADMINPANEL_PATH.'/template/appsaz-login.php';
        $loginbase =ABSPATH.'/wp-content/wp-login.php';

        $loginpage1 = ABSPATH .'appsaz-login.php';
        $loginbase1 = ABSPATH .'wp-login.php';

        unlink($loginpage1);
        if(file_exists($loginbase)){
            rename($loginbase,$loginbase1);
        }

    }

}