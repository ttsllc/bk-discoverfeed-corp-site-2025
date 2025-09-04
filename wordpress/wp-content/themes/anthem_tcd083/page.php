<?php
     get_header();
     $options = get_design_plus_option();
     $hide_header = get_post_meta($post->ID, 'page_hide_header_image', true);
     $change_content_width = get_post_meta($post->ID, 'change_content_width', true);
     $page_content_width = get_post_meta($post->ID, 'page_content_width', true) ?  get_post_meta($post->ID, 'page_content_width', true) : '1200';
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
<div id="page_header_wrap">
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
      // ƒRƒ“ƒeƒ“ƒcƒŠƒ“ƒN
      $page_hide_content_link = get_post_meta($post->ID, 'page_hide_content_link', true);
      $contents_link_button = get_post_meta($post->ID, 'contents_link_button', true);
      if ( !$page_hide_content_link && $contents_link_button ) :
 ?>
 <div id="header_category_button_wrap" class="animate_item" <?php if($change_content_width) { ?>data-width="<?php echo esc_attr($page_content_width); ?>"<?php }; ?>>
  <div id="header_category_button" class="type2">
   <ol>
    <?php
         $i = 1;
         foreach ( $contents_link_button as $key => $value ) :
           $name = $value['name'];
           $url = $value['url'];
    ?>
    <li<?php if($i == 1){ echo ' class="active"'; }; ?>><a href="<?php echo esc_url($url); ?>"><?php echo esc_html($name); ?></a></li>
    <?php $i++; endforeach; ?>
   </ol>
   <div class="slide_item"></div>
  </div>
 </div>
 <?php endif; ?>
</div><!-- END #header_category_button_wrap -->

<div id="main_contents" class="content_link_target_top" <?php if($change_content_width) { ?>style="width:<?php echo esc_attr($page_content_width); ?>px;"<?php }; ?>>

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

 <article id="page_content">

  <?php // post content ------------------------------------------------------------------------------------------------------------------------ ?>
  <div class="post_content clearfix">

   <?php
        the_content();
        if ( ! post_password_required() ) {
          $pagenation_type = $options['pagenation_type'];
          if ( $pagenation_type == 'type2' ) {
            if ( $page < $numpages && preg_match( '/href="(.*?)"/', _wp_link_page( $page + 1 ), $matches ) ) :
   ?>
   <div id="p_readmore">
    <a class="button" href="<?php echo esc_url( $matches[1] ); ?>"><?php _e( 'Read more', 'tcd-w' ); ?></a>
    <p class="num"><?php echo $page . ' / ' . $numpages; ?></p>
   </div>
   <?php
            endif;
          } else {
            custom_wp_link_pages();
          }
        }
   ?>

  </div>

 </article><!-- END #page_content -->

 <?php endwhile; endif; ?>

</div><!-- END #design_page2 -->

<?php get_footer(); ?>