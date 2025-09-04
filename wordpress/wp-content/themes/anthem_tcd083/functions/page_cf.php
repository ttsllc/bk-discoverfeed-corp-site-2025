<?php

/* フォーム用 画像フィールド出力 */
function mlcf_media_form($cf_key, $label) {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($label)) $label = $cf_key;

	$media_id = get_post_meta($post->ID, $cf_key, true);
?>
 <div class="image_box cf">
  <div class="cf cf_media_field hide-if-no-js <?php echo esc_attr($cf_key); ?>">
    <input type="hidden" class="cf_media_id" name="<?php echo esc_attr($cf_key); ?>" id="<?php echo esc_attr($cf_key); ?>" value="<?php echo esc_attr($media_id); ?>" />
    <div class="preview_field"><?php if ($media_id) the_mlcf_image($post->ID, $cf_key); ?></div>
    <div class="buttton_area">
     <input type="button" class="cfmf-select-img button" value="<?php _e('Select Image', 'tcd-w'); ?>" />
     <input type="button" class="cfmf-delete-img button<?php if (!$media_id) echo ' hidden'; ?>" value="<?php _e('Remove Image', 'tcd-w'); ?>" />
    </div>
  </div>
 </div>
<?php
}




/* 画像フィールドで選択された画像をimgタグで出力 */
function the_mlcf_image($post_id, $cf_key, $image_size = 'medium') {
	echo get_mlcf_image($post_id, $cf_key, $image_size);
}

/* 画像フィールドで選択された画像をimgタグで返す */
function get_mlcf_image($post_id, $cf_key, $image_size = 'medium') {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($post_id)) $post_id = $post->ID;

	$media_id = get_post_meta($post_id, $cf_key, true);
	if ($media_id) {
		return wp_get_attachment_image($media_id, $image_size, $image_size);
	}

	return false;
}

/* 画像フィールドで選択された画像urlを返す */
function get_mlcf_image_url($post_id, $cf_key, $image_size = 'medium') {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($post_id)) $post_id = $post->ID;

	$media_id = get_post_meta($post_id, $cf_key, true);
	if ($media_id) {
		$img = wp_get_attachment_image_src($media_id, $image_size);
		if (!empty($img[0])) {
			return $img[0];
		}
	}

	return false;
}

/* 画像フィールドで選択されたメディアのURLを出力 */
function the_mlcf_media_url($post_id, $cf_key) {
	echo get_mlcf_media_url($post_id, $cf_key);
}

/* 画像フィールドで選択されたメディアのURLを返す */
function get_mlcf_media_url($post_id, $cf_key) {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($post_id)) $post_id = $post->ID;

	$media_id = get_post_meta($post_id, $cf_key, true);
	if ($media_id) {
		return wp_get_attachment_url($media_id);
	}

	return false;
}


// ヘッダーの設定 -------------------------------------------------------

function page_header_meta_box() {
  add_meta_box(
    'page_header_meta_box',//ID of meta box
    __('Header setting', 'tcd-w'),//label
    'show_page_header_meta_box',//callback function
    'page',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'page_header_meta_box');

function show_page_header_meta_box() {

  global $post, $layout_options, $font_type_options, $content_direction_options, $content_direction_options2;

  $page_header_catch = get_post_meta($post->ID, 'page_header_catch', true);
  $page_header_catch_font_size = get_post_meta($post->ID, 'page_header_catch_font_size', true) ?  get_post_meta($post->ID, 'page_header_catch_font_size', true) : '36';
  $page_header_catch_font_size_mobile = get_post_meta($post->ID, 'page_header_catch_font_size_mobile', true) ?  get_post_meta($post->ID, 'page_header_catch_font_size_mobile', true) : '20';
  $page_header_catch_font_color = get_post_meta($post->ID, 'page_header_catch_font_color', true) ?  get_post_meta($post->ID, 'page_header_catch_font_color', true) : '#ffffff';
  $page_header_catch_font_type = get_post_meta($post->ID, 'page_header_catch_font_type', true) ?  get_post_meta($post->ID, 'page_header_catch_font_type', true) : 'type3';

  $page_header_sub_title = get_post_meta($post->ID, 'page_header_sub_title', true);
  $page_header_sub_title_font_size = get_post_meta($post->ID, 'page_header_sub_title_font_size', true) ?  get_post_meta($post->ID, 'page_header_sub_title_font_size', true) : '16';
  $page_header_sub_title_font_size_mobile = get_post_meta($post->ID, 'page_header_sub_title_font_size_mobile', true) ?  get_post_meta($post->ID, 'page_header_sub_title_font_size_mobile', true) : '14';
  $page_header_sub_title_font_type = get_post_meta($post->ID, 'page_header_sub_title_font_type', true) ?  get_post_meta($post->ID, 'page_header_sub_title_font_type', true) : 'type2';
  $page_header_sub_title_font_color = get_post_meta($post->ID, 'page_header_sub_title_font_color', true) ?  get_post_meta($post->ID, 'page_header_sub_title_font_color', true) : '#ffffff';

  $page_header_desc = get_post_meta($post->ID, 'page_header_desc', true);
  $page_header_desc_mobile = get_post_meta($post->ID, 'page_header_desc_mobile', true);
  $page_header_desc_font_size = get_post_meta($post->ID, 'page_header_desc_font_size', true) ?  get_post_meta($post->ID, 'page_header_desc_font_size', true) : '16';
  $page_header_desc_font_size_mobile = get_post_meta($post->ID, 'page_header_desc_font_size_mobile', true) ?  get_post_meta($post->ID, 'page_header_desc_font_size_mobile', true) : '14';
  $page_header_desc_font_color = get_post_meta($post->ID, 'page_header_desc_font_color', true) ?  get_post_meta($post->ID, 'page_header_desc_font_color', true) : '#ffffff';

  $image_layout = get_post_meta($post->ID, 'image_layout', true) ?  get_post_meta($post->ID, 'image_layout', true) : 'type3';
  $image_layout2 = get_post_meta($post->ID, 'image_layout2', true) ?  get_post_meta($post->ID, 'image_layout2', true) : 'type2';
  $image_layout_mobile = get_post_meta($post->ID, 'image_layout_mobile', true) ?  get_post_meta($post->ID, 'image_layout_mobile', true) : 'type3';
  $text_layout = get_post_meta($post->ID, 'text_layout', true) ?  get_post_meta($post->ID, 'text_layout', true) : 'type1';
  $image_animation_type = get_post_meta($post->ID, 'image_animation_type', true) ?  get_post_meta($post->ID, 'image_animation_type', true) : 'type1';

  $image_blur = get_post_meta($post->ID, 'image_blur', true) ?  get_post_meta($post->ID, 'image_blur', true) : '10';

  $page_header_use_overlay = get_post_meta($post->ID, 'page_header_use_overlay', true);
  $page_header_overlay_color = get_post_meta($post->ID, 'page_header_overlay_color', true) ?  get_post_meta($post->ID, 'page_header_overlay_color', true) : '#000000';
  $page_header_overlay_opacity = get_post_meta($post->ID, 'page_header_overlay_opacity', true) ?  get_post_meta($post->ID, 'page_header_overlay_opacity', true) : '0.3';

  $page_content_font_size = get_post_meta($post->ID, 'page_content_font_size', true) ?  get_post_meta($post->ID, 'page_content_font_size', true) : '16';
  $page_content_font_size_mobile = get_post_meta($post->ID, 'page_content_font_size_mobile', true) ?  get_post_meta($post->ID, 'page_content_font_size_mobile', true) : '14';

  $page_hide_header = get_post_meta($post->ID, 'page_hide_header', true);
  $page_hide_header_image = get_post_meta($post->ID, 'page_hide_header_image', true);
  $page_hide_content_link = get_post_meta($post->ID, 'page_hide_content_link', true);
  $page_hide_footer = get_post_meta($post->ID, 'page_hide_footer', true);
  $change_content_width = get_post_meta($post->ID, 'change_content_width', true);

  $page_content_width = get_post_meta($post->ID, 'page_content_width', true) ?  get_post_meta($post->ID, 'page_content_width', true) : '1200';

  $contents_link_button = get_post_meta($post->ID, 'contents_link_button', true);
  $content_link_color1 = get_post_meta($post->ID, 'content_link_color1', true) ?  get_post_meta($post->ID, 'content_link_color1', true) : '#008a98';
  $content_link_color2 = get_post_meta($post->ID, 'content_link_color2', true) ?  get_post_meta($post->ID, 'content_link_color2', true) : '#006e7d';
  $content_link_font_color = get_post_meta($post->ID, 'content_link_font_color', true) ?  get_post_meta($post->ID, 'content_link_font_color', true) : '#ffffff';
  $content_link_font_size = get_post_meta($post->ID, 'content_link_font_size', true) ?  get_post_meta($post->ID, 'content_link_font_size', true) : '16';
  $content_link_font_size_mobile = get_post_meta($post->ID, 'content_link_font_size_mobile', true) ?  get_post_meta($post->ID, 'content_link_font_size_mobile', true) : '12';
  $fixed_content_link = get_post_meta($post->ID, 'fixed_content_link', true);

  echo '<input type="hidden" name="page_header_custom_fields_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>

<?php
     // WP5.0対策として隠しフィールドを用意　選択されているページテンプレートによってABOUT入力欄を表示・非表示する
     if ( count( get_page_templates( $post ) ) > 0 && get_option( 'page_for_posts' ) != $post->ID ) :
       $template = ! empty( $post->page_template ) ? $post->page_template : false;
?>
<select name="hidden_page_template" id="hidden_page_template" style="display:none;">
 <option value="default">Default Template</option>
 <?php page_template_dropdown( $template, 'page' ); ?>
</select>
<?php endif; ?>

<div class="tcd_custom_field_wrap">

  <div class="theme_option_field cf theme_option_field_ac">
   <h3 class="theme_option_headline"><?php _e( 'Basic setting', 'tcd-w' ); ?></h3>
   <div class="theme_option_field_ac_content">
    <h4 class="theme_option_headline2"><?php _e( 'Display setting', 'tcd-w' ); ?></h4>
    <div class="theme_option_message2">
     <p><?php _e('Please use the option below if you want to make this page like Landing page.', 'tcd-w'); ?></p>
    </div>
    <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Hide header', 'tcd-w'); ?></span><input name="page_hide_header" type="checkbox" value="1" <?php checked( $page_hide_header, 1 ); ?>></li>
     <li class="cf hide_page_header"><span class="label"><?php _e('Hide header image', 'tcd-w'); ?></span><input name="page_hide_header_image" type="checkbox" value="1" <?php checked( $page_hide_header_image, 1 ); ?>></li>
     <li class="cf hide_content_link"><span class="label"><?php _e('Hide content link button', 'tcd-w'); ?></span><input name="page_hide_content_link" type="checkbox" value="1" <?php checked( $page_hide_content_link, 1 ); ?>></li>
     <li class="cf"><span class="label"><?php _e('Hide footer', 'tcd-w'); ?></span><input name="page_hide_footer" type="checkbox" value="1" <?php checked( $page_hide_footer, 1 ); ?>></li>
     <li class="cf change_content_width"><span class="label"><?php _e('Change content width', 'tcd-w'); ?></span><input name="change_content_width" type="checkbox" value="1" <?php checked( $change_content_width, 1 ); ?>></li>
    </ul>
    <div id="page_option_content_width_setting" style="<?php if($change_content_width) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e( 'Content width', 'tcd-w' ); ?></h4>
      <p><input class="hankaku page_content_width_input" style="width:100px;" type="number" max="1200" name="page_content_width" value="<?php echo esc_attr($page_content_width); ?>" /><span>px</span></p>
    </div>
    <div id="page_option_content_font_size_setting" style="display:none;">
     <h4 class="theme_option_headline2"><?php _e( 'Other setting', 'tcd-w' ); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size of content', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="page_content_font_size" value="<?php echo esc_attr($page_content_font_size); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of content (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="page_content_font_size_mobile" value="<?php echo esc_attr($page_content_font_size_mobile); ?>" /><span>px</span></li>
     </ul>
    </div>
    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->

  <div class="theme_option_field cf theme_option_field_ac" id="page_header_setting_area" style="<?php if($page_hide_header_image){ echo 'display:none;'; } else { echo 'display:block;'; }; ?>">
   <h3 class="theme_option_headline"><?php _e( 'Header setting', 'tcd-w' ); ?></h3>
   <div class="theme_option_field_ac_content">

    <h3 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w'); ?></h3>
    <textarea class="full_width" cols="50" rows="2" name="page_header_catch"><?php echo esc_textarea(  $page_header_catch ); ?></textarea>
    <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
      <select name="page_header_catch_font_type">
       <?php foreach ( $font_type_options as $option ) { ?>
       <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $page_header_catch_font_type, $option['value'] ); ?>><?php echo $option['label']; ?></option>
       <?php } ?>
      </select>
     </li>
     <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="page_header_catch_font_size" value="<?php echo esc_attr($page_header_catch_font_size); ?>" /><span>px</span></li>
     <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="page_header_catch_font_size_mobile" value="<?php echo esc_attr($page_header_catch_font_size_mobile); ?>" /><span>px</span></li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="page_header_catch_font_color" value="<?php echo esc_attr($page_header_catch_font_color); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
    </ul>

    <h3 class="theme_option_headline2"><?php _e('Subtitle', 'tcd-w'); ?></h3>
    <textarea class="full_width" cols="50" rows="2" name="page_header_sub_title"><?php echo esc_textarea(  $page_header_sub_title ); ?></textarea>
    <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
      <select name="page_header_sub_title_font_type">
       <?php foreach ( $font_type_options as $option ) { ?>
       <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $page_header_sub_title_font_type, $option['value'] ); ?>><?php echo $option['label']; ?></option>
       <?php } ?>
      </select>
     </li>
     <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="page_header_sub_title_font_size" value="<?php echo esc_attr($page_header_sub_title_font_size); ?>" /><span>px</span></li>
     <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="page_header_sub_title_font_size_mobile" value="<?php echo esc_attr($page_header_sub_title_font_size_mobile); ?>" /><span>px</span></li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="page_header_sub_title_font_color" value="<?php echo esc_attr($page_header_sub_title_font_color); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
    </ul>

    <h3 class="theme_option_headline2"><?php _e('Description', 'tcd-w'); ?></h3>
    <textarea class="full_width" cols="50" rows="3" name="page_header_desc"><?php echo esc_textarea(  $page_header_desc ); ?></textarea>
    <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="page_header_desc_font_size" value="<?php echo esc_attr($page_header_desc_font_size); ?>" /><span>px</span></li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="page_header_desc_font_color" value="<?php echo esc_attr($page_header_desc_font_color); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
    </ul>

    <h3 class="theme_option_headline2"><?php _e('Description (mobile)', 'tcd-w'); ?></h3>
    <textarea class="full_width" cols="50" rows="3" name="page_header_desc_mobile"><?php echo esc_textarea(  $page_header_desc_mobile ); ?></textarea>
    <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="page_header_desc_font_size_mobile" value="<?php echo esc_attr($page_header_desc_font_size_mobile); ?>" /><span>px</span></li>
    </ul>

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

    <h3 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h3>
    <div class="theme_option_message2">
     <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '500'); ?></p>
    </div>
    <?php mlcf_media_form('page_header_bg_image', __('Background image', 'tcd-w')); ?>

    <h3 class="theme_option_headline2"><?php _e( 'Background image (mobile)', 'tcd-w' ); ?></h3>
    <div class="theme_option_message2">
     <p><?php echo __('Please use this option if you want to change background image in mobile device.', 'tcd-w'); ?></p>
     <p><?php printf(__('Recommended size assuming for retina display. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '500'); ?></p>
    </div>
    <?php mlcf_media_form('page_header_bg_image_mobile', __('Background image', 'tcd-w')); ?>

    <h3 class="theme_option_headline2"><?php _e( 'Overlay setting', 'tcd-w' ); ?></h3>
    <div class="theme_option_message2">
     <p><?php _e('By using overlay color, you can adjust the brightness of the image or create a mysterious impression.', 'tcd-w'); ?></p>
    </div>
    <p class="displayment_checkbox"><label for="page_header_use_overlay"><input id="page_header_use_overlay" type="checkbox" name="page_header_use_overlay" value="1" <?php if( $page_header_use_overlay == '1' ) { echo 'checked="checked"'; }; ?> /><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
    <div class="blog_show_overlay" style="<?php if($page_header_use_overlay == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
     <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
      <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="page_header_overlay_color" value="<?php echo esc_attr($page_header_overlay_color); ?>" data-default-color="#000000" class="c-color-picker" /></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" type="text" name="page_header_overlay_opacity" value="<?php echo esc_attr($page_header_overlay_opacity); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
       </div>
      </li>
     </ul>
    </div>

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

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->

  <?php // コンテンツリンクボタン ---------------------------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac content_link_button_setting_area" style="<?php if($page_hide_content_link){ echo 'display:none;'; } else { echo 'display:block;'; }; ?>">
   <h3 class="theme_option_headline"><?php _e( 'Content link button setting', 'tcd-w' ); ?></h3>
   <div class="theme_option_field_ac_content">

    <h3 class="theme_option_headline2"><?php _e( 'Basic setting', 'tcd-w' ); ?></h3>
    <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Main color', 'tcd-w'); ?></span><input type="text" name="content_link_color1" value="<?php echo esc_attr($content_link_color1); ?>" data-default-color="#008a98" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Sub color', 'tcd-w'); ?></span><input type="text" name="content_link_color2" value="<?php echo esc_attr($content_link_color2); ?>" data-default-color="#006e7d" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="content_link_font_color" value="<?php echo esc_attr($content_link_font_color); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="content_link_font_size" value="<?php echo esc_attr($content_link_font_size); ?>" /><span>px</span></li>
     <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="content_link_font_size_mobile" value="<?php echo esc_attr($content_link_font_size_mobile); ?>" /><span>px</span></li>
     <li class="cf"><span class="label"><?php _e('Fixed position to page top on scroll', 'tcd-w'); ?></span><input name="fixed_content_link" type="checkbox" value="1" <?php checked( $fixed_content_link, 1 ); ?>></li>
    </ul>

    <div id="ranking_page_content_link_area">
    <h3 class="theme_option_headline2"><?php _e( 'Link button setting', 'tcd-w' ); ?></h3>
    <div class="theme_option_message2">
     <p><?php _e('You can change order by dragging each item.', 'tcd-w'); ?></p>
    </div>
    <?php //繰り返しフィールド ----- ?>
    <div class="repeater-wrapper">
     <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
      <?php
           if ( $contents_link_button ) :
             foreach ( $contents_link_button as $key => $value ) :
      ?>
      <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
       <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-w' ); ?></h4>
       <div class="sub_box_content">
        <h4 class="theme_option_headline2"><?php _e( 'Name', 'tcd-w' ); ?></h4>
        <input class="repeater-label full_width" type="text" name="contents_link_button[<?php echo esc_attr( $key ); ?>][name]" value="<?php echo esc_attr( $value['name'] ); ?>" />
        <h4 class="theme_option_headline2"><?php _e( 'URL', 'tcd-w' ); ?></h4>
        <input class="full_width" type="text" name="contents_link_button[<?php echo esc_attr( $key ); ?>][url]" value="<?php echo esc_attr( $value['url'] ); ?>" />
        <h4 class="theme_option_headline2"><?php _e( 'Active link setting', 'tcd-w' ); ?></h4>
        <p class="hidden"><input name="contents_link_button[<?php echo esc_attr( $key ); ?>][active]" type="hidden" value="0"></p>
        <p><label><input name="contents_link_button[<?php echo esc_attr( $key ); ?>][active]" type="checkbox" value="1" <?php checked( $value['active'], 1 ); ?>><?php _e( 'Set this button as active link button', 'tcd-w' ); ?></label></p>
        <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
       </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->
      <?php
             endforeach;
           endif;
           $key = 'addindex';
           ob_start();
      ?>
      <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
       <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-w' ); ?></h4>
       <div class="sub_box_content">
        <h4 class="theme_option_headline2"><?php _e( 'Name', 'tcd-w' ); ?></h4>
        <input class="repeater-label full_width" type="text" name="contents_link_button[<?php echo esc_attr( $key ); ?>][name]" value="" />
        <h4 class="theme_option_headline2"><?php _e( 'URL', 'tcd-w' ); ?></h4>
        <input class="full_width" type="text" name="contents_link_button[<?php echo esc_attr( $key ); ?>][url]" value="" />
        <h4 class="theme_option_headline2"><?php _e( 'Active link setting', 'tcd-w' ); ?></h4>
        <p class="hidden"><input name="contents_link_button[<?php echo esc_attr( $key ); ?>][active]" type="hidden" value="0"></p>
        <p><label><input name="contents_link_button[<?php echo esc_attr( $key ); ?>][active]" type="checkbox" value="1"><?php _e( 'Set this button as active link button', 'tcd-w' ); ?></label></p>
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
    </div><!-- END #ranking_page_content_link_area -->

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->

</div><!-- END .tcd_custom_field_wrap -->

<?php
}

function save_page_header_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['page_header_custom_fields_meta_box_nonce']) || !wp_verify_nonce($_POST['page_header_custom_fields_meta_box_nonce'], basename(__FILE__))) {
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
    'fixed_content_link','content_link_color1','content_link_color2','content_link_font_color','content_link_font_size','content_link_font_size_mobile',
    'page_header_catch','page_header_catch_font_size','page_header_catch_font_size_mobile','page_header_catch_font_color','page_header_catch_font_type',
    'page_header_sub_title','page_header_sub_title_font_size','page_header_sub_title_font_size_mobile','page_header_sub_title_font_type','page_header_sub_title_font_color',
    'page_header_desc','page_header_desc_mobile','page_header_desc_font_size','page_header_desc_font_size_mobile','page_header_desc_font_color','page_header_desc_font_type',
    'layer_image','layer_image_mobile','image_layout','image_layout2','image_layout_mobile','text_layout', 'image_animation_type', 'image_blur',
    'page_header_bg_image','page_header_bg_image_mobile','page_header_use_overlay','page_header_overlay_color','page_header_overlay_opacity',
    'page_content_font_size','page_content_font_size_mobile',
    'page_hide_header','page_hide_header_image','page_hide_content_link','page_hide_footer','change_content_width','page_hide_side_bar','page_sub_title_type','page_content_width','page_header_width'
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
  $cf_keys = array( 'contents_link_button');
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

}
add_action('save_post', 'save_page_header_meta_box');



?>