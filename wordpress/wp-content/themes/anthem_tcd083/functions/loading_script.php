<?php
     function has_loading_screen(){
       $options = get_design_plus_option();
?>
<script>

<?php if(wp_is_mobile()) { ?>
jQuery(window).bind("pageshow", function(event) {
  if (event.originalEvent.persisted) {
    window.location.reload()
  }
});
<?php }; ?>

jQuery(document).ready(function($){

  var winH = $(window).innerHeight();

  function after_load() {
    <?php if($options['load_screen_animation_type'] == 'type1'){ ?>
    $('#site_loader_overlay').delay(600).fadeOut(900);
    <?php } elseif($options['load_screen_animation_type'] == 'type2'){ ?>
    $('#site_loader_overlay').addClass('active slide_up');
    <?php } elseif($options['load_screen_animation_type'] == 'type3'){ ?>
    $('#site_loader_overlay').addClass('active slide_down');
    <?php } elseif($options['load_screen_animation_type'] == 'type4'){ ?>
    $('#site_loader_overlay').addClass('active slide_left');
    <?php } else { ?>
    $('#site_loader_overlay').addClass('active slide_right');
    <?php }; ?>
    <?php
         // front page -----------------------------------
         if(is_front_page()) {
           $display_header_content = '';
           if(!is_mobile() && $options['show_index_slider']) {
             $display_header_content = 'show';
           } elseif(is_mobile() && ($options['mobile_show_index_slider'] != 'type3') ) {
             $display_header_content = 'show';
           }
           if($display_header_content == 'show') {
    ?>
    setTimeout(function(){
      $('#header_slider_content').slick('slickPlay');
      $('#header_slider_content').slick('setPosition');
      $('#header_slider_content .item1').addClass('animate');
      $('#header_slider_content .item1 .animate_item').each(function(i){
        $(this).delay(i *500).queue(function(next) {
        $(this).addClass('animate');
          next();
        });
      });
    },700);
    <?php
           };
         };
         // #page header -----------------------------------
    ?>
    $('#page_header_wrap .animate_item').each(function(i){
      $(this).delay(i *500).queue(function(next) {
      $(this).addClass('animate');
        next();
      });
    });
    <?php
         // 404 -----------------------------------
         if(is_404()) {
           echo "$('#page_404_header').addClass('animate');\n";
         };

         // page builder -----------------------------------
         if(is_single() || is_page()) {
           if(page_builder_has_widget('pb-widget-slider')) {
             echo "$('.pb_slider').slick('setPosition');\n";
           };
         };
    ?>
  }

  <?php if ($options['load_icon'] != 'type4') { ?>
  $(window).load(function () {
    $('#site_loader_overlay').css('height', winH);
    after_load();
  });
  <?php }; ?>

  $(function(){
    $('#site_loader_overlay').css('height', winH);
    <?php if ($options['load_icon'] == 'type4') { ?>
    $('#site_loader_logo').addClass('active');
    <?php }; ?>
    setTimeout(function(){
      if( $('#site_loader_overlay').is(':visible') ) {
        after_load();
      }
    }, <?php if($options['load_time']) { echo esc_html($options['load_time']); } else { echo '7000'; }; ?>);
  });

});
</script>
<?php } ?>
<?php
     // no loading ------------------------------------------------------------------------------------------------------------------
     function no_loading_screen(){
       $options = get_design_plus_option();
?>
<script>

<?php if(wp_is_mobile()) { ?>
jQuery(window).bind("pageshow", function(event) {
  if (event.originalEvent.persisted) {
    window.location.reload()
  }
});
<?php }; ?>

jQuery(document).ready(function($){

  <?php
       // front page -----------------------------------
       if(is_front_page()) {
         $display_header_content = '';
         if(!is_mobile() && $options['show_index_slider']) {
           $display_header_content = 'show';
         } elseif(is_mobile() && ($options['mobile_show_index_slider'] != 'type3') ) {
           $display_header_content = 'show';
         }
         if($display_header_content == 'show') {
  ?>
  $('#header_slider_content').slick('slickPlay');
  $('#header_slider_content .item1').addClass('animate');
  $('#header_slider_content .item1 .animate_item').each(function(i){
    $(this).delay(i *500).queue(function(next) {
    $(this).addClass('animate');
      next();
    });
  });
  <?php
         };
       };
       // Page header -----------------------------------
  ?>
  $('#page_header_wrap .animate_item:not(:hidden)').each(function(i){
      $(this).delay(i *500).queue(function(next) {
        $(this).addClass('animate');
        next();
      });
  });
  <?php
       // 404 -----------------------------------
       if(is_404()) {
         echo "$('#page_404_header').addClass('animate');\n";
       };
  ?>

});
</script>
<?php } ?>