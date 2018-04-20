<?php
/**
* Template Name: Full Page Layout
**/
get_header();
$singlepagetitle = 0; 
if(!is_front_page() && is_page())
{  $pagetitle = get_theme_mod('pagetitle',1);   
    if($pagetitle==1): $singlepagetitle =1; else: $singlepagetitle =0; endif;
}
if( $singlepagetitle == 1 ) : ?> 
<div class="heading-wrap blog-heading-wrap">
    <div class="heading-layer">
        <div class="heading-title"><h4><?php the_title(); ?></h4></div>
    </div>
</div>    
<?php endif;  ?>  
    <div class="container">
        <div class="row">          
            <div class="col-md-12 col-sm-12 col-xs-12 blog-article">
                <?php while ( have_posts() ) : the_post(); ?>
                        <?php the_content();
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) {
                            comments_template();
                        } ?>
                <?php endwhile;  ?> 
            </div>            
        </div>
    </div>
<?php get_footer(); ?>