<?php
     get_header();
     $options = get_design_plus_option();
     $side_content_layout = get_post_meta($post->ID, 'side_content_layout', true) ?  get_post_meta($post->ID, 'side_content_layout', true) : 'type0';
?>
<div id="news_single" style="background:<?php echo esc_attr($options['single_news_bg_color']); ?>;">

<?php get_template_part('template-parts/breadcrumb'); ?>

<div id="main_contents" class="clearfix">

 <div id="main_col">

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <article id="article">

   <?php if($page == '1') { // ***** only show on first page ***** ?>

   <?php
        // title_area ------------------------------------------------------------------------------------------------------------------------
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
        if( $options['single_news_layout'] == 'type3'){
          $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size4' );
        }
        if( $side_content_layout == 'type3' ){
          $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size4' );
        } elseif( $side_content_layout == 'type1' || $side_content_layout == 'type2' ){
          $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
        }
   ?>
   <div id="post_title_area">
    <h1 class="title rich_font_<?php echo esc_attr($options['single_news_title_font_type']); ?> entry-title"><?php the_title(); ?></h1>
    <?php if ( $options['single_news_show_date']){ ?>
    <ul class="meta clearfix">
     <?php if ( $options['single_news_show_date']){ ?><li class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></li><?php }; ?>
    </ul>
    <?php }; ?>
   </div>

   <?php if($options['single_news_show_image'] && has_post_thumbnail()) { ?>
   <div id="post_image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
   <?php }; ?>

   <?php
        // sns button top ------------------------------------------------------------------------------------------------------------------------
        if($options['single_news_show_sns_top']) {
   ?>
   <div class="single_share clearfix" id="single_share_top">
    <?php get_template_part('template-parts/sns-btn-top'); ?>
   </div>
   <?php }; ?>

   <?php
        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_news_show_copy_top']) {
   ?>
   <div class="single_copy_title_url" id="single_copy_title_url_top">
    <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED Title&amp;URL', 'tcd-w' ) ); ?>"><?php _e( 'COPY Title&amp;URL', 'tcd-w' ); ?></button>
   </div>
   <?php }; ?>

   <?php
        // banner top ------------------------------------------------------------------------------------------------------------------------
        if(!is_mobile()) {
          if( $options['news_single_top_ad_code'] || $options['news_single_top_ad_image'] ) {
   ?>
   <div id="single_banner_top" class="single_banner">
    <?php
         if ($options['news_single_top_ad_code']) {
           echo $options['news_single_top_ad_code'];
         } else {
           $banner_image = wp_get_attachment_image_src( $options['news_single_top_ad_image'], 'full' );
    ?>
    <a href="<?php echo esc_url( $options['news_single_top_ad_url'] ); ?>" target="_blank"><img class="single_banner_image" src="<?php echo esc_attr($banner_image[0]); ?>" alt="" title="" /></a>
    <?php }; ?>
   </div><!-- END #single_banner_top -->
   <?php
          };
        };
   ?>

   <?php }; // ***** END only show on first page ***** ?>

   <?php // post content ------------------------------------------------------------------------------------------------------------------------ ?>
   <div class="post_content clearfix">
    <?php
         the_content();
         if ( ! post_password_required() ) {
           $pagenation_type = get_post_meta($post->ID, 'pagenation_type', true);
           if($pagenation_type == 'type3') {
             $pagenation_type = $options['pagenation_type'];
           };
           if ( $pagenation_type == 'type2' ) {
             if ( $page < $numpages && preg_match( '/href="(.*?)"/', _wp_link_page( $page + 1 ), $matches ) ) :
    ?>
    <div id="p_readmore">
     <a class="button" href="<?php echo esc_url( $matches[1] ); ?>#article"><?php _e( 'Read more', 'tcd-w' ); ?></a>
     <p class="num"><?php echo $page . ' / ' . $numpages; ?></p>
    </div>
    <?php
             endif;
           } else {
             custom_wp_link_pages();
           }
         }
    ?>
   </div>

   <?php
        // sns button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_news_show_sns_btm']) {
   ?>
   <div class="single_share clearfix" id="single_share_bottom">
    <?php get_template_part('template-parts/sns-btn-btm'); ?>
   </div>
   <?php }; ?>

   <?php
        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_news_show_copy_btm']) {
   ?>
   <div class="single_copy_title_url" id="single_copy_title_url_bottom">
    <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED Title&amp;URL', 'tcd-w' ) ); ?>"><?php _e( 'COPY Title&amp;URL', 'tcd-w' ); ?></button>
   </div>
   <?php }; ?>

   <?php
        // page nav ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if ($options['single_news_show_nav']) :
   ?>
   <div id="next_prev_post" class="clearfix">
    <?php next_prev_post_link(); ?>
   </div>
   <?php endif; ?>

  </article><!-- END #article -->

   <?php
        // banner bottom ------------------------------------------------------------------------------------------------------------------------
        if(!is_mobile()) {
          if( $options['news_single_bottom_ad_code'] || $options['news_single_bottom_ad_image'] ) {
   ?>
   <div id="single_banner_bottom" class="single_banner">
    <?php
         if ($options['news_single_bottom_ad_code']) {
           echo $options['news_single_bottom_ad_code'];
         } else {
           $banner_image = wp_get_attachment_image_src( $options['news_single_bottom_ad_image'], 'full' );
    ?>
    <a href="<?php echo esc_url( $options['news_single_bottom_ad_url'] ); ?>" target="_blank"><img class="single_banner_image" src="<?php echo esc_attr($banner_image[0]); ?>" alt="" title="" /></a>
    <?php }; ?>
   </div><!-- END #single_banner_bottom -->
   <?php
          };
        };
   ?>

   <?php
        // mobile banner ------------------------------------------------------------------------------------------------------------------------
        if(is_mobile()) {
          if( $options['news_single_mobile_ad_code'] || $options['news_single_mobile_ad_image'] ) {
   ?>
   <div id="single_banner_mobile" class="single_banner">
    <?php
         if ($options['news_single_mobile_ad_code']) {
           echo $options['news_single_mobile_ad_code'];
         } else {
           $banner_image = wp_get_attachment_image_src( $options['news_single_mobile_ad_image'], 'full' );
    ?>
    <a href="<?php echo esc_url( $options['news_single_mobile_ad_url'] ); ?>" target="_blank"><img class="single_banner_image" src="<?php echo esc_attr($banner_image[0]); ?>" alt="" title="" /></a>
    <?php }; ?>
   </div><!-- END #single_banner_mobile -->
   <?php
          };
        };
   ?>

  <?php endwhile; endif; ?>

  <?php
       // recent post ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
       if ($options['show_recent_news']){
         $post_num = $options['recent_news_num'];
         if(is_mobile()){
           $post_num = $options['recent_news_num_mobile'];
         }
         $args = array( 'post_type' => 'news', 'posts_per_page' => $post_num );
         $related_post_list = new wp_query($args);
         if($related_post_list->have_posts()):
  ?>
  <div id="related_post">
   <h3 class="headline rich_font"><span><?php echo wp_kses_post(nl2br($options['recent_news_headline'])); ?></span></h3>
   <div class="post_list clearfix">
    <?php
         while( $related_post_list->have_posts() ) : $related_post_list->the_post();
           if(has_post_thumbnail()) {
             $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
           } elseif($options['no_image1']) {
             $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
           } else {
             $image = array();
             $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image1.gif";
           }
    ?>
    <article class="item">
     <a class="image_link animate_background" href="<?php the_permalink(); ?>">
      <div class="image_wrap">
       <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
      </div>
     </a>
     <div class="title_area">
      <div class="title_area_inner">
       <h3 class="title rich_font_<?php echo esc_attr($options['recent_news_title_font_type']); ?>"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h3>
       <?php if ( $options['recent_news_show_date']){ ?>
       <ul class="meta clearfix">
        <?php if ( $options['recent_news_show_date']){ ?><li class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></p><?php }; ?>
       </ul>
       <?php }; ?>
      </div>
     </div>
    </article>
    <?php endwhile; wp_reset_query(); ?>
   </div><!-- END .post_list -->
  </div><!-- END #related_post -->
  <?php
         endif;
       };
  ?>

  </div><!-- END #main_col -->

  <?php
       if($side_content_layout == 'type0'){
         if($options['single_news_layout'] != 'type3'){
           get_sidebar();
          };
       } else {
         if($side_content_layout != 'type3'){
           get_sidebar();
          };
       }
  ?>

</div><!-- END #main_contents -->

</div><!-- END #news_single -->

<?php get_footer(); ?>