<?php
     $options = get_design_plus_option();

     $use_overlay = $options['blog_widget_use_overlay'];
     if($use_overlay) {
       $overlay_color = hex2rgb($options['blog_widget_overlay_color']);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['blog_widget_overlay_opacity'];
     }

     if ( is_active_sidebar( 'blog_widget_mobile' ) || is_active_sidebar( 'blog_widget_left' ) || is_active_sidebar( 'blog_widget_right' )) {
?>
<div id="widget_area" style="background:<?php echo esc_attr($options['blog_bg_color']); ?>;">
 <div id="widget_area_inner" class="clearfix">

  <?php if ( is_mobile() && is_active_sidebar( 'blog_widget_mobile' ) ) { ?>

  <div id="mobile_widget">
   <?php dynamic_sidebar( 'blog_widget_mobile' ); ?>
  </div>

  <?php } else { ?>

  <?php if ( is_active_sidebar( 'blog_widget_left' ) ) { ?>
  <div id="left_widget">
   <?php dynamic_sidebar( 'blog_widget_left' ); ?>
  </div>
  <?php }; ?>

  <?php if ( is_active_sidebar( 'blog_widget_right' ) ) { ?>
  <div id="right_widget">
   <?php dynamic_sidebar( 'blog_widget_right' ); ?>
  </div>
  <?php }; ?>

  <?php }; ?>

 </div><!-- END #widget_area_inner -->
 <?php if($use_overlay) { ?><div id="widget_area_overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></div><?php }; ?>
 <?php if($options['blog_widget_bg_image'] || $options['blog_widget_bg_image_mobile']){ ?>
 <div id="widget_area_image" class="bg_image" data-parallax-image="<?php echo esc_attr(wp_get_attachment_url($options['blog_widget_bg_image'])); ?>" data-parallax-mobile-image="<?php echo esc_attr(wp_get_attachment_url($options['blog_widget_bg_image_mobile'])); ?>"<?php if ($options['blog_widget_use_para'] != 'type1') echo ' data-parallax-speed="0"'; ?>></div>
 <?php }; ?>
</div><!-- END #widget_area -->
<?php }; ?>