<?php
defined('ABSPATH') || exit;
?>
<dialog id="contact-dialog" aria-labelledby="contact-title" aria-describedby="contact-intro">
    <div class="dialog-content">
        <button class="dialog-close" type="button" aria-label="<?php esc_attr_e('Закрити вибір зв’язку', 'autofix'); ?>"
                autofocus>×
        </button>
        <p class="eyebrow muted"><?php esc_html_e('НА ЗВ’ЯЗКУ', 'autofix'); ?></p>
        <h2 id="contact-title"><?php esc_html_e('Поговорити зі старшим механіком', 'autofix'); ?></h2>
        <p id="contact-intro"><?php esc_html_e('Оберіть зручний спосіб: зателефонуйте або напишіть, що турбує ваше авто.', 'autofix'); ?></p>
        <div class="contact-options">
            <a class="contact-option" href="tel:+380660568121">

                <span><?php esc_html_e('Зателефонувати', 'autofix'); ?><small>+380 66 056 81 21</small></span>
                <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                    <path d="M5 19 19 5M5 5h14v14"/>
                </svg>
            </a>
            <a class="contact-option contact-viber" href="viber://chat?number=%2B380660568121">

                <span>Viber<small><?php esc_html_e('Написати механіку', 'autofix'); ?></small></span>
                <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                    <path d="M5 19 19 5M5 5h14v14"/>
                </svg>
            </a>
            <a class="contact-option contact-telegram" href="https://t.me/+380660568121" target="_blank"
               rel="noopener noreferrer">
                <span class="contact-option-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path
                                d="m3 10 18-7-4 18-6-6-4 3 1-6Zm5 2 13-9M11 15l10-12"/></svg></span>
                <span>Telegram<small><?php esc_html_e('Написати механіку', 'autofix'); ?></small></span>
                <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                    <path d="M5 19 19 5M5 5h14v14"/>
                </svg>
            </a>
            <a class="contact-option contact-whatsapp" href="https://wa.me/380660568121" target="_blank"
               rel="noopener noreferrer">
                <span class="contact-option-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path
                                d="M21 11.5a9 9 0 0 1-13 8L3 21l1.5-5A9 9 0 1 1 21 11.5Z"/><path
                                d="m9 7 2 3-1 1 3 3 1-1 3 2c-2 4-10-2-10-6Z"/></svg></span>
                <span>WhatsApp<small><?php esc_html_e('Написати механіку', 'autofix'); ?></small></span>
                <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                    <path d="M5 19 19 5M5 5h14v14"/>
                </svg>
            </a>
        </div>
    </div>
</dialog>
