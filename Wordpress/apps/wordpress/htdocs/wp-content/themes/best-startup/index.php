<?php
/**
 * The main template file
 **/

get_header();
$pagetitle = get_theme_mod('pagetitle',1);
if( $pagetitle == 1 ) : ?> 
<div class="heading-wrap blog-heading-wrap" >
    <div class="heading-layer">
        <div class="heading-title">
            <h4><?php esc_html_e('Blog ','best-startup'); ?></h4>
        </div>
    </div>
</div> 
<?php endif;
get_template_part('content');
get_footer(); ?>