<?php
     get_header();
     $options = get_design_plus_option();
     if ( !empty( get_search_query() ) ) {
       $title = sprintf( __( 'Search result for %s', 'tcd-w' ), get_search_query() );
     } else {
       $title = __( 'Search result', 'tcd-w' );
     }
     $title_font_type = $options['blog_title_font_type'];
     $desc = '';
     $desc_font_type = $options['blog_desc_font_type'];
     $bg_image = $options['blog_bg_image'] ? wp_get_attachment_image_src( $options['blog_bg_image'], 'full' ) : '';
     $bg_image_mobile = $options['blog_bg_image_mobile'] ? wp_get_attachment_image_src( $options['blog_bg_image_mobile'], 'full' ) : '';
     $use_overlay = $options['blog_use_overlay'];
     if($use_overlay) {
       $overlay_color = $options['blog_overlay_color'];
       $overlay_color = hex2rgb($overlay_color);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['blog_overlay_opacity'];
     }
?>
<div id="page_header_wrap">
 <div id="page_header" class="text_layout_type2 no_layer_image">
  <div id="page_header_inner">
   <div class="caption">
    <?php if($title){ ?>
    <h2 class="catch rich_font_<?php echo esc_attr($title_font_type); ?> animate_item"><?php echo wp_kses_post(nl2br($title)); ?></h2>
    <?php }; ?>
    <?php if($desc){ ?>
    <h3 class="desc rich_font_<?php echo esc_attr($desc_font_type); ?>"><span><?php echo wp_kses_post(nl2br($desc)); ?></span></h3>
    <?php }; ?>
   </div>
  </div>
  <?php if($use_overlay) { ?>
  <div class="overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></div>
  <?php }; ?>
  <?php if($bg_image) { ?><div class="bg_image<?php if($bg_image_mobile) { echo ' pc'; }; ?>" style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center top; background-size:cover;"></div><?php }; ?>
  <?php if($bg_image_mobile) { ?><div class="bg_image mobile" style="background:url(<?php echo esc_attr($bg_image_mobile[0]); ?>) no-repeat center top; background-size:cover;"></div><?php }; ?>
 </div>
</div>

<div id="blog_archive" style="background:<?php echo esc_attr($options['archive_blog_bg_color']); ?>;">

  <?php if ( empty( get_search_query() ) ) { ?>

  <p id="no_post"><?php _e('Please enter search keyword.', 'tcd-w');  ?></p>

  <?php } else { ?>

  <?php if ( have_posts() ) : ?>

  <div id="blog_list" class="clearfix">
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
          $post_type = $post->post_type;
          if($post_type == 'product'){
            $short_desc = get_post_meta($post->ID, 'short_desc', true);
          }
   ?>
    <article class="item">
     <a class="image_link animate_background clearfix" href="<?php the_permalink(); ?>">
      <div class="image_wrap">
       <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
      </div>
     </a>
     <div class="title_area">
      <h3 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h3>
      <?php if($post_type == 'product' && $short_desc){ ?>
      <p class="desc"><span><?php echo esc_html($short_desc); ?></span></p>
      <?php } else { ?>
      <p class="desc"><span><?php echo trim_excerpt(60); ?></span></p>
      <?php }; ?>
      <?php if($post_type == 'post'){ ?>
      <?php if ( $options['show_archive_blog_date'] || $options['show_archive_blog_category']){ ?>
      <ul class="meta clearfix">
       <?php if ( $options['show_archive_blog_date']){ ?>
       <li class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></li>
       <?php }; ?>
       <?php
            if ($options['show_archive_blog_category'] ) {
              if(is_category()) {
       ?>
       <li class="category"><a href="<?php echo esc_url(get_term_link($query_obj->term_id,'category')); ?>"><?php echo esc_html($query_obj->name); ?></a></li>
       <?php } else { ?>
       <li class="category"><?php the_category(' '); ?></li>
       <?php }; }; ?>
      </ul>
      <?php }; ?>
      <?php }; ?>
     </div>
    </article>
   <?php endwhile; ?>
  </div><!-- END #blog_list -->

  <?php get_template_part('template-parts/navigation'); ?>

  <?php else: ?>

  <p id="no_post"><?php _e('No post were found.', 'tcd-w');  ?></p>

  <?php endif; ?>

  <?php }; ?>

</div><!-- END #blog_archive -->

<?php get_footer(); ?>