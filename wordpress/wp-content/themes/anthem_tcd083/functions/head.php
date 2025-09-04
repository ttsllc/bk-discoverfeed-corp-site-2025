<?php
     function tcd_head() {
       $options = get_design_plus_option();
?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/design-plus.css?ver=<?php echo version_num(); ?>">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/sns-botton.css?ver=<?php echo version_num(); ?>">
<link rel="stylesheet" media="screen and (max-width:1251px)" href="<?php echo get_template_directory_uri(); ?>/css/responsive.css?ver=<?php echo version_num(); ?>">
<link rel="stylesheet" media="screen and (max-width:1251px)" href="<?php echo get_template_directory_uri(); ?>/css/footer-bar.css?ver=<?php echo version_num(); ?>">

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.4.js?ver=<?php echo version_num(); ?>"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jscript.js?ver=<?php echo version_num(); ?>"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/comment.js?ver=<?php echo version_num(); ?>"></script>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/simplebar.css?ver=<?php echo version_num(); ?>">
<script src="<?php echo get_template_directory_uri(); ?>/js/simplebar.min.js?ver=<?php echo version_num(); ?>"></script>

<?php if(is_mobile()) { ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/footer-bar.js?ver=<?php echo version_num(); ?>"></script>
<?php }; ?>

<?php
     if($options['header_fix'] != 'type1') {
?>
<script src="<?php echo get_template_directory_uri(); ?>/js/header_fix.js?ver=<?php echo version_num(); ?>"></script>
<?php }; ?>
<?php
     if($options['mobile_header_fix'] == 'type2') {
?>
<script src="<?php echo get_template_directory_uri(); ?>/js/header_fix_mobile.js?ver=<?php echo version_num(); ?>"></script>
<?php };  ?>

<?php
     // ヘッダーメッセージ
     if($options['show_header_message'] && $options['show_header_message_close']) {
?>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.cookie.min.js?ver=<?php echo version_num(); ?>"></script>
<script type="text/javascript">
jQuery(document).ready(function($){
  if ($.cookie('close_header_message') == 'on') {
    $('#header_message').hide();
  }
  $('#close_header_message').click(function() {
    $('#header_message').hide();
    $.cookie('close_header_message', 'on', {
      path:'/'
    });
  });
});
</script>
<?php }; ?>

<?php
     // Googleマップ
     if(is_page_template('page-access.php')) {
       global $post;
       $access_content = get_post_meta( $post->ID, 'access_content', true );
       if ( $access_content && is_array( $access_content ) ) :
         foreach( $access_content as $key => $content ) :
           if ( ($content['cb_content_select'] == 'access_map') && $content['show_content']) {
             if($options['basic_access_address']){
?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_attr( $options['basic_gmap_api_key'] ); ?>" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/pagebuilder/assets/js/googlemap.js?ver=<?php echo version_num(); ?>"></script>
<?php
             break;
             };
           };
         endforeach;
       endif;
     };
?>

<?php /* URLやモバイル等でcssが変わらないものをここで出力 */ ?>
<style type="text/css">
<?php
     // フォントタイプの設定　------------------------------------------------------------------
?>

<?php
     // 基本のフォントタイプ
     if($options['font_type'] == 'type1') {
?>
body, input, textarea { font-family: Arial, "Hiragino Kaku Gothic ProN", "ヒラギノ角ゴ ProN W3", "メイリオ", Meiryo, sans-serif; }
<?php } elseif($options['font_type'] == 'type2') { ?>
body, input, textarea { font-family: Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif; }
<?php } else { ?>
body, input, textarea { font-family: "Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif; }
<?php }; ?>

<?php
     // 見出しのフォントタイプ
     if($options['headline_font_type'] == 'type1') {
?>
.rich_font, .p-vertical { font-family: Arial, "Hiragino Kaku Gothic ProN", "ヒラギノ角ゴ ProN W3", "メイリオ", Meiryo, sans-serif; }
<?php } elseif($options['headline_font_type'] == 'type2') { ?>
.rich_font, .p-vertical { font-family: Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif; font-weight:500; }
<?php } else { ?>
.rich_font, .p-vertical { font-family: "Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif; font-weight:500; }
<?php }; ?>

.rich_font_type1 { font-family: Arial, "Hiragino Kaku Gothic ProN", "ヒラギノ角ゴ ProN W3", "メイリオ", Meiryo, sans-serif; }
.rich_font_type2 { font-family: Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif; font-weight:500; }
.rich_font_type3 { font-family: "Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif; font-weight:500; }

<?php
     // 本文のフォントタイプ
     if(is_single()) {
       if($options['content_font_type'] == 'type1') {
?>
.post_content, #next_prev_post { font-family: Arial, "Hiragino Kaku Gothic ProN", "ヒラギノ角ゴ ProN W3", "メイリオ", Meiryo, sans-serif; }
<?php } elseif($options['content_font_type'] == 'type2') { ?>
.post_content, #next_prev_post { font-family: Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif; }
<?php } else { ?>
.post_content, #next_prev_post { font-family: "Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif; }
<?php
     };
     // ウィジェットのフォントタイプ
     if($options['widget_headline_font_type'] == 'type1') {
?>
.widget_headline { font-family: Arial, "Hiragino Kaku Gothic ProN", "ヒラギノ角ゴ ProN W3", "メイリオ", Meiryo, sans-serif; }
<?php } elseif($options['widget_headline_font_type'] == 'type2') { ?>
.widget_headline { font-family: Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif; }
<?php } else { ?>
.widget_headline { font-family: "Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif; }
<?php }; }; ?>

<?php
     // ヘッダー -------------------------------------------------------------------------------
     $header_bg_color2_hex = hex2rgb($options['header_bg_color2']);
     $header_bg_color2_hex = implode(",",$header_bg_color2_hex);
?>
#header_top { color:<?php echo esc_html($options['header_font_color']); ?>; background:<?php echo esc_html($options['header_bg_color']); ?>; }
#header_top a, header_search .button label:before { color:<?php echo esc_html($options['header_font_color']); ?>; }
#header_bottom { color:<?php echo esc_html($options['header_font_color2']); ?>; background:<?php echo esc_html($options['header_bg_color2']); ?>; }
#header_bottom a { color:<?php echo esc_html($options['header_font_color2']); ?>; }
#header_top a:hover, #header_bottom a:hover, header_search .button label:hover:before { color:<?php echo esc_html($options['main_color']); ?>; }
#header_search .button label { background:<?php echo esc_html($options['header_bg_color']); ?>; }
.header_fix #header_bottom, .header_fix_mobile #header_bottom { background:rgba(<?php echo esc_attr($header_bg_color2_hex); ?>,<?php echo esc_html($options['header_bg_color2_opacity']); ?>); }
.header_fix #header.active #header_bottom, .header_fix_mobile #header.active #header_bottom{ background:rgba(<?php echo esc_attr($header_bg_color2_hex); ?>,1); }
<?php
     // グローバルメニュー
?>
#global_menu > ul > li > a, body.home #global_menu > ul > li.current-menu-item > a { color:<?php echo esc_html($options['header_font_color2']); ?>; }
#global_menu > ul > li.active > a, #global_menu > ul > li.active_button > a { color:<?php echo esc_html($options['main_color']); ?> !important; }
#global_menu ul ul a { color:<?php echo esc_html($options['global_menu_child_font_color']); ?>; background:<?php echo esc_html($options['global_menu_child_bg_color']); ?>; }
#global_menu ul ul a:hover { color:<?php echo esc_html($options['global_menu_child_font_color']); ?>; background:<?php echo esc_html($options['global_menu_child_bg_color_hover']); ?>; }
<?php
     // ドロワーメニュー
?>
#menu_button span { background:#000; }
#menu_button:hover span { background:<?php echo esc_html($options['main_color']); ?> !important; }
#drawer_menu { background:<?php echo esc_html($options['mobile_menu_bg_color']); ?>; }
#mobile_menu a, .mobile #lang_button a { color:<?php echo esc_html($options['mobile_menu_font_color']); ?>; background:<?php echo esc_html($options['mobile_menu_bg_color']); ?>; border-color:<?php echo esc_html($options['mobile_menu_border_color']); ?>; }
#mobile_menu li li a { color:<?php echo esc_html($options['mobile_menu_child_font_color']); ?>; background:<?php echo esc_html($options['mobile_menu_sub_menu_bg_color']); ?>; }
#mobile_menu a:hover, #drawer_menu .close_button:hover, #mobile_menu .child_menu_button:hover { color:<?php echo esc_html($options['mobile_menu_font_hover_color']); ?>; background:<?php echo esc_html($options['mobile_menu_bg_hover_color']); ?>; }
#mobile_menu li li a:hover { color:<?php echo esc_html($options['mobile_menu_child_font_hover_color']); ?>; }
<?php
     // 言語ボタン
?>
#lang_button_mobile { background:<?php echo esc_html($options['mobile_menu_bg_color']); ?>; }
#lang_button_mobile li { border-color:<?php echo esc_html($options['mobile_menu_border_color']); ?>; }
#lang_button_mobile li a { color:<?php echo esc_html($options['mobile_menu_font_color']); ?>; background:<?php echo esc_html($options['mobile_menu_bg_color']); ?>; border-color:<?php echo esc_html($options['mobile_menu_border_color']); ?>; }
#lang_button_mobile li a:hover { color:<?php echo esc_html($options['mobile_menu_font_hover_color']); ?>; background:<?php echo esc_html($options['mobile_menu_bg_hover_color']); ?>; }
#lang_mobile_button:hover:before, #lang_mobile_button.active:before { color:<?php echo esc_html($options['main_color']); ?>; }
<?php
     // 検索ボタン
?>
#header_search .input_area input, #footer_search { background:<?php echo esc_html($options['header_search_bg_color']); ?>; }
<?php
     // メガメニュー
?>
.megamenu_product_category_list { background:<?php echo esc_html($options['mega_menu_a_bg_color']); ?>; }
.megamenu_product_category_list .title { font-size:<?php echo esc_html($options['mega_menu_a_title_font_size']); ?>px; }
.megamenu_blog_list { background:<?php echo esc_html($options['mega_menu_b_bg_color']); ?>; }
.megamenu_blog_list .title { font-size:<?php echo esc_html($options['mega_menu_b_title_font_size']); ?>px; }
<?php
     // メッセージ -----------------------------------------------------------------------------------
     if($options['show_header_message'] && $options['header_message']) {
?>
#header_message { background:<?php echo esc_attr($options['header_message_bg_color']); ?>; color:<?php echo esc_attr($options['header_message_font_color']); ?>; font-size:<?php echo esc_attr($options['header_message_font_size']); ?>px; }
#close_header_message:before { color:<?php echo esc_attr($options['header_message_font_color']); ?>; }
#header_message a { color:<?php echo esc_attr($options['header_message_link_font_color']); ?>; }
#header_message a:hover { color:<?php echo esc_attr($options['main_color']); ?>; }
@media screen and (max-width:750px) {
  #header_message { font-size:<?php echo esc_attr($options['header_message_font_size_mobile']); ?>px; }
}
<?php
     };

     // フッター記事一覧 -----------------------------------------------------------------------------------
     if($options['show_footer_post_list']) {
?>
#footer_post_list_wrap { background:<?php echo esc_html($options['footer_post_list_bg_color']); ?>; }
#footer_post_list .title_area { background:<?php echo esc_html($options['footer_post_list_title_bg_color']); ?>; }
#footer_post_list .title { color:<?php echo esc_html($options['footer_post_list_title_font_color']); ?>; }
<?php
      };

     // フッターカルーセル -----------------------------------------------------------------------------------
     if($options['show_footer_carousel']) {
?>
#footer_carousel .headline { color:<?php echo esc_attr($options['footer_carousel_headline_font_color']); ?>; }
#footer_carousel_inner .title { font-size:<?php echo esc_attr($options['footer_carousel_title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  #footer_carousel_inner .title { font-size:<?php echo esc_attr($options['footer_carousel_title_font_size_mobile']); ?>px; }
}
<?php
     };
     // フッター -----------------------------------------------------------------------------------
?>
#return_top a:before { color:<?php echo esc_html($options['return_top_font_color']); ?>; }
#return_top a { background:<?php echo esc_html($options['return_top_bg_color']); ?>; }
#return_top a:hover { background:<?php echo esc_html($options['return_top_bg_color_hover']); ?>; }
<?php
     // サムネイルのアニメーション設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
     if($options['hover_type']!="type4"){

       // ズーム ------------------------------------------------------------------------------
       if($options['hover_type']=="type1"){
?>
.author_profile a.avatar img, .animate_image img, .animate_background .image, #recipe_archive .blur_image {
  width:100%; height:auto;
  -webkit-transition: transform  0.75s ease;
  transition: transform  0.75s ease;
}
.author_profile a.avatar:hover img, .animate_image:hover img, .animate_background:hover .image, #recipe_archive a:hover .blur_image {
  -webkit-transform: scale(<?php echo $options['hover1_zoom']; ?>);
  transform: scale(<?php echo $options['hover1_zoom']; ?>);
}


<?php
     // スライド ------------------------------------------------------------------------------
     } elseif($options['hover_type']=="type2"){
?>
.author_profile a.avatar, .animate_image, .animate_background, .animate_background .image_wrap {
  background: <?php echo $options['hover2_bgcolor']; ?>;
}
.animate_image img, .animate_background .image {
  -webkit-width:calc(100% + 30px) !important; width:calc(100% + 30px) !important; height:auto; max-width:inherit !important; position:relative;
  <?php if($options['hover2_direct']=='type1'): ?>
  -webkit-transform: translate(-15px, 0px); -webkit-transition-property: opacity, translateX; -webkit-transition: 0.5s;
  transform: translate(-15px, 0px); transition-property: opacity, translateX; transition: 0.5s;
  <?php else: ?>
  -webkit-transform: translate(-15px, 0px); -webkit-transition-property: opacity, translateX; -webkit-transition: 0.5s;
  transform: translate(-15px, 0px); transition-property: opacity, translateX; transition: 0.5s;
  <?php endif; ?>
}
.animate_image:hover img, .animate_background:hover .image {
  opacity:<?php echo $options['hover2_opacity']; ?>;
  <?php if($options['hover2_direct']=='type1'): ?>
  -webkit-transform: translate(0px, 0px);
  transform: translate(0px, 0px);
  <?php else: ?>
  -webkit-transform: translate(-30px, 0px);
  transform: translate(-30px, 0px);
  <?php endif; ?>
}
.animate_image.square img {
  -webkit-width:calc(100% + 30px) !important; width:calc(100% + 30px) !important; height:auto; max-width:inherit !important; position:relative;
  <?php if($options['hover2_direct']=='type1'): ?>
  -webkit-transform: translate(-15px, -15px); -webkit-transition-property: opacity, translateX; -webkit-transition: 0.5s;
  transform: translate(-15px, -15px); transition-property: opacity, translateX; transition: 0.5s;
  <?php else: ?>
  -webkit-transform: translate(-15px, -15px); -webkit-transition-property: opacity, translateX; -webkit-transition: 0.5s;
  transform: translate(-15px, -15px); transition-property: opacity, translateX; transition: 0.5s;
  <?php endif; ?>
}
.animate_image.square:hover img {
  opacity:<?php echo $options['hover2_opacity']; ?>;
  <?php if($options['hover2_direct']=='type1'): ?>
  -webkit-transform: translate(0px, -15px);
  transform: translate(0px, -15px);
  <?php else: ?>
  -webkit-transform: translate(-30px, -15px);
  transform: translate(-30px, -15px);
  <?php endif; ?>
}
<?php
     // フェードアウト ------------------------------------------------------------------------------
     } elseif($options['hover_type']=="type3"){
?>
.author_profile a.avatar, .animate_image, .animate_background, .animate_background .image_wrap {
  background: <?php echo $options['hover3_bgcolor']; ?>;
}
.author_profile a.avatar img, .animate_image img, .animate_background .image {
  -webkit-transition-property: opacity; -webkit-transition: 0.5s;
  transition-property: opacity; transition: 0.5s;
}
.author_profile a.avatar:hover img, .animate_image:hover img, .animate_background:hover .image {
  opacity: <?php echo $options['hover3_opacity']; ?>;
}
<?php }; }; // アニメーションここまで ?>

<?php
     // 色関連のスタイル　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

     // メインカラー ----------------------------------
     $main_color = esc_html($options['main_color']);
     $main_color_hex = hex2rgb($main_color);
     $main_color_hex = implode(",",$main_color_hex);
?>
a { color:#000; }

a:hover, #header_logo a:hover, #global_menu > ul > li.current-menu-item > a, .megamenu_blog_list a:hover .title, #footer a:hover, #footer_social_link li a:hover:before, #bread_crumb a:hover, #bread_crumb li.home a:hover:after, #bread_crumb, #bread_crumb li.last, #next_prev_post a:hover,
.index_post_slider .category a:hover, .index_post_slider .carousel_arrow:hover:before, .single_copy_title_url_btn:hover, #footer_post_list a:hover .title, #footer_carousel_inner a:hover .desc, .support_list .date, .support_list .question:hover, .support_list .question.active,
.widget_tab_post_list_button a.active, .p-dropdown__list li a:hover, .p-dropdown__title:hover, .p-dropdown__title:hover:after, .p-dropdown__title:hover:after, .p-dropdown__list li a:hover, .p-dropdown__list .child_menu_button:hover, .tcdw_search_box_widget .search_area .search_button:hover:before,
#blog_list .title a:hover, #post_title_area .category a:hover, #related_post .category a:hover, #blog_list li a:hover, #index_news a .date, #index_news_slider a:hover .title, .tcd_category_list a:hover, .tcd_category_list .child_menu_button:hover, .styled_post_list1 a:hover .title,
#post_title_area .post_meta a:hover, #single_author_title_area .author_link li a:hover:before, .author_profile a:hover, .author_profile .author_link li a:hover:before, #post_meta_bottom a:hover, .cardlink_title a:hover, .comment a:hover, .comment_form_wrapper a:hover, #searchform .submit_button:hover:before
  { color: <?php echo $main_color; ?>; }

.megamenu_product_category_list a:hover .title_area, #comment_tab li.active a, #submit_comment:hover, #cancel_comment_reply a:hover, #wp-calendar #prev a:hover, #wp-calendar #next a:hover, #wp-calendar td a:hover,
#post_pagination p, #post_pagination a:hover, #p_readmore .button:hover, .page_navi a:hover, .page_navi span.current, #post_pagination a:hover,.c-pw__btn:hover, #post_pagination a:hover, #comment_tab li a:hover,
#footer_post_list .category a, .post_slider_widget .slick-dots button:hover::before, .post_slider_widget .slick-dots .slick-active button::before, #header_slider .slick-dots button:hover::before, #header_slider .slick-dots .slick-active button::before,
.cb_product_review .vote_buttons a:hover, .cb_product_review .vote_buttons a.active
  { background-color: <?php echo $main_color; ?>; }

.megamenu_product_category_list a:hover .title_area, .megamenu_product_category_list .item:first-of-type a:hover .title_area, .index_post_slider .carousel_arrow:hover, .widget_headline, #comment_textarea textarea:focus, .c-pw__box-input:focus, .page_navi a:hover, .page_navi span.current, #post_pagination p, #post_pagination a:hover,
#header_slider .slick-dots button:hover::before, #header_slider .slick-dots .slick-active button::before, .cb_product_review .vote_buttons a:hover, .cb_product_review .vote_buttons a.active
  { border-color: <?php echo $main_color; ?>; }

#footer_post_list .category a:hover { background:rgba(<?php echo esc_attr($main_color_hex); ?>,0.7); }

<?php
     // その他のカラー ----------------------------------
?>
.widget_headline { background:<?php echo esc_html($options['widget_headline_bg_color']); ?>; }
.post_content a, .custom-html-widget a { color:<?php echo esc_html($options['content_link_color']); ?>; }
.post_content a:hover, .custom-html-widget a:hover { color:<?php echo esc_html($options['content_link_hover_color']); ?>; }
<?php
     // カスタムCSS --------------------------------------------
     if($options['css_code']) {
       echo wp_kses_post($options['css_code']);
     };

     // クイックタグ --------------------------------------------
     if ( $options['use_quicktags'] ) :

     // 見出し
?>
.styled_h2 {
  font-size:<?php echo esc_attr($options['qt_h2_font_size']); ?>px !important; text-align:<?php echo esc_attr($options['qt_h2_text_align']); ?>; color:<?php echo esc_attr($options['qt_h2_font_color']); ?>; <?php if($options['show_qt_h2_bg_color']) { ?>background:<?php echo esc_attr($options['qt_h2_bg_color']); ?>;<?php }; ?>
  border-top:<?php echo esc_attr($options['qt_h2_border_top_width']); ?>px solid <?php echo esc_attr($options['qt_h2_border_top_color']); ?>;
  border-bottom:<?php echo esc_attr($options['qt_h2_border_bottom_width']); ?>px solid <?php echo esc_attr($options['qt_h2_border_bottom_color']); ?>;
  border-left:<?php echo esc_attr($options['qt_h2_border_left_width']); ?>px solid <?php echo esc_attr($options['qt_h2_border_left_color']); ?>;
  border-right:<?php echo esc_attr($options['qt_h2_border_right_width']); ?>px solid <?php echo esc_attr($options['qt_h2_border_right_color']); ?>;
  padding:<?php echo esc_attr($options['qt_h2_padding_top']); ?>px <?php echo esc_attr($options['qt_h2_padding_right']); ?>px <?php echo esc_attr($options['qt_h2_padding_bottom']); ?>px <?php echo esc_attr($options['qt_h2_padding_left']); ?>px !important;
  margin:<?php echo esc_attr($options['qt_h2_margin_top']); ?>px 0px <?php echo esc_attr($options['qt_h2_margin_bottom']); ?>px !important;
}
.styled_h3 {
  font-size:<?php echo esc_attr($options['qt_h3_font_size']); ?>px !important; text-align:<?php echo esc_attr($options['qt_h3_text_align']); ?>; color:<?php echo esc_attr($options['qt_h3_font_color']); ?>; <?php if($options['show_qt_h3_bg_color']) { ?>background:<?php echo esc_attr($options['qt_h3_bg_color']); ?>;<?php }; ?>
  border-top:<?php echo esc_attr($options['qt_h3_border_top_width']); ?>px solid <?php echo esc_attr($options['qt_h3_border_top_color']); ?>;
  border-bottom:<?php echo esc_attr($options['qt_h3_border_bottom_width']); ?>px solid <?php echo esc_attr($options['qt_h3_border_bottom_color']); ?>;
  border-left:<?php echo esc_attr($options['qt_h3_border_left_width']); ?>px solid <?php echo esc_attr($options['qt_h3_border_left_color']); ?>;
  border-right:<?php echo esc_attr($options['qt_h3_border_right_width']); ?>px solid <?php echo esc_attr($options['qt_h3_border_right_color']); ?>;
  padding:<?php echo esc_attr($options['qt_h3_padding_top']); ?>px <?php echo esc_attr($options['qt_h3_padding_right']); ?>px <?php echo esc_attr($options['qt_h3_padding_bottom']); ?>px <?php echo esc_attr($options['qt_h3_padding_left']); ?>px !important;
  margin:<?php echo esc_attr($options['qt_h3_margin_top']); ?>px 0px <?php echo esc_attr($options['qt_h3_margin_bottom']); ?>px !important;
}
.styled_h4 {
  font-size:<?php echo esc_attr($options['qt_h4_font_size']); ?>px !important; text-align:<?php echo esc_attr($options['qt_h4_text_align']); ?>; color:<?php echo esc_attr($options['qt_h4_font_color']); ?>; <?php if($options['show_qt_h4_bg_color']) { ?>background:<?php echo esc_attr($options['qt_h4_bg_color']); ?>;<?php }; ?>
  border-top:<?php echo esc_attr($options['qt_h4_border_top_width']); ?>px solid <?php echo esc_attr($options['qt_h4_border_top_color']); ?>;
  border-bottom:<?php echo esc_attr($options['qt_h4_border_bottom_width']); ?>px solid <?php echo esc_attr($options['qt_h4_border_bottom_color']); ?>;
  border-left:<?php echo esc_attr($options['qt_h4_border_left_width']); ?>px solid <?php echo esc_attr($options['qt_h4_border_left_color']); ?>;
  border-right:<?php echo esc_attr($options['qt_h4_border_right_width']); ?>px solid <?php echo esc_attr($options['qt_h4_border_right_color']); ?>;
  padding:<?php echo esc_attr($options['qt_h4_padding_top']); ?>px <?php echo esc_attr($options['qt_h4_padding_right']); ?>px <?php echo esc_attr($options['qt_h4_padding_bottom']); ?>px <?php echo esc_attr($options['qt_h4_padding_left']); ?>px !important;
  margin:<?php echo esc_attr($options['qt_h4_margin_top']); ?>px 0px <?php echo esc_attr($options['qt_h4_margin_bottom']); ?>px !important;
}
.styled_h5 {
  font-size:<?php echo esc_attr($options['qt_h5_font_size']); ?>px !important; text-align:<?php echo esc_attr($options['qt_h5_text_align']); ?>; color:<?php echo esc_attr($options['qt_h5_font_color']); ?>; <?php if($options['show_qt_h5_bg_color']) { ?>background:<?php echo esc_attr($options['qt_h5_bg_color']); ?>;<?php }; ?>
  border-top:<?php echo esc_attr($options['qt_h5_border_top_width']); ?>px solid <?php echo esc_attr($options['qt_h5_border_top_color']); ?>;
  border-bottom:<?php echo esc_attr($options['qt_h5_border_bottom_width']); ?>px solid <?php echo esc_attr($options['qt_h5_border_bottom_color']); ?>;
  border-left:<?php echo esc_attr($options['qt_h5_border_left_width']); ?>px solid <?php echo esc_attr($options['qt_h5_border_left_color']); ?>;
  border-right:<?php echo esc_attr($options['qt_h5_border_right_width']); ?>px solid <?php echo esc_attr($options['qt_h5_border_right_color']); ?>;
  padding:<?php echo esc_attr($options['qt_h5_padding_top']); ?>px <?php echo esc_attr($options['qt_h5_padding_right']); ?>px <?php echo esc_attr($options['qt_h5_padding_bottom']); ?>px <?php echo esc_attr($options['qt_h5_padding_left']); ?>px !important;
  margin:<?php echo esc_attr($options['qt_h5_margin_top']); ?>px 0px <?php echo esc_attr($options['qt_h5_margin_bottom']); ?>px !important;
}
<?php
     // ボタン
     for ( $i = 1; $i <= 3; $i++ ) {
       $qt_custom_button_border_color = hex2rgb($options['qt_custom_button_border_color' . $i]);
       $qt_custom_button_border_color = implode(",",$qt_custom_button_border_color);
       $qt_custom_button_border_color_hover = hex2rgb($options['qt_custom_button_border_color_hover' . $i]);
       $qt_custom_button_border_color_hover = implode(",",$qt_custom_button_border_color_hover);
?>
.q_custom_button<?php echo $i; ?> {
  color:<?php echo esc_attr($options['qt_custom_button_font_color' . $i]); ?> !important;
  border-color:rgba(<?php echo esc_attr($qt_custom_button_border_color); ?>,<?php echo esc_attr($options['qt_custom_button_border_color_opacity' . $i]); ?>);
}
.q_custom_button<?php echo $i; ?>.animation_type1 { background:<?php echo esc_attr($options['qt_custom_button_bg_color' . $i]); ?>; }
.q_custom_button<?php echo $i; ?>:hover, .q_custom_button<?php echo $i; ?>:focus {
  color:<?php echo esc_attr($options['qt_custom_button_font_color_hover' . $i]); ?> !important;
  border-color:rgba(<?php echo esc_attr($qt_custom_button_border_color_hover); ?>,<?php echo esc_attr($options['qt_custom_button_border_color_hover_opacity' . $i]); ?>);
}
.q_custom_button<?php echo $i; ?>.animation_type1:hover { background:<?php echo esc_attr($options['qt_custom_button_bg_color_hover' . $i]); ?>; }
.q_custom_button<?php echo $i; ?>:before { background:<?php echo esc_attr($options['qt_custom_button_bg_color_hover' . $i]); ?>; }
<?php }; ?>
<?php
     // 吹き出し
?>
.speech_balloon_left1 .speach_balloon_text { background-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color1'] ); ?>; border-color: <?php echo esc_html( $options['qt_speech_balloon_border_color1'] ); ?>; color: <?php echo esc_html( $options['qt_speech_balloon_font_color1'] ); ?> }
.speech_balloon_left1 .speach_balloon_text::before { border-right-color: <?php echo esc_html( $options['qt_speech_balloon_border_color1'] ); ?> }
.speech_balloon_left1 .speach_balloon_text::after { border-right-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color1'] ); ?> }
.speech_balloon_left2 .speach_balloon_text { background-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color2'] ); ?>; border-color: <?php echo esc_html( $options['qt_speech_balloon_border_color2'] ); ?>; color: <?php echo esc_html( $options['qt_speech_balloon_font_color2'] ); ?> }
.speech_balloon_left2 .speach_balloon_text::before { border-right-color: <?php echo esc_html( $options['qt_speech_balloon_border_color2'] ); ?> }
.speech_balloon_left2 .speach_balloon_text::after { border-right-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color2'] ); ?> }
.speech_balloon_right1 .speach_balloon_text { background-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color3'] ); ?>; border-color: <?php echo esc_html( $options['qt_speech_balloon_border_color3'] ); ?>; color: <?php echo esc_html( $options['qt_speech_balloon_font_color3'] ); ?> }
.speech_balloon_right1 .speach_balloon_text::before { border-left-color: <?php echo esc_html( $options['qt_speech_balloon_border_color3'] ); ?> }
.speech_balloon_right1 .speach_balloon_text::after { border-left-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color3'] ); ?> }
.speech_balloon_right2 .speach_balloon_text { background-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color4'] ); ?>; border-color: <?php echo esc_html( $options['qt_speech_balloon_border_color4'] ); ?>; color: <?php echo esc_html( $options['qt_speech_balloon_font_color4'] ); ?> }
.speech_balloon_right2 .speach_balloon_text::before { border-left-color: <?php echo esc_html( $options['qt_speech_balloon_border_color4'] ); ?> }
.speech_balloon_right2 .speach_balloon_text::after { border-left-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color4'] ); ?> }
<?php
     endif;
     // Google map
?>
.qt_google_map .pb_googlemap_custom-overlay-inner { background:<?php echo esc_attr($options['qt_gmap_marker_bg']); ?>; color:<?php echo esc_attr($options['qt_gmap_marker_color']); ?>; }
.qt_google_map .pb_googlemap_custom-overlay-inner::after { border-color:<?php echo esc_attr($options['qt_gmap_marker_bg']); ?> transparent transparent transparent; }
</style>

<?php /* URLやモバイル等でcssが変わるものはここで出力 ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ */ ?>
<style id="current-page-style" type="text/css">
<?php
     // お知らせアーカイブページ -----------------------------------------------------------------------------
     if(is_post_type_archive('news')) {
?>
#news_archive .headline { font-size:<?php echo esc_attr($options['archive_news_headline_font_size']); ?>px; }
#news_list .title { font-size:<?php echo esc_attr($options['archive_news_title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  #news_archive .headline { font-size:<?php echo esc_attr($options['archive_news_headline_font_size_mobile']); ?>px; }
  #news_list .title { font-size:<?php echo esc_attr($options['archive_news_title_font_size_mobile']); ?>px; }
}
<?php
     // お知らせ詳細 -----------------------------------------------------------------------------
     } elseif(is_singular('news')) {
?>
#page_header .catch { font-size:<?php echo esc_attr($options['news_title_font_size']); ?>px; color:<?php echo esc_attr($options['news_title_font_color']); ?>; }
#page_header .desc { font-size:<?php echo esc_attr($options['news_desc_font_size']); ?>px; color:<?php echo esc_attr($options['news_desc_font_color']); ?>; }
#post_title_area .title { font-size:<?php echo esc_attr($options['single_news_title_font_size']); ?>px; }
#article .post_content { font-size:<?php echo esc_attr($options['single_news_content_font_size']); ?>px; }
#related_post .headline { font-size:<?php echo esc_attr($options['recent_news_headline_font_size']); ?>px; background:<?php echo esc_attr($options['recent_news_headline_bg_color']); ?>; }
#related_post .title { font-size:<?php echo esc_attr($options['recent_news_title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  #page_header .catch { font-size:<?php echo esc_attr($options['news_title_font_size']); ?>px; }
  #page_header .desc { font-size:<?php echo esc_attr($options['news_desc_font_size']); ?>px; }
  #post_title_area .title { font-size:<?php echo esc_attr($options['single_news_title_font_size_mobile']); ?>px; }
  #article .post_content { font-size:<?php echo esc_attr($options['single_news_content_font_size_mobile']); ?>px; }
  #related_post .headline { font-size:<?php echo esc_attr($options['recent_news_headline_font_size_mobile']); ?>px; }
  #related_post .title { font-size:<?php echo esc_attr($options['recent_news_title_font_size_mobile']); ?>px; }
}
<?php
     // サポートアーカイブページ -----------------------------------------------------------------------------
     } elseif(is_post_type_archive('support') ) {
?>
#page_header .catch { font-size:<?php echo esc_attr($options['support_title_font_size']); ?>px; color:<?php echo esc_attr($options['support_title_font_color']); ?>; }
#page_header .desc { font-size:<?php echo esc_attr($options['support_desc_font_size']); ?>px; color:<?php echo esc_attr($options['support_desc_font_color']); ?>; }
#header_category_button_wrap { background:<?php echo esc_attr($options['archive_support_category_bg_color']); ?>; }
#header_category_button a { font-size:<?php echo esc_attr($options['archive_support_category_font_size']); ?>px; color:<?php echo esc_attr($options['archive_support_category_font_color']); ?>; }
#header_category_button .slide_item { background:<?php echo esc_attr($options['archive_support_category_bg_color_active']); ?>; }
#support_archive .list_header .catch { font-size:<?php echo esc_attr($options['archive_support_catch_font_size']); ?>px; }
#support_archive .list_header .desc { font-size:<?php echo esc_attr($options['archive_support_desc_font_size']); ?>px; }
.support_list .question { font-size:<?php echo esc_attr($options['archive_support_title_font_size']); ?>px; }
.support_list .answer { background:<?php echo esc_attr($options['archive_support_answer_bg_color']); ?>; font-size:<?php echo esc_attr($options['archive_support_answer_font_size']); ?>px; }
@media screen and (max-width:1251px) {
  #header_category_button a { font-size:<?php echo esc_attr($options['archive_support_category_font_size_mobile']); ?>px; }
}
@media screen and (max-width:750px) {
  #page_header .catch { font-size:<?php echo esc_attr($options['support_title_font_size']); ?>px; }
  #page_header .desc { font-size:<?php echo esc_attr($options['support_desc_font_size']); ?>px; }
  #support_archive .list_header .catch { font-size:<?php echo esc_attr($options['archive_support_catch_font_size_mobile']); ?>px; }
  #support_archive .list_header .desc { font-size:<?php echo esc_attr($options['archive_support_desc_font_size_mobile']); ?>px; }
  .support_list .question { font-size:<?php echo esc_attr($options['archive_support_title_font_size_mobile']); ?>px; }
  .support_list .answer { font-size:<?php echo esc_attr($options['archive_support_answer_font_size_mobile']); ?>px; }
}
<?php
     // 商品アーカイブページ -----------------------------------------------------------------------------
     } elseif(is_post_type_archive('product') || is_tax('product_category') ) {
?>
#page_header .catch { font-size:<?php echo esc_attr($options['product_title_font_size']); ?>px; color:<?php echo esc_attr($options['product_title_font_color']); ?>; }
#page_header .desc { font-size:<?php echo esc_attr($options['product_desc_font_size']); ?>px; color:<?php echo esc_attr($options['product_desc_font_color']); ?>; }
#header_category_button_wrap { background:<?php echo esc_attr($options['archive_product_category_bg_color']); ?>; }
#header_category_button a { font-size:<?php echo esc_attr($options['archive_product_category_font_size']); ?>px; color:<?php echo esc_attr($options['archive_product_category_font_color']); ?>; }
#header_category_button .slide_item { background:<?php echo esc_attr($options['archive_product_category_bg_color_active']); ?>; }
.content_header .catch { font-size:<?php echo esc_attr($options['archive_product_catch_font_size']); ?>px; }
.content_header .desc { font-size:<?php echo esc_attr($options['archive_product_desc_font_size']); ?>px; }
#product_archive .product_list .title { font-size:<?php echo esc_attr($options['archive_product_title_font_size']); ?>px; }
#product_archive .product_list .desc { font-size:<?php echo esc_attr($options['archive_product_excerpt_font_size']); ?>px; }
@media screen and (max-width:1251px) {
  #header_category_button a { font-size:<?php echo esc_attr($options['archive_product_category_font_size_mobile']); ?>px; }
}
@media screen and (max-width:750px) {
  #page_header .catch { font-size:<?php echo esc_attr($options['product_title_font_size_mobile']); ?>px; }
  #page_header .desc { font-size:<?php echo esc_attr($options['product_desc_font_size_mobile']); ?>px; }
  .content_header .catch { font-size:<?php echo esc_attr($options['archive_product_catch_font_size_mobile']); ?>px; }
  .content_header .desc { font-size:<?php echo esc_attr($options['archive_product_desc_font_size_mobile']); ?>px; }
  #product_archive .product_list .title { font-size:<?php echo esc_attr($options['archive_product_title_font_size_mobile']); ?>px; }
  #product_archive .product_list .desc { font-size:<?php echo esc_attr($options['archive_product_excerpt_font_size_mobile']); ?>px; }
}
<?php
     // 商品詳細ページ -----------------------------------------------------------------------------
     } elseif(is_singular('product')) {
       global $post;
       $header_title_bg_color = hex2rgb($options['single_product_header_title_bg_color']);
       $header_title_bg_color = implode(",",$header_title_bg_color);
       $header_button_font_color = get_post_meta($post->ID, 'header_button_font_color', true) ?  get_post_meta($post->ID, 'header_button_font_color', true) : '#ffffff';
       $header_button_font_color_hover = get_post_meta($post->ID, 'header_button_font_color_hover', true) ?  get_post_meta($post->ID, 'header_button_font_color_hover', true) : '#ffffff';
       $header_button_border_color = get_post_meta($post->ID, 'header_button_border_color', true) ?  get_post_meta($post->ID, 'header_button_border_color', true) : '#ffffff';
       $header_button_border_color_opacity = get_post_meta($post->ID, 'header_button_border_color_opacity', true) ?  get_post_meta($post->ID, 'header_button_border_color_opacity', true) : '0.5';
       $header_button_border_color_hover = get_post_meta($post->ID, 'header_button_border_color_hover', true) ?  get_post_meta($post->ID, 'header_button_border_color_hover', true) : '#208a96';
       $header_button_border_color_hover_opacity = get_post_meta($post->ID, 'header_button_border_color_hover_opacity', true) ?  get_post_meta($post->ID, 'header_button_border_color_hover_opacity', true) : '0.5';
       $header_button_bg_color_hover = get_post_meta($post->ID, 'header_button_bg_color_hover', true) ?  get_post_meta($post->ID, 'header_button_bg_color_hover', true) : '#208a96';
       $header_button_border_color = hex2rgb($header_button_border_color);
       $header_button_border_color = implode(",",$header_button_border_color);
       $header_button_border_color_hover = hex2rgb($header_button_border_color_hover);
       $header_button_border_color_hover = implode(",",$header_button_border_color_hover);
       $main_color = get_post_meta($post->ID, 'main_color', true) ?  get_post_meta($post->ID, 'main_color', true) : '#008a98';
       $sub_color = get_post_meta($post->ID, 'sub_color', true) ?  get_post_meta($post->ID, 'sub_color', true) : '#006e7d';
       $content_link_font_color = get_post_meta($post->ID, 'content_link_font_color', true) ?  get_post_meta($post->ID, 'content_link_font_color', true) : '#ffffff';
       $side_button_list = get_post_meta($post->ID, 'side_button_list', true);
       if(get_post_meta($post->ID, 'image_blur', true) == 'no_blur'){
         $image_blur = "0";
       } else {
         $image_blur = get_post_meta($post->ID, 'image_blur', true) ?  get_post_meta($post->ID, 'image_blur', true) : '10';
       }
?>
#page_header .bg_image { filter:blur(<?php echo esc_attr($image_blur); ?>px); margin:-<?php echo esc_attr($image_blur*2); ?>px; width:calc(100% + <?php echo esc_attr($image_blur*4); ?>px); height:calc(100% + <?php echo esc_attr($image_blur*4); ?>px); }
#page_header .catch  { font-size:<?php echo esc_attr($options['single_product_header_catch_font_size']); ?>px; color:<?php echo esc_attr($options['single_product_header_catch_font_color']); ?>; }
#page_header .sub_title  { font-size:<?php echo esc_attr($options['single_product_header_sub_title_font_size']); ?>px; color:<?php echo esc_attr($options['single_product_header_sub_title_font_color']); ?>; }
#page_header .title  { font-size:<?php echo esc_attr($options['single_product_header_title_font_size']); ?>px; color:<?php echo esc_attr($options['single_product_header_title_font_color']); ?>; }
#page_header .title_area { background:rgba(<?php echo esc_attr($header_title_bg_color); ?>,<?php echo esc_attr($options['single_product_header_title_bg_color_opacity']); ?>); }
#page_header .link_button { color:<?php echo esc_attr($header_button_font_color); ?>; border-color:rgba(<?php echo esc_attr($header_button_border_color); ?>,<?php echo esc_attr($header_button_border_color_opacity); ?>); }
#page_header .link_button:before { background:<?php echo esc_attr($header_button_bg_color_hover); ?>; }
#page_header .link_button.button_animation_type1:hover { color:<?php echo esc_attr($header_button_font_color_hover); ?>; background:<?php echo esc_attr($header_button_bg_color_hover); ?>; border-color:rgba(<?php echo esc_attr($header_button_border_color_hover); ?>,<?php echo esc_attr($header_button_border_color_hover_opacity); ?>); }
#page_header .link_button.button_animation_type2:hover { color:<?php echo esc_attr($header_button_font_color_hover); ?>; background:none; border-color:rgba(<?php echo esc_attr($header_button_border_color_hover); ?>,<?php echo esc_attr($header_button_border_color_hover_opacity); ?>); }
#page_header .link_button.button_animation_type3:hover { color:<?php echo esc_attr($header_button_font_color_hover); ?>; background:none; border-color:rgba(<?php echo esc_attr($header_button_border_color_hover); ?>,<?php echo esc_attr($header_button_border_color_hover_opacity); ?>); }
#header_category_button_wrap { background:<?php echo esc_attr($main_color); ?>; }
#header_category_button a { font-size:<?php echo esc_attr($options['single_product_category_font_size']); ?>px; color:<?php echo esc_attr($content_link_font_color); ?>; }
#header_category_button .slide_item { background:<?php echo esc_attr($sub_color); ?>; }
.content_header .catch { font-size:<?php echo esc_attr($options['single_product_content_catch_font_size']); ?>px; }
.content_header .desc { font-size:<?php echo esc_attr($options['single_product_content_desc_font_size']); ?>px; }
.product_content .top_headline { font-size:<?php echo esc_attr($options['single_product_content_catch_font_size']); ?>px; }
.product_content .top_sub_title { font-size:<?php echo esc_attr($options['single_product_content_desc_font_size']); ?>px; }
#product_side_content { background:<?php echo esc_attr($options['show_side_product_background_color']); ?>; }
#product_side_content .top_area .category { color:<?php echo esc_attr($options['side_product_button_font_color']); ?>; background:<?php echo esc_attr($options['side_product_button_bg_color']); ?>; border-color:<?php echo esc_attr($options['side_product_button_border_color']); ?>; }
#product_side_content .top_area .category:hover { color:<?php echo esc_attr($options['side_product_button_font_color_hover']); ?>; background:<?php echo esc_attr($options['side_product_button_bg_color_hover']); ?>; border-color:<?php echo esc_attr($options['side_product_button_border_color_hover']); ?>; }
#product_side_content .top_area .catch { font-size:<?php echo esc_attr($options['side_product_catch_font_size']); ?>px; }
#product_side_content .desc { font-size:<?php echo esc_attr($options['side_product_desc_font_size']); ?>px; }
#product_side_content .bottom_area .price_label { font-size:<?php echo esc_attr($options['side_product_price_label_font_size']); ?>px; }
#product_side_content .bottom_area .price { font-size:<?php echo esc_attr($options['side_product_price_font_size']); ?>px; }
<?php
     if(!empty($side_button_list)) {
       foreach ( $side_button_list as $key => $value ) :
         $font_color = isset($value['font_color']) ?  $value['font_color'] : '#ffffff';
         $background_color = isset($value['background_color']) ?  $value['background_color'] : '#008a98';
         $border_color = isset($value['border_color']) ?  $value['border_color'] : '#008a98';
         $border_color_opacity = isset($value['border_color_opacity']) ?  $value['border_color_opacity'] : '1';
         $font_color_hover = isset($value['font_color_hover']) ?  $value['font_color_hover'] : '#ffffff';
         $background_color_hover = isset($value['background_color_hover']) ?  $value['background_color_hover'] : '#006e7d';
         $border_color_hover = isset($value['border_color_hover']) ?  $value['border_color_hover'] : '#006e7d';
         $border_color_hover_opacity = isset($value['border_color_hover_opacity']) ?  $value['border_color_hover_opacity'] : '1';
         $border_color = hex2rgb($border_color);
         $border_color = implode(",",$border_color);
         $border_color_hover = hex2rgb($border_color_hover);
         $border_color_hover = implode(",",$border_color_hover);
?>
#product_side_content .button_list li.num<?php echo $key; ?> a:before { background:<?php echo esc_attr($background_color_hover); ?>; }
#product_side_content .button_list li.num<?php echo $key; ?> a { color:<?php echo esc_html($font_color); ?>; border-color:rgba(<?php echo esc_attr($border_color); ?>,<?php echo esc_attr($border_color_opacity); ?>); }
#product_side_content .button_list li.num<?php echo $key; ?> a.button_animation_type1 { background:<?php echo esc_html($background_color); ?>; }
#product_side_content .button_list li.num<?php echo $key; ?> a.button_animation_type1:hover { color:<?php echo esc_attr($font_color_hover); ?>; background:<?php echo esc_attr($background_color_hover); ?>; border-color:rgba(<?php echo esc_attr($border_color_hover); ?>,<?php echo esc_attr($border_color_hover_opacity); ?>); }
#product_side_content .button_list li.num<?php echo $key; ?> a.button_animation_type2:hover { color:<?php echo esc_attr($font_color_hover); ?>; border-color:rgba(<?php echo esc_attr($border_color_hover); ?>,<?php echo esc_attr($border_color_hover_opacity); ?>); }
#product_side_content .button_list li.num<?php echo $key; ?> a.button_animation_type3:hover { color:<?php echo esc_attr($font_color_hover); ?>; border-color:rgba(<?php echo esc_attr($border_color_hover); ?>,<?php echo esc_attr($border_color_hover_opacity); ?>); }
<?php
       endforeach;
     };
?>
#related_product .headline { font-size:<?php echo esc_attr($options['single_product_list_headline_font_size']); ?>px; }
#related_product .product_list .title { font-size:<?php echo esc_attr($options['single_product_list_title_font_size']); ?>px; }
#related_product .product_list .desc { font-size:<?php echo esc_attr($options['single_product_list_excerpt_font_size']); ?>px; }
@media screen and (max-width:1251px) {
  #page_header .title  { font-size:<?php echo esc_attr($options['single_product_header_title_font_size_mobile']); ?>px; }
  #header_category_button a { font-size:<?php echo esc_attr($options['single_product_category_font_size_mobile']); ?>px; }
}
@media screen and (max-width:750px) {
  #page_header .catch  { font-size:<?php echo esc_attr($options['single_product_header_catch_font_size_mobile']); ?>px; }
  #page_header .sub_title  { font-size:<?php echo esc_attr($options['single_product_header_sub_title_font_size_mobile']); ?>px; }
  .content_header .catch { font-size:<?php echo esc_attr($options['single_product_content_catch_font_size_mobile']); ?>px; }
  .content_header .desc { font-size:<?php echo esc_attr($options['single_product_content_desc_font_size_mobile']); ?>px; }
  .product_content .top_headline { font-size:<?php echo esc_attr($options['single_product_content_catch_font_size_mobile']); ?>px; }
  .product_content .top_sub_title { font-size:<?php echo esc_attr($options['single_product_content_desc_font_size_mobile']); ?>px; }
  #product_side_content .top_area .catch { font-size:<?php echo esc_attr($options['side_product_catch_font_size_mobile']); ?>px; }
  #product_side_content .desc { font-size:<?php echo esc_attr($options['side_product_desc_font_size_mobile']); ?>px; }
  #product_side_content .bottom_area .price_label { font-size:<?php echo esc_attr($options['side_product_price_label_font_size_mobile']); ?>px; }
  #product_side_content .bottom_area .price { font-size:<?php echo esc_attr($options['side_product_price_font_size_mobile']); ?>px; }
  #related_product .headline { font-size:<?php echo esc_attr($options['single_product_list_headline_font_size_mobile']); ?>px; }
  #related_product .product_list .title { font-size:<?php echo esc_attr($options['single_product_list_title_font_size_mobile']); ?>px; }
  #related_product .product_list .desc { font-size:<?php echo esc_attr($options['single_product_list_excerpt_font_size_mobile']); ?>px; }
}
<?php
       $product_cf = get_post_meta( $post->ID, 'product_cf', true );
       if ( $product_cf && is_array( $product_cf ) ) :
         foreach( $product_cf as $key => $content ) :
           // 特徴一覧 -----------------------------------------------------------------
           if ( ($content['cb_content_select'] == 'featured_list') && $content['show_content'] ) {
             $headline_font_size = $content['headline_font_size'] ? esc_html( $content['headline_font_size'] ) : '26';
             $headline_font_size_mobile = $content['headline_font_size_mobile'] ? esc_html( $content['headline_font_size_mobile'] ) : '20';
             $sub_title_font_size = $content['sub_title_font_size'] ? esc_html( $content['sub_title_font_size'] ) : '12';
             $sub_title_font_size_mobile = $content['sub_title_font_size_mobile'] ? esc_html( $content['sub_title_font_size_mobile'] ) : '11';
             $list_font_size = $content['list_font_size'] ? esc_html( $content['list_font_size'] ) : '14';
             $list_font_size_mobile = $content['list_font_size_mobile'] ? esc_html( $content['list_font_size_mobile'] ) : '12';
?>
.cb_featured_list.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo $headline_font_size; ?>px; }
.cb_featured_list.num<?php echo esc_attr($key); ?> .top_sub_title { font-size:<?php echo $sub_title_font_size; ?>px; }
.cb_featured_list.num<?php echo esc_attr($key); ?> .item .desc { font-size:<?php echo $list_font_size; ?>px; }
@media screen and (max-width:750px) {
  .cb_featured_list.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo $headline_font_size_mobile; ?>px; }
  .cb_featured_list.num<?php echo esc_attr($key); ?> .top_sub_title { font-size:<?php echo $sub_title_font_size_mobile; ?>px; }
  .cb_featured_list.num<?php echo esc_attr($key); ?> .item .desc { font-size:<?php echo $list_font_size_mobile; ?>px; }
}
<?php
           // レビュー -----------------------------------------------------------------
           } elseif ( ($content['cb_content_select'] == 'review') && $content['show_content'] ) {
             $headline_font_size = $content['headline_font_size'] ? esc_html( $content['headline_font_size'] ) : '26';
             $headline_font_size_mobile = $content['headline_font_size_mobile'] ? esc_html( $content['headline_font_size_mobile'] ) : '20';
             $sub_title_font_size = $content['sub_title_font_size'] ? esc_html( $content['sub_title_font_size'] ) : '12';
             $sub_title_font_size_mobile = $content['sub_title_font_size_mobile'] ? esc_html( $content['sub_title_font_size_mobile'] ) : '11';
             $list_font_size = $content['list_font_size'] ? esc_html( $content['list_font_size'] ) : '16';
             $list_font_size_mobile = $content['list_font_size_mobile'] ? esc_html( $content['list_font_size_mobile'] ) : '14';
?>
.cb_product_review.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo $headline_font_size; ?>px; }
.cb_product_review.num<?php echo esc_attr($key); ?> .top_sub_title { font-size:<?php echo $sub_title_font_size; ?>px; }
.cb_product_review.num<?php echo esc_attr($key); ?> .item { font-size:<?php echo $list_font_size; ?>px; }
@media screen and (max-width:750px) {
  .cb_product_review.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo $headline_font_size_mobile; ?>px; }
  .cb_product_review.num<?php echo esc_attr($key); ?> .top_sub_title { font-size:<?php echo $sub_title_font_size_mobile; ?>px; }
  .cb_product_review.num<?php echo esc_attr($key); ?> .item { font-size:<?php echo $list_font_size_mobile; ?>px; }
}
<?php
           // フリースペース -----------------------------------------------------------------
           } elseif ( ($content['cb_content_select'] == 'free_space') && $content['show_content'] ) {
             $headline_font_size = $content['headline_font_size'] ? esc_html( $content['headline_font_size'] ) : '26';
             $headline_font_size_mobile = $content['headline_font_size_mobile'] ? esc_html( $content['headline_font_size_mobile'] ) : '20';
             $sub_title_font_size = $content['sub_title_font_size'] ? esc_html( $content['sub_title_font_size'] ) : '12';
             $sub_title_font_size_mobile = $content['sub_title_font_size_mobile'] ? esc_html( $content['sub_title_font_size_mobile'] ) : '11';
             $desc_font_size = $content['desc_font_size'] ? esc_html( $content['desc_font_size'] ) : '16';
             $desc_font_size_mobile = $content['desc_font_size_mobile'] ? esc_html( $content['desc_font_size_mobile'] ) : '14';
?>
.cb_product_free.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo $headline_font_size; ?>px; }
.cb_product_free.num<?php echo esc_attr($key); ?> .top_sub_title { font-size:<?php echo $sub_title_font_size; ?>px; }
.cb_product_free.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo $desc_font_size; ?>px; }
@media screen and (max-width:750px) {
  .cb_product_free.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo $headline_font_size_mobile; ?>px; }
  .cb_product_free.num<?php echo esc_attr($key); ?> .top_sub_title { font-size:<?php echo $sub_title_font_size_mobile; ?>px; }
  .cb_product_free.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo $desc_font_size_mobile; ?>px; }
}
<?php
           };
         endforeach;
       endif;

     // トップページ -----------------------------------------------------------------------------
     } elseif(is_front_page()) {

       // ヘッダーコンテンツ
       $index_slider = '';
       $display_header_content = '';

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
         $i = 1;
         foreach ( $index_slider as $key => $value ) :
           if(is_mobile() && ($options['mobile_show_index_slider'] == 'type1')) {
             $catch_font_size_mobile = $value['catch_font_size'];
             $desc_font_size_mobile = $value['desc_font_size'];
           } else {
             $catch_font_size_mobile = $value['catch_font_size_mobile'];
             $desc_font_size_mobile = $value['desc_font_size_mobile'];
           }
           $button_border_color = hex2rgb($value['button_border_color']);
           $button_border_color = implode(",",$button_border_color);
           $button_border_color_hover = hex2rgb($value['button_border_color_hover']);
           $button_border_color_hover = implode(",",$button_border_color_hover);
?>
#header_slider .item<?php echo $i; ?> .catch { font-size:<?php echo esc_attr($value['catch_font_size']); ?>px; color:<?php echo esc_attr($value['catch_font_color']); ?>; <?php if($value['use_catch_shadow']) { ?>text-shadow:<?php echo esc_attr($value['catch_shadow_a']); ?>px <?php echo esc_attr($value['catch_shadow_b']); ?>px <?php echo esc_attr($value['catch_shadow_c']); ?>px <?php echo esc_attr($value['catch_shadow_color']); ?>;<?php }; ?> }
#header_slider .item<?php echo $i; ?> .desc p { font-size:<?php echo esc_attr($value['desc_font_size']); ?>px; color:<?php echo esc_attr($value['desc_font_color']); ?>; <?php if($value['use_catch_shadow']) { ?>text-shadow:<?php echo esc_attr($value['catch_shadow_a']); ?>px <?php echo esc_attr($value['catch_shadow_b']); ?>px <?php echo esc_attr($value['catch_shadow_c']); ?>px <?php echo esc_attr($value['catch_shadow_color']); ?>;<?php }; ?> }
#header_slider .item<?php echo $i; ?> .button { color:<?php echo esc_attr($value['button_font_color']); ?>; border-color:rgba(<?php echo esc_attr($button_border_color); ?>,<?php echo esc_attr($value['button_border_color_opacity']); ?>); }
#header_slider .item<?php echo $i; ?> .button:before { background:<?php echo esc_attr($value['button_bg_color_hover']); ?>; }
#header_slider .item<?php echo $i; ?> .button.button_animation_type1:hover { color:<?php echo esc_attr($value['button_font_color_hover']); ?>; background:<?php echo esc_attr($value['button_bg_color_hover']); ?>; border-color:rgba(<?php echo esc_attr($button_border_color_hover); ?>,<?php echo esc_attr($value['button_border_color_opacity_hover']); ?>); }
#header_slider .item<?php echo $i; ?> .button.button_animation_type2:hover { color:<?php echo esc_attr($value['button_font_color_hover']); ?>; background:none; border-color:rgba(<?php echo esc_attr($button_border_color_hover); ?>,<?php echo esc_attr($value['button_border_color_opacity_hover']); ?>); }
#header_slider .item<?php echo $i; ?> .button.button_animation_type3:hover { color:<?php echo esc_attr($value['button_font_color_hover']); ?>; background:none; border-color:rgba(<?php echo esc_attr($button_border_color_hover); ?>,<?php echo esc_attr($value['button_border_color_opacity_hover']); ?>); }
@media screen and (max-width:750px) {
  #header_slider .item<?php echo $i; ?> .catch { font-size:<?php echo esc_attr($catch_font_size_mobile); ?>px; }
  #header_slider .item<?php echo $i; ?> .desc p { font-size:<?php echo esc_attr($desc_font_size_mobile); ?>px; }
}
<?php
         $i++;
         endforeach;
       };

       // トップページ　コンテンツビルダー -------------------------------------------------------------------------------------------------------------
       if ($options['contents_builder'] || $options['mobile_contents_builder']) :
         $content_count = 1;
         if(is_mobile() && $options['mobile_show_contents_builder']) {
           $contents_builder = $options['mobile_contents_builder'];
         } else {
           $contents_builder = $options['contents_builder'];
         }
         foreach($contents_builder as $content) :

           // レイヤー画像コンテンツ
           if ( $content['cb_content_select'] == 'layer_content' && $content['show_content'] ) {
             if(is_mobile() && $options['mobile_show_contents_builder']) {
               $catch_font_size_mobile = $content['catch_font_size'];
               $desc_font_size_mobile = $content['desc_font_size'];
             } else {
               $catch_font_size_mobile = $content['catch_font_size_mobile'];
               $desc_font_size_mobile = $content['desc_font_size_mobile'];
             }
             $button_border_color = hex2rgb($content['button_border_color']);
             $button_border_color = implode(",",$button_border_color);
             $button_border_color_hover = hex2rgb($content['button_border_color_hover']);
             $button_border_color_hover = implode(",",$button_border_color_hover);
?>
.index_layer_content.num<?php echo $content_count; ?> .catch { font-size:<?php echo esc_html($content['catch_font_size']); ?>px; color:<?php echo esc_html($content['catch_font_color']); ?>; }
.index_layer_content.num<?php echo $content_count; ?> .desc { font-size:<?php echo esc_html($content['desc_font_size']); ?>px; color:<?php echo esc_html($content['desc_font_color']); ?>; }
.index_layer_content.num<?php echo $content_count; ?> .link_button a:before { background:<?php echo esc_attr($content['button_bg_color_hover']); ?>; }
.index_layer_content.num<?php echo $content_count; ?> .link_button a { color:<?php echo esc_html($content['button_font_color']); ?>; border-color:rgba(<?php echo esc_attr($button_border_color); ?>,<?php echo esc_attr($content['button_border_color_opacity']); ?>); }
.index_layer_content.num<?php echo $content_count; ?> .link_button a.button_animation_type1 { background:<?php echo esc_html($content['button_bg_color']); ?>; }
.index_layer_content.num<?php echo $content_count; ?> .link_button a.button_animation_type1:hover { color:<?php echo esc_attr($content['button_font_color_hover']); ?>; background:<?php echo esc_attr($content['button_bg_color_hover']); ?>; border-color:rgba(<?php echo esc_attr($button_border_color_hover); ?>,<?php echo esc_attr($content['button_border_color_hover_opacity']); ?>); }
.index_layer_content.num<?php echo $content_count; ?> .link_button a.button_animation_type2:hover { color:<?php echo esc_attr($content['button_font_color_hover']); ?>; border-color:rgba(<?php echo esc_attr($button_border_color_hover); ?>,<?php echo esc_attr($content['button_border_color_hover_opacity']); ?>); }
.index_layer_content.num<?php echo $content_count; ?> .link_button a.button_animation_type3:hover { color:<?php echo esc_attr($content['button_font_color_hover']); ?>; border-color:rgba(<?php echo esc_attr($button_border_color_hover); ?>,<?php echo esc_attr($content['button_border_color_hover_opacity']); ?>); }
@media screen and (max-width:750px) {
  .index_layer_content.num<?php echo $content_count; ?> .catch { font-size:<?php echo esc_html($catch_font_size_mobile); ?>px; }
  .index_layer_content.num<?php echo $content_count; ?> .desc { font-size:<?php echo esc_html($desc_font_size_mobile); ?>px; }
}
<?php
     // 商品一覧
     } elseif ( $content['cb_content_select'] == 'product_list' && $content['show_content'] ) {
       if(is_mobile() && $options['mobile_show_contents_builder']) {
         $catch_font_size_mobile = $content['catch_font_size'];
         $desc_font_size_mobile = $content['desc_font_size'];
         $title_font_size_mobile = $content['title_font_size'];
         $excerpt_font_size_mobile = $content['excerpt_font_size'];
       } else {
         $catch_font_size_mobile = $content['catch_font_size_mobile'];
         $desc_font_size_mobile = $content['desc_font_size_mobile'];
         $title_font_size_mobile = $content['title_font_size_mobile'];
         $excerpt_font_size_mobile = $content['excerpt_font_size_mobile'];
       }
       $button_border_color = hex2rgb($content['button_border_color']);
       $button_border_color = implode(",",$button_border_color);
       $button_border_color_hover = hex2rgb($content['button_border_color_hover']);
       $button_border_color_hover = implode(",",$button_border_color_hover);
?>
.index_product_list.num<?php echo $content_count; ?> .cb_catch { font-size:<?php echo esc_html($content['catch_font_size']); ?>px; }
.index_product_list.num<?php echo $content_count; ?> .cb_desc { font-size:<?php echo esc_html($content['desc_font_size']); ?>px; }
.index_product_list.num<?php echo $content_count; ?> .item .title { font-size:<?php echo esc_html($content['title_font_size']); ?>px; }
.index_product_list.num<?php echo $content_count; ?> .item .desc { font-size:<?php echo esc_html($content['excerpt_font_size']); ?>px; }
.index_product_list.num<?php echo $content_count; ?> .link_button a:before { background:<?php echo esc_attr($content['button_bg_color_hover']); ?>; }
.index_product_list.num<?php echo $content_count; ?> .link_button a { color:<?php echo esc_html($content['button_font_color']); ?>; border-color:rgba(<?php echo esc_attr($button_border_color); ?>,<?php echo esc_attr($content['button_border_color_opacity']); ?>); }
.index_product_list.num<?php echo $content_count; ?> .link_button a.button_animation_type1 { background:<?php echo esc_html($content['button_bg_color']); ?>; }
.index_product_list.num<?php echo $content_count; ?> .link_button a.button_animation_type1:hover { color:<?php echo esc_attr($content['button_font_color_hover']); ?>; background:<?php echo esc_attr($content['button_bg_color_hover']); ?>; border-color:rgba(<?php echo esc_attr($button_border_color_hover); ?>,<?php echo esc_attr($content['button_border_color_hover_opacity']); ?>); }
.index_product_list.num<?php echo $content_count; ?> .link_button a.button_animation_type2:hover { color:<?php echo esc_attr($content['button_font_color_hover']); ?>; border-color:rgba(<?php echo esc_attr($button_border_color_hover); ?>,<?php echo esc_attr($content['button_border_color_hover_opacity']); ?>); }
.index_product_list.num<?php echo $content_count; ?> .link_button a.button_animation_type3:hover { color:<?php echo esc_attr($content['button_font_color_hover']); ?>; border-color:rgba(<?php echo esc_attr($button_border_color_hover); ?>,<?php echo esc_attr($content['button_border_color_hover_opacity']); ?>); }
@media screen and (max-width:750px) {
  .index_product_list.num<?php echo $content_count; ?> .cb_catch { font-size:<?php echo esc_html($catch_font_size_mobile); ?>px; }
  .index_product_list.num<?php echo $content_count; ?> .cb_desc { font-size:<?php echo esc_html($desc_font_size_mobile); ?>px; }
  .index_product_list.num<?php echo $content_count; ?> .item .title { font-size:<?php echo esc_html($title_font_size_mobile); ?>px; }
  .index_product_list.num<?php echo $content_count; ?> .item .desc { font-size:<?php echo esc_html($excerpt_font_size_mobile); ?>px; }
}
<?php
     // 記事スライダー
     } elseif ( $content['cb_content_select'] == 'post_slider' && $content['show_content'] ) {
       if(is_mobile() && $options['mobile_show_contents_builder']) {
         $catch_font_size_mobile = $content['catch_font_size'];
         $desc_font_size_mobile = $content['desc_font_size'];
         $title_font_size_mobile = $content['title_font_size'];
         $excerpt_font_size_mobile = $content['excerpt_font_size'];
       } else {
         $catch_font_size_mobile = $content['catch_font_size_mobile'];
         $desc_font_size_mobile = $content['desc_font_size_mobile'];
         $title_font_size_mobile = $content['title_font_size_mobile'];
         $excerpt_font_size_mobile = $content['excerpt_font_size_mobile'];
       }
       $button_border_color = hex2rgb($content['button_border_color']);
       $button_border_color = implode(",",$button_border_color);
       $button_border_color_hover = hex2rgb($content['button_border_color_hover']);
       $button_border_color_hover = implode(",",$button_border_color_hover);
?>
.index_post_slider.num<?php echo $content_count; ?> .cb_catch { font-size:<?php echo esc_html($content['catch_font_size']); ?>px; }
.index_post_slider.num<?php echo $content_count; ?> .cb_desc { font-size:<?php echo esc_html($content['desc_font_size']); ?>px; }
.index_post_slider.num<?php echo $content_count; ?> .item .title { font-size:<?php echo esc_html($content['title_font_size']); ?>px; }
.index_post_slider.num<?php echo $content_count; ?> .item .title a { color:<?php echo esc_html($content['title_font_color']); ?>; }
.index_post_slider.num<?php echo $content_count; ?> .item .title a:hover { color:<?php echo esc_html($options['main_color']); ?>; }
.index_post_slider.num<?php echo $content_count; ?> .item .desc { font-size:<?php echo esc_html($content['excerpt_font_size']); ?>px; }
.index_post_slider.num<?php echo $content_count; ?> .link_button a:before { background:<?php echo esc_attr($content['button_bg_color_hover']); ?>; }
.index_post_slider.num<?php echo $content_count; ?> .link_button a { color:<?php echo esc_html($content['button_font_color']); ?>; border-color:rgba(<?php echo esc_attr($button_border_color); ?>,<?php echo esc_attr($content['button_border_color_opacity']); ?>); }
.index_post_slider.num<?php echo $content_count; ?> .link_button a.button_animation_type1 { background:<?php echo esc_html($content['button_bg_color']); ?>; }
.index_post_slider.num<?php echo $content_count; ?> .link_button a.button_animation_type1:hover { color:<?php echo esc_attr($content['button_font_color_hover']); ?>; background:<?php echo esc_attr($content['button_bg_color_hover']); ?>; border-color:rgba(<?php echo esc_attr($button_border_color_hover); ?>,<?php echo esc_attr($content['button_border_color_hover_opacity']); ?>); }
.index_post_slider.num<?php echo $content_count; ?> .link_button a.button_animation_type2:hover { color:<?php echo esc_attr($content['button_font_color_hover']); ?>; border-color:rgba(<?php echo esc_attr($button_border_color_hover); ?>,<?php echo esc_attr($content['button_border_color_hover_opacity']); ?>); }
.index_post_slider.num<?php echo $content_count; ?> .link_button a.button_animation_type3:hover { color:<?php echo esc_attr($content['button_font_color_hover']); ?>; border-color:rgba(<?php echo esc_attr($button_border_color_hover); ?>,<?php echo esc_attr($content['button_border_color_hover_opacity']); ?>); }
@media screen and (max-width:750px) {
  .index_post_slider.num<?php echo $content_count; ?> .cb_catch { font-size:<?php echo esc_html($catch_font_size_mobile); ?>px; }
  .index_post_slider.num<?php echo $content_count; ?> .cb_desc { font-size:<?php echo esc_html($desc_font_size_mobile); ?>px; }
  .index_post_slider.num<?php echo $content_count; ?> .item .title { font-size:<?php echo esc_html($title_font_size_mobile); ?>px; }
  .index_post_slider.num<?php echo $content_count; ?> .item .desc { font-size:<?php echo esc_html($excerpt_font_size_mobile); ?>px; }
}
<?php
     // フリースペース
     } elseif ( $content['cb_content_select'] == 'free_space' && $content['show_content'] ) {
       if(is_mobile() && $options['mobile_show_contents_builder']) {
         $padding_top_mobile = $content['padding_top'];
         $padding_bottom_mobile = $content['padding_bottom'];
         $catch_font_size_mobile = $content['catch_font_size'];
         $desc_font_size_mobile = $content['desc_font_size'];
       } else {
         $padding_top_mobile = $content['padding_top_mobile'];
         $padding_bottom_mobile = $content['padding_bottom_mobile'];
         $catch_font_size_mobile = $content['catch_font_size_mobile'];
         $desc_font_size_mobile = $content['desc_font_size_mobile'];
       }
?>
.index_free_space.num<?php echo $content_count; ?> .cb_catch { font-size:<?php echo esc_html($content['catch_font_size']); ?>px; }
.index_free_space.num<?php echo $content_count; ?> { font-size:<?php echo esc_html($content['desc_font_size']); ?>px; margin-top:<?php echo esc_html($content['padding_top']); ?>px; margin-bottom:<?php echo esc_html($content['padding_bottom']); ?>px; }
@media screen and (max-width:750px) {
  .index_free_space.num<?php echo $content_count; ?> .cb_catch { font-size:<?php echo esc_html($catch_font_size_mobile); ?>px; }
  .index_free_space.num<?php echo $content_count; ?> { font-size:<?php echo esc_html($desc_font_size_mobile); ?>px; margin-top:<?php echo esc_html($padding_top_mobile); ?>px; margin-bottom:<?php echo esc_html($padding_bottom_mobile); ?>px; }
}
<?php
       };
       $content_count++;
       endforeach;
     endif; // END コンテンツビルダーここまで

     // ヘッダーカルーセル
     if($options['show_header_carousel']){
?>
#header_carousel_wrap { background:<?php echo esc_attr($options['header_carousel_bg_color']); ?>; }
#header_carousel_wrap .headline { font-size:<?php echo esc_attr($options['header_carousel_headline_font_size']); ?>px; color:<?php echo esc_attr($options['header_carousel_headline_font_color']); ?>; }
@media screen and (max-width:750px) {
  #header_carousel_wrap .headline { font-size:<?php echo esc_attr($options['header_carousel_headline_font_size_mobile']); ?>px; }
}
<?php
     }

     // ブログアーカイブ -----------------------------------------------------------------------------
     } elseif(is_archive() || is_home() || is_search()) {
?>
#page_header .catch { font-size:<?php echo esc_attr($options['blog_title_font_size']); ?>px; color:<?php echo esc_attr($options['blog_title_font_color']); ?>; }
#page_header .desc { font-size:<?php echo esc_attr($options['blog_desc_font_size']); ?>px; color:<?php echo esc_attr($options['blog_desc_font_color']); ?>; }
#blog_list .title { font-size:<?php echo esc_attr($options['archive_blog_title_font_size']); ?>px; }
#blog_list .title a { color:<?php echo esc_attr($options['archive_blog_title_font_color']); ?>; }
#blog_list .desc { font-size:<?php echo esc_attr($options['archive_blog_desc_font_size']); ?>px; }
@media screen and (max-width:750px) {
  #page_header .catch { font-size:<?php echo esc_attr($options['blog_title_font_size_mobile']); ?>px; }
  #page_header .desc { font-size:<?php echo esc_attr($options['blog_desc_font_size_mobile']); ?>px; }
  #blog_list .title { font-size:<?php echo esc_attr($options['archive_blog_title_font_size_mobile']); ?>px; }
  #blog_list .desc { font-size:<?php echo esc_attr($options['archive_blog_desc_font_size_mobile']); ?>px; }
}
<?php
     // ブログ詳細ページ -----------------------------------------------------------------------------
     } elseif(is_single()){
?>
#post_title_area .title { font-size:<?php echo esc_attr($options['single_blog_title_font_size']); ?>px; }
#article .post_content { font-size:<?php echo esc_attr($options['single_blog_content_font_size']); ?>px; }
#related_post .headline { font-size:<?php echo esc_attr($options['related_post_headline_font_size']); ?>px; background:<?php echo esc_attr($options['related_post_headline_bg_color']); ?>; }
#comments .headline { font-size:<?php echo esc_attr($options['comment_headline_font_size']); ?>px; background:<?php echo esc_attr($options['comment_headline_bg_color']); ?>; }
@media screen and (max-width:750px) {
  #post_title_area .title { font-size:<?php echo esc_attr($options['single_blog_title_font_size_mobile']); ?>px; }
  #article .post_content { font-size:<?php echo esc_attr($options['single_blog_content_font_size_mobile']); ?>px; }
  #related_post .headline { font-size:<?php echo esc_attr($options['related_post_headline_font_size_mobile']); ?>px; }
  #comments .headline { font-size:<?php echo esc_attr($options['comment_headline_font_size_mobile']); ?>px; }
}
<?php
     // 固定ページ --------------------------------------------------------------------
     } elseif(is_page()) {

       global $post;

       $page_header_catch_font_size = get_post_meta($post->ID, 'page_header_catch_font_size', true) ?  get_post_meta($post->ID, 'page_header_catch_font_size', true) : '28';
       $page_header_catch_font_size_mobile = get_post_meta($post->ID, 'page_header_catch_font_size_mobile', true) ?  get_post_meta($post->ID, 'page_header_catch_font_size_mobile', true) : '18';
       $page_header_catch_font_color = get_post_meta($post->ID, 'page_header_catch_font_color', true) ?  get_post_meta($post->ID, 'page_header_catch_font_color', true) : '#ffffff';

       $page_header_sub_title_font_size = get_post_meta($post->ID, 'page_header_sub_title_font_size', true) ?  get_post_meta($post->ID, 'page_header_sub_title_font_size', true) : '16';
       $page_header_sub_title_font_size_mobile = get_post_meta($post->ID, 'page_header_sub_title_font_size_mobile', true) ?  get_post_meta($post->ID, 'page_header_sub_title_font_size_mobile', true) : '14';
       $page_header_sub_title_font_color = get_post_meta($post->ID, 'page_header_sub_title_font_color', true) ?  get_post_meta($post->ID, 'page_header_sub_title_font_color', true) : '#ffffff';

       $page_header_desc_font_size = get_post_meta($post->ID, 'page_header_desc_font_size', true) ?  get_post_meta($post->ID, 'page_header_desc_font_size', true) : '16';
       $page_header_desc_font_size_mobile = get_post_meta($post->ID, 'page_header_desc_font_size_mobile', true) ?  get_post_meta($post->ID, 'page_header_desc_font_size_mobile', true) : '14';
       $page_header_desc_font_color = get_post_meta($post->ID, 'page_header_desc_font_color', true) ?  get_post_meta($post->ID, 'page_header_desc_font_color', true) : '#ffffff';

       $content_link_color1 = get_post_meta($post->ID, 'content_link_color1', true) ?  get_post_meta($post->ID, 'content_link_color1', true) : '#008a98';
       $content_link_color2 = get_post_meta($post->ID, 'content_link_color2', true) ?  get_post_meta($post->ID, 'content_link_color2', true) : '#006e7d';
       $content_link_font_color = get_post_meta($post->ID, 'content_link_font_color', true) ?  get_post_meta($post->ID, 'content_link_font_color', true) : '#ffffff';
       $content_link_font_size = get_post_meta($post->ID, 'content_link_font_size', true) ?  get_post_meta($post->ID, 'content_link_font_size', true) : '16';
       $content_link_font_size_mobile = get_post_meta($post->ID, 'content_link_font_size_mobile', true) ?  get_post_meta($post->ID, 'content_link_font_size_mobile', true) : '14';

       $page_content_font_size = get_post_meta($post->ID, 'page_content_font_size', true) ?  get_post_meta($post->ID, 'page_content_font_size', true) : '16';
       $page_content_font_size_mobile = get_post_meta($post->ID, 'page_content_font_size_mobile', true) ?  get_post_meta($post->ID, 'page_content_font_size_mobile', true) : '14';

       if(get_post_meta($post->ID, 'image_blur', true) == 'no_blur'){
         $image_blur = "0";
       } else {
         $image_blur = get_post_meta($post->ID, 'image_blur', true) ?  get_post_meta($post->ID, 'image_blur', true) : '10';
       }
?>
#page_header .bg_image { filter:blur(<?php echo esc_attr($image_blur); ?>px); margin:-<?php echo esc_attr($image_blur*2); ?>px; width:calc(100% + <?php echo esc_attr($image_blur*4); ?>px); height:calc(100% + <?php echo esc_attr($image_blur*4); ?>px); }
#page_header .catch { font-size:<?php echo esc_attr($page_header_catch_font_size); ?>px; color:<?php echo esc_attr($page_header_catch_font_color); ?>; }
#page_header .sub_title { font-size:<?php echo esc_attr($page_header_sub_title_font_size); ?>px; color:<?php echo esc_attr($page_header_sub_title_font_color); ?>; }
#page_header .desc { font-size:<?php echo esc_attr($page_header_desc_font_size); ?>px; color:<?php echo esc_attr($page_header_desc_font_color); ?>; }
#header_category_button_wrap { background:<?php echo esc_attr($content_link_color1); ?>; }
#header_category_button a { font-size:<?php echo esc_attr($content_link_font_size); ?>px; color:<?php echo esc_attr($content_link_font_color); ?>; }
#header_category_button .slide_item { background:<?php echo esc_attr($content_link_color2); ?>; }
#main_contents { font-size:<?php echo esc_attr($page_content_font_size); ?>px; }
@media screen and (max-width:1251px) {
  #header_category_button a { font-size:<?php echo esc_attr($content_link_font_size_mobile); ?>px; }
}
@media screen and (max-width:750px) {
  #page_header .catch { font-size:<?php echo esc_attr($page_header_catch_font_size_mobile); ?>px; }
  #page_header .sub_title { font-size:<?php echo esc_attr($page_header_sub_title_font_size_mobile); ?>px; }
  #page_header .desc { font-size:<?php echo esc_attr($page_header_desc_font_size_mobile); ?>px; }
  #main_contents { font-size:<?php echo esc_attr($page_content_font_size_mobile); ?>px; }
}
<?php
     // デザインページ１ --------------------------------------------------------------------
     if(is_page_template('page-design1.php')) {
       $design1_content = get_post_meta( $post->ID, 'design1_content', true );
       if ( $design1_content && is_array( $design1_content ) ) :
         foreach( $design1_content as $key => $content ) :
           // コンテンツ１ -----------------------------------------------------------------
           if ( ($content['cb_content_select'] == 'content1') && $content['show_content']) {
             $bg_image = $content['bg_image'] ? wp_get_attachment_image_src( $content['bg_image'], 'full' ) : '';
             $headline_font_size = $content['headline_font_size'] ?  $content['headline_font_size'] : '16';
             $headline_font_size_mobile = $content['headline_font_size_mobile'] ?  $content['headline_font_size_mobile'] : '14';
             $headline_font_color = $content['headline_font_color'] ?  $content['headline_font_color'] : '#ffffff';
             $headline_bg_color = $content['headline_bg_color'] ?  $content['headline_bg_color'] : '#000000';
             $catch_font_size = $content['catch_font_size'] ?  $content['catch_font_size'] : '36';
             $catch_font_size_mobile = $content['catch_font_size_mobile'] ?  $content['catch_font_size_mobile'] : '24';
             $desc_font_size = $content['desc_font_size'] ?  $content['desc_font_size'] : '16';
             $desc_font_size_mobile = $content['desc_font_size_mobile'] ?  $content['desc_font_size_mobile'] : '14';
             $item_title_font_size = $content['item_title_font_size'] ?  $content['item_title_font_size'] : '18';
             $item_title_font_size_mobile = $content['item_title_font_size_mobile'] ?  $content['item_title_font_size_mobile'] : '16';
             $item_desc_font_size = $content['item_desc_font_size'] ?  $content['item_desc_font_size'] : '16';
             $item_desc_font_size_mobile = $content['item_desc_font_size_mobile'] ?  $content['item_desc_font_size_mobile'] : '14';
             $button_font_color = isset($content['button_font_color']) ?  $content['button_font_color'] : '#ffffff';
             $button_bg_color = isset($content['button_bg_color']) ?  $content['button_bg_color'] : '#008a98';
             $button_border_color = isset($content['button_border_color']) ?  $content['button_border_color'] : '#008a98';
             $button_border_color_opacity = isset($content['button_border_color_opacity']) ?  $content['button_border_color_opacity'] : '1';
             $button_font_color_hover = isset($content['button_font_color_hover']) ?  $content['button_font_color_hover'] : '#ffffff';
             $button_bg_color_hover = isset($content['button_bg_color_hover']) ?  $content['button_bg_color_hover'] : '#006e7d';
             $button_border_color_hover = isset($content['button_border_color_hover']) ?  $content['button_border_color_hover'] : '#006e7d';
             $button_border_color_hover_opacity = isset($content['button_border_color_hover_opacity']) ?  $content['button_border_color_hover_opacity'] : '1';
             $button_border_color = hex2rgb($button_border_color);
             $button_border_color = implode(",",$button_border_color);
             $button_border_color_hover = hex2rgb($button_border_color_hover);
             $button_border_color_hover = implode(",",$button_border_color_hover);
             if($content['headline_shape'] != 'type3'){
?>
.design1_content1.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo esc_attr($headline_font_size); ?>px; color:<?php echo esc_attr($headline_font_color); ?>; <?php if($bg_image) { ?>background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center center; background-size:cover;<?php }; ?>}
<?php } else { ?>
.design1_content1.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo esc_attr($headline_font_size); ?>px; color:<?php echo esc_attr($headline_font_color); ?>; background:<?php echo esc_attr($headline_bg_color); ?>;  }
<?php }; ?>
.design1_content1.num<?php echo esc_attr($key); ?> .content_header .catch { font-size:<?php echo esc_attr($catch_font_size); ?>px; }
.design1_content1.num<?php echo esc_attr($key); ?> .content_header .desc { font-size:<?php echo esc_attr($desc_font_size); ?>px; }
.design1_content1.num<?php echo esc_attr($key); ?> .item_list .title { font-size:<?php echo esc_attr($item_title_font_size); ?>px; }
.design1_content1.num<?php echo esc_attr($key); ?> .item_list .desc { font-size:<?php echo esc_attr($item_desc_font_size); ?>px; }
.design1_content1.num<?php echo $key; ?> .link_button a:before { background:<?php echo esc_attr($button_bg_color_hover); ?>; }
.design1_content1.num<?php echo $key; ?> .link_button a { color:<?php echo esc_html($button_font_color); ?>; border-color:rgba(<?php echo esc_attr($button_border_color); ?>,<?php echo esc_attr($button_border_color_opacity); ?>); }
.design1_content1.num<?php echo $key; ?> .link_button a.button_animation_type1 { background:<?php echo esc_html($button_bg_color); ?>; }
.design1_content1.num<?php echo $key; ?> .link_button a.button_animation_type1:hover { color:<?php echo esc_attr($button_font_color_hover); ?>; background:<?php echo esc_attr($button_bg_color_hover); ?>; border-color:rgba(<?php echo esc_attr($button_border_color_hover); ?>,<?php echo esc_attr($button_border_color_hover_opacity); ?>); }
.design1_content1.num<?php echo $key; ?> .link_button a.button_animation_type2:hover { color:<?php echo esc_attr($button_font_color_hover); ?>; border-color:rgba(<?php echo esc_attr($button_border_color_hover); ?>,<?php echo esc_attr($button_border_color_hover_opacity); ?>); }
.design1_content1.num<?php echo $key; ?> .link_button a.button_animation_type3:hover { color:<?php echo esc_attr($button_font_color_hover); ?>; border-color:rgba(<?php echo esc_attr($button_border_color_hover); ?>,<?php echo esc_attr($button_border_color_hover_opacity); ?>); }
@media screen and (max-width:750px) {
  .design1_content1.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo esc_attr($headline_font_size_mobile); ?>px; }
  .design1_content1.num<?php echo esc_attr($key); ?> .content_header .catch { font-size:<?php echo esc_attr($catch_font_size_mobile); ?>px; }
  .design1_content1.num<?php echo esc_attr($key); ?> .content_header .desc { font-size:<?php echo esc_attr($desc_font_size_mobile); ?>px; }
  .design1_content1.num<?php echo esc_attr($key); ?> .item_list .title { font-size:<?php echo esc_attr($item_title_font_size_mobile); ?>px; }
  .design1_content1.num<?php echo esc_attr($key); ?> .item_list .desc { font-size:<?php echo esc_attr($item_desc_font_size_mobile); ?>px; }
}
<?php
           // コンテンツ２ -----------------------------------------------------------------
           } elseif ( ($content['cb_content_select'] == 'content2') && $content['show_content']) {
             $catch_font_size = $content['catch_font_size'] ?  $content['catch_font_size'] : '24';
             $catch_font_size_mobile = $content['catch_font_size_mobile'] ?  $content['catch_font_size_mobile'] : '20';
             $catch_font_color = $content['catch_font_color'] ?  $content['catch_font_color'] : '#ffffff';
             $desc_font_size = $content['desc_font_size'] ?  $content['desc_font_size'] : '16';
             $desc_font_size_mobile = $content['desc_font_size_mobile'] ?  $content['desc_font_size_mobile'] : '14';
             $desc_font_color = $content['desc_font_color'] ?  $content['desc_font_color'] : '#ffffff';
             $button_font_color = isset($content['button_font_color']) ?  $content['button_font_color'] : '#ffffff';
             $button_bg_color = isset($content['button_bg_color']) ?  $content['button_bg_color'] : '#008a98';
             $button_border_color = isset($content['button_border_color']) ?  $content['button_border_color'] : '#008a98';
             $button_border_color_opacity = isset($content['button_border_color_opacity']) ?  $content['button_border_color_opacity'] : '1';
             $button_font_color_hover = isset($content['button_font_color_hover']) ?  $content['button_font_color_hover'] : '#ffffff';
             $button_bg_color_hover = isset($content['button_bg_color_hover']) ?  $content['button_bg_color_hover'] : '#006e7d';
             $button_border_color_hover = isset($content['button_border_color_hover']) ?  $content['button_border_color_hover'] : '#006e7d';
             $button_border_color_hover_opacity = isset($content['button_border_color_hover_opacity']) ?  $content['button_border_color_hover_opacity'] : '1';
             $button_border_color = hex2rgb($button_border_color);
             $button_border_color = implode(",",$button_border_color);
             $button_border_color_hover = hex2rgb($button_border_color_hover);
             $button_border_color_hover = implode(",",$button_border_color_hover);
             if($content['image_blur'] == 'no_blur'){
               $image_blur = "0";
             } else {
               $image_blur = $content['image_blur'] ?  $content['image_blur'] : '0';
             }
?>
.design1_content2.num<?php echo $key; ?> .catch { font-size:<?php echo esc_html($catch_font_size); ?>px; color:<?php echo esc_html($catch_font_color); ?>; }
.design1_content2.num<?php echo $key; ?> .desc { font-size:<?php echo esc_html($desc_font_size); ?>px; color:<?php echo esc_html($desc_font_color); ?>; }
.design1_content2.num<?php echo $key; ?> .link_button a:before { background:<?php echo esc_attr($button_bg_color_hover); ?>; }
.design1_content2.num<?php echo $key; ?> .link_button a { color:<?php echo esc_html($button_font_color); ?>; border-color:rgba(<?php echo esc_attr($button_border_color); ?>,<?php echo esc_attr($button_border_color_opacity); ?>); }
.design1_content2.num<?php echo $key; ?> .link_button a.button_animation_type1 { background:<?php echo esc_html($button_bg_color); ?>; }
.design1_content2.num<?php echo $key; ?> .link_button a.button_animation_type1:hover { color:<?php echo esc_attr($button_font_color_hover); ?>; background:<?php echo esc_attr($button_bg_color_hover); ?>; border-color:rgba(<?php echo esc_attr($button_border_color_hover); ?>,<?php echo esc_attr($button_border_color_hover_opacity); ?>); }
.design1_content2.num<?php echo $key; ?> .link_button a.button_animation_type2:hover { color:<?php echo esc_attr($button_font_color_hover); ?>; border-color:rgba(<?php echo esc_attr($button_border_color_hover); ?>,<?php echo esc_attr($button_border_color_hover_opacity); ?>); }
.design1_content2.num<?php echo $key; ?> .link_button a.button_animation_type3:hover { color:<?php echo esc_attr($button_font_color_hover); ?>; border-color:rgba(<?php echo esc_attr($button_border_color_hover); ?>,<?php echo esc_attr($button_border_color_hover_opacity); ?>); }
.design1_content2.num<?php echo $key; ?> .bg_image { filter:blur(<?php echo esc_attr($image_blur); ?>px); margin:-<?php echo esc_attr($image_blur*2); ?>px; width:calc(100% + <?php echo esc_attr($image_blur*4); ?>px); height:calc(100% + <?php echo esc_attr($image_blur*4); ?>px); }
@media screen and (max-width:750px) {
  .design1_content2.num<?php echo $key; ?> .catch { font-size:<?php echo esc_html($catch_font_size_mobile); ?>px; }
  .design1_content2.num<?php echo $key; ?> .desc { font-size:<?php echo esc_html($desc_font_size_mobile); ?>px; }
}
<?php
           // コンテンツ３ -----------------------------------------------------------------
           } elseif ( ($content['cb_content_select'] == 'content3') && $content['show_content']) {
             $bg_image = $content['bg_image'] ? wp_get_attachment_image_src( $content['bg_image'], 'full' ) : '';
             $headline_font_size = $content['headline_font_size'] ?  $content['headline_font_size'] : '16';
             $headline_font_size_mobile = $content['headline_font_size_mobile'] ?  $content['headline_font_size_mobile'] : '14';
             $headline_font_color = $content['headline_font_color'] ?  $content['headline_font_color'] : '#ffffff';
             $headline_bg_color = $content['headline_bg_color'] ?  $content['headline_bg_color'] : '#000000';
             $catch_font_size = $content['catch_font_size'] ?  $content['catch_font_size'] : '30';
             $catch_font_size_mobile = $content['catch_font_size_mobile'] ?  $content['catch_font_size_mobile'] : '20';
             $desc_font_size = $content['desc_font_size'] ?  $content['desc_font_size'] : '16';
             $desc_font_size_mobile = $content['desc_font_size_mobile'] ?  $content['desc_font_size_mobile'] : '14';
             $button_font_color = isset($content['button_font_color']) ?  $content['button_font_color'] : '#ffffff';
             $button_bg_color = isset($content['button_bg_color']) ?  $content['button_bg_color'] : '#008a98';
             $button_border_color = isset($content['button_border_color']) ?  $content['button_border_color'] : '#008a98';
             $button_border_color_opacity = isset($content['button_border_color_opacity']) ?  $content['button_border_color_opacity'] : '1';
             $button_font_color_hover = isset($content['button_font_color_hover']) ?  $content['button_font_color_hover'] : '#ffffff';
             $button_bg_color_hover = isset($content['button_bg_color_hover']) ?  $content['button_bg_color_hover'] : '#006e7d';
             $button_border_color_hover = isset($content['button_border_color_hover']) ?  $content['button_border_color_hover'] : '#006e7d';
             $button_border_color_hover_opacity = isset($content['button_border_color_hover_opacity']) ?  $content['button_border_color_hover_opacity'] : '1';
             $button_border_color = hex2rgb($button_border_color);
             $button_border_color = implode(",",$button_border_color);
             $button_border_color_hover = hex2rgb($button_border_color_hover);
             $button_border_color_hover = implode(",",$button_border_color_hover);
             if($content['headline_shape'] != 'type3'){
?>
.design1_content3.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo esc_attr($headline_font_size); ?>px; color:<?php echo esc_attr($headline_font_color); ?>; <?php if($bg_image) { ?>background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center center; background-size:cover;<?php }; ?>}
<?php } else { ?>
.design1_content3.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo esc_attr($headline_font_size); ?>px; color:<?php echo esc_attr($headline_font_color); ?>; background:<?php echo esc_attr($headline_bg_color); ?>;  }
<?php }; ?>
.design1_content3.num<?php echo esc_attr($key); ?> .content_header .catch { font-size:<?php echo esc_attr($catch_font_size); ?>px; }
.design1_content3.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo esc_attr($desc_font_size); ?>px; }
.design1_content3.num<?php echo $key; ?> .link_button a:before { background:<?php echo esc_attr($button_bg_color_hover); ?>; }
.design1_content3.num<?php echo $key; ?> .link_button a { color:<?php echo esc_html($button_font_color); ?>; border-color:rgba(<?php echo esc_attr($button_border_color); ?>,<?php echo esc_attr($button_border_color_opacity); ?>); }
.design1_content3.num<?php echo $key; ?> .link_button a.button_animation_type1 { background:<?php echo esc_html($button_bg_color); ?>; }
.design1_content3.num<?php echo $key; ?> .link_button a.button_animation_type1:hover { color:<?php echo esc_attr($button_font_color_hover); ?>; background:<?php echo esc_attr($button_bg_color_hover); ?>; border-color:rgba(<?php echo esc_attr($button_border_color_hover); ?>,<?php echo esc_attr($button_border_color_hover_opacity); ?>); }
.design1_content3.num<?php echo $key; ?> .link_button a.button_animation_type2:hover { color:<?php echo esc_attr($button_font_color_hover); ?>; border-color:rgba(<?php echo esc_attr($button_border_color_hover); ?>,<?php echo esc_attr($button_border_color_hover_opacity); ?>); }
.design1_content3.num<?php echo $key; ?> .link_button a.button_animation_type3:hover { color:<?php echo esc_attr($button_font_color_hover); ?>; border-color:rgba(<?php echo esc_attr($button_border_color_hover); ?>,<?php echo esc_attr($button_border_color_hover_opacity); ?>); }
@media screen and (max-width:750px) {
  .design1_content3.num<?php echo esc_attr($key); ?> .top_headline { font-size:<?php echo esc_attr($headline_font_size_mobile); ?>px; }
  .design1_content3.num<?php echo esc_attr($key); ?> .content_header .catch { font-size:<?php echo esc_attr($catch_font_size_mobile); ?>px; }
  .design1_content3.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo esc_attr($desc_font_size_mobile); ?>px; }
}
<?php
           };
         endforeach;
       endif;
     } // END デザインページ１
?>
<?php
     // ランキングページ --------------------------------------------------------------------
     if(is_page_template('page-ranking.php')) {
       // フリースペース
       $ranking_free1_font_size = get_post_meta($post->ID, 'ranking_free1_font_size', true) ?  get_post_meta($post->ID, 'ranking_free1_font_size', true) : '16';
       $ranking_free1_font_size_mobile = get_post_meta($post->ID, 'ranking_free1_font_size_mobile', true) ?  get_post_meta($post->ID, 'ranking_free1_font_size_mobile', true) : '14';
       $ranking_free1_margin_top = get_post_meta($post->ID, 'ranking_free1_margin_top', true) ?  get_post_meta($post->ID, 'ranking_free1_margin_top', true) : '50';
       $ranking_free1_margin_bottom = get_post_meta($post->ID, 'ranking_free1_margin_bottom', true) ?  get_post_meta($post->ID, 'ranking_free1_margin_bottom', true) : '50';
       $ranking_free1_margin_top_mobile = get_post_meta($post->ID, 'ranking_free1_margin_top_mobile', true) ?  get_post_meta($post->ID, 'ranking_free1_margin_top_mobile', true) : '50';
       $ranking_free1_margin_bottom_mobile = get_post_meta($post->ID, 'ranking_free1_margin_bottom_mobile', true) ?  get_post_meta($post->ID, 'ranking_free1_margin_bottom_mobile', true) : '50';
       $ranking_free2_font_size = get_post_meta($post->ID, 'ranking_free2_font_size', true) ?  get_post_meta($post->ID, 'ranking_free2_font_size', true) : '16';
       $ranking_free2_font_size_mobile = get_post_meta($post->ID, 'ranking_free2_font_size_mobile', true) ?  get_post_meta($post->ID, 'ranking_free2_font_size_mobile', true) : '14';
       $ranking_free2_margin_top = get_post_meta($post->ID, 'ranking_free2_margin_top', true) ?  get_post_meta($post->ID, 'ranking_free2_margin_top', true) : '50';
       $ranking_free2_margin_bottom = get_post_meta($post->ID, 'ranking_free2_margin_bottom', true) ?  get_post_meta($post->ID, 'ranking_free2_margin_bottom', true) : '50';
       $ranking_free2_margin_top_mobile = get_post_meta($post->ID, 'ranking_free2_margin_top_mobile', true) ?  get_post_meta($post->ID, 'ranking_free2_margin_top_mobile', true) : '50';
       $ranking_free2_margin_bottom_mobile = get_post_meta($post->ID, 'ranking_free2_margin_bottom_mobile', true) ?  get_post_meta($post->ID, 'ranking_free2_margin_bottom_mobile', true) : '50';
?>
.ranking_free_space.top { margin-top:<?php echo $ranking_free1_margin_top; ?>px; margin-bottom:<?php echo $ranking_free1_margin_bottom; ?>px; }
.ranking_free_space.top .post_content { font-size:<?php echo $ranking_free1_font_size; ?>px; }
.ranking_free_space.bottom { margin-top:<?php echo $ranking_free2_margin_top; ?>px; margin-bottom:<?php echo $ranking_free2_margin_bottom; ?>px; }
.ranking_free_space.bottom .post_content { font-size:<?php echo $ranking_free2_font_size; ?>px; }
@media screen and (max-width:750px) {
  .ranking_free_space.top { margin-top:<?php echo $ranking_free1_margin_top_mobile; ?>px; margin-bottom:<?php echo $ranking_free1_margin_bottom_mobile; ?>px; }
  .ranking_free_space.top .post_content { font-size:<?php echo $ranking_free1_font_size_mobile; ?>px; }
  .ranking_free_space.bottom { margin-top:<?php echo $ranking_free2_margin_top_mobile; ?>px; margin-bottom:<?php echo $ranking_free2_margin_bottom_mobile; ?>px; }
  .ranking_free_space.bottom .post_content { font-size:<?php echo $ranking_free2_font_size_mobile; ?>px; }
}
<?php
       $ranking_content = get_post_meta( $post->ID, 'ranking_content', true );
       if ( $ranking_content && is_array( $ranking_content ) ) :
         foreach( $ranking_content as $key => $content ) :
           // コンテンツ１ -----------------------------------------------------------------
           if ( ($content['cb_content_select'] == 'content1') && $content['show_content']) {

             $catch_font_size = $content['catch_font_size'] ?  $content['catch_font_size'] : '36';
             $catch_font_size_mobile = $content['catch_font_size_mobile'] ?  $content['catch_font_size_mobile'] : '24';
             $desc_font_size = $content['desc_font_size'] ?  esc_html($content['desc_font_size']) : '16';
             $desc_font_size_mobile = $content['desc_font_size_mobile'] ?  esc_html($content['desc_font_size_mobile']) : '14';

             $ranking_number_bg_color = $content['ranking_number_bg_color'] ?  $content['ranking_number_bg_color'] : '#000000';
             $ranking_number_font_color = $content['ranking_number_font_color'] ?  $content['ranking_number_font_color'] : '#ffffff';
             $ranking_label_font_size = $content['ranking_label_font_size'] ?  esc_html($content['ranking_label_font_size']) : '14';
             $ranking_number_font_size = $content['ranking_number_font_size'] ?  esc_html($content['ranking_number_font_size']) : '28';

             $item_title_font_size = $content['item_title_font_size'] ?  esc_html($content['item_title_font_size']) : '20';
             $item_title_font_size_mobile = $content['item_title_font_size_mobile'] ?  esc_html($content['item_title_font_size_mobile']) : '16';
             $item_desc_font_size = $content['item_desc_font_size'] ?  esc_html($content['item_desc_font_size']) : '16';
             $item_desc_font_size_mobile = $content['item_desc_font_size_mobile'] ?  esc_html($content['item_desc_font_size_mobile']) : '14';

             $category_catch_font_size = $content['category_catch_font_size'] ?  $content['category_catch_font_size'] : '36';
             $category_catch_font_size_mobile = $content['category_catch_font_size_mobile'] ?  $content['category_catch_font_size_mobile'] : '24';
             $category_desc_font_size = $content['category_desc_font_size'] ?  esc_html($content['category_desc_font_size']) : '16';
             $category_desc_font_size_mobile = $content['category_desc_font_size_mobile'] ?  esc_html($content['category_desc_font_size_mobile']) : '14';

             $category_headline_font_size = $content['category_headline_font_size'] ?  esc_html($content['category_headline_font_size']) : '20';
             $category_headline_font_size_mobile = $content['category_headline_font_size_mobile'] ?  esc_html($content['category_headline_font_size_mobile']) : '16';
             $category_headline_bg_color = $content['category_headline_bg_color'] ?  esc_html($content['category_headline_bg_color']) : '#f4f4f4';

             $category_ranking_label_font_size = $content['category_ranking_label_font_size'] ?  esc_html($content['category_ranking_label_font_size']) : '14';
             $category_ranking_number_font_size = $content['category_ranking_number_font_size'] ?  esc_html($content['category_ranking_number_font_size']) : '28';
             $category_ranking_number_bg_color = $content['category_ranking_number_bg_color'] ?  esc_html($content['category_ranking_number_bg_color']) : '#000000';
             $category_ranking_number_font_color = $content['category_ranking_number_font_color'] ?  esc_html($content['category_ranking_number_font_color']) : '#ffffff';

             $category_item_title_font_size = $content['category_item_title_font_size'] ?  esc_html($content['category_item_title_font_size']) : '20';
             $category_item_title_font_size_mobile = $content['category_item_title_font_size_mobile'] ?  esc_html($content['category_item_title_font_size_mobile']) : '16';
             $category_item_desc_font_size = $content['category_item_desc_font_size'] ?  esc_html($content['category_item_desc_font_size']) : '16';
             $category_item_desc_font_size_mobile = $content['category_item_desc_font_size_mobile'] ?  esc_html($content['category_item_desc_font_size_mobile']) : '14';
?>
.ranking_content.num<?php echo esc_attr($key); ?> .ranking_top .content_header .catch { font-size:<?php echo esc_attr($catch_font_size); ?>px; }
.ranking_content.num<?php echo esc_attr($key); ?> .ranking_top .content_header .desc { font-size:<?php echo esc_attr($desc_font_size); ?>px; }
.ranking_content.num<?php echo esc_attr($key); ?> .product_ranking_list_top .rank_number { background:<?php echo esc_attr($ranking_number_bg_color); ?>; color:<?php echo esc_attr($ranking_number_font_color); ?>; }
.ranking_content.num<?php echo esc_attr($key); ?> .product_ranking_list_top .rank_number .label { font-size:<?php echo esc_attr($ranking_label_font_size); ?>px; }
.ranking_content.num<?php echo esc_attr($key); ?> .product_ranking_list_top .rank_number .num { font-size:<?php echo esc_attr($ranking_number_font_size); ?>px; }
.ranking_content.num<?php echo esc_attr($key); ?> .product_ranking_list_top .item .title { font-size:<?php echo esc_attr($item_title_font_size); ?>px; }
.ranking_content.num<?php echo esc_attr($key); ?> .product_ranking_list_top .item .desc { font-size:<?php echo esc_attr($item_desc_font_size); ?>px; }
.ranking_content.num<?php echo esc_attr($key); ?> .ranking_bottom .content_header .catch { font-size:<?php echo esc_attr($category_catch_font_size); ?>px; }
.ranking_content.num<?php echo esc_attr($key); ?> .ranking_bottom .content_header .desc { font-size:<?php echo esc_attr($category_desc_font_size); ?>px; }
.ranking_content.num<?php echo esc_attr($key); ?> .category_ranking_list .product_ranking_list .headline { background:<?php echo esc_attr($category_headline_bg_color); ?>; font-size:<?php echo esc_attr($category_headline_font_size); ?>px; }
.ranking_content.num<?php echo esc_attr($key); ?> .category_ranking_list .rank_number { background:<?php echo esc_attr($category_ranking_number_bg_color); ?>; color:<?php echo esc_attr($category_ranking_number_font_color); ?>; }
.ranking_content.num<?php echo esc_attr($key); ?> .category_ranking_list .rank_number .label { font-size:<?php echo esc_attr($category_ranking_label_font_size); ?>px; }
.ranking_content.num<?php echo esc_attr($key); ?> .category_ranking_list .rank_number .num { font-size:<?php echo esc_attr($category_ranking_number_font_size); ?>px; }
.ranking_content.num<?php echo esc_attr($key); ?> .category_ranking_list .product_ranking_list .item .title { font-size:<?php echo esc_attr($category_item_title_font_size); ?>px; }
.ranking_content.num<?php echo esc_attr($key); ?> .category_ranking_list .product_ranking_list .item .desc { font-size:<?php echo esc_attr($category_item_desc_font_size); ?>px; }
@media screen and (max-width:1251px) {
  .ranking_content.num<?php echo esc_attr($key); ?> .category_ranking_list .product_ranking_list .item .title { font-size:<?php echo esc_attr($category_item_title_font_size_mobile); ?>px; }
  .ranking_content.num<?php echo esc_attr($key); ?> .category_ranking_list .product_ranking_list .item .desc { font-size:<?php echo esc_attr($category_item_desc_font_size_mobile); ?>px; }
}
@media screen and (max-width:750px) {
  .ranking_content.num<?php echo esc_attr($key); ?> .ranking_top .content_header .catch { font-size:<?php echo esc_attr($catch_font_size_mobile); ?>px; }
  .ranking_content.num<?php echo esc_attr($key); ?> .ranking_top .content_header .desc { font-size:<?php echo esc_attr($desc_font_size_mobile); ?>px; }
  .ranking_content.num<?php echo esc_attr($key); ?> .product_ranking_list_top .item .title { font-size:<?php echo esc_attr($item_title_font_size_mobile); ?>px; }
  .ranking_content.num<?php echo esc_attr($key); ?> .product_ranking_list_top .item .desc { font-size:<?php echo esc_attr($item_desc_font_size_mobile); ?>px; }
  .ranking_content.num<?php echo esc_attr($key); ?> .ranking_bottom .content_header .catch { font-size:<?php echo esc_attr($category_catch_font_size_mobile); ?>px; }
  .ranking_content.num<?php echo esc_attr($key); ?> .ranking_bottom .content_header .desc { font-size:<?php echo esc_attr($category_desc_font_size_mobile); ?>px; }
  .ranking_content.num<?php echo esc_attr($key); ?> .category_ranking_list .product_ranking_list .headline { font-size:<?php echo esc_attr($category_headline_font_size_mobile); ?>px; }
}
<?php
           };
         endforeach;
       endif;
     } // END ランキングページ
?>
<?php
     // 404ページ -----------------------------------------------------------------------------
     } elseif( is_404()) {
       $title_font_size_pc = ( ! empty( $options['header_txt_size_404'] ) ) ? $options['header_txt_size_404'] : 38;
       $sub_title_font_size_pc = ( ! empty( $options['header_sub_txt_size_404'] ) ) ? $options['header_sub_txt_size_404'] : 16;
       $title_font_size_mobile = ( ! empty( $options['header_txt_size_404_mobile'] ) ) ? $options['header_txt_size_404_mobile'] : 28;
       $sub_title_font_size_mobile = ( ! empty( $options['header_sub_txt_size_404_mobile'] ) ) ? $options['header_sub_txt_size_404_mobile'] : 14;
?>
#page_404_header .catch { font-size:<?php echo esc_html($title_font_size_pc); ?>px; }
#page_404_header .desc { font-size:<?php echo esc_html($sub_title_font_size_pc); ?>px; }
@media screen and (max-width:750px) {
  #page_404_header .catch { font-size:<?php echo esc_html($title_font_size_mobile); ?>px; }
  #page_404_header .desc { font-size:<?php echo esc_html($sub_title_font_size_mobile); ?>px; }
}
<?php
     }; //END page setting

     // カスタムCSS --------------------------------------------
     if(is_single() || is_page()) {
       global $post;
       $custom_css = get_post_meta($post->ID, 'custom_css', true);
       if($custom_css) {
         echo $custom_css;
       };
     }

     // ロード画面 -----------------------------------------
     get_template_part('functions/loader');
     if($options['load_icon'] == 'type4'){
?>
#site_loader_logo_inner .message { font-size:<?php echo esc_html($options['load_type4_catch_font_size']); ?>px; color:<?php echo esc_html($options['load_type4_catch_color']); ?>; }
#site_loader_logo_inner i { background:<?php echo esc_html($options['load_type4_catch_color']); ?>; }
@media screen and (max-width:750px) {
  #site_loader_logo_inner .message { font-size:<?php echo esc_html($options['load_type4_catch_font_size_sp']); ?>px; }
}
<?php
     };

     //フッターバー --------------------------------------------
     if(is_mobile()) {
       if($options['footer_bar_display'] == 'type1' || $options['footer_bar_display'] == 'type2') {
         $footer_bar_border_color = hex2rgb($options['footer_bar_border_color']);
         $footer_bar_border_color = implode(",",$footer_bar_border_color);
?>
#dp-footer-bar { background:<?php echo esc_attr($options['footer_bar_bg_color']); ?>; color:<?php echo esc_html($options['footer_bar_font_color']); ?>; }
.dp-footer-bar-item a { border-color:rgba(<?php echo esc_attr($footer_bar_border_color); ?>,<?php echo esc_html($options['footer_bar_border_color_opacity']); ?>); color:<?php echo esc_html($options['footer_bar_font_color']); ?>; }
.dp-footer-bar-item a:hover { border-color:<?php echo esc_html($options['footer_bar_bg_color_hover']); ?>; background:<?php echo esc_html($options['footer_bar_bg_color_hover']); ?>; }
<?php
       };
     };
?>
</style>

<?php
     // JavaScriptの設定はここから　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

     // メガメニュー ------------------------------------------------------------
     wp_enqueue_style('slick-style', apply_filters('page_builder_slider_slick_style_url', get_template_directory_uri().'/js/slick.css'), '', '1.0.0');
     wp_enqueue_script('slick-script', apply_filters('page_builder_slider_slick_script_url', get_template_directory_uri().'/js/slick.min.js'), '', '1.0.0', true);
?>
<script type="text/javascript">
jQuery(document).ready(function($){

  $('.megamenu_blog_slider').slick({
    infinite: true,
    dots: false,
    arrows: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    swipeToSlide: true,
    touchThreshold: 20,
    adaptiveHeight: false,
    pauseOnHover: true,
    autoplay: false,
    fade: false,
    easing: 'easeOutExpo',
    speed: 700,
    autoplaySpeed: 5000
  });
  $('.megamenu_blog_list .prev_item').on('click', function() {
    $(this).closest('.megamenu_blog_list').find('.megamenu_blog_slider').slick('slickPrev');
  });
  $('.megamenu_blog_list .next_item').on('click', function() {
    $(this).closest('.megamenu_blog_list').find('.megamenu_blog_slider').slick('slickNext');
  });

});
</script>
<?php
     // トップページ
     if(is_front_page()) {

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

       // ヘッダーコンテンツ --------------------------------------------------
       wp_enqueue_style('slick-style', apply_filters('page_builder_slider_slick_style_url', get_template_directory_uri().'/js/slick.css'), '', '1.0.0');
       wp_enqueue_script('slick-script', apply_filters('page_builder_slider_slick_script_url', get_template_directory_uri().'/js/slick.min.js'), '', '1.0.0', true);
       $index_slider_bg_type = $options[$device . 'index_slider_bg_type'];
       $index_slider_time = $options[$device . 'index_slider_time'];
?>
<script type="text/javascript">
jQuery(document).ready(function($){

  function adjust_height(){
    var winH = $(window).innerHeight();
    var winW = $(window).width();
    if(winW < 750){
      $('#header_slider').css('height', winH - 60);
      $('#header_slider .item').css('height', winH - 60);
    } else {
      $('#header_slider').css('height', '');
      $('#header_slider .item').css('height', '');
    }
  }
  adjust_height();

  <?php if($index_slider_bg_type == 'type2' || $index_slider_bg_type == 'type3') { ?>
  function fix_video_size(){
    var slider_height = $('#header_slider').innerHeight();
    var slider_width = slider_height*(16/9);
    var win_width = $(window).width();
    var win_height = win_width*(9/16);
    if(win_width > slider_width) {
      $('#index_video').addClass('type1');
      $('#index_video').removeClass('type2');
      $('#index_video').css({'width': '100%', 'height': win_height});
    } else {
      $('#index_video').removeClass('type1');
      $('#index_video').addClass('type2');
      $('#index_video').css({'width':slider_width, 'height':slider_height });
    }
  }
  fix_video_size();
  <?php }; ?>

  $(window).on('resize',function(){
    adjust_height();
    <?php if($index_slider_bg_type == 'type2' || $index_slider_bg_type == 'type3') { ?>
    fix_video_size();
    <?php }; ?>
  });

  $('#header_slider_content').slick({
    infinite: true,
    dots: true,
    arrows: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    adaptiveHeight: false,
    pauseOnFocus: false,
    pauseOnHover: false,
    autoplay: true,
    fade: true,
    slide: '.item',
    easing: 'easeOutExpo',
    speed: 1500,
    autoplaySpeed: <?php echo esc_html($index_slider_time); ?>
  });
  $('#header_slider_content').on("beforeChange", function(event, slick, currentSlide, nextSlide) {
    $('#header_slider_content .item').eq(nextSlide).addClass('animate');
    $('#header_slider_content .item:eq(' + nextSlide + ') .animate_item').each(function(i){
      $(this).delay(i *500).queue(function(next) {
      $(this).addClass('animate');
        next();
      });
    });
  });
  $('#header_slider_content').on("afterChange", function(event, slick, currentSlide, nextSlide) {
    $('#header_slider_content .item').not(':eq(' + currentSlide + ')').removeClass('animate');
    $('#header_slider_content .item:not(:eq(' + currentSlide + ')) .animate_item').removeClass('animate');
  });
  $('#header_slider_content').slick('slickPause');

});
</script>
<?php
       // Youtube ------------------------------------------------------------
       if($index_slider_bg_type == 'type3' && auto_play_movie()) {
         $youtube_url = $options[$device . 'index_youtube_url'];
         if($youtube_url) {
           $matches = array();
           if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[\w\-?&!#=,;]+/[\w\-?&!#=/,;]+/|(?:v|e(?:mbed)?)/|[\w\-?&!#=,;]*[?&]v=)|youtu\.be/)([\w-]{11})(?:[^\w-]|\Z)%i', $youtube_url, $matches)) {
             $video_id = $matches[1];
           }
           if($video_id) {
?>
<script src="https://www.youtube.com/iframe_api"></script>
<script type="text/javascript">
function onYouTubeIframeAPIReady() {
  ytPlayer = new YT.Player(
    'youtube_video_player',{
      videoId: '<?php echo esc_html($video_id); ?>',
      playerVars: {
        loop: 1,
        playlist: '<?php echo esc_html($video_id); ?>',
        controls: 0,
        autoplay: 1,
        playsinline: 1,
        showinfo: 0
      },
      events: {
       'onReady': onPlayerReady
      }
    }
  );
}
function onPlayerReady(event) {
  event.target.playVideo();
  event.target.mute();
}
</script>
<?php
            };
           };
         };
       };

       // コンテンツビルダー　記事一覧スライダー ------------------------------------------------------------
       if ($options['contents_builder'] || $options['mobile_contents_builder']) :
         if(is_mobile() && $options['mobile_show_contents_builder']) {
           $contents_builder = $options['mobile_contents_builder'];
         } else {
           $contents_builder = $options['contents_builder'];
         }
         $content_count = 1;
         foreach($contents_builder as $content) :
           if ($content['cb_content_select'] == 'post_slider') {
             wp_enqueue_style('slick-style', apply_filters('page_builder_slider_slick_style_url', get_template_directory_uri().'/js/slick.css'), '', '1.0.0');
             wp_enqueue_script('slick-script', apply_filters('page_builder_slider_slick_script_url', get_template_directory_uri().'/js/slick.min.js'), '', '1.0.0', true);
?>
<script type="text/javascript">
jQuery(document).ready(function($){

  $('.index_post_slider.num<?php echo $content_count; ?> .post_list').slick({
    infinite: true,
    dots: false,
    arrows: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    adaptiveHeight: false,
    pauseOnHover: true,
    autoplay: true,
    fade: false,
    easing: 'easeOutExpo',
    speed: 700,
    autoplaySpeed: <?php echo esc_attr($content['slider_time']); ?>,
    responsive: [
      {
        breakpoint: 950,
        settings: { slidesToShow: 2 }
      },
      {
        breakpoint: 750,
        settings: { slidesToShow: 1 }
      }
    ]
  });
  $('.index_post_slider .prev_item').on('click', function() {
    $(this).closest('.index_post_slider').find('.post_list').slick('slickPrev');
  });
  $('.index_post_slider .next_item').on('click', function() {
    $(this).closest('.index_post_slider').find('.post_list').slick('slickNext');
  });

});
</script>
<?php
           };
           $content_count++;
         endforeach;
       endif;

       // ヘッダーカルーセル --------------------------------------------------------------
       if($options['show_header_carousel']){
         wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.css','','1.0.0');
         wp_enqueue_style('owl-theme-default', get_template_directory_uri() . '/js/owl.theme.default.min.css','','1.0.0');
         wp_enqueue_script('owl-carousel-js', get_template_directory_uri().'/js/owl.carousel.min.js', '', '1.0.0', true);
?>
<script type="text/javascript">
jQuery(document).ready(function($){

  $('#header_carousel').owlCarousel({
    loop: true,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplaySpeed: 1000,
    autoplayHoverPause: true,
    dots: false,
    nav: false,
    navSpeed: 1000,
    margin: 10,
    nav: false,
    responsive : {
      0 : {
        center:false,
        items: 2,
        autoWidth: false,
      },
      650 : {
        center: true,
        items: 4,
        autoWidth: true,
      }
    }
  });

});
</script>
<?php
       }

       // ニュースティッカー --------------------------------------------------------------
       if($options['show_header_news']){
         wp_enqueue_style('slick-style', apply_filters('page_builder_slider_slick_style_url', get_template_directory_uri().'/js/slick.css'), '', '1.0.0');
         wp_enqueue_script('slick-script', apply_filters('page_builder_slider_slick_script_url', get_template_directory_uri().'/js/slick.min.js'), '', '1.0.0', true);
?>
<script type="text/javascript">
jQuery(document).ready(function($){

  $('#index_news_slider').slick({
    infinite: true,
    dots: false,
    arrows: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    swipeToSlide: false,
    adaptiveHeight: false,
    pauseOnHover: true,
    autoplay: true,
    fade: true,
    easing: 'easeOutExpo',
    speed: 700,
    autoplaySpeed: 5000
  });

});
</script>
<?php
       }
       // トップページのコンテンツビルダーのアニメーショントリガー
?>
<script type="text/javascript">
jQuery(document).ready(function($){
  $(window).on('scroll load pageshow', function(i) {
    var scTop = $(this).scrollTop();
    var scBottom = scTop + $(this).height();
    $('.inview').each( function(i) {
      var thisPos = $(this).offset().top + 100;
      if ( thisPos < scBottom ) {
        $(this).addClass('animate');
        $(".animate_item",this).each(function(i){
          $(this).delay(i * 500).queue(function(next) {
            $(this).addClass('animate');
            next();
          });
        });
      }
    });
  });
});
</script>
<?php
     }; // END front page

     // 商品ページ、サポートページ、ランキングページ、固定ページのコンテンツリンク ----------------------------------------------------------
     if(is_post_type_archive('product') || is_tax('product_category') || is_singular('product') || is_post_type_archive('support') || (is_page() && !is_front_page()) ) {
?>
<script type="text/javascript">
jQuery(document).ready(function($){

  var currentItem = $("#header_category_button li.active");
  if (currentItem.length) {
    $("#header_category_button .slide_item").css({
      "width": currentItem.width(),
      "left": currentItem.position().left
    });
  }
  $("#header_category_button li").hover(
    function(){
      $("#header_category_button .slide_item").addClass('animate');
      $("#header_category_button .slide_item").css({
        "width": $(this).width(),
        "left": $(this).position().left
      });
    },
    function(){
      <?php if(is_page() || is_singular('product')) { ?>
      currentItem = $("#header_category_button li.active");
      <?php }; ?>
      $("#header_category_button .slide_item").css({
        "width": currentItem.width(),
        "left": currentItem.position().left
      });
    }
  );

  // perfect scroll fix
  if( $('#header_category_button_wrap').length ) {
    if( ! $(body).hasClass('mobile_device') ) {
      new SimpleBar($('#header_category_button_wrap')[0]);
    }

    $(window).on('resize',function(ev){
      currentItem = $("#header_category_button li.active");
      $("#header_category_button .slide_item").css({
        "width": currentItem.width(),
        "left": currentItem.position().left
      });
    });
  }

  var animate_flag = true;

  <?php
       // サイドコンテンツの固定　商品詳細ページ
       if(is_singular('product')) {
         $side_content_layout = get_post_meta($post->ID, 'side_content_layout', true) ?  get_post_meta($post->ID, 'side_content_layout', true) : 'type0';
         if( ($side_content_layout == 'type0' && $options['single_product_layout'] != 'type3') || $side_content_layout == 'type1' || $side_content_layout == 'type2'){
  ?>
  var side_content = $('#product_side_content');
  var side_content_height = side_content.innerHeight();
  var side_content_top = side_content.offset().top;
  var main_col = $('#main_col');
  $(window).on('scroll load pageshow', function(i) {
    var main_col_height = main_col.height();
    var main_col_top = main_col.offset().top;
    $('body').removeClass('use_header_fix use_mobile_header_fix');
    var scTop = $(this).scrollTop() + 90;
    if ( scTop > side_content_top) {
      side_content.addClass('active');
    } else {
      side_content.removeClass('active');
    }
    if ( scTop > main_col_height + main_col_top - side_content_height) {
      side_content.addClass('active_off');
    } else {
      side_content.removeClass('active_off');
    }
  });
  <?php }; }; ?>

  <?php
       // コンテンツリンクを固定　商品詳細ページ　固定ページ
       if(is_singular('product') || is_page() ) {
  ?>
  $(window).on('scroll load pageshow', function(i) {

    if( $('#header_category_button_wrap').length ) {

      <?php if(is_singular('product') || (is_page() && get_post_meta($post->ID, 'fixed_content_link', true)) ) { ?>

      var scTop = $(this).scrollTop();
      var scBottom = scTop + $(this).height();
      if( $("html").hasClass('mobile') ){
        var content_top = $('.content_link_target_top').offset().top - 50;
      } else {
        var content_top = $('.content_link_target_top').offset().top - 60;
      }
      if ( content_top < scTop ) {
        $('body').addClass('fixed_content_link');
      } else {
        $('body').removeClass('fixed_content_link');
      }
      $('.content_link_target').each( function(i) {
        if( $("html").hasClass('mobile') ){
          var content_top_position = $(this).offset().top - 50;
        } else {
          var content_top_position = $(this).offset().top - 60;
        }
        if(animate_flag == true) {
          if ( content_top_position < scTop ) {
            var content_id = '#' + $(this).attr('id');
            $("#header_category_button li a").each(function(){
              var link_id = $(this).attr('href');
              if(link_id == content_id) {
                $("#header_category_button li").removeClass('active');
                $(this).parent().addClass('active');
                currentItem = $(this).parent();
                $("#header_category_button .slide_item").addClass('animate');
                $("#header_category_button .slide_item").css({
                  "width": currentItem.width(),
                  "left": currentItem.position().left
                });
              }
            });
          };
        };
      });

      <?php }; ?>

      <?php if( !is_page_template('page-ranking.php') ) { ?>

      // スクロールエフェクト
      $("#header_category_button a").off('click');
      $('#header_category_button a[href^="#"]').on('click',function() {
        $('#header_category_button li').addClass('moving');
        animate_flag = false;
        $('#header_category_button li').removeClass('active');
        $(this).parent().addClass('active');
        var myHref= $(this).attr("href");
        if($(myHref).length){
          if( $("html").hasClass('mobile') ){
            if( $("body").hasClass('hide_header') ){
              var myPos = $(myHref).offset().top;
            } else {
              var myPos = $(myHref).offset().top - 48;
            }
          } else {
            if( $("body").hasClass('hide_header') ){
              var myPos = $(myHref).offset().top;
            } else {
              var myPos = $(myHref).offset().top - 58;
            }
          }
          $("html,body").animate({scrollTop : myPos}, 1000, 'easeOutExpo', function(){
            animate_flag = true;
            $('#header_category_button li').removeClass('moving');
          });
          return false;
        } else {
          animate_flag = true;
          $('#header_category_button li').removeClass('moving');
        }
      });

      <?php }; ?>

    } // end if has content link

    <?php
         // コンテンツのアニメーション
         if(is_singular('product') ) {
    ?>
    $('.inview').each( function(i) {
      var thisPos = $(this).offset().top + 100;
      if ( thisPos < scBottom ) {
        $(this).addClass('animate');
        $(".animate_item",this).each(function(i){
          $(this).delay(i * 500).queue(function(next) {
            $(this).addClass('animate');
            next();
          });
        });
      }
    });
    <?php }; ?>

  });
  <?php }; ?>

  <?php
       // 商品アーカイブページ
       if(is_post_type_archive('product') || is_tax('product_category')) {
  ?>
  $('#header_category_button li').on('click', function() {
    currentItem = $(this);
    $(this).siblings().removeClass('active');
    $(this).addClass('active');
  });
  var $filters = $('#header_category_button [data-filter]'),
  $items = $('#archive_product_list [data-category]');
  $filters.on('click', function(e) {
    e.preventDefault();
    var $this = $(this);
    if( $this.hasClass('active') ) return false;
    $filters.removeClass('active');
    $this.addClass('active');
    var $filterCategory = $this.attr('data-filter');
    if ($filterCategory == 'all') {
      $items.removeClass('animate').fadeOut().finish().promise().done(function() {
        $items.each(function(i) {
          $(this).css('opacity','0').show();
          $(this).delay(i * 300).queue(function(next) {
            $(this).addClass('animate').fadeIn();
            next();
          });
        });
      });
    } else {
      $items.removeClass('animate').fadeOut().finish().promise().done(function() {
        $items.filter('[data-category~= "' + $filterCategory + '"]').each(function(i) {
          $(this).css('opacity','0').show();
          $(this).delay(i * 300).queue(function(next) {
            $(this).addClass('animate').fadeIn();
            next();
          });
        });
      });
    }
  });
  if (location.hash && location.hash != '#') {
    $(location.hash).click();
  }
  <?php
       if(is_tax('product_category')) {
        $query_obj = get_queried_object();
        $current_cat_id = $query_obj->term_id;
  ?>
  $("#product_cat_<?php echo esc_attr($current_cat_id); ?>").click();
  <?php }; ?>
  $('.megamenu_product_category_list a').click(function(){
    var anchor = $(this).attr('data-anchor');
    if (!anchor) return;
    $(anchor).click();
    $('#header_category_button li').removeClass('active');
    $(anchor).parent().addClass('active');
    currentItem = $(anchor).parent();
    $("#header_category_button .slide_item").css({
      "width": currentItem.width(),
      "left": currentItem.position().left
    });
  });
  <?php }; ?>

  <?php
       // サポートページ、ランキングページ
       if(is_page('faq') || is_post_type_archive('support') || is_page_template('page-ranking.php')) {
  ?>
  $('#header_category_button li').on('click', function() {
    currentItem = $(this);
    $(this).siblings().removeClass('active');
    $(this).addClass('active');
    var cat_id = '#' + $(this).data("cat_id");
    $(cat_id).siblings().removeClass('active');
    $(cat_id).addClass('active');
  });
  <?php if(is_page('faq') || is_post_type_archive('support')) { ?>
  $('.support_list .question').on('click', function() {
    $('.support_list .question').not($(this)).removeClass('active');
    if( $(this).hasClass('active') ){
      $(this).removeClass('active');
    } else {
      $(this).addClass('active');
    }
    $(this).next('.answer').slideToggle(600 ,'easeOutExpo');
    $('.support_list .answer').not($(this).next('.answer')).slideUp(600 ,'easeOutExpo');
  });
  <?php }; }; ?>

});
</script>
<?php
     };

     // デザインページ ----------------------------------------------------------
     if(is_page_template('page-design1.php')) {
       $page_hide_footer = get_post_meta($post->ID, 'page_hide_footer', true);
?>
<script type="text/javascript">
jQuery(document).ready(function($){
  $(window).bind('scroll load', function(i) {
    var scTop = $(this).scrollTop();
    var scBottom = scTop + $(this).height();
    $('.inview').each( function(i) {
      var thisPos = $(this).offset().top + 100;
      if ( thisPos < scBottom ) {
        $(this).addClass('animate');
        $(".animate_item",this).each(function(i){
          $(this).delay(i * 500).queue(function(next) {
            $(this).addClass('animate');
            next();
          });
        });
      }
    });
    <?php if($page_hide_footer){ ?>
    var docHeight = $(document).innerHeight();
    var windowHeight = $(this).innerHeight();
    var pageBottom = docHeight - windowHeight;
    if(pageBottom <= scTop) {
      $('.inview').each( function(i) {
        $(this).addClass('animate');
      });
    }
    <?php }; ?>
  });
});
</script>
<?php
     };


     // フッターカルーセル ------------------------------------------------------------
     if($options['show_footer_carousel']){
       wp_enqueue_style('slick-style', apply_filters('page_builder_slider_slick_style_url', get_template_directory_uri().'/js/slick.css'), '', '1.0.0');
       wp_enqueue_script('slick-script', apply_filters('page_builder_slider_slick_script_url', get_template_directory_uri().'/js/slick.min.js'), '', '1.0.0', true);
?>
<script type="text/javascript">
jQuery(document).ready(function($){

  $('#footer_carousel_inner').slick({
    infinite: true,
    dots: false,
    arrows: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    swipeToSlide: true,
    touchThreshold: 20,
    adaptiveHeight: false,
    pauseOnHover: true,
    autoplay: true,
    fade: false,
    easing: 'easeOutExpo',
    speed: 700,
    autoplaySpeed: <?php echo esc_attr($options['footer_carousel_time']); ?>,
    responsive: [
      {
        breakpoint: 1200,
        settings: { slidesToShow: 3 }
      },
      {
        breakpoint: 950,
        settings: { slidesToShow: 2 }
      },
      {
        breakpoint: 650,
        settings: { slidesToShow: 1 }
      }
    ]
  });
  $('#footer_carousel .prev_item').on('click', function() {
    $('#footer_carousel_inner').slick('slickPrev');
  });
  $('#footer_carousel .next_item').on('click', function() {
    $('#footer_carousel_inner').slick('slickNext');
  });

});
</script>
<?php
     };

     // スライダーウィジェット --------------------
     if ( (is_single() && is_active_widget(false, false, 'post_slider_widget', true)) || (is_post_type_archive('news') && is_active_widget(false, false, 'post_slider_widget', true)) || (is_single() && is_active_widget(false, false, 'product_slider_widget', true)) || (is_post_type_archive('news') && is_active_widget(false, false, 'product_slider_widget', true))) {
       wp_enqueue_style('slick-style', apply_filters('page_builder_slider_slick_style_url', get_template_directory_uri().'/js/slick.css'), '', '1.0.0');
       wp_enqueue_script('slick-script', apply_filters('page_builder_slider_slick_script_url', get_template_directory_uri().'/js/slick.min.js'), '', '1.0.0', true);
?>
<script type="text/javascript">
jQuery(document).ready(function($){

  if( $('.post_slider').length ){
    $('.post_slider').slick({
      infinite: true,
      dots: true,
      arrows: false,
      slidesToShow: 1,
      slidesToScroll: 1,
      adaptiveHeight: false,
      pauseOnHover: false,
      autoplay: true,
      fade: false,
      easing: 'easeOutExpo',
      speed: 700,
      autoplaySpeed: 7000
    });
  }

});
</script>
<?php
     } // スライダーウィジェット

     // カスタムスクリプト--------------------------------------------
     if($options['script_code']) {
       echo $options['script_code'];
     };
     if(is_single() || is_page()) {
       global $post;
       $custom_script = get_post_meta($post->ID, 'custom_script', true);
       if($custom_script) {
         echo $custom_script;
       };
     };
?>

<?php
     }; // END function tcd_head()
     add_action("wp_head", "tcd_head");
?>
