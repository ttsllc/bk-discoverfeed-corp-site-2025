<?php

function access_meta_box() {
  $options = get_design_plus_option();
  add_meta_box(
    'access_meta_box',//ID of meta box
    __('Access page setting', 'tcd-w'),//label
    'show_access_meta_box',//callback function
    'page',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'access_meta_box');

function show_access_meta_box() {

  global $post;

  // コンテンツビルダー
  $access_content = get_post_meta( $post->ID, 'access_content', true );

  echo '<input type="hidden" name="access_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

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

<div class="tcd_custom_field_wrap contents_builder_wrap">

 <div class="theme_option_message">
  <?php echo __( '<p>STEP1: Click add content button.<br />STEP2: Select content from dropdown menu.<br />STEP3: Input data and save the option.</p><br /><p>You can change order by dragging MOVE button and you can delete content by clicking DELETE button.</p>', 'tcd-w' ); ?>
  <?php echo __( '<p>Margins will be automatically adjusted and displayed where the content is not set. You do not have to enter all the content.</p>', 'tcd-w' ); ?>
  <p class="rebox_group preview_page_image"><a href="<?php bloginfo('template_url'); ?>/admin/img/access.jpg"><?php _e( 'Preview page image', 'tcd-w' ); ?></a></p>
 </div>

 <?php
      // コンテンツビルダーはここから -----------------------------------------------------------------
 ?>
 <div class="contents_builder">
  <p class="cb_message"><?php _e( 'Click Add content button to start content builder', 'tcd-w' ); ?></p>
  <?php
       if ( $access_content && is_array( $access_content ) ) :
         foreach( $access_content as $key => $content ) :
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
          access_content_select( $cb_index, $content['cb_content_select'] );
          if ( ! empty( $content['cb_content_select'] ) ) :
            access_content_content_setting( $cb_index, $content['cb_content_select'], $content );
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
       <?php access_content_select( 'cb_cloneindex' ); ?>
    </div><!-- END .cb_column -->
   </div><!-- END .cb_column_area -->
  </div><!-- END .cb_row -->
  <?php
       foreach ( access_get_contents() as $key => $value ) :
         access_content_content_setting( 'cb_cloneindex', $key );
       endforeach;
  ?>
 </div><!-- END .contents_builder-clone -->

</div><!-- END .tcd_custom_field_wrap -->
<?php
}

function save_access_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['access_meta_box_nonce']) || !wp_verify_nonce($_POST['access_meta_box_nonce'], basename(__FILE__))) {
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
  $cf_keys = array();
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

	// コンテンツビルダー 整形保存
	if ( ! empty( $_POST['access_content'] ) && is_array( $_POST['access_content'] ) ) {
		$cb_contents = access_get_contents();
		$cb_data = array();

		foreach ( $_POST['access_content'] as $key => $value ) {
			// クローン用はスルー
			if ( 'cb_cloneindex' === $key ) continue;

			// コンテンツデフォルト値に入力値をマージ
			if ( ! empty( $value['cb_content_select'] ) && isset( $cb_contents[$value['cb_content_select']]['default'] ) ) {
				$value = array_merge( (array) $cb_contents[$value['cb_content_select']]['default'], $value );
			}

			// コンテンツ１
			if ( 'content1' === $value['cb_content_select'] ) {

				$value['show_content'] = ! empty( $value['show_content'] ) ? 1 : 0;

        $value['headline'] = wp_filter_nohtml_kses( $value['headline'] );
        $value['headline_font_color'] = wp_filter_nohtml_kses( $value['headline_font_color'] );
        $value['headline_font_size'] = wp_filter_nohtml_kses( $value['headline_font_size'] );
        $value['headline_font_size_mobile'] = wp_filter_nohtml_kses( $value['headline_font_size_mobile'] );
        $value['headline_font_type'] = wp_filter_nohtml_kses( $value['headline_font_type'] );

        $value['catch'] = wp_filter_nohtml_kses( $value['catch'] );
        $value['catch_font_size'] = wp_filter_nohtml_kses( $value['catch_font_size'] );
        $value['catch_font_size_mobile'] = wp_filter_nohtml_kses( $value['catch_font_size_mobile'] );
        $value['catch_font_type'] = wp_filter_nohtml_kses( $value['catch_font_type'] );

        $value['list_catch_font_size'] = wp_filter_nohtml_kses( $value['list_catch_font_size'] );
        $value['list_catch_font_size_mobile'] = wp_filter_nohtml_kses( $value['list_catch_font_size_mobile'] );
        $value['list_catch_font_type'] = wp_filter_nohtml_kses( $value['list_catch_font_type'] );

        $value['list_desc_font_size'] = wp_filter_nohtml_kses( $value['list_desc_font_size'] );
        $value['list_desc_font_size_mobile'] = wp_filter_nohtml_kses( $value['list_desc_font_size_mobile'] );

				$item_list = array();
				if ( $value['item_list'] && is_array( $value['item_list'] ) ) {
					foreach( array_values( $value['item_list'] ) as $repeater_value ) {
						$item_list[] = array_merge( $cb_contents[$value['cb_content_select']]['item_list_default'], $repeater_value );
					}
				}
				$value['item_list'] = $item_list;

			// アクセス情報
			} elseif ( 'access_map' === $value['cb_content_select'] ) {

				$value['show_content'] = ! empty( $value['show_content'] ) ? 1 : 0;

				$value['headline'] = sanitize_textarea_field($value['headline']);
				$value['headline_font_size'] = absint( $value['headline_font_size'] );
				$value['headline_font_size_mobile'] = absint( $value['headline_font_size_mobile'] );
				$value['headline_font_type'] = sanitize_text_field( $value['headline_font_type'] );

				// 地図情報
				$value['show_button'] = ! empty( $value['show_button'] ) ? 1 : 0;
				$value['button_label'] = sanitize_text_field( $value['button_label'] );
				$value['button_url'] = sanitize_text_field( $value['button_url'] );
				$value['button_font_color'] = sanitize_hex_color( $value['button_font_color'] );
				$value['button_bg_color'] = sanitize_hex_color( $value['button_bg_color'] );
				$value['button_font_color_hover'] = sanitize_hex_color( $value['button_font_color_hover'] );
				$value['button_bg_color_hover'] = sanitize_hex_color( $value['button_bg_color_hover'] );

				$value['show_access_info'] = ! empty( $value['show_access_info'] ) ? 1 : 0;
				$value['show_contact'] = ! empty( $value['show_contact'] ) ? 1 : 0;
				$value['show_tel'] = ! empty( $value['show_tel'] ) ? 1 : 0;
				$value['show_service_list'] = ! empty( $value['show_service_list'] ) ? 1 : 0;
				$value['show_logo'] = ! empty( $value['show_logo'] ) ? 1 : 0;
				$value['show_address'] = ! empty( $value['show_address'] ) ? 1 : 0;
				$value['access_info_bg_color'] = sanitize_hex_color( $value['access_info_bg_color'] );

			// フリースペース
			} elseif ( 'free_space' === $value['cb_content_select'] ) {

				$value['show_content'] = ! empty( $value['show_content'] ) ? 1 : 0;

        $value['content_width'] = wp_filter_nohtml_kses( $value['content_width'] );

				$value['desc'] = $value['desc'];
				$value['desc_font_size'] = absint( $value['desc_font_size'] );
				$value['desc_font_size_mobile'] = absint( $value['desc_font_size_mobile'] );

				$value['padding_top'] = absint( $value['padding_top'] );
				$value['padding_bottom'] = absint( $value['padding_bottom'] );
				$value['padding_top_mobile'] = absint( $value['padding_top_mobile'] );
				$value['padding_bottom_mobile'] = absint( $value['padding_bottom_mobile'] );

			}

			$cb_data[] = $value;
		}

		if ( $cb_data ) {
			update_post_meta( $post_id, 'access_content', $cb_data );
		} else {
			delete_post_meta( $post_id, 'access_content' );
		}
	}
}
add_action('save_post', 'save_access_meta_box');


/**
 * コンテンツビルダー コンテンツ一覧取得
 */
function access_get_contents() {
	return array(
    // コンテンツ１
		'content1' => array(
			'name' => 'content1',
			'label' => __( 'Image + text content', 'tcd-w' ),
			'default' => array(
				'show_content' => 1,
				'headline' => '',
				'headline_font_size' => 14,
				'headline_font_size_mobile' => 12,
				'headline_font_type' => 'type2',
				'headline_font_color' => '#00a5d0',
				'catch' => '',
				'catch_font_size' => 38,
				'catch_font_size_mobile' => 24,
				'catch_font_type' => 'type3',
				'list_catch_font_size' => 22,
				'list_catch_font_size_mobile' => 18,
				'list_catch_font_type' => 'type2',
				'list_desc_font_size' => 16,
				'list_desc_font_size_mobile' => 14,
				'item_list' => array(),
			),
			'item_list_default' => array(
				'layout' => 'type1',
				'image' => '',
				'catch' => '',
				'catch_font_color' => '#00a8cc',
				'desc' => '',
				'caption' => '',
			),
		),
    // アクセスマップ
		'access_map' => array(
			'name' => 'access_map',
			'label' => __( 'Access map', 'tcd-w' ),
			'default' => array(
				'show_content' => 1,
				'headline' => '',
				'headline_font_size' => 24,
				'headline_font_size_mobile' => 18,
				'headline_font_type' => 'type2',
				'show_button' => '',
				'button_label' => __( 'Display on large map', 'tcd-w' ),
				'button_url' => '',
				'button_font_color' => '#000000',
				'button_bg_color' => '#ffffff',
				'button_border_color' => '#dddddd',
				'button_font_color_hover' => '#ffffff',
				'button_bg_color_hover' => '#00a7ce',
				'button_border_color_hover' => '#00a7ce',
				'show_access_info' => '',
				'show_contact' => '',
				'show_tel' => '',
				'show_service_list' => '',
				'show_logo' => '',
				'show_address' => '',
				'access_info_bg_color' => '#f5f5f5',
			)
		),
    // フリースペース
		'free_space' => array(
			'name' => 'free_space',
			'label' => __( 'Free space', 'tcd-w' ),
			'default' => array(
				'show_content' => 1,
				'content_width' => 'type1',
				'desc' => '',
				'desc_font_size' => 16,
				'desc_font_size_mobile' => 14,
				'padding_top' => '50',
				'padding_bottom' => '50',
				'padding_top_mobile' => '30',
				'padding_bottom_mobile' => '30',
			)
		)
	);
}

/**
 * コンテンツビルダー用 コンテンツ選択プルダウン
 */
function access_content_select( $cb_index = 'cb_cloneindex', $selected = null ) {
	$cb_contents = access_get_contents();

	if ( $selected && isset( $cb_contents[$selected] ) ) {
		$add_class = ' hidden';
	} else {
		$add_class = '';
	}

	$out = '<select name="access_content[' . esc_attr( $cb_index ) . '][cb_content_select]" class="cb_content_select' . $add_class . '">';
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
function access_content_content_setting( $cb_index = 'cb_cloneindex', $cb_content_select = null, $value = array() ) {

  global $post, $font_type_options, $content_direction_options, $gmap_marker_type_options, $gmap_custom_marker_type_options, $content_width_options;

  $options = get_design_plus_option();
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-w' );

	$cb_contents = access_get_contents();

  $page_content_width = get_post_meta($post->ID, 'page_content_width', true) ?  get_post_meta($post->ID, 'page_content_width', true) : '1000';

	// 不明なコンテンツの場合は終了
	if ( ! $cb_content_select || ! isset( $cb_contents[$cb_content_select] ) ) return false;

	// コンテンツデフォルト値に入力値をマージ
	if ( isset( $cb_contents[$cb_content_select]['default'] ) ) {
		$value = array_merge( (array) $cb_contents[$cb_content_select]['default'], $value );
	}
?>
  <div class="cb_content_wrap cf <?php echo esc_attr( $cb_content_select ); ?>">

  <?php
      // コンテンツ１ -------------------------------------------------------------------------
      if ( 'content1' === $cb_content_select ) :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?><span></span></h3>
  <div class="cb_content">

   <p class="hidden"><input name="access_content[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p><label><input name="access_content[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><?php printf(__('Display %s', 'tcd-w'), $cb_contents[$cb_content_select]['label']); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
   <input class="repeater_label full_width" type="text" name="access_content[<?php echo $cb_index; ?>][headline]" value="<?php esc_attr_e( $value['headline'] ); ?>" />
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="access_content[<?php echo $cb_index; ?>][headline_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['headline_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="access_content[<?php echo $cb_index; ?>][headline_font_size]" value="<?php esc_attr_e( $value['headline_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="access_content[<?php echo $cb_index; ?>][headline_font_size_mobile]" value="<?php esc_attr_e( $value['headline_font_size_mobile'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="access_content[<?php echo $cb_index; ?>][headline_font_color]" value="<?php echo esc_attr( $value['headline_font_color'] ); ?>" data-default-color="#00a5d0" class="c-color-picker"></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
   <textarea class="cb-repeater-label large-text" cols="50" rows="3" name="access_content[<?php echo $cb_index; ?>][catch]"><?php echo esc_textarea(  $value['catch'] ); ?></textarea>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="access_content[<?php echo $cb_index; ?>][catch_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="access_content[<?php echo $cb_index; ?>][catch_font_size]" value="<?php esc_attr_e( $value['catch_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="access_content[<?php echo $cb_index; ?>][catch_font_size_mobile]" value="<?php esc_attr_e( $value['catch_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <?php // リピーターここから -------------------------- ?>
   <h4 class="theme_option_headline2"><?php _e('Content list setting', 'tcd-w');  ?></h4>
   <div class="theme_option_message2">
    <p><?php _e( 'Click add new content button to add content.<br />You can change order by dragging item header.', 'tcd-w' ); ?></p>
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
       <h4 class="theme_option_headline2"><?php _e('Layout setting', 'tcd-w');  ?></h4>
       <ul class="design_radio_button">
        <li>
         <input type="radio" id="layout_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_type1" name="access_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][layout]" value="type1" <?php checked( $repeater_value['layout'], 'type1' ); ?> />
         <label for="layout_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_type1"><?php _e('Display image on left side', 'tcd-w');  ?></label>
        </li>
        <li>
         <input type="radio" id="layout_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_type2" name="access_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][layout]" value="type2" <?php checked( $repeater_value['layout'], 'type2' ); ?> />
         <label for="layout_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_type2"><?php _e('Display image on right side', 'tcd-w');  ?></label>
        </li>
       </ul>
       <h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
       <div class="theme_option_message2">
        <p><?php printf(__('Recommend image size. Width:<span class="page_change_image_width2">%1$s</span>px, Height:%2$spx.', 'tcd-w'), $page_content_width, '400' ); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js">
         <input type="hidden" class="cf_media_id" name="access_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image]" id="item_list-<?php echo $cb_index; ?>-item_list-<?php echo esc_attr( $repeater_key ); ?>-image" value="<?php echo esc_attr( $repeater_value['image'] ); ?>">
         <div class="preview_field"><?php if ( $repeater_value['image'] ) echo wp_get_attachment_image( $repeater_value['image'], 'medium' ); ?></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( ! $repeater_value['image'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
       <textarea class="repeater-label large-text" cols="50" rows="3" name="access_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][catch]"><?php echo esc_textarea(  $repeater_value['catch'] ); ?></textarea>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="access_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][catch_font_color]" value="<?php echo esc_attr( $repeater_value['catch_font_color'] ); ?>" data-default-color="#00a8cc" class="c-color-picker"></li>
       </ul>
       <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
       <textarea class="large-text" cols="50" rows="3" name="access_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][desc]"><?php echo esc_textarea(  $repeater_value['desc'] ); ?></textarea>
       <h4 class="theme_option_headline2"><?php _e( 'Caption', 'tcd-w' ); ?></h4>
       <textarea class="large-text" cols="50" rows="2" name="access_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][caption]"><?php echo esc_textarea(  $repeater_value['caption'] ); ?></textarea>
       <ul class="button_list cf">
        <li class="delete-row"><a class="button-delete-row button-ml" href="#"><?php echo __( 'Delete content', 'tcd-w' ); ?></a></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
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
       <h4 class="theme_option_headline2"><?php _e('Layout setting', 'tcd-w');  ?></h4>
       <ul class="design_radio_button">
        <li>
         <input type="radio" id="layout_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_type1" name="access_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][layout]" value="type1" <?php checked( $repeater_value['layout'], 'type1' ); ?> />
         <label for="layout_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_type1"><?php _e('Display image on left side', 'tcd-w');  ?></label>
        </li>
        <li>
         <input type="radio" id="layout_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_type2" name="access_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][layout]" value="type2" <?php checked( $repeater_value['layout'], 'type2' ); ?> />
         <label for="layout_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_type2"><?php _e('Display image on right side', 'tcd-w');  ?></label>
        </li>
       </ul>
       <h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
       <div class="theme_option_message2">
        <p><?php printf(__('Recommend image size. Width:<span class="page_change_image_width2">%1$s</span>px, Height:%2$spx.', 'tcd-w'), $page_content_width, '400' ); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js">
         <input type="hidden" class="cf_media_id" name="access_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image]" id="item_list-<?php echo $cb_index; ?>-item_list-<?php echo esc_attr( $repeater_key ); ?>-image" value="">
         <div class="preview_field"></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( ! $repeater_value['image'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
       <textarea class="repeater-label large-text" cols="50" rows="3" name="access_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][catch]"></textarea>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="access_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][catch_font_color]" value="<?php echo esc_attr( $repeater_value['catch_font_color'] ); ?>" data-default-color="#00a8cc" class="c-color-picker"></li>
       </ul>
       <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-w' ); ?></h4>
       <textarea class="large-text" cols="50" rows="3" name="access_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][desc]"></textarea>
       <h4 class="theme_option_headline2"><?php _e( 'Caption', 'tcd-w' ); ?></h4>
       <textarea class="large-text" cols="50" rows="2" name="access_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][caption]"></textarea>
       <ul class="button_list cf">
        <li class="delete-row"><a class="button-delete-row button-ml" href="#"><?php echo __( 'Delete content', 'tcd-w' ); ?></a></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
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
    <li class="cf"><span class="label"><?php _e('Font type of catchphrase', 'tcd-w');  ?></span>
     <select name="access_content[<?php echo $cb_index; ?>][list_catch_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['list_catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size of catchphrase', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="access_content[<?php echo $cb_index; ?>][list_catch_font_size]" value="<?php esc_attr_e( $value['list_catch_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of catchphrase (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="access_content[<?php echo $cb_index; ?>][list_catch_font_size_mobile]" value="<?php esc_attr_e( $value['list_catch_font_size_mobile'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of description', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="access_content[<?php echo $cb_index; ?>][list_desc_font_size]" value="<?php esc_attr_e( $value['list_desc_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of description (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="access_content[<?php echo $cb_index; ?>][list_desc_font_size_mobile]" value="<?php esc_attr_e( $value['list_desc_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>


   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div><!-- END .cb_content -->


  <?php
       // アクセスマップ -------------------------------------------------------------------------
       elseif ( 'access_map' === $cb_content_select ) :

  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?></h3>
  <div class="cb_content">

   <p class="hidden"><input name="access_content[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p><label><input name="access_content[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><?php printf(__('Display %s', 'tcd-w'), $cb_contents[$cb_content_select]['label']); ?></label></p>

   <div class="theme_option_message2">
    <p><?php _e('Please register access data and contact information from <strong>Basic setting area</strong> in site basic setting theme option.', 'tcd-w'); ?></p>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
   <input class="cb-repeater-label full_width" type="text" name="access_content[<?php echo $cb_index; ?>][headline]" value="<?php esc_attr_e( $value['headline'] ); ?>" />
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="access_content[<?php echo $cb_index; ?>][headline_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['headline_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="access_content[<?php echo $cb_index; ?>][headline_font_size]" value="<?php esc_attr_e( $value['headline_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="access_content[<?php echo $cb_index; ?>][headline_font_size_mobile]" value="<?php esc_attr_e( $value['headline_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e( 'Button setting', 'tcd-w' ); ?></h4>
   <p class="displayment_checkbox"><label><input name="access_content[<?php echo $cb_index; ?>][show_button]" type="checkbox" value="1" <?php checked( $value['show_button'], 1 ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
   <div style="<?php if($value['show_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('label', 'tcd-w');  ?></span><input class="full_width" type="text" name="access_content[<?php echo $cb_index; ?>][button_label]" value="<?php echo esc_attr($value['button_label']); ?>" /></li>
     <li class="cf"><span class="label"><?php _e('URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="access_content[<?php echo $cb_index; ?>][button_url]" value="<?php echo esc_url($value['button_url']); ?>" /></li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="access_content[<?php echo $cb_index; ?>][button_font_color]" value="<?php echo esc_attr($value['button_font_color']); ?>" data-default-color="#000000" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="access_content[<?php echo $cb_index; ?>][button_bg_color]" value="<?php echo esc_attr($value['button_bg_color']); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="access_content[<?php echo $cb_index; ?>][button_border_color]" value="<?php echo esc_attr($value['button_border_color']); ?>" data-default-color="#dddddd" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color on mouseover', 'tcd-w'); ?></span><input type="text" name="access_content[<?php echo $cb_index; ?>][button_font_color_hover]" value="<?php echo esc_attr($value['button_font_color_hover']); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color on mouseover', 'tcd-w'); ?></span><input type="text" name="access_content[<?php echo $cb_index; ?>][button_bg_color_hover]" value="<?php echo esc_attr($value['button_bg_color_hover']); ?>" data-default-color="#00a7ce" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Border color on mouseover', 'tcd-w'); ?></span><input type="text" name="access_content[<?php echo $cb_index; ?>][button_border_color_hover]" value="<?php echo esc_attr($value['button_border_color_hover']); ?>" data-default-color="#00a7ce" class="c-color-picker"></li>
    </ul>
   </div>

   <h4 class="theme_option_headline2"><?php _e( 'Other setting', 'tcd-w' ); ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Display access information', 'tcd-w');  ?></span><input name="access_content[<?php echo $cb_index; ?>][show_access_info]" type="checkbox" value="1" <?php checked( $value['show_access_info'], 1 ); ?>></li>
    <li class="cf"><span class="label"><?php _e('Display contact button', 'tcd-w');  ?></span><input name="access_content[<?php echo $cb_index; ?>][show_contact]" type="checkbox" value="1" <?php checked( $value['show_contact'], 1 ); ?>></li>
    <li class="cf"><span class="label"><?php _e('Display telephone', 'tcd-w');  ?></span><input name="access_content[<?php echo $cb_index; ?>][show_tel]" type="checkbox" value="1" <?php checked( $value['show_tel'], 1 ); ?>></li>
    <li class="cf"><span class="label"><?php printf(__('Display %s list', 'tcd-w'),$service_label);  ?></span><input name="access_content[<?php echo $cb_index; ?>][show_service_list]" type="checkbox" value="1" <?php checked( $value['show_service_list'], 1 ); ?>></li>
    <li class="cf"><span class="label"><?php _e('Display logo', 'tcd-w');  ?></span><input name="access_content[<?php echo $cb_index; ?>][show_logo]" type="checkbox" value="1" <?php checked( $value['show_logo'], 1 ); ?>></li>
    <li class="cf"><span class="label"><?php _e('Display address', 'tcd-w');  ?></span><input name="access_content[<?php echo $cb_index; ?>][show_address]" type="checkbox" value="1" <?php checked( $value['show_address'], 1 ); ?>></li>
    <li class="cf"><span class="label"><?php _e('Background color of information area', 'tcd-w'); ?></span><input type="text" name="access_content[<?php echo $cb_index; ?>][access_info_bg_color]" value="<?php echo esc_attr($value['access_info_bg_color']); ?>" data-default-color="#f5f5f5" class="c-color-picker"></li>
   </ul>

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

   <p class="hidden"><input name="access_content[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p><label><input name="access_content[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><?php printf(__('Display %s', 'tcd-w'), $cb_contents[$cb_content_select]['label']); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Content width', 'tcd-w');  ?></h4>
   <ul class="design_radio_button">
    <li>
     <input type="radio" id="ac_content_width_<?php echo $cb_index; ?>_<?php esc_attr_e( $option['value'] ); ?>" name="access_content[<?php echo $cb_index; ?>][content_width]" value="type1" <?php checked( $value['content_width'], 'type1' ); ?> />
     <label for="ac_content_width_<?php echo $cb_index; ?>_<?php esc_attr_e( $option['value'] ); ?>"><span class="page_change_image_width"><?php echo esc_attr($page_content_width); ?></span>px</label>
    </li>
    <li>
     <input type="radio" id="ac_content_width_<?php echo $cb_index; ?>_<?php esc_attr_e( $option['value'] ); ?>" name="access_content[<?php echo $cb_index; ?>][content_width]" value="type2" <?php checked( $value['content_width'], 'type2' ); ?> />
     <label for="ac_content_width_<?php echo $cb_index; ?>_<?php esc_attr_e( $option['value'] ); ?>"><?php _e('Full screen width', 'tcd-w');  ?></label>
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Free space', 'tcd-w');  ?></h4>
   <?php wp_editor( $value['desc'], 'cb_wysiwyg_editor-' . $cb_index, array ('textarea_name' => 'access_content[' . $cb_index . '][desc]')); ?>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="access_content[<?php echo $cb_index; ?>][desc_font_size]" value="<?php esc_attr_e( $value['desc_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="access_content[<?php echo $cb_index; ?>][desc_font_size_mobile]" value="<?php esc_attr_e( $value['desc_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Space setting', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Margin top', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="access_content[<?php echo $cb_index; ?>][padding_top]" value="<?php esc_attr_e( $value['padding_top'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Margin bottom', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="access_content[<?php echo $cb_index; ?>][padding_bottom]" value="<?php esc_attr_e( $value['padding_bottom'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Margin top (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="access_content[<?php echo $cb_index; ?>][padding_top_mobile]" value="<?php esc_attr_e( $value['padding_top_mobile'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Margin bottom (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="access_content[<?php echo $cb_index; ?>][padding_bottom_mobile]" value="<?php esc_attr_e( $value['padding_bottom_mobile'] ); ?>" /><span>px</span></li>
   </ul>

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


