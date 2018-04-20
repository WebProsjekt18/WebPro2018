<div class="blog-wrapper">
    <div class="">
        <div class="container">
            <div id="post-<?php the_ID(); ?>" <?php post_class( 'row responsive' ); ?>>
                <?php $blog_layout_class=(get_theme_mod('blogsidebar',3) == 1)?"9":((get_theme_mod('blogsidebar',3) == 2)?"9":"12");
                if(get_theme_mod('blogsidebar',3) == 1):
                        get_sidebar();
                 endif;
                ?>                
                <div class="col-md-<?php echo esc_attr($blog_layout_class); ?> col-sm-12 col-xs-12 content blog-layout-one">
                    <div class="blog-content-area fadeIn animated">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <div class="col-md-6 col-sm-6 col-xs-12 fadeIn animated">
                                <div class="blog-content view view-fifth">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="blog-images">
                                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'best-startup-thumbnail-image', array( 'class' => 'img-responsive') ); ?></a>
                                    </div>
                                    <?php else: ?>                                        
                                        <div class="blog-images">
                                            <a href="<?php the_permalink(); ?>">
                                                <div class="no-post-thumbnail"><i class="fa fa-image"></i> </div>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="blog-inner-content mask">
                                        <div class="title-data fadeIn animated">
                                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                           <?php if(get_theme_mod('blogMetaTag') == 1):?>
                                             <?php best_startup_entry_meta(); ?>
                                          <?php endif; ?>
                                        </div>
                                        <?php if(get_theme_mod('blogPostExcerpt',1) == 1): ?> 
                                          <p><?php echo esc_html(best_startup_excerpt(absint(get_theme_mod('blogPostExcerptTextLimit',15)))); ?></p>
                                        <?php endif; ?> 
                                        <?php if(get_theme_mod('blogPostReadMore',1) == 1): ?>  
                                        <a href="<?php the_permalink();?>" class="btn-light"><?php esc_html_e('READ MORE','best-startup'); ?></a>
                                        <?php endif; ?> 
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;  ?> 
                        <?php the_posts_pagination( array(
                            'Previous' => __( 'Back', 'best-startup' ),
                            'Next' => __( 'Onward', 'best-startup' ),
                        ) ); ?>
                    </div>
                </div>
                <?php 
                if(get_theme_mod('blogsidebar',3) == 2):
                        get_sidebar();
                 endif;
                ?>
            </div>
        </div>
    </div>
</div>