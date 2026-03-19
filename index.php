<?php
/**
 * The main template file
 *
 * @package taehos-light-core
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            get_template_part( 'template-parts/content', get_post_type() );
        endwhile;

        the_posts_pagination( array(
            'prev_text' => __( '이전', 'taehos-light-core' ),
            'next_text' => __( '다음', 'taehos-light-core' ),
        ) );
    else :
        echo '<p>' . esc_html__( 'No content found.', 'taehos-light-core' ) . '</p>';
    endif;
    ?>
</main>

<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
<aside id="secondary" class="widget-area">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
<?php endif; ?>

<?php
get_footer();
