<?php
defined('ABSPATH') || exit;

$preview_image = $block['data']['preview_image'] ?? '';
if (!empty($is_preview) && is_string($preview_image) && $preview_image !== '') {
    echo '<img src="' . esc_url(get_template_directory_uri() . $preview_image) . '" alt="' . esc_attr__('Корисно знати — попередній перегляд', 'autofix') . '" style="width: 100%; height: auto;">';
    return;
}

if (!function_exists('get_field')) {
    return;
}

$eyebrow = get_field('faq_eyebrow');
$title = get_field('faq_title');
$description = get_field('faq_description');
$link = get_field('faq_link');
$items = get_field('faq_items');
$section_id = !empty($block['anchor']) ? $block['anchor'] : 'faq';
$title_id = $section_id . '-title';
$classes = 'section faq';

if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
?>
<section
    class="<?php echo esc_attr($classes); ?>"
    id="<?php echo esc_attr($section_id); ?>"
    <?php if ($title) : ?>aria-labelledby="<?php echo esc_attr($title_id); ?>"<?php endif; ?>
>
    <div class="container faq-layout">
        <div>
            <?php if ($eyebrow) : ?>
                <p class="eyebrow muted"><?php echo esc_html($eyebrow); ?></p>
            <?php endif; ?>
            <?php if ($title) : ?>
                <h2 id="<?php echo esc_attr($title_id); ?>"><?php echo nl2br(esc_html($title)); ?></h2>
            <?php endif; ?>
            <?php if ($description) : ?>
                <p><?php echo nl2br(esc_html($description)); ?></p>
            <?php endif; ?>
            <?php if (is_array($link) && !empty($link['url']) && !empty($link['title'])) : ?>
                <a class="text-link" href="<?php echo esc_url($link['url']); ?>"<?php if (($link['target'] ?? '') === '_blank') : ?> target="_blank" rel="noopener noreferrer"<?php endif; ?>>
                    <?php echo esc_html($link['title']); ?>
                    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                        <path d="M5 19 19 5M5 5h14v14"/>
                    </svg>
                </a>
            <?php endif; ?>
        </div>
        <?php if (is_array($items) && $items) : ?>
            <div class="faq-items">
                <?php foreach ($items as $item) : ?>
                    <?php if (!empty($item['question'])) : ?>
                        <details>
                            <summary>
                                <?php echo esc_html($item['question']); ?><span aria-hidden="true">+</span>
                            </summary>
                            <?php if (!empty($item['answer'])) : ?>
                                <?php echo wp_kses_post($item['answer']); ?>
                            <?php endif; ?>
                        </details>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
