<?php
/*
 * Configuration for the options function
 */
//get all admin users

function is_wps_single() {
   if(!is_multisite())
	return true;
   elseif(is_multisite() && !defined('NETWORK_ADMIN_CONTROL'))
	return true;
   else return false;
}

function get_wps_options() {

  $blog_email = get_option('admin_email');
  $blog_from_name = get_option('blogname');

  if(is_wps_single()) {
    $wps_options = (is_serialized(get_option(APPSAZ_ADMIN_OPTIONS_PANEL))) ? unserialize(get_option(APPSAZ_ADMIN_OPTIONS_PANEL)) : get_option(APPSAZ_ADMIN_OPTIONS_PANEL);
  }
  else {
    $wps_options = (is_serialized(get_site_option(APPSAZ_ADMIN_OPTIONS_PANEL))) ? unserialize(get_site_option(APPSAZ_ADMIN_OPTIONS_PANEL)) : get_site_option(APPSAZ_ADMIN_OPTIONS_PANEL);
  }

  /**
  * get adminbar items
  *
  */
  if(is_wps_single()) {
    $adminbar_items = (is_serialized(get_option(WPS_ADMINBAR_LIST_SLUG))) ? unserialize(get_option(WPS_ADMINBAR_LIST_SLUG)) : get_option(WPS_ADMINBAR_LIST_SLUG);
  }
  else {
    $adminbar_items = (is_serialized(get_site_option(WPS_ADMINBAR_LIST_SLUG))) ? unserialize(get_site_option(WPS_ADMINBAR_LIST_SLUG)) : get_site_option(WPS_ADMINBAR_LIST_SLUG);
  }

  $adminbar_items = (!empty($adminbar_items)) ? array_unique($adminbar_items) : "";

  //get all admin users
    $admin_users = (is_serialized(get_option(WPADMINPANEL_USERS_SLUG))) ? unserialize(get_option(WPADMINPANEL_USERS_SLUG)) : get_option(WPADMINPANEL_USERS_SLUG);

  if(empty($admin_users) && !is_array($admin_users)) {
    $users_query = new WP_User_Query( array( 'role' => 'Administrator' ) );
    if(isset($users_query) && !empty($users_query)) {
        if ( ! empty( $users_query->results ) ) {
            foreach ( $users_query->results as $user_detail ) {
                $admin_users[$user_detail->ID] = $user_detail->data->display_name;
            }
        }
    }
  }

  //get dashboard widgets
  if(is_wps_single()) {
    $dash_widgets_list = (is_serialized(get_option('wps_widgets_list'))) ? unserialize(get_option('wps_widgets_list')) : get_option('wps_widgets_list');
  }
  else {
    $dash_widgets_list = (is_serialized(get_site_option('wps_widgets_list'))) ? unserialize(get_site_option('wps_widgets_list')) : get_site_option('wps_widgets_list');
  }

  $wps_dash_widgets = array();
  $wps_dash_widgets['welcome_panel'] = "Welcome Panel";
  if(!empty($dash_widgets_list)) {
      foreach( $dash_widgets_list as $dash_widget ) {
          $dash_widget_name = (empty($dash_widget[1])) ? $dash_widget[0] : $dash_widget[1];
          $wps_dash_widgets[$dash_widget[0]] = $dash_widget_name;
      }
  }

    $panel_tabs = array(
        'general' => __( 'تنظیمات عمومی', 'aof' ),
        'login' => __( 'تنظیمات ورود به پنل', 'aof' ),
        'dash' => __( 'تنظیمات داشبورد', 'aof' ),
        'adminbar' => __( 'تنظیمات نوار ادمین', 'aof' ),
        'adminop' => __( 'تنظیمات صفحه ادمین', 'aof' ),
        'footer' => __( 'تنظیمات پاورقی', 'aof' ),

    );

  $panel_tabs = apply_filters( 'aof_tabs_list', $panel_tabs );

  $panel_fields = array();

    $panel_fields[] = array(
        'name' => __( 'تنظیمات عمومی', 'aof' ),
        'type' => 'openTab'
    );
    $panel_fields[] = array(
        'name' => __( 'Heading H1 color', 'appsaz-admin' ),
        'id' => 'h1_color',
        'type' => 'wpcolor',
        'default' => '#333333',
    );

    $panel_fields[] = array(
        'name' => __( 'Heading H2 color', 'appsaz-admin' ),
        'id' => 'h2_color',
        'type' => 'wpcolor',
        'default' => '#4704ef',
    );

    $panel_fields[] = array(
        'name' => __( 'Heading H3 color', 'appsaz-admin' ),
        'id' => 'h3_color',
        'type' => 'wpcolor',
        'default' => '#222222',
    );

    $panel_fields[] = array(
        'name' => __( 'Heading H4 color', 'appsaz-admin' ),
        'id' => 'h4_color',
        'type' => 'wpcolor',
        'default' => '#18307c',
    );

    $panel_fields[] = array(
        'name' => __( 'Heading H5 color', 'appsaz-admin' ),
        'id' => 'h5_color',
        'type' => 'wpcolor',
        'default' => '#555555',
    );

    $panel_fields[] = array(
        'name' => __( 'Heading H6 color', 'appsaz-admin' ),
        'id' => 'h6_color',
        'type' => 'wpcolor',
        'default' => '#555555',
    );

    $panel_fields[] = array(
        'name' => __( 'حذف موارد ناخواسته', 'appsaz-admin' ),
        'id' => 'admin_generaloptions',
        'type' => 'multicheck',
        'desc' => __( 'مواردی که می خواهید حذف شوند را انتخاب کنید.', 'appsaz-admin' ),
        'options' => array(
            '1' => __( 'Wordpress Help tab.', 'appsaz-admin' ),
            '2' => __( 'Screen Options.', 'appsaz-admin' ),
            '3' => __( 'Wordpress update notifications.', 'appsaz-admin' ),
        ),
    );

    $panel_fields[] = array(
        'name' => __( 'تنظیمات سفارشی سازی  منو', 'appsaz-admin' ),
        'type' => 'title',
    );

    $panel_fields[] = array(
        'name' => __( 'نمایش منو', 'appsaz-admin' ),
        'id' => 'show_all_menu_to_admin',
        'type' => 'radio',
        'options' => array(
            '1' => __( 'نمایش تمام لینک های منو به تمام مدیران', 'appsaz-admin' ),
            '2' => __( 'نمایش تمام لینک های منو به مدیران خاص', 'appsaz-admin' ),
        ),
    );

    $panel_fields[] = array(
        'name' => __( 'انتخاب کاربران مجاز', 'appsaz-admin' ),
        'id' => 'privilege_users',
        'type' => 'multicheck',
        'desc' => __( 'مدیرانی که می توانند به تمام آیتم های منو دسترسی داشته باشند را انتخاب کنید.', 'appsaz-admin' ),
        'options' => $admin_users,
    );

//Login Options
    $panel_fields[] = array(
        'name' => __( 'تنظیمات ورود به پنل', 'aof' ),
        'type' => 'openTab'
    );
    $panel_fields[] = array(
        'name' => __( 'تغییر آدرس صفحه ورود ادمین', 'appsaz-admin' ),
        'id' => 'admin_page_login',
        'type' => 'checkbox',
        'desc' => __( 'اگر انتخاب کنید آدرس به /appsaz-login.php تغییر می کند', 'appsaz-admin' ),
        'default' => false,
    );
    $panel_fields[] = array(
        'name' => __( 'تغییر ظاهر صفحه وورد', 'appsaz-admin' ),
        'id' => 'disable_styles_login',
        'type' => 'checkbox',
        'desc' => __( 'جهت فعال کردن تنظیمات زیر این گزینه را انتخاب کنید.', 'appsaz-admin' ),
        'default' => true,
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ پس زمینه', 'appsaz-admin' ),
        'id' => 'login_bg_color',
        'type' => 'wpcolor',
        'default' => '#2c81b8',
    );

    $panel_fields[] = array(
        'name' => __( 'تصویر پس زمینه', 'appsaz-admin' ),
        'id' => 'login_bg_img',
        'type' => 'upload',
    );

    $panel_fields[] = array(
        'name' => __( 'تکرار تصویر پس زمینه', 'appsaz-admin' ),
        'id' => 'login_bg_img_repeat',
        'type' => 'checkbox',
        'desc' => __( 'برای تکرار تصویر، این گزینه را انتخاب کنید.', 'appsaz-admin' ),
        'default' => true,
    );

    $panel_fields[] = array(
        'name' => __( 'اندازه تصویر پس زمینه', 'appsaz-admin' ),
        'id' => 'login_bg_img_scale',
        'type' => 'checkbox',
        'desc' => __( 'فیت کردن تصویر در صفحه نمایش ', 'appsaz-admin' ),
        'default' => true,
    );

    $panel_fields[] = array(
        'name' => __( 'حاشیه بالای فرم ورود به پنل', 'appsaz-admin' ),
        'id' => 'login_form_margintop',
        'type' => 'number',
        'default' => '100',
        'min' => '0',
        'max' => '700',
    );

    $panel_fields[] = array(
        'name' => __( 'عرض فرم ورود به پنل (%)', 'appsaz-admin' ),
        'id' => 'login_form_width',
        'type' => 'number',
        'default' => '25',
        'desc'=>__('25 پیشنهادی','appsaz-admin'),
        'min' => '20',
        'max' => '100',
    );

    $panel_fields[] = array(
        'name' => __( 'آپلود کردن لوگو اپلیکیشن', 'appsaz-admin' ),
        'id' => 'admin_login_logo',
        'type' => 'upload',
        'desc' => __( 'تصویری که در صفحه ورود نمایش داده می شود. حداکثر عرض باید کمتر از 450 پیکسل باشد.', 'appsaz-admin' ),
    );

    $panel_fields[] = array(
        'name' => __( 'تغییر اندازه لوگو', 'appsaz-admin' ),
        'id' => 'admin_logo_resize',
        'type' => 'checkbox',
        'default' => false,
        'desc' => __( 'جهت تغییر اندازه لوگو، این گزینه را انتخاب کنید.', 'appsaz-admin' ),
    );

    $panel_fields[] = array(
        'name' => __( 'تنظیم اندازه لوگو (%)', 'appsaz-admin' ),
        'id' => 'admin_logo_size_percent',
        'type' => 'number',
        'default' => '20',
        'desc' => __( '20 پیشنهادی', 'appsaz-admin' ),
        'max' => '100',
    );

    $panel_fields[] = array(
        'name' => __( 'ارتفاع لوگو', 'appsaz-admin' ),
        'id' => 'admin_logo_height',
        'type' => 'number',
        'default' => '100',
        'desc' => __( '100 پیشنهادی', 'appsaz-admin' ),
        'max' => '150',
    );

    $panel_fields[] = array(
        'name' => __( 'url لوگو ', 'appsaz-admin' ),
        'id' => 'login_logo_url',
        'type' => 'text',
        'default' => get_bloginfo('url'),
    );

    $panel_fields[] = array(
        'name' => __( 'Transparent Form', 'appsaz-admin' ),
        'id' => 'login_divbg_transparent',
        'type' => 'checkbox',
        'default' => false,
        'desc' => __( '.برای نمایش پس زمینه  شفاف فرم ورود این گزینه را انتخاب کنید', 'appsaz-admin' ),
    );

    $panel_fields[] = array(
        'name' => __( 'Login div bacground color', 'appsaz-admin' ),
        'id' => 'login_divbg_color',
        'type' => 'wpcolor',
        'default' => '#f5f5f5',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ پس زمینه فرم ورود به پنل', 'appsaz-admin' ),
        'id' => 'login_formbg_color',
        'type' => 'wpcolor',
        'default' => '#423143',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ حاشیه فرم', 'appsaz-admin' ),
        'id' => 'form_border_color',
        'type' => 'wpcolor',
        'default' => '#e5e5e5',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ متن فرم', 'appsaz-admin' ),
        'id' => 'form_text_color',
        'type' => 'wpcolor',
        'default' => '#cccccc',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ لینک فرم', 'appsaz-admin' ),
        'id' => 'form_link_color',
        'type' => 'wpcolor',
        'default' => '#777777',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ hover لینک فرم ', 'appsaz-admin' ),
        'id' => 'form_link_hover_color',
        'type' => 'wpcolor',
        'default' => '#555555',
    );

    $panel_fields[] = array(
        'name' => __( 'مخفی کردن بازگشت به لینک وبلاگ', 'appsaz-admin' ),
        'id' => 'hide_backtoblog',
        'type' => 'checkbox',
        'default' => false,
        'desc' => __( 'جهت مخفی کردن این گزینه را انتخاب کنید.', 'appsaz-admin' ),
    );

    $panel_fields[] = array(
        'name' => __( 'مخفی کردن "مرا به خاطر بسپار"', 'appsaz-admin' ),
        'id' => 'hide_remember',
        'type' => 'checkbox',
        'default' => false,
        'desc' => __( 'جهت مخفی کردن این گزینه را انتخاب کنید.', 'appsaz-admin' ),
    );

    $panel_fields[] = array(
        'name' => __( 'سفارشی سازی محتوای فوتر', 'appsaz-admin' ),
        'id' => 'login_footer_content',
        'type' => 'wpeditor',
    );

    $panel_fields[] = array(
        'name' => __( 'CSS سفارشی', 'appsaz-admin' ),
        'type' => 'title',
    );

    $panel_fields[] = array(
        'name' => __( 'CSS سفارشی برای صفحه ورود به پنل', 'appsaz-admin' ),
        'id' => 'login_custom_css',
        'type' => 'textarea',
    );


//Dash Options
    $panel_fields[] = array(
        'name' => __( 'تنظیمات داشبورد', 'aof' ),
        'type' => 'openTab'
    );

    $panel_fields[] = array(
        'name' => __( 'حذف ابزارک های ناخواسته', 'appsaz-admin' ),
        'id' => 'remove_dash_widgets',
        'type' => 'multicheck',
        'desc' => __( 'مواردی که می خواهید حذف شوند، را انتخاب کنید.', 'appsaz-admin' ),
        'options' => array(
            '1' => __( 'پنل خوش آمد گویی', 'appsaz-admin' ),
            '2' => __( 'Right now', 'appsaz-admin' ),
            '3' => __( 'فعالیت های اخیر', 'appsaz-admin' ),
            '4' => __( 'Incoming links', 'appsaz-admin' ),
            '5' => __( 'افزونه ها', 'appsaz-admin' ),
            '6' => __( 'Quick press', 'appsaz-admin' ),
            '7' => __( 'پیش نویس های اخیر', 'appsaz-admin' ),
            '8' => __( 'اخبار وردپرس', 'appsaz-admin' ),
            '9' => __( 'وبلاگ وردپرس', 'appsaz-admin' ),
            '10' => __( 'bbPress', 'appsaz-admin' ),
            '11' => __( 'Yoast seo', 'appsaz-admin' ),
            '12' => __( 'گرویتی فرم', 'appsaz-admin' ),
        ),
        'default' => array( '8', '9' ),
    );

//AdminBar Options
    $panel_fields[] = array(
        'name' => __( 'تنظیمات نوار ادمین', 'aof' ),
        'type' => 'openTab'
    );

    $panel_fields[] = array(
        'name' => __( 'بارگذاری لوگو اپلیکیشن', 'appsaz-admin' ),
        'id' => 'admin_logo',
        'type' => 'upload',
        'desc' => __( 'تصویری که در همه صفحات نمایش داده می شود. (حداکثر اندازه  200x50 پیکسل)', 'appsaz-admin' ),
    );

    $panel_fields[] = array(
        'name' => __( 'حرکت لوگو به بالا', 'appsaz-admin' ),
        'id' => 'logo_top_margin',
        'type' => 'number',
        'desc' => __( "در صورتی که موقعیت لوگو با موقعیت منو مطابقت ندارد، می تواند استفاده شود.", 'appsaz-admin' ),
        'default' => '3',
        'max' => '20',
    );

    $panel_fields[] = array(
        'name' => __( 'حرکت لوگو به پایین', 'appsaz-admin' ),
        'id' => 'logo_bottom_margin',
        'type' => 'number',
        'desc' => __( "در صورتی که موقعیت لوگو با موقعیت منو مطابقت ندارد، می تواند استفاده شود", 'appsaz-admin' ),
        'default' => '0',
        'max' => '20',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ نوار ادمین', 'appsaz-admin' ),
        'id' => 'admin_bar_color',
        'type' => 'wpcolor',
        'default' => '#fff',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ لینک منو', 'appsaz-admin' ),
        'id' => 'admin_bar_menu_color',
        'type' => 'wpcolor',
        'default' => '#94979B',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ  hover لینک منو', 'appsaz-admin' ),
        'id' => 'admin_bar_menu_hover_color',
        'type' => 'wpcolor',
        'default' => '#474747',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ پس زمینه hover لینک منو', 'appsaz-admin' ),
        'id' => 'admin_bar_menu_bg_hover_color',
        'type' => 'wpcolor',
        'default' => '#f4f4f4',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ لینک زیر منو', 'appsaz-admin' ),
        'id' => 'admin_bar_sbmenu_link_color',
        'type' => 'wpcolor',
        'default' => '#666666',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ hover لینک زیر منو', 'appsaz-admin' ),
        'id' => 'admin_bar_sbmenu_link_hover_color',
        'type' => 'wpcolor',
        'default' => '#333333',
    );

    $panel_fields[] = array(
        'name' => __( 'حذف منوهای ناخواسته', 'appsaz-admin' ),
        'id' => 'hide_admin_bar_menus',
        'type' => 'multicheck',
        'desc' => __( 'مواردی که می خواهید حذف شوند را انتخاب کنید.', 'appsaz-admin' ),
        'options' => array(
            '1' => __( 'نام سایت', 'appsaz-admin' ),
            '2' => __( 'بارگذاری ها', 'appsaz-admin' ),
            '3' => __( 'نظرات', 'appsaz-admin' ),
            '4' => __( 'نظر جدید', 'appsaz-admin' ),
            '5' => __( 'ویرایش مشخصات', 'appsaz-admin' ),
            '7' => __( 'لوگوی وردپرس', 'appsaz-admin' ),
            '8' => __( 'سریع ترین کش ووردپرس', 'appsaz-admin' ),
        ),
        'default' => array( '1','3', '4', '7','2','5'),
    );



//Admin Options
    $panel_fields[] = array(
        'name' => __( 'تنظیمات صفحه ادمین', 'aof' ),
        'type' => 'openTab',

    );

    $panel_fields[] = array(
        'name' => __( 'تنظیمات رنگ منو ادمین', 'appsaz-admin' ),
        'type' => 'title',

    );

    $panel_fields[] = array(
        'name' => __( 'رنگ پس زمینه', 'appsaz-admin' ),
        'id' => 'bg_color',
        'type' => 'wpcolor',
        'default' => '#d8d8d8',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ پس زمینه منو کنار', 'appsaz-admin' ),
        'id' => 'nav_wrap_color',
        'type' => 'wpcolor',
        'default' => '#5200e0',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ wrap زیر منو', 'appsaz-admin' ),
        'id' => 'sub_nav_wrap_color',
        'type' => 'wpcolor',
        'default' => '#a8a8a8',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ hover منو', 'appsaz-admin' ),
        'id' => 'hover_menu_color',
        'type' => 'wpcolor',
        'default' => '#ffd800',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ منو فعال فعلی', 'appsaz-admin' ),
        'id' => 'active_menu_color',
        'type' => 'wpcolor',
        'default' => '#f97400',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ متن منو', 'appsaz-admin' ),
        'id' => 'nav_text_color',
        'type' => 'wpcolor',
        'default' => '#fff',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ hover متن منو', 'appsaz-admin' ),
        'id' => 'menu_hover_text_color',
        'type' => 'wpcolor',
        'default' => '#ff0000',
    );

    $panel_fields[] = array(
        'name' => __( 'تعداد به روز رسانی های اعلان های پس زمینه', 'appsaz-admin' ),
        'id' => 'menu_updates_count_bg',
        'type' => 'wpcolor',
        'default' => '#ffffff',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ متن تعداد به روز رسانی ها', 'appsaz-admin' ),
        'id' => 'menu_updates_count_text',
        'type' => 'wpcolor',
        'default' => '#2f28ff',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ دکمه اصلی', 'appsaz-admin' ),
        'type' => 'title',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ پس زمینه دکمه', 'appsaz-admin' ),
        'id' => 'pry_button_color',
        'type' => 'wpcolor',
        'default' => '#7ac600',
    );

    if(isset($wps_options['design_type']) && $wps_options['design_type'] != 1) {
        $panel_fields[] = array(
            'name' => __( 'رنگ حاشیه دکمه', 'appsaz-admin' ),
            'id' => 'pry_button_border_color',
            'type' => 'wpcolor',
            'default' => '#86b520',
        );

        $panel_fields[] = array(
            'name' => __( 'رنگ سایه دکمه', 'appsaz-admin' ),
            'id' => 'pry_button_shadow_color',
            'type' => 'wpcolor',
            'default' => '#98ce23',
        );
    }

    $panel_fields[] = array(
        'name' => __( 'رنگ متن دکمه', 'appsaz-admin' ),
        'id' => 'pry_button_text_color',
        'type' => 'wpcolor',
        'default' => '#ffffff',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ hover پس زمینه دکمه ', 'appsaz-admin' ),
        'id' => 'pry_button_hover_color',
        'type' => 'wpcolor',
        'default' => '#29ac39',
    );

    if(isset($wps_options['design_type']) && $wps_options['design_type'] != 1) {
        $panel_fields[] = array(
            'name' => __( 'رنگ hover حاشیه دکمه', 'appsaz-admin' ),
            'id' => 'pry_button_hover_border_color',
            'type' => 'wpcolor',
            'default' => '#259633',
        );

        $panel_fields[] = array(
            'name' => __( 'رنگ hover حاشیه دکمه', 'appsaz-admin' ),
            'id' => 'pry_button_hover_shadow_color',
            'type' => 'wpcolor',
            'default' => '#3d7a0c',
        );
    }

    $panel_fields[] = array(
        'name' => __( 'رنگ hover متن دکمه', 'appsaz-admin' ),
        'id' => 'pry_button_hover_text_color',
        'type' => 'wpcolor',
        'default' => '#ffffff',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ های دکمه ثانوی', 'appsaz-admin' ),
        'type' => 'title',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ پس زمینه دکمه', 'appsaz-admin' ),
        'id' => 'sec_button_color',
        'type' => 'wpcolor',
        'default' => '#ced6c9',
    );

    if(isset($wps_options['design_type']) && $wps_options['design_type'] != 1) {
        $panel_fields[] = array(
            'name' => __( 'رنگ حاشیه دکمه', 'appsaz-admin' ),
            'id' => 'sec_button_border_color',
            'type' => 'wpcolor',
            'default' => '#bdc4b8',
        );

        $panel_fields[] = array(
            'name' => __( 'رنگ سایه دکمه', 'appsaz-admin' ),
            'id' => 'sec_button_shadow_color',
            'type' => 'wpcolor',
            'default' => '#dde5d7',
        );
    }

    $panel_fields[] = array(
        'name' => __( 'رنگ متن دکمه', 'appsaz-admin' ),
        'id' => 'sec_button_text_color',
        'type' => 'wpcolor',
        'default' => '#7a7a7a',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ hover پس زمینه دکمه', 'appsaz-admin' ),
        'id' => 'sec_button_hover_color',
        'type' => 'wpcolor',
        'default' => '#c9c8bf',
    );

    if(isset($wps_options['design_type']) && $wps_options['design_type'] != 1) {
        $panel_fields[] = array(
            'name' => __( 'رنگ  hover حاشیه دکمه', 'appsaz-admin' ),
            'id' => 'sec_button_hover_border_color',
            'type' => 'wpcolor',
            'default' => '#babab0',
        );

        $panel_fields[] = array(
            'name' => __( 'رنگ  hover سایه دکمه', 'appsaz-admin' ),
            'id' => 'sec_button_hover_shadow_color',
            'type' => 'wpcolor',
            'default' => '#9ea59b',
        );
    }

    $panel_fields[] = array(
        'name' => __( 'رنگ hover متن دکمه', 'appsaz-admin' ),
        'id' => 'sec_button_hover_text_color',
        'type' => 'wpcolor',
        'default' => '#ffffff',
    );

    $panel_fields[] = array(
        'name' => __( 'افزودن دکمه جدید', 'appsaz-admin' ),
        'type' => 'title',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ پس زمینه دکمه', 'appsaz-admin' ),
        'id' => 'addbtn_bg_color',
        'type' => 'wpcolor',
        'default' => '#53D860',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ hover پس زمینه دکمه', 'appsaz-admin' ),
        'id' => 'addbtn_hover_bg_color',
        'type' => 'wpcolor',
        'default' => '#5AC565',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ متن دکمه', 'appsaz-admin' ),
        'id' => 'addbtn_text_color',
        'type' => 'wpcolor',
        'default' => '#ffffff',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ hover متن دکمه', 'appsaz-admin' ),
        'id' => 'addbtn_hover_text_color',
        'type' => 'wpcolor',
        'default' => '#ffffff',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ های متاباکس', 'appsaz-admin' ),
        'type' => 'title',
    );

    $panel_fields[] = array(
        'name' => __( 'هدر متاباکس', 'appsaz-admin' ),
        'id' => 'metabox_h3_color',
        'type' => 'wpcolor',
        'default' => '#bdbdbd',
    );

    $panel_fields[] = array(
        'name' => __( 'حاشیه هدر متاباکس', 'appsaz-admin' ),
        'id' => 'metabox_h3_border_color',
        'type' => 'wpcolor',
        'default' => '#9e9e9e',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ دکمه کلیک هدر متاباکس', 'appsaz-admin' ),
        'id' => 'metabox_handle_color',
        'type' => 'wpcolor',
        'default' => '#ffffff',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ hover دکمه کلیک هدر متاباکس', 'appsaz-admin' ),
        'id' => 'metabox_handle_hover_color',
        'type' => 'wpcolor',
        'default' => '#949494',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ متن هدر متاباکس', 'appsaz-admin' ),
        'id' => 'metabox_text_color',
        'type' => 'wpcolor',
        'default' => '#ffffff',
    );

    $panel_fields[] = array(
        'name' => __( 'صندوق پیام (به روز رسانی های پست / صفحه)', 'appsaz-admin' ),
        'type' => 'title',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ صندوق پیام', 'appsaz-admin' ),
        'id' => 'msg_box_color',
        'type' => 'wpcolor',
        'default' => '#02c5cc',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ متن پیام', 'appsaz-admin' ),
        'id' => 'msgbox_text_color',
        'type' => 'wpcolor',
        'default' => '#ffffff',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ حاشیه صندوق پیام', 'appsaz-admin' ),
        'id' => 'msgbox_border_color',
        'type' => 'wpcolor',
        'default' => '#007e87',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ لینک پیام', 'appsaz-admin' ),
        'id' => 'msgbox_link_color',
        'type' => 'wpcolor',
        'default' => '#efefef',
    );

    $panel_fields[] = array(
        'name' => __( 'رنگ hover لینک پیام', 'appsaz-admin' ),
        'id' => 'msgbox_link_hover_color',
        'type' => 'wpcolor',
        'default' => '#e5e5e5',
    );

    $panel_fields[] = array(
        'name' => __( ' CSS سفارشی', 'appsaz-admin' ),
        'type' => 'title',
    );

    $panel_fields[] = array(
        'name' => __( ' CSS سفارشی برای صفحه مدیریت', 'appsaz-admin' ),
        'id' => 'admin_page_custom_css',
        'type' => 'textarea',
    );

//Footer Options
    $panel_fields[] = array(
        'name' => __( 'تنظیمات پاورقی', 'aof' ),
        'type' => 'openTab'
    );
    $panel_fields[] = array(
        'name' => __( 'متن پاورقی', 'appsaz-admin' ),
        'id' => 'admin_footer_txt',
        'type' => 'wpeditor',
        'desc' => __( 'هر متنی را که میخواهید در پایین صفحه مدیریت نشان دهید، در اینجا قرار دهید.', 'appsaz-admin' ),
        'default'=>__('تمامی حقوق برای هلدینگ نرم افزاری <a href="http://palapalco.com">پالاپال پرداز فارس </a>محفوظ است.', 'appsaz-admin' )
    );


    $panel_fields = apply_filters( 'aof_panel_fields', $panel_fields );

  $output = array('wps_tabs' => $panel_tabs, 'wps_fields' => $panel_fields);
  return $output;
}
