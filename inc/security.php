<?php
/**
 * Security and Hardening functions
 *
 * @package taehos-light-core
 */

function taeho_theme_security_headers() {
    if ( ! is_admin() ) {
        // HSTS 강제 (1년, 하위 도메인 포함)
        header( 'Strict-Transport-Security: max-age=31536000; includeSubDomains; preload' );
        
        // 클릭재킹 방어
        header( 'X-Frame-Options: SAMEORIGIN' );
        
        // MIME 유형 스니핑 차단
        header( 'X-Content-Type-Options: nosniff' );
        
        // Referrer-Policy
        header( 'Referrer-Policy: strict-origin-when-cross-origin' );
    }
}
add_action( 'send_headers', 'taeho_theme_security_headers' );

// 워드프레스 버전 정보 제거
add_filter( 'the_generator', '__return_empty_string' );
