<?php
     get_header();
     $options = get_design_plus_option();
     $title = $options['blog_title'];
     $title_font_type = $options['blog_title_font_type'];
     $desc = $options['blog_desc'];
     $desc_mobile = $options['blog_desc_mobile'];
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
     // overwrite the data if category data exist
     $current_cat_id = '';
     if (is_category()) {
       $query_obj = get_queried_object();
       $current_cat_id = $query_obj->term_id;
       $title = $query_obj->name;
       if (!empty($query_obj->description)){
         $desc = $query_obj->description;
       }
       $term_meta = get_option( 'taxonomy_' . $current_cat_id, array() );
       if (!empty($term_meta['image'])){
         $bg_image = $term_meta['image'];
         $bg_image = wp_get_attachment_image_src( $bg_image, 'full' );
       }
       if (!empty($term_meta['use_overlay'])){
         if (!empty($term_meta['overlay_color'])){
           $overlay_color = hex2rgb($term_meta['overlay_color']);
           $overlay_color = implode(",",$overlay_color);
           if (!empty($term_meta['overlay_opacity'])){
             $overlay_opacity = $term_meta['overlay_opacity'];
           } else {
             $overlay_opacity = '0.3';
           }
         }
       }
     } elseif(is_tag()) {
       $query_obj = get_queried_object();
       $title = $query_obj->name;
       if (!empty($query_obj->description)){
         $desc = $query_obj->description;
       }
     }
     if (!is_author()) {
?>
<div id="page_header_wrap">
 <?php if($options['blog_show_header']){ ?>
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
</div><!-- END #page_header_wrap -->
<?php }; ?>

<div id="blog_archive" style="background:<?php echo esc_attr($options['archive_blog_bg_color']); ?>;">

  <?php
       // Author profile ------------------------------------------------------------------------------------------------------------------------------
       if (is_author()) {
         $author_info = $wp_query->get_queried_object();
         $author_id = $author_info->ID;
         $user_data = get_userdata($author_id);
         if(!empty($user_data->show_author)) {
            $desc = $user_data->description;
            $catch = $user_data->user_catch;
            $facebook = $user_data->facebook_url;
            $twitter = $user_data->twitter_url;
            $insta = $user_data->instagram_url;
            $pinterest = $user_data->pinterest_url;
            $youtube = $user_data->youtube_url;
            $contact = $user_data->contact_url;
            $author_url = get_author_posts_url($author_id);
  ?>
  <div class="author_profile clearfix">
   <a class="avatar animate_image square" href="<?php echo esc_url($author_url); ?>"><?php echo wp_kses_post(get_avatar($author_id, 300)); ?></a>
   <div class="info clearfix">
    <h4 class="name rich_font"><a href="<?php echo esc_url($author_url); ?>"><?php echo esc_html($user_data->display_name); ?></a></h4>
    <?php if($desc || $catch) { ?>
    <p class="desc"><span><?php if($catch){ echo esc_html($catch); } elseif($desc) { echo esc_html($desc); }; ?></span></p>
    <?php }; ?>
    <?php if($facebook || $twitter || $insta || $pinterest || $youtube || $contact ) { ?>
    <ul class="author_link clearfix">
     <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
     <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow" target="_blank" title="Twitter"><span>Twitter</span></a></li><?php }; ?>
     <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
     <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
     <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
     <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
    </ul>
    <?php }; ?>
   </div>
  </div><!-- END .author_profile -->
  <?php }; }; ?>

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
   ?>
    <article class="item">
     <a class="image_link animate_background clearfix" href="<?php the_permalink(); ?>">
      <div class="image_wrap">
       <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
      </div>
     </a>
     <div class="title_area">
      <h3 class="title rich_font_<?php echo esc_attr($options['archive_blog_title_font_type']); ?>"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h3>
      <?php if ( $options['show_archive_blog_desc']){ ?><p class="desc"><span><?php echo trim_excerpt(70); ?></span></p><?php }; ?>
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
     </div>
    </article>
   <?php endwhile; ?>
  </div><!-- END #blog_list -->

  <?php get_template_part('template-parts/navigation'); ?>

  <?php else: ?>

  <p id="no_post"><?php _e('There is no registered post.', 'tcd-w');  ?></p>

  <?php endif; ?>

</div><!-- END #blog_archive -->

<?php get_footer(); ?>