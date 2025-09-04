<?php
/*
 * トップページの設定（モバイル用）
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_front_page_mobile_dp_default_options' );


// Add label of front page tab
add_action( 'tcd_tab_labels', 'add_front_page_mobile_tab_label' );


// Add HTML of front page tab
add_action( 'tcd_tab_panel', 'add_front_page_mobile_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_front_page_mobile_theme_options_validate' );


// タブの名前
function add_front_page_mobile_tab_label( $tab_labels ) {
	$tab_labels['front_page_mobile'] = __( 'Front page (smartphone)', 'tcd-w' );
	return $tab_labels;
}


// 初期値
function add_front_page_mobile_dp_default_options( $dp_default_options ) {

	// ヘッダースライダー
	$dp_default_options['mobile_show_index_slider'] = 'type2';

	// ヘッダースライダー
	$dp_default_options['mobile_index_slider_bg_type'] = 'type1';
	$dp_default_options['mobile_index_slider_image'] = false;
	$dp_default_options['mobile_index_slider_use_image_slider'] = '';
	$dp_default_options['mobile_index_video'] = false;
	$dp_default_options['mobile_index_youtube_url'] = '';
	$dp_default_options['mobile_index_movie_image'] = false;
	$dp_default_options['mobile_index_slider_use_overlay'] = '';
	$dp_default_options['mobile_index_slider_overlay_color'] = '#000000';
	$dp_default_options['mobile_index_slider_overlay_opacity'] = '0.3';
	$dp_default_options['mobile_index_slider_time'] = '7000';
	$dp_default_options['mobile_index_slider'] = array();

  // コンテンツビルダー
	$dp_default_options['mobile_show_contents_builder'] = '';
	$dp_default_options['mobile_contents_builder'] = array();

	return $dp_default_options;

}

// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_front_page_mobile_tab_panel( $options ) {

  global $dp_default_options, $item_type_options, $time_options, $font_type_options, $content_direction_options, $content_direction_options2, $slider_animation_options;
  $blog_label = $options['blog_label'] ? esc_html( $options['blog_label'] ) : __( 'Blog', 'tcd-w' );
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-w' );
  $product_label = $options['product_label'] ? esc_html( $options['product_label'] ) : __( 'Product', 'tcd-w' );

?>

<div id="tab-content-front-page-mobile" class="tab-content">

   <?php // ヘッダーコンテンツの設定 ---------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header content setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <ul class="design_radio_button">
      <li id="mobile_show_index_slider_type1_button">
       <input type="radio" id="mobile_show_index_slider_type1" name="dp_options[mobile_show_index_slider]" value="type1" <?php checked( $options['mobile_show_index_slider'], 'type1' ); ?> />
       <label for="mobile_show_index_slider_type1"><?php _e('Display different slider in smartphone', 'tcd-w');  ?></label>
      </li>
      <li id="mobile_show_index_slider_type2_button">
       <input type="radio" id="mobile_show_index_slider_type2" name="dp_options[mobile_show_index_slider]" value="type2" <?php checked( $options['mobile_show_index_slider'], 'type2' ); ?> />
       <label for="mobile_show_index_slider_type2"><?php _e('Display same slider in smartphone', 'tcd-w');  ?></label>
      </li>
      <li id="mobile_show_index_slider_type3_button">
       <input type="radio" id="mobile_show_index_slider_type3" name="dp_options[mobile_show_index_slider]" value="type3" <?php checked( $options['mobile_show_index_slider'], 'type3' ); ?> />
       <label for="mobile_show_index_slider_type3"><?php _e('Don\'t display slider in smartphone', 'tcd-w');  ?></label>
      </li>
     </ul>

     <div id="index_slider_input_area" style="<?php if($options['mobile_show_index_slider'] == 'type1'){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">


     <?php // 背景のタイプ ---------- ?>
     <h4 class="theme_option_headline2"><?php _e('Background type', 'tcd-w');  ?></h4>
     <ul class="design_radio_button">
      <?php foreach ( $item_type_options as $option ) { ?>
      <li>
       <input type="radio" id="mobile_index_slider_background_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[mobile_index_slider_bg_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['mobile_index_slider_bg_type'], $option['value'] ); ?> />
       <label for="mobile_index_slider_background_<?php esc_attr_e( $option['value'] ); ?>"><?php echo $option['label']; ?></label>
      </li>
      <?php } ?>
     </ul>

     <?php // 背景画像 ----------- ?>
     <div id="mobile_index_slider_bg_image" style="<?php if($options['mobile_index_slider_bg_type'] == 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Slider setting', 'tcd-w');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('Please check the checkbox bellow if you want change background image in each content.', 'tcd-w'); ?></p>
      </div>
      <p class="mobile_index_slider_use_image_slider"><label><input name="dp_options[mobile_index_slider_use_image_slider]" type="checkbox" value="1" <?php checked( $options['mobile_index_slider_use_image_slider'], 1 ); ?>><?php _e( 'Change background image in each content', 'tcd-w' ); ?></label></p>
      <div class="mobile_index_slider_bg_image_setting_area" style="<?php if($options['mobile_index_slider_use_image_slider']){ echo 'display:none;'; } else { echo 'display:block;'; }; ?>">
       <h4 class="theme_option_headline2"><?php _e('Background image', 'tcd-w');  ?></h4>
       <div class="theme_option_message2">
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '1200'); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js mobile_index_slider_image">
         <input type="hidden" value="<?php echo esc_attr( $options['mobile_index_slider_image'] ); ?>" id="mobile_index_slider_image" name="dp_options[mobile_index_slider_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['mobile_index_slider_image']){ echo wp_get_attachment_image($options['mobile_index_slider_image'], 'full'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['mobile_index_slider_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>

      </div>
     </div>

     <?php // 動画の設定---------- ?>
     <div id="mobile_index_slider_video" style="<?php if($options['mobile_index_slider_bg_type'] == 'type2') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Video setting', 'tcd-w');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('Please upload MP4 format file.', 'tcd-w');  ?></p>
       <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-w'); ?></p>
      </div>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js mobile_index_video">
        <input type="hidden" value="<?php echo esc_attr( $options['mobile_index_video'] ); ?>" id="mobile_index_video" name="dp_options[mobile_index_video]" class="cf_media_id">
        <div class="preview_field preview_field_video">
         <?php if($options['mobile_index_video']){ ?>
         <h4><?php _e( 'Uploaded MP4 file', 'tcd-w' ); ?></h4>
         <p><?php echo esc_url(wp_get_attachment_url($options['mobile_index_video'])); ?></p>
         <?php }; ?>
        </div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select MP4 file', 'tcd-w'); ?>" class="cfmf-select-video button">
         <input type="button" value="<?php _e('Remove MP4 file', 'tcd-w'); ?>" class="cfmf-delete-video button <?php if(!$options['mobile_index_video']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>
     </div><!-- END #mobile_index_slider_video -->

     <?php // YouTube ----------------------------------------- ?>
     <div id="mobile_index_slider_youtube" style="<?php if($options['mobile_index_slider_bg_type'] == 'type3') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Youtube setting', 'tcd-w');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('Please enter Youtube URL.', 'tcd-w');  ?></p>
       <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-w'); ?></p>
      </div>
      <input id="dp_options[mobile_index_youtube_url]" class="regular-text" type="text" name="dp_options[mobile_index_youtube_url]" value="<?php esc_attr_e( $options['mobile_index_youtube_url'] ); ?>" />
     </div><!-- END #mobile_index_slider_youtube -->

     <?php // 動画用代替画像 ----------- ?>
     <div id="mobile_index_slider_movie_image" style="<?php if($options['mobile_index_slider_bg_type'] != 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Substitute image', 'tcd-w');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('If the mobile device can\'t play video this image will be displayed instead.', 'tcd-w');  ?></p>
      </div>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js mobile_index_movie_image">
        <input type="hidden" value="<?php echo esc_attr( $options['mobile_index_movie_image'] ); ?>" id="mobile_index_movie_image" name="dp_options[mobile_index_movie_image]" class="cf_media_id">
        <div class="preview_field"><?php if($options['mobile_index_movie_image']){ echo wp_get_attachment_image($options['mobile_index_movie_image'], 'full'); }; ?></div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
         <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['mobile_index_movie_image']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>
     </div>

     <?php // オーバーレイ ----------------------- ?>
     <div class="mobile_index_slider_bg_image_setting_area" style="<?php if($options['mobile_index_slider_use_image_slider']) { echo 'display:none;'; } else { echo 'display:block;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e( 'Overlay setting', 'tcd-w' ); ?></h4>
      <p class="displayment_checkbox"><label><input name="dp_options[mobile_index_slider_use_overlay]" type="checkbox" value="1" <?php checked( $options['mobile_index_slider_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
      <div style="<?php if($options['mobile_index_slider_use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
        <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[mobile_index_slider_overlay_color]" value="<?php echo esc_attr( $options['mobile_index_slider_overlay_color'] ); ?>" data-default-color="#000000"></li>
        <li class="cf"><span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_index_slider_overlay_opacity]" value="<?php echo esc_attr( $options['mobile_index_slider_overlay_opacity'] ); ?>" /><p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p></li>
       </ul>
      </div>
     </div>

     <?php //コンテンツの設定 ----- ?>
     <h4 class="theme_option_headline2"><?php _e('Content setting', 'tcd-w');  ?></h4>
     <div class="theme_option_message">
      <p><?php _e('Click add item button to start this option.<br />You can change order by dragging each headline of option field.', 'tcd-w');  ?></p>
     </div>
     <?php //繰り返しフィールド ----- ?>
     <div class="repeater-wrapper">
      <input type="hidden" name="dp_options[mobile_index_slider]" value="">
      <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
       <?php
            if ( $options['mobile_index_slider'] ) :
              foreach ( $options['mobile_index_slider'] as $key => $value ) :
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
        <h4 class="theme_option_subbox_headline"><?php if($value['catch']) { echo esc_html( $value['catch'] ); } else { _e( 'Item', 'tcd-w' ); }; ?></h4>
        <div class="sub_box_content">
         <?php // レイヤー画像 ----------------------- ?>
         <h4 class="theme_option_headline2"><?php _e( 'Layer image', 'tcd-w' ); ?></h4>
         <div class="theme_option_message2">
          <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '900', '900'); ?></p>
         </div>
         <div class="image_box cf">
          <div class="cf cf_media_field hide-if-no-js mobile_index_slider<?php echo esc_attr( $key ); ?>_layer_image">
           <input type="hidden" value="<?php if($value['layer_image']) { echo esc_attr( $value['layer_image'] ); }; ?>" id="mobile_index_slider<?php echo esc_attr( $key ); ?>_layer_image" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][layer_image]" class="cf_media_id">
           <div class="preview_field"><?php if($value['layer_image']){ echo wp_get_attachment_image($value['layer_image'], 'medium'); }; ?></div>
           <div class="buttton_area">
            <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
            <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$value['layer_image']){ echo 'hidden'; }; ?>">
           </div>
          </div>
         </div>
         <?php // アニメーション ----------------------- ?>
         <h4 class="theme_option_headline2"><?php _e('Animation for layer image', 'tcd-w'); ?></h4>
         <select name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][animation_type]">
          <option style="padding-right: 10px;" value="type1" <?php selected( $value['animation_type'], 'type1' ); ?>><?php _e('No animation', 'tcd-w'); ?></option>
          <option style="padding-right: 10px;" value="type2" <?php selected( $value['animation_type'], 'type2' ); ?>><?php _e('Fade in', 'tcd-w'); ?></option>
          <option style="padding-right: 10px;" value="type3" <?php selected( $value['animation_type'], 'type3' ); ?>><?php _e('Slide in from left', 'tcd-w'); ?></option>
          <option style="padding-right: 10px;" value="type4" <?php selected( $value['animation_type'], 'type4' ); ?>><?php _e('Slide in from right', 'tcd-w'); ?></option>
         </select>
         <?php // キャッチフレーズ ----------------------- ?>
         <div class="mobile_index_slider_other_setting">
          <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
          <textarea class="repeater-label large-text" cols="50" rows="3" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch]"><?php echo esc_textarea(  $value['catch'] ); ?></textarea>
          <ul class="option_list">
           <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
            <select name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_font_type]">
             <?php foreach ( $font_type_options as $option ) { ?>
             <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
             <?php } ?>
            </select>
           </li>
           <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_font_size]" value="<?php echo esc_attr( $value['catch_font_size'] ); ?>" /><span>px</span></li>
           <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_font_color]" value="<?php echo esc_attr( $value['catch_font_color'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
          </ul>
          <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
          <textarea class="large-text" cols="50" rows="4" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea>
          <ul class="option_list">
           <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][desc_font_size]" value="<?php echo esc_attr( $value['desc_font_size'] ); ?>" /><span>px</span></li>
           <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][desc_font_color]" value="<?php echo esc_attr( $value['desc_font_color'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
          </ul>
          <?php // ボタン ----------------------- ?>
          <h4 class="theme_option_headline2"><?php _e('Button setting', 'tcd-w');  ?></h4>
          <p class="displayment_checkbox"><label><input class="show_button" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][show_button]" type="checkbox" value="1" <?php checked( $value['show_button'], 1 ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
          <div style="<?php if($value['show_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
           <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
            <li class="cf"><span class="label"><?php _e('label', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_label]" value="<?php echo esc_attr( $value['button_label'] ); ?>" /></li>
            <li class="cf"><span class="label"><?php _e('URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_url]" value="<?php echo esc_attr( $value['button_url'] ); ?>"></li>
            <li class="cf"><span class="label"><?php _e('Open link in new window', 'tcd-w'); ?></span><input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_target]" type="checkbox" value="1" <?php checked( $value['button_target'], 1 ); ?>></li>
            <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_font_color]" value="<?php echo esc_attr( $value['button_font_color'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
            <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_border_color]" value="<?php echo esc_attr( $value['button_border_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
            <li class="cf">
             <span class="label"><?php _e('Transparency of border', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_border_color_opacity]" value="<?php echo esc_attr( $value['button_border_color_opacity'] ); ?>" />
             <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
              <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
             </div>
            </li>
            <li class="cf"><span class="label"><?php _e('Font color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_font_color_hover]" value="<?php echo esc_attr( $value['button_font_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
            <li class="cf"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_bg_color_hover]" value="<?php echo esc_attr( $value['button_bg_color_hover'] ); ?>" data-default-color="#208a96" class="c-color-picker"></li>
            <li class="cf"><span class="label"><?php _e('Border color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_border_color_hover]" value="<?php echo esc_attr( $value['button_border_color_hover'] ); ?>" data-default-color="#208a96" class="c-color-picker"></li>
            <li class="cf">
             <span class="label"><?php _e('Transparency of border on mouseover', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_border_color_opacity_hover]" value="<?php echo esc_attr( $value['button_border_color_opacity_hover'] ); ?>" />
             <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
              <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
             </div>
            </li>
            <li class="cf"><span class="label"><?php _e('Hover effect', 'tcd-w');  ?></span>
             <select name="dp_options[mobile_index_slider][<?php echo esc_attr($key); ?>][button_animation_type]">
              <option style="padding-right: 10px;" value="type1" <?php selected( $value['button_animation_type'], 'type1' ); ?>><?php _e('No hover effect', 'tcd-w');  ?></option>
              <option style="padding-right: 10px;" value="type2" <?php selected( $value['button_animation_type'], 'type2' ); ?>><?php _e('Swipe animation', 'tcd-w');  ?></option>
              <option style="padding-right: 10px;" value="type3" <?php selected( $value['button_animation_type'], 'type3' ); ?>><?php _e('Diagonal swipe animation', 'tcd-w');  ?></option>
             </select>
            </li>
           </ul>
          </div>
          <?php // ドロップシャドウ ----------------------- ?>
          <h4 class="theme_option_headline2"><?php _e('Dropshadow setting', 'tcd-w');  ?></h4>
          <p class="displayment_checkbox"><label><input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][use_catch_shadow]" type="checkbox" value="1" <?php checked( $value['use_catch_shadow'], 1 ); ?>><?php _e( 'Use dropshadow on text content', 'tcd-w' ); ?></label></p>
          <div style="<?php if($value['use_catch_shadow'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
           <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
            <li class="cf"><span class="label"><?php _e('Dropshadow position (left)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_shadow_a]" value="<?php echo esc_attr( $value['catch_shadow_a'] ); ?>"><span>px</span></li>
            <li class="cf"><span class="label"><?php _e('Dropshadow position (top)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_shadow_b]" value="<?php echo esc_attr( $value['catch_shadow_b'] ); ?>"><span>px</span></li>
            <li class="cf"><span class="label"><?php _e('Dropshadow size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_shadow_c]" value="<?php echo esc_attr( $value['catch_shadow_c'] ); ?>"><span>px</span></li>
            <li class="cf"><span class="label"><?php _e('Dropshadow color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_shadow_color]" value="<?php echo esc_attr( $value['catch_shadow_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
           </ul>
          </div>
          <?php // 位置の設定 ----------------------- ?>
          <h4 class="theme_option_headline2"><?php _e('Display position setting', 'tcd-w');  ?></h4>
          <ul class="option_list">
           <li class="cf"><span class="label"><?php _e('Horizontal position of layer image', 'tcd-w');  ?></span>
            <select name="dp_options[mobile_index_slider][<?php echo esc_attr($key); ?>][image_layout_mobile]">
             <?php foreach ( $content_direction_options as $option ) { ?>
             <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['image_layout_mobile'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
             <?php } ?>
            </select>
           </li>
           <li class="cf"><span class="label"><?php _e('Position of text content', 'tcd-w');  ?></span>
            <select name="dp_options[mobile_index_slider][<?php echo esc_attr($key); ?>][text_layout_mobile]">
             <?php foreach ( $content_direction_options as $option ) { ?>
             <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['text_layout_mobile'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
             <?php } ?>
            </select>
           </li>
          </ul>
         </div><!-- END .mobile_index_slider_other_setting -->
         <?php // 背景画像画 ----------------------- ?>
         <div class="mobile_index_slider_item_bg_image_setting_area" style="<?php if($options['mobile_index_slider_use_image_slider']){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
          <h4 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h4>
          <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '1200'); ?></p>
          <div class="image_box cf">
           <div class="cf cf_media_field hide-if-no-js mobile_index_slider<?php echo esc_attr( $key ); ?>_bg_image">
            <input type="hidden" value="<?php if($value['bg_image']) { echo esc_attr( $value['bg_image'] ); }; ?>" id="mobile_index_slider<?php echo esc_attr( $key ); ?>_bg_image" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][bg_image]" class="cf_media_id">
            <div class="preview_field"><?php if($value['bg_image']){ echo wp_get_attachment_image($value['bg_image'], 'medium'); }; ?></div>
            <div class="buttton_area">
             <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
             <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$value['bg_image']){ echo 'hidden'; }; ?>">
            </div>
           </div>
          </div>
          <?php // オーバーレイ ----------------------- ?>
          <h4 class="theme_option_headline2"><?php _e( 'Overlay setting', 'tcd-w' ); ?></h4>
          <p class="displayment_checkbox"><label><input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][use_overlay]" type="checkbox" value="1" <?php checked( $value['use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
          <div style="<?php if($value['use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
           <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
            <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][overlay_color]" value="<?php echo esc_attr( $value['overlay_color'] ); ?>" data-default-color="#000000"></li>
            <li class="cf"><span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][overlay_opacity]" value="<?php echo esc_attr( $value['overlay_opacity'] ); ?>" /><p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p></li>
           </ul>
          </div>
          <?php // アニメーション ----------------------- ?>
          <h4 class="theme_option_headline2"><?php _e('Background image animation type', 'tcd-w');  ?></h4>
          <select name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][bg_image_animation_type]">
           <?php foreach ( $slider_animation_options as $option ) { ?>
           <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['bg_image_animation_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
           <?php } ?>
          </select>
         </div><!-- END .mobile_index_slider_item_bg_image_setting_area -->
         <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
        </div><!-- END .sub_box_content -->
       </div><!-- END .sub_box -->
       <?php
              endforeach;
            endif;
            $key = 'addindex';
            $value = array(
             'image_layout_mobile' => 'type3',
             'text_layout_mobile' => 'type1',
             'layer_image' => false,
             'bg_image' => false,
             'catch' => '',
             'catch_font_type' => 'type3',
             'catch_font_size' => '24',
             'catch_font_color' => '#ffffff',
             'desc' => '',
             'desc_font_size' => '15',
             'desc_font_color' => '#ffffff',
             'show_button' => '',
             'button_label' => '',
             'button_url' => '',
             'button_target' => '',
             'button_font_color' => '#ffffff',
             'button_border_color' => '#ffffff',
             'button_border_color_opacity' => '0.5',
             'button_font_color_hover' => '#ffffff',
             'button_border_color_hover' => '#208a96',
             'button_border_color_opacity_hover' => '0.5',
             'button_bg_color_hover' => '#208a96',
             'button_animation_type' => 'type1',
             'use_catch_shadow' => '',
             'catch_shadow_a' => '0',
             'catch_shadow_b' => '0',
             'catch_shadow_c' => '4',
             'catch_shadow_color' => '#000000',
             'use_overlay' => '',
             'overlay_color' => '#000000',
             'overlay_opacity' => '0.3',
             'animation_type' => 'type1',
             'bg_image_animation_type' => 'type1',
            );
            ob_start();
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
        <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-w' ); ?></h4>
        <div class="sub_box_content">
         <?php // レイヤー画像 ----------------------- ?>
         <h4 class="theme_option_headline2"><?php _e( 'Layer image', 'tcd-w' ); ?></h4>
         <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '750'); ?></p>
         <div class="image_box cf">
          <div class="cf cf_media_field hide-if-no-js mobile_index_slider<?php echo esc_attr( $key ); ?>_layer_image">
           <input type="hidden" value="<?php if($value['layer_image']) { echo esc_attr( $value['layer_image'] ); }; ?>" id="mobile_index_slider<?php echo esc_attr( $key ); ?>_layer_image" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][layer_image]" class="cf_media_id">
           <div class="preview_field"><?php if($value['layer_image']){ echo wp_get_attachment_image($value['layer_image'], 'medium'); }; ?></div>
           <div class="buttton_area">
            <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
            <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$value['layer_image']){ echo 'hidden'; }; ?>">
           </div>
          </div>
         </div>
         <?php // アニメーション ----------------------- ?>
         <h4 class="theme_option_headline2"><?php _e('Animation for layer image', 'tcd-w'); ?></h4>
         <select name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][animation_type]">
          <option style="padding-right: 10px;" value="type1" <?php selected( $value['animation_type'], 'type1' ); ?>><?php _e('No animation', 'tcd-w'); ?></option>
          <option style="padding-right: 10px;" value="type2" <?php selected( $value['animation_type'], 'type2' ); ?>><?php _e('Fade in', 'tcd-w'); ?></option>
          <option style="padding-right: 10px;" value="type3" <?php selected( $value['animation_type'], 'type3' ); ?>><?php _e('Slide in from left', 'tcd-w'); ?></option>
          <option style="padding-right: 10px;" value="type4" <?php selected( $value['animation_type'], 'type4' ); ?>><?php _e('Slide in from right', 'tcd-w'); ?></option>
         </select>
         <?php // キャッチフレーズ ----------------------- ?>
         <div class="mobile_index_slider_other_setting">
          <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
          <textarea class="repeater-label large-text" cols="50" rows="3" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch]"><?php echo esc_textarea(  $value['catch'] ); ?></textarea>
          <ul class="option_list">
           <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
            <select name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_font_type]">
             <?php foreach ( $font_type_options as $option ) { ?>
             <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
             <?php } ?>
            </select>
           </li>
           <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_font_size]" value="<?php echo esc_attr( $value['catch_font_size'] ); ?>" /><span>px</span></li>
           <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_font_color]" value="<?php echo esc_attr( $value['catch_font_color'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
          </ul>
          <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
          <textarea class="large-text" cols="50" rows="4" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea>
          <ul class="option_list">
           <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][desc_font_size]" value="<?php echo esc_attr( $value['desc_font_size'] ); ?>" /><span>px</span></li>
           <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][desc_font_color]" value="<?php echo esc_attr( $value['desc_font_color'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
          </ul>
          <?php // ボタン ----------------------- ?>
          <h4 class="theme_option_headline2"><?php _e('Button setting', 'tcd-w');  ?></h4>
          <p class="displayment_checkbox"><label><input class="show_button" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][show_button]" type="checkbox" value="1" <?php checked( $value['show_button'], 1 ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
          <div style="<?php if($value['show_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
           <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
            <li class="cf"><span class="label"><?php _e('label', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_label]" value="<?php echo esc_attr( $value['button_label'] ); ?>" /></li>
            <li class="cf"><span class="label"><?php _e('URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_url]" value="<?php echo esc_attr( $value['button_url'] ); ?>"></li>
            <li class="cf"><span class="label"><?php _e('Open link in new window', 'tcd-w'); ?></span><input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_target]" type="checkbox" value="1" <?php checked( $value['button_target'], 1 ); ?>></li>
            <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_font_color]" value="<?php echo esc_attr( $value['button_font_color'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
            <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_border_color]" value="<?php echo esc_attr( $value['button_border_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
            <li class="cf">
             <span class="label"><?php _e('Transparency of border', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_border_color_opacity]" value="<?php echo esc_attr( $value['button_border_color_opacity'] ); ?>" />
             <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
              <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
             </div>
            </li>
            <li class="cf"><span class="label"><?php _e('Font color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_font_color_hover]" value="<?php echo esc_attr( $value['button_font_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
            <li class="cf"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_bg_color_hover]" value="<?php echo esc_attr( $value['button_bg_color_hover'] ); ?>" data-default-color="#208a96" class="c-color-picker"></li>
            <li class="cf"><span class="label"><?php _e('Border color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_border_color_hover]" value="<?php echo esc_attr( $value['button_border_color_hover'] ); ?>" data-default-color="#208a96" class="c-color-picker"></li>
            <li class="cf">
             <span class="label"><?php _e('Transparency of border on mouseover', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][button_border_color_opacity_hover]" value="<?php echo esc_attr( $value['button_border_color_opacity_hover'] ); ?>" />
             <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
              <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
             </div>
            </li>
            <li class="cf"><span class="label"><?php _e('Hover effect', 'tcd-w');  ?></span>
             <select name="dp_options[mobile_index_slider][<?php echo esc_attr($key); ?>][button_animation_type]">
              <option style="padding-right: 10px;" value="type1" <?php selected( $value['button_animation_type'], 'type1' ); ?>><?php _e('No hover effect', 'tcd-w');  ?></option>
              <option style="padding-right: 10px;" value="type2" <?php selected( $value['button_animation_type'], 'type2' ); ?>><?php _e('Swipe animation', 'tcd-w');  ?></option>
              <option style="padding-right: 10px;" value="type3" <?php selected( $value['button_animation_type'], 'type3' ); ?>><?php _e('Diagonal swipe animation', 'tcd-w');  ?></option>
             </select>
            </li>
           </ul>
          </div>
          <?php // ドロップシャドウ ----------------------- ?>
          <h4 class="theme_option_headline2"><?php _e('Dropshadow setting', 'tcd-w');  ?></h4>
          <p class="displayment_checkbox"><label><input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][use_catch_shadow]" type="checkbox" value="1" <?php checked( $value['use_catch_shadow'], 1 ); ?>><?php _e( 'Use dropshadow on text content', 'tcd-w' ); ?></label></p>
          <div style="<?php if($value['use_catch_shadow'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
           <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
            <li class="cf"><span class="label"><?php _e('Dropshadow position (left)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_shadow_a]" value="<?php echo esc_attr( $value['catch_shadow_a'] ); ?>"><span>px</span></li>
            <li class="cf"><span class="label"><?php _e('Dropshadow position (top)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_shadow_b]" value="<?php echo esc_attr( $value['catch_shadow_b'] ); ?>"><span>px</span></li>
            <li class="cf"><span class="label"><?php _e('Dropshadow size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_shadow_c]" value="<?php echo esc_attr( $value['catch_shadow_c'] ); ?>"><span>px</span></li>
            <li class="cf"><span class="label"><?php _e('Dropshadow color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][catch_shadow_color]" value="<?php echo esc_attr( $value['catch_shadow_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
           </ul>
          </div>
          <?php // 位置の設定 ----------------------- ?>
          <h4 class="theme_option_headline2"><?php _e('Display position setting', 'tcd-w');  ?></h4>
          <ul class="option_list">
           <li class="cf"><span class="label"><?php _e('Horizontal position of layer image', 'tcd-w');  ?></span>
            <select name="dp_options[mobile_index_slider][<?php echo esc_attr($key); ?>][image_layout_mobile]">
             <?php foreach ( $content_direction_options as $option ) { ?>
             <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['image_layout_mobile'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
             <?php } ?>
            </select>
           </li>
           <li class="cf"><span class="label"><?php _e('Position of text content', 'tcd-w');  ?></span>
            <select name="dp_options[mobile_index_slider][<?php echo esc_attr($key); ?>][text_layout_mobile]">
             <?php foreach ( $content_direction_options as $option ) { ?>
             <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['text_layout_mobile'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
             <?php } ?>
            </select>
           </li>
          </ul>
         </div><!-- END .mobile_index_slider_other_setting -->
         <?php // 背景画像画像 ----------------------- ?>
         <div class="mobile_index_slider_item_bg_image_setting_area" style="<?php if($options['mobile_index_slider_use_image_slider']){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
          <h4 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h4>
          <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '1200'); ?></p>
          <div class="image_box cf">
           <div class="cf cf_media_field hide-if-no-js mobile_index_slider<?php echo esc_attr( $key ); ?>_bg_image">
            <input type="hidden" value="<?php if($value['bg_image']) { echo esc_attr( $value['bg_image'] ); }; ?>" id="mobile_index_slider<?php echo esc_attr( $key ); ?>_bg_image" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][bg_image]" class="cf_media_id">
            <div class="preview_field"><?php if($value['bg_image']){ echo wp_get_attachment_image($value['bg_image'], 'medium'); }; ?></div>
            <div class="buttton_area">
             <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
             <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$value['bg_image']){ echo 'hidden'; }; ?>">
            </div>
           </div>
          </div>
          <?php // オーバーレイ ----------------------- ?>
          <h4 class="theme_option_headline2"><?php _e( 'Overlay setting', 'tcd-w' ); ?></h4>
          <p class="displayment_checkbox"><label><input name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][use_overlay]" type="checkbox" value="1" <?php checked( $value['use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
          <div style="<?php if($value['use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
           <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
            <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][overlay_color]" value="<?php echo esc_attr( $value['overlay_color'] ); ?>" data-default-color="#000000"></li>
            <li class="cf"><span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][overlay_opacity]" value="<?php echo esc_attr( $value['overlay_opacity'] ); ?>" /><p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p></li>
           </ul>
          </div>
          <?php // アニメーション ----------------------- ?>
          <h4 class="theme_option_headline2"><?php _e('Background image animation type', 'tcd-w');  ?></h4>
          <select name="dp_options[mobile_index_slider][<?php echo esc_attr( $key ); ?>][bg_image_animation_type]">
           <?php foreach ( $slider_animation_options as $option ) { ?>
           <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['bg_image_animation_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
           <?php } ?>
          </select>
         </div><!-- END .mobile_index_slider_item_bg_image_setting_area -->
         <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
        </div><!-- END .sub_box_content -->
       </div><!-- END .sub_box -->
       <?php
            $clone = ob_get_clean();
       ?>
      </div><!-- END .repeater -->
      <a href="#" class="button button-secondary button-add-row mobile_index_slider_add_item" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add item', 'tcd-w' ); ?></a>
     </div><!-- END .repeater-wrapper -->
     <?php //繰り返しフィールドここまで ----- ?>
     <?php // スピードの設定 ---------- ?>
     <h4 class="theme_option_headline2"><?php _e('Content slider speed setting', 'tcd-w');  ?></h4>
     <select name="dp_options[mobile_index_slider_time]">
      <?php
           $i = 1;
           foreach ( $time_options as $option ):
             if( $i >= 2 && $i <= 10 ){
      ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $options['mobile_index_slider_time'], $option['value'] ); ?>><?php echo esc_html($option['label']); ?></option>
      <?php
             }
             $i++;
          endforeach;
      ?>
     </select>

     </div><!-- END #index_slider_input_area -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // コンテンツビルダー ここから ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ ?>
   <div class="theme_option_field theme_option_field_ac open active show_arrow">
    <h3 class="theme_option_headline"><?php _e('Content builder', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message no_arrow">
      <?php echo __( '<p>You can build contents freely with this function.</p><br /><p>STEP1: Click Add content button.<br />STEP2: Select content from dropdown menu.<br />STEP3: Input data and save the option.</p><br /><p>You can change order by dragging MOVE button and you can delete content by clicking DELETE button.</p>', 'tcd-w' ); ?>
     </div>
     <p><label><input name="dp_options[mobile_show_contents_builder]" type="checkbox" value="1" <?php checked( '1', $options['mobile_show_contents_builder'] ); ?> /> <?php _e('Use content builder for smartphone', 'tcd-w');  ?></label></p>
     <h4 class="theme_option_headline2"><?php _e( 'Content image', 'tcd-w' ); ?></h4>
     <ul class="design_button_list cf rebox_group">
      <li><a href="<?php bloginfo('template_url'); ?>/admin/img/cb_layer_content.jpg" title="<?php _e( 'Layer content', 'tcd-w' ); ?>"><?php _e( 'Layer content', 'tcd-w' ); ?></a></li>
      <li><a href="<?php bloginfo('template_url'); ?>/admin/img/cb_product_list.jpg" title="<?php printf(__('%s list', 'tcd-w'),$product_label); ?>"><?php printf(__('%s list', 'tcd-w'),$product_label); ?></a></li>
      <li><a href="<?php bloginfo('template_url'); ?>/admin/img/cb_post_slider.jpg" title="<?php echo __('Post carousel', 'tcd-w'); ?>"><?php echo __('Post carousel', 'tcd-w'); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

   <div class="contents_builder_wrap">

    <div class="contents_builder">
     <p class="cb_message"><?php _e( 'Click Add content button to start content builder', 'tcd-w' ); ?></p>
     <?php
          if (!empty($options['mobile_contents_builder'])) {
            foreach($options['mobile_contents_builder'] as $key => $content) :
              $cb_index = 'cb_'.$key.'_'.mt_rand(0,999999);
     ?>
     <div class="cb_row">
      <ul class="cb_button cf">
       <li><span class="cb_move"><?php echo __('Move', 'tcd-w'); ?></span></li>
       <li><span class="cb_delete"><?php echo __('Delete', 'tcd-w'); ?></span></li>
      </ul>
      <div class="cb_column_area cf">
       <div class="cb_column">
        <input type="hidden" class="cb_index" value="<?php echo $cb_index; ?>" />
        <?php mobile_the_cb_content_select($cb_index, $content['cb_content_select']); ?>
        <?php if (!empty($content['cb_content_select'])) mobile_the_cb_content_setting($cb_index, $content['cb_content_select'], $content); ?>
       </div>
      </div><!-- END .cb_column_area -->
     </div><!-- END .cb_row -->
     <?php
          endforeach;
         };
     ?>
    </div><!-- END .contents_builder -->
    <ul class="button_list cf cb_add_row_buttton_area">
     <li><input type="button" value="<?php echo __( 'Add content', 'tcd-w' ); ?>" class="button-ml add_row"></li>
     <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
    </ul>

    <?php // コンテンツビルダー追加用 非表示 ?>
    <div class="contents_builder-clone hidden">
     <div class="cb_row">
      <ul class="cb_button cf">
       <li><span class="cb_move"><?php echo __('Move', 'tcd-w'); ?></span></li>
       <li><span class="cb_delete"><?php echo __('Delete', 'tcd-w'); ?></span></li>
      </ul>
      <div class="cb_column_area cf">
       <div class="cb_column">
        <input type="hidden" class="cb_index" value="cb_cloneindex" />
        <?php mobile_the_cb_content_select('cb_cloneindex'); ?>
       </div>
      </div><!-- END .cb_column_area -->
     </div><!-- END .cb_row -->
     <?php
          mobile_the_cb_content_setting('cb_cloneindex', 'layer_content');
          mobile_the_cb_content_setting('cb_cloneindex', 'product_list');
          mobile_the_cb_content_setting('cb_cloneindex', 'post_slider');
          mobile_the_cb_content_setting('cb_cloneindex', 'free_space');
     ?>
    </div><!-- END .contents_builder-clone -->

   </div><!-- END .contents_builder_wrap -->
   <?php // コンテンツビルダーここまで ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ ?>


</div><!-- END .tab-content -->

<?php
} // END add_front_page_mobile_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_front_page_mobile_theme_options_validate( $input ) {

  global $dp_default_options, $time_options, $font_type_options, $slider_animation_options, $content_direction_options, $index_content_type_options, $item_type_options;

  // ヘッダーコンテンツ
  $input['mobile_show_index_slider'] = wp_filter_nohtml_kses( $input['mobile_show_index_slider'] );
  if ( ! isset( $value['mobile_index_slider_time'] ) )
    $value['mobile_index_slider_time'] = null;
  if ( ! array_key_exists( $value['mobile_index_slider_time'], $time_options ) )
    $value['mobile_index_slider_time'] = null;

  if ( ! isset( $input['mobile_index_slider_bg_type'] ) )
    $input['mobile_index_slider_bg_type'] = null;
  if ( ! array_key_exists( $input['mobile_index_slider_bg_type'], $item_type_options ) )
    $input['mobile_index_slider_bg_type'] = null;

  $input['mobile_index_slider_image'] = wp_filter_nohtml_kses( $input['mobile_index_slider_image'] );
  $input['mobile_index_video'] = wp_filter_nohtml_kses( $input['mobile_index_video'] );
  $input['mobile_index_youtube_url'] = wp_filter_nohtml_kses( $input['mobile_index_youtube_url'] );
  $input['mobile_index_movie_image'] = wp_filter_nohtml_kses( $input['mobile_index_movie_image'] );
  $input['mobile_index_slider_use_overlay'] = ! empty( $input['mobile_index_slider_use_overlay'] ) ? 1 : 0;
  $input['mobile_index_slider_overlay_color'] = wp_filter_nohtml_kses( $input['mobile_index_slider_overlay_color'] );
  $input['mobile_index_slider_overlay_opacity'] = wp_filter_nohtml_kses( $input['mobile_index_slider_overlay_opacity'] );

  $input['mobile_index_slider_use_image_slider'] = ! empty( $input['mobile_index_slider_use_image_slider'] ) ? 1 : 0;

  if ( ! isset( $value['mobile_index_slider_time'] ) )
    $value['mobile_index_slider_time'] = null;
  if ( ! array_key_exists( $value['mobile_index_slider_time'], $time_options ) )
    $value['mobile_index_slider_time'] = null;

  //スライダーの設定
  $mobile_index_slider = array();
  if ( isset( $input['mobile_index_slider'] ) && is_array( $input['mobile_index_slider'] ) ) {
    foreach ( $input['mobile_index_slider'] as $key => $value ) {
      $mobile_index_slider[] = array(
        'image_layout_mobile' => ( isset( $input['mobile_index_slider'][$key]['image_layout_mobile'] ) && array_key_exists( $input['mobile_index_slider'][$key]['image_layout_mobile'], $content_direction_options ) ) ? $input['mobile_index_slider'][$key]['image_layout_mobile'] : 'type3',
        'text_layout_mobile' => ( isset( $input['mobile_index_slider'][$key]['text_layout_mobile'] ) && array_key_exists( $input['mobile_index_slider'][$key]['text_layout_mobile'], $content_direction_options ) ) ? $input['mobile_index_slider'][$key]['text_layout_mobile'] : 'type2',
        'layer_image' => isset( $input['mobile_index_slider'][$key]['layer_image'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['layer_image'] ) : '',
        'bg_image' => isset( $input['mobile_index_slider'][$key]['bg_image'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['bg_image'] ) : '',
        'catch' => isset( $input['mobile_index_slider'][$key]['catch'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['catch'] ) : '',
        'catch_font_type' => ( isset( $input['mobile_index_slider'][$key]['catch_font_type'] ) && array_key_exists( $input['mobile_index_slider'][$key]['catch_font_type'], $font_type_options ) ) ? $input['mobile_index_slider'][$key]['catch_font_type'] : 'type1',
        'catch_font_size' => isset( $input['mobile_index_slider'][$key]['catch_font_size'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['catch_font_size'] ) : '30',
        'catch_font_color' => isset( $input['mobile_index_slider'][$key]['catch_font_color'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['catch_font_color'] ) : '#FFFFFF',
        'desc' => isset( $input['mobile_index_slider'][$key]['desc'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['desc'] ) : '',
        'desc_mobile' => isset( $input['mobile_index_slider'][$key]['desc_mobile'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['desc_mobile'] ) : '',
        'desc_font_size' => isset( $input['mobile_index_slider'][$key]['desc_font_size'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['desc_font_size'] ) : '20',
        'desc_font_color' => isset( $input['mobile_index_slider'][$key]['desc_font_color'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['desc_font_color'] ) : '#FFFFFF',
        'show_button' => ! empty( $input['mobile_index_slider'][$key]['show_button'] ) ? 1 : 0,
        'button_label' => isset( $input['mobile_index_slider'][$key]['button_label'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_label'] ) : '',
        'button_url' => isset( $input['mobile_index_slider'][$key]['button_url'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_url'] ) : '',
        'button_target' => ! empty( $input['mobile_index_slider'][$key]['button_target'] ) ? 1 : 0,
        'button_font_color' => isset( $input['mobile_index_slider'][$key]['button_font_color'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_font_color'] ) : '#FFFFFF',
        'button_border_color' => isset( $input['mobile_index_slider'][$key]['button_border_color'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_border_color'] ) : '#FFFFFF',
        'button_border_color_opacity' => isset( $input['mobile_index_slider'][$key]['button_border_color_opacity'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_border_color_opacity'] ) : '0.5',
        'button_font_color_hover' => isset( $input['mobile_index_slider'][$key]['button_font_color_hover'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_font_color_hover'] ) : '#FFFFFF',
        'button_border_color_hover' => isset( $input['mobile_index_slider'][$key]['button_border_color_hover'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_border_color_hover'] ) : '#208a96',
        'button_border_color_opacity_hover' => isset( $input['mobile_index_slider'][$key]['button_border_color_opacity_hover'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_border_color_opacity_hover'] ) : '0.5',
        'button_bg_color_hover' => isset( $input['mobile_index_slider'][$key]['button_bg_color_hover'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_bg_color_hover'] ) : '#208a96',
        'button_animation_type' => isset( $input['mobile_index_slider'][$key]['button_animation_type'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['button_animation_type'] ) : 'type1',
        'use_catch_shadow' => ! empty( $input['mobile_index_slider'][$key]['use_catch_shadow'] ) ? 1 : 0,
        'catch_shadow_a' => isset( $input['mobile_index_slider'][$key]['catch_shadow_a'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['catch_shadow_a'] ) : '0',
        'catch_shadow_b' => isset( $input['mobile_index_slider'][$key]['catch_shadow_b'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['catch_shadow_b'] ) : '0',
        'catch_shadow_c' => isset( $input['mobile_index_slider'][$key]['catch_shadow_c'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['catch_shadow_c'] ) : '4',
        'catch_shadow_color' => isset( $input['mobile_index_slider'][$key]['catch_shadow_color'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['catch_shadow_color'] ) : '#000000',
        'use_overlay' => ! empty( $input['mobile_index_slider'][$key]['use_overlay'] ) ? 1 : 0,
        'overlay_color' => isset( $input['mobile_index_slider'][$key]['overlay_color'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['overlay_color'] ) : '#000000',
        'overlay_opacity' => isset( $input['mobile_index_slider'][$key]['overlay_opacity'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['overlay_opacity'] ) : '0.3',
        'animation_type' => isset( $input['mobile_index_slider'][$key]['animation_type'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['animation_type'] ) : 'type1',
        'bg_image_animation_type' => isset( $input['mobile_index_slider'][$key]['bg_image_animation_type'] ) ? wp_filter_nohtml_kses( $input['mobile_index_slider'][$key]['bg_image_animation_type'] ) : 'type1',
      );
    }
  };
  $input['mobile_index_slider'] = $mobile_index_slider;

  // コンテンツビルダー -----------------------------------------------------------------------------
  $input['mobile_show_contents_builder'] = ! empty( $input['mobile_show_contents_builder'] ) ? 1 : 0;
  if (!empty($input['mobile_contents_builder'])) {

    $input_cb = $input['mobile_contents_builder'];
    $input['mobile_contents_builder'] = array();

    foreach($input_cb as $key => $value) {

      // クローン用はスルー
      //if (in_array($key, array('cb_cloneindex', 'cb_cloneindex2'))) continue;
      if (in_array($key, array('cb_cloneindex', 'cb_cloneindex2'), true)) continue;

      // レイヤー画像コンテンツ -----------------------------------------------------------------------
      if ($value['cb_content_select'] == 'layer_content') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        if ( ! isset( $value['show_layer_image'] ) )
          $value['show_layer_image'] = null;
          $value['show_layer_image'] = ( $value['show_layer_image'] == 1 ? 1 : 0 );

        $value['image_layout_mobile'] = wp_filter_nohtml_kses( $value['image_layout_mobile'] );
        $value['text_layout_mobile'] = wp_filter_nohtml_kses( $value['text_layout_mobile'] );

        $value['catch'] = wp_filter_nohtml_kses( $value['catch'] );
        $value['catch_font_size'] = wp_filter_nohtml_kses( $value['catch_font_size'] );
        $value['catch_font_type'] = wp_filter_nohtml_kses( $value['catch_font_type'] );
        $value['catch_font_color'] = wp_filter_nohtml_kses( $value['catch_font_color'] );

        $value['desc'] = wp_filter_nohtml_kses( $value['desc'] );
        $value['desc_font_size'] = wp_filter_nohtml_kses( $value['desc_font_size'] );
        $value['desc_font_color'] = wp_filter_nohtml_kses( $value['desc_font_color'] );

        if ( ! isset( $value['show_button'] ) )
          $value['show_button'] = null;
          $value['show_button'] = ( $value['show_button'] == 1 ? 1 : 0 );
        $value['button_label'] = wp_filter_nohtml_kses( $value['button_label'] );
        $value['button_url'] = wp_filter_nohtml_kses( $value['button_url'] );
        $value['button_font_color'] = wp_filter_nohtml_kses( $value['button_font_color'] );
        $value['button_bg_color'] = wp_filter_nohtml_kses( $value['button_bg_color'] );
        $value['button_border_color'] = wp_filter_nohtml_kses( $value['button_border_color'] );
        $value['button_border_color_opacity'] = wp_filter_nohtml_kses( $value['button_border_color_opacity'] );
        $value['button_font_color_hover'] = wp_filter_nohtml_kses( $value['button_font_color_hover'] );
        $value['button_bg_color_hover'] = wp_filter_nohtml_kses( $value['button_bg_color_hover'] );
        $value['button_border_color_hover'] = wp_filter_nohtml_kses( $value['button_border_color_hover'] );
        $value['button_border_color_hover_opacity'] = wp_filter_nohtml_kses( $value['button_border_color_hover_opacity'] );
        $value['button_animation_type'] = wp_filter_nohtml_kses( $value['button_animation_type'] );
        $value['button_target'] = ! empty( $value['button_target'] ) ? 1 : 0;

        $value['bg_image'] = wp_filter_nohtml_kses( $value['bg_image'] );
        $value['bg_image_mobile'] = wp_filter_nohtml_kses( $value['bg_image_mobile'] );
        $value['bg_use_overlay'] = ! empty( $value['bg_use_overlay'] ) ? 1 : 0;
        $value['bg_overlay_color'] = wp_filter_nohtml_kses( $value['bg_overlay_color'] );
        $value['bg_overlay_opacity'] = wp_filter_nohtml_kses( $value['bg_overlay_opacity'] );

        $value['image'] = wp_filter_nohtml_kses( $value['image'] );
        $value['image_mobile'] = wp_filter_nohtml_kses( $value['image_mobile'] );
        $value['animation_type'] = wp_filter_nohtml_kses( $value['animation_type'] );

      // 商品一覧 -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'product_list') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        $value['post_num'] = wp_filter_nohtml_kses( $value['post_num'] );

        $value['catch'] = wp_filter_nohtml_kses( $value['catch'] );
        $value['catch_font_size'] = wp_filter_nohtml_kses( $value['catch_font_size'] );
        $value['catch_font_type'] = wp_filter_nohtml_kses( $value['catch_font_type'] );

        $value['desc'] = wp_filter_nohtml_kses( $value['desc'] );
        $value['desc_font_size'] = wp_filter_nohtml_kses( $value['desc_font_size'] );

        $value['title_font_size'] = wp_filter_nohtml_kses( $value['title_font_size'] );
        $value['title_font_type'] = wp_filter_nohtml_kses( $value['title_font_type'] );

        $value['excerpt_font_size'] = wp_filter_nohtml_kses( $value['excerpt_font_size'] );

        if ( ! isset( $value['show_button'] ) )
          $value['show_button'] = null;
          $value['show_button'] = ( $value['show_button'] == 1 ? 1 : 0 );
        $value['button_label'] = wp_filter_nohtml_kses( $value['button_label'] );
        $value['button_font_color'] = wp_filter_nohtml_kses( $value['button_font_color'] );
        $value['button_bg_color'] = wp_filter_nohtml_kses( $value['button_bg_color'] );
        $value['button_border_color'] = wp_filter_nohtml_kses( $value['button_border_color'] );
        $value['button_border_color_opacity'] = wp_filter_nohtml_kses( $value['button_border_color_opacity'] );
        $value['button_font_color_hover'] = wp_filter_nohtml_kses( $value['button_font_color_hover'] );
        $value['button_bg_color_hover'] = wp_filter_nohtml_kses( $value['button_bg_color_hover'] );
        $value['button_border_color_hover'] = wp_filter_nohtml_kses( $value['button_border_color_hover'] );
        $value['button_border_color_hover_opacity'] = wp_filter_nohtml_kses( $value['button_border_color_hover_opacity'] );
        $value['button_animation_type'] = wp_filter_nohtml_kses( $value['button_animation_type'] );

        $value['post_num'] = wp_filter_nohtml_kses( $value['post_num'] );

      // 記事カルーセル -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'post_slider') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        $value['background_color'] = wp_filter_nohtml_kses( $value['background_color'] );

        $value['catch'] = wp_filter_nohtml_kses( $value['catch'] );
        $value['catch_font_size'] = wp_filter_nohtml_kses( $value['catch_font_size'] );
        $value['catch_font_type'] = wp_filter_nohtml_kses( $value['catch_font_type'] );

        $value['desc'] = wp_filter_nohtml_kses( $value['desc'] );
        $value['desc_font_size'] = wp_filter_nohtml_kses( $value['desc_font_size'] );

        $value['post_type'] = wp_filter_nohtml_kses( $value['post_type'] );
        $value['post_num'] = wp_filter_nohtml_kses( $value['post_num'] );
        $value['post_order'] = wp_filter_nohtml_kses( $value['post_order'] );
        $value['slider_time'] = wp_filter_nohtml_kses( $value['slider_time'] );

        $value['title_font_size'] = wp_filter_nohtml_kses( $value['title_font_size'] );
        $value['title_font_color'] = wp_filter_nohtml_kses( $value['title_font_color'] );
        $value['title_font_type'] = wp_filter_nohtml_kses( $value['title_font_type'] );

        $value['excerpt_font_size'] = wp_filter_nohtml_kses( $value['excerpt_font_size'] );

        if ( ! isset( $value['show_date'] ) )
          $value['show_date'] = null;
          $value['show_date'] = ( $value['show_date'] == 1 ? 1 : 0 );
        if ( ! isset( $value['show_category'] ) )
          $value['show_category'] = null;
          $value['show_category'] = ( $value['show_category'] == 1 ? 1 : 0 );

        if ( ! isset( $value['show_button'] ) )
          $value['show_button'] = null;
          $value['show_button'] = ( $value['show_button'] == 1 ? 1 : 0 );
        $value['button_font_color'] = wp_filter_nohtml_kses( $value['button_font_color'] );
        $value['button_bg_color'] = wp_filter_nohtml_kses( $value['button_bg_color'] );
        $value['button_border_color'] = wp_filter_nohtml_kses( $value['button_border_color'] );
        $value['button_border_color_opacity'] = wp_filter_nohtml_kses( $value['button_border_color_opacity'] );
        $value['button_font_color_hover'] = wp_filter_nohtml_kses( $value['button_font_color_hover'] );
        $value['button_bg_color_hover'] = wp_filter_nohtml_kses( $value['button_bg_color_hover'] );
        $value['button_border_color_hover'] = wp_filter_nohtml_kses( $value['button_border_color_hover'] );
        $value['button_border_color_hover_opacity'] = wp_filter_nohtml_kses( $value['button_border_color_hover_opacity'] );
        $value['button_animation_type'] = wp_filter_nohtml_kses( $value['button_animation_type'] );

      //自由入力欄 -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'free_space') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        if ( ! isset( $value['free_space'] )) {
          $value['free_space'] = null;
        } else {
          $value['free_space'] = $value['free_space'];
        }

        $value['catch'] = wp_filter_nohtml_kses( $value['catch'] );
        $value['catch_font_size'] = wp_filter_nohtml_kses( $value['catch_font_size'] );
        $value['catch_font_type'] = wp_filter_nohtml_kses( $value['catch_font_type'] );

        $value['padding_top'] = wp_filter_nohtml_kses( $value['padding_top'] );
        $value['padding_bottom'] = wp_filter_nohtml_kses( $value['padding_bottom'] );

        $value['content_width'] = wp_filter_nohtml_kses( $value['content_width'] );
        $value['desc_font_size'] = wp_filter_nohtml_kses( $value['desc_font_size'] );

      }

      $input['mobile_contents_builder'][] = $value;

    }

  } //コンテンツビルダーここまで -----------------------------------------------------------------------

  return $input;

};


/**
 * コンテンツビルダー用 コンテンツ選択プルダウン　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
 */
function mobile_the_cb_content_select($cb_index = 'cb_cloneindex', $selected = null) {

  $options = get_design_plus_option();
  $product_label = $options['product_label'] ? esc_html( $options['product_label'] ) : __( 'Product', 'tcd-w' );

	$cb_content_select = array(
		'layer_content' => __('Layer content', 'tcd-w'),
		'product_list' =>  sprintf(__('%s list', 'tcd-w'),$product_label),
		'post_slider' => __('Post carousel', 'tcd-w'),
		'free_space' => __('Free space', 'tcd-w')
	);

	if ($selected && isset($cb_content_select[$selected])) {
		$add_class = ' hidden';
	} else {
		$add_class = '';
	}

	$out = '<select name="dp_options[mobile_contents_builder]['.esc_attr($cb_index).'][cb_content_select]" class="cb_content_select'.$add_class.'">';
	$out .= '<option value="" style="padding-right: 10px;">'.__("Choose the content", "tcd-w").'</option>';

	foreach($cb_content_select as $key => $value) {
		$attr = '';
		if ($key == $selected) {
			$attr = ' selected="selected"';
		}
		$out .= '<option value="'.esc_attr($key).'"'.$attr.' style="padding-right: 10px;">'.esc_html($value).'</option>';
	}

	$out .= '</select>';

	echo $out; 
}

/**
 * コンテンツビルダー用 コンテンツ設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
 */
function mobile_the_cb_content_setting($cb_index = 'cb_cloneindex', $cb_content_select = null, $value = array()) {

  global $content_direction_options, $content_direction_options2, $font_type_options, $content_width_options, $time_options;
  $options = get_design_plus_option();
  $blog_label = $options['blog_label'] ? esc_html( $options['blog_label'] ) : __( 'Blog', 'tcd-w' );
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-w' );
  $product_label = $options['product_label'] ? esc_html( $options['product_label'] ) : __( 'Product', 'tcd-w' );

?>

<div class="cb_content_wrap cf <?php echo esc_attr($cb_content_select); ?>">

<?php
     // レイヤー画像コンテンツ　-------------------------------------------------------------
     if ($cb_content_select == 'layer_content') {

       if (!isset($value['show_content'])) { $value['show_content'] = 1; }

       if (!isset($value['show_layer_image'])) { $value['show_layer_image'] = 1; }

       if (!isset($value['image_layout_mobile'])) { $value['image_layout_mobile'] = 'type1'; }
       if (!isset($value['text_layout_mobile'])) { $value['text_layout_mobile'] = 'type2'; }

       if (!isset($value['catch'])) { $value['catch'] = ''; }
       if (!isset($value['catch_font_size'])) { $value['catch_font_size'] = '20'; }
       if (!isset($value['catch_font_type'])) { $value['catch_font_type'] = 'type2'; }
       if (!isset($value['catch_font_color'])) { $value['catch_font_color'] = '#ffffff'; }

       if (!isset($value['desc'])) { $value['desc'] = ''; }
       if (!isset($value['desc_font_size'])) { $value['desc_font_size'] = '14'; }
       if (!isset($value['desc_font_color'])) { $value['desc_font_color'] = '#ffffff'; }

       if (!isset($value['show_button'])) { $value['show_button'] = ''; }
       if (!isset($value['button_label'])) { $value['button_label'] = ''; }
       if (!isset($value['button_url'])) { $value['button_url'] = ''; }
       if (!isset($value['button_font_color'])) { $value['button_font_color'] = '#ffffff'; }
       if (!isset($value['button_bg_color'])) { $value['button_bg_color'] = '#008a98'; }
       if (!isset($value['button_border_color'])) { $value['button_border_color'] = '#008a98'; }
       if (!isset($value['button_border_color_opacity'])) { $value['button_border_color_opacity'] = '1'; }
       if (!isset($value['button_font_color_hover'])) { $value['button_font_color_hover'] = '#ffffff'; }
       if (!isset($value['button_bg_color_hover'])) { $value['button_bg_color_hover'] = '#006e7d'; }
       if (!isset($value['button_border_color_hover'])) { $value['button_border_color_hover'] = '#006e7d'; }
       if (!isset($value['button_border_color_hover_opacity'])) { $value['button_border_color_hover_opacity'] = '1'; }
       if (!isset($value['button_animation_type'])) { $value['button_animation_type'] = 'type1'; }
       if (!isset($value['button_target'])) { $value['button_target'] = ''; }

       if (!isset($value['bg_image'])) { $value['bg_image'] = 'false'; }
       if (!isset($value['bg_use_overlay'])) { $value['bg_use_overlay'] = ''; }
       if (!isset($value['bg_overlay_color'])) { $value['bg_overlay_color'] = '#000000'; }
       if (!isset($value['bg_overlay_opacity'])) { $value['bg_overlay_opacity'] = '0.3'; }

       if (!isset($value['image'])) { $value['image'] = 'false'; }
       if (!isset($value['animation_type'])) { $value['animation_type'] = 'type2'; }
?>

  <h3 class="cb_content_headline"><?php _e('Layer content', 'tcd-w'); ?></h3>
  <div class="cb_content">

   <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Display layer content', 'tcd-w'); ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>></li>
    <li class="cf"><span class="label"><?php _e('Use layer image', 'tcd-w'); ?></span><input class="show_layer_image" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_layer_image]" type="checkbox" value="1" <?php checked( $value['show_layer_image'], 1 ); ?>></li>
   </ul>

   <div class="layer_image_option">
    <h4 class="theme_option_headline2"><?php _e('Layer image', 'tcd-w'); ?></h4>
    <div class="theme_option_message2">
     <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '600', '600'); ?></p>
    </div>
    <div class="image_box cf">
     <div class="cf cf_media_field hide-if-no-js">
      <input type="hidden" class="cf_media_id" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][image]" id="image-<?php echo $cb_index; ?>" value="<?php echo esc_attr( $value['image'] ); ?>">
      <div class="preview_field"><?php if ( $value['image'] ) echo wp_get_attachment_image( $value['image'], 'medium' ); ?></div>
      <div class="buttton_area">
       <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
       <input type="button" class="cfmf-delete-img button<?php if ( ! $value['image'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
      </div>
     </div>
    </div>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
   <textarea class="full_width cb-repeater-label" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch]"><?php echo esc_textarea(  $value['catch'] ); ?></textarea>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch_font_size]" value="<?php esc_attr_e( $value['catch_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch_font_color]" value="<?php echo esc_attr( $value['catch_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
   <textarea class="large-text" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][desc_font_size]" value="<?php esc_attr_e( $value['desc_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][desc_font_color]" value="<?php echo esc_attr( $value['desc_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Button setting', 'tcd-w');  ?></h4>
   <p class="displayment_checkbox"><label><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_button]" type="checkbox" value="1" <?php checked( $value['show_button'], 1 ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
   <div style="<?php if($value['show_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('label', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_label]" value="<?php esc_attr_e( $value['button_label'] ); ?>" /></li>
     <li class="cf"><span class="label"><?php _e('URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_url]" value="<?php esc_attr_e( $value['button_url'] ); ?>" /></li>
     <li class="cf"><span class="label"><?php _e('Open link in new window', 'tcd-w'); ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_target]" type="checkbox" value="1" <?php checked( $value['button_target'], 1 ); ?>></li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_font_color]" value="<?php echo esc_attr( $value['button_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf cb_button_animation_type1"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_bg_color]" value="<?php echo esc_attr( $value['button_bg_color'] ); ?>" data-default-color="#008a98" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_border_color]" value="<?php echo esc_attr( $value['button_border_color'] ); ?>" data-default-color="#008a98" class="c-color-picker"></li>
     <li class="cf">
      <span class="label"><?php _e('Transparency of border', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_contents_builder][<?php echo esc_attr( $cb_index ); ?>][button_border_color_opacity]" value="<?php echo esc_attr( $value['button_border_color_opacity'] ); ?>" />
      <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
       <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
      </div>
     </li>
     <li class="cf"><span class="label"><?php _e('Font color of on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_font_color_hover]" value="<?php echo esc_attr( $value['button_font_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_bg_color_hover]" value="<?php echo esc_attr( $value['button_bg_color_hover'] ); ?>" data-default-color="#006e7d" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Border color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_border_color_hover]" value="<?php echo esc_attr( $value['button_border_color_hover'] ); ?>" data-default-color="#006e7d" class="c-color-picker"></li>
     <li class="cf">
      <span class="label"><?php _e('Transparency of border on mouseover', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_contents_builder][<?php echo esc_attr( $cb_index ); ?>][button_border_color_hover_opacity]" value="<?php echo esc_attr( $value['button_border_color_hover_opacity'] ); ?>" />
      <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
       <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
      </div>
     </li>
     <li class="cf"><span class="label"><?php _e('Hover effect', 'tcd-w');  ?></span>
      <select class="cb_button_animation" name="dp_options[mobile_contents_builder][<?php echo esc_attr($cb_index); ?>][button_animation_type]">
       <option style="padding-right: 10px;" value="type1" <?php selected( $value['button_animation_type'], 'type1' ); ?>><?php _e('No hover effect', 'tcd-w');  ?></option>
       <option style="padding-right: 10px;" value="type2" <?php selected( $value['button_animation_type'], 'type2' ); ?>><?php _e('Swipe animation', 'tcd-w');  ?></option>
       <option style="padding-right: 10px;" value="type3" <?php selected( $value['button_animation_type'], 'type3' ); ?>><?php _e('Diagonal swipe animation', 'tcd-w');  ?></option>
      </select>
     </li>
    </ul>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Display position setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf layer_image_option"><span class="label"><?php _e('Horizontal position of layer image', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo esc_attr($cb_index); ?>][image_layout_mobile]">
      <?php foreach ( $content_direction_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['image_layout_mobile'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php }; ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Position of text content', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo esc_attr($cb_index); ?>][text_layout_mobile]">
      <?php foreach ( $content_direction_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['text_layout_mobile'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
   </ul>

   <div class="layer_image_option">
    <h4 class="theme_option_headline2"><?php _e('Animation for layer image', 'tcd-w'); ?></h4>
    <select name="dp_options[mobile_contents_builder][<?php echo esc_attr( $cb_index ); ?>][animation_type]">
     <option style="padding-right: 10px;" value="type1" <?php selected( $value['animation_type'], 'type1' ); ?>><?php _e('No animation', 'tcd-w'); ?></option>
     <option style="padding-right: 10px;" value="type2" <?php selected( $value['animation_type'], 'type2' ); ?>><?php _e('Fade in', 'tcd-w'); ?></option>
     <option style="padding-right: 10px;" value="type3" <?php selected( $value['animation_type'], 'type3' ); ?>><?php _e('Slide in from left', 'tcd-w'); ?></option>
     <option style="padding-right: 10px;" value="type4" <?php selected( $value['animation_type'], 'type4' ); ?>><?php _e('Slide in from right', 'tcd-w'); ?></option>
    </select>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Background image', 'tcd-w'); ?></h4>
   <div class="theme_option_message2">
    <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '1200'); ?></p>
   </div>
   <div class="image_box cf">
    <div class="cf cf_media_field hide-if-no-js">
     <input type="hidden" class="cf_media_id" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][bg_image]" id="bg_image-<?php echo $cb_index; ?>" value="<?php echo esc_attr( $value['bg_image'] ); ?>">
     <div class="preview_field"><?php if ( $value['bg_image'] ) echo wp_get_attachment_image( $value['bg_image'], 'medium' ); ?></div>
     <div class="buttton_area">
      <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
      <input type="button" class="cfmf-delete-img button<?php if ( ! $value['bg_image'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
     </div>
    </div>
   </div>

   <h4 class="theme_option_headline2"><?php _e( 'Overlay setting for background image', 'tcd-w' ); ?></h4>
   <p class="displayment_checkbox"><label><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][bg_use_overlay]" type="checkbox" value="1" <?php checked( $value['bg_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
   <div style="<?php if($value['bg_use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][bg_overlay_color]" value="<?php echo esc_attr( $value['bg_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
     <li class="cf">
      <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][bg_overlay_opacity]" value="<?php echo esc_attr( $value['bg_overlay_opacity'] ); ?>" />
      <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
       <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
      </div>
     </li>
    </ul>
   </div>

<?php
     // 商品一覧　-------------------------------------------------------------
     } elseif ($cb_content_select == 'product_list') {

       if (!isset($value['show_content'])) { $value['show_content'] = 1; }

       if (!isset($value['catch'])) { $value['catch'] = ''; }
       if (!isset($value['catch_font_size'])) { $value['catch_font_size'] = '24'; }
       if (!isset($value['catch_font_type'])) { $value['catch_font_type'] = 'type3'; }

       if (!isset($value['desc'])) { $value['desc'] = ''; }
       if (!isset($value['desc_font_size'])) { $value['desc_font_size'] = '14'; }

       if (!isset($value['title_font_size'])) { $value['title_font_size'] = '18'; }
       if (!isset($value['title_font_type'])) { $value['title_font_type'] = 'type2'; }

       if (!isset($value['excerpt_font_size'])) { $value['excerpt_font_size'] = '14'; }

       if (!isset($value['show_button'])) { $value['show_button'] = ''; }
       if (!isset($value['button_label'])) { $value['button_label'] = ''; }
       if (!isset($value['button_font_color'])) { $value['button_font_color'] = '#ffffff'; }
       if (!isset($value['button_bg_color'])) { $value['button_bg_color'] = '#008a98'; }
       if (!isset($value['button_border_color'])) { $value['button_border_color'] = '#008a98'; }
       if (!isset($value['button_border_color_opacity'])) { $value['button_border_color_opacity'] = '1'; }
       if (!isset($value['button_font_color_hover'])) { $value['button_font_color_hover'] = '#ffffff'; }
       if (!isset($value['button_bg_color_hover'])) { $value['button_bg_color_hover'] = '#006e7d'; }
       if (!isset($value['button_border_color_hover'])) { $value['button_border_color_hover'] = '#006e7d'; }
       if (!isset($value['button_border_color_hover_opacity'])) { $value['button_border_color_hover_opacity'] = '1'; }
       if (!isset($value['button_animation_type'])) { $value['button_animation_type'] = 'type1'; }

       if (!isset($value['post_num'])) { $value['post_num'] = '6'; }

?>
  <h3 class="cb_content_headline"><?php printf(__('%s list', 'tcd-w'), $product_label); ?></h3>
  <div class="cb_content">

   <div class="theme_option_message2" style="margin-top:20px;">
    <p><?php printf(__('The image and description created in custom post type "%s" will be displayed.', 'tcd-w'), $product_label); ?></p>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php printf(__('Display %s list', 'tcd-w'), $product_label); ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
   <textarea class="full_width cb-repeater-label" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch]"><?php echo esc_textarea(  $value['catch'] ); ?></textarea>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch_font_size]" value="<?php esc_attr_e( $value['catch_font_size'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
   <textarea class="large-text" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][desc_font_size]" value="<?php esc_attr_e( $value['desc_font_size'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php printf(__('%s list setting', 'tcd-w'), $product_label); ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php printf(__('Number of %s to display', 'tcd-w'), $product_label); ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][post_num]">
      <option style="padding-right: 10px;" value="-1" <?php selected( $value['post_num'], '-1' ); ?>><?php _e('Display all', 'tcd-w');  ?></option>
      <?php for($post_num=3; $post_num<= 15; $post_num++): ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($post_num); ?>" <?php selected( $value['post_num'], $post_num ); ?>><?php echo esc_html($post_num); ?></option>
      <?php endfor; ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font type of title', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][title_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['title_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][title_font_size]" value="<?php esc_attr_e( $value['title_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of excerpt', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][excerpt_font_size]" value="<?php esc_attr_e( $value['excerpt_font_size'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Archive page button setting', 'tcd-w');  ?></h4>
   <p class="displayment_checkbox"><label><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_button]" type="checkbox" value="1" <?php checked( $value['show_button'], 1 ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
   <div style="<?php if($value['show_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('label', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_label]" value="<?php esc_attr_e( $value['button_label'] ); ?>" /></li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_font_color]" value="<?php echo esc_attr( $value['button_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf cb_button_animation_type1"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_bg_color]" value="<?php echo esc_attr( $value['button_bg_color'] ); ?>" data-default-color="#008a98" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_border_color]" value="<?php echo esc_attr( $value['button_border_color'] ); ?>" data-default-color="#008a98" class="c-color-picker"></li>
     <li class="cf">
      <span class="label"><?php _e('Transparency of border', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_contents_builder][<?php echo esc_attr( $cb_index ); ?>][button_border_color_opacity]" value="<?php echo esc_attr( $value['button_border_color_opacity'] ); ?>" />
      <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
       <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
      </div>
     </li>
     <li class="cf"><span class="label"><?php _e('Font color of on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_font_color_hover]" value="<?php echo esc_attr( $value['button_font_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_bg_color_hover]" value="<?php echo esc_attr( $value['button_bg_color_hover'] ); ?>" data-default-color="#006e7d" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Border color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_border_color_hover]" value="<?php echo esc_attr( $value['button_border_color_hover'] ); ?>" data-default-color="#006e7d" class="c-color-picker"></li>
     <li class="cf">
      <span class="label"><?php _e('Transparency of border on mouseover', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_contents_builder][<?php echo esc_attr( $cb_index ); ?>][button_border_color_hover_opacity]" value="<?php echo esc_attr( $value['button_border_color_hover_opacity'] ); ?>" />
      <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
       <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
      </div>
     </li>
     <li class="cf"><span class="label"><?php _e('Hover effect', 'tcd-w');  ?></span>
      <select class="cb_button_animation" name="dp_options[mobile_contents_builder][<?php echo esc_attr($cb_index); ?>][button_animation_type]">
       <option style="padding-right: 10px;" value="type1" <?php selected( $value['button_animation_type'], 'type1' ); ?>><?php _e('No hover effect', 'tcd-w');  ?></option>
       <option style="padding-right: 10px;" value="type2" <?php selected( $value['button_animation_type'], 'type2' ); ?>><?php _e('Swipe animation', 'tcd-w');  ?></option>
       <option style="padding-right: 10px;" value="type3" <?php selected( $value['button_animation_type'], 'type3' ); ?>><?php _e('Diagonal swipe animation', 'tcd-w');  ?></option>
      </select>
     </li>
    </ul>
   </div>

<?php
     // 記事カルーセル　-------------------------------------------------------------
     } elseif ($cb_content_select == 'post_slider') {

       if (!isset($value['show_content'])) { $value['show_content'] = 1; }

       if (!isset($value['background_color'])) { $value['background_color'] = '#f4f4f4'; }

       if (!isset($value['catch'])) { $value['catch'] = ''; }
       if (!isset($value['catch_font_size'])) { $value['catch_font_size'] = '24'; }
       if (!isset($value['catch_font_type'])) { $value['catch_font_type'] = 'type3'; }

       if (!isset($value['desc'])) { $value['desc'] = ''; }
       if (!isset($value['desc_font_size'])) { $value['desc_font_size'] = '14'; }

       if (!isset($value['post_type'])) { $value['post_type'] = 'post'; }
       if (!isset($value['post_num'])) { $value['post_num'] = '6'; }
       if (!isset($value['post_order'])) { $value['post_order'] = 'date'; }
       if (!isset($value['slider_time'])) { $value['slider_time'] = 5000; }

       if (!isset($value['show_date'])) { $value['show_date'] = 1; }
       if (!isset($value['show_category'])) { $value['show_category'] = 1; }

       if (!isset($value['title_font_size'])) { $value['title_font_size'] = '15'; }
       if (!isset($value['title_font_color'])) { $value['title_font_color'] = '#2c8a95'; }
       if (!isset($value['title_font_type'])) { $value['title_font_type'] = 'type2'; }

       if (!isset($value['excerpt_font_size'])) { $value['excerpt_font_size'] = '14'; }

       if (!isset($value['show_button'])) { $value['show_button'] = ''; }
       if (!isset($value['button_label'])) { $value['button_label'] = ''; }
       if (!isset($value['button_font_color'])) { $value['button_font_color'] = '#ffffff'; }
       if (!isset($value['button_bg_color'])) { $value['button_bg_color'] = '#008a98'; }
       if (!isset($value['button_border_color'])) { $value['button_border_color'] = '#008a98'; }
       if (!isset($value['button_border_color_opacity'])) { $value['button_border_color_opacity'] = '1'; }
       if (!isset($value['button_font_color_hover'])) { $value['button_font_color_hover'] = '#ffffff'; }
       if (!isset($value['button_bg_color_hover'])) { $value['button_bg_color_hover'] = '#006e7d'; }
       if (!isset($value['button_border_color_hover'])) { $value['button_border_color_hover'] = '#006e7d'; }
       if (!isset($value['button_border_color_hover_opacity'])) { $value['button_border_color_hover_opacity'] = '1'; }
       if (!isset($value['button_animation_type'])) { $value['button_animation_type'] = 'type1'; }

?>
  <h3 class="cb_content_headline"><?php _e('Post carousel', 'tcd-w'); ?></h3>
  <div class="cb_content">

   <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Display post carousel', 'tcd-w'); ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Background color', 'tcd-w'); ?></h4>
   <input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][background_color]" value="<?php echo esc_attr($value['background_color']); ?>" data-default-color="#f4f4f4" class="c-color-picker" />

   <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
   <textarea class="full_width cb-repeater-label" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch]"><?php echo esc_textarea(  $value['catch'] ); ?></textarea>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch_font_size]" value="<?php esc_attr_e( $value['catch_font_size'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
   <textarea class="large-text" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][desc_font_size]" value="<?php esc_attr_e( $value['desc_font_size'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Carousel setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Post type', 'tcd-w'); ?></span>
     <select class="post_type" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][post_type]">
      <option style="padding-right: 10px;" value="post" <?php selected( $value['post_type'], 'post' ); ?>><?php _e('Blog', 'tcd-w'); ?></option>
      <option style="padding-right: 10px;" value="news" <?php selected( $value['post_type'], 'news' ); ?>><?php echo esc_html($news_label); ?></option>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Post order', 'tcd-w'); ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][post_order]">
      <option style="padding-right: 10px;" value="date" <?php selected( $value['post_order'], 'date' ); ?>><?php _e('Date', 'tcd-w');  ?></option>
      <option style="padding-right: 10px;" value="rand" <?php selected( $value['post_order'], 'rand' ); ?>><?php _e('Random', 'tcd-w');  ?></option>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][post_num]">
      <?php for($post_num=3; $post_num<= 10; $post_num++): ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($post_num); ?>" <?php selected( $value['post_num'], $post_num ); ?>><?php echo esc_html($post_num); ?></option>
      <?php endfor; ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Carousel speed', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][slider_time]">
      <?php
           $time = 1;
           foreach ( $time_options as $option ):
             if( $time >= 2 && $time <= 10 ){
      ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $value['slider_time'], $option['value'] ); ?>><?php echo esc_html($option['label']); ?></option>
      <?php
             }
             $time++;
          endforeach;
      ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font type of title', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][title_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['title_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][title_font_size]" value="<?php esc_attr_e( $value['title_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font color of title', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][title_font_color]" value="<?php echo esc_attr( $value['title_font_color'] ); ?>" data-default-color="#2c8a95" class="c-color-picker"></li>
    <li class="cf"><span class="label"><?php _e('Font size of excerpt', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][excerpt_font_size]" value="<?php esc_attr_e( $value['excerpt_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w'); ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_date]" type="checkbox" value="1" <?php checked( $value['show_date'], 1 ); ?>></li>
    <li class="cf"><span class="label"><?php _e('Display category', 'tcd-w'); ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_category]" type="checkbox" value="1" <?php checked( $value['show_category'], 1 ); ?>></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Archive page button setting', 'tcd-w');  ?></h4>
   <p class="displayment_checkbox"><label><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_button]" type="checkbox" value="1" <?php checked( $value['show_button'], 1 ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
   <div style="<?php if($value['show_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('label', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_label]" value="<?php esc_attr_e( $value['button_label'] ); ?>" /></li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_font_color]" value="<?php echo esc_attr( $value['button_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf cb_button_animation_type1"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_bg_color]" value="<?php echo esc_attr( $value['button_bg_color'] ); ?>" data-default-color="#008a98" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_border_color]" value="<?php echo esc_attr( $value['button_border_color'] ); ?>" data-default-color="#008a98" class="c-color-picker"></li>
     <li class="cf">
      <span class="label"><?php _e('Transparency of border', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_contents_builder][<?php echo esc_attr( $cb_index ); ?>][button_border_color_opacity]" value="<?php echo esc_attr( $value['button_border_color_opacity'] ); ?>" />
      <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
       <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
      </div>
     </li>
     <li class="cf"><span class="label"><?php _e('Font color of on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_font_color_hover]" value="<?php echo esc_attr( $value['button_font_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_bg_color_hover]" value="<?php echo esc_attr( $value['button_bg_color_hover'] ); ?>" data-default-color="#006e7d" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Border color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][button_border_color_hover]" value="<?php echo esc_attr( $value['button_border_color_hover'] ); ?>" data-default-color="#006e7d" class="c-color-picker"></li>
     <li class="cf">
      <span class="label"><?php _e('Transparency of border on mouseover', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mobile_contents_builder][<?php echo esc_attr( $cb_index ); ?>][button_border_color_hover_opacity]" value="<?php echo esc_attr( $value['button_border_color_hover_opacity'] ); ?>" />
      <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
       <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
      </div>
     </li>
     <li class="cf"><span class="label"><?php _e('Hover effect', 'tcd-w');  ?></span>
      <select class="cb_button_animation" name="dp_options[mobile_contents_builder][<?php echo esc_attr($cb_index); ?>][button_animation_type]">
       <option style="padding-right: 10px;" value="type1" <?php selected( $value['button_animation_type'], 'type1' ); ?>><?php _e('No hover effect', 'tcd-w');  ?></option>
       <option style="padding-right: 10px;" value="type2" <?php selected( $value['button_animation_type'], 'type2' ); ?>><?php _e('Swipe animation', 'tcd-w');  ?></option>
       <option style="padding-right: 10px;" value="type3" <?php selected( $value['button_animation_type'], 'type3' ); ?>><?php _e('Diagonal swipe animation', 'tcd-w');  ?></option>
      </select>
     </li>
    </ul>
   </div>

<?php
     // 自由入力欄　-------------------------------------------------------------
     } elseif ($cb_content_select == 'free_space') {

       if (!isset($value['show_content'])) { $value['show_content'] = 1; }

       if (!isset($value['free_space'])) {
         $value['free_space'] = '';
       }

       if (!isset($value['catch'])) { $value['catch'] = ''; }
       if (!isset($value['catch_font_size'])) { $value['catch_font_size'] = '24'; }
       if (!isset($value['catch_font_type'])) { $value['catch_font_type'] = 'type3'; }

       if (!isset($value['padding_top'])) { $value['padding_top'] = '30'; }
       if (!isset($value['padding_bottom'])) { $value['padding_bottom'] = '30'; }

       if (!isset($value['content_width'])) { $value['content_width'] = 'type1'; }
       if (!isset($value['desc_font_size'])) { $value['desc_font_size'] = '14'; }

?>
  <h3 class="cb_content_headline"><?php _e('Free space', 'tcd-w');  ?></h3>
  <div class="cb_content">

   <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Display free space', 'tcd-w'); ?></span><input name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Content width', 'tcd-w'); ?></h4>
   <ul class="design_radio_button">
    <li>
     <input type="radio" id="content_width_<?php echo $cb_index; ?>_type1" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][content_width]" value="type1" <?php checked( $value['content_width'], 'type1' ); ?> />
     <label for="content_width_<?php echo $cb_index; ?>_type1"><?php _e('Same as content width', 'tcd-w'); ?></label>
    </li>
    <li>
     <input type="radio" id="content_width_<?php echo $cb_index; ?>_type2" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][content_width]" value="type2" <?php checked( $value['content_width'], 'type2' ); ?> />
     <label for="content_width_<?php echo $cb_index; ?>_type2"><?php _e('100% width (no space on left and right)', 'tcd-w'); ?></label>
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
   <textarea class="full_width cb-repeater-label" cols="50" rows="3" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch]"><?php echo esc_textarea(  $value['catch'] ); ?></textarea>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][catch_font_size]" value="<?php esc_attr_e( $value['catch_font_size'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Free space', 'tcd-w');  ?></h4>
   <?php
        wp_editor(
          $value['free_space'],
          'cb_wysiwyg_editor-' . $cb_index,
          array (
            'textarea_name' => 'dp_options[mobile_contents_builder][' . $cb_index . '][free_space]'
          )
       );
   ?>

   <h4 class="theme_option_headline2"><?php _e('Space setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Margin top', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][padding_top]" value="<?php esc_attr_e( $value['padding_top'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Margin bottom', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][padding_bottom]" value="<?php esc_attr_e( $value['padding_bottom'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Font size setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mobile_contents_builder][<?php echo $cb_index; ?>][desc_font_size]" value="<?php esc_attr_e( $value['desc_font_size'] ); ?>" /><span>px</span></li>
   </ul>

<?php
     // ボタンの表示　-------------------------------------------------------------
     } else {
?>
  <h3 class="cb_content_headline"><?php echo esc_html($cb_content_select); ?></h3>
  <div class="cb_content">

<?php
     }
?>

   <ul class="button_list cf">
    <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>

  </div><!-- END .cb_content -->

</div><!-- END .cb_content_wrap -->

<?php

} // END mobile_the_cb_content_setting()

?>