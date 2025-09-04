<?php

class product_ranking_widget extends WP_Widget {

  function __construct() {
    $options = get_design_plus_option();
    $product_label = $options['product_label'] ? esc_html( $options['product_label'] ) : __( 'Product', 'tcd-w' );
    parent::__construct(
      'product_ranking_widget',// ID
      sprintf(__('%s ranking list (tcd ver)', 'tcd-w'), $product_label),
      array(
        'classname' => 'product_ranking_widget',
        'description' => sprintf(__('Display %s ranking list.', 'tcd-w'), $product_label),
      )
    );
  }

  // Extract Args //
  function widget($args, $instance) {

    global $post;

    extract( $args );
    $title = apply_filters('widget_title', $instance['title']);
    $post_ids = $instance['post_ids'];
    if(!empty($post_ids)){
      $post_ids = str_replace(array("\r\n", "\r", "\n"), "\n", $post_ids);
      $post_ids = explode("\n", $post_ids);
    }
    $list_type = isset($instance['list_type']) ?  $instance['list_type'] : 'type2';

    // Before widget //
    echo $before_widget;

    // Title of widget //
    if ( $title ) { echo $before_title . $title . $after_title; }

    // Widget output //
    $args = array( 'post_type' => 'product', 'post__in' => $post_ids, 'orderby' => 'post__in');
    $post_list_query = new wp_query($args);
    $options = get_design_plus_option();
    $post_list_query = new WP_Query($args);
?>
<div class="side_product_ranking clearfix <?php echo esc_attr($list_type); ?>">
 <?php
      $i = 1;
      if ($post_list_query->have_posts()) {
        while ($post_list_query->have_posts()) : $post_list_query->the_post();
          $main_color = get_post_meta($post->ID, 'main_color', true) ?  get_post_meta($post->ID, 'main_color', true) : '#008a98';
 ?>
 <article class="item clearfix">
  <a class="clearfix" href="<?php the_permalink(); ?>">
   <div class="num"<?php if($i < 4){ echo 'style="background:' . $main_color . ';"'; }; ?>><?php echo $i; ?></div>
   <p class="title"><?php the_title(); ?></p>
  </a>
 </article>
 <?php $i++; endwhile; wp_reset_query(); }; ?>
</div>
<?php

    // After widget //
    echo $after_widget;

  } // end function widget


  // Update Settings //
  function update($new_instance, $old_instance) {
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['post_ids'] = $new_instance['post_ids'];
    $instance['list_type'] = $new_instance['list_type'];
    return $instance;
  }

  // Widget Control Panel //
  function form($instance) {
    $defaults = array( 'title' => __('Ranking', 'tcd-w'), 'post_ids' => '', 'list_type' => 'type2');
    $instance = wp_parse_args( (array) $instance, $defaults );

    $options = get_design_plus_option();
    $product_label = $options['product_label'] ? esc_html( $options['product_label'] ) : __( 'Product', 'tcd-w' );
?>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Title', 'tcd-w'); ?></h3>
 <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>'" type="text" value="<?php echo $instance['title']; ?>" />
</div>
<div class="tcd_widget_content">
 <h4 class="tcd_widget_headline"><?php printf(__('%s to display in ranking list', 'tcd-w'), $product_label); ?></h4>
 <div class="theme_option_message2">
  <p><?php _e('Please enter a post ID numbers in each row.', 'tcd-w'); ?></p>
 </div>
 <textarea class="full_width" cols="50" rows="10" name="<?php echo $this->get_field_name('post_ids'); ?>"><?php echo $instance['post_ids']; ?></textarea>
</div>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Layout', 'tcd-w'); ?></h3>
 <ul>
  <li><label><input type="radio" name="<?php echo $this->get_field_name('list_type'); ?>" value="type1" <?php checked( $instance['list_type'], 'type1' ); ?> /><?php _e('Display in one column', 'tcd-w'); ?></label></li>
  <li><label><input type="radio" name="<?php echo $this->get_field_name('list_type'); ?>" value="type2" <?php checked( $instance['list_type'], 'type2' ); ?> /><?php _e('Display in two column', 'tcd-w'); ?></label></li>
 </ul>
</div>
<?php

  } // end function form

} // end class


function register_product_ranking_widget() {
	register_widget( 'product_ranking_widget' );
}
add_action( 'widgets_init', 'register_product_ranking_widget' );


?>
