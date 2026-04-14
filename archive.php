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
                <ul class="archive-results-list" style="list-style: none; padding: 0;">
                <?php
                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <li id="post-<?php the_ID(); ?>" <?php post_class( 'archive-result-item' ); ?> style="margin-bottom: 2.5em; padding-bottom: 1.5em; border-bottom: 1px solid #eaeaea;">
                        <h2 class="entry-title" style="margin-bottom: 0.5em; font-size: 1.5em;">
                            <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" style="text-decoration: none; color: inherit;">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                        <div class="entry-meta" style="font-size: 0.9em; color: #777; margin-bottom: 1em;">
                            <?php
                            // 카테고리 출력
                            $categories_list = get_the_category_list( esc_html__( ', ', 'taehos-light-core' ) );
                            if ( $categories_list ) {
                                printf( '<span class="cat-links">' . esc_html__( '카테고리: %s', 'taehos-light-core' ) . '</span> <span style="margin: 0 8px;">|</span> ', $categories_list );
                            }

                            // 날짜 출력
                            $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
                            if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
                                $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
                            }
                            $time_string = sprintf(
                                $time_string,
                                esc_attr( get_the_date( DATE_W3C ) ),
                                esc_html( get_the_date() )
                            );
                            echo '<span class="posted-on">' . esc_html__( '작성일: ', 'taehos-light-core' ) . $time_string . '</span>';
                            ?>
                        </div><!-- .entry-meta -->

                        <div class="entry-summary" style="line-height: 1.6; color: #444;">
                            <?php
                            // 요약글 설정 불러오기
                            $excerpt_length = absint( get_theme_mod( 'search_excerpt_length', 55 ) );
                            
                            // 본문에서 HTML 태그(code, pre 등)를 보존하여 요약글 추출
                            $content = get_the_content();
                            $content = strip_shortcodes( $content );
                            
                            // 단락 간 텍스트가 붙지 않도록 줄바꿈을 우선 공백으로 치환
                            $content = str_replace( array( "\r\n", "\r", "\n" ), ' ', $content );
                            
                            // 줄바꿈을 유발하는 블록 태그(p, br, pre 등)를 제외한 인라인 태그만 허용
                            $allowed_tags = '<a><b><strong><i><em><code><span><mark>';
                            $content = strip_tags( $content, $allowed_tags );
                            $content = preg_replace( '/\s+/', ' ', $content ); // 다중 공백을 하나로 압축
                            
                            // 글자 수(Characters) 기준으로 자르면서 HTML 태그 보존하기
                            $excerpt = '';
                            if ( mb_strlen( strip_tags( $content ), 'UTF-8' ) > $excerpt_length ) {
                                $printed_length = 0;
                                preg_match_all( '/(<[^>]+>)|([^<]+)/', $content, $matches, PREG_SET_ORDER );
                                foreach ( $matches as $match ) {
                                    if ( ! empty( $match[1] ) ) {
                                        $excerpt .= $match[1]; // 태그는 그대로 추가
                                    } elseif ( ! empty( $match[2] ) ) {
                                        $text_len = mb_strlen( $match[2], 'UTF-8' );
                                        if ( $printed_length + $text_len > $excerpt_length ) {
                                            $rem_len = $excerpt_length - $printed_length;
                                            $excerpt .= mb_substr( $match[2], 0, $rem_len, 'UTF-8' ) . ' &hellip;';
                                            break;
                                        } else {
                                            $excerpt .= $match[2];
                                            $printed_length += $text_len;
                                        }
                                    }
                                }
                            } else {
                                $excerpt = $content;
                            }
                            
                            // 열린 태그 닫기 및 최종 요약글 출력
                            echo '<p>' . force_balance_tags( trim( $excerpt ) ) . '</p>';
                            ?>
                        </div><!-- .entry-summary -->
                    </li><!-- #post-<?php the_ID(); ?> -->
                    <?php
                endwhile;
                ?>
                </ul>

                <?php
                // 페이지네이션
                the_posts_pagination( array(
                    'prev_text' => __( '이전', 'taehos-light-core' ),
                    'next_text' => __( '다음', 'taehos-light-core' ),
                ) );
                ?>
            </div>
        <?php else : ?>
            <?php get_template_part( 'template-parts/content', 'none' ); ?>
        <?php endif; ?>
    </main><!-- #primary -->

    <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
    <aside id="secondary" class="widget-area">
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    </aside>
    <?php endif; ?>

<?php
get_footer();