<?php
/*
 * best-startup default footer file
 */
$footer_widget_style = get_theme_mod('footerWidgetStyle',3);
$hide_footer_widget_bar = get_theme_mod('hideFooterWidgetBar',1); ?>
<footer>
    <?php if(($hide_footer_widget_bar == 1) || ($hide_footer_widget_bar == '')) : 
        $footer_widget_style = $footer_widget_style+1;
        $footer_column_value = floor(12/($footer_widget_style)); ?>
        <div class="footer-box">
            <div class="container">
                <div class="row">
                    <?php $k = 1; ?>
                    <?php for( $i=0; $i<$footer_widget_style; $i++) { ?>
                        <?php if (is_active_sidebar('footer-'.$k)) { ?>
                            <div class="col-md-<?php echo esc_attr($footer_column_value); ?> col-sm-<?php echo esc_attr($footer_column_value); ?> col-xs-12"><?php dynamic_sidebar('footer-'.$k); ?></div>
                        <?php }
                        $k++;
                    } ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="footer-wrap style2">
        <div class="container">
            <div class="best-startup-section">
                <div class="row">
                    <div class="col-md-4 col-xs-12 col-sm-4">
                        <div class="copyright fadeIn animated">                            
                            <p><?php esc_html_e('Powered by ','best-startup');?><a href="<?php echo esc_url('https://electrathemes.com/wordpress-themes/best-startup/','best-startup'); ?>" target="_blank"><?php esc_html_e('Best Startup WordPress Theme','best-startup'); ?></a></p>
                            
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12 col-sm-4">
                        <p><?php echo wp_kses_post(get_theme_mod('CopyrightAreaText')); ?></p>
                        <?php if(get_theme_mod('footerLogo') != '') : ?>
                            <div class="footer-logo fadeIn animated">
                                <?php $footer_logo=get_theme_mod('footerLogo'); $footer_logo=wp_get_attachment_url($footer_logo);?>
                                <img class="img-responsive" src="<?php echo esc_url($footer_logo); ?>" alt="<?php esc_attr_e('Footer Logo','best-startup');?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-4 col-xs-12 col-sm-4">
                        <div class="footer-social-icon fadeIn animated">
                            <ul>
                                <?php for($i=1; $i<=6; $i++) : ?>
                                <?php if(get_theme_mod('best_startup_social_icon'.$i) != '' && get_theme_mod('best_startup_social_icon_links'.$i) != '' ): ?>
                                    <li>
                                        <a href="<?php echo esc_url(get_theme_mod('best_startup_social_icon_links'.$i)); ?>" class="fb" title="" target="_blank">
                                            <i class="fa <?php echo esc_attr(get_theme_mod('best_startup_social_icon'.$i)); ?>"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php endfor; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>