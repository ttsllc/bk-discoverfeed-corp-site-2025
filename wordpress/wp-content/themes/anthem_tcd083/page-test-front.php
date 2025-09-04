<?php
     $options = get_design_plus_option();
     get_header();
?>
<div id="index_content_builder">

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
 the_content();
 
 endwhile;endif;
 ?>



</div><!-- END #index_content_builder -->
<?php get_footer(); ?>