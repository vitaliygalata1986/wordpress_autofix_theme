<?php
defined('ABSPATH') || exit;

$preview_image = $block['data']['preview_image'] ?? '';
if (!empty($is_preview) && is_string($preview_image) && $preview_image !== '') {
    echo '<img src="' . esc_url(get_template_directory_uri() . $preview_image) . '" alt="' . esc_attr__('Зустрінемось на сервісі — попередній перегляд', 'autofix') . '" style="width: 100%; height: auto;">';
    return;
}

if (!function_exists('get_field')) {
    return;
}

$eyebrow = get_field('contacts_eyebrow');
$location = get_field('contacts_location');
$title = get_field('contacts_title');
$call_label = get_field('contacts_call_label');
$phone_label = get_field('contacts_phone_label');
$phone = get_field('contacts_phone');
$extra_phones = get_field('contacts_extra_phones');
$address_label = get_field('contacts_address_label');
$address = get_field('contacts_address');
$address_note = get_field('contacts_address_note');
$map_link = get_field('contacts_map_link');
$hours = get_field('contacts_hours');
$social_title = get_field('contacts_social_title');
$social_description = get_field('contacts_social_description');
$social_links = get_field('contacts_social_links');
$section_id = !empty($block['anchor']) ? $block['anchor'] : 'contacts';
$title_id = $section_id . '-title';
$classes = 'contacts';

if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}

// Номер отображается как введён, а ссылка содержит только цифры и начальный плюс.
$phone_url = static function ($number): string {
    $number = trim((string) $number);
    if (!preg_match('/^\+?[0-9\s().-]+$/', $number)) {
        return '';
    }

    $digits = preg_replace('/\D/', '', $number);
    return $digits !== '' ? 'tel:' . ($number[0] === '+' ? '+' : '') . $digits : '';
};
$main_phone_url = $phone_url($phone);
$map_url = is_array($map_link) ? esc_url($map_link['url'] ?? '') : '';
$social_links = is_array($social_links) ? array_filter($social_links, static function ($social): bool {
    return !empty($social['link']['title']) && !empty($social['link']['url']) && esc_url($social['link']['url']) !== '';
}) : [];

// Встроенные иконки видны и на сайте, и в редакторе без SVG-спрайта шапки.
$arrow_icon = '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M5 19 19 5M5 5h14v14"/></svg>';
$social_icons = [
    'instagram' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".7" fill="currentColor" stroke="none"/></svg>',
    'tiktok' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M14 3v12.5a5 5 0 1 1-4-4.9M14 3c1 4 3 6 7 6M17 3v12.5"/></svg>',
];
?>
<section
    class="<?php echo esc_attr($classes); ?>"
    id="<?php echo esc_attr($section_id); ?>"
    <?php if ($title) : ?>aria-labelledby="<?php echo esc_attr($title_id); ?>"<?php endif; ?>
>
    <div class="container">
        <div class="contacts-top">
            <?php if ($eyebrow) : ?>
                <p class="eyebrow"><?php echo esc_html($eyebrow); ?></p>
            <?php endif; ?>
            <?php if ($location) : ?>
                <span class="location"><span class="location-dot" aria-hidden="true"></span> <?php echo esc_html($location); ?></span>
            <?php endif; ?>
        </div>
        <div class="contact-heading">
            <?php if ($title) : ?>
                <h2 id="<?php echo esc_attr($title_id); ?>"><?php echo nl2br(esc_html($title)); ?></h2>
            <?php endif; ?>
            <?php if ($main_phone_url) : ?>
                <a class="contact-arrow" href="<?php echo esc_url($main_phone_url); ?>" aria-label="<?php echo esc_attr($call_label ?: __('Зателефонувати для запису', 'autofix')); ?>">
                    <?php echo $arrow_icon; ?>
                </a>
            <?php endif; ?>
        </div>
        <div class="contacts-bottom">
            <div>
                <?php if ($phone_label) : ?>
                    <p><?php echo esc_html($phone_label); ?></p>
                <?php endif; ?>
                <?php if ($main_phone_url) : ?>
                    <a class="big-phone" href="<?php echo esc_url($main_phone_url); ?>"><?php echo esc_html($phone); ?></a>
                <?php endif; ?>
                <?php if (is_array($extra_phones)) : ?>
                    <?php foreach ($extra_phones as $extra_phone) : ?>
                        <?php $extra_phone_url = $phone_url($extra_phone['phone'] ?? ''); ?>
                        <?php if ($extra_phone_url) : ?>
                            <div class="alignment-contact">
                                <?php if (!empty($extra_phone['label'])) : ?>
                                    <span><?php echo esc_html($extra_phone['label']); ?></span>
                                <?php endif; ?>
                                <a href="<?php echo esc_url($extra_phone_url); ?>"><?php echo esc_html($extra_phone['phone']); ?></a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="contact-details">
                <?php if ($address_label) : ?>
                    <p><?php echo esc_html($address_label); ?></p>
                <?php endif; ?>
                <?php if ($address || $address_note) : ?>
                    <address>
                        <?php echo nl2br(esc_html($address ?: '')); ?>
                        <?php if ($address && $address_note) : ?><br /><?php endif; ?>
                        <?php if ($address_note) : ?><strong><?php echo esc_html($address_note); ?></strong><?php endif; ?>
                    </address>
                <?php endif; ?>
                <?php if ($map_url && !empty($map_link['title'])) : ?>
                    <a class="text-link map-link" href="<?php echo $map_url; ?>"<?php if (($map_link['target'] ?? '') === '_blank') : ?> target="_blank" rel="noopener noreferrer"<?php endif; ?>>
                        <?php echo esc_html($map_link['title']); ?> <?php echo $arrow_icon; ?>
                    </a>
                <?php endif; ?>
                <?php if ($hours) : ?>
                    <span class="contact-hours"><?php echo nl2br(esc_html($hours)); ?></span>
                <?php endif; ?>
            </div>
        </div>
        <?php if ($social_links) : ?>
            <div class="social-section">
                <div>
                    <?php if ($social_title) : ?>
                        <h3><?php echo esc_html($social_title); ?></h3>
                    <?php endif; ?>
                    <?php if ($social_description) : ?>
                        <p><?php echo nl2br(esc_html($social_description)); ?></p>
                    <?php endif; ?>
                </div>
                <div class="social-links">
                    <?php foreach ($social_links as $social) : ?>
                        <?php $social_link = $social['link']; ?>
                        <a href="<?php echo esc_url($social_link['url']); ?>"<?php if (($social_link['target'] ?? '') === '_blank') : ?> target="_blank" rel="noopener noreferrer"<?php endif; ?>>
                            <?php echo $social_icons[$social['icon'] ?? 'none'] ?? ''; ?>
                            <?php echo esc_html($social_link['title']); ?>
                            <?php echo $arrow_icon; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
