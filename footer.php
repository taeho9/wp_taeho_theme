<?php
/**
 * The template for displaying the footer
 *
 * @package taehos-light-core
 */
?>
    </div><!-- .site-container -->

    <footer id="colophon" class="site-footer">
        <div class="site-info">
            <?php
            $start_year     = get_theme_mod( 'footer_start_year', 2008 );
            $current_year   = date( 'Y' );
            $copyright_type = get_theme_mod( 'footer_copyright_type', 'sample1' );
            $site_title     = get_bloginfo( 'name' );

            if ( 'sample1' === $copyright_type ) {
                $copyright_text = sprintf( 'Created by %s. All rights reserved.', $site_title );
            } elseif ( 'sample2' === $copyright_type ) {
                $copyright_text = sprintf( 'Copyright %s. All rights reserved.', $site_title );
            } else {
                $copyright_text = get_theme_mod( 'footer_custom_copyright', 'Created by taeho. All rights reserved.' );
            }

            if ( (int) $start_year === (int) $current_year ) {
                printf( esc_html__( '© %1$s %2$s', 'taehos-light-core' ), esc_html( $start_year ), esc_html( $copyright_text ) );
            } else {
                printf( esc_html__( '© %1$s - %2$s %3$s', 'taehos-light-core' ), esc_html( $start_year ), esc_html( $current_year ), esc_html( $copyright_text ) );
            }
            ?>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

<div class="floating-scroll-nav">
    <button class="scroll-btn scroll-top" aria-label="맨 위로" title="맨 위로">
        <svg viewBox="0 0 24 24"><path d="M4 3v2h16V3H4zm4 8h3v10h2V11h3l-4-4-4 4z"/></svg>
    </button>
    <button class="scroll-btn scroll-page-up" aria-label="한 페이지 위로" title="한 페이지 위로">
        <svg viewBox="0 0 24 24"><path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/></svg>
    </button>
    <button class="scroll-btn scroll-page-down" aria-label="한 페이지 아래로" title="한 페이지 아래로">
        <svg viewBox="0 0 24 24"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>
    </button>
    <button class="scroll-btn scroll-bottom" aria-label="맨 아래로" title="맨 아래로">
        <svg viewBox="0 0 24 24"><path d="M16 13h-3V3h-2v10H8l4 4 4-4zm-12 6v2h16v-2H4z"/></svg>
    </button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // 플로팅 스크롤 네비게이션 로직
    var floatNav = document.querySelector('.floating-scroll-nav');
    if (floatNav) {
        var btnTop = floatNav.querySelector('.scroll-top');
        var btnPageUp = floatNav.querySelector('.scroll-page-up');
        var btnPageDown = floatNav.querySelector('.scroll-page-down');
        var btnBottom = floatNav.querySelector('.scroll-bottom');

        if (btnTop) btnTop.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        if (btnPageUp) btnPageUp.addEventListener('click', function() {
            window.scrollBy({ top: -window.innerHeight, behavior: 'smooth' });
        });

        if (btnPageDown) btnPageDown.addEventListener('click', function() {
            window.scrollBy({ top: window.innerHeight, behavior: 'smooth' });
        });

        if (btnBottom) btnBottom.addEventListener('click', function() {
            window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
        });
    }

    var navWrapper = document.querySelector('.main-navigation');
    var navUl = document.querySelector('.main-navigation ul');

    if (navWrapper && navUl) {
        function checkScroll() {
            // 데스크탑 등 스크롤이 필요 없는 환경 처리
            if (navUl.scrollWidth <= navUl.clientWidth) {
                navWrapper.classList.remove('can-scroll-left', 'can-scroll-right');
                return;
            }

            var scrollLeft = Math.ceil(navUl.scrollLeft);
            var maxScroll = navUl.scrollWidth - navUl.clientWidth;

            if (scrollLeft > 0) {
                navWrapper.classList.add('can-scroll-left');
            } else {
                navWrapper.classList.remove('can-scroll-left');
            }

            if (scrollLeft < maxScroll - 1) {
                navWrapper.classList.add('can-scroll-right');
            } else {
                navWrapper.classList.remove('can-scroll-right');
            }
        }

        // 페이지 로드 시 선택된 메뉴 항목이 보이도록 스크롤 이동
        var activeItem = navUl.querySelector('.current-menu-item, .current_page_item');
        if (activeItem) {
            var offsetLeft = activeItem.offsetLeft;
            var itemWidth = activeItem.clientWidth;
            var wrapperWidth = navWrapper.clientWidth;
            // 항목을 중앙에 위치시키기 위한 스크롤 값 계산
            navUl.scrollLeft = offsetLeft - (wrapperWidth / 2) + (itemWidth / 2);
        }

        checkScroll();
        navUl.addEventListener('scroll', checkScroll);
        window.addEventListener('resize', checkScroll);
    }
});
</script>
</body>
</html>
