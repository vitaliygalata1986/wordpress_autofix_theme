<?php
defined('ABSPATH') || exit;

$phones = [];
foreach (autofix_header_phone_defaults() as $key => $defaults) {
    $number = trim((string)get_theme_mod('autofix_header_phone_' . $key . '_number', $defaults['number']));
    if (!preg_match('/^\+?[0-9\s().-]+$/', $number)) {
        continue;
    }
    $digits = preg_replace('/\D/', '', $number);
    if ($digits === '') {
        continue;
    }
    $label = trim((string)get_theme_mod('autofix_header_phone_' . $key . '_label', $defaults['label']));
    $phones[] = [
            'number' => $number,
            'label' => $label,
            'url' => 'tel:' . (strpos($number, '+') === 0 ? '+' : '') . $digits,
    ];
}
?>
<?php if ($phones) : ?>
    <div class="header-phones">
        <?php foreach ($phones as $phone) : ?>
            <a class="header-phone" href="<?php echo esc_url($phone['url']); ?>"
               aria-label="<?php echo esc_attr($phone['label'] !== '' ? $phone['label'] . ': ' . $phone['number'] : $phone['number']); ?>">
                <?php if ($phone['label'] !== '') : ?>
                    <span class="header-phone-label"><?php echo esc_html($phone['label']); ?></span>
                <?php endif; ?>
                <?php echo esc_html($phone['number']); ?>
                <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                    <path d="M5 19 19 5M5 5h14v14"/>
                </svg>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
