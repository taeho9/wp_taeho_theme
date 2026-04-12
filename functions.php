<?php
/**
 * Taeho Theme functions and definitions
 *
 * @package taehos-light-core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // 직접 접근 차단
}

// 테마 지원 및 설정 초기화
function taeho_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-header' );
    add_theme_support( 'custom-background' );
    
    // 메뉴 등록
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'taehos-light-core' ),
    ) );
}
add_action( 'after_setup_theme', 'taeho_theme_setup' );

// 스크립트 및 스타일 큐 등록
function taeho_theme_scripts() {
    // style.css 파일의 마지막 수정 시간을 버전으로 사용하여 캐시 문제 방지
    $theme_version = filemtime( get_stylesheet_directory() . '/style.css' );
    wp_enqueue_style( 'taehos-light-core-style', get_stylesheet_uri(), array(), $theme_version );
}
add_action( 'wp_enqueue_scripts', 'taeho_theme_scripts' );

// 위젯 영역 등록
function taeho_theme_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'taehos-light-core' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Add widgets here.', 'taehos-light-core' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'taeho_theme_widgets_init' );

// 커스텀 모듈 로드
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/security.php';

// 댓글 폼 필드 및 순서 사용자 정의
function taeho_custom_comment_form( $fields ) {
    $commenter = wp_get_current_commenter();
    
    $author = '<p class="comment-form-author"><label for="author">' . __( '이름' ) . '</label> <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" /></p>';
    
    $email = '<p class="comment-form-email"><label for="email">' . __( '이메일 (필수) <span class="required">*</span>' ) . '</label> <input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" required="required" /></p>';
    
    $url = '<p class="comment-form-url"><label for="url">' . __( '웹사이트 주소' ) . '</label> <input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';
    
    $comment = '<p class="comment-form-comment"><label for="comment">' . _x( '내용 (필수) <span class="required">*</span>', 'noun' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="2" maxlength="65525" required="required"></textarea></p>';

    // 기존 필드 유지하면서 순서 재배치
    $new_fields = array();
    if ( ! is_user_logged_in() ) {
        $new_fields['author_email_row'] = '<div class="comment-form-row">' . $author . $email . '</div>';
    }
    $new_fields['comment'] = $comment;
    if ( ! is_user_logged_in() ) {
        $new_fields['url'] = $url;
    }
    
    // author, email, url, comment를 제외한 나머지 플러그인 추가 필드(예: 쿠키 동의, 구독 옵션 등) 보존
    foreach ( $fields as $key => $field ) {
        if ( ! in_array( $key, array( 'author', 'email', 'url', 'comment' ) ) ) {
            $new_fields[ $key ] = $field;
        }
    }

    return $new_fields;
}
add_filter( 'comment_form_fields', 'taeho_custom_comment_form' );

// 본문 하단 태그 자동 추가 (코드 스니펫 애드센스 광고보다 먼저 출력되도록 제어)
function taeho_append_tags_to_content( $content ) {
    // 태그 표시 설정이 켜져 있고, 단일 포스트의 메인 루프인 경우에만 실행
    if ( is_singular( 'post' ) && in_the_loop() && is_main_query() && get_theme_mod( 'show_post_tags', true ) ) {
        $tags_list = get_the_tag_list( '', ' ' );
        if ( $tags_list ) {
            $tags_html  = '<div class="entry-tags">';
            $tags_html .= '<span class="tags-label">' . esc_html__( '태그:', 'taehos-light-core' ) . '</span> ';
            $tags_html .= wp_kses_post( $tags_list );
            $tags_html .= '</div>';
            
            $content .= $tags_html;
        }
    }
    return $content;
}
add_filter( 'the_content', 'taeho_append_tags_to_content', 5 ); // 우선순위를 5로 주어 애드센스(기본값 10)보다 먼저 텍스트에 결합시킴

// 검색 결과 및 아카이브(태그, 카테고리 등) 페이지에 noindex, follow 메타 태그 적용
function taeho_theme_noindex_archives( $robots ) {
    if ( is_search() || is_archive() || is_tag() || is_category() ) {
        $robots['noindex'] = true;
        $robots['follow']  = true;
        // index 값이 기존에 설정되어 있다면 충돌 방지를 위해 제거
        unset( $robots['index'] );
    }
    return $robots;
}
add_filter( 'wp_robots', 'taeho_theme_noindex_archives' );

// 검색 결과 및 아카이브(태그 포함) 페이지의 표시 글 개수 설정
function taeho_theme_custom_posts_per_page( $query ) {
    // 관리자 페이지가 아니고, 메인 쿼리일 때만 실행 (메뉴나 위젯 등의 사이드 이펙트 방지)
    if ( ! is_admin() && $query->is_main_query() ) {
        if ( $query->is_search() ) {
            $search_limit = get_theme_mod( 'search_posts_per_page', 10 );
            $query->set( 'posts_per_page', absint( $search_limit ) );
        } elseif ( $query->is_archive() || $query->is_tag() || $query->is_category() ) { // 태그 및 카테고리를 명시적으로 추가
            $archive_limit = get_theme_mod( 'archive_posts_per_page', 10 );
            $query->set( 'posts_per_page', absint( $archive_limit ) );
        }
    }
}
add_action( 'pre_get_posts', 'taeho_theme_custom_posts_per_page' );
