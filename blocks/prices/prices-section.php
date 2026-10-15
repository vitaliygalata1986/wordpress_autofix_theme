<?php
defined('ABSPATH') || exit;

$preview_image = $block['data']['preview_image'] ?? '';
if (!empty($is_preview) && is_string($preview_image) && $preview_image !== '') {
    if (is_file(get_template_directory() . $preview_image)) {
        echo '<img src="' . esc_url(get_template_directory_uri() . $preview_image) . '" alt="' . esc_attr__('Вартість робіт — попередній перегляд', 'autofix') . '" style="width: 100%; height: auto;">';
    } else {
        echo '<p>' . esc_html__('Вартість робіт — прайс і розрахунок вартості послуг.', 'autofix') . '</p>';
    }
    return;
}

if (!function_exists('get_field')) {
    return;
}

$eyebrow = get_field('prices_eyebrow');
$title = get_field('prices_title');
$demo_label = get_field('prices_demo_label');
$intro = get_field('prices_intro');
$rows = get_field('prices_rows');
$footnote = get_field('prices_footnote');
$estimate_eyebrow = get_field('prices_estimate_eyebrow');
$estimate_title = get_field('prices_estimate_title');
$estimate_description = get_field('prices_estimate_description');
$estimate_note = get_field('prices_estimate_note');
$estimate_phone = get_field('prices_estimate_phone');
$estimate_phone_fallback = ['url' => 'tel:+380660568121', 'title' => __('Уточнити ціну телефоном', 'autofix'), 'target' => ''];
$estimate_phone = is_array($estimate_phone) && !empty($estimate_phone['url']) && !empty($estimate_phone['title']) ? $estimate_phone : $estimate_phone_fallback;
$section_id = !empty($block['anchor']) ? $block['anchor'] : 'prices';
$title_id = $section_id . '-title';
$classes = 'section prices';
$categories = ['maintenance', 'diagnostics', 'chassis', 'engine', 'climate'];

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
            <div class="section-intro">
                <?php if ($demo_label) : ?>
                    <span class="demo-label"><?php echo esc_html($demo_label); ?></span>
                <?php endif; ?>
                <?php if ($intro) : ?>
                    <p><?php echo nl2br(esc_html($intro)); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="price-layout">
            <div class="price-list">
                <div class="price-filters" role="group" aria-label="<?php esc_attr_e('Фільтр послуг', 'autofix'); ?>" hidden>
                    <button class="active" data-filter="all" aria-pressed="true"><?php esc_html_e('Усі послуги', 'autofix'); ?></button>
                    <button data-filter="maintenance" aria-pressed="false"><?php esc_html_e('ТО', 'autofix'); ?></button>
                    <button data-filter="diagnostics" aria-pressed="false"><?php esc_html_e('Діагностика', 'autofix'); ?></button>
                    <button data-filter="chassis" aria-pressed="false"><?php esc_html_e('Ходова й гальма', 'autofix'); ?></button>
                    <button data-filter="engine" aria-pressed="false"><?php esc_html_e('Двигун', 'autofix'); ?></button>
                    <button data-filter="climate" aria-pressed="false"><?php esc_html_e('Клімат', 'autofix'); ?></button>
                </div>
                <div class="price-table-head">
                    <span><?php esc_html_e('ПОСЛУГА', 'autofix'); ?></span><span><?php esc_html_e('РОБОТА, ВІД', 'autofix'); ?></span>
                </div>
                <?php if (is_array($rows) && $rows) : ?>
                    <div class="price-rows">
                        <?php foreach ($rows as $row) : ?>
                            <?php
                            $category = sanitize_key($row['category'] ?? '');
                            if (!in_array($category, $categories, true)) {
                                $category = 'maintenance';
                            }
                            $service = (string) ($row['service'] ?? '');
                            $dialog_service = (string) ($row['dialog_service'] ?? '');
                            $description = (string) ($row['description'] ?? '');
                            $price = absint($row['price'] ?? 0);
                            ?>
                            <?php if ($service !== '') : ?>
                                <label class="price-row" data-category="<?php echo esc_attr($category); ?>">
                                    <input type="checkbox" value="<?php echo esc_attr((string) $price); ?>" data-service="<?php echo esc_attr($dialog_service !== '' ? $dialog_service : $service); ?>" />
                                    <span>
                                        <?php echo esc_html($service); ?>
                                        <?php if ($description !== '') : ?><small><?php echo esc_html($description); ?></small><?php endif; ?>
                                    </span>
                                    <strong><?php echo esc_html(number_format_i18n($price)); ?> <small><?php esc_html_e('грн', 'autofix'); ?></small></strong>
                                </label>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php if ($footnote) : ?>
                    <p class="price-footnote"><?php echo nl2br(esc_html($footnote)); ?></p>
                <?php endif; ?>
            </div>

            <aside class="estimate"<?php if ($estimate_title) : ?> aria-labelledby="estimate-title"<?php endif; ?>>
                <div class="estimate-top">
                    <?php if ($estimate_eyebrow) : ?><span class="eyebrow"><?php echo esc_html($estimate_eyebrow); ?></span><?php endif; ?>
                    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M5 19 19 5M5 5h14v14"/></svg>
                </div>
                <?php if ($estimate_title) : ?><h3 id="estimate-title"><?php echo nl2br(esc_html($estimate_title)); ?></h3><?php endif; ?>
                <?php if ($estimate_description) : ?><p class="estimate-description"><?php echo nl2br(esc_html($estimate_description)); ?></p><?php endif; ?>
                <div class="estimate-results" aria-live="polite" aria-atomic="true">
                    <p id="selection-count"><?php esc_html_e('Послуги ще не обрані', 'autofix'); ?></p>
                    <div class="estimate-total">
                        <span><?php esc_html_e('від', 'autofix'); ?></span><strong id="estimate-total">0</strong><span><?php esc_html_e('грн', 'autofix'); ?></span>
                    </div>
                </div>
                <?php if ($estimate_note) : ?><p class="estimate-note"><?php echo nl2br(esc_html($estimate_note)); ?></p><?php endif; ?>
                <button class="button button-orange" id="review-selection" type="button" hidden>
                    <?php esc_html_e('Переглянути список', 'autofix'); ?> <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M5 19 19 5M5 5h14v14"/></svg>
                </button>
                <?php if (!empty($estimate_phone['url']) && !empty($estimate_phone['title'])) : ?>
                    <a class="estimate-call" href="<?php echo esc_url($estimate_phone['url']); ?>"<?php if (($estimate_phone['target'] ?? '') === '_blank') : ?> target="_blank" rel="noopener noreferrer"<?php endif; ?>><?php echo esc_html($estimate_phone['title']); ?></a>
                <?php endif; ?>
                <button class="reset-selection" type="button" id="reset-selection" hidden><?php esc_html_e('Очистити вибір', 'autofix'); ?></button>
                <noscript><p><?php esc_html_e('Для підрахунку ввімкніть JavaScript. Усі ціни й телефон доступні без нього.', 'autofix'); ?></p></noscript>
                <div class="estimate-watermark" aria-hidden="true">AF</div>
            </aside>
        </div>
    </div>
</section>
