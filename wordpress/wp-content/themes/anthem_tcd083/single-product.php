<?php
     get_header();
     $options = get_design_plus_option();
     $side_content_layout = get_post_meta($post->ID, 'side_content_layout', true) ?  get_post_meta($post->ID, 'side_content_layout', true) : 'type0';
     $header_title_font_type = $options['single_product_header_title_font_type'];
     $show_header_button = get_post_meta($post->ID, 'show_header_button', true);
     $header_button_label = get_post_meta($post->ID, 'header_button_label', true);
     $header_button_url = get_post_meta($post->ID, 'header_button_url', true);
     $header_button_target = get_post_meta($post->ID, 'header_button_target', true);
     $header_button_animation = get_post_meta($post->ID, 'header_button_animation', true) ?  get_post_meta($post->ID, 'header_button_animation', true) : 'type1';
     $header_catch = get_post_meta($post->ID, 'header_catch', true);
     $header_sub_title = get_post_meta($post->ID, 'header_sub_title', true);
     $header_catch_font_type = $options['single_product_header_catch_font_type'];
     if(has_post_thumbnail()) {
       $bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size5' );
     }
     $image_layout = get_post_meta($post->ID, 'image_layout', true) ?  get_post_meta($post->ID, 'image_layout', true) : 'type3';
     $image_layout2 = get_post_meta($post->ID, 'image_layout2', true) ?  get_post_meta($post->ID, 'image_layout2', true) : 'type2';
     $image_layout_mobile = get_post_meta($post->ID, 'image_layout_mobile', true) ?  get_post_meta($post->ID, 'image_layout_mobile', true) : 'type2';
     $text_layout = get_post_meta($post->ID, 'text_layout', true) ?  get_post_meta($post->ID, 'text_layout', true) : 'type1';
     $image_animation_type = get_post_meta($post->ID, 'image_animation_type', true) ?  get_post_meta($post->ID, 'image_animation_type', true) : 'type1';
     $layer_image = get_post_meta($post->ID, 'layer_image', true) ? wp_get_attachment_image_src( get_post_meta($post->ID, 'layer_image', true), 'full' ) : '';
     $layer_image_mobile = get_post_meta($post->ID, 'layer_image_mobile', true) ? wp_get_attachment_image_src( get_post_meta($post->ID, 'layer_image_mobile', true), 'full' ) : '';
     $use_overlay = get_post_meta($post->ID, 'header_use_overlay', true);
     if($use_overlay) {
       $overlay_color = get_post_meta($post->ID, 'header_overlay_color', true) ?  get_post_meta($post->ID, 'header_overlay_color', true) : '#000000';
       $overlay_color = hex2rgb($overlay_color);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = get_post_meta($post->ID, 'header_overlay_opacity', true) ?  get_post_meta($post->ID, 'header_overlay_opacity', true) : '0.3';
     }
?>
<div id="page_header_wrap">
 <div id="page_header" class="image_layout_<?php echo esc_attr($image_layout); ?> image_layout2_<?php echo esc_attr($image_layout2); ?> image_layout_mobile_<?php echo esc_attr($image_layout_mobile); ?> text_layout_<?php echo esc_attr($text_layout); ?> animation_<?php echo esc_attr($image_animation_type); ?> <?php if(empty($layer_image)) { echo 'no_layer_image'; }; ?>">
  <div id="page_header_inner">
   <div class="caption">
    <?php if($header_sub_title){ ?>
    <p class="sub_title animate_item"><span><?php echo wp_kses_post(nl2br($header_sub_title)); ?></span></p>
    <?php }; ?>
    <?php if($header_catch){ ?>
    <h2 class="catch  animate_item rich_font_<?php echo esc_attr($header_catch_font_type); ?>"><?php echo wp_kses_post(nl2br($header_catch)); ?></h2>
    <?php }; ?>
    <?php if($show_header_button){ ?><a class="link_button animate_item button_animation_<?php echo esc_attr($header_button_animation); ?>" href="<?php echo esc_url($header_button_url); ?>"<?php if($header_button_target) { echo ' target="_blank"'; }; ?>><?php echo esc_html($header_button_label); ?></a><?php }; ?>
   </div>
   <?php if($layer_image) { ?>
   <div class="layer_image animate_item">
    <img <?php if($layer_image_mobile){ echo 'class="pc"'; }; ?> src="<?php echo esc_attr($layer_image[0]); ?>" alt="" title="">
    <?php if($layer_image_mobile) { ?><img class="mobile" src="<?php echo esc_attr($layer_image_mobile[0]); ?>" alt="" title=""><?php }; ?>
   </div>
   <?php }; ?>
  </div>
  <div class="title_area animate_item">
   <div class="title_area_inner">
    <h1 class="title rich_font_<?php echo esc_attr($header_title_font_type); ?>"><?php the_title(); ?></h1>
    <?php if($show_header_button){ ?><a class="link_button button_animation_<?php echo esc_attr($header_button_animation); ?>" href="<?php echo esc_url($header_button_url); ?>"<?php if($header_button_target) { echo ' target="_blank"'; }; ?>><?php echo esc_html($header_button_label); ?></a><?php }; ?>
   </div>
  </div>
  <?php if($use_overlay) { ?>
  <div class="overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></div>
  <?php }; ?>
  <?php if(has_post_thumbnail()) { ?>
  <div class="bg_image" style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center top; background-size:cover;"></div>
  <?php }; ?>
 </div>
 <?php
      // コンテンツリンク ------------------------------------------------------------
      $product_cf = get_post_meta( $post->ID, 'product_cf', true );
      if($options['show_single_product_content_link_button']){
        if ( $product_cf && is_array( $product_cf ) ) :
          $show_content_link_button = get_post_meta($post->ID, 'show_content_link_button', true);
          $content_link_button_label = get_post_meta($post->ID, 'content_link_button_label', true);
          $content_link_button_url = get_post_meta($post->ID, 'content_link_button_url', true);
          $content_link_button_target = get_post_meta($post->ID, 'content_link_button_target', true);
 ?>
 <div id="header_category_button_wrap" data-width="1200">
  <div id="header_category_button" class="type2">
   <ol>
    <?php
         $i = 1;
         foreach( $product_cf as $key => $content ) :
            if ( $content['show_content'] && !empty($content['headline']) ) {
    ?>
    <li<?php if($i == 1){ echo ' class="active"'; }; ?>><a href="#product_content<?php echo esc_attr($key); ?>"><?php echo esc_html($content['headline']); ?></a></li>
    <?php }; $i++; endforeach; ?>
    <?php if($show_content_link_button){ ?>
    <li><a class="outer_link" href="<?php echo esc_url($content_link_button_url); ?>"<?php if($content_link_button_target) { echo ' target="_blank"'; }; ?>><?php echo esc_html($content_link_button_label); ?></a></li>
    <?php }; ?>
   </ol>
   <div class="slide_item"></div>
  </div>
 </div>
 <?php endif; }; ?>
</div><!-- END #page_header_wrap -->


<div id="product_single" class="clearfix content_link_target_top">

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

 <?php
      // 見出し ---------------------------------------------------------------
      $content_catch = get_post_meta($post->ID, 'content_catch', true);
      $content_desc = get_post_meta($post->ID, 'content_desc', true);
      $content_image = get_post_meta($post->ID, 'content_image', true) ? wp_get_attachment_image_src( get_post_meta($post->ID, 'content_image', true), 'full' ) : '';
 ?>
 <div class="content_header">
  <?php if(!empty($content_catch)) { ?>
  <h3 class="catch inview rich_font_<?php echo esc_attr($options['single_product_content_catch_font_type']); ?>"><?php echo wp_kses_post(nl2br($content_catch)); ?></h3>
  <?php }; ?>
  <?php if(!empty($content_desc)) { ?>
  <p class="desc inview"><?php echo wp_kses_post(nl2br($content_desc)); ?></p>
  <?php }; ?>
 </div>

 <div id="main_contents" class="clearfix">

  <div id="main_col">

   <?php if($content_image){ ?>
   <img class="content_image inview" src="<?php echo esc_attr($content_image[0]); ?>" alt="" title="">
   <?php }; ?>

   <?php
        // コンテンツビルダー
        if ( $product_cf && is_array( $product_cf ) ) :
          foreach( $product_cf as $key => $content ) :

            // 特徴一覧 -----------------------------------------------------------------
            if ( ($content['cb_content_select'] == 'featured_list') && $content['show_content']) {
   ?>
   <div class="product_content cb_featured_list clearfix content_link_target <?php if(!$content['show_border']) { echo 'no_border'; }; ?> num<?php echo esc_attr($key); ?>" id="product_content<?php echo esc_attr($key); ?>">

    <?php if(!empty($content['headline']) || !empty($content['sub_title'])) { ?>
    <div class="headline_area inview">
    <?php if(!empty($content['headline'])) { ?>
     <h3 class="top_headline rich_font_<?php echo esc_attr($content['headline_font_type']); ?>"><?php echo esc_html($content['headline']); ?></h3>
     <?php }; ?>
     <?php if(!empty($content['sub_title'])) { ?>
     <p class="top_sub_title"><?php echo esc_html($content['sub_title']); ?></p>
     <?php }; ?>
    </div>
    <?php }; ?>

    <?php
         if (!empty($content['item_list']) && is_array( $content['item_list'] ) ) :
           $list_layout = $content['list_layout'] ? $content['list_layout'] : 'type1';
           $retina = isset($content['retina']) ? $content['retina'] : '';
    ?>
    <div class="item_list inview layout_<?php echo esc_attr($list_layout); ?>">
     <?php
          foreach ( $content['item_list'] as $key => $value ) :
           $image = $value['image'] ? wp_get_attachment_image_src( $value['image'], 'full' ) : '';
           if($image){
             $image_width = $image[1];
             $image_height = $image[2];
             if($retina) {
               $image_width = round($image_width / 2);
               $image_height = round($image_height / 2);
             };
           }
           $desc = $value['desc'];
     ?>
     <div class="item clearfix">
      <?php if($image){ ?>
      <div class="image">
       <img src="<?php echo esc_attr($image[0]); ?>" alt="" title="" width="<?php echo esc_attr($image_width); ?>" height="<?php echo esc_attr($image_height); ?>">
      </div>
      <?php }; ?>
      <div class="content">
       <?php if($desc) { ?>
       <p class="desc"><span><?php echo wp_kses_post(nl2br($desc)); ?></span></p>
       <?php }; ?>
      </div>
     </div>
     <?php endforeach; ?>
    </div><!-- END .item_list -->
    <?php endif; ?>

   </div><!-- END .cb_featured_list -->

   <?php
         // レビュー -----------------------------------------------------------------
         } elseif ( ($content['cb_content_select'] == 'review') && $content['show_content']) {
   ?>
   <div class="product_content cb_product_review clearfix content_link_target <?php if(!$content['show_border']) { echo 'no_border'; }; ?> num<?php echo esc_attr($key); ?>" id="product_content<?php echo esc_attr($key); ?>">

    <?php if(!empty($content['headline']) || !empty($content['sub_title'])) { ?>
    <div class="headline_area inview">
    <?php if(!empty($content['headline'])) { ?>
     <h3 class="top_headline rich_font_<?php echo esc_attr($content['headline_font_type']); ?>"><?php echo esc_html($content['headline']); ?></h3>
     <?php }; ?>
     <?php if(!empty($content['sub_title'])) { ?>
     <p class="top_sub_title"><?php echo esc_html($content['sub_title']); ?></p>
     <?php }; ?>
    </div>
    <?php }; ?>

    <?php
      if ( $reviews = get_reviews_from_cb_content( $content ) ) :
        $use_review_vote = ! empty( $content['use_review_vote'] );
        $list_per_page = ! empty( $content['list_per_page'] ) ? absint( $content['list_per_page'] ) : 10;
        $review_max_page = ceil( count( $reviews ) / $list_per_page );
        $review_current_page = 1;
        $cnt = 0;

        wp_enqueue_script( 'tcd-review', get_template_directory_uri() . '/js/review.js', array( 'jquery' ), version_num(), true );
        wp_localize_script( 'tcd-review', 'TCD_REVIEW', array(
          'ajax_url' => admin_url( 'admin-ajax.php' ),
          'ajax_error_message' => __( 'Error was occurred. Please retry again.', 'tcd-w' ),
          'require_enable_cookies' => __( 'Require enable cookies to use review vote.', 'tcd-w' )
        ) );
    ?>
    <div class="item_list inview" style="background:<?php echo esc_attr( $content['list_bg_color'] ); ?>;" data-current-page="<?php echo $review_current_page; ?>" data-max-page="<?php echo $review_max_page; ?>" data-vote-result-text="<?php echo esc_attr( $content['review_vote_result_text'] ); ?>" data-post-id="<?php echo $post->ID; ?>">
     <?php foreach ( $reviews as $review ) : $review_page = ceil( ++$cnt / $list_per_page ); ?>
     <div class="item clearfix review-page-<?php echo $review_page; ?>"<?php if ( $review_page != $review_current_page ) echo ' style="display: none;"'; ?>>
      <?php if ( $review['name'] || $review['rating'] || $review['date'] ) : ?>
      <div class="item_header">
       <?php if ( $review['name'] ) : ?>
       <h4 class="name"><?php echo wp_kses_post( $review['name'] ); ?></h4>
       <?php endif;
             if ( $review['rating'] ) : ?>
       <p class="rating rating-<?php echo esc_attr( $review['rating'] ); ?>"><?php echo str_repeat ( '<span class="rating-star rating-star-active">&#9733;</span>', $review['rating'] ) . str_repeat ( '<span class="rating-star">&#9733;</span>', 5 - $review['rating'] ) ?></p>
       <?php endif;
             if ( $review['date'] ) : ?>
       <p class="date"><?php echo wp_kses_post( $review['date'] ); ?></p>
       <?php endif; ?>
      </div>
      <?php endif;
            if ( $review['desc'] ) : ?>
      <p class="desc"><?php echo wp_kses_post( nl2br( $review['desc'] ) ); ?></p>
      <?php endif;
            if ( $use_review_vote && $review['unique_id'] ) :
              $voted = get_review_voted( $post->ID, $review['unique_id'] );
      ?>
      <div class="vote">
       <p class="vote_result<?php if ( ! $review['vote_count'] ) echo ' hide'; ?>"><?php echo esc_html( sprintf( $content['review_vote_result_text'], $review['vote_yes'], $review['vote_count'] ) ); ?></p>
       <h5 class="vote_headline"><?php _e( 'Please vote this review.', 'tcd-w' ); ?></h5>
       <div class="vote_buttons clearfix">
        <span><?php echo wp_kses_post( $content['text_before_review_vote_button'] ); ?></span>
        <a class="vote_button vote_yes<?php if ( 'yes' === $voted ) echo ' active'; ?>" href="javascript:void(0);" data-review-id="<?php echo esc_attr( $review['unique_id'] ); ?>" data-vote="yes"><?php _e( 'Yes', 'tcd-w' ); ?></a>
        <a class="vote_button vote_no<?php if ( 'no' === $voted ) echo ' active'; ?>" href="javascript:void(0);" data-review-id="<?php echo esc_attr( $review['unique_id'] ); ?>" data-vote="no"><?php _e( 'No', 'tcd-w' ); ?></a>
       </div>
      </div>
      <?php endif; ?>
     </div>
     <?php endforeach; ?>
    </div><!-- END .item_list -->
    <?php endif; ?>

   </div><!-- END .cb_product_review -->

   <?php
        // フリースペース -----------------------------------------------------------------
        } elseif ( ($content['cb_content_select'] == 'free_space') && $content['show_content'] ) {
   ?>
   <div class="product_content cb_product_free clearfix content_link_target <?php if(!$content['show_border']) { echo 'no_border'; }; ?> num<?php echo esc_attr($key); ?>" id="product_content<?php echo esc_attr($key); ?>">

    <?php if(!empty($content['headline']) || !empty($content['sub_title'])) { ?>
    <div class="headline_area inview">
    <?php if(!empty($content['headline'])) { ?>
     <h3 class="top_headline rich_font_<?php echo esc_attr($content['headline_font_type']); ?>"><?php echo esc_html($content['headline']); ?></h3>
     <?php }; ?>
     <?php if(!empty($content['sub_title'])) { ?>
     <p class="top_sub_title"><?php echo esc_html($content['sub_title']); ?></p>
     <?php }; ?>
    </div>
    <?php }; ?>

    <?php if(!empty($content['desc'])) { ?>
    <div class="post_content clearfix">
     <?php echo apply_filters('the_content', $content['desc'] ); ?>
    </div>
    <?php }; ?>

   </div><!-- END .cb_product_free -->
   <?php
            };
          endforeach; // END 並び替え
        endif;
   ?>

   <?php endwhile; endif; ?>

   </div><!-- END #main_col -->

   <?php
        if($side_content_layout == 'type0'){
          if($options['single_product_layout'] != 'type3'){
            get_template_part('sidebar_product');
          };
        } else {
          if($side_content_layout != 'type3'){
            get_template_part('sidebar_product');
          };
        }
   ?>

 </div><!-- END #main_contents -->


 <?php
      // 関連商品 -------------------------------------------
      $product_category = wp_get_post_terms( $post->ID, 'product_category' , array( 'orderby' => 'term_order' ));
      $cat_id = '';
      if ( $product_category && ! is_wp_error($product_category) ) {
        foreach ( $product_category as $product_cat ) :
          $cat_id = $product_cat->term_id;
          break;
        endforeach;
      };
      if ( $product_category && ! is_wp_error($product_category) && $options['show_single_product_list'] ) {
 ?>
 <div id="related_product" style="background:<?php echo esc_attr($options['single_product_list_bg_color']); ?>">
  <h3 class="headline rich_font_<?php echo esc_attr($options['single_product_list_headline_font_type']); ?>"><?php echo esc_html($options['single_product_list_headline']); ?></h3>
  <?php
       if($cat_id){
         $post_num = $options['single_product_list_num'];
         $args = array( 'post_type' => 'product', 'post__not_in' => array($post->ID), 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'), 'posts_per_page' => $post_num, 'tax_query' => array( array( 'taxonomy' => 'product_category', 'field' => 'term_id', 'terms' => $cat_id ) ) );
         $post_list_query = new wp_query($args);
         if($post_list_query->have_posts()):
  ?>
  <div class="product_list clearfix">
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
   ?>
   <article class="item">
    <a class="animate_background" href="<?php the_permalink(); ?>">
     <?php if($image) { ?>
     <div class="image_wrap">
      <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
     </div>
     <?php }; ?>
     <h3 class="title rich_font_<?php echo esc_attr($options['single_product_list_title_font_type']); ?>" style="background:<?php echo esc_attr($main_color); ?>;"><span><?php the_title(); ?></span></h3>
     <div class="desc_area">
      <?php if($short_desc) { ?>
      <p class="desc"><span><?php echo esc_html($short_desc); ?></span></p>
      <?php }; ?>
     </div>
    </a>
   </article>
   <?php endwhile; ?>
  </div><!-- END .product_list -->
  <?php endif; }; ?>
 </div><!-- END #related_product -->
 <?php }; ?>

</div><!-- END #product_single -->

<?php get_footer(); ?>