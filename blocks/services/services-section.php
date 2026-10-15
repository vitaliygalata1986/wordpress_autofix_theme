<?php
defined('ABSPATH') || exit;

$preview_image = $block['data']['preview_image'] ?? '';
if (!empty($is_preview) && is_string($preview_image) && $preview_image !== '') {
    if (is_file(get_template_directory() . $preview_image)) {
        echo '<img src="' . esc_url(get_template_directory_uri() . $preview_image) . '" alt="' . esc_attr__('Послуги AUTO FIX — попередній перегляд', 'autofix') . '" style="width: 100%; height: auto;">';
    } else {
        echo '<p>' . esc_html__('Послуги AUTO FIX — картки напрямків обслуговування та телефонні посилання.', 'autofix') . '</p>';
    }
    return;
}

if (!function_exists('get_field')) {
    return;
}

$eyebrow = get_field('services_eyebrow');
$title = get_field('services_title');
$intro = get_field('services_intro');
$items = get_field('services_items');
$help_items = get_field('services_help_items');
$section_id = !empty($block['anchor']) ? $block['anchor'] : 'services';
$title_id = $section_id . '-title';
$classes = 'section services';
$service_icons = [
    'oil' => '<path d="m7 15 7-4 13 5 5-2 3 5-7 4v9H8V19H4v-6h5M16 12V7h8M35 25s-3 4-3 6a3 3 0 0 0 6 0c0-2-3-6-3-6Z" />',
    'scan' => '<rect x="5" y="6" width="30" height="22" rx="3"/> <path d="M12 34h16M20 28v6M10 18h6l3-6 5 11 3-5h4"/>',
    'spring' => '<path d="M20 3v6M12 9h16l-16 6 16 6-16 6 16 6H12M20 33v5M9 3h22M9 38h22" />',
    'wheel' => '<circle cx="20" cy="20" r="15"/> <circle cx="20" cy="20" r="7"/> <circle cx="20" cy="20" r="2"/> <path d="m20 5 3 8M35 20l-8 3M20 35l-3-8M5 20l8-3"/>',
    'engine' => '<path d="M12 12h15l5 5h4v13h-7l-4 4H12l-5-6V16h5ZM16 7h9M20 7v5M3 20v8M7 24H3M32 17v8" />',
    'climate' => '<path d="M20 3v34M5 11l30 18M5 29l30-18M15 6l5 5 5-5M15 34l5-5 5 5M5 17l7-2-2-7M30 32l-2-7 7-2M10 32l2-7-7-2M35 17l-7-2 2-7" />',
    'welding' => '<path d="m7 32 15-15 6 6-15 15ZM20 19l-5-5 6-6 9 9M29 10l5-5M32 17h6M23 7V2M4 37h29" />',
];
$default_icons = ['oil', 'scan', 'spring', 'wheel', 'engine', 'climate', 'wheel', 'engine', 'welding'];

if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
?>
<section
    class="<?php echo esc_attr($classes); ?>"
    id="<?php echo esc_attr($section_id); ?>"
    <?php if ($title) : ?>aria-labelledby="<?php echo esc_attr($title_id); ?>"<?php endif; ?>
>
    <div class="container">
        <div class="section-heading">
            <div>
                <?php if ($eyebrow) : ?>
                    <p class="eyebrow muted"><?php echo esc_html($eyebrow); ?></p>
                <?php endif; ?>
                <?php if ($title) : ?>
                    <h2 id="<?php echo esc_attr($title_id); ?>"><?php echo nl2br(esc_html($title)); ?></h2>
                <?php endif; ?>
            </div>
            <?php if ($intro) : ?>
                <p class="section-intro"><?php echo nl2br(esc_html($intro)); ?></p>
            <?php endif; ?>
        </div>

        <?php if (is_array($items) && $items) : ?>
            <div class="services-grid">
                <?php foreach (array_values($items) as $index => $item) : ?>
                    <?php
                    $icon = sanitize_key($item['icon'] ?? ($default_icons[$index] ?? 'engine'));
                    $icon_markup = $service_icons[$icon] ?? $service_icons['engine'];
                    $category = sanitize_key($item['category'] ?? '');
                    $link = $item['link'] ?? [];
                    $url = $category !== '' ? '#prices' : (is_array($link) ? ($link['url'] ?? '') : '');
                    $link_title = is_array($link) ? ($link['title'] ?? '') : '';
                    if ($category === '') {
                        $url = esc_url($url);
                    }
                    ?>
                    <?php if ($url) : ?>
                        <a class="service-card" href="<?php echo $category !== '' ? esc_attr($url) : $url; ?>"<?php if ($category !== '') : ?> data-category-link="<?php echo esc_attr($category); ?>"<?php endif; ?><?php if (is_array($link) && ($link['target'] ?? '') === '_blank') : ?> target="_blank" rel="noopener noreferrer"<?php endif; ?>>
                    <?php else : ?>
                        <article class="service-card">
                    <?php endif; ?>
                            <div class="service-top">
                                <svg class="service-icon" viewBox="0 0 40 40" aria-hidden="true" focusable="false"><?php echo $icon_markup; ?></svg>
                                <span><?php echo esc_html(sprintf('%02d', $index + 1)); ?></span>
                            </div>
                            <?php if (!empty($item['title'])) : ?>
                                <h3><?php echo esc_html($item['title']); ?></h3>
                            <?php endif; ?>
                            <?php if (!empty($item['text'])) : ?>
                                <p><?php echo nl2br(esc_html($item['text'])); ?></p>
                            <?php endif; ?>
                            <?php if ($link_title) : ?>
                                <div class="service-bottom">
                                    <span><?php echo esc_html($link_title); ?></span>
                                    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M5 19 19 5M5 5h14v14"/></svg>
                                </div>
                            <?php endif; ?>
                    <?php if ($url) : ?>
                        </a>
                    <?php else : ?>
                        </article>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (is_array($help_items) && $help_items) : ?>
            <?php foreach ($help_items as $help_item) : ?>
                <?php $help_link = $help_item['link'] ?? []; ?>
                <div class="services-help">
                    <?php if (!empty($help_item['text'])) : ?>
                        <span><?php echo nl2br(esc_html($help_item['text'])); ?></span>
                    <?php endif; ?>
                    <?php if (is_array($help_link) && !empty($help_link['url']) && !empty($help_link['title'])) : ?>
                        <a class="text-link" href="<?php echo esc_url($help_link['url']); ?>"<?php if (!empty($help_item['open_contact_dialog'])) : ?> data-contact-open<?php endif; ?><?php if (($help_link['target'] ?? '') === '_blank') : ?> target="_blank" rel="noopener noreferrer"<?php endif; ?>>
                            <?php echo esc_html($help_link['title']); ?>
                            <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M5 19 19 5M5 5h14v14"/></svg>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>
