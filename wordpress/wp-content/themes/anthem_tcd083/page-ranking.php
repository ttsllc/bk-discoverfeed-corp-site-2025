<?php
/*
Template Name:Ranking page
*/
__('Ranking page', 'tcd-w');
?>
<?php
     get_header();
     $options = get_design_plus_option();
?>
<div id="page_header_wrap">
 <?php
      $hide_header = get_post_meta($post->ID, 'page_hide_header_image', true);
      if(!$hide_header){
        $header_catch = get_post_meta($post->ID, 'page_header_catch', true);
        $header_catch_font_type = get_post_meta($post->ID, 'page_header_catch_font_type', true) ?  get_post_meta($post->ID, 'page_header_catch_font_type', true) : 'type3';
        $header_sub_title = get_post_meta($post->ID, 'page_header_sub_title', true);
        $header_sub_title_font_type = get_post_meta($post->ID, 'page_header_sub_title_font_type', true) ?  get_post_meta($post->ID, 'page_header_sub_title_font_type', true) : 'type2';
        $header_desc = get_post_meta($post->ID, 'page_header_desc', true);
        $header_desc_mobile = get_post_meta($post->ID, 'page_header_desc_mobile', true);
        $bg_image = get_post_meta($post->ID, 'page_header_bg_image', true) ? wp_get_attachment_image_src( get_post_meta($post->ID, 'page_header_bg_image', true), 'full' ) : '';
        $bg_image_mobile = get_post_meta($post->ID, 'page_header_bg_image_mobile', true) ? wp_get_attachment_image_src( get_post_meta($post->ID, 'page_header_bg_image_mobile', true), 'full' ) : '';
        $use_overlay = get_post_meta($post->ID, 'page_header_use_overlay', true);
        if($use_overlay) {
          $overlay_color = get_post_meta($post->ID, 'page_header_overlay_color', true) ?  get_post_meta($post->ID, 'page_header_overlay_color', true) : '#000000';
          $overlay_color = hex2rgb($overlay_color);
          $overlay_color = implode(",",$overlay_color);
          $overlay_opacity = get_post_meta($post->ID, 'page_header_overlay_opacity', true) ?  get_post_meta($post->ID, 'page_header_overlay_opacity', true) : '0.3';
        }
        $image_layout = get_post_meta($post->ID, 'image_layout', true) ?  get_post_meta($post->ID, 'image_layout', true) : 'type3';
        $image_layout2 = get_post_meta($post->ID, 'image_layout2', true) ?  get_post_meta($post->ID, 'image_layout2', true) : 'type2';
        $image_layout_mobile = get_post_meta($post->ID, 'image_layout_mobile', true) ?  get_post_meta($post->ID, 'image_layout_mobile', true) : 'type2';
        $text_layout = get_post_meta($post->ID, 'text_layout', true) ?  get_post_meta($post->ID, 'text_layout', true) : 'type1';
        $image_animation_type = get_post_meta($post->ID, 'image_animation_type', true) ?  get_post_meta($post->ID, 'image_animation_type', true) : 'type1';
        $layer_image = get_post_meta($post->ID, 'layer_image', true) ? wp_get_attachment_image_src( get_post_meta($post->ID, 'layer_image', true), 'full' ) : '';
        $layer_image_mobile = get_post_meta($post->ID, 'layer_image_mobile', true) ? wp_get_attachment_image_src( get_post_meta($post->ID, 'layer_image_mobile', true), 'full' ) : '';
 ?>
 <div id="page_header" class="image_layout_<?php echo esc_attr($image_layout); ?> image_layout2_<?php echo esc_attr($image_layout2); ?> image_layout_mobile_<?php echo esc_attr($image_layout_mobile); ?> text_layout_<?php echo esc_attr($text_layout); ?> animation_<?php echo esc_attr($image_animation_type); ?> <?php if(empty($layer_image)) { echo 'no_layer_image'; }; ?>">
  <div id="page_header_inner">
   <div class="caption">
    <?php if($header_sub_title){ ?>
    <p class="sub_title animate_item rich_font_<?php echo esc_attr($header_sub_title_font_type); ?>"><span><?php echo wp_kses_post(nl2br($header_sub_title)); ?></span></p>
    <?php }; ?>
    <?php if($header_catch){ ?>
    <h1 class="catch  animate_item rich_font_<?php echo esc_attr($header_catch_font_type); ?>"><?php echo wp_kses_post(nl2br($header_catch)); ?></h1>
    <?php }; ?>
    <?php if($header_desc){ ?>
    <p class="desc animate_item"><span<?php if($header_desc_mobile){ echo ' class="pc"'; }; ?>><?php echo wp_kses_post(nl2br($header_desc)); ?></span><?php if($header_desc_mobile){ ?><span class="mobile"><?php echo wp_kses_post(nl2br($header_desc_mobile)); ?></span><?php }; ?></p>
    <?php }; ?>
   </div>
   <?php if($layer_image) { ?>
   <div class="layer_image animate_item">
    <img <?php if($layer_image_mobile){ echo 'class="pc"'; }; ?> src="<?php echo esc_attr($layer_image[0]); ?>" alt="" title="">
    <?php if($layer_image_mobile) { ?><img class="mobile" src="<?php echo esc_attr($layer_image_mobile[0]); ?>" alt="" title=""><?php }; ?>
   </div>
   <?php }; ?>
  </div>
  <?php if($use_overlay) { ?>
  <div class="overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></div>
  <?php }; ?>
  <?php if($bg_image) { ?>
  <div class="bg_image<?php if($bg_image_mobile) { echo ' pc'; }; ?>" style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center top; background-size:cover;"></div>
  <?php }; ?>
  <?php if($bg_image_mobile) { ?>
  <div class="bg_image mobile" style="background:url(<?php echo esc_attr($bg_image_mobile[0]); ?>) no-repeat center top; background-size:cover;"></div>
  <?php }; ?>
 </div>
 <?php }; ?>
 <?php
      // コンテンツリンク ------------------------------------------------------------
      $ranking_content = get_post_meta( $post->ID, 'ranking_content', true );
      $page_hide_content_link = get_post_meta($post->ID, 'page_hide_content_link', true);
      if(!$page_hide_content_link){
        if ( $ranking_content && is_array( $ranking_content ) ) :
 ?>
 <div id="header_category_button_wrap" class="animate_item" data-width="1200">
  <div id="header_category_button" class="type2">
   <ol>
    <?php
         $ranking_flag = true;
         foreach( $ranking_content as $key => $content ) :
           if ( $content['show_content'] && !empty($content['ranking_list_title']) ) {
    ?>
    <li<?php if($ranking_flag == true){ echo ' class="active"'; }; ?> data-cat_id="ranking_content_<?php echo esc_attr($key); ?>"><a href="#"><?php echo esc_html($content['ranking_list_title']); ?></a></li>
    <?php $ranking_flag = false; }; endforeach; ?>
   </ol>
   <div class="slide_item"></div>
  </div>
 </div>
 <?php endif; }; ?>
</div><!-- END #page_header_wrap -->

<div id="ranking_page" class="content_link_target_top">

 <?php
      // フリースペース
      $show_ranking_free1 = get_post_meta($post->ID, 'show_ranking_free1', true);
      if($show_ranking_free1){
        $ranking_free1_content_width_type = get_post_meta($post->ID, 'ranking_free1_content_width', true) ?  get_post_meta($post->ID, 'ranking_free1_content_width', true) : 'type1';
        if($ranking_free1_content_width_type == 'type1'){
          $ranking_free1_content_width = '1200px';
        } else {
          $ranking_free1_content_width = '100%';
        }
        $ranking_free1 = get_post_meta($post->ID, 'ranking_free1', true);
 ?>
 <div class="ranking_free_space top <?php echo esc_attr($ranking_free1_content_width_type); ?>" style="width:<?php echo esc_attr($ranking_free1_content_width); ?>;">
  <?php if(!empty($ranking_free1)) { ?>
  <div class="post_content clearfix">
   <?php echo apply_filters('the_content', $ranking_free1 ); ?>
  </div>
  <?php }; ?>
 </div>
 <?php }; ?>

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

 <?php
      // コンテンツビルダー
      if ( $ranking_content && is_array( $ranking_content ) ) :
        $ranking_flag = true;
        foreach( $ranking_content as $key => $content ) :
          if ( ($content['cb_content_select'] == 'content1') && $content['show_content']) {
  ?>
  <div class="ranking_content content_link_target num<?php echo esc_attr($key); ?> <?php if($ranking_flag == true) { echo 'active'; }; ?>" id="ranking_content_<?php echo $key; ?>">

   <?php
        // 総合ラインキング -------------------------------------------------
        $catch = $content['catch'];
        $catch_font_type = $content['catch_font_type'] ?  $content['catch_font_type'] : 'type3';
        $desc = $content['desc'];
   ?>
   <div class="ranking_top">

    <?php if($catch || $desc) { ?>
    <div class="content_header">
     <?php if($catch) { ?>
     <h3 class="catch rich_font_<?php echo esc_attr($catch_font_type); ?>"><?php echo esc_html($catch); ?></h3>
     <?php }; ?>
     <?php if($desc) { ?>
     <p class="desc"><?php echo wp_kses_post(nl2br($desc)); ?></p>
     <?php }; ?>
    </div>
    <?php }; ?>

    <?php
         // ランキング一覧
         $post_ids = $content['ranking_post_ids'];
         if($post_ids){
           $ranking_label = $content['ranking_label'] ?  $content['ranking_label'] : 'BEST';
           $item_title_font_type = $content['item_title_font_type'] ?  get_post_meta($post->ID, 'item_title_font_type', true) : 'type2';
           $ranking_hide_icon = $content['ranking_hide_icon'];
           $post_ids = str_replace(array("\r\n", "\r", "\n"), "\n", $post_ids);
           $post_ids = explode("\n", $post_ids);
           $args = array( 'post_type' => 'product', 'post__in' => $post_ids, 'orderby' => 'post__in');
           $post_list_query = new wp_query($args);
           if($post_list_query->have_posts()):
    ?>
    <div class="product_ranking_list product_ranking_list_top clearfix">
     <?php
          $i = 1;
          $ranking_post_num_mobile = $content['ranking_post_num_mobile'] ?  $content['ranking_post_num_mobile'] : '3';
          while($post_list_query->have_posts()): $post_list_query->the_post();
            if(is_mobile() && ($i > $ranking_post_num_mobile)){
              break;
            }
            if(has_post_thumbnail()) {
              $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
            } elseif($options['no_image1']) {
              $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
            } else {
              $image = array();
              $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
            }
            $main_color = get_post_meta($post->ID, 'icon_color', true) ?  get_post_meta($post->ID, 'icon_color', true) : '#008a98';
            $short_desc = get_post_meta($post->ID, 'short_desc', true);
            $featured_text = get_post_meta($post->ID, 'featured_text', true);
     ?>
     <article class="item">
      <a class="animate_background clearfix" href="<?php the_permalink() ?>">
       <p class="rank_number"><span class="label"><?php echo esc_html($ranking_label); ?></span><span class="num"><?php echo esc_attr($i); ?></span></p>
       <?php if(!$ranking_hide_icon && $featured_text) { ?><p class="icon" style="background:<?php echo esc_attr($main_color); ?>;"><span><?php echo wp_kses_post(nl2br($featured_text)); ?></span></p><?php }; ?>
       <div class="image_wrap">
        <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
       </div>
       <div class="title_area">
        <div class="title_area_inner">
         <h4 class="title rich_font_<?php echo esc_attr($ranking_list_title_font_type); ?>"><span><?php the_title(); ?></span></h4>
         <?php if(!empty($short_desc)) { ?>
         <p class="desc"><span><?php echo wp_kses_post(nl2br($short_desc)); ?></span></p>
         <?php }; ?>
        </div>
       </div>
      </a>
     </article>
     <?php $i++; endwhile; wp_reset_query(); ?>
    </div>
    <?php endif; }; // if post_ids ?>

   </div><!-- END ranking top -->

   <?php $ranking_flag = false; ?>

   <?php // カテゴリーランキング --------------------------------------------- ?>
   <div class="ranking_bottom">

    <?php
         $category_catch = $content['category_catch'];
         $category_catch_font_type = $content['category_catch_font_type'] ?  $content['category_catch_font_type'] : 'type3';
         $category_desc = $content['category_desc'];
         if($category_catch || $category_desc) {
    ?>
    <div class="content_header">
     <?php if($category_catch) { ?>
     <h3 class="catch rich_font_<?php echo esc_attr($category_catch_font_type); ?>"><?php echo esc_html($category_catch); ?></h3>
     <?php }; ?>
     <?php if($category_desc) { ?>
     <p class="desc"><?php echo wp_kses_post(nl2br($category_desc)); ?></p>
     <?php }; ?>
    </div>
    <?php }; ?>

    <?php
         // カテゴリーランキング一覧
         $category_ranking_list = $content['item_list'];
         $category_headline_font_type = $content['category_headline_font_type'] ?  $content['category_headline_font_type'] : 'type3';
         $category_item_title_font_type = $content['category_item_title_font_type'] ?  $content['category_item_title_font_type'] : 'type2';
         $category_ranking_hide_icon = $content['category_ranking_hide_icon'];
         if($category_ranking_list){
    ?>
    <div class="category_ranking_list clearfix">
     <?php
          foreach ( $category_ranking_list as $key => $value ) :
            $post_ids = $value['post_ids'];
            if($post_ids){
              $headline = $value['headline'];
              $sub_title = $value['sub_title'];
              $ranking_label = get_post_meta($post->ID, 'category_ranking_label', true) ?  get_post_meta($post->ID, 'category_ranking_label', true) : 'BEST';
              $ranking_list_title_font_type = get_post_meta($post->ID, 'category_ranking_list_title_font_type', true) ?  get_post_meta($post->ID, 'category_ranking_list_title_font_type', true) : 'type2';
              $post_ids = str_replace(array("\r\n", "\r", "\n"), "\n", $post_ids);
              $post_ids = explode("\n", $post_ids);
              $args = array( 'post_type' => 'product', 'post__in' => $post_ids, 'orderby' => 'post__in');
              $post_list_query = new wp_query($args);
              if($post_list_query->have_posts()):
     ?>
     <div class="product_ranking_list clearfix num<?php echo esc_attr($key); ?>">
      <?php if($headline){ ?>
      <h3 class="headline"><span class="title rich_font_<?php echo esc_attr($category_headline_font_type); ?>"><?php echo esc_html($headline); ?></span><?php if($sub_title){ echo '<span class="sub_title">' . esc_html($sub_title) . '</span>'; };?></h3>
      <?php }; ?>
      <?php
           $i = 1;
           $category_ranking_post_num_mobile = $content['category_ranking_post_num_mobile'] ? $content['category_ranking_post_num_mobile'] : '3';
           while($post_list_query->have_posts()): $post_list_query->the_post();
             if(is_mobile() && ($i > $category_ranking_post_num_mobile)){
               break;
             }
             if(has_post_thumbnail()) {
               $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
             } elseif($options['no_image1']) {
               $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
             } else {
               $image = array();
               $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
             }
             $main_color = get_post_meta($post->ID, 'icon_color', true) ?  get_post_meta($post->ID, 'icon_color', true) : '#008a98';
             $short_desc = get_post_meta($post->ID, 'short_desc', true);
             $featured_text = get_post_meta($post->ID, 'featured_text', true);
      ?>
      <article class="item">
       <a class="animate_background clearfix" href="<?php the_permalink() ?>">
        <p class="rank_number"><span class="label"><?php echo esc_html($ranking_label); ?></span><span class="num"><?php echo esc_attr($i); ?></span></p>
        <?php if(!$category_ranking_hide_icon && $featured_text) { ?><p class="icon" style="background:<?php echo esc_attr($main_color); ?>;"><span><?php echo wp_kses_post(nl2br($featured_text)); ?></span></p><?php }; ?>
        <div class="image_wrap">
         <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
        </div>
        <div class="title_area">
         <div class="title_area_inner">
          <h4 class="title rich_font_<?php echo esc_attr($category_item_title_font_type); ?>"><span><?php the_title(); ?></span></h4>
          <?php if(!empty($short_desc)) { ?>
          <p class="desc"><span><?php echo wp_kses_post(nl2br($short_desc)); ?></span></p>
          <?php }; ?>
         </div>
        </div>
       </a>
      </article>
      <?php $i++; endwhile; wp_reset_query(); ?>
     </div>
     <?php
              endif;
            };
          endforeach;
     ?>
    </div><!-- END .category_ranking_list -->
    <?php }; ?>

   </div><!-- END .ranking bottom -->

  </div><!-- END .ranking_content -->

  <?php
           };
         endforeach;
       endif; // コンテンツビルダーここまで
  ?>

  <?php endwhile; endif; ?>

 <?php
      // フリースペース
      $show_ranking_free2 = get_post_meta($post->ID, 'show_ranking_free2', true);
      if($show_ranking_free2){
        $ranking_free2_content_width_type = get_post_meta($post->ID, 'ranking_free2_content_width', true) ?  get_post_meta($post->ID, 'ranking_free2_content_width', true) : 'type1';
        if($ranking_free2_content_width_type == 'type1'){
          $ranking_free2_content_width = '1200px';
        } else {
          $ranking_free2_content_width = '100%';
        }
        $ranking_free2 = get_post_meta($post->ID, 'ranking_free2', true);
 ?>
 <div class="ranking_free_space bottom <?php echo esc_attr($ranking_free2_content_width_type); ?>" style="width:<?php echo esc_attr($ranking_free2_content_width); ?>;">
  <?php if(!empty($ranking_free2)) { ?>
  <div class="post_content clearfix">
   <?php echo apply_filters('the_content', $ranking_free2 ); ?>
  </div>
  <?php }; ?>
 </div>
 <?php }; ?>

</div><!-- END #ranking_page -->

<?php get_footer(); ?>