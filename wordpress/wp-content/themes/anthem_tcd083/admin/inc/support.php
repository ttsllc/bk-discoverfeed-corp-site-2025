<?php
/*
 * サービスの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_support_dp_default_options' );


//  Add label of support tab
add_action( 'tcd_tab_labels', 'add_support_tab_label' );


// Add HTML of support tab
add_action( 'tcd_tab_panel', 'add_support_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_support_theme_options_validate' );


// タブの名前
function add_support_tab_label( $tab_labels ) {
  $options = get_design_plus_option();
  $tab_label = $options['support_label'] ? esc_html( $options['support_label'] ) : __( 'Support', 'tcd-w' );
  $tab_labels['support'] = $tab_label;
	return $tab_labels;
}


// 初期値
function add_support_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['support_label'] = __( 'Support', 'tcd-w' );
	$dp_default_options['support_slug'] = 'support';

	// ヘッダー
	$dp_default_options['support_show_header'] = '';
	$dp_default_options['support_title'] = '';
	$dp_default_options['support_title_font_size'] = '36';
	$dp_default_options['support_title_font_size_mobile'] = '24';
	$dp_default_options['support_title_font_color'] = '#FFFFFF';
	$dp_default_options['support_title_font_type'] = 'type3';
	$dp_default_options['support_desc'] = '';
	$dp_default_options['support_desc_mobile'] = '';
	$dp_default_options['support_desc_font_size'] = '16';
	$dp_default_options['support_desc_font_size_mobile'] = '14';
	$dp_default_options['support_desc_font_color'] = '#FFFFFF';
	$dp_default_options['support_desc_font_type'] = 'type2';
	$dp_default_options['support_bg_image'] = false;
	$dp_default_options['support_bg_image_mobile'] = false;
	$dp_default_options['support_use_overlay'] = 1;
	$dp_default_options['support_overlay_color'] = '#000000';
	$dp_default_options['support_overlay_opacity'] = '0.3';

	// アーカイブページ
	$dp_default_options['archive_support_category_font_size'] = '16';
	$dp_default_options['archive_support_category_font_size_mobile'] = '12';
	$dp_default_options['archive_support_category_font_color'] = '#ffffff';
	$dp_default_options['archive_support_category_bg_color'] = '#008a98';
	$dp_default_options['archive_support_category_bg_color_active'] = '#006e7c';

	$dp_default_options['archive_support_catch_font_type'] = 'type3';
	$dp_default_options['archive_support_catch_font_size'] = '38';
	$dp_default_options['archive_support_catch_font_size_mobile'] = '20';
	$dp_default_options['archive_support_desc_font_size'] = '16';
	$dp_default_options['archive_support_desc_font_size_mobile'] = '14';

	$dp_default_options['archive_support_title_font_size'] = '16';
	$dp_default_options['archive_support_title_font_size_mobile'] = '14';

	$dp_default_options['archive_support_answer_font_size'] = '16';
	$dp_default_options['archive_support_answer_font_size_mobile'] = '14';
	$dp_default_options['archive_support_answer_bg_color'] = '#f7f7f7';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_support_tab_panel( $options ) {

  global $dp_default_options, $pagenation_type_options, $font_type_options, $animation_type_options;
  $support_label = $options['support_label'] ? esc_html( $options['support_label'] ) : __( 'Support', 'tcd-w' );

?>

<div id="tab-content-support" class="tab-content">

   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Basic setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Name of content', 'tcd-w');  ?></h4>
     <input class="regular-text" type="text" name="dp_options[support_label]" value="<?php echo esc_attr( $options['support_label'] ); ?>" />

     <h4 class="theme_option_headline2"><?php _e('Slug setting', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please enter word by alphabet only.<br />After changing slug, please update permalink setting form <a href="./options-permalink.php"><strong>permalink option page</strong></a>.', 'tcd-w'); ?></p>
     </div>
     <p><input class="hankaku regular-text" type="text" name="dp_options[support_slug]" value="<?php echo sanitize_title( $options['support_slug'] ); ?>" /></p>

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
     <p class="displayment_checkbox"><label><input name="dp_options[support_show_header]" type="checkbox" value="1" <?php checked( $options['support_show_header'], 1 ); ?>><?php _e( 'Display header', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['support_show_header'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

     <h4 class="theme_option_headline2"><?php _e('Title', 'tcd-w');  ?></h4>
     <input class="full_width" type="text" name="dp_options[support_title]" value="<?php echo esc_attr( $options['support_title'] ); ?>" />
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
       <select name="dp_options[support_title_font_type]">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['support_title_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[support_title_font_size]" value="<?php esc_attr_e( $options['support_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[support_title_font_size_mobile]" value="<?php esc_attr_e( $options['support_title_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[support_title_font_color]" value="<?php echo esc_attr( $options['support_title_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
     <textarea class="full_width" cols="50" rows="4" name="dp_options[support_desc]"><?php echo esc_textarea(  $options['support_desc'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
       <select name="dp_options[support_desc_font_type]">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['support_desc_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[support_desc_font_size]" value="<?php esc_attr_e( $options['support_desc_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[support_desc_font_color]" value="<?php echo esc_attr( $options['support_desc_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Description (mobile)', 'tcd-w');  ?></h4>
     <textarea class="full_width" cols="50" rows="4" name="dp_options[support_desc_mobile]"><?php echo esc_textarea(  $options['support_desc_mobile'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[support_desc_font_size_mobile]" value="<?php esc_attr_e( $options['support_desc_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Background image', 'tcd-w'); ?></h4>
     <div class="theme_option_message2">
      <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '500'); ?></p>
     </div>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js support_bg_image">
       <input type="hidden" value="<?php echo esc_attr( $options['support_bg_image'] ); ?>" id="support_bg_image" name="dp_options[support_bg_image]" class="cf_media_id">
       <div class="preview_field"><?php if($options['support_bg_image']){ echo wp_get_attachment_image($options['support_bg_image'], 'medium'); }; ?></div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['support_bg_image']){ echo 'hidden'; }; ?>">
       </div>
      </div>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Background image (mobile)', 'tcd-w'); ?></h4>
     <div class="theme_option_message2">
      <p><?php echo __('Please use this option if you want to change background image in mobile device.', 'tcd-w'); ?></p>
      <p><?php printf(__('Recommended size assuming for retina display. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '1100'); ?></p>
     </div>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js support_bg_image_mobile">
       <input type="hidden" value="<?php echo esc_attr( $options['support_bg_image_mobile'] ); ?>" id="support_bg_image_mobile" name="dp_options[support_bg_image_mobile]" class="cf_media_id">
       <div class="preview_field"><?php if($options['support_bg_image_mobile']){ echo wp_get_attachment_image($options['support_bg_image_mobile'], 'medium'); }; ?></div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['support_bg_image_mobile']){ echo 'hidden'; }; ?>">
       </div>
      </div>
     </div>

     <h4 class="theme_option_headline2"><?php _e( 'Overlay setting', 'tcd-w' ); ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[support_use_overlay]" type="checkbox" value="1" <?php checked( $options['support_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['support_use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[support_overlay_color]" value="<?php echo esc_attr( $options['support_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       <li class="cf">
        <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[support_overlay_opacity]" value="<?php echo esc_attr( $options['support_overlay_opacity'] ); ?>" />
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
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_support_category_font_size]" value="<?php esc_attr_e( $options['archive_support_category_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_support_category_font_size_mobile]" value="<?php esc_attr_e( $options['archive_support_category_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[archive_support_category_font_color]" value="<?php echo esc_attr( $options['archive_support_category_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[archive_support_category_bg_color]" value="<?php echo esc_attr( $options['archive_support_category_bg_color'] ); ?>" data-default-color="#008a98" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color of active category', 'tcd-w'); ?></span><input type="text" name="dp_options[archive_support_category_bg_color_active]" value="<?php echo esc_attr( $options['archive_support_category_bg_color_active'] ); ?>" data-default-color="#006e7c" class="c-color-picker"></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
       <select name="dp_options[archive_support_catch_font_type]">
        <?php foreach ( $font_type_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['archive_support_catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_support_catch_font_size]" value="<?php esc_attr_e( $options['archive_support_catch_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_support_catch_font_size_mobile]" value="<?php esc_attr_e( $options['archive_support_catch_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_support_desc_font_size]" value="<?php esc_attr_e( $options['archive_support_desc_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_support_desc_font_size_mobile]" value="<?php esc_attr_e( $options['archive_support_desc_font_size_mobile'] ); ?>" /><span>px</span></li>
     </ul>

     <h4 class="theme_option_headline2"><?php printf(__('%s list', 'tcd-w'),$support_label);  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size of question', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_support_title_font_size]" value="<?php esc_attr_e( $options['archive_support_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of question (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_support_title_font_size_mobile]" value="<?php esc_attr_e( $options['archive_support_title_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of answer', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_support_answer_font_size]" value="<?php esc_attr_e( $options['archive_support_answer_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size of answer (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[archive_support_answer_font_size_mobile]" value="<?php esc_attr_e( $options['archive_support_answer_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color of answer', 'tcd-w'); ?></span><input type="text" name="dp_options[archive_support_answer_bg_color]" value="<?php echo esc_attr( $options['archive_support_answer_bg_color'] ); ?>" data-default-color="#f7f7f7" class="c-color-picker"></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_support_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_support_theme_options_validate( $input ) {

  global $dp_default_options, $pagenation_type_options, $font_type_options, $animation_type_options;

  // 基本設定
  $input['support_label'] = wp_filter_nohtml_kses( $input['support_label'] );
  $input['support_slug'] = sanitize_title( $input['support_slug'] );

  //ヘッダーの設定
  $input['support_show_header'] = ! empty( $input['support_show_header'] ) ? 1 : 0;
  $input['support_title'] = wp_filter_nohtml_kses( $input['support_title'] );
  if ( ! isset( $value['support_title_font_type'] ) )
    $value['support_title_font_type'] = null;
  if ( ! array_key_exists( $value['support_title_font_type'], $font_type_options ) )
    $value['support_title_font_type'] = null;
  $input['support_title_font_size'] = wp_filter_nohtml_kses( $input['support_title_font_size'] );
  $input['support_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['support_title_font_size_mobile'] );
  $input['support_title_font_color'] = wp_filter_nohtml_kses( $input['support_title_font_color'] );
  $input['support_desc'] = wp_filter_nohtml_kses( $input['support_desc'] );
  $input['support_desc_mobile'] = wp_filter_nohtml_kses( $input['support_desc_mobile'] );
  if ( ! isset( $value['support_desc_font_type'] ) )
    $value['support_desc_font_type'] = null;
  if ( ! array_key_exists( $value['support_desc_font_type'], $font_type_options ) )
    $value['support_desc_font_type'] = null;
  $input['support_desc_font_size'] = wp_filter_nohtml_kses( $input['support_desc_font_size'] );
  $input['support_desc_font_size_mobile'] = wp_filter_nohtml_kses( $input['support_desc_font_size_mobile'] );
  $input['support_desc_font_color'] = wp_filter_nohtml_kses( $input['support_desc_font_color'] );
  $input['support_bg_image'] = wp_filter_nohtml_kses( $input['support_bg_image'] );
  $input['support_bg_image_mobile'] = wp_filter_nohtml_kses( $input['support_bg_image_mobile'] );
  $input['support_use_overlay'] = ! empty( $input['support_use_overlay'] ) ? 1 : 0;
  $input['support_overlay_color'] = wp_filter_nohtml_kses( $input['support_overlay_color'] );
  $input['support_overlay_opacity'] = wp_filter_nohtml_kses( $input['support_overlay_opacity'] );

  // アーカイブ
  $input['archive_support_category_font_size'] = wp_filter_nohtml_kses( $input['archive_support_category_font_size'] );
  $input['archive_support_category_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_support_category_font_size_mobile'] );
  $input['archive_support_category_font_color'] = wp_filter_nohtml_kses( $input['archive_support_category_font_color'] );
  $input['archive_support_category_bg_color'] = wp_filter_nohtml_kses( $input['archive_support_category_bg_color'] );
  $input['archive_support_category_bg_color_active'] = wp_filter_nohtml_kses( $input['archive_support_category_bg_color_active'] );

  if ( ! isset( $value['archive_support_catch_font_type'] ) )
    $value['archive_support_catch_font_type'] = null;
  if ( ! array_key_exists( $value['archive_support_catch_font_type'], $font_type_options ) )
    $value['archive_support_catch_font_type'] = null;
  $input['archive_support_catch_font_size'] = wp_filter_nohtml_kses( $input['archive_support_catch_font_size'] );
  $input['archive_support_catch_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_support_catch_font_size_mobile'] );
  $input['archive_support_desc_font_size'] = wp_filter_nohtml_kses( $input['archive_support_desc_font_size'] );
  $input['archive_support_desc_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_support_desc_font_size_mobile'] );

  $input['archive_support_title_font_size'] = wp_filter_nohtml_kses( $input['archive_support_title_font_size'] );
  $input['archive_support_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_support_title_font_size_mobile'] );
  $input['archive_support_answer_font_size'] = wp_filter_nohtml_kses( $input['archive_support_answer_font_size'] );
  $input['archive_support_answer_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_support_answer_font_size_mobile'] );
  $input['archive_support_answer_bg_color'] = wp_filter_nohtml_kses( $input['archive_support_answer_bg_color'] );

	return $input;

};


?>