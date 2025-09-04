<?php

//ヘッダーロゴ　---------------------------------------------------------------------------------------------
function header_logo(){

  $options = get_design_plus_option();

  $pc_image_width = '';
  $pc_image_height = '';

  $logo_image = wp_get_attachment_image_src( $options['header_logo_image'], 'full' );
  if($logo_image) {
    $pc_image_width = $logo_image[1];
    $pc_image_height = $logo_image[2];
    if($options['header_logo_retina'] == 1) {
      $pc_image_width = round($pc_image_width / 2);
      $pc_image_height = round($pc_image_height / 2);
    };
  };

  $logo_image_mobile = wp_get_attachment_image_src( $options['header_logo_image_mobile'], 'full' );
  if($logo_image_mobile) {
    $mobile_image_width = $logo_image_mobile[1];
    $mobile_image_height = $logo_image_mobile[2];
    if($options['header_logo_retina_mobile'] == 1) {
      $mobile_image_width = round($mobile_image_width / 2);
      $mobile_image_height = round($mobile_image_height / 2);
    };
  };

  $title = get_bloginfo('name');
  $url = home_url();

?>
<?php
 if( is_front_page() || is_home() || is_archive() ){ $thisTag = 'h1'; }else{ $thisTag = 'h2'; }
 ?>
<<?php echo $thisTag; ?> class="logo">
 <a href="<?php echo esc_url($url); ?>/" title="<?php echo esc_attr($title); ?>">
  <?php if( ($options['use_logo_image'] == 'yes') && $logo_image ){ ?>
  <img class="pc_logo_image" src="<?php echo esc_attr($logo_image[0]); ?>?<?php echo esc_attr(time()); ?>" alt="<?php echo esc_attr($title); ?>" title="<?php echo esc_attr($title); ?>" width="<?php echo esc_attr($pc_image_width); ?>" height="<?php echo esc_attr($pc_image_height); ?>" />
  <?php } else { ?>
  <span class="pc_logo_text" style="font-size:<?php echo esc_html($options['logo_font_size']); ?>px;"><?php echo esc_html($title); ?></span>
  <?php }; ?>
  <?php if( ($options['use_logo_image_mobile'] == 'yes') && $logo_image_mobile ){ ?>
  <img class="mobile_logo_image" src="<?php echo esc_attr($logo_image_mobile[0]); ?>?<?php echo esc_attr(time()); ?>" alt="<?php echo esc_attr($title); ?>" title="<?php echo esc_attr($title); ?>" width="<?php echo esc_attr($mobile_image_width); ?>" height="<?php echo esc_attr($mobile_image_height); ?>" />
  <?php } else { ?>
  <span class="mobile_logo_text" style="font-size:<?php echo esc_html($options['logo_font_size_mobile']); ?>px;"><?php echo esc_html($title); ?></span>
  <?php }; ?>
 </a>
</<?php echo $thisTag; ?>>

<?php
}

?>