<?php

class product_slider_widget extends WP_Widget {

  function __construct() {
    $options = get_design_plus_option();
    $product_label = $options['product_label'] ? esc_html( $options['product_label'] ) : __( 'Product', 'tcd-w' );
    parent::__construct(
      'product_slider_widget',// ID
      sprintf(__('%s slider (tcd ver)', 'tcd-w'), $product_label),
      array(
        'classname' => 'product_slider_widget',
        'description' => sprintf(__('Display %s slider.', 'tcd-w'), $product_label),
      )
    );
  }

  // Extract Args //
  function widget($args, $instance) {

    global $post;

    extract( $args );
    $title = apply_filters('widget_title', $instance['title']);
    $post_num = $instance['post_num'];
    $post_type = $instance['post_type'];
    $post_order = $instance['post_order'];

    // Before widget //
    echo $before_widget;

    // Title of widget //
    if ( $title ) { echo $before_title . $title . $after_title; }

    // Widget output //
    if($post_order == 'menu_order'){
      $post_order = array( 'menu_order' => 'ASC', 'date' => 'DESC' );
    }
    if($post_type != 'all_post') {
      $args = array( 'post_type' => 'product', 'orderby' => $post_order, 'posts_per_page' => $post_num, 'meta_key' => $post_type, 'meta_value' => '1' );
    } else {
      $args = array( 'post_type' => 'product', 'orderby' => $post_order, 'posts_per_page' => $post_num );
    };
    $options = get_design_plus_option();
    $post_slider_query = new WP_Query($args);
?>
<div class="post_slider clearfix">
 <?php
      if ($post_slider_query->have_posts()) {
        while ($post_slider_query->have_posts()) : $post_slider_query->the_post();
          if(has_post_thumbnail()) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
          } elseif($options['no_image1']) {
            $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
          } else {
            $image = array();
            $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
          }
          $short_desc = get_post_meta($post->ID, 'short_desc', true);
 ?>
 <article class="item clearfix">
  <a class="clearfix animate_background" href="<?php the_permalink(); ?>">
   <div class="image_wrap">
    <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
   </div>
   <?php if(!empty($short_desc)) { ?>
    <p class="desc"><span><?php echo wp_kses_post(nl2br($short_desc)); ?></span></p>
   <?php }; ?>
  </a>
 </article>
 <?php endwhile; wp_reset_query(); }; ?>
</div>
<?php

    // After widget //
    echo $after_widget;

  } // end function widget


  // Update Settings //
  function update($new_instance, $old_instance) {
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['post_num'] = $new_instance['post_num'];
    $instance['post_type'] = $new_instance['post_type'];
    $instance['post_order'] = $new_instance['post_order'];
    return $instance;
  }

  // Widget Control Panel //
  function form($instance) {
    $defaults = array( 'title' => __('Recommend post', 'tcd-w'), 'post_num' => 3, 'post_type' => 'all_post', 'post_order' => 'rand');
    $instance = wp_parse_args( (array) $instance, $defaults );

    $options = get_design_plus_option();
    $product_label = $options['product_label'] ? esc_html( $options['product_label'] ) : __( 'Product', 'tcd-w' );
?>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Title', 'tcd-w'); ?></h3>
 <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>'" type="text" value="<?php echo $instance['title']; ?>" />
</div>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php printf(__('%s type', 'tcd-w'), $product_label); ?></h3>
 <select name="<?php echo $this->get_field_name('post_type'); ?>" class="widefat" style="width:100%;">
  <option value="all_post" <?php selected('recent_post', $instance['post_type']); ?>><?php printf(__('All %s', 'tcd-w'), $product_label); ?></option>
  <option value="recommend_post" <?php selected('recommend_post', $instance['post_type']); ?>><?php printf(__('Recommend %s', 'tcd-w'), $product_label); ?></option>
  <option value="featured_post" <?php selected('featured_post', $instance['post_type']); ?>><?php printf(__('Featured %s', 'tcd-w'), $product_label); ?></option>
 </select>
</div>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php printf(__('Number of %s to display', 'tcd-w'), $product_label); ?></h3>
 <select name="<?php echo $this->get_field_name('post_num'); ?>" class="widefat" style="width:100%;">
  <option value="3" <?php selected('3', $instance['post_num']); ?>>3</option>
  <option value="4" <?php selected('4', $instance['post_num']); ?>>4</option>
  <option value="5" <?php selected('5', $instance['post_num']); ?>>5</option>
  <option value="6" <?php selected('6', $instance['post_num']); ?>>6</option>
  <option value="7" <?php selected('7', $instance['post_num']); ?>>7</option>
  <option value="8" <?php selected('8', $instance['post_num']); ?>>8</option>
  <option value="9" <?php selected('9', $instance['post_num']); ?>>9</option>
  <option value="10" <?php selected('10', $instance['post_num']); ?>>10</option>
 </select>
</div>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php printf(__('%s order', 'tcd-w'), $product_label);  ?></h3>
 <select name="<?php echo $this->get_field_name('post_order'); ?>" class="widefat" style="width:100%;">
  <option style="padding-right: 10px;" value="menu_order" <?php selected( $instance['post_order'], 'menu_order' ); ?>><?php _e('Admin order', 'tcd-w');  ?></option>
  <option style="padding-right: 10px;" value="rand" <?php selected( $instance['post_order'], 'rand' ); ?>><?php _e('Random', 'tcd-w');  ?></option>
 </select>
</div>

<?php

  } // end function form

} // end class


function register_product_slider_widget() {
	register_widget( 'product_slider_widget' );
}
add_action( 'widgets_init', 'register_product_slider_widget' );


?>
