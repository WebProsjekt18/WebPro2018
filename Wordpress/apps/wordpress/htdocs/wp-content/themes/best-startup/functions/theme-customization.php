<?php
/**
* Best Startup Customization options
**/
//get categories

if ( ! function_exists( 'best_startup_field_sanitize_checkbox' ) ) :
  function best_startup_field_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true === $checked ) ? true : false );
}
endif;

if ( ! function_exists( 'best_startup_field_sanitize_input_choice' ) ) :
function best_startup_field_sanitize_input_choice( $input, $setting ) {

  // Ensure input is a slug.
  $input = sanitize_key( $input );

  // Get list of choices from the control associated with the setting.
  $choices = $setting->manager->get_control( $setting->id )->choices;

  // If the input is a valid key, return it; otherwise, return the default.
  return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
endif;

function best_startup_customize_register( $wp_customize ) {
  $wp_customize->add_panel(
    'general',
    array(
        'title' => __( 'General', 'best-startup' ),
        'description' => __('styling options','best-startup'),
        'priority' => 20, 
    )
  );
   //All our sections, settings, and controls will be added here
  $wp_customize->add_section(
    'BestStartupSocialLinks',
    array(
      'title' => __('Social Accounts', 'best-startup'),
      'priority' => 120,
      'description' => __( 'In first input box, you need to add FONT AWESOME shortcode which you can find ' ,  'best-startup').'<a target="_blank" href="'.esc_url('https://fortawesome.github.io/Font-Awesome/icons/').'">'.__('here' ,  'best-startup').'</a>'.__(' and in second input box, you need to add your social media profile URL.', 'best-startup').'<br />'.__(' Enter the URL of your social accounts. Leave it empty to hide the icon.' ,  'best-startup'),
      'panel' => 'footer'
    )
  );
  $wp_customize->get_section('title_tagline')->panel = 'general';
  $wp_customize->get_section('header_image')->panel = 'general';
  $wp_customize->get_section('static_front_page')->panel = 'general';
  $wp_customize->get_section('title_tagline')->title = __('Header & Logo','best-startup');
  
 $best_startup_social_icon = array();
for($i=1;$i <= 10;$i++):  
    $best_startup_social_icon[] =  array( 'slug'=>sprintf('best_startup_social_icon%d',$i),   
      'default' => '',   
      'label' => sprintf(esc_html__( 'Social Account %s', 'best-startup' ),$i),
      'priority' => sprintf('%d',$i) );  
  endfor;
foreach($best_startup_social_icon as $best_startup_social_icons){
    $wp_customize->add_setting(
        $best_startup_social_icons['slug'],
        array(
          'default' => '',
          'capability'     => 'edit_theme_options',         
          'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        $best_startup_social_icons['slug'],
        array('type' => 'text',
            'input_attrs' => array( 'placeholder' => esc_attr__('Enter Icon','best-startup') ),
            'section' => 'BestStartupSocialLinks',
            'label'      =>   $best_startup_social_icons['label'],
            'priority' => $best_startup_social_icons['priority']
        )
    );
}
$best_startup_social_icon_links = array();
for($i=1;$i <= 10;$i++):  
    $best_startup_social_icon_links[] =  array( 'slug'=>sprintf('best_startup_social_icon_links%d',$i),   
      'default' => '',   
      'label' => sprintf(esc_html__( 'Social Link %s', 'best-startup' ),$i),   
      'priority' => sprintf('%d',$i) );  
  endfor;

foreach($best_startup_social_icon_links as $best_startup_social_icons){
    $wp_customize->add_setting(
        $best_startup_social_icons['slug'],
        array(
            'default' => '',
            'capability'     => 'edit_theme_options',           
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        $best_startup_social_icons['slug'],
        array('type' => 'url',
            'input_attrs' => array( 'placeholder' => esc_attr__('Enter URL','best-startup') ),
            'section' => 'BestStartupSocialLinks',
            'priority' => $best_startup_social_icons['priority']
        )
    );
}
$wp_customize->add_section(
  'headerNlogo',
  array(
    'title' => __('Header & Logo','best-startup'),
    'panel' => 'general'
  )
);
$wp_customize->add_setting(
    'theme_header_style',
    array(
        'default' => 'style1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'priority' => 20, 
    )
);

/*
*Multiple logo upload code
*/
$wp_customize->add_setting(
    'BestStartupDarkLogo',
    array(
        'default' => '',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'BestStartupDarkLogo', array(
    'section'     => 'title_tagline',
    'label'       => __( 'Upload Dark Logo' ,'best-startup'),
    'flex_width'  => true,
    'flex_height' => true,
    'width'       => 120,
    'height'      => 50,
    'priority'    => 48,
    'default-image' => '',
) ) );

$wp_customize->add_setting('theme_header_fix', array(
        'default' => false,  
        'sanitize_callback' => 'best_startup_field_sanitize_checkbox',
));
$wp_customize->add_control('theme_header_fix', array(
    'label'   => esc_html__('Header Fix','best-startup'),
    'section' => 'title_tagline',
    'type'    => 'checkbox',
    'priority' => 49
));

$wp_customize->add_setting(
  'theme_logo_height',
  array(
    'default' => '',
    'capability'     => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
  );
$wp_customize->add_control(
  'theme_logo_height',
  array(
    'section' => 'title_tagline',
    'label'      => __('Enter Logo Size', 'best-startup'),
    'description' => __("Use if you want to increase or decrease logo size (optional) Don't enter `px` in the string. e.g. 20 (default: 10px)",'best-startup'),
    'type'       => 'text',
    'priority'    => 50,
    )
  );

$wp_customize->add_setting(
    'preloader',
    array(
        'default' => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'best_startup_field_sanitize_input_choice',
        'priority' => 20, 
    )
);
$wp_customize->add_section( 'preloaderSection' , array(
    'title'       => __( 'Preloader', 'best-startup' ),
    'priority'    => 32,
    'capability'     => 'edit_theme_options',
    'panel' => 'general'
) );
$wp_customize->add_control(
    'preloader',
    array(
        'section' => 'preloaderSection',                
        'label'   => __('Preloader','best-startup'),
        'type'    => 'radio',
        'choices'        => array(
            "1"   => esc_html__( "On ", 'best-startup' ),
            "2"   => esc_html__( "Off", 'best-startup' ),
        ),
    )
);

$wp_customize->add_setting( 'customPreloader', array(
    'sanitize_callback' => 'esc_url_raw',
    'capability'     => 'edit_theme_options',
    'priority' => 40,
));

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'customPreloader', array(
    'label'    => __( 'Upload Custom Preloader', 'best-startup' ),
    'section'  => 'preloaderSection',
    'settings' => 'customPreloader',
) ) );

$wp_customize->add_section( 'homepageSection' , array(
    'title'       => __( 'Menu Settings', 'best-startup' ),
    'priority'    => 40,
    'capability'     => 'edit_theme_options',
    'panel' => 'general'
) );

$wp_customize->add_setting( 'menustyle', array(
    'capability'     => 'edit_theme_options',
    'priority' => 40,
    'default' => '0',
    'sanitize_callback' => 'best_startup_field_sanitize_input_choice',
));

$wp_customize->add_control( 'menustyle', array(
    'label'    => __( 'Menu Style', 'best-startup' ),
    'section'  => 'homepageSection',
    'type'       => 'select',
    
    'choices' => array(
      "0"   => esc_html__( "Transparent", 'best-startup' ),
      "1"   => esc_html__( "Non-Transparent", 'best-startup' ),
    ),
));

$wp_customize->add_setting( 'pagetitle', array(
    'capability'     => 'edit_theme_options',
    'priority' => 40,
     'default' => '1',
    'sanitize_callback' => 'best_startup_field_sanitize_input_choice',
));

$wp_customize->add_control( 'pagetitle', array(
    'label'    => __( 'Blog Archive Page Title', 'best-startup' ),
    'section'  => 'homepageSection',
    'type'       => 'select',   
    'choices' => array(
      "0"   => esc_html__( "Hide", 'best-startup' ),
      "1"   => esc_html__( "Show", 'best-startup' ),
    ),
));
$wp_customize->add_setting( 'singlepagetitle', array(
    'capability'     => 'edit_theme_options',
    'priority' => 40,
     'default' => '1',
    'sanitize_callback' => 'best_startup_field_sanitize_input_choice',
));

$wp_customize->add_control( 'singlepagetitle', array(
    'label'    => __( 'Single Page & Post Title', 'best-startup' ),
    'section'  => 'homepageSection',
    'type'       => 'select',   
    'choices' => array(
      "0"   => esc_html__( "Hide", 'best-startup' ),
      "1"   => esc_html__( "Show", 'best-startup' ),
    ),
));

//Colors section
$wp_customize->add_setting(
    'themeColor',
    array(
        'default' => '#ea8800',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'themeColor',
    array(
        'label'      => __('Theme Color ', 'best-startup'),
        'section' => 'colors',
        'priority' => 10
    )
  )
);
$wp_customize->add_setting(
  'secondaryColor',
  array(
      'default' => '#2c3e55',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'secondaryColor',
    array(
        'label'      => __('Secondary Color', 'best-startup'),
        'section' => 'colors',
        'priority' => 11
    )
  )
);
//Menu Background Color
$wp_customize->add_setting(
  'menuBackgroundColor',
  array(
      'default' => '',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'menuBackgroundColor',
    array(
        'label'      => __('Menu Background Color', 'best-startup'),
        'section' => 'colors',
        'priority' => 11
    )
  )
);
//Menu Background Color (Scroll)
$wp_customize->add_setting(
  'menuBackgroundColorScroll',
  array(
      'default' => '#fff',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'menuBackgroundColorScroll',
    array(
        'label'      => __('Menu Background Color (after scroll)', 'best-startup'),
        'section' => 'colors',
        'priority' => 11
    )
  )
);
//Menu Text Color
$wp_customize->add_setting(
  'menuTextColor',
  array(
      'default' => '#000000',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'menuTextColor',
    array(
        'label'      => __('Menu Text Color', 'best-startup'),
        'section' => 'colors',
        'priority' => 11
    )
  )
);
//Menu Text Color
$wp_customize->add_setting(
  'menuTextColorScroll',
  array(
      'default' => '#000',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'menuTextColorScroll',
    array(
        'label'      => __('Menu Text Color(after scroll)', 'best-startup'),
        'section' => 'colors',
        'priority' => 11
    )
  )
);
//Body Background Color
$wp_customize->add_setting(
  'bodyBackgroundColor',
  array(
      'default' => '#ffffff',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'bodyBackgroundColor',
    array(
        'label'      => __('Body Background Color', 'best-startup'),
        'section' => 'colors',
        'priority' => 11
    )
  )
);
//Body Text Color
$wp_customize->add_setting(
  'bodyTextColor',
  array(
      'default' => '#424242',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'bodyTextColor',
    array(
        'label'      => __('Body Text Color', 'best-startup'),
        'section' => 'colors',
        'priority' => 11
    )
  )
);
//Footer Background Color
$wp_customize->add_setting(
  'footerBackgroundColor',
  array(
      'default' => '#2C3E55',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'footerBackgroundColor',
    array(
        'label'      => __('Footer Background Color', 'best-startup'),
        'section' => 'colors',
        'priority' => 14
    )
  )
);
$wp_customize->add_setting(
  'footerTextColor',
  array(
      'default' => '#ffffff',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'footerTextColor',
    array(
        'label'      => __('Footer Text Color', 'best-startup'),
        'section' => 'colors',
        'priority' => 14
    )
  )
);
$wp_customize->add_setting(
  'footerLinkColor',
  array(
      'default' => '#ffffff',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'footerLinkColor',
    array(
        'label'      => __('Footer Link Color', 'best-startup'),
        'section' => 'colors',
        'priority' => 14
    )
  )
);
$wp_customize->add_setting(
  'footerLinkHoverColor',
  array(
      'default' => '#ea8800',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
  new WP_Customize_Color_Control(
    $wp_customize,
    'footerLinkHoverColor',
    array(
        'label'      => __('Footer Link Hover Color', 'best-startup'),
        'section' => 'colors',
        'priority' => 14
    )
  )
);

/* Color Section Ends */

/*-------------------- BLog Page Option --------------------------*/
$wp_customize->add_section(
    'blogThemeOption',
    array(
        'title' => __( 'Blog Page Options', 'best-startup' ),
        'description' => __('Blog page option settings. ','best-startup'),
        'priority' => 124,
       
    )
);
$wp_customize->add_setting(
    'blogsidebar',
    array(
        'default' => '3',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'best_startup_field_sanitize_input_choice',
    )
);
$wp_customize->add_control(
    'blogsidebar',
    array(
        'section' => 'blogThemeOption',
        'label'      => __('Select Blog Sidebar Option', 'best-startup'),
        'type'       => 'select',
        'choices' => array(
          "1"   => esc_html__( "Left Sidebar", 'best-startup' ),
          "2"   => esc_html__( "Right Sidebar", 'best-startup' ),
          "3"   => esc_html__( "Full Sidebar", 'best-startup' ),          
        ),
    )
);
$wp_customize->add_setting(
    'blogsinglesidebar',
    array(
        'default' => '3',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'best_startup_field_sanitize_input_choice',
    )
);
$wp_customize->add_control(
    'blogsinglesidebar',
    array(
        'section' => 'blogThemeOption',
        'label'      => __('Select Single Post Sidebar Option', 'best-startup'),
        'type'       => 'select',
        'choices' => array(
          "1"   => esc_html__( "Left Sidebar", 'best-startup' ),
          "2"   => esc_html__( "Right Sidebar", 'best-startup' ),         
          "3"   => esc_html__( "Full Sidebar", 'best-startup' ),
        ),
    )
);
$wp_customize->add_setting(
    'blogMetaTag',
    array(
        'default' => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'best_startup_field_sanitize_input_choice',
    )
);
$wp_customize->add_control(
    'blogMetaTag',
    array(
        'section' => 'blogThemeOption',
        'label'      => __('Select Blog Post Meta Tag Option', 'best-startup'),
        'type'       => 'select',
        'choices' => array(
          "1"   => esc_html__( "Show", 'best-startup' ),
          "2"   => esc_html__( "Hide", 'best-startup' ),      
        ),
    )
);
$wp_customize->add_setting(
    'blogSingleMetaTag',
    array(
        'default' => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'best_startup_field_sanitize_input_choice',
    )
);
$wp_customize->add_control(
    'blogSingleMetaTag',
    array(
        'section' => 'blogThemeOption',
        'label'      => __('Select Single Post Meta Tag Option', 'best-startup'),
        'type'       => 'select',
        'choices' => array(
          "1"   => esc_html__( "Show", 'best-startup' ),
          "2"   => esc_html__( "Hide", 'best-startup' ),      
        ),
    )
);

$wp_customize->add_setting(
    'blogPostExcerpt',
    array(
        'default' => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'best_startup_field_sanitize_input_choice',
    )
);
$wp_customize->add_control(
    'blogPostExcerpt',
    array(
        'section' => 'blogThemeOption',
        'label'      => __('Select Blog Post Excerpt Option', 'best-startup'),
        'type'       => 'select',
        'choices' => array(
          "1"   => esc_html__( "Show", 'best-startup' ),
          "2"   => esc_html__( "Hide", 'best-startup' ),      
        ),
    )
);
$wp_customize->add_setting(
    'blogPostExcerptTextLimit',
    array(
        'default' => '150',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'blogPostExcerptTextLimit',
    array(
        'section' => 'blogThemeOption',
        'label'      => __('Blog Post Excerpt String Limit Option', 'best-startup'),
        'type'       => 'text',        
    )
);
$wp_customize->add_setting(
    'blogPostReadMore',
    array(
        'default' => '1',
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'best_startup_field_sanitize_input_choice',
    )
);
$wp_customize->add_control(
    'blogPostReadMore',
    array(
        'section' => 'blogThemeOption',
        'label'      => __('Select Blog Post Read More Button Option', 'best-startup'),
        'type'       => 'select',
        'choices' => array(
          "1"   => esc_html__( "Show", 'best-startup' ),
          "2"   => esc_html__( "Hide", 'best-startup' ),      
        ),
    )
);

/*------------------------ Blog  Page option End ----------------------------*/

//Footer Section
$wp_customize->add_panel(
    'footer',
    array(
        'title' => __( 'Footer', 'best-startup' ),
        'description' => __('Footer options','best-startup'),
        'priority' => 105, 
    )
);
$wp_customize->add_section( 'footerWidgetArea' , array(
    'title'       => __( 'Footer Widget Area', 'best-startup' ),
    'priority'    => 135,
    'capability'     => 'edit_theme_options',
    'panel' => 'footer'
) );

$wp_customize->add_section( 'footerSocialSection' , array(
    'title'       => __( 'Social Settings', 'best-startup' ),
    'description' => __( 'In first input box, you need to add FONT AWESOME shortcode which you can find ' , 'best-startup').'<a target="_blank" href="'.esc_url('https://fortawesome.github.io/Font-Awesome/icons/').'">'.__('here' , 'best-startup').'</a>'.__('and in second input box, you need to add your social media profile URL.' , 'best-startup'),
    'priority'    => 135,
    'capability'     => 'edit_theme_options',
    'panel' => 'footer'
) );
$wp_customize->add_section( 'footerCopyright' , array(
    'title'       => __( 'Footer Copyright Area', 'best-startup' ),
    'priority'    => 135,
    'capability'     => 'edit_theme_options',
    'panel' => 'footer'
) );
$wp_customize->add_setting(
  'hideFooterWidgetBar',
  array(
      'default' => '2',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'best_startup_field_sanitize_input_choice',
      'priority' => 20, 
  )
);
$wp_customize->add_control(
  'hideFooterWidgetBar',
  array(
    'section' => 'footerWidgetArea',                
    'label'   => __('Hide Widget Area','best-startup'),
    'type'    => 'select',
    'choices' => array(
        "1"   => esc_html__( "Show", 'best-startup' ),
        "2"   => esc_html__( "Hide", 'best-startup' ),
    ),
  )
);
$wp_customize->add_setting(
  'footerWidgetStyle',
  array(
      'default' => '3',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'best_startup_field_sanitize_input_choice',
      'priority' => 20, 
  )
);
$wp_customize->add_control(
  'footerWidgetStyle',
  array(
      'section' => 'footerWidgetArea',                
      'label'   => __('Select Widget Area','best-startup'),
      'type'    => 'select',
      'choices'        => array(
          "1"   => esc_html__( "2 column", 'best-startup' ),
          "2"   => esc_html__( "3 column", 'best-startup' ),
          "3"   => esc_html__( "4 column", 'best-startup' )
      ),
  )
);

$wp_customize->add_setting(
    'CopyrightAreaText',
    array(
        'capability'     => 'edit_theme_options',
        'sanitize_callback' => 'wp_kses_post',
        'priority' => 20, 
    )
);
$wp_customize->add_control(
    'CopyrightAreaText',
    array(
        'section' => 'footerCopyright',                
        'label'   => __('Enter Copyright Text','best-startup'),
        'type'    => 'textarea',
    )
);
// Text Panel Starts Here 

}
add_action( 'customize_register', 'best_startup_customize_register' );

function best_startup_custom_css(){
 
  wp_enqueue_style( 'best_startup_style', get_stylesheet_uri(),null);
  $custom_css='';

  $custom_css.="
    .navbar {
      background: ".esc_attr(get_theme_mod('menuBackgroundColor', 'transparent')).";
    }
    .best-startup-fixed-top,.best-startup-fixed-top #cssmenu ul.sub-menu{
      background-color: ".esc_attr(get_theme_mod('menuBackgroundColor','transparent')).";
    }
    #top-menu ul ul li a{
      background-color: ".esc_attr(get_theme_mod('themeColor','#ea8800')).";
    }
    .fixed-header #top-menu ul ul li a{
      background-color: ".esc_attr(get_theme_mod('menuBackgroundColorScroll','#fff')).";
    }
    .fixed-header,.fixed-header #cssmenu ul.sub-menu,.fixed-header #top-menu ul{
      background-color: ".esc_attr(get_theme_mod('menuBackgroundColorScroll','#fff')).";
    }
    .header-top.no-transparent{
      position:relative; 
      background-color:".esc_attr(get_theme_mod('menuBackgroundColor','transparent')).";
    }";

    /*Main logo height*/
    $theme_logo_height = (get_theme_mod('theme_logo_height'))?(get_theme_mod('theme_logo_height')):55;
    $custom_css.= "#top-menu .logo img ,.header-top .logo img , #best_startup_navigation .main-logo img{ max-height: ".esc_attr($theme_logo_height)."px;   }";

    if(get_theme_mod('theme_header_fix',0)){
      $custom_css.= ".header-top.fixed-header { position :fixed; } ";
    }    

    $custom_css.= "
    .logo-light, .logo-light a {
      color: ".esc_attr(get_theme_mod('menuTextColor','#fff')).";
    }    
    
    .logo-dark a, .logo-dark{
      color: ".esc_attr(get_theme_mod('menuTextColorScroll','#000'))."; 
    }

    *::selection,.silver-package-bg,#menu-line,.menu-left li:hover:before{
      background-color: ".esc_attr(get_theme_mod('themeColor','#ea8800')).";
    }
    .title-data h2 a,.btn-light:focus,.btn-light:hover,a:hover, a:focus,.package-feature h6,.menu-left h6,.sow-slide-nav a:hover .sow-sld-icon-themeDefault-left,.sow-slide-nav a:hover .sow-sld-icon-themeDefault-right, .menu-left ul li a:hover, .menu-left ul li.active a, .recentcomments:hover,.blog-carousel .blog-carousel-title h4,
    .gallery-item .ovelay .content .lightbox:hover, .gallery-item:hover .ovelay .content .imag-alt a:hover{
      color: ".esc_attr(get_theme_mod('themeColor','#ea8800')).";
    }
       
    .btn-blank{
      box-shadow: inset 0 0 0 1px ".esc_attr(get_theme_mod('themeColor','#ea8800')).";
    }
    .btn-blank:hover:before, .btn-blank:focus:before, .btn-blank:active:before{
      box-shadow: inset 10px 0 0 0px ".esc_attr(get_theme_mod('themeColor','#ea8800')).";
    }
    .contact-me.darkForm input[type=submit],.contact-me.lightForm input[type=submit]:hover {
      background: ".esc_attr(get_theme_mod('secondaryColor','#000000')).";
      box-shadow: inset 10px 0 0 0px ".esc_attr(get_theme_mod('themeColor','#ea8800')).";
    }
    .btn-nav:focus, .btn-nav:hover,.menu-left li a:hover:before, .menu-left li.active:before, .services-tabs-left li:hover:before, .services-tabs-left li.active:before, ul#recentcomments li:hover:before,.btn-speechblue:before,.search-submit:hover, .search-submit:focus {
      background: ".esc_attr(get_theme_mod('themeColor','#ea8800')).";
    }
    .contact-me.lightForm input[type=submit],.contact-me.darkForm input[type=submit]:hover {
      background: ".esc_attr(get_theme_mod('themeColor','#ea8800')).";
      box-shadow: inset 10px 0 0 0px ".esc_attr(get_theme_mod('secondaryColor','#000000')).";
    }
    .menu-left ul li,.menu-left ul li span, body,.comment-form input, .comment-form textarea,input::-webkit-input-placeholder,textarea::-webkit-input-placeholder,time,.menu-left ul li a, .services-tabs-left li a, .menu-left ul li .comment-author-link a, .menu-left ul li.recentcomments a,caption{
      color: ".esc_attr(get_theme_mod('bodyTextColor','#424242')).";
    }
    input:-moz-placeholder{
      color: ".esc_attr(get_theme_mod('bodyTextColor','#424242')).";
    }
    input::-moz-placeholder{
      color: ".esc_attr(get_theme_mod('bodyTextColor','#424242')).";
    }
    input:-ms-input-placeholder{
      color: ".esc_attr(get_theme_mod('bodyTextColor','#424242')).";
    }
    a,.comment .comment-reply-link,.services-tabs-left li a:hover, .services-tabs-left li.active a{
      color: ".esc_attr(get_theme_mod('secondaryColor','#000000')).";
    }
    .menu-left li:before,.menu-left h6::after,.btn-blank:hover:before, .btn-blank:focus:before, .btn-blank:active:before,.package-feature h6::after,.counter-box p:before,.menu-left li:before, .services-tabs-left li:before,.btn-blank:before,.search-submit {
      background: ".esc_attr(get_theme_mod('secondaryColor','#000000')).";
    }
    .comment-form p.form-submit,.btn-speechblue{
      background: ".esc_attr(get_theme_mod('secondaryColor','#000000')).";
      box-shadow: inset 10px 0 0 0px ".esc_attr(get_theme_mod('themeColor','#ea8800')).";
    }
    .comment-form .form-submit:hover::before,.btn-speechblue:hover:before, .btn-speechblue:focus:before, .btn-speechblue:active:before{
      box-shadow: inset 10px 0 0 0px ".esc_attr(get_theme_mod('secondaryColor','#000000')).";
      background: ".esc_attr(get_theme_mod('themeColor','#ea8800')).";
    }
    .contact-me.darkForm input:focus, .contact-me.lightForm input:focus, .contact-me.darkForm textarea:focus, .contact-me.lightForm textarea:focus,
    blockquote,
    .comment-form input:focus, .comment-form textarea:focus{
      border-color: ".esc_attr(get_theme_mod('themeColor','#ea8800')).";
    }
    .footer-wrap{
      background: ".esc_attr(get_theme_mod('secondaryColor','#001530')).";
    }
    .footer-box{
      background:".esc_attr(get_theme_mod('footerBackgroundColor','#2c3e50')).";
    }
    .footer-box div,.footer-box .widget-title,.footer-box p,.footer-box .textwidget, .footer-box .calendar_wrap caption, .footer-box .textwidget p,.footer-box div,.footer-box h1,.footer-box h2,.footer-box h3,.footer-box h4,.footer-box h5,.footer-box h6 {
      color: ".esc_attr(get_theme_mod('footerTextColor','#ffffff')).";
    }    
    .footer-box .footer-widget ul li a,.footer-widget .tagcloud a{
      color:".esc_attr(get_theme_mod('footerLinkColor','#ffffff')).";
    }
    .footer-box .footer-widget ul li a:hover, .footer-widget .tagcloud a:hover{
      color:".esc_attr(get_theme_mod('footerLinkHoverColor','#ea8800')).";
    }
    .footer-box .tagcloud > a:hover{
      background:".esc_attr(get_theme_mod('footerLinkHoverColor','#ea8800')).";
    }
    .footer-wrap .copyright p,.footer-wrap{
      color: ".esc_attr(get_theme_mod('copyrightTextColor', '#fff')).";
    }
    .footer-wrap a,.footer-wrap.style2 .footer-nav ul li a{
      color: ".esc_attr(get_theme_mod('copyrightLinkColor', '#ffff')).";
    }    
    .footer-wrap a:hover,.footer-wrap.style2 .footer-nav ul li a:hover,.footer-wrap.style2 .copyright a:hover{
      color: ".esc_attr(get_theme_mod('themeColor','#ea8800')).";
    }    
    .no-post-thumbnail { background-color: ".esc_attr(get_theme_mod('themeColor','#ea8800')).";
    }

    /* Menu Css Cutomization */
    
      /*main top menu text color*/

      #menu-style-header > ul > li > a{
        color: ".esc_attr(get_theme_mod('menuTextColor','#ffffff')).";
      }

      /*sub menu text color*/

      #menu-style-header ul ul li a{
        color: ".esc_attr(get_theme_mod('secondaryColor','#2c3e55')).";
      }

      /*main top menu text Scroll color*/

      .fixed-header #menu-style-header > ul > li > a{
        color: ".esc_attr(get_theme_mod('menuTextColorScroll','#ffffff')).";
      }

      /*sub menu text Scroll color*/

      .fixed-header #menu-style-header ul ul li a{
        color: ".esc_attr(get_theme_mod('menuTextColorScroll','#ffffff')).";
      }

      /*sub menu background color*/

      #menu-style-header ul ul li a  {
        background-color: ".esc_attr(get_theme_mod('secondaryColor','#000000')).";
      }

      /*sub menu Scroll background color*/

      .fixed-header #menu-style-header ul ul li a {
        background-color: ".esc_attr(get_theme_mod('menuBackgroundColorScroll','#ffffff')).";
      } 

      /*sub menu background hover color*/

      #menu-style-header ul ul li a:hover {
        background-color: ".esc_attr(get_theme_mod('themeColor','#ea8800')).";
      } 
      
      /*all top menu hover effect border color*/

      #menu-style-header > ul > li:before {
           border-color: ".esc_attr(get_theme_mod('themeColor','#ea8800')).";
        }

      /*all menu arrow border color*/

      #menu-style-header > ul > li.has-sub > a::after, #menu-style-header ul ul li.has-sub > a::after {
           border-color: ".esc_attr(get_theme_mod('menuTextColor','#ffffff')).";
        }

        /*all menu scroll arrow border color*/

       .fixed-header #menu-style-header > ul > li.has-sub > a::after, .fixed-header #menu-style-header ul ul li.has-sub > a::after {
           border-color: ".esc_attr(get_theme_mod('menuTextColorScroll','#ffffff')).";
        }

      @media only screen and (max-width: 1024px){
        
      /*all menu arrow border color*/

      #menu-style-header #menu-button::before, #menu-style-header .menu-opened::after {
           border-color: ".esc_attr(get_theme_mod('secondaryColor','#2c3e55')).";
        }

      /*all menu scroll arrow border color*/

      .fixed-header #menu-style-header #menu-button::before, .fixed-header #menu-style-header .menu-opened::after {
           border-color: ".esc_attr(get_theme_mod('menuTextColorScroll','#ffffff'))." ;
        }

      /*all menu arrow background border color*/
      
      #menu-style-header #menu-button::after
        {
          background-color: ".esc_attr(get_theme_mod('secondaryColor','#2c3e55')).";
        }

      /*all menu scroll arrow background border color*/
      
      .fixed-header #menu-style-header #menu-button::after {
          background-color: ".esc_attr(get_theme_mod('menuTextColorScroll','#ffffff')).";
        } 

      /*mobile menu background color*/

      #menu-style-header .mobilemenu li a{
           background-color: ".esc_attr(get_theme_mod('menuBackgroundColorScroll','#ffffff')).";
           color: ".esc_attr(get_theme_mod('menuTextColorScroll','#2c3e55')).";
        }

        #menu-style-header .mobilemenu li a:hover{
           background-color: ".esc_attr(get_theme_mod('themeColor','#ea8800')).";
        }

        #menu-style-header .mobilemenu li:hover > a  {
           background-color: ".esc_attr(get_theme_mod('themeColor','#ea8800')).";
        }

        #menu-style-header .submenu-button::before, #menu-style-header .submenu-button::after{
           background-color: ".esc_attr(get_theme_mod('menuTextColorScroll','#ffffff')).";
        }     

      }   

      /*  Menu Css Cutomization */

      .preloader-gif.customPreloader{
        background: url(".esc_url(get_theme_mod('customPreloader')).") no-repeat;
        background-size: contain;
        animation: none;
      }

    ";
  if(has_header_image()){
     
      $url = get_header_image();
      $custom_css .= ".blog-heading-wrap {background-image:url(".esc_url_raw($url).");}";
  }
  $custom_css .= wp_kses_post(get_theme_mod('customCss'));
  wp_add_inline_style( 'best_startup_style', $custom_css ); 

  $script_js = '';  
  
  if( get_theme_mod('theme_header_fix',0))
  {
    $script_js .="
      jQuery(window).scroll(function () {
        if (jQuery(window).scrollTop() > 200) {
            jQuery('.header-top').addClass('fixed-header');             
        } else {           
            jQuery('.header-top').removeClass('fixed-header');
        }
      });
    ";
  }

  wp_add_inline_script( 'best-startup-script-header-style', $script_js );
 }