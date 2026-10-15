<?php
defined('ABSPATH') || exit;

$preview_image = $block['data']['preview_image'] ?? '';
if (!empty($is_preview) && is_string($preview_image) && $preview_image !== '') {
    if (is_file(get_template_directory() . $preview_image)) {
        echo '<img src="' . esc_url(get_template_directory_uri() . $preview_image) . '" alt="' . esc_attr__('Наш сервіс зблизька — попередній перегляд', 'autofix') . '" style="width: 100%; height: auto;">';
    } else {
        echo '<p>' . esc_html__('Наш сервіс зблизька — фотогалерея автосервісу.', 'autofix') . '</p>';
    }
    return;
}

if (!function_exists('get_field')) {
    return;
}

$eyebrow = get_field('gallery_eyebrow');
$title = get_field('gallery_title');
$intro = get_field('gallery_intro');
$label = get_field('gallery_label');
$hint = get_field('gallery_hint');
$rows = get_field('gallery_slides');
$slides = [];

foreach (is_array($rows) ? $rows : [] as $row) {
    $image_id = absint($row['image'] ?? 0);
    $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'full') : false;
    if (!$image_url) {
        continue;
    }

    $caption = (string) ($row['title'] ?? '');
    $alt = (string) get_post_meta($image_id, '_wp_attachment_image_alt', true);
    $image = wp_get_attachment_image($image_id, 'large', false, [
        'alt' => $alt ?: $caption,
        'loading' => 'lazy',
        'decoding' => 'async',
    ]);
    if ($image) {
        $slides[] = ['url' => $image_url, 'title' => $caption, 'image' => $image];
    }
}

$section_id = !empty($block['anchor']) ? $block['anchor'] : 'gallery';
$title_id = $section_id . '-title';
$classes = 'section gallery';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
?>
<section class="<?php echo esc_attr($classes); ?>" id="<?php echo esc_attr($section_id); ?>"<?php if ($title) : ?> aria-labelledby="<?php echo esc_attr($title_id); ?>"<?php endif; ?>>
    <div class="container">
        <div class="section-heading">
            <div>
                <?php if ($eyebrow) : ?><p class="eyebrow muted"><?php echo esc_html($eyebrow); ?></p><?php endif; ?>
                <?php if ($title) : ?><h2 id="<?php echo esc_attr($title_id); ?>"><?php echo nl2br(esc_html($title)); ?></h2><?php endif; ?>
            </div>
            <?php if ($intro) : ?><p class="section-intro"><?php echo nl2br(esc_html($intro)); ?></p><?php endif; ?>
        </div>
        <?php if ($slides) : ?>
            <div class="gallery-carousel" role="region" aria-roledescription="<?php esc_attr_e('карусель', 'autofix'); ?>" aria-label="<?php echo esc_attr($label ?: __('Фотографії автосервісу AUTO FIX', 'autofix')); ?>">
                <div class="swiper gallery-swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($slides as $index => $slide) : ?>
                            <figure class="swiper-slide gallery-slide">
                                <a class="gallery-photo" href="<?php echo esc_url($slide['url']); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr(sprintf(__('Відкрити фото: %s (нова вкладка)', 'autofix'), $slide['title'] ?: sprintf(__('Фото %d', 'autofix'), $index + 1))); ?>" data-dialog-label="<?php echo esc_attr(sprintf(__('Відкрити фото: %s', 'autofix'), $slide['title'] ?: sprintf(__('Фото %d', 'autofix'), $index + 1))); ?>">
                                    <?php echo $slide['image']; ?>
                                    <span class="gallery-expand" aria-hidden="true"><svg viewBox="0 0 24 24" focusable="false"><path d="M5 19 19 5M5 5h14v14"/></svg></span>
                                </a>
                                <figcaption>
                                    <span><?php echo esc_html(sprintf('%02d /', $index + 1)); ?></span>
                                    <?php if ($slide['title']) : ?><h3><?php echo esc_html($slide['title']); ?></h3><?php endif; ?>
                                </figcaption>
                            </figure>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="gallery-controls" hidden>
                    <button class="gallery-autoplay" type="button" aria-pressed="false" aria-label="<?php esc_attr_e('Зупинити автоматичну зміну фотографій', 'autofix'); ?>">
                        <span aria-hidden="true">Ⅱ</span><span class="gallery-autoplay-label"><?php esc_html_e('Пауза', 'autofix'); ?></span>
                    </button>
                    <div class="gallery-pagination"></div>
                    <div class="gallery-arrows">
                        <button class="gallery-prev" type="button" aria-label="<?php esc_attr_e('Попереднє фото', 'autofix'); ?>"><span aria-hidden="true">←</span></button>
                        <button class="gallery-next" type="button" aria-label="<?php esc_attr_e('Наступне фото', 'autofix'); ?>"><span aria-hidden="true">→</span></button>
                    </div>
                </div>
            </div>
            <?php if ($hint) : ?><p class="gallery-hint"><?php echo nl2br(esc_html($hint)); ?></p><?php endif; ?>
        <?php elseif (!empty($is_preview)) : ?>
            <p><?php esc_html_e('Додайте фотографії та підписи в полях блоку.', 'autofix'); ?></p>
        <?php endif; ?>
    </div>
</section>
