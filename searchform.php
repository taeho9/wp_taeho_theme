<?php
/**
 * Template for displaying search forms
 *
 * @package taehos-light-core
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" style="display: flex; align-items: center; justify-content: center; width: 100%; max-width: 500px; margin: 0 auto;">
    <label style="flex: 1; margin: 0;">
        <span class="screen-reader-text" style="display: none;"><?php echo _x( 'Search for:', 'label', 'taehos-light-core' ); ?></span>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( '검색어를 입력하세요...', 'placeholder', 'taehos-light-core' ); ?>" value="<?php echo get_search_query(); ?>" name="s" style="width: 100%; padding: 12px 16px; border: 1px solid #ddd; border-radius: 24px 0 0 24px; font-size: 16px; outline: none; box-sizing: border-box; transition: border-color 0.3s;" onfocus="this.style.borderColor='#0073aa';" onblur="this.style.borderColor='#ddd';" />
    </label>
    <button type="submit" class="search-submit" style="padding: 12px 24px; background-color: #0073aa; color: #fff; border: 1px solid #0073aa; border-radius: 0 24px 24px 0; font-size: 16px; cursor: pointer; transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='#005177';" onmouseout="this.style.backgroundColor='#0073aa';">
        <?php echo _x( '검색', 'submit button', 'taehos-light-core' ); ?>
    </button>
</form>
