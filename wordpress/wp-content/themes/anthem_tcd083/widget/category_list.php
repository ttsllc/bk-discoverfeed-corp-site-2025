<?php

class tcd_category_list_widget extends WP_Widget {

  function __construct() {
    parent::__construct(
      'tcd_category_list_widget',// ID
      __( 'Category list (tcd ver)', 'tcd-w' ),
      array(
        'classname' => 'tcd_category_list_widget',
        'description' => __('Displays designed category list.', 'tcd-w')
      )
    );
  }

  function widget($args, $instance) {

    extract( $args );
    $title = apply_filters('widget_title', $instance['title']);
    $exclude_cat_num = $instance['exclude_cat_num'];
    $only_parent = $instance['only_parent'];

    // Before widget //
    echo $before_widget;

    // Title of widget //
    if ( $title ) { echo $before_title . $title . $after_title; }

    // Widget output //
?>
<ul class="tcd_category_list clearfix">
 <?php
      if($only_parent) {
        $string = wp_list_categories(array('title_li' =>'','show_count' => 0, 'echo' => 0, 'depth' => 1, 'exclude' => $exclude_cat_num));
      } else {
        $string = wp_list_categories(array('title_li' =>'','show_count' => 0, 'echo' => 0, 'exclude' => $exclude_cat_num));
      }
      echo $string;
 ?>
</ul>
<?php

    // After widget //
    echo $after_widget;

  } // end function widget


  // Update Settings //
  function update($new_instance, $old_instance) {
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['exclude_cat_num'] = $new_instance['exclude_cat_num'];
    $instance['only_parent'] = $new_instance['only_parent'];
    return $instance;
  }

  // Widget Control Panel //
  function form($instance) {
    $defaults = array( 'title' => __('Category list', 'tcd-w'), 'exclude_cat_num' => '', 'only_parent' => '');
    $instance = wp_parse_args( (array) $instance, $defaults );
?>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Title', 'tcd-w'); ?></h3>
 <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>'" type="text" value="<?php echo $instance['title']; ?>" />
</div>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Categories to exclude', 'tcd-w'); ?></h3>
 <input class="widefat" name="<?php echo $this->get_field_name('exclude_cat_num'); ?>'" type="text" value="<?php echo $instance['exclude_cat_num']; ?>" />
 <p><?php _e('Enter a comma-seperated list of category ID numbers, example 2,4,10<br />(Don\'t enter comma for last number).', 'tcd-w'); ?></p>
</div>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Display setting', 'tcd-w'); ?></h3>
 <input id="<?php echo $this->get_field_id('only_parent'); ?>" name="<?php echo $this->get_field_name('only_parent'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['only_parent'] ); ?> />
 <label for="<?php echo $this->get_field_id('only_parent'); ?>"><?php _e('Display only parent category', 'tcd-w'); ?></label>
</div>

<?php
  } // end function form

} // end class


function register_tcd_category_list_widget() {
	register_widget( 'tcd_category_list_widget' );
}
add_action( 'widgets_init', 'register_tcd_category_list_widget' );


?>