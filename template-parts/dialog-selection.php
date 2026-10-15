<?php
defined('ABSPATH') || exit;
?>
<dialog id="selection-dialog" aria-labelledby="dialog-title">
    <div class="dialog-content">
        <button class="dialog-close" type="button" aria-label="<?php esc_attr_e('Закрити', 'autofix'); ?>">
            ×
        </button>
        <p class="eyebrow muted"><?php esc_html_e('ПЛАН ВІЗИТУ', 'autofix'); ?></p>
        <h2 id="dialog-title"><?php esc_html_e('Ваш список робіт', 'autofix'); ?></h2>
        <p id="dialog-intro">
            <?php esc_html_e('Оберіть роботи в прайсі або обговоріть потрібну послугу телефоном.', 'autofix'); ?>
        </p>
        <ul id="dialog-services"></ul>
        <p class="dialog-total" id="dialog-total"></p>
        <p class="dialog-note">
            <?php esc_html_e('Попередній розрахунок за демонстраційними цінами. Запчастини та
            матеріали не включено. Запис і вартість підтверджуються телефоном.', 'autofix'); ?>
        </p>
        <a class="button button-orange" href="tel:+380660568121"
        ><?php esc_html_e('Зателефонувати', 'autofix'); ?>

        </a
        >
        <button class="copy-button" id="copy-selection" type="button">
            <?php esc_html_e('Скопіювати список', 'autofix'); ?>
        </button>
        <p class="copy-status" id="copy-status" role="status"></p>
        <textarea
                id="copy-fallback"
                readonly
                aria-label="<?php esc_attr_e('Список для ручного копіювання', 'autofix'); ?>"
                hidden
        ></textarea>
    </div>
</dialog>
