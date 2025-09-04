<?php
function page_ranking() {
  $options = get_design_plus_option();
  $product_label = $options['product_label'] ? esc_html( $options['product_label'] ) : __( 'Product', 'tcd-w' );
  add_meta_box(
    'ranking_meta_box',//ID of meta box
    sprintf(__('%s ranking page setting', 'tcd-w'), $product_label),
    'show_page_ranking',//callback function
    'page',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'page_ranking');

function show_page_ranking() {

  global $post, $font_type_options;

  $options = get_design_plus_option();
  $product_label = $options['product_label'] ? esc_html( $options['product_label'] ) : __( 'Product', 'tcd-w' );

  $show_ranking_free1 = get_post_meta($post->ID, 'show_ranking_free1', true);
  $ranking_free1_content_width = get_post_meta($post->ID, 'ranking_free1_content_width', true) ?  get_post_meta($post->ID, 'ranking_free1_content_width', true) : 'type1';
  $ranking_free1 = get_post_meta($post->ID, 'ranking_free1', true);
  $ranking_free1_font_size = get_post_meta($post->ID, 'ranking_free1_font_size', true) ?  get_post_meta($post->ID, 'ranking_free1_font_size', true) : '16';
  $ranking_free1_font_size_mobile = get_post_meta($post->ID, 'ranking_free1_font_size_mobile', true) ?  get_post_meta($post->ID, 'ranking_free1_font_size_mobile', true) : '14';
  $ranking_free1_margin_top = get_post_meta($post->ID, 'ranking_free1_margin_top', true) ?  get_post_meta($post->ID, 'ranking_free1_margin_top', true) : '50';
  $ranking_free1_margin_bottom = get_post_meta($post->ID, 'ranking_free1_margin_bottom', true) ?  get_post_meta($post->ID, 'ranking_free1_margin_bottom', true) : '50';
  $ranking_free1_margin_top_mobile = get_post_meta($post->ID, 'ranking_free1_margin_top_mobile', true) ?  get_post_meta($post->ID, 'ranking_free1_margin_top_mobile', true) : '50';
  $ranking_free1_margin_bottom_mobile = get_post_meta($post->ID, 'ranking_free1_margin_bottom_mobile', true) ?  get_post_meta($post->ID, 'ranking_free1_margin_bottom_mobile', true) : '50';

  $show_ranking_free2 = get_post_meta($post->ID, 'show_ranking_free2', true);
  $ranking_free2_content_width = get_post_meta($post->ID, 'ranking_free2_content_width', true) ?  get_post_meta($post->ID, 'ranking_free2_content_width', true) : 'type1';
  $ranking_free2 = get_post_meta($post->ID, 'ranking_free2', true);
  $ranking_free2_font_size = get_post_meta($post->ID, 'ranking_free2_font_size', true) ?  get_post_meta($post->ID, 'ranking_free2_font_size', true) : '16';
  $ranking_free2_font_size_mobile = get_post_meta($post->ID, 'ranking_free2_font_size_mobile', true) ?  get_post_meta($post->ID, 'ranking_free2_font_size_mobile', true) : '14';
  $ranking_free2_margin_top = get_post_meta($post->ID, 'ranking_free2_margin_top', true) ?  get_post_meta($post->ID, 'ranking_free2_margin_top', true) : '50';
  $ranking_free2_margin_bottom = get_post_meta($post->ID, 'ranking_free2_margin_bottom', true) ?  get_post_meta($post->ID, 'ranking_free2_margin_bottom', true) : '50';
  $ranking_free2_margin_top_mobile = get_post_meta($post->ID, 'ranking_free2_margin_top_mobile', true) ?  get_post_meta($post->ID, 'ranking_free2_margin_top_mobile', true) : '50';
  $ranking_free2_margin_bottom_mobile = get_post_meta($post->ID, 'ranking_free2_margin_bottom_mobile', true) ?  get_post_meta($post->ID, 'ranking_free2_margin_bottom_mobile', true) : '50';

  $page_content_width = get_post_meta($post->ID, 'page_content_width', true) ?  get_post_meta($post->ID, 'page_content_width', true) : '1200';

  // コンテンツビルダー
  $ranking_content = get_post_meta( $post->ID, 'ranking_content', true );

  echo '<input type="hidden" name="page_ranking_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>

<div class="tcd_custom_field_wrap contents_builder_wrap">

 <?php // フリースペースの設定 -------------------------------------------------------------- ?>
 <div class="theme_option_field cf theme_option_field_ac">
  <h3 class="theme_option_headline"><?php _e('Free space setting', 'tcd-w'); ?></h3>
  <div class="theme_option_field_ac_content">

   <div class="sub_box">
    <h4 class="theme_option_subbox_headline"><?php _e( 'Above ranking list', 'tcd-w' ); ?></h4>
    <div class="sub_box_content">

     <p class="displayment_checkbox"><label for="show_ranking_free1"><input id="show_ranking_free1" type="checkbox" name="show_ranking_free1" value="1" <?php checked( $show_ranking_free1, 1 ); ?> /><?php _e( 'Display free space', 'tcd-w' ); ?></label></p>
     <div style="<?php if($show_ranking_free1 == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

      <h4 class="theme_option_headline2"><?php _e('Content width', 'tcd-w');  ?></h4>
      <ul class="design_radio_button">
       <li>
        <input type="radio" id="ranking_free1_content_width_type1" name="ranking_free1_content_width" value="type1" <?php checked( $ranking_free1_content_width, 'type1' ); ?> />
        <label for="ranking_free1_content_width_type1"><span class="page_change_image_width"><?php echo esc_attr($page_content_width); ?></span>px</label>
       </li>
       <li>
        <input type="radio" id="ranking_free1_content_width_type2" name="ranking_free1_content_width" value="type2" <?php checked( $ranking_free1_content_width, 'type2' ); ?> />
        <label for="ranking_free1_content_width_type2"><?php _e('Full screen width', 'tcd-w');  ?></label>
       </li>
      </ul>

      <h4 class="theme_option_headline2"><?php _e('Free space', 'tcd-w');  ?></h4>
      <?php wp_editor( $ranking_free1, 'cb_wysiwyg_editor_ranking_free1', array ('textarea_name' => 'ranking_free1')); ?>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_free1_font_size" value="<?php esc_attr_e( $ranking_free1_font_size ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_free1_font_size_mobile" value="<?php esc_attr_e( $ranking_free1_font_size_mobile ); ?>" /><span>px</span></li>
      </ul>

      <h4 class="theme_option_headline2"><?php _e('Space setting', 'tcd-w');  ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Margin top', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_free1_margin_top" value="<?php esc_attr_e( $ranking_free1_margin_top ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Margin bottom', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_free1_margin_bottom" value="<?php esc_attr_e( $ranking_free1_margin_bottom ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Margin top (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_free1_margin_top_mobile" value="<?php esc_attr_e( $ranking_free1_margin_top_mobile ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Margin bottom (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_free1_margin_bottom_mobile" value="<?php esc_attr_e( $ranking_free1_margin_bottom_mobile ); ?>" /><span>px</span></li>
      </ul>

     </div>

     <ul class="button_list cf">
      <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->

   <div class="sub_box">
    <h4 class="theme_option_subbox_headline"><?php _e( 'Under ranking list', 'tcd-w' ); ?></h4>
    <div class="sub_box_content">

     <p class="displayment_checkbox"><label for="show_ranking_free2"><input id="show_ranking_free2" type="checkbox" name="show_ranking_free2" value="1" <?php checked( $show_ranking_free2, 1 ); ?> /><?php _e( 'Display free space', 'tcd-w' ); ?></label></p>
     <div style="<?php if($show_ranking_free2 == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

      <h4 class="theme_option_headline2"><?php _e('Content width', 'tcd-w');  ?></h4>
      <ul class="design_radio_button">
       <li>
        <input type="radio" id="ranking_free2_content_width_type1" name="ranking_free2_content_width" value="type1" <?php checked( $ranking_free2_content_width, 'type1' ); ?> />
        <label for="ranking_free2_content_width_type1"><span class="page_change_image_width"><?php echo esc_attr($page_content_width); ?></span>px</label>
       </li>
       <li>
        <input type="radio" id="ranking_free2_content_width_type2" name="ranking_free2_content_width" value="type2" <?php checked( $ranking_free2_content_width, 'type2' ); ?> />
        <label for="ranking_free2_content_width_type2"><?php _e('Full screen width', 'tcd-w');  ?></label>
       </li>
      </ul>

      <h4 class="theme_option_headline2"><?php _e('Free space', 'tcd-w');  ?></h4>
      <?php wp_editor( $ranking_free2, 'cb_wysiwyg_editor_ranking_free2', array ('textarea_name' => 'ranking_free2')); ?>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_free2_font_size" value="<?php esc_attr_e( $ranking_free2_font_size ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_free2_font_size_mobile" value="<?php esc_attr_e( $ranking_free2_font_size_mobile ); ?>" /><span>px</span></li>
      </ul>

      <h4 class="theme_option_headline2"><?php _e('Space setting', 'tcd-w');  ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Margin top', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_free2_margin_top" value="<?php esc_attr_e( $ranking_free2_margin_top ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Margin bottom', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_free2_margin_bottom" value="<?php esc_attr_e( $ranking_free2_margin_bottom ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Margin top (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_free2_margin_top_mobile" value="<?php esc_attr_e( $ranking_free2_margin_top_mobile ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Margin bottom (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_free2_margin_bottom_mobile" value="<?php esc_attr_e( $ranking_free2_margin_bottom_mobile ); ?>" /><span>px</span></li>
      </ul>

     </div>

     <ul class="button_list cf">
      <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->

   <ul class="button_list cf">
    <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div><!-- END .theme_option_field_ac_content -->
 </div><!-- END .theme_option_field -->

 <div class="theme_option_message">
  <?php echo __( '<p>STEP1: Click add content button.<br />STEP2: Select content from dropdown menu.<br />STEP3: Input data and save the option.</p><br /><p>You can change order by dragging MOVE button and you can delete content by clicking DELETE button.</p>', 'tcd-w' ); ?>
  <?php echo __( '<p>Only one ranking list will be displayed at a time. Different ranking list will be displayed when user click the content link at the header.</p>', 'tcd-w' ); ?>
  <?php echo __( '<p>Margins will be automatically adjusted and displayed where the content is not set. You do not have to enter all the content.</p>', 'tcd-w' ); ?>
  <p class="rebox_group preview_page_image"><a href="<?php bloginfo('template_url'); ?>/admin/img/ranking.jpg"><?php _e( 'Preview page image', 'tcd-w' ); ?></a></p>
 </div>

 <?php
      // コンテンツビルダーはここから -----------------------------------------------------------------
 ?>
 <div class="contents_builder">
  <p class="cb_message"><?php _e( 'Click Add content button to start content builder', 'tcd-w' ); ?></p>
  <?php
       if ( $ranking_content && is_array( $ranking_content ) ) :
         foreach( $ranking_content as $key => $content ) :
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
          ranking_content_select( $cb_index, $content['cb_content_select'] );
          if ( ! empty( $content['cb_content_select'] ) ) :
            ranking_content_content_setting( $cb_index, $content['cb_content_select'], $content );
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
       <?php ranking_content_select( 'cb_cloneindex' ); ?>
    </div><!-- END .cb_column -->
   </div><!-- END .cb_column_area -->
  </div><!-- END .cb_row -->
  <?php
       foreach ( ranking_get_contents() as $key => $value ) :
         ranking_content_content_setting( 'cb_cloneindex', $key );
       endforeach;
  ?>
 </div><!-- END .contents_builder-clone -->

</div><!-- END .tcd_custom_field_wrap -->
<?php
}

function save_page_ranking( $post_id ) {

  // verify nonce
  if (!isset($_POST['page_ranking_nonce']) || !wp_verify_nonce($_POST['page_ranking_nonce'], basename(__FILE__))) {
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
   'show_ranking_free1','ranking_free1_content_width','ranking_free1','ranking_free1_font_size','ranking_free1_font_size_mobile','ranking_free1_margin_top','ranking_free1_margin_bottom','ranking_free1_margin_top_mobile','ranking_free1_margin_bottom_mobile',
   'show_ranking_free2','ranking_free2_content_width','ranking_free2','ranking_free2_font_size','ranking_free2_font_size_mobile','ranking_free2_margin_top','ranking_free2_margin_bottom','ranking_free2_margin_top_mobile','ranking_free2_margin_bottom_mobile',
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

	// コンテンツビルダー 整形保存
	if ( ! empty( $_POST['ranking_content'] ) && is_array( $_POST['ranking_content'] ) ) {
		$cb_contents = ranking_get_contents();
		$cb_data = array();

		foreach ( $_POST['ranking_content'] as $key => $value ) {
			// クローン用はスルー
			if ( 'cb_cloneindex' === $key ) continue;

			// コンテンツデフォルト値に入力値をマージ
			if ( ! empty( $value['cb_content_select'] ) && isset( $cb_contents[$value['cb_content_select']]['default'] ) ) {
				$value = array_merge( (array) $cb_contents[$value['cb_content_select']]['default'], $value );
			}

			// コンテンツ１
			if ( 'content1' === $value['cb_content_select'] ) {

				$value['show_content'] = ! empty( $value['show_content'] ) ? 1 : 0;

				$value['ranking_list_title'] = sanitize_text_field( $value['ranking_list_title'] );

				$value['catch'] = sanitize_textarea_field($value['catch']);
				$value['catch_font_size'] = absint( $value['catch_font_size'] );
				$value['catch_font_size_mobile'] = absint( $value['catch_font_size_mobile'] );
				$value['catch_font_type'] = sanitize_text_field( $value['catch_font_type'] );

				$value['desc'] = sanitize_textarea_field($value['desc']);
				$value['desc_font_size'] = absint( $value['desc_font_size'] );
				$value['desc_font_size_mobile'] = absint( $value['desc_font_size_mobile'] );

        $value['ranking_post_ids'] = wp_filter_nohtml_kses( $value['ranking_post_ids'] );

				$value['ranking_hide_icon'] = ! empty( $value['ranking_hide_icon'] ) ? 1 : 0;
        $value['ranking_label'] = wp_filter_nohtml_kses( $value['ranking_label'] );
        $value['ranking_label_font_size'] = wp_filter_nohtml_kses( $value['ranking_label_font_size'] );
        $value['ranking_number_font_size'] = wp_filter_nohtml_kses( $value['ranking_number_font_size'] );
        $value['ranking_number_bg_color'] = wp_filter_nohtml_kses( $value['ranking_number_bg_color'] );
        $value['ranking_number_font_color'] = wp_filter_nohtml_kses( $value['ranking_number_font_color'] );

        $value['item_title_font_size'] = wp_filter_nohtml_kses( $value['item_title_font_size'] );
        $value['item_title_font_size_mobile'] = wp_filter_nohtml_kses( $value['item_title_font_size_mobile'] );
        $value['item_title_font_type'] = wp_filter_nohtml_kses( $value['item_title_font_type'] );
        $value['item_desc_font_size'] = wp_filter_nohtml_kses( $value['item_desc_font_size'] );
        $value['item_desc_font_size_mobile'] = wp_filter_nohtml_kses( $value['item_desc_font_size_mobile'] );

        $value['ranking_post_num_mobile'] = wp_filter_nohtml_kses( $value['ranking_post_num_mobile'] );

        // カテゴリーランキング

				$value['category_catch'] = sanitize_textarea_field($value['category_catch']);
				$value['category_catch_font_size'] = absint( $value['category_catch_font_size'] );
				$value['category_catch_font_size_mobile'] = absint( $value['category_catch_font_size_mobile'] );
				$value['category_catch_font_type'] = sanitize_text_field( $value['category_catch_font_type'] );

				$value['category_desc'] = sanitize_textarea_field($value['category_desc']);
				$value['category_desc_font_size'] = absint( $value['category_desc_font_size'] );
				$value['category_desc_font_size_mobile'] = absint( $value['category_desc_font_size_mobile'] );

				$item_list = array();
				if ( $value['item_list'] && is_array( $value['item_list'] ) ) {
					foreach( array_values( $value['item_list'] ) as $repeater_value ) {
						$item_list[] = array_merge( $cb_contents[$value['cb_content_select']]['item_list_default'], $repeater_value );
					}
				}
				$value['item_list'] = $item_list;

				$value['category_headline_font_size'] = absint( $value['category_headline_font_size'] );
				$value['category_headline_font_size_mobile'] = absint( $value['category_headline_font_size_mobile'] );
				$value['category_headline_font_type'] = sanitize_text_field( $value['category_headline_font_type'] );
        $value['category_headline_bg_color'] = wp_filter_nohtml_kses( $value['category_headline_bg_color'] );

				$value['category_ranking_hide_icon'] = ! empty( $value['category_ranking_hide_icon'] ) ? 1 : 0;
        $value['category_ranking_label'] = wp_filter_nohtml_kses( $value['category_ranking_label'] );
        $value['category_ranking_label_font_size'] = wp_filter_nohtml_kses( $value['category_ranking_label_font_size'] );
        $value['category_ranking_number_font_size'] = wp_filter_nohtml_kses( $value['category_ranking_number_font_size'] );
        $value['category_ranking_number_bg_color'] = wp_filter_nohtml_kses( $value['category_ranking_number_bg_color'] );
        $value['category_ranking_number_font_color'] = wp_filter_nohtml_kses( $value['category_ranking_number_font_color'] );

        $value['category_item_title_font_size'] = wp_filter_nohtml_kses( $value['category_item_title_font_size'] );
        $value['category_item_title_font_size_mobile'] = wp_filter_nohtml_kses( $value['category_item_title_font_size_mobile'] );
        $value['category_item_title_font_type'] = wp_filter_nohtml_kses( $value['category_item_title_font_type'] );
        $value['category_item_desc_font_size'] = wp_filter_nohtml_kses( $value['category_item_desc_font_size'] );
        $value['category_item_desc_font_size_mobile'] = wp_filter_nohtml_kses( $value['category_item_desc_font_size_mobile'] );

        $value['category_ranking_post_num_mobile'] = wp_filter_nohtml_kses( $value['category_ranking_post_num_mobile'] );

			}

			$cb_data[] = $value;
		}

		if ( $cb_data ) {
			update_post_meta( $post_id, 'ranking_content', $cb_data );
		} else {
			delete_post_meta( $post_id, 'ranking_content' );
		}
	}

}
add_action('save_post', 'save_page_ranking');

/**
 * コンテンツビルダー コンテンツ一覧取得
 */
function ranking_get_contents() {
	return array(
    // コンテンツ１
		'content1' => array(
			'name' => 'content1',
			'label' => __( 'Ranking list', 'tcd-w' ),
			'default' => array(
				'show_content' => 1,
				'ranking_list_title' => '',
				'catch' => '',
				'catch_font_size' => 36,
				'catch_font_size_mobile' => 24,
				'catch_font_type' => 'type3',
				'desc' => '',
				'desc_font_size' => 16,
				'desc_font_size_mobile' => 14,
				'ranking_post_ids' => '',
				'ranking_hide_icon' => '',
				'ranking_label' => 'BEST',
				'ranking_label_font_size' => 14,
				'ranking_number_font_size' => 28,
				'ranking_number_bg_color' => '#000000',
				'ranking_number_font_color' => '#ffffff',
				'item_title_font_size' => 20,
				'item_title_font_size_mobile' => 16,
				'item_title_font_type' => 'type2',
				'item_desc_font_size' => 16,
				'item_desc_font_size_mobile' => 14,
				'ranking_post_num_mobile' => '3',
				'category_catch' => '',
				'category_catch_font_size' => 36,
				'category_catch_font_size_mobile' => 24,
				'category_catch_font_type' => 'type3',
				'category_desc' => '',
				'category_desc_font_size' => 16,
				'category_desc_font_size_mobile' => 14,
				'item_list' => array(),
				'category_headline_font_size' => 20,
				'category_headline_font_size_mobile' => 16,
				'category_headline_bg_color' => '#f4f4f4',
				'category_headline_font_type' => 'type3',
				'category_ranking_hide_icon' => '',
				'category_ranking_label' => 'BEST',
				'category_ranking_label_font_size' => 14,
				'category_ranking_number_font_size' => 28,
				'category_ranking_number_bg_color' => '#000000',
				'category_ranking_number_font_color' => '#ffffff',
				'category_item_title_font_size' => 20,
				'category_item_title_font_size_mobile' => 16,
				'category_item_title_font_type' => 'type2',
				'category_item_desc_font_size' => 16,
				'category_item_desc_font_size_mobile' => 14,
				'category_ranking_post_num_mobile' => '3',
			),
			'item_list_default' => array(
				'headline' => '',
				'sub_title' => '',
				'post_ids' => '',
			),
		),
	);
}

/**
 * コンテンツビルダー用 コンテンツ選択プルダウン
 */
function ranking_content_select( $cb_index = 'cb_cloneindex', $selected = null ) {
	$cb_contents = ranking_get_contents();

	if ( $selected && isset( $cb_contents[$selected] ) ) {
		$add_class = ' hidden';
	} else {
		$add_class = '';
	}

	$out = '<select name="ranking_content[' . esc_attr( $cb_index ) . '][cb_content_select]" class="cb_content_select' . $add_class . '">';
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
function ranking_content_content_setting( $cb_index = 'cb_cloneindex', $cb_content_select = null, $value = array() ) {

  global $post, $font_type_options, $content_direction_options, $content_direction_options2;

  $options = get_design_plus_option();
  $product_label = $options['product_label'] ? esc_html( $options['product_label'] ) : __( 'Product', 'tcd-w' );

	$cb_contents = ranking_get_contents();

  $page_content_width = get_post_meta($post->ID, 'page_content_width', true) ?  get_post_meta($post->ID, 'page_content_width', true) : '1200';

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
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?></h3>
  <div class="cb_content">

   <p class="hidden"><input name="ranking_content[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p><label><input name="ranking_content[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><?php printf(__('Display %s', 'tcd-w'), $cb_contents[$cb_content_select]['label']); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Title of ranking list', 'tcd-w');  ?></h4>
   <input class="cb-repeater-label full_width" type="text" name="ranking_content[<?php echo $cb_index; ?>][ranking_list_title]" value="<?php echo esc_textarea($value['ranking_list_title']); ?>">

   <h4 class="theme_option_headline2"><?php _e('Ranking list setting', 'tcd-w');  ?></h4>

   <div class="sub_box">
    <h4 class="theme_option_subbox_headline"><?php _e( 'Main ranking setting', 'tcd-w' ); ?></h4>
    <div class="sub_box_content">

   <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
   <textarea class="full_width" cols="50" rows="2" name="ranking_content[<?php echo $cb_index; ?>][catch]"><?php echo esc_textarea($value['catch']); ?></textarea>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="ranking_content[<?php echo $cb_index; ?>][catch_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_content[<?php echo $cb_index; ?>][catch_font_size]" value="<?php esc_attr_e( $value['catch_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_content[<?php echo $cb_index; ?>][catch_font_size_mobile]" value="<?php esc_attr_e( $value['catch_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
   <textarea class="full_width" cols="50" rows="4" name="ranking_content[<?php echo $cb_index; ?>][desc]"><?php echo esc_textarea($value['desc']); ?></textarea>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_content[<?php echo $cb_index; ?>][desc_font_size]" value="<?php esc_attr_e( $value['desc_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_content[<?php echo $cb_index; ?>][desc_font_size_mobile]" value="<?php esc_attr_e( $value['desc_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php printf(__('%s to display in ranking list', 'tcd-w'), $product_label); ?></h4>
   <div class="theme_option_message2">
    <p><?php _e('Please enter a post ID numbers in each row.', 'tcd-w'); ?></p>
   </div>
   <textarea class="full_width" cols="50" rows="10" name="ranking_content[<?php echo $cb_index; ?>][ranking_post_ids]"><?php echo esc_textarea($value['ranking_post_ids']); ?></textarea>

   <h4 class="theme_option_headline2"><?php _e('Ranking list setting', 'tcd-w'); ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Hide featured icon', 'tcd-w'); ?></span><input name="ranking_content[<?php echo $cb_index; ?>][ranking_hide_icon]" type="checkbox" value="1" <?php checked( $value['ranking_hide_icon'], 1 ); ?>></li>
    <li class="cf"><span class="label"><?php _e('Ranking label', 'tcd-w'); ?></span><input class="full_width" type="text" name="ranking_content[<?php echo $cb_index; ?>][ranking_label]" value="<?php echo esc_attr($value['ranking_label']); ?>" /></li>
    <li class="cf"><span class="label"><?php _e('Font size of label', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_content[<?php echo $cb_index; ?>][ranking_label_font_size]" value="<?php echo esc_attr($value['ranking_label_font_size']); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of ranking number', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_content[<?php echo $cb_index; ?>][ranking_number_font_size]" value="<?php echo esc_attr($value['ranking_number_font_size']); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font color of ranking number', 'tcd-w'); ?></span><input type="text" name="ranking_content[<?php echo $cb_index; ?>][ranking_number_font_color]" value="<?php echo esc_attr($value['ranking_number_font_color']); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
    <li class="cf"><span class="label"><?php _e('Background color of ranking number', 'tcd-w'); ?></span><input type="text" name="ranking_content[<?php echo $cb_index; ?>][ranking_number_bg_color]" value="<?php echo esc_attr($value['ranking_number_bg_color']); ?>" data-default-color="#000000" class="c-color-picker"></li>
    <li class="cf"><span class="label"><?php _e('Font type of title', 'tcd-w');  ?></span>
     <select name="ranking_content[<?php echo $cb_index; ?>][item_title_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['item_title_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_content[<?php echo $cb_index; ?>][item_title_font_size]" value="<?php echo esc_attr($value['item_title_font_size']); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of title (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_content[<?php echo $cb_index; ?>][item_title_font_size_mobile]" value="<?php echo esc_attr($value['item_title_font_size_mobile']); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of description', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_content[<?php echo $cb_index; ?>][item_desc_font_size]" value="<?php echo esc_attr($value['item_desc_font_size']); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of description (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_content[<?php echo $cb_index; ?>][item_desc_font_size_mobile]" value="<?php echo esc_attr($value['item_desc_font_size_mobile']); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Number of ranking to display (mobile)', 'tcd-w');  ?></span>
     <select name="ranking_content[<?php echo $cb_index; ?>][ranking_post_num_mobile]">
      <?php for($i=3; $i<= 20; $i++): ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $value['ranking_post_num_mobile'], $i ); ?>><?php echo esc_html($i); ?></option>
      <?php endfor; ?>
     </select>
    </li>
   </ul>

     <ul class="button_list cf">
      <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->

   <?php // カテゴリーランキングここから -------------------------- ?>

   <div class="sub_box">
    <h4 class="theme_option_subbox_headline"><?php _e( 'Category ranking setting', 'tcd-w' ); ?></h4>
    <div class="sub_box_content">

   <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
   <textarea class="full_width" cols="50" rows="2" name="ranking_content[<?php echo $cb_index; ?>][category_catch]"><?php echo esc_textarea($value['category_catch']); ?></textarea>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w');  ?></span>
     <select name="ranking_content[<?php echo $cb_index; ?>][category_catch_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['category_catch_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_content[<?php echo $cb_index; ?>][category_catch_font_size]" value="<?php esc_attr_e( $value['category_catch_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_content[<?php echo $cb_index; ?>][category_catch_font_size_mobile]" value="<?php esc_attr_e( $value['category_catch_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
   <textarea class="full_width" cols="50" rows="4" name="ranking_content[<?php echo $cb_index; ?>][category_desc]"><?php echo esc_textarea($value['category_desc']); ?></textarea>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_content[<?php echo $cb_index; ?>][category_desc_font_size]" value="<?php esc_attr_e( $value['category_desc_font_size'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_content[<?php echo $cb_index; ?>][category_desc_font_size_mobile]" value="<?php esc_attr_e( $value['category_desc_font_size_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   <?php // リピーターここから -------------------------- ?>
   <h4 class="theme_option_headline2"><?php _e('Ranking setting', 'tcd-w');  ?></h4>
   <div class="theme_option_message2">
    <p><?php _e('You can change order by dragging each item.', 'tcd-w'); ?></p>
   </div>
   <div class="repeater-wrapper">
    <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
     <?php
          if ( $value['item_list'] && is_array( $value['item_list'] ) ) :
            foreach ( $value['item_list'] as $repeater_key => $repeater_value ) :
               $repeater_value = array_merge( $cb_contents[$cb_content_select]['item_list_default'], $repeater_value );
     ?>
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-w' ); ?></h4>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e( 'Headline', 'tcd-w' ); ?></h4>
       <input class="repeater-label full_width" type="text" name="ranking_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][headline]" value="<?php echo esc_html($repeater_value['headline']); ?>">
       <h4 class="theme_option_headline2"><?php _e( 'Subtitle', 'tcd-w' ); ?></h4>
       <input class="full_width" type="text" name="ranking_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][sub_title]" value="<?php echo esc_html($repeater_value['sub_title']); ?>">
       <h4 class="theme_option_headline2"><?php printf(__('%s to display in ranking list', 'tcd-w'), $product_label); ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('Please enter a post ID numbers in each row.', 'tcd-w'); ?></p>
       </div>
       <textarea class="large-text" cols="50" rows="5" name="ranking_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][post_ids]"><?php echo esc_textarea($repeater_value['post_ids']); ?></textarea>
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
       <h4 class="theme_option_headline2"><?php _e( 'Headline', 'tcd-w' ); ?></h4>
       <input class="repeater-label full_width" type="text" name="ranking_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][headline]" value="<?php echo esc_html($repeater_value['headline']); ?>">
       <h4 class="theme_option_headline2"><?php _e( 'Subtitle', 'tcd-w' ); ?></h4>
       <input class="full_width" type="text" name="ranking_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][sub_title]" value="<?php echo esc_html($repeater_value['sub_title']); ?>">
       <h4 class="theme_option_headline2"><?php printf(__('%s to display in ranking list', 'tcd-w'), $product_label); ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('Please enter a post ID numbers in each row.', 'tcd-w'); ?></p>
       </div>
       <textarea class="large-text" cols="50" rows="5" name="ranking_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][post_ids]"><?php echo esc_textarea($repeater_value['post_ids']); ?></textarea>
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

   <h4 class="theme_option_headline2"><?php _e('Ranking list setting', 'tcd-w'); ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Font type of headline', 'tcd-w');  ?></span>
     <select name="ranking_content[<?php echo $cb_index; ?>][category_headline_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['category_headline_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size of headline', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_content[<?php echo $cb_index; ?>][category_headline_font_size]" value="<?php echo esc_attr($value['category_headline_font_size']); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of headline (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_content[<?php echo $cb_index; ?>][category_headline_font_size_mobile]" value="<?php echo esc_attr($value['category_headline_font_size_mobile']); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Background color of headline', 'tcd-w'); ?></span><input type="text" name="ranking_content[<?php echo $cb_index; ?>][category_headline_bg_color]" value="<?php echo esc_attr($value['category_headline_bg_color']); ?>" data-default-color="#f4f4f4" class="c-color-picker"></li>
    <li class="cf"><span class="label"><?php _e('Hide featured icon', 'tcd-w'); ?></span><input name="ranking_content[<?php echo $cb_index; ?>][category_ranking_hide_icon]" type="checkbox" value="1" <?php checked( $value['category_ranking_hide_icon'], 1 ); ?>></li>
    <li class="cf"><span class="label"><?php _e('Ranking label', 'tcd-w'); ?></span><input class="full_width" type="text" name="ranking_content[<?php echo $cb_index; ?>][category_ranking_label]" value="<?php echo esc_attr($value['category_ranking_label']); ?>" /></li>
    <li class="cf"><span class="label"><?php _e('Font size of label', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_content[<?php echo $cb_index; ?>][category_ranking_label_font_size]" value="<?php echo esc_attr($value['category_ranking_label_font_size']); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of ranking number', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_content[<?php echo $cb_index; ?>][category_ranking_number_font_size]" value="<?php echo esc_attr($value['category_ranking_number_font_size']); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font color of ranking number', 'tcd-w'); ?></span><input type="text" name="ranking_content[<?php echo $cb_index; ?>][category_ranking_number_font_color]" value="<?php echo esc_attr($value['category_ranking_number_font_color']); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
    <li class="cf"><span class="label"><?php _e('Background color of ranking number', 'tcd-w'); ?></span><input type="text" name="ranking_content[<?php echo $cb_index; ?>][category_ranking_number_bg_color]" value="<?php echo esc_attr($value['category_ranking_number_bg_color']); ?>" data-default-color="#000000" class="c-color-picker"></li>
    <li class="cf"><span class="label"><?php _e('Font type of title', 'tcd-w');  ?></span>
     <select name="ranking_content[<?php echo $cb_index; ?>][category_item_title_font_type]">
      <?php foreach ( $font_type_options as $option ) { ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $value['category_item_title_font_type'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
      <?php } ?>
     </select>
    </li>
    <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_content[<?php echo $cb_index; ?>][category_item_title_font_size]" value="<?php echo esc_attr($value['category_item_title_font_size']); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of title (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_content[<?php echo $cb_index; ?>][category_item_title_font_size_mobile]" value="<?php echo esc_attr($value['category_item_title_font_size_mobile']); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of description', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_content[<?php echo $cb_index; ?>][category_item_desc_font_size]" value="<?php echo esc_attr($value['category_item_desc_font_size']); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Font size of description (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="ranking_content[<?php echo $cb_index; ?>][category_item_desc_font_size_mobile]" value="<?php echo esc_attr($value['category_item_desc_font_size_mobile']); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Number of ranking to display (mobile)', 'tcd-w');  ?></span>
     <select name="ranking_content[<?php echo $cb_index; ?>][category_ranking_post_num_mobile]">
      <?php for($i=3; $i<= 20; $i++): ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $value['category_ranking_post_num_mobile'], $i ); ?>><?php echo esc_html($i); ?></option>
      <?php endfor; ?>
     </select>
    </li>
   </ul>

     <ul class="button_list cf">
      <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->

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


