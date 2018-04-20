<?php
/*
 * best startup Main Sidebar
 */
function best_startup_widgets_init() {
    register_sidebar(array(
        'name' => __('Main Sidebar', 'best-startup'),
        'id' => 'sidebar-1',
        'description' => __('Main sidebar that appears on the right.', 'best-startup'),
        'before_widget' => '<aside id="%1$s" class="menu-left widget widget_recent_entries %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h6>',
        'after_title' => '</h6>',
    ));
    register_sidebar(array(
        'name' => __('Footer 1', 'best-startup'),
        'id' => 'footer-1',
        'description' => __('Footer that appears on the down.', 'best-startup'),
        'before_widget' => '<aside id="%1$s" class="footer-widget widget widget_recent_entries %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => __('Footer 2', 'best-startup'),
        'id' => 'footer-2',
        'description' => __('Footer that appears on the down.', 'best-startup'),
        'before_widget' => '<aside id="%1$s" class="footer-widget widget widget_recent_entries %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => __('Footer 3', 'best-startup'),
        'id' => 'footer-3',
        'description' => __('Footer that appears on the down.', 'best-startup'),
        'before_widget' => '<aside id="%1$s" class="footer-widget widget widget_recent_entries %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => __('Footer 4', 'best-startup'),
        'id' => 'footer-4',
        'description' => __('Footer that appears on the down.', 'best-startup'),
        'before_widget' => '<aside id="%1$s" class="footer-widget widget widget_recent_entries %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
}
add_action('widgets_init', 'best_startup_widgets_init');
/**
 * Set up post entry meta.    
 * Meta information for current post: categories, tags, permalink, author, and date.    
 * */
function best_startup_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'&hellip;';
  } else {
    $excerpt = implode(" ",$excerpt);
  } 
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
} 

function best_startup_entry_meta() {	
  $best_startup_TagList = get_the_tag_list('', esc_html__( ', #', 'best-startup' )); 
   if($best_startup_TagList): ?>
    <p> <?php echo get_the_tag_list('', esc_html__( ', #', 'best-startup' ));?>	</p>
  <?php endif; ?>
    <p><?php esc_html_e('By : ', 'best-startup'); ?><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="tag"><?php echo esc_html(ucfirst(get_the_author())); ?></a> - <?php echo sprintf('<time datetime="%1$s">%2$s</time>', esc_attr(get_the_date('c')), esc_html(get_the_date('F d , Y'))); ?></p>
<?php 	
}

/*
* TGM plugin activation register hook 
*/
add_action( 'tgmpa_register', 'best_startup_action_tgm_plugin_active_register_required_plugins' );
function best_startup_action_tgm_plugin_active_register_required_plugins() {
    if(class_exists('TGM_Plugin_Activation')){
      $plugins = array(
        array(
           'name'      => __('Page Builder by SiteOrigin','best-startup'),
           'slug'      => 'siteorigin-panels',
           'required'  => false,
        ),
        array(
           'name'      => __('SiteOrigin Widgets Bundle','best-startup'),
           'slug'      => 'so-widgets-bundle',
           'required'  => false,
        ),
        array(
           'name'      => __('Contact Form 7','best-startup'),
           'slug'      => 'contact-form-7',
           'required'  => false,
        ),
      );
      $config = array(
        'default_path' => '',
        'menu'         => 'best-startup-install-plugins',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
        'strings'      => array(
           'page_title'                      => __( 'Install Recommended Plugins', 'best-startup' ),
           'menu_title'                      => __( 'Install Plugins', 'best-startup' ),           
           'nag_type'                        => 'updated'
        )
      );
      tgmpa( $plugins, $config );
    }
}