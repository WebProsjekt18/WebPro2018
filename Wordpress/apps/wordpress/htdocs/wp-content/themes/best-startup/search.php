<?php
/*
 * Search Template File
 */
get_header(); ?>
<div class="heading-wrap blog-heading-wrap">
    <div class="heading-layer">
        <div class="heading-title">
            <h4><?php
                esc_html_e('Search results for', 'best-startup');
                echo " : " . get_search_query();
            ?></h4>
        </div>
    </div>
</div>
<?php if (have_posts()) : ?>
    <?php get_template_part('content'); ?>
<?php else : ?>
    <div class="best-startup-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="blog-content-area fadeIn animated">
                        <div class="search-area">
                            <p class="spage">
                                <?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords', 'best-startup'); ?>.</p>
                            <?php get_search_form(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; get_footer(); ?>