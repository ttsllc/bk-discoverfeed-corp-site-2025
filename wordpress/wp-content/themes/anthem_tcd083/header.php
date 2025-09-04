<?php $options = get_design_plus_option(); ?>
<!DOCTYPE html>
<html class="pc" <?php language_attributes(); ?>>
<?php if($options['use_ogp']) { ?>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
<?php } else { ?>
<head>
<?php }; ?>
<meta charset="<?php bloginfo('charset'); ?>">
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
<meta name="viewport" content="width=device-width">
<title><?php wp_title('|', true, 'right'); ?></title>
<meta name="description" content="<?php seo_description(); ?>">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php
     if ( $options['favicon'] ) {
       $favicon_image = wp_get_attachment_image_src( $options['favicon'], 'full');
       if(!empty($favicon_image)) {
?>
<link rel="shortcut icon" href="<?php echo esc_url($favicon_image[0]); ?>">
<?php }; }; ?>
<?php wp_enqueue_style('style', get_stylesheet_uri(), false, version_num(), 'all'); wp_enqueue_script( 'jquery' ); if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>
<body id="body" <?php body_class(); ?>>

<?php
     if ($options['show_load_screen'] == 'type2') {
       if(is_front_page() or is_page(2159)){
         load_icon();
       }
     } elseif ($options['show_load_screen'] == 'type3') {
       if(is_front_page() || is_home() || is_archive() ){
         load_icon();
       }
     };
?>

<div id="container">

 <?php
      // Message --------------------------------------------------------------------
      if($options['show_header_message'] && $options['header_message']) {
        if( (is_front_page() && $options['show_header_message_top']) || (!is_front_page() && $options['show_header_message_sub']) ) {
 ?>
 <div id="header_message" class="<?php echo esc_attr($options['header_message_width']); if($options['show_header_message_close']) { echo ' show_close_button'; }; ?>" <?php if($options['show_header_message_close'] && isset($_COOKIE['close_header_message'])) { echo 'style="display:none;"'; }; ?>>
  <div class="post_content clearfix">
   <?php echo $options['header_message']; ?>
  </div>
  <?php if($options['show_header_message_close']) { ?>
  <div id="close_header_message"></div>
  <?php }; ?>
 </div>
 <?php }; }; ?>

 <?php if( (is_page() && get_post_meta($post->ID, 'page_hide_header', true)) || is_404() && $options['hide_header_404']) { } else { ?>

 <header id="header">

  <div id="header_top">
   <div id="header_top_inner">
    <?php
         // Description --------------------------------------------------------------------
         if( $options['show_header_desc'] && get_bloginfo('description')) {
    ?>
    <h2 id="site_description"><span><?php echo esc_html(get_bloginfo('description')); ?></span></h2>
    <?php }; ?>
    <?php
         // Search --------------------------------------------------------------------
         if( $options['show_header_search']) {
    ?>
    <div id="header_search">
     <form role="search" method="get" id="header_searchform" action="<?php echo esc_url(home_url()); ?>">
      <div class="input_area"><input type="text" value="" id="header_search_input" name="s" autocomplete="off"></div>
      <div class="button"><label for="header_search_button"></label><input type="submit" id="header_search_button" value=""></div>
     </form>
    </div>
    <?php }; ?>
    <?php
         // lang button ------------------------------------
         if($options['show_lang_button'] && $options['lang_button']) {
    ?>
    <ul id="lang_button" class="clearfix">
     <?php foreach ( $options['lang_button'] as $key => $value ) : ?>
     <li<?php if($value['active_button']){ echo ' class="active"'; }; ?>><a href="<?php if($value['url']) { echo esc_url($value['url']); }; ?>" target="_blank"><?php if($value['name']) { echo esc_html($value['name']); }; ?></a></li>
     <?php endforeach; ?>
    </ul>
    <?php }; ?>
   </div><!-- END #header_top_inner -->
  </div><!-- END #header_top -->

  <div id="header_bottom">
   <div id="header_bottom_inner">
    <div id="header_logo">
     <?php header_logo(); ?>
    </div>
    <?php
         // lang button mobile------------------------------------
         if($options['show_lang_button'] && $options['show_lang_button_mobile'] && $options['lang_button']) {
    ?>
    <a href="#" id="lang_mobile_button"></a>
    <ul id="lang_button_mobile" class="clearfix">
     <?php foreach ( $options['lang_button'] as $key => $value ) : ?>
     <li<?php if($value['active_button']){ echo ' class="active"'; }; ?>><a href="<?php if($value['url']) { echo esc_url($value['url']); }; ?>" target="_blank"><?php if($value['name']) { echo esc_html($value['name']); }; ?></a></li>
     <?php endforeach; ?>
    </ul>
    <?php }; ?>
    <?php
         // global menu
         if (has_nav_menu('global-menu')) {
    ?>
    <a id="menu_button" href="#"><span></span><span></span><span></span></a>
    <nav id="global_menu">
     <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'global-menu' , 'container' => '' ) ); ?>
    </nav>
    <?php }; ?>
    <?php
         // header sns ------------------------------------
         if($options['show_header_sns']) {
           $facebook = $options['header_facebook_url'];
           $twitter = $options['header_twitter_url'];
           $insta = $options['header_instagram_url'];
           $pinterest = $options['header_pinterest_url'];
           $youtube = $options['header_youtube_url'];
           $contact = $options['header_contact_url'];
           $show_rss = $options['header_show_rss'];
    ?>
    <ul id="header_sns" class="header_sns clearfix">
     <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
     <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow" target="_blank" title="Twitter"><span>Twitter</span></a></li><?php }; ?>
     <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
     <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
     <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
     <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
     <?php if($show_rss) { ?><li class="rss"><a href="<?php esc_url(bloginfo('rss2_url')); ?>" rel="nofollow" target="_blank" title="RSS"><span>RSS</span></a></li><?php }; ?>
    </ul>
    <?php }; ?>
   </div><!-- END #header_bottom_inner -->
  </div><!-- END #header_bottom -->

  <?php get_template_part( 'template-parts/megamenu' ); ?>

 </header>

 <?php }; ?>

 <?php
      //  ヘッダーコンテンツ -------------------------------------------------------------------------
      if(is_front_page() or is_page(2159)) {

        $index_slider = '';
        $display_header_content = '';

        if(is_mobile() && ($options['mobile_show_index_slider'] == 'type1')){
          $device = 'mobile_';
        } else {
          $device = '';
        }

        if(!is_mobile() && $options['show_index_slider']) {
          $index_slider = $options['index_slider'];
          $index_slider_bg_type = $options['index_slider_bg_type'];
          $display_header_content = 'show';
        } elseif(is_mobile() && ($options['mobile_show_index_slider'] == 'type1') ) {
          $index_slider = $options['mobile_index_slider'];
          $index_slider_bg_type = $options['mobile_index_slider_bg_type'];
          $display_header_content = 'show';
        } elseif(is_mobile() && ($options['mobile_show_index_slider'] == 'type2') ) {
          $index_slider = $options['index_slider'];
          $index_slider_bg_type = $options['index_slider_bg_type'];
          $display_header_content = 'show';
        }

        if($display_header_content == 'show'){
 ?>
 <div id="header_slider">

  <?php // コンテンツ ---------------------------- ?>
  <div id="header_slider_content" class="header_content_<?php echo esc_attr($index_slider_bg_type); ?>">
   <?php
        $i = 1;
        foreach ( $index_slider as $key => $value ) :
          $layer_image = wp_get_attachment_image_src( $value['layer_image'], 'full' );
          $bg_image = wp_get_attachment_image_src( $value['bg_image'], 'full' );
          if(is_mobile() && ($options['mobile_show_index_slider'] == 'type1') ) {
            $layer_image_mobile = '';
            $bg_image_mobile = '';
            $image_layout = 'type3';
            $image_layout2 = 'type2';
            $text_layout = 'type1';
          } else {
            $layer_image_mobile = wp_get_attachment_image_src( $value['layer_image_mobile'], 'full' );
            $bg_image_mobile = wp_get_attachment_image_src( $value['bg_image_mobile'], 'full' );
            $image_layout = $value['image_layout'];
            $image_layout2 = $value['image_layout2'];
            $text_layout = $value['text_layout'];
          }
   ?>
   <div class="item image_item item<?php echo $i; ?> slick-slide animation_<?php echo esc_attr($value['animation_type']); ?> bg_animation_<?php echo esc_attr($value['bg_image_animation_type']); ?> image_layout_<?php echo esc_attr($image_layout); ?> image_layout2_<?php echo esc_attr($image_layout2); ?> image_layout_mobile_<?php echo esc_attr($value['image_layout_mobile']); ?> text_layout_<?php echo esc_attr($text_layout); ?> text_layout_mobile_<?php echo esc_attr($value['text_layout_mobile']); ?> <?php if(empty($layer_image)) { echo 'no_layer_image'; }; ?>">
    <div class="caption">
     <div class="caption_inner">
      <?php if(!empty($value['catch'])){ ?><h3 class="animate_item catch rich_font_<?php echo esc_attr($value['catch_font_type']); ?>"><?php echo wp_kses_post(nl2br($value['catch'])); ?></h3><?php }; ?>
      <?php if(!empty($value['desc'])){ ?>
      <div class="animate_item desc">
       <p<?php if($value['desc_mobile']){ echo ' class="pc"'; }; ?>><?php echo wp_kses_post(nl2br($value['desc'])); ?></p>
       <?php if($value['desc_mobile']) { ?><p class="mobile"><?php echo wp_kses_post(nl2br($value['desc_mobile'])); ?></p><?php }; ?>
      </div>
      <?php }; ?>
      <?php if($value['show_button']){ ?><a class="animate_item button button_animation_<?php echo esc_attr($value['button_animation_type']); ?>" href="<?php echo esc_attr($value['button_url']); ?>" <?php if($value['button_target']){ echo 'target="_blank"'; }; ?>><span><?php echo esc_html($value['button_label']); ?></span></a><?php }; ?>
     </div>
    </div>
    <?php if($layer_image || $layer_image_mobile) { ?>
    <div class="animate_item layer_image">
     <?php if($layer_image) { ?><img <?php if($layer_image_mobile) { echo 'class="pc"'; }; ?> src="<?php echo esc_attr($layer_image[0]); ?>" alt="" title=""><?php }; ?>
     <?php if($layer_image_mobile) { ?><img class="mobile" src="<?php echo esc_attr($layer_image_mobile[0]); ?>" alt="" title=""><?php }; ?>
    </div>
    <?php }; ?>
    <?php
         // 背景画像をスライダーにする場合
         if($options[$device . 'index_slider_use_image_slider'] == 1) {
           if($value['use_overlay'] == 1) {
             $overlay_color = hex2rgb($value['overlay_color']);
             $overlay_color = implode(",",$overlay_color);
    ?>
    <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($value['overlay_opacity']); ?>);"></div>
    <?php
           };
           if($bg_image) {
    ?>
    <div class="bg_image <?php if($bg_image_mobile) { echo 'pc'; }; ?>" style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center center; background-size:cover;"></div>
    <?php if($bg_image_mobile) { ?><div class="bg_image mobile" style="background:url(<?php echo esc_attr($bg_image_mobile[0]); ?>) no-repeat center center; background-size:cover;"></div><?php }; ?>
    <?php
           };
         };
    ?>
   </div><!-- END .item -->
   <?php
        $i++;
        endforeach;
   ?>
  </div><!-- END #header_slider_content -->

  <?php
       // オーバーレイ -------------------------
       if( ($options[$device .'index_slider_use_overlay'] == 1) && ($options[$device .'index_slider_use_image_slider'] != 1) ) {
         $index_slider_overlay_color = hex2rgb($options[$device .'index_slider_overlay_color']);
         $index_slider_overlay_color = implode(",",$index_slider_overlay_color);
  ?>
  <div class="overlay bg_overlay" style="background:rgba(<?php echo esc_attr($index_slider_overlay_color); ?>,<?php echo esc_attr($options[$device .'index_slider_overlay_opacity']); ?>);"></div>
  <?php }; ?>

  <?php
       // 背景画像の場合 -------------------------
       if( ($index_slider_bg_type == 'type1') && ($options[$device .'index_slider_use_image_slider'] != 1) ){
         $bg_image = wp_get_attachment_image_src( $options[$device .'index_slider_image'], 'full' );
         $bg_image_mobile = wp_get_attachment_image_src( $options[$device .'index_slider_image_mobile'], 'full' );
         if($bg_image){
  ?>
  <div class="image <?php if($bg_image_mobile) { echo 'pc'; }; ?>" style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center center; background-size:cover;"></div>
  <?php if($bg_image_mobile) { ?><div class="image mobile" style="background:url(<?php echo esc_attr($bg_image_mobile[0]); ?>) no-repeat center center; background-size:cover;"></div><?php }; ?>
  <?php
         };
       };
  ?>

  <?php
       // MP4動画の場合 -------------------------
       if($index_slider_bg_type == 'type2'){
         $video = $options[$device .'index_video'];
         if(!empty($video)) {
           if (auto_play_movie()) {
  ?>
  <div id="index_video">
   <div id="index_video_inner">
    <video src="<?php echo esc_url(wp_get_attachment_url($video)); ?>" id="index_video_mp4" playsinline autoplay loop muted></video>
   </div>
  </div>
  <?php
           } else {
             $video_image = wp_get_attachment_image_src($options[$device .'index_movie_image'], 'full');
             if($video_image) {
  ?>
  <div class="image" style="background:url(<?php echo esc_attr($video_image[0]); ?>) no-repeat center center; background-size:cover;"></div>
  <?php
             };
           };
         };
       };
  ?>

  <?php
       // YouTubeの場合 -------------------------
       if($index_slider_bg_type == 'type3'){
         $youtube_url = $options[$device .'index_youtube_url'];
         if(!empty($youtube_url)) {
           if (auto_play_movie()) {
  ?>
  <div id="index_video">
   <div id="index_video_inner">
    <div id="youtube_video_player"></div>
   </div>
  </div>
  <?php
           } else {
             $video_image = wp_get_attachment_image_src($options[$device .'index_movie_image'], 'full');
             if($video_image) {
  ?>
  <div class="image" style="background:url(<?php echo esc_attr($video_image[0]); ?>) no-repeat center center; background-size:cover;"></div>
  <?php
             };
           };
         };
       };
  ?>

 </div><!-- END #header_slider -->
 <?php
      };

      // ヘッダーカルーセル --------------------------------------------------------------------
      if( $options['show_header_carousel']) {
        $post_num = $options['header_carousel_num'];
        $post_type = $options['header_carousel_type'];
        $post_order = $options['header_carousel_order'];
         if($post_order == 'menu_order'){
           $post_order = array( 'menu_order' => 'ASC', 'date' => 'DESC' );
         }
        if($post_type != 'all_post') {
          $args = array( 'post_type' => 'product', 'orderby' => $post_order, 'posts_per_page' => $post_num, 'meta_key' => $post_type, 'meta_value' => '1' );
        } else {
          $args = array( 'post_type' => 'product', 'orderby' => $post_order, 'posts_per_page' => $post_num );
        }
        $product_query = new wp_query($args);
        if ($product_query->have_posts()) :
 ?>
 <div id="header_carousel_wrap">
  <h3 class="headline rich_font"><?php echo esc_html($options['header_carousel_headline']); ?></h3>
  <div id="header_carousel" class="owl-carousel">
   <?php
        while($product_query->have_posts()): $product_query->the_post();
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
    <a class="animate_background" href="<?php the_permalink() ?>">
     <div class="image_wrap">
      <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
     </div>
    </a>
   </article>
   <?php endwhile;  ?>
  </div>
 </div>
 <?php
          endif;
          wp_reset_query();
        }; // END header carousel

      // ニュースティッカー --------------------------------------------------------------------
      if( $options['show_header_news']) {
        $post_num = $options['header_news_num'];
        $post_type = $options['header_news_type'];
        if($options['header_news_order'] == 'rand') {
          $args = array( 'post_type' => $post_type, 'orderby' => 'rand', 'posts_per_page' => $post_num );
        } else {
          $args = array( 'post_type' => $post_type, 'posts_per_page' => $post_num );
        }
        $news_query = new wp_query($args);
        if ($news_query->have_posts()) :
 ?>
 <div id="index_news">
  <div id="index_news_inner">
   <div id="index_news_slider">
    <?php while($news_query->have_posts()): $news_query->the_post(); ?>
    <article class="item">
     <a href="<?php the_permalink() ?>" class="clearfix">
      <p class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.j'); ?></time></p>
      <h4 class="title"><span><?php the_title_attribute(); ?></span></h4>
     </a>
    </article>
    <?php endwhile;  ?>
   </div>
  </div>
 </div>
 <?php
          endif;
          wp_reset_query();
        }; // END news

      }; // END front page
 ?>
