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
            $current_year = date( 'Y' );
            printf( esc_html__( '© 2008 - %s Created by taeho. All rights reserved.', 'taehos-light-core' ), esc_html( $current_year ) );
            ?>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
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
