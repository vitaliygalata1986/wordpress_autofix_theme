<?php
defined('ABSPATH') || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <meta name="theme-color" content="#171918"/>
    <meta
            name="description"
            content="<?php esc_attr_e('AUTO FIX — автосервіс у Миколаєві: діагностика на німецькому вібростенді, розвал-сходження, ремонт двигунів і дизельних паливних систем. Вул. Троїцька, 244, авторинок, бокс 10. Телефон: +380 66 056 81 21.', 'autofix'); ?>"
    />
    <link rel="icon" type="image/webp"
          href="<?php echo esc_url(get_template_directory_uri() . '/assets/image/logo.webp'); ?>"/>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="header" id="top">
    <div class="container header-inner">
        <?php get_template_part('template-parts/logo'); ?>
        <button
                class="menu-toggle"
                type="button"
                aria-expanded="false"
                aria-controls="navigation"
                aria-label="<?php esc_attr_e('Відкрити меню', 'autofix'); ?>"
        >
            <span></span><span></span>
        </button>
        <nav id="navigation" aria-label="<?php esc_attr_e('Головне меню', 'autofix'); ?>">
            <?php
            wp_nav_menu([
                    'theme_location' => 'header',
                    'container' => false,
                    'menu_class' => 'header-menu',
                    'fallback_cb' => false,
                    'depth' => 1,
            ]);
            ?>
        </nav>
        <?php get_template_part('template-parts/header-phones'); ?>
    </div>
</header>
