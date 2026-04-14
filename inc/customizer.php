<?php
/**
 * Taeho Theme Customizer
 *
 * @package taehos-light-core
 */

function taeho_theme_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    // 레이아웃 설정 패널
    $wp_customize->add_section( 'taeho_layout_section', array(
        'title'      => __( 'Layout Settings', 'taehos-light-core' ),
        'priority'   => 30,
    ) );

    // 컨테이너 전체 폭
    $wp_customize->add_setting( 'container_width', array(
        'default'           => 1200,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'container_width', array(
        'label'       => __( '블로그 컨테이너 넓이 (px)', 'taehos-light-core' ),
        'section'     => 'taeho_layout_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 1000,
            'max'  => 1600,
            'step' => 10,
        ),
    ) );

    // 사이드바 폭
    $wp_customize->add_setting( 'sidebar_width', array(
        'default'           => 300,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'sidebar_width', array(
        'label'       => __( '사이드바 넓이 (px)', 'taehos-light-core' ),
        'section'     => 'taeho_layout_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 200,
            'max'  => 600,
            'step' => 50,
        ),
    ) );

    // 레이아웃 간격
    $wp_customize->add_setting( 'layout_gap', array(
        'default'           => 40,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'layout_gap', array(
        'label'       => __( '구성요소 간 간격 (px)', 'taehos-light-core' ),
        'section'     => 'taeho_layout_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 100,
            'step' => 1,
        ),
    ) );

    // 태그/아카이브 페이지 표시 개수
    $wp_customize->add_setting( 'archive_posts_per_page', array(
        'default'           => 10,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'archive_posts_per_page', array(
        'label'       => __( '태그/카테고리 페이지 표시 개수', 'taehos-light-core' ),
        'section'     => 'taeho_layout_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 1,
            'max'  => 50,
            'step' => 1,
        ),
    ) );

    // 메뉴 설정 패널
    $wp_customize->add_section( 'taeho_menu_section', array(
        'title'      => __( 'Menu Settings', 'taehos-light-core' ),
        'priority'   => 40,
    ) );

    // 메뉴 배경색
    $wp_customize->add_setting( 'menu_bg_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_bg_color', array(
        'label'    => __( 'Menu Background Color', 'taehos-light-core' ),
        'section'  => 'taeho_menu_section',
    ) ) );

    // 메뉴 글자색
    $wp_customize->add_setting( 'menu_text_color', array(
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_text_color', array(
        'label'    => __( '메뉴 글자색', 'taehos-light-core' ),
        'section'  => 'taeho_menu_section',
    ) ) );

    // 메뉴 폰트 사이즈
    $wp_customize->add_setting( 'menu_font_size', array(
        'default'           => 16,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'menu_font_size', array(
        'label'       => __( 'Menu Font Size (px)', 'taehos-light-core' ),
        'section'     => 'taeho_menu_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 10,
            'max'  => 36,
            'step' => 1,
        ),
    ) );

    // 메뉴 폰트 굵기
    $wp_customize->add_setting( 'menu_font_weight', array(
        'default'           => 'normal',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'menu_font_weight', array(
        'label'       => __( 'Menu Font Weight', 'taehos-light-core' ),
        'section'     => 'taeho_menu_section',
        'type'        => 'select',
        'choices'     => array(
            'normal' => __( 'Normal', 'taehos-light-core' ),
            'bold'   => __( 'Bold', 'taehos-light-core' ),
            '500'    => '500',
            '600'    => '600',
            '700'    => '700',
        ),
    ) );

    // 타이포그래피 설정 패널
    $wp_customize->add_section( 'taeho_typography_section', array(
        'title'      => __( '타이포그래피 설정', 'taehos-light-core' ),
        'priority'   => 50,
    ) );

    // 데스크탑 본문 폰트 크기
    $wp_customize->add_setting( 'post_font_size_desktop', array(
        'default'           => 16,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'post_font_size_desktop', array(
        'label'       => __( '데스크탑 본문 폰트 크기 (px)', 'taehos-light-core' ),
        'section'     => 'taeho_typography_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 10,
            'max'  => 36,
            'step' => 1,
        ),
    ) );

    // 모바일 본문 폰트 크기
    $wp_customize->add_setting( 'post_font_size_mobile', array(
        'default'           => 16,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'post_font_size_mobile', array(
        'label'       => __( '모바일 본문 폰트 크기 (px)', 'taehos-light-core' ),
        'section'     => 'taeho_typography_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 10,
            'max'  => 36,
            'step' => 1,
        ),
    ) );

    // 목록 페이지 제목 폰트 크기 (데스크탑)
    $wp_customize->add_setting( 'archive_title_font_size_desktop', array(
        'default'           => 24,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'archive_title_font_size_desktop', array(
        'label'       => __( '목록 페이지 제목 크기 - 데스크탑 (px)', 'taehos-light-core' ),
        'section'     => 'taeho_typography_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 12,
            'max'  => 48,
            'step' => 1,
        ),
    ) );

    // 목록 페이지 제목 폰트 크기 (모바일)
    $wp_customize->add_setting( 'archive_title_font_size_mobile', array(
        'default'           => 20,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'archive_title_font_size_mobile', array(
        'label'       => __( '목록 페이지 제목 크기 - 모바일 (px)', 'taehos-light-core' ),
        'section'     => 'taeho_typography_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 12,
            'max'  => 48,
            'step' => 1,
        ),
    ) );

    // 목록 페이지 요약글 폰트 크기 (데스크탑)
    $wp_customize->add_setting( 'archive_excerpt_font_size_desktop', array(
        'default'           => 15,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'archive_excerpt_font_size_desktop', array(
        'label'       => __( '목록 페이지 요약글 크기 - 데스크탑 (px)', 'taehos-light-core' ),
        'section'     => 'taeho_typography_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 10,
            'max'  => 36,
            'step' => 1,
        ),
    ) );

    // 목록 페이지 요약글 폰트 크기 (모바일)
    $wp_customize->add_setting( 'archive_excerpt_font_size_mobile', array(
        'default'           => 14,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'archive_excerpt_font_size_mobile', array(
        'label'       => __( '목록 페이지 요약글 크기 - 모바일 (px)', 'taehos-light-core' ),
        'section'     => 'taeho_typography_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 10,
            'max'  => 36,
            'step' => 1,
        ),
    ) );

    // 본문 스타일 설정 패널
    $wp_customize->add_section( 'taeho_content_style_section', array(
        'title'      => __( '본문 스타일 설정', 'taehos-light-core' ),
        'priority'   => 55,
    ) );

    // H2 태그 박스 스타일
    $wp_customize->add_setting( 'h2_tag_style', array(
        'default'           => 'none',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'h2_tag_style', array(
        'label'       => __( '본문 소제목(H2) 스타일', 'taehos-light-core' ),
        'section'     => 'taeho_content_style_section',
        'type'        => 'select',
        'choices'     => array(
            'none'     => __( '기본', 'taehos-light-core' ),
            'left_bar' => __( '왼쪽 굵은 선', 'taehos-light-core' ),
            'bottom_line' => __( '아래쪽 선', 'taehos-light-core' ),
            'bg_box'   => __( '배경 박스', 'taehos-light-core' ),
            'quote_style' => __( '점 강조 박스', 'taehos-light-core' ),
        ),
    ) );

    // H3 태그 박스 스타일
    $wp_customize->add_setting( 'h3_tag_style', array(
        'default'           => 'none',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'h3_tag_style', array(
        'label'       => __( '본문 소제목(H3) 스타일', 'taehos-light-core' ),
        'section'     => 'taeho_content_style_section',
        'type'        => 'select',
        'choices'     => array(
            'none'     => __( '기본', 'taehos-light-core' ),
            'left_bar' => __( '왼쪽 굵은 선', 'taehos-light-core' ),
            'bottom_line' => __( '아래쪽 선', 'taehos-light-core' ),
            'bg_box'   => __( '배경 박스', 'taehos-light-core' ),
            'quote_style' => __( '점 강조 박스', 'taehos-light-core' ),
        ),
    ) );

    // 코드 블록 배경색
    $wp_customize->add_setting( 'code_bg_color', array(
        'default'           => '#212529',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'code_bg_color', array(
        'label'    => __( '코드 블록 배경색', 'taehos-light-core' ),
        'section'  => 'taeho_content_style_section',
    ) ) );

    // 코드 블록 글자색
    $wp_customize->add_setting( 'code_text_color', array(
        'default'           => '#f8f9fa',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'code_text_color', array(
        'label'    => __( '코드 블록 글자색', 'taehos-light-core' ),
        'section'  => 'taeho_content_style_section',
    ) ) );

    // 본문 하단 태그 표시 여부
    $wp_customize->add_setting( 'show_post_tags', array(
        'default'           => true,
        'sanitize_callback' => function( $checked ) {
            return ( ( isset( $checked ) && true == $checked ) ? true : false );
        },
    ) );
    $wp_customize->add_control( 'show_post_tags', array(
        'label'       => __( '본문 하단에 태그(Tag) 표시', 'taehos-light-core' ),
        'section'     => 'taeho_content_style_section',
        'type'        => 'checkbox',
    ) );

    // 본문 마지막 수정일 표시 여부
    $wp_customize->add_setting( 'show_modified_date', array(
        'default'           => true,
        'sanitize_callback' => function( $checked ) {
            return ( ( isset( $checked ) && true == $checked ) ? true : false );
        },
    ) );
    $wp_customize->add_control( 'show_modified_date', array(
        'label'       => __( '본문 마지막 수정일 표시', 'taehos-light-core' ),
        'section'     => 'taeho_content_style_section',
        'type'        => 'checkbox',
    ) );

    // 검색 결과 설정 패널
    $wp_customize->add_section( 'taeho_search_section', array(
        'title'      => __( '검색 결과 설정', 'taehos-light-core' ),
        'priority'   => 60,
    ) );

    // 검색 결과 표시 방식
    $wp_customize->add_setting( 'search_display_mode', array(
        'default'           => 'default',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'search_display_mode', array(
        'label'       => __( '검색 결과 표시 방식', 'taehos-light-core' ),
        'section'     => 'taeho_search_section',
        'type'        => 'radio',
        'choices'     => array(
            'default'   => __( '기본 목록 표시 (제목/카테고리/날짜/요약)', 'taehos-light-core' ),
            'shortcode' => __( '플러그인 숏코드 연동', 'taehos-light-core' ),
        ),
    ) );

    // 검색 결과 표시 개수
    $wp_customize->add_setting( 'search_posts_per_page', array(
        'default'           => 10,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'search_posts_per_page', array(
        'label'       => __( '검색 결과 표시 개수', 'taehos-light-core' ),
        'section'     => 'taeho_search_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 1,
            'max'  => 50,
            'step' => 1,
        ),
    ) );

    // 검색 연동 숏코드
    $wp_customize->add_setting( 'search_shortcode', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'search_shortcode', array(
        'label'       => __( '연동할 숏코드 (예: [post_list keyword="{query}"])', 'taehos-light-core' ),
        'description' => __( '{query} 부분은 사용자가 입력한 검색어로 자동 치환됩니다.', 'taehos-light-core' ),
        'section'     => 'taeho_search_section',
        'type'        => 'text',
        'active_callback' => function( $control ) {
            return 'shortcode' === $control->manager->get_setting( 'search_display_mode' )->value();
        },
    ) );

    // 요약글 글자수 (기본 모드)
    $wp_customize->add_setting( 'search_excerpt_length', array(
        'default'           => 55,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'search_excerpt_length', array(
        'label'       => __( '요약글 단어 수 제한 (기본 표시 방식용)', 'taehos-light-core' ),
        'section'     => 'taeho_search_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 10,
            'max'  => 200,
            'step' => 5,
        ),
        'active_callback' => function( $control ) {
            return 'default' === $control->manager->get_setting( 'search_display_mode' )->value();
        },
    ) );

    // 푸터 설정 패널
    $wp_customize->add_section( 'taeho_footer_section', array(
        'title'      => __( '푸터(Footer) 설정', 'taehos-light-core' ),
        'priority'   => 70,
    ) );

    // 블로그 개설 연도
    $wp_customize->add_setting( 'footer_start_year', array(
        'default'           => 2008,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'footer_start_year', array(
        'label'       => __( '블로그 첫 개설 연도', 'taehos-light-core' ),
        'section'     => 'taeho_footer_section',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 1990,
            'max'  => date( 'Y' ),
            'step' => 1,
        ),
    ) );

    // Copyright 문구 타입
    $wp_customize->add_setting( 'footer_copyright_type', array(
        'default'           => 'sample1',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'footer_copyright_type', array(
        'label'       => __( 'Copyright 문구 선택', 'taehos-light-core' ),
        'section'     => 'taeho_footer_section',
        'type'        => 'radio',
        'choices'     => array(
            'sample1' => __( 'Created by [사이트이름]. All rights reserved.', 'taehos-light-core' ),
            'sample2' => __( 'Copyright [사이트이름]. All rights reserved.', 'taehos-light-core' ),
            'custom'  => __( '직접 입력', 'taehos-light-core' ),
        ),
    ) );

    // 직접 입력한 Copyright 문구
    $wp_customize->add_setting( 'footer_custom_copyright', array(
        'default'           => 'Created by taeho. All rights reserved.',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'footer_custom_copyright', array(
        'label'       => __( '직접 입력할 Copyright 문구', 'taehos-light-core' ),
        'section'     => 'taeho_footer_section',
        'type'        => 'text',
        'active_callback' => function( $control ) {
            return 'custom' === $control->manager->get_setting( 'footer_copyright_type' )->value();
        },
    ) );
}
add_action( 'customize_register', 'taeho_theme_customize_register' );

// 동적 CSS 생성
function taeho_theme_dynamic_css() {
    $container_width = absint( get_theme_mod( 'container_width', 1200 ) );
    $sidebar_width   = absint( get_theme_mod( 'sidebar_width', 300 ) );
    $gap             = absint( get_theme_mod( 'layout_gap', 40 ) );
    
    $menu_bg_color    = sanitize_hex_color( get_theme_mod( 'menu_bg_color', '#ffffff' ) );
    $menu_text_color  = sanitize_hex_color( get_theme_mod( 'menu_text_color', '#333333' ) );
    $menu_font_size   = absint( get_theme_mod( 'menu_font_size', 16 ) );
    $menu_font_weight = esc_attr( get_theme_mod( 'menu_font_weight', 'normal' ) );

    $post_font_size_desktop = absint( get_theme_mod( 'post_font_size_desktop', 16 ) );
    $post_font_size_mobile  = absint( get_theme_mod( 'post_font_size_mobile', 16 ) );

    $archive_title_desktop   = absint( get_theme_mod( 'archive_title_font_size_desktop', 24 ) );
    $archive_title_mobile    = absint( get_theme_mod( 'archive_title_font_size_mobile', 20 ) );
    $archive_excerpt_desktop = absint( get_theme_mod( 'archive_excerpt_font_size_desktop', 15 ) );
    $archive_excerpt_mobile  = absint( get_theme_mod( 'archive_excerpt_font_size_mobile', 14 ) );

    $h2_tag_style    = esc_attr( get_theme_mod( 'h2_tag_style', 'none' ) );
    $h3_tag_style    = esc_attr( get_theme_mod( 'h3_tag_style', 'none' ) );
    $code_bg_color   = sanitize_hex_color( get_theme_mod( 'code_bg_color', '#212529' ) );
    $code_text_color = sanitize_hex_color( get_theme_mod( 'code_text_color', '#f8f9fa' ) );

    $h_tag_css = '';
    
    // H2 스타일
    if ( 'left_bar' === $h2_tag_style ) {
        $h_tag_css .= "
        .entry-content h2 { border-left: 5px solid #333; padding-left: 10px; margin-top: 1.5em; margin-bottom: 1em; }";
    } elseif ( 'bottom_line' === $h2_tag_style ) {
        $h_tag_css .= "
        .entry-content h2 { border-bottom: 2px solid #333; padding-bottom: 5px; margin-top: 1.5em; margin-bottom: 1em; }";
    } elseif ( 'bg_box' === $h2_tag_style ) {
        $h_tag_css .= "
        .entry-content h2 { background-color: #f8f9fa; padding: 10px 15px; border-radius: 5px; border: 1px solid #e9ecef; margin-top: 1.5em; margin-bottom: 1em; }";
    } elseif ( 'quote_style' === $h2_tag_style ) {
        $h_tag_css .= "
        .entry-content h2 { position: relative; padding: 10px 15px 10px 30px; background-color: #f1f3f5; border-radius: 4px; margin-top: 1.5em; margin-bottom: 1em; }
        .entry-content h2::before { content: ''; position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 8px; height: 8px; background-color: #333; border-radius: 50%; }";
    }

    // H3 스타일
    if ( 'left_bar' === $h3_tag_style ) {
        $h_tag_css .= "
        .entry-content h3 { border-left: 5px solid #333; padding-left: 10px; margin-top: 1.5em; margin-bottom: 1em; }";
    } elseif ( 'bottom_line' === $h3_tag_style ) {
        $h_tag_css .= "
        .entry-content h3 { border-bottom: 2px solid #333; padding-bottom: 5px; margin-top: 1.5em; margin-bottom: 1em; }";
    } elseif ( 'bg_box' === $h3_tag_style ) {
        $h_tag_css .= "
        .entry-content h3 { background-color: #f8f9fa; padding: 10px 15px; border-radius: 5px; border: 1px solid #e9ecef; margin-top: 1.5em; margin-bottom: 1em; }";
    } elseif ( 'quote_style' === $h3_tag_style ) {
        $h_tag_css .= "
        .entry-content h3 { position: relative; padding: 10px 15px 10px 30px; background-color: #f1f3f5; border-radius: 4px; margin-top: 1.5em; margin-bottom: 1em; }
        .entry-content h3::before { content: ''; position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 8px; height: 8px; background-color: #333; border-radius: 50%; }";
    }

    $dynamic_style = "
        .site-header,
        .site-footer {
            max-width: {$container_width}px;
            margin: 0 auto;
            padding-left: 0;
            padding-right: 0;
            box-sizing: border-box;
        }
        .site-container {
            max-width: {$container_width}px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr {$sidebar_width}px;
            gap: {$gap}px;
            padding: 0;
            box-sizing: border-box;
        }

        @media (max-width: " . ($container_width + 40) . "px) {
            .site-header,
            .site-footer {
                padding-left: 20px;
                padding-right: 20px;
            }
            .site-container {
                padding-left: 20px;
                padding-right: 20px;
            }
        }

        .main-navigation {
            background-color: {$menu_bg_color};
            border-radius: 4px; /* 옵션: 배경색이 들어갔을 때 모서리를 둥글게 */
        }
        .main-navigation a {
            color: {$menu_text_color};
            font-size: {$menu_font_size}px;
            font-weight: {$menu_font_weight};
        }
        .entry-content,
        .entry-content p,
        .entry-content li {
            font-size: {$post_font_size_desktop}px;
        }
        
        /* 목록 페이지(메인, 카테고리 등) 데스크탑 폰트 크기 */
        .blog .entry-title, .blog .entry-title a,
        .archive .entry-title, .archive .entry-title a,
        .search .entry-title, .search .entry-title a {
            font-size: {$archive_title_desktop}px;
        }
        .blog .entry-content, .blog .entry-content p, .blog .entry-content li,
        .archive .entry-content, .archive .entry-content p, .archive .entry-content li,
        .search .entry-content, .search .entry-content p, .search .entry-content li {
            font-size: {$archive_excerpt_desktop}px;
        }

        pre,
        .wp-block-code {
            background-color: {$code_bg_color};
        }
        pre code,
        .wp-block-code code {
            color: {$code_text_color};
            background-color: transparent; /* 혹시나 겹치는 스타일 방지 */
        }
        {$h_tag_css}

        @media (max-width: 768px) {
            .entry-content,
            .entry-content p,
            .entry-content li {
                font-size: {$post_font_size_mobile}px;
            }
            
            /* 목록 페이지 모바일 폰트 크기 */
            .blog .entry-title, .blog .entry-title a,
            .archive .entry-title, .archive .entry-title a,
            .search .entry-title, .search .entry-title a {
                font-size: {$archive_title_mobile}px;
            }
            .blog .entry-content, .blog .entry-content p, .blog .entry-content li,
            .archive .entry-content, .archive .entry-content p, .archive .entry-content li,
            .search .entry-content, .search .entry-content p, .search .entry-content li {
                font-size: {$archive_excerpt_mobile}px;
            }
        }
    ";
    wp_add_inline_style( 'taehos-light-core-style', $dynamic_style );
}
add_action( 'wp_enqueue_scripts', 'taeho_theme_dynamic_css' );

/**
 * 실시간 커스터마이저 미리보기를 위한 자바스크립트 등록
 */
function taeho_theme_customize_preview_js() {
    wp_enqueue_script( 'taehos-light-core-customizer', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '1.0.0', true );
}
add_action( 'customize_preview_init', 'taeho_theme_customize_preview_js' );
