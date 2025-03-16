<?php


/**
 * Register menu for theme
 */
function menu_register()
{
    register_nav_menus(
        array(
            'menu-principal'    =>  __('Main menu', BISIESTHEME_SLUG),
            'menu-footer'       =>  __('Footer menu', BISIESTHEME_SLUG)
        )
    );
}
add_action('init', 'menu_register');


/**
 * Register widgets for theme
 */
function widgets_register()
{
    register_sidebar(
        array(
            'name'              =>  __('Main sidebar', 'wordpycat'),
            'id'                =>  'main-sidebar',
            'description'       =>  __('Main sidebar for theme.', 'wordpycat'),
            'class'             =>  'main-sidebar custom-sidebar',
            'before_widget'     =>  '<li id="%1$s" class="widget %2$s">',
            'after_widget'      =>  '</li>',
            'before_title'      =>  '<p>',
            'after_title'       =>  '</p>',
        )
    );
}
add_action('widgets_init', 'widgets_register');


/**
 * Customize theme
 */
function customize_bisiestheme()
{
    // Allow alignwide and fullalign Gutenberg
    add_theme_support('align-wide');
    // Allow post-thumbnail
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'customize_bisiestheme');


/**
 * Add preload to CSS files
 */
function agregar_rel_preload($html, $handle, $href, $media)
{
    if (is_admin()) {
        return $html;
    }
    $assets = ['wp-block-library'];
    if (! in_array($handle, $assets)) {
        return $html;
    }
    $html = <<<EOT
<link rel='preload' as='style' id='$handle' href='$href' type='text/css' media='$media' />
EOT;
    return $html;
}
add_filter('style_loader_tag', 'agregar_rel_preload', 10, 4);


/**
 * Remove unnecessary links from the head
 */
function remove_headlinks()
{
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'remove_headlinks');



/**
 * Allow SVG images
 */
function allow_svg($mimes = array())
{
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'allow_svg');
