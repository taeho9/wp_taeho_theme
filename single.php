<?php
/**
 * The template for displaying all single posts
 *
 * @package taehos-light-core
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    while ( have_posts() ) :
        the_post();

        get_template_part( 'template-parts/content', get_post_type() );

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

    endwhile; // End of the loop.
    ?>
</main>

<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
<aside id="secondary" class="widget-area">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
<?php endif; ?>

<?php
get_footer();
