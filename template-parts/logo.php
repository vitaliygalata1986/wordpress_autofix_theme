<?php
defined('ABSPATH') || exit;

$logo_text = get_theme_mod('autofix_logo_text', __('AUTO FIX', 'autofix'));
$logo_subtitle = get_theme_mod('autofix_logo_subtitle', __('АВТОСЕРВІС · МИКОЛАЇВ', 'autofix'));
$logo_id = absint(get_theme_mod('custom_logo'));
$logo_image = $logo_id ? wp_get_attachment_image($logo_id, 'full', false, [
        'class' => 'logo-image',
        'alt' => '',
]) : '';
$logo_label = $logo_text !== ''
        ? sprintf(__('%s — на головну', 'autofix'), $logo_text)
        : __('На головну', 'autofix');
?>
<a class="logo" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr($logo_label); ?>">
    <?php if ($logo_image) : ?>
        <?php echo $logo_image; ?>
    <?php else : ?>
        <img
                class="logo-image"
                src="<?php echo esc_url(get_template_directory_uri() . '/assets/image/logo.webp'); ?>"
                width="930"
                height="930"
                alt=""
        />
    <?php endif; ?>
    <?php if ($logo_text !== '' || $logo_subtitle !== '') : ?>
        <span>
            <?php echo esc_html($logo_text); ?>
            <?php if ($logo_subtitle !== '') : ?>
                <span class="logo-sub"><?php echo esc_html($logo_subtitle); ?></span>
            <?php endif; ?>
        </span>
    <?php endif; ?>
</a>
