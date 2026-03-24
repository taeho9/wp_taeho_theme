<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package taehos-light-core
 */

?>

<section class="no-results not-found" style="text-align: center; padding: 4em 2em; background-color: #f9f9f9; border-radius: 8px; margin-bottom: 2em; border: 1px solid #eaeaea;">
    <?php
    // 구글 광고 등을 삽입할 수 있는 액션 훅
    do_action( 'taeho_before_content_none' );
    ?>
    <header class="page-header" style="margin-bottom: 1.5em;">
        <h1 class="page-title" style="font-size: 2em; margin-bottom: 0.5em; color: #333;">
            <?php
            if ( is_404() ) {
                esc_html_e( '앗! 페이지를 찾을 수 없습니다.', 'taehos-light-core' );
            } elseif ( is_search() ) {
                esc_html_e( '검색 결과가 없습니다.', 'taehos-light-core' );
            } else {
                esc_html_e( '콘텐츠를 찾을 수 없습니다.', 'taehos-light-core' );
            }
            ?>
        </h1>
    </header><!-- .page-header -->

    <div class="page-content" style="color: #666; font-size: 1.1em; line-height: 1.6;">
        <?php
        if ( is_404() ) :
            ?>
            <p><?php esc_html_e( '찾으시는 페이지의 주소가 잘못 입력되었거나, 변경 혹은 삭제되어 요청하신 페이지를 찾을 수 없습니다.', 'taehos-light-core' ); ?></p>
            <p><?php esc_html_e( '검색을 통해 원하시는 내용을 찾아보세요.', 'taehos-light-core' ); ?></p>
            <?php
            echo '<div style="max-width: 400px; margin: 2em auto 0;">';
            get_search_form();
            echo '</div>';

        elseif ( is_search() ) :
            ?>
            <p><?php esc_html_e( '입력하신 검색어에 해당하는 결과가 없습니다. 다른 검색어로 다시 시도해 보세요.', 'taehos-light-core' ); ?></p>
            <?php
            echo '<div style="max-width: 400px; margin: 2em auto 0;">';
            get_search_form();
            echo '</div>';

        else :
            ?>
            <p><?php esc_html_e( '찾으시는 콘텐츠가 존재하지 않거나, 아직 작성된 글이 없습니다.', 'taehos-light-core' ); ?></p>
            <p><?php esc_html_e( '다른 카테고리를 확인하시거나 검색 기능을 이용해 보세요.', 'taehos-light-core' ); ?></p>
            <?php
            echo '<div style="max-width: 400px; margin: 2em auto 0;">';
            get_search_form();
            echo '</div>';

        endif;
        ?>
    </div><!-- .page-content -->
</section><!-- .no-results -->
