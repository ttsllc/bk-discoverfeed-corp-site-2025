<?php

// レビューの並び順
global $review_sort_options;
$review_sort_options = array(
	'none' => array( 'value' => 'none', 'label' => __( 'Do not sort', 'tcd-w' ) ),
	'date_desc' => array( 'value' => 'date_desc', 'label' => __( 'Date (DESC)', 'tcd-w' ) ),
	'date_asc' => array( 'value' => 'date_asc', 'label' => __( 'Date (ASC)', 'tcd-w'  ) ),
	'vote' => array( 'value' => 'vote', 'label' => __( 'Review vote results (Available when using review vote)', 'tcd-w' ) )
);

// レビュー評価
global $review_rating_options;
$review_rating_options = array(
	1 => array( 'value' => 1, 'label' => '&#9733;&#9734;&#9734;&#9734;&#9734;' ),
	2 => array( 'value' => 2, 'label' => '&#9733;&#9733;&#9734;&#9734;&#9734;' ),
	3 => array( 'value' => 3, 'label' => '&#9733;&#9733;&#9733;&#9734;&#9734;' ),
	4 => array( 'value' => 4, 'label' => '&#9733;&#9733;&#9733;&#9733;&#9734;' ),
	5 => array( 'value' => 5, 'label' => '&#9733;&#9733;&#9733;&#9733;&#9733;' )
);

function product_cf_meta_box() {
  $options = get_design_plus_option();
  $product_label = $options['product_label'] ? esc_html( $options['product_label'] ) : __( 'Product', 'tcd-w' );
  add_meta_box(
    'product_cf_meta_box',//ID of meta box
    sprintf(__('%s data setting', 'tcd-w'), $product_label),
    'show_product_cf_meta_box',//callback function
    'product',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'product_cf_meta_box');

function show_product_cf_meta_box() {

  global $post, $layout_options, $content_direction_options, $content_direction_options2;

  $options = get_design_plus_option();
  $product_label = $options['product_label'] ? esc_html( $options['product_label'] ) : __( 'Product', 'tcd-w' );

  // 基本設定
  $main_color = get_post_meta($post->ID, 'main_color', true) ?  get_post_meta($post->ID, 'main_color', true) : '#008a98';
  $sub_color = get_post_meta($post->ID, 'sub_color', true) ?  get_post_meta($post->ID, 'sub_color', true) : '#006e7d';
  $icon_color = get_post_meta($post->ID, 'icon_color', true) ?  get_post_meta($post->ID, 'icon_color', true) : '#008a98';
  $content_link_font_color = get_post_meta($post->ID, 'content_link_font_color', true) ?  get_post_meta($post->ID, 'content_link_font_color', true) : '#ffffff';

  $recommend_post = get_post_meta($post->ID, 'recommend_post', true);
  $featured_post = get_post_meta($post->ID, 'featured_post', true);
  $featured_text = get_post_meta($post->ID, 'featured_text', true);

  $short_desc = get_post_meta($post->ID, 'short_desc', true);

  // ヘッダー
  $header_catch = get_post_meta($post->ID, 'header_catch', true);
  $header_sub_title = get_post_meta($post->ID, 'header_sub_title', true);

  $image_layout = get_post_meta($post->ID, 'image_layout', true) ?  get_post_meta($post->ID, 'image_layout', true) : 'type3';
  $image_layout2 = get_post_meta($post->ID, 'image_layout2', true) ?  get_post_meta($post->ID, 'image_layout2', true) : 'type2';
  $text_layout = get_post_meta($post->ID, 'text_layout', true) ?  get_post_meta($post->ID, 'text_layout', true) : 'type1';
  $image_animation_type = get_post_meta($post->ID, 'image_animation_type', true) ?  get_post_meta($post->ID, 'image_animation_type', true) : 'type1';
  $image_layout_mobile = get_post_meta($post->ID, 'image_layout_mobile', true) ?  get_post_meta($post->ID, 'image_layout_mobile', true) : 'type2';

  $image_blur = get_post_meta($post->ID, 'image_blur', true) ?  get_post_meta($post->ID, 'image_blur', true) : '10';

  $show_header_button = get_post_meta($post->ID, 'show_header_button', true);
  $header_button_label = get_post_meta($post->ID, 'header_button_label', true);
  $header_button_url = get_post_meta($post->ID, 'header_button_url', true);
  $header_button_target = get_post_meta($post->ID, 'header_button_target', true);
  $header_button_font_color = get_post_meta($post->ID, 'header_button_font_color', true) ?  get_post_meta($post->ID, 'header_button_font_color', true) : '#ffffff';
  $header_button_font_color_hover = get_post_meta($post->ID, 'header_button_font_color_hover', true) ?  get_post_meta($post->ID, 'header_button_font_color_hover', true) : '#ffffff';
  $header_button_border_color = get_post_meta($post->ID, 'header_button_border_color', true) ?  get_post_meta($post->ID, 'header_button_border_color', true) : '#ffffff';
  $header_button_border_color_opacity = get_post_meta($post->ID, 'header_button_border_color_opacity', true) ?  get_post_meta($post->ID, 'header_button_border_color_opacity', true) : '0.5';
  $header_button_border_color_hover = get_post_meta($post->ID, 'header_button_border_color_hover', true) ?  get_post_meta($post->ID, 'header_button_border_color_hover', true) : '#208a96';
  $header_button_border_color_hover_opacity = get_post_meta($post->ID, 'header_button_border_color_hover_opacity', true) ?  get_post_meta($post->ID, 'header_button_border_color_hover_opacity', true) : '1';
  $header_button_bg_color_hover = get_post_meta($post->ID, 'header_button_bg_color_hover', true) ?  get_post_meta($post->ID, 'header_button_bg_color_hover', true) : '#208a96';
  $header_button_animation = get_post_meta($post->ID, 'header_button_animation', true) ?  get_post_meta($post->ID, 'header_button_animation', true) : 'type1';

  $header_use_overlay = get_post_meta($post->ID, 'header_use_overlay', true);
  $header_overlay_color = get_post_meta($post->ID, 'header_overlay_color', true) ?  get_post_meta($post->ID, 'header_overlay_color', true) : '#000000';
  $header_overlay_opacity = get_post_meta($post->ID, 'header_overlay_opacity', true) ?  get_post_meta($post->ID, 'header_overlay_opacity', true) : '0.3';

  // サイドコンテンツ
  $side_content_layout = get_post_meta($post->ID, 'side_content_layout', true) ?  get_post_meta($post->ID, 'side_content_layout', true) : 'type0';

  $side_catch = get_post_meta($post->ID, 'side_catch', true);
  $side_desc_top = get_post_meta($post->ID, 'side_desc_top', true);
  $side_price_label = get_post_meta($post->ID, 'side_price_label', true);
  $side_price = get_post_meta($post->ID, 'side_price', true);
  $side_desc_bottom = get_post_meta($post->ID, 'side_desc_bottom', true);
  $side_price_tax_type = get_post_meta($post->ID, 'side_price_tax_type', true) ?  get_post_meta($post->ID, 'side_price_tax_type', true) : 'type1';

  $side_button_list = get_post_meta($post->ID, 'side_button_list', true);

  // メインコンテンツ
  $content_catch = get_post_meta($post->ID, 'content_catch', true);
  $content_desc = get_post_meta($post->ID, 'content_desc', true);

  $show_content_link_button = get_post_meta($post->ID, 'show_content_link_button', true);
  $content_link_button_label = get_post_meta($post->ID, 'content_link_button_label', true);
  $content_link_button_url = get_post_meta($post->ID, 'content_link_button_url', true);
  $content_link_button_target = get_post_meta($post->ID, 'content_link_button_target', true);

  // コンテンツビルダー
  $product_cf = get_post_meta( $post->ID, 'product_cf', true );

  echo '<input type="hidden" name="product_cf_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>

<div class="tcd_custom_field_wrap contents_builder_wrap">

 <?php // 基本設定 -------------------------------------------------------------- ?>
 <div class="theme_option_field cf theme_option_field_ac">
  <h3 class="theme_option_headline"><?php _e('Basic setting', 'tcd-w'); ?></h3>
  <div class="theme_option_field_ac_content">

   <h4 class="theme_option_headline2"><?php _e('Color setting', 'tcd-w'); ?></h4>
   <div class="theme_option_message2">
    <p><?php _e('Featured icon will be displayed in footer carousel and ranking page.', 'tcd-w');  ?></p>
   </div>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Main color', 'tcd-w'); ?></span><input type="text" name="main_color" value="<?php echo esc_attr($main_color); ?>" data-default-color="#008a98" class="c-color-picker"></li>
    <li class="cf"><span class="label"><?php _e('Sub color', 'tcd-w'); ?></span><input type="text" name="sub_color" value="<?php echo esc_attr($sub_color); ?>" data-default-color="#006e7d" class="c-color-picker"></li>
    <li class="cf"><span class="label"><?php _e('Font color of content link', 'tcd-w'); ?></span><input type="text" name="content_link_font_color" value="<?php echo esc_attr($content_link_font_color); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
    <li class="cf"><span class="label"><?php _e('Featured icon color', 'tcd-w'); ?></span><input type="text" name="icon_color" value="<?php echo esc_attr($icon_color); ?>" data-default-color="#008a98" class="c-color-picker"></li>
   </ul>

   <h4 class="theme_option_headline2"><?php printf(__('Description for %s list', 'tcd-w'), $product_label); ?></h4>
   <textarea class="full_width" cols="50" rows="3" name="short_desc"><?php echo esc_textarea($short_desc); ?></textarea>

   <h4 class="theme_option_headline2"><?php _e('Image for footer carousel', 'tcd-w'); ?></h4>
   <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '470', '290'); ?></p>
   <?php mlcf_media_form('carousel_image', __('Image for mega menu', 'tcd-w')); ?>

   <h4 class="theme_option_headline2"><?php _e('Text for featured icon', 'tcd-w'); ?></h4>
   <textarea class="full_width" cols="50" rows="2" name="featured_text"><?php echo esc_textarea($featured_text); ?></textarea>

   <h4 class="theme_option_headline2"><?php printf(__('%s type setting', 'tcd-w'), $product_label); ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php printf(__('Set this %1$s as recommend %2$s', 'tcd-w'), $product_label, $product_label); ?></span><input name="recommend_post" type="checkbox" value="1" <?php checked( $recommend_post, 1 ); ?>></li>
    <li class="cf"><span class="label"><?php printf(__('Set this %1$s as featured %2$s', 'tcd-w'), $product_label, $product_label); ?></span><input name="featured_post" type="checkbox" value="1" <?php checked( $featured_post, 1 ); ?>></li>
   </ul>

   <ul class="button_list cf">
    <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div><!-- END .theme_option_field_ac_content -->
 </div><!-- END .theme_option_field -->

 <?php // ヘッダーの設定 -------------------------------------------------------------- ?>
 <div class="theme_option_field cf theme_option_field_ac">
  <h3 class="theme_option_headline"><?php _e('Header setting', 'tcd-w'); ?></h3>
  <div class="theme_option_field_ac_content">

   <div class="theme_option_message2">
    <p><?php _e('Font style and color can be set from the theme option page.', 'tcd-w');  ?></p>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w'); ?></h4>
   <textarea class="full_width" cols="50" rows="3" name="header_catch"><?php echo esc_textarea($header_catch); ?></textarea>

   <h4 class="theme_option_headline2"><?php _e('Subtitle', 'tcd-w'); ?></h4>
   <p><input class="full_width" type="text" name="header_sub_title" value="<?php echo esc_attr($header_sub_title); ?>" /></p>

   <h4 class="theme_option_headline2"><?php _e('Layer image', 'tcd-w'); ?></h4>
   <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '500', '500'); ?></p>
   <?php mlcf_media_form('layer_image', __('Layer image', 'tcd-w')); ?>

   <h4 class="theme_option_headline2"><?php _e('Layer image (mobile)', 'tcd-w'); ?></h4>
   <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '500', '500'); ?></p>
   <?php mlcf_media_form('layer_image_mobile', __('Layer image (mobile)', 'tcd-w')); ?>

   <h4 class="theme_option_headline2"><?php _e('Animation for layer image', 'tcd-w'); ?></h4>
   <select name="image_animation_type">
    <option style="padding-right: 10px;" value="type1" <?php selected( $image_animation_type, 'type1' ); ?>><?php _e('No animation', 'tcd-w'); ?></option>
    <option style="padding-right: 10px;" value="type2" <?php selected( $image_animation_type, 'type2' ); ?>><?php _e('Fade in', 'tcd-w'); ?></option>
    <option style="padding-right: 10px;" value="type3" <?php selected( $image_animation_type, 'type3' ); ?>><?php _e('Slide in from left', 'tcd-w'); ?></option>
    <option style="padding-right: 10px;" value="type4" <?php selected( $image_animation_type, 'type4' ); ?>><?php _e('Slide in from right', 'tcd-w'); ?></option>
   </select>

   <h4 class="theme_option_headline2"><?php _e('Image blur for background image', 'tcd-w');  ?></h4>
   <div class="theme_option_message2">
    <p><?php _e('The higher the number image will be blurry.', 'tcd-w');  ?></p>
   </div>
   <select name="image_blur">
    <?php for($i=1; $i<= 10; $i++): ?>
    <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $image_blur, $i ); ?>><?php echo esc_html($i); ?></option>
    <?php endfor; ?>
    <option style="padding-right: 10px;" value="no_blur" <?php selected( $image_blur, 'no_blur' ); ?>><?php _e('No image blur', 'tcd-w'); ?></option>
   </select>

   <h4 class="theme_option_headline2"><?php _e('Display position', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Horizontal position of layer image', 'tcd-w');  ?></span>
     <select name="image_layout">
      <?php foreach ( $content_direction_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $image_layout, $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Vertical position of layer image', 'tcd-w');  ?></span>
     <select name="image_layout2">
      <?php $i = 1; foreach ( $content_direction_options2 as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $image_layout2, $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php $i++; } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Position of text content', 'tcd-w');  ?></span>
     <select name="text_layout">
      <?php foreach ( $content_direction_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $text_layout, $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Horizontal position of layer image (mobile)', 'tcd-w');  ?></span>
     <select name="image_layout_mobile">
      <?php foreach ( $content_direction_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $image_layout_mobile, $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Button setting', 'tcd-w'); ?></h4>
   <p class="displayment_checkbox"><label><input name="show_header_button" type="checkbox" value="1" <?php checked( $show_header_button, 1 ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
   <div style="<?php if($show_header_button == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('label', 'tcd-w'); ?></span><input class="full_width" type="text" name="header_button_label" value="<?php echo esc_attr( $header_button_label ); ?>" /></li>
     <li class="cf"><span class="label"><?php _e('URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="header_button_url" value="<?php echo esc_attr( $header_button_url ); ?>"></li>
     <li class="cf"><span class="label"><?php _e('Open link in new window', 'tcd-w'); ?></span><input name="header_button_target" type="checkbox" value="1" <?php checked( $header_button_target, 1 ); ?>></li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="header_button_font_color" value="<?php echo esc_attr( $header_button_font_color ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="header_button_border_color" value="<?php echo esc_attr( $header_button_border_color ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf">
      <span class="label"><?php _e('Transparency of border color', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="header_button_border_color_opacity" value="<?php echo esc_attr( $header_button_border_color_opacity ); ?>" />
      <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
       <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
      </div>
     </li>
     <li class="cf"><span class="label"><?php _e('Font color on mouseover', 'tcd-w'); ?></span><input type="text" name="header_button_font_color_hover" value="<?php echo esc_attr( $header_button_font_color_hover ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input type="text" name="header_button_bg_color_hover" value="<?php echo esc_attr( $header_button_bg_color_hover ); ?>" data-default-color="#208a96" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Border color on mouseover', 'tcd-w'); ?></span><input type="text" name="header_button_border_color_hover" value="<?php echo esc_attr( $header_button_border_color_hover ); ?>" data-default-color="#208a96" class="c-color-picker"></li>
     <li class="cf">
      <span class="label"><?php _e('Transparency of border color on mouseover', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="header_button_border_color_hover_opacity" value="<?php echo esc_attr( $header_button_border_color_hover_opacity ); ?>" />
      <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
       <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
      </div>
     </li>
     <li class="cf"><span class="label"><?php _e('Hover effect', 'tcd-w');  ?></span>
      <select name="header_button_animation">
       <option style="padding-right: 10px;" value="type1" <?php selected( $header_button_animation, 'type1' ); ?>><?php _e('No hover effect', 'tcd-w');  ?></option>
       <option style="padding-right: 10px;" value="type2" <?php selected( $header_button_animation, 'type2' ); ?>><?php _e('Swipe animation', 'tcd-w');  ?></option>
       <option style="padding-right: 10px;" value="type3" <?php selected( $header_button_animation, 'type3' ); ?>><?php _e('Diagonal swipe animation', 'tcd-w');  ?></option>
      </select>
     </li>
    </ul>
   </div>

   <h3 class="theme_option_headline2"><?php _e( 'Overlay setting', 'tcd-w' ); ?></h3>
   <div class="theme_option_message2">
    <p><?php _e('By using overlay color, you can adjust the brightness of the image or create a mysterious impression.', 'tcd-w'); ?></p>
   </div>
   <p class="displayment_checkbox"><label for="header_use_overlay"><input id="header_use_overlay" type="checkbox" name="header_use_overlay" value="1" <?php if( $header_use_overlay == '1' ) { echo 'checked="checked"'; }; ?> /><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
   <div class="blog_show_overlay" style="<?php if($header_use_overlay == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="header_overlay_color" value="<?php echo esc_attr($header_overlay_color); ?>" data-default-color="#000000" class="c-color-picker" /></li>
     <li class="cf">
      <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" type="text" name="header_overlay_opacity" value="<?php echo esc_attr($header_overlay_opacity); ?>" />
      <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
       <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
      </div>
     </li>
    </ul>
   </div>

   <ul class="button_list cf">
    <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div><!-- END .theme_option_field_ac_content -->
 </div><!-- END .theme_option_field -->

 <?php // サイドコンテンツの設定 -------------------------------------------------------------- ?>
 <div class="theme_option_field cf theme_option_field_ac">
  <h3 class="theme_option_headline"><?php _e('Side content setting', 'tcd-w'); ?></h3>
  <div class="theme_option_field_ac_content">

   <div class="theme_option_message2">
    <p><?php _e('Font style and color can be set from the theme option page.', 'tcd-w');  ?></p>
   </div>

   <h4 class="theme_option_headline2"><?php _e( 'Display position', 'tcd-w' ); ?></h4>
   <div class="theme_option_message2">
    <p><?php _e('Content width will be 1000px if you don\'t display side content.', 'tcd-w');  ?></p>
   </div>
   <select name="side_content_layout" id="side_content_layout">
    <?php foreach ( $layout_options as $option ) { ?>
    <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $side_content_layout, $option['value'] ); ?>><?php echo $option['label']; ?></option>
    <?php }; ?>
   </select>

   <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w'); ?></h4>
   <textarea class="full_width" cols="50" rows="3" name="side_catch"><?php echo esc_textarea($side_catch); ?></textarea>

   <h4 class="theme_option_headline2"><?php _e('Description (top)', 'tcd-w'); ?></h4>
   <textarea class="full_width" cols="50" rows="3" name="side_desc_top"><?php echo esc_textarea($side_desc_top); ?></textarea>

   <h4 class="theme_option_headline2"><?php _e('Label of price', 'tcd-w'); ?></h4>
   <p><input class="full_width" type="text" name="side_price_label" value="<?php echo esc_attr($side_price_label); ?>" /></p>

   <h4 class="theme_option_headline2"><?php _e('Price', 'tcd-w'); ?></h4>
   <p><input class="full_width" type="text" name="side_price" value="<?php echo esc_attr($side_price); ?>" /></p>

   <h4 class="theme_option_headline2"><?php _e('Tax displayment setting', 'tcd-w'); ?></h4>
   <select name="side_price_tax_type">
    <option style="padding-right: 10px;" value="type1" <?php selected( $side_price_tax_type, 'type1' ); ?>><?php _e('Don\'t display anything', 'tcd-w'); ?></option>
    <option style="padding-right: 10px;" value="type2" <?php selected( $side_price_tax_type, 'type2' ); ?>><?php _e('Display including tax label', 'tcd-w'); ?></option>
    <option style="padding-right: 10px;" value="type3" <?php selected( $side_price_tax_type, 'type3' ); ?>><?php _e('Display excluding tax label', 'tcd-w'); ?></option>
   </select>

   <h4 class="theme_option_headline2"><?php _e( 'Button setting', 'tcd-w' ); ?></h4>
   <div class="theme_option_message2">
    <p><?php _e('You can change order by dragging each item.', 'tcd-w'); ?></p>
   </div>
   <?php //繰り返しフィールド ----- ?>
   <div class="repeater-wrapper">
    <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
     <?php
          if ( $side_button_list ) :
            foreach ( $side_button_list as $key => $value ) :
              if(!isset($value['background_color'])) { $value['border_color'] = '#000000'; };
              if(!isset($value['border_color'])) { $value['border_color'] = '#000000'; };
              if(!isset($value['border_color_opacity'])) { $value['border_color_opacity'] = '1'; };
              if(!isset($value['background_color_hover'])) { $value['border_color_hover'] = '#333333'; };
              if(!isset($value['border_color_hover'])) { $value['border_color_hover'] = '#333333'; };
              if(!isset($value['border_color_hover_opacity'])) { $value['border_color_hover_opacity'] = '1'; };
              if(!isset($value['animation_type'])) { $value['animation_type'] = 'type1'; };
     ?>
     <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-w' ); ?></h4>
      <div class="sub_box_content">
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('label', 'tcd-w'); ?></span><input class="repeater-label full_width" type="text" name="side_button_list[<?php echo esc_attr( $key ); ?>][label]" value="<?php echo esc_attr( $value['label'] ); ?>" /></li>
        <li class="cf"><span class="label"><?php _e('URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="side_button_list[<?php echo esc_attr( $key ); ?>][url]" value="<?php echo esc_attr( $value['url'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('Open link in new window', 'tcd-w'); ?></span><input name="side_button_list[<?php echo esc_attr( $key ); ?>][target]" type="hidden" value="0"><input name="side_button_list[<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>></li>
        <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="side_button_list[<?php echo esc_attr( $key ); ?>][font_color]" value="<?php echo esc_attr( $value['font_color'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
        <li class="cf button_animation_option_type1"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="side_button_list[<?php echo esc_attr( $key ); ?>][background_color]" value="<?php echo esc_attr( $value['background_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="side_button_list[<?php echo esc_attr( $key ); ?>][border_color]" value="<?php echo esc_attr( $value['border_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
        <li class="cf">
         <span class="label"><?php _e('Transparency of border', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="side_button_list[<?php echo esc_attr( $key ); ?>][border_color_opacity]" value="<?php echo esc_attr( $value['border_color_opacity'] ); ?>" />
         <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
          <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
         </div>
        </li>
        <li class="cf"><span class="label"><?php _e('Font color on mouseover', 'tcd-w'); ?></span><input type="text" name="side_button_list[<?php echo esc_attr( $key ); ?>][font_color_hover]" value="<?php echo esc_attr( $value['font_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input type="text" name="side_button_list[<?php echo esc_attr( $key ); ?>][background_color_hover]" value="<?php echo esc_attr( $value['background_color_hover'] ); ?>" data-default-color="#333333" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Border color on mouseover', 'tcd-w'); ?></span><input type="text" name="side_button_list[<?php echo esc_attr( $key ); ?>][border_color_hover]" value="<?php echo esc_attr( $value['border_color_hover'] ); ?>" data-default-color="#333333" class="c-color-picker"></li>
        <li class="cf">
         <span class="label"><?php _e('Transparency of border on mouseover', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="side_button_list[<?php echo esc_attr( $key ); ?>][border_color_hover_opacity]" value="<?php echo esc_attr( $value['border_color_hover_opacity'] ); ?>" />
         <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
          <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
         </div>
        </li>
        <li class="cf"><span class="label"><?php _e('Hover effect', 'tcd-w');  ?></span>
         <select class="button_animation_option" name="side_button_list[<?php echo esc_attr( $key ); ?>][animation_type]">
          <option style="padding-right: 10px;" value="type1" <?php selected( $value['animation_type'] , 'type1' ); ?>><?php _e('No hover effect', 'tcd-w');  ?></option>
          <option style="padding-right: 10px;" value="type2" <?php selected( $value['animation_type'], 'type2' ); ?>><?php _e('Swipe animation', 'tcd-w');  ?></option>
          <option style="padding-right: 10px;" value="type3" <?php selected( $value['animation_type'], 'type3' ); ?>><?php _e('Diagonal swipe animation', 'tcd-w');  ?></option>
         </select>
        </li>
       </ul>
       <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php
            endforeach;
          endif;
          $key = 'addindex';
          $value = array(
             'label' => '',
             'url' => '',
             'target' => '',
             'url' => '',
             'target' => '',
             'font_color' => '#ffffff',
             'background_color' => '#000000',
             'border_color' => '#000000',
             'border_color_opacity' => '1',
             'font_color_hover' => '#ffffff',
             'border_color_hover' => '#333333',
             'border_color_hover_opacity' => '1',
             'background_color_hover' => '#333333',
             'animation_type' => 'type1',
          );
          ob_start();
     ?>
     <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-w' ); ?></h4>
      <div class="sub_box_content">
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('label', 'tcd-w'); ?></span><input class="repeater-label full_width" type="text" name="side_button_list[<?php echo esc_attr( $key ); ?>][label]" value="<?php echo esc_attr( $value['label'] ); ?>" /></li>
        <li class="cf"><span class="label"><?php _e('URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="side_button_list[<?php echo esc_attr( $key ); ?>][url]" value="<?php echo esc_attr( $value['url'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('Open link in new window', 'tcd-w'); ?></span><input name="side_button_list[<?php echo esc_attr( $key ); ?>][target]" type="hidden" value="0"><input name="side_button_list[<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>></li>
        <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="side_button_list[<?php echo esc_attr( $key ); ?>][font_color]" value="<?php echo esc_attr( $value['font_color'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
        <li class="cf button_animation_option_type1"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="side_button_list[<?php echo esc_attr( $key ); ?>][background_color]" value="<?php echo esc_attr( $value['background_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="side_button_list[<?php echo esc_attr( $key ); ?>][border_color]" value="<?php echo esc_attr( $value['border_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
        <li class="cf">
         <span class="label"><?php _e('Transparency of border', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="side_button_list[<?php echo esc_attr( $key ); ?>][border_color_opacity]" value="<?php echo esc_attr( $value['border_color_opacity'] ); ?>" />
         <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
          <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
         </div>
        </li>
        <li class="cf"><span class="label"><?php _e('Font color on mouseover', 'tcd-w'); ?></span><input type="text" name="side_button_list[<?php echo esc_attr( $key ); ?>][font_color_hover]" value="<?php echo esc_attr( $value['font_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input type="text" name="side_button_list[<?php echo esc_attr( $key ); ?>][background_color_hover]" value="<?php echo esc_attr( $value['background_color_hover'] ); ?>" data-default-color="#333333" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Border color on mouseover', 'tcd-w'); ?></span><input type="text" name="side_button_list[<?php echo esc_attr( $key ); ?>][border_color_hover]" value="<?php echo esc_attr( $value['border_color_hover'] ); ?>" data-default-color="#333333" class="c-color-picker"></li>
        <li class="cf">
         <span class="label"><?php _e('Transparency of border on mouseover', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="side_button_list[<?php echo esc_attr( $key ); ?>][border_color_hover_opacity]" value="<?php echo esc_attr( $value['border_color_hover_opacity'] ); ?>" />
         <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
          <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
         </div>
        </li>
        <li class="cf"><span class="label"><?php _e('Hover effect', 'tcd-w');  ?></span>
         <select class="button_animation_option" name="side_button_list[<?php echo esc_attr( $key ); ?>][animation_type]">
          <option style="padding-right: 10px;" value="type1" <?php selected( $value['animation_type'] , 'type1' ); ?>><?php _e('No hover effect', 'tcd-w');  ?></option>
          <option style="padding-right: 10px;" value="type2" <?php selected( $value['animation_type'], 'type2' ); ?>><?php _e('Swipe animation', 'tcd-w');  ?></option>
          <option style="padding-right: 10px;" value="type3" <?php selected( $value['animation_type'], 'type3' ); ?>><?php _e('Diagonal swipe animation', 'tcd-w');  ?></option>
         </select>
        </li>
       </ul>
       <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php
          $clone = ob_get_clean();
     ?>
    </div><!-- END .repeater -->
    <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add item', 'tcd-w' ); ?></a>
   </div><!-- END .repeater-wrapper -->
   <?php // 繰り返しフィールドここまで ----- ?>

   <h4 class="theme_option_headline2"><?php _e('Description (bottom)', 'tcd-w'); ?></h4>
   <textarea class="full_width" cols="50" rows="3" name="side_desc_bottom"><?php echo esc_textarea($side_desc_bottom); ?></textarea>

   <ul class="button_list cf">
    <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div><!-- END .theme_option_field_ac_content -->
 </div><!-- END .theme_option_field -->

 <?php // メインコンテンツの設定 -------------------------------------------------------------- ?>
 <div class="theme_option_field cf theme_option_field_ac">
  <h3 class="theme_option_headline"><?php _e('Main content setting', 'tcd-w'); ?></h3>
  <div class="theme_option_field_ac_content">

   <div class="theme_option_message2">
    <p><?php _e('Font style and color can be set from the theme option page.', 'tcd-w');  ?></p>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w'); ?></h4>
   <textarea class="full_width" cols="50" rows="3" name="content_catch"><?php echo esc_textarea($content_catch); ?></textarea>

   <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w'); ?></h4>
   <textarea class="full_width" cols="50" rows="3" name="content_desc"><?php echo esc_textarea($content_desc); ?></textarea>

   <h4 class="theme_option_headline2"><?php _e('Image at the top of the content', 'tcd-w'); ?></h4>
   <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '800', '500'); ?></p>
   <?php mlcf_media_form('content_image', __('Image at the top of the content', 'tcd-w')); ?>

   <h4 class="theme_option_headline2"><?php _e('Content link button', 'tcd-w'); ?></h4>
   <div class="theme_option_message2">
    <p><?php _e('This button will be displayed at the end of the content link button.', 'tcd-w');  ?></p>
   </div>
   <p class="displayment_checkbox"><label><input name="show_content_link_button" type="checkbox" value="1" <?php checked( $show_content_link_button, 1 ); ?>><?php _e( 'Display content link button', 'tcd-w' ); ?></label></p>
   <div style="<?php if($show_content_link_button == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('label', 'tcd-w'); ?></span><input class="full_width" type="text" name="content_link_button_label" value="<?php echo esc_attr( $content_link_button_label ); ?>" /></li>
     <li class="cf"><span class="label"><?php _e('URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="content_link_button_url" value="<?php echo esc_attr( $content_link_button_url ); ?>"></li>
     <li class="cf"><span class="label"><?php _e('Open link in new window', 'tcd-w'); ?></span><input name="content_link_button_target" type="checkbox" value="1" <?php checked( $content_link_button_target, 1 ); ?>></li>
    </ul>
   </div>

   <ul class="button_list cf">
    <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div><!-- END .theme_option_field_ac_content -->
 </div><!-- END .theme_option_field -->

 <div class="theme_option_message">
  <?php echo __( '<p>You can build contents freely with this function.</p><br /><p>STEP1: Click Add content button.<br />STEP2: Select content from dropdown product.<br />STEP3: Input data and save the option.</p><br /><p>You can change order by dragging MOVE button and you can delete content by clicking DELETE button.</p>', 'tcd-w' ); ?>
 </div>


 <?php
      // コンテンツビルダーはここから -----------------------------------------------------------------
 ?>
 <div class="contents_builder">
  <p class="cb_message"><?php _e( 'Click Add content button to start content builder', 'tcd-w' ); ?></p>
  <?php
       if ( $product_cf && is_array( $product_cf ) ) :
         foreach( $product_cf as $key => $content ) :
           $cb_index = 'cb_' . $key . '_' . mt_rand( 0, 999999 );
  ?>
  <div class="cb_row">
   <ul class="cb_button cf">
    <li><span class="cb_move"><?php _e( 'Move', 'tcd-w' ); ?></span></li>
    <li><span class="cb_delete"><?php _e( 'Delete', 'tcd-w' ); ?></span></li>
   </ul>
   <div class="cb_column_area cf">
    <div class="cb_column">
     <input type="hidden" class="cb_index" value="<?php echo $cb_index; ?>">
     <?php
          the_page_cb_content_select( $cb_index, $content['cb_content_select'] );
          if ( ! empty( $content['cb_content_select'] ) ) :
            product_cf_content_setting( $cb_index, $content['cb_content_select'], $content );
          endif;
     ?>
    </div><!-- END .cb_column -->
   </div><!-- END .cb_column_area -->
  </div><!-- END .cb_row -->
  <?php
         endforeach;
       endif;
  ?>
 </div><!-- END .contents_builder -->
 <ul class="button_list cf cb_add_row_buttton_area">
  <li><input type="button" value="<?php _e( 'Add content', 'tcd-w' ); ?>" class="button-ml add_row"></li>
 </ul>

 <?php // コンテンツビルダー追加用 非表示 ?>
 <div class="contents_builder-clone hidden">
  <div class="cb_row">
   <ul class="cb_button cf">
    <li><span class="cb_move"><?php _e( 'Move', 'tcd-w' ); ?></span></li>
    <li><span class="cb_delete"><?php _e( 'Delete', 'tcd-w' ); ?></span></li>
   </ul>
   <div class="cb_column_area cf">
    <div class="cb_column">
     <input type="hidden" class="cb_index" value="cb_cloneindex">
       <?php the_page_cb_content_select( 'cb_cloneindex' ); ?>
    </div><!-- END .cb_column -->
   </div><!-- END .cb_column_area -->
  </div><!-- END .cb_row -->
  <?php
       foreach ( page_cb_get_contents() as $key => $value ) :
         product_cf_content_setting( 'cb_cloneindex', $key );
       endforeach;
  ?>
 </div><!-- END .contents_builder-clone -->

</div><!-- END .tcd_custom_field_wrap -->
<?php
}

function save_product_cf_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['product_cf_meta_box_nonce']) || !wp_verify_nonce($_POST['product_cf_meta_box_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // check permissions
  if ('page' == $_POST['post_type']) {
    if (!current_user_can('edit_page', $post_id)) {
      return $post_id;
    }
  } elseif (!current_user_can('edit_post', $post_id)) {
      return $post_id;
  }

  // save or delete
  $cf_keys = array(
    'main_color','sub_color','icon_color','content_link_font_color','short_desc','carousel_image','featured_text','recommend_post','featured_post',
    'layer_image','layer_image_mobile','header_catch','header_sub_title','image_layout', 'image_layout2', 'text_layout', 'image_layout_mobile', 'image_animation_type', 'image_blur',
    'show_header_button', 'header_button_label', 'header_button_url', 'header_button_target','header_button_font_color','header_button_font_color_hover','header_button_border_color','header_button_border_color_hover','header_button_border_opacity','header_button_bg_color_hover','header_button_animation',
    'header_use_overlay','header_overlay_color','header_overlay_opacity',
    'content_catch','content_desc','content_image','show_content_link_button', 'content_link_button_label', 'content_link_button_url', 'content_link_button_target',
    'side_content_layout','side_catch','side_desc_top','side_price_label','side_price','side_desc_bottom','side_price_tax_type'
  );
  foreach ($cf_keys as $cf_key) {
    $old = get_post_meta($post_id, $cf_key, true);

    if (isset($_POST[$cf_key])) {
      $new = $_POST[$cf_key];
    } else {
      $new = '';
    }

    if ($new && $new != $old) {
      update_post_meta($post_id, $cf_key, $new);
    } elseif ('' == $new && $old) {
      delete_post_meta($post_id, $cf_key, $old);
    }
  }

  // repeater save or delete
  $cf_keys = array( 'side_button_list');
  foreach ( $cf_keys as $cf_key ) {
    $old = get_post_meta( $post_id, $cf_key, true );

    if ( isset( $_POST[$cf_key] ) && is_array( $_POST[$cf_key] ) ) {
      $new = array_values( $_POST[$cf_key] );
    } else {
      $new = false;
    }

    if ( $new && $new != $old ) {
      update_post_meta( $post_id, $cf_key, $new );
    } elseif ( ! $new && $old ) {
      delete_post_meta( $post_id, $cf_key, $old );
    }
  }

	// コンテンツビルダー 整形保存
	if ( ! empty( $_POST['product_cf'] ) && is_array( $_POST['product_cf'] ) ) {
		$cb_contents = page_cb_get_contents();
		$cb_data = array();

		// レビューユニークキー用配列
		$review_unique_keys = array();

		foreach ( $_POST['product_cf'] as $key => $value ) {
			// クローン用はスルー
			if ( 'cb_cloneindex' === $key ) continue;

			// コンテンツデフォルト値に入力値をマージ
			if ( ! empty( $value['cb_content_select'] ) && isset( $cb_contents[$value['cb_content_select']]['default'] ) ) {
				$value = array_merge( (array) $cb_contents[$value['cb_content_select']]['default'], $value );
			}

			// 特徴リスト
			if ( 'featured_list' === $value['cb_content_select'] ) {

				$value['show_content'] = ! empty( $value['show_content'] ) ? 1 : 0;
				$value['show_border'] = ! empty( $value['show_border'] ) ? 1 : 0;

        $value['headline'] = wp_filter_nohtml_kses( $value['headline'] );
        $value['headline_font_size'] = wp_filter_nohtml_kses( $value['headline_font_size'] );
        $value['headline_font_size_mobile'] = wp_filter_nohtml_kses( $value['headline_font_size_mobile'] );
        $value['headline_font_type'] = wp_filter_nohtml_kses( $value['headline_font_type'] );

        $value['sub_title'] = wp_filter_nohtml_kses( $value['sub_title'] );
        $value['sub_title_font_size'] = wp_filter_nohtml_kses( $value['sub_title_font_size'] );
        $value['sub_title_font_size_mobile'] = wp_filter_nohtml_kses( $value['sub_title_font_size_mobile'] );

				$item_list = array();
				if ( $value['item_list'] && is_array( $value['item_list'] ) ) {
					foreach( array_values( $value['item_list'] ) as $repeater_value ) {
						$item_list[] = array_merge( $cb_contents[$value['cb_content_select']]['item_list_default'], $repeater_value );
					}
				}
				$value['item_list'] = $item_list;

        $value['list_font_size'] = wp_filter_nohtml_kses( $value['list_font_size'] );
        $value['list_font_size_mobile'] = wp_filter_nohtml_kses( $value['list_font_size_mobile'] );
        $value['list_layout'] = wp_filter_nohtml_kses( $value['list_layout'] );

			// レビュー
			} elseif ( 'review' === $value['cb_content_select'] ) {

				$value['show_border'] = ! empty( $value['show_border'] ) ? 1 : 0;

        $value['headline'] = wp_filter_nohtml_kses( $value['headline'] );
        $value['headline_font_size'] = wp_filter_nohtml_kses( $value['headline_font_size'] );
        $value['headline_font_size_mobile'] = wp_filter_nohtml_kses( $value['headline_font_size_mobile'] );
        $value['headline_font_type'] = wp_filter_nohtml_kses( $value['headline_font_type'] );

        $value['sub_title'] = wp_filter_nohtml_kses( $value['sub_title'] );
        $value['sub_title_font_size'] = wp_filter_nohtml_kses( $value['sub_title_font_size'] );
        $value['sub_title_font_size_mobile'] = wp_filter_nohtml_kses( $value['sub_title_font_size_mobile'] );

				$item_list = array();
				if ( $value['item_list'] && is_array( $value['item_list'] ) ) {
					foreach( array_values( $value['item_list'] ) as $repeater_key => $repeater_value ) {
						$item_list[$repeater_key] = array_merge( $cb_contents[$value['cb_content_select']]['item_list_default'], $repeater_value );

						// レビューユニークキー未指定なら生成
						if (empty($item_list[$repeater_key]['unique_id'])) {
							do {
								// 0-9a-z
								$unique_id = strtolower( wp_generate_password( 8, false, false ) );
							} while ( in_array( $unique_id, $review_unique_keys ) );

							$item_list[$repeater_key]['unique_id'] = $unique_id;
							$review_unique_keys[] = $unique_id;
						}
					}
				}
				$value['item_list'] = $item_list;

				$value['list_sort'] = wp_filter_nohtml_kses( $value['list_sort'] );
				$value['list_per_page'] = absint( $value['list_per_page'] );
				$value['use_review_vote'] = ! empty( $value['use_review_vote'] ) ? 1 : 0;
				$value['review_vote_result_text'] = wp_filter_nohtml_kses( $value['review_vote_result_text'] );
				$value['text_before_review_vote_button'] = wp_filter_nohtml_kses( $value['text_before_review_vote_button'] );

        $value['list_font_size'] = wp_filter_nohtml_kses( $value['list_font_size'] );
        $value['list_font_size_mobile'] = wp_filter_nohtml_kses( $value['list_font_size_mobile'] );
        $value['list_bg_color'] = wp_filter_nohtml_kses( $value['list_bg_color'] );

			// フリースペース
			} elseif ( 'free_space' === $value['cb_content_select'] ) {

				$value['show_content'] = ! empty( $value['show_content'] ) ? 1 : 0;
				$value['show_border'] = ! empty( $value['show_border'] ) ? 1 : 0;

        $value['headline'] = wp_filter_nohtml_kses( $value['headline'] );
        $value['headline_font_size'] = wp_filter_nohtml_kses( $value['headline_font_size'] );
        $value['headline_font_size_mobile'] = wp_filter_nohtml_kses( $value['headline_font_size_mobile'] );
        $value['headline_font_type'] = wp_filter_nohtml_kses( $value['headline_font_type'] );

        $value['sub_title'] = wp_filter_nohtml_kses( $value['sub_title'] );
        $value['sub_title_font_size'] = wp_filter_nohtml_kses( $value['sub_title_font_size'] );
        $value['sub_title_font_size_mobile'] = wp_filter_nohtml_kses( $value['sub_title_font_size_mobile'] );

				$value['desc'] = $value['desc'];
				$value['desc_font_size'] = absint( $value['desc_font_size'] );
				$value['desc_font_size_mobile'] = absint( $value['desc_font_size_mobile'] );

			}

			$cb_data[] = $value;
		}

		if ( $cb_data ) {
			update_post_meta( $post_id, 'product_cf', $cb_data );
		} else {
			delete_post_meta( $post_id, 'product_cf' );
		}
	}
}
add_action('save_post', 'save_product_cf_meta_box');


/**
 * コンテンツビルダー コンテンツ一覧取得
 */
function page_cb_get_contents() {
  $options = get_design_plus_option();
  $product_label = $options['product_label'] ? esc_html( $options['product_label'] ) : __( 'Menu', 'tcd-w' );
	return array(
    // 特徴リスト
		'featured_list' => array(
			'name' => 'featured_list',
			'label' => __('Featured list', 'tcd-w'),
			'default' => array(
				'show_content' => 1,
				'show_border' => 1,
				'headline' => '',
				'headline_font_size' => 26,
				'headline_font_size_mobile' => 20,
				'headline_font_type' => 'type2',
				'sub_title' => '',
				'sub_title_font_size' => 12,
				'sub_title_font_size_mobile' => 11,
				'item_list' => array(),
				'list_font_size' => 14,
				'list_font_size_mobile' => 12,
				'list_layout' => 'type2',
				'retina' => '',
			),
			'item_list_default' => array(
				'image' => '',
				'desc' => '',
			),
		),
    // レビュー
		'review' => array(
			'name' => 'review',
			'label' => __('Review', 'tcd-w'),
			'default' => array(
				'show_content' => 1,
				'show_border' => 1,
				'headline' => '',
				'headline_font_size' => 26,
				'headline_font_size_mobile' => 20,
				'headline_font_type' => 'type2',
				'sub_title' => '',
				'sub_title_font_size' => 12,
				'sub_title_font_size_mobile' => 11,
				'item_list' => array(),
				'list_sort' => 'none',
				'list_per_page' => 10,
				'use_review_vote' => true,
				'review_vote_result_text' => __( '%1$d out of %2$d people voted that this review was helpful.', 'tcd-w' ),
				'text_before_review_vote_button' => __( 'Did you find this review helpful?', 'tcd-w' ),
				'list_bg_color' => '#fbfbfb',
				'list_font_size' => 16,
				'list_font_size_mobile' => 14,
			),
			'item_list_default' => array(
				'unique_id' => '',
				'name' => '',
				'date' => '',
				'rating' => 3,
				'desc' => ''
			),
		),
    // フリースペース
		'free_space' => array(
			'name' => 'free_space',
			'label' => __( 'Free space', 'tcd-w' ),
			'default' => array(
				'show_content' => 1,
				'show_border' => 1,
				'headline' => '',
				'headline_font_size' => 26,
				'headline_font_size_mobile' => 20,
				'headline_font_type' => 'type2',
				'sub_title' => '',
				'sub_title_font_size' => 12,
				'sub_title_font_size_mobile' => 11,
				'desc' => '',
				'desc_font_size' => 16,
				'desc_font_size_mobile' => 14,
			)
		)
	);
}

/**
 * コンテンツビルダー用 コンテンツ選択プルダウン
 */
function the_page_cb_content_select( $cb_index = 'cb_cloneindex', $selected = null ) {
	$cb_contents = page_cb_get_contents();

	if ( $selected && isset( $cb_contents[$selected] ) ) {
		$add_class = ' hidden';
	} else {
		$add_class = '';
	}

	$out = '<select name="product_cf[' . esc_attr( $cb_index ) . '][cb_content_select]" class="cb_content_select' . $add_class . '">';
	$out .= '<option value="">' . __( 'Choose the content', 'tcd-w' ) . '</option>';

	foreach ( $cb_contents as $key => $value ) {
		$out .= '<option value="' . esc_attr( $key ) . '"' . selected( $key, $selected, false ) . '>' . esc_html( $value['label'] ) . '</option>';
	}

	$out .= '</select>';

	echo $out;
}

/**
 * コンテンツビルダー用 コンテンツ設定
 */
function product_cf_content_setting( $cb_index = 'cb_cloneindex', $cb_content_select = null, $value = array() ) {

  global $font_type_options, $free_space_options, $content_width_options, $review_sort_options, $review_rating_options;

	$cb_contents = page_cb_get_contents();

	// 不明なコンテンツの場合は終了
	if ( ! $cb_content_select || ! isset( $cb_contents[$cb_content_select] ) ) return false;

	// コンテンツデフォルト値に入力値をマージ
	if ( isset( $cb_contents[$cb_content_select]['default'] ) ) {
		$value = array_merge( (array) $cb_contents[$cb_content_select]['default'], $value );
	}
?>
  <div class="cb_content_wrap cf <?php echo esc_attr( $cb_content_select ); ?>">

  <?php
      // 特徴リスト -------------------------------------------------------------------------
      if ( 'featured_list' === $cb_content_select ) :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?><span></span></h3>
  <div class="cb_content">

   <p class="hidden"><input name="product_cf[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p><label><input name="product_cf[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><?php printf(__('Display %s', 'tcd-w'), $cb_contents[$cb_content_select]['label']); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
   <input class="cb-repeater-label full_width" type="text" name="product_cf[<?php echo $cb_index; ?>][headline]" value="<?php esc_attr_e( $value['headline'] ); ?>" />
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="product_cf[<?php echo $cb_index; ?>][headline_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['headline_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="product_cf[<?php echo $cb_index; ?>][headline_font_size]" value="<?php esc_attr_e( $value['headline_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="product_cf[<?php echo $cb_index; ?>][headline_font_size_mobile]" value="<?php esc_attr_e( $value['headline_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Subtitle', 'tcd-w');  ?></h4>
   <input class="full_width" type="text" name="product_cf[<?php echo $cb_index; ?>][sub_title]" value="<?php esc_attr_e( $value['sub_title'] ); ?>" />
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="product_cf[<?php echo $cb_index; ?>][sub_title_font_size]" value="<?php esc_attr_e( $value['sub_title_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="product_cf[<?php echo $cb_index; ?>][sub_title_font_size_mobile]" value="<?php esc_attr_e( $value['sub_title_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <?php // リピーターここから -------------------------- ?>
   <h4 class="theme_option_headline2"><?php _e('Featured list setting', 'tcd-w');  ?></h4>
   <div class="theme_option_message2">
    <p><?php _e( 'Click add new content button to add content.<br />You can change order by dragging content header.', 'tcd-w' ); ?></p>
   </div>
   <div class="repeater-wrapper">
    <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
     <?php
          if ( $value['item_list'] && is_array( $value['item_list'] ) ) :
            foreach ( $value['item_list'] as $repeater_key => $repeater_value ) :
               $repeater_value = array_merge( $cb_contents[$cb_content_select]['item_list_default'], $repeater_value );
     ?>
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'Content', 'tcd-w' ); echo esc_html( $repeater_key + 1 ); ?></h4>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
       <div class="theme_option_message2">
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '128', '128'); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js">
         <input type="hidden" class="cf_media_id" name="product_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image]" id="item_list-<?php echo $cb_index; ?>-item_list-<?php echo esc_attr( $repeater_key ); ?>-image" value="<?php echo esc_attr( $repeater_value['image'] ); ?>">
         <div class="preview_field"><?php if ( $repeater_value['image'] ) echo wp_get_attachment_image( $repeater_value['image'], 'medium' ); ?></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( ! $repeater_value['image'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
       <textarea class="repeater-label full_width" cols="50" rows="3" name="product_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][desc]"><?php echo esc_textarea(  $repeater_value['desc'] ); ?></textarea>
       <ul class="button_list cf">
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
        <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete content', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php
            endforeach;
          endif;

          $repeater_key = 'addindex';
          $repeater_value = $cb_contents[$cb_content_select]['item_list_default'];
          ob_start();
     ?>
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'New content', 'tcd-w' ); ?></h4>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
       <div class="theme_option_message2">
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '128', '128'); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js">
         <input type="hidden" class="cf_media_id" name="product_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image]" id="item_list-<?php echo $cb_index; ?>-item_list-<?php echo esc_attr( $repeater_key ); ?>-image" value="">
         <div class="preview_field"></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( ! $repeater_value['image'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
       <textarea class="repeater-label full_width" cols="50" rows="3" name="product_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][desc]"></textarea>
       <ul class="button_list cf">
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
        <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete content', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php
          $clone = ob_get_clean();
     ?>
    </div><!-- END .repeater -->
    <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add content', 'tcd-w' ); ?></a>
   </div><!-- END .repeater-wrapper -->
   <?php // リピーターここまで -------------------------- ?>
   <p class="hidden"><input name="product_cf[<?php echo $cb_index; ?>][retina]" type="hidden" value="0"></p>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Layout', 'tcd-w'); ?></span>
     <select name="product_cf[<?php echo $cb_index; ?>][list_layout]">
      <option style="padding-right: 10px;" value="type1" <?php selected( $value['list_layout'], 'type1' ); ?>><?php _e('Display in 1 columns', 'tcd-w'); ?></option>
      <option style="padding-right: 10px;" value="type2" <?php selected( $value['list_layout'], 'type2' ); ?>><?php _e('Display in 2 columns', 'tcd-w'); ?></option>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="product_cf[<?php echo $cb_index; ?>][list_font_size]" value="<?php esc_attr_e( $value['list_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="product_cf[<?php echo $cb_index; ?>][list_font_size_mobile]" value="<?php esc_attr_e( $value['list_font_size_mobile'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Use retina display image', 'tcd-w');  ?></span><input name="product_cf[<?php echo $cb_index; ?>][retina]" type="checkbox" value="1" <?php checked( '1', $value['retina'] ); ?> /></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Under line setting', 'tcd-w');  ?></h4>
   <p class="hidden"><input name="product_cf[<?php echo $cb_index; ?>][show_border]" type="hidden" value="0"></p>
   <p><label><input name="product_cf[<?php echo $cb_index; ?>][show_border]" type="checkbox" value="1" <?php checked( $value['show_border'], 1 ); ?>><?php _e('Display border under content', 'tcd-w'); ?></label></p>

   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div><!-- END .cb_content -->

  <?php
      // レビュー -------------------------------------------------------------------------
      elseif ( 'review' === $cb_content_select ) :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?><span></span></h3>
  <div class="cb_content">

   <p class="hidden"><input name="product_cf[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p><label><input name="product_cf[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><?php printf(__('Display %s', 'tcd-w'), $cb_contents[$cb_content_select]['label']); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
   <input class="cb-repeater-label full_width" type="text" name="product_cf[<?php echo $cb_index; ?>][headline]" value="<?php esc_attr_e( $value['headline'] ); ?>" />
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="product_cf[<?php echo $cb_index; ?>][headline_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['headline_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="product_cf[<?php echo $cb_index; ?>][headline_font_size]" value="<?php esc_attr_e( $value['headline_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="product_cf[<?php echo $cb_index; ?>][headline_font_size_mobile]" value="<?php esc_attr_e( $value['headline_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Subtitle', 'tcd-w');  ?></h4>
   <input class="full_width" type="text" name="product_cf[<?php echo $cb_index; ?>][sub_title]" value="<?php esc_attr_e( $value['sub_title'] ); ?>" />
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="product_cf[<?php echo $cb_index; ?>][sub_title_font_size]" value="<?php esc_attr_e( $value['sub_title_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="product_cf[<?php echo $cb_index; ?>][sub_title_font_size_mobile]" value="<?php esc_attr_e( $value['sub_title_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <?php // リピーターここから -------------------------- ?>
   <h4 class="theme_option_headline2"><?php _e('Content list setting', 'tcd-w');  ?></h4>
   <div class="theme_option_message2">
    <p><?php _e( 'Click add new content button to add content.<br />You can change order by dragging content header.', 'tcd-w' ); ?></p>
   </div>
   <div class="repeater-wrapper">
    <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
     <?php
          if ( $value['item_list'] && is_array( $value['item_list'] ) ) :
            foreach ( $value['item_list'] as $repeater_key => $repeater_value ) :
               $repeater_value = array_merge( $cb_contents[$cb_content_select]['item_list_default'], $repeater_value );
     ?>
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'Content', 'tcd-w' ); echo esc_html( $repeater_key + 1 ); ?></h4>
      <div class="sub_box_content">
       <input type="hidden" name="product_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][unique_id]" value="<?php echo esc_attr( $repeater_value['unique_id'] ); ?>" />
       <h4 class="theme_option_headline2"><?php _e( 'Name', 'tcd-w' ); ?></h4>
       <input class="repeater-label full_width" type="text" name="product_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][name]" value="<?php echo esc_attr( $repeater_value['name'] ); ?>" />
       <h4 class="theme_option_headline2"><?php _e( 'Date', 'tcd-w' ); ?></h4>
       <input class="item_list_date" type="text" name="product_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][date]" value="<?php echo esc_attr( $repeater_value['date'] ); ?>" size="12" />
       <h4 class="theme_option_headline2"><?php _e( 'Star rating', 'tcd-w' ); ?></h4>
       <select name="product_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][rating]">
        <?php foreach ( $review_rating_options as $option ) { ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $repeater_value['rating'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
       <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
       <textarea class="full_width" cols="50" rows="3" name="product_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][desc]"><?php echo esc_textarea(  $repeater_value['desc'] ); ?></textarea>
       <ul class="button_list cf">
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
        <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete content', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php
            endforeach;
          endif;

          $repeater_key = 'addindex';
          $repeater_value = $cb_contents[$cb_content_select]['item_list_default'];
          ob_start();
     ?>
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'New content', 'tcd-w' ); ?></h4>
      <div class="sub_box_content">
       <input type="hidden" name="product_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][unique_id]" value="<?php echo esc_attr( $repeater_value['unique_id'] ); ?>" />
       <h4 class="theme_option_headline2"><?php _e( 'Name', 'tcd-w' ); ?></h4>
       <input class="repeater-label full_width" type="text" name="product_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][name]" value="<?php echo esc_attr( $repeater_value['name'] ); ?>" />
       <h4 class="theme_option_headline2"><?php _e( 'Date', 'tcd-w' ); ?></h4>
       <input class="item_list_date" type="text" name="product_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][date]" value="<?php echo esc_attr( $repeater_value['date'] ); ?>" size="12" />
       <h4 class="theme_option_headline2"><?php _e( 'Star rating', 'tcd-w' ); ?></h4>
       <select name="product_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][rating]">
        <?php foreach ( $review_rating_options as $option ) { ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $repeater_value['rating'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
       <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
       <textarea class="full_width" cols="50" rows="3" name="product_cf[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][desc]"><?php echo esc_textarea(  $repeater_value['desc'] ); ?></textarea>
       <ul class="button_list cf">
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
        <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete content', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php
          $clone = ob_get_clean();
     ?>
    </div><!-- END .repeater -->
    <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add content', 'tcd-w' ); ?></a>
   </div><!-- END .repeater-wrapper -->
   <?php // リピーターここまで -------------------------- ?>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Sort reviews ', 'tcd-w');  ?></span>     <select name="product_cf[<?php echo $cb_index; ?>][list_sort]">
      <?php foreach ( $review_sort_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['list_sort'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Review list per page', 'tcd-w'); ?></span><input class="small-text" type="number" name="product_cf[<?php echo $cb_index; ?>][list_per_page]" value="<?php echo absint( $value['list_per_page'] ); ?>" min="1" /></li>
    <li class="cf"><span class="label"><?php _e( 'Use review vote', 'tcd-w' ); ?></span>
     <input name="product_cf[<?php echo $cb_index; ?>][use_review_vote]" type="hidden" value="0">
     <input class="checkbox-use_review_vote" name="product_cf[<?php echo $cb_index; ?>][use_review_vote]" type="checkbox" value="1" <?php checked( $value['use_review_vote'], 1 ); ?>>
    </li>
    <li class="cf review_vote hidden">
     <span class="label"><?php _e('Review vote results text', 'tcd-w'); ?></span><input class="full_width" type="text" name="product_cf[<?php echo $cb_index; ?>][review_vote_result_text]" value="<?php echo esc_attr( $value['review_vote_result_text'] ); ?>" />
     <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
      <p><?php _e('Please do not edit the word <strong>%1$d</strong> and <strong>%2$d</strong>. Review number will not be reflected correctly.', 'tcd-w');  ?></p>
      <p><?php _e('Please copy and paste the text below if you want to initialize.', 'tcd-w');  ?><br><?php _e( '%1$d out of %2$d people voted that this review was helpful.', 'tcd-w' ); ?></p>
     </div>
    </li>
    <li class="cf review_vote hidden"><span class="label"><?php _e('Text before the review vote button', 'tcd-w'); ?></span><input class="full_width" type="text" name="product_cf[<?php echo $cb_index; ?>][text_before_review_vote_button]" value="<?php echo esc_attr( $value['text_before_review_vote_button'] ); ?>" /></li>
    <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="product_cf[<?php echo $cb_index; ?>][list_bg_color]" value="<?php echo esc_attr( $value['list_bg_color'] ); ?>" data-default-color="#fbfbfb" class="c-color-picker"></li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="product_cf[<?php echo $cb_index; ?>][list_font_size]" value="<?php esc_attr_e( $value['list_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="product_cf[<?php echo $cb_index; ?>][list_font_size_mobile]" value="<?php esc_attr_e( $value['list_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Under line setting', 'tcd-w');  ?></h4>
   <p class="hidden"><input name="product_cf[<?php echo $cb_index; ?>][show_border]" type="hidden" value="0"></p>
   <p><label><input name="product_cf[<?php echo $cb_index; ?>][show_border]" type="checkbox" value="1" <?php checked( $value['show_border'], 1 ); ?>><?php _e('Display border under content', 'tcd-w'); ?></label></p>

   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div><!-- END .cb_content -->

  <?php
       // フリースペース -------------------------------------------------------------------------
       elseif ( 'free_space' === $cb_content_select ) :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?><span></span></h3>
  <div class="cb_content">

   <p class="hidden"><input name="product_cf[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p><label><input name="product_cf[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><?php printf(__('Display %s', 'tcd-w'), $cb_contents[$cb_content_select]['label']); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
   <input class="cb-repeater-label full_width" type="text" name="product_cf[<?php echo $cb_index; ?>][headline]" value="<?php esc_attr_e( $value['headline'] ); ?>" />
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="product_cf[<?php echo $cb_index; ?>][headline_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['headline_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="product_cf[<?php echo $cb_index; ?>][headline_font_size]" value="<?php esc_attr_e( $value['headline_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="product_cf[<?php echo $cb_index; ?>][headline_font_size_mobile]" value="<?php esc_attr_e( $value['headline_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Subtitle', 'tcd-w');  ?></h4>
   <input class="full_width" type="text" name="product_cf[<?php echo $cb_index; ?>][sub_title]" value="<?php esc_attr_e( $value['sub_title'] ); ?>" />
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="product_cf[<?php echo $cb_index; ?>][sub_title_font_size]" value="<?php esc_attr_e( $value['sub_title_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="product_cf[<?php echo $cb_index; ?>][sub_title_font_size_mobile]" value="<?php esc_attr_e( $value['sub_title_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
   <?php wp_editor( $value['desc'], 'cb_wysiwyg_editor-' . $cb_index, array ('textarea_name' => 'product_cf[' . $cb_index . '][desc]')); ?>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="product_cf[<?php echo $cb_index; ?>][desc_font_size]" value="<?php esc_attr_e( $value['desc_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="product_cf[<?php echo $cb_index; ?>][desc_font_size_mobile]" value="<?php esc_attr_e( $value['desc_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Under line setting', 'tcd-w');  ?></h4>
   <p class="hidden"><input name="product_cf[<?php echo $cb_index; ?>][show_border]" type="hidden" value="0"></p>
   <p><label><input name="product_cf[<?php echo $cb_index; ?>][show_border]" type="checkbox" value="1" <?php checked( $value['show_border'], 1 ); ?>><?php _e('Display border under content', 'tcd-w'); ?></label></p>

   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div><!-- END .cb_content -->


  <?php
       // ボタンを表示 ----------------------------------------------------------------------------
       else :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_content_select ); ?></h3>
  <div class="cb_content">
   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div>
  <?php endif; ?>

  </div><!-- END .cb_content_wrap -->
<?php
}

/**
 * クローン用のリッチエディター化処理をしないようにする
 * クローン後のリッチエディター化はjsで行う
 */
function product_cb_tiny_mce_before_init( $mceInit, $editor_id ) {
	if ( strpos( $editor_id, 'cb_cloneindex' ) !== false ) {
		$mceInit['wp_skip_init'] = true;
	}
	return $mceInit;
}
add_filter( 'tiny_mce_before_init', 'product_cb_tiny_mce_before_init', 10, 2 );






