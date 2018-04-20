<?php
/**
 * Main Page template file
 **/

get_header();
$singlepagetitle = get_theme_mod('singlepagetitle',1); 
if(!is_front_page() && is_page())
{  $pagetitle = get_theme_mod('pagetitle',1);   
    if($pagetitle==1): $singlepagetitle =1; else: $singlepagetitle =0; endif;
}
if( $singlepagetitle == 1 ) : ?>
    <div class="heading-wrap blog-heading-wrap">
        <div class="heading-layer">
            <div class="heading-title">
                <h4><?php the_title(); ?></h4>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <?php $blog_layout_class=(get_theme_mod('blogsinglesidebar',3) == 1)?"9":((get_theme_mod('blogsinglesidebar',3) == 2)?"9":"12");
              if(get_theme_mod('blogsinglesidebar',3) == 1):
                   get_sidebar();
              endif; ?>
            <div class="col-md-<?php echo esc_attr($blog_layout_class); ?> col-sm-12 col-xs-12 blog-article ">
                <?php while ( have_posts() ) : the_post(); ?>
                        <?php the_content();
                            wp_link_pages( array(
                                'before' => '<div class="page-links">' . esc_html__( 'Page:', 'best-startup' ),
                                'after'  => '</div>',
                            ) );
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) {
                            comments_template();
                        } ?>
                <?php endwhile;  ?> 
            </div>
            <?php 
                if(get_theme_mod('blogsinglesidebar',3) == 2):
                        get_sidebar();
                 endif; ?>
        </div>
    </div>
<?php get_footer(); ?>