<?php
defined('ABSPATH') || exit;
get_header();
?>
    <main id="main">
        <?php the_post(); ?>
        <?php the_content(); ?>
    </main>
<?php
get_footer();
