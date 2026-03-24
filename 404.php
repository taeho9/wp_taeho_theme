<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package taehos-light-core
 */

get_header();
?>

    <main id="primary" class="site-main">
        <?php
        // content-none.php 템플릿 파트를 불러옵니다.
        // is_404() 함수를 통해 content-none.php 내부에서 404 전용 메시지를 출력합니다.
        get_template_part( 'template-parts/content', 'none' );
        ?>
    </main><!-- #primary -->

    <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
    <aside id="secondary" class="widget-area">
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    </aside>
    <?php endif; ?>

<?php
get_footer();
