<?php

class tab_post_list_widget extends WP_Widget {

  function __construct() {
    parent::__construct(
      'tab_post_list_widget',// ID
      __('Tab post list (tcd ver)', 'tcd-w'),
      array(
        'classname' => 'tab_post_list_widget',
        'description' => __('Display two type of post list by tab.', 'tcd-w')
      )
    );
  }

  // Extract Args //
  function widget($args, $instance) {

    global $post;

    $options = get_design_plus_option();

    extract( $args );
    $title1 = apply_filters('widget_title', $instance['title1']);
    $title2 = apply_filters('widget_title', $instance['title2']);
    $post_num1 = $instance['post_num1'];
    $post_num2 = $instance['post_num2'];
    $post_type1 = $instance['post_type1'];
    $post_type2 = $instance['post_type2'];
    $show_date1 = $instance['show_date1'];
    $show_date2 = $instance['show_date2'];

    $post_order1 = $instance['post_order1'];
    if($post_order1=='date2'){ $order1 = 'ASC'; } else { $order1 = 'DESC'; };
    if($post_order1=='date1'||$post_order1=='date2'){ $post_order1 = 'date'; };

    $post_order2 = $instance['post_order2'];
    if($post_order2=='date2'){ $order2 = 'ASC'; } else { $order2 = 'DESC'; };
    if($post_order2=='date1'||$post_order2=='date2'){ $post_order2 = 'date'; };

    // Before widget //
    echo $before_widget;

    // Title of widget //

    // Widget output //
    if($post_type1 == 'recent_post') {
      $args1 = array('post_type' => 'post', 'posts_per_page' => $post_num1, 'ignore_sticky_posts' => 1, 'orderby' => $post_order1, 'order' => $order1);
    } else {
      $args1 = array('post_type' => 'post', 'posts_per_page' => $post_num1, 'ignore_sticky_posts' => 1, 'orderby' => $post_order1, 'order' => $order1, 'meta_key' => $post_type1, 'meta_value' => 'on');
    };

    if($post_type2 == 'recent_post') {
      $args2 = array('post_type' => 'post', 'posts_per_page' => $post_num2, 'ignore_sticky_posts' => 1, 'orderby' => $post_order2, 'order' => $order2);
    } else {
      $args2 = array('post_type' => 'post', 'posts_per_page' => $post_num2, 'ignore_sticky_posts' => 1, 'orderby' => $post_order2, 'order' => $order2, 'meta_key' => $post_type2, 'meta_value' => 'on');
    };

    $post_list1 = new WP_Query($args1);
    $post_list2 = new WP_Query($args2);

?>

<div class="widget_tab_post_list_button clearfix">
 <a class="tab1 active" href="#"><?php echo esc_html($title1); ?></a>
 <a class="tab2" href="#"><?php echo esc_html($title2); ?></a>
</div>

<ol class="widget_tab_post_list widget_tab_post_list1 clearfix<?php if($show_date1) { echo ' has_date'; }; ?>">
<?php
   if ($post_list1->have_posts()) {
    while ($post_list1->have_posts()) : $post_list1->the_post();
     if(has_post_thumbnail()) {
       $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size1' );
     } elseif($options['no_image1']) {
       $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
     } else {
       $image = array();
       $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image1.gif";
     }
?>
 <li class="clearfix">
  <a class="clearfix animate_background" href="<?php the_permalink(); ?>">
   <div class="image_wrap">
    <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
   </div>
   <div class="title_area">
    <div class="title_area_inner">
     <h4 class="title"><span><?php the_title_attribute(); ?></span></h4>
     <?php if($show_date1) { ?><p class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></p><?php }; ?>
    </div>
   </div>
  </a>
 </li>
<?php endwhile; wp_reset_query(); } else { ?>
 <li class="no_post"><?php _e('There is no registered post.', 'tcd-w');  ?></li>
<?php }; ?>
</ol>

<ol class="widget_tab_post_list widget_tab_post_list2 clearfix<?php if($show_date2) { echo ' has_date'; }; ?>">
<?php
   if ($post_list2->have_posts()) {
    while ($post_list2->have_posts()) : $post_list2->the_post();
     if(has_post_thumbnail()) {
       $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size1' );
     } elseif($options['no_image1']) {
       $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
     } else {
       $image = array();
       $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image1.gif";
     }
?>
 <li class="clearfix">
  <a class="clearfix animate_background" href="<?php the_permalink(); ?>">
   <div class="image_wrap">
    <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
   </div>
   <div class="title_area">
    <div class="title_area_inner">
     <h4 class="title"><span><?php the_title_attribute(); ?></span></h4>
     <?php if($show_date2) { ?><p class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></p><?php }; ?>
    </div>
   </div>
  </a>
 </li>
<?php endwhile; wp_reset_query(); } else { ?>
 <li class="no_post"><?php _e('There is no registered post.', 'tcd-w');  ?></li>
<?php }; ?>
</ol>

<?php

    // After widget //
    echo $after_widget;

  } // end function widget


  // Update Settings //
  function update($new_instance, $old_instance) {
    $instance['title1'] = strip_tags($new_instance['title1']);
    $instance['title2'] = strip_tags($new_instance['title2']);
    $instance['post_num1'] = $new_instance['post_num1'];
    $instance['post_order1'] = $new_instance['post_order1'];
    $instance['post_type1'] = $new_instance['post_type1'];
    $instance['show_date1'] = $new_instance['show_date1'];
    $instance['post_num2'] = $new_instance['post_num2'];
    $instance['post_order2'] = $new_instance['post_order2'];
    $instance['post_type2'] = $new_instance['post_type2'];
    $instance['show_date2'] = $new_instance['show_date2'];
    return $instance;
  }

  // Widget Control Panel //
  function form($instance) {
    $options = get_design_plus_option();
    $defaults = array( 'title1' => __('Recent post', 'tcd-w'), 'post_num1' => 3, 'post_order1' => 'date1', 'post_type1' => 'recent_post', 'show_date1' => '', 'title2' => __('Recommend post', 'tcd-w'), 'post_num2' => 3, 'post_order2' => 'date1', 'post_type2' => 'recommend_post', 'show_date2' => '');
    $instance = wp_parse_args( (array) $instance, $defaults );
?>

<div class="tcd_ad_widget_box_wrap">

<h3 class="tcd_ad_widget_headline"><?php _e('First tab setting', 'tcd-w'); ?></h3>
<div class="tcd_ad_widget_box">
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Title', 'tcd-w'); ?></h3>
 <input class="widefat" name="<?php echo $this->get_field_name('title1'); ?>'" type="text" value="<?php echo $instance['title1']; ?>" />
</div>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Post type', 'tcd-w'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_type1'); ?>" class="widefat" style="width:100%;">
  <option value="recent_post" <?php selected('recent_post', $instance['post_type1']); ?>><?php _e('All post', 'tcd-w'); ?></option>
  <option value="recommend_post" <?php selected('recommend_post', $instance['post_type1']); ?>><?php _e('Recommend post1', 'tcd-w'); ?></option>
  <option value="recommend_post2" <?php selected('recommend_post2', $instance['post_type1']); ?>><?php _e('Recommend post2', 'tcd-w'); ?></option>
  <option value="pickup_post" <?php selected('pickup_post', $instance['post_type1']); ?>><?php _e('Pickup post', 'tcd-w'); ?></option>
 </select>
</div>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Number of post', 'tcd-w'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_num1'); ?>" class="widefat" style="width:100%;">
  <option value="3" <?php selected('3', $instance['post_num1']); ?>>3</option>
  <option value="4" <?php selected('4', $instance['post_num1']); ?>>4</option>
  <option value="5" <?php selected('5', $instance['post_num1']); ?>>5</option>
  <option value="6" <?php selected('6', $instance['post_num1']); ?>>6</option>
  <option value="7" <?php selected('7', $instance['post_num1']); ?>>7</option>
  <option value="8" <?php selected('8', $instance['post_num1']); ?>>8</option>
  <option value="9" <?php selected('9', $instance['post_num1']); ?>>9</option>
  <option value="10" <?php selected('10', $instance['post_num1']); ?>>10</option>
 </select>
</div>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Post order', 'tcd-w'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_order1'); ?>" class="widefat" style="width:100%;">
  <option value="date1" <?php selected('date1', $instance['post_order1']); ?>><?php _e('Date (DESC)', 'tcd-w'); ?></option>
  <option value="date2" <?php selected('date2', $instance['post_order1']); ?>><?php _e('Date (ASC)', 'tcd-w'); ?></option>
  <option value="rand" <?php selected('rand', $instance['post_order1']); ?>><?php _e('Random', 'tcd-w'); ?></option>
 </select>
</div>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Display setting', 'tcd-w'); ?></h3>
 <input id="<?php echo $this->get_field_id('show_date1'); ?>" name="<?php echo $this->get_field_name('show_date1'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['show_date1'] ); ?> />
 <label for="<?php echo $this->get_field_id('show_date1'); ?>"><?php _e('Display date', 'tcd-w'); ?></label>
</div>
</div><!-- END .tcd_ad_widget_box -->

<h3 class="tcd_ad_widget_headline"><?php _e('Second tab setting', 'tcd-w'); ?></h3>
<div class="tcd_ad_widget_box">
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Title', 'tcd-w'); ?></h3>
 <input class="widefat" name="<?php echo $this->get_field_name('title2'); ?>'" type="text" value="<?php echo $instance['title2']; ?>" />
</div>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Post type', 'tcd-w'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_type2'); ?>" class="widefat" style="width:100%;">
  <option value="recent_post" <?php selected('recent_post', $instance['post_type2']); ?>><?php _e('All post', 'tcd-w'); ?></option>
  <option value="recommend_post" <?php selected('recommend_post', $instance['post_type2']); ?>><?php _e('Recommend post1', 'tcd-w'); ?></option>
  <option value="recommend_post2" <?php selected('recommend_post2', $instance['post_type2']); ?>><?php _e('Recommend post2', 'tcd-w'); ?></option>
  <option value="pickup_post" <?php selected('pickup_post', $instance['post_type2']); ?>><?php _e('Pickup post', 'tcd-w'); ?></option>
 </select>
</div>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Number of post', 'tcd-w'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_num2'); ?>" class="widefat" style="width:100%;">
  <option value="3" <?php selected('3', $instance['post_num2']); ?>>3</option>
  <option value="4" <?php selected('4', $instance['post_num2']); ?>>4</option>
  <option value="5" <?php selected('5', $instance['post_num2']); ?>>5</option>
  <option value="6" <?php selected('6', $instance['post_num2']); ?>>6</option>
  <option value="7" <?php selected('7', $instance['post_num2']); ?>>7</option>
  <option value="8" <?php selected('8', $instance['post_num2']); ?>>8</option>
  <option value="9" <?php selected('9', $instance['post_num2']); ?>>9</option>
  <option value="10" <?php selected('10', $instance['post_num2']); ?>>10</option>
 </select>
</div>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Post order', 'tcd-w'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_order2'); ?>" class="widefat" style="width:100%;">
  <option value="date1" <?php selected('date1', $instance['post_order2']); ?>><?php _e('Date (DESC)', 'tcd-w'); ?></option>
  <option value="date2" <?php selected('date2', $instance['post_order2']); ?>><?php _e('Date (ASC)', 'tcd-w'); ?></option>
  <option value="rand" <?php selected('rand', $instance['post_order2']); ?>><?php _e('Random', 'tcd-w'); ?></option>
 </select>
</div>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Display setting', 'tcd-w'); ?></h3>
 <input id="<?php echo $this->get_field_id('show_date2'); ?>" name="<?php echo $this->get_field_name('show_date2'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['show_date2'] ); ?> />
 <label for="<?php echo $this->get_field_id('show_date2'); ?>"><?php _e('Display date', 'tcd-w'); ?></label>
</div>
</div><!-- END .tcd_ad_widget_box -->

</div><!-- END .tcd_ad_widget_box_wrap -->

<?php

  } // end function form

} // end class


function register_tab_post_list_widget() {
  register_widget( 'tab_post_list_widget' );
}
add_action( 'widgets_init', 'register_tab_post_list_widget' );


?>