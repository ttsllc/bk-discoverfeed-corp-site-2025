<?php
     get_header();
     $options = get_design_plus_option();
     $title = $options['product_title'];
     $title_font_type = $options['product_title_font_type'];
     $desc = $options['product_desc'];
     $desc_mobile = $options['product_desc_mobile'];
     $desc_font_type = $options['product_desc_font_type'];
     $bg_image = $options['product_bg_image'];
     if(!empty($bg_image)) {
       $bg_image = wp_get_attachment_image_src($bg_image, 'full');
     }
     $use_overlay = $options['product_use_overlay'];
     if($use_overlay) {
       $overlay_color = $options['product_overlay_color'];
       $overlay_color = hex2rgb($overlay_color);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['product_overlay_opacity'];
     }
?>
<div id="page_header_wrap">
 <?php if($options['product_show_header']){ ?>
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
  <?php if($bg_image) { ?><div class="bg_image" style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center top; background-size:cover;"></div><?php }; ?>
 </div>
 <?php }; ?>
 <?php
      $query_obj = get_queried_object();
      $current_cat_id = $query_obj->term_id;
      $category = get_terms( 'product_category', array( 'orderby' => 'order' ) );
      if ( $category && ! is_wp_error( $category ) ) :
        $total = count($category);
 ?>
 <div id="header_category_button_wrap" class="animate_item" data-width="1200">
  <div id="header_category_button"<?php if($total < 5) { echo ' class="type2"'; }; ?>>
   <ol>
    <li><a data-filter="all" href="#">ALL</a></li>
    <?php
         foreach ( $category as $cat ):
           $cat_id = $cat->term_id;
           $cat_name = $cat->name;
    ?>
    <li <?php if($cat_id == $current_cat_id) { echo 'class="active"'; }; ?>><a id="product_cat_<?php echo esc_attr($cat_id); ?>" data-filter="product_cat_<?php echo esc_attr($cat_id); ?>" href="#"><?php echo esc_html($cat_name); ?></a></li>
    <?php endforeach; ?>
   </ol>
   <div class="slide_item"></div>
  </div>
 </div>
 <?php endif; ?>
</div><!-- END #header_category_button_wrap -->

<div id="product_archive">

  <?php if($options['archive_product_catch'] || $options['archive_product_desc']) { ?>
  <div class="content_header">
   <?php if(!empty($options['archive_product_catch'])) { ?>
   <h3 class="catch rich_font_<?php echo esc_attr($options['archive_product_catch_font_type']); ?>"><?php echo esc_html($options['archive_product_catch']); ?></h3>
   <?php }; ?>
   <?php if(!empty($options['archive_product_desc'])) { ?>
   <p class="desc"><?php echo wp_kses_post(nl2br($options['archive_product_desc'])); ?></p>
   <?php }; ?>
  </div>
  <?php }; ?>

  <?php
       $args = array( 'post_type' => 'product', 'posts_per_page' => -1, 'orderby' => array( 'menu_order' => 'ASC', 'date' => 'DESC' ) );
       $post_list_query = new wp_query($args);
       if($post_list_query->have_posts()):
  ?>

  <div class="product_list clearfix animation_<?php echo esc_attr($options['archive_product_list_animation_type']); ?>" id="archive_product_list">
   <?php
        while($post_list_query->have_posts()): $post_list_query->the_post();
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
         } elseif($options['no_image1']) {
           $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
         } else {
           $image = array();
           $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
         }
         $main_color = get_post_meta($post->ID, 'main_color', true) ?  get_post_meta($post->ID, 'main_color', true) : '#008a98';
         $short_desc = get_post_meta($post->ID, 'short_desc', true);
         $product_category = get_the_terms( $post->ID, 'product_category' );
         $category_ids = array();
         if ( $product_category && ! is_wp_error($product_category) ) {
           foreach ( $product_category as $cat ) :
             $cat_id = $cat->term_id;
             $category_ids[] = 'product_cat_' . $cat_id;
           endforeach;
           $category_ids = implode(" ", $category_ids);
         }
   ?>
   <article class="item" data-category="<?php if($category_ids){ echo $category_ids; }; ?>">
    <a class="animate_background" href="<?php the_permalink(); ?>">
     <?php if($image) { ?>
     <div class="image_wrap">
      <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
     </div>
     <?php }; ?>
     <h3 class="title rich_font_<?php echo esc_attr($options['archive_product_title_font_type']); ?>" style="background:<?php echo esc_attr($main_color); ?>;"><span><?php the_title(); ?></span></h3>
     <div class="desc_area">
      <?php if($short_desc) { ?>
      <p class="desc"><span><?php echo esc_html($short_desc); ?></span></p>
      <?php }; ?>
     </div>
    </a>
   </article>
   <?php endwhile; ?>
  </div><!-- END .product_list -->

  <?php else: ?>

  <p id="no_post"><?php _e('There is no registered post.', 'tcd-w');  ?></p>

  <?php endif; ?>

</div><!-- END #product_archive -->

<?php get_footer(); ?>