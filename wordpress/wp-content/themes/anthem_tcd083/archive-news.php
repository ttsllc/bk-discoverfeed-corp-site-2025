<?php
     get_header();
     $options = get_design_plus_option();
     $title = $options['news_title'];
     $title_font_type = $options['news_title_font_type'];
     $desc = $options['news_desc'];
     $desc_mobile = $options['news_desc_mobile'];
     $desc_font_type = $options['news_desc_font_type'];
     $bg_image = $options['news_bg_image'] ? wp_get_attachment_image_src( $options['news_bg_image'], 'full' ) : '';
     $bg_image_mobile = $options['news_bg_image_mobile'] ? wp_get_attachment_image_src( $options['news_bg_image_mobile'], 'full' ) : '';
     $use_overlay = $options['news_use_overlay'];
     if($use_overlay) {
       $overlay_color = $options['news_overlay_color'];
       $overlay_color = hex2rgb($overlay_color);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['news_overlay_opacity'];
     }
?>
<div id="page_header_wrap">
 <?php if($options['news_show_header']){ ?>
 <div id="page_header" class="text_layout_type2 no_layer_image">
  <div id="page_header_inner">
   <div class="caption">
    <?php if($title){ ?>
    <h2 class="catch animate_item rich_font_<?php echo esc_attr($title_font_type); ?>"><?php echo wp_kses_post(nl2br($title)); ?></h2>
    <?php }; ?>
    <?php if($desc){ ?>
    <p class="desc animate_item rich_font_<?php echo esc_attr($desc_font_type); ?>"><span<?php if($desc_mobile){ echo ' class="pc"'; }; ?>><?php echo wp_kses_post(nl2br($desc)); ?></span><?php if($desc_mobile){ ?><span class="mobile"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></span><?php }; ?></p>
    <?php }; ?>
   </div>
  </div>
  <?php if($use_overlay) { ?>
  <div class="overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></div>
  <?php }; ?>
  <?php if($bg_image) { ?><div class="bg_image<?php if($bg_image_mobile) { echo ' pc'; }; ?>" style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center top; background-size:cover;"></div><?php }; ?>
  <?php if($bg_image_mobile) { ?><div class="bg_image mobile" style="background:url(<?php echo esc_attr($bg_image_mobile[0]); ?>) no-repeat center top; background-size:cover;"></div><?php }; ?>
 </div>
 <?php }; ?>
</div><!-- END #header_category_button_wrap -->

<div id="news_archive" style="background:<?php echo esc_attr($options['archive_news_bg_color']); ?>;">

<?php get_template_part('template-parts/breadcrumb'); ?>

<div id="main_contents" class="clearfix">

 <div id="main_col">

  <?php if(!empty($options['archive_news_headline'])) { ?>
  <h2 class="headline rich_font_<?php echo esc_attr($options['archive_news_headline_font_type']); ?>"><?php echo esc_html($options['archive_news_headline']); ?></h2>
  <?php }; ?>

  <?php if ( have_posts() ) : ?>

  <div id="news_list" class="clearfix">
   <?php
        while ( have_posts() ) : the_post();
          if(has_post_thumbnail()) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
          } elseif($options['no_image1']) {
            $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
          } else {
            $image = array();
            $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
          }
   ?>
   <article class="item clearfix">
    <a class="link animate_background" href="<?php the_permalink(); ?>">
     <div class="image_wrap">
      <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
     </div>
     <div class="title_area">
      <div class="title_area_inner">
       <h3 class="title rich_font_<?php echo esc_attr($options['archive_news_title_font_type']); ?>"><span><?php the_title(); ?></span></h3>
       <?php if ( $options['archive_news_show_date'] ){ ?>
       <p class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></p>
       <?php }; ?>
      </div>
     </div>
    </a>
   </article>
  <?php endwhile; ?>
  </div><!-- END #news_list -->

  <?php get_template_part('template-parts/navigation'); ?>

  <?php else: ?>

  <p id="no_post"><?php _e('There is no registered post.', 'tcd-w');  ?></p>

  <?php endif; ?>

 </div><!-- END #main_col -->

  <?php if($options['archive_news_layout'] != 'type3') { get_sidebar(); }; ?>

</div><!-- END #main_contents -->

</div><!-- END #news_archive -->

<?php get_footer(); ?>