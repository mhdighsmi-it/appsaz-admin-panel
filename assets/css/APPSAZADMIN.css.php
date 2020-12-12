<?php
/**
 * @package APPSAZADMIN
 * @author   AcmeeDesign
 * @url     http://acmeedesign.com
 * defining css styles for WordPress admin pages.
 */

$css_styles = '';
$css_styles .= '<style type="text/css">';

//static styles
$css_styles .= '

#wpadminbar {
    -webkit-box-shadow: 0 2px 2px rgba(0, 0, 0, 0.05), 0 1px 0 rgba(0, 0, 0, 0.05);
    -moz-box-shadow: 0 2px 2px rgba(0, 0, 0, 0.05), 0 1px 0 rgba(0, 0, 0, 0.05);
    box-shadow: 0 2px 2px rgba(0, 0, 0, 0.05), 0 1px 0 rgba(0, 0, 0, 0.05);
}
#wpadminbar .quicklinks {
    border: none !important;
}
#wpadminbar .quicklinks li#wp-admin-bar-my-account.with-avatar>a img {
    width: 36px;
    height: 36px;
    border-radius: 100px;
    -moz-border-radius: 100px;
    -webkit-border-radius: 100px;
    border: none;
}
li#wp-admin-bar-my-account a {
    font-weight: 600;
}
#wpadminbar .quicklinks li a .blavatar, #wpadminbar .quicklinks li a:hover .blavatar { display: none}
#wpadminbar .quicklinks .ab-empty-item, #wpadminbar .quicklinks a, #wpadminbar .shortlink-input {
    height: 32px;
}
#collapse-button {
    margin:10px 21px 20px;
}
ul#wp-admin-bar-root-default, ul.ab-top-menu {}
#wpadminbar .quicklinks ul li li div.ab-empty-item {padding-top: 0!important;padding-bottom: 0!important}

#adminmenu {margin-top:0}
.folded #adminmenu, .folded #adminmenu li.menu-top, .folded #adminmenuback, .folded #adminmenuwrap {
    width: 58px;
}
#adminmenu li.wp-has-submenu.wp-not-current-submenu:hover:after {
    top: 14px;
}
#adminmenu .wp-submenu {
  padding: 0;
}
#wpbody-content .wrap { margin-top: 20px}
#wp-auth-check-wrap #wp-auth-check {
        width: 450px;
}
#dashboard-widgets .postbox .inside img {max-width:100%;height:auto}
.button, .button-primary, .button-secondary { outline: none}
.dashicons, .dashicons-before:before, .wp-menu-image:before {
    display: inline-block;
    width: 20px;
    height: 20px;
    font-size: 20px;
    line-height: 1;
    font-family: dashicons;
    text-decoration: inherit;
    font-weight: 400;
    font-style: normal;
    vertical-align: top;
    text-align: center;
    -webkit-transition: color .1s ease-in 0;
    transition: color .1s ease-in 0;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }
  .wps-manage-menu-slug-mthd {
    background:#fff;
    width: 670px;
    padding:15px;
  }


@media only screen and (min-width:782px) and (max-width: 960px) {
  .auto-fold #adminmenu, .auto-fold #adminmenu li.menu-top, .auto-fold #adminmenuback, .auto-fold #adminmenuwrap {
          width: 58px;
  }
  .auto-fold #adminmenu .opensub .wp-submenu, .auto-fold #adminmenu .wp-has-current-submenu .wp-submenu.sub-open, .auto-fold #adminmenu .wp-has-current-submenu a.menu-top:focus+.wp-submenu, .auto-fold #adminmenu .wp-has-current-submenu.opensub .wp-submenu, .auto-fold #adminmenu .wp-submenu.sub-open, .auto-fold #adminmenu a.menu-top:focus+.wp-submenu {
          left: 58px;
  }
  .auto-fold #wpcontent, .auto-fold #wpfooter {
          margin-left: 76px;
  }
}

@media screen and (max-width: 782px){
  ul#wp-admin-bar-root-default, ul.ab-top-menu {
          margin-top: 0;
  }
  .auto-fold #adminmenu, .auto-fold #adminmenuback, .auto-fold #adminmenuwrap {
          width: 190px;
  }
  .auto-fold #adminmenu li.menu-top {
          width: 100%;
  }
  #adminmenu .wp-not-current-submenu .wp-submenu, .folded #adminmenu .wp-has-current-submenu .wp-submenu {
          width: 190px;
  }
  .auto-fold #wpcontent {
          margin-left: 0;
  }
  #wpadminbar .quicklinks>ul>li>a {
      padding: 0;
  }
  #wpadminbar .quicklinks>ul>li>a, div.ab-empty-item {
      padding: 0 !important;
  }
  #wpadminbar .quicklinks .ab-empty-item, #wpadminbar .quicklinks a, #wpadminbar .shortlink-input {
          height: 46px;
  }
}

@media screen and (max-width: 960px){
  .wps-user-avatar img.avatar {
    max-width:45px;
    max-height:45px;
  }
  .wps-menu-logout{
    margin-left:0;
    margin-top:7px;
  }
}

@media screen and (max-width: 600px){
  div#login {
      width: 90% !important;
  }
}';

if(isset($this->aap_options['enable_menu_user_info']) &&  $this->aap_options['enable_menu_user_info'] == 1) {
  $css_styles .= '
    .wps-user-avatar,.wps-user-displayname {text-align:center}
    .wps-user-avatar {clear:both;padding-top:24px;}
    .wps-user-displayname {line-height:24px;font-size:15px;font-weight:600;color:#fff;margin-bottom:5px;}
    .wps-user-avatar img.avatar{border-radius: 100px;
    -moz-border-radius: 100px;
    -webkit-border-radius: 100px;}
    .wps-menu-user-actions{
      text-align:center;
      margin-bottom: 8px;
      border-bottom: 1px solid #0e1419;
      padding-bottom: 23px;}
    .wps-menu-user-actions a {
      width:23px;
      height:23px;
      display:inline-block;
      border-style:solid;
      border-width: 1px;
      border-color: rgba(255, 255, 255, 0.3);
      -webkit-border-radius: 6px;
      -moz-border-radius: 6px;
      -ms-border-radius: 6px;
      border-radius: 6px;
    }
    .wps-menu-logout{display:inline-block;margin-left:9px;}
    i.wps-power-switch:before,i.wps-user:before{font-family: LineIcons!important;
        display: inline-block;
        color:#fff;
        font-size: 14px;
        text-decoration: inherit;
        font-weight: 400;
        font-style: normal;
        vertical-align: middle;
        text-align: center;
        -webkit-transition: color .1s ease-in 0;
        transition: color .1s ease-in 0;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;}
    i.wps-power-switch:before{
      content: "\e932" !important;
    }
    i.wps-user:before{content:"\e9a4" !important}
    ';
  $css_styles .= '@media screen and (max-width: 600px){
    .auto-fold #adminmenu {
      top:175px;
    }
    .wps-user-avatar {
      padding-top:56px;
    }
    .wps-menu-logout {
      margin-left:7px;
    }
  }
  ';

  //adminmenu user info
  if( !empty($this->aap_options['user_info_btm_border_color']) )
    $css_styles .= '.wps-menu-user-actions {border-color:' . $this->aap_options['user_info_btm_border_color'] . '}';

  if( !empty($this->aap_options['user_info_icon_border_color']) )
    $css_styles .= '.wps-menu-user-actions a {border-color:' . $this->aap_options['user_info_icon_border_color'] . '}';

  if( !empty($this->aap_options['user_info_icon_color']) )
    $css_styles .= 'i.wps-power-switch:before,i.wps-user:before {color:' . $this->aap_options['user_info_icon_color'] . '}';

  if( !empty($this->aap_options['user_info_icon_hover_bg_color']) )
    $css_styles .= '.wps-menu-user-actions a:hover {background-color:' . $this->aap_options['user_info_icon_hover_bg_color'] . ';
      border-color:' . $this->aap_options['user_info_icon_hover_bg_color'] . '}';

  if( !empty($this->aap_options['user_info_icon_hover_color']) )
    $css_styles .= '.wps-menu-user-actions a:hover i.wps-power-switch:before,
    .wps-menu-user-actions a:hover i.wps-user:before {color:' . $this->aap_options['user_info_icon_hover_color'] . '}';
}

if(!isset($this->aap_options['admin_menu_font_size']) || $this->aap_options['admin_menu_font_size'] == 'small') {
  $css_styles .= '#adminmenu .wp-submenu-head, #adminmenu a.menu-top {font-size:0.95em;}
  #adminmenu .wp-submenu a {font-size:0.9em;}';
}
  if(empty($this->aap_options['default_adminbar_height'])) {
    $css_styles .= '#wpadminbar {height:50px;}';
    $css_styles .= '@media screen and (max-width: 782px){
      #wpadminbar .quicklinks .ab-empty-item, #wpadminbar .quicklinks a, #wpadminbar .shortlink-input {
          height: 46px;
      }
    }
    @media only screen and (min-width:782px) {
      html.wp-toolbar {padding-top: 50px;}
      #wpadminbar .quicklinks>ul>li>a, div.ab-empty-item { padding: 9px !important }
      #wpadminbar #wp-admin-bar-APPSAZADMIN_site_title a{height: 25px;
    margin: 4px 38% 0;
    padding: 14px !important;}
    }
    ';
  }
$css_styles .= 'html, #wpwrap, #wp-content-editor-tools,body { background: ' . $this->aap_options['bg_color'] . '; }';
$css_styles .= 'ul#adminmenu a.wp-has-current-submenu:after, ul#adminmenu>li.current>a.current:after { ';
  if(is_rtl()) {
    $css_styles .= 'border-left-color: ' . $this->aap_options['bg_color'];
  }
  else {
    $css_styles .= 'border-right-color: ' . $this->aap_options['bg_color'];
  }
$css_styles .= '}';

/* Headings */
$css_styles .= 'h1 { color: ' . $this->aap_options['h1_color'] . '}';
$css_styles .= 'h2 { color: ' . $this->aap_options['h2_color'] . '}';
$css_styles .= 'h3 { color: ' . $this->aap_options['h3_color'] . '}';
$css_styles .= 'h4 { color: ' . $this->aap_options['h4_color'] . '}';
$css_styles .= 'h5 { color: ' . $this->aap_options['h5_color'] . '}';

/* Admin Bar */
$css_styles .= '#wpadminbar, #wpadminbar .menupop .ab-sub-wrapper, .ab-sub-secondary, #wpadminbar .quicklinks .menupop ul.ab-sub-secondary,
#wpadminbar .quicklinks .menupop ul.ab-sub-secondary .ab-submenu {
  background: ' . $this->aap_options['admin_bar_color'] . '}';
$css_styles .= '#wpadminbar a.ab-item, #wpadminbar>#wp-toolbar span.ab-label, #wpadminbar>#wp-toolbar span.noticon, #wpadminbar .ab-icon:before,
#wpadminbar .ab-item:before {
  color: ' . $this->aap_options['admin_bar_menu_color'] .'}';
$css_styles .= '#wpadminbar .quicklinks .menupop ul li a, #wpadminbar .quicklinks .menupop ul li a strong, #wpadminbar .quicklinks .menupop.hover ul li a,
#wpadminbar.nojs .quicklinks .menupop:hover ul li a {
  color: ' . $this->aap_options['admin_bar_menu_color'] . '; font-size:13px !important }';
$css_styles .= '#wpcontent #wpadminbar .ab-top-menu>li.hover>a.ab-item,
#wpcontent #wpadminbar>#wp-toolbar li.hover span.ab-label, #wpcontent #wpadminbar>#wp-toolbar li.hover span.ab-icon,
#wpadminbar:not(.mobile)>#wp-toolbar a:focus span.ab-label, #wpadminbar:not(.mobile)>#wp-toolbar li:hover span.ab-label, #wpadminbar>#wp-toolbar li.hover span.ab-label,
#wpcontent #wpadminbar .ab-top-menu>li:hover>a.ab-item,#wpcontent #wpadminbar .ab-top-menu>li:hover>a.ab-label,#wpcontent #wpadminbar .ab-top-menu>li:hover>a.ab-icon {
  color:' . $this->aap_options['admin_bar_menu_hover_color'] .'}';
$css_styles .= '#wpadminbar .quicklinks .ab-sub-wrapper .menupop.hover>a,#wpadminbar .quicklinks .menupop ul li a:focus,
#wpadminbar .quicklinks .menupop ul li a:focus strong,#wpadminbar .quicklinks .menupop ul li a:hover,
#wpadminbar .quicklinks .menupop ul li a:hover strong,#wpadminbar .quicklinks .menupop.hover ul li a:focus,
#wpadminbar .quicklinks .menupop.hover ul li a:hover,#wpadminbar li #adminbarsearch.adminbar-focused:before,
#wpadminbar li .ab-item:focus:before,#wpadminbar li a:focus .ab-icon:before,#wpadminbar li.hover .ab-icon:before,
#wpadminbar li.hover .ab-item:before,#wpadminbar li:hover #adminbarsearch:before,#wpadminbar li:hover .ab-icon:before,
#wpadminbar li:hover .ab-item:before,#wpadminbar.nojs .quicklinks .menupop:hover ul li a:focus,
#wpadminbar.nojs .quicklinks .menupop:hover ul li a:hover, #wpadminbar .quicklinks .ab-sub-wrapper .menupop.hover>a .blavatar,
#wpadminbar .quicklinks li a:focus .blavatar,#wpadminbar .quicklinks li a:hover .blavatar{
  color: ' . $this->aap_options['admin_bar_menu_hover_color'] .'}';
$css_styles .= '#wpadminbar .menupop .ab-sub-wrapper, #wpadminbar .shortlink-input {
  background: ' . $this->aap_options['admin_bar_menu_bg_hover_color'] . '}';

$css_styles .= '#wpadminbar .ab-submenu .ab-item, #wpadminbar .quicklinks .menupop ul.ab-submenu li a,
#wpadminbar .quicklinks .menupop ul.ab-submenu li a.ab-item {
  color: '. $this->aap_options['admin_bar_sbmenu_link_color'] . '}';
$css_styles .= '#wpadminbar .ab-submenu .ab-item:hover, #wpadminbar .quicklinks .menupop ul.ab-submenu li a:hover,
#wpadminbar .quicklinks .menupop ul.ab-submenu li a.ab-item:hover {
  color: ' . $this->aap_options['admin_bar_sbmenu_link_hover_color'] . '}';

/* Site logo and title */
$css_styles .= '.quicklinks li.APPSAZADMIN_site_title {';
if($this->aap_options['logo_top_margin'] != 0)
  $css_styles .= 'margin-top:-' . $this->aap_options['logo_top_margin'] . 'px !important;';
if($this->aap_options['logo_bottom_margin'] != 0)
  $css_styles .= 'margin-top:' . $this->aap_options['logo_bottom_margin'] . 'px !important;';
$css_styles .= '}';
$css_styles .= '.quicklinks li.APPSAZADMIN_site_title a{outline:none; border:none;}';

if(!empty($this->aap_options['adminbar_external_logo_url']) && filter_var($this->aap_options['adminbar_external_logo_url'], FILTER_VALIDATE_URL)) {
  $adminbar_logo = esc_url( $this->aap_options['adminbar_external_logo_url']);
}
else {
  $adminbar_logo = (is_numeric($this->aap_options['admin_logo'])) ? $this->get_wps_image_url($this->aap_options['admin_logo']) : $this->aap_options['admin_logo'];
}

$logo_v_margins = '0px';
if(isset($this->aap_options['logo_bottom_margin']) && $this->aap_options['logo_bottom_margin'] != 0) {
  $logo_v_margins = $this->aap_options['logo_bottom_margin'] . 'px';
}
elseif(isset($this->aap_options['logo_top_margin']) && $this->aap_options['logo_top_margin'] != 0) {
  $logo_v_margins = '-' . $this->aap_options['logo_top_margin'] . 'px';
}
$logo_l_margins = 'left';
if(isset($this->aap_options['logo_left_margin']) && $this->aap_options['logo_left_margin'] != 0) {
  $logo_l_margins = $this->aap_options['logo_left_margin'] . 'px';
}

$css_styles .= '.quicklinks li.APPSAZADMIN_site_title a, .quicklinks li.APPSAZADMIN_site_title a:hover, .quicklinks li.APPSAZADMIN_site_title a:focus {';
if(!empty($adminbar_logo)){
  $css_styles .= 'background:url(' . $adminbar_logo . ') ' . $logo_l_margins . ' ' . $logo_v_margins . ' no-repeat !important; text-indent:-9999px !important; width: auto;background-size:
  100% !important;';
}
else{
      $css_styles .= 'background:url(' . WPADMINPANEL_DIR_URI . 'assets/images/appsaz-icon.jpeg' . ') ' . $logo_l_margins . ' ' . $logo_v_margins . ' no-repeat !important; text-indent:-9999px !important; width: auto;';

}
$css_styles .= '}';

/* Buttons */
$css_styles .= '.wp-core-ui .button,.wp-core-ui .button-secondary,.wp-core-ui .button-disabled{
  color: '. $this->aap_options['sec_button_text_color'] . ';background: '. $this->aap_options['sec_button_color'] . '}';
$css_styles .= '.button.installing:before, .button.updating-message:before,.plugin-card .update-now:before,
.import-php .updating-message:before, .update-message p:before, .updating-message p:before{color:' . $this->aap_options['sec_button_text_color'] . '!important}';
$css_styles .= '.wp-core-ui .button-secondary:focus, .wp-core-ui .button-secondary:hover, .wp-core-ui .button.focus,
.wp-core-ui .button.hover, .wp-core-ui .button:focus, .wp-core-ui .button:hover {
  color: '. $this->aap_options['sec_button_hover_text_color'] . ';background: '. $this->aap_options['sec_button_hover_color'] . '}';
$css_styles .= '.wp-core-ui .button-primary, .wp-core-ui .button-primary-disabled, .wp-core-ui .button-primary.disabled,
.wp-core-ui .button-primary:disabled, .wp-core-ui .button-primary[disabled] {
  background: ' . $this->aap_options['pry_button_color'] . '!important; color: '. $this->aap_options['pry_button_text_color'] . '!important;text-shadow: none;}';
$css_styles .= '.wp-core-ui .button-primary.focus, .wp-core-ui .button-primary.hover, .wp-core-ui .button-primary:focus,
.wp-core-ui .button-primary:hover, .wp-core-ui .button-primary.active,.wp-core-ui .button-primary.active:focus,
.wp-core-ui .button-primary.active:hover,.wp-core-ui .button-primary:active {
  background: ' . $this->aap_options['pry_button_hover_color'] . '!important;color: ' . $this->aap_options['pry_button_hover_text_color'] . '!important}';

/* Left Menu */
if( isset( $this->aap_options['enable_admin_menu_shadow'] ) && !empty( $this->aap_options['enable_admin_menu_shadow'] ) ) {
  $admin_menu_shadow_opacity = ( isset( $this->aap_options['admin_menu_shadow_opacity'] ) ) ? '0.' . $this->aap_options['admin_menu_shadow_opacity'] : '0.3';
  $css_styles .= '#wps-sidebar, #adminmenuback {-webkit-box-shadow: 0 3px 9px 0 rgba(14, 14, 14, 0.3);
    box-shadow: 0 3px 9px 0 rgba(14, 14, 14, ' . $admin_menu_shadow_opacity . '); -moz-box-shadow: 0 3px 9px 0 rgba(14, 14, 14, ' . $admin_menu_shadow_opacity . ')}';
}
if(isset($this->aap_options['admin_menu_width']) && !empty($this->aap_options['admin_menu_width'])) {
    $admin_menu_width = $this->aap_options['admin_menu_width'];
    $wp_content_margin = $admin_menu_width + 20;

    $css_styles .= '#adminmenu, #adminmenu .wp-submenu, #adminmenuback, #adminmenuwrap {
            width: ' . $admin_menu_width . 'px}';
    $css_styles .= '#wpcontent, #wpfooter {';
      if(is_rtl()) {
        $css_styles .= 'margin-right: '. $admin_menu_width . 'px';
      } else {
        $css_styles .= 'margin-left: '. $admin_menu_width . 'px';
      }
    $css_styles .= '}';
    $css_styles .= '#adminmenu .wp-submenu {';
      if(is_rtl())
        $css_styles .= 'right:' . $admin_menu_width . 'px';
      else $css_styles .= 'left:' . $admin_menu_width . 'px';
    $css_styles .= '}';
    $css_styles .= '.quicklinks li.APPSAZADMIN_site_title {
            width:'. $admin_menu_width . 'px !important}';

    $css_styles .= '@media screen and (min-width: 960px) {
    .auto-fold .edit-post-layout__content .components-editor-notices__snackbar{
      left:'. $admin_menu_width . 'px !important;
    }
    }
    @media screen and (max-width: 782px) {
      .auto-fold .edit-post-layout__content .components-editor-notices__snackbar{
        left:58px !important;
      }
    }
    ';
}
else {
      $css_styles .= '#adminmenu, #adminmenu .wp-submenu, #adminmenuback, #adminmenuwrap {
        width: 200px;
      }
    #wpcontent, #wpfooter {';
      if(is_rtl())
        $css_styles .= 'margin-right:220px';
      else $css_styles .= 'margin-left:220px';
    $css_styles .= '}';

    $css_styles .= '#adminmenu .wp-submenu {';
      if(is_rtl())
        $css_styles .= 'right: 200px';
      else $css_styles .= 'left:200px';
    $css_styles .= '}';

    $css_styles .= '.quicklinks li.APPSAZADMIN_site_title {
        width: 200px !important;
    }';
}
$css_styles .= '#wp-admin-bar-APPSAZADMIN_site_title,#adminmenuback, #adminmenuwrap, #adminmenu { background: '. $this->aap_options['nav_wrap_color'] .'!important}';
$css_styles .= '#adminmenu div.wp-menu-image:before, #adminmenu a, #collapse-menu, #collapse-button div:after {
  color:'. $this->aap_options['nav_text_color'] .'}';
$css_styles .= '#adminmenu li a:focus div.wp-menu-image:before, #adminmenu li.opensub div.wp-menu-image:before,
#adminmenu li:hover div.wp-menu-image:before, #adminmenu .opensub .wp-submenu li.current a,
#adminmenu .wp-submenu li.current, #adminmenu a.wp-has-current-submenu:focus+.wp-submenu li.current a {
  color:'. $this->aap_options['menu_hover_text_color'] .'}';

$css_styles .= '#adminmenu li.menu-top:hover, #adminmenu li.menu-top a:hover, #adminmenu li.opensub>a.menu-top, #adminmenu li>a.menu-top:focus{
  background: '. $this->aap_options['hover_menu_color'] .'; color: '. $this->aap_options['menu_hover_text_color'] .'}';

$css_styles .= '#adminmenu li.menu-top:hover div.wp-menu-image:before, #adminmenu li.menu-top a:hover div.wp-menu-image:before, #adminmenu li.opensub>a.menu-top, #adminmenu li>a.menu-top:focus div.wp-menu-image:before{
color: '. $this->aap_options['menu_hover_text_color'] .'}';



/* Sub menu */
$admin_submenu_v_padding = '10px';
if(isset($this->aap_options['admin_submenu_v_padding']) && !empty($this->aap_options['admin_submenu_v_padding'])) {
  $admin_submenu_v_padding = $this->aap_options['admin_submenu_v_padding'] . 'px';
}
$css_styles .= '#adminmenu .wp-has-current-submenu ul>li>a, .folded #adminmenu li.menu-top .wp-submenu>li>a, #adminmenu .wp-submenu a {
  padding: '. $admin_submenu_v_padding .' 20px;
}
#adminmenu .wp-not-current-submenu li>a, .folded #adminmenu .wp-has-current-submenu li>a {
        padding-left: 20px;
}';

$css_styles .= '#adminmenu .wp-submenu-head, #adminmenu a.menu-top {';

$admin_par_menu_v_padding = '5px';
  if(isset($this->aap_options['admin_par_menu_v_padding']) && !empty($this->aap_options['admin_par_menu_v_padding'])) {
    $admin_par_menu_v_padding = $this->aap_options['admin_par_menu_v_padding'] . 'px';
  }

  if(is_rtl())
    $css_styles .= 'padding: ' . $admin_par_menu_v_padding . ' 10px ' . $admin_par_menu_v_padding . ' 0';
  else $css_styles .= 'padding: ' . $admin_par_menu_v_padding . ' 0 ' . $admin_par_menu_v_padding . ' 10px';
$css_styles .= '}';
$css_styles .= '.folded #wpcontent, .folded #wpfooter {';
  if(is_rtl())
    $css_styles .= 'margin-right: ';
  else $css_styles .= 'margin-left: ';
$css_styles .= '78px;}';

$css_styles .= '.folded #adminmenu .opensub .wp-submenu, .folded #adminmenu .wp-has-current-submenu .wp-submenu.sub-open,
.folded #adminmenu .wp-has-current-submenu a.menu-top:focus+.wp-submenu,
.folded #adminmenu .wp-has-current-submenu.opensub .wp-submenu, .folded #adminmenu .wp-submenu.sub-open,
.folded #adminmenu a.menu-top:focus+.wp-submenu, .no-js.folded #adminmenu .wp-has-submenu:hover .wp-submenu {';
  if(is_rtl())
    $css_styles .= 'right: 58px';
  else $css_styles .= 'left: 58px';
$css_styles .= '}';

$css_styles .= '#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, #adminmenu li.current a.menu-top,
.folded #adminmenu li.wp-has-current-submenu, .folded #adminmenu li.current.menu-top, #adminmenu .wp-menu-arrow,
#adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head, #adminmenu .wp-menu-arrow div, .wps-sidebar-menu .wps-curent-menu-item > a,
.wps-sidebar-menu .wps-curent-menu-item > a:hover {
  background: '. $this->aap_options['active_menu_color'] .'}';

$css_styles .= '#adminmenu .wp-has-current-submenu .wp-submenu, .no-js li.wp-has-current-submenu:hover .wp-submenu,
#adminmenu a.wp-has-current-submenu:focus+.wp-submenu, #adminmenu .wp-has-current-submenu .wp-submenu.sub-open,
#adminmenu .wp-has-current-submenu.opensub .wp-submenu, #adminmenu .wp-not-current-submenu .wp-submenu,
.folded #adminmenu .wp-has-current-submenu .wp-submenu {
  background:'. $this->aap_options['sub_nav_wrap_color'] . '}';

$css_styles .= '#adminmenu li.wp-has-submenu.wp-not-current-submenu.opensub:hover:after {';
  if(is_rtl())
    $css_styles .= 'border-left-color: ';
  else $css_styles .= 'border-right-color: ';
$css_styles .= $this->aap_options['sub_nav_wrap_color'] .'}';
$css_styles .= '#adminmenu .awaiting-mod, #adminmenu .update-plugins,
#sidemenu li a span.update-plugins, #adminmenu li a.wp-has-current-submenu .update-plugins {
  background-color:'. $this->aap_options['menu_updates_count_bg'] .'; color: '. $this->aap_options['menu_updates_count_text'] . '}';

$css_styles .= '#adminmenu .wp-menu-image img { padding: 6px 0 0 }';

/* Metabox handles */
$css_styles .= '.menu.ui-sortable .menu-item-handle, .meta-box-sortables.ui-sortable .hndle,
.sortUls div.menu_handle, .wp-list-table thead, .menu-item-handle, .widget .widget-top {
  background:'. $this->aap_options['metabox_h3_color'] .';
  border: 1px solid ' . $this->aap_options['metabox_h3_border_color'] .';
  color: '. $this->aap_options['metabox_text_color'] . '}';
$css_styles .= '.postbox .hndle { border: none !important}';
$css_styles .= 'ol.sortUls a.plus:before, ol.sortUls a.minus:before {
  color:'. $this->aap_options['metabox_handle_color'] .'}';
$css_styles .= '.postbox .accordion-section-title:after, .handlediv, .item-edit,
.sidebar-name-arrow, .widget-action, .sortUls a.admin_menu_edit {
  color:'. $this->aap_options['metabox_handle_color'] .'}';
$css_styles .= '.postbox .accordion-section-title:hover:after, .handlediv:hover,
.item-edit:hover, .sidebar-name:hover .sidebar-name-arrow, .widget-action:hover,
.sortUls a.admin_menu_edit:hover {
  color:'. $this->aap_options['metabox_handle_hover_color'] .'}';
$css_styles .= '.wp-list-table thead tr th, .wp-list-table thead tr th a, .wp-list-table thead tr th:hover,
.wp-list-table thead tr th a:hover, span.sorting-indicator:before, span.comment-grey-bubble:before,
.ui-sortable .item-type {
  color:'. $this->aap_options['metabox_text_color'] .'}';

/* Add new buttons */
$css_styles .= '.wrap .add-new-h2, .wrap .add-new-h2:active {
  background-color:'. $this->aap_options['addbtn_bg_color'] .';
  color:'. $this->aap_options['addbtn_text_color'] .'}';
$css_styles .= '.wrap .add-new-h2:hover {
  background-color:'. $this->aap_options['addbtn_hover_bg_color'] .';
  color:'. $this->aap_options['addbtn_hover_text_color'] . '}';

/* Message box */
$css_styles .= 'div.updated, #update-nag, .update-nag {
  border-left: 4px solid '. $this->aap_options['msgbox_border_color'] .';
  background-color:'. $this->aap_options['msg_box_color'] .';
  color:'. $this->aap_options['msgbox_text_color'] .'}';
$css_styles .= 'div.updated #bulk-titles div a:before, .notice-dismiss:before,
.tagchecklist span a:before, .welcome-panel .welcome-panel-close:before {
  background:'. $this->aap_options['msg_box_color'] .';
  color:'. $this->aap_options['msgbox_text_color'] .'}';
$css_styles .= 'div.updated a, #update-nag a, .update-nag a {
  color:'. $this->aap_options['msgbox_link_color'] . '}';
$css_styles .= 'div.updated a:hover, #update-nag a:hover, .update-nag a:hover {
  color:'. $this->aap_options['msgbox_link_hover_color'] . '}';

//gutenberg styles
if(isset($this->aap_options['admin_menu_width']) && !empty($this->aap_options['admin_menu_width'])) {
  $guttenberg_header_width = $this->aap_options['admin_menu_width'] . 'px';
}
else {
  $guttenberg_header_width = '200px';
}

$css_styles .= "@media screen and (min-width: 782px){
    .block-editor .edit-post-header,.auto-fold .edit-post-header,.block-editor .components-notice-list,.auto-fold .block-editor-editor-skeleton,
    .auto-fold .edit-post-layout .components-editor-notices__snackbar {
      left: $guttenberg_header_width;
    }
  }";


  $css_styles .= '@media screen and (min-width: 782px){
    body.auto-fold .edit-post-layout__content {';
  if(!isset($wp_content_margin)){
      $wp_content_margin=200;
  }
    if(is_rtl()) {
      $css_styles .= 'margin-right: '. $wp_content_margin . 'px';
    } else {
      $css_styles .= 'margin-left: '. $wp_content_margin . 'px';
    }
  $css_styles .= '}}';

  if(empty($this->aap_options['default_adminbar_height'])) {
    $css_styles .= '@media screen and (min-width: 782px){
      .edit-post-header, .block-editor .edit-post-header, .woocommerce-layout__header,.auto-fold .block-editor-editor-skeleton,
      .edit-post-layout .editor-post-publish-panel {
          top: 50px!important;
      }
      .ld-header-has-tabs .edit-post-layout .edit-post-header {
        top: 173px!important;
      }
      .block-editor .edit-post-sidebar {
        top:105px;
      }
      .ld-header-has-tabs .edit-post-sidebar, .ld-header-has-tabs.is-fullscreen-mode .edit-post-sidebar {
        top:235px!important;
      }
    }';
  }

  $css_styles .= '.edit-post-header a[href="edit.php?post_type=post"],
  .edit-post-header .edit-post-fullscreen-mode-close {
    display:none;
  }';
  //gutenberg styles

  //Wordfence options control fix
  $css_styles .= ".wf-options-controls {
    position:relative;
    left:auto;
  }";

//Impreza theme options header fixed positioning fix
$css_styles .= '.usof-header {
top:50px;
}
.usof-nav {
top:80px;
}';

/* WPSPowerbox Sidebar menu */
if( is_plugin_active( 'appsaz-admin-panel/appsaz-admin-panel.php' ) ) {

  $css_styles .= '';

  $wpspb_sidebar_width = ( isset($this->aap_options['wpspb_sidebar_menu_width']) && !empty( $this->aap_options['wpspb_sidebar_menu_width'] ) ) ?
    $this->aap_options['wpspb_sidebar_menu_width'] : '250';

  $css_styles .= '.wps-sidebar-wrapper{';

    $css_styles .= 'width:' . $wpspb_sidebar_width . 'px;';

    if( isset($this->aap_options['wpspb_sidebar_wrap_color']) && !empty($this->aap_options['wpspb_sidebar_wrap_color']) ) {
      $css_styles .= 'background: ' . $this->aap_options['wpspb_sidebar_wrap_color'] . ';';
    }
    else {
      $css_styles .= 'background: #1b2831;';
    }

  $css_styles .= '}';

  $css_styles .= '.wps-sidebar-header,.wps-mobile-nav {';
    if( !empty( $this->aap_options['wpspb_sidebar_header_bg'] ) ) {
      $css_styles .= 'background:'. $this->aap_options['wpspb_sidebar_header_bg'];
    }
    else {
      $css_styles .= 'background:#0f161b';
    }
  $css_styles .= '}';

  $css_styles .= '#pin-sidebar, #pin-sidebar i {';
    if( !empty( $this->aap_options['wpspb_sidebar_hamb_color'] ) ) {
      $css_styles .= 'color:'. $this->aap_options['wpspb_sidebar_hamb_color'];
    }
    else {
      $css_styles .= 'color:#ffffff';
    }
  $css_styles .= '}';

  $css_styles .= '.mob-hamburger a, .mob-hamburger a i {';
    if(isset($this->aap_options['wpspb_mob_hamburger_color']) && !empty($this->aap_options['wpspb_mob_hamburger_color'])) {
      $css_styles .= 'color:' . $this->aap_options['wpspb_mob_hamburger_color'] . ';';
    }
    else
      $css_styles .= 'color:#ffffff;';
  $css_styles .= '}';

  $css_styles .= '.wps-sidebar-wrapper .wps-separator {';
    if(isset($this->aap_options['wpspb_sidebar_sep_color']) && !empty($this->aap_options['wpspb_sidebar_sep_color'])) {
      $css_styles .= 'color:' . $this->aap_options['wpspb_sidebar_sep_color'] . ';';
    }
    else
      $css_styles .= 'color:#32343a;';
  $css_styles .= '}';

  $css_styles .= 'body.has-wpspb-sidebar #wpcontent, body.has-wpspb-sidebar #wpfooter {';
    if(is_rtl()) {
      $css_styles .= 'margin-right: '. $wpspb_sidebar_width . 'px';
    } else {
      $css_styles .= 'margin-left: '. $wpspb_sidebar_width . 'px';
    }
  $css_styles .= '}';

  $css_styles .= '
  @media screen and (min-width: 961px) {
    body.has-wpspb-sidebar.auto-fold #wpcontent .interface-interface-skeleton {
        left: '. $wpspb_sidebar_width . 'px;
    }
    body.has-wpspb-sidebar.auto-fold #wpcontent.pinned .interface-interface-skeleton {
        left: 65px;
    }
  }';

  $css_styles .= '@media screen and (min-width: 782px) {
    body.js.is-fullscreen-mode .wps-sidebar-wrapper {
        display: none;
    }
  }';

  $css_styles .= '@media screen and (max-width: 960px) {
    body.has-wpspb-sidebar .wps-sidebar-wrapper {
        left:-' . $wpspb_sidebar_width . 'px;
    }
    body.has-wpspb-sidebar #wpcontent, body.has-wpspb-sidebar #wpfooter {
      margin-left:0
    }
  }';

  //menu text color
  $css_styles .= '.wps-sidebar-menu ul li a, .wps-sidebar-menu ul li a i {';
    if(isset($this->aap_options['wpspb_sidebar_menu_color']) && !empty($this->aap_options['wpspb_sidebar_menu_color'])) {
      $css_styles .= 'color:' . $this->aap_options['wpspb_sidebar_menu_color'] . ';';
    }
    else
      $css_styles .= 'color:#6c727f;';
  $css_styles .= '}';

  //menu hover text color
  $css_styles .= '.wps-sidebar-menu ul li a:hover, .wps-sidebar-menu ul li a:hover i {';
    if(isset($this->aap_options['wpspb_sidebar_hover_text_color']) && !empty($this->aap_options['wpspb_sidebar_hover_text_color'])) {
      $css_styles .= 'color:' . $this->aap_options['wpspb_sidebar_hover_text_color'] . ';';
    }
    else
      $css_styles .= 'color:#ffffff;';
  $css_styles .= '}';

  //current menu bg and text color
  $css_styles .= '.wps-sidebar-wrapper .wps-sidebar-menu ul li.wps-curent-menu-item > a {';
    if(isset($this->aap_options['wpspb_sidebar_active_menu_color']) && !empty($this->aap_options['wpspb_sidebar_active_menu_color'])) {
      $css_styles .= 'background:' . $this->aap_options['wpspb_sidebar_active_menu_color'] . ';';
    }
    else
      $css_styles .= 'background:#507ee4;';
  $css_styles .= '}';

  $css_styles .= '.wps-sidebar-wrapper .wps-sidebar-menu ul li.wps-curent-menu-item > a i {';
    if(isset($this->aap_options['wpspb_sidebar_active_text_color']) && !empty($this->aap_options['wpspb_sidebar_active_text_color'])) {
      $css_styles .= 'color:' . $this->aap_options['wpspb_sidebar_active_text_color'] . ';';
    }
    else
      $css_styles .= 'color:#ffffff;';

    $css_styles .= '}';

  //sub menu wrap
  $css_styles .= '.wps-sidebar-dropdown .wps-sidebar-submenu {';
    if(isset($this->aap_options['wpspb_sidebar_subnav_wrap_color']) && !empty($this->aap_options['wpspb_sidebar_subnav_wrap_color'])) {
      $css_styles .= 'background:' . $this->aap_options['wpspb_sidebar_subnav_wrap_color'] . ';';
    }
    else
      $css_styles .= 'background:#22303a;';
  $css_styles .= '}';

  //sub menu colors
  $css_styles .= '.wps-sidebar-dropdown .wps-sidebar-submenu li a {';
    if(isset($this->aap_options['wpspb_sidebar_subnav_text_color']) && !empty($this->aap_options['wpspb_sidebar_subnav_text_color'])) {
      $css_styles .= 'color:' . $this->aap_options['wpspb_sidebar_subnav_text_color'] . ';';
    }
    else
      $css_styles .= 'color:#6c727f;';
  $css_styles .= '}';

  $css_styles .= '.wps-sidebar-dropdown .wps-sidebar-submenu li a:hover {';
    if(isset($this->aap_options['wpspb_sidebar_subnav_hover_text_color']) && !empty($this->aap_options['wpspb_sidebar_subnav_hover_text_color'])) {
      $css_styles .= 'color:' . $this->aap_options['wpspb_sidebar_subnav_hover_text_color'] . ';';
    }
    else
      $css_styles .= 'color:#ffffff;';
  $css_styles .= '}';

  //WPSPowerbox sidebar user info
  if( !empty($this->aap_options['wpspb_userinfo_text_color']) )
    $css_styles .= '.wps-sidebar-wrapper .user-info, .wps-sidebar-wrapper .wps-user-displayname {color:' . $this->aap_options['wpspb_userinfo_text_color'] . '}';

  if( !empty($this->aap_options['wpspb_userinfo_border_color']) )
    $css_styles .= '.wps-sidebar-wrapper .wps-menu-user-actions {border-color:' . $this->aap_options['wpspb_userinfo_border_color'] . '}';

  if( !empty($this->aap_options['wpspb_userinfo_icon_border_color']) )
    $css_styles .= '.wps-sidebar-wrapper .wps-menu-user-actions a {border-color:' . $this->aap_options['wpspb_userinfo_icon_border_color'] . '}';

  if( !empty($this->aap_options['wpspb_user_info_icon_color']) )
    $css_styles .= 'i.wps-power-switch:before,i.wps-user:before {color:' . $this->aap_options['wpspb_user_info_icon_color'] . '}';

  if( !empty($this->aap_options['wpspb_userinfo_icon_hover_bg_color']) )
    $css_styles .= '.wps-sidebar-wrapper .wps-menu-user-actions a:hover {background-color:' . $this->aap_options['wpspb_userinfo_icon_hover_bg_color'] . ';
      border-color:' . $this->aap_options['wpspb_userinfo_icon_hover_bg_color'] . '}';

  if( !empty($this->aap_options['wpspb_userinfo_icon_hover_color']) )
    $css_styles .= '.wps-sidebar-wrapper .wps-menu-user-actions a:hover i.wps-power-switch:before,
    .wps-sidebar-wrapper .wps-menu-user-actions a:hover i.wps-user:before {color:' . $this->aap_options['wpspb_userinfo_icon_hover_color'] . '}';

}
/* WPSPowerbox Sidebar menu */

$css_styles .= $this->aap_options['admin_page_custom_css'];
$css_styles .= '</style>';

echo $css_styles;
