<?php
/**
 * Author Page template file
 * */
get_header(); 
$pagetitle = get_theme_mod('singlepagetitle',1); 
if( $pagetitle == 1 ): ?>
<div class="heading-wrap blog-heading-wrap">
    <div class="heading-layer">
        <div class="heading-title">
            <h4><?php
                  esc_html_e('Published by : ', 'best-startup');
                  echo esc_html(get_the_author());
              ?> </h4>
        </div>
    </div>
</div>
<?php endif; ?>
<?php get_template_part('content'); get_footer(); ?>