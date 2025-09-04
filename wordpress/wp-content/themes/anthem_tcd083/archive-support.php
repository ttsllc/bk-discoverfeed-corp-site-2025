<?php
     get_header();
     $options = get_design_plus_option();
     $title = $options['support_title'];
     $title_font_type = $options['support_title_font_type'];
     $desc = $options['support_desc'];
     $desc_mobile = $options['support_desc_mobile'];
     $desc_font_type = $options['support_desc_font_type'];
     $bg_image = $options['support_bg_image'] ? wp_get_attachment_image_src( $options['support_bg_image'], 'full' ) : '';
     $bg_image_mobile = $options['support_bg_image_mobile'] ? wp_get_attachment_image_src( $options['support_bg_image_mobile'], 'full' ) : '';
     $use_overlay = $options['support_use_overlay'];
     if($use_overlay) {
       $overlay_color = $options['support_overlay_color'];
       $overlay_color = hex2rgb($overlay_color);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['support_overlay_opacity'];
     }
?>
<div id="page_header_wrap">
 <?php if($options['support_show_header']){ ?>
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
 <?php
      $category = get_terms( 'support_category', array( 'orderby' => 'order' ) );
      if ( $category && ! is_wp_error( $category ) ) :
        $total = count($category);
 ?>
 <div id="header_category_button_wrap" class="animate_item" data-width="1200">
  <div id="header_category_button"<?php if($total < 5) { echo ' class="type2"'; }; ?>>
   <ol>
    <?php
         $i = 1;
         foreach ( $category as $cat ):
           $cat_id = $cat->term_id;
           $cat_name = $cat->name;
    ?>
    <li<?php if($i == 1){ echo ' class="active"'; }; ?> data-cat_id="support_cat<?php echo esc_attr($cat_id); ?>"><a href="#"><?php echo esc_html($cat_name); ?></a></li>
    <?php $i++; endforeach; ?>
   </ol>
   <div class="slide_item"></div>
  </div>
 </div>
 <?php endif; ?>
</div><!-- END #header_category_button_wrap -->

<div id="support_archive">

  <?php
       if ( $category && ! is_wp_error( $category ) ) {
         $i = 1;
         foreach ( $category as $cat ):
           $cat_id = $cat->term_id;
           $args = array( 'post_type' => 'support', 'posts_per_page' => -1, 'tax_query' => array( array( 'taxonomy' => 'support_category', 'field' => 'term_id', 'terms' => $cat_id ) ) );
           $support_list = new wp_query($args);
           if($support_list->have_posts()):
             $cat_data = get_term($cat_id);
             $desc = $cat_data->description;
  ?>
  <div class="support_list clearfix <?php if($i == 1) { echo 'active'; }; ?>" id="support_cat<?php echo esc_attr($cat_id); ?>">
   <div class="list_header">
    <h3 class="catch rich_font_<?php echo esc_attr($options['archive_support_catch_font_type']); ?>"><?php echo esc_html($cat->name); ?></h3>
    <?php if($desc) { ?><p class="desc"><?php echo wp_kses_post(nl2br($desc)); ?></p><?php }; ?>
   </div>
   <?php
        while( $support_list->have_posts() ) : $support_list->the_post();
          $show_date = get_post_meta($post->ID, 'show_date', true);
   ?>
   <article class="item clearfix">
    <h4 class="question"><?php if($show_date){ ?><span class="date"><?php the_time('Y.m.d'); ?></span><?php }; ?><?php the_title(); ?></h4>
    <div class="answer post_content clearfix" style="display:none;">
     <?php the_content(); ?>
    </div>
   </article>
   <?php $i++; endwhile; wp_reset_query(); ?>
  </div><!-- END .support_list -->
  <?php
           endif;
         endforeach;
       } else {
         $args = array( 'post_type' => 'support', 'posts_per_page' => -1);
         $support_list = new wp_query($args);
         if($support_list->have_posts()):
  ?>
  <div class="support_list clearfix">
   <?php while( $support_list->have_posts() ) : $support_list->the_post(); ?>
   <article class="item clearfix">
    <h4 class="question"><?php the_title(); ?></h4>
    <div class="answer post_content clearfix" style="display:none;">
     <?php the_content(); ?>
    </div>
   </article>
   <?php endwhile; wp_reset_query(); ?>
  </div><!-- END .support_list -->
  <?php
         endif;
       };
  ?>

</div><!-- END #support_archive -->

<?php get_footer(); ?>