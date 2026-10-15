<?php
defined('ABSPATH') || exit;
function autofix_header_phone_defaults(): array
{
    return [
        'service' => ['label' => __('Автосервіс', 'autofix'), 'number' => '+380 66 056 81 21'],
        'tow' => ['label' => __('Евакуатор', 'autofix'), 'number' => '+380 95 421 74 15'],
        'alignment' => ['label' => __('Розвал-сходження', 'autofix'), 'number' => '+380 93 147 20 22'],
    ];
}

function autofix_customize_register(WP_Customize_Manager $wp_customize): void
{
    $custom_logo = $wp_customize->get_setting('custom_logo');
    if ($custom_logo) {
        $custom_logo->transport = 'refresh';
        $wp_customize->selective_refresh->remove_partial('custom_logo');
    }

    $wp_customize->add_setting('autofix_logo_text', [
        'default' => __('AUTO FIX', 'autofix'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ]);

    $wp_customize->add_control('autofix_logo_text', [
        'label' => __('Текст біля логотипа', 'autofix'),
        'section' => 'title_tagline',
        'type' => 'text',
        'priority' => 9,
    ]);

    $wp_customize->add_setting('autofix_logo_subtitle', [
        'default' => __('АВТОСЕРВІС · МИКОЛАЇВ', 'autofix'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ]);

    $wp_customize->add_control('autofix_logo_subtitle', [
        'label' => __('Підпис під логотипом', 'autofix'),
        'section' => 'title_tagline',
        'type' => 'text',
        'priority' => 10,
    ]);

    $wp_customize->add_section('autofix_header_phones', [
        'title' => __('Телефони в шапці', 'autofix'),
        'description' => __('Підписи та номери трьох телефонів у шапці. Залиште номер порожнім, щоб приховати його.', 'autofix'),
        'priority' => 35,
    ]);

    $wp_customize->add_section('autofix_footer', [
        'title' => __('Футер', 'autofix'),
        'priority' => 40,
    ]);

    $wp_customize->add_setting('autofix_footer_text', [
        'default' => __("Турбота про авто.\nПовага до вашого часу.", 'autofix'),
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh',
    ]);
    $wp_customize->add_control('autofix_footer_text', [
        'label' => __('Текст у футері', 'autofix'),
        'section' => 'autofix_footer',
        'type' => 'textarea',
    ]);

    $wp_customize->add_setting('autofix_footer_address', [
        'default' => __('Миколаїв · вул. Троїцька, 244 · бокс 10', 'autofix'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh',
    ]);
    $wp_customize->add_control('autofix_footer_address', [
        'label' => __('Адреса у футері', 'autofix'),
        'section' => 'autofix_footer',
        'type' => 'text',
    ]);

    foreach (autofix_header_phone_defaults() as $key => $phone) {
        foreach (['label' => __('Підпис', 'autofix'), 'number' => __('Телефон', 'autofix')] as $field => $label) {
            $setting_id = 'autofix_header_phone_' . $key . '_' . $field;
            $wp_customize->add_setting($setting_id, [
                'default' => $phone[$field],
                'sanitize_callback' => 'sanitize_text_field',
                'transport' => 'refresh',
            ]);
            $wp_customize->add_control($setting_id, [
                'label' => $phone['label'] . ' — ' . $label,
                'section' => 'autofix_header_phones',
                'type' => $field === 'number' ? 'tel' : 'text',
            ]);
        }
    }
}

add_action('customize_register', 'autofix_customize_register');
