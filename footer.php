<?php
defined('ABSPATH') || exit;
$footer_text = get_theme_mod('autofix_footer_text', __("Турбота про авто.\nПовага до вашого часу.", 'autofix'));
$footer_address = get_theme_mod('autofix_footer_address', __('Миколаїв · вул. Троїцька, 244 · бокс 10', 'autofix'));
?>

<footer class="footer">
    <div class="container footer-main">
        <?php get_template_part('template-parts/logo'); ?>
        <?php if ($footer_text !== '') : ?>
            <p><?php echo nl2br(esc_html($footer_text)); ?></p>
        <?php endif; ?>
        <a class="text-link light-link" href="#top"><?php esc_html_e('Нагору ↑', 'autofix'); ?></a>
    </div>
    <div class="container footer-bottom">
        <span>© <?php echo esc_html(wp_date('Y')); ?> <?php esc_html_e('AUTO FIX', 'autofix'); ?></span>
        <?php if ($footer_address !== '') : ?>
            <span class="footer-address"><?php echo esc_html($footer_address); ?></span>
        <?php endif; ?>
        <span><?php esc_html_e('Прайс потребує погодження.', 'autofix'); ?></span>
    </div>
</footer>
<a class="mobile-call" href="tel:+380660568121">
    <?php esc_html_e('Зателефонувати для запису', 'autofix'); ?>
    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
        <path d="M5 19 19 5M5 5h14v14"/>
    </svg>
</a>

<?php get_template_part('template-parts/dialog-contact'); ?>
<?php get_template_part('template-parts/dialog-gallery'); ?>
<?php get_template_part('template-parts/dialog-selection'); ?>
<?php wp_footer(); ?>
</body>
</html>
