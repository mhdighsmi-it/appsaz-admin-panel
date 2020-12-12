<?php

/*
 * AAPFramework
 * @author   AcmeeDesign
 * @url     http://acmeedesign.com
*/

defined('ABSPATH') || die;

if (!class_exists('AAPFramework')) {

    class AAPFramework {
        public $config;
        protected $options_slug;
        private $wps_purchase_data = 'wps_purchase_data';
        public $page_title;
        public $fields_array;
        public $do_not_save;

        function __construct() {
            $this->config = wpaap_config();
            $this->do_not_save = array('title', 'openTab', 'import', 'export', 'fieldsetwrapstart', 'fieldsetwrapclose');

            add_action('aap_after_setup_theme', array($this, 'aofLoaddefault' ));
            add_action('aap_tab_start', array($this, 'formwrapStart'));
            add_action('aap_tab_start', array($this, 'saveBtn'));
            add_action('aap_tab_close', array($this, 'formwrapEnd'));
            add_action('aap_tab_close', array($this, 'saveBtn'));
            add_action('aap_before_heading', array($this, 'adminNotices'));
        }

        /**
        * Function to generate form fields
        */
        function generateFields($fields_array) {
            //build form
            echo '<div class="aof-wrap clearfix">';
            do_action('aof_before_form');
            do_action('aap_the_form');
            $this->fieldLoop($fields_array);
            do_action('aof_after_form');

            echo '</div>'; //close div wrap
        }

        public function fieldLoop($config) {

            //get options data
            $getoption = $this->aapgetOptions( APPSAZ_ADMIN_OPTIONS_PANEL );

            echo '<div class="loading_form_text">' . __('Loading...', 'appsaz-admin') . '</div>';

            do_action('aap_tab_start');

            $fields_array['tabs'] = $config['wps_fields']['wps_tabs'];
            $fields_array['fields'] = $config['wps_fields']['wps_fields'];
            echo '<div id="app_options_tab" class="clearfix">
            <ul class="aof-tabs-list hor_1">';
            if(is_array($fields_array['tabs']) && !empty($fields_array['tabs'])) {
                foreach($fields_array['tabs'] as $tabkey =>$tabvalue) {
                    echo '<li class="' . $tabkey . '">' . $tabvalue . '</li>';
                }
            }
            echo '</ul>
            <div class="aof-tabs-container hor_1">';

            foreach($fields_array['fields'] as $field_key => $field_array) {
                if(isset($field_array['id']) && !empty($field_array['id'])) {
                    unset($field_meta);
                    $field_meta = array();
                    $field_meta['meta'] = (!empty($getoption[$field_array['id']])) ? $getoption[$field_array['id']] : "";
                    $field_array = array_merge($field_array, $field_meta);
                }
                switch ($field_array['type']) {
                    case 'openTab' :
                        $tab_first = ($field_key == 0) ? true : false;
                        $this->openTab($field_array, $tab_first);
                        break;
                    case 'title' :
                        $this->addTitle($field_array);
                        break;
                    case 'note':
                        $this->addNote($field_array);
                        break;
                    case 'text':
                        $this->addText($field_array);
                        break;
                    case 'textarea':
                        $this->addTextarea($field_array);
                        break;
                    case 'checkbox':
                        $this->addCheckbox($field_array);
                        break;
                    case 'multicheck':
                        $this->addMultiCheckbox($field_array);
                        break;
                    case 'radio':
                        $this->addradio($field_array);
                        break;
                    case 'select':
                        $this->addSelect($field_array);
                        break;
                    case 'imgselect':
                        $this->addimgSelect($field_array);
                        break;
                    case 'number':
                        $this->addNumber($field_array);
                        break;
                    case 'typography':
                        $this->addTypography($field_array);
                        break;
                    case 'wpcolor':
                        $this->addwpColor($field_array);
                        break;
                    case 'upload':
                        $this->addUpload($field_array);
                        break;
                    case 'wpeditor':
                        $this->addwpEditor($field_array);
                        break;
                    case 'export':
                        $this->addExport($field_array);
                        break;
                    case 'import':
                        $this->addImport($field_array);
                        break;
                    case 'fieldsetwrapstart':
                        $this->addfieldsetWrapStart($field_array);
                        break;
                    case 'fieldsetwrapclose':
                        $this->addfieldsetWrapclose($field_array);
                        break;
                    case 'aoficon':
                        $this->addIcon($field_array);
                        break;
                        }



            } // foreach


            echo '</div>
        </div>'; //close div app_options_tab

            do_action('aap_tab_close');

        }

        function SaveSettings($post) {
            if(isset($post['action']) && $post['action'] == 'license_data') {
                $purchase_code = trim($post['purchase_code']);
                $validate = EnvatoApi2::verifyPurchase( $purchase_code );
                if ( is_object($validate) ) {
                    $buyer = $validate->buyer;
                    $item_id = $validate->item_id;
                    $license_type = $validate->licence;
                    $code = explode('-', $purchase_code);
                    $purchase_data = array($buyer, $item_id, $license_type, $code);
                    update_option( $this->wps_purchase_data, $purchase_data );
                    wp_safe_redirect( admin_url( 'admin.php?page=' . WPADMINPANEL_MENU_SLUG . '&status=license_success' ) );
                    exit();
                }
                else {
                    wp_safe_redirect( admin_url( 'admin.php?page=' . WPADMINPANEL_MENU_SLUG . '&status=license_fail' ) );
                    exit();
                }

            }
             if(isset($post) && isset($post['aap_options_save'])) {

                if ( isset($post['aap_options_nonce']) && !wp_verify_nonce($post['aap_options_nonce'], 'aap_options_form') )
	               return;

                    if( isset($post['aof_import_settings']) && !empty($post['aof_import_settings']) ) {
                        $settings = $post['aof_import_settings'];
                        if(!empty($settings) && is_serialized($settings)) {
                            $settings = unserialize($settings);
                            update_option( APPSAZ_ADMIN_OPTIONS_PANEL, $settings );
                            wp_safe_redirect( admin_url( 'admin.php?page=' . WPADMINPANEL_MENU_SLUG . '&status=success' ) );
                            exit();
                        }
                    }
                    else {
                      $save_data = array();
                      $config = wpaap_config();
                      $fields_array['fields'] = $config['wps_fields']['wps_fields'];
                      if( is_array($fields_array['fields']) && !empty($fields_array['fields']) ) {
                        //loop through the fields array and initialize $save_data variable
                        foreach($fields_array['fields'] as $field) {
                          if(isset($field['id']) && !in_array($field['type'], $this->do_not_save)) {
                              $post_name = $field['id'];
                              $post_value = (!empty($post[$post_name])) ? $post[$post_name] : "";
                              if($field['type'] == "multicheck") {
                                  $multicheck = array();
                                  if(is_array($post_value)) {
                                      foreach($post_value as $options) {
                                          $multicheck[] = $options;
                                      }
                                  }
                                  $save_data[$field['id']] = $multicheck;
                              }
                              elseif($field['type'] == "typography") {
                                  $typography = array();
                                  if(is_array($post_value)) {
                                      foreach($post_value as $typo_name => $typo_value) {
                                          $typography[$typo_name] = $typo_value;
                                      }
                                      $save_data[$field['id']] = $typography;
                                  }
                              }
                              else {
                                  $save_data[$field['id']] = (isset($post_value)) ? $this->validateInputs($post_value) : "";
                              }
                            }
                          }
                        }

                        $saved = $this->aapssaveOptions($save_data);
                        if($saved) {
                            wp_safe_redirect( admin_url( 'admin.php?page=' . WPADMINPANEL_MENU_SLUG . '&status=updated' ) );
                            exit();
                        }
                        else {
                            wp_safe_redirect( admin_url( 'admin.php?page=' . WPADMINPANEL_MENU_SLUG . '&status=error' ) );
                            exit();
                        }

                    }


            }//app options save
        }

        function aapgetOptions($option_id) {

                if(is_serialized(get_option( $option_id ))) {
                    $get_options = unserialize(get_option( $option_id ));
                }
                else {
                    $get_options = get_option( $option_id );
                }
            return $get_options;
        }

        function aapssaveOptions($save_options) {
            //get options data
            $getoption = $this->aapgetOptions( APPSAZ_ADMIN_OPTIONS_PANEL );

            if($getoption)
                $data = array_merge($getoption, $save_options);
            else
                $data = $save_options;

            if($this->config['multi'] === true) {
                update_site_option( APPSAZ_ADMIN_OPTIONS_PANEL, $data );
                return true;
            }
            else {
                update_option( APPSAZ_ADMIN_OPTIONS_PANEL, $data );
                return true;
            }
        }

        function openTab($fields, $tab_first) {
            if($tab_first) {
                $output = '<div>';
                if(!empty($fields['name'])) $output .= '<h2 class="aof-fieldset-title">' . $fields['name'] . '</h2>';
            }
            else {
                $output = '</div><div>';
                if(!empty($fields['name'])) $output .= '<h2 class="aof-fieldset-title">' . $fields['name'] . '</h2>';
            }
            echo $output;
        }

        function addfieldsetWrapStart($fields) {
          echo '<div class="aof-fieldset-wrap" id="' . $fields['id'] . '">';
        }

        function addfieldsetWrapclose($fields) {
          echo '</div>';
        }

        function addTitle($fields) {
            echo '<h3 class="aof-fieldset-title">' . $fields['name'] . '</h3>';
            if(!empty($fields['desc']))
              echo '<p class="aof-title-desc">' . $fields['desc'] . '</p>';
        }

        function addNote($fields) {
            $output = '<p class="aof-description">' . $fields['desc'] . '</p>';
            echo $output;
        }

        function addText($fields) {
            $meta = (isset($fields['meta'])) ? $fields['meta'] : "";
            $form_field = '<input id="' . $fields['id'] . '" class="regular-text ' . $fields['id'] . '" type="text" name="' . $fields['id'] . '" value="' . $meta . '"  />';
            $output = $this->fieldWrap($fields, $form_field);
            echo $output;
        }

        function addTextarea($fields) {
            $meta = (isset($fields['meta'])) ? $fields['meta'] : "";
            $form_field = '<textarea id="' . $fields['id'] . '" class="regular-text ' . $fields['id'] . '" name="' . $fields['id'] . '" rows="10">' . $meta . '</textarea>';
            $output = $this->fieldWrap($fields, $form_field);
            echo $output;
        }

        //single checkbox
        function addCheckbox($fields) {
            $meta = (isset($fields['meta'])) ? $fields['meta'] : "";
            $form_field = '<label for="' . $fields['id'] . '"><input id="' . $fields['id'] . '" class="' . $fields['id'] . '" type="checkbox" name="' . $fields['id'] . '" value="1"';
            $form_field .= ($meta == 1) ? ' checked="checked"' : '';
            $form_field .= '/></label>';
            $output = $this->fieldWrap($fields, $form_field);
            echo $output;
        }

        //multi checkboxes
        function addMultiCheckbox($fields) {
            $meta = (isset($fields['meta'])) ? $fields['meta'] : "";
            if(isset($fields['options'])) {
                $form_field = "";
                foreach($fields['options'] as $field_key => $field_value) {
                    $form_field .= '<label for="' . $fields['id'] . '"><input class="' . $fields['id'] . '" type="checkbox" name="' . $fields['id'] . '[]" value="' . $field_key . '"  ';
                    if(is_array($meta) && in_array($field_key, $meta)) {
                        $form_field .= 'checked="checked"';
                    }
                    $form_field .= '/>';
                    $form_field .= $field_value .  '</label>';
                }
                $output = $this->fieldWrap($fields, $form_field);
                echo $output;
            }
        }

        function addradio($fields) {
            $meta = (isset($fields['meta'])) ? $fields['meta'] : "";
            if(isset($fields['options'])) {
                $form_field = "";
                foreach($fields['options'] as $field_key => $field_value) {
                    $form_field .= '<label for="' . $fields['id'] . '"><input class="' . $fields['id'] . '" type="radio" name="' . $fields['id'] . '" value="' . $field_key . '" ';
                    $form_field .= ($meta == $field_key) ? 'checked="checked"' : '';
                    $form_field .= '/>';
                    $form_field .= $field_value .  '</label>';
                }
            }
            $output = $this->fieldWrap($fields, $form_field);
            echo $output;
        }

        function addSelect($fields) {
            $meta = (isset($fields['meta'])) ? $fields['meta'] : "";
            if(isset($fields['options'])) {
                $form_field = '<label for="' . $fields['id'] . '"><select id="' . $fields['id'] . '" class="' . $fields['id'] . '" name="' . $fields['id'] . '">';
                foreach($fields['options'] as $field_key => $field_value) {
                    $form_field .= '<option value="' . $field_key . '"';
                    $form_field .= ($meta == $field_key) ? ' selected="selected"' : '';
                    $form_field .= '>' . $field_value .  '</option>';
                }
                $form_field .= '</select></label>';
            }
            $output = $this->fieldWrap($fields, $form_field);
            echo $output;
        }

        function addimgSelect($fields) {
            $meta = (isset($fields['meta'])) ? $fields['meta'] : "";
            if(isset($fields['options'])) {
                $form_field = '<label for="' . $fields['id'] . '"></label><select id="' . $fields['id'] . '" class="aof-image-select ' . $fields['id'] . '" name="' . $fields['id'] . '">';
                foreach($fields['options'] as $field_key => $field_value) {
                    $form_field .= '<option data-img-src="' . $field_value[1] . '" value="' . $field_key . '"';
                    $form_field .= ($meta == $field_key) ? ' selected="selected"' : '';
                    $form_field .= '>' . $field_value[0] .  '</option>';
                }
                $form_field .= '</select>';
            }
            $output = $this->fieldWrap($fields, $form_field);
            echo $output;
        }

        function addNumber($fields) {
            $default = array(
                'default' => '1',
                'min' => '0',
                'max' => '50',
                'step' => '1',
                );
            if(isset($fields['meta']) && !empty($fields['meta'])) {
                $meta = $fields['meta'];
            }
            else if($fields['default']) {
                $meta = $fields['default'];
            }
            else {
                $meta = "";
            }
            $fields = array_merge($default, $fields);
            $form_field = '<div id="aof-number-' . $fields['id'] . '" class="aof-number-slider"></div>';
            $form_field .= '<input id="' . $fields['id'] . '" class="aof-number small-text ' . $fields['id'] . '" name="' . $fields['id'] . '" type="number" value="' . $meta . '" min="' . $fields['min'] . '" max="' . $fields['max'] . '" step="' . $fields['step'] . '">';
            $output = $this->fieldWrap($fields, $form_field);
            echo $output;
        }

        function addTypography($fields) {
            $meta = (isset($fields['meta'])) ? $fields['meta'] : "";
            $font_type = isset($meta['font-type']) ? $meta['font-type'] : "";
            $color = isset($meta['color']) ? $meta['color'] : "";
            $gfonts = new AOFgfonts();
            $gfonts_lists = $gfonts->get_gfonts();
            $safe_fonts = array('Arial' => 'Arial, Helvetica, sans-serif', 'Arial Black' => '&quot;Arial Black&quot;, Gadget, sans-serif', 'Comic Sans' => '&quot;Comic Sans MS&quot;, cursive, sans-serif', 'Courier New' => '&quot;Courier New&quot;, Courier, monospace', 'Georgia' => 'Georgia, serif', 'Lucida Sans Unicode' => '&quot;Lucida Sans Unicode&quot;, &quot;Lucida Grande&quot;, sans-serif');
            $font_weights = array( 'normal', 'lighter', 'bold', 'bolder', '100', '200', '300', '400', '500', '600', '700', '800', '900' );
            $font_styles = array('normal', 'italic');

            //print_r($gfonts_lists);
            $form_field = '<div class="aof_typography">';
            if(isset($fields['show_font_family']) && $fields['show_font_family'] !== false) {
                $form_field .='<label>' . __( 'Font Family', 'aof' ) . '<select class="aof_font_family" name="' . $fields['id'] . '[font-family]">';
                $form_field .='<optgroup label="Web Safe Fonts" class="safe">';
                foreach ($safe_fonts as $sfontname => $sfontvalue) {
                    $selected = ( htmlentities($meta['font-family']) == $sfontvalue ) ? " selected=selected" : "";
                    $form_field .='<option value="' . $sfontvalue . '"' . $selected . '>' . $sfontname . '</option>';
                }
                //<option value="Arial, Helvetica, sans-serif">Arial</option><option value="&quot;Arial Black&quot;, Gadget, sans-serif">Arial Black</option><option value="&quot;Comic Sans MS&quot;, cursive, sans-serif">Comic Sans</option><option value="&quot;Courier New&quot;, Courier, monospace">Courier New</option><option value="Georgia, serif">Geogia</option><option value="Impact, Charcoal, sans-serif">Impact</option><option value="&quot;Lucida Console&quot;, Monaco, monospace">Lucida Console</option><option value="&quot;Lucida Sans Unicode&quot;, &quot;Lucida Grande&quot;, sans-serif">Lucida Sans</option><option value="&quot;Palatino Linotype&quot;, &quot;Book Antiqua&quot;, Palatino, serif">Palatino</option><option value="Tahoma, Geneva, sans-serif">Tahoma</option><option value="&quot;Times New Roman&quot;, Times, serif">Times New Roman</option><option value="&quot;Trebuchet MS&quot;, Helvetica, sans-serif">Trebuchet</option><option value="Verdana, Geneva, sans-serif">Verdana</option></optgroup>';
                $form_field .='<optgroup label="Google WebFonts" class="google">';
                foreach ($gfonts_lists as $fontname => $fontvalue) {
                    $selected = ( $meta['font-family'] == $fontvalue['name'] ) ? " selected=selected" : "";
                    $form_field .='<option value="' . $fontvalue['name'] . '"' . $selected . '>' . $fontvalue['name'] . '</option>';
                }
                $form_field .='</optgroup>';
                $form_field .='</select><input type="hidden" class="aof-font-type" name="' . $fields['id'] . '[font-type]" value="' . $font_type . '" /></label>';
            }

            if(isset($fields['show_color']) && $fields['show_color'] !== false) {
                //wpcolor
                $form_field .= __( 'Color', 'appsaz-admin' ) . '<label><input class="aof-wpcolor ' . $fields['id'] . '" type="text" name="' . $fields['id'] . '[color]" value="' . $color . '"  /></label>';
            }

            if(isset($fields['show_font_weight']) && $fields['show_font_weight'] !== false) {
                //font weight
                $form_field .= __( 'Font Weight', 'appsaz-admin' ) . '<label><select class="aof_font_weight" name="' . $fields['id'] . '[font-weight]">';
                foreach ($font_weights as $font_weight) {
                    $selected = ( $meta['font-weight'] == $font_weight ) ? " selected=selected" : "";
                    $form_field .='<option value="' . $font_weight . '"' . $selected . '>' . $font_weight . '</option>';
                }
                $form_field .='</select></label>';
            }

            if(isset($fields['show_font_style']) && $fields['show_font_style'] !== false) {
                //font style
                $form_field .= __( 'Font Style', 'appsaz-admin' ) . '<label><select class="aof_font_style" name="' . $fields['id'] . '[font-style]">';
                foreach ($font_styles as $font_style) {
                    $selected = ( $meta['font-style'] == $font_style ) ? " selected=selected" : "";
                    $form_field .='<option value="' . $font_style . '"' . $selected .'>' . $font_style . '</option>';
                }
                $form_field .='</select></label>';
            }

            if(isset($fields['show_font_size']) && $fields['show_font_size'] !== false) {
                //font size
                $form_field .= __( 'Font Size', 'appsaz-admin' ) . '<label><select class="aof_font_size" name="' . $fields['id'] . '[font-size]">';
                for($i = 9; $i <= 65; $i++) {
                    $selected = ( $meta['font-size'] == $i ) ? " selected=selected" : "";
                    $form_field .='<option value="' . $i . '"' . $selected . '>' . $i . 'px</option>';
                }
                $form_field .='</select></label>';
            }
            $form_field .='</div>';
            $output = $this->fieldWrap($fields, $form_field);
            echo $output;
        }

        function addwpColor($fields) {
            $meta = (isset($fields['meta'])) ? $fields['meta'] : "";
            $form_field = '<input id="' . $fields['id'] . '" class="aof-wpcolor ' . $fields['id'] . '" type="text" name="' . $fields['id'] . '" value="' . $meta . '"  />';
            $output = $this->fieldWrap($fields, $form_field);
            echo $output;
        }

        function addwpEditor($fields) {
            $meta = (isset($fields['meta'])) ? $fields['meta'] : "";
            echo '<div class="field_wrap">';
            echo '<div class="label"><label for="' . $fields['id'] . '">' . $fields['name'] . '</label></div>';
            echo '<div class="field_content">';
            $settings = array('textarea_name' => $fields['id'], 'textarea_rows' => 10, 'editor_height' => 100);
            wp_editor(stripslashes(stripslashes(html_entity_decode($meta))), $fields['id'], $settings);
            if(isset($fields['desc']) && !empty($fields['desc'])) {
                echo '<div class="field_desc">' . $fields['desc'] . '</div>';
            }
            echo '</div></div>';

        }

        function addUpload($fields) {
            $meta = (isset($fields['meta'])) ? $fields['meta'] : "";
            $attachment_url = (is_numeric($meta)) ? $this->getAttachmenturl($meta) : $meta;
            $form_field = '
                <div id ="' . $fields['id'] . '" class="thumbnail aof-image-preview">';
            if((!empty($meta))) {
                $form_field .=  '<i class="dashicons dashicons-no-alt img-remove"></i>';
                $form_field .=  '<image class="imgpreview_' . $fields['id'] .'" src="' . $attachment_url . '" />';
            }
            $form_field .= '<input class="aof_image_url" name="' . $fields['id'] . '" type="hidden" value="' . $attachment_url . '" /></div>';
            $output = $this->fieldWrap($fields, $form_field);
            echo $output;
        }

        function addExport($fields) {
            $getoption = $this->aapgetOptions( APPSAZ_ADMIN_OPTIONS_PANEL );
            if(is_serialized($getoption) === false && is_array($getoption)) {
                $meta = serialize($getoption);
            }
            elseif(is_serialized($getoption)) {
                $meta = $getoption;
            }
            else {
                $meta = "";
            }
            $export_options = array();
            $export_options['name'] = $fields['name'];
            $export_options['id'] = $fields['id'];
            $export_options['meta'] = $meta;
            $this->addTextarea($export_options);
        }

        function addImport($fields) {
            $import_options = array();
            $import_options['name'] = $fields['name'];
            $import_options['id'] = "aof_import_settings";
            $this->addTextarea($import_options);
        }

        function saveBtn() {
          ?>
            <div class="save_options">
              <input type="submit" value="<?php _e('Save Changes', 'appsaz-admin'); ?>" class="aof_save_button" />
            </div>
          <?php
        }

        function addIcon($fields) {
            $meta = (isset($fields['meta'])) ? $fields['meta'] : "";
            $aof_icon_class = "";
            if(!empty($meta)) {
              $aof_icon_class_data = explode('|', $meta);
              $aof_icon_class = implode(" ", $aof_icon_class_data);
            }

            $form_field = '<div class="menu_icon">
                <label for="icon_picker"><em>'. __('Choose Icon', 'appsaz-admin') . '</em></label>
                <div id="" data-target="#menu-icon-for-' . $fields['id'] . '" class="icon-picker '. $aof_icon_class .'"></div>
                <input type="hidden" id="menu-icon-for-' . $fields['id'] . '" name="' . $fields['id'] . '" value="' . $meta . '" />
            </div>';
            $output = $this->fieldWrap($fields, $form_field);
            echo $output;
        }

        function fieldWrap($args, $field) {
            if(isset($args['id']) && !empty($args['id'])) {
                $label = $args['id'];
            }
            else {
                $label = $this->createSlug($args['name']);
            }
            $output = '<div class="field_wrap ' . $args['id'] . '">';
            $output .= '<div class="label"><label for="' . $label . '">' . $args['name'] . '</label></div>';
            $output .= '<div class="field_content">';
            $output .= $field;
            if(isset($args['desc']) && !empty($args['desc'])) {
                $output .= '<div class="field_desc">' . $args['desc'] . '</div>';
            }
            $output .= '</div></div>';
            return $output;
        }

        function formwrapStart() {
            echo '<form method="post" name="aap_options_framework" class="aap_options_framework clearfix" id="aap_options_framework" action="" enctype="multipart/form-data">';
        }

        function formwrapEnd() {
            echo '<input type="hidden" name="aap_options_save" value="saveoptions" />';
            wp_nonce_field( 'aap_options_form', 'aap_options_nonce' );
            echo '</form>';
        }

        function validateInputs($data, $type = NULL) {
            if($type == "text") {
               $output = sanitize_text_field( $data );
            }
            elseif($type == "textarea") {
                $output = esc_textarea( $data );
            }
            else {
                $output = stripslashes( trim($data) );
            }
            return $output;
        }

        function createSlug($arg) {
            $slug = trim(strtolower($arg));
            $slug = str_replace(' ', '_', $slug);
            $slug = preg_replace('/[^a-zA-Z0-9]/', '_', $slug);
            return $slug;
        }

        function getAttachmenturl($attc_id, $size='full') {
            global $switched, $wpdb;
            $imageAttachment = "";
            if ( is_numeric( $attc_id ) ) {
                if($this->config['multi'] === true) {
                    switch_to_blog(1);
                    $imageAttachment = wp_get_attachment_image_src( $attc_id, $size );
                    restore_current_blog();
                }
                else $imageAttachment = wp_get_attachment_image_src( $attc_id, $size );
                return $imageAttachment[0];
            }
        }

        /**
        * Function to get default options
        */
       function getDefaultOptions() {
         $fields_array = $this->config['wps_fields']['wps_fields'];
         if( is_array($fields_array) && !empty($fields_array) ) {
           foreach($fields_array as $field) {
              if(isset($field['id']) && !in_array($field['type'], $this->do_not_save)) {
                  $default_value = ( isset($field['default']) && !empty($field['default']) ) ? $field['default'] : "";
                  if($field['type'] == "multicheck") {
                      $multicheck = array();
                      if(is_array($default_value)) {
                          foreach($default_value as $options) {
                              $multicheck[] = $options;
                          }
                          $save_data[$field['id']] = $multicheck;
                      }
                    }
                    elseif($field['type'] == "typography") {
                      $typography = array();
                      if(is_array($default_value)) {
                          foreach($default_value as $typo_name => $typo_value) {
                              $typography[$typo_name] = $typo_value;
                          }
                          $save_data[$field['id']] = $typography;
                      }
                    }
                    else {
                      $save_data[$field['id']] = $default_value;
                    }
              }
           }
           return $save_data;
         }
         else return false;
       }

        /**
        * Function to insert default values
        */
        function aofLoaddefault($reset=false) {
            $default_options = $this->aapgetOptions( APPSAZ_ADMIN_OPTIONS_PANEL );
            if ( false === $default_options || empty($default_options) || true === $reset ) {
                $default_options = $this->getDefaultOptions();
                if(!empty($default_options)) {
                    if($this->config['multi'] === true) {
                        update_site_option( APPSAZ_ADMIN_OPTIONS_PANEL, $default_options );
                    }
                    else {
                        update_option( APPSAZ_ADMIN_OPTIONS_PANEL, $default_options );
                    }
                }
            }

        }

        /**
        * Function to show notices for plugin actions
        */
        function adminNotices() {
            if( isset($_GET['status']) && $_GET['status'] == "updated") {
                $message = __( 'Settings saved.', 'aof');
                echo "<div class='updated'><p>{$message}</p></div>";
            }
            if( isset($_GET['status']) && $_GET['status'] == "error") {
                $message = __( 'Error: Settings not saved.', 'aof');
                echo "<div class='error'><p>{$message}</p></div>";
            }
        }


    }
}
