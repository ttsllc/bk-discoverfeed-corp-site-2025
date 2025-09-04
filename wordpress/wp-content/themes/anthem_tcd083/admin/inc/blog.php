<?php
/*
 * ブログの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_blog_dp_default_options' );


//  Add label of blog tab
add_action( 'tcd_tab_labels', 'add_blog_tab_label' );


// Add HTML of blog tab
add_action( 'tcd_tab_panel', 'add_blog_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_blog_theme_options_validate' );


// タブの名前
function add_blog_tab_label( $tab_labels ) {
	$tab_labels['blog'] = __( 'Blog', 'tcd-w' );
	return $tab_labels;
}


// 初期値
function add_blog_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['blog_label'] = __( 'Blog', 'tcd-w' );

	// ヘッダー
	$dp_default_options['blog_show_header'] = 1;
  $dp_default_options['blog_title'] = '';
	$dp_default_options['blog_title_font_size'] = '36';
	$dp_default_options['blog_title_font_size_mobile'] = '24';
	$dp_default_options['blog_title_font_color'] = '#FFFFFF';
	$dp_default_options['blog_title_font_type'] = 'type3';
	$dp_default_options['blog_desc'] = '';
	$dp_default_options['blog_desc_mobile'] = '';
	$dp_default_options['blog_desc_font_size'] = '16';
	$dp_default_options['blog_desc_font_size_mobile'] = '14';
	$dp_default_options['blog_desc_font_color'] = '#FFFFFF';
	$dp_default_options['blog_desc_font_type'] = 'type2';
	$dp_default_options['blog_bg_image'] = false;
	$dp_default_options['blog_bg_image_mobile'] = false;
	$dp_default_options['blog_use_overlay'] = 1;
	$dp_default_options['blog_overlay_color'] = '#000000';
	$dp_default_options['blog_overlay_opacity'] = '0.3';

	// アーカイブページ　記事一覧
	$dp_default_options['archive_blog_bg_color'] = '#f4f4f4';
	$dp_default_options['archive_blog_title_font_type'] = 'type2';
	$dp_default_options['archive_blog_title_font_size'] = '18';
	$dp_default_options['archive_blog_title_font_size_mobile'] = '15';
	$dp_default_options['archive_blog_title_font_color'] = '#2c8a95';
	$dp_default_options['archive_blog_desc_font_size'] = '16';
	$dp_default_options['archive_blog_desc_font_size_mobile'] = '14';
	$dp_default_options['show_archive_blog_date'] = 1;
	$dp_default_options['show_archive_blog_category'] = 1;
	$dp_default_options['show_archive_blog_desc'] = 1;

	// 記事ページ
	$dp_default_options['single_blog_bg_color'] = '#f4f4f4';
	$dp_default_options['single_blog_title_font_size'] = '26';
	$dp_default_options['single_blog_title_font_size_mobile'] = '18';
	$dp_default_options['single_blog_title_font_type'] = 'type2';
	$dp_default_options['single_blog_content_font_size'] = '16';
	$dp_default_options['single_blog_content_font_size_mobile'] = '14';
	$dp_default_options['single_blog_show_date'] = 1;
	$dp_default_options['single_blog_show_update'] = '';
	$dp_default_options['single_blog_show_comment'] = 1;
	$dp_default_options['single_blog_show_trackback'] = 1;
	$dp_default_options['single_blog_show_nav'] = 1;
	$dp_default_options['single_blog_show_image'] = 1;
	$dp_default_options['single_blog_show_sns_top'] = 1;
	$dp_default_options['single_blog_show_sns_btm'] = 1;
	$dp_default_options['single_blog_show_copy_top'] = 1;
	$dp_default_options['single_blog_show_copy_btm'] = 1;
	$dp_default_options['pagenation_type'] = 'type1';
	$dp_default_options['single_blog_show_meta_box'] = '';
	$dp_default_options['single_blog_show_meta_author'] = 1;
	$dp_default_options['single_blog_show_meta_comment'] = 1;
	$dp_default_options['single_blog_layout'] = 'type1';

	// 関連記事
	$dp_default_options['show_related_post'] = 1;
	$dp_default_options['related_post_headline'] = __( 'Related post', 'tcd-w' );
	$dp_default_options['related_post_headline_bg_color'] = '#000000';
	$dp_default_options['related_post_headline_font_size'] = '16';
	$dp_default_options['related_post_headline_font_size_mobile'] = '14';
	$dp_default_options['related_post_num'] = '3';
	$dp_default_options['related_post_num_mobile'] = '3';
	$dp_default_options['related_post_show_category'] = 1;
	$dp_default_options['related_post_show_date'] = 1;

	// コメントの見出し
	$dp_default_options['comment_headline_font_size'] = '16';
	$dp_default_options['comment_headline_font_size_mobile'] = '14';
	$dp_default_options['comment_headline_bg_color'] = '#000000';

	// 記事ページのバナー
	$dp_default_options['single_top_ad_code'] = '';
	$dp_default_options['single_top_ad_image'] = false;
	$dp_default_options['single_top_ad_url'] = '';

	$dp_default_options['single_bottom_ad_code'] = '';
	$dp_default_options['single_bottom_ad_image'] = false;
	$dp_default_options['single_bottom_ad_url'] = '';

	$dp_default_options['single_shortcode_ad_code'] = '';
	$dp_default_options['single_shortcode_ad_image'] = false;
	$dp_default_options['single_shortcode_ad_url'] = '';

	$dp_default_options['single_mobile_ad_code'] = '';
	$dp_default_options['single_mobile_ad_image'] = false;
	$dp_default_options['single_mobile_ad_url'] = '';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_blog_tab_panel( $options ) {

  global $dp_default_options, $pagenation_type_options, $font_type_options, $layout_options;
  $blog_label = $options['blog_label'] ? esc_html( $options['blog_label'] ) : __( 'Blog', 'tcd-w' );

?>

<div id="tab-content-blog" class="tab-content">

   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Basic setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <h4 class="theme_option_headline2"><?php _e('Name of content', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This name will also be used in breadcrumb link.', 'tcd-w'); ?></p>
     </div>
     <input class="full_width" type="text" name="dp_options[blog_label]" value="<?php echo esc_attr($options['blog_label']); ?>" />
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ヘッダーの設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <p class="displayment_checkbox"><label><input name="dp_options[blog_show_header]" type="checkbox" value="1" <?php checked( $options['blog_show_header'], 1 ); ?>><?php _e( 'Display header', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['blog_show_header'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

     <h4 class="theme_option_headline2"><?php _e('Title', 'tcd-w');  ?></h4>
     <input class="full_width" type="text" name="dp_options[blog_title]" value="<?php echo esc_attr( $options['blog_title'] ); ?>" />
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
       <select name="dp_options[blog_title_font_type]">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['blog_title_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[blog_title_font_size]" value="<?php esc_attr_e( $options['blog_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[blog_title_font_size_mobile]" value="<?php esc_attr_e( $options['blog_title_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[blog_title_font_color]" value="<?php echo esc_attr( $options['blog_title_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
     <textarea class="full_width" cols="50" rows="4" name="dp_options[blog_desc]"><?php echo esc_textarea(  $options['blog_desc'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
       <select name="dp_options[blog_desc_font_type]">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['blog_desc_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[blog_desc_font_size]" value="<?php esc_attr_e( $options['blog_desc_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[blog_desc_font_color]" value="<?php echo esc_attr( $options['blog_desc_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Description (mobile)', 'tcd-w');  ?></h4>
     <textarea class="full_width" cols="50" rows="4" name="dp_options[blog_desc_mobile]"><?php echo esc_textarea(  $options['blog_desc_mobile'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[blog_desc_font_size_mobile]" value="<?php esc_attr_e( $options['blog_desc_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Background image', 'tcd-w'); ?></h4>
     <div class="theme_option_message2">
      <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '500'); ?></p>
     </div>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js blog_bg_image">
       <input type="hidden" value="<?php echo esc_attr( $options['blog_bg_image'] ); ?>" id="blog_bg_image" name="dp_options[blog_bg_image]" class="cf_media_id">
       <div class="preview_field"><?php if($options['blog_bg_image']){ echo wp_get_attachment_image($options['blog_bg_image'], 'medium'); }; ?></div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['blog_bg_image']){ echo 'hidden'; }; ?>">
       </div>
      </div>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Background image (mobile)', 'tcd-w'); ?></h4>
     <div class="theme_option_message2">
      <p><?php echo __('Please use this option if you want to change background image in mobile device.', 'tcd-w'); ?></p>
      <p><?php printf(__('Recommended size assuming for retina display. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '1100'); ?></p>
     </div>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js blog_bg_image_mobile">
       <input type="hidden" value="<?php echo esc_attr( $options['blog_bg_image_mobile'] ); ?>" id="blog_bg_image_mobile" name="dp_options[blog_bg_image_mobile]" class="cf_media_id">
       <div class="preview_field"><?php if($options['blog_bg_image_mobile']){ echo wp_get_attachment_image($options['blog_bg_image_mobile'], 'medium'); }; ?></div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['blog_bg_image_mobile']){ echo 'hidden'; }; ?>">
       </div>
      </div>
     </div>

     <h4 class="theme_option_headline2"><?php _e( 'Overlay setting', 'tcd-w' ); ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[blog_use_overlay]" type="checkbox" value="1" <?php checked( $options['blog_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['blog_use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[blog_overlay_color]" value="<?php echo esc_attr( $options['blog_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       <li class="cf">
        <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[blog_overlay_opacity]" value="<?php echo esc_attr( $options['blog_overlay_opacity'] ); ?>" />
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
    <h3 class="theme_option_headline"><?php _e('Archive page setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <h4 class="theme_option_headline2"><?php _e('Background color', 'tcd-w');  ?></h4>
     <p><input type="text" name="dp_options[archive_blog_bg_color]" value="<?php echo esc_attr( $options['archive_blog_bg_color'] ); ?>" data-default-color="#f4f4f4" class="c-color-picker"></p>
     <h4 class="theme_option_headline2"><?php _e('Post list setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
       <select name="dp_options[archive_blog_title_font_type]">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['archive_blog_title_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_blog_title_font_size]" value="<?php esc_attr_e( $options['archive_blog_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of title (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_blog_title_font_size_mobile]" value="<?php esc_attr_e( $options['archive_blog_title_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font color of title', 'tcd-w'); ?></span><input type="text" name="dp_options[archive_blog_title_font_color]" value="<?php echo esc_attr( $options['archive_blog_title_font_color'] ); ?>" data-default-color="#2c8a95" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Font size of excerpt', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_blog_desc_font_size]" value="<?php esc_attr_e( $options['archive_blog_desc_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of excerpt (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_blog_desc_font_size_mobile]" value="<?php esc_attr_e( $options['archive_blog_desc_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Display excerpt', 'tcd-w');  ?></span><input name="dp_options[show_archive_blog_desc]" type="checkbox" value="1" <?php checked( '1', $options['show_archive_blog_desc'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w');  ?></span><input name="dp_options[show_archive_blog_date]" type="checkbox" value="1" <?php checked( '1', $options['show_archive_blog_date'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display category', 'tcd-w');  ?></span><input name="dp_options[show_archive_blog_category]" type="checkbox" value="1" <?php checked( '1', $options['show_archive_blog_category'] ); ?> /></li>
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
     <h4 class="theme_option_headline2"><?php _e('Background color', 'tcd-w');  ?></h4>
     <p><input type="text" name="dp_options[single_blog_bg_color]" value="<?php echo esc_attr( $options['single_blog_bg_color'] ); ?>" data-default-color="#f4f4f4" class="c-color-picker"></p>
     <h4 class="theme_option_headline2"><?php _e('Post title setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
       <select name="dp_options[single_blog_title_font_type]">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['single_blog_title_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_blog_title_font_size]" value="<?php esc_attr_e( $options['single_blog_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w');  ?></span><input class="font_size hankaku" type="text" name="dp_options[single_blog_title_font_size_mobile]" value="<?php esc_attr_e( $options['single_blog_title_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Post content setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size of content', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[single_blog_content_font_size]" value="<?php esc_attr_e( $options['single_blog_content_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of content (mobile)', 'tcd-w');  ?></span><input class="font_size hankaku" type="text" name="dp_options[single_blog_content_font_size_mobile]" value="<?php esc_attr_e( $options['single_blog_content_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Side content position', 'tcd-w');  ?></span>
       <select name="dp_options[single_blog_layout]">
        <?php
             $i = 1;
             foreach ( $layout_options as $option ) {
               if($i != 1){
        ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['single_blog_layout'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
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
      <li class="cf"><span class="label"><?php _e('Display featured image', 'tcd-w');  ?></span><input name="dp_options[single_blog_show_image]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_image'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display date under post title', 'tcd-w');  ?></span><input name="dp_options[single_blog_show_date]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_date'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display update under post title', 'tcd-w');  ?></span><input name="dp_options[single_blog_show_update]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_update'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display next previous link', 'tcd-w');  ?></span><input name="dp_options[single_blog_show_nav]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_nav'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display comment', 'tcd-w');  ?></span><input name="dp_options[single_blog_show_comment]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_comment'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display trackbacks', 'tcd-w');  ?></span><input name="dp_options[single_blog_show_trackback]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_trackback'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display social button under featured image', 'tcd-w');  ?></span><input name="dp_options[single_blog_show_sns_top]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_sns_top'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display social button under post content', 'tcd-w');  ?></span><input name="dp_options[single_blog_show_sns_btm]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_sns_btm'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display "COPY Title&amp;URL" button under featured image', 'tcd-w');  ?></span><input name="dp_options[single_blog_show_copy_top]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_copy_top'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display "COPY Title&amp;URL" button under post content', 'tcd-w');  ?></span><input name="dp_options[single_blog_show_copy_btm]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_copy_btm'] ); ?> /></li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Meta box setting', 'tcd-w');  ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[single_blog_show_meta_box]" type="checkbox" value="1" <?php checked( $options['single_blog_show_meta_box'], 1 ); ?>><?php _e( 'Display meta box', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['single_blog_show_meta_box'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Display author', 'tcd-w');  ?></span><input name="dp_options[single_blog_show_meta_author]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_meta_author'] ); ?> /></li>
       <li class="cf"><span class="label"><?php _e('Display comment', 'tcd-w');  ?></span><input name="dp_options[single_blog_show_meta_comment]" type="checkbox" value="1" <?php checked( '1', $options['single_blog_show_meta_comment'] ); ?> /></li>
      </ul>
     </div>
     <h4 class="theme_option_headline2"><?php _e( 'Pagenation settings', 'tcd-w' ); ?></h4>
     <ul class="design_radio_button image_radio_button cf">
      <?php foreach ( $pagenation_type_options as $option ) : ?>
      <li>
       <input type="radio" id="pagenation_type_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[pagenation_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['pagenation_type'] ); ?>>
       <label for="pagenation_type_<?php esc_attr_e( $option['value'] ); ?>">
        <span><?php echo esc_html( $option['label'] ); ?></span>
        <img src="<?php bloginfo('template_url'); ?>/admin/img/<?php echo esc_attr($option['img']); ?>?ver=1.0.2" alt="" title="" />
       </label>
      </li>
      <?php endforeach; ?>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Related post setting', 'tcd-w');  ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_related_post]" type="checkbox" value="1" <?php checked( $options['show_related_post'], 1 ); ?>><?php _e( 'Display related post', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['show_related_post'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input type="text" class="full_width" name="dp_options[related_post_headline]" value="<?php echo esc_attr($options['related_post_headline']); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Font size of headline', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[related_post_headline_font_size]" value="<?php esc_attr_e( $options['related_post_headline_font_size'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font size of headline (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[related_post_headline_font_size_mobile]" value="<?php esc_attr_e( $options['related_post_headline_font_size_mobile'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Background color of headline', 'tcd-w'); ?></span><input type="text" name="dp_options[related_post_headline_bg_color]" value="<?php echo esc_attr( $options['related_post_headline_bg_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
        <select name="dp_options[related_post_num]">
         <?php for($i=3; $i<= 12; $i++): ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['related_post_num'], $i ); ?>><?php echo esc_html($i); ?></option>
         <?php endfor; ?>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Number of post to display (mobile)', 'tcd-w');  ?></span>
        <select name="dp_options[related_post_num_mobile]">
         <?php for($i=3; $i<= 12; $i++): ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['related_post_num_mobile'], $i ); ?>><?php echo esc_html($i); ?></option>
         <?php endfor; ?>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w');  ?></span><input name="dp_options[related_post_show_date]" type="checkbox" value="1" <?php checked( '1', $options['related_post_show_date'] ); ?> /></li>
       <li class="cf"><span class="label"><?php _e('Display category', 'tcd-w');  ?></span><input name="dp_options[related_post_show_category]" type="checkbox" value="1" <?php checked( '1', $options['related_post_show_category'] ); ?> /></li>
      </ul>
     </div>
     <h4 class="theme_option_headline2"><?php _e('Comment headline setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size of headline', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[comment_headline_font_size]" value="<?php esc_attr_e( $options['comment_headline_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of headline (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[comment_headline_font_size_mobile]" value="<?php esc_attr_e( $options['comment_headline_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Background color of headline', 'tcd-w'); ?></span><input type="text" name="dp_options[comment_headline_bg_color]" value="<?php echo esc_attr( $options['comment_headline_bg_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
     </ul>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 広告 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Banner setting', 'tcd-w'); ?></h3>
    <div class="theme_option_field_ac_content">

     <?php // アイキャッチ画像の下 -------------------------------- ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php _e('Under featured image', 'tcd-w'); ?></h3>
      <div class="sub_box_content">
       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('This banner will be displayed after featured image.', 'tcd-w');  ?></p>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Banner code', 'tcd-w');  ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
       </div>
       <textarea id="dp_options[single_top_ad_code]" class="large-text" cols="50" rows="10" name="dp_options[single_top_ad_code]"><?php echo esc_textarea( $options['single_top_ad_code'] ); ?></textarea>
       <div class="theme_option_message">
        <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Register banner image.', 'tcd-w'); ?></h4>
       <div class="theme_option_message2">
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '300', '250'); ?></p>
        <p><?php printf(__('Maximum image width is %1$spx.', 'tcd-w'), '700'); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js single_top_ad_image">
         <input type="hidden" value="<?php echo esc_attr( $options['single_top_ad_image'] ); ?>" id="single_top_ad_image" name="dp_options[single_top_ad_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['single_top_ad_image']){ echo wp_get_attachment_image($options['single_top_ad_image'], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['single_top_ad_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
       <input id="dp_options[single_top_ad_url]" class="regular-text" type="text" name="dp_options[single_top_ad_url]" value="<?php esc_attr_e( $options['single_top_ad_url'] ); ?>" />
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <?php // 関連記事の上 -------------------------------- ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php _e('Above related post', 'tcd-w'); ?></h3>
      <div class="sub_box_content">
       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('This banner will be displayed before related post.', 'tcd-w');  ?></p>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Banner code', 'tcd-w');  ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
       </div>
       <textarea id="dp_options[single_bottom_ad_code]" class="large-text" cols="50" rows="10" name="dp_options[single_bottom_ad_code]"><?php echo esc_textarea( $options['single_bottom_ad_code'] ); ?></textarea>
       <div class="theme_option_message">
        <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Register banner image.', 'tcd-w'); ?></h4>
       <div class="theme_option_message2">
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '300', '250'); ?></p>
        <p><?php printf(__('Maximum image width is %1$spx.', 'tcd-w'), '700'); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js single_bottom_ad_image">
         <input type="hidden" value="<?php echo esc_attr( $options['single_bottom_ad_image'] ); ?>" id="single_bottom_ad_image" name="dp_options[single_bottom_ad_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['single_bottom_ad_image']){ echo wp_get_attachment_image($options['single_bottom_ad_image'], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['single_bottom_ad_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
       <input id="dp_options[single_bottom_ad_url]" class="regular-text" type="text" name="dp_options[single_bottom_ad_url]" value="<?php esc_attr_e( $options['single_bottom_ad_url'] ); ?>" />
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <?php // ショートコード -------------------------------- ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php _e('Short code', 'tcd-w'); ?></h3>
      <div class="sub_box_content">
       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('Please copy and paste the short code inside the content to show this banner.', 'tcd-w'); ?></p>
       </div>
       <p><?php _e('Short code', 'tcd-w');  ?> : <input type="text" readonly="readonly" value="[s_ad]" /></p>
       <h4 class="theme_option_headline2"><?php _e('Banner code', 'tcd-w');  ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
       </div>
       <textarea id="dp_options[single_shortcode_ad_code]" class="large-text" cols="50" rows="10" name="dp_options[single_shortcode_ad_code]"><?php echo esc_textarea( $options['single_shortcode_ad_code'] ); ?></textarea>
       <div class="theme_option_message">
        <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Register banner image.', 'tcd-w'); ?></h4>
       <div class="theme_option_message2">
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '300', '250'); ?></p>
        <p><?php printf(__('Maximum image width is %1$spx.', 'tcd-w'), '700'); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js single_shortcode_ad_image">
         <input type="hidden" value="<?php echo esc_attr( $options['single_shortcode_ad_image'] ); ?>" id="single_shortcode_ad_image" name="dp_options[single_shortcode_ad_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['single_shortcode_ad_image']){ echo wp_get_attachment_image($options['single_shortcode_ad_image'], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['single_shortcode_ad_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
       <input id="dp_options[single_shortcode_ad_url]" class="regular-text" type="text" name="dp_options[single_shortcode_ad_url]" value="<?php esc_attr_e( $options['single_shortcode_ad_url'] ); ?>" />
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <?php // モバイル用 -------------------------------- ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php _e('Mobile device', 'tcd-w'); ?></h3>
      <div class="sub_box_content">
       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('This banner will be displayed on mobile device.', 'tcd-w');  ?></p>
        <p><?php _e('This banner will be display above related post and will be repleace by banner for PC device.', 'tcd-w');  ?></p>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Banner code', 'tcd-w');  ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
       </div>
       <textarea id="dp_options[single_mobile_ad_code]" class="large-text" cols="50" rows="10" name="dp_options[single_mobile_ad_code]"><?php echo esc_textarea( $options['single_mobile_ad_code'] ); ?></textarea>
       <div class="theme_option_message">
        <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Register banner image.', 'tcd-w'); ?></h4>
       <div class="theme_option_message2">
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '300', '250'); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js single_mobile_ad_image">
         <input type="hidden" value="<?php echo esc_attr( $options['single_mobile_ad_image'] ); ?>" id="single_mobile_ad_image" name="dp_options[single_mobile_ad_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['single_mobile_ad_image']){ echo wp_get_attachment_image($options['single_mobile_ad_image'], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['single_mobile_ad_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
       <input id="dp_options[single_mobile_ad_url]" class="regular-text" type="text" name="dp_options[single_mobile_ad_url]" value="<?php esc_attr_e( $options['single_mobile_ad_url'] ); ?>" />
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_blog_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_blog_theme_options_validate( $input ) {

  global $dp_default_options, $pagenation_type_options, $font_type_options, $layout_options;

  // 基本設定
  $input['blog_label'] = wp_filter_nohtml_kses( $input['blog_label'] );


  //ヘッダーの設定
  $input['blog_show_header'] = ! empty( $input['blog_show_header'] ) ? 1 : 0;
  $input['blog_title'] = wp_filter_nohtml_kses( $input['blog_title'] );
  if ( ! isset( $value['blog_title_font_type'] ) )
    $value['blog_title_font_type'] = null;
  if ( ! array_key_exists( $value['blog_title_font_type'], $font_type_options ) )
    $value['blog_title_font_type'] = null;
  $input['blog_title_font_size'] = wp_filter_nohtml_kses( $input['blog_title_font_size'] );
  $input['blog_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['blog_title_font_size_mobile'] );
  $input['blog_title_font_color'] = wp_filter_nohtml_kses( $input['blog_title_font_color'] );
  $input['blog_desc'] = wp_filter_nohtml_kses( $input['blog_desc'] );
  $input['blog_desc_mobile'] = wp_filter_nohtml_kses( $input['blog_desc_mobile'] );
  if ( ! isset( $value['blog_desc_font_type'] ) )
    $value['blog_desc_font_type'] = null;
  if ( ! array_key_exists( $value['blog_desc_font_type'], $font_type_options ) )
    $value['blog_desc_font_type'] = null;
  $input['blog_desc_font_size'] = wp_filter_nohtml_kses( $input['blog_desc_font_size'] );
  $input['blog_desc_font_size_mobile'] = wp_filter_nohtml_kses( $input['blog_desc_font_size_mobile'] );
  $input['blog_desc_font_color'] = wp_filter_nohtml_kses( $input['blog_desc_font_color'] );
  $input['blog_bg_image'] = wp_filter_nohtml_kses( $input['blog_bg_image'] );
  $input['blog_bg_image_mobile'] = wp_filter_nohtml_kses( $input['blog_bg_image_mobile'] );
  $input['blog_use_overlay'] = ! empty( $input['blog_use_overlay'] ) ? 1 : 0;
  $input['blog_overlay_color'] = wp_filter_nohtml_kses( $input['blog_overlay_color'] );
  $input['blog_overlay_opacity'] = wp_filter_nohtml_kses( $input['blog_overlay_opacity'] );


  // アーカイブページ　記事一覧
  $input['archive_blog_bg_color'] = wp_filter_nohtml_kses( $input['archive_blog_bg_color'] );
  if ( ! isset( $value['archive_blog_title_font_type'] ) )
    $value['archive_blog_title_font_type'] = null;
  if ( ! array_key_exists( $value['archive_blog_title_font_type'], $font_type_options ) )
    $value['archive_blog_title_font_type'] = null;
  $input['archive_blog_title_font_size'] = wp_filter_nohtml_kses( $input['archive_blog_title_font_size'] );
  $input['archive_blog_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_blog_title_font_size_mobile'] );
  $input['archive_blog_title_font_color'] = wp_filter_nohtml_kses( $input['archive_blog_title_font_color'] );
  $input['archive_blog_desc_font_size'] = wp_filter_nohtml_kses( $input['archive_blog_desc_font_size'] );
  $input['archive_blog_desc_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_blog_desc_font_size_mobile'] );
  $input['show_archive_blog_desc'] = ! empty( $input['show_archive_blog_desc'] ) ? 1 : 0;
  $input['show_archive_blog_date'] = ! empty( $input['show_archive_blog_date'] ) ? 1 : 0;
  $input['show_archive_blog_category'] = ! empty( $input['show_archive_blog_category'] ) ? 1 : 0;


  // 記事ページ
  $input['single_blog_bg_color'] = wp_filter_nohtml_kses( $input['single_blog_bg_color'] );
  if ( ! isset( $value['single_blog_title_font_type'] ) )
    $value['single_blog_title_font_type'] = null;
  if ( ! array_key_exists( $value['single_blog_title_font_type'], $font_type_options ) )
    $value['single_blog_title_font_type'] = null;
  $input['single_blog_title_font_size'] = wp_filter_nohtml_kses( $input['single_blog_title_font_size'] );
  $input['single_blog_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_blog_title_font_size_mobile'] );
  $input['single_blog_content_font_size'] = wp_filter_nohtml_kses( $input['single_blog_content_font_size'] );
  $input['single_blog_content_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_blog_content_font_size_mobile'] );
  $input['single_blog_show_date'] = ! empty( $input['single_blog_show_date'] ) ? 1 : 0;
  $input['single_blog_show_update'] = ! empty( $input['single_blog_show_update'] ) ? 1 : 0;
  $input['single_blog_show_comment'] = ! empty( $input['single_blog_show_comment'] ) ? 1 : 0;
  $input['single_blog_show_trackback'] = ! empty( $input['single_blog_show_trackback'] ) ? 1 : 0;
  $input['single_blog_show_nav'] = ! empty( $input['single_blog_show_nav'] ) ? 1 : 0;
  $input['single_blog_show_image'] = ! empty( $input['single_blog_show_image'] ) ? 1 : 0;
  $input['single_blog_show_sns_top'] = ! empty( $input['single_blog_show_sns_top'] ) ? 1 : 0;
  $input['single_blog_show_sns_btm'] = ! empty( $input['single_blog_show_sns_btm'] ) ? 1 : 0;
  $input['single_blog_show_copy_top'] = ! empty( $input['single_blog_show_copy_top'] ) ? 1 : 0;
  $input['single_blog_show_copy_btm'] = ! empty( $input['single_blog_show_copy_btm'] ) ? 1 : 0;
  $input['single_blog_show_meta_box'] = ! empty( $input['single_blog_show_meta_box'] ) ? 1 : 0;
  $input['single_blog_show_meta_comment'] = ! empty( $input['single_blog_show_meta_comment'] ) ? 1 : 0;
  $input['single_blog_show_meta_author'] = ! empty( $input['single_blog_show_meta_author'] ) ? 1 : 0;
  if ( ! isset( $value['single_blog_layout'] ) )
    $value['single_blog_layout'] = null;
  if ( ! array_key_exists( $value['single_blog_layout'], $layout_options ) )
    $value['single_blog_layout'] = null;


  // 関連記事
  $input['show_related_post'] = ! empty( $input['show_related_post'] ) ? 1 : 0;
  $input['related_post_headline'] = wp_filter_nohtml_kses( $input['related_post_headline'] );
  $input['related_post_headline_font_size'] = wp_filter_nohtml_kses( $input['related_post_headline_font_size'] );
  $input['related_post_headline_font_size_mobile'] = wp_filter_nohtml_kses( $input['related_post_headline_font_size_mobile'] );
  $input['related_post_headline_bg_color'] = wp_filter_nohtml_kses( $input['related_post_headline_bg_color'] );
  $input['related_post_num'] = wp_filter_nohtml_kses( $input['related_post_num'] );
  $input['related_post_num_mobile'] = wp_filter_nohtml_kses( $input['related_post_num_mobile'] );
  $input['related_post_show_category'] = ! empty( $input['related_post_show_category'] ) ? 1 : 0;
  $input['related_post_show_date'] = ! empty( $input['related_post_show_date'] ) ? 1 : 0;


  // コメントの見出し
  $input['comment_headline_font_size'] = wp_filter_nohtml_kses( $input['comment_headline_font_size'] );
  $input['comment_headline_font_size_mobile'] = wp_filter_nohtml_kses( $input['comment_headline_font_size_mobile'] );


  // 記事ページ　その他
  if ( ! isset( $input['pagenation_type'] ) ) $input['pagenation_type'] = null;
  if ( ! array_key_exists( $input['pagenation_type'], $pagenation_type_options ) ) $input['pagenation_type'] = null;

  // 記事ページのバナー広告
  $input['single_top_ad_code'] = $input['single_top_ad_code'];
  $input['single_top_ad_image'] = wp_filter_nohtml_kses( $input['single_top_ad_image'] );
  $input['single_top_ad_url'] = wp_filter_nohtml_kses( $input['single_top_ad_url'] );

  $input['single_bottom_ad_code'] = $input['single_bottom_ad_code'];
  $input['single_bottom_ad_image'] = wp_filter_nohtml_kses( $input['single_bottom_ad_image'] );
  $input['single_bottom_ad_url'] = wp_filter_nohtml_kses( $input['single_bottom_ad_url'] );

  $input['single_shortcode_ad_code'] = $input['single_shortcode_ad_code'];
  $input['single_shortcode_ad_image'] = wp_filter_nohtml_kses( $input['single_shortcode_ad_image'] );
  $input['single_shortcode_ad_url'] = wp_filter_nohtml_kses( $input['single_shortcode_ad_url'] );

  $input['single_mobile_ad_code'] = $input['single_mobile_ad_code'];
  $input['single_mobile_ad_image'] = wp_filter_nohtml_kses( $input['single_mobile_ad_image'] );
  $input['single_mobile_ad_url'] = wp_filter_nohtml_kses( $input['single_mobile_ad_url'] );

	return $input;

};


?>
