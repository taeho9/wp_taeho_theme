<?php
/**
 * The template for displaying archive pages (Tags, Categories, Authors, etc.)
 *
 * @package taehos-light-core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // 직접 접근 차단
}

get_header();
?>

    <main id="primary" class="site-main">
        <?php if ( have_posts() ) : ?>
            <header class="page-header" style="margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid #eaeaea;">
                <?php
                // 태그, 카테고리 등의 제목을 자동으로 출력합니다.
                the_archive_title( '<h1 class="page-title" style="margin-top: 0;">', '</h1>' );
                the_archive_description( '<div class="archive-description">', '</div>' );
                ?>
            </header><!-- .page-header -->

            <?php do_action( 'taehos_before_archive_results' ); ?>

            <div class="archive-post-list">
                <?php
                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'archive-article' ); ?> style="margin-bottom: 40px;">
                        <header class="entry-header">
                            <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                        </header><!-- .entry-header -->

                        <div class="entry-content">
                            <?php the_excerpt(); ?>
                        </div><!-- .entry-content -->
                    </article><!-- #post-<?php the_ID(); ?> -->
                    <?php
                endwhile;

                // 페이지네이션
                the_posts_pagination( array(
                    'prev_text' => __( '이전', 'taehos-light-core' ),
                    'next_text' => __( '다음', 'taehos-light-core' ),
                ) );
                ?>
            </div>
        <?php else : ?>
            <section class="no-results not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e( '검색 결과가 없습니다.', 'taehos-light-core' ); ?></h1>
                </header>
                <div class="page-content">
                    <p><?php esc_html_e( '찾으시는 태그나 카테고리에 해당하는 글이 없습니다.', 'taehos-light-core' ); ?></p>
                </div>
            </section>
        <?php endif; ?>
    </main><!-- #primary -->

    <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
    <aside id="secondary" class="widget-area">
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    </aside>
    <?php endif; ?>

<?php
get_footer();