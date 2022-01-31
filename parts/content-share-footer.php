
<div id="share-links-bottom" class="center-align col s12">
  <a href="https://twitter.com/intent/tweet?url=<?php echo get_permalink(); ?>&via=<?php echo get_theme_mod( 'tcx_twitter_handle' );?>&text=<?php the_title(); ?>" aria-label="Share this content on Twitter"><i aria-hidden="true" class="mdi mdi-twitter"></i><span class="hide-o-small-and-down">Share on Twitter </span></a>

	<a href="mailto:?subject=I wanted to share this post with you from <?php bloginfo('name'); ?>&body=<?php the_title('','',true); ?>&#32;&#32;<?php echo wp_get_shortlink() ?>" aria-label="Email this content to a friend or colleague"><i aria-hidden="true" class="mdi mdi-email"></i><span class="hide-o-small-and-down">Share by email </span></a>

  <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo wp_get_shortlink() ?>" aria-label="Share this content on Facebook"><i aria-hidden="true" class="mdi mdi-facebook"></i><span class="hide-o-small-and-down">Share on Facebook </span></a>

  <button aria-label="Print this content" onclick="printFunction()"><i aria-hidden="true" class="mdi mdi-printer"></i><span class="hide-o-small-and-down">Print Page</span></button>

</div>


<!-- <script>
function hideLinks() {
  let article = document.getElementById('resources_article');
  let checkbox = document.getElementById('links_off');
  article.classList.toggle('links-off');
}
</script> -->
