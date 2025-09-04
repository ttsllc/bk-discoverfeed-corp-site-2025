<?php $options = get_design_plus_option(); ?>

 <?php
      if(is_page()){ 
        $page_hide_footer = get_post_meta($post->ID, 'page_hide_footer', true);
      } elseif(is_404()){ 
        $page_hide_footer = $options['hide_footer_404'];
      } else {
        $page_hide_footer = '';
      }
      if(!$page_hide_footer){
 ?>
 <footer id="footer">

  <?php
       // footer carousel -----------------------------------------------------------------------------------
       if( $options['show_footer_carousel']) {
         $show_icon = $options['show_footer_carousel_icon'];
         $post_num = $options['footer_carousel_num'];
         $post_type = $options['footer_carousel_type'];
         $post_order = $options['footer_carousel_order'];
         if($post_order == 'menu_order'){
           $post_order = array( 'menu_order' => 'ASC', 'date' => 'DESC' );
         }
         if($post_type != 'all_post') {
           $args = array( 'post_type' => 'product', 'orderby' => $post_order, 'posts_per_page' => $post_num, 'meta_key' => $post_type, 'meta_value' => '1' );
         } else {
           $args = array( 'post_type' => 'product', 'orderby' => $post_order, 'posts_per_page' => $post_num );
         }
         $product_query = new wp_query($args);
         $total_post_num = $product_query->post_count;
         if ($product_query->have_posts()) :
  ?>
  <div id="footer_carousel_wrap" <?php if(!$show_icon){ echo 'class="no_icon"'; }; ?>>
   <div id="footer_carousel">
    <h3 class="headline rich_font"><?php echo esc_html($options['footer_carousel_headline']); ?></h3>
    <div id="footer_carousel_inner">
     <?php
          while($product_query->have_posts()): $product_query->the_post();
            $image = get_post_meta($post->ID, 'carousel_image', true) ?  get_post_meta($post->ID, 'carousel_image', true) : '';
            if(!empty($image)){
              $image = wp_get_attachment_image_src($image, 'size3');
              $main_color = get_post_meta($post->ID, 'icon_color', true) ?  get_post_meta($post->ID, 'icon_color', true) : '#008a98';
              $featured_text = get_post_meta($post->ID, 'featured_text', true);
              $short_desc = get_post_meta($post->ID, 'short_desc', true);
     ?>
     <article class="item">
      <a href="<?php the_permalink() ?>">
       <?php if($show_icon && $featured_text) { ?><p class="icon" style="background:<?php echo esc_attr($main_color); ?>;"><span><?php echo wp_kses_post(nl2br($featured_text)); ?></span></p><?php }; ?>
       <img class="image" src="<?php echo esc_attr($image[0]); ?>" alt="" title="">
       <div class="title_area">
        <h4 class="title rich_font_<?php echo esc_attr($options['footer_carousel_title_font_type']); ?>"><span><?php the_title(); ?></span></h4>
        <?php if(!empty($short_desc)) { ?>
        <p class="desc"><span><?php echo wp_kses_post(nl2br($short_desc)); ?></span></p>
        <?php }; ?>
       </div>
      </a>
     </article>
     <?php }; endwhile; wp_reset_query(); ?>
    </div><!-- END #footer_carousel_inner -->
    <?php if($total_post_num > 4){ ?>
    <div class="carousel_arrow next_item"></div>
    <div class="carousel_arrow prev_item"></div>
    <?php }; ?>
   </div><!-- END #footer_carousel -->
   <?php
        $bg_image = wp_get_attachment_image_src($options['footer_bg_image'], 'full');
        $bg_image_mobile = wp_get_attachment_image_src($options['footer_bg_image_mobile'], 'full');
        $use_overlay = $options['footer_bg_use_overlay'];
        if($use_overlay) {
          $overlay_color = hex2rgb($options['footer_bg_overlay_color']);
          $overlay_color = implode(",",$overlay_color);
          $overlay_opacity = $options['footer_bg_overlay_opacity'];
   ?>
   <div class="overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></div>
   <?php }; ?>

   <?php if(!empty($bg_image)) { ?>
   <div class="footer_bg_image <?php if(!empty($bg_image_mobile)) { echo 'pc'; }; ?>" style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center center; background-size:cover;"></div>
   <?php }; ?>
   <?php if(!empty($bg_image_mobile)) { ?>
   <div class="footer_bg_image mobile" style="background:url(<?php echo esc_attr($bg_image_mobile[0]); ?>) no-repeat center center; background-size:cover;"></div>
   <?php }; ?>
  </div><!-- END #footer_carousel_wrap -->
  <?php
         endif;
       };
  ?>

  <?php
       // footer post list -----------------------------------------------------------------------------------
       if( $options['show_footer_post_list']) {
         $post_num = '3';
         $post_type = $options['footer_post_list_type'];
         $post_order = $options['footer_post_list_order'];
         if($post_type == 'recent_post') {
           $args = array( 'post_type' => 'post', 'ignore_sticky_posts' => 1, 'orderby' => $post_order, 'posts_per_page' => $post_num );
         } else {
           $args = array( 'post_type' => 'post', 'orderby' => $post_order, 'posts_per_page' => $post_num, 'meta_key' => $post_type, 'meta_value' => 'on' );
         }
         $post_list_query = new wp_query($args);
         if($post_list_query->have_posts()):
  ?>
  <div id="footer_post_list_wrap">
   <div id="footer_post_list" class="clearfix">
    <?php
         while($post_list_query->have_posts()): $post_list_query->the_post();
           if(has_post_thumbnail()) {
             $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size1' );
           } elseif($options['no_image1']) {
             $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
           } else {
             $image = array();
             $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image1.gif";
           }
           $category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
           if ( $category && ! is_wp_error($category) ) {
             foreach ( $category as $cat ) :
               $cat_name = $cat->name;
               $cat_id = $cat->term_id;
               break;
             endforeach;
           };
    ?>
    <article class="item">
     <?php if ( $category && ! is_wp_error($category) ) { ?>
     <p class="category cat_id_<?php echo esc_attr($cat_id); ?>"><a href="<?php echo esc_url(get_term_link($cat_id,'category')); ?>"><?php echo esc_html($cat_name); ?></a></p>
     <?php }; ?>
     <a class="animate_background clearfix" href="<?php the_permalink(); ?>">
      <div class="image_wrap">
       <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
      </div>
      <div class="title_area">
       <h3 class="title"><span><?php the_title(); ?></span></h3>
      </div>
     </a>
    </article>
    <?php endwhile; ?>
   </div><!-- END #footer_post_list -->
  </div><!-- END #footer_post_list_wrap -->
  <?php endif; wp_reset_query(); }; ?>

  <div id="footer_bottom">

    <?php // footer menu -------------------------------------------- ?>
    <?php if (has_nav_menu('footer-menu')) { ?>
    <div id="footer_menu" class="footer_menu">
     <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'footer-menu' , 'container' => '' , 'depth' => '1') ); ?>
    </div>
    <?php }; ?>

    <?php
         // footer sns ------------------------------------
         if($options['show_footer_sns']) {
           $facebook = $options['header_facebook_url'];
           $twitter = $options['header_twitter_url'];
           $insta = $options['header_instagram_url'];
           $pinterest = $options['header_pinterest_url'];
           $youtube = $options['header_youtube_url'];
           $contact = $options['header_contact_url'];
           $show_rss = $options['header_show_rss'];
    ?>
    <ul id="footer_sns" class="clearfix">
     <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
     <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow" target="_blank" title="Twitter"><span>Twitter</span></a></li><?php }; ?>
     <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
     <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
     <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
     <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
     <?php if($show_rss) { ?><li class="rss"><a href="<?php esc_url(bloginfo('rss2_url')); ?>" rel="nofollow" target="_blank" title="RSS"><span>RSS</span></a></li><?php }; ?>
    </ul>
    <?php }; ?>

  </div><!-- END #footer_bottom -->

  <p id="copyright" style="background:<?php echo esc_attr($options['copyright_bg_color']); ?>; color:<?php echo esc_attr($options['copyright_font_color']); ?>;"><?php echo wp_kses_post($options['copyright']); ?></p>

 </footer>

 <?php }; // END hide footer ?>

 <div id="return_top">
  <a href="#body"><span>TOP</span></a>
 </div>

 <?php
      // footer bar for mobile device -------------------
      if( is_mobile() && ($options['footer_bar_display'] != 'type3') ) {
        get_template_part('template-parts/footer-bar');
      };
 ?>

</div><!-- #container -->

<?php // drawer menu -------------------------------------------- ?>
<?php if (has_nav_menu('global-menu')) { ?>
<div id="drawer_menu">
 <nav>
  <?php wp_nav_menu( array( 'menu_id' => 'mobile_menu', 'sort_column' => 'menu_order', 'theme_location' => 'global-menu' , 'container' => '' ) ); ?>
 </nav>
 <?php
      // Search --------------------------------------------------------------------
      if( $options['show_header_search']) {
 ?>
 <div id="footer_search">
  <form role="search" method="get" id="footer_searchform" action="<?php echo esc_url(home_url()); ?>">
   <div class="input_area"><input type="text" value="" id="footer_search_input" name="s" autocomplete="off"></div>
   <div class="button"><label for="footer_search_button"></label><input type="submit" id="footer_search_button" value=""></div>
  </form>
 </div>
 <?php }; ?>
 <div id="mobile_banner">
  <?php
       for($i=1; $i<= 3; $i++):
         if( $options['mobile_menu_ad_code'.$i] || $options['mobile_menu_ad_image'.$i] ) {
           if ($options['mobile_menu_ad_code'.$i]) {
  ?>
  <div class="banner">
   <?php echo $options['mobile_menu_ad_code'.$i]; ?>
  </div>
  <?php
       } else {
         $mobile_menu_image = wp_get_attachment_image_src( $options['mobile_menu_ad_image'.$i], 'full' );
  ?>
  <div class="banner">
   <a href="<?php echo esc_url( $options['mobile_menu_ad_url'.$i] ); ?>"<?php if($options['mobile_menu_ad_target'.$i] == 1) { ?> target="_blank"<?php }; ?>><img src="<?php echo esc_attr($mobile_menu_image[0]); ?>" alt="" title="" /></a>
  </div>
  <?php }; }; endfor; ?>
 </div><!-- END #footer_mobile_banner -->
</div>
<?php }; ?>

<?php
     // load script -----------------------------------------------------------
     if ($options['show_load_screen'] == 'type2') {
       if(is_front_page()){
         has_loading_screen();
       } else {
         no_loading_screen();
       }
     } elseif ($options['show_load_screen'] == 'type3') {
       if(is_front_page() || is_home() || is_archive() ){
         has_loading_screen();
       } else {
         no_loading_screen();
       }
     } else {
       no_loading_screen();
     };
?>

<?php
     // share button ----------------------------------------------------------------------
     if ( is_single() && ( $options['single_blog_show_sns_top'] || $options['single_blog_show_sns_btm'] || $options['single_news_show_sns_top'] || $options['single_news_show_sns_btm']) ) :
       if ( 'type5' == $options['sns_type_top'] || 'type5' == $options['sns_type_btm'] ) :
         if ( $options['show_twitter_top'] || $options['show_twitter_btm'] ) :
?>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<?php
         endif;
         if ( $options['show_fblike_top'] || $options['show_fbshare_top'] || $options['show_fblike_btm'] || $options['show_fbshare_btm'] ) :
?>
<!-- facebook share button code -->
<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<?php
         endif;
         if ( $options['show_hatena_top'] || $options['show_hatena_btm'] ) :
?>
<script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
<?php
         endif;
         if ( $options['show_pocket_top'] || $options['show_pocket_btm'] ) :
?>
<script type="text/javascript">!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>
<?php
         endif;
         if ( $options['show_pinterest_top'] || $options['show_pinterest_btm'] ) :
?>
<script async defer src="//assets.pinterest.com/js/pinit.js"></script>
<?php
         endif;
       endif;
     endif;
?>

<?php wp_footer(); ?>
</body>
</html>