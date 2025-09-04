<?php
/**
 * Add data-megamenu attributes to the global navigation
 */
function nano_walker_nav_menu_start_el( $item_output, $item, $depth, $args ) {

  $options = get_design_plus_option();

  if ( 'global-menu' !== $args->theme_location ) return $item_output;

  if ( ! isset( $options['megamenu'][$item->ID] ) ) return $item_output;

  if ( 'type1' === $options['megamenu'][$item->ID] ) return $item_output;

  return sprintf( '<a href="%s" class="megamenu_button" data-megamenu="js-megamenu%d">%s</a>', $item->url, $item->ID, $item->title );
}

add_filter( 'walker_nav_menu_start_el', 'nano_walker_nav_menu_start_el', 10, 4 );


// Mega menu A - Product category list ---------------------------------------------------------------
function render_megamenu_a( $id, $megamenus ) {
  global $post;
?>
<div class="megamenu_product_category_list" id="js-megamenu<?php echo esc_attr( $id ); ?>">
 <div class="megamenu_product_category_list_inner clearfix">

  <div class="category_list clearfix">
   <?php
        foreach ( $megamenus[$id] as $menu ) :
          if ( 'product_category' !== $menu->object ) continue;
          $cat_id = $menu->object_id;
          $cat_name = $menu->title;
          $url = $menu->url;
          $custom_fields = get_option( 'taxonomy_' . $cat_id, array() );
          if (!empty($custom_fields['image'])){
            $image = wp_get_attachment_image_src( $custom_fields['image'], 'full' );
          } elseif($options['no_image1']) {
            $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
          } else {
            $image = array();
            $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image1.gif";
          }
   ?>
   <article class="item">
    <a data-anchor="#product_cat_<?php echo esc_attr($cat_id); ?>" class="clearfix animate_background" href="<?php echo esc_url(get_post_type_archive_link('product')); ?>#product_cat_<?php echo esc_attr($cat_id); ?>">
     <div class="image_wrap">
      <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
     </div>
     <div class="title_area">
      <h4 class="title"><?php echo esc_html($cat_name); ?><?php if (!empty($custom_fields['sub_title'])){ ?><span class="sub_title"><?php echo esc_html($custom_fields['sub_title']); ?></span><?php }; ?></h4>
     </div>
    </a>
   </article>
   <?php endforeach; ?>
  </div>

 </div>
</div>
<?php
}

// Mega menu B - Blog list ---------------------------------------------------------------
function render_megamenu_b( $id, $megamenus ) {
  global $post;
  $options = get_design_plus_option();
?>
<div class="megamenu_blog_list" id="js-megamenu<?php echo esc_attr( $id ); ?>">
 <div class="megamenu_blog_list_inner clearfix">
  <ul class="menu_area">
   <?php
        $i = 1;
        foreach ( $megamenus[$id] as $menu ) :
          if ( 'category' !== $menu->object ) continue;
          $cat_id = $menu->object_id;
          $cat_name = $menu->title;
          $url = $menu->url;
   ?>
   <li<?php if($i == 1) { echo ' class="active"'; }; ?>><a class="cat_id<?php echo esc_attr($cat_id); ?>" href="<?php echo esc_url($url); ?>"><?php echo esc_html($cat_name); ?></a></li>
   <?php $i++; endforeach; ?>
  </ul>
  <div class="post_list_area">
   <?php
       foreach ( $megamenus[$id] as $menu ) :
         if ( 'category' !== $menu->object ) continue;
         $cat_id = $menu->object_id;
           $args = array( 'post_type' => 'post', 'posts_per_page' => 4, 'tax_query' => array( array( 'taxonomy' => 'category', 'field' => 'term_id', 'terms' => $cat_id ) ) );
           $post_list = new wp_query($args);
           if($post_list->have_posts()):
   ?>
   <div class="post_list clearfix cat_id<?php echo esc_attr($cat_id); ?>">
    <?php
         while( $post_list->have_posts() ) : $post_list->the_post();
           if(has_post_thumbnail()) {
             $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
           } elseif($options['no_image1']) {
             $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
           } else {
             $image = array();
             $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image1.gif";
           }
    ?>
    <div class="item">
     <a class="clearfix animate_background" href="<?php the_permalink(); ?>">
      <div class="image_wrap">
       <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
      </div>
      <div class="title_area">
       <h4 class="title"><span><?php the_title_attribute(); ?></span></h4>
       <p class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></p>
      </div>
     </a>
    </div>
    <?php endwhile; wp_reset_query(); ?>
   </div>
   <?php endif; // END end post list ?>
   <?php endforeach; ?>
  </div><!-- END post_list_area -->
 </div>
</div>
<?php
}
?>