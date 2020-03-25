<? $post_type = get_post_type();?>
<form id="search" role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
    <label>
        <span class="screenreader-text"><?php echo _x( 'Search for', 'label' ) ?></span>
        <input type="search" class="search-field" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
        <input type="hidden" name="post_type" value="<?php echo $post_type;?>" />
    </label>
    <input type="submit" class="search-submit btn white-text green" value="<?php echo esc_attr_x( 'Find matching ' . $post_type, 'submit button' ) ?>" />
</form>
