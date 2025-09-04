<?php
/*
Template Name:LP page
*/
__('LP page', 'tcd-w');
?>
<?php
     get_header();
     $options = get_design_plus_option();
     $hide_header = get_post_meta($post->ID, 'page_hide_header_image', true);
     $change_content_width = get_post_meta($post->ID, 'change_content_width', true);
     $page_content_width = get_post_meta($post->ID, 'page_content_width', true) ?  get_post_meta($post->ID, 'page_content_width', true) : '1200';
?>
<div id="page_header_wrap">
 <?php
      if(!$hide_header){
        $header_catch = get_post_meta($post->ID, 'page_header_catch', true);
        $header_catch_font_type = get_post_meta($post->ID, 'page_header_catch_font_type', true) ?  get_post_meta($post->ID, 'page_header_catch_font_type', true) : 'type3';
        $header_sub_title = get_post_meta($post->ID, 'page_header_sub_title', true);
        $header_sub_title_font_type = get_post_meta($post->ID, 'page_header_sub_title_font_type', true) ?  get_post_meta($post->ID, 'page_header_sub_title_font_type', true) : 'type2';
        $header_desc = get_post_meta($post->ID, 'page_header_desc', true);
        $header_desc_mobile = get_post_meta($post->ID, 'page_header_desc_mobile', true);
        $bg_image = get_post_meta($post->ID, 'page_header_bg_image', true) ? wp_get_attachment_image_src( get_post_meta($post->ID, 'page_header_bg_image', true), 'full' ) : '';
        $bg_image_mobile = get_post_meta($post->ID, 'page_header_bg_image_mobile', true) ? wp_get_attachment_image_src( get_post_meta($post->ID, 'page_header_bg_image_mobile', true), 'full' ) : '';
        $use_overlay = get_post_meta($post->ID, 'page_header_use_overlay', true);
        if($use_overlay) {
          $overlay_color = get_post_meta($post->ID, 'page_header_overlay_color', true) ?  get_post_meta($post->ID, 'page_header_overlay_color', true) : '#000000';
          $overlay_color = hex2rgb($overlay_color);
          $overlay_color = implode(",",$overlay_color);
          $overlay_opacity = get_post_meta($post->ID, 'page_header_overlay_opacity', true) ?  get_post_meta($post->ID, 'page_header_overlay_opacity', true) : '0.3';
        }
        $image_layout = get_post_meta($post->ID, 'image_layout', true) ?  get_post_meta($post->ID, 'image_layout', true) : 'type3';
        $image_layout2 = get_post_meta($post->ID, 'image_layout2', true) ?  get_post_meta($post->ID, 'image_layout2', true) : 'type2';
        $image_layout_mobile = get_post_meta($post->ID, 'image_layout_mobile', true) ?  get_post_meta($post->ID, 'image_layout_mobile', true) : 'type2';
        $text_layout = get_post_meta($post->ID, 'text_layout', true) ?  get_post_meta($post->ID, 'text_layout', true) : 'type1';
        $image_animation_type = get_post_meta($post->ID, 'image_animation_type', true) ?  get_post_meta($post->ID, 'image_animation_type', true) : 'type1';
        $layer_image = get_post_meta($post->ID, 'layer_image', true) ? wp_get_attachment_image_src( get_post_meta($post->ID, 'layer_image', true), 'full' ) : '';
        $layer_image_mobile = get_post_meta($post->ID, 'layer_image_mobile', true) ? wp_get_attachment_image_src( get_post_meta($post->ID, 'layer_image_mobile', true), 'full' ) : '';
 ?>
 <div id="page_header" class="image_layout_<?php echo esc_attr($image_layout); ?> image_layout2_<?php echo esc_attr($image_layout2); ?> image_layout_mobile_<?php echo esc_attr($image_layout_mobile); ?> text_layout_<?php echo esc_attr($text_layout); ?> animation_<?php echo esc_attr($image_animation_type); ?> <?php if(empty($layer_image)) { echo 'no_layer_image'; }; ?>">
  <div id="page_header_inner" <?php if($change_content_width) { ?>style="width:<?php echo esc_attr($page_content_width); ?>px;"<?php }; ?>>
   <div class="caption">
    <?php if($header_sub_title){ ?>
    <p class="sub_title animate_item rich_font_<?php echo esc_attr($header_sub_title_font_type); ?>"><span><?php echo wp_kses_post(nl2br($header_sub_title)); ?></span></p>
    <?php }; ?>
    <?php if($header_catch){ ?>
    <h1 class="catch  animate_item rich_font_<?php echo esc_attr($header_catch_font_type); ?>"><?php echo wp_kses_post(nl2br($header_catch)); ?></h1>
    <?php }; ?>
    <?php if($header_desc){ ?>
    <p class="desc animate_item"><span<?php if($header_desc_mobile){ echo ' class="pc"'; }; ?>><?php echo wp_kses_post(nl2br($header_desc)); ?></span><?php if($header_desc_mobile){ ?><span class="mobile"><?php echo wp_kses_post(nl2br($header_desc_mobile)); ?></span><?php }; ?></p>
    <?php }; ?>
   </div>
   <?php if($layer_image) { ?>
   <div class="layer_image animate_item">
    <img <?php if($layer_image_mobile){ echo 'class="pc"'; }; ?> src="<?php echo esc_attr($layer_image[0]); ?>" alt="" title="">
    <?php if($layer_image_mobile) { ?><img class="mobile" src="<?php echo esc_attr($layer_image_mobile[0]); ?>" alt="" title=""><?php }; ?>
   </div>
   <?php }; ?>
  </div>
  <?php if($use_overlay) { ?>
  <div class="overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></div>
  <?php }; ?>
  <?php if($bg_image) { ?>
  <div class="bg_image<?php if($bg_image_mobile) { echo ' pc'; }; ?>" style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center top; background-size:cover;"></div>
  <?php }; ?>
  <?php if($bg_image_mobile) { ?>
  <div class="bg_image mobile" style="background:url(<?php echo esc_attr($bg_image_mobile[0]); ?>) no-repeat center top; background-size:cover;"></div>
  <?php }; ?>
 </div>
 <?php }; ?>

 <?php
      // ƒRƒ“ƒeƒ“ƒcƒŠƒ“ƒN ------------------------------------------------------------
      $design1_content = get_post_meta( $post->ID, 'design1_content', true );
      $page_hide_content_link = get_post_meta($post->ID, 'page_hide_content_link', true);
      if(!$page_hide_content_link){
        if ( $design1_content && is_array( $design1_content ) ) :
 ?>
 <div id="header_category_button_wrap" class="animate_item" <?php if($change_content_width) { ?>data-width="<?php echo esc_attr($page_content_width); ?>"<?php }; ?>>
  <div id="header_category_button" class="type2" <?php if($change_content_width) { ?>style="width:<?php echo esc_attr($page_content_width); ?>px;"<?php }; ?>>
   <ol>
    <?php
         $i = 1;
         foreach( $design1_content as $key => $content ) :
           if ( $content['show_content'] && !empty($content['headline']) ) {
    ?>
    <li<?php if($i == 1){ echo ' class="active"'; }; ?>><a href="#dc1_content_<?php echo esc_attr($key); ?>"><?php echo esc_html($content['headline']); ?></a></li>
    <?php }; $i++; endforeach; ?>
   </ol>
   <div class="slide_item"></div>
  </div>
 </div>
 <?php endif; }; ?>
</div><!-- END #page_header_wrap -->

<div id="design_page1" class="content_link_target_top">

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

 <?php
      // ƒRƒ“ƒeƒ“ƒcƒrƒ‹ƒ_[
      if ( $design1_content && is_array( $design1_content ) ) :
        foreach( $design1_content as $key => $content ) :

        // ƒRƒ“ƒeƒ“ƒc‚P -----------------------------------------------------------------
        if ( ($content['cb_content_select'] == 'content1') && $content['show_content']) {
  ?>
  <div class="design1_content1 design1_content content_link_target num<?php echo esc_attr($key); ?>" id="dc1_content_<?php echo $key; ?>" <?php if($change_content_width) { ?>style="width:<?php echo esc_attr($page_content_width); ?>px;"<?php }; ?>>

   <?php
        if(!empty($content['headline'])) {
          if($content['headline_shape'] != 'type3'){
            $use_overlay = $content['bg_use_overlay'];
            if($use_overlay) {
              $overlay_color = $content['bg_overlay_color'] ?  $content['bg_overlay_color'] : '#000000';
              $overlay_color = hex2rgb($overlay_color);
              $overlay_color = implode(",",$overlay_color);
              $overlay_opacity = $content['bg_overlay_opacity'] ?  $content['bg_overlay_opacity'] : '0.3';
            }
   ?>
   <h3 class="top_headline inview rich_font_<?php echo esc_attr($content['headline_font_type']); ?> type1 shape_<?php echo esc_attr($content['headline_shape']); ?>">
    <span class="label"><?php echo wp_kses_post(nl2br($content['headline'])); ?></span>
    <?php if($use_overlay) { ?>
     <span class="overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></span>
    <?php }; ?>
   </h3>
   <?php } else { ?>
   <h3 class="top_headline inview rich_font_<?php echo esc_attr($content['headline_font_type']); ?> type2 shape_<?php echo esc_attr($content['headline_shape']); ?>"><?php echo wp_kses_post(nl2br($content['headline'])); ?></h3>
   <?php }; }; ?>

   <div class="content_header">
    <?php
         if(!empty($content['catch'])) {
           $catch_text_align = $content['catch_text_align'] ?  $content['catch_text_align'] : 'type2';
    ?>
    <h3 class="catch inview rich_font_<?php echo esc_attr($content['catch_font_type']); ?> text_align_<?php echo esc_attr($catch_text_align); ?>"><?php echo wp_kses_post(nl2br($content['catch'])); ?></h3>
    <?php }; ?>
    <?php if(!empty($content['desc'])) { ?>
    <p class="desc inview"><?php echo wp_kses_post(nl2br($content['desc'])); ?></p>
    <?php }; ?>
   </div>

   <?php if (!empty($content['item_list']) && is_array( $content['item_list'] ) ) : ?>
   <div class="item_list inview clearfix">
    <?php
         foreach ( $content['item_list'] as $key => $value ) :
          $image = $value['image'] ? wp_get_attachment_image_src( $value['image'], 'full' ) : '';
          $title = $value['title'];
          $desc = $value['desc'];
    ?>
    <div class="item">
     <?php if($image){ ?>
     <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
     <?php }; ?>
     <div class="content">
      <?php if($title) { ?>
      <h4 class="title rich_font_<?php echo esc_attr($content['item_title_font_type']); ?>"><?php echo wp_kses_post(nl2br($title)); ?></h4>
      <?php }; ?>
      <?php if($desc) { ?>
      <p class="desc"><?php echo wp_kses_post(nl2br($desc)); ?></p>
      <?php }; ?>
     </div>
    </div>
    <?php endforeach; ?>
   </div><!-- END .item_list -->
   <?php endif; ?>

   <?php
        if($content['show_button']){
           $button_animation_type = isset($content['button_animation_type']) ?  $content['button_animation_type'] : 'type1';
   ?>
   <div class="link_button inview">
    <a class="button_animation_<?php echo esc_attr($button_animation_type); ?>" href="<?php echo esc_url($content['button_url']); ?>" <?php if($content['button_target']){ echo 'target="_blank"'; }; ?>><?php echo esc_html($content['button_label']); ?></a>
   </div>
   <?php }; ?>

  </div><!-- END .design1_content1 -->

  <?php
        // ƒRƒ“ƒeƒ“ƒc‚Q -----------------------------------------------------------------
        } elseif ( ($content['cb_content_select'] == 'content2') && $content['show_content']) {
          $image = $content['image'] ? wp_get_attachment_image_src( $content['image'], 'full' ) : '';
          $image_mobile = $content['image_mobile'] ? wp_get_attachment_image_src( $content['image_mobile'], 'full' ) : '';
  ?>
  <div class="design1_content2 inview design1_content content_link_target num<?php echo $key; ?> image_layout_<?php echo esc_attr($content['image_layout']); ?> image_layout2_<?php echo esc_attr($content['image_layout2']); ?> image_layout_mobile_<?php echo esc_attr($content['image_layout_mobile']); ?> text_layout_<?php echo esc_attr($content['text_layout']); ?> text_layout_mobile_<?php echo esc_attr($content['text_layout_mobile']); ?> animation_<?php echo esc_attr($content['animation_type']); ?> <?php if(empty($image)){ echo 'no_layer_image'; }; ?>" id="dc1_content_<?php echo $key; ?>">

   <div class="cb_contents_inner clearfix">

    <div class="content">

     <?php if(!empty($content['catch'])) { ?>
     <h4 class="catch animate_item rich_font_<?php echo esc_attr($content['catch_font_type']); ?>"><?php echo wp_kses_post(nl2br($content['catch'])); ?></h4>
     <?php }; ?>

     <?php if(!empty($content['desc'])) { ?>
     <p class="desc animate_item"><?php echo wp_kses_post(nl2br($content['desc'])); ?></p>
     <?php }; ?>

     <?php
          if($content['show_button']){
             $button_animation_type = isset($content['button_animation_type']) ?  $content['button_animation_type'] : 'type1';
     ?>
     <div class="link_button animate_item">
      <a class="button_animation_<?php echo esc_attr($button_animation_type); ?>" href="<?php echo esc_url($content['button_url']); ?>" <?php if($content['button_target']){ echo 'target="_blank"'; }; ?>><?php echo esc_html($content['button_label']); ?></a>
     </div>
     <?php }; ?>

    </div>

   </div><!-- END .cb_contents_inner -->

   <?php if($image) { ?>
   <div class="layer_image animate_item">
    <img <?php if($image_mobile) { echo 'class="pc"'; }; ?> src="<?php echo esc_attr($image[0]); ?>" alt="" title="">
    <?php if($image_mobile) { ?><img class="mobile" src="<?php echo esc_attr($image_mobile[0]); ?>" alt="" title=""><?php }; ?>
   </div>
   <?php }; ?>

   <?php
        if($content['bg_use_overlay']){
          $bg_overlay_color = $content['bg_overlay_color'] ? $content['bg_overlay_color'] : '#000000';
          $bg_overlay_color = hex2rgb($bg_overlay_color);
          $bg_overlay_color = implode(",",$bg_overlay_color);
          $bg_overlay_opacity = $content['bg_overlay_opacity'] ? $content['bg_overlay_opacity'] : '0.3';
   ?>
   <div class="overlay" style="background:rgba(<?php echo $bg_overlay_color; ?>,<?php echo $bg_overlay_opacity; ?>)"></div>
   <?php }; ?>

   <?php
        $bg_image = $content['bg_image'] ? wp_get_attachment_image_src( $content['bg_image'], 'full' ) : '';
        $bg_image_mobile = $content['bg_image_mobile'] ? wp_get_attachment_image_src( $content['bg_image_mobile'], 'full' ) : '';
        if($bg_image) {
   ?>
   <div class="bg_image <?php if($bg_image_mobile) { echo 'pc'; }; ?>" style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center center; background-size:cover;"></div>
   <?php if($bg_image_mobile) { ?><div class="bg_image mobile" style="background:url(<?php echo esc_attr($bg_image_mobile[0]); ?>) no-repeat center center; background-size:cover;"></div><?php }; ?>
   <?php }; ?>

  </div><!-- END .design1_content2 -->

  <?php
        // ƒRƒ“ƒeƒ“ƒc‚R -----------------------------------------------------------------
        } elseif ( ($content['cb_content_select'] == 'content3') && $content['show_content']) {
  ?>
  <div class="design1_content3 design1_content content_link_target num<?php echo esc_attr($key); ?> width_<?php echo esc_attr($content['content_width']); ?>" id="dc1_content_<?php echo $key; ?>" style="width:<?php if($content['content_width'] == 'type1') { echo esc_attr($page_content_width) . 'px'; } else { echo '100%'; }; ?>;">

   <?php
        if(!empty($content['headline'])) {
          if($content['headline_shape'] != 'type3'){
            $use_overlay = $content['bg_use_overlay'];
            if($use_overlay) {
              $overlay_color = $content['bg_overlay_color'] ?  $content['bg_overlay_color'] : '#000000';
              $overlay_color = hex2rgb($overlay_color);
              $overlay_color = implode(",",$overlay_color);
              $overlay_opacity = $content['bg_overlay_opacity'] ?  $content['bg_overlay_opacity'] : '0.3';
            }
   ?>
   <h3 class="top_headline inview rich_font_<?php echo esc_attr($content['headline_font_type']); ?> type1 shape_<?php echo esc_attr($content['headline_shape']); ?>">
    <span class="label"><?php echo wp_kses_post(nl2br($content['headline'])); ?></span>
    <?php if($use_overlay) { ?>
     <span class="overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></span>
    <?php }; ?>
   </h3>
   <?php } else { ?>
   <h3 class="top_headline inview rich_font_<?php echo esc_attr($content['headline_font_type']); ?> type2 shape_<?php echo esc_attr($content['headline_shape']); ?>"><?php echo wp_kses_post(nl2br($content['headline'])); ?></h3>
   <?php }; }; ?>

   <div class="content_header">
    <?php
         if(!empty($content['catch'])) {
           $catch_text_align = $content['catch_text_align'] ?  $content['catch_text_align'] : 'type2';
    ?>
    <h3 class="catch inview rich_font_<?php echo esc_attr($content['catch_font_type']); ?> text_align_<?php echo esc_attr($catch_text_align); ?>"><?php echo wp_kses_post(nl2br($content['catch'])); ?></h3>
    <?php }; ?>
   </div>

   <?php if(!empty($content['desc'])) { ?>
   <div class="post_content clearfix">
    <?php echo apply_filters('the_content', $content['desc'] ); ?>
   </div>
   <?php }; ?>

   <?php
        if($content['show_button']){
           $button_animation_type = isset($content['button_animation_type']) ?  $content['button_animation_type'] : 'type1';
   ?>
   <div class="link_button inview">
    <a class="button_animation_<?php echo esc_attr($button_animation_type); ?>" href="<?php echo esc_url($content['button_url']); ?>" <?php if($content['button_target']){ echo 'target="_blank"'; }; ?>><?php echo esc_html($content['button_label']); ?></a>
   </div>
   <?php }; ?>

  </div><!-- END .design1_content1 -->

  <?php
           };
         endforeach; // END •À‚Ñ‘Ö‚¦
       endif;
  ?>

 <?php endwhile; endif; ?>

</div><!-- END #design_page1 -->

<?php get_footer(); ?>