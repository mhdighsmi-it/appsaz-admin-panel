<?php
/*
 * APPSAZADMIN
 * @author   AcmeeDesign
 * @url     http://acmeedesign.com
*/

defined('ABSPATH') || die;

if (!class_exists('APPSAZADMIN')) {

  class APPSAZADMIN
  {
  	private $wp_df_menu;
  	private $wp_df_submenu;
  	private $wps_options = APPSAZ_ADMIN_OPTIONS_PANEL;
  	private $wps_menuorder_options = 'APPSAZADMIN_menuorder';
    private $wps_purchase_data = 'wps_purchase_data';
    public $aap_options;
    private $do_not_save;

	function __construct()
	{
      $this->do_not_save = array('title', 'openTab', 'import', 'export');
      $this->aap_options = $this->get_wps_option_data($this->wps_options);
      add_action('admin_menu', array($this, 'wps_sub_menus'));
      add_action('wp_dashboard_setup', array($this, 'initialize_dash_widgets'), 999);

	    add_filter('admin_title', array($this, 'custom_admin_title'), 999, 2);

	    add_action( 'admin_bar_menu', array($this, 'add_APPSAZADMIN_menus'), 0 );
	    add_action( 'admin_bar_menu', array($this, 'add_APPSAZADMIN_nav_menus'), 99);
      add_action( 'admin_bar_menu', array($this, 'wps_save_adminbar_nodes'), 9990 );
      add_action( 'wp_before_admin_bar_render', array($this, 'wps_save_adminbar_nodes'), 9990 );
      if($this->aap_options['disable_styles_login'] == 1) {
          if ( ! has_action( 'login_enqueue_scripts', array($this, 'APPSAZADMINloginAssets') ) )
            add_action('login_enqueue_scripts', array($this, 'APPSAZADMINloginAssets'), 10);
          add_action('login_head', array($this, 'wpshapeLogincss'));
       }
	    add_action( 'admin_enqueue_scripts', array($this, 'APPSAZADMINAssets'), 99999 );
      add_action('admin_head', array($this, 'wpshapeOptionscss'));
	    add_action('wp_before_admin_bar_render', array($this, 'wps_remove_bar_links'), 9999);
      if(!empty($this->aap_options['adminbar_custom_welcome_text']))
        add_action( 'admin_bar_menu', array($this, 'update_avatar_size'), 99 );
	    add_filter('login_headerurl', array($this, 'APPSAZADMIN_login_url'));
	    add_filter('login_headertext', array($this, 'APPSAZADMIN_login_title'));
//	    add_action('admin_head', array($this, 'generalFns'));

      add_action('plugins_loaded',array($this, 'get_admin_users'));
      //add_action( 'admin_footer', array($this, 'wps_footer_content'), 99);
      add_filter( 'admin_footer_text', array($this, 'wps_footer_content'), 99999 );
	    add_action('login_footer', array($this, 'login_footer_content'));

      add_action( 'activated_plugin', array($this, 'wps_activated' ));
      add_action( 'aap_before_heading', array($this, 'wps_welcome_msg'));
      add_action( 'aof_after_heading', array($this, 'wps_help_link'));
      add_filter( 'login_title', array($this, 'login_page_title') );
	}

    /*
    * Redirect to settings page after plugin activation
    */
   function wps_activated( $plugin ) {
     if( $plugin == plugin_basename( WPADMINPANEL_PATH . "appsaz-admin-panel.php" ) ) {
       exit( wp_redirect( admin_url( 'admin.php?page=wpappsazadmin_options&status=wps-activated' ) ) );
     }
   }

  function wps_welcome_msg() {
    if(isset($_GET['status']) && $_GET['status'] == "wps-activated") {
       echo '<h1 style="line-height: 1.2em;font-size: 2.8em;font-weight: 400;">' . __('Welcome to APPSAZADMIN ', 'appsaz-admin') . '</h1><br />';
    }
  }

  function wps_help_link() {
    echo '<div class="wps_kb_link"><a class="wps_kb_link" target="_blank" href="https://kb.acmeedesign.com/kbase_categories/APPSAZADMIN/"><span class="dashicons dashicons-editor-help"></span> ';
    echo __('Visit Knowledgebase', 'appsaz-admin');
    echo '</a></div>';
  }

  function wps_load_textdomain()
  {
    load_plugin_textdomain('appsaz-admin', false, dirname( plugin_basename( __FILE__ ) )  . '/languages' );
  }

  /* custom login page title */
  function login_page_title() {
    if(!empty($this->aap_options['login_page_title'])) {
      return $this->aap_options['login_page_title'];
    }
    else return get_bloginfo('name');
  }

  /*
  * function to determine multi customization is enabled
  */
	public function is_wps_single() {
	    if(!is_multisite())
		return true;
	    elseif(is_multisite() && !defined('NETWORK_ADMIN_CONTROL'))
		return true;
	    else return false;
	}


	public function APPSAZADMINloginAssets()
	{
		wp_enqueue_script("jquery");
    if(isset($_GET['action']) && $_GET['action'] == 'rp'){}
    else {
      wp_enqueue_script( 'loginjs-js', WPADMINPANEL_DIR_URI . 'assets/js/loginjs.js', array( 'jquery' ), '', true );
    }
    wp_enqueue_style( 'dashicons' );
    wp_enqueue_style('fontAwesome', WPADMINPANEL_DIR_URI . 'assets/font-awesome/css/font-awesome.min.css');
    wp_enqueue_style('lineIcons', WPADMINPANEL_DIR_URI . 'assets/lineicons/lineicons.min.css');
	}
	public function APPSAZADMINAssets($nowpage)
	{
    wp_enqueue_script('jquery');
    wp_enqueue_style( 'dashicons' );
    wp_enqueue_style('fontAwesome', WPADMINPANEL_DIR_URI . 'assets/font-awesome/css/font-awesome.min.css', '', WPAPPSAZADMIN_VERSION);
    wp_enqueue_style('lineIcons', WPADMINPANEL_DIR_URI . 'assets/lineicons/lineicons.min.css', '', WPAPPSAZADMIN_VERSION);
    if($nowpage == 'toplevel_page_wpappsazadmin_options') {
      wp_enqueue_script( 'wps-livepreview', WPADMINPANEL_DIR_URI . 'assets/js/aof-live-preview.min.js', array( 'jquery' ), '', true );
    }
	}

	public function wpshapeLogincss()
	{
    include_once( WPADMINPANEL_PATH . 'assets/css/APPSAZADMIN.login.css.php');
	}

	public function wpshapeOptionscss()
	{
	    ?>
        <style>
            @font-face {
                font-family: iransans;
                src: url('<?php echo WPADMINPANEL_DIR_URI  ?>/assets/fonts/IRANSansWebFaNum.ttf');
                src: url('<?php echo WPADMINPANEL_DIR_URI  ?>/assets/fonts/IRANSansWebFaNum.woff2');
            }
            #wpwrap {
                font-family: iransans;
            }
        </style>
        <?php
    if( is_plugin_active( 'appsaz-admin-panel/appsaz-admin-panel.php' ) && $this->is_user_has_custom_menu() == true ) {
    	$this->wps_admin_css();

    }
    if( isset($this->aap_options['disable_admin_theme']) && $this->aap_options['disable_admin_theme'] == 1 )
      return;
    $this->wps_admin_css();
	}

  function wps_admin_css(){
    include_once( WPADMINPANEL_PATH . 'assets/css/APPSAZADMIN.css.php');
  }

  function get_admin_users() {
    if(isset($_POST) && isset($_POST['aap_options_save'])) {

      $admin_users = array();
      $admin_user_query = null;

      if ( is_multisite() ) {
        $admin_user_query = get_super_admins();
      }
      if(empty($admin_user_query) && !is_array($admin_user_query)) {
        $admin_user_query = new WP_User_Query( array( 'role' => 'Administrator' ) );
      }
      if(empty($admin_user_query) && !is_array($admin_user_query)) {
        $admin_user_query = new WP_User_Query( array( 'meta_key' => 'wp_user_level', 'meta_value' => '10' ) );
      }

      if ( is_multisite() ) {

        if(!empty($admin_user_query) && is_array($admin_user_query)) {
          foreach ($admin_user_query as $admin_user_name) {
            $admin_user_id = get_user_by('login', $admin_user_name);
            $admin_user_id = $admin_user_id->ID;
            $admin_users[$admin_user_id] = $admin_user_name;
          }
        }

      }
      else {

        foreach ($admin_user_query->results as $admin_data) {
          if(!empty($admin_data->data->display_name)) {
            $user_display_name = $admin_data->data->display_name;
          }
          else {
            $user_display_name = $admin_data->data->user_login;
          }
          $admin_users[$admin_data->ID] = $user_display_name;
        }

      }

      if(!empty($admin_users)) {
        $this->updateOption(WPADMINPANEL_USERS_SLUG, $admin_users);
      }
    }
  }

	public function generalFns() {
    //get current user ID
    $current_user_id = get_current_user_id();

    //get menu access data
    $screen_meta_access = ( !empty($this->aap_options['show_screen_meta_to_admin'] ) ) ? $this->aap_options['show_screen_meta_to_admin'] : '';

    //get privilege users
    $wps_privilege_users = $this->get_privilege_users();

    $this->wps_menu_user_avatar();

    //remove wp version
    add_filter( 'update_footer', array($this, 'wpsremoveVersion'), 99);


    //prevent access to APPSAZADMIN menu for non-superadmin
    if( (!current_user_can('manage_network')) && defined('NETWORK_ADMIN_CONTROL') ){
      if(isset($screen->id)) {
    		if($screen->id == "toplevel_page_wpappsazadmin_options" || $screen->id == "wpappsazadmin_options_page_wps_admin_menuorder" || $screen->id == "wpappsazadmin_options_page_wps_impexp_settings") {
    		    wp_die("<div style='width:70%; margin: 30px auto; padding:30px; background:#fff'><h4>Sorry, you don't have sufficient previlege to access to this page!</h4></div>");
    		    exit();
    		}
      }
    }

    //to whom screen meta links and admin notices to hide
    if(is_super_admin($current_user_id) && isset($screen_meta_access) && $screen_meta_access == 1){
      return;
    }
    elseif(is_super_admin($current_user_id) && isset($screen_meta_access) && $screen_meta_access == 2 && !empty($wps_privilege_users) && in_array($current_user_id, $wps_privilege_users)) {
      return;
    }

    $screen = get_current_screen();
    $admin_general_options_data = ( !empty($this->aap_options['admin_generaloptions']) ) ? $this->aap_options['admin_generaloptions'] : "";
    $admin_generaloptions = (is_serialized( $admin_general_options_data )) ? unserialize( $admin_general_options_data ) : $admin_general_options_data;
    if(!empty($admin_generaloptions)) {
      foreach($admin_generaloptions as $general_opt) {
        if(isset($screen) && $general_opt == 1) {
                $screen->remove_help_tabs();
        }
        elseif($general_opt == 2) {
                add_filter('screen_options_show_screen', '__return_false');
        }
        elseif($general_opt == 3) {
                remove_action('admin_notices', 'update_nag', 3);
        }
        elseif($general_opt == 4) {
                remove_submenu_page('index.php', 'update-core.php');
        }
      }
    }

	?>

		<?php
	}

  function wps_menu_user_avatar() {

    if( empty($this->aap_options['enable_menu_user_info']) )
      return;

    //get current user data
    $current_user = wp_get_current_user();

    //if no user ID exists return
    if ( ! $current_user->ID )
			return;

    $user_avatar = get_avatar( $current_user->ID, 60 );
    $avatar_img = get_avatar_url($current_user->ID);
    $user_displayname = $current_user->display_name;
    $user_profile = '<a href="'. admin_url( 'profile.php' ) .'"><i class="wps-user"></i></a>';
    $logout_icon = '<a class="wps-menu-logout" href="' . wp_logout_url() .'"><i class="wps-power-switch"></i></a>';
    $user_profile_data = "<div class='wps-user-avatar'>" . $user_avatar . "</div>
    <div class='wps-user-displayname'>" . $user_displayname . "</div>
    <div class='wps-menu-user-actions'>" . $user_profile . $logout_icon . "</div>";
?>
    <script>
    jQuery(document).ready(function($) {
      "use strict";
      $(`<?php echo $user_profile_data; ?>`).insertBefore("#adminmenu");
    });
    </script>
<?php
  }

	public function custom_admin_title($admin_title, $title)
	{
	    return $title . " &#45; " . get_bloginfo('name');
	}

	public function custom_email_addr($email){
		if($this->aap_options['email_settings'] == 1)
			return get_option('admin_email');
		else return $this->aap_options['email_from_addr'];
	}

	public function custom_email_name($name){
		if($this->aap_options['email_settings'] == 1)
			return get_option('blogname');
		else return $this->aap_options['email_from_name'];
	}

	public function wps_sub_menus()
	{
    //Remove APPSAZADMIN menu
    if( defined('HIDE_APPSAZADMIN_OPTION_LINK') || (!current_user_can('manage_network')) && defined('NETWORK_ADMIN_CONTROL') )
	    remove_menu_page('wpappsazadmin_options');
	}

	function removeSubmenuitem($item ='' )
  {
      global $submenu;
      if(!empty($subitems)) {
          foreach ($submenu as $key => &$value) {
              if (is_array($value)) {
                  foreach ($value as $subkey => $subvalue) {
                      if ($subvalue[2] == $item) {
                          unset($submenu[$key][$subkey]);
                      }
                  }
              }
          }
      }
  }

  function initialize_dash_widgets() {
      global $wp_meta_boxes;

      $context = array("normal","side","advanced");
      $priority =array("high","low","default","core");

      $wps_widgets_list = $wp_meta_boxes['dashboard'];
      $wps_get_dash_Widgets = array();
      if (!is_array($wps_widgets_list['normal']['core'])) {
          $wps_widgets_list = array('normal'=>array('core'=>array()), 'side'=>array('core'=>array()),'advanced'=>array('core'=>array()));
      }
      foreach ($context as $context_value)
      {
          foreach ($priority as $priority_value)
          {
              if(isset($wps_widgets_list[$context_value][$priority_value]) && is_array($wps_widgets_list[$context_value][$priority_value]))
              {
                  foreach ($wps_widgets_list[$context_value][$priority_value] as $key=>$data) {
                      $key = $key . "|".$context_value;
                      $widget_title = preg_replace("/Configure/", "", strip_tags($data['title']));
                      $wps_get_dash_Widgets[] = array($key, $widget_title);
                  }
              }
          }
      }

      $this->updateOption('wps_widgets_list', $wps_get_dash_Widgets);

  }

	function customizephpFix($url) {
      if(preg_match('/customize.php?/', $url) && preg_match('/autofocus/', $url)) {
          $url_decode = explode('autofocus[control]=', rawurldecode($url));
          return $url_decode[1];
      }
      elseif(preg_match('/customize.php?/', $url)) {
        return 'customize.php';
      }
      else return $url;
  }

	function login_footer_content()
	{
    $login_footer_content = $this->aap_options['login_footer_content'];
    echo '<div class="login_footer_content">';
    if(!empty($login_footer_content)) {
        echo do_shortcode ($this->aap_options['login_footer_content']);
    }
    echo '</div>';
	}

  function wps_footer_content( $text ) {
    return '<p class="wps-footer-content">' . $this->aap_options['admin_footer_txt'] . '</p>';
  }

	function wpsremoveVersion()
	{
		return '';
	}

  function wps_save_adminbar_nodes() {
    global $wp_admin_bar;
    if ( !is_object( $wp_admin_bar ) )
        return;

    $all_nodes = $wp_admin_bar->get_nodes(); //echo '<pre>'; print_r($all_nodes); echo '</pre>';
    $adminbar_nodes = array();
    foreach( $all_nodes as $node )
    {
      $node_id = (!empty($node->id)) ? strip_tags($node->id) : '';
      if(empty($node_id))
       continue;

      if(!empty($node->parent)) {
        $node_data = strip_tags($node_id) . " <strong>(Parent: " . strip_tags($node->parent) . ")</strong>";
      }
      else {
        $node_data = strip_tags($node_id);
      }
      $adminbar_nodes[$node_id] = $node_data;
    }

    $data = array();
    $saved_data = get_option(WPS_ADMINBAR_LIST_SLUG);
    if($saved_data){
        $data = array_merge($saved_data, $adminbar_nodes);
    }else{
        $data = $adminbar_nodes;
    }

    $this->updateOption(WPS_ADMINBAR_LIST_SLUG, $data);
  }

  /**
  * admin bar customization
  * @since 4.9 admin bar customization method rewritten
  * @return null
  */
	function wps_remove_bar_links()
	{
    global $wp_admin_bar;
    $current_user_id = get_current_user_id();
    $wps_menu_access = $this->aap_options['show_all_menu_to_admin'];
    $wps_privilege_users = $this->get_privilege_users();
if(isset($this->aap_options['hide_admin_bar_menus']) && !empty($this->aap_options['hide_admin_bar_menus'])) {
      foreach ($this->aap_options['hide_admin_bar_menus'] as $hide_bar_menu) {
          if ($hide_bar_menu == 1)
              $wp_admin_bar->remove_menu('site-name');
          elseif ($hide_bar_menu == 2)
              $wp_admin_bar->remove_menu('updates');
          elseif ($hide_bar_menu == 3)
              $wp_admin_bar->remove_menu('comments');
          elseif ($hide_bar_menu == 4)
              $wp_admin_bar->remove_menu('new-content');
          elseif ($hide_bar_menu == 5)
              $wp_admin_bar->remove_menu('edit-profile');
          elseif ($hide_bar_menu == 7)
              $wp_admin_bar->remove_menu('wp-logo');
          elseif ($hide_bar_menu == 8)
              $wp_admin_bar->remove_menu('wpfc-toolbar-parent');
      }
    }
        $wp_admin_bar->remove_menu('wp-logo');

	}

	function add_APPSAZADMIN_menus($wp_admin_bar) {
    $admin_logo_url = (!empty($this->aap_options['adminbar_logo_link'])) ? $this->aap_options['adminbar_logo_link'] : admin_url();

			$wp_admin_bar->add_node( array(
				'id'    => 'APPSAZADMIN_site_title',
				'href'  => $admin_logo_url,
				'meta'  => array( 'class' => 'APPSAZADMIN_site_title' )
			) );

    if(!empty($this->aap_options['collapsed_admin_logo']) || !empty($this->aap_options['collapsed_adminbar_ext_logo_url'])) {
			$wp_admin_bar->add_node( array(
				'id'    => 'APPSAZADMIN_clpsd_site_logo',
				'href'  => $admin_logo_url,
				'meta'  => array( 'class' => 'wps-collapsed-logo' )
			) );
		}
	}

	function add_APPSAZADMIN_nav_menus($wp_admin_bar)
	{
		//add Nav items to adminbar
		if( ( $locations = get_nav_menu_locations() ) && isset( $locations[ 'APPSAZADMIN_adminbar_menu' ] ) ) {

			$custom_nav_object = wp_get_nav_menu_object( $locations[ 'APPSAZADMIN_adminbar_menu' ] );
			if(!isset($custom_nav_object->term_id))
				return;
			$menu_items = wp_get_nav_menu_items( $custom_nav_object->term_id );

			foreach( (array) $menu_items as $key => $menu_item ) {
				if( $menu_item->classes ) {
					$classes = implode( ' ', $menu_item->classes );
				} else {
					$classes = "";
				}
				$meta = array(
					'class' 	=> $classes,
					'target' 	=> $menu_item->target,
					'title' 	=> $menu_item->attr_title
				);
				if( $menu_item->menu_item_parent ) {
					$wp_admin_bar->add_node(
						array(
						'parent' 	=> $menu_item->menu_item_parent,
						'id' 		=> $menu_item->ID,
						'title' 	=> $menu_item->title,
						'href' 		=> $menu_item->url,
						'meta' 		=> $meta
						)
					);
				} else {
					$wp_admin_bar->add_node(
						array(
						'id' 		=> $menu_item->ID,
						'title' 	=> $menu_item->title,
						'href' 		=> $menu_item->url,
						'meta' 		=> $meta
						)
					);
				}
			} //foreach
		}
	}

	public function update_avatar_size( $wp_admin_bar ) {

		//update avatar size
		$current_user = wp_get_current_user();
		if ( ! $current_user->ID )
			return;
		$avatar = get_avatar( $current_user->ID, 36 );
    $welcome_text = (!empty($this->aap_options['adminbar_custom_welcome_text'])) ? $this->aap_options['adminbar_custom_welcome_text'] . ", " . $current_user->display_name :
    sprintf( __('Howdy, %1$s'), $current_user->display_name );
		$account_node = $wp_admin_bar->get_node( 'my-account' );
		$title = $welcome_text . $avatar;
		$wp_admin_bar->add_node( array(
			'id' => 'my-account',
			'title' => $title
			) );

	}

  /**
  * check whether the user has custom menu
  * @since 6.1.3
  */
  function is_user_has_custom_menu( $menu_data = false ) {

    if( ! is_plugin_active( 'wpspowerbox/wpspowerbox.php' ) ) {
    	return false;
    }

    global $wpdb;
    $current_user_role = $this->wps_get_user_role();
    $current_user_id = get_current_user_id();

    $wps_privilege_users = (!empty($this->aap_options['privilege_users'])) ? $this->aap_options['privilege_users'] : array();

    if( !empty( $wps_privilege_users ) && in_array( $current_user_id, $wps_privilege_users ) )
      return false;

    //get menu data
    $wps_menu_data = '';
    $wps_menu_data = $wpdb->get_row( "SELECT menu_data FROM " . POWERBOX_MENU_TABLE . " WHERE menu_role_id='" . $current_user_id . "'" );
    if ( empty( $wps_menu_data )) {
      $wps_menu_data = $wpdb->get_row( "SELECT menu_data FROM " . POWERBOX_MENU_TABLE . " WHERE menu_role_id='" . $current_user_role . "'" );
    }

    if ( !empty( $wps_menu_data ) && $menu_data == true )
      return $wps_menu_data;
    elseif ( !empty( $wps_menu_data ) )
      return true;
    else return false;

  }

	function get_wps_option($option_id) {
    //$getoptions = unserialize(get_option( 'wpappsazadmin_options' ));
   // return $getoptions[$option_id];
    //return $this->APPSAZADMINOptions->getOption( $option_id );
	}

	public function get_wps_option_data( $option_id ) {
    if($this->is_wps_single()) {
        $get_wps_option_data = (is_serialized(get_option($option_id))) ? unserialize(get_option($option_id)) : get_option($option_id);
     }
    else {
        $get_wps_option_data = (is_serialized(get_site_option($option_id))) ? unserialize(get_site_option($option_id)) : get_site_option($option_id);
    }
    return $get_wps_option_data;
	}

	function get_wps_image_url($imgid, $size='full') {
    global $switched, $wpdb;

    if ( is_numeric( $imgid ) ) {
  		if(!$this->is_wps_single()) {
          switch_to_blog(1);
          $imageAttachment = wp_get_attachment_image_src( $imgid, $size );
          restore_current_blog();
      }
      else $imageAttachment = wp_get_attachment_image_src( $imgid, $size );
  		return $imageAttachment[0];
    }
	}

  function wps_get_user_role() {
      global $current_user;
      $get_user_roles = $current_user->roles;
      $get_user_role = array_shift($get_user_roles);
      return $get_user_role;
  }

  function wps_get_wproles() {
      global $wp_roles;
      if ( ! isset( $wp_roles ) ) {
          $wp_roles = new WP_Roles();
      }
      return $wp_roles->get_names();
  }

  function wps_array_merge()
  {
      $output = array();
      foreach(func_get_args() as $array) {
          foreach($array as $key => $value) {
              $output[$key] = isset($output[$key]) ?
                  array_merge($output[$key], $value) : $value;
          }
      }
      return $output;
  }

  //fn to save options
  public function updateOption($option='', $data) {
      if(empty($option)) {
        $option = APPSAZ_ADMIN_OPTIONS_PANEL;
      }
      if(isset($data) && !empty($data)) {
        if($this->is_wps_single())
          update_option($option, $data);
        else
          update_site_option($option, $data);
      }
  }

	function APPSAZADMIN_login_url()
	{
		$login_logo_url = $this->aap_options['login_logo_url'];
		if(empty($login_logo_url))
			return site_url();
		else return $login_logo_url;
	}

	function APPSAZADMIN_login_title()
	{
		return get_bloginfo('name');
	}

  function wps_clean_slug($slug) {
      $clean_slug = trim(preg_replace("/[^a-zA-Z0-9]+/", "", $slug));
      return $clean_slug;
  }

  function clean_title($title) {
    $clean_title = trim(preg_replace('/[0-9]+/', '', $title));
    return $clean_title;
  }

  function wps_get_file_url_ext($url) {
      $ext = parse_url($url, PHP_URL_PATH);
      if (strpos($ext,'.') !== false) {
          $basename = explode('.', basename($ext));
          return $basename[1];
      }
  }

  function wps_get_domain_name($url) {
      $parse_url = parse_url($url);
      $hostname = explode('.', $parse_url['host']);
      return $hostname;
  }

  public function wps_get_icons(){
    //new method with fa icons php array written instead of using wp_remote_get method
  	$pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
  	$file_contents = wp_remote_get( WPADMINPANEL_DIR_URI . 'assets/font-awesome/css/font-awesome.css' );

    if(is_wp_error($file_contents))
        return;
    if ( 200 == wp_remote_retrieve_response_code( $file_contents ) ) {
            $icon_contents = $file_contents['body'];
    }

  	$icons = array();
  	if(!empty($icon_contents)) {
        preg_match_all($pattern, $icon_contents, $matches, PREG_SET_ORDER);
        foreach($matches as $match){
                $icons[$match[1]] = $match[2];
        }
    }
    return $icons;
  }

    function wps_get_icon_class($iconData) {
        if(!empty($iconData)) {
            $icon_class = explode('|', $iconData);
            if(isset($icon_class[0]) && isset($icon_class[1])) {
                return $icon_class[0] . ' ' . $icon_class[1];
            }
        }
    }


    function get_privilege_users() {
      //return WPS privilege users
      $wps_privilege_users = (!empty($this->aap_options['privilege_users'])) ? $this->aap_options['privilege_users'] : array();
      return $wps_privilege_users;
    }




  }

}

$APPSAZADMIN = new APPSAZADMIN();
