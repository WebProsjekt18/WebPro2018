<?php
/*
* Single Post template file
*/
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
<div class="single-blog-wrapper">
    <div class="best-startup-section">
        <div class="container">
            <div class="row responsive">
                 <?php 
                $blog_layout_class=(get_theme_mod('blogsinglesidebar',3) == 1)?"9":((get_theme_mod('blogsinglesidebar',3) == 2)?"9":"12");
                if(get_theme_mod('blogsinglesidebar',3) == 1):
                        get_sidebar();
                 endif;
                ?>  
                <div class="col-md-<?php echo esc_attr($blog_layout_class); ?> col-sm-12 col-xs-12 content">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div class="single-blog-content-area fadeIn animated">
                            <div class="single-blog-content">
                               
                                <?php if ( has_post_thumbnail() ) : ?>
                                 <div class="single-blog-images">
                                    <?php the_post_thumbnail( 'best-startup-thumbnail-image', array( 'class' => 'img-responsive') ); ?>
                                </div>
                                <?php endif; ?>
                                 <div class="title-data fadeIn animated">
                                    <h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
                                    <?php if(get_theme_mod('blogSingleMetaTag',1) == 1): ?>
                                            <?php best_startup_entry_meta(); ?>
                                    <?php endif; ?>
                                </div>
                                <?php   the_content(); 
                                    wp_link_pages( array(
                                    'before' => '<div class="page-links">' . esc_html__( 'Post:', 'best-startup' ),
                                    'after'  => '</div>',
                                    ) );?>
                            </div>                            
                           <?php // Previous/next page navigation.
                           the_post_navigation( array(
                                'prev_text'          => esc_html__( 'Previous page', 'best-startup' ),
                                'next_text'          => esc_html__( 'Next page', 'best-startup' ),
                                'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'best-startup' ) . ' </span>',
                            ) );
                           
                           if ( comments_open() || get_comments_number() ) :
                                    comments_template();
                                endif; ?>
                        </div>                        
                <?php endwhile; ?>
                </div>
                 <?php 
                if(get_theme_mod('blogsinglesidebar',3) == 2 ):
                        get_sidebar();
                 endif;
                ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>