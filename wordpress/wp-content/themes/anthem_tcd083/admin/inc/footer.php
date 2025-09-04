<?php
/*
 * フッターの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_footer_dp_default_options' );


// Add label of footer tab
add_action( 'tcd_tab_labels', 'add_footer_tab_label' );


// Add HTML of footer tab
add_action( 'tcd_tab_panel', 'add_footer_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_footer_theme_options_validate' );


// タブの名前
function add_footer_tab_label( $tab_labels ) {
	$tab_labels['footer'] = __( 'Footer', 'tcd-w' );
	return $tab_labels;
}


// 初期値
function add_footer_dp_default_options( $dp_default_options ) {

	// カルーセル設定
	$dp_default_options['show_footer_carousel'] = '1';
	$dp_default_options['footer_carousel_headline'] = __( 'Featured post', 'tcd-w' );
	$dp_default_options['footer_carousel_headline_font_color'] = '#ffffff';
	$dp_default_options['footer_carousel_type'] = 'all_post';
	$dp_default_options['footer_carousel_order'] = 'rand';
	$dp_default_options['show_footer_carousel_icon'] = '1';
	$dp_default_options['footer_bg_image'] = false;
	$dp_default_options['footer_bg_image_mobile'] = false;
	$dp_default_options['footer_bg_use_overlay'] = 1;
	$dp_default_options['footer_bg_overlay_color'] = '#000000';
	$dp_default_options['footer_bg_overlay_opacity'] = '0.3';
	$dp_default_options['footer_carousel_num'] = '6';
	$dp_default_options['footer_carousel_title_font_type'] = 'type2';
	$dp_default_options['footer_carousel_title_font_size'] = '18';
	$dp_default_options['footer_carousel_title_font_size_mobile'] = '15';
	$dp_default_options['footer_carousel_time'] = '5000';

  //記事一覧
	$dp_default_options['show_footer_post_list'] = '1';
	$dp_default_options['footer_post_list_type'] = 'recent_post';
	$dp_default_options['footer_post_list_order'] = 'normal';
	$dp_default_options['footer_post_list_bg_color'] = '#000000';
	$dp_default_options['footer_post_list_title_font_color'] = '#ffffff';
	$dp_default_options['footer_post_list_title_bg_color'] = '#222222';

  //コピーライト
	$dp_default_options['copyright'] = 'Copyright &copy; 2020';
	$dp_default_options['copyright_font_color'] = '#ffffff';
	$dp_default_options['copyright_bg_color'] = '#000000';

  //ページ上部へ戻るリンク
	$dp_default_options['return_top_font_color'] = '#ffffff';
	$dp_default_options['return_top_bg_color'] = '#008a98';
	$dp_default_options['return_top_bg_color_hover'] = '#006e7d';

	// フッターの固定メニュー
	$dp_default_options['footer_bar_display'] = 'type3';
	$dp_default_options['footer_bar_font_color'] = '#ffffff';
	$dp_default_options['footer_bar_bg_color'] = '#000000';
	$dp_default_options['footer_bar_bg_color_hover'] = '#333333';
	$dp_default_options['footer_bar_border_color'] = '#ffffff';
	$dp_default_options['footer_bar_border_color_opacity'] = 0.2;
	$dp_default_options['footer_bar_btns'] = array();

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_footer_tab_panel( $options ) {

  global $dp_default_options, $footer_bar_display_options, $footer_bar_button_options, $footer_bar_icon_options, $font_type_options, $time_options;
  $blog_label = __( 'Blog', 'tcd-w' );
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-w' );
  $product_label = $options['product_label'] ? esc_html( $options['product_label'] ) : __( 'Product', 'tcd-w' );

?>

<div id="tab-content-footer" class="tab-content">


   <?php // カルーセルの設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Carousel setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <p class="displayment_checkbox"><label><input name="dp_options[show_footer_carousel]" type="checkbox" value="1" <?php checked( $options['show_footer_carousel'], 1 ); ?>><?php _e( 'Display carousel', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['show_footer_carousel'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Basic setting', 'tcd-w'); ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php printf(__('%s type', 'tcd-w'), $product_label); ?></span>
        <select class="post_type" name="dp_options[footer_carousel_type]">
         <option style="padding-right: 10px;" value="all_post" <?php selected( $options['footer_carousel_type'], 'all_post' ); ?>><?php printf(__('All %s', 'tcd-w'), $product_label); ?></option>
         <option style="padding-right: 10px;" value="recommend_post" <?php selected( $options['footer_carousel_type'], 'recommend_post' ); ?>><?php printf(__('Recommend %s', 'tcd-w'), $product_label); ?></option>
         <option style="padding-right: 10px;" value="featured_post" <?php selected( $options['footer_carousel_type'], 'featured_post' ); ?>><?php printf(__('Featured %s', 'tcd-w'), $product_label); ?></option>
        </select>
       </li>
       <li class="cf"><span class="label"><?php printf(__('%s order', 'tcd-w'), $product_label);  ?></span>
        <select name="dp_options[footer_carousel_order]">
         <option style="padding-right: 10px;" value="menu_order" <?php selected( $options['footer_carousel_order'], 'menu_order' ); ?>><?php _e('Admin order', 'tcd-w');  ?></option>
         <option style="padding-right: 10px;" value="rand" <?php selected( $options['footer_carousel_order'], 'rand' ); ?>><?php _e('Random', 'tcd-w');  ?></option>
        </select>
       </li>
       <li class="cf">
        <span class="label"><?php printf(__('Number of %s to display', 'tcd-w'), $product_label); ?></span>
        <select name="dp_options[footer_carousel_num]">
         <?php for($i=4; $i<= 10; $i++): ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['footer_carousel_num'], $i ); ?>><?php echo esc_html($i); ?></option>
         <?php endfor; ?>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_carousel_headline]" value="<?php esc_attr_e( $options['footer_carousel_headline'] ); ?>" /></li>
       <li class="cf"><span class="label"><?php _e('Font color of headline', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_carousel_headline_font_color]" value="<?php echo esc_attr( $options['footer_carousel_headline_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Font type of title', 'tcd-w');  ?></span>
        <select name="dp_options[footer_carousel_title_font_type]">
         <?php foreach ( $font_type_options as $option ) { ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['footer_carousel_title_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
         <?php } ?>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[footer_carousel_title_font_size]" value="<?php esc_attr_e( $options['footer_carousel_title_font_size'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font size of title (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[footer_carousel_title_font_size_mobile]" value="<?php esc_attr_e( $options['footer_carousel_title_font_size_mobile'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Display featured icon', 'tcd-w'); ?></span><input name="dp_options[show_footer_carousel_icon]" type="checkbox" value="1" <?php checked( $options['show_footer_carousel_icon'], 1 ); ?>></li>
       <li class="cf"><span class="label"><?php _e('Carousel speed', 'tcd-w');  ?></span>
        <select name="dp_options[footer_carousel_time]">
         <?php
              $i = 1;
              foreach ( $time_options as $option ):
                if( $i >= 4 && $i <= 10 ){
         ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $options['footer_carousel_time'], $option['value'] ); ?>><?php echo esc_html($option['label']); ?></option>
         <?php
                }
                $i++;
            endforeach;
         ?>
        </select>
       </li>
      </ul>
      <h4 class="theme_option_headline2"><?php _e('Background image', 'tcd-w'); ?></h4>
      <div class="theme_option_message2">
       <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '400'); ?></p>
      </div>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js footer_bg_image">
        <input type="hidden" value="<?php echo esc_attr( $options['footer_bg_image'] ); ?>" id="footer_bg_image" name="dp_options[footer_bg_image]" class="cf_media_id">
        <div class="preview_field"><?php if($options['footer_bg_image']){ echo wp_get_attachment_image($options['footer_bg_image'], 'medium'); }; ?></div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
         <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['footer_bg_image']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>
      <h4 class="theme_option_headline2"><?php _e('Background image (mobile)', 'tcd-w'); ?></h4>
      <div class="theme_option_message2">
       <p><?php echo __('Please use this option if you want to change background image in mobile device.', 'tcd-w'); ?></p>
       <p><?php printf(__('Recommended size assuming for retina display. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '1100'); ?></p>
      </div>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js footer_bg_image_mobile">
        <input type="hidden" value="<?php echo esc_attr( $options['footer_bg_image_mobile'] ); ?>" id="footer_bg_image_mobile" name="dp_options[footer_bg_image_mobile]" class="cf_media_id">
        <div class="preview_field"><?php if($options['footer_bg_image_mobile']){ echo wp_get_attachment_image($options['footer_bg_image_mobile'], 'medium'); }; ?></div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
         <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['footer_bg_image_mobile']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>
      <h4 class="theme_option_headline2"><?php _e( 'Overlay setting for background', 'tcd-w' ); ?></h4>
      <p class="displayment_checkbox"><label><input name="dp_options[footer_bg_use_overlay]" type="checkbox" value="1" <?php checked( $options['footer_bg_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
      <div style="<?php if($options['footer_bg_use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
        <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_bg_overlay_color]" value="<?php echo esc_attr( $options['footer_bg_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
        <li class="cf">
         <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[footer_bg_overlay_opacity]" value="<?php echo esc_attr( $options['footer_bg_overlay_opacity'] ); ?>" />
         <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
          <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
         </div>
        </li>
       </ul>
      </div>
     </div>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 記事一覧の設定 ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Post list setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <p class="displayment_checkbox"><label><input name="dp_options[show_footer_post_list]" type="checkbox" value="1" <?php checked( $options['show_footer_post_list'], 1 ); ?>><?php _e( 'Display post list', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['show_footer_post_list'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Post type', 'tcd-w'); ?></span>
        <select class="post_type" name="dp_options[footer_post_list_type]">
         <option style="padding-right: 10px;" value="recent_post" <?php selected( $options['footer_post_list_type'], 'recent_post' ); ?>><?php _e('All post', 'tcd-w'); ?></option>
         <option style="padding-right: 10px;" value="recommend_post" <?php selected( $options['footer_post_list_type'], 'recomment_post' ); ?>><?php _e('Recommend post1', 'tcd-w'); ?></option>
         <option style="padding-right: 10px;" value="recommend_post2" <?php selected( $options['footer_post_list_type'], 'recomment_post2' ); ?>><?php _e('Recommend post2', 'tcd-w'); ?></option>
         <option style="padding-right: 10px;" value="featured_post" <?php selected( $options['footer_post_list_type'], 'featured_post' ); ?>><?php _e('Featured post', 'tcd-w'); ?></option>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Post order', 'tcd-w');  ?></span>
        <select name="dp_options[footer_post_list_order]">
         <option style="padding-right: 10px;" value="date" <?php selected( $options['footer_post_list_order'], 'date' ); ?>><?php _e('Date', 'tcd-w');  ?></option>
         <option style="padding-right: 10px;" value="rand" <?php selected( $options['footer_post_list_order'], 'rand' ); ?>><?php _e('Random', 'tcd-w');  ?></option>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Background color of post list', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_post_list_bg_color]" value="<?php echo esc_attr( $options['footer_post_list_bg_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Font color of title', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_post_list_title_font_color]" value="<?php echo esc_attr( $options['footer_post_list_title_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Background color of title', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_post_list_title_bg_color]" value="<?php echo esc_attr( $options['footer_post_list_title_bg_color'] ); ?>" data-default-color="#222222" class="c-color-picker"></li>
      </ul>
     </div>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ページ上部へ戻るリンクの設定 ------------------------------------------------------------ ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Return top link button setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <h4 class="theme_option_headline2"><?php _e('Color setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[return_top_font_color]" value="<?php echo esc_attr( $options['return_top_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[return_top_bg_color]" value="<?php echo esc_attr( $options['return_top_bg_color'] ); ?>" data-default-color="#008a98" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[return_top_bg_color_hover]" value="<?php echo esc_attr( $options['return_top_bg_color_hover'] ); ?>" data-default-color="#006e7d" class="c-color-picker"></li>
     </ul>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // コピーライトの設定 ------------------------------------------------------------ ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Copyright setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <input class="regular-text" type="text" name="dp_options[copyright]" value="<?php echo esc_attr($options['copyright']); ?>" />
     <h4 class="theme_option_headline2"><?php _e('Color setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[copyright_font_color]" value="<?php echo esc_attr( $options['copyright_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[copyright_bg_color]" value="<?php echo esc_attr( $options['copyright_bg_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
     </ul>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // フッターバーの設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e( 'Footer bar setting (mobile device only)', 'tcd-w' ); ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p><?php _e( 'Footer bar will only be displayed at mobile device.', 'tcd-w' ); ?>
     </div>
     <h4 class="theme_option_headline2"><?php _e('Display type of the footer bar', 'tcd-w'); ?></h4>
     <ul class="design_radio_button">
      <?php foreach ( $footer_bar_display_options as $option ) { ?>
      <li>
       <input type="radio" id="footer_bar_display_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[footer_bar_display]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['footer_bar_display'], $option['value'] ); ?> />
       <label for="footer_bar_display_<?php esc_attr_e( $option['value'] ); ?>"><?php echo $option['label']; ?></label>
      </li>
      <?php } ?>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Settings for the appearance of the footer bar', 'tcd-w'); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_bar_font_color]" value="<?php echo esc_attr( $options['footer_bar_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_bar_bg_color]" value="<?php echo esc_attr( $options['footer_bar_bg_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_bar_bg_color_hover]" value="<?php echo esc_attr( $options['footer_bar_bg_color_hover'] ); ?>" data-default-color="#333333" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_bar_border_color]" value="<?php echo esc_attr( $options['footer_bar_border_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><?php _e('Opacity of border', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[footer_bar_border_color_opacity]" value="<?php echo esc_attr( $options['footer_bar_border_color_opacity'] ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?><br><?php _e('Please enter 0 if you don\'t want to display border.', 'tcd-w');  ?></p>
       </div>
      </li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Settings for the contents of the footer bar', 'tcd-w'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'You can display the button with icon in footer bar. (We recommend you to set max 4 buttons.)', 'tcd-w' ); ?><br><?php _e( 'You can select button types below.', 'tcd-w' ); ?></p>
     </div>
     <table class="table-border">
      <tr>
       <th><?php _e( 'Default', 'tcd-w' ); ?></th>
       <td><?php _e( 'You can set link URL.', 'tcd-w' ); ?></td>
      </tr>
      <tr>
       <th><?php _e( 'Share', 'tcd-w' ); ?></th>
       <td><?php _e( 'Share buttons are displayed if you tap this button.', 'tcd-w' ); ?></td>
      </tr>
      <tr>
       <th><?php _e( 'Telephone', 'tcd-w' ); ?></th>
       <td><?php _e( 'You can call this number.', 'tcd-w' ); ?></td>
      </tr>
     </table>
     <p><?php _e( 'Click "Add item", and set the button for footer bar. You can drag the item to change their order.', 'tcd-w' ); ?></p>
     <div class="repeater-wrapper">
      <input type="hidden" name="dp_options[footer_bar_btns]" value="">
      <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
       <?php
            if ( $options['footer_bar_btns'] ) :
              foreach ( $options['footer_bar_btns'] as $key => $value ) :  
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
        <h4 class="theme_option_subbox_headline"><?php echo esc_attr( $value['label'] ); ?></h4>
        <div class="sub_box_content">
         <ul class="option_list footer-bar-type">
          <li class="cf footer-bar-target" style="<?php if ( $value['type'] !== 'type1' ) { echo 'display: none;'; } ?>"><span class="label"><?php _e('Open with new window', 'tcd-w'); ?></span><input name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>></li>
          <li class="cf">
           <span class="label"><?php _e('Button type', 'tcd-w'); ?></span>
           <select name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][type]">
            <?php foreach( $footer_bar_button_options as $option ) : ?>
            <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $value['type'], $option['value'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></option>
            <?php endforeach; ?>
           </select>
          </li>
          <li class="cf"><span class="label"><?php _e('Button label', 'tcd-w'); ?></span><input class="full_width repeater-label" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][label]" value="<?php echo esc_attr( $value['label'] ); ?>"></li>
          <li class="cf footer-bar-url" style="<?php if ( $value['type'] !== 'type1' ) { echo 'display: none;'; } ?>"><span class="label"><?php _e('Link URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][url]" value="<?php echo esc_attr( $value['url'] ); ?>"></li>
          <li class="cf footer-bar-number" style="<?php if ( $value['type'] !== 'type3' ) { echo 'display: none;'; } ?>"><span class="label"><?php _e('Phone number', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][number]" value="<?php echo esc_attr( $value['number'] ); ?>"></li>
          <li class="cf">
           <span class="label"><?php _e('Button icon', 'tcd-w'); ?></span>
           <ul class="footer_bar_icon_type cf">
            <?php foreach( $footer_bar_icon_options as $option ) : ?>
            <li><label><input type="radio" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="<?php echo esc_attr($option['value']); ?>" <?php checked( $option['value'], $value['icon'] ); ?>><span class="icon icon-<?php echo esc_attr($option['value']); ?>"></span></label></li>
            <?php endforeach; ?>
           </ul>
          </li>
         </ul>
         <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
        </div>
       </div>
       <?php
              endforeach;
            endif;
            $key = 'addindex';
            $value = array(
              'type' => 'type1',
              'label' => '',
              'url' => '',
              'number' => '',
              'target' => 0,
              'icon' => 'twitter'
            );
            ob_start();
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
        <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-w' ); ?></h4>
        <div class="sub_box_content">
         <ul class="option_list footer-bar-type">
          <li class="cf">
           <span class="label"><?php _e('Button type', 'tcd-w'); ?></span>
           <select name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][type]">
            <?php foreach( $footer_bar_button_options as $option ) : ?>
            <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $value['type'], $option['value'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></option>
            <?php endforeach; ?>
           </select>
          </li>
          <li class="cf"><span class="label"><?php _e('Button label', 'tcd-w'); ?></span><input class="full_width repeater-label" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][label]" value=""></li>
          <li class="cf footer-bar-url"><span class="label"><?php _e('Link URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][url]" value=""></li>
          <li class="cf footer-bar-target"><span class="label"><?php _e('Open with new window', 'tcd-w'); ?></span><input name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>></li>
          <li class="cf footer-bar-number" style="display:none;"><span class="label"><?php _e('Phone number', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][number]" value=""></li>
          <li class="cf">
           <span class="label"><?php _e('Button icon', 'tcd-w'); ?></span>
           <ul class="footer_bar_icon_type cf">
            <?php foreach( $footer_bar_icon_options as $option ) : ?>
            <li><label><input type="radio" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="<?php echo esc_attr($option['value']); ?>" <?php checked( $option['value'], $value['icon'] ); ?>><span class="icon icon-<?php echo esc_attr($option['value']); ?>"></span></label></li>
            <?php endforeach; ?>
           </ul>
          </li>
         </ul>
         <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
        </div>
       </div>
       <?php
            $clone = ob_get_clean();
       ?>
      </div><!-- END .repeater -->
      <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add item', 'tcd-w' ); ?></a>
     </div><!-- END .repeater-wrapper -->
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_footer_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_footer_theme_options_validate( $input ) {

  global $dp_default_options, $footer_bar_display_options, $footer_bar_button_options, $footer_bar_icon_options, $font_type_options, $time_options;

  // カルーセル設定
  $input['show_footer_carousel'] = ! empty( $input['show_footer_carousel'] ) ? 1 : 0;
  $input['show_footer_carousel_icon'] = ! empty( $input['show_footer_carousel_icon'] ) ? 1 : 0;
  $input['footer_carousel_type'] = wp_filter_nohtml_kses( $input['footer_carousel_type'] );
  $input['footer_carousel_order'] = wp_filter_nohtml_kses( $input['footer_carousel_order'] );
  $input['footer_bg_image'] = wp_filter_nohtml_kses( $input['footer_bg_image'] );
  $input['footer_bg_image_mobile'] = wp_filter_nohtml_kses( $input['footer_bg_image_mobile'] );
  $input['footer_bg_use_overlay'] = ! empty( $input['footer_bg_use_overlay'] ) ? 1 : 0;
  $input['footer_bg_overlay_color'] = wp_filter_nohtml_kses( $input['footer_bg_overlay_color'] );
  $input['footer_bg_overlay_opacity'] = wp_filter_nohtml_kses( $input['footer_bg_overlay_opacity'] );
  $input['footer_carousel_num'] = wp_filter_nohtml_kses( $input['footer_carousel_num'] );
  $input['footer_carousel_headline'] = wp_filter_nohtml_kses( $input['footer_carousel_headline'] );
  $input['footer_carousel_headline_font_color'] = wp_filter_nohtml_kses( $input['footer_carousel_headline_font_color'] );
  if ( ! isset( $value['footer_carousel_title_font_type'] ) )
    $value['footer_carousel_title_font_type'] = null;
  if ( ! array_key_exists( $value['footer_carousel_title_font_type'], $font_type_options ) )
    $value['footer_carousel_title_font_type'] = null;
  $input['footer_carousel_title_font_size'] = wp_filter_nohtml_kses( $input['footer_carousel_title_font_size'] );
  $input['footer_carousel_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['footer_carousel_title_font_size_mobile'] );
  $input['footer_carousel_time'] = wp_filter_nohtml_kses( $input['footer_carousel_time'] );


  // 記事一覧の設定
  $input['show_footer_post_list'] = ! empty( $input['show_footer_post_list'] ) ? 1 : 0;
  $input['footer_post_list_type'] = wp_filter_nohtml_kses( $input['footer_post_list_type'] );
  $input['footer_post_list_order'] = wp_filter_nohtml_kses( $input['footer_post_list_order'] );
  $input['footer_post_list_bg_color'] = wp_filter_nohtml_kses( $input['footer_post_list_bg_color'] );
  $input['footer_post_list_title_font_color'] = wp_filter_nohtml_kses( $input['footer_post_list_title_font_color'] );
  $input['footer_post_list_title_bg_color'] = wp_filter_nohtml_kses( $input['footer_post_list_title_bg_color'] );


  // ページ上部へ戻るリンク
  $input['return_top_font_color'] = wp_kses_post($input['return_top_font_color']);
  $input['return_top_bg_color'] = wp_kses_post($input['return_top_bg_color']);
  $input['return_top_bg_color_hover'] = wp_kses_post($input['return_top_bg_color_hover']);


  // コピーライト
  $input['copyright'] = wp_kses_post($input['copyright']);
  $input['copyright_font_color'] = wp_kses_post($input['copyright_font_color']);
  $input['copyright_bg_color'] = wp_kses_post($input['copyright_bg_color']);


  // スマホ用固定フッターバーの設定
  $input['footer_bar_display'] = wp_kses_post($input['footer_bar_display']);
  $input['footer_bar_font_color'] = wp_kses_post($input['footer_bar_font_color']);
  $input['footer_bar_bg_color'] = wp_kses_post($input['footer_bar_bg_color']);
  $input['footer_bar_bg_color_hover'] = wp_kses_post($input['footer_bar_bg_color_hover']);
  $input['footer_bar_border_color'] = wp_kses_post($input['footer_bar_border_color']);
  $input['footer_bar_border_color_opacity'] = wp_kses_post($input['footer_bar_border_color_opacity']);
  $footer_bar_btns = array();
  if ( isset( $input['footer_bar_btns'] ) && is_array( $input['footer_bar_btns'] ) ) {
    foreach ( $input['footer_bar_btns'] as $key => $value ) {
      $footer_bar_btns[] = array(
        'type' => ( isset( $input['footer_bar_btns'][$key]['type'] ) && array_key_exists( $input['footer_bar_btns'][$key]['type'], $footer_bar_button_options ) ) ? $input['footer_bar_btns'][$key]['type'] : 'type1',
        'label' => isset( $input['footer_bar_btns'][$key]['label'] ) ? wp_filter_nohtml_kses( $input['footer_bar_btns'][$key]['label'] ) : '',
        'url' => isset( $input['footer_bar_btns'][$key]['url'] ) ? wp_filter_nohtml_kses( $input['footer_bar_btns'][$key]['url'] ) : '',
        'number' => isset( $input['footer_bar_btns'][$key]['number'] ) ? wp_filter_nohtml_kses( $input['footer_bar_btns'][$key]['number'] ) : '',
        'target' => ! empty( $input['footer_bar_btns'][$key]['target'] ) ? 1 : 0,
        'icon' => ( isset( $input['footer_bar_btns'][$key]['icon'] ) && array_key_exists( $input['footer_bar_btns'][$key]['icon'], $footer_bar_icon_options ) ) ? $input['footer_bar_btns'][$key]['icon'] : 'twitter',
      );
    };
  };
  $input['footer_bar_btns'] = $footer_bar_btns;

	return $input;

};


?>