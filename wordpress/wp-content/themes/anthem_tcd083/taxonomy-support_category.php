<?php
     // redirect to Support archive page
     $support_archive_page = get_post_type_archive_link('support');
     wp_safe_redirect( $support_archive_page );
     exit;
?>