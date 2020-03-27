
<div id="share-links-bottom" class="center-align">
  <a class="btn-flat" href="https://twitter.com/intent/tweet?url=<?php echo get_permalink(); ?>&via=<?php echo get_theme_mod( 'tcx_twitter_handle' );?>&text=<?php the_title(); ?>" aria-label="Share this content on Twitter"><span class="hide-on-small-and-down">Share on Twitter </span><i aria-hidden="true" class="mdi mdi-twitter left"></i></a>

	<a class="btn-flat" href="mailto:?subject=I wanted to share this post with you from <?php bloginfo('name'); ?>&body=<?php the_title('','',true); ?>&#32;&#32;<?php echo wp_get_shortlink() ?>" aria-label="Email this content to a friend or colleague"><span class="hide-on-small-and-down">Share by email </span><i aria-hidden="true" class="mdi mdi-email left"></i></a>

  <a class="btn-flat" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo wp_get_shortlink() ?>" aria-label="Share this content on Facebook"><span class="hide-on-small-and-down">Share on Facebook </span><i aria-hidden="true" class="mdi mdi-facebook left"></i></a>

  <button class="btn-flat" aria-label="Print this content" onclick="printFunction()"><span class="hide-on-small-and-down">Print Page </span><i aria-hidden="true" class="mdi mdi-printer left"></i></button>
</div>
