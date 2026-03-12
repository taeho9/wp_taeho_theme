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
    wp_enqueue_style( 'taehos-light-core-style', get_stylesheet_uri(), array(), '1.0.0' );
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
