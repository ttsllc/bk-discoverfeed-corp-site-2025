<?php

// カテゴリー編集用入力欄を出力 -------------------------------------------------------
function product_category_edit_extra_fields( $term ) {
	$term_meta = get_option( 'taxonomy_' . $term->term_id, array() );
	$term_meta = array_merge( array(
		'image' => null,
		'sub_title' => '',
	), $term_meta );
?>
<tr class="form-field">
	<th colspan="2">

<div class="custom_category_meta">
 <h3 class="ccm_headline"><?php _e( 'Mega menu setting', 'tcd-w' ); ?></h3>

 <div class="ccm_content clearfix">
  <h4 class="theme_option_headline2"><?php _e('Subtitle', 'tcd-w');  ?></h4>
  <div class="input_field">
   <input type="text" class="full_width" name="term_meta[sub_title]" value="<?php echo esc_attr( $term_meta['sub_title'] ); ?>">
  </div><!-- END input_field -->
 </div><!-- END ccm_content -->

 <div class="ccm_content clearfix">
  <h4 class="headline"><?php _e( 'Image', 'tcd-w' ); ?></h4>
  <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '172', '180'); ?></p>
  <div class="input_field">
		<div class="image_box cf">
			<div class="cf cf_media_field hide-if-no-js image">
				<input type="hidden" value="<?php if ( $term_meta['image'] ) echo esc_attr( $term_meta['image'] ); ?>" id="image" name="term_meta[image]" class="cf_media_id">
				<div class="preview_field"><?php if ( $term_meta['image'] ) echo wp_get_attachment_image( $term_meta['image'], 'medium'); ?></div>
				<div class="button_area">
					<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
					<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $term_meta['image'] ) echo 'hidden'; ?>">
				</div>
			</div>
		</div>
  </div><!-- END input_field -->
 </div><!-- END ccm_content -->

</div><!-- END .custom_category_meta -->

 </th>
</tr><!-- END .form-field -->
<?php
}
add_action( 'product_category_edit_form_fields', 'product_category_edit_extra_fields' );


// データを保存 -------------------------------------------------------
function product_category_save_extra_fileds( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$term_meta = get_option( "taxonomy_{$term_id}", array() );
		$meta_keys = array(
			'sub_title','image',
		);
		foreach ( $meta_keys as $key ) {
			if ( isset( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}

		update_option( "taxonomy_{$term_id}", $term_meta );
	}
}
add_action( 'edited_product_category', 'product_category_save_extra_fileds' );

