<?php
defined('ABSPATH') || exit;
?>
<dialog id="gallery-dialog" class="gallery-dialog" aria-label="<?php esc_attr_e('Перегляд фотографії', 'autofix'); ?>">
    <button class="gallery-close" type="button" aria-label="<?php esc_attr_e('Закрити фото', 'autofix'); ?>" autofocus>
        ×
    </button>
    <img class="gallery-full-image" alt=""/>
    <p class="gallery-image-error" role="status"
       hidden><?php esc_html_e('Не вдалося завантажити фото. Спробуйте ще раз.', 'autofix'); ?></p>
</dialog>
