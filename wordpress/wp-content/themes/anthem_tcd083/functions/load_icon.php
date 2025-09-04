<?php

function load_icon(){
  $options = get_design_plus_option();
  if ($options['load_icon'] == 'type4') {
    $logo_image = wp_get_attachment_image_src( $options['load_type4_image'], 'full' );
    if($logo_image) {
      $image_width = $logo_image[1];
      $image_height = $logo_image[2];
      if($options['load_type4_image_retina']) {
        $image_width = round($image_width / 2);
        $image_height = round($image_height / 2);
      };
    };
    $logo_image_mobile = wp_get_attachment_image_src( $options['load_type4_image_mobile'], 'full' );
    if($logo_image_mobile) {
      $image_width_mobile = $logo_image_mobile[1];
      $image_height_mobile = $logo_image_mobile[2];
      if($options['load_type4_image_retina_mobile']) {
        $image_width_mobile = round($image_width_mobile / 2);
        $image_height_mobile = round($image_height_mobile / 2);
      };
    };
  };

?>
<?php if ($options['load_icon'] == 'type3') { ?>
<div id="site_loader_overlay">
 <div id="site_loader_animation">
  <i></i><i></i><i></i><i></i>
 </div>
</div>
<?php } elseif( ($options['load_icon'] == 'type4') && $logo_image) { ?>
<div id="site_loader_overlay">
 <div id="site_loader_logo"<?php if($logo_image_mobile) { echo ' class="has_mobile_logo"'; }; ?>>
  <div id="site_loader_logo_inner">
   <img class="logo_image pc" src="<?php echo esc_attr($logo_image[0]); ?>?<?php echo esc_attr(time()); ?>" alt="" title="" width="<?php echo esc_attr($image_width); ?>" height="<?php echo esc_attr($image_height); ?>" />
   <?php if($logo_image_mobile) { ?><img class="logo_image mobile" src="<?php echo esc_attr($logo_image_mobile[0]); ?>?<?php echo esc_attr(time()); ?>" alt="" title="" width="<?php echo esc_attr($image_width_mobile); ?>" height="<?php echo esc_attr($image_height_mobile); ?>" /><?php }; ?>
   <?php if($options['load_type4_catch']){ ?>
   <div class="message type2">
    <div class="message_inner clearfix">
     <div class="text rich_font_<?php echo esc_attr($options['load_type4_catch_font_type']); ?>"><?php echo wp_kses_post(nl2br($options['load_type4_catch'])); ?></div>
     <?php if(!$options['load_type4_no_dot']) { ?>
     <div class="dot_animation_wrap">
      <div class="dot_animation">
       <i></i><i></i><i></i>
      </div>
     </div>
     <?php }; ?>
    </div>
   </div>
   <?php }; ?>
  </div>
 </div>
</div>
<?php } else { ?>
<div id="site_loader_overlay">
 <div id="site_loader_animation">
 </div>
</div>
<?php }; ?>
<?php
}


?>