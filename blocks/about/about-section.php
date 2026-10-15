<?php
defined('ABSPATH') || exit;

$preview_image = $block['data']['preview_image'] ?? '';
if (!empty($is_preview) && is_string($preview_image) && $preview_image !== '') {
    if (is_file(get_template_directory() . $preview_image)) {
        echo '<img src="' . esc_url(get_template_directory_uri() . $preview_image) . '" alt="' . esc_attr__('Наш підхід — попередній перегляд', 'autofix') . '" style="width: 100%; height: auto;">';
    } else {
        echo '<p>' . esc_html__('Наш підхід — схема діагностики та переваги AUTO FIX.', 'autofix') . '</p>';
    }
    return;
}

if (!function_exists('get_field')) {
    return;
}

$eyebrow = get_field('about_eyebrow');
$title_start = get_field('about_title_start');
$title_accent = get_field('about_title_accent');
$lead = get_field('about_lead');
$diagram_heading = get_field('about_diagram_heading');
$diagram_footer = get_field('about_diagram_footer');
$points = get_field('about_points');
$section_id = !empty($block['anchor']) ? $block['anchor'] : 'about';
$title_id = $section_id . '-title';
$diagram_title_id = $section_id . '-diagram-title';
$classes = 'section about';

if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
?>
<section
    class="<?php echo esc_attr($classes); ?>"
    id="<?php echo esc_attr($section_id); ?>"
    <?php if ($title_start || $title_accent) : ?>aria-labelledby="<?php echo esc_attr($title_id); ?>"<?php endif; ?>
>
    <div class="container about-layout">
        <div class="about-visual">
            <div class="diagram-heading">
                <span><?php echo esc_html($diagram_heading); ?></span><span class="orange-dot" aria-hidden="true"></span>
            </div>
            <svg
                class="car-diagram"
                viewBox="0 0 520 540"
                role="img"
                aria-labelledby="<?php echo esc_attr($diagram_title_id); ?>"
            >
                <title id="<?php echo esc_attr($diagram_title_id); ?>">Схема основних напрямків обслуговування автомобіля</title>
                <defs>
                    <pattern id="<?php echo esc_attr($section_id . '-grid'); ?>" width="30" height="30" patternUnits="userSpaceOnUse">
                        <path d="M30 0H0V30" fill="none" stroke="#343936" stroke-width=".6" />
                    </pattern>
                </defs>
                <rect width="520" height="540" fill="url(#<?php echo esc_attr($section_id . '-grid'); ?>)" />
                <g fill="none" stroke="#8b938c" stroke-width="2">
                    <path d="M204 62Q260 38 316 62L338 124 345 384Q343 441 315 462H205Q177 441 175 384L182 124Z" />
                    <path d="M199 151Q260 130 321 151L313 220H207ZM205 345h110l11 67q-66 26-132 0ZM208 226h104v111H208ZM186 164l14 67v100l-16 53M334 164l-14 67v100l16 53M200 70l-7 46h36l5-51M320 70l7 46h-36l-5-51M202 434h116" />
                    <rect x="165" y="131" width="13" height="63" rx="4" />
                    <rect x="342" y="131" width="13" height="63" rx="4" />
                    <rect x="160" y="354" width="14" height="63" rx="4" />
                    <rect x="346" y="354" width="14" height="63" rx="4" />
                    <path d="M199 252h-14l-8 31h20M321 252h14l8 31h-20" />
                </g>
                <g fill="none" stroke="#f4383b" stroke-width="1.5">
                    <circle cx="260" cy="110" r="27" stroke-dasharray="4 5" />
                    <path d="M260 110H375l25-25h70M174 164H100l-20 25H35M290 272h88l25-24h67M260 397H99l-20 25H35" />
                    <circle cx="260" cy="110" r="5" fill="#f4383b" />
                    <circle cx="174" cy="164" r="5" fill="#f4383b" />
                    <circle cx="290" cy="272" r="5" fill="#f4383b" />
                    <circle cx="260" cy="397" r="5" fill="#f4383b" />
                </g>
                <g font-family="Arial, sans-serif" font-size="12" fill="#d3d7d2">
                    <text x="394" y="73">ДВИГУН</text>
                    <text x="34" y="177">ГАЛЬМА</text>
                    <text x="399" y="237">КЛІМАТ</text>
                    <text x="34" y="447">ПІДВІСКА</text>
                </g>
            </svg>
            <div class="diagram-footer">
                <span><?php echo esc_html($diagram_footer); ?></span><span aria-hidden="true">↗</span>
            </div>
        </div>
        <div class="about-copy">
            <?php if ($eyebrow) : ?>
                <p class="eyebrow"><?php echo esc_html($eyebrow); ?></p>
            <?php endif; ?>
            <?php if ($title_start || $title_accent) : ?>
                <h2 id="<?php echo esc_attr($title_id); ?>">
                    <?php if ($title_start) : ?><?php echo nl2br(esc_html($title_start)); ?><?php endif; ?>
                    <?php if ($title_accent) : ?><span><?php echo nl2br(esc_html($title_accent)); ?></span><?php endif; ?>
                </h2>
            <?php endif; ?>
            <?php if ($lead) : ?>
                <p class="about-lead"><?php echo nl2br(esc_html($lead)); ?></p>
            <?php endif; ?>
            <?php if (is_array($points) && $points) : ?>
                <?php foreach (array_values($points) as $index => $point) : ?>
                    <?php if (!empty($point['title']) || !empty($point['text'])) : ?>
                        <div class="about-point">
                            <span><?php echo esc_html(sprintf('%02d', $index + 1)); ?></span>
                            <div>
                                <?php if (!empty($point['title'])) : ?>
                                    <h3><?php echo esc_html($point['title']); ?></h3>
                                <?php endif; ?>
                                <?php if (!empty($point['text'])) : ?>
                                    <p><?php echo nl2br(esc_html($point['text'])); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
