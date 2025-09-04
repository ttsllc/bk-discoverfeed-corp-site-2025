<?php
/*
 * 商品の設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_product_dp_default_options' );


//  Add label of product tab
add_action( 'tcd_tab_labels', 'add_product_tab_label' );


// Add HTML of product tab
add_action( 'tcd_tab_panel', 'add_product_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_product_theme_options_validate' );


// タブの名前
function add_product_tab_label( $tab_labels ) {
  $options = get_design_plus_option();
  $tab_label = $options['product_label'] ? esc_html( $options['product_label'] ) : __( 'Product', 'tcd-w' );
  $tab_labels['product'] = $tab_label;
	return $tab_labels;
}


// 初期値
function add_product_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['product_label'] = __( 'Product', 'tcd-w' );
	$dp_default_options['product_slug'] = 'product';
	$dp_default_options['product_category_label'] = __( 'Product category', 'tcd-w' );
	$dp_default_options['product_category_slug'] = 'product_category';

	// ヘッダー
	$dp_default_options['product_show_header'] = '';
	$dp_default_options['product_title'] = '';
	$dp_default_options['product_title_font_size'] = '36';
	$dp_default_options['product_title_font_size_mobile'] = '24';
	$dp_default_options['product_title_font_color'] = '#FFFFFF';
	$dp_default_options['product_title_font_type'] = 'type3';
	$dp_default_options['product_desc'] = '';
	$dp_default_options['product_desc_mobile'] = '';
	$dp_default_options['product_desc_font_size'] = '16';
	$dp_default_options['product_desc_font_size_mobile'] = '14';
	$dp_default_options['product_desc_font_color'] = '#FFFFFF';
	$dp_default_options['product_desc_font_type'] = 'type2';
	$dp_default_options['product_bg_image'] = false;
	$dp_default_options['product_bg_image_mobile'] = false;
	$dp_default_options['product_use_overlay'] = 1;
	$dp_default_options['product_overlay_color'] = '#000000';
	$dp_default_options['product_overlay_opacity'] = '0.3';

	// アーカイブページ
	$dp_default_options['archive_product_category_font_size'] = '16';
	$dp_default_options['archive_product_category_font_size_mobile'] = '12';
	$dp_default_options['archive_product_category_font_color'] = '#ffffff';
	$dp_default_options['archive_product_category_bg_color'] = '#008a98';
	$dp_default_options['archive_product_category_bg_color_active'] = '#006e7c';

	$dp_default_options['archive_product_catch'] = '';
	$dp_default_options['archive_product_catch_mobile'] = '';
	$dp_default_options['archive_product_catch_font_type'] = 'type3';
	$dp_default_options['archive_product_catch_font_size'] = '38';
	$dp_default_options['archive_product_catch_font_size_mobile'] = '20';
	$dp_default_options['archive_product_desc'] = '';
	$dp_default_options['archive_product_desc_mobile'] = '';
	$dp_default_options['archive_product_desc_font_size'] = '16';
	$dp_default_options['archive_product_desc_font_size_mobile'] = '14';

	$dp_default_options['archive_product_title_font_size'] = '22';
	$dp_default_options['archive_product_title_font_size_mobile'] = '18';
	$dp_default_options['archive_product_title_font_type'] = 'type2';

	$dp_default_options['archive_product_excerpt_font_size'] = '16';
	$dp_default_options['archive_product_excerpt_font_size_mobile'] = '14';

	$dp_default_options['archive_product_list_animation_type'] = 'type1';

	// 記事ページ
	$dp_default_options['single_product_header_catch_font_size'] = '36';
	$dp_default_options['single_product_header_catch_font_size_mobile'] = '24';
	$dp_default_options['single_product_header_catch_font_color'] = '#ffffff';
	$dp_default_options['single_product_header_catch_font_type'] = 'type3';

	$dp_default_options['single_product_header_sub_title_font_size'] = '16';
	$dp_default_options['single_product_header_sub_title_font_size_mobile'] = '14';
	$dp_default_options['single_product_header_sub_title_font_color'] = '#ffffff';
	$dp_default_options['single_product_header_sub_title_font_type'] = 'type2';

	$dp_default_options['single_product_header_title_font_size'] = '34';
	$dp_default_options['single_product_header_title_font_size_mobile'] = '24';
	$dp_default_options['single_product_header_title_font_color'] = '#ffffff';
	$dp_default_options['single_product_header_title_font_type'] = 'type3';
	$dp_default_options['single_product_header_title_bg_color'] = '#000000';
	$dp_default_options['single_product_header_title_bg_color_opacity'] = '0.3';

	$dp_default_options['single_product_category_font_size'] = '16';
	$dp_default_options['single_product_category_font_size_mobile'] = '14';

	$dp_default_options['single_product_content_catch_font_size'] = '36';
	$dp_default_options['single_product_content_catch_font_size_mobile'] = '24';
	$dp_default_options['single_product_content_catch_font_type'] = 'type3';
	$dp_default_options['single_product_content_desc_font_size'] = '16';
	$dp_default_options['single_product_content_desc_font_size_mobile'] = '14';

	$dp_default_options['show_single_product_content_link_button'] = 1;

	$dp_default_options['show_side_product_category'] = 1;
	$dp_default_options['show_side_product_background_color'] = '#f4f4f4';
	$dp_default_options['side_product_catch_font_size'] = '18';
	$dp_default_options['side_product_catch_font_size_mobile'] = '15';
	$dp_default_options['side_product_desc_font_size'] = '14';
	$dp_default_options['side_product_desc_font_size_mobile'] = '12';
	$dp_default_options['side_product_price_label_font_size'] = '14';
	$dp_default_options['side_product_price_label_font_size_mobile'] = '12';
	$dp_default_options['side_product_price_font_size'] = '18';
	$dp_default_options['side_product_price_font_size_mobile'] = '15';

	$dp_default_options['side_product_button_font_color'] = '#000000';
	$dp_default_options['side_product_button_bg_color'] = '#ffffff';
	$dp_default_options['side_product_button_border_color'] = '#000000';
	$dp_default_options['side_product_button_font_color_hover'] = '#ffffff';
	$dp_default_options['side_product_button_border_color_hover'] = '#208a96';
	$dp_default_options['side_product_button_bg_color_hover'] = '#208a96';
	$dp_default_options['single_product_layout'] = 'type1';

	$dp_default_options['show_single_product_list'] = 1;
	$dp_default_options['single_product_list_headline'] = __( 'Product', 'tcd-w' );
	$dp_default_options['single_product_list_headline_font_size'] = '26';
	$dp_default_options['single_product_list_headline_font_size_mobile'] = '20';
	$dp_default_options['single_product_list_headline_font_type'] = 'type2';
	$dp_default_options['single_product_list_num'] = '6';
	$dp_default_options['single_product_list_bg_color'] = '#f4f4f4';

	$dp_default_options['single_product_list_title_font_size'] = '22';
	$dp_default_options['single_product_list_title_font_size_mobile'] = '18';
	$dp_default_options['single_product_list_title_font_type'] = 'type2';
	$dp_default_options['single_product_list_excerpt_font_size'] = '16';
	$dp_default_options['single_product_list_excerpt_font_size_mobile'] = '14';


	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_product_tab_panel( $options ) {

  global $dp_default_options, $font_type_options, $layout_options;
  $product_label = $options['product_label'] ? esc_html( $options['product_label'] ) : __( 'Product', 'tcd-w' );

?>

<div id="tab-content-product" class="tab-content">

   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Basic setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Name of content', 'tcd-w');  ?></h4>
     <input class="regular-text" type="text" name="dp_options[product_label]" value="<?php echo esc_attr( $options['product_label'] ); ?>" />

     <h4 class="theme_option_headline2"><?php _e('Slug setting', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please enter word by alphabet only.<br />After changing slug, please update permalink setting form <a href="./options-permalink.php"><strong>permalink option page</strong></a>.', 'tcd-w'); ?></p>
     </div>
     <p><input class="hankaku regular-text" type="text" name="dp_options[product_slug]" value="<?php echo sanitize_title( $options['product_slug'] ); ?>" /></p>

     <h4 class="theme_option_headline2"><?php printf(__('%s category setting', 'tcd-w'), $product_label); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please enter word by alphabet only.<br />After changing slug, please update permalink setting form <a href="./options-permalink.php"><strong>permalink option page</strong></a>.', 'tcd-w'); ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Name', 'tcd-w'); ?></span><input type="text" name="dp_options[product_category_label]" value="<?php esc_attr_e( $options['product_category_label'] ); ?>" /></li>
      <li class="cf"><span class="label"><?php _e('Slug', 'tcd-w'); ?></span><input type="text" name="dp_options[product_category_slug]" value="<?php echo sanitize_title( $options['product_category_slug'] ); ?>" /></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ヘッダーの設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <p class="displayment_checkbox"><label><input name="dp_options[product_show_header]" type="checkbox" value="1" <?php checked( $options['product_show_header'], 1 ); ?>><?php _e( 'Display header', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['product_show_header'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

     <h4 class="theme_option_headline2"><?php _e('Title', 'tcd-w');  ?></h4>
     <input class="full_width" type="text" name="dp_options[product_title]" value="<?php echo esc_attr( $options['product_title'] ); ?>" />
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
       <select name="dp_options[product_title_font_type]">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['product_title_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[product_title_font_size]" value="<?php esc_attr_e( $options['product_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[product_title_font_size_mobile]" value="<?php esc_attr_e( $options['product_title_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[product_title_font_color]" value="<?php echo esc_attr( $options['product_title_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
     <textarea class="full_width" cols="50" rows="4" name="dp_options[product_desc]"><?php echo esc_textarea(  $options['product_desc'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
       <select name="dp_options[product_desc_font_type]">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['product_desc_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[product_desc_font_size]" value="<?php esc_attr_e( $options['product_desc_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[product_desc_font_color]" value="<?php echo esc_attr( $options['product_desc_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Description (mobile)', 'tcd-w');  ?></h4>
     <textarea class="full_width" cols="50" rows="4" name="dp_options[product_desc_mobile]"><?php echo esc_textarea(  $options['product_desc_mobile'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[product_desc_font_size_mobile]" value="<?php esc_attr_e( $options['product_desc_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Background image', 'tcd-w'); ?></h4>
     <div class="theme_option_message2">
      <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '500'); ?></p>
     </div>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js product_bg_image">
       <input type="hidden" value="<?php echo esc_attr( $options['product_bg_image'] ); ?>" id="product_bg_image" name="dp_options[product_bg_image]" class="cf_media_id">
       <div class="preview_field"><?php if($options['product_bg_image']){ echo wp_get_attachment_image($options['product_bg_image'], 'medium'); }; ?></div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['product_bg_image']){ echo 'hidden'; }; ?>">
       </div>
      </div>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Background image (mobile)', 'tcd-w'); ?></h4>
     <div class="theme_option_message2">
      <p><?php echo __('Please use this option if you want to change background image in mobile device.', 'tcd-w'); ?></p>
      <p><?php printf(__('Recommended size assuming for retina display. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '1100'); ?></p>
     </div>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js product_bg_image_mobile">
       <input type="hidden" value="<?php echo esc_attr( $options['product_bg_image_mobile'] ); ?>" id="product_bg_image_mobile" name="dp_options[product_bg_image_mobile]" class="cf_media_id">
       <div class="preview_field"><?php if($options['product_bg_image_mobile']){ echo wp_get_attachment_image($options['product_bg_image_mobile'], 'medium'); }; ?></div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['product_bg_image_mobile']){ echo 'hidden'; }; ?>">
       </div>
      </div>
     </div>

     <h4 class="theme_option_headline2"><?php _e( 'Overlay setting', 'tcd-w' ); ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[product_use_overlay]" type="checkbox" value="1" <?php checked( $options['product_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['product_use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[product_overlay_color]" value="<?php echo esc_attr( $options['product_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       <li class="cf">
        <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[product_overlay_opacity]" value="<?php echo esc_attr( $options['product_overlay_opacity'] ); ?>" />
        <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
         <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
        </div>
       </li>
      </ul>
     </div>

     </div><!-- END show header -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // アーカイブページの設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Archive page setting', 'tcd-w'); ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Category button', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_product_category_font_size]" value="<?php esc_attr_e( $options['archive_product_category_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_product_category_font_size_mobile]" value="<?php esc_attr_e( $options['archive_product_category_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[archive_product_category_font_color]" value="<?php echo esc_attr( $options['archive_product_category_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[archive_product_category_bg_color]" value="<?php echo esc_attr( $options['archive_product_category_bg_color'] ); ?>" data-default-color="#008a98" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color of active category', 'tcd-w'); ?></span><input type="text" name="dp_options[archive_product_category_bg_color_active]" value="<?php echo esc_attr( $options['archive_product_category_bg_color_active'] ); ?>" data-default-color="#006e7c" class="c-color-picker"></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
     <textarea class="full_width" cols="50" rows="4" name="dp_options[archive_product_catch]"><?php echo esc_textarea(  $options['archive_product_catch'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
       <select name="dp_options[archive_product_catch_font_type]">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['archive_product_catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_product_catch_font_size]" value="<?php esc_attr_e( $options['archive_product_catch_font_size'] ); ?>" /><span>px</span></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Catchphrase (mobile)', 'tcd-w');  ?></h4>
     <textarea class="full_width" cols="50" rows="4" name="dp_options[archive_product_catch_mobile]"><?php echo esc_textarea(  $options['archive_product_catch_mobile'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_product_catch_font_size_mobile]" value="<?php esc_attr_e( $options['archive_product_catch_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
     <textarea class="full_width" cols="50" rows="4" name="dp_options[archive_product_desc]"><?php echo esc_textarea(  $options['archive_product_desc'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_product_desc_font_size]" value="<?php esc_attr_e( $options['archive_product_desc_font_size'] ); ?>" /><span>px</span></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Description (mobile)', 'tcd-w');  ?></h4>
     <textarea class="full_width" cols="50" rows="4" name="dp_options[archive_product_desc_mobile]"><?php echo esc_textarea(  $options['archive_product_desc_mobile'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_product_desc_font_size_mobile]" value="<?php esc_attr_e( $options['archive_product_desc_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>

     <h4 class="theme_option_headline2"><?php printf(__('%s list', 'tcd-w'),$product_label);  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Animation type', 'tcd-w');  ?></span>
       <select name="dp_options[archive_product_list_animation_type]">
        <option style="padding-right: 10px;" value="type1" <?php selected( $options['archive_product_list_animation_type'], 'type1' ); ?>><?php _e('Fade in', 'tcd-w');  ?></option>
        <option style="padding-right: 10px;" value="type2" <?php selected( $options['archive_product_list_animation_type'], 'type2' ); ?>><?php _e('Slide up', 'tcd-w');  ?></option>
        <option style="padding-right: 10px;" value="type3" <?php selected( $options['archive_product_list_animation_type'], 'type3' ); ?>><?php _e('Pop up', 'tcd-w');  ?></option>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font type of title', 'tcd-w');  ?></span>
       <select name="dp_options[archive_product_title_font_type]">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['archive_product_title_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_product_title_font_size]" value="<?php esc_attr_e( $options['archive_product_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of title (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_product_title_font_size_mobile]" value="<?php esc_attr_e( $options['archive_product_title_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of description', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_product_excerpt_font_size]" value="<?php esc_attr_e( $options['archive_product_excerpt_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of description (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_product_excerpt_font_size_mobile]" value="<?php esc_attr_e( $options['archive_product_excerpt_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 記事ページの設定 -------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Single page setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Header catchphrase', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
       <select name="dp_options[single_product_header_catch_font_type]">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['single_product_header_catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_product_header_catch_font_size]" value="<?php esc_attr_e( $options['single_product_header_catch_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_product_header_catch_font_size_mobile]" value="<?php esc_attr_e( $options['single_product_header_catch_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[single_product_header_catch_font_color]" value="<?php echo esc_attr( $options['single_product_header_catch_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Header subtitle', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
       <select name="dp_options[single_product_header_sub_title_font_type]">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['single_product_header_sub_title_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_product_header_sub_title_font_size]" value="<?php esc_attr_e( $options['single_product_header_sub_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w');  ?></span><input class="font_size hankaku" type="text" name="dp_options[single_product_header_sub_title_font_size_mobile]" value="<?php esc_attr_e( $options['single_product_header_sub_title_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[single_product_header_sub_title_font_color]" value="<?php echo esc_attr( $options['single_product_header_sub_title_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Header title', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
       <select name="dp_options[single_product_header_title_font_type]">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['single_product_header_title_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_product_header_title_font_size]" value="<?php esc_attr_e( $options['single_product_header_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_product_header_title_font_size_mobile]" value="<?php esc_attr_e( $options['single_product_header_title_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[single_product_header_title_font_color]" value="<?php echo esc_attr( $options['single_product_header_title_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[single_product_header_title_bg_color]" value="<?php echo esc_attr( $options['single_product_header_title_bg_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of background color', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[single_product_header_title_bg_color_opacity]" value="<?php echo esc_attr( $options['single_product_header_title_bg_color_opacity'] ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
       </div>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Content link button', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_product_category_font_size]" value="<?php esc_attr_e( $options['single_product_category_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_product_category_font_size_mobile]" value="<?php esc_attr_e( $options['single_product_category_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Main content', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display content link button', 'tcd-w'); ?></span><input name="dp_options[show_single_product_content_link_button]" type="checkbox" value="1" <?php checked( $options['show_single_product_content_link_button'], 1 ); ?>></li>
      <li class="cf"><span class="label"><?php _e('Font type of catchphrase', 'tcd-w');  ?></span>
       <select name="dp_options[single_product_content_catch_font_type]">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['single_product_content_catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size of catchphrase', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_product_content_catch_font_size]" value="<?php esc_attr_e( $options['single_product_content_catch_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of catchphrase (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_product_content_catch_font_size_mobile]" value="<?php esc_attr_e( $options['single_product_content_catch_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of description', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_product_content_desc_font_size]" value="<?php esc_attr_e( $options['single_product_content_desc_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of description (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_product_content_desc_font_size_mobile]" value="<?php esc_attr_e( $options['single_product_content_desc_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Side content', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Side content position', 'tcd-w');  ?></span>
       <select name="dp_options[single_product_layout]">
        <?php
             $i = 1;
             foreach ( $layout_options as $option ) {
               if($i != 1){
        ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['single_product_layout'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php
                };
             $i++;
             };
        ?>
       </select>
       <div class="theme_option_message2" style="clear:both; margin:12px 0 7px 0;">
        <p><?php _e('Content width will be 1000px if you don\'t display side content.', 'tcd-w');  ?></p>
       </div>
      </li>
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[show_side_product_background_color]" value="<?php echo esc_attr( $options['show_side_product_background_color'] ); ?>" data-default-color="#f4f4f4" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Display category button', 'tcd-w'); ?></span><input id="scb_button" name="dp_options[show_side_product_category]" type="checkbox" value="1" <?php checked( $options['show_side_product_category'], 1 ); ?>></li>
      <li class="cf scb"><span class="label"><?php _e('Font color of button', 'tcd-w'); ?></span><input type="text" name="dp_options[side_product_button_font_color]" value="<?php echo esc_attr( $options['side_product_button_font_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf scb"><span class="label"><?php _e('Background color of button', 'tcd-w'); ?></span><input type="text" name="dp_options[side_product_button_bg_color]" value="<?php echo esc_attr( $options['side_product_button_bg_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf scb"><span class="label"><?php _e('Border color of button', 'tcd-w'); ?></span><input type="text" name="dp_options[side_product_button_border_color]" value="<?php echo esc_attr( $options['side_product_button_border_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf scb"><span class="label"><?php _e('Font color of button on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[side_product_button_font_color_hover]" value="<?php echo esc_attr( $options['side_product_button_font_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf scb"><span class="label"><?php _e('Background color of button on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[side_product_button_bg_color_hover]" value="<?php echo esc_attr( $options['side_product_button_bg_color_hover'] ); ?>" data-default-color="#208a96" class="c-color-picker"></li>
      <li class="cf scb"><span class="label"><?php _e('Border color of button on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[side_product_button_border_color_hover]" value="<?php echo esc_attr( $options['side_product_button_border_color_hover'] ); ?>" data-default-color="#208a96" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Font size of catchphrase', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[side_product_catch_font_size]" value="<?php esc_attr_e( $options['side_product_catch_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of catchphrase (mobile)', 'tcd-w');  ?></span><input class="font_size hankaku" type="text" name="dp_options[side_product_catch_font_size_mobile]" value="<?php esc_attr_e( $options['side_product_catch_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of description', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[side_product_desc_font_size]" value="<?php esc_attr_e( $options['side_product_desc_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of description (mobile)', 'tcd-w');  ?></span><input class="font_size hankaku" type="text" name="dp_options[side_product_desc_font_size_mobile]" value="<?php esc_attr_e( $options['side_product_desc_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of price label', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[side_product_price_label_font_size]" value="<?php esc_attr_e( $options['side_product_price_label_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of price label (mobile)', 'tcd-w');  ?></span><input class="font_size hankaku" type="text" name="dp_options[side_product_price_label_font_size_mobile]" value="<?php esc_attr_e( $options['side_product_price_label_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of price', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[side_product_price_font_size]" value="<?php esc_attr_e( $options['side_product_price_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of price (mobile)', 'tcd-w');  ?></span><input class="font_size hankaku" type="text" name="dp_options[side_product_price_font_size_mobile]" value="<?php esc_attr_e( $options['side_product_price_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>

     <h4 class="theme_option_headline2"><?php printf(__('%s list', 'tcd-w'),$product_label); ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_single_product_list]" type="checkbox" value="1" <?php checked( $options['show_single_product_list'], 1 ); ?>><?php printf(__('Display %s list', 'tcd-w'),$product_label); ?></label></p>
     <div style="<?php if($options['show_single_product_list'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input type="text" class="full_width" name="dp_options[single_product_list_headline]" value="<?php echo esc_attr($options['single_product_list_headline']); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Font type of headline', 'tcd-w');  ?></span>
        <select name="dp_options[single_product_list_headline_font_type]">
         <?php foreach ( $font_type_options as $option ) { ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['single_product_list_headline_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
         <?php } ?>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Font size of headline', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_product_list_headline_font_size]" value="<?php esc_attr_e( $options['single_product_list_headline_font_size'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font size of headline (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_product_list_headline_font_size_mobile]" value="<?php esc_attr_e( $options['single_product_list_headline_font_size_mobile'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
        <select name="dp_options[single_product_list_num]">
         <option style="padding-right: 10px;" value="-1" <?php selected( $options['single_product_list_num'], '-1' ); ?>><?php _e('Display all', 'tcd-w');  ?></option>
         <?php for($i=3; $i<= 24; $i++): if(($i % 3) == 0) { ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['single_product_list_num'], $i ); ?>><?php echo esc_html($i); ?></option>
         <?php }; endfor; ?>
        </select>
       </li>
       <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[single_product_list_bg_color]" value="<?php echo esc_attr( $options['single_product_list_bg_color'] ); ?>" data-default-color="#f4f4f4" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Font type of title', 'tcd-w');  ?></span>
        <select name="dp_options[single_product_list_title_font_type]">
         <?php foreach ( $font_type_options as $option ) { ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['single_product_list_title_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
         <?php } ?>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_product_list_title_font_size]" value="<?php esc_attr_e( $options['single_product_list_title_font_size'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font size of title (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_product_list_title_font_size_mobile]" value="<?php esc_attr_e( $options['single_product_list_title_font_size_mobile'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font size of description', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_product_list_excerpt_font_size]" value="<?php esc_attr_e( $options['single_product_list_excerpt_font_size'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font size of description (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_product_list_excerpt_font_size_mobile]" value="<?php esc_attr_e( $options['single_product_list_excerpt_font_size_mobile'] ); ?>" /><span>px</span></li>
      </ul>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_product_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_product_theme_options_validate( $input ) {

  global $dp_default_options, $font_type_options, $layout_options;

  // 基本設定
  $input['product_label'] = wp_filter_nohtml_kses( $input['product_label'] );
  $input['product_slug'] = sanitize_title( $input['product_slug'] );
  $input['product_category_label'] = wp_filter_nohtml_kses( $input['product_category_label'] );
  $input['product_category_slug'] = sanitize_title( $input['product_category_slug'] );

  //ヘッダーの設定
  $input['product_show_header'] = ! empty( $input['product_show_header'] ) ? 1 : 0;
  $input['product_title'] = wp_filter_nohtml_kses( $input['product_title'] );
  if ( ! isset( $value['product_title_font_type'] ) )
    $value['product_title_font_type'] = null;
  if ( ! array_key_exists( $value['product_title_font_type'], $font_type_options ) )
    $value['product_title_font_type'] = null;
  $input['product_title_font_size'] = wp_filter_nohtml_kses( $input['product_title_font_size'] );
  $input['product_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['product_title_font_size_mobile'] );
  $input['product_title_font_color'] = wp_filter_nohtml_kses( $input['product_title_font_color'] );
  $input['product_desc'] = wp_filter_nohtml_kses( $input['product_desc'] );
  $input['product_desc_mobile'] = wp_filter_nohtml_kses( $input['product_desc_mobile'] );
  if ( ! isset( $value['product_desc_font_type'] ) )
    $value['product_desc_font_type'] = null;
  if ( ! array_key_exists( $value['product_desc_font_type'], $font_type_options ) )
    $value['product_desc_font_type'] = null;
  $input['product_desc_font_size'] = wp_filter_nohtml_kses( $input['product_desc_font_size'] );
  $input['product_desc_font_size_mobile'] = wp_filter_nohtml_kses( $input['product_desc_font_size_mobile'] );
  $input['product_desc_font_color'] = wp_filter_nohtml_kses( $input['product_desc_font_color'] );
  $input['product_bg_image'] = wp_filter_nohtml_kses( $input['product_bg_image'] );
  $input['product_bg_image_mobile'] = wp_filter_nohtml_kses( $input['product_bg_image_mobile'] );
  $input['product_use_overlay'] = ! empty( $input['product_use_overlay'] ) ? 1 : 0;
  $input['product_overlay_color'] = wp_filter_nohtml_kses( $input['product_overlay_color'] );
  $input['product_overlay_opacity'] = wp_filter_nohtml_kses( $input['product_overlay_opacity'] );

  // アーカイブ
  $input['archive_product_category_font_size'] = wp_filter_nohtml_kses( $input['archive_product_category_font_size'] );
  $input['archive_product_category_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_product_category_font_size_mobile'] );
  $input['archive_product_category_font_color'] = wp_filter_nohtml_kses( $input['archive_product_category_font_color'] );
  $input['archive_product_category_bg_color'] = wp_filter_nohtml_kses( $input['archive_product_category_bg_color'] );
  $input['archive_product_category_bg_color_active'] = wp_filter_nohtml_kses( $input['archive_product_category_bg_color_active'] );

  $input['archive_product_catch'] = wp_filter_nohtml_kses( $input['archive_product_catch'] );
  $input['archive_product_catch_mobile'] = wp_filter_nohtml_kses( $input['archive_product_catch_mobile'] );
  if ( ! isset( $value['archive_product_catch_font_type'] ) )
    $value['archive_product_catch_font_type'] = null;
  if ( ! array_key_exists( $value['archive_product_catch_font_type'], $font_type_options ) )
    $value['archive_product_catch_font_type'] = null;
  $input['archive_product_catch_font_size'] = wp_filter_nohtml_kses( $input['archive_product_catch_font_size'] );
  $input['archive_product_catch_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_product_catch_font_size_mobile'] );
  $input['archive_product_desc'] = wp_filter_nohtml_kses( $input['archive_product_desc'] );
  $input['archive_product_desc_mobile'] = wp_filter_nohtml_kses( $input['archive_product_desc_mobile'] );
  $input['archive_product_desc_font_size'] = wp_filter_nohtml_kses( $input['archive_product_desc_font_size'] );
  $input['archive_product_desc_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_product_desc_font_size_mobile'] );
  if ( ! isset( $value['archive_product_title_font_type'] ) )
    $value['archive_product_title_font_type'] = null;
  if ( ! array_key_exists( $value['archive_product_title_font_type'], $font_type_options ) )
    $value['archive_product_title_font_type'] = null;
  $input['archive_product_title_font_size'] = wp_filter_nohtml_kses( $input['archive_product_title_font_size'] );
  $input['archive_product_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_product_title_font_size_mobile'] );
  $input['archive_product_excerpt_font_size'] = wp_filter_nohtml_kses( $input['archive_product_excerpt_font_size'] );
  $input['archive_product_excerpt_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_product_excerpt_font_size_mobile'] );

  $input['archive_product_list_animation_type'] = wp_filter_nohtml_kses( $input['archive_product_list_animation_type'] );

  // 記事ページ
  $input['single_product_header_catch_font_size'] = wp_filter_nohtml_kses( $input['single_product_header_catch_font_size'] );
  $input['single_product_header_catch_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_product_header_catch_font_size_mobile'] );
  $input['single_product_header_catch_font_color'] = wp_filter_nohtml_kses( $input['single_product_header_catch_font_color'] );
  $input['single_product_header_catch_font_type'] = wp_filter_nohtml_kses( $input['single_product_header_catch_font_type'] );

  $input['single_product_header_sub_title_font_size'] = wp_filter_nohtml_kses( $input['single_product_header_sub_title_font_size'] );
  $input['single_product_header_sub_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_product_header_sub_title_font_size_mobile'] );
  $input['single_product_header_sub_title_font_color'] = wp_filter_nohtml_kses( $input['single_product_header_sub_title_font_color'] );
  $input['single_product_header_sub_title_font_type'] = wp_filter_nohtml_kses( $input['single_product_header_sub_title_font_type'] );

  $input['single_product_header_title_font_size'] = wp_filter_nohtml_kses( $input['single_product_header_title_font_size'] );
  $input['single_product_header_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_product_header_title_font_size_mobile'] );
  $input['single_product_header_title_font_color'] = wp_filter_nohtml_kses( $input['single_product_header_title_font_color'] );
  $input['single_product_header_title_font_type'] = wp_filter_nohtml_kses( $input['single_product_header_title_font_type'] );
  $input['single_product_header_title_bg_color'] = wp_filter_nohtml_kses( $input['single_product_header_title_bg_color'] );
  $input['single_product_header_title_bg_color_opacity'] = wp_filter_nohtml_kses( $input['single_product_header_title_bg_color_opacity'] );

  $input['single_product_category_font_size'] = wp_filter_nohtml_kses( $input['single_product_category_font_size'] );
  $input['single_product_category_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_product_category_font_size_mobile'] );

  $input['single_product_content_catch_font_size'] = wp_filter_nohtml_kses( $input['single_product_content_catch_font_size'] );
  $input['single_product_content_catch_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_product_content_catch_font_size_mobile'] );
  $input['single_product_content_catch_font_type'] = wp_filter_nohtml_kses( $input['single_product_content_catch_font_type'] );

  $input['show_single_product_content_link_button'] = ! empty( $input['show_single_product_content_link_button'] ) ? 1 : 0;

  $input['single_product_content_desc_font_size'] = wp_filter_nohtml_kses( $input['single_product_content_desc_font_size'] );
  $input['single_product_content_desc_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_product_content_desc_font_size_mobile'] );

  $input['show_side_product_background_color'] = wp_filter_nohtml_kses( $input['show_side_product_background_color'] );
  $input['show_side_product_category'] = ! empty( $input['show_side_product_category'] ) ? 1 : 0;
  $input['side_product_catch_font_size'] = wp_filter_nohtml_kses( $input['side_product_catch_font_size'] );
  $input['side_product_catch_font_size_mobile'] = wp_filter_nohtml_kses( $input['side_product_catch_font_size_mobile'] );
  $input['side_product_desc_font_size'] = wp_filter_nohtml_kses( $input['side_product_desc_font_size'] );
  $input['side_product_desc_font_size_mobile'] = wp_filter_nohtml_kses( $input['side_product_desc_font_size_mobile'] );
  $input['side_product_price_label_font_size'] = wp_filter_nohtml_kses( $input['side_product_price_label_font_size'] );
  $input['side_product_price_label_font_size_mobile'] = wp_filter_nohtml_kses( $input['side_product_price_label_font_size_mobile'] );
  $input['side_product_price_font_size'] = wp_filter_nohtml_kses( $input['side_product_price_font_size'] );
  $input['side_product_price_font_size_mobile'] = wp_filter_nohtml_kses( $input['side_product_price_font_size_mobile'] );

  $input['side_product_button_font_color'] = wp_filter_nohtml_kses( $input['side_product_button_font_color'] );
  $input['side_product_button_border_color'] = wp_filter_nohtml_kses( $input['side_product_button_border_color'] );
  $input['side_product_button_bg_color'] = wp_filter_nohtml_kses( $input['side_product_button_bg_color'] );
  $input['side_product_button_font_color_hover'] = wp_filter_nohtml_kses( $input['side_product_button_font_color_hover'] );
  $input['side_product_button_border_color_hover'] = wp_filter_nohtml_kses( $input['side_product_button_border_color_hover'] );
  $input['side_product_button_bg_color_hover'] = wp_filter_nohtml_kses( $input['side_product_button_bg_color_hover'] );
  if ( ! isset( $value['single_product_layout'] ) )
    $value['single_product_layout'] = null;
  if ( ! array_key_exists( $value['single_product_layout'], $layout_options ) )
    $value['single_product_layout'] = null;

  $input['show_single_product_list'] = ! empty( $input['show_single_product_list'] ) ? 1 : 0;
  $input['single_product_list_headline'] = wp_filter_nohtml_kses( $input['single_product_list_headline'] );
  $input['single_product_list_headline_font_size'] = wp_filter_nohtml_kses( $input['single_product_list_headline_font_size'] );
  $input['single_product_list_headline_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_product_list_headline_font_size_mobile'] );
  $input['single_product_list_num'] = wp_filter_nohtml_kses( $input['single_product_list_num'] );
  $input['single_product_list_headline_font_type'] = wp_filter_nohtml_kses( $input['single_product_list_headline_font_type'] );
  $input['single_product_list_bg_color'] = wp_filter_nohtml_kses( $input['single_product_list_bg_color'] );
  if ( ! isset( $value['single_product_list_title_font_type'] ) )
    $value['single_product_list_title_font_type'] = null;
  if ( ! array_key_exists( $value['single_product_list_title_font_type'], $font_type_options ) )
    $value['single_product_list_title_font_type'] = null;
  $input['single_product_list_title_font_size'] = wp_filter_nohtml_kses( $input['single_product_list_title_font_size'] );
  $input['single_product_list_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_product_list_title_font_size_mobile'] );
  $input['single_product_list_excerpt_font_size'] = wp_filter_nohtml_kses( $input['single_product_list_excerpt_font_size'] );
  $input['single_product_list_excerpt_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_product_list_excerpt_font_size_mobile'] );

	return $input;

};


?>