<?php
defined('ABSPATH') || exit;
function autofix_enqueue_assets(): void
{
    wp_enqueue_style(
        'autofix-basic-theme-style',
        get_stylesheet_uri(),
        [],
        wp_get_theme()->get('Version')
    );

    wp_enqueue_style(
        'autofix-swiper-style',
        get_template_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.css',
        [],
        wp_get_theme()->get('Version')
    );

    wp_enqueue_style(
        'autofix-basic-main-style',
        get_template_directory_uri() . '/assets/css/style.css',
        ['autofix-basic-theme-style', 'autofix-swiper-style'],
        wp_get_theme()->get('Version')
    );

    wp_enqueue_script(
        'autofix-swiper',
        get_template_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.js',
        [],
        wp_get_theme()->get('Version'),
        ['strategy' => 'defer', 'in_footer' => true]
    );

    wp_enqueue_script(
        'autofix-main',
        get_template_directory_uri() . '/assets/js/script.js',
        ['autofix-swiper', 'wp-i18n'],
        wp_get_theme()->get('Version'),
        ['strategy' => 'defer', 'in_footer' => true]
    );

    wp_set_script_translations('autofix-main', 'autofix', get_template_directory() . '/languages');
}

add_action('wp_enqueue_scripts', 'autofix_enqueue_assets');
