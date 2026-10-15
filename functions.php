<?php

defined('ABSPATH') || exit;

require_once get_template_directory() . '/inc/acf-gutenberg-register-blocks.php';

function autofix_setup(): void
{
    load_theme_textdomain('autofix', get_template_directory() . '/languages');

    register_nav_menus([
        'header' => __('Меню в шапці', 'autofix'),
    ]);

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('editor-styles');
    add_editor_style('assets/css/style.css');
    add_theme_support('custom-logo', [
        'height' => 930,
        'width' => 930,
        'flex-height' => true,
        'flex-width' => true,
    ]);
    add_theme_support(
        'html5',
        [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ]
    );
}

add_action('after_setup_theme', 'autofix_setup');

require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/customizer.php';
