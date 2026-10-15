<?php
defined('ABSPATH') || exit;

if (!empty($is_preview) && !empty($block['data']['preview_image'])) {
    echo '<img src="' . esc_url(get_template_directory_uri() . '/blocks/process/process.jpg') . '" alt="' . esc_attr__('Як це працює — попередній перегляд', 'autofix') . '" style="width: 100%; height: auto;">';
    return;
}

if (!function_exists('get_field')) {
    return;
}

$eyebrow = get_field('process_eyebrow');
$title = get_field('process_title');
$link = get_field('process_link');
$steps = get_field('process_steps');
$section_id = !empty($block['anchor']) ? $block['anchor'] : 'process';
$title_id = $section_id . '-title';
$classes = 'section process';

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
            <?php if (is_array($link) && !empty($link['url']) && !empty($link['title'])) : ?>
                <a class="text-link" href="<?php echo esc_url($link['url']); ?>"<?php if (($link['target'] ?? '') === '_blank') : ?> target="_blank" rel="noopener noreferrer"<?php endif; ?>>
                    <?php echo esc_html($link['title']); ?>
                    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                        <path d="M5 19 19 5M5 5h14v14"/>
                    </svg>
                </a>
            <?php endif; ?>
        </div>
        <?php if (is_array($steps) && $steps) : ?>
            <div class="steps">
                <?php foreach (array_values($steps) as $index => $step) : ?>
                    <article>
                        <div class="step-number"><?php echo esc_html(sprintf('%02d', $index + 1)); ?><span aria-hidden="true">↗</span></div>
                        <?php if (!empty($step['title'])) : ?>
                            <h3><?php echo esc_html($step['title']); ?></h3>
                        <?php endif; ?>
                        <?php if (!empty($step['text'])) : ?>
                            <p><?php echo nl2br(esc_html($step['text'])); ?></p>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
