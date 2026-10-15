<?php
defined('ABSPATH') || exit;

if (!empty($is_preview) && ($block['data']['preview_image'] ?? '') === '/blocks/hero/hero.jpg') {
    echo '<img src="' . esc_url(get_template_directory_uri() . '/blocks/hero/hero.jpg') . '" alt="' . esc_attr__('Головний екран AUTO FIX — попередній перегляд', 'autofix') . '" style="width: 100%; height: auto;">';
    return;
}

if (!function_exists('get_field')) {
    return;
}

$eyebrow = get_field('hero_eyebrow');
$title = get_field('hero_title');
$title_accent = get_field('hero_title_accent');
$description = get_field('hero_description');
$note = get_field('hero_note');
$image_note = get_field('hero_image_note');
$caption = get_field('hero_caption');
$caption_accent = get_field('hero_caption_accent');
$image_id = absint(get_field('hero_image'));
$image_html = $image_id ? wp_get_attachment_image($image_id, 'full', false, [
    'class' => 'hero-image',
    'loading' => 'eager',
    'fetchpriority' => 'high',
]) : '';

$get_link = static function (string $field): array {
    $link = get_field($field);
    if (!is_array($link) || empty($link['url']) || empty($link['title'])) {
        return [];
    }
    $link['url'] = esc_url($link['url']);
    return $link['url'] !== '' ? $link : [];
};
$primary_link = $get_link('hero_primary_link');
$secondary_link = $get_link('hero_secondary_link');
$scroll_link = $get_link('hero_scroll_link');
$section_id = !empty($block['anchor']) ? $block['anchor'] : 'hero';
$title_id = $section_id . '-title';
$classes = 'hero';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
?>
<section class="<?php echo esc_attr($classes); ?>" id="<?php echo esc_attr($section_id); ?>"<?php if ($title || $title_accent) : ?> aria-labelledby="<?php echo esc_attr($title_id); ?>"<?php endif; ?>>
    <?php if ($image_html) : ?>
        <?php echo $image_html; ?>
    <?php else : ?>
        <img class="hero-image" src="<?php echo esc_url(get_template_directory_uri() . '/assets/image/workshop.webp'); ?>" width="1536" height="1024" alt="<?php esc_attr_e('Ілюстрація автомобіля в сучасній майстерні', 'autofix'); ?>" loading="eager" fetchpriority="high"/>
    <?php endif; ?>
    <div class="hero-shade"></div>
    <div class="container hero-inner">
        <div class="hero-copy">
            <?php if ($eyebrow) : ?>
                <p class="eyebrow"><span class="orange-dot" aria-hidden="true"></span> <?php echo esc_html($eyebrow); ?></p>
            <?php endif; ?>
            <?php if ($title || $title_accent) : ?>
                <h1 id="<?php echo esc_attr($title_id); ?>"><?php echo nl2br(esc_html($title ?: '')); ?><?php if ($title && $title_accent) : ?> <?php endif; ?><?php if ($title_accent) : ?><span><?php echo esc_html($title_accent); ?></span><?php endif; ?></h1>
            <?php endif; ?>
            <?php if ($description) : ?>
                <p class="hero-description"><?php echo nl2br(esc_html($description)); ?></p>
            <?php endif; ?>
            <?php if ($primary_link || $secondary_link) : ?>
                <div class="hero-actions">
                    <?php if ($primary_link) : ?>
                        <a class="button button-orange" href="<?php echo $primary_link['url']; ?>"<?php if (($primary_link['target'] ?? '') === '_blank') : ?> target="_blank" rel="noopener noreferrer"<?php endif; ?>>
                            <?php echo esc_html($primary_link['title']); ?>
                            <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M5 19 19 5M5 5h14v14"/></svg>
                        </a>
                    <?php endif; ?>
                    <?php if ($secondary_link) : ?>
                        <a class="text-link light-link" href="<?php echo $secondary_link['url']; ?>"<?php if (($secondary_link['target'] ?? '') === '_blank') : ?> target="_blank" rel="noopener noreferrer"<?php endif; ?>><?php echo esc_html($secondary_link['title']); ?> <span aria-hidden="true">↓</span></a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php if ($note) : ?>
                <p class="hero-note"><?php echo esc_html($note); ?></p>
            <?php endif; ?>
        </div>
        <?php if ($caption || $caption_accent) : ?>
            <div class="hero-caption">
                <span class="caption-cross" aria-hidden="true">+</span><span><?php echo esc_html($caption ?: ''); ?><?php if ($caption && $caption_accent) : ?><br/><?php endif; ?><?php if ($caption_accent) : ?><strong><?php echo esc_html($caption_accent); ?></strong><?php endif; ?></span>
            </div>
        <?php endif; ?>
        <?php if ($scroll_link) : ?>
            <a class="hero-scroll" href="<?php echo $scroll_link['url']; ?>"<?php if (($scroll_link['target'] ?? '') === '_blank') : ?> target="_blank" rel="noopener noreferrer"<?php endif; ?>><span><?php echo esc_html($scroll_link['title']); ?></span><span aria-hidden="true">↓</span></a>
        <?php endif; ?>
        <?php if ($image_note) : ?>
            <span class="hero-image-note"><?php echo esc_html($image_note); ?></span>
        <?php endif; ?>
    </div>
</section>
