<?php
/*
 * Archive Template File.
 */
get_header(); 
$pagetitle = get_theme_mod('singlepagetitle',1); 
if( $pagetitle == 1 ): ?>
<!--archive posts start-->
<div class="heading-wrap blog-heading-wrap">
    <div class="heading-layer">
        <div class="heading-title">
            <h4> <?php esc_html_e('Archive ','best-startup'); the_archive_title(); ?> </h4>
        </div>
    </div>
</div>
<?php endif; ?>
<?php  get_template_part('content'); get_footer(); ?>