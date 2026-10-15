<?php
defined('ABSPATH') || exit;

function autofix_register_acf_blocks(): void
{
    if (!function_exists('acf_register_block_type')) {
        return;
    }

    register_block_type(get_template_directory() . '/blocks/hero');
    register_block_type(get_template_directory() . '/blocks/prices');
    register_block_type(get_template_directory() . '/blocks/services');
    register_block_type(get_template_directory() . '/blocks/about');
    register_block_type(get_template_directory() . '/blocks/gallery');
    register_block_type(get_template_directory() . '/blocks/process');
    register_block_type(get_template_directory() . '/blocks/faq');
    register_block_type(get_template_directory() . '/blocks/contacts');
}

add_action('init', 'autofix_register_acf_blocks');

function autofix_block_categories(array $categories): array
{
    if (!in_array('autofix-blocks', array_column($categories, 'slug'), true)) {
        $categories[] = [
            'slug' => 'autofix-blocks',
            'title' => __('Секції AUTO FIX', 'autofix'),
        ];
    }

    return $categories;
}

add_filter('block_categories_all', 'autofix_block_categories');
