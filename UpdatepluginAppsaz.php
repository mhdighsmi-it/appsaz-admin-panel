<?php
if(!class_exists('UpdatepluginAppsaz')) {
    class UpdatepluginAppsaz
    {
        private $link_json;
        private $base_name;
        private $slug;
        private $old_version;

        function __construct($link_json, $base_name,$path, $slug)
        {
            if ( is_admin() ) {
                if( ! function_exists('get_plugin_data') ){
                    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                    }
                $plugin_data = get_plugin_data( $path );
                $this->old_version=$plugin_data['Version'];
            }
            $this->link_json = $link_json;
            $this->base_name = $base_name;
            $this->slug = $slug;
            add_filter('plugins_api', array($this, 'mhdi_plugin_info'), 20, 3);
            add_filter('site_transient_update_plugins', array($this, 'mhdi_push_update'));
          // add_filter('transient_update_plugins', array($this, 'mhdi_push_update'));
            add_action('upgrader_process_complete', array($this, 'mhdi_after_update'), 10, 2);
        }
        function mhdi_plugin_info($res, $action, $args)
        {
            if( 'plugin_information' !== $action ) {
                return false;
            }

            $plugin_slug =  $this->slug; // we are going to use it in many places in this function

            if( $plugin_slug !== $args->slug ) {
                return false;
            }
            $remote = wp_remote_get(   $this->link_json, array(
                        'timeout' => 10,
                        'headers' => array(
                            'Accept' => 'application/json'
                        ) )
                );
                if ( ! is_wp_error( $remote ) && isset( $remote['response']['code'] ) && $remote['response']['code'] == 200 && ! empty( $remote['body'] ) ) {
                    set_transient( 'mhdi_update_' . $plugin_slug, $remote, 200 );
                }



            if( ! is_wp_error( $remote ) && isset( $remote['response']['code'] ) && $remote['response']['code'] == 200 && ! empty( $remote['body'] ) ) {

                $remote = json_decode( $remote['body'] );
                $res = new stdClass();

                $res->name = $remote->name;
                $res->slug = $plugin_slug;
                $res->version = $remote->version;
                $res->tested = $remote->tested;
                $res->requires = $remote->requires;
                $res->author =  $remote->author;
                $res->author_profile = $remote->homepage;
                $res->download_link = $remote->download_url;
                $res->trunk = $remote->download_url;
                $res->requires_php = $remote->requires;
                $res->last_updated = $remote->last_updated;
                $res->upgrade_notice = $remote->upgrade_notice;
                $res->sections = array(
                    'description' => $remote->sections->description,
                    'installation' => $remote->sections->installation,
                    'changelog' => $remote->sections->changelog
                );
                if( !empty( $remote->sections->screenshots ) ) {
                    $res->sections['screenshots'] = $remote->sections->screenshots;
                }
                if( !empty( $remote->banners ) ) {
                    $res->banners = array(
                        'low' => $remote->banners->low,
                        'high' => $remote->banners->high
                    );
                }

                $res->rating=$remote->rating;
                $res->num_ratings=$remote->num_ratings;
                return $res;

            }

            return false;

        }

        function mhdi_push_update($transient)
        {

            if ( empty($transient->checked ) ) {
                return $transient;
            }
            // info.json is the file with the actual plugin information on your server
            $remote = wp_remote_get(   $this->link_json, array(
                    'timeout' => 10,
                    'headers' => array(
                        'Accept' => 'application/json'
                    ) )
            );
            if($this->old_version < json_decode($remote['body'])->version) {
                if (!is_wp_error($remote) && isset($remote['response']['code']) && $remote['response']['code'] == 200 && !empty($remote['body'])) {
                    set_transient('mhdi_upgrade_'.$this->slug, $remote, 200); 
                }
                if ($remote) {
                    $remote = json_decode($remote['body']);
                    if ($remote && version_compare('1.0', $remote->version, '<') && version_compare($remote->requires, get_bloginfo('version'), '<')) {
                        $res = new stdClass();
                        $res->slug =  $this->slug;
                        $res->plugin = $this->base_name ; // it could be just YOUR_PLUGIN_SLUG.php if your plugin doesn't have its own directory
                        $res->new_version = $remote->version;
                        $res->tested = $remote->tested;
                        $res->package = $remote->download_url;
                        $transient->response[$res->plugin] = $res;
                        $transient->checked[$res->plugin] = $remote->version;
                    }

                }
            }
            return $transient;
        }

        function mhdi_after_update($upgrader_object, $options)
        {
            if ( $options['action'] == 'update' && $options['type'] === 'plugin' )  {
                // just clean the cache when new plugin version is installed
                delete_transient( 'mhdi_upgrade_'.$this->slug );
                delete_transient( 'mhdi_update_'.$this->slug );
            }
        }
    }
}